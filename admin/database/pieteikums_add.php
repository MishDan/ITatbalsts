<?php

    if (isset($_POST["id"])){
        require "con_db.php";

        $vards = htmlspecialchars($_POST['vards']);
        $uzvards = htmlspecialchars($_POST['uzvards']);
        $epasts = htmlspecialchars($_POST['epasts']);
        $talrunis = htmlspecialchars($_POST['talrunis']);
        $apraksts = htmlspecialchars($_POST['apraksts']);
        $statuss = htmlspecialchars($_POST['statuss']);
        $ip_adrese = $_SERVER['REMOTE_ADDR']; // Получение IP-адреса клиента


        if(!empty($vards) && !empty($uzvards) && !empty($epasts) && !empty($talrunis) && !empty($apraksts) && !empty($statuss)){
            $vaicajums = $savienojums->prepare("INSERT INTO IT_pieteikumi (vards, uzvards, epasts, talrunis, apraksts, status, ip_adrese) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $vaicajums->bind_param("sssisss", $vards, $uzvards, $epasts, $talrunis, $apraksts, $statuss, $ip_adrese);
            if($vaicajums->execute()){
                echo "Pieteikums veiksmīgi pievienots!";
            }else{
                echo "Kļūda sistēmā: ".$vaicajums->error;
            }
            $vaicajums->close();
            $savienojums->close();
        }else{
            echo "Visi ievades lauki nav aizpildīti!";
        }
    
    }
?>