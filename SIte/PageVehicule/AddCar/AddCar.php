<?php

session_start();
require_once('../../fonctions.php');
$bdd = Fonctions::InitBDD();

if (isset($_GET['action']))
{
    $param = array($_GET['idVehicule']);
    $infos = Fonctions::RequeteSQLFetch($bdd, 'SELECT Marque, Modele, Immatriculation, Site, Carburant, MiseEnService, Critair, Assurance, Puissance, AgeParc FROM vehicule WHERE ID = ?', $param);
    
}

if (isset($_POST['submit']))
{
    $id = $_POST['id'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $immatriculation = $_POST['immatriculation'];
    $site = $_POST['site'];
    $carburant = $_POST['carburant'];
    $miseenservice = $_POST['miseenservice'];
    $critair = $_POST['critair'];
    $assurance = $_POST['assurance'];
    $puissance = $_POST['puissance'];
    $ageparc = $_POST['ageparc'];

    

    if (isset($_POST['id']))
    {
        $param = array($marque, $modele, $immatriculation, $site, $carburant, $miseenservice, $critair, $assurance, $puissance, $ageparc, $id);
        $requete = 'UPDATE Vehicule SET Marque = ?, Modele= ?, Immatriculation= ?, Site= ?, Carburant= ?, MiseEnService= ?, Critair= ?, Assurance= ?, Puissance= ?, AgeParc= ? WHERE ID = ?';

        Fonctions::RequeteSQLExecute($bdd, $requete,$param);

    }

    else
    {
        
        $param = array($marque, $modele, $immatriculation, $site, $carburant, $miseenservice, $critair, $assurance, $puissance, $ageparc);
        $requete = 'INSERT INTO Vehicule(Marque, Modele, Immatriculation, Site, Carburant, MiseEnService, Critair, Assurance, Puissance, AgeParc) VALUES (?,?,?,?,?,?,?,?,?,?)';

        Fonctions::RequeteSQLExecute($bdd, $requete,$param);

        echo    
            '<style>
                #popup{text-align:center; color:green; font-size:15px; margin-top: 1px;}
                #popup:after{content:\'La voiture à bien été enregistré !\'; }
            </style>';


            
    }
    header('location:../vehicule.php'); 
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AddCar.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <nav>
            <img src="../../res/logo.png" class="logo" alt="">
            <ul>
                <li><a href="../../accueil/PageAccueil.php">Accueil</a></li>
            </ul>
            <a href="../../Compte/PageCompte.php"><img  src="../../res/compte.png" class="compte" alt="" ></a>
        </nav>
    
        <div class = "form">
            <h2>Ajouter un véhicule</h2>
            <form action="AddCar.php" method="POST">
                
                <?php if(isset($infos)) echo "<input type=\"hidden\" name=\"id\" value=". $_GET['idVehicule'] .">";?>
                <label for="marque">Marque : </label>
                <input name="marque" type="text" required value=<?php if(isset($infos)) echo $infos["Marque"];?>> 
                <br>
                <label for="modele">Modele : </label>
                <input name="modele" type="text" required value=<?php if(isset($infos)) echo $infos["Modele"];?>>
                <br>
                <label for="immatriculation">Immatriculation : </label>
                <input name="immatriculation" type="text" required value=<?php if(isset($infos)) echo $infos["Immatriculation"];?>>
                <br>
                <label for="site">Site : </label>
                <input name="site" type="text" required value=<?php if(isset($infos)) echo $infos["Site"];?>>
                <br>
                <label for="carburant">Carburant : </label>
                <input name="carburant" type="text" required value=<?php if(isset($infos)) echo $infos["Carburant"];?>>
                <br>
                <label for="miseenservice">Date de mise en service : </label>
                <input name="miseenservice" type="date" value=<?php if(isset($infos)) echo $infos["MiseEnService"];?>>
                <br>
                <label for="critair">Vignette critair : </label>
                <input name="critair" type="text" value=<?php if(isset($infos)) echo $infos["Critair"];?>>
                <br>
                <label for="assurance">Assurance : </label>
                <input name="assurance" type="number" value=<?php if(isset($infos)) echo $infos["Assurance"];?>>
                <br>
                <label for="puissance">Puissance : </label>
                <input name="puissance" type="number" value=<?php if(isset($infos)) echo $infos["Puissance"];?>>
                <br>
                <label for="ageparc">Age du parc : </label>
                <input name="ageparc" type="number" value=<?php if(isset($infos)) echo $infos["AgeParc"];?>>
                <br>
                <input class="button" name="submit" type="submit" value="Valider">
                
            </form>
            
        </div>
        <div id = "popup"></div>
        
    
    
    


    <a id="retour" href="../vehicule.php"> Retour </a>  
    

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

    </div>

    <!-- FOOTEREND -->
</body>
</html>