<?php



session_start();


if (!isset($_SESSION['login']))
{
    header('location:../connexion/connexion.html');
}
include('PageAccueil.html');

?>