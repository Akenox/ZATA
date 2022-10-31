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
    $permis = $_POST['permis'];
    $identifiant = $_POST['id'];
    $motdepasse = $_POST['password'];

    $reqIdExists = 'SELECT Identifiant FROM Compte WHERE Identifiant = :idTyped';
    $reqPending = $bdd->prepare($reqIdExists);
    $reqPending->execute([
        'idTyped' => $identifiant,

    ]);
    $result = $reqPending->fetch();
    if (isset($result['Identifiant']))
    {
        echo 'Identifiant déjà utilisé';
    }
    else 
    {
        $requete = 'INSERT INTO Compte(Prenom, Nom, Email, Numero, Permis, Identifiant, MotDePasse)  VALUES (:Prenom, :Nom, :Email, :Numero, :Permis, :Identifiant, :MotDePasse)';

        $insertRecipe = $bdd->prepare($requete);

        $insertRecipe->execute([
            'Prenom' => $prenom,
            'Nom' => $nom,
            'Email' => $email,
            'Numero' => $numero,
            'Permis' => $permis,
            'Identifiant' => $identifiant,
            'MotDePasse' => $motdepasse,
        ]);
        header('location:../connexion/connexion.html');
    }

    
}

?>