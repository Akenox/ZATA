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
$naissance = $infos['DateDeNaissance'];

$prenom[0] = strtoupper($prenom[0]);
$nom[0] = strtoupper($nom[0]);

echo "

<div id=\"divform\">
<ul>
    <li class=\"oui\"><a >   Nom : </a> <a class=\"infos\"> $prenom </a> </li>              
    <li class=\"oui\"><a >Prénom :</a><a class=\"infos\"> $nom</a></li>
    <li class=\"oui\"><a > Email : </a><a class=\"infos\"> $email</a></li>
    <li class=\"oui\"><a >Numéro : </a><a class=\"infos\"> $num</a></li>
    <li class=\"oui\"><a >Date de naissance : </a><a class=\"infos\"> $naissance </li>
    <li class=\"oui\"><a >Identifiant     : </a><a class=\"infos\"> $id </li>
    <li class=\"oui\"><a >Mot de passe : </a><a class=\"infos\"> $mdp </li>
</ul>
</div>";

echo "
<footer>
    <div id=\"divhelp\">
        <span id=\"needhelptext\">Besoin d'aide ? </span>
        <a id=\"needhelplink\" href=\"#\">Contactez-nous !</a> 
        <a id=\"policonf\" href=\"#\">Politique de confidentialité<a>
        <span id=\"langue\">
            <label for=\"langues\">Langue:</label>
            <select name=\"langues\" id=\"\">
            <option value=\"\">Français</option>
            <option value=\"\">Anglais</option>
            </select>
        </span>
    </div>
    
    <p id=\"copyright\">Copyright 2022 -- AirPur -- Tous droits réservés</p>

</footer>
"






?>