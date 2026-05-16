<?php
include '../config/database.php';

$message = "";

if(isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $check->execute([$username]);

    if($check->rowCount() > 0) {

        $message = "Username already exists.";

    } else {

        $sql = "INSERT INTO users(username, password)
                VALUES(?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $username,
            $password
        ]);

        $message = "Registration Successful.";
    }
}
?>

<h1>Register</h1>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<br><br>

<input type="password" name="password" placeholder="Password" required>

<br><br>

<button type="submit" name="register">
Register
</button>

</form>

<p><?= $message; ?></p>

<a href="login.php">Login</a>