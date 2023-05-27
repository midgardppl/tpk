<?php
include('../../../koneksi.php');

$KODEKLS = $_POST['kodekelas'];
$NAMAKLS = $_POST['namakelas'];

$SELECTNAMA = mysqli_query($koneksi,"select namakelas from kelas where namakelas='$NAMAKLS'");
if(mysqli_num_rows($SELECTNAMA)>0){
        echo '<script language="javascript">alert("Kelas Sudah Ada!")</script>';
        echo "<META http-equiv='refresh' content='0;URL=insertview_kelas.php'>";
}
else{
	$SQL = mysqli_query($koneksi,"insert into kelas values('$KODEKLS','$NAMAKLS')") or die (mysql_error($koneksi));
	if($SQL){
		echo '<script language="javascript">';
		echo 'alert("Sukses!")';
		echo '</script>';
		echo "<META http-equiv='refresh' content='0;URL=insertview_kelas.php'>";
		}
	}
?>

