<?php
session_start();
require_once "../Database/connection_db.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['login'])){
        $adminName=$_POST['adminname'];
        $password=$_POST['pswd'];
        $query="SELECT adminid, name, password from admindetail WHERE name='$adminName' AND password='$password'";
        $execute=mysqli_query($conn, $query);
        $data=mysqli_fetch_array($execute, MYSQLI_ASSOC);
        $count = mysqli_num_rows($execute);
        if($count == 1){
            $_SESSION['adminid']=$data['adminid'];
            $_SESSION['adminname']=$data['name'];
            $_SESSION['adminsessionid']=session_id();
            setcookie('adminauth','true', time()+18000);
            header('location: admindashboard.php');
        } else {
            echo "admin login failed";
        }
       
  }
}
?>

.
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Keeper Signup</title>
    <style type="text/css">
        .form {
          position: relative;
          background-color: white;
          padding: 3.125em;
          border-radius: 10px;
          display: flex;
          flex-direction: column;
          align-items: center;
          max-width: 300px;
          left: 50%;
          top: 50%;
          transform: translate(-50%, -50%);
          box-shadow: 5px 5px 15px -1px rgba(0,0,0,0.75);
        }

        .signup {
          color: rgb(77, 75, 75);
          text-transform: uppercase;
          letter-spacing: 2px;
          display: block;
          font-weight: bold;
          font-size: x-large;
          margin-bottom: 0.5em;
        }

        .form--input {
          width: 100%;
          margin-bottom: 1.25em;
          height: 40px;
          border-radius: 5px;
          border: 1px solid gray;
          padding: 0.8em;
          font-family: 'Inter', sans-serif;
          outline: none;
        }

        .form--input:focus {
          border: 1px solid #639;
          outline: none;
        }

        .form--submit {
          width: 50%;
          padding: 0.625em;
          border-radius: 5px;
          color: white;
          background-color: #639;
          border: 1px dashed #639;
          cursor: pointer;
        }

        .form--submit:hover {
          color: #639;
          background-color: white;
          border: 1px dashed #639;
          cursor: pointer;
          transition: 0.5s;
        }
    </style>
</head>
<body>
<form action="#" method="post" class="form">
    <span class="signup">Admin Login</span>
    <input type="text" name="adminname" placeholder="Admin Name" class="form--input">
    <input type="password" name="pswd" placeholder="Password" class="form--input">
    <input type="submit" name="login" value="Login" class="form--submit">
</form>
</body>
</html>

