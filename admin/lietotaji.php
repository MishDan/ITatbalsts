<?php
    session_start();  
    if(!isset($_SESSION['lietotajvardsDEB'])){
        header("Location: login.php");
        exit();
    }
    
    if($_SESSION['lomaDEB'] !== 'admin'){
        header("Location: index.php");

    }
   

?>

<!DOCTYPE html>
<html lang="LV">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IT atbalsts - administrēšana</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="shourtcut icon" href="../images/logo.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="script-admin.js" defer></script>

</head>

<body>

    <header>

        <a href="./" class="logo">
            <i class="fa fa-server"></i> IT atbalsts 
        </a>

        <div class="apply">
            <a href="index.php" class="btn">Sākums</a>
            <a href="pieteikumi.php" class="btn">Pieteikumi</a>
            <a href="./" class="btn">PRO īpašnieki</a>
            <?php
                if ($_SESSION['lomaDEB'] == 'admin') {
            ?>
                    <a href="lietotaji.php" class="btn">Lietotāji</a>
            <?php
                }
            ?>
            <a href="logout.php" class="btn"><i class="fas fa-power-off"></i></a>


        </div>

    </header>


    <div class="admin-top">
        <div>
            <input type="text" placeholder="Meklēšna">
            <a class="btn-sm">Meklēt</a>
        </div>
        <a class="btn-sm" id="new-btn">
            <i class="fas fa-plus"></i>Pievienot jaunu
        </a>
    </div>
    <div class="admin-main">
        <table>
            <tr>
                <th>ID</th>
                <th>Lietotājsvards</th>
                <th>Vārds</th>
                <th>Uzvārds</th>
                <th>E-pasts</th>
                <th>Loma</th>
                <th>Reģ.datums</th>
                <th></th>
            </tr>
            <tbody id="lietotaji"></tbody>
        </table>
    </div>
    <!-- te buss patstavigais darbs-->
 

    <!-- Модальное окно для создания тикета -->
    <div id="modal-lietotaji" class="modal">
    <div class="modal-box">
        <button class="close-model" data-target="#modal-lietotaji"><i class="fas fa-times"></i></button>
        <h2 data-lang="modal_title">Lietotājs</h2>
        <form id="lietotajaForma">
            <div class="fromElements">
                <label for="lietotajvards" data-lang="modal_label_username">Lietotājvārds</label>
                <input type="text" id="lietotajvards" name="lietotajvards" required>

                <label for="name" data-lang="modal_label_name">Vārds</label>
                <input type="text" id="vards" name="vards" required>

                <label for="surname" data-lang="modal_label_surname">Uzvārds</label>
                <input type="text" id="uzvards" name="uzvards" required>

                <label for="email" data-lang="modal_label_email">E-pasta adrese</label>
                <input type="email" id="epasts" name="epasts" required>

                <label for="role" data-lang="modal_label_role">Loma</label>
                <select id="loma" name="loma" required>
                    <option value="admin">admin</option>
                    <option value="moder">moder</option>
                </select>

                <label for="changePassword" data-lang="modal_label_password">Parole</label>
                <button class="btn active" type="button" id="changePasswordBtn">Izveidot jaunu paroli<i class="fa-solid fa-arrow-turn-down"></i></button>
                <div id="newPasswordSection"style="display: none;">
                    <label for="newPassword" >Jauna Parole</label>
                    <input type="password" id="newPassword" name="newPassword">
                </div>

                <input type="hidden" id="lietotajs_ID">
            </div>
            <button type="submit" class="btn active" data-lang="modal_submit" id="saglabat">Saglabāt</button>
        </form>
    </div>
</div>
</body>
</html>