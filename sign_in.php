<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Clinic Portal | Select Role</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to right, #9c031d, #8b080e);
      font-family: 'Segoe UI', sans-serif;
      color: #fff;
    }

    .portal-container {
      min-height: 80vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }

    .card {
      border: none;
      border-radius: 16px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .role-icon {
      font-size: 4rem;
      color: #9c031d;
    }

    .card-body {
      padding: 2rem;
      text-align: center;
    }

    .role-title {
      font-weight: 600;
      color: #9c031d;
    }

    a.text-decoration-none {
      color: inherit;
    }

    .card-text {
      color: #555;
    }

    header {
      background-color: #800000;
      color: #fff;
      padding: 1rem 2rem;
      text-align: center;
      font-size: 1.5rem;
      font-weight: bold;
    }

    footer {
      background-color: #8b080e;
      color: #fff;
      text-align: center;
      padding: 1rem;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    @media (max-width: 768px) {
      .role-icon {
        font-size: 2.5rem;
      }
    }
  </style>
</head>
<body>

  <header>
    PUP Clinic Information System
  </header>

  <div class="container portal-container">
    <div class="row g-4 justify-content-center">
      <div class="col-md-5">
        <a href="login.php" class="text-decoration-none">
          <div class="card bg-light">
            <div class="card-body">
              <div class="role-icon mb-3">
                <i class="bi bi-mortarboard-fill"></i>
              </div>
              <h4 class="role-title">Student Portal</h4>
              <p class="card-text">Access your medical records, certificates, and health assessments.</p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-5">
        <a href="nurse_login.php" class="text-decoration-none">
          <div class="card bg-light">
            <div class="card-body">
              <div class="role-icon mb-3">
                <i class="bi bi-person-bounding-box"></i>
              </div>
              <h4 class="role-title">Nurse Portal</h4>
              <p class="card-text">Login to manage student health records and assessments.</p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <footer>
    &copy; 2025 Clinic Information System. All rights reserved.
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
