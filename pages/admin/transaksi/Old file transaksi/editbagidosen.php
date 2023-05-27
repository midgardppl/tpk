<?php
session_start();
include('../../../koneksi.php');
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['jabatan']) || empty($_SESSION['jabatan']) || $_SESSION['jabatan']!="jab001"){
echo "<META http-equiv='refresh' content='0;URL=../../../logout.php'>";
        }
echo "<META http-equiv='refresh' content='1800;URL=../../../logout.php'>";
$nama = $_SESSION['namapegawai'];
$jabatan = $_SESSION['jabatan'];
$sql=mysql_query("select namajabatan from jabatan where kodejabatan='$jabatan'");
$row=mysql_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fakultas Vokasi Universitas Airlangga</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Fakultas Vokasi Universitas Airlangga</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->

                <!-- /.dropdown -->

                <!-- /.dropdown -->
                <li class="dropdown">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $row['namajabatan'];?></a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../../../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                    
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <?php include("../sidebaradmin.php")?>
            
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">

                <div class="col-lg-12">
                    <h1 class="page-header">UBAH DATA PEMBAGIAN DOSEN</h1>
                </div>
                <div class="row col-lg-6">
                <?php
//$sql = mysql_query("SELECT DETAILAJAR.NIP, PEGAWAI.NAMAPEGAWAI, DETAILAJAR.KODEMATKUL, MATAKULIAH.NAMAMATKUL,
//DETAILAJAR.KODETHNAJARAN,TAHUNAJARAN.TAHUNAJARAN,DETAILAJAR.KODESEMESTER,SEMESTER.NAMASEMESTER
//FROM DETAILAJAR INNER JOIN PEGAWAI INNER JOIN MATAKULIAH INNER JOIN TAHUNAJARAN INNER JOIN SEMESTER
//ON DETAILAJAR.NIP=PEGAWAI.NIP AND DETAILAJAR.KODEMATKUL=MATAKULIAH.KODEMATKUL AND
//DETAILAJAR.KODETHNAJARAN=TAHUNAJARAN.KODETHNAJARAN AND DETAILAJAR.KODESEMESTER=SEMESTER.KODESEMESTER 
//WHERE DETAILAJAR.NIP='$_GET[nip]' AND DETAILAJAR.KODEMATKUL='$_GET[kodematkul]'") or die (mysql_error());				

//$c1=$_GET['nip'];		
//$c2=$_GET['kodematkul'];
//echo $c1." dan ".$c2."<br/ >";
			
$sql = mysql_query("SELECT DA.NIP, P.NAMAPEGAWAI, DA.KODEMATKUL, MK.NAMAMATKUL,DA.KODETHNAJARAN,TA.TAHUNAJARAN,DA.KODESEMESTER,S.NAMASEMESTER FROM DETAILAJAR AS DA INNER JOIN PEGAWAI AS P INNER JOIN MATAKULIAH AS MK INNER JOIN TAHUNAJARAN AS TA INNER JOIN SEMESTER AS S ON DA.NIP=P.NIP AND DA.KODEMATKUL=MK.KODEMATKUL AND DA.KODETHNAJARAN=TA.KODETHNAJARAN AND DA.KODESEMESTER=S.KODESEMESTER WHERE DA.NIP='$_GET[nip]' AND DA.KODEMATKUL='$_GET[kodematkul]'") or die (mysql_error());
mysql_select_db($nama_db, $koneksi) or die("Gagal memilih database!");
$row=mysql_fetch_array($sql);
//echo $row."<br/ >";
?>

<form method="post" action="updatebagidosen.php" style="font-size:16px">


<div class="form-group">
<label>Dosen</label>
<select class="form-control" name="nip" required>
     <option value="<?php echo $row['NIP']; ?>" selected="selected">--<?php echo $row['NAMAPEGAWAI']; ?>--</option>
      <?php
        $query_peg = mysql_query("select * from pegawai") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($baris_peg = mysql_fetch_array($query_peg)){
            echo "<option value='".$baris_peg[0]."'>".$baris_peg[3]."</option>";
        }
        ?>  
</select><br>
</div>

<div class="form-group">
<label>Mata Kuliah</label>
<select class="form-control" name="kodematkul" required>
     <option value="<?php echo $row['KODEMATKUL']; ?>" selected="selected">--<?php echo $row['NAMAMATKUL']; ?>--</option>
      <?php
        //$query_mk = mysql_query("select * from matakuliah") or die (mysql_error());
       // while($baris_mk = mysql_fetch_array($query_mk)){
        //    echo "<option value='".$baris_mk['KODEMATKUL']."'>".$baris_mk['NAMAMATKUL']."</option>";
        //}
        ?>  
        
</select><br>
</div>

<div class="form-group">
<label>Tahun Ajaran</label>
<select class="form-control" name="kodethnajaran" required>
     <option value="<?php echo $row['KODETHNAJARAN']; ?>" selected="selected">--<?php echo $row['TAHUNAJARAN']; ?>--</option>
        
</select><br>
</div>

<div class="form-group">
<label>Semester</label>
<select class="form-control" name="kodesemester" required>
     <option value="<?php echo $row['KODESEMESTER']; ?>" selected="selected">--<?php echo $row['NAMASEMESTER']; ?>--</option>       
</select><br>
</div>

<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Perbarui </button>
<a href="insertview_bagidosen.php"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</button></a></td>
</form>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../../vendor/raphael/raphael.min.js"></script>
    <script src="../../../vendor/morrisjs/morris.min.js"></script>
    <script src="../../../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../../dist/js/sb-admin-2.js"></script>

</body>

</html>
