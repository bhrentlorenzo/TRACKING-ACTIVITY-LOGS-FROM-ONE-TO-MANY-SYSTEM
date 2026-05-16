<?php
include 'config/database.php';

if(!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

$search = "";

$developers = [];
$projects = [];

if(isset($_GET['search'])) {

    $search = $_GET['search'];

    $stmt = $pdo->prepare("
    SELECT * FROM developers
    WHERE developer_name LIKE ?
    OR specialty LIKE ?
    ");

    $stmt->execute([
        "%$search%",
        "%$search%"
    ]);

    $developers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt2 = $pdo->prepare("
    SELECT * FROM projects
    WHERE project_name LIKE ?
    OR client_name LIKE ?
    ");

    $stmt2->execute([
        "%$search%",
        "%$search%"
    ]);

    $projects = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Search Records</title>
</head>

<body>

<h1>Search Records</h1>

<a href="index.php">
Back to Homepage
</a>

<hr>

<form method="GET">

    <input
    type="text"
    name="search"
    placeholder="Search here"
    value="<?= $search; ?>"
    required>

    <button type="submit">
        Search
    </button>

</form>

<hr>

<h2>Developer Results</h2>

<table border="1" cellpadding="10">

<tr>
    <th>Developer Name</th>
    <th>Specialty</th>
</tr>

<?php foreach($developers as $developer): ?>

<tr>

    <td>
        <?= $developer['developer_name']; ?>
    </td>

    <td>
        <?= $developer['specialty']; ?>
    </td>

</tr>

<?php endforeach; ?>

</table>

<hr>

<h2>Project Results</h2>

<table border="1" cellpadding="10">

<tr>
    <th>Project Name</th>
    <th>Client Name</th>
</tr>

<?php foreach($projects as $project): ?>

<tr>

    <td>
        <?= $project['project_name']; ?>
    </td>

    <td>
        <?= $project['client_name']; ?>
    </td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>