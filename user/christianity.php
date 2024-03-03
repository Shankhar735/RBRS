<?php
$msg = "";
session_start();
$id = $_SESSION['Id'];

include '../Database/connection_db.php';

$sql = "SELECT * FROM books WHERE category='Christian'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Christianity</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Cover page</th>
            <th>Book file</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['bookid'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['author'] . "</td>";
            echo "<td><img style='height: 80px; width: 110px;' src='http://localhost/RBRS/adminstrator/" . $row['coverpage'] . "'></td>";
            echo "<td>" . $row['bookfile'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>
