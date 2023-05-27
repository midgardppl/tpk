<?php
include('../../../koneksi.php');

$NIPs = $_POST['nip'];
$KODEMATKUL = $_POST['kodematkul'];
$KODETHNAJARAN = $_POST['kodethnajaran'];
$KODESEMESTER = $_POST['kodesemester'];

foreach($NIPs as $nip){
    $SQL = mysql_query("insert into detailajar values('$nip','$KODEMATKUL','$KODETHNAJARAN','$KODESEMESTER',1)") or die (mysql_error());
}
if($SQL){
	header('location:insertview_bagidosen.php');
}
?>

