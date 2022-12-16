<?php



session_start();
require_once('../fonctions.php');
$bdd = Fonctions::InitBDD();
Fonctions::CheckIfNotLoggedIn($_SESSION['login']);

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

if (isset($_GET['action']))
{
    if ($_GET['action'] == "del")
    {
    $param = array($_GET['idVehicule']);
    Fonctions::RequeteSQLExecute($bdd, 'DELETE FROM courroie WHERE idVehicule = ?', $param);
    Fonctions::RequeteSQLExecute($bdd, 'DELETE FROM infoct WHERE idVehicule = ?', $param);
    Fonctions::RequeteSQLExecute($bdd, 'DELETE FROM vidange WHERE idVehicule = ?', $param);
    Fonctions::RequeteSQLExecute($bdd, 'DELETE FROM intervention WHERE idVehicule = ?', $param);
    Fonctions::RequeteSQLExecute($bdd, 'DELETE FROM vehicule WHERE ID = ?', $param);

    Fonctions::RequeteSQLExecute($bdd, 'COMMIT');
    }
    
}

function Detail()
{
    echo "Fonction activée";
    header('location: PageDetails/detail.html');
}

if(!table_ok("Vehicule", $bdd))
{
    Fonctions::RequeteSQLExecute($bdd,
        "CREATE TABLE Vehicule (
            ID int(10) NOT NULL,
            Marque varchar(45) NOT NULL,
            Modele varchar(45) NOT NULL,
            Immatriculation varchar(15) NOT NULL,
            Site varchar(45) NOT NULL,
            Carburant varchar(45) NOT NULL,
            MiseEnService date NOT NULL,
            Critair int(11) NOT NULL,
            Assurance year(4) NOT NULL,
            Puissance int(11) NOT NULL,
            AgeParc Decimal NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    

    Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE Vehicule ADD PRIMARY KEY (ID);");

    Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE Vehicule MODIFY ID int(10) NOT NULL AUTO_INCREMENT");
    
    Fonctions::RequeteSQLExecute($bdd,"COMMIT");
    
}



function CarTable($bdd) : string
{
    $bool = true;
    $res = "";
    $i[0] = 2;
    while($bool)
    {


        $reqres = Fonctions::RequeteSQLFetch($bdd, 'SELECT*FROM Vehicule WHERE ID = ?', $i);
        if (isset($reqres[1]))
        {
            
            $res .= "<tr>
                    <td>" . $reqres[1] . "</td>
                    <td>" . $reqres[2] . "</td>
                    <td>" . $reqres[3] . "</td>
                    <td>" . $reqres[4] . "</td>
                    <td>" . $reqres[5] . "</td>
                    <td>" . $reqres[6] . "</td>
                    <td>" . $reqres[7] . "</td>
                    <td>" . $reqres[8] . "</td>
                    <td>" . $reqres[9] . "</td>
                    <td>" . $reqres[10] . "</td>
                    <td> <a href=\"PageDetails/detail.php?idVehicule=" . $reqres[0] . "\">Details</a>
                    <td> <a href=\"AddCar/AddCar.php?action=edit&idVehicule=" . $reqres[0] . "\">Edit  ||  </a><a href=\"vehicule.php?action=del&idVehicule=" . $reqres[0] . "\">Del</a></td>
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
$_SESSION['function'] = CarTable($bdd); // permet d'afficher la fonction CarTable plus bas



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vehicule.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <nav>
            <img src="../res/logo.png" class="logo" alt="">
            <ul>
                <li><a href="../accueil/PageAccueil.php">Accueil</a></li>
            </ul>
            <a href="../Compte/PageCompte.php"><img  src="../res/compte.png" class="compte" alt="" ></a>
        </nav>
   

        
     <h1>Liste de véhicules</h1>
    <br><br>






     <table id="listcar">
        <tr id="coul">
            <th>Marque</th>
            <th>Modele</th>
            <th>Immatriculation</th>
            <th>Site</th>
            <th>Carburant</th>
            <th>Date mise en service</th>
            <th>Vignette Critair</th>
            <th>Assurance</th>
            <th>Puissance</th>
            <th>Age Parc</th>
            <th>Details</th>
            <th>Outils</th>
           <!-- <th>Details</th> -->
        <tr>
    

        <?php
        echo $_SESSION['function'];
        ?>
        
     </table>    
     <br><br>
     
     <div class="bout"> 
     <a href="AddCar/AddCar.html" >Ajouter un véhicule</a>
     </div>
     </div>






    <!-- FOOTER -->

    <footer>
        <div id="divtopfooter">
        <div id="divhelp">
            <span id="needhelptext">Besoin d'aide ? </span>
            <a id="needhelplink" href="#">Contactez-nous !</a> 
        </div>
        <a id="policonf" href="../PoliConf/policonf.html">Politique de confidentialité<a>
        <div id="langue">
            <label for="langues">Langue:</label>
            <select name="langues" id="">
            <option value="">Français</option>
            <option value="">Anglais</option>
            </select>
        </div>
        </div>
        
        <p id="copyright">Copyright 2022 -- AirPur -- Tous droits réservés</p>
    
    </footer>

    <!-- FOOTEREND -->
</body>

</html>