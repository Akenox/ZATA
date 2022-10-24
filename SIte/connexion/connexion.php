<?php

require_once('../inscription/inscription.php');


include_once("code.html");

$a = "";
$b = "";

if (isset($_POST['id'])){
    $a = $_POST['id'];
}

else if (isset($_POST['password'])){
    $b = $_POST['password'];
}

if(isset($_POST['submit']))
{
    if(($_COOKIE['pwc'] == $b) && ($_COOKIE['idc'] == $a))
    {
    header('location:../accueil/Accueil.html');
    }
    else{
        echo "<p>Error</p>";
    }
}


?>