<?php
/*
 	input  : satu baris string yang berisi angka 
 	output : string
 */
 
class BuatArray{    
  public function bersihString($inString){	
		//$p=strlen($inString);
		//$j=0;
		//for($ind=0;$ind<$p;$ind++){
		//	$temp=substr($inString,$ind,1);
		//	if($temp==" " || $temp=="\n" || $temp=="\t" || $temp=="\r") $j++;   
		//}
		//if($p!=$j) $text=$inString;
		//echo $text."<br />";   
		$inString = str_replace(" ","",$inString);
		$text = str_replace("\\","",$inString);
		$text = str_replace(","," ",$text);
		$text = str_replace("(","",$text);
		$text = str_replace(")","",$text);
	return $text;
   }
   
   //$data = $text;
	
/*
 	input  : satu baris string yang berisi angka 
 	output : berupa array satu dimensi
 */	
 public function buatVektorData($data){
	$data = BuatArray::bersihString($data);
	$p=strlen($data);
	$j=0;
	$angka=array();
	for($i=0;$i<$p;$i++){
		$temp=substr($data,$i,1);
		if($temp==" " || $temp=="\n" || $temp=="\t" || $temp=="\r") {
			if($j!=0) $angka[]=substr($data,$i-$j,$j);
				$j=0;;
			}
			else {
				$j++;
				if($i==$p-1) $angka[]=substr($data,$i-$j+1,$j);         
				}    
	}
	return $angka;
	}
  
  //$v = $angka;
  
  /*
	input 	: vektor v
	Output 	: -
	fungsi	: menampilkan vektor
 */	
 public function tampilVektorMixed($v){
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
  

  public function tampilVektor($v){
	//global $x, $n;
	//echo "nilai Vektor : (";
	$nb = count($v);
	//echo "(";
	for($i=0;$i<$nb;$i++){	
		   echo $v[$i]." ";	
		//if($i<$nb-1) echo $v[$i].", ";
		//		else 	echo $v[$i].") <br>";    
		}
	} 

	/*
		input  : nama String yang berisi data ANGKA 
				 ==> ((1,2,3,4),(5,6,7,8),(2,3,4,5))				
		output : berupa array satu dimensi
	*/
 public function pecahJadiBeberapaBaris($namaString){
	//echo "masuk pecahJadiBeberapaBaris <br />";
	$namaString = str_replace(" ","",$namaString);
	$namaString = substr($namaString,1,-1);//3,4,(1,2,3,4),(5,6,7,8),(2,3,4,5)
	
	//$namaS1=substr($namaString,0,4);// 3,4,
	//$baris = substr($namaS1,0,1);
	//$kolom = substr($namaS1,2,1);
	
	//$namaString=substr($namaString,4);// (1,2,3,4),(5,6,7,8),(2,3,4,5)
	
	$text=array();
  //$myfile = fopen($fileData, "r") or die("Unable to open file!");
  //$i=0;
 // while(!feof($myfile)) {
  //  $hasil=fgets($myfile); 
  
   //$namaString = $namaString.'$';
	$p=strlen($namaString);
	$j=0;
	for($ind=0;$ind<$p;$ind++){
      $temp1=substr($namaString,$ind,1);
	  $temp2=substr($namaString,$ind+1,1);
	  //echo "nilai ind : ".$ind.", temp1 : ".$temp1." dan temp2 : ".$temp2."<br />";
	  //echo ($temp1 == ')' && $temp2==',') ? 'true' : 'false';
	  //echo "<br />";
      //if($temp==" " || $temp=="\n" || $temp=="\t" || $temp=="\r") $j++;  
	  if(($temp1==')' && $temp2==',') || ($temp1==")" && $temp2=='')) {
		        //echo "nilai j : ".$j." dan nilai ind : ".$ind."<br />";
				$text[] = substr($namaString,$j,$ind-$j+1);
				$j = $ind + 2;
				}
    }
  // if($p!=$j) $text[]=$hasil; //$angka[]=substr($data,$i-$j+1,$j);
  //}
  //fclose($myfile);
  return $text;
 }
 /*
 	input  : string yang berisi data ANGKA 
 	output : berupa array dua dimensi
 */
 public function buatMatriksData($namaString){
   $mat=array();
   $matText=BuatArray::pecahJadiBeberapaBaris($namaString);
   //$size=
   $bar=count($matText);
   $kol=count(BuatArray::buatVektorData($matText[0]));
   $indeks=2;
   for($i=0;$i<$bar;$i++){
	   $mat[]=BuatArray::buatVektorData($matText[$i]);
   	//$mat[$i]=array();
   	//$v=BuatArray::buatVektorData($matText[$i]);
   	//for($j=0;$j<$kol;$j++){
   	//   $mat[$i][]=$v[$j];
  	//}
   }
   return $mat;	
 }

 public function tampilMatriks($objM){
	//echo "public function tampilObjectMatriks(objM)";
	$nb = count($objM,0);
	if($nb>0){
		$nk = (count($objM,1)/count($objM,0))-1;
		echo "\$nb : $nb  dan \$nk : $nk <br>";
		for($i=0;$i<$nb;$i++){
			for($j=0;$j<$nk;$j++){
				echo  $objM[$i][$j]." ";
				//echo "\$i : $i  dan \$j : $j <br>";		
			//printf("%8s",$objM[$i][$j]);
			//echo str_repeat("&nbsp;",5); 
			}
			echo " \n";
			 //print "<br>";		
			}   
		}
	} 
	
	public function tampilMatriksNBaris($objM, $n){
	//echo "public function tampilObjectMatriks($objM)";
	$nb = count($objM,0);
	$nk = (count($objM,1)/count($objM,0))-1;
	//echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$n;$i++){
	    for($j=0;$j<$nk;$j++){
			echo  $objM[$i][$j]." ";
	        //echo "\$i : $i  dan \$j : $j <br>";		
		//printf("%8s",$objM[$i][$j]);
		//echo str_repeat("&nbsp;",5); 
		}
		echo " \n";
	     //print "<br>";		
	    }   
	} 
	
