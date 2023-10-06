<?php
session_start();
require_once "../Database/connection_db.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['register'])){
        $email=$_POST['email'];
        $username=$_POST['name'];
        $password=$_POST['pswd'];
        
        $validate=true;
        if($validate){
            $query= "INSERT INTO users (name, email, password) VALUES ('$username','$email', '$password')";
            $execute=mysqli_query($conn, $query);
            if($execute){
                header("Refresh:0");
            }else{
                echo "signup failed";
            }
        }

    }

   
    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $password=$_POST['pswd'];
        $query="SELECT id, name, email, password FROM users WHERE email='$email' AND password='$password'";
        $execute=mysqli_query($conn, $query);
        $data=mysqli_fetch_array($execute, MYSQLI_ASSOC);
        $count = mysqli_num_rows($execute);
        if($count == 1){
            $_SESSION['login'] = true;
            $_SESSION['Id']=$data['id'];
            $_SESSION['Name']=$data['name'];
            $_SESSION['Email']=$data['email'];
            $_SESSION['usersessionid']=session_id();
            setcookie('userauth','true', time()+18000);
            header('location: manage_profile.php');
            
        } else {
            echo "login failed";
        }
       
	}
}
?>


<html>
<head>
	<title>user form</title>
	<link rel="stylesheet" type="text/css" href="userasset/userLoginSignupStyle.css">
</head>
<body>
<div class="main">  	
	<input type="checkbox" id="chk" aria-hidden="true">

		<div class="login">
			<form action="#" method="post" class="form">
				<label for="chk" aria-hidden="true">Log in</label>
				<input class="input" type="email" name="email" placeholder="Email" required="">
				<input class="input" type="password" name="pswd" placeholder="Password" required="">
				<input type="submit" name="login" value="login">
			</form>
		</div>

	<div class="register">
		<form action="#" method="post" class="form">
			<label for="chk" aria-hidden="true">Register</label>
			<input class="input" type="text" name="name" placeholder="Username" required="">
			<input class="input" type="email" name="email" placeholder="Email" required="">
			<input class="input" type="password" name="pswd" placeholder="Password" required="">
			<input type="submit" name="register" value="register">
		</form>
	</div>
</div>
</body>
</html>