<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['username'])) {
    die("<script>alert('You must be logged in.'); window.location.href='login.php';</script>");
}

$student_id = $_SESSION['username'];

// Fetch medical records from database
$query = "SELECT * FROM students WHERE 'username' = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Medical Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #9c031d;
            --secondary: #8b080e;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #f5f7fa;
        }

        .header {
            background-color: var(--primary);
            color: white;
            padding: 1rem;
        }

        .record-container {
            max-width: 800px;
            margin: 2rem auto;
        }

        .record-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }

        .record-header {
            background-color: #f8f9fa;
            padding: 1rem;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .record-details {
            padding: 1rem;
            display: none;
        }

        .bmi-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }

        .underweight {
            background-color: #fff3cd;
            color: #856404;
        }

        .normal {
            background-color: #d4edda;
            color: #155724;
        }

        .overweight {
            background-color: #ffe8cc;
            color: #856404;
        }

        .obese {
            background-color: #f8d7da;
            color: #721c24;
        }

        .detail-row {
            margin-bottom: 0.5rem;
        }

        .detail-label {
            font-weight: 600;
            color: #555;
        }

        .back-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
        }

        .empty-message {
            text-align: center;
            color: #666;
            padding: 2rem;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>My Medical Records</h1>
            <button id="newRecordBtn" class="back-btn">New Record</button>
        </div>
    </div>

    <div class="text-start mt-3" style="padding: 20px;">
    <a href="home.php" class="btn btn-secondary">← Back</a>
    </div>
    <div>
        <?php echo $student_id;?>
    </div>  

    <div class="container record-container" id="recordsList">
        <?php if (count($records) == 0): ?>
            <div class="empty-message">
                No medical records found. Click "New Record" to create one.
            </div>
        <?php else: ?>
            <?php foreach ($records as $record): ?>
                <div class="record-card">
                    <div class="record-header">
                        Medical Record on <?= date("F j, Y", strtotime($record['created_at'] ?? 'now')) ?>
                    </div>
                    <div class="record-details">
                        <div class="detail-row"><span class="detail-label">Age:</span> <?= htmlspecialchars($record['age']) ?></div>
                        <div class="detail-row"><span class="detail-label">Sex:</span> <?= htmlspecialchars($record['sex']) ?></div>
                        <div class="detail-row"><span class="detail-label">Program:</span> <?= htmlspecialchars($record['program']) ?></div>
                        <div class="detail-row"><span class="detail-label">Height:</span> <?= htmlspecialchars($record['height']) ?> cm</div>
                        <div class="detail-row"><span class="detail-label">Weight:</span> <?= htmlspecialchars($record['weight']) ?> kg</div>

                        <?php
                            $bmi = $record['weight'] / pow($record['height'] / 100, 2);
                            $bmi = round($bmi, 1);
                            $bmi_class = match (true) {
                                $bmi < 18.5 => 'underweight',
                                $bmi <= 24.9 => 'normal',
                                $bmi <= 29.9 => 'overweight',
                                default => 'obese',
                            };
                        ?>
                        <div class="detail-row">
                            <span class="detail-label">BMI:</span>
                            <?= $bmi ?>
                            <span class="bmi-badge <?= $bmi_class ?>"><?= ucfirst($bmi_class) ?></span>
                        </div>

                        <div class="detail-row"><span class="detail-label">Allergies:</span> <?= htmlspecialchars($record['allergies']) ?></div>
                        <div class="detail-row"><span class="detail-label">Medical History:</span> <?= htmlspecialchars($record['medical_history']) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script>
        // Toggle detail view
        document.querySelectorAll('.record-header').forEach(header => {
            header.addEventListener('click', () => {
                const details = header.nextElementSibling;
                details.style.display = details.style.display === 'block' ? 'none' : 'block';
            });
        });

        // Redirect to form page
        document.getElementById('newRecordBtn').addEventListener('click', () => {
            window.location.href = 'create.php';
        });
    </script>
</body>

</html>
