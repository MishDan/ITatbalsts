<?php
    session_start();  
    if(!isset($_SESSION['lietotajvardsDEB'])){
        header("Location: login.php");
        exit();
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
            <input type="text" id="searchInput" placeholder="Meklēšna">
            <button  class="btn-sm" id="meklet">Meklēt</button >
        
        </div>
        <a class="btn-sm" id="new-btn">
            <i class="fas fa-plus"></i>Pievienot jaunu
        </a>
    </div>
    <div class="admin-main">
        <table>
            <tr>
                <th>ID</th>
                <th>Vārds</th>
                <th>Uzvārds</th>
                <th>E-pasts</th>
                <th>Tālrunis</th>
                <th>Datums</th>
                <th>Status</th>
                <th></th>
            </tr>
            <tbody id="pieteikumi"></tbody>
        </table>
    </div>
    <!-- te buss patstavigais darbs-->
 

    <!-- Модальное окно для создания тикета -->
<div id="modal-admin" class="modal">
    <div class="modal-box">
        <!-- Кнопка закрытия -->
        <button class="close-model" data-target="#modal-ticket"><i class="fas fa-times"></i></button>

        <h2 data-lang="modal_title">Pieteikums</h2>
        <form id="pieteikumaForma">
            <div class="fromElements">
                <label for="name" data-lang="modal_label_name">Vārds</label>
                <input type="text" id="vards" name="vards" required>

                <label for="surname" data-lang="modal_label_surname">Uzvārds</label>
                <input type="text" id="uzvards" name="uzvards" required>

                <label for="email" data-lang="modal_label_email">E-pasta adrese</label>
                <input type="email" id="epasts" name="epasts" required>

                <label for="phone" data-lang="modal_label_phone">Tālrunis</label>
                <input type="tel" id="talrunis" name="talrunis" required>

                <label for="description" data-lang="modal_label_description">Problēmas apraksts</label>
                <textarea row=4 id="apraksts" name="apraksts" required></textarea>
                <label>Statuss:</label>
                <select id="statuss" required>
                    <option value="Jauns">Jauns</option>
                    <option value="Atvērts">Atvērts</option>
                    <option value="Gaida">Gaida</option>
                    <option value="Pabeigts">Pabeigts</option>
                </select>
                <input type="hidden" id="piet_ID">
            </div>
            <button class="btn active" data-lang="modal_submit" id="nosutit">Saglabāt</button>
        </form>
        <div class="dinfos"><p id="dateandip"></p>
        <p id="updatedAt"></p>

        </div>
    </div>
</div>

</body>
</html>