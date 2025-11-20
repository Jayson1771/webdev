<?php
session_start();
include("connect.php");
include("functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (!empty($username) && !empty($password) && !is_numeric($username)) {
    $query = "SELECT * FROM users WHERE username = ? AND pass_word = ? AND role = 'student'";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
      $user_data = mysqli_fetch_assoc($result);
      if ($user_data['pass_word'] === $password && $user_data['username'] === $username) {
        $_SESSION['username'] = $user_data['username'];
        header("Location: home.php");
        exit;
      }
    }
}else {
        echo "<script>alert('Incorrect Student ID or Student ID doesn\\'t exist');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIS Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Log In</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #f5f7fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }


        header {
            background-color: #9c031d;
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            height: 68px;
            display: flex;
            align-items: center;
        }

        header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }


        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        p a{
            color: #8b080e;
            text-decoration: none;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
        }

        .clinic-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #9c031d;
            color: white;
            border-radius: 50%;
            font-size: 2rem;
        }

        .btn-login {
            background-color: #9c031d;
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            width: 100%;
            transition: background-color 0.2s;
        }

        .btn-login:hover {
            background-color: #8b080e;
        }

        .form-control:focus {
            border-color: #9c031d;
            box-shadow: 0 0 0 0.25rem rgba(156, 3, 29, 0.25);
        }

        .error-message {
            color: #e63946;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            text-align: left;
        }


        footer {
            background-color: #8b080e;
            color: white;
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Clinic Information System</h1>
    </header>
    <div class="text-start mt-3" style="padding: 20px;">
    <a href="sign_in.php" class="btn btn-secondary">← Back</a>
    </div>
    <div class="login-container">
        <div class="login-card">

            <div class="clinic-logo">
                <i class="fas fa-hospital"></i>
            </div>
            
            <h2 class="mb-4">Student Login</h2>
            
            <form id="loginForm" method="POST">
                <div class="mb-3">
                    <label for="studentId" class="form-label">Student Username</label>
                    <input name="username" type="text" class="form-control" id="studentId" placeholder="Enter your student username" required>
                    <label for="studentId" class="form-label">Student Password</label>
                    <input name="password" type="password" class="form-control" id="studentId" placeholder="Enter your password" required>
                    <div id="studentIdError" class="error-message d-none">Please enter your student Username and Password</div>
                </div>
                
                <input type="submit" name="continue" class="btn btn-login text-white" value="Continue">
        </div>
        
    </div>
</form>
    <footer>
        <div class="container">
            <p class="mb-0">© 2025 CIS | <i class="fas fa-phone"></i> (123) 456-7890</p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const studentId = document.getElementById('studentId').value.trim();
            const errorElement = document.getElementById('studentIdError');
            
            errorElement.classList.add('d-none');
            
            if (!studentId) {
                errorElement.classList.remove('d-none');
            } else {

                alert('Student ID: ' + studentId + 'Welcome, to your CIS!');
            }
        });
    </script> -->
</body>
</html>