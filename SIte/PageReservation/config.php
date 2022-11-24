<?php


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



?>