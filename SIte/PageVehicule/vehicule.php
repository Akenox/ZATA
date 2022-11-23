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

function table_ok($table, $bdd){
    $req = "SELECT 1 from $table";
    $req = $bdd->prepare($req);  
    $req->execute();
    $req->fetch();
    if ($req == NULL)
    {
       return false;
    }
    else 
    {
        return true;
    }

}

if(!table_ok("Vehicule", $bdd))
{
    $req = "CREATE TABLE 'vehicule' (
        'ID' int(10) NOT NULL,
        'Marque' varchar(45) NOT NULL,
        'Modele' varchar(45) NOT NULL,
        'Immatriculation' varchar(15) NOT NULL,
        'Site' varchar(45) NOT NULL,
        'Carburant' varchar(45) NOT NULL,
        'MiseEnService' date NOT NULL,
        'Critair' int(11) NOT NULL,
        'Assurance' year(4) NOT NULL,
        'Puissance' int(11) NOT NULL,
        'AgeParc' float NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $req = $req->prepare();
    $req->execute();  
}
else{
    echo "exsiste deja";
}


function CarTable($bdd) : string
{
    $bool = true;
    $res = "";
    $i = 1;
    while($bool)
    {
        $req = 'SELECT*FROM Vehicule WHERE ID = :i';
        $reqPending = $bdd->prepare($req);
        $reqPending->execute(['i' => $i]);
        $reqres = $reqPending->fetch();
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
                  <tr>
                    ";
            $i++;
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
                <li><a href="Deconnexon.php">Se Deconnecter</a></li>
            </ul>
            <a href="../Compte/PageCompte.php"><img  src="../res/compte.png" class="compte" alt="" ></a>
        </nav>
    <h1>Liste de véhicules</h1>
    




    <table id="listcar">
        <tr>
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
        <tr>
    

        <?php
        echo $_SESSION['function'];
        ?>
        
    </table>    
    <a href="AddCar/AddCar.html">Ajouter un véhicule</a>









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