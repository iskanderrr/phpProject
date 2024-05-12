<?php 
require_once 'pdo.php';

function Verifier_session ()
{

if (($_SESSION['connecte']!="1")) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}
}
?>
