<?php
$_SERVER = "localhost";
$username = "root";
$password = "";
$databasename = "coba";

$koneksi = mysqli_connect($_SERVER, $username, $password, $databasename);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <header>Login</header>
    <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Masukan Username">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukan Password">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukan email">

        <button type="Submit">Login</button>
    </form>
</body>
</html>