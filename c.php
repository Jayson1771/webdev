<?php
include 'connect.php';
if (isset($_POST['submit'])) {
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

$sql = "INSERT INTO users (email, password_hash, role) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $email, $password, $role);
$stmt->execute();
$user_id = $stmt->insert_id;

if ($role === 'nurse'){
    $license = $_POST['license_no'];
    $sql2 = "INSERT INTO nurses (user_id, license_no) VALUES (?, ?)";
    $stmt2 = $con->prepare($sql2);
    $stmt2->bind_param("is", $user_id, $license);
    $stmt2->execute();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="email" name = "email">
        <input type="password" name="password">
        <select name="role" id="role">
            <option value="nurse">Nurse</option>
            <option value="user">Student</option>
            <option value="teacher">Teacher</option>
        </select>
        <input type="text" name="license_no" placeholder="License Number (Nurse only)">
        <input type="submit" name="submit" class="btn btn-login text-white" value="Continue">
    </form>
</body>
</html>