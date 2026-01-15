<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

//Intentionally no role validation (vulnerability)

$conn = mysqli_connect("localhost", "root", "", "sqli");

if (!$conn) {
    die("Database connection failed");
}

// Dump all user data (simulating data theft)
$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form>
    <h2>Admin Dashboard (Sensitive Data)</h2>

    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
        </tr>

        <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['password']}</td>
                        <td>{$row['role']}</td>
                      </tr>";
            }
        }
        ?>
    </table>
</form>

</body>
</html>
