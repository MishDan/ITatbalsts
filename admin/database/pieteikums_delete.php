<?php
    require 'con_db.php';
    if(isset($_POST['id'])){
        $id = intval($_POST['id']);
        $vaicajums = $savienojums->prepare("DELETE FROM IT_pieteikumi WHERE pieteikums_id = ?");
        $vaicajums->bind_param("i",$id);
        if($vaicajums->execute()){
            // echo "Veiksmigi dzests";
        }else{
            // echo "Kļuda: ".$savienojums->error;
        }

        $vaicajums->close();
        $savienojums->close();
    }
?>