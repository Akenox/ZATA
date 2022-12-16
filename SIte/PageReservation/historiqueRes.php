<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Reservation.css"/>
    <title>AirPur</title>
</head>
<body>
<div class="container">
        <nav>
            <img src="../res/logo.png" class="logo" alt="">
            <ul>
                <li><a class="botn" href="../accueil/PageAccueil.php">Accueil</a></li>
                <li><a class="botn" href="../PageReservation/reservation.php">Retour</a></li>
            </ul>
            <a href="../Compte/PageCompte.php"><img  src="../res/compte.png" class="compte" alt="" ></a>
        </nav>
        <table id="listres">
        <tr id="coul">
            <th>Nom</th>
            <th>Date</th>
            <th>Véhicule</th>
            <th>Nombre de covoit</th>
            <th></th>
        <tr>
        <?php 
            require('config.php');
            echo $_SESSION['function'];
        ?>

        </table>

</div>
</body>
</html>