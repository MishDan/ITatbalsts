<?php
    session_start();  
?>

<!DOCTYPE html>
<html lang="LV">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IT atbalsts</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="shourtcut icon" href="images/logo.png" type="image/x-icon">
    <script src="script.js" defer></script>

</head>

<body>

    <header>

        <a href="./" class="logo">
            <i class="fa fa-server"></i> IT atbalsts 
        </a>

        <div class="apply">

            <a class="btn" data-target="#modal-ticket">Izveidot pieteikumu</a>

            <a class="btn active" data-target="#modal-pro">Iegadaties PRO</a>

        </div>

    </header>

    <section id="home" class="info">

        <div class="content">

            <h1>Uzticams IT atbalsts</h1>

            <p>Sniedzam kvalitativu IT atbalstu privātpersonām un uzņēmumiem dažādās problēmsituācijās ar datoru, tă perifērijas ierīcēm, programmatūru un internetu gan attālināti, gan dodoties pie klienta klātienē. Iesniedz savu pieteikumu un mēs ar Jums sazināsimies!</p>

            <a class="btn active"  data-target="#modal-ticket">
                <i class="fa fa-check-circle"></i>Izveidot pieteikumu
            </a>

        </div>

        <div class="images">

            <img src="images/main.png" alt="">

        </div>

    </section>

    <section class="services">

        <h1>Mūsu piedāvātie <span>pakalpojumi</span></h1>

        <div class="box-container">

            <div class="box pirmais">
                <i class="fa fa-desktop"></i>
                <h2>Pakalpojums 1</h2>
                <p>Apraksts par konkretu pakalpojumu</p>
            </div>

            <div class="box otrais">
                <i class="fa fa-download"></i>
                <h2>Pakalpojums 2</h2>
                <p>Apraksts par konkretu pakalpojumu</p>
            </div>

            <div class="box tresais">
                <i class="fa fa-wifi"></i>
                <h2>Pakalpojums 3</h2>
                <p>Apraksts par konkretu pakalpojumu</p>
            </div>

            <div class="box ceturtais">
                <i class="fa fa-server"></i>
                <h2>Pakalpojums 4</h2>
                <p>Apraksts par konkretu pakalpojumu</p>
            </div>

        </div>

    </section>

    <section id="pro-plans" class="info">

            <div class="images">
    
                <img src="images/pro.png" alt="">
    
            </div>    

            <div class="content pro">
                

                <h1>Iegadajies <span>Pro</span> plānu!</h1>
    
                <p>Izvēloties maksas plānu PRO, mūsu speciālisti ar Jums sazināsies daudz ätråk nekā tas ir bezmaksas versijäl Turklāt visiem klātienes pakalpojumien tiks pieškirta 50% atlaidell</p>
    
                <a class="btn active"  data-target="#modal-pro">
                    <i class="fa fa-check-circle"></i>Iegādājies PRO tikai par 99<sup>99</sup> EUR/gadā
                </a>
    
            </div>
    

    </section>


    <!-- te buss patstavigais darbs-->


    <div class="virsraksts">
        <h1>Mūsu <span>komanda</span></h1>

    </div>
    <div class="komandas">
        <div class="komanda-box">

            <img src="images/team/team-1.jpg" alt="">
            <h2>Jānis Bērziņš</h2>
            <em>Direktors</em>

            <div class="ikonas">

                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-linkedin"></i>
                <i class="fa-brands fa-instagram"></i>

            </div>

        </div>
        <div class="komanda-box">

            <img src="images/team/team-2.jpg" alt="">
            <h2>Uldis Kļaviņš</h2>
            <em>Vadošais IT speciālists</em>

            <div class="ikonas">

                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-linkedin"></i>
                <i class="fa-brands fa-instagram"></i>

            </div>

        </div>
        <div class="komanda-box">

            <img src="images/team/team-3.jpg" alt="">
            <h2>Andris Ozoliņš</h2>
            <em>Direktors</em>

            <div class="ikonas">

                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-linkedin"></i>
                <!-- <i class="fa-brands fa-instagram"></i> -->

            </div>

        </div>
        <div class="komanda-box">

            <img src="images/team/team-4.jpg" alt="">
            <h2>Ilze Eglīte</h2>
            <em>IT speciāliste</em>

            <div class="ikonas">

                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-linkedin"></i>
                <i class="fa-brands fa-instagram"></i>

            </div>

        </div>
        <div class="komanda-box">

            <img src="images/team/team-5.jpg" alt="">
            <h2>Mārtiņš Zariņš</h2>
            <em>Programmētajs</em>

            <div class="ikonas">

                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-linkedin"></i>
                <!-- <i class="fa-brands fa-instagram"></i> -->

            </div>

        </div>
    </div>


    <footer>
        <div class="footer-box">
            <div class="footer-info">
                <!-- Колонка с языками -->
                <div class="footer-kolonna">
                    <h3 data-lang="footer_language">Valodas</h3>
                    <p class="language-option " data-lang="lv"><i class="fa-solid fa-location-dot"></i>Latviski</p>
                    <p class="language-option" data-lang="en"><i class="fa-solid fa-location-dot"></i>English</p>
                    <p class="language-option" data-lang="ru"><i class="fa-solid fa-location-dot"></i>Русский</p>
                </div>
    
                <!-- Контакты -->
                <div class="footer-kolonna">
                    <h3 data-lang="footer_contacts">Kontakti</h3>
                    <p data-lang="footer_phone"><i class="fa-solid fa-phone"></i>+371 29 999 999</p>
                    <p data-lang="footer_email"><i class="fa-solid fa-envelope"></i>it@atbalsts.lv</p>
                    <p data-lang="footer_address"><i class="fa-solid fa-location-dot"></i>Ventspils iela 51, Liepāja</p>
                </div>
    
                <!-- Ссылки на соцсети -->
                <div class="footer-kolonna">
                    <h3 data-lang="footer_follow">Seko mums</h3>
                    <p><i class="fa-brands fa-facebook-f"></i>Facebook</p>
                    <p><i class="fa-brands fa-instagram"></i>Instagram</p>
                </div>
            </div>
    
            <!-- Копирайт -->
            <p class="autor" data-lang="footer_rights">Visas autortiesības aizsargātas - IT atbalsts &copy 2024</p>
        </div>
    </footer>
    <!-- te buss patstavigais darbs-->
 
    <!-- Модальное окно для создания тикета -->
