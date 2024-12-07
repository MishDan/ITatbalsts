<?php
require "con_db.php";

$vaicajums = "SELECT * FROM IT_lietotaji ORDER BY lietotajs_id DESC";
$rezultats = mysqli_query($savienojums, $vaicajums);

$json = [];
if ($rezultats->num_rows > 0) {
    while($ieraksts = $rezultats->fetch_assoc()){
        $json[] = array(
        'lietotajs_id' => htmlspecialchars($ieraksts['lietotajs_id']),
            'lietotajvards' => htmlspecialchars($ieraksts['lietotajvards']),
            'vards' => htmlspecialchars($ieraksts['vards']),
            'uzvards' => htmlspecialchars($ieraksts['uzvards']),
            'epasts' => htmlspecialchars($ieraksts['epasts']),
            'loma' => htmlspecialchars($ieraksts['loma']),
            'datums' => date("d.m.Y.H:i", strtotime($ieraksts['datums'])),
        );
    }
}
$jsonstring = json_encode($json);
echo $jsonstring;
?>