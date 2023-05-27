<?php
include('../../../koneksi.php');

$ACTION = $_POST['action'];
$KODEMATKUL = $_POST['kodematkul'];
$KODETHNAJARAN = $_POST['kodethnajaran'];
$KODESEMESTER = $_POST['kodesemester'];
$SELECTENTRY = mysql_query("select kodethnajaran,kodematkul from tawaranmatkul where kodethnajaran='$KODETHNAJARAN' and kodematkul='$KODEMATKUL'");
if(mysql_num_rows($SELECTENTRY)>0){
    echo '<script language="javascript">alert("Mata Kuliah Sudah Dijadwalkan!")</script>';
    echo "<META http-equiv='refresh' content='0;URL=insertview_trans_matkul.php'>";
    }
	else if ($ACTION=="1"){
        $SQL = mysql_query("insert into tawaranmatkul values('$KODETHNAJARAN','$KODEMATKUL','$KODESEMESTER','Aktif')") or die (mysql_error());
        if($SQL){
			$updatestatus= mysql_query("update tawaranmatkul set statustawaran = 'Tidak Aktif' where kodethnajaran!='$KODETHNAJARAN' or kodesemester!='$KODESEMESTER'") or die (mysql_error());
			if($updatestatus){ header('location:insertview_trans_matkul.php'); }
        }
    }
    else if ($ACTION=="2"){
		$SQL = mysql_query("insert into tawaranmatkul select '$KODETHNAJARAN',kodematkul,kodesemester,'Aktif' from matakuliah where kodesemester='$KODESEMESTER' and statusaktif='Aktif'") or die (mysql_error());
		if($SQL){
			$updatestatus= mysql_query("update tawaranmatkul set statustawaran = 'Tidak Aktif' where kodethnajaran!='$KODETHNAJARAN' or kodesemester!='$KODESEMESTER'") or die (mysql_error());
			if($updatestatus){ header('location:insertview_trans_matkul.php');}
        }
    }

?>

