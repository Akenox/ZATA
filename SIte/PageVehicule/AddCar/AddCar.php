<?php

session_start();


require_once('../../fonctions.php');
$bdd = Fonctions::InitBDD();



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

echo    
    '<style>
        #popup{text-align:center; color:green; font-size:15px; margin-top: 1px;}
        #popup:after{content:\'La voiture à bien été enregistré !\'; }
    </style>';

if (isset($_POST['submit']))
{
    require_once('AddCar.html');
}



?>