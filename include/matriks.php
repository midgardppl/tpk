<?php 

include "vektor.php";

class Matriks 
 {
 private $mat = array();
 private $baris, $kolom;

 public function __construct($b, $k){ 
	$this->baris=$b;
	$this->kolom=$k;
	//echo "nilai \$baris : $this->baris <br>";
	//echo "nilai \$kolom : $this->kolom <br>";
	for($i=0;$i<$this->baris;$i++){
	     $this->mat[$i]=array();
	     for($j=0;$j<$this->kolom;$j++){	    
		$this->mat[$i][]=0;
		}
	    }
        }

 public function inputNilaiMatriks($in){ 
	//$this->baris=count($in,0);
	//$this->kolom=(count($in,1)/count($in,0))-1;
	//echo "nilai \$baris : $this->baris <br>";
	//echo "nilai \$kolom : $this->kolom <br>";
	for($i=0;$i<$this->baris;$i++){
	     //$this->mat[$i]=array();
	     for($j=0;$j<$this->kolom;$j++){	    
		$this->mat[$i][$j]=$in[$i][$j];
		}
	    }
        }
  public function inputNilaiMatriksVektorBaris($v_in, $bar){ 
	//for($i=0;$i<$this->baris;$i++){
	     for($j=0;$j<$this->kolom;$j++){	    
			$this->mat[$bar][$j]=$v_in[$j];
			}
	//    }
    }  
  public function inputNilaiMatriksVektorKol($v_in, $kol){ 
	for($i=0;$i<$this->baris;$i++){
	     //for($j=0;$j<$this->kolom;$j++){	    
			$this->mat[$i][$kol]=$v_in[$i];
			//}
	    }
    }    
        
 public function ambilBaris(){ return $this->baris; } 
        
 public function ambilKolom(){ return $this->kolom; } 

 public function ubahNilaiMatriks($ib, $jb, $nilBaru) { 
	//echo "nilai \$ib : $ib , nilai \$jb : $jb dan nilai baru : $nilBaru <br>";
	$this->mat[$ib][$jb] = $nilBaru; 
	}   
	
 public function ambilNilaiMatriks($ib, $jb) { 
	//echo "nilai \$ib : $ib , nilai \$jb : $jb dan nilai baru : $nilBaru <br>";
	return $this->mat[$ib][$jb]; 
	}	             
  
 public function ambilVektorBaris($b_ke)
        {
         $klm=Matriks::ambilKolom();
         //echo "nilai \$klm : $klm <br>";
         //$kerja=0;
         $vekt_baris=new Vektor($klm);
         //Vektor::inputNolVektor($klm);
         
         for($j=0;$j<$klm;$j++)
            {
             $kerja=Matriks::ambilNilaiMatriks($b_ke,$j);
            // echo "nilai \$kerja : $kerja <br>";
             $vekt_baris->gantiElVektor($j,$kerja);
            }
         //$vekt_baris->tampilVektor();   
         return $vekt_baris->ambilVektor();
        }
 
  public function ambil2VektorBaris($b_ke1,$b_ke2)
        {
         $klm=Matriks::ambilKolom();
         $mat_2baris=new Matriks(2,$klm);
		 
         for($j=0;$j<$klm;$j++)
            {
             $kerja1=Matriks::ambilNilaiMatriks($b_ke1,$j);
	     $kerja2=Matriks::ambilNilaiMatriks($b_ke2,$j);
	     $mat_2baris->ubahNilaiMatriks(0,$j,$kerja1);
	     $mat_2baris->ubahNilaiMatriks(1,$j,$kerja2);
            }         
         return $mat_2baris->ambilMatriks();
        }
		
 public function ambilVektorKolom($k_ke)
        {
         $bar=Matriks::ambilBaris();
         $kerja=0;
         $vekt_baris=new Vektor($bar);        
         for($j=0;$j<$bar;$j++)
            {
             $kerja=Matriks::ambilNilaiMatriks($j,$k_ke);
             $vekt_baris->gantiElVektor($j,$kerja);
            }  
         return $vekt_baris->ambilVektor();
        }
 
 /*        
   public void ganti_baris(matriks m,vektor v_ganti, int b_ke)
        {int klm=m.kolom;
         int brs=m.baris;
         //int uk_v=v_ganti.size();
         double kerja=0;     
         for(int j=0;j<klm;j++){
             m.elemen(v_ganti.ambil(j),b_ke,j);
            }
        }

 */ 
  
    
 public function ambilMatriks(){ 
	//echo "public function ambilMatriks() <br>";
	$has = array();
	//echo "nilai \$n : $this->n <br>";
	for($i=0;$i<$this->baris;$i++){
	    $has[$i] = array();
	    for($j=0;$j<$this->kolom;$j++){
		$has[$i][]=$this->mat[$i][$j];
		}		
	    }     
	return $has;        
        }   
    
/*	
 public function tampilMatriks(){
	//global $mat, $n;
	//echo "public function tampilMatriks() <br /> ";
	//echo "(";
	for($i=0;$i<$this->baris;$i++){
	    for($j=0;$j<$this->kolom;$j++){		
		//if($j<$this->kolom - 1) {
		    printf("%8s",$this->mat[$i][$j]);
		    echo str_repeat("&nbsp;",5);
		    //}		    
		    //echo str_pad($this->mat[$i][$j],10," ",STR_PAD_LEFT). str_repeat("&nbsp;",5);
			//	else 	echo str_pad($this->mat[$i][$j],10, " ", STR_PAD_LEFT);    
		}
	     print "<br>";		
	    }
	}  
*/
//string str_pad ( string $input , int $pad_length [, string $pad_string = " " [, int $pad_type = STR_PAD_RIGHT ]] )

 //public function tampilObjectMatriks($objM){
 public function tampilMatriks($objM){	 
	$nb = count($objM,0);
	$nk = (count($objM,1)/count($objM,0))-1;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    for($j=0;$j<$nk;$j++){
	        //echo "\$i : $i  dan \$j : $j <br>";
			echo $objM[$i][$j]." ";			
		//printf("%8s",$objM[$i][$j]);
		//echo str_repeat("&nbsp;",5); 
		}
	     echo "<br />";		
	    }   
	} 	
	 
 public function jumlah2Matriks($mat1, $mat2){
 	$hasil = array();
 	$nb = count($mat1,0);
	$nk = (count($mat1,1)/count($mat1,0))-1;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    $hasil[$i] = array();
	    for($j=0;$j<$nk;$j++){
		$hasil[$i][]=$mat1[$i][$j]+$mat2[$i][$j];
	        }
	    }    
	return $hasil;        
 	}	
	 
 public function kurang2Matriks($mat1, $mat2){
 	$hasil2 = array();
 	$nb = count($mat1,0);
	$nk = (count($mat1,1)/count($mat1,0))-1;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    $hasil2[$i] = array();
	    for($j=0;$j<$nk;$j++){
		$hasil2[$i][]=$mat1[$i][$j]-$mat2[$i][$j];
	        }
	    }    
	return $hasil2;         
 	}

 public function kali2Matriks($mat1, $mat2){
 	$hasil3 = array();
 	$nb = count($mat1,0);
	$nk1 = (count($mat1,1)/count($mat1,0))-1;
	$nk2= (count($mat2,1)/count($mat2,0))-1;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    $hasil3[$i] = array();
	    for($j=0;$j<$nk2;$j++){
	        $temp = 0;
	        for($ij=0;$ij<$nk1;$ij++) $temp+=$mat1[$i][$ij]*$mat2[$ij][$j];
		$hasil3[$i][]=$temp;
	        }
	    }    
	return $hasil3;        
 	}

 public function kaliMatriksSkalar($mat1, $mat2){
 	$hasil3b = array();
 	$nb = count($mat1,0);
	$nk = (count($mat1,1)/count($mat1,0))-1;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    $hasil3b[$i] = array();
	    for($j=0;$j<$nk;$j++){	        
		$hasil3b[$i][] =$mat1[$i][$j]*$mat2;
	        }
	    }    
	return $hasil3b;        
 	}
 	
 public function bagiMatriksSkalar($mat1, $mat2){
 	$hasil4 = array();
 	$nb = count($mat1,0);
	$nk = (count($mat1,1)/count($mat1,0))-1;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    $hasil4[$i] = array();
	    for($j=0;$j<$nk;$j++){	        
		$hasil4[$i][] =$mat1[$i][$j]/$mat2;
	        }
	    }    
	return $hasil4;       
 	} 		 

 public function kaliPerElemen2Matriks($mat1, $mat2){
 	$hasil5 = array();
 	$nb = count($mat1,0);
	$nk = (count($mat1,1)/count($mat1,0))-1;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    $hasil5[$i] = array();
	    for($j=0;$j<$nk;$j++){	        
		   $hasil5[$i][] =$mat1[$i][$j]*$mat2[$i][$j];
	        }
	    }    
	return $hasil5;        
 	}
