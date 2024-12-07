<?php
    require "con_db.php";

    if(isset($_POST['ielogoties'])){
        session_start();

        $lietotajsvards = htmlspecialchars($_POST['lietotajs']);
        $parole = $_POST['parole']; // labdien 

        $vaicajums = $savienojums->prepare("SELECT * FROM IT_lietotaji WHERE lietotajvards = ?");
        $vaicajums->bind_param("s", $lietotajsvards);
        $vaicajums->execute();
        $rezultats = $vaicajums->get_result();
        $lietotajs = $rezultats->fetch_assoc();
    
        if($lietotajs && password_verify($parole, $lietotajs['parole'])){
            $_SESSION['lietotajvardsDEB'] = $lietotajs['lietotajvards'];
            $_SESSION['lomaDEB'] = $lietotajs['loma'];

            echo "Veiksmīga ielogošanās!";

        }else{
            echo $_SESSION['pazinojums'] = "Nepareiz lietotajs vards vaio parole!:(";
        }
        header("Location: ../");
        $vaicajums->close();
        $savienojums->close();
    }
?>