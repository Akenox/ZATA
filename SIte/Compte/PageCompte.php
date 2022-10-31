<?php

include('PageCompte.html');

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

$reqInfo = 'SELECT * FROM Compte WHERE Identifiant = :idSearch';
$reqPending = $bdd->prepare($reqInfo);
$reqPending->execute([
    'idSearch' => $identifiant,
    ]);
$infos = $reqPending->fetch();

$prenom =  $infos['Prenom'];
$nom = $infos['Nom'];
$email = $infos['Email'];
$num = $infos['Numero'];
$id = $infos['Identifiant'];
$mdp = $infos['MotDePasse'];
echo "<div>
<ul>
    <li><a >Nom : </a> $prenom </li>              
    <li><a >Prénom :</a>$nom</li>
    <li><a >Email : </a>$email</li>
    <li><a >Numéro : </a>$num</li>
    <li><a >Identifiant : </a>$id</li>
    <li><a >Mot de passe : </a>$mdp</li>
</ul>
</div>";






?>