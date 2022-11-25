<?php
require_once('../fonctions.php');

session_start();


$Identifiant = $_SESSION['login'];

Fonctions::CheckIfNotLoggedIn($_SESSION['login']);
$bdd = Fonctions::InitBDD();

function table_ok($table, $bdd){
    $req = $bdd->query("SHOW TABLES LIKE '$table'");
    $tableExists = $req !== false && $req->rowCount() > 0;
    if ($tableExists)
    {
        return true;
    }
    else{
        return false;
    }

}

if(!table_ok("reservation", $bdd))
{
    Fonctions::RequeteSQLExecute($bdd,
        "CREATE TABLE reservation (
            ID int(10) NOT NULL,
            Nom varchar(32) NOT NULL,
            date date NOT NULL,
            véhicule varchar(32) NOT NULL,
            Nombre_covoit int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    

    Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE reservation ADD PRIMARY KEY (ID);");

    Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE reservation MODIFY ID int(10) NOT NULL AUTO_INCREMENT");
    
    Fonctions::RequeteSQLExecute($bdd,"COMMIT");


    
}




if(isset($_POST['submit']))
{
    
    $params[0] = $Identifiant;
    $infos = Fonctions::RequeteSQLFetch($bdd,'SELECT Nom FROM Compte WHERE Identifiant = ?', $params);
    

    $nom = $infos['Nom'];
    $vehicule = $_POST['nom'];
    $date = $_POST['date'];
    $covoit = $_POST['numbe'];

    $param = array($nom, $date, $vehicule, $covoit);
    Fonctions::RequeteSQLExecute($bdd, 'INSERT INTO reservation(Nom, date, Véhicule, Nombre_covoit)  VALUES (?, ?, ?, ?)', $param);


    header('location:../PageReservation/reservation.php');
}
?>