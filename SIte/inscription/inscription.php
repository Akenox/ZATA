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

    $reqIdExists = 'SELECT Identifiant FROM Compte WHERE Identifiant = :idTyped';
    $reqPending = $bdd->prepare($reqIdExists);
    $reqPending->execute([
        'idTyped' => $identifiant,

    ]);
    $result = $reqPending->fetch();
    if (isset($result['Identifiant']))
    {
        echo '<style> 
        #popup{text-align:center; color:red; font-size:large; }
        #popup::after{content:\'Identifiant déjà utilisé\';} 
        </style>';
    }
    else 
    {
        $requete = 'INSERT INTO Compte(Prenom, Nom, Email, Numero, Identifiant, MotDePasse, DateDeNaissance)  VALUES (:Prenom, :Nom, :Email, :Numero, :Identifiant, :MotDePasse, :DateDeNaissance)';

        $insertRecipe = $bdd->prepare($requete);

        $insertRecipe->execute([
            'Prenom' => $prenom,
            'Nom' => $nom,
            'Email' => $email,
            'Numero' => $numero,
            'Identifiant' => $identifiant,
            'MotDePasse' => $motdepasse,
            'DateDeNaissance' => $naissance,
        ]);
        header('location:../connexion/connexion.html');
    }

    
}

?>