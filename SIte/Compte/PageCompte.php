<?php
require_once('../fonctions.php');
include('PageCompte.html');

session_start();

Fonctions::CheckIfNotLoggedIn($_SESSION['login']);

$identifiant = $_SESSION['login'];

$bdd = Fonctions::InitBDD();

$reqInfo = 'SELECT * FROM Compte WHERE Identifiant = :idSearch';
$reqPending = $bdd->prepare($reqInfo);
$reqPending->execute(['idSearch' => $identifiant,]);
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

<link rel=\"stylesheet\" href=\"PageCompte.css\">


<div id=\"divform\">
<ul>
    <li class=\"oui\"><a >   Nom : </a> <a class=\"infos\"> $prenom </a> </li>
    <li class=\"oui\"><a >Prénom :</a><a class=\"infos\"> $nom</a></li>
</ul>
</div>

    <div id=\"divform1\">
<ul>

    <li class=\"oui\"><a > Email : </a><a class=\"infos\"> $email</a></li>
    <li class=\"oui\"><a >Numéro : </a><a class=\"infos\"> $num</a></li>

</ul>
</div>

<div id=\"divform2\">
<ul>
    <li class=\"oui\"><a >Date de naissance : </a><a class=\"infos\"> $naissance </li>
    <li class=\"oui\"><a > Identifiant : </a><a class=\"infos\"> $id </li>
    <li class=\"oui\"><a >Mot de passe : </a><a class=\"infos\">$mdp</li>
</ul>
</div>
";


echo "
<footer>
    <div id=\"divtopfooter\">
        <div id=\"divhelp\">
            <span id=\"needhelptext\">Besoin d'aide ? </span>
            <a id=\"needhelplink\" href=\"#\">Contactez-nous !</a> 
        </div>
        <a id=\"policonf\" href=\"../PoliConf/policonf.html\">Politique de confidentialité<a>
        <div id=\"langue\">
            <label for=\"langues\"> Langue : </label>
            <select name=\"langues\" id=\"\">
            <option value=\"\">Français</option>
            <option value=\"\">Anglais</option>
            </select>
        </div>
    </div>
    <p id=\"copyright\">Copyright 2022 -- AirPur -- Tous droits réservés</p>
</footer> 
";






?>