<?php


session_start();

if (!isset($_SESSION['login']))
{
    header('location:../connexion/connexion.html');
}

$identifiant = $_SESSION['login'];


if ($_SESSION['bdd'] == "local")
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=grp-223_s3_sae;charset=utf8',
        'root', 
        '' 
    );
}
else
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=grp-223_s3_sae;charset=utf8',
        'grp-223', 
        'nkksqopb' 
    );
}


if(isset($_POST['submit']))
{
    $reqInfo = 'SELECT * FROM Compte WHERE Identifiant = :idSearch';
    $reqPending = $bdd->prepare($reqInfo);
    $reqPending->execute([
    'idSearch' => $identifiant,
    ]);
    $infos = $reqPending->fetch();

    $nom = $infos['Nom'];
    $vehicule = $_POST['nom'];
    $date = $_POST['date'];
    $covoit = $_POST['numbe'];


    $requete = 'INSERT INTO reservation(Nom, date, Véhicule, Nombre_covoit)  VALUES (?, ?, ?, ?)';

    $insertRecipe = $bdd->prepare($requete);

    $insertRecipe->execute([
        $nom,
        $date,   
        $vehicule,  
        $covoit,
    ]);

    header('location:../PageReservation/reservation.php');
}
?>