	public function ambilSatuKolomMatriks($objM ,$k){
	//echo "public function ambilSatuKolomMatriks(objM)";
	/*
	$nb = 0;
	$nk = 0;
	foreach($objM as $key=>$val){
		$nb++;
		$vBar = $val;
		}	
	foreach($vBar as $key2=>$v){
			$nk++;
		}
	*/
	//print_r($vBar);

	//$nb = $nb/$nk;
	$nb = count($objM,0);
	$nk = (count($objM,1)/count($objM,0))-1;
	$vHas = array();
	echo "\$nb : $nb  dan \$nk : $nk <br>";
	for($i=0;$i<$nb;$i++){
		
	    //for($j=0;$j<$nk;$j++){
		$vHas[$i] = $objM[$i][$k];
	    //echo "\$i : $i  dan \$k : $k <br>";		
		//printf("%8s",$objM[$i][$k]);
		//echo str_repeat("&nbsp;",5); 
		//}
		//echo $vHas[$i]." \n";
	     //print "<br>";		
	    }  
		return $vHas;
	}

} // end of class

    
/*	
	//$inS = '1 2 3 4 5 6 7 8A B 9'; 
	//$inS = '(1, 2, 3, 4 ,5 ,6 ,7 ,8A, B ,9)';
	//$inS = ' ( 1 , 2 , 3 , 4 , 5 , 6 , 7 , 8A , B , 9 ) ';
	$inS = '((1,2,3,4),(5,6,7,8),(2,3,4,5))';		
	echo "input string : ".$inS."<br />";
	
	/*
	$inS=str_replace(" ","",$inS);
	echo "input string - spasi hilang : ".$inS."<br />";
	$inS=substr($inS,1,-1);
	echo "input string - awal akhir hilang : ".$inS."<br />";
	$inS1=substr($inS,0,4);
	echo "input string - awal 4 : ".$inS1."<br />";
    $baris = substr($inS,0,1);
	$kolom = substr($inS,2,1);
	echo "baris : ".$baris." dan kolom : ".$kolom."<br />";
	$inS2=substr($inS,4);
	echo "input string - awal 4 : ".$inS2."<br />";
	*/
/*	
	$ba1 = new BuatArray();
	$dataV = $ba1->buatVektorData($inS);
	echo "Hasil array 1 dimensi : ";
	$ba1->tampilVektor($dataV);
	echo " <br />";
	$nv = count($dataV);
	echo "dataV length : ".$nv." <br />";
	
	//$datapecah = $ba1->pecahJadiBeberapaBaris($inS);
	//echo "datapecah : <br />";
	//$ba1->tampilVektor($datapecah);
	
	$dataM = $ba1->buatMatriksData($inS);
	echo "matriks data : <br />";
	$ba1->tampilMatriks($dataM);
*/
?>