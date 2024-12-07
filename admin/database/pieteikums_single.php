<?php
require 'con_db.php';

if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
    
    // Подготовленный запрос для получения данных
    $vaicajums = $savienojums->prepare("SELECT * FROM IT_pieteikumi WHERE pieteikums_id = ?");
    $vaicajums->bind_param("i", $id);
    $vaicajums->execute();
    
    // Проверка результата
    $rezultats = $vaicajums->get_result();
    if (!$rezultats) {
        die('Kļūda izpildot vaicājumu: ' . $savienojums->error);
    }

    // Проверка на наличие записи
    if ($rezultats->num_rows > 0) {
        $ieraksts = $rezultats->fetch_assoc();
        
        // Формирование JSON-ответа с добавлением новых полей
        $json = array(
            'id' => htmlspecialchars($ieraksts['pieteikums_id']),
            'vards' => htmlspecialchars($ieraksts['vards']),
            'uzvards' => htmlspecialchars($ieraksts['uzvards']),
            'epasts' => htmlspecialchars($ieraksts['epasts']),
            'talrunis' => htmlspecialchars($ieraksts['talrunis']),
            'apraksts' => htmlspecialchars($ieraksts['apraksts']),
            'datums' => date("d.m.Y H:i", strtotime($ieraksts['datums'])),
            'statuss' => htmlspecialchars($ieraksts['status']),
            'ip_adrese' => htmlspecialchars($ieraksts['ip_adrese']), // Новый столбец для IP
            'izmainits' =>$ieraksts['izmainits'] 
            ? "Pēdējās izmaiņas pieteikumā:  " . date("d.m.Y H:i", strtotime($ieraksts['izmainits'])) : "Pieteikums vēl nav rediģēts" 
        );
        
        // Преобразование в JSON
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        // Если запись не найдена
        echo json_encode(array('message' => 'Запись не найдена.'));
    }

    // Закрытие запроса и соединения
    $vaicajums->close();
    $savienojums->close();
} else {
    echo json_encode(array('message' => 'ID не передан.'));
}
?>