<div id="modal-ticket" class="modal">
    <div class="modal-box">
        <!-- Кнопка закрытия -->
        <button class="close-model" data-target="#modal-ticket"><i class="fas fa-times"></i></button>

        <h2 data-lang="modal_title">Izveidot jaunu pieteikumu</h2>
        <form action="pieteikumi.php" method="POST">
            <label for="name" data-lang="modal_label_name">Vārds</label>
            <input type="text" id="name" name="vards" required>

            <label for="surname" data-lang="modal_label_surname">Uzvārds</label>
            <input type="text" id="surname" name="uzvards" required>

            <label for="email" data-lang="modal_label_email">E-pasta adrese</label>
            <input type="email" id="email" name="epasts" required>

            <label for="phone" data-lang="modal_label_phone">Tālrunis</label>
            <input type="tel" id="phone" name="talrunis" required>

            <label for="description" data-lang="modal_label_description">Problēmas apraksts</label>
            <textarea row=4 id="description" name="apraksts" required></textarea>

            <button class="btn active" data-lang="modal_submit" name="nosutit">Nosūtīt pieteikumu</button>
        </form>
    </div>
</div>
<div class="modal" id="modal-pro">
        <div class="modal-box">
            <div class="close-model" data-target="#modal-pro"><i class="fas fa-times"></i></div>         
                <h2>Iegādājies <span>PRO</span> plānu!</h2>
                <div class="buy-pro"> 
                    <p>Ieguvumi iegādājoties PRO versiju:</p>
                    <ul>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            Komunikācija ar klinetu dažu minūšu laikā
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            50% atlaide visiem klātienes pakalpojumiem
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            Pieteikumu statusa un vēstures aplūkošana
                        </li>
                    </ul>
                </div>  
                <div class="buy-pro">
                   Cena: 99.99 EUR/gadā 
                </div>
                <a href="payment/checkout.php" class="btn active">Iegādāties jau tagad!</a>
             </div>
        </div>
    <?php
    if(isset($_SESSION['pazinojums'])):
    ?>
    <div id="modal-message" class="modal modal-active">
        <div class="modal-box">
            <!-- Кнопка закрытия -->
            <button class="close-model" data-target="#modal-message"><i class="fas fa-times"></i></button>

            <!-- <h2 data-lang="modal_title">Izveidot jaunu pieteikumu</h2> -->
            <div class="notif">
                <?php
                    echo $_SESSION['pazinojums'];
                    unset($_SESSION['pazinojums'])

                ?>
            </div>

        </div>
    </div>
    <?php
        endif;
        
    ?>
</body>
</html>