<?php
require 'con_db.php';

if (isset($_POST['id'])) {
    // Приводим id к целочисленному значению для безопасности
    $id = intval($_POST['id']);

    // Подготавливаем SQL-запрос для удаления пользователя по id
    $query = $savienojums->prepare("DELETE FROM IT_lietotaji WHERE lietotajs_id = ?");
    $query->bind_param("i", $id);

    if ($query->execute()) {
        echo "Пользователь успешно удален!";
    } else {
        echo "Ошибка при удалении: " . $savienojums->error;
    }

    $query->close();
    $savienojums->close();
} else {
    echo "ID пользователя не был передан!";
}
?>
