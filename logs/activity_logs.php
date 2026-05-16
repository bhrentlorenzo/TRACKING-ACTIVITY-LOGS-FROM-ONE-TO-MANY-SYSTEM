<?php
include '../config/database.php';

$logs = $pdo->query("SELECT * FROM activity_logs
ORDER BY created_at DESC")
->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Activity Logs</h1>

<a href="../index.php">Back</a>

<table border="1" cellpadding="10">

<tr>
<th>Username</th>
<th>Action</th>
<th>Date</th>
</tr>

<?php foreach($logs as $log): ?>

<tr>

<td>
<?= $log['username']; ?>
</td>

<td>
<?= $log['action']; ?>
</td>

<td>
<?= $log['created_at']; ?>
</td>

</tr>

<?php endforeach; ?>

</table>