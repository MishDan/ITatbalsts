<?php
require 'con_db.php';

// Проверка, что все обязательные данные переданы
if (isset($_POST['id'], $_POST['lietotajvards'], $_POST['vards'], $_POST['uzvards'], $_POST['epasts'], $_POST['loma'])) {

    // Получаем данные из POST
    $lietotajs_id = intval($_POST['id']);
    $lietotajvards = htmlspecialchars($_POST['lietotajvards']);
    $vards = htmlspecialchars($_POST['vards']);
    $uzvards = htmlspecialchars($_POST['uzvards']);
    $epasts = htmlspecialchars($_POST['epasts']);
    $loma = htmlspecialchars($_POST['loma']);
    $parole = isset($_POST['parole']) ? $_POST['parole'] : null; // Пароль может быть пустым, если не меняем

    // Если пароль задан, хэшируем его
    if ($parole) {
        $hashed_password = password_hash($parole, PASSWORD_DEFAULT);
    }

    // Подготовка SQL запроса для обновления данных
    if ($parole) {
        // Если пароль передан, обновляем его тоже
        $sql = "UPDATE IT_lietotaji SET lietotajvards = ?, vards = ?, uzvards = ?, epasts = ?, loma = ?, parole = ? WHERE lietotajs_id = ?";
        $stmt = $savienojums->prepare($sql);
        $stmt->bind_param("ssssssi", $lietotajvards, $vards, $uzvards, $epasts, $loma, $hashed_password, $lietotajs_id);
    } else {
        // Если пароль не передан, не меняем его
        $sql = "UPDATE IT_lietotaji SET lietotajvards = ?, vards = ?, uzvards = ?, epasts = ?, loma = ? WHERE lietotajs_id = ?";
        $stmt = $savienojums->prepare($sql);
        $stmt->bind_param("sssssi", $lietotajvards, $vards, $uzvards, $epasts, $loma, $lietotajs_id);
    }

    // Выполняем запрос
    if ($stmt->execute()) {
        echo "Dati veiksmīgi atjaunināti!";
    } else {
        echo "Kļūda: " . $savienojums->error;
    }

    // Закрываем соединение
    $stmt->close();
    $savienojums->close();

} else {
    echo "Nepilnīgi dati! Lūdzu, pārbaudiet ievades laukus.";
}
?>
