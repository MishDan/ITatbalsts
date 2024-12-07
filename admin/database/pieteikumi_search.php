<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

require "con_db.php";

// Получаем поисковый запрос
$searchQuery = isset($_GET['query']) ? mysqli_real_escape_string($savienojums, $_GET['query']) : '';

// Если запрос пустой, не выполняем поиск
if (empty($searchQuery)) {
    echo json_encode([]);
    exit;
}

// Строим SQL запрос для поиска
$vaicajums = "SELECT * FROM IT_pieteikumi WHERE 
                vards LIKE '%$searchQuery%' OR 
                uzvards LIKE '%$searchQuery%' OR 
                epasts LIKE '%$searchQuery%' OR 
                talrunis LIKE '%$searchQuery%' 
              ORDER BY pieteikums_id DESC";

// Выполняем запрос
$rezultats = mysqli_query($savienojums, $vaicajums);

// Проверяем, есть ли ошибка в SQL запросе
if (!$rezultats) {
    echo json_encode(['error' => 'Ошибка SQL запроса: ' . mysqli_error($savienojums)]);
    exit;
}

// Массив для хранения результатов
$json = array();

// Процессируем все записи
while ($ieraksts = $rezultats->fetch_assoc()) {
    $json[] = array(
        'id' => htmlspecialchars($ieraksts['pieteikums_id']),
        'vards' => htmlspecialchars($ieraksts['vards']),
        'uzvards' => htmlspecialchars($ieraksts['uzvards']),
        'epasts' => htmlspecialchars($ieraksts['epasts']),
        'talrunis' => htmlspecialchars($ieraksts['talrunis']),
        'datums' => date("d.m.Y H:i", strtotime($ieraksts['datums'])),
        'status' => htmlspecialchars($ieraksts['status']),
    );
}

// Если не нашли данных, возвращаем пустой массив
if (empty($json)) {
    echo json_encode([]);
} else {
    echo json_encode($json);
}
?>
