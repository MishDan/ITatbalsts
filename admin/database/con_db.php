<?php
    $serveris ="localhost";
    $lietotajs ="grobina1_miscuks";
    $parole = "gSCZrk!jz";
    $datubaze = "grobina1_miscuks";

    $savienojums = mysqli_connect($serveris,$lietotajs,$parole,$datubaze);

    if(!$savienojums){
        echo"viss goood";
    }else{
        echo "nogood";
    }
?>
