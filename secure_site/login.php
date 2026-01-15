<?php
$conn = mysqli_connect("localhost", "root", "", "sqli");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ✅ Prepared statement
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username=? AND password=?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="POST">
    <h2>Secure Login</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <input type="text" name="username" placeholder="Username" required>
    <input type="text" name="password" placeholder="Password" required>

    <button name="login">Login</button>
</form>

</body>
</html>
