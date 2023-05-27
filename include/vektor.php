<?php

class Vektor{

 private $x = array();
 private $n;

 public function __construct(){ } 
 


 public function inputNilaiVektor($in){ 
	$this->n=count($in);
	for($i=0;$i<$this->n;$i++){
		$this->x[]=$in[$i];
	        }
        }
    
 public function ambilVektor(){ 
	//echo "public function ambilVektor() <br>";
	$has=array();
	//echo "nilai \$n : $this->n <br>";
	for($i=0;$i<$this->n;$i++){
		$has[]=$this->x[$i];		
	        }     
	return $has;        
        } 
		
 public function ambilIndeksVektor($labelB , $nil){   
         $has=0;
        // $sudah=1;
         foreach($labelB as $i){
             // if($sudah==1){
             //     if($i==$nil) {$sudah=0; break;}
                  if($i==$nil)  break;
                  $has++;
               //   }
            }
     return $has;
   }		
 
 /*
	input 	: vektor v
	Output 	: -
	fungsi	: menampilkan vektor
 */	
 public function tampilVektor($v){
	//echo "public function tampilObjectMatriks($objM)";
	$nb = count($v);
	//$nk = (count($v,1)/count($v,0))-1;;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    //for($j=0;$j<$nk;$j++){
	        //echo "\$i : $i  dan \$j : $j <br>";
	        if(is_integer($v[$i]) || is_string($v[$i]) ) printf("%8s",$v[$i]);
		     else printf("%1\$.2f",$v[$i]); //%f				        
		echo str_repeat("&nbsp;",2); 
		//}
	    // print "<br>";		
	    }  
	print "<br>";     
	} 
/*	   
 public function tampilVektor(){
	//global $x, $n;
	//echo "nilai Vektor : (";
	echo "(";
	for($i=0;$i<$this->n;$i++){		
		if($i<$this->n -1) echo $this->x[$i].", ";
				else 	echo $this->x[$i].") <br>";    
		}
	}  

 public function tampilObjectVektor($objV){
	//global $x, $n;
	echo "nilai Vektor : (";
	$nx=count($objV);
	//echo "nilai \$nx : $nx";
	for($i=0;$i<$nx;$i++){
	        if($i<$nx - 1) echo $objV[$i].", ";
		        else 	echo $objV[$i].")";  
	        }
	//echo "<br>";    
	} 	
*/
	 
 public function jumlah2Vektor($x1, $x2){
 	$hasil = array();
 	$nx=count($x1);
	for($i=0;$i<$nx;$i++){
		$hasil[]=$x1[$i]+$x2[$i];
	        }
	return $hasil;        
 	}	
