<?php
require_once('../fonctions.php');

session_start();

$Identifiant = $_SESSION['login'];


    Fonctions::CheckIfNotLoggedIn($_SESSION['login']);
    $bdd = Fonctions::InitBDD();

if(isset($_POST['submit']))
{
    
    $params[0] = $Identifiant;
    $infos = Fonctions::RequeteSQLFetch($bdd,'SELECT Nom FROM Compte WHERE Identifiant = ?', $params);
    

    $nom = $infos['Nom'];
    $vehicule = $_POST['nom'];
    $date = $_POST['date'];
    $covoit = $_POST['numbe'];

    $param = array($nom, $date, $vehicule, $covoit);
    Fonctions::RequeteSQLExecute($bdd, 'INSERT INTO reservation(Nom, date, Véhicule, Nombre_covoit)  VALUES (?, ?, ?, ?)', $param);


    header('location:../PageReservation/reservation.php');
}
?>