/* 	
public function jlhMatriks($mat1){
 	$hasil6;
 	$nmat=count($mat1);
	for($i=0;$i<$nmat;$i++){
		$this->hasil6 += $mat1[$i];
	        }
	return $this->hasil6;        
 	}
*/ 	
///* 	
 public function jlhElemenMatriks($mat1){
 	$hasil6;
 	$nb = count($mat1,0);
	$nk = (count($mat1,1)/count($mat1,0))-1;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    //$hasil6[$i] = array();
	    for($j=0;$j<$nk;$j++){	        
		   $hasil6 += $mat1[$i][$j];
	        }
	    }
	return $hasil6;        
 	} 		
//*/

 public function kurangMatriksKonst($mat1, $konst){
 	$hasil7 = array();
 	$nb = count($mat1,0);
	$nk = (count($mat1,1)/count($mat1,0))-1;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    $hasil7[$i] = array();
	    for($j=0;$j<$nk;$j++){	        
		   $hasil7[$i][] =$mat1[$i][$j]-$konst;
	        }
	    } 
	return $hasil7;        
 	}

 public function kuadratMatriks($mat1){
 	$hasil8 = array();
 	$nb = count($mat1,0);
	$nk = (count($mat1,1)/count($mat1,0))-1;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    $hasil8[$i] = array();
	    for($j=0;$j<$nk;$j++){	        
		   $hasil8[$i][] =$mat1[$i][$j]*$mat1[$i][$j];
	        }
	    }
	return $hasil8;        
 	} 	

 public function hitungMean($mat1){
    $nb = count($mat1,0);
	$nk = (count($mat1,1)/count($mat1,0))-1;
 	$hasil9 = Matriks::jlhElemenMatriks($mat1)/($nb*$nk);		
	return $hasil9;        
 	} 	

 public function hitungVarians($mat1){
        $hm = Matriks::hitungMean($mat1);
        $kvk = Matriks::kurangMatriksKonst($mat1, $hm);
        $kv = Matriks::kuadratMatriks($kvk);
        $jv = Matriks::jlhMatriks($kv);
 	$hasil10 = $jv/(count($mat1)-1);		
	return $hasil10;        
 	}  
 /*
   ambil baris pertama dari matriks populasi
*/   
   public function ambil_1baris_mat($mat,  $baris_ke)
     {
   	$kol = (count($mat,1)/count($mat,0))-1;
      	$ambilBAris = array();
      	for($i=0;$i<$kol;$i++) $ambilBAris[] =$mat[$baris_ke][$i];
      	return $ambilBAris; 
     }  	
 /*
   buat matriks gabung  
   	mat1 --> bar1
	mat2 --> bar2
	matriks_gabung --> bar1 + bar 2

*/  
  public function buat_matriks_gabung($mat1, $mat2)
  { 
  $j_bar=count($mat1,0)+count($mat2,0);//-1;
  $kol = (count($mat1,1)/count($mat1,0))-1;
  $matriks_gabung=array();
  $ganti=0;
  for($brs=0;$brs<$j_bar;$brs++)
    {
    $matriks_gabung[$brs]=array();
    if($brs<count($mat1,0)){
        for($k=0;$k<$kol;$k++) 
            $matriks_gabung[$brs][$k]=$mat1[$brs][$k];
    	}
    else{
        for($k=0;$k<$kol;$k++) 
            $matriks_gabung[$brs][$k]=$mat2[$ganti][$k];
        $ganti++;
         }
    }//end for brs
    return $matriks_gabung;
} 	
 	
 	
 public function __destruct(){ }		
 	
}
?>


