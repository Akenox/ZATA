<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Reservation.css"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript">
         
         jQuery(function($){
               $('.month').hide();
               $('.month:first').show();
               $('.months a:first').addClass('active');
               var current = 1;
               $('.months a').click(function(){
                    var month = $(this).attr('id').replace('linkMonth','');
                    if(month != current){
                        $('#month'+current).slideUp();
                        $('#month'+month).slideDown();
                        $('.months a').removeClass('active'); 
                        $('.months a#linkMonth'+month).addClass('active'); 
                        current = month;                      
                    }
                    return false; 
               });

         
            });
    </script>
    <title>Calendrier</title>
</head>
<body>

<div class="container">
        <nav>
            <img src="../res/logo.png" class="logo" alt="">
            <ul>
                <li><a class="botn" href="../accueil/PageAccueil.php">Accueil</a></li>
                <li><a class="botn"  href="Deconnexon.php">Se Deconnecter</a></li>
            </ul>
            <a href="../Compte/PageCompte.php"><img  src="../res/compte.png" class="compte" alt="" ></a>
        </nav>


    <?php 
       require('config.php');
       require('Date.php');

       $date = new Date();
       $year = date('Y');

       $events = $date->getEvents($year);
       $dates = $date->getAll($year);
        
    ?>

    <div class="periods">
        <div class="year"><?php echo $year?> </div>
        <div class="months">
            <ul>
                <?php foreach ($date->months as $id=>$m): ?>
                    <li><a class="calend" href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo utf8_encode(substr(utf8_decode($m), 0, 3)); ?> </a> </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="clear"></div>
        <?php $dates = current($dates); ?>                                                                                                                                                                                                                              
        <?php foreach ($dates as $m =>$days): ?>
            <div class="month" class="relative"  id="month<?php echo $m; ?>">
            <table>
                <thead>
                    <tr>
                        <?php foreach ($date -> days as $d): ?>
                            <th><?php echo substr($d,0,3); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $end = end($days); foreach ($days as $d=>$w): ?>
                            <?php $time = strtotime("$year-$m-$d");  ?>
                            <?php if($d ==1): ?>
                                <td colspan="<?php echo $w-1; ?>" class="padding"></td>
                            <?php endif; ?>

                            <td>
                                <div class="relative">
                                   <div class="day"> <?php echo $d; ?></div>
                                </div>
                                <div class="daytitle">
                                    <?php echo $date->days[$w-1]; ?> <?php echo $d; ?> <?php echo $date->months[$m-1]; ?> 
                                </div>
                                <div class="events">
                                    <?php  if(isset($events[$time])) : foreach($events[$time] as $e):  ?>
                                        <li> <?php  echo $e; ?></li> 
                                    <?php endforeach; endif;?>
                                </div>
                            </td>
                            <?php if($w ==7): ?>
                             </tr><tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if($end != 7): ?>
                            <td colspan="<?php echo 7-$end?>" class="padding"></td> 
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
            </div>
            <?php endforeach; ?>
    </div>
    <div class="clear"></div>
     <pre><?php  print_r($events);  ?></pre>

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

    
</body>
</html>