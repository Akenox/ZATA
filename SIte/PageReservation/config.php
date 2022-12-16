<?php
require_once('../fonctions.php');   
require_once('horaire.php');

session_start();

Fonctions::CheckIfNotLoggedIn($_SESSION['login']);
$Identifiant = $_SESSION['login'];


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

if(table_ok("reservation", $bdd)){
    Fonctions::RequeteSQLExecute($bdd,"drop table reservation");
}

if(!table_ok("historiquereservation", $bdd))
{
    Fonctions::RequeteSQLExecute($bdd,
        "CREATE TABLE historiquereservation (
            ID int(10) NOT NULL,
            Nom varchar(32) NOT NULL,
            date date NOT NULL,
            véhicule varchar(32) NOT NULL,
            Nombre_covoit int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    

    Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE historiquereservation ADD PRIMARY KEY (ID);");

    Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE historiquereservation MODIFY ID int(10) NOT NULL AUTO_INCREMENT");
    
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
    Fonctions::RequeteSQLExecute($bdd, 'INSERT INTO historiquereservation(Nom, date, Véhicule, Nombre_covoit)  VALUES (?, ?, ?, ?)', $param);
    Fonctions::RequeteSQLExecute($bdd,"COMMIT");

    header('location:../PageReservation/reservation.php');
}


function ResTable($bdd) : string{

    $bool = true;
    $res = "";
    $i[0] = 2;
    while($bool)
    {

        $date = new Horaire();

        $reqres = Fonctions::RequeteSQLFetch($bdd, 'SELECT * FROM historiquereservation WHERE ID = ?', $i);



        if (isset($reqres[1]))
        {
            $res .= "<tr>   
                    <td >" . $reqres[1] . "</td>
                    <td>" . $reqres[2] . "</td>
                    <td>" . $reqres[3] . "</td>
                    <td>" . $reqres[4] . "</td>
                    <td> <a> ". $date->etat($reqres[2]) . " </a>  </td>
                  <tr>
                    ";
            $_SESSION['i'] = $i[0];
            $i[0]++;
            
            
        }
        else{
            $bool = false;
        }
    }
    return $res;
}

function selecvehicule($bdd) {
    $bool = true;
    $res = "";
    $i[0] = 2;

    while($bool)
    {
        $reqres = Fonctions::RequeteSQLFetch($bdd, 'SELECT Marque, Modele FROM Vehicule where ID=?', $i);


       
        if(isset($reqres["Marque"])){

            $res .= "<option> " . $reqres["Marque"] . " - " . $reqres["Modele"] . "</option>";
            
            $_SESSION['i'] = $i[0];
            $i[0]++;
        }   
        else {
            $bool = false;
        }
    }  
    return $res;
}



$_SESSION['vehicule'] = selecvehicule($bdd);
$_SESSION['function'] = ResTable($bdd); 