<?php
/*
echo "Execution of class Matriks <br>";
$y1 = array(0=>array(1,2,3,4),
	1=>array(5,6,7,8),
	2=>array(9,10,11,12)
	);
$bar=count($y1,0);
$kol=(count($y1,1)/count($y1,0))-1;	
$m1 = new Matriks($bar, $kol);
$m1->inputNilaiMatriks($y1);
$has1 = $m1->ambilMatriks();

echo " ********* mengambil satu baris dari matriks ********* <br>";
$m1->tampilMatriks();
echo "<br>";
$vBrs=$m1->ambilVektorBaris(1);
$objV=new Vektor(count($vBrs));
$objV->tampilObjectVektor($vBrs);
echo "<br>";
echo " ********* mengambil satu kolom dari matriks ********* <br>";
$vKlm=$m1->ambilVektorKolom(0);
$objV2=new Vektor(count($vKlm));
$objV2->tampilObjectVektor($vKlm);
echo "<br>";
//*/

/*
$y2 = array(0=>array(4,5,6,7),
	1=>array(8,9,10,11),
	2=>array(12,13,14,15)
	);
$m2 = new Matriks($y2);

$has2 = $m2->ambilMatriks();
$y3 = array(0=>array(2,1,3),
	1=>array(1,2,3),
	2=>array(2,1,2),
	3=>array(3,2,1)
	);
$m3 = new Matriks($y3);
$has2b = $m3->ambilMatriks();
echo "<br>";



*/

