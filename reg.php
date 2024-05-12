<?php
    require_once "pdo.php";


/* récupération des données du formulaire */

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$numtel = $_POST['numtel'];


$sql= "INSERT INTO user (fullname,email,password,phoneNumber) VALUES('$fullname','$email','$password','$numtel')";
$pdo->exec($sql);
header('location:rege.html');
?>