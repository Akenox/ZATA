<?php
    session_start();
    require_once('../../fonctions.php');
    require_once('createtable.php');
    $bdd = Fonctions::InitBDD();
    
    CreateTable::CreateTableCT($bdd);
    CreateTable::CreateTableCourroie($bdd);
    CreateTable::CreateTableVidange($bdd);
    CreateTable::CreateTableIntervention($bdd);


    function TabIntervention($bdd, $idcar)
    {
        $res = "";
        $i = 0; 
        $param[0] = $idcar;
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
        echo (var_dump($infos));
       
        return $res;
    }
    $_SESSION['functionInter'] = TabIntervention($bdd,2);
    function TabCT($bdd,$idcar) : string
    {
       $res = "<tr>";
       $param[0] = $idcar;
       $infos = Fonctions::RequeteSQLFetch($bdd,'SELECT DateDernierCT, DateComplementaireCT, DateProchainCT FROM infoct WHERE IDVehicule = ?', $param);
       for ($i = 0;$i<3;$i++)
       {
            $res .="<td>". $infos[$i] ."</td>";
       }
       $res.= "</tr>";
       return $res;
    }
    $_SESSION['functionCT'] = TabCT($bdd,2);

    function TabCourroie($bdd, $idcar)
    {
       $res = "<tr>";
       $param[0] = $idcar;
       $infos = Fonctions::RequeteSQLFetch($bdd,'SELECT CadenceCourroie, KmDerniereCourroie, CourroieARemplacer FROM courroie WHERE IDVehicule = ?', $param);
       for ($i = 0;$i<3;$i++)
       {
            $res .="<td>". $infos[$i] ."</td>";
       }
       $res.= "</tr>";
       return $res;
    }
    $_SESSION['functionCourroie'] = TabCourroie($bdd,2);

    function TabVidange($bdd, $idcar)
    {
       $res = "<tr>";
       $param[0] = $idcar;
       $infos = Fonctions::RequeteSQLFetch($bdd,'SELECT CadenceVidange, KmDerniereVidange, VidangeAFaire FROM vidange WHERE IDVehicule = ?', $param);
       for ($i = 0;$i<3;$i++)
       {
            $res .="<td>". $infos[$i] ."</td>";
       }
       $res.= "</tr>";
       return $res;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Page Details</h1>
    <br>
    <br>
    <h2> Infos controle technique </h2>
    <table>
        <tr>
            <th>Date du dernier contrôle technique</th>
            <th>Date du dernier contrôle technique complémentaire</th>
            <th>Date du prochain contrôle technique</th>
        <tr>
        <?php echo ($_SESSION['functionCT']); ?>
        
    </table>
    <br>
    <br>
    <h2> Infos courroie </h2>
    <br>
    <table>
        <tr>
            <th>Cadence du changement de la courroie</th>
            <th>Km parcourus depuis le dernier changement de courroie</th>
            <th>Courroie à remplacer ?</th>
        </tr>
        <?php echo ($_SESSION['functionCourroie']); ?>
    </table>
    <br>
    <br>
    <h2> Infos vidange </h2>
    <br>
    <table>
        <tr>
            <th>Cadence des vidanges</th>
            <th>Km parcouru depuis la derniere vidange</th>
            <th>Vidange à faire ?</th>
        </tr>
        <?php echo ($_SESSION['functionCourroie']); ?>
    </table>
    <br>
    <br>
    <h2>Liste des interventions</h2>
    <br>
    <table>
        <tr>
            <th>Numéro</th>
            <th>Date</th>
            <th>Cout</th>
            <th>Kilometre</th>
            <th>Dexscription</th>
        </tr>
        <?php echo ($_SESSION['functionInter']); ?>
    </table>
   
</body>
</html>