/*
echo " ********* mengganti suatu nilai dalam matriks ********* <br>";
$m1->tampilMatriks();
$ib = 0;
$jb = 0;
$nilB = 20;
$m1->ubahNilaiMatriks($ib, $jb, $nilB);
echo "elemen baris ke-$ib dan kolom ke-$jb berubah menjadi $nilB adalah <br>";
$m1->tampilMatriks();
$jb = 2;
$ambilNil = $m1->ambilNilaiMatriks($ib, $jb);
echo "ambil elemen baris ke-$ib dan kolom ke-$jb adalah $ambilNil<br>";
echo "<br>";
*/

/*
echo " ********* Penjumlahan 2 matriks ********* <br>";
$m1->tampilMatriks();
echo " + <br>";
$m2->tampilMatriks();
//echo "<br>";
echo " = <br>";
$has3 = $m2->jumlah2Matriks($has1, $has2);
$m2->tampilObjectMatriks($has3);
echo "<br>";
echo " ********* Pengurangan 2 matriks ********* <br>";
$m1->tampilMatriks();
echo " - <br>";
$m2->tampilMatriks();
echo " = <br>";
$has4 = $m2->kurang2Matriks($has1, $has2);
$m2->tampilObjectMatriks($has4);
echo "<br>";
echo " ********* Perkalian 2 matriks ********* <br>";
$m1->tampilMatriks();
echo " %*% <br>";
$m3->tampilMatriks();
echo " = <br>";
$has5 = $m2->kali2Matriks($has1, $has2b);
$m2->tampilObjectMatriks($has5);
echo "<br>";
echo " ********* Perkalian matriks dan skalar ********* <br>";
$c2 = 2;
$m1->tampilMatriks();
echo " * ".$c2;
echo " = <br>";
$has5b = $m2->kaliMatriksSkalar($has1, $c2);
$m2->tampilObjectMatriks($has5b);
echo "<br>";


echo " ********* Pembagian matriks dengan skalar ********* <br>";
$c3 = 2;
$m1->tampilMatriks();
echo " / ".$c3;
echo " = <br>";
$has5c = $m2->bagiMatriksSkalar($has1, $c3);
$m2->tampilObjectMatriks($has5c);
echo "<br>";

echo " ********* Perkalian per elemen 2 matriks ********* <br>";
$m1->tampilMatriks();
echo " * <br>";
$m2->tampilMatriks();
echo " = <br>";
$has6 = $m2->kaliPerElemen2Matriks($has1, $has2);
$m2->tampilObjectMatriks($has6);
echo "<br>";

echo " ********* Jumlahan dari semua elemen matriks ********* <br>";
$has7 = $m2->jlhElemenMatriks($has1);
//echo "nilai jumlahan dari semua elemen matriks <br \>";
$m1->tampilMatriks();
echo " = $has7";
echo "<br>";

echo "<br>";
echo " ********* Pengurangan matriks dengan konstanta ********* <br>";
$c4 = 6;
$m1->tampilMatriks();
echo " - ".$c4;
echo " = <br \>";
$has8 = $m2->kurangMatriksKonst($has1, $c4);
$m2->tampilObjectMatriks($has8);
echo "<br>";
//echo "<br>";
echo " ********* Kuadrat matriks ********* <br>";
$has9 = $m2->kuadratMatriks($has1);
//echo "Elemen kuadrat dari matriks ";
$m1->tampilMatriks();
echo " = <br \>";
$m2->tampilObjectMatriks($has9);
echo "<br>";
echo "<br>";

echo " ********* Hitung Mean matriks ********* <br>";
$has10 = $m2->hitungMean($has1);
echo "nilai mean dari matriks <br> ";
$m1->tampilMatriks();
echo " = $has10";
echo "<br>";
$has10b = $m2->hitungMean($has2);
echo "nilai mean dari matriks <br>";
$m2->tampilMatriks();
echo " = $has10b";
echo "<br>";
*/


/*
echo " ********* Operator dot 2 matriks ********* <br>";
$m1->tampilMatriks();
echo " . ";
$m2->tampilMatriks();
echo " = ";
$has6 = $m2->operatorDotMatriks($has1, $has2);
$m2->tampilObjectMatriks($has6);
echo "<br>";
echo "<br>";
$has7b = $m2->jlhMatriks($has2);
echo "nilai jumlahan dari elemen matriks ";
$m2->tampilMatriks();
echo " = $has7b";
echo "<br>";



echo "<br>";
echo " ********* Hitung varians ********* <br>";
$has11 = $m2->hitungvarians($has1);
echo "nilai varians dari matriks ";
$m1->tampilMatriks();
echo " = $has11";
echo "<br>";

//*/
?>

