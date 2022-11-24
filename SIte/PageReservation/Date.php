<?php

class Date{

    var $days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    var $months = array('janvier', 'février', 'mars', 'avril', "mai", 'juin', 'juillet', 'août', 'septembre', 'ocotbre', 'novembre', 'décembre');

    function getEvents($year){

        global $bdd;
        $req = $bdd->query('SELECT Id, Nom, date, Véhicule, Nombre_covoit FROM reservation WHERE YEAR(date)='.$year);
        $r = array();
        while($d = $req->fetch(PDO::FETCH_OBJ)){
            $r[strtotime($d->date)][$d->Id] = $d -> Nom;
        }
        return $r;
    }


    function getAll($year){
        $r = array();
  

        $date = new DateTime($year.'-01-01');

        while($date->format('Y') <= $year){

            $y = $date->format('Y');
            $m = $date->format('n');
            $d = $date->format('j');
            $w = str_replace('0', '7', $date->format('w'));
            $r[$y][$m][$d] = $w ;
            
            $date->add(new DateInterval('P1D'));
        }

        return $r;
    }
}


?>