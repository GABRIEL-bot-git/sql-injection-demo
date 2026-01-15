<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Basic authentication check
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form>
    <h2>User Dashboard</h2>
    <p>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></p>
    <p>This is a normal user account.</p>
</form>

</body>
</html>
