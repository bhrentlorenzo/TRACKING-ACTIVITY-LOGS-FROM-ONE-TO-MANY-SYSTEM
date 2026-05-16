<?php
include '../config/database.php';

$message = "";

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])) {

        $_SESSION['username'] = $username;

        header("Location: ../index.php");

    } else {

        $message = "Invalid username or password.";
    }
}
?>

<h1>Login</h1>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<br><br>

<input type="password" name="password" placeholder="Password" required>

<br><br>

<button type="submit" name="login">
Login
</button>

</form>

<p><?= $message; ?></p>

<a href="register.php">Register</a>