<?php


require_once('../../fonctions.php');
//var_dump($_POST);
//echo "<br>";
//var_dump($_GET);


class ajoutDetail{

    
    private PDO $bdd; 

    public function __construct()
    {
        $this->bdd = Fonctions::InitBDD();
    }

    public function createForm(string $table)  : string
    {
        if (isset($_GET['idVehicule']))
            $idcar = $_GET['idVehicule'];
        else
            $idcar = $_GET['idVehicule_'];
        $res = "<form action=\"detail.php?idVehicule=" .$idcar. "\" method=\"POST\">";
        switch($table)
        {
            case "infoct": 
                    $res.= "<input type=\"hidden\" name=\"ct\"/>";
                    $res.= "<input type=\"date\" name=\"dateDernierCt\" placeholder=\"Date du dernier contrôle technique\"/><br>";
                    $res.= "<input type=\"date\" name=\"dateComplementaireCt\" placeholder=\"Date du dernier contrôle complémentaire\"/><br>";
                    $res.= "<input type=\"date\" name=\"dateProchainCt\" placeholder=\"Date du prochain contrôle technique\"/><br>";                   
                break;
            case "courroie":
                    $res.= "<input type=\"hidden\" name=\"courroie\"/>";
                    $res.= "<input type=\"text\" name=\"cadenceCourroie\" placeholder=\"Cadence du changement de la courroie\"/><br>";
                    $res.= "<input type=\"text\" name=\"kmDerniereCourroie\" placeholder=\"Kilomêtres parcouru depuis le dernier changement\"/><br>";
                    $res.= "<label for=\"CAR\">Oui</label>";
                    $res.= "<input type=\"radio\" name=\"CAR\" value=\"1\"/>";
                    $res.= "<label for=\"CAR\">Non</label>";
                    $res.= "<input type=\"radio\" name=\"CAR\" value=\"0\"/>";              
                break;
            case "vidange":
                    $res.= "<input type=\"hidden\" name=\"vidange\"/>";
                    $res.= "<input type=\"text\" name=\"cadenceVidange\" placeholder=\"Cadence du changement de la vidange\"/><br>";
                    $res.= "<input type=\"text\" name=\"kmDerniereVidange\" placeholder=\"Kilomêtres parcouru depuis le dernier changement\"/><br>";
                    $res.= "<label for=\"VAR\">Oui</label>";
                    $res.= "<input type=\"radio\" name=\"VAR\" value=\"1\"/>";
                    $res.= "<label for=\"VAR\">Non</label>";
                    $res.= "<input type=\"radio\" name=\"VAR\" value=\"0\"/>";
                break;
            case "intervention":
                    $res.= "<input type=\"hidden\" name=\"inter\"/>";
                    $res.= "<input type=\"number\" name=\"cout\" placeholder=\"Cout\"/><br>";
                    $res.= "<input type=\"date\" name=\"date\" placeholder=\"Date\"/><br>";
                    $res.= "<input type=\"number\" name=\"kilometre\" placeholder=\"Kilometre\"/><br>";
                    $res.= "<input type=\"text\" name=\"description\" placeholder=\"Description\"/>";
                break;

        }
        
        $res .= "<input type=\"submit\" name=\"submit\"/>";
        $res .= "</form>";
        return $res;
        
    }

    public function testForm(array $POST)
    {
        $ad = new ajoutDetail();
        if (isset($_POST['submitCT']))
        {
            echo "<h1>Ajouter des données de contrôle technique</h1>";
            echo $ad->createForm("infoct");
        }

            else if (isset($POST['submitVidange']))
            {
                echo "<h1>Ajouter des données de vidange</h1>";
                echo $ad->createForm("vidange");
            }
                

                else if (isset($POST['submitCourroie']))
                {
                    echo "<h1>Ajouter des données de courroie</h1>";
                    echo $ad->createForm("courroie");
                }
                    

                    else if (isset($POST['submitInter']))
                    {
                        echo "<h1>Ajouter un incident</h1>";
                        echo $ad->createForm("intervention");
                    }
                        

                        else
                            header('../vehicule.php');
    }


}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ajoutDetail.css">
<title>Ajouter</title>
</head>
<body>
    <?php
    $ad = new ajoutDetail();
    $ad->testForm($_POST)
     ?>
</body>
</html>
