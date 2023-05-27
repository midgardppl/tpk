//####################################################################################
//			PsoScheduling
//####################################################################################
var PsoScheduling = {
/*
   generate individu ==> contoh
   ruang (3) :  0  0  0  0  0  0  1  1  1  1   1   1   2   2   2   2   2  2
   hari	(2)  :  0  0  0  1  1  1  0  0  0  1   1   1   0   0   0   1   1  1  
   jam(3 )   :  0  1  2  0  1  2  0  1  2  0   1   2   0   1   2   0   1  2
   gen		 :  0  1  2  3  4  5  6  7  8  9  10   11 12  13  14  15  16  17
   3*2*3 = 18 (0 - 17)  
*/
	generateIndBulat : function(nSlot){ //nGen = nSlot
		var vtemp = this.generateIndRiil(nSlot);
		//OperasiVektor.tampilVektorRiil(vtemp);
		var vInd = OperasiVektor.ambilIndeksVektorSortAsc(vtemp);
		return vInd;
	},
	generateIndRiil : function(nSlot){ //nGen = nSlot
		var vInd = OperasiVektor.isiAwal(nSlot);
		for(var i=0;i<nSlot;i++) vInd[i] = (Math.random()*nSlot)+1;
		return vInd;
	},
	ubahEncodingRiilKeBulat : function(v1){
		//var vtemp = this.generateIndRiil(nGen);
		//OperasiVektor.tampilVektorRiil(vtemp);
		var vtemp = OperasiVektor.ambilIndeksVektorSortAsc(v1);
		var vInd = OperasiVektor.ambilIndeksVektorSortAsc(vtemp);
		return vInd;
	},
	/*
		generate vektor --> dari -nilMax s.d. nilMax
	*/
	generateVektorRiil : function(n, nilMin, nilMax){ //n
		var vInd = OperasiVektor.isiAwal(n);
		for(var i=0;i<n;i++) vInd[i] = nilMin + (nilMax-nilMin)*Math.random();
		return vInd;
	},
	/*
		generate vektor neigborhood --> vektor baru yang jaraknya dengan
		vektor lama < epsilon		
	*/
	generateVektorNeigborhood : function(v1, epsilon){	
//document.write("===== v1 asal : ");
//OperasiVektor.tampilVektorRiil(v1);document.write("<br />");		
		var nV1 = v1.length, sum=0, nil;
		//var vUnif = Array();
		var vHas = Array();
		//do{
			var vUnif =this.generateIndRiil(nV1);
			//for(var i=0;i<nV1;i++) {nil = (Math.random()*nV1)+1; vUnif[i] = nil; sum+=nil;}
			for(var i=0;i<nV1;i++)  vHas[i] = v1[i]+vUnif[i]*epsilon;		
		//}while(OperasiVektor.jarakEuclide(v1,vUnif) < epsilon);
//document.write("===== vHas : ");
//OperasiVektor.tampilVektorRiil(vHas);document.write("<br />");		
		return vHas;
		},
	/*
		generate Velocity
		nInd ==> banyaknya individu/partikel 
		nSlot ==> banyaknya slot yang tersedia
	*/
	generateVelocity : function(nInd,nSlot, nilMin,nilMax){
		var matP = new Array(nInd);
		for(var i=0;i<nInd;i++){
			matP[i] = this.generateVektorRiil(nSlot, nilMin, nilMax);
		}
		return matP;
	},
	/*
		generate populasi 
		nInd ==> banyaknya individu/partikel 
		nSlot ==> banyaknya slot yang tersedia
	*/
	generatePop : function(nInd,nSlot,nilMin,nilMax){
		var matPop = new Array(nInd);
		for(var i=0;i<nInd;i++){
			matPop[i] = this.generateVektorRiil(nSlot,nilMin,nilMax);
		}
		return matPop;
	},
	
	ubahPopKeBulat : function(matPop){
		var nInd = matPop.length;
		var matPopBulat = new Array(nInd);
		for(var i=0;i<nInd;i++){
			matPopBulat[i] = this.ubahEncodingRiilKeBulat(matPop[i]);
		}
		return matPopBulat;
	},
	 /*
	*****************************************************************
	  LOCAL BEST DAN GLOBAL BEST UJIAN GABUNGAN TEORI DAN PRAKTIKUM
	*****************************************************************		

		Matriks Local Best dan vektor nilai Local Best
		matriks ==> nInd x (nSlot+1)
					kolom terakhir nilai localBest-nya
	*/
	hitMatriksDanNilaiLocalBestUjian : function(matSlot,matSlotP,matPopT, matPopP,matRuangUjian, matLabkomUjian,mkJalanTeoriUjian,mkJalanPraktekUjian,maxDosenUjian, maxPegawaiUjian,maxJaga,maxUjian){
		var np = matPopT.length;		
		var matLocalBest = new Array(np);
		//var vNilaiLB = [];
		//var nLB = 0;
		for(var i=0 ;i<np ;i++){ // matSlotIsi, matSlotIsiP
			var vRiilT = OperasiMatriks.ambilVektorBaris(matPopT, i);			
			//var vIndT = this.ubahEncodingRiilKeBulat(vRiilT);
			//var matSlotIsi = this.buatMatSlotIsiRHJ(vIndT,matSlot, "k");
			
			var vRiilP = OperasiMatriks.ambilVektorBaris(matPopP, i);			
			//var vIndP = this.ubahEncodingRiilKeBulat(vRiilP);			
			//var matSlotIsiP = this.buatMatSlotIsiRHJ(vIndP,matSlotP, "p");
			
			//var vRiilTnP = OperasiVektor.gabung2Vektor(vRiilT,vRiilP);
			//var nilFitness = this.hitFitnessUjian(matSlotIsi, matSlotIsiP,matRuangUjian, matLabkomUjian,mkJalanTeoriUjian,mkJalanPraktekUjian,maxDosenUjian, maxPegawaiUjian,maxJaga,maxUjian);
			//vRiilTnP.push(nilFitness);
			matLocalBest[i] = this.hitVektorDanNilaiLocalBestUjian(matSlot,matSlotP,vRiilT, vRiilP,matRuangUjian, matLabkomUjian,mkJalanTeoriUjian,mkJalanPraktekUjian,maxDosenUjian, maxPegawaiUjian,maxJaga,maxUjian);
			}
//document.write("==== vRiilTnP.length : "+vRiilTnP.length+", nKol: "+nKol+"<br />");
//document.write("==== matLocalBest.length : "+matLocalBest[0].length+"<br />");	
		//var nKol = matLocalBest[0].length;
		//var matLocalBestSort = OperasiMatriks.sortMatriksKolom(matLocalBest,nKol-1);	
		return matLocalBest;		
	},
	hitVektorDanNilaiLocalBestUjian : function(matSlot,matSlotP,vRiilT, vRiilP,matRuangUjian, matLabkomUjian,mkJalanTeoriUjian,mkJalanPraktekUjian,maxDosenUjian, maxPegawaiUjian,maxJaga,maxUjian){				
		var vIndT = this.ubahEncodingRiilKeBulat(vRiilT);
		var matSlotIsi = this.buatMatSlotIsiRHJ(vIndT,matSlot, "k");
					
		var vIndP = this.ubahEncodingRiilKeBulat(vRiilP);			
		var matSlotIsiP = this.buatMatSlotIsiRHJ(vIndP,matSlotP, "p");
			
		var vRiilTnP = OperasiVektor.gabung2Vektor(vRiilT,vRiilP);
		var nilFitness = this.hitFitnessUjian(matSlotIsi, matSlotIsiP,matRuangUjian, matLabkomUjian,mkJalanTeoriUjian,mkJalanPraktekUjian,maxDosenUjian, maxPegawaiUjian,maxJaga,maxUjian);
		vRiilTnP.push(nilFitness);
		
		return vRiilTnP;		
	},
	hitFitnessUjian : function(matSlotIsi, matSlotIsiP,matRuangUjian, matLabkomUjian,mkJalanTeoriUjian,mkJalanPraktekUjian,maxDosenUjian, maxPegawaiUjian,maxJaga,maxUjian){
		
		var mPinaltiRuangGabung = this.hitPinaltiRuangUjianGabung(matSlotIsi, matSlotIsiP,matRuangUjian, matLabkomUjian,mkJalanTeoriUjian, mkJalanPraktekUjian);				
		var nilPinaltiRGabung = mPinaltiRuangGabung[1][mPinaltiRuangGabung[0].length - 1];	
	//var mPinaltiRuangGabungHas = OperasiMatriks.hilangKolomAkhirMatriks(mPinaltiRuangGabung);

		var mPinaltiDosenGabung = this.hitPinaltiDosenUjianGabung(matSlotIsi,matSlotIsiP, mkJalanTeoriUjian, mkJalanPraktekUjian,maxDosenUjian);		
		var nilPinaltiDGabung = mPinaltiDosenGabung[0][mPinaltiDosenGabung[0].length - 1];	
	//var mPinaltiDosenGabungHas = OperasiMatriks.hilangKolomAkhirMatriks(mPinaltiDosenGabung);

		var mPinaltiPegawai = this.hitPinaltiPegawaiUjian(matSlotIsi, mkJalanTeoriUjian, maxPegawaiUjian);		
		var nilPinaltiPeg = mPinaltiPegawai[0][mPinaltiPegawai[0].length - 1];	
	//var mPinaltiPegawaiHas = OperasiMatriks.hilangKolomAkhirMatriks(mPinaltiPegawai);

		var mPinaltiDosenMaxUjianGabung = this.hitPinaltiDosenMaxUjianGabung(matSlotIsi,matSlotIsiP, mkJalanTeoriUjian, mkJalanPraktekUjian,maxDosenUjian, maxJaga);		
		var nilPinaltiDMaxUjianGabung = mPinaltiDosenMaxUjianGabung[0][mPinaltiDosenMaxUjianGabung[0].length - 1];	
	//var mPinaltiDosenHasMaxUjianGabung = OperasiMatriks.hilangKolomAkhirMatriks(mPinaltiDosenMaxUjianGabung);

		var mPinaltiMhsUjianGabung = this.hitPinaltiMhsUjianGabung(matSlotIsi,matSlotIsiP, mkJalanTeoriUjian, mkJalanPraktekUjian,maxUjian);		
		var nilPinaltiMUjianGabung = mPinaltiMhsUjianGabung[0][mPinaltiMhsUjianGabung[0].length - 1];	
	//var mPinaltiMhsHasUjianGabung = OperasiMatriks.hilangKolomAkhirMatriks(mPinaltiMhsUjianGabung);

		var mPinaltiMhsMaxUjianGabung = this.hitPinaltiMhsMaxUjianGabung(matSlotIsi,matSlotIsiP, mkJalanTeoriUjian,mkJalanPraktekUjian,maxUjian );		
		var nilPinaltiMMaxUjianGabung = mPinaltiMhsMaxUjianGabung[0][mPinaltiMhsMaxUjianGabung[0].length - 1];
	//var mPinaltiMhsHasMaxUjianGabung = OperasiMatriks.hilangKolomAkhirMatriks(mPinaltiMhsMaxUjianGabung);
	
		var nilFit = 1/(1+ nilPinaltiRGabung + nilPinaltiDGabung + nilPinaltiPeg + nilPinaltiDMaxUjianGabung + nilPinaltiMUjianGabung +nilPinaltiMMaxUjianGabung);			
		return nilFit;
	},
	/*
		ambil vektor kode individu teori
	*/
	ambilKodeIntBest : function(vekt , nSlotT, nSlotP, kp){
		var vHas = Array();
		var vWork = OperasiVektor.hilangElemenAkhirVektor(vekt);
		if(kp == "k"){
			for(var i=0; i< nSlotT; i++) vHas[i] = vWork[i];
		}else {
			for(var i=0; i< nSlotP; i++) vHas[i] = vWork[i+nSlotT];
		}
//document.write("vHas : ");
//OperasiVektor.tampilVektor(vHas);document.write("<br />");	
		
		var vHas2 = this.ubahEncodingRiilKeBulat(vHas);
//document.write("vHas2 : ");
//OperasiVektor.tampilVektor(vHas2);document.write("<br />");		
		return vHas2;
	},
	/*
		buat Mat Slot Final
	*/
	buatMatSlotFinal : function(matSlotIsi,matSlotIsiP, mkJalanTeoriUjian, mkJalanPraktekUjian,nilFitBest,kdthnajaran, kdsemester, kdmasaujian,kdjadwal){
		var nBarT = matSlotIsi.length;
		var nBarP = matSlotIsiP.length;
		var nKol = matSlotIsi[0].length;
		var nBarMKT = mkJalanTeoriUjian.length;
		var nBarMKP = mkJalanPraktekUjian.length;
		var nKolMK = mkJalanTeoriUjian[0].length;
//document.write("=== nBarMKP : "+nBarMKP+" dan nBarMKT : "+nBarMKT+" <br />");
//document.write("=== nBarT : "+nBarT+" dan nBarP : "+nBarP+" <br />");		
		var mNolT = OperasiMatriks.isiAwalMatriks(nBarT ,nKolMK+4);
		var mNolP = OperasiMatriks.isiAwalMatriks(nBarP ,nKolMK+4);		
		var iMK;
		for(var i=0 ;i<nBarT ;i++){
//document.write("=== i : "+i+", nBarT : "+nBarT+" dan nBarMKT : "+nBarMKT+" <br />");			
			iMK = matSlotIsi[i][4];
			if( iMK < nBarMKT ) {
//document.write("===== i : "+i+" dan matSlotIsi[i][4] : "+matSlotIsi[i][4]+" <br />");				
				var vTemp = Array();			
				for(var j=0 ;j<nKolMK-1 ;j++) {
//document.write("===== mkJalanTeoriUjian[i][j] : "+mkJalanTeoriUjian[iMK][j]+" <br />");					
					vTemp[j] = mkJalanTeoriUjian[iMK][j];
				}
				vTemp[nKolMK-1] = kdthnajaran;
				vTemp[nKolMK] = kdsemester;
				vTemp[nKolMK+1] = kdmasaujian;
				vTemp[nKolMK+2] = nilFitBest;
				vTemp[nKolMK+3] = kdjadwal; // tambahan
				mNolT[i] = vTemp;				
			} else {
				mNolT[i][nKolMK-1] = kdthnajaran;
				mNolT[i][nKolMK] = kdsemester;
				mNolT[i][nKolMK+1] = kdmasaujian;
				mNolT[i][nKolMK+2] = nilFitBest;			
				mNolT[i][nKolMK+3] = kdjadwal; // tambahan
					}
		}
		for(var i=0 ;i<nBarP ;i++){
			iMK = matSlotIsiP[i][4];
			if(iMK < nBarMKP ) {
				var vTemp = Array();
				for(var j=0 ;j<nKolMK-1 ;j++) vTemp[j] = mkJalanPraktekUjian[iMK][j];
				vTemp[nKolMK-1] = kdthnajaran;
				vTemp[nKolMK] = kdsemester;
				vTemp[nKolMK+1] = kdmasaujian;
				vTemp[nKolMK+2] = nilFitBest;	
				vTemp[nKolMK+3] = kdjadwal; // tambahan				
				mNolP[i] = vTemp;				
			} else {
				mNolP[i][nKolMK-1] = kdthnajaran;
				mNolP[i][nKolMK] = kdsemester;
				mNolP[i][nKolMK+1] = kdmasaujian;
				mNolP[i][nKolMK+2] = nilFitBest;
				mNolP[i][nKolMK+3] = kdjadwal; // tambahan
					}
		}	
		var mHasT = OperasiMatriks.gabung2MatriksKolom(matSlotIsi ,mNolT);
		var mHasP = OperasiMatriks.gabung2MatriksKolom(matSlotIsiP ,mNolP);
	/*	
	document.write("buatMatSlotFinal --- mHasT : <br />");
	OperasiMatriks.tampilMatriksString(mHasT);document.write("<br />");		
	document.write("buatMatSlotFinal --- mHasP : <br />");
	OperasiMatriks.tampilMatriksString(mHasP);document.write("<br />");		
	//*/
		var mHas = OperasiMatriks.gabung2MatriksBaris(mHasT ,mHasP);
		return mHas;				
	},
	
	
	/* 
	===============================================================
				LOCAL BEST DAN GLOBAL BEST UNTUK KULIAH
	===============================================================	
		Matriks Local Best dan vektor nilai Local Best
		matriks ==> nInd x (nSlot+1)
					kolom terakhir nilai localBest-nya
	*/
	hitMatriksDanNilaiLocalBest : function(matPop, matRuang, matMkJalan, maxDosen, maxNgajar, jruang, jhari, jam){
		var np = matPop.length;
		//var nKol = matPop[0].length;
		var matLocalBest = new Array(np);
		var vNilaiLB = [];
		var nLB = 0;
		for(var i=0 ;i<np ;i++){
			var vRiil = OperasiMatriks.ambilVektorBaris(matPop, i);
			var vInd = this.ubahEncodingRiilKeBulat(vRiil);
			var nilFitness = this.hitFitness(vInd, matRuang, matMkJalan, maxDosen, maxNgajar, jruang, jhari, jam);
			vRiil.push(nilFitness);
			matLocalBest[i] = vRiil;
			}
		//var matLocalBestSort = OperasiMatriks.sortMatriksKolom(matLocalBest,nKol);	
		return matLocalBest;		
	},
	hitFitness : function(vInd, matRuang, matMkJalan, maxDosen, maxNgajar, jruang, jhari, jam){
		var vPinaltiTR = this.hitPinaltiRuang(vInd, matRuang, matMkJalan,jruang, jhari, jam);			
		var nilPinaltiTR = vPinaltiTR[vPinaltiTR.length - 1];
	 
		var mPinaltiDosen = this.hitPinaltiDosen(vInd, matRuang, matMkJalan, maxDosen, jruang, jhari, jam);		
		var nilPinaltiD = mPinaltiDosen[0][mPinaltiDosen[0].length - 1];

		var mPinaltiMhs = this.hitPinaltiMahasiswa(vInd, matRuang, matMkJalan, jruang, jhari, jam);		
		var nilPinaltiM = mPinaltiMhs[0][mPinaltiMhs[0].length - 1];
		
		var mPinaltiDosenMax = PsoScheduling.hitPinaltiDosenMaxNgajar(vInd, matRuang, matMkJalan, maxDosen, maxNgajar, jruang, jhari, jam);	
		var nilPinaltiDMax = mPinaltiDosenMax[0][mPinaltiDosenMax[0].length - 1];

		var nilFit = 1/(1+ nilPinaltiTR + nilPinaltiD + nilPinaltiM +nilPinaltiDMax);
		
		return nilFit;
	},
/*
#########################################################################################################

	hitMatriksLocalBest : function(mHitMatNilLocBest)
	hitVektorNilaiLocalBest : function(mHitMatNilLocBest)
	hitVektorDanNilaiGlobalBest : function(mHitMatNilLocBest, indeksMaks)
	hitIndeksMinMaksBest : function(mHitMatNilLocBest)
	hitVektorGlobalBest : function(vHitVekNilGlobBest)
	hitNilaiGlobalBest : function(vHitVekNilGlobBest)
	
	hitMatUpdatePartikel : function(matPop, mUpVelocity)
	hitMatUpdateVelocity : function(matPop, matVelocity, w, c1, c2, matLocBest, vektGlobalBest)
	hitMatUpdateVelocityModified : function(matPop, matVelocity, w, c1, c2, matLocBest, vektGlobalBest,nilaiMinFit,indeksMinMaks)
	hitMatUpdateVelocityGI : function(G, matPop, matVelocity, matLocBest, vektGlobalBest, vNilaiLocBest, nilGlobalB, nilaiMinFit)
	hitVektorMass : function(vNilaiLocBest, nilGlobalB, nilaiMinFit)
	
	ambilMatLocBestKP : function(matLocBest, nSlotT, nSlotP,kp)
	ambilVektGlobalBestKP : function(vektGlobalBestBaru, nSlotT, nSlotP, kp)
	
	bentukVektorGlobalBest : function(nilGlobalB, size)
	bentukVektorLokalBest : function(nilLocBest, size)
	
	hitMatTerbaikDariDuaMatNilLocalBest : function(matLBsatu , matLBdua)
	
#########################################################################################################	
*/	
	/*
	  Matriks Local Best
	*/
	hitMatriksLocalBest : function(mHitMatNilLocBest){
		return OperasiMatriks.hilangKolomAkhirMatriks(mHitMatNilLocBest);
	},
	/*
	  vektor nilai Local Best
	*/
	hitVektorNilaiLocalBest : function(mHitMatNilLocBest){
		var kol = mHitMatNilLocBest[0].length - 1 ;
		return OperasiMatriks.ambilVektorKolom(mHitMatNilLocBest, kol);
	},
	/*
	  vektor Global Best dan nilai Global Best
	*/
	hitVektorDanNilaiGlobalBest : function(mHitMatNilLocBest, indeksMaks){
		//var vNilaiLocBest2 = this.hitVektorNilaiLocalBest(mHitMatNilLocBest);
		//var v1 = OperasiVektor.ambilIndeksVektorSortDesc(vNilaiLocBest2);
		//var bar = v1[0];//mHitMatNilLocBest.length; //
		//var min = v1[v1.length-1];
		//var vHas = [min, maks] ;//OperasiMatriks.ambilVektorBaris(mHitMatNilLocBest, bar);
		var vHas = OperasiMatriks.ambilVektorBaris(mHitMatNilLocBest, indeksMaks);
		return vHas;
	},
	hitIndeksMinMaksBest : function(mHitMatNilLocBest){
		var vNilaiLocBest2 = this.hitVektorNilaiLocalBest(mHitMatNilLocBest);
		var v1 = OperasiVektor.ambilIndeksVektorSortDesc(vNilaiLocBest2);
		var maks = v1[0];//mHitMatNilLocBest.length; //
		var min = v1[v1.length-1];
		var vHas = [min, maks] ;//OperasiMatriks.ambilVektorBaris(mHitMatNilLocBest, bar);
		return vHas;
	},
	/*
	  vektor Global Best
	*/
	hitVektorGlobalBest : function(vHitVekNilGlobBest){
		var vGlobBest = OperasiVektor.hilangElemenAkhirVektor(vHitVekNilGlobBest);
		return vGlobBest;
	},
	/*
	  nilai Global Best
	*/
	hitNilaiGlobalBest : function(vHitVekNilGlobBest){
		var nil = vHitVekNilGlobBest.length;
		return vHitVekNilGlobBest[nil-1];
	},
	/* 
		hit Mat Update Partikel/individu 	
	*/
	hitMatUpdatePartikel : function(matPop, mUpVelocity){
		var bar = matPop.length;
		var kol = matPop[0].length;
		var matHas = Array();
		//var mUpVelocity = this.hitMatUpdateVelocity(matPop, matVelocity, w, c1, c2, vNilaiLocBest, nilGlobalB);
		for(var i=0 ;i<bar ;i++){
			var vind = OperasiMatriks.ambilVektorBaris(matPop, i);
			var vvelo = OperasiMatriks.ambilVektorBaris(mUpVelocity, i);	
			matHas[i] = OperasiVektor.jumlah2Vektor(vind, vvelo);	
			}
		return matHas;
	},
	/*  
		hit Mat Update Velocity PSO
		
		The procedure of standard PSO is as following:
		1) Initialize the original position and velocity of particle swarm;
		2) Calculate the fitness value of each particle;
		3) For each particle, compare the fitness value with the fitness value of pbest, 
			if current value is better, then renew the position with current position, 
			and update the fitness value simultaneously;
		4) Determine the best particle of group with the best fitness value, 
			if the fitness value is better than the fitness value of gbest, 
			then update the gbest and its fitness value with the position;
		5) Check the finalizing criterion, if it has been satisfied, quit the iteration; 
			otherwise, return to step 2).
	*/
	/*  
		hit Mat Update Velocity M-PSO
		
		The procedure of modified PSO is as following:
		1) Initialize the position and velocity of each particle;
		2) Calculate the fitness of each particle;
		3) Concern the particle with the biggest fitness value, reinitialize its position; 
			and evaluate the particle with the smallest fitness value 
			whether its new position is acceptable, if the answer is yes, 
			update its position, otherwise, a new position is assigned to the particle randomly
			in its neighborhood with radius r; then renew the position and 
			velocity of other particles according to Formula (1) and (2);
		4) For each particle, compare its current fitness value with the fitness of its pbest, 
			if the current value is better, then update pbest and its fitness value;
		5) Determine the best particle of group with the best fitness value, 
			if the current fitness value is better than the fitness value of gbest, 
			then update the gbest and its fitness value with the position;
		6) Check the finalizing criterion, if it has been satisfied, quit the iteration; 
			otherwise, return to step 3).
	*/
	hitMatUpdateVelocity : function(matPop, matVelocity, w, c1, c2, matLocBest, vektGlobalBest){
//document.write("============ hitMatUpdateVelocity <br />");
		var bar = matPop.length;
		var kol = matPop[0].length;
		var matHas = Array();
		//var vgb = this.bentukVektorGlobalBest(nilGlobalB,kol);
		//var vTemp = Array();
		var r1 = Math.random();
		var r2 = Math.random();
		for(var i=0 ;i<bar ;i++){
			var vTemp = Array();
			var vind = OperasiMatriks.ambilVektorBaris(matPop, i);
			var velo = OperasiMatriks.ambilVektorBaris(matVelocity, i);
			var vlb =  OperasiMatriks.ambilVektorBaris(matLocBest, i); //this.bentukVektorLokalBest(vNilaiLocBest[i],kol);	
			for(var j=0 ;j<kol ;j++){
				vTemp[j] = w*velo[j] + c1*r1*(vlb[j]-vind[j]) + c2*r2*(vektGlobalBest[j]-vind[j]);
				}	
			matHas[i] = vTemp;	
			}
		return matHas;
	},
	

	/*  
		hit Mat Update Velocity M-PSO GI
		gravitational field interactions
		
	*/
	hitMatUpdateVelocityGI : function(G, matPop, matVelocity, matLocBest, vektGlobalBest, vNilaiLocBest, nilGlobalB, nilaiFitTerburuk){
//document.write("============ hitMatUpdateVelocity <br />");
//document.write("================= vektGlobalBest : "); 
//OperasiVektor.tampilVektor(vektGlobalBest); document.write("<br>");
		var bar = matPop.length; // banyaknya partikel
		var kol = matPop[0].length;
		var matHas = Array();
		var vMass = this.hitVektorMass(vNilaiLocBest, nilGlobalB, nilaiFitTerburuk);
//document.write("================= vMass : "); 
//OperasiVektor.tampilVektor(vMass); document.write("<br>");	
		var r1 = Math.random();
		var r2 = Math.random();
		for(var i=0 ;i<bar ;i++){
			var vTemp = Array();
			var apb, agb;
			var vind = OperasiMatriks.ambilVektorBaris(matPop, i);
			var velo = OperasiMatriks.ambilVektorBaris(matVelocity, i);
			var vlb =  OperasiMatriks.ambilVektorBaris(matLocBest, i); //this.bentukVektorLokalBest(vNilaiLocBest[i],kol);	
	
			//var G = 9.8*Math.exp(-0.2*i/bar);
//document.write("===== G : "+G+" <br />");	
			var R2pb = OperasiVektor.jarakEuclide(vind, vlb);
//document.write("===== R2pb : "+R2pb+" <br />");			
			//if(R2pb == 0) apb = 1; else apb = G*vMass[i]/R2pb;
			if(R2pb == 0) apb = Math.random(); else apb = G*vMass[i]/(R2pb*R2pb);
//document.write("===== apb : "+apb+" <br />");			
			var R2gb = OperasiVektor.jarakEuclide(vind, vektGlobalBest);
//document.write("===== R2gb : "+R2gb+" <br />");				
			//if(R2gb == 0) agb = 1; else agb = G*vMass[i]/R2gb;
			if(R2gb == 0) agb = Math.random(); else agb = G*vMass[i]/(R2gb*R2gb);
//document.write("===== agb : "+agb+" <br />");			
			for(var j=0 ;j<kol ;j++){
				vTemp[j] = vMass[i]*velo[j] + apb*r1*(vlb[j]-vind[j]) + agb*r2*(vektGlobalBest[j]-vind[j]);
//document.write("===== vMass[i] : "+vMass[i]+" ===== vTemp[j] : "+vTemp[j]+" <br />");					
				}	
			matHas[i] = vTemp;	
//document.write("================= vTemp : "); 
//OperasiVektor.tampilVektor(vTemp); document.write("<br>");			
			}
		return matHas;
	},
	
	hitVektorMass : function(vNilaiLocBest, nilGlobalB, nilaiFitTerburuk){
		var n = vNilaiLocBest.length;
		var vMassTemp = Array();
		for(var i=0 ;i<n ;i++) vMassTemp[i] = (vNilaiLocBest[i]-nilaiFitTerburuk)/(nilGlobalB-nilaiFitTerburuk);
		var vMass = Array();
		var M = OperasiVektor.jumlahVektor(vMassTemp);
		for(var i=0 ;i<n ;i++) vMass[i] = vMassTemp[i]/M;
		return vMass;
	},
	
	/*
		ambil mat kode dari matLocBest teori atau praktikum
	*/
	ambilMatLocBestKP : function(matLocBest, nSlotT, nSlotP,kp){
//document.write("nSlotT : "+nSlotT+" dan nSlotP : "+nSlotP+" <br />");		
		if(kp == "k")
			var mHas = OperasiMatriks.ambilBeberapaKolomMatriks(matLocBest, 0, nSlotT);
		else 
			var mHas = OperasiMatriks.ambilBeberapaKolomMatriks(matLocBest,nSlotT , nSlotT+nSlotP);		
		return mHas;
	},
	// ambilVektGlobalBestKP(vektGlobalBestBaru,nSlotT, nSlotP, "k");
	/*
		ambil vektor kode dari vektGlobalBestBaru teori atau praktikum
	*/
	ambilVektGlobalBestKP : function(vektGlobalBestBaru, nSlotT, nSlotP, kp){
		var vHas = Array();
		if(kp == "k"){
			for(var i=0; i< nSlotT; i++) vHas[i] = vektGlobalBestBaru[i];
		}else {
			for(var i=0; i< nSlotP; i++) vHas[i] = vektGlobalBestBaru[i+nSlotT];
		}
//document.write("vHas : ");
//OperasiVektor.tampilVektor(vHas);document.write("<br />");		
		return vHas;
	},
	bentukVektorGlobalBest : function(nilGlobalB, size){
		var vGB = [nilGlobalB];
		for(var i=0 ;i<size-1 ;i++) vGB.push(nilGlobalB);
		return vGB;
	},
	bentukVektorLokalBest : function(nilLocBest, size){
		var vLB = [nilLocBest];
		for(var i=0 ;i<size-1 ;i++) vLB.push(nilLocBest);
		return vLB;
	},
	/* 
		banding 2 matriks local Best 	
			pilih baris terbaik ==> taruh di matriks baru
	*/
	hitMatTerbaikDariDuaMatNilLocalBest : function(matLBsatu , matLBdua, fitTerbaik){
		var bar = matLBsatu.length;
		var kol = matLBsatu[0].length;
		var matHas = Array();
		for(var i=0 ;i<bar ;i++){
			var v1 = OperasiMatriks.ambilVektorBaris(matLBsatu, i);
			var v2 = OperasiMatriks.ambilVektorBaris(matLBdua, i);
//document.write("===== v1.length : "+v1.length+", kol : "+kol+", v1["+(kol-1)+"] : "+v1[kol-1]+" dan v2["+(kol-1)+"] : "+v2[kol-1]+" <br />");			
			if(fitTerbaik==1) { if(v1[kol-1] > v2[kol-1]) matHas[i] = v1; else matHas[i] = v2; }
			if(fitTerbaik==0) { if(v1[kol-1] < v2[kol-1]) matHas[i] = v1; else matHas[i] = v2; }
						
		}
		return matHas;
	},
	
//#########################################################################################################
//#########################################################################################################
	
	
	/* 
	===============================================================
				   MATRIKS SLOT UNTUK KULIAH
	===============================================================
	buat matriks hari vs jam kuliah per ruang
	hari : senin, selasa, rabu, kamis, jum'at ==> 5 hari
	jam kuliah : 1-2, 3-5, 5-6, 7-8, 9-10 ==> 5 jam kuliah
	untuk cek ==> kapasitas ruang dan peserta MK
	
	=> buat slot seperti untuk ujian -- untuk 100' -- 2 sks	
-----------------------------------------------------------------------------------------------------------------
	mSlot ==> 
	No | kode Ruang | kode Hari | kode Jam Mulai | kode Jam Selesai | kode lama waktu | No urut MatKul | k atau p
	
	kode lama waktu --> 2 untuk 2 sks dan 1 untuk 1 sks
-----------------------------------------------------------------------------------------------------------------	
	=> pecah 3 sks menjadi 2 sks dan 1 sks -- untuk 4 menjadi 2 sks dan 2 sks
	=> gabung menjadi MK yang akan dijadwal -- kode MK | sks | dosen
	=> hitung banyaknya MK yang 1 sks misalkan nMKsatu --> dibagi 2 -->  nMKsatuSks = (nMKsatu/2) + 1
	=> slot yang ada di -- mSlot -- sebanyak nMKsatuSks dipecah menjadi 2
						| kode Jam Mulai | kode Jam Selesai | kode lama waktu |
						untuk 	kode Jam Mulai --> kode asli
								kode Jam Selesai --> akan menjadi kode Mulai di slot pecahannya
													 dan diganti null atau "-" untuk aslinya
								kode lama waktu	--> kode 2 berubah menjadi 1
	=> pengisian slot harus disesuaikan 
						--> slot dipecah menjadi 2 --> mSlotDua untuk 2 sks dan mSlotSatu 1 sks 
						--> isikan MK dengan 2 sks di mSlotDua dan MK dengan 1 sks di mSlotSatu
						--> digabung kembali untuk dihitung PINALTInya
						--> jika OK buat matriks JADWALnya
	
	*/

	
	/* 
	===============================================================
				   MATRIKS SLOT UNTUK KULIAH DAN UJIAN
	===============================================================
	buat matriks hari vs jam kuliah per ruang
	hari : senin, selasa, rabu, kamis, jum'at ==> 5 hari
	jam kuliah : 1-2, 3-5, 5-6, 7-8, 9-10 ==> 5 jam kuliah
	untuk cek ==> kapasitas ruang dan peserta MK
----------------------------------------------------------------------------------
	mSlot ==> No | kode Ruang | kode Hari | kode Jam | No urut MatKul | k atau p
----------------------------------------------------------------------------------
	*/
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
   /*
	****************************************************************
				PINALTI UJIAN GABUNGAN TEORI DAN PRAKTIKUM
	****************************************************************			
	mSlotIsiGabung <-- mSlotIsi(Teori) + mSlotIsiP(Praktikum)
	Pinalti :
		1. Ruang => cek kapasitas ruang
			mSlotIsi(Teori) -> var vPinaltiRuang = 
					PsoScheduling.hitPinaltiRuangUjian
					(matSlotIsi, matRuangUjian, mkJalanTeoriUjian);	
			mSlotIsiP(Praktikum) -> var vPinaltiLabkom = 
					PsoScheduling.hitPinaltiLabkomUjian
					(matSlotIsiP, matLabkomUjian, mkJalanPraktekUjian);	
					
		2. Dosen => cek apakah Dosen jaga ujian dalam satu hari dan jam yang sama
			mSlotIsiGabung ->
			
		3. Pegawai => cek apakah Pegawai jaga ujian dalam satu hari dan jam yang sama
			mSlotIsiGabung ->
			
		4. maxDosen jaga Ujian => Dosen menjaga ujian ada max dalam suatu hari
			mSlotIsiGabung ->
			
		6. Mhs => cek apakah Mhs jaga ujian dalam satu hari dan jam yang sama
			mSlotIsiGabung ->
			
		7. maxMhs Ujian => Mhs mengikuti ujian ada max dalam suatu hari
			mSlotIsiGabung ->
			
			
	****************************************************************
	*/  
	/*
	hitung pinalti daya tampung mk terhadap kapasitas ruang
    	sesuai ==> 0
    	tidak sesuai ==> 500   	
		mat Ruang ==> mat ruang
		mat Mk Dosen ==> mat MK dan dosen
		
		output ==> mkPinaltiRuang = (mkPinaltiRuang , pinaltiRuang)
					mkPinaltiRuang ==> array
					pinaltiRuang  ==> skalar
	*/  
	hitPinaltiRuangUjianGabung : function(mSlotIsi,matSlotIsiP, mRuang,mLabkom, mMkUjian, mMkUjianPraktek)
		{
			var mPinaltiRuang = this.hitPinaltiRuangUjian(mSlotIsi, mRuang, mMkUjian);
			var nilPinaltiRuang = mPinaltiRuang[1][mPinaltiRuang[0].length - 1];
			var mPinaltiRuangHas = OperasiMatriks.hilangKolomAkhirMatriks(mPinaltiRuang);
			
			var mPinaltiLab = this.hitPinaltiLabkomUjian(matSlotIsiP, mLabkom, mMkUjianPraktek);
			var nilPinaltiLab = mPinaltiLab[1][mPinaltiLab[0].length - 1];
			var mPinaltiLabHas = OperasiMatriks.hilangKolomAkhirMatriks(mPinaltiLab);
			var v1 = ["pinalti", nilPinaltiRuang+nilPinaltiLab];

//document.write("mPinaltiRuang : <br />");
//OperasiMatriks.tampilMatriksString(mPinaltiRuang);document.write("<br />");
//document.write("mPinaltiLab : <br />");
//OperasiMatriks.tampilMatriksString(mPinaltiLab);document.write("<br />");
			
			var matHas2 = OperasiMatriks.gabung2MatriksKolom(mPinaltiRuangHas, mPinaltiLabHas);
			var matHas = OperasiMatriks.tambahKolomAkhirMatriks(matHas2, v1);
			return matHas;
	},
	/*
   hitung pinalti dosen tidak boleh menjaga UJIAN Gabung pada jam yang sama
    	sesuai --> 0
    	tidak sesuai --> 500   	
		maxDosen --> 2 orang
		
	hitPinaltiDosenUjianPraktek : function
	(matSlotIsiP, mMkUjianPraktek, maxDosen)  

 */  
	hitPinaltiDosenUjianGabung : function(matSlotIsi,matSlotIsiP, mMkUjian,mMkUjianPraktek, maxDosen)
      {
		//document.write("######### hitPinaltiDosenUjian ######### <br />");
//document.write("================ mMkUjian : <br>");
//OperasiMatriks.tampilMatriksString(mMkUjian);document.write("<br>");	
//document.write("================ mMkUjianPraktek : <br>");
//OperasiMatriks.tampilMatriksString(mMkUjianPraktek);document.write("<br>");
//document.write("================ matSlotIsi : <br>");
//OperasiMatriks.tampilMatriksString(matSlotIsi);document.write("<br>");	
//document.write("================ matSlotIsiP : <br>");
//OperasiMatriks.tampilMatriksString(matSlotIsiP);document.write("<br>");
        var mSlotIsi = OperasiMatriks.gabung2MatriksBaris(matSlotIsi,matSlotIsiP);
		var nSlotT = matSlotIsi.length;
		var nSlotP = matSlotIsiP.length;
        var jmkT = mMkUjian.length;  
		var jmkP = mMkUjianPraktek.length;
		var jmkGab = jmkT+jmkP;
		var vPinaltiDosen = [];
		var vPinaltiKP = [];
        var pinaltiDosen = 0;
        var iMK = 0, hSlot, jSlot, kp;
		var bar = mSlotIsi.length;
		var kol = mSlotIsi[0].length;		
		var mSlotIsiSort = OperasiMatriks.sortMatriksDuaKolom(mSlotIsi,2,3); //sort Hari		
//document.write("================ mSlotIsiSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(mSlotIsiSort);document.write("<br>");
		//var vKolmk = OperasiMatriks.ambilVektorKolom(mSlotIsiSort,4);
		//OperasiVektor.urutAsc(vKolmk);
//document.write("================= vKolmk : "); 
//OperasiVektor.tampilVektor(vKolmk); document.write("<br>");		

//document.write("================ jmkT : "+jmkT+", jmkP : "+jmkP+" dan jmkGab : "+jmkGab+" <br>");
		var mDosen = OperasiMatriks.isiAwalMatriks(jmkT,maxDosen); //Array();
        var iter , id;
		//iter = 0;
		for(var i=0;i<jmkT ;i++){ 
            //mDosen[iter] = Array();
            for(var id=0;id<maxDosen;id++){  			
				mDosen[i][id] = mMkUjian[i][id+5];
//document.write("================ iter : "+iter+" <br>");				
				//mDosen[i][maxDosen] = mMkUjian[i][11];
                }
			//iter++;	
        } 	
		//iter = jmkT;
		var mDosenP = OperasiMatriks.isiAwalMatriks(jmkP,maxDosen);
		for(var i=0;i<jmkP ;i++){ 
            //mDosen[iter] = Array();
            for(var id=0;id<maxDosen;id++){ 			
				mDosenP[i][id] = mMkUjianPraktek[i][id+5];
//document.write("================ iter : "+iter+" <br>");	
				//mDosen[iter][maxDosen] = mMkUjianPraktek[i][11];
                }
			//iter++;	
        }
//document.write("================ mDosen : <br>");
//OperasiMatriks.tampilMatriksString(mDosen);document.write("<br>"); 
//document.write("================ mDosenP : <br>");
//OperasiMatriks.tampilMatriksString(mDosenP);document.write("<br>"); 	
//document.write("================ mDosen.length : "+mDosen.length+" <br>");
		var mKerja =  OperasiMatriks.isiAwalMatriks(jmkGab,6);
		
//document.write("================ mKerja : <br>");
//OperasiMatriks.tampilMatriksString(mKerja);document.write("<br>"); 	
//document.write("================ mKerja.length : "+mKerja.length+" <br>");	
//document.write("================ bar : "+bar+" <br>");	
		iter = 0;
       	for(var i=0;i<bar;i++){
			iMK = mSlotIsiSort[i][4];			
			hSlot = mSlotIsiSort[i][2];
			jSlot = mSlotIsiSort[i][3];	
			kp = mSlotIsiSort[i][5];
//document.write("======= iMK : "+iMK+", kp : "+kp+", jSlot : "+jSlot+" dan hSlot : "+hSlot+"<br>");			
            if(kp == "k") {
				if(iMK < jmkT) {
//document.write("======= iMK : "+iMK+", kp : "+kp+", jSlot : "+jSlot+" dan hSlot : "+hSlot+"<br>");					
					mKerja[iter][0] = hSlot;					
					mKerja[iter][1] = jSlot;
					mKerja[iter][2] = iMK;
					mKerja[iter][3] = mDosen[iMK][0];
					mKerja[iter][4] = mDosen[iMK][1];
					mKerja[iter][5] = kp;
					iter++;
				}
			} else 
				if(iMK < jmkP) {
//document.write("======= iMK : "+iMK+", kp : "+kp+", jSlot : "+jSlot+" dan hSlot : "+hSlot+"<br>");					
					mKerja[iter][0] = hSlot;					
					mKerja[iter][1] = jSlot;
					mKerja[iter][2] = iMK;
					mKerja[iter][3] = mDosenP[iMK][0];
					mKerja[iter][4] = mDosenP[iMK][1];
					mKerja[iter][5] = kp;					
					iter++;
				}
		}
//document.write("================ mKerja : <br>");
//OperasiMatriks.tampilMatriksString(mKerja);document.write("<br>");			
//document.write("======= mKerja : "+mKerja.length+" dan kol : "+mKerja[0].length+"<br>");	
	//*	
		var m1, m2, m3, m4,m5,m6, puter;
		for(var i=0;i<jmkGab-1;i++){
			var vDosenTemp = Array();
			for(var j=i+1;j<jmkGab;j++){
				puter = 0;
				m1 = mKerja[i][0];
				m2 = mKerja[i][1];
				m3 = mKerja[j][0];
				m4 = mKerja[j][1];
//document.write("======= m1 : "+m1+", m2 : "+m2+", m3 : "+m3+", m4 : "+m4+"<br>");										
				if(m1 == m3 && m2 == m4){ 
					for(var k=0;k<maxDosen;k++){
						vDosenTemp[puter++] =  mKerja[i][k+3];
						vDosenTemp[puter++] =  mKerja[j][k+3];
					}
//document.write("vDosenTemp : "); OperasiVektor.tampilVektorString(vDosenTemp); document.write("<br>");				
					var cekSama = OperasiVektor.cekAdaElemenSamaVektor(vDosenTemp);
//document.write("======= cekSama : "+cekSama+"<br>");					
					if(cekSama){
						pinaltiDosen +=500;
						vPinaltiDosen.push(mKerja[i][2]);
						vPinaltiDosen.push(mKerja[j][2]);
						vPinaltiKP.push(mKerja[i][5]);
						vPinaltiKP.push(mKerja[j][5]);
						}
				}
				else break;
			}
		} 
//*/		     
	/****************************************************************
	  matriks mkPinaltiDosen ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  ================= pada jam yang sama =======================
			#	baris ke-1 ==> nama MK I	#
			#	baris ke-2 ==> nama MK II	# 	  
	/****************************************************************/
//*	
//*

	var np = vPinaltiDosen.length/2;
	var mkPinaltiDosen = OperasiMatriks.isiAwalMatriks(4,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiDosen[0][i] = vPinaltiDosen[2*i];
		mkPinaltiDosen[2][i] = vPinaltiDosen[2*i+1];
		mkPinaltiDosen[1][i] = vPinaltiKP[2*i];
		mkPinaltiDosen[3][i] = vPinaltiKP[2*i+1];
		
	}
	mkPinaltiDosen[0][np] = pinaltiDosen;	
	return mkPinaltiDosen;
	//*/
	//return mDosen;
	},
	/*
   hitung pinalti dosen boleh menjaga ujian sebanyak 2 (maxNgajar) kali sehari
    	sesuai --> 0
    	tidak sesuai --> 500   	

		var myFish = ['angel', 'clown', 'drum', 'mandarin', 'sturgeon'];
		var removed = myFish.splice(3, 1);
			// removed is ["mandarin"]
			// myFish is ["angel", "clown", "drum", "sturgeon"]
			
	mSlotIsi --> kolom ==> 0 : No , 1 : Ruang , 2 : Hari, 3 : Jam dan 4 : No urut MatKul 
	mMkUjian --> matriks yang berisi MatKul yang akan diujikan 
	maxDosenJaga --> banyaknya dosen yang menjaga di suatu MatKul 
	maxJaga --> maksimum seorang dosen menjaga dalam satu hari	
	=====================================
		mDosenTemp	=== HARUS di-sort
	=====================================	
	
	hitPinaltiDosenMaxUjianPraktek : function
	(matSlotIsiP, mMkUjianPraktek, maxDosenJaga, maxJaga)
 
 */  
	hitPinaltiDosenMaxUjianGabung : function(matSlotIsi,matSlotIsiP, mMkUjian,mMkUjianPraktek, maxDosenJaga, maxJaga)
      {
		//document.write("######### hitPinaltiDosen max ngajar ######### <br />");         
        var mSlotIsi = OperasiMatriks.gabung2MatriksBaris(matSlotIsi,matSlotIsiP);
		var nSlotT = matSlotIsi.length;
		var nSlotP = matSlotIsiP.length;
        var jmkT = mMkUjian.length;  
		var jmkP = mMkUjianPraktek.length;
		var jmkGab = jmkT+jmkP;      
		var vPinaltiDosenMax = [];	
		var vPinaltiKP = [];
		var vPinaltiMK = [];				
		var vKodeDosen = [];	
		var vBanyakNgajar = [];		
        var pinaltiDosenMax = 0;
		var iMK = 0, hSlot, jSlot, kp ,mk;
		var bar = mSlotIsi.length;
		var kol = mSlotIsi[0].length;		
		var mSlotIsiSort = OperasiMatriks.sortMatriksDuaKolom(mSlotIsi,2,3); //sort Hari
		
//document.write("================ mSlotIsiSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(mSlotIsiSort);document.write("<br>");
		var vInput = OperasiMatriks.ambilVektorKolom(mSlotIsiSort,2); // ambil kolom Hari
		var mKelHari = OperasiMatriks.buatMatKelompokDanBanyaknya(vInput); // kelompok per Hari dan banyaknya anggota kelompok
//document.write("vInput : "); OperasiVektor.tampilVektorString(vInput); document.write("<br>");		
//document.write("================ mKelHari : <br>");
//OperasiMatriks.tampilMatriksString(mKelHari);document.write("<br>");

		var iter; // , id;
		var mDosen = Array();       		
		for(var i=0;i<jmkT ;i++){ 
            mDosen[i] = Array();
            for(var id=0;id<maxDosenJaga;id++){      
				mDosen[i][id] = mMkUjian[i][id+5];
				mDosen[i][maxDosenJaga] = mMkUjian[i][11];
                }
        }
		var mDosenP = Array();       		
		for(var i=0;i<jmkP ;i++){ 
            mDosenP[i] = Array();
            for(var id=0;id<maxDosenJaga;id++){      
				mDosenP[i][id] = mMkUjianPraktek[i][id+5];
				mDosenP[i][maxDosenJaga] = mMkUjianPraktek[i][11];
                }
        }		
		
//document.write("================ mDosen : <br>");
//OperasiMatriks.tampilMatriksString(mDosen);document.write("<br>"); 
//document.write("================ mDosenP : <br>");
//OperasiMatriks.tampilMatriksString(mDosenP);document.write("<br>"); 
		var  nKelHari = mKelHari.length,awal, akhir,puter,iter; //
		for(var k=0;k<nKelHari;k++){
			puter = 0;
			var vDosenTemp = Array();
			var vKP = Array();
			var viMK = Array();
			awal = mKelHari[k][1];
			akhir = awal + mKelHari[k][2];
//document.write("================ awal : "+awal+" dan akhir : "+akhir+"<br>");
			
			for(var i=awal;i<akhir;i++){
				iMK = mSlotIsiSort[i][4];
				kp = mSlotIsiSort[i][5];
				if(kp == "k") {
					if(iMK < jmkT) {
//document.write("================  puter : "+puter+", kp : "+kp+" dan iMK : "+iMK+"<br>");								
						for(var j=0;j<maxDosenJaga;j++) {
							vDosenTemp[puter] = mDosen[iMK][j];
							vKP[puter] = mDosen[iMK][maxDosenJaga];
							viMK[puter] = iMK;
							puter++;
						}
					}
				} else 	
					if(iMK < jmkP) {
//document.write("================  puter : "+puter+", kp : "+kp+" dan iMK : "+iMK+"<br>");								
						for(var j=0;j<maxDosenJaga;j++) {
							vDosenTemp[puter] = mDosenP[iMK][j];
							vKP[puter] = mDosenP[iMK][maxDosenJaga];
							viMK[puter] = iMK;
							puter++;
						}
					}
			}
			
			
//document.write("========== vDosenTemp.length : "+vDosenTemp.length+" <br>");
//document.write("========== vKP.length : "+vKP.length+" <br>");
//document.write("========== viMK.length : "+viMK.length+" <br>");
//document.write("<br>");	

			if(vDosenTemp.length==0) {
				//document.write("=============== vDosenTemp.length = 0 <br>");
				break;
				}
		
			var m2Vektor = OperasiMatriks.gabung2VektorKolom(vDosenTemp,vKP);
			var m3Vektor = OperasiMatriks.tambahKolomAkhirMatriks(m2Vektor, viMK);
//document.write("========== m3Vektor : <br>");
//OperasiMatriks.tampilMatriksString(m3Vektor);document.write("<br>");				
//document.write("=========== m3Vektor.length : "+m3Vektor.length+" <br>");			
			var mDosenT = OperasiMatriks.sortMatriksKolom(m3Vektor,0);
			
			//OperasiVektor.urutAsc(vDosenTemp);
			
			//OperasiVektor.urutDescString(vDosenTemp); // sort string desc
//document.write("vDosenTemp : "); 
//OperasiVektor.tampilVektorString(vDosenTemp); document.write("<br>"); 
//document.write("vKP : "); 
//OperasiVektor.tampilVektorString(vKP); document.write("<br>");	
//document.write("================ mDosenT : <br>");
//OperasiMatriks.tampilMatriksString(mDosenT);document.write("<br>");		
			var nilP = 0 , cekKode = mDosenT[0][0], kp = mDosenT[0][1] ,mk = mDosenT[0][2];
			iter = 0;
			while(iter < mDosenT.length-1){
				var isiD = mDosenT[iter][0];
				if(!(isiD == "-" || isiD == "")){
					if(isiD == mDosenT[iter+1][0]){
					    nilP++;		
						kp = (kp.concat("-")).concat(mDosenT[iter+1][1]);
						mk = mk+"-"+mDosenT[iter+1][2];						
					}
					else {
						vKodeDosen.push(cekKode);
						vBanyakNgajar.push(nilP+1);
						if(nilP+1 > maxJaga) {
								pinaltiDosenMax+=500;
								vPinaltiDosenMax.push(cekKode);
								vPinaltiDosenMax.push(nilP+1);
								vPinaltiKP.push(kp);
								vPinaltiMK.push(mk);
							}
						nilP=0;
						cekKode = mDosenT[iter+1][0];
						kp = mDosenT[iter+1][1];
						mk = mDosenT[iter+1][2];
						}
				}
				iter++;
			}
		}
				
	/**********************************************************************
	  matriks mkPinaltiDosenMax ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  	#	baris ke-1 ==> nama Dosen									#
		#	baris ke-2 ==> banyaknya MK yg bentrok pada hari yg sama	#  
	/*********************************************************************/
/*	
document.write("<br>");	
document.write("vKodeDosen : "); OperasiVektor.tampilVektorString(vKodeDosen); document.write("<br>");
document.write("vBanyakNgajar : "); OperasiVektor.tampilVektorString(vBanyakNgajar); document.write("<br>");
document.write("vPinaltiDosenMax : "); OperasiVektor.tampilVektorString(vPinaltiDosenMax); document.write("<br>");
document.write("vPinaltiKP : "); OperasiVektor.tampilVektorString(vPinaltiKP); document.write("<br>");
//*/
	var np = vPinaltiDosenMax.length/2;
	var mkPinaltiDosenMax = OperasiMatriks.isiAwalMatriks(4,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiDosenMax[0][i] = vPinaltiDosenMax[2*i];
		mkPinaltiDosenMax[1][i] = vPinaltiDosenMax[2*i+1];
		mkPinaltiDosenMax[2][i] = vPinaltiKP[i];
		mkPinaltiDosenMax[3][i] = vPinaltiMK[i];
	}
	mkPinaltiDosenMax[0][np] = pinaltiDosenMax;	
	return mkPinaltiDosenMax;
	},
	/*
   hitung pinalti Mahasiswa tidak boleh melaksanakan UJIAN Gabung pada jam yang sama
    	sesuai --> 0
    	tidak sesuai --> 500   	
		
		
	hitPinaltiDosenUjianPraktek : function
	(matSlotIsiP, mMkUjianPraktek, maxDosen)  

 */  
	hitPinaltiMhsUjianGabung : function(matSlotIsi,matSlotIsiP, mMkUjian,mMkUjianPraktek)
      {
		//document.write("######### hitPinaltiMhsUjian ######### <br />");
//document.write("================ mMkUjian : <br>");
//OperasiMatriks.tampilMatriksString(mMkUjian);document.write("<br>");	
//document.write("================ mMkUjianPraktek : <br>");
//OperasiMatriks.tampilMatriksString(mMkUjianPraktek);document.write("<br>");	
        var mSlotIsi = OperasiMatriks.gabung2MatriksBaris(matSlotIsi,matSlotIsiP);
		var nSlotT = matSlotIsi.length;
		var nSlotP = matSlotIsiP.length;
        var jmkT = mMkUjian.length;  
		var jmkP = mMkUjianPraktek.length;
		var jmkGab = jmkT+jmkP;
		var vPinaltiMhs = [];
		var vPinaltiKP = [];
        var pinaltiMhs = 0;
        var iMK = 0, hSlot, jSlot, kp;
		var bar = mSlotIsi.length;
		var kol = mSlotIsi[0].length;		
		var mSlotIsiSort = OperasiMatriks.sortMatriksDuaKolom(mSlotIsi,2,3); //sort Hari		
//document.write("================ mSlotIsiSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(mSlotIsiSort);document.write("<br>");
		//var vKolmk = OperasiMatriks.ambilVektorKolom(mSlotIsiSort,4);
		//OperasiVektor.urutAsc(vKolmk);
//document.write("================= vKolmk : "); 
//OperasiVektor.tampilVektor(vKolmk); document.write("<br>");		

//document.write("================ jmkT : "+jmkT+", jmkP : "+jmkP+" dan jmkGab : "+jmkGab+" <br>");
		var vMhs = Array();
        var iter;// , id;		
		for(var i=0;i<jmkT ;i++){ 
            vMhs[i] = mMkUjian[i][4]; //[10]; ==> 4 untuk semester dan 10 untuk tahun angkatan
			}
		
		var vMhsP = Array();
		for(var i=0;i<jmkP ;i++){ 
            vMhsP[i] = mMkUjianPraktek[i][4]; //[10]; ==> 4 untuk semester dan 10 untuk tahun angkatan
			}
//document.write("========== vMhs : "); 
//OperasiVektor.tampilVektorString(vMhs); document.write("<br>");		
//document.write("================ vMhsP : <br>");
//OperasiVektor.tampilVektorString(vMhsP); document.write("<br>"); 	
//document.write("================ mMhs.length : "+mMhs.length+" <br>");
		var mKerja =  OperasiMatriks.isiAwalMatriks(jmkGab,5);
		
//document.write("================ mKerja : <br>");
//OperasiMatriks.tampilMatriksString(mKerja);document.write("<br>"); 	
//document.write("================ mKerja.length : "+mKerja.length+" <br>");	
//document.write("================ bar : "+bar+" <br>");	
		iter = 0;
       	for(var i=0;i<bar;i++){
			iMK = mSlotIsiSort[i][4];			
			hSlot = mSlotIsiSort[i][2];
			jSlot = mSlotIsiSort[i][3];	
			kp = mSlotIsiSort[i][5];
//document.write("======= iMK : "+iMK+", kp : "+kp+", jSlot : "+jSlot+" dan hSlot : "+hSlot+"<br>");			
            if(kp == "k") {
				if(iMK < jmkT) {
					mKerja[iter][0] = hSlot;					
					mKerja[iter][1] = jSlot;
					mKerja[iter][2] = iMK;
					mKerja[iter][3] = vMhs[iMK];
					mKerja[iter][4] = kp;
					iter++;
				}
			} else 
				if(iMK < jmkP) {
					mKerja[iter][0] = hSlot;					
					mKerja[iter][1] = jSlot;
					mKerja[iter][2] = iMK;
					mKerja[iter][3] = vMhsP[iMK];
					mKerja[iter][4] = kp;					
					iter++;
				}
		}
//document.write("================ mKerja : <br>");
//OperasiMatriks.tampilMatriksString(mKerja);document.write("<br>");			
//document.write("======= mKerja : "+mKerja.length+" dan kol : "+mKerja[0].length+"<br>");	
	//*	
		var m1, m2, m3, m4,m5,m6, puter;
		for(var i=0;i<jmkGab-1;i++){
			var vMhsTemp = Array();
			for(var j=i+1;j<jmkGab;j++){
				puter = 0;
				m1 = mKerja[i][0];
				m2 = mKerja[i][1];
				m3 = mKerja[j][0];
				m4 = mKerja[j][1];
//document.write("======= m1 : "+m1+", m2 : "+m2+", m3 : "+m3+", m4 : "+m4+"<br>");										
				if(m1 == m3 && m2 == m4){ 
					for(var k=0;k<2;k++){
						vMhsTemp[puter++] =  mKerja[i+k][3];
						//vMhsTemp[puter++] =  mKerja[j][3];
					}
//document.write("vMhsTemp : "); OperasiVektor.tampilVektorString(vMhsTemp); document.write("<br>");				
					var cekSama = OperasiVektor.cekAdaElemenSamaVektor(vMhsTemp);
//document.write("======= cekSama : "+cekSama+"<br>");					
					if(cekSama){
						pinaltiMhs +=500;
						vPinaltiMhs.push(mKerja[i][2]);
						vPinaltiMhs.push(mKerja[j][2]);
						vPinaltiKP.push(mKerja[i][4]);
						vPinaltiKP.push(mKerja[j][4]);
						}
				}
				else break;
			}
		} 
//*/		     
	/****************************************************************
	  matriks mkPinaltiMhs ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  ================= pada jam yang sama =======================
			#	baris ke-1 ==> nama MK I	#
			#	baris ke-2 ==> nama MK II	# 	  
	/****************************************************************/
//*	
//*

	var np = vPinaltiMhs.length/2;
	var mkPinaltiMhs = OperasiMatriks.isiAwalMatriks(4,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiMhs[0][i] = vPinaltiMhs[2*i];
		mkPinaltiMhs[2][i] = vPinaltiMhs[2*i+1];
		mkPinaltiMhs[1][i] = vPinaltiKP[2*i];
		mkPinaltiMhs[3][i] = vPinaltiKP[2*i+1];
		
	}
	mkPinaltiMhs[0][np] = pinaltiMhs;	
	return mkPinaltiMhs;
	//*/
	//return mMhs;
	},
	/*
   hitung pinalti Mahasiswa boleh menempuh ujian sebanyak 2 (maxUjian) kali sehari
    	sesuai --> 0
    	tidak sesuai --> 500   	
			
	mSlotIsi --> kolom ==> 0 : No , 1 : Ruang , 2 : Hari, 3 : Jam dan 4 : No urut MatKul 
	mMkUjian --> matriks yang berisi MatKul yang akan diujikan 
	//maxMhsUjian --> banyaknya mahasiswa yang menempuh ujian di suatu MatKul 
	maxUjian --> maksimum seorang mahasiswa menempuh ujian dalam satu hari	
	=====================================
		mMhsTemp	=== HARUS di-sort
	=====================================	
	hitPinaltiMhsMaxUjian : function(mSlotIsi, mMkUjian, maxUjian)
 */  
	
	
	hitPinaltiMhsMaxUjianGabung : function(matSlotIsi,matSlotIsiP, mMkUjian,mMkUjianPraktek, maxUjian)
      {
		//document.write("######### hitPinaltiMhs max ngajar ######### <br />");         
        var mSlotIsi = OperasiMatriks.gabung2MatriksBaris(matSlotIsi,matSlotIsiP);
		var nSlotT = matSlotIsi.length;
		var nSlotP = matSlotIsiP.length;
        var jmkT = mMkUjian.length;  
		var jmkP = mMkUjianPraktek.length;
		var jmkGab = jmkT+jmkP;      
		var vPinaltiMhsMax = [];	
		var vPinaltiKP = [];
		var vPinaltiMK = [];
		var vKodeMhs = [];	
		var vBanyakNgajar = [];		
        var pinaltiMhsMax = 0;
		var iMK = 0, hSlot, jSlot, kp, mk;
		var bar = mSlotIsi.length;
		var kol = mSlotIsi[0].length;		
		var mSlotIsiSort = OperasiMatriks.sortMatriksDuaKolom(mSlotIsi,2,3); //sort Hari
		
//document.write("================ mSlotIsiSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(mSlotIsiSort);document.write("<br>");
		var vInput = OperasiMatriks.ambilVektorKolom(mSlotIsiSort,2); // ambil kolom Hari
		var mKelHari = OperasiMatriks.buatMatKelompokDanBanyaknya(vInput); // kelompok per Hari dan banyaknya anggota kelompok
//document.write("vInput : "); OperasiVektor.tampilVektorString(vInput); document.write("<br>");		
//document.write("================ mKelHari : <br>");
//OperasiMatriks.tampilMatriksString(mKelHari);document.write("<br>");

		var iter; // , id;
		var mMhs = Array();       		
		for(var i=0;i<jmkT ;i++){ 
            mMhs[i] = Array();
            //for(var id=0;id<maxMhsUjian;id++){      
				mMhs[i][0] = mMkUjian[i][4];
				mMhs[i][1] = mMkUjian[i][11];
               // }
        }
		var mMhsP = Array();       		
		for(var i=0;i<jmkP ;i++){ 
            mMhsP[i] = Array();
            //for(var id=0;id<maxMhsUjian;id++){      
				mMhsP[i][0] = mMkUjianPraktek[i][4];
				mMhsP[i][1] = mMkUjianPraktek[i][11];
               // }
        }		
		
//document.write("================ mMhs : <br>");
//OperasiMatriks.tampilMatriksString(mMhs);document.write("<br>"); 
//document.write("================ mMhsP : <br>");
//OperasiMatriks.tampilMatriksString(mMhsP);document.write("<br>"); 
		var  nKelHari = mKelHari.length,awal, akhir,puter,iter; //
		for(var k=0;k<nKelHari;k++){
			puter = 0;
			var vMhsTemp = Array();
			var vKP = Array();
			var viMK = Array();
			awal = mKelHari[k][1];
			akhir = awal + mKelHari[k][2];
//document.write("================ awal : "+awal+" dan akhir : "+akhir+"<br>");
			
			for(var i=awal;i<akhir;i++){
				iMK = mSlotIsiSort[i][4];
				kp = mSlotIsiSort[i][5];
				if(kp == "k") {
					if(iMK < jmkT) {
//document.write("================  puter : "+puter+", kp : "+kp+" dan iMK : "+iMK+"<br>");								
						//for(var j=0;j<maxMhsUjian;j++) {
							vMhsTemp[puter] = mMhs[iMK][0];
							vKP[puter] = mMhs[iMK][1];
							viMK[puter] = iMK;
							puter++;
						//}
					}
				} else 	
					if(iMK < jmkP) {
//document.write("================  puter : "+puter+", kp : "+kp+" dan iMK : "+iMK+"<br>");								
						//for(var j=0;j<maxMhsUjian;j++) {
							vMhsTemp[puter] = mMhsP[iMK][0];
							vKP[puter] = mMhsP[iMK][1];
							viMK[puter] = iMK;
							puter++;
						//}
					}
			}
			
//document.write("========== vMhsTemp.length : "+vMhsTemp.length+" <br>");
//document.write("========== vKP.length : "+vKP.length+" <br>");
//document.write("========== viMK.length : "+viMK.length+" <br>");			
			if(vMhsTemp.length==0) {
				//document.write("=============== vMhsTemp.length = 0 <br>");
				break;
				}
			
			var m2Vektor = OperasiMatriks.gabung2VektorKolom(vMhsTemp,vKP);
			var m3Vektor = OperasiMatriks.tambahKolomAkhirMatriks(m2Vektor, viMK);
//document.write("================ m3Vektor : <br>");
//OperasiMatriks.tampilMatriksString(m3Vektor);document.write("<br>");				
//document.write("================ m3Vektor.length : "+m3Vektor.length+" <br>");			
			var mMhsT = OperasiMatriks.sortMatriksKolom(m3Vektor,0);
			
			//OperasiVektor.urutAsc(vMhsTemp);
			
			//OperasiVektor.urutDescString(vMhsTemp); // sort string desc
//document.write("vMhsTemp : "); 
//OperasiVektor.tampilVektorString(vMhsTemp); document.write("<br>"); 
//document.write("vKP : "); 
//OperasiVektor.tampilVektorString(vKP); document.write("<br>");	
//document.write("================ mMhsT : <br>");
//OperasiMatriks.tampilMatriksString(mMhsT);document.write("<br>");		
			var nilP = 0 , cekKode = mMhsT[0][0], kp = mMhsT[0][1] ,mk = mMhsT[0][2];
			iter = 0;
			while(iter < mMhsT.length-1){
				var isiD = mMhsT[iter][0];
				if(!(isiD == "-" || isiD == "")){
					if(isiD == mMhsT[iter+1][0]){
					    nilP++;
						kp = (kp.concat("-")).concat(mMhsT[iter+1][1]);
						mk = mk+"-"+mMhsT[iter+1][2];
					}
					else {
						vKodeMhs.push(cekKode);
						vBanyakNgajar.push(nilP+1);
						if(nilP+1 > maxUjian) {
								pinaltiMhsMax+=500;
								vPinaltiMhsMax.push(cekKode);
								vPinaltiMhsMax.push(nilP+1);
								vPinaltiKP.push(kp);
								vPinaltiMK.push(mk);
							}
						nilP=0;
						cekKode = mMhsT[iter+1][0];
						kp = mMhsT[iter+1][1];
						mk = mMhsT[iter+1][2];
						}
				}
				iter++;
			}
		}
				
	/**********************************************************************
	  matriks mkPinaltiMhsMax ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  	#	baris ke-1 ==> nama Mhs									#
		#	baris ke-2 ==> banyaknya MK yg bentrok pada hari yg sama	#  
	/*********************************************************************/
/*	
document.write("<br>");	
document.write("vKodeMhs : "); OperasiVektor.tampilVektorString(vKodeMhs); document.write("<br>");
document.write("vBanyakNgajar : "); OperasiVektor.tampilVektorString(vBanyakNgajar); document.write("<br>");
document.write("vPinaltiMhsMax : "); OperasiVektor.tampilVektorString(vPinaltiMhsMax); document.write("<br>");
document.write("vPinaltiKP : "); OperasiVektor.tampilVektorString(vPinaltiKP); document.write("<br>");
//*/
	var np = vPinaltiMhsMax.length/2;
	var mkPinaltiMhsMax = OperasiMatriks.isiAwalMatriks(4,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiMhsMax[0][i] = vPinaltiMhsMax[2*i];
		mkPinaltiMhsMax[1][i] = vPinaltiMhsMax[2*i+1];
		mkPinaltiMhsMax[2][i] = vPinaltiKP[i];
		mkPinaltiMhsMax[3][i] = vPinaltiMK[i];
	}
	mkPinaltiMhsMax[0][np] = pinaltiMhsMax;	
	return mkPinaltiMhsMax;
	},
	
   /*
	****************************************************************
						PINALTI UJIAN TEORI
	****************************************************************
	hitung pinalti daya tampung mk terhadap kapasitas ruang
    	sesuai ==> 0
    	tidak sesuai ==> 500   	
		mat Ruang ==> mat ruang
		mat Mk Dosen ==> mat MK dan dosen
		
		output ==> mkPinaltiRuang = (mkPinaltiRuang , pinaltiRuang)
					mkPinaltiRuang ==> array
					pinaltiRuang  ==> skalar
	*/  
	
	hitPinaltiRuangUjian : function(mSlotIsi, mRuang, mMkUjian){
	    //document.write("######### hitTampungRuang ######### <br />");
        var jmk = mMkUjian.length;
        var mkPinaltiRuang = [];
        var pinaltiRuang = 0;
		var iMK = 0, rSlot;
		var bar = mSlotIsi.length;
		var kol = mSlotIsi[0].length;		
       	for(var i=0;i<bar;i++){
			iMK = mSlotIsi[i][4];
			rSlot = mSlotIsi[i][1];
           	//for(var j=0;j<kol;j++) {          
				if(iMK < jmk && iMK != "-") {
//document.write("======= iMK : "+iMK+" dan rSlot : "+rSlot+"<br>");						
                	if(mRuang[rSlot][3] < mMkUjian[iMK][9])
                	     	{ 
                	     	pinaltiRuang +=500;
                	     	mkPinaltiRuang.push(iMK); 
                	     	}
                	}					       
            //}
        }  
		
		var np = mkPinaltiRuang.length;
		var matPinaltiRuang = OperasiMatriks.isiAwalMatriks(2,np+1);
		for(var i=0;i<np;i++){
			matPinaltiRuang[0][i] = "k";
			matPinaltiRuang[1][i] = mkPinaltiRuang[i];
		}
		matPinaltiRuang[0][np] = "pinalti";
		matPinaltiRuang[1][np] = pinaltiRuang;
//document.write("======= pinaltiRuang : "+pinaltiRuang+"<br>");		
//document.write("================= mkPinaltiRuang : "); 
//OperasiVektor.tampilVektor(mkPinaltiRuang); document.write("<br>");		
	// mkPinaltiRuang.push(pinaltiRuang);
//document.write("================= mkPinaltiRuang : "); 
//OperasiVektor.tampilVektor(mkPinaltiRuang); document.write("<br>");	 
	 return matPinaltiRuang;
	},
	/*
   hitung pinalti dosen tidak boleh menjaga UJIAN pada jam yang sama
    	sesuai --> 0
    	tidak sesuai --> 500   	
		maxDosen --> 2 orang
 */  
	hitPinaltiDosenUjian : function(mSlotIsi, mMkUjian, maxDosen)
      {
		//document.write("######### hitPinaltiDosenUjian ######### <br />");         
        var jmk = mMkUjian.length;      
		var vPinaltiDosen = [];
        var pinaltiDosen = 0;
        var iMK = 0, hSlot, jSlot;
		var bar = mSlotIsi.length;
		var kol = mSlotIsi[0].length;		
		var mSlotIsiSort = OperasiMatriks.sortMatriksDuaKolom(mSlotIsi,2,3); //sort Hari		
//document.write("================ mSlotIsiSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(mSlotIsiSort);document.write("<br>");
		var mDosen = Array();
        var iter , id;
		
		for(var i=0;i<jmk ;i++){ 
            mDosen[i] = Array();
            for(var id=0;id<maxDosen;id++){      
				mDosen[i][id] = mMkUjian[i][id+5];
                }
        } 
//document.write("================ mDosen : <br>");
//OperasiMatriks.tampilMatriksString(mDosen);document.write("<br>"); 	
		var mKerja =  OperasiMatriks.isiAwalMatriks(jmk,5);
		iter = 0;
       	for(var i=0;i<bar;i++){
			iMK = mSlotIsiSort[i][4];			
			hSlot = mSlotIsiSort[i][2];
			jSlot = mSlotIsiSort[i][3];			
            if(iMK < jmk) {   
					mKerja[iter][0] = hSlot;
					mKerja[iter][1] = jSlot;
					mKerja[iter][2] = iMK;
					mKerja[iter][3] = mDosen[iMK][0];
					mKerja[iter][4] = mDosen[iMK][1];
//document.write("======= iMK : "+iMK+", id : "+id+", jSlot : "+jSlot+" dan hSlot : "+hSlot+"<br>");					
					iter++;
				}
			}
//document.write("================ mKerja : <br>");
//OperasiMatriks.tampilMatriksString(mKerja);document.write("<br>");			
//document.write("======= mKerja : "+mKerja.length+" dan kol : "+mKerja[0].length+"<br>");	
		var m1, m2, m3, m4,m5,m6, puter;
		for(var i=0;i<jmk-1;i++){
			var vDosenTemp = Array();
			for(var j=i+1;j<jmk;j++){
				puter = 0;
				m1 = mKerja[i][0];
				m2 = mKerja[i][1];
				m3 = mKerja[j][0];
				m4 = mKerja[j][1];
//document.write("======= m1 : "+m1+", m2 : "+m2+", m3 : "+m3+", m4 : "+m4+"<br>");										
				if(m1 == m3 && m2 == m4){ 
					for(var k=0;k<maxDosen;k++){
						vDosenTemp[puter++] =  mKerja[i][k+3];
						vDosenTemp[puter++] =  mKerja[j][k+3];
					}
//document.write("vDosenTemp : "); OperasiVektor.tampilVektorString(vDosenTemp); document.write("<br>");				
					var cekSama = OperasiVektor.cekAdaElemenSamaVektor(vDosenTemp);
//document.write("======= cekSama : "+cekSama+"<br>");					
					if(cekSama){
						pinaltiDosen +=500;
						vPinaltiDosen.push(mKerja[i][2]);
						vPinaltiDosen.push(mKerja[j][2]);
						}
				}
				else break;
			}
		} 
//*/		     
	/****************************************************************
	  matriks mkPinaltiDosen ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  ================= pada jam yang sama =======================
			#	baris ke-1 ==> nama MK I	#
			#	baris ke-2 ==> nama MK II	# 	  
	/****************************************************************/
//*	
	var np = vPinaltiDosen.length/2;
	var mkPinaltiDosen = OperasiMatriks.isiAwalMatriks(2,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiDosen[0][i] = vPinaltiDosen[2*i];
		mkPinaltiDosen[1][i] = vPinaltiDosen[2*i+1];
	}
	mkPinaltiDosen[0][np] = pinaltiDosen;	
	return mkPinaltiDosen;
	},
	/*
   hitung pinalti Pegawai tidak boleh menjaga UJIAN pada jam yang sama
    	sesuai --> 0
    	tidak sesuai --> 500   	
		maxPegawai --> 2 orang
 */  
	hitPinaltiPegawaiUjian : function(mSlotIsi, mMkUjian, maxPegawai)
      {
		//document.write("######### hitPinaltiPegawaiUjian ######### <br />");         
        var jmk = mMkUjian.length;      
		var vPinaltiPegawai = [];
        var pinaltiPegawai = 0;
        var iMK = 0, hSlot, jSlot;
		var bar = mSlotIsi.length;
		var kol = mSlotIsi[0].length;		
		var mSlotIsiSort = OperasiMatriks.sortMatriksDuaKolom(mSlotIsi,2,3); //sort Hari		
//document.write("================ mSlotIsiSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(mSlotIsiSort);document.write("<br>");
		var mPegawai = Array();
        var iter , id;
		
		for(var i=0;i<jmk ;i++){ 
            mPegawai[i] = Array();
            for(var id=0;id<maxPegawai;id++){      
				mPegawai[i][id] = mMkUjian[i][id+7];
                }
        } 
//document.write("================ mPegawai : <br>");
//OperasiMatriks.tampilMatriksString(mPegawai);document.write("<br>"); 	
		var mKerja =  OperasiMatriks.isiAwalMatriks(jmk,5);
		iter = 0;
       	for(var i=0;i<bar;i++){
			iMK = mSlotIsiSort[i][4];			
			hSlot = mSlotIsiSort[i][2];
			jSlot = mSlotIsiSort[i][3];			
            if(iMK < jmk) {   
					mKerja[iter][0] = hSlot;
					mKerja[iter][1] = jSlot;
					mKerja[iter][2] = iMK;
					mKerja[iter][3] = mPegawai[iMK][0];
					mKerja[iter][4] = mPegawai[iMK][1];
//document.write("======= iMK : "+iMK+", id : "+id+", jSlot : "+jSlot+" dan hSlot : "+hSlot+"<br>");					
					iter++;
				}
			}
//document.write("================ mKerja : <br>");
//OperasiMatriks.tampilMatriksString(mKerja);document.write("<br>");			
//document.write("======= mKerja : "+mKerja.length+" dan kol : "+mKerja[0].length+"<br>");	
		var m1, m2, m3, m4,m5,m6, puter;
		for(var i=0;i<jmk-1;i++){
			var vPegawaiTemp = Array();
			for(var j=i+1;j<jmk;j++){
				puter = 0;
				m1 = mKerja[i][0];
				m2 = mKerja[i][1];
				m3 = mKerja[j][0];
				m4 = mKerja[j][1];
//document.write("======= m1 : "+m1+", m2 : "+m2+", m3 : "+m3+", m4 : "+m4+"<br>");										
				if(m1 == m3 && m2 == m4){ 
					for(var k=0;k<maxPegawai;k++){
						vPegawaiTemp[puter++] =  mKerja[i][k+3];
						vPegawaiTemp[puter++] =  mKerja[j][k+3];
					}
//document.write("vPegawaiTemp : "); OperasiVektor.tampilVektorString(vPegawaiTemp); document.write("<br>");				
					var cekSama = OperasiVektor.cekAdaElemenSamaVektor(vPegawaiTemp);
//document.write("======= cekSama : "+cekSama+"<br>");					
					if(cekSama){
						pinaltiPegawai +=500;
						vPinaltiPegawai.push(mKerja[i][2]);
						vPinaltiPegawai.push(mKerja[j][2]);
						}
				}
				else break;
			}
		} 
//*/		     
	/****************************************************************
	  matriks mkPinaltiPegawai ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  ================= pada jam yang sama =======================
			#	baris ke-1 ==> nama MK I	#
			#	baris ke-2 ==> nama MK II	# 	  
	/****************************************************************/
//*	
	var np = vPinaltiPegawai.length/2;
	var mkPinaltiPegawai = OperasiMatriks.isiAwalMatriks(2,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiPegawai[0][i] = vPinaltiPegawai[2*i];
		mkPinaltiPegawai[1][i] = vPinaltiPegawai[2*i+1];
	}
	mkPinaltiPegawai[0][np] = pinaltiPegawai;	
	return mkPinaltiPegawai;
	},
	/*
	   mencari indeks dari iMK di matriks mMkUjian
	*/
	indeksTempatMK : function(mMkUjian, iMK){
		var indeks, bar = mMkUjian.length;
		for(var i=0;i<bar;i++){
			if(mMkUjian[i][4] == iMK) indeks = i;
		}
		return indeks;
	},
	/*
   hitung pinalti dosen boleh menjaga ujian sebanyak 2 (maxNgajar) kali sehari
    	sesuai --> 0
    	tidak sesuai --> 500   	

		var myFish = ['angel', 'clown', 'drum', 'mandarin', 'sturgeon'];
		var removed = myFish.splice(3, 1);
			// removed is ["mandarin"]
			// myFish is ["angel", "clown", "drum", "sturgeon"]
			
	mSlotIsi --> kolom ==> 0 : No , 1 : Ruang , 2 : Hari, 3 : Jam dan 4 : No urut MatKul 
	mMkUjian --> matriks yang berisi MatKul yang akan diujikan 
	maxDosenJaga --> banyaknya dosen yang menjaga di suatu MatKul 
	maxJaga --> maksimum seorang dosen menjaga dalam satu hari	
	=====================================
		mDosenTemp	=== HARUS di-sort
	=====================================	
 */  
	hitPinaltiDosenMaxUjian : function(mSlotIsi, mMkUjian, maxDosenJaga, maxJaga)
      {
		//document.write("######### hitPinaltiDosen max ngajar ######### <br />");         
        var jmk = mMkUjian.length;       
		var vPinaltiDosenMax = [];	
		var vKodeDosen = [];	
		var vBanyakNgajar = [];		
        var pinaltiDosenMax = 0;
		var iMK = 0, hSlot, jSlot;
		var bar = mSlotIsi.length;
		var kol = mSlotIsi[0].length;		
		var mSlotIsiSort = OperasiMatriks.sortMatriksDuaKolom(mSlotIsi,2,3); //sort Hari
		
//document.write("================ mSlotIsiSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(mSlotIsiSort);document.write("<br>");
		var vInput = OperasiMatriks.ambilVektorKolom(mSlotIsiSort,2); // ambil kolom Hari
		var mKelHari = OperasiMatriks.buatMatKelompokDanBanyaknya(vInput); // kelompok per Hari dan banyaknya anggota kelompok
//document.write("vInput : "); OperasiVektor.tampilVektorString(vInput); document.write("<br>");		
//document.write("================ mKelHari : <br>");
//OperasiMatriks.tampilMatriksString(mKelHari);document.write("<br>");

		var mDosen = Array();
        var iter , id;		
		for(var i=0;i<jmk ;i++){ 
            mDosen[i] = Array();
            for(var id=0;id<maxDosenJaga;id++){      
				mDosen[i][id] = mMkUjian[i][id+5];
                }
        } 
//document.write("================ mDosen : <br>");
//OperasiMatriks.tampilMatriksString(mDosen);document.write("<br>"); 
		var nKelHari = mKelHari.length, awal, akhir,puter,iter;
		for(var k=0;k<nKelHari;k++){
			puter = 0;
			var mDosenTemp = Array();
			awal = mKelHari[k][1];
			akhir = awal + mKelHari[k][2];
//document.write("================ awal : "+awal+" dan akhir : "+akhir+"<br>");
			
			for(var i=awal;i<akhir;i++){
				iMK = mSlotIsiSort[i][4];
				if(iMK < jmk) {
//document.write("================ maxDosenJaga : "+maxDosenJaga+", puter : "+puter+" dan iMK : "+iMK+"<br>");								
					for(var j=0;j<maxDosenJaga;j++) {
						mDosenTemp[puter] = mDosen[iMK][j];
						puter++;
					}
				}
			}
			OperasiVektor.urutDescString(mDosenTemp); // sort string desc
//document.write("mDosenTemp : "); OperasiVektor.tampilVektorString(mDosenTemp); document.write("<br>"); 			
			var nilP = 0 , cekKode = mDosenTemp[0] ;
			iter = 0;
			while(iter < mDosenTemp.length-1){
				var isiD = mDosenTemp[iter];
				if(!(isiD == "-" || isiD == "")){
					if(isiD == mDosenTemp[iter+1]){
					    nilP++;						
					}
					else {
						vKodeDosen.push(cekKode);
						vBanyakNgajar.push(nilP+1);
						if(nilP+1 > maxJaga) {
								pinaltiDosenMax+=500;
								vPinaltiDosenMax.push(cekKode);
								vPinaltiDosenMax.push(nilP+1);
							}
						nilP=0;
						cekKode = mDosenTemp[iter+1];
						}
				}
				iter++;
			}
		}
				
	/**********************************************************************
	  matriks mkPinaltiDosenMax ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  	#	baris ke-1 ==> nama Dosen									#
		#	baris ke-2 ==> banyaknya MK yg bentrok pada hari yg sama	#  
	/*********************************************************************/
/*	
document.write("<br>");	
document.write("vKodeDosen : "); OperasiVektor.tampilVektorString(vKodeDosen); document.write("<br>");
document.write("vBanyakNgajar : "); OperasiVektor.tampilVektorString(vBanyakNgajar); document.write("<br>");
document.write("vPinaltiDosenMax : "); OperasiVektor.tampilVektorString(vPinaltiDosenMax); document.write("<br>");
//*/
	var np = vPinaltiDosenMax.length/2;
	var mkPinaltiDosenMax = OperasiMatriks.isiAwalMatriks(2,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiDosenMax[0][i] = vPinaltiDosenMax[2*i];
		mkPinaltiDosenMax[1][i] = vPinaltiDosenMax[2*i+1];
	}
	mkPinaltiDosenMax[0][np] = pinaltiDosenMax;	
	return mkPinaltiDosenMax;
	},
	/*
    hitung pinalti Mahasiswa tidak boleh menempuh UJIAN pada jam yang sama
    	sesuai --> 0
    	tidak sesuai --> 500   	
		
 */  
	hitPinaltiMhsUjian : function(mSlotIsi, mMkUjian)
      {
		//document.write("######### hitPinaltiMhsUjian ######### <br />");         
        var jmk = mMkUjian.length;      
		var vPinaltiMhs = [];
        var pinaltiMhs = 0;
        var iMK = 0, hSlot, jSlot;
		var bar = mSlotIsi.length;
		var kol = mSlotIsi[0].length;		
		var mSlotIsiSort = OperasiMatriks.sortMatriksDuaKolom(mSlotIsi,2,3); //sort Hari
		
//document.write("================ mSlotIsiSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(mSlotIsiSort);document.write("<br>");
		var vMhs = Array();
        var iter , id;
		
		for(var i=0;i<jmk ;i++){ 
            vMhs[i] = mMkUjian[i][4]; //[10]; ==> 4 untuk semester dan 10 untuk tahun angkatan
			}
//document.write("vMhs : "); OperasiVektor.tampilVektorString(vMhs); document.write("<br>");			
		var mKerja =  OperasiMatriks.isiAwalMatriks(jmk,4);
		iter = 0;
       	for(var i=0;i<bar;i++){
			iMK = mSlotIsiSort[i][4];			
			hSlot = mSlotIsiSort[i][2];
			jSlot = mSlotIsiSort[i][3];			
            if(iMK < jmk) {   
					mKerja[iter][0] = hSlot;
					mKerja[iter][1] = jSlot;
					mKerja[iter][2] = iMK;
					mKerja[iter][3] = vMhs[iMK];
//document.write("======= iMK : "+iMK+", id : "+id+", jSlot : "+jSlot+" dan hSlot : "+hSlot+"<br>");					
					iter++;
				}
			}
//document.write("================ mKerja : <br>");
//OperasiMatriks.tampilMatriksString(mKerja);document.write("<br>");			
//document.write("======= mKerja : "+mKerja.length+" dan kol : "+mKerja[0].length+"<br>");					
		var m1, m2, m3, m4,puter;
		for(var i=0;i<jmk-1;i++){						
			for(var j=i+1;j<jmk;j++){	
				var vMhsTemp = Array();
				m1 = mKerja[i][0];
				m2 = mKerja[i][1];
				m3 = mKerja[j][0];
				m4 = mKerja[j][1];
//document.write("======= m1 : "+m1+", m2 : "+m2+", m3 : "+m3+" dan m4 : "+m4+"<br>");														
				if(m1 == m3 && m2 == m4){ 
					puter=0;
					for(var k=0;k<2;k++){
						vMhsTemp[puter++] =  mKerja[i+k][3];
					}
//document.write("vMhsTemp : "); OperasiVektor.tampilVektorString(vMhsTemp); document.write("<br>");				
//document.write("======= m1 : "+m1+", m2 : "+m2+", m3 : "+m3+", m4 : "+m4+"<br>");					
					var cekSama = OperasiVektor.cekAdaElemenSamaVektor(vMhsTemp);	
//document.write("======= cekSama : "+cekSama+"<br>");				  
			  //if(m1 == m3 && m2 == m4){
					if(cekSama){
						pinaltiMhs +=500;
						vPinaltiMhs.push(mKerja[i][2]);
						vPinaltiMhs.push(mKerja[j][2]);
						}
				}
				else break;
			}
		} 
//*/		     
	/****************************************************************
	  matriks mkPinaltiMhs ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  ================= pada jam yang sama =======================
			#	baris ke-1 ==> nama MK I	#
			#	baris ke-2 ==> nama MK II	# 	  
	/****************************************************************/
//*	
	var np = vPinaltiMhs.length/2;
	var mkPinaltiMhs = OperasiMatriks.isiAwalMatriks(2,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiMhs[0][i] = vPinaltiMhs[2*i];
		mkPinaltiMhs[1][i] = vPinaltiMhs[2*i+1];
	}
	mkPinaltiMhs[0][np] = pinaltiMhs;	
	return mkPinaltiMhs;
	},
	/*
   hitung pinalti Mahasiswa boleh menempuh ujian sebanyak 2 (maxUjian) kali sehari
    	sesuai --> 0
    	tidak sesuai --> 500   	
			
	mSlotIsi --> kolom ==> 0 : No , 1 : Ruang , 2 : Hari, 3 : Jam dan 4 : No urut MatKul 
	mMkUjian --> matriks yang berisi MatKul yang akan diujikan 
	//maxMhsUjian --> banyaknya mahasiswa yang menempuh ujian di suatu MatKul 
	maxUjian --> maksimum seorang mahasiswa menempuh ujian dalam satu hari	
	=====================================
		mMhsTemp	=== HARUS di-sort
	=====================================	
 */  
	hitPinaltiMhsMaxUjian : function(mSlotIsi, mMkUjian, maxUjian)
      {
		//document.write("######### hitPinaltiMhs max ngajar ######### <br />");         
        var jmk = mMkUjian.length;       
		var vPinaltiMhsMax = [];	
		var vKodeMhs = [];	
		var vBanyakNgajar = [];		
        var pinaltiMhsMax = 0;
		var iMK = 0, hSlot, jSlot;
		var bar = mSlotIsi.length;
		var kol = mSlotIsi[0].length;		
		var mSlotIsiSort = OperasiMatriks.sortMatriksDuaKolom(mSlotIsi,2,3); //sort Hari
		
//document.write("================ mSlotIsiSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(mSlotIsiSort);document.write("<br>");
		var vInput = OperasiMatriks.ambilVektorKolom(mSlotIsiSort,2);
		var mKelHari = OperasiMatriks.buatMatKelompokDanBanyaknya(vInput);
//document.write("================ mKelHari : <br>");
//OperasiMatriks.tampilMatriksString(mKelHari);document.write("<br>");

		var mMhs = Array();
        var iter , id;		
		for(var i=0;i<jmk ;i++){ 
            mMhs[i] = mMkUjian[i][4];
            
        } 
//document.write("mMhs : "); OperasiVektor.tampilVektorString(mMhs); document.write("<br>");		 
		var nKelHari = mKelHari.length, awal, akhir,puter,iter;
		for(var k=0;k<nKelHari;k++){
			puter = 0;
			var mMhsTemp = Array();
			awal = mKelHari[k][1];
			akhir = awal + mKelHari[k][2];
//document.write("====== awal : "+awal+" dan akhir : "+akhir+"<br>");
			
			for(var i=awal;i<akhir;i++){
				iMK = mSlotIsiSort[i][4];
				if(iMK < jmk) {
//document.write("================ puter : "+puter+" dan iMK : "+iMK+"<br>");								
					//for(var j=0;j<maxMhsUjian;j++) {
						mMhsTemp[puter++] = mMhs[iMK];
						//puter++;
					//}
				}
			}
			OperasiVektor.urutDescString(mMhsTemp); // sort string desc
//document.write("mMhsTemp : "); OperasiVektor.tampilVektorString(mMhsTemp); document.write("<br>"); 			
			var nilP = 0 , cekKode = mMhsTemp[0] ;
			iter = 0;
			while(iter < mMhsTemp.length-1){
				var isiD = mMhsTemp[iter];
				if(!(isiD == "-" || isiD == "")){
					if(isiD == mMhsTemp[iter+1]){
					    nilP++;						
					}
					else {
						vKodeMhs.push(cekKode);
						vBanyakNgajar.push(nilP+1);
						if(nilP+1 > maxUjian) {
								pinaltiMhsMax+=500;
								vPinaltiMhsMax.push(cekKode);
								vPinaltiMhsMax.push(nilP+1);
							}
						nilP=0;
						cekKode = mMhsTemp[iter+1];
						}
				}
				iter++;
			}
		}
				
	/**********************************************************************
	  matriks mkPinaltiMhsMax ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  	#	baris ke-1 ==> nama Mhs									#
		#	baris ke-2 ==> banyaknya MK yg bentrok pada hari yg sama	#  
	/*********************************************************************/
/*	
document.write("<br>");	
document.write("vKodeMhs : "); OperasiVektor.tampilVektorString(vKodeMhs); document.write("<br>");
document.write("vBanyakNgajar : "); OperasiVektor.tampilVektorString(vBanyakNgajar); document.write("<br>");
document.write("vPinaltiMhsMax : "); OperasiVektor.tampilVektorString(vPinaltiMhsMax); document.write("<br>");
//*/
	var np = vPinaltiMhsMax.length/2;
	var mkPinaltiMhsMax = OperasiMatriks.isiAwalMatriks(2,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiMhsMax[0][i] = vPinaltiMhsMax[2*i];
		mkPinaltiMhsMax[1][i] = vPinaltiMhsMax[2*i+1];
	}
	mkPinaltiMhsMax[0][np] = pinaltiMhsMax;	
	return mkPinaltiMhsMax;
	},
	/*
	****************************************************************
						PINALTI UJIAN PRAKTEK
	****************************************************************
	hitung pinalti daya tampung mk terhadap kapasitas labkom
    	sesuai ==> 0
    	tidak sesuai ==> 500   	
		mat labkom ==> mat labkom
		mat Mk Dosen ==> mat MK dan dosen
		
		output ==> mkPinaltiLabkom = (mkPinaltiLabkom , pinaltiLabkom)
					mkPinaltiLabkom ==> array
					pinaltiLabkom  ==> skalar
	*/  
	
	hitPinaltiLabkomUjian : function(matSlotIsiP, mLabkom, mMkUjianPraktek)
		{
	    //document.write("######### hitTampungLabkom ######### <br />");
/*		
document.write("================ matSlotIsiP : <br>");
OperasiMatriks.tampilMatriksString(matSlotIsiP);document.write("<br>");	
document.write("================ mLabkom : <br>");
OperasiMatriks.tampilMatriksString(mLabkom);document.write("<br>");
document.write("================ mMkUjianPraktek : <br>");
OperasiMatriks.tampilMatriksString(mMkUjianPraktek);document.write("<br>");	
//*/		
        var jmk = mMkUjianPraktek.length;
        var mkPinaltiLabkom = [];
        var pinaltiLabkom = 0;
		var iMK = 0, rSlot;
		var bar = matSlotIsiP.length;
		var kol = matSlotIsiP[0].length;		
       	for(var i=0;i<bar;i++){
			iMK = matSlotIsiP[i][4];
			rSlot = matSlotIsiP[i][1];
           	//for(var j=0;j<kol;j++) {          
				if(iMK < jmk && iMK != "-") {
//document.write("======= iMK : "+iMK+" dan rSlot : "+rSlot+"<br>");						
                	if(mLabkom[rSlot][2] < mMkUjianPraktek[iMK][9])
                	     	{ 
                	     	pinaltiLabkom +=500;
                	     	mkPinaltiLabkom.push(iMK); 
                	     	}
                	}					       
            //}
        }  
		
		var np = mkPinaltiLabkom.length;
		var matPinaltiLabkom = OperasiMatriks.isiAwalMatriks(2,np+1);
		for(var i=0;i<np;i++){
			matPinaltiLabkom[0][i] = "p";
			matPinaltiLabkom[1][i] = mkPinaltiLabkom[i];
		}
		matPinaltiLabkom[0][np] = "pinalti";
		matPinaltiLabkom[1][np] = pinaltiLabkom;
//document.write("======= pinaltiLabkom : "+pinaltiLabkom+"<br>");		
//document.write("================= mkPinaltiLabkom : "); 
//OperasiVektor.tampilVektor(mkPinaltiLabkom); document.write("<br>");		
	 //mkPinaltiLabkom.push(pinaltiLabkom);
//document.write("================= mkPinaltiLabkom : "); 
//OperasiVektor.tampilVektor(mkPinaltiLabkom); document.write("<br>");	 
	 return matPinaltiLabkom;
	},
	/*
   hitung pinalti dosen tidak boleh menjaga UjianPraktek pada jam yang sama
    	sesuai --> 0
    	tidak sesuai --> 500   	
		maxDosen --> 2 orang
 */  
	hitPinaltiDosenUjianPraktek : function(matSlotIsiP, mMkUjianPraktek, maxDosen)
      {
		//document.write("######### hitPinaltiDosenUjianPraktek ######### <br />");         
        var jmk = mMkUjianPraktek.length;      
		var vPinaltiDosen = [];
        var pinaltiDosen = 0;
        var iMK = 0, hSlot, jSlot;
		var bar = matSlotIsiP.length;
		var kol = matSlotIsiP[0].length;		
		var matSlotIsiPSort = OperasiMatriks.sortMatriksDuaKolom(matSlotIsiP,2,3); //sort Hari		
//document.write("================ matSlotIsiPSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(matSlotIsiPSort);document.write("<br>");
		var mDosen = Array();
        var iter , id;
		
		for(var i=0;i<jmk ;i++){ 
            mDosen[i] = Array();
            for(var id=0;id<maxDosen;id++){      
				mDosen[i][id] = mMkUjianPraktek[i][id+5];
                }
        } 
//document.write("================ mDosen : <br>");
//OperasiMatriks.tampilMatriksString(mDosen);document.write("<br>"); 	
		var mKerja =  OperasiMatriks.isiAwalMatriks(jmk,5);
		iter = 0;
       	for(var i=0;i<bar;i++){
			iMK = matSlotIsiPSort[i][4];			
			hSlot = matSlotIsiPSort[i][2];
			jSlot = matSlotIsiPSort[i][3];			
            if(iMK < jmk) {   
					mKerja[iter][0] = hSlot;
					mKerja[iter][1] = jSlot;
					mKerja[iter][2] = iMK;
					mKerja[iter][3] = mDosen[iMK][0];
					mKerja[iter][4] = mDosen[iMK][1];
//document.write("======= iMK : "+iMK+", id : "+id+", jSlot : "+jSlot+" dan hSlot : "+hSlot+"<br>");					
					iter++;
				}
			}
//document.write("================ mKerja : <br>");
//OperasiMatriks.tampilMatriksString(mKerja);document.write("<br>");			
//document.write("======= mKerja : "+mKerja.length+" dan kol : "+mKerja[0].length+"<br>");	
		var m1, m2, m3, m4,m5,m6, puter;
		for(var i=0;i<jmk-1;i++){
			var vDosenTemp = Array();
			for(var j=i+1;j<jmk;j++){
				puter = 0;
				m1 = mKerja[i][0];
				m2 = mKerja[i][1];
				m3 = mKerja[j][0];
				m4 = mKerja[j][1];
//document.write("======= m1 : "+m1+", m2 : "+m2+", m3 : "+m3+", m4 : "+m4+"<br>");										
				if(m1 == m3 && m2 == m4){ 
					for(var k=0;k<maxDosen;k++){
						vDosenTemp[puter++] =  mKerja[i][k+3];
						vDosenTemp[puter++] =  mKerja[j][k+3];
					}
//document.write("vDosenTemp : "); OperasiVektor.tampilVektorString(vDosenTemp); document.write("<br>");				
					var cekSama = OperasiVektor.cekAdaElemenSamaVektor(vDosenTemp);
//document.write("======= cekSama : "+cekSama+"<br>");					
					if(cekSama){
						pinaltiDosen +=500;
						vPinaltiDosen.push(mKerja[i][2]);
						vPinaltiDosen.push(mKerja[j][2]);
						}
				}
				else break;
			}
		} 
//*/		     
	/****************************************************************
	  matriks mkPinaltiDosen ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  ================= pada jam yang sama =======================
			#	baris ke-1 ==> nama MK I	#
			#	baris ke-2 ==> nama MK II	# 	  
	/****************************************************************/
//*	
	var np = vPinaltiDosen.length/2;
	var mkPinaltiDosen = OperasiMatriks.isiAwalMatriks(2,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiDosen[0][i] = vPinaltiDosen[2*i];
		mkPinaltiDosen[1][i] = vPinaltiDosen[2*i+1];
	}
	mkPinaltiDosen[0][np] = pinaltiDosen;	
	return mkPinaltiDosen;
	},
	/*
	   mencari indeks dari iMK di matriks mMkUjianPraktek
	*/
	indeksTempatMK : function(mMkUjianPraktek, iMK){
		var indeks, bar = mMkUjianPraktek.length;
		for(var i=0;i<bar;i++){
			if(mMkUjianPraktek[i][4] == iMK) indeks = i;
		}
		return indeks;
	},
		/*
----------------------------------------------------------------------------------	
   hitung pinalti dosen boleh menjaga UjianPraktek sebanyak 2 (maxJaga) kali sehari
    	sesuai --> 0
    	tidak sesuai --> 500   	

	matSlotIsiP --> kolom ==> 0 : No , 1 : Labkom , 2 : Hari, 3 : Jam dan 4 : No urut MatKul 
	mMkUjianPraktek --> matriks yang berisi MatKul yang akan diujikan 
	maxDosenJaga --> banyaknya dosen yang menjaga di suatu MatKul 
	maxJaga --> maksimum seorang dosen menjaga dalam satu hari	
	=====================================
		mDosenTemp	=== HARUS di-sort
	=====================================	
----------------------------------------------------------------------------------	
 */  
	hitPinaltiDosenMaxUjianPraktek : function(matSlotIsiP, mMkUjianPraktek, maxDosenJaga, maxJaga)
      {
		//document.write("######### hitPinaltiDosen max ngajar ######### <br />");         
        var jmk = mMkUjianPraktek.length;       
		var vPinaltiDosenMax = [];	
		var vKodeDosen = [];	
		var vBanyakNgajar = [];		
        var pinaltiDosenMax = 0;
		var iMK = 0, hSlot, jSlot;
		var bar = matSlotIsiP.length;
		var kol = matSlotIsiP[0].length;		
		var matSlotIsiPSort = OperasiMatriks.sortMatriksDuaKolom(matSlotIsiP,2,3); //sort Hari
		
//document.write("================ matSlotIsiPSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(matSlotIsiPSort);document.write("<br>");
		var vInput = OperasiMatriks.ambilVektorKolom(matSlotIsiPSort,2); // ambil kolom Hari
		var mKelHari = OperasiMatriks.buatMatKelompokDanBanyaknya(vInput); // kelompok per Hari dan banyaknya anggota kelompok
//document.write("vInput : "); OperasiVektor.tampilVektorString(vInput); document.write("<br>");		
//document.write("================ mKelHari : <br>");
//OperasiMatriks.tampilMatriksString(mKelHari);document.write("<br>");

		var mDosen = Array();
        var iter , id;		
		for(var i=0;i<jmk ;i++){ 
            mDosen[i] = Array();
            for(var id=0;id<maxDosenJaga;id++){      
				mDosen[i][id] = mMkUjianPraktek[i][id+5];
                }
        } 
//document.write("================ mDosen : <br>");
//OperasiMatriks.tampilMatriksString(mDosen);document.write("<br>"); 
		var nKelHari = mKelHari.length, awal, akhir,puter,iter;
		for(var k=0;k<nKelHari;k++){
			puter = 0;
			var mDosenTemp = Array();
			awal = mKelHari[k][1];
			akhir = awal + mKelHari[k][2];
//document.write("================ awal : "+awal+" dan akhir : "+akhir+"<br>");
			
			for(var i=awal;i<akhir;i++){
				iMK = matSlotIsiPSort[i][4];
				if(iMK < jmk) {
//document.write("================ maxDosenJaga : "+maxDosenJaga+", puter : "+puter+" dan iMK : "+iMK+"<br>");								
					for(var j=0;j<maxDosenJaga;j++) {
						mDosenTemp[puter] = mDosen[iMK][j];
						puter++;
					}
				}
			}
			OperasiVektor.urutDescString(mDosenTemp); // sort string desc
//document.write("mDosenTemp : "); OperasiVektor.tampilVektorString(mDosenTemp); document.write("<br>"); 			
			var nilP = 0 , cekKode = mDosenTemp[0] ;
			iter = 0;
			while(iter < mDosenTemp.length-1){
				var isiD = mDosenTemp[iter];
				if(!(isiD == "-" || isiD == "")){
					if(isiD == mDosenTemp[iter+1]){
					    nilP++;						
					}
					else {
						vKodeDosen.push(cekKode);
						vBanyakNgajar.push(nilP+1);
						if(nilP+1 > maxJaga) {
								pinaltiDosenMax+=500;
								vPinaltiDosenMax.push(cekKode);
								vPinaltiDosenMax.push(nilP+1);
							}
						nilP=0;
						cekKode = mDosenTemp[iter+1];
						}
				}
				iter++;
			}
		}
				
	/**********************************************************************
	  matriks mkPinaltiDosenMax ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  	#	baris ke-1 ==> nama Dosen									#
		#	baris ke-2 ==> banyaknya MK yg bentrok pada hari yg sama	#  
	/*********************************************************************/
/*	
document.write("<br>");	
document.write("vKodeDosen : "); OperasiVektor.tampilVektorString(vKodeDosen); document.write("<br>");
document.write("vBanyakNgajar : "); OperasiVektor.tampilVektorString(vBanyakNgajar); document.write("<br>");
document.write("vPinaltiDosenMax : "); OperasiVektor.tampilVektorString(vPinaltiDosenMax); document.write("<br>");
//*/
	var np = vPinaltiDosenMax.length/2;
	var mkPinaltiDosenMax = OperasiMatriks.isiAwalMatriks(2,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiDosenMax[0][i] = vPinaltiDosenMax[2*i];
		mkPinaltiDosenMax[1][i] = vPinaltiDosenMax[2*i+1];
	}
	mkPinaltiDosenMax[0][np] = pinaltiDosenMax;	
	return mkPinaltiDosenMax;
	},
		/*
    hitung pinalti Mahasiswa tidak boleh UjianPraktek pada jam yang sama
    	sesuai --> 0
    	tidak sesuai --> 500   	
		
 */  
	hitPinaltiMhsUjianPraktek : function(matSlotIsiP,mMkUjianPraktek)
      {
		//document.write("######### hitPinaltiMhsUjianPraktek ######### <br />");         
        var jmk = mMkUjianPraktek.length;      
		var vPinaltiMhs = [];
        var pinaltiMhs = 0;
        var iMK = 0, hSlot, jSlot;
		var bar = matSlotIsiP.length;
		var kol = matSlotIsiP[0].length;		
		var matSlotIsiPSort = OperasiMatriks.sortMatriksDuaKolom(matSlotIsiP,2,3); //sort Hari
		
//document.write("================ matSlotIsiPSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(matSlotIsiPSort);document.write("<br>");
		var vMhs = Array();
        var iter , id;
		
		for(var i=0;i<jmk ;i++){ 
            vMhs[i] = mMkUjianPraktek[i][4]; //[10]; ==> 4 untuk semester dan 10 untuk tahun angkatan
			}
//document.write("vMhs : "); OperasiVektor.tampilVektorString(vMhs); document.write("<br>");			
		var mKerja =  OperasiMatriks.isiAwalMatriks(jmk,4);
		iter = 0;
       	for(var i=0;i<bar;i++){
			iMK = matSlotIsiPSort[i][4];			
			hSlot = matSlotIsiPSort[i][2];
			jSlot = matSlotIsiPSort[i][3];			
            if(iMK < jmk) {   
					mKerja[iter][0] = hSlot;
					mKerja[iter][1] = jSlot;
					mKerja[iter][2] = iMK;
					mKerja[iter][3] = vMhs[iMK];
//document.write("======= iMK : "+iMK+", id : "+id+", jSlot : "+jSlot+" dan hSlot : "+hSlot+"<br>");					
					iter++;
				}
			}
//document.write("================ mKerja : <br>");
//OperasiMatriks.tampilMatriksString(mKerja);document.write("<br>");			
//document.write("======= mKerja : "+mKerja.length+" dan kol : "+mKerja[0].length+"<br>");					
		var m1, m2, m3, m4,puter;
		for(var i=0;i<jmk-1;i++){						
			for(var j=i+1;j<jmk;j++){	
				var vMhsTemp = Array();
				m1 = mKerja[i][0];
				m2 = mKerja[i][1];
				m3 = mKerja[j][0];
				m4 = mKerja[j][1];
//document.write("======= m1 : "+m1+", m2 : "+m2+", m3 : "+m3+" dan m4 : "+m4+"<br>");														
				if(m1 == m3 && m2 == m4){ 
					puter=0;
					for(var k=0;k<2;k++){
						vMhsTemp[puter++] =  mKerja[i+k][3];
					}
//document.write("vMhsTemp : "); OperasiVektor.tampilVektorString(vMhsTemp); document.write("<br>");				
//document.write("======= m1 : "+m1+", m2 : "+m2+", m3 : "+m3+", m4 : "+m4+"<br>");					
					var cekSama = OperasiVektor.cekAdaElemenSamaVektor(vMhsTemp);	
//document.write("======= cekSama : "+cekSama+"<br>");				  
			  //if(m1 == m3 && m2 == m4){
					if(cekSama){
						pinaltiMhs +=500;
						vPinaltiMhs.push(mKerja[i][2]);
						vPinaltiMhs.push(mKerja[j][2]);
						}
				}
				else break;
			}
		} 
//*/		     
	/****************************************************************
	  matriks mkPinaltiMhs ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  ================= pada jam yang sama =======================
			#	baris ke-1 ==> nama MK I	#
			#	baris ke-2 ==> nama MK II	# 	  
	/****************************************************************/
//*	
	var np = vPinaltiMhs.length/2;
	var mkPinaltiMhs = OperasiMatriks.isiAwalMatriks(2,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiMhs[0][i] = vPinaltiMhs[2*i];
		mkPinaltiMhs[1][i] = vPinaltiMhs[2*i+1];
	}
	mkPinaltiMhs[0][np] = pinaltiMhs;	
	return mkPinaltiMhs;
	},
		/* 
------------------------------------------------------------------------------------------------	
   hitung pinalti Mahasiswa boleh menempuh UjianPraktek sebanyak 2 (maxUjianPraktek) kali sehari
    	sesuai --> 0
    	tidak sesuai --> 500   	
			
	matSlotIsiP --> kolom ==> 0 : No , 1 : Labkom , 2 : Hari, 3 : Jam dan 4 : No urut MatKul 
	mMkUjianPraktek --> matriks yang berisi MatKul yang akan diujikan 
	maxMhsUjianPraktek --> banyaknya mahasiswa yang menempuh UjianPraktek di suatu MatKul 
	maxUjianPraktek --> maksimum seorang mahasiswa menempuh UjianPraktek dalam satu hari	
	=====================================
		mMhsTemp	=== HARUS di-sort
	=====================================	
------------------------------------------------------------------------------------------------	
 */  
	hitPinaltiMhsMaxUjianPraktek : function(matSlotIsiP, mMkUjianPraktek, maxUjianPraktek)
      {
		//document.write("######### hitPinaltiMhs max ngajar ######### <br />");         
        var jmk = mMkUjianPraktek.length;       
		var vPinaltiMhsMax = [];	
		var vKodeMhs = [];	
		var vBanyakNgajar = [];		
        var pinaltiMhsMax = 0;
		var iMK = 0, hSlot, jSlot;
		var bar = matSlotIsiP.length;
		var kol = matSlotIsiP[0].length;		
		var matSlotIsiPSort = OperasiMatriks.sortMatriksDuaKolom(matSlotIsiP,2,3); //sort Hari
		
//document.write("================ matSlotIsiPSort Hari : <br>");
//OperasiMatriks.tampilMatriksString(matSlotIsiPSort);document.write("<br>");
		var vInput = OperasiMatriks.ambilVektorKolom(matSlotIsiPSort,2);
		var mKelHari = OperasiMatriks.buatMatKelompokDanBanyaknya(vInput);
//document.write("================ mKelHari : <br>");
//OperasiMatriks.tampilMatriksString(mKelHari);document.write("<br>");

		var mMhs = Array();
        var iter , id;		
		for(var i=0;i<jmk ;i++){ 
            mMhs[i] = mMkUjianPraktek[i][4];
            
        } 
//document.write("mMhs : "); OperasiVektor.tampilVektorString(mMhs); document.write("<br>");		 
		var nKelHari = mKelHari.length, awal, akhir,puter,iter;
		for(var k=0;k<nKelHari;k++){
			puter = 0;
			var mMhsTemp = Array();
			awal = mKelHari[k][1];
			akhir = awal + mKelHari[k][2];
//document.write("====== awal : "+awal+" dan akhir : "+akhir+"<br>");
			
			for(var i=awal;i<akhir;i++){
				iMK = matSlotIsiPSort[i][4];
				if(iMK < jmk) {
//document.write("================ puter : "+puter+" dan iMK : "+iMK+"<br>");								
					//for(var j=0;j<maxMhsUjianPraktek;j++) {
						mMhsTemp[puter++] = mMhs[iMK];
						//puter++;
					//}
				}
			}
			OperasiVektor.urutDescString(mMhsTemp); // sort string desc
//document.write("mMhsTemp : "); OperasiVektor.tampilVektorString(mMhsTemp); document.write("<br>"); 			
			var nilP = 0 , cekKode = mMhsTemp[0] ;
			iter = 0;
			while(iter < mMhsTemp.length-1){
				var isiD = mMhsTemp[iter];
				if(!(isiD == "-" || isiD == "")){
					if(isiD == mMhsTemp[iter+1]){
					    nilP++;						
					}
					else {
						vKodeMhs.push(cekKode);
						vBanyakNgajar.push(nilP+1);
						if(nilP+1 > maxUjianPraktek) {
								pinaltiMhsMax+=500;
								vPinaltiMhsMax.push(cekKode);
								vPinaltiMhsMax.push(nilP+1);
							}
						nilP=0;
						cekKode = mMhsTemp[iter+1];
						}
				}
				iter++;
			}
		}
				
	/**********************************************************************
	  matriks mkPinaltiMhsMax ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  	#	baris ke-1 ==> nama Mhs									#
		#	baris ke-2 ==> banyaknya MK yg bentrok pada hari yg sama	#  
	/*********************************************************************/
/*	
document.write("<br>");	
document.write("vKodeMhs : "); OperasiVektor.tampilVektorString(vKodeMhs); document.write("<br>");
document.write("vBanyakNgajar : "); OperasiVektor.tampilVektorString(vBanyakNgajar); document.write("<br>");
document.write("vPinaltiMhsMax : "); OperasiVektor.tampilVektorString(vPinaltiMhsMax); document.write("<br>");
//*/
	var np = vPinaltiMhsMax.length/2;
	var mkPinaltiMhsMax = OperasiMatriks.isiAwalMatriks(2,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiMhsMax[0][i] = vPinaltiMhsMax[2*i];
		mkPinaltiMhsMax[1][i] = vPinaltiMhsMax[2*i+1];
	}
	mkPinaltiMhsMax[0][np] = pinaltiMhsMax;	
	return mkPinaltiMhsMax;
	},
   /*
    ===============================================================
								UJIAN
	===============================================================
   */
   /*
		generate bilangan berualang sebanyak k
		nPeg ==> banyaknya pengawas 
		nMK ==> banyaknya MK
	*/
	generateVektorBulatUlang : function(nMK , nPeg){ 
		var k = Math.ceil(nMK/nPeg);
		var vIndT = this.generateIndBulat(k*nPeg), indeks = 0;
		var vInd = OperasiVektor.isiAwal(nMK);
//document.write("vIndT : <br />");
//OperasiVektor.tampilVektor(vIndT);document.write("<br />");		
		for(var i=0;i<k;i++) {
			for(var j=0;j<nPeg;j++){
			  if(indeks < nMK) vInd[indeks] = vIndT[indeks]%nPeg;
			  indeks++;
			}
		}
		return vInd;
	},	
	/*
----------------------------------------------------------------------------------	
		kolom pertama --> bilangan bulat berulang
		kolom kedua --> bilangan bulat berulang 
						tapi harus beda dengan kolom pertama
----------------------------------------------------------------------------------						
	*/
	generateMatriksBulatUlang : function(nMK , nPeg){ 
		var vCek = OperasiVektor.isiAwal(nMK);		
		var batas, puter = 0;
		var matPeg = OperasiMatriks.isiAwalMatriks(nMK, 2);
		var v1 = this.generateVektorBulatUlang(nMK, nPeg);
		var v2 = this.generateVektorBulatUlang(nMK, nPeg);
		var nSama = this.cekSamaVektor(v1, v2);
//document.write("cekSamaVektor : "+this.cekSamaVektor(v1, v2)+"<br />");
		if(nSama != 0){
		    for(var i=0;i<nMK;i++){					
			//if(vCek[i]==0){	
				if(v1[i]==v2[i]) {
					 for(var j=0;j<nMK;j++){
						 if(v2[j]!=v1[i] && v1[j]!=v2[i]){ // && vCek[i]==0){
							 this.tukarPosisiVektor(v2, i, j);
							 //vCek[i]=1;
							 break;
						 }
					 }
				//}
			   }
		    }
		}
		for(var j=0;j<nMK;j++){
			matPeg[j][0] = v1[j];
			matPeg[j][1] = v2[j];	
		}
		return matPeg;
	},
	/*
		tukar posisi
	*/
	tukarPosisiVektor : function(vInd, i, j){
		var nil = vInd[i];	
		vInd[i] = vInd[j];
		vInd[j] = nil;			
	},
	/*
		cek kesamaan 2 vektor
	*/
	cekSamaVektor : function(v1, v2){
		var nil=0;	
		for(var i=0;i<v1.length;i++) if(v1[i] == v2[i]) nil++;
		return nil;			
	},
	/*
		hitung banyaknya "-" di kolom matriks 
	*/
	hitTandaMinKolomMatriks : function(mat, nKol){
		var bar = mat.length , nil=0;	
		var kol = mat[0].length;
		for(var i=0;i<bar;i++) if(mat[i][nKol] == "-") nil++;
			//for(var j=0;j<kol;j++) if(mat[i][j] == "-") nil++;
		return nil;			
	},
	/*
		vInd, i, n --> vektor input, 
		posisi yang akan digeser, 
		banyaknya elemen vInput
	*/
	geserIsiVektor : function(vInd, i, n){
		var nil = vInd[i];	
		for(var j=i;j<n-1;j++) vInd[j] = vInd[j+1];
		vInd[n-1] = nil;			
		return vInd;
	},	
	/*
	===============================================================================
						       MATA KULIAH --- UJIAN TEORI					   
	===============================================================================	
	$mat_kelas_teori_php = ambil_detailkelas("detailkelas","matakuliah",$kd_thn_ajaran,"k");
	var mKelasTeori = JSON.parse( '<?php echo json_encode($mat_kelas_teori_php) ?>' );
	var mkJalanTeori = PsoScheduling.buatMatKelas(mKelasTeori,maxDosen);
	var mkJalanTeoriUjian = PsoScheduling.buatMkJalanTeoriUjian(mKelasTeori,matPengawasPeg, matPengawasDos,maxDosen);

	*/
	buatMkJalanTeoriUjian : function(mKelasTeori,matPengawasPeg, matPengawasDos,maxDosen){
		//var vHas = this.buatVekKelompokDosenBeda(matKelasTabel);		
		var kolOp = 6;
		var matTeoriUjian = this.buatMatKelasTeoriUjian(mKelasTeori,matPengawasPeg, maxDosen);	
//document.write("=========matTeoriUjian : ==========<br />");
//OperasiMatriks.tampilMatriksString(matTeoriUjian);
//document.write("<br />");

		var nTandaMin = this.hitTandaMinKolomMatriks(matTeoriUjian, kolOp);
		var matKolHilang = OperasiMatriks.hilangVektorKolomMatriks(matTeoriUjian,kolOp+1);
//document.write("========== matKolHilang : ==========<br />");
//OperasiMatriks.tampilMatriksString(matKolHilang);
//document.write("<br />");

		var bar = matKolHilang.length;
		var kol = matKolHilang[0].length;
		var nDos = matPengawasDos.length;
		var vBul = this.generateVektorBulatUlang(nTandaMin , nDos);
//document.write("========== vBul : ");
//OperasiVektor.tampilVektorString(vBul);document.write("<br />");			
		var vDosen = Array();
		for(var j=0 ;j<nTandaMin ;j++){ vDosen[j] = matPengawasDos[vBul[j]][0]; }
//document.write("========== vDosen : ");
//OperasiVektor.tampilVektorString(vDosen);document.write("<br />");	
		var vDosen2 = Array();	
		var puter = 0;
		for(var i=0 ;i<bar ;i++){	
			if(matKolHilang[i][kolOp] == "-") {
					vDosen2[puter] = matKolHilang[i][kolOp-1];
					puter++;
				}
		}
//document.write("========== vDosen2 : ");
//OperasiVektor.tampilVektorString(vDosen2);document.write("<br />");		
		for(var i=0 ;i<nTandaMin ;i++){	
				for(var j=0 ;j<nTandaMin ;j++){
					if(vDosen[j] != vDosen2[i] && vDosen2[j] != vDosen[i]) {
					 //if(v2[j]!=v1[i] && v1[j]!=v2[i]){ // && vCek[i]==0){
							 this.tukarPosisiVektor(vDosen, i, j);
							 //vCek[i]=1;
							 break;
					}
				}
		}
//document.write("========== vDosen1 : ");
//OperasiVektor.tampilVektorString(vDosen);document.write("<br />");		
		puter = 0;
		for(var i=0 ;i<bar ;i++){	
			if(matKolHilang[i][kolOp] == "-") {
			 matKolHilang[i][kolOp] = vDosen[puter];
			 puter++;
				}
		}
		
		return matKolHilang;
	},
	
	/*
		============= buatMatKelasTeoriUjian ===============
		dipakai dalam ===== buatMkJalanTeoriUjian =====
	*/
	buatMatKelasTeoriUjian : function(matKelasTabel, matPeg, banyakDosen){
		var bar = matKelasTabel.length;
		var kol = matKelasTabel[0].length;
		var vHas = this.buatVekKelompokDosenBeda(matKelasTabel);				
		var vHas1 = Array(); // no yang berulang
		var vHas2 = Array(); // indeks mulai perulangan 
		var vHas3 = Array(); // banyaknya perulangan		
		var hit, sudah , maks = vHas[vHas.length-1];	
		for(var i2=0 ;i2< vHas.length ;i2++){	
			hit = 0;
			sudah=0;
			vHas1[i2] = i2;			
			for(var i3 = i2 ;i3<bar ;i3++){	
				 if(vHas[i3] == i2) {hit++; 
									if(sudah==0) {vHas2[i2]=i3; sudah=1;}
									}
			}
			if(i2 <= maks) vHas3[i2] = hit;		
		}	
//generateMatriksBulatUlang(nMK , nPeg);
	
		var tetap ,indeks1, indeks2;
		var k = vHas2.length;	
		var nPeg = matPeg.length;	
		var matPegKode = this.generateMatriksBulatUlang(k , nPeg);
//document.write("matPeg Kode: <br />");
//OperasiMatriks.tampilMatriks(matPegKode);
//document.write("<br />");		
		var nKol = 2+kol+banyakDosen-1;
		var matHas = OperasiMatriks.isiAwalMatriks(k , nKol);	
		var puter;
		for(var i=0 ;i<k ;i++){	
			indeks1 = vHas2[i];
			indeks2 = vHas3[i];
			puter=0;
//document.write("====== k : "+k+" ,indeks1 : "+indeks1+", "+" indeks2 : "+indeks2+"<br>");
			for(var j2=0 ;j2<=kol-4 ;j2++){				  
					matHas[i][j2] =  matKelasTabel[indeks1][j2];					
				}
			tetap = 5; //kol-banyakDosen;		
			if(indeks2 == 1) {
				for(var j=tetap ;j<tetap+banyakDosen ;j++){
					if(j==tetap) matHas[i][j] =  matKelasTabel[indeks1][tetap];
						else matHas[i][j] = '-';
					}
				}
				else for(var j=tetap ;j<tetap+banyakDosen ;j++){				
						//for(var ij=0 ; ij< indeks2; ij++){ 
//document.write("j : "+j+" ,indeks1 : "+indeks1+", "+" indeks2 : "+indeks2+"<br>");						
						if(j < tetap + indeks2) {
								matHas[i][j] =  matKelasTabel[indeks1+puter][tetap];						
								puter++;
								}
							else matHas[i][j] = '-';
						//}
					}
			puter = 0;		
			for(var j2=(tetap+banyakDosen) ;j2<tetap+banyakDosen+2 ;j2++){				 
				  matHas[i][j2] =  matPeg[matPegKode[i][puter]][0];
				  puter++;
				}		
			for(var jj=(tetap+banyakDosen+2) ;jj<nKol ;jj++){
				  matHas[i][jj] =  matKelasTabel[indeks1][jj-banyakDosen-1];
				}				
			}		
		return matHas;
	},
	/*
		`KODEKELAS`,kdpecah,KODEMATKUL, semester ,NIP,JUMLAHMAHASISWA, TAHUNANGKATAN
		var matKelasTeori
			
	$mat_kelas_teori_php = ambil_detailkelas("detailkelas","matakuliah",$kd_thn_ajaran,"k");
	var mKelasTeori = JSON.parse( '<?php echo json_encode($mat_kelas_teori_php) ?>' );
	var mkJalanTeori = PsoScheduling.buatMatKelas(mKelasTeori,maxDosen);	
	
	 =================== buatMatKelas ========================
	 kelompok yang sama dianggap satu (=== nama dosen saja yang berbeda ===) 
	 dan jika dosen > 1 maka ditambahkan pada kolom berikutnya
	*/
	buatMatKelas : function(matKelasTabel, banyakDosen){
		var bar = matKelasTabel.length;
		var kol = matKelasTabel[0].length;
		var vHas = this.buatVekKelompokDosenBeda(matKelasTabel);
		
//document.write("vHas : ");
//OperasiVektor.tampilVektorString(vHas);	document.write("<br />");				
		var vHas1 = Array(); // no yang berulang
		var vHas2 = Array(); // indeks mulai perulangan 
		var vHas3 = Array(); // banyaknya perulangan
		
		var hit, sudah , maks = vHas[vHas.length-1];	
		for(var i2=0 ;i2< vHas.length ;i2++){	
			hit = 0;
			sudah=0;
			vHas1[i2] = i2;			
			for(var i3 = i2 ;i3<bar ;i3++){	
				 if(vHas[i3] == i2) {hit++; 
									if(sudah==0) {vHas2[i2]=i3; sudah=1;}
									}
			}
			if(i2 <= maks) vHas3[i2] = hit;		
		}	
//document.write("vHas1 : ");
//OperasiVektor.tampilVektorString(vHas1);document.write("<br />");
//document.write("vHas2 : ");
//OperasiVektor.tampilVektorString(vHas2);document.write("<br />");
//document.write("vHas3 : ");
//OperasiVektor.tampilVektorString(vHas3);document.write("<br />");
		var tetap ,indeks1, indeks2;
		var k = vHas2.length;
//	==========================================	
		//var banyakDosen = 3;
//	==========================================		
		var matHas = OperasiMatriks.isiAwalMatriks(k , kol+banyakDosen-1);	
//document.write("matHas : <br />");
//OperasiMatriks.tampilMatriksString(matHas);
//document.write("<br />");
		var puter;
		for(var i=0 ;i<k ;i++){	
			indeks1 = vHas2[i];
			indeks2 = vHas3[i];
			puter=0;
//document.write("====== k : "+k+" ,indeks1 : "+indeks1+", "+" indeks2 : "+indeks2+"<br>");
			for(var j2=0 ;j2<=kol-4 ;j2++){				  
					matHas[i][j2] =  matKelasTabel[indeks1][j2];					
				}
			tetap = 5; //kol-banyakDosen;		
			if(indeks2 == 1) {
				for(var j=tetap ;j<tetap+banyakDosen ;j++){
					if(j==tetap) matHas[i][j] =  matKelasTabel[indeks1][tetap];
						else matHas[i][j] = '-';
					}
				}
				else for(var j=tetap ;j<tetap+banyakDosen ;j++){				
						//for(var ij=0 ; ij< indeks2; ij++){ 
//document.write("j : "+j+" ,indeks1 : "+indeks1+", "+" indeks2 : "+indeks2+"<br>");						
						if(j < tetap + indeks2) {
								matHas[i][j] =  matKelasTabel[indeks1+puter][tetap];						
								puter++;
								}
							else matHas[i][j] = '-';
						//}
					}
			for(var jj=(tetap+banyakDosen) ;jj<kol+banyakDosen-1 ;jj++){
				  matHas[i][jj] =  matKelasTabel[indeks1][jj-banyakDosen+1];
				}				
			}		
		return matHas;
	},
	/*
								  0 1 2 3 4 5
	  membuat vektor kelompok --> 1 1 2 2 1 3 
	  --> 0 ada 1, 2 ada 2, 5 ada 3 anggota	
	  var vHas = this.buatVekKelompokDosenBeda(matKelasTabel);
	  
	  untuk prodi,kelas, pecah, mk dan semester yang sama --> dijadikan satu kelompok
	  ===================== dosen saja yang berbeda =================================	
	  
	  dipakai dalam ===== buatMatKelas =====
				dan ===== buatMatKelasUjian =====
	*/
	buatVekKelompokDosenBeda : function(mat){
		var bar = mat.length;
		var kol = mat[0].length;
		var k = 0, isi = -1, vCek, vBaris;
		var vHas = Array();
		for(var i=0 ;i<bar-1 ;i++){	
		//document.write("i : "+i+", "+" isi : "+isi+"<br>");
			if(i>isi){
				vCek = this.gabungString(mat[i][0],mat[i][1],mat[i][2],mat[i][3],mat[i][4]);
				vHas[i] =  k;
				isi++;
				for(var j=i+1 ;j<bar ;j++){
					//document.write("i : "+i+", "+" j : "+j+"<br>");
					vBaris = this.gabungString(mat[j][0],mat[j][1],mat[j][2],mat[j][3],mat[i][4]);
					if(vCek == vBaris) {vHas[j] = k; isi++;}
					else {k++; 
						  if(j==bar-1) vHas[j] = k; 
						  break;}
					}						
				}
			}
		return vHas;
	},
	// s1.concat(s2) --> gabung string
	// s4.replace(/\s/g, '') --> menghilangkan spasi di s4
	// s1.toLowerCase();
	//
	//  =================== gabungString ===================
	//
	gabungString : function(s1,s2,s3,s4,s5,s6){
		var has = (s1.concat(s2).concat(s3).concat(s4).concat(s5).concat(s6)).replace(/\s/g, '');
		return has.toLowerCase();
	},
	gabung2String : function(s1,s2){
		var has = (s1.concat(s2)).replace(/\s/g, '');
		return has.toLowerCase();
	},
	/*
	===============================================================================
						     MATA KULIAH --- UJIAN PRAKTIKUM
	===============================================================================	
	$mat_kelas_praktikum_php = 
				ambil_detailkelas("detailkelas","matakuliah",$kd_thn_ajaran,"p");
	var mKelasPraktek = 
				JSON.parse( '<?php echo json_encode($mat_kelas_praktikum_php) ?>' );	
	var matKelasPraktekAwal = PsoScheduling.buatMatKelas(mKelasPraktek,maxDosen);
	buatMatKelasPraktekUjian(mKelasPraktek,matPengawasPeg, maxDosen);
	buatMkJalanPraktekUjian(mKelasPraktek,matPengawasPeg, matPengawasDos,maxDosen);
	
	*/
	buatMkJalanPraktekUjian : function(mKelasPraktek, matPengawasDos,maxDosen){
		//var vHas = this.buatVekKelompokDosenBeda(matKelasTabel);		
		var kolOp = 6;
		var matPraktekUjian = this.buatMatKelasPraktekUjian(mKelasPraktek, maxDosen);	
//document.write("=========matPraktekUjian : ==========<br />");
//OperasiMatriks.tampilMatriksString(matPraktekUjian);
//document.write("<br />");

		var nTandaMin = this.hitTandaMinKolomMatriks(matPraktekUjian, kolOp);
		var matKolHilang = OperasiMatriks.hilangVektorKolomMatriks(matPraktekUjian,kolOp+1);
//document.write("========== matKolHilang : ==========<br />");
//OperasiMatriks.tampilMatriksString(matKolHilang);
//document.write("<br />");

		var bar = matKolHilang.length;
		var kol = matKolHilang[0].length;
		var nDos = matPengawasDos.length;
		var vBul = this.generateVektorBulatUlang(nTandaMin , nDos);
//document.write("========== vBul : ");
//OperasiVektor.tampilVektorString(vBul);document.write("<br />");			
		var vDosen = Array();
		for(var j=0 ;j<nTandaMin ;j++){ vDosen[j] = matPengawasDos[vBul[j]][0]; }
//document.write("========== vDosen : ");
//OperasiVektor.tampilVektorString(vDosen);document.write("<br />");	
		var vDosen2 = Array();	
		var puter = 0;
		for(var i=0 ;i<bar ;i++){	
			if(matKolHilang[i][kolOp] == "-") {
					vDosen2[puter] = matKolHilang[i][kolOp-1];
					puter++;
				}
		}
//document.write("========== vDosen2 : ");
//OperasiVektor.tampilVektorString(vDosen2);document.write("<br />");		
		for(var i=0 ;i<nTandaMin ;i++){	
				for(var j=0 ;j<nTandaMin ;j++){
					if(vDosen[j] != vDosen2[i] && vDosen2[j] != vDosen[i]) {
					 //if(v2[j]!=v1[i] && v1[j]!=v2[i]){ // && vCek[i]==0){
							 this.tukarPosisiVektor(vDosen, i, j);
							 //vCek[i]=1;
							 break;
					}
				}
		}
//document.write("========== vDosen1 : ");
//OperasiVektor.tampilVektorString(vDosen);document.write("<br />");		
		puter = 0;
		var vSisip = Array();
		for(var i=0 ;i<bar ;i++){
			vSisip[i] = "-";		
			if(matKolHilang[i][kolOp] == "-") {
			 matKolHilang[i][kolOp] = vDosen[puter];
			 puter++;
				}
		}
		var matHas2 = OperasiMatriks.sisipKolomMatriks(matKolHilang, vSisip, 7);
		var matHas = OperasiMatriks.sisipKolomMatriks(matHas2, vSisip, 8);
		return matHas;
	},      
	/*
		============= buatMatKelasPraktekUjian ===============
		dipakai dalam ===== buatMkJalanPraktekUjian =====
		
		var matKelasPraktekAwal = this.buatMatKelas(mKelasPraktek,maxDosen);	
	    var vekKelompokPecahBeda = this.buatVekKelompokPecahBeda(matKelasPraktekAwal);
		
	*/
	buatMatKelasPraktekUjian : function(matKelasTabel, banyakDosen){
		var matKelasPraktekAwal = this.buatMatKelas(matKelasTabel, banyakDosen);	
	    var vHas = this.buatVekKelompokPecahBeda(matKelasPraktekAwal);
		var bar = matKelasPraktekAwal.length;
		var kol = matKelasPraktekAwal[0].length;
		
		var vHas1 = Array(); // no yang berulang
		var vHas2 = Array(); // indeks mulai perulangan'
		var vHas3 = Array(); // banyaknya perulangan
		var hit, sudah , maks = vHas[vHas.length-1];	
		for(var i2=0 ;i2< vHas.length ;i2++){	
			hit = 0;
			sudah=0;
			vHas1[i2] = i2;			
			for(var i3 = i2 ;i3<bar ;i3++){	
				 if(vHas[i3] == i2) {hit++; 
									if(sudah==0) {vHas2[i2]=i3; sudah=1;}
									}
			}
			if(i2 <= maks) vHas3[i2] = hit;		
		}	
/*
document.write("========== vHas : ");
OperasiVektor.tampilVektorString(vHas);document.write("<br />");		
document.write("========== vHas2 : ");
OperasiVektor.tampilVektorString(vHas2);document.write("<br />");
document.write("========== vHas3 : ");
OperasiVektor.tampilVektorString(vHas3);document.write("<br />");	
*/	
		var k = vHas2.length;
//document.write("========= k : "+k+"<br>");		
		var matHas = OperasiMatriks.isiAwalMatriks(k , kol);
		for(var i=0 ;i<k ;i++){	
			var vTemp = OperasiMatriks.ambilVektorBaris(matKelasPraktekAwal, vHas2[i]);
			for(var j=0 ;j<kol ;j++){
				matHas[i][j] = vTemp[j];
			}
		}						
		return matHas;
	},
	/*
								  0 1 2 3 4 5
	  membuat vektor kelompok --> 1 1 2 2 1 3 
	  --> 0 ada 1, 2 ada 2, 5 ada 3 anggota	
	  	  
	  untuk prodi,kelas, mk dan semester yang sama --> dijadikan satu kelompok
	  ===================== kode pecah saja yang berbeda =====================	
	  
	  var matKelasPraktekAwal = PsoScheduling.buatMatKelas(mKelasPraktek,maxDosen);
	  var vHas = this.buatVekKelompokPecahBeda(matKelasPraktekAwal);
	  
	*/
	buatVekKelompokPecahBeda : function(mat){
		var bar = mat.length;
		var kol = mat[0].length;
		var k = 0, isi = -1, vCek, vBaris;
		var vHas = Array();
		for(var i=0 ;i<bar-1 ;i++){	
		//document.write("i : "+i+", "+" isi : "+isi+"<br>");
			if(i>isi){
				vCek = this.gabungString(mat[i][0],mat[i][1],mat[i][3],mat[i][4],mat[i][5],mat[i][5]);
				vHas[i] =  k;
				isi++;
				for(var j=i+1 ;j<bar ;j++){
					//document.write("i : "+i+", "+" j : "+j+"<br>");
					vBaris = this.gabungString(mat[j][0],mat[j][1],mat[i][3],mat[i][4],mat[i][5],mat[i][5]);
					if(vCek == vBaris) {vHas[j] = k; isi++;}
					else {k++; 
						  if(j==bar-1) vHas[j] = k; 
						  break;}
					}						
				}
			}
		return vHas;
	},
	  /* 
	===============================================================
								KULIAH
	===============================================================
	buat matriks hari vs jam kuliah per ruang
	hari : senin, selasa, rabu, kamis, jum'at ==> 5 hari
	jam kuliah : 1-2, 3-5, 5-6, 7-8, 9-10 ==> 5 jam kuliah
	untuk cek ==> kapasitas ruang dan peserta MK
	*/
	matRuangHariJam : function(ind,jruang,jhari,jam){
	 var arr3dim = OperasiArray3Dim.isiAwalArray3Dim(jruang,jhari,jam);
     var indeks = 0, nS = jruang*jhari*jam;
     for(var k=0;k<jruang;k++){
       for(var i=0;i<jhari;i++){       
            for(var j=0;j<jam;j++) {                  
						arr3dim[k][i][j] = ind[indeks];
						indeks++;						
                }
            }
        }    
      return arr3dim;          
   },
   
   showMatRuangHariJam : function(arr3dim, jruang, jhari, jam){
	for(var k=0;k<jruang;k++){
	   for(var i=0;i<jhari;i++){
	       for(var j=0;j<jam;j++){
	            document.write("Ruang ke-"+k+", ");
				document.write("Hari ke-"+i+", "); 					
				document.write("Jam ke-"+j+" ==> ");
				document.write(arr3dim[k][i][j].toFixed(3)+"<br /> ");
		   }
	       //document.write("<br />");		
	      } 
	   document.write("<br />");     
	   }    
   },
	/*
	buat matriks jam vs ruang kuliah per hari
	hari : senin, selasa, rabu, kamis, jum'at ==> 5 hari
	jam kuliah : 1-2, 3-5, 5-6, 7-8, 9-10 ==> 5 jam kuliah
	untuk cek ==> seorang dosen tidak boleh mengajar di waktu yg sama di ruang berbeda
   		  ==> mhs semester yang sama di ruang berbeda
   		  ==> 
	*/
	matHariJamRuang : function (ind , jruang, jhari, jam){
		var arr3dim = OperasiArray3Dim.isiAwalArray3Dim(jhari,jam,jruang);
		var indeks = 0;
		var iter = 0;
		for(var k=0;k<jhari;k++){
       //mulai = k* jhari; 
			for(var i=0;i<jam;i++){                                 
				indeks = iter;
				iter++;   
				for(var j=0;j<jruang;j++) {           
					arr3dim[k][i][j] = ind[indeks];
					indeks +=jhari * jam ;
					}
				indeks = 0;     
             //i=0;
				}
			}    
		return arr3dim;          
	},
	showMatHariJamRuang : function (arr3dim, jruang, jhari, jam){
		for(var k=0;k<jhari;k++){
			//document.write( "Hari ke-".k." : <br>");  //, ,
			for(var i=0;i<jam;i++){
				//document.write( "Jam ke-".i." : ");
				for(var j=0;j<jruang;j++){
					document.write("Hari ke-"+k+", ");
					document.write("Jam ke-"+i+", "); 					
					document.write("Ruang ke-"+j+" ==> ");
					document.write(arr3dim[k][i][j].toFixed(3)+"<br /> ");
					}
				//document.write("<br />"); 		
				} 
			document.write("<br />");      
		}    
	},
	/*
	buat matriks hari vs ruang kuliah per jam
	hari : senin, selasa, rabu, kamis, jum'at ==> 5 hari
	jam kuliah : 1-2, 3-5, 5-6, 7-8, 9-10 ==> 5 jam kuliah
	untuk cek ==> seorang dosen tidak boleh mengajar di waktu yg sama di ruang berbeda
			  ==> mhs semester yang sama di ruang berbeda
   		      ==> 
	*/
	matJamHariRuang : function(ind , jruang, jhari, jam){
		var arr3dim = OperasiArray3Dim.isiAwalArray3Dim(jam,jhari,jruang);
		//document.write("matJamHariRuang <br />");
		var indeks = 0;   
		var iter = 0;		
		for(var k=0;k<jam;k++){
			iter =  k;
			for(var i=0;i<jhari;i++){                                
				indeks = iter; // iter;
				iter += jam;   
				for(var j=0;j<jruang;j++) {           
					arr3dim[k][i][j] = ind[indeks];
					indeks = indeks + jhari * jam ;
					}
					indeks = 0;     
				}
			}    
      return arr3dim;          
	},
	showMatJamHariRuang : function(arr3dim,jruang,jhari,jam){
		for(var k=0;k<jam;k++){
			//document.write("Jam ke-"+k+", "); 
			for(var i=0;i<jhari;i++){
				//document.write("Hari ke-"+i+", ");
				for(var j=0;j<jruang;j++){
					document.write("Jam ke-"+k+", "); 
					document.write("Hari ke-"+i+", ");
					document.write("Ruang ke-"+j+" ==> ");
					document.write(arr3dim[k][i][j].toFixed(3)+"<br /> ");
				}
				//document.write("<br />");		
			} 
			document.write("<br />");     
		}   
	},
	 /*
	buat matriks kode ruang , hari dan jam kuliah
	hari : senin, selasa, rabu, kamis, jum'at ==> 5 hari
	jam kuliah : 1-2, 3-5, 5-6, 7-8, 9-10 ==> 5 jam kuliah
	untuk cek ==> kapasitas ruang dan peserta MK
	*/
	//*
	matKodeRuangHariJam : function(ind,jslot,jruang,jhari,jam){
     // MK--ruang--hari--jam -- pinalti dosen -- pinalti ruang	
	 //document.write("matKodeRuangHariJam <br />");	 
     var kodeRHJ = Array();
     for(var kk=0;kk<jslot;kk++){
       kodeRHJ[kk] = Array();
       for(var ii=0;ii<6;ii++){
          if(ii == 0) kodeRHJ[kk][ii] = ind[kk];
          	     else kodeRHJ[kk][ii]= 0;
       }
     }
     var indeks = 0;
     for(var k=0;k<jruang;k++){
		for(var i=0;i<jhari;i++){     
            for(var j=0;j<jam;j++) {            
                kodeRHJ[indeks][1] = k;
                kodeRHJ[indeks][2] = i;
                kodeRHJ[indeks][3] = j;
                indeks++;
                }
            }
        }    
      return kodeRHJ;          
	},				
	/*
	****************************************************************
						PINALTI KULIAH
	****************************************************************
	hitung pinalti daya tampung mk terhadap kapasitas ruang
    	sesuai ==> 0
    	tidak sesuai ==> 500   	
		kode = 0 ==> pinaltiRuang
      	kode = 1 ==> mkKenaPinaltiRuang
		mat Ruang ==> mat ruang
		mat Mk Dosen ==> mat MK dan dosen
		
		output ==> mkPinaltiRuang = (mkPinaltiRuang , pinaltiRuang)
					mkPinaltiRuang ==> array
					pinaltiRuang  ==> skalar
	*/  
	
	hitPinaltiRuang : function(vInd, mRuang, mMkDosen,jruang, jhari, jam){
	    //document.write("######### hitTampungRuang ######### <br />");
		var mRHJ = this.matRuangHariJam(vInd , jruang, jhari, jam);
        //var jslot = jruang*jhari*jam;
        var jmk = mMkDosen.length;
        var mkPinaltiRuang = [];
        var pinaltiRuang = 0;
		var iMK = 0;
        for(var k=0;k<jruang;k++){
       		for(var i=0;i<jhari;i++){
            	for(var j=0;j<jam;j++) {          
                	iMK = mRHJ[k][i][j];
                	     // kapasitas ruang  ==> pada kolom ke 3
 //document.write("iMK : "+iMK+" ");						 
 //document.write(mRuang[k][2]+" dan "+mMkDosen[iMK][6]+"==>");
					if(iMK < jmk) {
                	    if(mRuang[k][2] < mMkDosen[iMK][6])
						//if(vRuang[k] < vDT[iMK])
                	     	{ 
                	     // daya tampung mk ==> pada kolom ke 6 
                	     	pinaltiRuang +=500;
                	     	mkPinaltiRuang.push(iMK); // [] = 1;
 //document.write( " iMK ==> 1 <br>");
                	     	}
                	     	//else  {
                	     	//	pinaltiRuang +=1;
                	     		//mkPinaltiRuang.push(0); //[] = 0;
 //document.write( " iMK ==> 0 <br>");
                	     	//	}
                	    }
                	    //else mkPinaltiRuang.push(0); //[] = 0; 	
//document.write( pinaltiRuang ."<br>");
				}					       
            }
        }   
//*/		
 
	//document.write("mkPinaltiRuang : "); OperasiVektor.tampilVektor(mkPinaltiRuang); document.write("<br>");		
	 mkPinaltiRuang.push(pinaltiRuang);
	 return mkPinaltiRuang;
	},
	/*
   hitung pinalti dosen tidak boleh mengajar pada jam yang sama
    	sesuai --> 0
    	tidak sesuai --> 500   			
 */  
	hitPinaltiDosen : function(vInd, matRuang, matMkJalan, maxDosen, jruang, jhari, jam)
      {
		//document.write("######### hitPinaltiDosen ######### <br />");  
        var bd = maxDosen; // #dosen per mata kuliah
        var jslot = jruang*jhari*jam;
        var jmk = matMkJalan.length; //count(matMkJalan,0);
        var matHJR = this.matHariJamRuang(vInd,jruang, jhari, jam);        
		var vPinaltiDosen = [];
        var pinaltiDosen = 0;
        var vMK = Array();
        for(var k=0;k<jhari;k++){
            for(var i=0;i<jam;i++){
               for(var j=0;j<jruang;j++)  vMK[j] = matHJR[k][i][j]; 
               var mDosen = Array();
               var iter = 0;
               //foreach(var vMK as nil) {
				for(var nil=0;nil<vMK.length ;nil++){   
                   mDosen[iter] = Array();
                   for(var id=0;id<bd;id++){ // banyak dosen maksimal di satu MK = 3
                    	if(vMK[nil] < jmk)     
								mDosen[iter][id] =  matMkJalan[vMK[nil]][id+2];
						    else mDosen[iter][id] = '-';
                    	}
                     iter++;
                   } 
//document.write("vMK : "); OperasiVektor.tampilVektor(vMK); document.write("<br>"); 
//document.write("mDosen : <br>");OperasiMatriks.tampilMatriksString(mDosen);document.write("<br>"); 
        
              //puter = count(vMK);
              //iMK = 0;
              for(var ip=0;ip<jruang-1;ip++){
//document.write("MK : "+vMK[ip]+" dan "+jmk+" ==> <br>");     
                nilP = 0;            
                if(vMK[ip] < jmk) {// if(vMK[ip] < jmk
//document.write(vMK[ip]+" dan < "+jmk+" ==> <br>");                 
                for(var jp=ip+1;jp<jruang;jp++) {                                 
                     for(var id1=0;id1<bd;id1++){//for(var id1
					    var isiD = ((mDosen[ip][id1]).toLowerCase()).trim();
                        if(!(isiD == "-" || isiD == "")){// if !() =====
                           for(var id2=0;id2<bd;id2++){
                              if((mDosen[ip][id1].toLowerCase()).trim() == (mDosen[jp][id2].toLowerCase()).trim()) {
                         		pinaltiDosen +=500;
								vPinaltiDosen.push(vMK[ip]);
								vPinaltiDosen.push(vMK[jp]);
								nilP++;
//document.write("sama <br>");
                        		}// if((mDosen
                        		//else { // else awal
                           			//pinaltiDosen +=1;
//document.write("tidak sama <br>");                           
                           			//} //  else akhir                           
                              }//for(var id2
                           }// if !() =====
                        }//for(var id1
                      }// for(var jp
                  } //if(vMK[ip] < jmk             
              } // end for(ip=0;ip<jruang-1;ip++)             
           } // emd i == jam
        } // emd k == jhari
		
	/****************************************************************
	  matriks mkPinaltiDosen ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  ================= pada jam yang sama =======================
			#	baris ke-1 ==> nama MK I	#
			#	baris ke-2 ==> nama MK II	# 	  
	/****************************************************************/
	var np = vPinaltiDosen.length/2;
	var mkPinaltiDosen = OperasiMatriks.isiAwalMatriks(2,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiDosen[0][i] = vPinaltiDosen[2*i];
		mkPinaltiDosen[1][i] = vPinaltiDosen[2*i+1];
	}
	mkPinaltiDosen[0][np] = pinaltiDosen;	
	return mkPinaltiDosen;
	},
	/*
   hitung pinalti dosen boleh mengajar sebanyak 2 (maxNgajar) kali sehari
    	sesuai --> 0
    	tidak sesuai --> 500   	

		var myFish = ['angel', 'clown', 'drum', 'mandarin', 'sturgeon'];
		var removed = myFish.splice(3, 1);
			// removed is ["mandarin"]
			// myFish is ["angel", "clown", "drum", "sturgeon"]
		
 */  
	hitPinaltiDosenMaxNgajar : function(vInd, matRuang, matMkJalan, maxDosen, maxNgajar, jruang, jhari, jam)
      {
		//document.write("######### hitPinaltiDosen max ngajar ######### <br />");  
        var bd = maxDosen; // #dosen per mata kuliah
        var jslot = jruang*jhari*jam;
        var jmk = matMkJalan.length; //count(matMkJalan,0);
        var matHJR = this.matHariJamRuang(vInd,jruang, jhari, jam);        
		var vPinaltiDosenMax = [];						
        var pinaltiDosenMax = 0;
        var vMK = Array();
        for(var k=0;k<jhari;k++){
			var ivmk = 0;
            for(var i=0;i<jam;i++){
				for(var j=0;j<jruang;j++) {  
				   vMK[ivmk++] = matHJR[k][i][j];
				   }
				} // emd i == jam
                var mDosen = Array(); //OperasiMatriks.isiAwalMatriks(2, jruang*jam*maxDosen);
                var iter1 = 0;
               //foreach(var vMK as nil) {
				for(var nil=0;nil<vMK.length ;nil++){   
                   //mDosen[iter] = Array();
                   for(var id=0;id<bd;id++){ // banyak dosen maksimal di satu MK = 3
                    	if(vMK[nil] < jmk)     
								mDosen[iter1] =  matMkJalan[vMK[nil]][id+2];
						    else mDosen[iter1] = '-';
						iter1++;	
                    	}                    
                    } 
//document.write("vMK : "); OperasiVektor.tampilVektor(vMK); document.write("<br>"); 
//document.write("mDosen : <br>");OperasiMatriks.tampilMatriksString(mDosen);document.write("<br>"); 
//document.write("mDosen : "); OperasiVektor.tampilVektorString(mDosen); document.write("<br>");         
              //puter = count(vMK);
              //iMK = 0;
			OperasiVektor.urutDescString(mDosen); // sort string desc 
//document.write("mDosen : "); OperasiVektor.tampilVektorString(mDosen); document.write("<br>"); 			
			var vNamaDosen = [];
		    var vBanyakNgajar = [];
			var nilP = 0 , cekNama = mDosen[0] ;
			var iter = 0;
			while(iter < mDosen.length-1){
				var isiD = ((mDosen[iter]).toLowerCase()).trim();
				if(!(isiD == "-" || isiD == "")){
					if(isiD == (mDosen[iter+1].toLowerCase()).trim()){
					    nilP++;						
					}
					else {
						vNamaDosen.push(cekNama);
						vBanyakNgajar.push(nilP+1);
						if(nilP+1 > maxNgajar) {
								pinaltiDosenMax+=500;
								vPinaltiDosenMax.push(cekNama);
								vPinaltiDosenMax.push(nilP+1);
							}
						nilP=0;
						cekNama = mDosen[iter+1];
						}
				}
				iter++;
			}			           
//document.write("vNamaDosen : "); OperasiVektor.tampilVektorString(vNamaDosen); document.write("<br>"); 
//document.write("vBanyakNgajar : "); OperasiVektor.tampilVektorString(vBanyakNgajar); document.write("<br>");			
        } // emd k == jhari
		
		
	/**********************************************************************
	  matriks mkPinaltiDosenMax ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  	#	baris ke-1 ==> nama Dosen									#
		#	baris ke-2 ==> banyaknya MK yg bentrok pada hari yg sama	#  
	/*********************************************************************/
	var np = vPinaltiDosenMax.length/2;
	var mkPinaltiDosenMax = OperasiMatriks.isiAwalMatriks(2,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiDosenMax[0][i] = vPinaltiDosenMax[2*i];
		mkPinaltiDosenMax[1][i] = vPinaltiDosenMax[2*i+1];
	}
	mkPinaltiDosenMax[0][np] = pinaltiDosenMax;	
	return mkPinaltiDosenMax;
	},						
	/*
   hitung pinalti mahasiswa tidak boleh kuliah pada jam yang sama
    	sesuai --> 0
    	tidak sesuai --> 500   		
hitPinaltiMahasiswa : function(vInd, matRuang, matMkJalan, maxMK, jruang, jhari, jam)		
 */  
	hitPinaltiMahasiswa : function(vInd,matRuang,matMkJalan,jruang,jhari,jam)
      {
		//document.write("######### hitPinaltiMahasiswa ######### <br />");  
        //maxMK ==> #mahasiswa per hari
        var jslot = jruang*jhari*jam;
        var jmk = matMkJalan.length; //count(matMkJalan,0);
        var matHJR = this.matHariJamRuang(vInd,jruang, jhari, jam);        
		var vPinaltiMhs = [];
        var pinaltiMhs = 0;
        var vMK = Array();
        for(var k=0;k<jhari;k++){
            for(var i=0;i<jam;i++){
               for(var j=0;j<jruang;j++)  vMK[j] = matHJR[k][i][j]; 
               var vMahasiswa = Array();
               //var iter = 0;
               //foreach(var vMK as nil) {
				for(var nil=0;nil<vMK.length ;nil++){   
                   //vMahasiswa[iter] = Array();
                   //for(var id=0;id<maxMK;id++){ // banyak mahasiswa maksimal di satu MK = 3
                    	if(vMK[nil] < jmk)     
								vMahasiswa[nil] =  matMkJalan[vMK[nil]][5];
						    else vMahasiswa[nil] = '-';
                    	//}
                     //iter++;
                   } 
//document.write("vMK : "); OperasiVektor.tampilVektor(vMK); document.write("<br>"); 
//document.write("vMahasiswa : "); OperasiVektor.tampilVektor(vMahasiswa); document.write("<br>");        
              //puter = count(vMK);
              //iMK = 0;
              for(var ip=0;ip<jruang-1;ip++){
//document.write("MK : "+vMK[ip]+" dan "+jmk+" ==> <br>");     
                //nilP = 0;            
                if(vMK[ip] < jmk) {// if(vMK[ip] < jmk
//document.write(vMK[ip]+" dan < "+jmk+" ==> <br>");                 
                for(var jp=ip+1;jp<jruang;jp++) {                                 
                     //for(var id1=0;id1<maxMK;id1++){//for(var id1
                        if(!(isNaN(vMahasiswa[ip]))){// if !() =====
                           //for(var id2=0;id2<maxMK;id2++){
                              if(vMahasiswa[ip] == vMahasiswa[jp]) {
                         		pinaltiMhs +=500;
								vPinaltiMhs.push(vMK[ip]);
								vPinaltiMhs.push(vMK[jp]);
								//nilP++;
//document.write("sama <br>");
                        		}// if((vMahasiswa
                        		//else { // else awal
                           			//pinaltiMhs +=1;
//document.write("tidak sama <br>");                           
                           			//} //  else akhir                           
                              //}//for(var id2
                           }// if !() =====
                        //}//for(var id1
                      }// for(var jp
                  } //if(vMK[ip] < jmk             
              } // end for(ip=0;ip<jruang-1;ip++)             
           } // emd i == jam	   
        } // emd k == jhari
		
	/****************************************************************
	  matriks mkPinaltiMhs ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
	  ================= pada jam yang sama =======================
		#	baris ke-1 ==> nama MK yg I			#
		#	baris ke-2 ==> nama MK yg II		#  
	/****************************************************************/
		var np = vPinaltiMhs.length/2;
		var mkPinaltiMhs = OperasiMatriks.isiAwalMatriks(2,np+1);
		for(var i=0;i<np;i++){
			mkPinaltiMhs[0][i] = vPinaltiMhs[2*i];
			mkPinaltiMhs[1][i] = vPinaltiMhs[2*i+1];
		}
		mkPinaltiMhs[0][np] = pinaltiMhs;	
		return mkPinaltiMhs; 					
	},
/*
   hitung pinalti mahasiswa tidak boleh kuliah pada jam yang sama
    	sesuai --> 0
    	tidak sesuai --> 500   		
hitPinaltiMahasiswa : function(vInd, matRuang, matMkJalan, maxMK, jruang, jhari, jam)		
 */  
	hitPinaltiMahasiswaMax : function(vInd,matRuang,matMkJalan, maxMK, jruang,jhari,jam)
      {
		//document.write("######### hitPinaltiMahasiswa max MK ######### <br />");  
        //maxMK ==> #mahasiswa per hari
        var jslot = jruang*jhari*jam;
        var jmk = matMkJalan.length; //count(matMkJalan,0);
        var matHJR = this.matHariJamRuang(vInd,jruang, jhari, jam);        
		var vPinaltiMhsMax = [];
		var vHariMax = [];
        var pinaltiMhsMax = 0;
        var vMK = Array();
		var puter;
        for(var k=0;k<jhari;k++){
//document.write("k : "+k+" ==> jhari : "+jhari+"<br>");			
			puter = 0;
            for(var i=0;i<jam;i++){
               for(var j=0;j<jruang;j++) vMK[puter++] = matHJR[k][i][j]; 
			   } // emd i == jam
            var vMahasiswaMax = Array();
               //var iter = 0;
               //foreach(var vMK as nil) {
			for(var nil=0;nil<vMK.length ;nil++){   
                if(vMK[nil] < jmk)  vMahasiswaMax[nil] =  matMkJalan[vMK[nil]][5];
						else vMahasiswaMax[nil] = '-';
                   } 
//document.write("vMK : "); OperasiVektor.tampilVektor(vMK); document.write("<br>"); 
//document.write("vMahasiswaMax : "); OperasiVektor.tampilVektorString(vMahasiswaMax); document.write("<br>");        
            //if(Number.isInteger(vMahasiswaMax[0])) 
					OperasiVektor.urutDescString(vMahasiswaMax); // sort desc 
					//else OperasiVektor.urutDesc(vMahasiswaMax);
//document.write("vMahasiswaMax : "); OperasiVektor.tampilVektorString(vMahasiswaMax); document.write("<br>"); 					
			var vNamaMhs = [];
		    var vBanyakMK = [];
			var nilP = 0 , cekNama = vMahasiswaMax[0] ;
			var iter = 0;
			while(iter < vMahasiswaMax.length-1){
//document.write("iter : "+iter+" dan vMahasiswaMax : "+vMahasiswaMax[iter]+" <br>"); 				
				//var isiD = ((vMahasiswaMax[iter]).toLowerCase()).trim();
				if(!(cekNama == "-" || cekNama == "")){
					if(cekNama == (vMahasiswaMax[iter+1].toLowerCase()).trim()){
					    nilP++;	
//document.write("cekNama : "+cekNama+" nilP : "+nilP+" cekNama : "+cekNama+"<br>"); 						
					}
					else {
						vNamaMhs.push(cekNama);
						vBanyakMK.push(nilP+1);
						if(nilP+1 > maxMK) {	
//document.write("cekNama : "+cekNama+" nilP : "+nilP+" cekNama : "+cekNama+" ==> kena pinalti <br>"); 						
								pinaltiMhsMax+=500;
								vPinaltiMhsMax.push(cekNama);								
								vPinaltiMhsMax.push(nilP+1);
								vHariMax.push(k);
//document.write("vPinaltiMhsMax : "); OperasiVektor.tampilVektorString(vPinaltiMhsMax); document.write("<br>");								
								}
							
						nilP=0;
						cekNama = vMahasiswaMax[iter+1];
//document.write("cekNama : "+cekNama+" nilP : "+nilP+" ==> lewat nilP = 0 <br>"); 						
						}
					if(iter == vMahasiswaMax.length-2){
						vNamaMhs.push(cekNama);
						vBanyakMK.push(nilP+1);
						if(nilP+1 > maxMK) {	
//document.write("cekNama : "+cekNama+" nilP : "+nilP+" ==> kena pinalti <br>"); 						
								pinaltiMhsMax+=500;
								vPinaltiMhsMax.push(cekNama);
								vPinaltiMhsMax.push(nilP+1);
								vHariMax.push(k);
//document.write("iter ==  vPinaltiMhsMax : "); OperasiVektor.tampilVektorString(vPinaltiMhsMax); document.write("<br>");								
							}
							
						nilP=0;
						cekNama = vMahasiswaMax[iter];
//document.write("cekNama : "+cekNama+" nilP : "+nilP+" ==> lewat nilP = 0 <br>"); 						
						}
//document.write("vPinaltiMhsMax : "); OperasiVektor.tampilVektorString(vPinaltiMhsMax); document.write("<br>");						
				}
				iter++;
			}           
//document.write("vNamaMhs : "); OperasiVektor.tampilVektorString(vNamaMhs); document.write("<br>"); 
//document.write("vBanyakMK : "); OperasiVektor.tampilVektorString(vBanyakMK); document.write("<br>");          
        } // emd k == jhari
		
	/****************************************************************
	  matriks mkPinaltiMhsMax ==> kolom adalah pasangan yang bentrok 
	  dan kolom terakhir menunjukkan nilai pinalti
		#	baris ke-1 ==> hari ke								#
		#	baris ke-2 ==> semester								#
		#	baris ke-3 ==> banyaknya MK dalam hari yang sama	#
	/****************************************************************/
//document.write("vPinaltiMhsMax : "); OperasiVektor.tampilVektorString(vPinaltiMhsMax); document.write("<br>");	
	var np = vPinaltiMhsMax.length/2;
	var mkPinaltiMhsMax = OperasiMatriks.isiAwalMatriks(3,np+1);
	for(var i=0;i<np;i++){
		mkPinaltiMhsMax[0][i] = vHariMax[i];
		mkPinaltiMhsMax[1][i] = vPinaltiMhsMax[2*i];
		mkPinaltiMhsMax[2][i] = vPinaltiMhsMax[2*i+1];
	}
	mkPinaltiMhsMax[0][np] = pinaltiMhsMax;	
	return mkPinaltiMhsMax;
	}

	
};

