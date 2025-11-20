<?php
session_start();
include 'connect.php';
session_destroy();
session_abort();
header("Location: sign_in.php");
exit;
?>
