<?php
    include('connect.php');
if(isset($_POST['submit'])){
    $student_id = $_POST['id']; // Logged-in user ID
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $program = $_POST['program'];

    // Handle allergies, including "Other"
    $allergies = $_POST['allergies'] ?? [];
    if (in_array('Other', $allergies) && !empty($_POST['other_allergy'])) {
        $allergies[] = $_POST['other_allergy'];
    }
    $allergies_str = count($allergies) ? implode(", ", array_diff($allergies, ['Other'])) : 'None';

    // Handle medical history, including "Other"
    $medical_history = $_POST['medical_history'] ?? [];
    if (in_array('Other', $medical_history) && !empty($_POST['other_history'])) {
        $medical_history[] = $_POST['other_history'];
    }
    $medical_history_str = count($medical_history) ? implode(", ", array_diff($medical_history, ['Other'])) : 'None';

    // Prepare SQL
    $query = "INSERT INTO studentdata 
              (student_id, height, weight, age, sex, program, allergies, medical_history) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param(
        $stmt,
        "ssssssss",
        $student_id, $height, $weight, $age, $sex, $program, $allergies_str, $medical_history_str
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Medical assessment submitted successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic - Medical Assessment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Certificate</title>
    <style>
        :root {
            --primary: #9c031d;
            --secondary: #8b080e;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        header {
            background-color: var(--primary);
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            height: 68px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
            flex: 1;
            width: 100%;
        }

        .medical-form {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .bmi-result {
            padding: 1rem;
            border-radius: 5px;
            margin-top: 1rem;
            font-weight: 500;
            text-align: center;
            display: none;
        }

        .underweight {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .normal {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .overweight {
            background-color: #ffe8cc;
            color: #856404;
            border: 1px solid #ffdfb3;
        }

        .obese {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--secondary);
        }

        footer {
            background-color: var(--secondary);
            color: white;
            text-align: center;
            padding: 1.5rem;
            margin-top: auto;
        }

        [id*="OtherContainer"] {
            display: none;
        }
    </style>
</head>

<body>
    <header>
        <h1 class="m-0">Clinic Information System</h1>
    </header>
    <div class="text-start mt-3" style="padding: 20px;">
    <a href="dashboard.php" class="btn btn-secondary">← Back</a>
    </div>
    <form class="medical-form" id="medicalForm" method="POST" action="">
    <h2 class="text-center mb-4" style="color: var(--primary);">Medical Assessment</h2>

    <!-- New Fields: Age, Sex, Program -->
     <div class="row mb-4 g-3">
    <div class="col-md-4">
        <label class="form-label">Student ID</label>
        <input type="text" name="id" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Age</label>
        <input type="number" name="age" class="form-control" min="10" max="50" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Sex</label>
        <select name="sex" class="form-select" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>
</div>

<div class="row mb-4 g-3">
    <div class="col-md-6">
        <label class="form-label">Program</label>
        <select name="program" class="form-select" required>
            <option value="">Select</option>
            <option value="BSED">BEED</option>
            <option value="BSIT">BSIT</option>
            <option value="BSENT">BSENT</option>
            <option value="DOMT">DOMT</option>
            <option value="DIT">DIT</option>
        </select>
    </div>
</div>


    <!-- BMI Calculation (Existing) -->
    <div class="mb-4">
        <h3>BMI Calculation</h3>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Height (cm)</label>
                <input type="number" name="height" class="form-control" min="50" max="250" step="0.1" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Weight (kg)</label>
                <input type="number" name="weight" class="form-control" min="10" max="300" step="0.1" required>
            </div>
        </div>
        <button type="button" class="btn btn-primary mt-3" id="calculateBmi">Calculate BMI</button>
        <div id="bmiResult" class="bmi-result"></div>
    </div>

    <!-- Allergies (Existing) -->
    <div class="mb-4">
        <h3>Allergies</h3>
        <div class="d-flex flex-column gap-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="allergies[]" value="None" id="allergyNone">
                <label class="form-check-label" for="allergyNone">No known allergies</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="allergies[]" value="Penicillin" id="allergyPenicillin">
                <label class="form-check-label" for="allergyPenicillin">Penicillin/antibiotics</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="allergies[]" value="Food" id="allergyFood">
                <label class="form-check-label" for="allergyFood">Food allergies</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="allergies[]" value="Latex" id="allergyLatex">
                <label class="form-check-label" for="allergyLatex">Latex</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="allergies[]" value="Other" id="allergyOther">
                <label class="form-check-label" for="allergyOther">Other allergies</label>
            </div>
        </div>
        <div id="otherAllergyContainer" class="mt-2">
            <input type="text" class="form-control" name="other_allergy" placeholder="Please specify">
        </div>
    </div>

    <!-- Medical History (Existing) -->
    <div class="mb-4">
        <h3>Medical History</h3>
        <div class="d-flex flex-column gap-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="medical_history[]" value="None" id="historyNone">
                <label class="form-check-label" for="historyNone">No significant history</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="medical_history[]" value="Diabetes" id="historyDiabetes">
                <label class="form-check-label" for="historyDiabetes">Diabetes</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="medical_history[]" value="Hypertension" id="historyHypertension">
                <label class="form-check-label" for="historyHypertension">Hypertension</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="medical_history[]" value="Asthma" id="historyAsthma">
                <label class="form-check-label" for="historyAsthma">Asthma</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="medical_history[]" value="Heart" id="historyHeart">
                <label class="form-check-label" for="historyHeart">Heart conditions</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="medical_history[]" value="Other" id="historyOther">
                <label class="form-check-label" for="historyOther">Other conditions</label>
            </div>
        </div>
        <div id="otherHistoryContainer" class="mt-2">
            <input type="text" class="form-control" name="other_history" placeholder="Please specify">
        </div>
    </div>

    <button type="submit" name="submit" class="btn btn-primary w-100">Submit Assessment</button>
</form>
    <footer>
        <div class="container">
            <p class="m-0">© 2025 CIS</p>
        </div>
    </footer>

</body>

</html>