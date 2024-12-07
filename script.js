let modalBtns = document.querySelectorAll('[data-target]');
let closeModalBtns = document.querySelectorAll('.close-model');

// Open modal when a button is clicked
modalBtns.forEach(function(btn){
    btn.addEventListener('click', function(){
        document.querySelector(btn.dataset.target).classList.add('modal-active'); // Add modal-active to show the modal
    });
});

// Close modal when the close button is clicked
closeModalBtns.forEach(function(btn){
    btn.addEventListener('click', function(){
        document.querySelector(btn.dataset.target).classList.remove('modal-active'); // Remove modal-active to hide the modal
    });
});




document.addEventListener("DOMContentLoaded", function () {
    // Получаем последний выбранный язык из localStorage, если он есть
    const defaultLang = "lv"; // Язык по умолчанию
    let currentLang = localStorage.getItem("language") || defaultLang; // Если язык не выбран, будет использоваться "lv"

    // Загрузка текстов из JSON и обновление текста на странице
    async function loadLanguage(lang) {
        const response = await fetch("languages.json");
        const translations = await response.json();
        const texts = translations[lang];

        // Изменяем текстовые элементы
        document.title = texts["title"];
        document.querySelector(".logo").innerText = texts["header_logo"];
        document.querySelector("[data-target='#modal-ticket']").innerText = texts["create_ticket_button"];
        document.querySelector(".btn.active").innerText = texts["buy_pro_button"];
        document.querySelector("#home h1").innerText = texts["main_heading"];
        document.querySelector("#home p").innerText = texts["main_paragraph"];
        document.querySelector("#home .btn").innerText = texts["create_ticket_cta"];

        document.querySelector(".services h1").innerHTML = `${texts["services_heading"]} <span>${texts["services_heading2"]}</span>`;

        // Перевод услуг
        document.querySelector(".services .box.pirmais h2").innerText = texts["service1_title"];
        document.querySelector(".services .box.pirmais p").innerText = texts["service1_description"];
        document.querySelector(".services .box.otrais h2").innerText = texts["service2_title"];
        document.querySelector(".services .box.otrais p").innerText = texts["service2_description"];
        document.querySelector(".services .box.tresais h2").innerText = texts["service3_title"];
        document.querySelector(".services .box.tresais p").innerText = texts["service3_description"];
        document.querySelector(".services .box.ceturtais h2").innerText = texts["service4_title"];
        document.querySelector(".services .box.ceturtais p").innerText = texts["service4_description"];
        
        // Перевод раздела "PRO"

        document.querySelector("#pro-plans h1").innerHTML = `${texts["pro_plan_heading"]} <span>${texts["pro_plan_heading2"]}</span> ${texts["pro_plan_heading3"]}`;
      
        document.querySelector("#pro-plans p").innerText = texts["pro_plan_paragraph"];

        document.querySelector("#pro-plans .btn.active").innerText = texts["pro_plan_cta"];
        
        // Перевод раздела "Команда"
        document.querySelector(".virsraksts h1").innerHTML = `${texts["team_heading"]} <span>${texts["team_heading2"]}</span>`;

        const teamNames = ["member1_name", "member2_name", "member3_name", "member4_name", "member5_name"];
        
        document.querySelectorAll(".komanda-box h2").forEach((el, idx) => {
            el.innerText = texts[teamNames[idx]];
        });

        const teamRoles = ["member1_role", "member2_role", "member3_role", "member4_role", "member5_role"];
        document.querySelectorAll(".komanda-box em").forEach((el, idx) => {
            el.innerText = texts[teamRoles[idx]];
        });

        // Перевод модального окна
        document.querySelector("#modal-ticket h5").innerText = texts["modal_title"];
        document.querySelector("[for='name']").innerText = texts["modal_label_name"];
        document.querySelector("[for='surname']").innerText = texts["modal_label_surname"];
        document.querySelector("[for='email']").innerText = texts["modal_label_email"];
        document.querySelector("[for='phone']").innerText = texts["modal_label_phone"];
        document.querySelector("[for='description']").innerText = texts["modal_label_description"];
        document.querySelector("#modal-ticket .btn").innerText = texts["modal_submit"];

        // Перевод футера
        document.querySelector(".footer-kolonna h3[data-lang='footer_language']").innerText = texts["footer_language"];
        document.querySelector(".footer-kolonna h3[data-lang='footer_contacts']").innerText = texts["footer_contacts"];
        document.querySelector(".footer-kolonna p[data-lang='footer_address']").innerHTML = `<i class="fa-solid fa-location-dot"></i>${texts["footer_address"]}`;
        document.querySelector(".footer-kolonna h3[data-lang='footer_follow']").innerText = texts["footer_follow"];
        document.querySelector(".autor[data-lang='footer_rights']").innerText = texts["footer_rights"];
    }

    loadLanguage(currentLang);

    document.querySelectorAll(".language-option").forEach(button => {
        button.addEventListener("click", () => {
            currentLang = button.dataset.lang;
            localStorage.setItem("language", currentLang); // Сохраняем выбранный язык
            loadLanguage(currentLang); 
        });
    });
});

