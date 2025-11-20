<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['username'])) {
    die("<script>alert('You must be logged in.'); window.location.href='nurse_login.php';</script>");
}
$query = "
    SELECT sex, weight, height
    FROM students
    WHERE (LRN_number, registration_time) IN (
        SELECT LRN_number, MAX(registration_time)
        FROM students
        GROUP BY LRN_number
    )";
$result = $conn->query($query);

$total_students = 0;
$male_students = 0;
$female_students = 0;
$male_overweight = 0;
$female_overweight = 0;
$healthy_males = 0;
$healthy_females = 0;
$male_underweight = 0;
$female_underweight = 0;

while ($row = $result->fetch_assoc()) {
    $total_students++;
    $sex = strtolower($row['sex']);
    $weight = floatval($row['weight']);
    $height_cm = floatval($row['height']);
    $height_m = $height_cm / 100;

    if ($height_m > 0) {
        $bmi = $weight / ($height_m * $height_m);

        $is_healthy = $bmi >= 18.5 && $bmi <= 24.9;
        $is_overweight = $bmi >= 25;
        $is_underweight = $bmi < 18.5;

        if ($sex === "male") {
            $male_students++;
            if ($is_healthy) $healthy_males++;
            if ($is_overweight) $male_overweight++;
            if ($is_underweight) $male_underweight++;
        } elseif ($sex === "female") {
            $female_students++;
            if ($is_healthy) $healthy_females++;
            if ($is_overweight) $female_overweight++;
            if ($is_underweight) $female_underweight++;
        }
    }
}

$total_healthy = $healthy_males + $healthy_females;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CIS Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-text mx-3">CIS Dashboard</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="signup.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Create Account for Student</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="R_nurse.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Create Student Record</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">
                    <i class="fas fa-fw fa-question"></i>
                    <span>About</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h1 class="h3 mb-0 text-gray-800">CIS Dashboard, Welcome Back <?php echo $_SESSION['username']; ?></h1>
                </nav>


                <div class="container-fluid">
                    <div class="row">
  
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">All Students</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_students; ?></div>
                                            <small class="text-muted"><?php echo $total_healthy; ?> are healthy</small>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Male Students</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $male_students; ?></div>
                                            <small class="text-muted"><?php echo $healthy_males; ?> healthy, <?php echo $male_overweight; ?> overweight</small>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-mars fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Female Students</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $female_students; ?></div>
                                            <small class="text-muted"><?php echo $healthy_females; ?> healthy, <?php echo $female_overweight; ?> overweight</small>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-venus fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Overall Healthy</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_healthy; ?></div>
                                            <small class="text-muted"><?php echo $total_healthy; ?> out of <?php echo $total_students; ?> students</small>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-heartbeat fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Gender Distribution</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="genderChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
    <div class="col-xl-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Health Status</h6>
            </div>
            <div class="card-body">
                <canvas id="healthChart"></canvas>
            </div>
        </div>
    </div>
</div>

                        </div>                       
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const genderChart = new Chart(document.getElementById('genderChart'), {
            type: 'pie',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: 'Gender Distribution',
                    data: [<?= $male_students ?>, <?= $female_students ?>],
                    backgroundColor: ['#36b9cc', '#f6c23e']
                }]
            }
        });
    const healthChart = new Chart(document.getElementById('healthChart'), {
        type: 'bar',
        data: {
            labels: ['Healthy', 'Overweight', 'Underweight'],
            datasets: [
                {
                    label: 'Male',
                    data: [<?= $healthy_males ?>, <?= $male_overweight ?>, <?= $male_underweight ?>],
                    backgroundColor: '#4e73df'
                },
                {
                    label: 'Female',
                    data: [<?= $healthy_females ?>, <?= $female_overweight ?>, <?= $female_underweight ?>],
                    backgroundColor: '#e74a3b'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</body>

</html>