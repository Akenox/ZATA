<?php
    session_start();
    require_once('../../fonctions.php');
    require_once('createtable.php');
    $bdd = Fonctions::InitBDD();
    $idcar = $_GET['idVehicule'];

    CreateTable::CreateTableCT($bdd);
    CreateTable::CreateTableCourroie($bdd);
    CreateTable::CreateTableVidange($bdd);
    CreateTable::CreateTableIntervention($bdd);

    if (isset($_POST))
    {
        if (isset($_POST['ct']))
        {
            $param = array($_POST['dateDernierCt'], $_POST['dateComplementaireCt'], $_POST['dateProchainCt'], $idcar);
            Fonctions::RequeteSQLExecute($bdd, "INSERT INTO infoct(DateDernierCT, DateComplementaireCT, DateProchainCT, IDVehicule) VALUES (?,?,?,?)", $param);
            Fonctions::RequeteSQLExecute($bdd, "COMMIT");
        }
        else if (isset($_POST['courroie']))
        {
            $param = array($_POST['cadenceCourroie'], $_POST['kmDerniereCourroie'], $_POST['CAR'], $idcar);
            Fonctions::RequeteSQLExecute($bdd, "INSERT INTO courroie(cadenceCourroie, kmDerniereCourroie, courroieARemplacer, IDVehicule) VALUES (?,?,?,?)", $param);
            Fonctions::RequeteSQLExecute($bdd, "COMMIT");
        }

        else if  (isset($_POST['vidange']))
        {
            $param = array($_POST['cadenceVidange'], $_POST['kmDerniereVidange'], $_POST['VAR'], $idcar);
            Fonctions::RequeteSQLExecute($bdd, "INSERT INTO vidange(CadenceVidange, KmDerniereVidange, VidangeAFaire, IDVehicule) VALUES (?,?,?,?)", $param);
            Fonctions::RequeteSQLExecute($bdd, "COMMIT");
        }

        else if (isset($_POST['inter']))
        {
            $param = array($_POST['date'], $_POST['cout'], $_POST['kilometre'], $_POST['description'], $idcar);
            Fonctions::RequeteSQLExecute($bdd, "INSERT INTO intervention(Date, Cout , Kilometre, Description, IDVehicule) VALUES (?,?,?,?,?)", $param);
            Fonctions::RequeteSQLExecute($bdd, "COMMIT");
        }
    }



    function TabIntervention($bdd, $idcar)
    {
        $res = "";
        $i = 0; 
        $param = array($idcar);
        $infos = Fonctions::RequeteSQLFetch($bdd, 'SELECT*FROM Intervention WHERE IDVehicule = ?', $param, true);
        while (isset($infos[$i]))
        {
            $res .= "
                    <tr>
                        <td>" . $infos[$i][0] . "</td>
                        <td>" . $infos[$i][1] . "</td>
                        <td>" . $infos[$i][2]. "</td>
                        <td>" . $infos[$i][3] . "</td>
                        <td>" . $infos[$i][4] . "</td>
                    </tr>
                ";
            $i++;
        }
       
        return $res;
    }
    $_SESSION['functionInter'] = TabIntervention($bdd,$idcar);
    function TabCT($bdd,$idcar) : string
    {
       $res = "<tr>";
       $param = array($idcar);
       $infos = Fonctions::RequeteSQLFetch($bdd,'SELECT DateDernierCT, DateComplementaireCT, DateProchainCT FROM infoct WHERE IDVehicule = ?', $param);
       if($infos != false)
       {
            $res .="<td>". $infos[0] ."</td>";
            $res .="<td>". $infos[1] ."</td>";
            $res .="<td>". $infos[2] ."</td>";
        }
       $res.= "</tr>";
       return $res;
    }
    $_SESSION['functionCT'] = TabCT($bdd,$idcar);

    function TabCourroie($bdd, $idcar)
    {
       $res = "<tr>";
       $param = array($idcar);
       $infos = Fonctions::RequeteSQLFetch($bdd,'SELECT CadenceCourroie, KmDerniereCourroie, CourroieARemplacer FROM courroie WHERE IDVehicule = ?', $param);
       if($infos != false)
       {
            
                    $res .="<td>". $infos[0] ."</td>";
                    $res .="<td>". $infos[1] ."</td>";
                    if($infos[2] == 1)
                        $res .="<td> Oui </td>";
                    else
                        $res .="<td> Non </td>";
            
        }
       $res.= "</tr>";
       return $res;
    }
    $_SESSION['functionCourroie'] = TabCourroie($bdd,$idcar);

    function TabVidange($bdd, $idcar)
    {
       $res = "<tr>";
       $param = array($idcar);
       $infos = Fonctions::RequeteSQLFetch($bdd,'SELECT CadenceVidange, KmDerniereVidange, VidangeAFaire FROM vidange WHERE IDVehicule = ?', $param);
       if($infos != false)
       {
            $res .="<td>". $infos[0] ."</td>";
            $res .="<td>". $infos[1] ."</td>";
            if($infos[2] == 1)
                $res .="<td> Oui </td>";
            else
                $res .="<td> Non </td>";
 
                    
        }
       $res.= "</tr>";
       return $res;
    }
    $_SESSION['functionVidange'] = TabVidange($bdd,$idcar);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detail.css">
    <title>Document</title>
