<?php
    session_start();
    require_once('../../fonctions.php');
    require_once('createtable.php');
    $bdd = Fonctions::InitBDD();
    
    CreateTable::CreateTableCT($bdd);
    CreateTable::CreateTableCourroie($bdd);

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
    <p>Page details</p>

    <table>
        <tr>
            <th>Date du dernier contrôle technique</th>
            <th>Date du dernier contrôle technique complémentaire</th>
            <th>Date du prochain contrôle technique</th>
        <tr>
        <?php echo ($_SESSION['functionCT']); ?>
        
    </table>
    <br>
    <table>
        <th>Cadence du changement de la courroie</th>
        <th>Km parcourus depuis le dernier changement de courroie</th>
        <th>Courroie à remplacer ?</th>
        <?php echo ($_SESSION['functionCourroie']); ?>
    </table>
   
</body>
</html>

