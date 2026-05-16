<?php
include 'config/database.php';

if(!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}

$search = "";

if(isset($_GET['search'])) {
    $search = $_GET['search'];
}

$stmt = $pdo->prepare("
SELECT * FROM developers
WHERE developer_name LIKE ?
");

$stmt->execute(["%$search%"]);

$developers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Web Development Agency</title>
</head>

<body>

<h1>WEB DEVELOPMENT AGENCY</h1>

<p>
Logged in as:
<b><?= $_SESSION['username']; ?></b>
</p>

<a href="auth/logout.php">Logout</a>

|

<a href="logs/activity_logs.php">
Activity Logs
</a>

|

<a href="search.php">
Search Records
</a>

<hr>

<form method="GET">

    <input
    type="text"
    name="search"
    placeholder="Search Developer">

    <button type="submit">
        Search
    </button>

</form>

<br>

<a href="developer/add_developer.php">
Add Developer
</a>

<hr>

<?php foreach($developers as $developer): ?>

    <h2>
        <?= $developer['developer_name']; ?>
    </h2>

    <p>
        Specialty:
        <?= $developer['specialty']; ?>
    </p>

    <a href="developer/update_developer.php?id=<?= $developer['developer_id']; ?>">
        Edit
    </a>

    |

    <a href="developer/delete_developer.php?id=<?= $developer['developer_id']; ?>">
        Delete
    </a>

    |

    <a href="project/add_project.php?id=<?= $developer['developer_id']; ?>">
        Add Project
    </a>

    <br><br>

    <?php

    $stmt2 = $pdo->prepare("
    SELECT * FROM projects
    WHERE developer_id = ?
    ");

    $stmt2->execute([
        $developer['developer_id']
    ]);

    $projects = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <table border="1" cellpadding="10">

        <tr>
            <th>Project</th>
            <th>Client</th>
            <th>Actions</th>
        </tr>

        <?php foreach($projects as $project): ?>

        <tr>

            <td>
                <?= $project['project_name']; ?>
            </td>

            <td>
                <?= $project['client_name']; ?>
            </td>

            <td>

                <a href="project/update_project.php?id=<?= $project['project_id']; ?>">
                    Edit
                </a>

                |

                <a href="project/delete_project.php?id=<?= $project['project_id']; ?>">
                    Delete
                </a>

            </td>

        </tr>

        <?php endforeach; ?>

    </table>

    <hr>

<?php endforeach; ?>

</body>
</html>