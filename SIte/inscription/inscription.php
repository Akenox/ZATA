<?php



include_once("Inscription.html");
setcookie("idc", "", time() - 3600); //destruction des cookies
setcookie("pwc", "", time() - 3600);
$a = "";
$b = "";

if (isset($_POST['id'])){
    setcookie('idc',$_POST['id'], time() + 60 * 60 * 24, '/');
}

else if (isset($_POST['password'])){
    setcookie('pwc,',$_POST['password'], time() + 60 * 60 * 24,'/');
}


if(isset($_POST['submit']))
{
    header('location:../connexion/code.html');
}

?>