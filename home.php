<?php
    session_start();
    include 'connect.php';
    if (!isset($_SESSION['username'])) {
    die("<script>alert('You must enter your Student.'); window.location.href='sign_in.php';</script>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Portal Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Home</title>
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
            justify-content: space-between;
        }

        header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logout-btn {
            background-color: #8b080e;
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        /* Main Content Styles */
        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .welcome-message {
            text-align: center;
            margin-bottom: 3rem;
        }

        .welcome-message h2 {
            font-size: 2rem;
            color: #001219;
            margin-bottom: 1rem;
        }

        .welcome-message p {
            color: #444;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .actions-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            width: 100%;
            max-width: 800px;
        }

        .action-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
            width: 300px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .action-icon {
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

        .action-card h3 {
            margin-bottom: 1rem;
            color: #001219;
        }

        .action-card p {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .btn-action {
            background-color: #9c031d;
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.2s;
        }

        .btn-action:hover {
            background-color: #8b080e;
            color: white;
        }

        footer {
            background-color: #8b080e;
            color: white;
            text-align: center;
            padding: 1.5rem;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .actions-container {
                flex-direction: column;
                align-items: center;
            }
            
            .action-card {
                width: 100%;
                max-width: 350px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Clinic Information System Services</h1>
        <div class="header-actions">
           <a href="logout.php">Logout</a>
        </div>
    </header>


    <div class="main-container">
        <div class="welcome-message">
            <h2>Clinic Management Portal</h2>
            <p>Access student health form records or create new medical entries with just one click</p>
        </div>

        <div class="actions-container">

            <div class="action-card">
                <div class="action-icon">
                    <i class="fas fa-history"></i>
                </div>
                <h3>Records History</h3>
                <p>View and manage all student medical records in the system</p>
                <a href="view.php" class="btn-action">View Records</a>
            </div>

            <div class="action-card">
                <div class="action-icon">
                    <i class="fas fa-file-medical"></i>
                </div>
                <h3>Create New Record</h3>
                <p>Create a new medical record for a student</p>
                <a href="create.php" class="btn-action">Create Record</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p class="mb-0">© 2025 CIS | <i class="fas fa-phone"></i> (123) 456-7890 | <i class="fas fa-envelope"></i> clinic@university.edu</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function logout(){
            var con = confirm("Do you want to Log-out?");{
                if (con==false){
                    event.preventDefault();
                }else{
                    alert("Logged Out successfully.")
                }
            }
        }
    </script>
</body>
</html>