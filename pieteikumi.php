<?php
    session_start();  
      
    if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["nosutit"])){
        require "admin/database/con_db.php";
        
        $vards = htmlspecialchars($_POST['vards']);
        $uzvards = htmlspecialchars($_POST['uzvards']);
        $epasts = htmlspecialchars($_POST['epasts']);
        $talrunis = htmlspecialchars($_POST['talrunis']);
        $apraksts = htmlspecialchars($_POST['apraksts']);

        if(!empty($vards) && !empty($uzvards) && !empty($epasts) && !empty($talrunis)&& !empty($apraksts)){
            $vaicajums = $savienojums->prepare("INSERT INTO IT_pieteikumi (vards, uzvards, epasts, talrunis, apraksts) VALUES (?, ?, ?, ?, ?)");// prepared statment
            $vaicajums->bind_param("sssis",$vards,$uzvards, $epasts, $talrunis, $apraksts);
            if($vaicajums->execute()){
                 $_SESSION['pazinojums'] = "Pieteikums veiksmīgi nosūtīts! Sazināsamies ar jums pavisam drīz!";    
            }else{
                 $_SESSION['pazinojums'] = "Kļuda sistēmā! Sazinies ar vietnes administracija pa tālruni!";
            }
            $vaicajums->close();
            $savienojums->close();
        }else{
             $_SESSION['pazinojums'] = "Visi ievades lauki nav aizpildīti!";
        }

    }

    header("Location: ./")
?>