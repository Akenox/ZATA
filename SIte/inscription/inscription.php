<?php

require_once('../fonctions.php');
session_start();


$bdd = Fonctions::InitBDD();

include_once("inscription.html");




if(isset($_POST['submit']))
{
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];
    $identifiant = $_POST['id'];
    $motdepasse = $_POST['password'];
    $naissance = $_POST['naissance'];

    $param[0] = $identifiant;
    $result = Fonctions::RequeteSQLFetch($bdd, 'SELECT Identifiant FROM Compte WHERE Identifiant = ?', $param);

    if (isset($result['Identifiant']))
    {
        echo '<style> 
        #popup{text-align:center; color:red; font-size:large; }
        #popup::after{content:\'Identifiant déjà utilisé\';} 
        </style>';
    }
    else 
    {
        $parametre = array($prenom,$nom,$email,$numero,$identifiant,$motdepasse,$naissance);
        Fonctions::RequeteSqlExecute(
            $bdd, 
            'INSERT INTO Compte(Prenom, Nom, Email, Numero, Identifiant, MotDePasse, DateDeNaissance)  VALUES (?,?,?,?,?,?,?)', 
            $parametre);

        header('location:../connexion/connexion.html');
    }

    
}

?>