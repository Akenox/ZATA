<?php

session_start();

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

$marque = $_POST['marque'];
$modele = $_POST['modele'];
$immatriculation = $_POST['immatriculation'];
$site = $_POST['site'];
$carburant = $_POST['carburant'];
$miseenservice = $_POST['miseenservice'];
$critair = $_POST['critair'];
$assurance = $_POST['assurance'];
$puissance = $_POST['puissance'];
$ageparc = $_POST['ageparc'];

$requete = 'INSERT INTO Vehicule(Marque, Modele, Immatriculation, Site, Carburant, MiseEnService, Critair, Assurance, Puissance, AgeParc) VALUES (:Marque, :Modele, :Immatriculation, :Site, :Carburant, :MiseEnService, :Critair, :Assurance, :Puissance, :AgeParc)';

$requete = $bdd->prepare($requete);

$requete->execute([

    'Marque' => $marque,
    'Modele' => $modele,
    'Immatriculation' => $immatriculation,
    'Site' => $site,
    'Carburant' => $carburant,
    'MiseEnService' => $miseenservice,
    'Critair' => $critair,
    'Assurance' => $assurance,
    'Puissance' => $puissance,
    'AgeParc' => $ageparc,

]);

if (isset($_POST['submit']))
{
    require_once('AddCar.html');

}

?>