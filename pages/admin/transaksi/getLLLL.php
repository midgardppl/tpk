<?php
include('../../../koneksi.php');
$t = $_GET['t'];
$tt = $_GET['tt'];
$ttt = $_GET['ttt'];
if($t=='-' && $tt=='-' && $ttt=='-'){
$sql = mysqli_query($koneksi,"select dk.kodematkul, dt.koderuang, dt.kodehari, dt.kodejam, dt.kodejam2 from detailjadwal dt, detailkelas dk where dt.kodekelas=dk.kodekelas and dt.kodeprodi=dk.kodeprodi group by dt.iddetail") or die (mysql_error());
} else if($t!='-' && $tt=='-' && $ttt=='-'){
$sql = mysqli_query($koneksi,"select dk.kodematkul, dt.koderuang, dt.kodehari, dt.kodejam, dt.kodejam2 from detailjadwal dt, detailkelas dk where dt.kodekelas=dk.kodekelas and dt.kodeprodi=dk.kodeprodi and dt.kodejadwal in (select kodejadwal from penjadwalan where kodethnajaran='".$t."') group by dt.iddetail") or die (mysql_error());
} else if($t!='-' && $tt!='-' && $ttt=='-'){
$sql = mysqli_query($koneksi,"select dk.kodematkul, dt.koderuang, dt.kodehari, dt.kodejam, dt.kodejam2 from detailjadwal dt, detailkelas dk where dt.kodekelas=dk.kodekelas and dt.kodeprodi=dk.kodeprodi and dt.kodejadwal in (select kodejadwal from penjadwalan where kodethnajaran='".$t."' and kodesemester='".$tt."') group by dt.iddetail") or die (mysql_error());
} else if($t=='-' && $tt!='-' && $ttt=='-'){
$sql = mysqli_query($koneksi,"select dk.kodematkul, dt.koderuang, dt.kodehari, dt.kodejam, dt.kodejam2 from detailjadwal dt, detailkelas dk where dt.kodekelas=dk.kodekelas and dt.kodeprodi=dk.kodeprodi and dt.kodejadwal in (select kodejadwal from penjadwalan where kodesemester='".$tt."') group by dt.iddetail") or die (mysql_error());
} else if($t=='-' && $tt!='-' && $ttt!='-'){
$sql = mysqli_query($koneksi,"select dk.kodematkul, dt.koderuang, dt.kodehari, dt.kodejam, dt.kodejam2 from detailjadwal dt, detailkelas dk where dt.kodekelas=dk.kodekelas and dt.kodeprodi=dk.kodeprodi and dk.nip='".$ttt."' and dt.kodejadwal in (select kodejadwal from penjadwalan where kodesemester='".$tt."') group by dt.iddetail") or die (mysql_error());
} else if($t!='-' && $tt=='-' && $ttt!='-'){
$sql = mysqli_query($koneksi,"select dk.kodematkul, dt.koderuang, dt.kodehari, dt.kodejam, dt.kodejam2 from detailjadwal dt, detailkelas dk where dt.kodekelas=dk.kodekelas and dt.kodeprodi=dk.kodeprodi and dk.nip='".$ttt."' and dt.kodejadwal in (select kodejadwal from penjadwalan where kodethnajaran='".$t."') group by dt.iddetail") or die (mysql_error());
} else if($t=='-' && $tt=='-' && $ttt!='-'){
$sql = mysqli_query($koneksi,"select dk.kodematkul, dt.koderuang, dt.kodehari, dt.kodejam, dt.kodejam2 from detailjadwal dt, detailkelas dk where dt.kodekelas=dk.kodekelas and dt.kodeprodi=dk.kodeprodi and dk.nip='".$ttt."' group by dt.iddetail") or die (mysql_error());
} else if($t!='-' && $tt!='-' && $ttt!='-'){
$sql = mysqli_query($koneksi,"select dk.kodematkul, dt.koderuang, dt.kodehari, dt.kodejam, dt.kodejam2 from detailjadwal dt, detailkelas dk where dt.kodekelas=dk.kodekelas and dt.kodeprodi=dk.kodeprodi and dk.nip='".$ttt."' and dt.kodejadwal in (select kodejadwal from penjadwalan where kodethnajaran='".$t."' and kodesemester='".$tt."') group by dt.iddetail") or die (mysql_error());
}
echo "<table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>";
echo "<thead>";
echo "<tr>";
	echo "<th style='width:60px'>Mata Kuliah</th>";
    echo "<th style='width:100px'>Ruangan</th>";
    echo "<th style='width:100px'>Hari</th>";
	echo "<th style='width:100px'>Jam Mulai</th>";
	echo "<th style='width:100px'>Jam Selesai</th>";
	echo "<th style='width:100px'>SKS</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
mysqli_select_db($koneksi,$nama_db) or die("Gagal memilih database!");
$no = 0;
while ($row = mysqli_fetch_array($sql)){
    $no = $no+1;
	$ta=mysqli_fetch_array(mysqli_query($koneksi,"select * from matakuliah where kodematkul='".$row[0]."'"));
$sm=mysqli_fetch_array(mysqli_query($koneksi,"select * from ruangan where koderuang='".$row[1]."'"));
$hr=mysqli_fetch_array(mysqli_query($koneksi,"select * from hari where kodehari='".$row[2]."'"));
$j1=mysqli_fetch_array(mysqli_query($koneksi,"select * from jam where kodejam='".$row[3]."'"));
$j2=mysqli_fetch_array(mysqli_query($koneksi,"select * from jam where kodejam='".$row[4]."'"));

    echo '<tr>
        <td>'.$ta[1].'</td>
        <td>'.$sm[2].'</td>
		<td>'.$hr[1].'</td>
        <td>'.$j1[1].'</td>
		<td>'.$j2[1].'</td>
		<td>'.$ta[2].'</td>
    </tr>';

}
echo "</tbody>";
echo "</table>
<form method=\"post\" action=\"javascript: printExternal('p_laporan_dsn.php?t=".$t."&tt=".$tt."&ttt=".$ttt."')\" style=\"font-size:16px\">

						<button type=\"submit\">Cetak</button>
</form>";
?>