<?php

class Fonctions
{

    private static string $bddplace = "local";


    public static function InitBDD() : PDO
    {
        if (self::$bddplace == "local")
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
        return $bdd;
    }

    public static function RequeteSQLFetch(PDO $bdd,string $req, array $param = null, $all = false)
    {
        $req = $bdd->prepare($req);
        $req->execute($param);
        if ($all == false ) return $req->fetch();
        else return $req->fetchAll();
    }
    public static function RequeteSQLExecute(PDO $bdd,string $req, array $param = null)
    {
        $req = $bdd->prepare($req);
        $req->execute($param);
    }
    
    public static function CheckIfNotLoggedIn($login)
    {
        if(!isset($login))
        {
            header('location:../connexion/connexion.html');
        }
    }

}



?>