//####################################################################################
//			OperasiMatriks
//####################################################################################
var OperasiMatriks = {
		isiAwalMatriks : function(bar , kol){
			//document.write("isiAwalMatriks <br />");
			var mat = new Array(bar);
			//for(var i=0;i<bar;i++) if(i>0) mat[i].push(0);
			for(var i=0;i<bar;i++){	
				//var v1 = OperasiVektor.isiAwal(kol);
				mat[i] = new Array(kol); //.push(v1);
				for(var j=0;j<kol;j++) mat[i][j]=0;
				}
			//this.tampilMatriks(mat);
			return mat;
		},
		kaliSkalar : function(mat1, k){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			//document.write("nilai n : "+n+" dan m : "+m+"<br />");
			var mathas1 = this.isiAwalMatriks(n,m);
			//this.tampilMatriks(mathas1);
			//this.tampilMatriks(mat1);
			for(var i=0;i<n;i++) {
				for(var j=0;j<m;j++) {
				//document.write("nilai i : "+i+" dan j : "+j+"<br />");
					mathas1[i][j] = mat1[i][j]*k;
					}
				}
			//this.tampilMatriks(mathas1);	
			return mathas1;
		},
		bagiSkalar : function(mat1, k){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var mathas1 = this.isiAwalMatriks(n,m);
			for(var i=0;i<n;i++) {
				for(var j=0;j<m;j++) mathas1[i][j] = mat1[i][j]/k;
				}
			return mathas1;
		},
		kurangSkalar : function(mat1, k){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var mathas1 = this.isiAwalMatriks(n,m);
			for(var i=0;i<n;i++) {
				for(var j=0;j<m;j++) mathas1[i][j] = mat1[i][j]-k;
				}
			return mathas1;
		},
		jumlah2Matriks : function(mat1, mat2){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var mathas1 = this.isiAwalMatriks(n,m);
			for(var i=0;i<n;i++) {
				for(var j=0;j<m;j++) mathas1[i][j] = mat1[i][j]+mat2[i][j];
				}
			return mathas1;
		},
		kurang2Matriks : function(mat1, mat2){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var mathas1 = this.isiAwalMatriks(n,m);
			for(var i=0;i<n;i++) {
				for(var j=0;j<m;j++) mathas1[i][j] = mat1[i][j]-mat2[i][j];
				}
			return mathas1;
		},
		operatorDotMatriks : function(mat1, mat2){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var mathas1 = this.isiAwalMatriks(n,m);
			for(var i=0;i<n;i++) {
				for(var j=0;j<m;j++) mathas1[i][j] = mat1[i][j]*mat2[i][j];
				}
			return mathas1;
		},
		kuadratMatriks : function(mat1){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var mathas1 = this.isiAwalMatriks(n,m);
			for(var i=0;i<n;i++) {
				for(var j=0;j<m;j++) mathas1[i][j] = mat1[i][j]*mat1[i][j];
				}
			return mathas1;
		},
		jumlahMatriks : function(mat1){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var mathas1 = 0; //this.isiAwalMatriks(n,m);
			for(var i=0;i<n;i++) {
				for(var j=0;j<m;j++) mathas1 = mathas1 + mat1[i][j];
				}
			return mathas1;
		},
		hitungMean : function(mat1){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var mathas1 = this.jumlahMatriks(mat1);
			return mathas1/(n*m);
		},
		/*
			menambahkan satu vektor baris di baris terakhir suatu matriks
		*/
		tambahBarisAkhirMatriks : function(mat1, v1){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var size = v1.length;
			//var n1 = n+1;
			//document.write("nilai n : "+n+" dan m : "+m+" dan size : "+size+"<br />");
			//document.write("Masuk ==> tanbahVektorBaris <br />");
			//this.tampilMatriks(mat1);
			var mathas1 = this.isiAwalMatriks(n+1,m);
				//document.write("tampilMatriks(mathas1) <br />");
				//this.tampilMatriks(mathas1);
			for(var i=0;i<=n;i++) {
				//document.write("loop <br />");
				for(var j=0;j<m;j++) 					
					if(i<n) mathas1[i][j] = mat1[i][j];
						 else mathas1[i][j] = v1[j];
			}
			//this.tampilMatriks(mathas1);	
			return mathas1;
		},
		/*
			menambahkan satu vektor kolom di kolom terakhir suatu matriks
		*/
		tambahKolomAkhirMatriks : function(mat1, v1){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			//var size = v1.length;
			//var n1 = n+1;
			//document.write("nilai n : "+n+" dan m : "+m+" dan size : "+size+"<br />");
			//document.write("Masuk ==> tanbahVektorBaris <br />");
			//this.tampilMatriks(mat1);
			var mathas1 = this.isiAwalMatriks(n,m+1);
				//document.write("tampilMatriks(mathas1) <br />");
				//this.tampilMatriks(mathas1);
			for(var i=0;i<n;i++) {
				//document.write("loop <br />");
				for(var j=0;j<=m;j++) 					
					if(j<m) mathas1[i][j] = mat1[i][j];
						else mathas1[i][j] = v1[i];
			}					
			//this.tampilMatriks(mathas1);	
			return mathas1;
		},
		/*
			menambahkan satu vektor kolom di kolom ke-k
			di suatu matriks
		*/
		sisipKolomMatriks : function(mat1, v1, k){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var size = v1.length;
			//var n1 = n+1;
			//document.write("nilai n : "+n+" dan m : "+m+" dan size : "+size+"<br />");
			//document.write("Masuk ==> tanbahVektorBaris <br />");
			//this.tampilMatriks(mat1);
			var mathas1 = this.isiAwalMatriks(n,m+1);
				//document.write("tampilMatriks(mathas1) <br />");
				//this.tampilMatriks(mathas1);
			for(var i=0;i<n;i++) {
				//document.write("loop <br />");
				for(var j=0;j<m+1;j++) 					
					if(j<k) mathas1[i][j] = mat1[i][j];
						else 
							if(j==k) mathas1[i][j] = v1[i];
								else mathas1[i][j] = mat1[i][j-1];
			}					
			//this.tampilMatriks(mathas1);	
			return mathas1;
		},
		/*
			gabung 2 matriks
		*/
		/*
		gabung2Matriks : function(mat1, mat2){	
			// baris = true ==> gabung kolomnya
		    var n1 = mat1.length; 
			var m1 = mat1[0].length;
			var n2 = mat2.length;
			var m2 = mat2[0].length;
			if(n1==n2){
				var mathas1 = this.isiAwalMatriks(n1,m1+m2);
				for(var i=0;i<n1;i++) {
					for(var j=0;j<m1;j++) mathas1[i][j] = mat1[i][j];
					for(var j=0;j<m2;j++) mathas1[i][m1+j] = mat2[i][j];
					}
				}
				else {
					var mathas1 = this.isiAwalMatriks(n1+n2,m1);
					for(var j=0;j<m1;j++) {
						for(var i=0;i<n1;i++) mathas1[i][j] = mat1[i][j];
						for(var i=0;i<n2;i++) mathas1[i+n1][j] = mat2[i][j];							
					}
				}
			return mathas1;
		},
		*/
		/*
			gabung 2 matriks  -- Kolom -- banyaknya Kolom bertambah
		*/
		gabung2MatriksKolom : function(mat1, mat2){	
			// baris = true ==> gabung kolomnya
		    var n1 = mat1.length; 
			var m1 = mat1[0].length;
			//var n2 = mat2.length;
			var m2 = mat2[0].length;
			var mathas1 = this.isiAwalMatriks(n1,m1+m2);
			for(var i=0;i<n1;i++) {
				for(var j=0;j<m1;j++) mathas1[i][j] = mat1[i][j];
				for(var j=0;j<m2;j++) mathas1[i][m1+j] = mat2[i][j];
				}
			return mathas1;
		},
		gabung2VektorKolom : function(v1, v2){	
			// baris = true ==> gabung kolomnya
		    var n1 = v1.length; 
			//var m1 = mat1[0].length;
			//var n2 = mat2.length;
			//var m2 = mat2[0].length;
			var mathas1 = this.isiAwalMatriks(n1,2);
			for(var i=0;i<n1;i++) {
				 mathas1[i][0] = v1[i];
				 mathas1[i][1] = v2[i];
				}
			return mathas1;
		},
		/*
			gabung 2 matriks -- baris -- banyaknya baris bertambah
		*/
		gabung2MatriksBaris : function(mat1, mat2){	
			// baris = true ==> gabung kolomnya
		    var n1 = mat1.length; 
			var m1 = mat1[0].length;
			var n2 = mat2.length;
			var m2 = mat2[0].length;
			var mathas1 = this.isiAwalMatriks(n1+n2,m1);
			for(var j=0;j<m1;j++) {
				for(var i=0;i<n1;i++) mathas1[i][j] = mat1[i][j];
				for(var i=0;i<n2;i++) mathas1[i+n1][j] = mat2[i][j];							
				}
			
			return mathas1;
		},
		/*
		  mengambil baris ke-barisKe dari suatu matriks mat1 
		*/
		ambilVektorBaris : function(mat1, barisKe){			
		    //var n = mat1.length; 
			var m = mat1[0].length;
			var v1 = OperasiVektor.isiAwal(m);
			for(var j=0;j<m;j++) v1[j] = mat1[barisKe][j];
			return v1;
		},
		/*
		  mengambil baris ke-barisKe dari suatu matriks mat1 
		*/
		ambilBeberapaBarisMatriks : function(mat1, b1, b2){			
		    //var n = mat1.length; 
//document.write("b1 : "+b1+" dan b2 : "+b2+" <br />");			
			var m = mat1[0].length;			
			var mHas = OperasiMatriks.isiAwalMatriks(b2-b1, m);
			for(var i=0;i<b2-b1;i++)
				for(var j=0;j<m;j++) mHas[i][j] = mat1[b1+i][j];
			return mHas;
		},
		/*
		  mengambil beberapa kolom ke-k1 sd kolom ke-k2 dari suatu matriks mat1 
		*/
		ambilBeberapaKolomMatriks : function(mat1, k1, k2){			
		    var n = mat1.length; 
//document.write("k1 : "+k1+" dan k2 : "+k2+" <br />");			
			//var m = mat1[0].length;			
			var mHas = OperasiMatriks.isiAwalMatriks(n, k2-k1);
			for(var i=0;i<k2-k1;i++)
				for(var j=0;j<n;j++) mHas[j][i] = mat1[j][k1+i];
			return mHas;
		},
		ambilVektorKolom : function(mat1, kolomKe){			
		    var n = mat1.length; 
			//var m = mat1[0].length;
			var v1 = OperasiVektor.isiAwal(n);
			for(var i=0;i<n;i++) v1[i] = mat1[i][kolomKe];
			return v1;
		},
		hilangKolomAkhirMatriks : function(mat1){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var mathas1 = this.isiAwalMatriks(n,m-1);
			for(var i=0;i<n;i++) {
				for(var j=0;j<m-1;j++) mathas1[i][j] = mat1[i][j];
				}
			return mathas1;
		},
		hilangVektorKolomMatriks : function(mat1, kol){			
		        var n = mat1.length; 
			var m = mat1[0].length;
			var mathas1 = this.isiAwalMatriks(n,m-1);
			for(var i=0;i<n;i++) {
				for(var j=0;j<kol;j++) mathas1[i][j] = mat1[i][j];
				for(var j2=kol;j2<m-1;j2++) mathas1[i][j2] = mat1[i][j2+1];
				}
			return mathas1;
		},
		hilangVektorBarisMatriks : function(mat1, bar){			
		        var n = mat1.length; 
			var m = mat1[0].length;
			var mathas1 = this.isiAwalMatriks(n-1,m);
			for(var i=0;i<bar;i++) {
				for(var j=0;j<m;j++) mathas1[i][j] = mat1[i][j];
				}
			for(var i=bar;i<n-1;i++) {
				for(var j=0;j<m;j++) mathas1[i][j] = mat1[i+1][j];
				}	
			return mathas1;
		},
		gantiBarisMatriks : function(mat1, v1, bar){			
		    //var n = mat1.length; 
			var m = mat1[0].length;
			for(var j=0;j<m;j++) mat1[bar][j] = v1[j];							
			return mat1;
		},
		// sort matriks berdasarkan barisKe
		sortMatriksBaris : function(mat1, barisKe){			
		    //var n = mat1.length; 
			//var m = mat1[0].length;
			//var v1 = OperasiVektor.isiAwal(n);
			//for(var i=0;i<n;i++) v1[i] = mat1[i][kolomKe];
			//return v1;
		},
		// sort matriks berdasarkan kolomKe
		sortMatriksKolom : function(mat1, kolomKe){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var matHas = OperasiMatriks.isiAwalMatriks(n, m);
			var vKol = Array();
			for(var i=0;i<n;i++) vKol[i] = mat1[i][kolomKe];
//document.write("========== kolomKe : "+kolomKe+" === sortMatriksKolom  : <br />");			
//document.write("========== vKol dan baris,kolom : "+n+","+m+" === sortMatriksKolom : <br />");
//OperasiVektor.tampilVektorString(vKol);document.write("<br />");		
			var vIndeks = OperasiVektor.ambilIndeksVektorSamaSortAsc(vKol);
//document.write("========== vIndeks === sortMatriksKolom  : <br />");
//OperasiVektor.tampilVektorString(vIndeks);document.write("<br />");	
			var iTemp;
			for(var i=0;i<n;i++) {
				iTemp = vIndeks[i];
				for(var j=0;j<m;j++) {
					matHas[i][j] = mat1[iTemp][j];
				}
			}
			return matHas;
		},
		//
		// sort matriks berdasarkan kolomKe1 dan 
		//	dilanjutkan sort berdasarkan kolomKe2 
		//
		sortMatriksDuaKolom : function(mat1, kolomKe1, kolomKe2){			
		    var n = mat1.length; 
			var m = mat1[0].length;
			var matHas = OperasiMatriks.isiAwalMatriks(n, m);
			var matHasAwal = this.sortMatriksKolom(mat1, kolomKe1);		
//document.write("========== matHasAwal : <br />");
//this.tampilMatriksString(matHasAwal);document.write("<br />");	
		
			var vKolSort = this.ambilVektorKolom(matHasAwal, kolomKe1);
//document.write("========== vKolSort : ");
//OperasiVektor.tampilVektorString(vKolSort);document.write("<br />");		
			var matKel = this.buatMatKelompokDanBanyaknya(vKolSort);
//document.write("========== matKel : <br />");
//this.tampilMatriksString(matKel);document.write("<br />");	
			var b1 = 0, b2 = 0;
			var batas = matKel.length;
			for(var i=0;i<batas;i++) {
				b1 = matKel[i][1];
				b2 = b1 + matKel[i][2];
				//if(i<batas-1) b2 = matKel[i+1][1]; else b2=n;
//document.write("========== b1 : "+b1+" dan b2 : "+b2+" <br />");				
				var mAmbil = this.ambilBeberapaBarisMatriks(matHasAwal, b1, b2);
				var mAmbilSort = this.sortMatriksKolom(mAmbil, kolomKe2);
				if(i==0) matHas = mAmbilSort;
					else matHas = this.gabung2MatriksBaris(matHas, mAmbilSort);
			}
			return matHas;
		},
		/*
			vInput --> sudah dirutkan dan memiliki beberapa elemen yang sama
		*/
		buatMatKelompokDanBanyaknya : function(vInput){
		
	    //var vHas = this.ambilVektorKolom(mat,);
		var bar = vInput.length;
		var kol = 3;
		
		var vHas1 = Array(); // no yang berulang
		var vHas2 = Array(); // indeks mulai perulangan'
		var vHas3 = Array(); // banyaknya perulangan
		var hit, iter = 0, sudah, min = vInput[0];
		var puter=0, maks = vInput[vInput.length-1]+1;	
		for(var i2=min ;i2< maks ;i2++){	
			hit = 0;
			sudah=0;
			//vHas1[i2] = i2;			
			for(var i3 = puter ;i3<bar ;i3++){	
				 if(vInput[i3] == i2) {
					hit++; 
					if(sudah==0) {vHas1[iter] = i2; vHas2[iter]=i3; sudah=1;}
					
					}
			}
			if(i2 <= maks && OperasiVektor.cekAdaDiVektor(vInput, i2)) 
				{vHas3[iter] = hit; iter++;}
			puter++;
		}	
/*
document.write("========== vInput : ");
OperasiVektor.tampilVektorString(vInput);document.write("<br />");	
document.write("========== vHas1 : ");
OperasiVektor.tampilVektorString(vHas1);document.write("<br />");	
document.write("========== vHas2 : ");
OperasiVektor.tampilVektorString(vHas2);document.write("<br />");
document.write("========== vHas3 : ");
OperasiVektor.tampilVektorString(vHas3);document.write("<br />");	
//*/	
		var k = vHas2.length;
//document.write("========= k : "+k+"<br>");		
		var matHas = OperasiMatriks.isiAwalMatriks(k , kol);
		for(var i=0 ;i<k ;i++){	
			//for(var j=0 ;j<kol ;j++){
			//matHas[i][0] = i;
			matHas[i][0] = vHas1[i];
			matHas[i][1] = vHas2[i];
			matHas[i][2] = vHas3[i];
			//}
		}						
		return matHas;
	},
	/*
		Menampilkan matriks
	*/
		tampilMatriks : function(mat1){
					//document.write("tampil <br />"); sort(function(a, b){return b-a});
					var n = mat1.length; 
					var m = mat1[0].length;
					//document.write("nilai n : "+n);
					for(var i=0;i<n;i++) {
						for(var j=0;j<m;j++) {
						   if(Number.isInteger(mat1[i][j])) 	
							  document.write(mat1[i][j]+" ");
							    else {
									if(Math.abs(mat1[i][j]) < 0.001) document.write(mat1[i][j].toFixed(7)+" ");
									     else document.write(mat1[i][j].toFixed(2)+" ");
								}									
						}
					document.write("<br />");	
					}	
		},
		
	
		tampilMatriksString : function(mat1){
					//document.write("tampil <br />"); sort(function(a, b){return b-a});
					var n = mat1.length; 
					var m = mat1[0].length;
					//document.write("nilai n : "+n);
					for(var i=0;i<n;i++) {
						for(var j=0;j<m;j++) {
						   document.write(mat1[i][j]+" ");
						}
					document.write("<br />");	
					}	
		}
		//*/
		
	};
