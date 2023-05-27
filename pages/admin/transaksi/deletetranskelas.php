<?php
include('../../../koneksi.php');

$KODEPRODI = $_GET['KODEPRODI'];
$KODEKELAS = $_GET['KODEKELAS'];
$KDPECAH = $_GET['KDPECAH'];
$TAHUNAJARAN = $_GET['KODETHNAJARAN'];
$KODEMATKUL = $_GET['KODEMATKUL'];
$NIP = $_GET['NIP'];

$SQL = mysql_query("DELETE FROM detailkelas WHERE KODEPRODI = '$KODEPRODI' AND KODEKELAS = '$KODEKELAS' AND kdpecah = '$KDPECAH' AND KODETHNAJARAN = '$TAHUNAJARAN' AND KODEMATKUL  = '$KODEMATKUL' AND NIP  = '$NIP'") or die (mysql_error());
if ($SQL) {
    header('location:insertview_trans_kelas.php');
}
?>