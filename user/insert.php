<?php
include 'conn.php';

if(isset($_POST['signup'])){
    $stmt = $pdo->prepare("INSERT INTO users(Name, Email, Password) VALUES (?,?,?)");
    $stmt->bindValue(1,$_POST['uname']);
    $stmt->bindValue(2,$_POST['email']);
    $stmt->bindValue(3,md5($_POST['pass']));
    $stmt->execute();
    header('location:../signin.php');
}
?>
