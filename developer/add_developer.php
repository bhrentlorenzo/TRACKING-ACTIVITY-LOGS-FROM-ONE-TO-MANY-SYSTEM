<?php
include '../config/database.php';

if(isset($_POST['submit'])) {

    $developer_name = $_POST['developer_name'];
    $specialty = $_POST['specialty'];

    $sql = "INSERT INTO developers
            (developer_name, specialty)
            VALUES (?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $developer_name,
        $specialty
    ]);

    $log = $pdo->prepare("INSERT INTO activity_logs(username, action)
    VALUES(?, ?)");

    $action = "Inserted developer: $developer_name";

    $log->execute([
        $_SESSION['username'],
        $action
    ]);

    header("Location: ../index.php");
}
?>

<h1>Add Developer</h1>

<form method="POST">

<input type="text" name="developer_name" placeholder="Developer Name" required>

<br><br>

<input type="text" name="specialty" placeholder="Specialty" required>

<br><br>

<button type="submit" name="submit">
Add Developer
</button>

</form>