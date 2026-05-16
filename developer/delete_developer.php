<?php
include '../config/database.php';

$id = $_GET['id'];

$get = $pdo->prepare("SELECT * FROM developers WHERE developer_id = ?");
$get->execute([$id]);

$developer = $get->fetch(PDO::FETCH_ASSOC);

$sql = "DELETE FROM developers WHERE developer_id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$log = $pdo->prepare("INSERT INTO activity_logs(username, action)
VALUES(?, ?)");

$action = "Deleted developer: " . $developer['developer_name'];

$log->execute([
    $_SESSION['username'],
    $action
]);

header("Location: ../index.php");
?>