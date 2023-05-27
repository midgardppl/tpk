<?php
/*
	mengambil data dari tabel database mysql ==> array 2 dimensi (matriks)
*/
//include('../koneksi.php');

function ambil_data_tabel($koneksi,$nama_tabel){
	$baca_nama_tabel = mysqli_query($koneksi,"SELECT * FROM $nama_tabel");
	$matNama_Tabel_php = array();
	$nNama_Tabel_php = 0;
	$n_colR = 0;
	while($row = mysqli_fetch_row($baca_nama_tabel)){
			$matNama_Tabel_php[$nNama_Tabel_php] = $row;
			$nNama_Tabel_php++;
			if($nNama_Tabel_php < 2) $n_colR = count($row);
			}  	
	return $matNama_Tabel_php;	
}
function ambil_data_tabel_urut($koneksi,$nama_tabel, $urut){
	$baca_nama_tabel = mysqli_query($koneksi,"SELECT * FROM $nama_tabel ORDER BY '$urut' ASC");
	$matNama_Tabel_php = array();
	$nNama_Tabel_php = 0;
	$n_colR = 0;
	while($row = mysqli_fetch_row($baca_nama_tabel)){
			$matNama_Tabel_php[$nNama_Tabel_php] = $row;
			$nNama_Tabel_php++;
			if($nNama_Tabel_php < 2) $n_colR = count($row);
			}  	
	return $matNama_Tabel_php;	
}
/*
	ambil data dari tabel slotisi
*/
function ambil_data_slotisi($koneksi,$nama_tabel,$kd_thn_ajaran,$kd_semester ,$kd_masa_ujian){
	$baca_nama_tabel = mysqli_query($koneksi,"SELECT * FROM $nama_tabel"
	."WHERE `KODETHNAJARAN`= '$kd_thn_ajaran' AND `KODESEMESTER` = '$kd_semester' AND `masaujian` = '$kd_masa_ujian' ");
	$matNama_Tabel_php = array();
	$nNama_Tabel_php = 0;
	//$n_colR = 0; 
	while($row = mysqli_fetch_row($baca_nama_tabel)){
			$matNama_Tabel_php[$nNama_Tabel_php] = $row;
			$nNama_Tabel_php++;
			//if($nNama_Tabel_php < 2) $n_colR = count($row);
			}  

	return $matNama_Tabel_php;	
}
function refresh_nomer_data($koneksi,$nama_tabel,$kode_nomer){
	$bawah = mysqli_query($koneksi,"SELECT $kode_nomer FROM $nama_tabel order by $kode_nomer asc limit 1 ");
	$batas1 = mysqli_fetch_array($bawah);
	$b1 = $batas1[0];
	
	$atas = mysqli_query($koneksi,"SELECT $kode_nomer FROM $nama_tabel order by $kode_nomer desc limit 1 ");
	$batas2 = mysqli_fetch_array($atas);
	$b2 = $batas2[0];
	//echo "=== b1 : ".$b1." dan b2 : ".$b2." <br>";
	
	$ganti=0;
	for($i=$b1;$i<=$b2;$i++){
		$ganti++;
		$sql=mysqli_query($koneksi,"update $nama_tabel set $kode_nomer= $ganti where $kode_nomer= $i ");		
	}  		
}
/*
	delete data dari tabel slotisi
*/
function delete_slotisi($koneksi,$nama_tabel, $kd_thn_ajaran, $kd_semester ,$kd_masa_ujian){
	//echo "nama_tabel : ".$nama_tabel." <br>";
	//echo "kd_thn_ajaran : ".$kd_thn_ajaran." <br>";
	//echo "kd_semester : ".$kd_semester." <br>";
	//echo "kd_masa_ujian : ".$kd_masa_ujian." <br>";
			
	$baca_nama_tabel = mysqli_query($koneksi,"SELECT * FROM $nama_tabel WHERE `KODETHNAJARAN`= '$kd_thn_ajaran' AND `KODESEMESTER` = '$kd_semester' AND `masaujian` = $kd_masa_ujian ORDER BY `nilaifitness` DESC");
	
		if (!$baca_nama_tabel) {
			echo 'Could not run query: ' . mysqli_error($koneksi);
			exit;
			}
			
	//nilaifitness
	//$baca_nama_tabel = mysql_query("SELECT * FROM $nama_tabel"
	//."WHERE `KODETHNAJARAN`= '$kd_thn_ajaran' AND `KODESEMESTER` = '$kd_semester' AND `masaujian` = $kd_masa_ujian"
	//."ORDER BY `nilaifitness` DESC");
	
	$matNama_Tabel_php = array();
	$nNama_Tabel_php = 0;
	//$n_colR = 0; SELECT max(`nilaifitness`) FROM `slotisi` WHERE 1 
	while($row = mysqli_fetch_row($baca_nama_tabel)){
			$matNama_Tabel_php[$nNama_Tabel_php] = $row;
			$nNama_Tabel_php++;
			//if($nNama_Tabel_php < 2) $n_colR = count($row);
			}  
	//echo "matNama_Tabel_php : ".count($matNama_Tabel_php)." <br>";
	//tampilMatriks($matNama_Tabel_php);
	
	if($nNama_Tabel_php != 0) {
		$nil_maks = $matNama_Tabel_php[0][21];
		$nil_ket = $matNama_Tabel_php[0][22];	
	
		//echo "nil_maks : ".$nil_maks." dan nil_ket : ".$nil_ket." <br>";
	
		//`SELECT * FROM `slotisi` WHERE `KODETHNAJARAN`= 'thn003' AND `KODESEMESTER` = 'sem001' AND `masaujian` = 0 ORDER BY `nilaifitness` DESC 
		$result = mysqli_query($koneksi,"DELETE FROM $nama_tabel WHERE `ket` <> '$nil_ket' ");
		//$result = mysql_query("DELETE FROM $nama_tabel WHERE `nilaifitness` < '$nil_maks' "
		//."AND `ket` <> '$nil_ket' ");
		}
 //DELETE FROM `slotisi` WHERE `nilaifitness`< 0.00011763321962122103 AND `ket` <> 1 
	
	//return $matNama_Tabel_php;	
}
/*
	mengambil data dari tabel $nama_tabel1 --> detailkelas 
							  $nama_tabel2 --> matakuliah
	$kel --> k atau teori
	$kel --> p atau praktikum
*/
function ambil_detailkelas($koneksi,$nama_tabel, $nama_tabel2 ,$kd_thn_ajaran, $kel){
	//echo "nama_tabel : ".$nama_tabel." <br>";
	//echo "nama_tabel2 : ".$nama_tabel2." <br>";
	//echo "kd_thn_ajaran : ".$kd_thn_ajaran." <br>";
	//echo "kel : ".$kel." <br>";

	$baca_nama_tabel = mysqli_query($koneksi,"SELECT dk.`KODEPRODI`,dk.`KODEKELAS`,dk.`kdpecah`,dk.`KODEMATKUL`, "
	."mk.`semester` ,dk.`NIP`,dk.`JUMLAHMAHASISWA`, dk.`TAHUNANGKATAN`,mk.`kataup`"
	."FROM $nama_tabel AS dk INNER JOIN $nama_tabel2 AS mk "
	."ON dk.`KODEMATKUL` = mk.`KODEMATKUL`"
	."WHERE dk.`KODETHNAJARAN`= '$kd_thn_ajaran' AND mk.`kataup` = '$kel' "
	."ORDER BY dk.`KODEMATKUL`,dk.`KODEKELAS`,dk.`kdpecah` ASC");	
	
	$matNama_Tabel_php = array();
	$nNama_Tabel_php = 0;
	while($row = mysqli_fetch_row($baca_nama_tabel)){
			$matNama_Tabel_php[$nNama_Tabel_php] = $row;
			$nNama_Tabel_php++;
			}  	
	return $matNama_Tabel_php;	
}
/*
	mengambil data dari tabel $nama_tabel --> `labkomujian` 
							  $nama_tabel2 --> `labkom`
	
*/
function ambil_labkomujian($koneksi,$nama_tabel, $nama_tabel2 ,$kd_thn_ajaran, $kd_semester){
	//echo "nama_tabel : ".$nama_tabel." <br>";
	//echo "nama_tabel2 : ".$nama_tabel2." <br>";
	//echo "kd_thn_ajaran : ".$kd_thn_ajaran." <br>";
	//echo "kel : ".$kel." <br>";

	$baca_nama_tabel = mysqli_query($koneksi,"SELECT nt.`KODELABUJIAN`,nt.`KODELAB`, nt2.`KAPASITASLAB`, nt2.`NAMALAB`"
	."FROM $nama_tabel AS nt INNER JOIN $nama_tabel2 AS nt2 "
	."ON nt.`KODELAB` = nt2.`KODELAB`"
	."WHERE nt.`KODETHNAJARAN`= '$kd_thn_ajaran' AND nt.`KODESEMESTER` = '$kd_semester' "
	."ORDER BY nt.`KODELAB` ASC");	
	
	$matNama_Tabel_php = array();
	$nNama_Tabel_php = 0;
	while($row = mysqli_fetch_row($baca_nama_tabel)){
			$matNama_Tabel_php[$nNama_Tabel_php] = $row;
			$nNama_Tabel_php++;
			}  	
	return $matNama_Tabel_php;	
}
/*
	mengambil data dari tabel $nama_tabel --> `ruangujian` 
							  $nama_tabel2 --> `ruangan`
	
*/
function ambil_ruangujian($koneksi,$nama_tabel, $nama_tabel2 ,$kd_thn_ajaran, $kd_semester){
    //echo "nama_tabel : ".$nama_tabel." <br>";
	//echo "nama_tabel2 : ".$nama_tabel2." <br>";
	//echo "kd_thn_ajaran : ".$kd_thn_ajaran." <br>";
	//echo "kd_semester : ".$kd_semester." <br>";
	
	$baca_nama_tabel = mysqli_query($koneksi,"SELECT * FROM $nama_tabel AS nt "
	."WHERE nt.`KODETHNAJARAN`= '$kd_thn_ajaran' AND nt.`KODESEMESTER`='$kd_semester' ");
				
	$matNama_Tabel_php = array();
	$nNama_Tabel_php = 0;
	while($row = mysqli_fetch_row($baca_nama_tabel)){
			$matNama_Tabel_php[$nNama_Tabel_php] = $row;
			$nNama_Tabel_php++;
			}  	
	for($i=0;$i<$nNama_Tabel_php;$i++){
		if($matNama_Tabel_php[$i][2] == null){		
			$matNama_Tabel_php[$i][2] = "-";
			$indeks = $matNama_Tabel_php[$i][0];
			mysqli_query($koneksi,"UPDATE `ruangujian` SET `koderuang2` = '-' "
				."WHERE `ruangujian`.`KODERU` = '$indeks'");
		}
	}
//echo "============= matNama_Tabel_php : <br>";
//tampilMatriks($matNama_Tabel_php);echo "<br>";	
	$baca_nama_tabel2 = mysqli_query($koneksi,"SELECT * FROM $nama_tabel2");	
	$matNama_Tabel_php2 = array();
	$nNama_Tabel_php2 = 0;
	while($row = mysqli_fetch_row($baca_nama_tabel2)){
			$matNama_Tabel_php2[$nNama_Tabel_php2] = $row;
			$nNama_Tabel_php2++;
			}
//echo "============= matNama_Tabel_php2 : <br>";
//tampilMatriks($matNama_Tabel_php2);echo "<br>";	
			//$bar = count($matNama_Tabel_php);
	$has = 0;
	for($i=0;$i<$nNama_Tabel_php;$i++){
		$nil = $matNama_Tabel_php[$i][1];
		$nil2 = $matNama_Tabel_php[$i][2];
		for($i2=0;$i2<$nNama_Tabel_php2;$i2++){
			if($matNama_Tabel_php2[$i2][0]==$nil) $has = $has + $matNama_Tabel_php2[$i2][2];
			if($matNama_Tabel_php2[$i2][0]==$nil2) $has = $has + $matNama_Tabel_php2[$i2][2];
		}
//echo "============= has : ".$has." dan nil : ".$nil." <br>";		
		$matNama_Tabel_php[$i][3] = $has;
		$indeks = $matNama_Tabel_php[$i][0];
		mysqli_query($koneksi,"UPDATE `ruangujian` SET `kapasitas` = '$has' "
		."WHERE `ruangujian`.`KODERU` = '$indeks'");	
		
		$has = 0;
	}
//echo "============= matNama_Tabel_php : <br>";
//tampilMatriks($matNama_Tabel_php);echo "<br>";	
	return $matNama_Tabel_php;	
}
/*
	cek apakah di tabel hari ada hari jumat --> return = 0 atau = 1
*/
function cek_hari_jumat($koneksi,$nama_tabel){
	//echo "nama_tabel : ".$nama_tabel." <br>";
	//$nj = array();	
	//if (!$baca_nama_tabel) {
	//		echo 'Could not run query: ' . mysql_error();
	//		exit;
	//		}		
	//$row = mysql_fetch_row($baca_nama_tabel);
	//echo "nilai nj : ".$row[1]." <br>";
	//$fields_num = mysql_num_fields($baca_nama_tabel);
	//echo "fields_num : ".$fields_num." <br>";
	
	$hit = 0;
	$baca_nama_tabel = mysqli_query($koneksi,"SELECT KODEHARI,NAMAHARI FROM hari ");
	while($row = mysqli_fetch_row($baca_nama_tabel)) { 
			if(strtolower($row[1]) == 'jumat') $hit++; //else echo $row[1]." not <br />"; 
			}	
	//echo "nilai hit : ".$hit." <br>";
	
	if($hit > 0) {
		$ada_jumat = 1;
		if($nama_tabel == "hari") 
			{
			$baca_nama_tabel_h = mysqli_query($koneksi,"SELECT * FROM $nama_tabel WHERE NAMAHARI='jumat'");
			$row = mysqli_fetch_row($baca_nama_tabel_h);
			//echo "hari_jumat : ".$row[1]." <br>";
			}
		if($nama_tabel == "hariujian") 
			{
			$baca_nama_tabel_hu = mysqli_query($koneksi,"SELECT hu.`KODEHARIUJIAN`,hu.`KODEHARI`, h.`NAMAHARI`,hu.`KODESEMESTER` ,hu.`KODETHNAJARAN`"
							."FROM $nama_tabel AS hu INNER JOIN hari AS h ON hu.`KODEHARI` = h.`KODEHARI`"
							."WHERE h.`NAMAHARI` = 'jumat' ORDER BY hu.`KODEHARIUJIAN`");
			$row = mysqli_fetch_row($baca_nama_tabel_hu);	
			//echo "hari_jumat : ".$row[2]." <br>";			
			}
		if(count($row)==0) $ada_jumat = 0; 
		//echo "ada_jumat ".$ada_jumat." <br>";
		} 
		else $ada_jumat = 0;
	return $ada_jumat;	
}
/*
	mengambil data dari tabel $nama_tabel --> pegawai 
	SELECT * FROM `pegawai` 
	WHERE `KODEJABATAN`='jab001' AND `KODEFAKULTAS`= 'fak001'
*/
function ambil_peg_pengawas($koneksi,$nama_tabel,$kd_fakultas, $kd_jabatan){
	//echo "nama_tabel : ".$nama_tabel." <br>";
	//echo "nama_tabel2 : ".$nama_tabel2." <br>";
	//echo "kd_thn_ajaran : ".$kd_thn_ajaran." <br>";
	//echo "kel : ".$kel." <br>";

	$baca_nama_tabel = mysqli_query($koneksi,"SELECT p.`NIP`,p.`NAMAPEGAWAI` FROM $nama_tabel AS p "
	."WHERE p.`KODEJABATAN`='$kd_jabatan' AND p.`KODEFAKULTAS`= '$kd_fakultas' "
	."ORDER BY p.`NAMAPEGAWAI` ASC");	
	
	$matNama_Tabel_php = array();
	$nNama_Tabel_php = 0;
	while($row = mysqli_fetch_row($baca_nama_tabel)){
			$matNama_Tabel_php[$nNama_Tabel_php] = $row;
			$nNama_Tabel_php++;
			}  	
	return $matNama_Tabel_php;	
}
/*
	menampilkan data dari array 2 dimensi (matriks)
*/
function tampilMatriks($objM){	 
	$nb = count($objM,0);
	$nk = (count($objM,1)/count($objM,0))-1;
	for($i=0;$i<$nb;$i++){
	    for($j=0;$j<$nk;$j++){
			echo $objM[$i][$j]." ";			
		}
	     echo "<br />";		
	    }   
	}
	
?>	