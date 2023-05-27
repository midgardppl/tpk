<?php
include('../../../koneksi.php');

$KODEPROD = $_POST['kodeprodi'];
$KODEKLS = $_POST['kodekelas'];
$KODEPECAH = $_POST['kodepecah'];
$KODETA = $_POST['kodethnajaran'];
$KODEMK = $_POST['kodematkul'];
$KODESEM = $_POST['kodesemester'];
$KODENIP = $_POST['nip'];
$KODEJM = $_POST['jumlahmahasiswa'];
$KODEANGKAT = $_POST['tahunangkatan'];
$KODEFAK = $_POST['kodefakultas'];



$SQL = mysql_query("update detailkelas set KODEPRODI = '$KODEPROD',KODEKELAS = '$KODEKLS',
kdpecah = '$KODEPECAH',KODETHNAJARAN = '$KODETA',KODEMATKUL = '$KODEMK', KODESEMESTER = '$KODESEM',
NIP = '$KODENIP', JUMLAHMAHASISWA = '$KODEJM',TAHUNANGKATAN = '$KODEANGKAT',kodefakultas = '$KODEFAK'
WHERE KODEPRODI = '$KODEPROD' AND KODEKELAS = '$KODEKLS' AND kdpecah = '$KODEPECAH' AND KODETHNAJARAN = '$KODETA' AND
KODEMATKUL = '$KODEMK' AND KODESEMESTER = '$KODESEM' AND NIP = '$KODENIP'") or die (mysql_error());

if ($SQL) {
	header('location:insertview_trans_kelas.php');
}

?>