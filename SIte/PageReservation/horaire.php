<?php

class Horaire{

    var $days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    var $months = array('janvier', 'février', 'mars', 'avril', "mai", 'juin', 'juillet', 'août', 'septembre', 'ocotbre', 'novembre', 'décembre');
    var $annee ;



    function getEvents($year){
        $annee = $year;
        global $bdd;
        $req = $bdd->query('SELECT Id, Nom, date, Véhicule, Nombre_covoit FROM historiquereservation WHERE YEAR(date)='.$annee);
        $r = array();
        while($d = $req->fetch(PDO::FETCH_OBJ)){
            $r[strtotime($d->date)][$d->Id] = $d -> Nom . " || " . " Covoit à " . $d->Nombre_covoit . " Personnes.";
        }
        return $r;
    }


    function getAll($year){
        $r = array();
        $annee = $year;

        $date = new DateTime($annee.'-01-01');

        while($date->format('Y') <= $annee){

            $y = $date->format('Y');
            $m = $date->format('n');
            $d = $date->format('j');
            $w = str_replace('0', '7', $date->format('w'));
            $r[$y][$m][$d] = $w ;
            
            $date->add(new DateInterval('P1D'));
        }

        return $r;
    }

    function etat($da){

     $etat = array('Annuler la réservation', 'réservation passé');

        $y = date('Y') ;
        $m = date('n');
        $d = date('j');

        $date2 = new DateTime($y.$m.$d);

        if($da == $date2){
            return $etat[1];
        }
        else if($date2 < $da){
            return $etat[1];
        }
        else {
            return $etat[0];
        }


    }

}
?>