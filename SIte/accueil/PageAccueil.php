<?php



session_start();


if (!isset($_SESSION['login']))
{
    header('location:../connexion/code.html');
}
include('PageAccueil.html');

?>