<?php

  include "string_to_array.php";
  include "../include/koneksi.php";
  include("../include/matriks.php");

 echo "Proses perhitungan sudah selesai dan hasilnya telah disimpan di database ...! \n";		
 echo "========== BERHASIL ========== <br>";
  if(isset($_POST['categories'])) {
    $sJson = $_POST['categories'];
	//echo "hasil POST : ".$sJson." \n"; 
	
	$ba1 = new BuatArray();		
	$dataM = $ba1->buatMatriksData($sJson);
	//echo "matriks data : \n";
	//$ba1->tampilMatriks($dataM);
	$bar = count($dataM);
	//echo "baris dataM : ".$bar." <br>";
	//echo json_encode($dataM);
	
	// echo "*********  SELECT count(*) FROM ruang_coba WHERE 1  ********* <br> ";
	//$baca_slotisi = mysql_query("SELECT * FROM slotisi ORDER BY id ASC");	
	
	$sql = "SELECT * FROM slotisi ORDER BY id ASC";
	$baca_slotisi = mysqli_query($koneksi, $sql);
	
	$baris = 0;
	$nil_id_min = array();
	//while($row = mysql_fetch_row($baca_slotisi)){
	//		//if($baris == 0) $nil_id_min[0] = $row;
	//		$nil_id_min[$baris] = $row;
	//		$baris++;
	//	}
		
	//$sql = "SELECT Lastname, Age FROM Persons ORDER BY Lastname";

	//if ($result = mysqli_query($con, $sql)) {
	if ($baca_slotisi) {	
	  // Fetch one and one row
	  while ($row = mysqli_fetch_row($baca_slotisi)) {
		  $nil_id_min[$baris] = $row;
 		  $baris++;
		//printf ("%s (%s)\n", $row[0], $row[22]);
	  }
	  //mysqli_free_result($result);
	  //mysqli_free_result($baca_slotisi);
	}	
	//$nil_id_min2 = array();
	//$coba = array();
	//foreach($nil_id_min as $key=>$val){
	//	$nil_id_min2[$key] = array();
	//	foreach($val as $k=>$v){
	//		$nil_id_min2[$key][$k]= $v;
	//		if($k == 22) $coba[$key] = $v;
	//	}
	//}
	
	
	//	foreach($row as $key => $value)
	//		{
	//		//echo $key." has the value". $value;
	//		$nil_id_min2[$baris][$key] = $value;
	//		}
	//
	//echo "matriks nil_id_min : \n";
	//$ba1->tampilMatriks($nil_id_min);
	//$ba1->tampilMatriksNBaris($nil_id_min, 1);
	
	//echo "nil_id_min : ".$nil_id_min2[0][22]." <br>";
	//echo "coba : ".$coba[1]." <br>";
		
	$nilKet = 0;	
	if($baris != 0){ 	
		$vSort = $ba1->ambilSatuKolomMatriks($nil_id_min ,21);
		echo "tampilVektor vSort <br>";
		$ba1->tampilVektor($vSort);
 
		sort($vSort);
		//$ba1->tampilVektor($vSort);
		//$nil_min_ket = $vSort[0];   //$nil_id_min[0][22];
		$nilKetmaks = $vSort[count($vSort)-1]; 
		//echo "=== nilKet2 : ".$nilKet2." <br>";
	
		$nilKetmin = $vSort[0];//$nil_id_min[$baris-1][22];
		
		if($bar < $nil_id_min[0][0]) $baris = 0;
		//echo "nil_id_min[0][0] : ".$nil_id_min[0][0]." <br>";
		//echo "baris : ".$baris." <br>";
	
		//if($nilKetmin > 1) $nilKet = 0;
		//	else $nilKet = $nilKetmaks;
			
		if($nilKetmin <= 1) $nilKet = $nilKetmaks;	
		echo "=== nilKet : ".$nilKet." <br>";		
			
	} //else 	$nilKet = 0;
	//
	//echo "baris : ".$baris." <br>";
	//$nil_maks_array = array();
	//$nil_maks_baca = mysql_query("SELECT nilaifitness FROM $nama_tabel ORDER BY nilaifitness DESC");	
	//$nil_maks_array[0] = mysql_fetch_row($nil_maks_baca);	
	//$nil_maks = $nil_maks_array[0][0];
	//echo "nil_maks : ".$nil_maks." <br>";
	
	
	//$nilKet = mysql_result(mysql_query("SELECT ket FROM slotisi WHERE id = $baris"),0);
	//echo "nilKet : ".$nilKet." <br>";
	
	$kol =(count($dataM ,1)/count($dataM ,0))-1;
	$bar = count($dataM);
    $k23 = $nilKet + 1;	
	$iter = 0;
	for($j=0;$j<$bar;$j++){
		$baris++;
		for($i=0;$i<$kol;$i++){			
			//echo "baris : ".$baris." <br>";	
			$k2 = $dataM[$iter][0];
			$k3 = $dataM[$iter][1];
			$k4 = $dataM[$iter][2];
			$k5 = $dataM[$iter][3];
			$k6 = $dataM[$iter][4];
			$k7 = $dataM[$iter][5];
			$k8 = $dataM[$iter][6];
			$k9 = $dataM[$iter][7];
			$k10 = $dataM[$iter][8];
			$k11 = $dataM[$iter][9];
			$k12 = $dataM[$iter][10];
			$k13 = $dataM[$iter][11];
			$k14 = $dataM[$iter][12];
			$k15 = $dataM[$iter][13];
			$k16 = $dataM[$iter][14];
			$k17 = $dataM[$iter][15];
			$k18 = $dataM[$iter][16];
			$k19 = $dataM[$iter][17];
			$k20 = $dataM[$iter][18];
			$k21 = $dataM[$iter][19];
			$k22 = $dataM[$iter][20];
		//mysql_query("INSERT INTO slotisi (id_ruang, nama_ruang, kapasitas_ruang, ket) VALUES ($baris , '$nilKet[i][0]', $mat_ruang_php[i][1],$nilKet + 1)");
			$tambah = "INSERT INTO slotisi (id, noslot,noruang,nohari,nojam, nomk,kp,"
			."KODEPRODI,KODEKELAS,kdpecah,KODEMATKUL,semester,NIPDosen1,NIPDosen2,"
			."NIPpeg1,NIPpeg2,JUMLAHMAHASISWA,TAHUNANGKATAN,KODETHNAJARAN,KODESEMESTER,masaujian,nilaifitness,ket) VALUES"
			."('$baris' , '$k2', '$k3','$k4', '$k5', '$k6','$k7','$k8',"
			."'$k9', '$k10','$k11', '$k12', '$k13','$k14', '$k15','$k16',"
			."'$k17','$k18','$k19','$k20','$k21','$k22','$k23')";
			
			$result = mysqli_query($koneksi,$tambah);
			
			//$sql = "SELECT id, firstname, lastname FROM MyGuests";
			//$result = mysqli_query($conn, $sql);
			
		//if($result) echo ("Data Input OK <br>");
		//	else echo ("Data Input Failed <br>");
		//echo "nilKet : ".mysql_result($result,0,0)." <br>";
			}
			$iter++;
    }		
	//echo "baris : ".$baris." <br>";	

	

	
	/*
	$idR = "SELECT count(*) FROM ruang_coba WHERE 1"; 
	$baris = (count($dataM ,1)/count($dataM ,0))-1;
	$nilKet = "SELECT ket FROM ruang_coba WHERE id_ruang = $idR";
	for($i=0;$i<$baris;$i++){
			$idR++;
			INSERT INTO ruang_coba (id_ruang, nama_ruang, kapasitas_ruang, ket)
			VALUES ($idR , '$dataM[i][0]', $dataM[i][1]);
		}
	//*/	
		
	} 
	else {
		   echo "Noooooooob";
		 }
//*/

mysqli_close($koneksi);

 //echo "lewat proses POST ...! "; // "<br />";
?>