/*
	input 	: 2 vektor data --> v1 dab v2
	Output 	: vektor hasil pengurangan v1-v2
	fungsi	: menghitung nilai pengurangan antara 2 vektor 
 */	 
  public function kurang2Vektor($x1, $x2){
 	$hasil2 = array();
 	$nx=count($x1);
	for($i=0;$i<$nx;$i++){
		$hasil2[]=$x1[$i]-$x2[$i];
	        }
	return $hasil2;        
 	}
 /*
	input 	: 2 vektor data --> v1 dab v2
	Output 	: vektor gabungan v1 dan v2
	fungsi	: menggabungkan nilai-nilai 2 vektor 
 */	 
  public function gabung2Vektor($x1, $x2){
 	$hasil2 = array();
 	$nx1=count($x1);
 	$nx2=count($x2);
	for($i=0;$i<$nx1+$nx2;$i++){
		if($i<$nx1)$hasil2[]=$x1[$i];
		  else $hasil2[]=$x2[$i-$nx1];
	        }
	return $hasil2;        
 	}
 
 /*
	input 	: vektor data
	Output 	: nilai dari jumlahan semua elemen vektor
	fungsi	: menghitung nilai dari jumlahan semua elemen vektor
 */	
  public function jlhVektor($x1){
 	$hasil=0;
 	$nx=count($x1);
	for($i=0;$i<$nx;$i++){
		$hasil += $x1[$i];
	        }
	return $hasil;        
 	} 	 

 public function kaliVektorSkalar($x1, $x2){
 	$hasil3 = array();
 	$nx=count($x1);
	for($i=0;$i<$nx;$i++){
		$hasil3[]=$x1[$i]*$x2;
	        }
	return $hasil3;        
 	}

 public function bagiVektorSkalar($x1, $x2){
 	$hasil4 = array();
 	$nx=count($x1);
	for($i=0;$i<$nx;$i++){
		$hasil4[]=$x1[$i]/$x2;
	        }
	return $hasil4;        
 	} 		 

 public function operatorDotVektor($x1, $x2){
 	$hasil5 = array();
 	$nx=count($x1);
	for($i=0;$i<$nx;$i++){
		$hasil5[]=$x1[$i]*$x2[$i];
	        }
	return $hasil5;        
 	}
 		

 public function kurangVektorKonst($x1, $x2){
 	$hasil7 = array();
 	$nx=count($x1);
	for($i=0;$i<$nx;$i++){
		$hasil7[]=$x1[$i]-$x2;
	        }
	return $hasil7;        
 	}

 /*
	input 	: vektor data
	Output 	: vektor yang merupakan kuadrat dari elemen vektor data
	fungsi	: menghitung nilai kuadrat per elemen suatu vektor
 */	
  public function kuadratVektor($x1){
 	$hasil8 = array();
 	$nx=count($x1);
	for($i=0;$i<$nx;$i++){
		$hasil8[] = $x1[$i]*$x1[$i];
	        }
	return $hasil8;        
 	} 	
 /*
	input 	: vektor data
	Output 	: nilai rata-rata semua elemen vektor
	fungsi	: menghitung nilai rata-rata semua elemen vektor
 */	
 // public function rataVektor($x1){
 //	$n=count($x1);	
 //	return TopsisFuzzy::jlhVektor($x1)/$n;        
 //	} 
 	
 public function hitungMean($x1){
        //$jv = Vektor::jlhVektor($x1);
        //echo "jlh vektor : $jv \n";
        //$nx=count($x1);
        //echo "nilai n : $nx <br>";
        //$hasil9 = $jv/$nx;
 	$hasil9 = Vektor::jlhVektor($x1)/count($x1);		
	return $hasil9;        
 	} 	

 public function hitungVarians($x1){
        $hm = Vektor::hitungMean($x1);
        $kvk = Vektor::kurangVektorKonst($x1, $hm);
        $kv = Vektor::kuadratVektor($kvk);
        $jv = Vektor::jlhVektor($kv);
 	$hasil10 = $jv/(count($x1)-1);		
	return $hasil10;        
 	}  
 
  /*
	input 	: vektor data dan k -> banyaknya elemen yang diambil 
	Output 	: vektor yang berisi k elemen dari vektor data
	fungsi	: mengambil vektor dari suatu vektor (k elemen pertama)
 */
  public function ambilVektorDariVektor($v,$k){
 	//$bar=count($v);
	$vhas = array();		
   	for($i=0;$i<$k;$i++){
   	   	$vhas[]=$v[$i];	
   		}
   	return $vhas;
 	}   	
  /*
	input 	: vektor data dan  k -> banyaknya elemen yang dibuang
	Output 	: vektor yang berisi k elemen dari vektor data
	fungsi	: menghilangkan vektor dari suatu vektor (k elemen pertama)
 */
  public function hilangVektorDariVektor($v,$k){
 	$bar=count($v);
	$vhas = array();		
   	for($i=$k;$i<$bar;$i++){
   	   	$vhas[]=$v[$i];	
   		}
   	return $vhas;
 	}   		
 /*
	input 	: matriks data dan kolom ke-k
	Output 	: vektor yang berisi kolom ke-k dari matriks data
	fungsi	: mengambil vektor kolom dari suatu matriks
 */
  public function ambilKolom($mat,$k){
 	$bar=count($mat);
	$vhas = array();		
   	for($i=0;$i<$bar;$i++){
   	   	$vhas[]=$mat[$i][$k];	
   		}
   	return $vhas;
 	}
 /*
	input 	: matriks data dan baris ke-b
	Output 	: vektor yang berisi baris ke-b dari matriks data
	fungsi	: mengambil vektor baris dari suatu matriks
 */	
  public function ambilBaris($mat,$b){
 	$kol=(count($mat,1)/count($mat,0))-1;
	$vhas = array();		
   	for($i=0;$i<$kol;$i++){
   	   	$vhas[]=$mat[$b][$i];	
   		}
   	return $vhas;
 	}
 /*
	input 	: vektor data
	Output 	: nilai maksimum
	fungsi	: untuk mendapatkan nilai maksimum di suatu vektor data
 */
  public function hitungMax($v){
 	$bar=count($v);
	$has=$v[0];		
   	for($i=1;$i<$bar;$i++){
   	   	if($has<$v[$i]) $has=$v[$i];	
   		}
   	return $has;
 	}
 /*
	input 	: $n --> nilai skalar
	Output 	: nilai mutlak
	fungsi	: untuk mendapatkan nilai mutlak suatu skalar
 */	
  public function hitungNilaiAbsolut($n){
 	if($n<0) $n = -$n; 
   	return $n;
 	}
