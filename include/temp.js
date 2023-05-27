
untuk slot jika ada mata kuliah yang sudah terjadwal
1. dipisah antara MK terjadwal dan MK belum 
2. MK terjadwal dikodekan (mulai dari 0 sesuai indeks) sesuai indeks dari 
	tabel matRuangUjian , matLabkomUjian dan matHariUjian 
	terdiri dari | no | no indeks ruang | no indeks hari | no indeks jam | no indeks MK |
	untuk teori ==> mkTeoriUjianTerjadwal 
	untuk praktek ==> mkPraktekUjianTerjadwal	
3. buatMatSlotRHJ : function(jruang,jhari,jam,matHariUjian) diubah menjadi 
	buatMatSlotRHJ : function(jruang,jhari,jam,matHariUjian, mkUjianTerjadwal)
	
buatMatSlotRHJ : function(jruang,jhari,jam,matHariUjian, mkUjianTerjadwal){
	 var mSlot = OperasiMatriks.isiAwalMatriks(jruang*jhari*jam , 6);
     var indeks = 0, nS = jruang*jhari*jam;
     for(var k=0;k<jruang;k++){
       for(var i=0;i<jhari;i++){   
			var hJum = matHariUjian[i][1]; // hari05
            for(var j=0;j<jam;j++) {                  
						//arr3dim[k][i][j] = ind[indeks];
						mSlot[indeks][0] = indeks ;
						mSlot[indeks][1] = k;
						mSlot[indeks][2] = i;
						mSlot[indeks][3] = j;
						//if((i+1)%5==0 && j==3) mSlot[indeks][4] = "-"; // untuk hari jumat jam ke-(5-6) kosong
						if(hJum == "hari05" && j==3) mSlot[indeks][4] = "-";											   // ditandai dengan "-"
						mSlot[indeks][5] = "-";
						indeks++;						
                }
            }
        }
		var nBar = mSlot.length, ims, imkj; // ims - indeks mSlot dan imkj - indeks MK terjadwal
		var nBarMK = mkUjianTerjadwal.length;
		for(var i=0;i<nBar;i++){ 
			ims = mSlot[i][1]+""+mSlot[i][2]+""+mSlot[i][3];
			for(var j=0;j<nBarMK;j++) { 
				imkj = mkUjianTerjadwal[j][1]+""+mkUjianTerjadwal[j][2]+""+mkUjianTerjadwal[j][3];
				if(ims.replace(/\s/g, '') == imkj.replace(/\s/g, '')) mSlot[i][4] = "*";
			}
		}
      return mSlot;          
   },
	
4. buatMatSlotIsiRHJ : function(vInd, mSlot, kp)  diubah menjadi
	buatMatSlotIsiRHJ : function(vInd, mSlot, kp, mkUjianTerjadwal)

buatMatSlotIsiRHJ : function(vInd, mSlot, kp, mkUjianTerjadwal){
	 //var mSlot = this.buatMatSlotRHJ(jruang,jhari,jam);
     var bar= mSlot.length, puter = 0, minStar;
     for(var i=0;i<bar;i++){ 
			mSlot[i][5] = kp;
			minStar = mSlot[i][4];
			if(minStar != "-" || minStar != "*") {
				mSlot[i][4] = vInd[puter];
				puter++;
			}
        }  
		var nBar = mSlot.length, ims, imkj; // ims - indeks mSlot dan imkj - indeks MK terjadwal
		var nBarMK = mkUjianTerjadwal.length;
		for(var i=0;i<nBar;i++){ 
			if(mSlot[i][4] == "*") {
				ims = mSlot[i][1]+""+mSlot[i][2]+""+mSlot[i][3];
				for(var j=0;j<nBarMK;j++) { 
					imkj = mkUjianTerjadwal[j][1]+""+mkUjianTerjadwal[j][2]+""+mkUjianTerjadwal[j][3];
					if(ims.replace(/\s/g, '') == imkj.replace(/\s/g, '')) 
						mSlot[i][4] = mkUjianTerjadwal[j][4];
				} 
					
			}
		}
      return mSlot;          
   },
	
	
	
	
	
	
	
buatMatSlotRHJ : function(jruang,jhari,jam,matHariUjian){
	 var mSlot = OperasiMatriks.isiAwalMatriks(jruang*jhari*jam , 6);
     var indeks = 0, nS = jruang*jhari*jam;
     for(var k=0;k<jruang;k++){
       for(var i=0;i<jhari;i++){   
			var hJum = matHariUjian[i][1]; // hari05
            for(var j=0;j<jam;j++) {                  
						//arr3dim[k][i][j] = ind[indeks];
						mSlot[indeks][0] = indeks ;
						mSlot[indeks][1] = k;
						mSlot[indeks][2] = i;
						mSlot[indeks][3] = j;
						//if((i+1)%5==0 && j==3) mSlot[indeks][4] = "-"; // untuk hari jumat jam ke-(5-6) kosong
						if(hJum == "hari05" && j==3) mSlot[indeks][4] = "-";											   // ditandai dengan "-"
						mSlot[indeks][5] = "-";
						indeks++;						
                }
            }
        }    
      return mSlot;          
   },
   /*
		vInd => 
		jruang => 
		jhari => 
		jam => 
		kp => 
   */
   buatMatSlotIsiRHJ : function(vInd, mSlot, kp){
	 //var mSlot = this.buatMatSlotRHJ(jruang,jhari,jam);
     var bar= mSlot.length, puter = 0;
     for(var i=0;i<bar;i++){ 
			mSlot[i][5] = kp;
			if(mSlot[i][4] != "-") {
				mSlot[i][4] = vInd[puter];
				puter++;
			}
        }    
      return mSlot;          
   }, 