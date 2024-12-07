<?php
// Устанавливаем кодировку UTF-8 для корректного отображения латышских символов
header('Content-Type: text/html; charset=utf-8');

require 'con_db.php';

// Проверяем, что все необходимые данные получены
if (isset($_POST['lietotajvards'], $_POST['vards'], $_POST['uzvards'], $_POST['epasts'], $_POST['loma'], $_POST['parole'])) {
    
    // Получаем и обрабатываем входные данные
    $lietotajvards = htmlspecialchars($_POST['lietotajvards']);
    $vards = htmlspecialchars($_POST['vards']);
    $uzvards = htmlspecialchars($_POST['uzvards']);
    $epasts = htmlspecialchars($_POST['epasts']);
    $loma = htmlspecialchars($_POST['loma']);
    $parole = password_hash($_POST['parole'], PASSWORD_BCRYPT);  // Хешируем пароль

    // Проверка уникальности lietotajvards
    $checkQuery = $savienojums->prepare("SELECT lietotajs_id FROM IT_lietotaji WHERE lietotajvards = ?");
    $checkQuery->bind_param("s", $lietotajvards);
    $checkQuery->execute();
    $checkQuery->store_result();

    // Если имя пользователя уже существует, выводим сообщение и завершаем выполнение скрипта
    if ($checkQuery->num_rows > 0) {
        echo "Šāds lietotājvārds jau eksistē! Lūdzu, izvēlieties citu vārdu.";
        $checkQuery->close();
        $savienojums->close();
        exit;
    }
    $checkQuery->close();

    // Добавляем нового пользователя в базу данных
    $query = $savienojums->prepare("INSERT INTO IT_lietotaji (lietotajvards, vards, uzvards, epasts, loma, parole, datums) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $query->bind_param("ssssss", $lietotajvards, $vards, $uzvards, $epasts, $loma, $parole);

    if ($query->execute()) {
        echo "Lietotājs veiksmīgi pievienots!";
    } else {
        echo "Kļūda pievienošanā: " . $savienojums->error;
    }

    // Закрываем соединение
    $query->close();
    $savienojums->close();
} else {
    // Выводим сообщение, если данные не были отправлены
    echo "Nepilnīgi dati! Lūdzu, pārbaudiet ievades laukus.";
}
?>
