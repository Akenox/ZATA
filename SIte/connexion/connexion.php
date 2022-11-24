<?php

require_once('../fonctions.php');

session_start();


if (isset($_SESSION['login'])){
    header('location:../accueil/PageAccueil.php');
}

$bdd = Fonctions::InitBDD();


include_once("connexion.html");




if(isset($_POST['submit']))
{
    $identifiant = $_POST['id'];
    $motdepasse = $_POST['password'];

    $param[0] = $identifiant;
    $idCheck = Fonctions::RequeteSQLFetch($bdd, 'SELECT Identifiant FROM Compte WHERE Identifiant = ?', $param);

    if (isset($idCheck["Identifiant"])) // Si l'identifiant existe
    {
        $params = array($identifiant, $motdepasse);
        $mdpCheck = Fonctions::RequeteSQLFetch($bdd, 'SELECT MotDePasse FROM Compte WHERE Identifiant = ? AND MotDePasse = ?', $params);
                if (isset($mdpCheck['MotDePasse'])) // Si le mot de passe est bon
        {
            $_SESSION['login'] = $identifiant;
            header('location:../accueil/PageAccueil.php');
            
        }
        else{
            echo '<style>
            #popup{text-align:center; color:red; font-size:large; }
            #popup::after{content:\'Mot de passe incorrect\';}
            </style>';
        }
            
    }
    else{
        echo '<style> 
        #popup{text-align:center; color:red; font-size:large; }
        #popup::after{content:\'Identifiant incorrect\';}
        </style>';
    }
  
}


?>