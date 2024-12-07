<?php
    require "con_db.php";

    // Первый запрос - данные из IT_pieteikumi
    $vaicajums_pieteikumi = "SELECT * FROM IT_pieteikumi ORDER BY pieteikums_id DESC";
    $rezultats_pieteikumi = mysqli_query($savienojums, $vaicajums_pieteikumi);

    $pieteikumi = array();
    while ($ieraksts = $rezultats_pieteikumi->fetch_assoc()) {
        $pieteikumi[] = array(
            'id' => htmlspecialchars($ieraksts['pieteikums_id']),
            'vards' => htmlspecialchars($ieraksts['vards']),
            'uzvards' => htmlspecialchars($ieraksts['uzvards']),
            'epasts' => htmlspecialchars($ieraksts['epasts']),
            'talrunis' => htmlspecialchars($ieraksts['talrunis']),
            'datums' => date("d.m.Y.H:i", strtotime($ieraksts['datums'])),
            'status' => htmlspecialchars($ieraksts['status']),
        );
    }

    // Второй запрос - все maks_epasts из IT_maksajumi
    $vaicajums_maksajumi = "SELECT maks_epasts FROM IT_maksajums";
    $rezultats_maksajumi = mysqli_query($savienojums, $vaicajums_maksajumi);

    $maksajumi = array();
    while ($ieraksts = $rezultats_maksajumi->fetch_assoc()) {
        $maksajumi[] = htmlspecialchars($ieraksts['maks_epasts']);
    }

    // Финальный JSON
    echo json_encode(array(
        'pieteikumi' => $pieteikumi,
        'maksajumi' => $maksajumi,
    ));
?>
