<?php
include '../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM developers WHERE developer_id = ?");
$stmt->execute([$id]);

$developer = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])) {

    $developer_name = $_POST['developer_name'];
    $specialty = $_POST['specialty'];

    $sql = "UPDATE developers
            SET developer_name = ?, specialty = ?
            WHERE developer_id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $developer_name,
        $specialty,
        $id
    ]);

    $log = $pdo->prepare("INSERT INTO activity_logs(username, action)
    VALUES(?, ?)");

    $action = "Updated developer: $developer_name";

    $log->execute([
        $_SESSION['username'],
        $action
    ]);

    header("Location: ../index.php");
}
?>

<h1>Update Developer</h1>

<form method="POST">

<input type="text" name="developer_name"
value="<?= $developer['developer_name']; ?>" required>

<br><br>

<input type="text" name="specialty"
value="<?= $developer['specialty']; ?>" required>

<br><br>

<button type="submit" name="submit">
Update Developer
</button>

</form>