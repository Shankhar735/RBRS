<?php
include 'conn.php';

if(isset($_POST['submit'])){
    $stmt = $pdo->prepare("INSERT INTO contactus(Name, Email, Message) VALUES (?,?,?)");
    $stmt->bindValue(1,$_POST['uname']);
    $stmt->bindValue(2,$_POST['uemail']);
    $stmt->bindValue(3,$_POST['msg']);
    $stmt->execute();
    ?>
    <script>
        confirm("Message Sent! Thank you for your feedbacks");
    </script>
    <?php
}
?>