<?php
require 'con_db.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $query = $savienojums->prepare("SELECT * FROM IT_lietotaji WHERE lietotajs_id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    if ($row = $result->fetch_assoc()) {
        $json = array(
            'lietotajs_id' => $row['lietotajs_id'],
            'lietotajvards' => htmlspecialchars($row['lietotajvards']),
            'vards' => htmlspecialchars($row['vards']),
            'uzvards' => htmlspecialchars($row['uzvards']),
            'epasts' => htmlspecialchars($row['epasts']),
            'loma' => htmlspecialchars($row['loma'])
        );
        echo json_encode($json);
    }
    $query->close();
}
?>
