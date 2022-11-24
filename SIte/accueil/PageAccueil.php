<?php

require_once('../Fonctions.php');

session_start();


Fonctions::CheckIfNotLoggedIn($_SESSION['login']);
include('PageAccueil.html');

?>