</head>
<body>

    <nav>
        <img src="../../res/logo.png" class="logo" alt="">
        <ul>
            <li><a href="../../accueil/PageAccueil.php">Accueil</a></li>
        </ul>
        <a href="../../Compte/PageCompte.php"><img  src="../../res/compte.png" class="compte" alt="" ></a>
    </nav>

    <h1>Page Details</h1>
    <br>
    <br>
    <div class = "detailtab">
        <h2> Infos controle technique </h2>
        <table class="tableInfo">
            <tr>
                <th>Date du dernier contrôle technique</th>
                <th>Date du dernier contrôle technique complémentaire</th>
                <th>Date du prochain contrôle technique</th>
            <tr>
            <?php echo ($_SESSION['functionCT']); ?>
            
        </table>
        <br>
        <form action="ajoutDetail.php?idVehicule =<?=$_GET['idVehicule']?>" method="POST">
            <input type="submit" name="submitCT" value ="Ajouter une donnée contrôle technique"/>
        </form>
    </div>

    <br>
    <br>

    <div class = "detailtab">
        <h2> Infos courroie </h2>
        <br>
        <table class="tableInfo">
            <tr>
                <th>Cadence du changement de la courroie</th>
                <th>Km parcourus depuis le dernier changement de courroie</th>
                <th>Courroie à remplacer ?</th>
            </tr>
            <?php echo ($_SESSION['functionCourroie']); ?>
        </table>
        <br>
        <form action="ajoutDetail.php?idVehicule=<?=$_GET['idVehicule']?>" method="POST">
            <input type="submit" name="submitCourroie" value="Ajouter une donnée courroie"/>
        </form>
    </div>

    <br>
    <br>  
    
    
    <div class = "detailtab">
        <h2> Infos vidange </h2>
        <br>
        <table class="tableInfo">
            <tr>
                <th>Cadence des vidanges</th>
                <th>Km parcouru depuis la derniere vidange</th>
                <th>Vidange à faire ?</th>
            </tr>
            <?php echo ($_SESSION['functionVidange']); ?>
        </table>
        <br>
        <form action="ajoutDetail.php?idVehicule =<?=$_GET['idVehicule']?>" method="POST">
            <input type="submit" name="submitVidange" value="Ajouter une donnée vidange"/>
        </form>
    </div>


    <br>
    <br>


    <div class = "detailtab">
        <h2>Liste des interventions</h2>
        <br>
        <table class="tableInfo">
            <tr>
                <th>Numéro</th>
                <th>Date</th>
                <th>Cout</th>
                <th>Kilometre</th>
                <th>Dexscription</th>
            </tr>
            <?php echo ($_SESSION['functionInter']); ?>
        </table>
        <br>
        <form action="ajoutDetail.php?idVehicule =<?=$_GET['idVehicule']?>" method="POST">
            <input type="submit" name="submitInter" value="Ajouter un incident"/>
        </form>
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