//####################################################################################
//			OperasiArray3Dim
//####################################################################################	
var OperasiArray3Dim = {
		isiAwalArray3Dim : function(bar , kol, tinggi){
			//document.write("isiAwalArray3Dim <br />");
			var a3dim = new Array(bar);
			//for(var i=0;i<bar;i++) if(i>0) a3dim[i].push(0);
			for(var i=0;i<bar;i++){	
				//var v1 = OperasiVektor.isiAwal(kol);
				a3dim[i] = new Array(kol); //.push(v1);
				for(var j=0;j<kol;j++) {
					a3dim[i][j] = new Array(tinggi);
					for(var k=0;k<tinggi;k++)
						 a3dim[i][j][k]=0;
						}
				}
			//this.tampilArray3Dim(a3dim);
			return a3dim;
		},
		kaliSkalar : function(a3dim1, konstanta){			
		    var n = a3dim1.length; 
			var m = a3dim1[0].length;
			var p = a3dim1[0][0].length;
			//document.write("nilai n : "+n+" dan m : "+m+"<br />");
			var a3dimhas1 = this.isiAwalArray3Dim(n,m,p);
			//this.tampilArray3Dim(a3dimhas1);
			//this.tampilArray3Dim(a3dim1);
			for(var i=0;i<n;i++) {
				for(var j=0;j<m;j++) {
				//document.write("nilai i : "+i+" dan j : "+j+"<br />");
					for(var k=0;k<p;k++)
						a3dimhas1[i][j][k] = a3dim1[i][j][k]*konstanta;
					}
				}
			//this.tampilArray3Dim(a3dimhas1);	
			return a3dimhas1;
		},		
		tampilArray3Dim : function(a3dim1){
					//document.write("tampil <br />"); sort(function(a, b){return b-a});
					var n = a3dim1.length; 
					var m = a3dim1[0].length;
					var p = a3dim1[0][0].length;
					//document.write("nilai n : "+n);
					for(var i=0;i<n;i++) {
						for(var j=0;j<m;j++) {
							for(var k=0;k<p;k++) {
								document.write(a3dim1[i][j][k]+" ");
								}
							document.write("<br />");	
						}
					document.write("<br />");	
					}	
		},
		tampilArray3DimRiil : function(a3dim1){
					//document.write("tampil <br />"); sort(function(a, b){return b-a});
					var n = a3dim1.length; 
					var m = a3dim1[0].length;
					var p = a3dim1[0][0].length;
					//document.write("nilai n : "+n);
					for(var i=0;i<n;i++) {
						for(var j=0;j<m;j++) {
							for(var k=0;k<p;k++) {
								document.write(a3dim1[i][j][k].toFixed(3)+" ");
								}
							document.write("<br />");
						}
					document.write("<br />");	
					}	
		}
		
	};
