<?php
session_start();
include '../admin/CRUD/connection.php';
if (!isset($_SESSION['login'])) {
    header('location:../index.php');
    exit;
}

$msg = "";
$id = $_SESSION['Id'];
if (isset($_POST['submit'])) {
	$name = $_POST['name'];

	$sql = "UPDATE `users` SET `Name` = '$name' WHERE `users`.`Id` = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $msg = "**Username changed";
    } else {
        $msg = "ERROR !!!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Picture</title>
    <link rel="stylesheet" href="../css/profilenav.css">
    <link rel="shortcut icon" href="../admin/images/setting.png" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .content {
            width: 100%;
            margin-left: 230px;
        }

        .content h1 {
            font-weight: 500;
            padding: 30px;
            background: white;
            border-bottom: 1px solid black;
        }

        table{
            margin: auto;
            margin-top: 120px;
        }

        table label{
            font-size: 20px;
        }

        table input[type=text]{
            width: 200px;
            font-size: 18px;
        }

        table input[type=submit]{
            margin-top: 10%;
            margin-left: 42%;
            padding: 10px;
            width: 120px;
            background-color: #4ea4dd;
            transition: 0.4s;
            font-size: 14px;
            font-weight: 500;
            border-radius: 22px;
            color: white;
            letter-spacing: 1px;
        }

        input[type=submit]:hover {
            background-color: #66ccff;
            color: black;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    include '../include/profilenav.php';
    ?>

    <div class="content">
        <h1>Change Username:</h1>
        <form action="#" method="post">
		<table>
			<?php
            include 'conn.php';
			$stmt = $pdo->query("SELECT * FROM users WHERE id = '$id'");
			foreach ($stmt as $row) {
			?>

			<tr>
				<td><label>Username:</label>
					<input type="text" name="name" placeholder="<?php echo $row['Name'] ?>" value="<?php echo $row['Name'] ?>">
            <?php
            }
			?>
				</td>
			</tr>

			<tr>
				<td><input type="submit" name="submit" value="Submit"></td>
                <td><?php
                    echo "<br><p>" . $msg . "</p>";
                ?></td>
			</tr>
		</table>
	</form>
    </div>
</body>
</html>