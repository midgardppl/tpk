<?php
include('../../../koneksi.php');
$t = $_GET['t'];
$tt = $_GET['tt'];
if($t=='-' && $tt=='-'){
$sql = mysql_query("select dt.kodejadwal, pj.kodethnajaran, pj.kodesemester, p.namaprodi, pj.status from detailjadwal dt, penjadwalan pj, prodi p where dt.kodejadwal=pj.kodejadwal and dt.kodeprodi=p.kodeprodi group by dt.iddetail") or die (mysql_error());
} else if($t!='-' && $tt=='-'){
$sql = mysql_query("select dt.kodejadwal, pj.kodethnajaran, pj.kodesemester, p.namaprodi, pj.status from detailjadwal dt, penjadwalan pj, prodi p where dt.kodejadwal=pj.kodejadwal and dt.kodeprodi=p.kodeprodi and dt.kodejadwal in (select kodejadwal from penjadwalan where kodethnajaran='".$t."') group by dt.iddetail") or die (mysql_error());
} else if($t=='-' && $tt!='-'){
$sql = mysql_query("select dt.kodejadwal, pj.kodethnajaran, pj.kodesemester, p.namaprodi, pj.status from detailjadwal dt, penjadwalan pj, prodi p where dt.kodejadwal=pj.kodejadwal and dt.kodeprodi=p.kodeprodi and dt.kodejadwal in (select kodejadwal from penjadwalan where kodesemester='".$tt."') group by dt.iddetail") or die (mysql_error());
} else if($t!='-' && $tt!='-'){
$sql = mysql_query("select dt.kodejadwal, pj.kodethnajaran, pj.kodesemester, p.namaprodi, pj.status from detailjadwal dt, penjadwalan pj, prodi p where dt.kodejadwal=pj.kodejadwal and dt.kodeprodi=p.kodeprodi and dt.kodejadwal in (select kodejadwal from penjadwalan where kodethnajaran='".$t."' and kodesemester='".$tt."') group by dt.iddetail") or die (mysql_error());
}
echo "<table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>";
echo "<thead>";
echo "<tr>";
	echo "<th style='width:60px'>Kode Jadwal</th>";
    echo "<th style='width:100px'>Tahun Ajaran</th>";
    echo "<th style='width:100px'>Semester</th>";
	echo "<th style='width:100px'>Prodi</th>";
	echo "<th style='width:100px'>Status</th>";
			echo "<th style='width:100px'>Aksi</th>";

echo "</tr>";
echo "</thead>";
echo "<tbody>";
mysql_select_db($nama_db, $koneksi) or die("Gagal memilih database!");
$no = 0;
while ($row = mysql_fetch_array($sql)){
    $no = $no+1;
	$ta=mysql_fetch_array(mysql_query("select * from tahunajaran where kodethnajaran='".$row[1]."'"));
$sm=mysql_fetch_array(mysql_query("select * from semester where kodesemester='".$row[2]."'"));

    echo '<tr>
        <td>'.$row[0].'</td>
        <td>'.$ta[1].'</td>
        <td>'.$sm[1].'</td>
		<td>'.$row[3].'</td>
        <td>'.$row[4].'</td>
				<td>';if($row[4]=="MENUNGGU"){}else{ echo '<button type="submit" onclick="javascript: printExternal(\'print_jadwal.php?kd='.$row[0].'\')">Cetak</button>';} echo '</td>

    </tr>';

}
echo "</tbody>";
echo "</table>";
?>