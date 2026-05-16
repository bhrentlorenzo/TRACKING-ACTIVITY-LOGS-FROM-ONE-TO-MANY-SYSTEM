<?php
include '../config/database.php';

$id = $_GET['id'];

$get = $pdo->prepare("SELECT * FROM projects WHERE project_id = ?");
$get->execute([$id]);

$project = $get->fetch(PDO::FETCH_ASSOC);

$sql = "DELETE FROM projects WHERE project_id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$log = $pdo->prepare("INSERT INTO activity_logs(username, action)
VALUES(?, ?)");

$action = "Deleted project: " . $project['project_name'];

$log->execute([
    $_SESSION['username'],
    $action
]);

header("Location: ../index.php");
?>