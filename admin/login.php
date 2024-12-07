<?php
    session_start();  
?>

<!DOCTYPE html>
<html lang="LV">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IT atbalsts - Ielogošana</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    

</head>

<body>

   

    
 

<div class="modal modal-active">
    <div class="modal-box">
        <button class="close-model" data-target="#modal-ticket"><i class="fas fa-times"></i></button>

        <h2 data-lang="modal_title">Ielogoties sistēmā</h2>

        <?php
             if(isset($_SESSION['pazinojums'])){
                echo "<p class='login-notif'>".$_SESSION['pazinojums']."</p>";
                unset($_SESSION['pazinojums']);
             }
        ?>
        <form action="database/login_function.php" method="post">
                <label >Lietotajvards</label>
                <input type="text"   name="lietotajs" required>

                <label >Parole</label>
                <input type="password"  name="parole" required>

            <button class="btn active" name="ielogoties" >Ielogoties</button>
        </form>
    </div>
</div>

</body>
</html>