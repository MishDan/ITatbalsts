$(document).ready(function(){
    // console.log("jQuery adrbojas")
    let edit = false
    let editLietotaji = false;
    let search = false
    fetchPieteikumi()

    function fetchPieteikumi() {
        $.ajax({
            url: 'database/pieteikumi_list.php',
            type: 'GET',
            success: function(response) {
                const data = JSON.parse(response);
                const pieteikumi = data.pieteikumi; // Данные из IT_pieteikumi
                const maksajumi = data.maksajumi; // Все maks_epasts из IT_maksajumi
                
                let template = "";
                pieteikumi.forEach(pieteikums => {
                    // Проверяем, есть ли epasts из IT_pieteikumi в списке maksajumi
                    const isInMaksajumi = maksajumi.includes(pieteikums.epasts);
    
                    // Если есть, выделяем <span>
                    const emailDisplay = isInMaksajumi 
                        ? `${pieteikums.epasts}   <span ">PRO <i style="color: green; font-size:1.5rem; padding-left: 1rem;" class="fa-solid fa-money-bill-wave"></i> </span> ` 
                        : pieteikums.epasts;
    
                    template += `
                        <tr piet_ID="${pieteikums.id}">
                            <td>${pieteikums.id}</td>
                            <td>${pieteikums.vards}</td>
                            <td>${pieteikums.uzvards}</td>
                            <td>${emailDisplay}</td>
                            <td>${pieteikums.talrunis}</td>
                            <td>${pieteikums.datums}</td>
                            <td>${pieteikums.status}</td>
                            <td>
                                <a class="pieteikums-item"><i class="fa fa-edit"></i></a>
                                <a class="pieteikums-delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    `;
                });
                $('#pieteikumi').html(template);
            },
            error: function() {
                alert("Neizdevās ielādēt datus");
            }
        });
    }
    fetchLietotaji();

    function fetchLietotaji() {
        $.ajax({
            url: 'database/lietotaji_list.php',
            type: 'GET',
            success: function (response) {
                if (response.trim() === "") {
                    alert("Нет данных для отображения");
                    return;
                }

                const lietotaji = JSON.parse(response);
                let template = "";
                lietotaji.forEach(lietotajs => {
                    template += `
                        <tr lietotajs_ID="${lietotajs.lietotajs_id}">
                            <td>${lietotajs.lietotajs_id}</td>
                            <td>${lietotajs.lietotajvards}</td>
                            <td>${lietotajs.vards}</td>
                            <td>${lietotajs.uzvards}</td>
                            <td>${lietotajs.epasts}</td>
                            <td>${lietotajs.loma}</td>
                            <td>${lietotajs.datums}</td>
                            <td>
                                <a class="lietotajs-item"><i class="fa fa-edit"></i></a>
                                <a class="lietotajs-delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    `;
                });
                $('#lietotaji').html(template);
            },
            error: function () {
                alert("Не удалось загрузить данные");
            }
        });
    }

    $(document).on('click', '.lietotajs-item', (e) => {
        $(".modal").css('display', 'flex');

        const element = $(e.currentTarget).closest('tr');
        const id = $(element).attr("lietotajs_ID");

        $.post('database/lietotajs_single.php', { id }, (response) => {
            const lietotajs = JSON.parse(response);
            $('#lietotajvards').val(lietotajs.lietotajvards);
            $('#vards').val(lietotajs.vards);
            $('#uzvards').val(lietotajs.uzvards);
            $('#epasts').val(lietotajs.epasts);
            $('#loma').val(lietotajs.loma);
            $('#lietotajs_ID').val(lietotajs.lietotajs_id);
            editLietotaji = true;
        });
    });

    $(document).on('click', '#new-btn-lietotaji', (e) => {
        $(".modal").css('display', 'flex');
    });

    $(document).on('click', '.close-model', (e) => {
        $(".modal").hide();
        $("#lietotajaForma").trigger('reset');
        editLietotaji = false;
    });

    $(document).on('click', '.lietotajs-delete', (e) => {
        if (confirm("Vai tišām vēlies dzēst?")) {
            const element = $(e.currentTarget).closest('tr');
            const id = $(element).attr("lietotajs_ID");
            $.post('database/lietotajs_delete.php', { id }, () => {
                fetchLietotaji();
            });
        }
    });

    $(document).ready(function() {
        let editLietotaji = false;
    
        // Показать/скрыть поле для смены пароля
        $('#changePasswordBtn').on('click', function() {
            $('#newPasswordSection').toggle();
        });
    
        $('#lietotajaForma').submit(function(e) {
            e.preventDefault();
    
            // Собираем данные формы
            const postData = {
                lietotajvards: $('#lietotajvards').val(),
                vards: $('#vards').val(),
                uzvards: $('#uzvards').val(),
                epasts: $('#epasts').val(),
                loma: $('#loma').val(),
                id: $('#lietotajs_ID').val()
            };
    
            // Если поле для нового пароля заполнено, добавляем его в postData
            if ($('#newPassword').is(':visible') && $('#newPassword').val().trim() !== '') {
                postData.parole = $('#newPassword').val();
            }
    
            const url = editLietotaji ? 'database/lietotajs_edit.php' : 'database/lietotajs_add.php';
    
            // Отправляем данные на сервер
            $.post(url, postData, function(response) {
                alert(response);
                if (!response.includes("eksistē")) {
                    $(".modal").hide();
                    $("#lietotajaForma").trigger('reset');
                    fetchLietotaji();
                    editLietotaji = false;
                }
            }).fail(function() {
                alert("Произошла ошибка при отправке формы.");
            });
        });
    });
    $(document).on('click','.pieteikums-item',(e) =>{
        $(".modal").css('display','flex')
        
        const element =$(e.currentTarget).closest('tr')
        const id = $(element).attr("piet_ID")
        // console.log(id)
        $.post('database/pieteikums_single.php',{id},(response) =>{
            const pieteikums = JSON.parse(response);
            $('#vards').val(pieteikums.vards)  
            $('#uzvards').val(pieteikums.uzvards)  
            $('#epasts').val(pieteikums.epasts)  
            $('#talrunis').val(pieteikums.talrunis)  
            $('#apraksts').val(pieteikums.apraksts)  
            $('#statuss').val(pieteikums.statuss)
            $('#updatedAt').text(pieteikums.izmainits); 
            $('#piet_ID').val(pieteikums.id)  
            edit =  true
            $('#dateandip').text('Pieteikums izveidots: '+pieteikums.datums+'('+pieteikums.ip_adrese+')')  
            $(".dinfos").css('display','flex')

        })
    })

    $(document).on('click','#new-btn',(e) =>{
        $(".modal").css('display','flex')
        $(".dinfos").hide()

    })

    $(document).on('click','.close-model',(e) =>{
        $(".modal").hide()
        $("#pieteikumaForma").trigger('reset')
        edit =  false
    })

    $(document).on('click','.pieteikums-delete',(e) =>{
        if(confirm("Vai tišām vēlies dzēst")){
            const element =$(e.currentTarget).closest('tr')
            const id = $(element).attr("piet_ID") 
            	console.log(id);    
                $.post('database/pieteikums_delete.php', {id},() =>{
                    fetchPieteikumi()
                })

        }
    })
    

    $('#lietotajaForma').submit(function(e) {
        e.preventDefault();
    
        // Собираем данные формы
        const postData = {
            lietotajvards: $('#lietotajvards').val(),
            vards: $('#vards').val(),
            uzvards: $('#uzvards').val(),
            epasts: $('#epasts').val(),
            loma: $('#loma').val(),
            id: $('#lietotajs_ID').val()
        };
    
        // Если поле для нового пароля заполнено, добавляем его в postData
        if ($('#newPassword').is(':visible') && $('#newPassword').val().trim() !== '') {
            postData.parole = $('#newPassword').val();
        }
    
        // Выводим данные в консоль для проверки
        console.log("Данные, отправляемые на сервер:", postData);
    
        const url = editLietotaji ? 'database/lietotajs_edit.php' : 'database/lietotajs_add.php';
    
        // Отправляем данные на сервер
        $.post(url, postData, function(response) {
            console.log("Ответ от сервера:", response);
            alert(response);
            if (!response.includes("eksistē")) {
                $(".modal").hide();
                $("#lietotajaForma").trigger('reset');
                fetchLietotaji();
                editLietotaji = false;
            }
        }).fail(function() {
            alert("Произошла ошибка при отправке формы.");
        });
    });

    $('#pieteikumaForma').submit(e =>{
        e.preventDefault()
        const postData = {
            vards: $('#vards').val(),
            uzvards: $('#uzvards').val(),
            epasts: $('#epasts').val(),
            talrunis: $('#talrunis').val(),
            apraksts: $('#apraksts').val(),
            statuss: $('#statuss').val(),
            id: $('#piet_ID').val()
        }

        url = !edit ? 'database/pieteikums_add.php' : 'database/pieteikums_edit.php'
        console.log(postData, url)
        $.post(url, postData, () =>{
            $(".modal").hide()
            $("#pieteikumaForma").trigger('reset')
            fetchPieteikumi()
            edit = false
        })
    })
    




    // SEARCH
// Функция для поиска
function searchPieteikumi() {
    var searchQuery = $('#searchInput').val(); 

    if (searchQuery.trim() === "") {
        return;
    }
    $.ajax({
        
        url: 'database/pieteikumi_search.php', 
                type: 'GET',
        data: { query: searchQuery }, 
        success: function(response) {
            if (response.trim() === "") {
                return;

            }

            try {
                const pieteikumi = JSON.parse(response);

                if (pieteikumi.error) {
                    alert(pieteikumi.error); 
                    return;

                }

                let template = "";

                pieteikumi.forEach(function(pieteikums) {
                    console.log(template)

                    template += `
                      
                          <tr piet_ID="${pieteikums.id}">
                            <td>${pieteikums.id}</td>
                            <td>${pieteikums.vards}</td>
                            <td>${pieteikums.uzvards}</td>
                            <td>${pieteikums.epasts}</td>
                            <td>${pieteikums.talrunis}</td>
                            <td>${pieteikums.datums}</td>
                            <td>${pieteikums.status}</td>
                             <td>
                                <a class="pieteikums-item"><i class="fa fa-edit"></i></a>
                                <a class="pieteikums-delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    `;

                });
                console.log(template)

                $('#pieteikumi').html(template); 

            } catch (e) {
                console.log("Kluda apstradajot datus: " + e.message);
            }
        },
        error: function(xhr, status, error) {
            console.log("Kluda apstradajot datus: " + error);
        }
    });
}
$(document).ready(function() {
    $('#meklet').on('click', function() {
        searchPieteikumi();
    });
});

}) //BEIGASS!!!!!!!