//####################################################################################
//			OperasiVektor
//####################################################################################
var OperasiVektor = {
		isiAwal : function(n){
			var vIsi = new Array(n); //[0];
			for(var i = 0 ; i<n ;i++) {
					vIsi[i] = 0;
					}
			return vIsi;
		},
		kaliSkalar : function(v1, k){			
		    var n = v1.length; 
			//document.write("nilai v10*k : "+(v1[0]*k)+"<br />");
			//var vhas1 = [v1[0]*k];
			var vhas1 = this.isiAwal(n);
			//for(var i=0;i<n;i++) document.write("nilai vHas1 : "+vhas1[i]+"<br />");
			//this.tampil(vhas1);
			//document.write("nilai v1[0] : "+v1[0]+"<br />");
			//document.write("nilai n : "+n+"<br />");
		    //for(var i=1;i<n;i++) {
			for(var i=0;i<n;i++) {
				//document.write("nilai i : "+i+"<br />");
				//vhas1.push(v1[i]*k);
				vhas1[i]=v1[i]*k;
				}
			//document.write("nilai vHas1[0] : "+vhas1[0]+"<br />");
			return vhas1;
		},
		bagiSkalar : function(v1, k){			
		    var n = v1.length; 			
			var vhas1 = this.isiAwal(n);			
			for(var i=0;i<n;i++) {				
				vhas1[i]=v1[i]/k;
				}
			return vhas1;
		},
		kurangSkalar : function(v1, k){			
		    var n = v1.length; 			
			var vhas1 = this.isiAwal(n);			
			for(var i=0;i<n;i++) {				
				vhas1[i]=v1[i]-k;
				}
			return vhas1;
		},
		jumlah2Vektor : function(v1, v2){			
		    var n = v1.length; 			
			var vhas1 = this.isiAwal(n);			
			for(var i=0;i<n;i++) {				
				vhas1[i]=v1[i]+v2[i];
				}
			return vhas1;
		},
		kurang2Vektor : function(v1, v2){			
		    var n = v1.length; 			
			var vhas1 = this.isiAwal(n);			
			for(var i=0;i<n;i++) {				
				vhas1[i]=v1[i]-v2[i];
				}
			return vhas1;
		},
		operatorDotVektor : function(v1, v2){			
		    var n = v1.length; 			
			var vhas1 = this.isiAwal(n);			
			for(var i=0;i<n;i++) {				
				vhas1[i]=v1[i]*v2[i];
				}
			return vhas1;
		},
		jarakEuclide : function(v1, v2){				
			var vKurang = this.kurang2Vektor(v1, v2);
			var vKuadrat = this.kuadratVektor(vKurang);
			var vTemp = this.jumlahVektor(vKuadrat);
			var vhas1 = Math.sqrt(vTemp);			
			return vhas1;
		},
		kuadratVektor : function(v1){			
		    var n = v1.length; 			
			var vhas1 = this.isiAwal(n);			
			for(var i=0;i<n;i++) {				
				vhas1[i]=v1[i]*v1[i];
				}
			return vhas1;
		}, 
		jumlahVektor : function(v1){			
		    var n = v1.length; 
			var jlh = 0;
			//var vhas1 = this.isiAwal(n);			
			for(var i=0;i<n;i++) {				
				jlh = jlh + v1[i];
				}
			return jlh;
		},
		
		hitungElemenNol : function(v1){			
		    var n = v1.length; 
			var jlh = 0;
			//var vhas1 = this.isiAwal(n);			
			for(var i=0;i<n;i++) {				
				if(v1[i] < 0.0000001) jlh++ ;
				}
			return jlh;
		},
		hitungMean : function(v1){			
		    var n = v1.length; 
			var jlh = this.jumlahVektor(v1);
			return jlh/n;
		},
		hitungVarians : function(v1){			
		    var n = v1.length; 						
			var hm = this.hitungMean(v1);
			var kvk = this.kurangSkalar(v1, hm);
			var kv = this.kuadratVektor(kvk);
			var jlh = this.jumlahVektor(kv);			
			return jlh/(n-1);
		},
		gabung2Vektor : function(v1, v2){			
		    var n = v2.length; 			
			//var vhas1 = this.isiAwal(n);			
			for(var i=0;i<n;i++) {				
				v1.push(v2[i]);
				}
			return v1;
		},
		/*
		input 	: vektor data dan k -> banyaknya elemen yang diambil 
		Output 	: vektor yang berisi k elemen dari vektor data
		fungsi	: mengambil vektor dari suatu vektor (k elemen pertama)
		*/
		ambilVektorDariVektor : function(v1, k){			
		    //var n = v1.length; 			
			var vhas1 = this.isiAwal(k);			
			for(var i=0;i<k;i++) {				
				vhas1[i]=v1[i];
				}
			return vhas1;
		},
		//hilangkan elemen terakhir suatu vektor
		hilangElemenAkhirVektor : function(v1){			
		    var n = v1.length; 			
			var vhas1 = this.isiAwal(n-1);			
			for(var i=0;i<n-1;i++) {				
				vhas1[i]=v1[i];
				}
			return vhas1;
		},
		// mengambil indeks dari vektor yang di-sort Desc (besar - kecil)
		ambilIndeksVektorSortDesc : function(v1){			
		    var n = v1.length;			
			var vSort = this.isiAwal(n);
			for(var i=0;i<n;i++) vSort[i] = v1[i];
			vSort = this.urutDesc(vSort);
			var vhas1 = this.isiAwal(n);	 
//document.write("v1 : ");this.tampilVektorRiil(v1);document.write("<br />");
//document.write("vSort : ");this.tampilVektorRiil(vSort);document.write("<br />");
//document.write("vhas1 : ");this.tampilVektorRiil(vhas1);document.write("<br />");			
			for(var i=0;i<n;i++) 
				for(var j=0;j<n;j++)
				   if(v1[j]==vSort[i]) {
								vhas1[i]=j;
								break;
								}
			return vhas1;
		},
		/*
		   mengambil indeks dari vektor yang di-sort Asc (kecil - besar)
		   untuk kasus kalau bilangan yang diurutkan tidak ada yang sama
		   
		*/
		ambilIndeksVektorSortAsc : function(v1){			
		    var n = v1.length;			
			var vSort = this.isiAwal(n);
			for(var i=0;i<n;i++) vSort[i] = v1[i];
			vSort = this.urutAsc(vSort); 
			var vhas1 = this.isiAwal(n);	 
//document.write("v1 : ");this.tampilVektor(v1);document.write("<br />");
//document.write("vSort : ");this.tampilVektor(vSort);document.write("<br />");
//document.write("vhas1 : ");this.tampilVektor(vhas1);document.write("<br />");	
			
			for(var i=0;i<n;i++){
				for(var j=0;j<n;j++){
					if(v1[j]==vSort[i]) {
						vhas1[i]=j;								
						break;
						}												
				}
			}
//document.write("vhas1 : ");this.tampilVektor(vhas1);document.write("<br />");			
			return vhas1;
		},
		/*
		   mengambil indeks dari vektor yang di-sort Asc (kecil - besar)
		   untuk kasus kalau bilangan yang diurutkan === ADA YANG SAMA ===
		   
		*/
		ambilIndeksVektorSamaSortAsc : function(v1){			
		    var n = v1.length;			
			var vSort = this.isiAwal(n);
			for(var i=0;i<n;i++) vSort[i] = v1[i];
			//vSort = 
			this.urutAsc2(vSort); 
			var vhas1 =  Array();	
			//for(var i=0;i<n;i++) vhas1[i] = Math.random(); 
//document.write("v1 : ");this.tampilVektorString(v1);document.write("<br />");
//document.write("===vSort : ");this.tampilVektorString(vSort);document.write("<br />");
//document.write("===vhas1 : ");this.tampilVektorString(vhas1);document.write("<br />");	
			//var puter;
			//var pindah = true;
			var banding;
			for(var i=0;i<n;i++){
				banding = vSort[i];				
				if(i == 0) {
					
					for(var j=0;j<n;j++){
						if(v1[j]==banding) {
								vhas1[i]=j;
								//pindah = false;
								break;
								}
					}
//document.write("i : "+i+" dan vhas1 : ");this.tampilVektorString(vhas1);
//document.write("<br />");					
				}
				else {			
					//if(v1[i] != v1[i-1]) {
						
						for(var j=0;j<n;j++){
							if((v1[j]==banding) && !(this.cekAdaDiVektor(vhas1, j))) {
								//puter++;
								vhas1[i]=j;
								//pindah = true;
								break;
								}
							}
//document.write("i : "+i+", BEDA dan vhas1 : ");this.tampilVektorString(vhas1);
//document.write("<br />");								
						//}
						//else {
						//	vhas1[i]=vhas1[i-1] + 1;
//document.write("i : "+i+", SAMA dan vhas1 : ");this.tampilVektor(vhas1);document.write("<br />");														
						//}
				}
			}
//document.write("===vhas1 : ");this.tampilVektorString(vhas1);document.write("<br />");			
			return vhas1;
		},
		/*
			cekAdaDiVektor(vhas1, j)
		*/
		cekAdaDiVektor : function(vhas1, j){			
		    var n = vhas1.length;
			var has = false;
			for(var i=0;i<n;i++) {
				if(vhas1[i] == j) { 
					has = true; 
					break; 
					}
			}
			return has;
		},
		/*
			cek Ada Elemen Yang Sama di suatu vektor Vektor
		*/
		cekAdaElemenSamaVektor : function(vhas1){			
		    var n = vhas1.length;
			var has = false;
			for(var i=0;i<n-1;i++) {
				for(var j=i+1;j<n;j++) {
					if(vhas1[i] == vhas1[j]) { 
						has = true; 
						break; 
						}
				}
			}
			return has;
		},
		/*
		input 	: vektor data
		Output 	: nilai maksimum
		fungsi	: untuk mendapatkan nilai maksimum di suatu vektor data
		*/
		hitungMax : function(v1){			
		    var n = v1.length; 			
			return this.urutAsc(v1)[n-1];
		},
		/*
		input 	: vektor data
		Output 	: nilai minimum
		fungsi	: untuk mendapatkan nilai minimum di suatu vektor data
		*/
		hitungMin : function(v1){			
			return this.urutDesc(v1)[0];
		},
		/*
		input 	: vektor data
		Output 	: sort dari kecil ke besar
		fungsi	: untuk mendapatkan sort suatu vektor data
		*/
		urutAsc : function(vSort){	
			var uk=vSort.length, kerja;
			for(var i=0;i<uk-1;i++){
				for(var j=i;j<uk;j++){
					if(vSort[i]>vSort[j]) {
						kerja=vSort[i];
						vSort[i]=vSort[j];
						vSort[j]=kerja;
					}
				}
			}
        return vSort;
		},
		/*
		input 	: vektor data
		Output 	: sort dari besar ke kecil
		fungsi	: untuk mendapatkan sort suatu vektor data
		*/
		urutDesc : function(vSort){
			var uk=vSort.length, kerja;
			for(var i=0;i<uk-1;i++){
				for(var j=i;j<uk;j++){
					if(vSort[i]<vSort[j]) {
						kerja=vSort[i];
						vSort[i]=vSort[j];
						vSort[j]=kerja;
					}
				}
			}
        return vSort;
		},
		/*
		  urutan data numeric dengan syntax sort()
		*/
		urutDesc2 : function(v1){ //besar ke kecil			
			return v1.sort(function(a, b){return b-a});
		},
		urutAsc2 : function(v1){ // kecil ke besar			
			return v1.sort(function(a, b){return a-b});
		},
		/*
		input 	: vektor data String
		Output 	: sort dari a ke z
		fungsi	: untuk mendapatkan sort suatu vektor data String
		*/
		urutAscString : function(v1){			
			return v1.sort(function(a,b){return a.localeCompare(b);});
		},
		urutDescString : function(v1){			
			return v1.sort(function(a,b){return b.localeCompare(a);});
		},
		/*
		function strDes(a, b) { if (a>b) return -1; else if (a<b) return 1; else return 0;}
		var a2=["1", "a", "A", "b"];
		a2.sort(strDes);
		document.write(a2);
		*/
		//users.sort(function(a,b){
		//	return a.firstname.localeCompare(b.firstname);
		//	})
		
		/*
		input 	: vektor data dan  k -> banyaknya elemen yang dibuang
		Output 	: vektor yang berisi k elemen dari vektor data
		fungsi	: menghilangkan vektor dari suatu vektor (k elemen pertama)
		*/
		hilangVektorDariVektor : function(v1, k){			
		    var n = v1.length; 			
			var vhas1 = this.isiAwal(n-k);			
			for(var i=0;i<n-k;i++) {				
				vhas1[i]=v1[i+k];
				}
			return vhas1;
		},
		tampilVektor : function(v2){
					//document.write("tampil <br />"); sort(function(a, b){return b-a});
					var n = v2.length; 
					//document.write("nilai n : "+n);
					for(var i=0;i<n;i++) {
						if(Number.isInteger(v2[i])){
							if(i<n-1) document.write(v2[i]+" ");
								else document.write(v2[i]);
							}
							else {
								if(i<n-1) {
									if(Math.abs(v2[i]) < 0.001) document.write(v2[i].toFixed(7)+" ");
									else document.write(v2[i].toFixed(2)+" ");
								   }
									else {
										if(Math.abs(v2[i]) < 0.001) document.write(v2[i].toFixed(7)+" ");
											else document.write(v2[i].toFixed(2)+" ");
										 }
							    }
						}
		},
		//*,
		tampilVektorRiil : function(v2){
					//document.write("tampil <br />"); sort(function(a, b){return b-a});
					var n = v2.length; 
					//document.write("nilai n : "+n);
					for(var i=0;i<n;i++) {
						if(i<n-1) document.write(v2[i].toFixed(6)+" ");
							else document.write(v2[i].toFixed(6));
						}
		},
		tampilVektorString : function(v2){
					//document.write("tampil <br />"); sort(function(a, b){return b-a});
					var n = v2.length; 
					//document.write("nilai n : "+n);
					for(var i=0;i<n;i++) {
						if(i<n-1) document.write(v2[i]+" ");
							else document.write(v2[i]);
						}
		}
		//*/	
	};  
		

 	