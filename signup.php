<?php
    session_start();
    include 'connect.php';
    if(isset($_POST['signup'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $query = "INSERT INTO users ( `username`, `pass_word`, role, name) VALUES ( '$email', '$password', 'student', '$name')";
        $query_run = mysqli_query($conn, $query);
        if($query_run){
            echo'<script>alert("Data Saved");</script>';
        }else{
            echo'<script>alert("Data NOT saved");</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
</head>
<body>
    <header>
        <h1 class="head">Clinic Information System</h1>
    </header>
    </div>
        <a href="dashboard.php" style="text-decoration: none; color: white; font-size: 1rem; background: #8b080e; padding: 0.5rem 1rem; border-radius: 5px;">← Back</a>
    
    <div class="signup-box">
        <h1 class="cis">CLINIC INFORMATION SYSTEM (CIS)</h1>
        <h3>Sign Up Form</h3>
        <form method="POST">
            <label for="Student Name">Student Name</label>
            <input type="text" name="name" required placeholder="Enter your Name">
            <label for="Email">User Name</label>
            <input type="text" name="email" required placeholder="Enter your User name">
            <label for="Email">Password</label>
            <input type="password" name="password" required placeholder="Enter your Password">
            <input type="submit" name="signup" value="Submit">
        </form>
        <p>By clicking the <b>Submit</b> button, you're creating an account with your information</p>
    </div>
    <footer>
        <div class="container">
            <p class="mb-0">© 2025 CIS | <i class="fas fa-phone"></i> (123) 456-7890</p>
        </div>
    </footer>
</body>
</html>