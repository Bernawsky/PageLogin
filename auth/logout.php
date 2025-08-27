<?php
// auth/logout.php
session_start();
session_destroy();
header("Location: ../public/login.html");
exit;
?>