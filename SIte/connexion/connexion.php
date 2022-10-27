<?php

/*$bdd = new PDO(
    'mysql:host=localhost;dbname=grp-223_s3_sae;charset=utf8',
    'grp-223', 
    'nkksqopb' 
);*/

$bdd = new PDO(
    'mysql:host=localhost;dbname=grp-223_s3_sae;charset=utf8',
    'root', 
    '' 
);

include_once("code.html");




if(isset($_POST['submit']))
{
    $identifiant = $_POST['id'];
    $motdepasse = $_POST['password'];
    $reqIdExists = 'SELECT Identifiant FROM Compte WHERE Identifiant = :idSearch'; // creation de la requête
    $reqPending = $bdd->prepare($reqIdExists); //préparation de la reqête
    $reqPending->execute([ // Execution de la requête
        'idSearch' => $identifiant,
    ]);
    $idCheck = $reqPending->fetch(); // Stockage du resultat de la requête dans un tableau
    if (isset($idCheck['Identifiant'])) // Si l'identifiant existe
    {
        $reqMdpCorrect = 'SELECT MotDePasse FROM Compte WHERE Identifiant = :idSearch AND MotDePasse = :mdpSearch';
        $reqMdpPending = $bdd->prepare($reqMdpCorrect);
        $reqMdpPending->execute([
        'idSearch' => $identifiant,
        'mdpSearch' => $motdepasse,
        ]);
        $mdpCheck = $reqMdpPending->fetch();
        

        if (isset($mdpCheck['MotDePasse'])) // Si le mot de passe est bon
        {

            header('location:../accueil/PageAccueil.html');
        }
        else{
            echo 'Mot de passe incorrect';
        }
            
    }
    else{
        echo 'Identifiant incorrect';
    }
  
}


?>