<?php
session_start();
include("connect.php");
include("functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (!empty($username) && !empty($password) && !is_numeric($username)) {
    $query = "SELECT * FROM users WHERE username = ? AND pass_word = ? AND role = 'nurse'";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
      $user_data = mysqli_fetch_assoc($result);
      if ($user_data['pass_word'] === $password && $user_data['username'] === $username) {
        $_SESSION['username'] = $user_data['username'];
        header("Location: dashboard.php");
        exit;
      }
    }else {
        echo "<script>window.alert('Incorrect input. Please enter your correct username or password.')</script>";
      }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nurse Login | Clinic Information System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #9c031d, #8b080e);
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-box {
      background: #fff;
      padding: 2.5rem 2rem;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 400px;
    }

    .login-box h2 {
      text-align: center;
      color: #9c031d;
      margin-bottom: 1.5rem;
    }

    .btn-login {
      background-color: #9c031d;
      color: #fff;
      font-weight: bold;
      border: none;
    }

    .btn-login:hover {
      background-color: #8b080e;
    }

    .form-control:focus {
      border-color: #9c031d;
      box-shadow: 0 0 0 0.2rem rgba(156, 3, 29, 0.25);
    }

    footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      text-align: center;
      background-color: #8b080e;
      color: white;
      padding: 0.75rem;
    }
  </style>
</head>
<body>
    <div class="text-start mt-3" style="padding: 20px;">
    <a href="sign_in.php" class="btn btn-secondary">← Back</a>
    </div>
  <!-- Nurse Login Form -->
  <div class="container login-container">
    <div class="login-box">
      <h2>Nurse Login</h2>
      <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
        </div>
        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-login w-100">Login</button>
      </form>
    </div>
  </div>

  <footer>
    &copy; 2025 PUP Clinic Information System. All rights reserved.
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
