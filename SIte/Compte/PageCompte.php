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

    <table id = \"tableau\">
        <tr>
            <th id=\"entete\" colspan=\"2\">Informations du compte</th>
        </tr>
        <tr class = \"ligne\">
            <td class = \"colonnegauche\"><a  class = \"titre\">Nom : </a></td>
            <td class = \"colonnedroite\"> <a class=\"infos\"> $nom </a></td>
        </tr>
        <tr class = \"ligne\">
            <td class = \"colonnegauche\"><a  class = \"titre\">Prenom : </a></td>
            <td class = \"colonnedroite\"> <a class=\"infos\"> $prenom </a></td>
        </tr>
        <tr class = \"ligne\">
            <td class = \"colonnegauche\" ><a  class = \"titre\">Email : </a></td>
            <td class = \"colonnedroite\"> <a class=\"infos\"> $email </a></td>
        </tr>
        <tr class = \"ligne\">
            <td class = \"colonnegauche\" ><a  class = \"titre\">Numéro : </a></td>
            <td class = \"colonnedroite\"> <a class=\"infos\"> $num </a></td>
        </tr>
        <tr class = \"ligne\">
            <td class = \"colonnegauche\" ><a  class = \"titre\">Date de naissance : </a></td>
            <td class = \"colonnedroite\"> <a class=\"infos\"> $naissance </a></td>
        </tr>
        <tr class = \"ligne\">
            <td class = \"colonnegauche\" ><a  class = \"titre\">Identifiant : </a></td>
            <td class = \"colonnedroite\"> <a class=\"infos\"> $id </a></td>
        </tr>
        <tr class = \"ligne\">
            <td class = \"colonnegauche\" ><a  class = \"titre\">Mot de passe : </a></td>
            <td class = \"colonnedroite\"> <a class=\"infos\"> $mdp </a></td>
        </tr>
        
    </table>
    

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