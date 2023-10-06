<?php
$msg = "";

session_start();
$id = $_SESSION['Id'];

include '../admin/CRUD/connection.php';
if (isset($_POST['submit'])) {
    $password_new = md5($_POST['pass']);
    $password_confirm = md5($_POST['passcf']);

    if ($p == $cp) {
        $sql = "UPDATE `users` SET `Password` = $password_confirm' WHERE `users`.`Id` = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $msg = "**Password changed";
        } else {
            $msg = "ERROR !!!";
        }
    } else {
        $msg = "**Both passwords must be same";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Change Password</title>
    <script src="../js/password.js"></script>
    <link rel="stylesheet" href="../css/profilenav.css">
    <link rel="shortcut icon" href="../admin/images/setting.png" type="image/x-icon">
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        form {
            width: 100%;
            margin-left: 230px;
        }

        form h1 {
            font-weight: 500;
            padding: 30px;
            background: white;
            border-bottom: 1px solid black;
        }

        table {
            border: 1px solid black;
            width: 500px;
            display: flex;
            justify-content: center;
            padding: 20px;
            margin: 160px auto;
        }

        label {
            font-size: 16px;
            font-weight: 500;
        }

        input {
            width: 250px;
            height: 20px;
        }

        button {
            margin-top: 20px;
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

        button:hover {
            background-color: #66ccff;
            color: black;
            cursor: pointer;
        }

        a {
            font-weight: 600;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    include '../include/profilenav.php';
    ?>

    <form method="post">
        <h1>Change Password:</h1>
        <table>
            <tr>
                <td><label>New Password:</label></td>
                <td><input type="password" name="pass" id="pass" onkeyup="passvalid()" required>
                    <p id="cmsg" style="color: red;"></span>
                </td>
            </tr>

            <tr>
                <td><label>Confirm Password:</label></td>
                <td><input type="password" name="passcf" id="passcf" onkeyup="cpassvalid()" required>
                    <p id="dmsg" style="color: red;"></span>
                </td>
                </td>
            </tr>
            <tr>
                <td><button name="submit">Submit</button> <br> <br> <br>
                <td><?php
                    echo "<br><p>" . $msg . "</p>";
                    ?></td>
            </tr>
        </table>
    </form>
</body>
</html>