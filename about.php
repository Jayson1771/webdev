<?php
   include ("connect.php");
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About CIS</title>

  <!-- Bootstrap and FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fa;
    }

    .sidebar {
      background: #9c031d;
      color: white;
      min-height: 100vh;
      padding-top: 1rem;
    }

    .sidebar .menu a {
      color: white;
      text-decoration: none;
      padding: 0.75rem 1rem;
      display: block;
    }

    .sidebar .menu a:hover,
    .sidebar .menu .active a {
      background: #8b080e;
    }

    .faq-section {
      overflow: hidden;
      max-height: 0;
      transition: max-height 0.6s ease, padding 0.3s ease;
    }

    .faq-section.open {
      max-height: 1000px;
      padding-top: 1rem;
    }

    footer {
      background-color: #9c031d;
      color: white;
      text-align: center;
      padding: 1rem;
      margin-top: 2rem;
    }
  </style>
</head>

<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar">
      <ul class="menu list-unstyled">
        <li><a href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
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
        <li class="active"><a href="#"><i class="fa-solid fa-question me-2"></i>About</a></li>
        <li><a href="sign_in.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="col-md-10 py-4 px-5">
      <div class="bg-danger text-white rounded p-4 mb-4 text-center shadow">
        <h1>About PUP Clinic Information System</h1>
        <p class="mb-0">A centralized system to manage student health records efficiently at PUP Unisan Campus.</p>
      </div>

      <div class="card p-4 mb-4 shadow">
        <h2 class="text-danger">Background</h2>
        <p>The PUP CIS addresses the need for a centralized, digital medical records system for students. It replaced manual records, streamlining access and improving data security and clinic responsiveness.</p>
        <p>Digitization enabled real-time access to medical data, eliminated redundancy, and improved reporting for health trends and risks.</p>
      </div>

      <div class="card p-4 mb-4 shadow">
        <h2 class="text-danger">Purpose</h2>
        <p>The system allows efficient access to medical records, health certificates, and assessments. It includes features for immunization tracking, appointments, and promotes better communication between students and the clinic.</p>
      </div>

      <div class="card p-4 mb-4 shadow">
        <h2 class="text-danger">Creators</h2>
        <p>Developed by dedicated BSIT students of PUP Unisan Campus:</p>
        <ul>
          <li>Jayson C. Santoalla</li>
          <li>John Michael L. Nadal</li>
          <li>Angeli Mae B. Gabuat</li>
          <li>Mekyla G. Otos</li>
          <li>Joana Marie P. Estrada</li>
          <li>Patrick L. Yulip</li>
        </ul>
      </div>

      <div class="card p-4 shadow">
        <h2 class="text-danger">Frequently Asked Questions</h2>
        <button id="faq-button" class="btn btn-danger mb-3">Toggle FAQ</button>
        <div id="faq-section" class="faq-section">
          <div class="mb-3">
            <h5>1. What is the purpose of the PUP Clinic Information System?</h5>
            <p>To digitally manage student medical records and streamline clinic services.</p>
          </div>
          <div>
            <h5>2. How can I access my health records?</h5>
            <p>Log in to the system using your student credentials to view your records.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- JS -->
<script>
  document.getElementById("faq-button").addEventListener("click", () => {
    const faq = document.getElementById("faq-section");
    faq.classList.toggle("open");
  });
</script>

<footer>
  <p><strong>&copy; 2025 Clinic Information System. All rights reserved.</strong></p>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>