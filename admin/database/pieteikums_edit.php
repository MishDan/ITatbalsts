<?php
    require 'con_db.php';

    if(isset($_POST['id'])){
        $p_vards = htmlspecialchars($_POST['vards']);
        $p_uzvards = htmlspecialchars($_POST['uzvards']);
        $p_epasts = htmlspecialchars($_POST['epasts']);
        $p_talrunis = htmlspecialchars($_POST['talrunis']);
        $p_apraksts = htmlspecialchars($_POST['apraksts']);
        $p_statuss = htmlspecialchars($_POST['statuss']);
        $id = intval($_POST['id']);
        $izmainits = date("Y-m-d H:i:s"); // Время изменений

    }

    $sql = "UPDATE IT_pieteikumi SET vards = ?, uzvards = ?, epasts = ?, talrunis = ?, apraksts = ?, status = ?, izmainits = ? WHERE pieteikums_id = ?";
    $vaicajums = $savienojums->prepare($sql);
    $vaicajums->bind_param("sssssssi", $p_vards, $p_uzvards, $p_epasts, $p_talrunis, $p_apraksts, $p_statuss, $izmainits, $id);

    if($vaicajums->execute()){
        echo "VEiksmigi rediģets";
    }else{
        echo "Kļuda:" .$savienojums->error;
    }

    $vaicajums->close();
    $savienojums->close();

?>  