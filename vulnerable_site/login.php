<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "sqli");

if (!$conn) {
    die("Database connection failed");
}

// Handle login
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    //Vulnerable query (intentionally unsafe)
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {

        // Fetch first matching user
        $user = mysqli_fetch_assoc($result);

        // Store session values
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit();

    } else {
        $error = "Invalid login credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="POST">
    <h2>Vulnerable Login</h2>

    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <input type="text" name="username" placeholder="Username" required>
    <input type="text" name="password" placeholder="Password" required>

    <button type="submit" name="login">Login</button>
</form>

</body>
</html>