/*
	input 	: vektor data
	Output 	: nilai minimum
	fungsi	: untuk mendapatkan nilai minimum di suatu vektor data
 */	
  public function hitungMin($v){
 	$bar=count($v);
	$has=$v[0];		
   	for($i=1;$i<$bar;$i++){
   	   	if($has>$v[$i]) $has=$v[$i];	
   		}
   	return $has;
 	}
 			
 /*
	input 	: vektor data
	Output 	: vektor yang sudah terurut dari kecil ke besar
	fungsi	: mengurutkan elemen-elemen vektor dari kecil ke besar
 */
 public function sortVektorAsc($vSort){
        $uk=count($vSort);
        for($i=0;$i<$uk-1;$i++){
            for($j=$i;$j<$uk;$j++){
              if($vSort[$i]>$vSort[$j]) {
                  $kerja=$vSort[$i];
                  $vSort[$i]=$vSort[$j];
                  $vSort[$j]=$kerja;
                }
            }
        }
        return $vSort;
     }	
 /*
	input 	: vektor data
	Output 	: vektor yang sudah terurut dari besar ke kecil
	fungsi	: mengurutkan elemen-elemen vektor dari besar ke kecil
 */
 public function sortVektorDesc($vSort){
        $uk=count($vSort);
        for($i=0;$i<$uk-1;$i++){
            for($j=$i;$j<$uk;$j++){
              if($vSort[$i]<$vSort[$j]) {
                  $kerja=$vSort[$i];
                  $vSort[$i]=$vSort[$j];
                  $vSort[$j]=$kerja;
                }
            }
        }
        return $vSort;
     }	
 /*
	input 	: vektor data
	Output 	: vektor yang berisi indeks dari vektor terurut dari besar ke kecil
	fungsi	: mengambil indeks dari elemen-elemen vektor dari besar ke kecil
 */
 public function ambilIndeksVektorDesc($v){
        $uk=count($v);
        $vIndeks=array();
        for($i=0;$i<$uk;$i++){
            $vIndeks[]=$i;
        }
        for($i=0;$i<$uk-1;$i++){
            for($j=$i;$j<$uk;$j++){
              if($v[$i]<$v[$j]) {
                  $kerja=$v[$i];
                  $v[$i]=$v[$j];
                  $v[$j]=$kerja;
                  $kerja2=$vIndeks[$i];
                  $vIndeks[$i]=$vIndeks[$j];
                  $vIndeks[$j]=$kerja2;
                }
            }
        }
        return $vIndeks;
     }		
  /*
	input 	: vektor data
	Output 	: vektor yang berisi indeks dari vektor terurut dari besar ke kecil
	fungsi	: mengambil indeks dari elemen-elemen vektor dari kecil ke besar
 */
 public function ambilIndeksVektorAsc($v){
        $uk=count($v);
        $vIndeks=array();
        for($i=0;$i<$uk;$i++){
            $vIndeks[]=$i;
        }
        for($i=0;$i<$uk-1;$i++){
            for($j=$i;$j<$uk;$j++){
              if($v[$i]>$v[$j]) {
                  $kerja=$v[$i];
                  $v[$i]=$v[$j];
                  $v[$j]=$kerja;
                  $kerja2=$vIndeks[$i];
                  $vIndeks[$i]=$vIndeks[$j];
                  $vIndeks[$j]=$kerja2;
                }
            }
        }
        return $vIndeks;
     }    

  /* ###################################################################################### 
  	TAMPIL VEKTOR DAN MATRIKS
  */ ######################################################################################




	
 /*
	input 	: matriks 
	Output 	: -
	fungsi	: menampilkan matriks
 */	
 public function tampilMatriks($objM){
	//echo "public function tampilObjectMatriks($objM)";
	$nb = count($objM,0);
	$nk = (count($objM,1)/count($objM,0))-1;;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    for($j=0;$j<$nk;$j++){
	        //echo "\$i : $i  dan \$j : $j <br>";		
		printf("%8s",$objM[$i][$j]);
		echo str_repeat("&nbsp;",4); 
		}
	     print "<br>";		
	    }   
	} 

  public function tampilMatriksRapi($objM){
	//echo "public function tampilObjectMatriks($objM)";
	$nb = count($objM,0);
	$nk = (count($objM,1)/count($objM,0))-1;;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
	    for($j=0;$j<$nk;$j++){
	        //echo "\$i : $i  dan \$j : $j <br>";	// %1\$.2f	        	
		if(is_numeric($objM[$i][$j])) printf("%1\$.2f",$objM[$i][$j]); //%f
		     else printf("%8s",$objM[$i][$j]);
		echo str_repeat("&nbsp;",3); 
		}
	     print "<br>";		
	    }   
	} 
	
  public function tampilMatriksIndeksStringRapi($objM, $label){
	//echo "public function tampilObjectMatriks($objM)";
	$nb = count($objM,0);
	$nk = (count($objM,1)/count($objM,0))-1;;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	//for($i=0;$i<$nb;$i++){
	foreach($label as $i){
	    printf("%8s",$i);
	    echo str_repeat("&nbsp;",5);
	    for($j=0;$j<$nk;$j++){
	        //echo "\$i : $i  dan \$j : $j <br>";	// %1\$.2f	        	
		if(is_numeric($objM[$i][$j])) printf("%1\$.2f",$objM[$i][$j]); //%f
		     else printf("%8s",$objM[$i][$j]);
		echo str_repeat("&nbsp;",3); 
		}
	     print "<br>";		
	    }   
	} 	
  	
  // ######################################################################################	
  public function __destruct(){ }   

 }
?>
