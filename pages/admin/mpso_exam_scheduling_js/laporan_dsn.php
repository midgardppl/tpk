<?php
session_start();
include('../../../koneksi.php');
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['jabatan']) || empty($_SESSION['jabatan']) || $_SESSION['jabatan']!="jab001"){
echo "<META http-equiv='refresh' content='0;URL=../../../logout.php'>";
        }
echo "<META http-equiv='refresh' content='1800;URL=../../../logout.php'>";
$nama = $_SESSION['namapegawai'];
$jabatan = $_SESSION['jabatan'];
$sql=mysqli_query($koneksi,"select namajabatan from jabatan where kodejabatan='$jabatan'");
$row=mysqli_fetch_array($sql);
?>

<?php
if (isset($_POST['simpan'])) {
   $server = "localhost";
   $user = "root";
   $pass = "";
   $db = "db_jadwal_baru2";
   
   $conn = new mysqli($server, $user, $pass, $db);
   
   if($conn -> connect_errno)
   {
      echo "Database connection failed!<BR>";
      echo "Reason: ", $conn -> connect_error;
      exit();
   }
   else
   {
      $dosen = $_POST["dos"];
      $tahun_ajaran = $_POST["ta"];
      $semester = $_POST["sem"];
      $masa_ujian = $_POST["mu"];
      
      $sql = "INSERT INTO pengawasdosen(nip, kd_thn_ajaran, kd_semester, uts_or_uas)
         VALUES('$dosen', '$tahun_ajaran', '$semester', '$masa_ujian');";
      
      $res = $conn -> query($sql);
      if($res)
      {
         echo "Data inserted into the database successfully!";
         
         // block of code to process further...
      }
      else
      {
         echo "Something went wrong!<BR>";
         echo "Error description: ", $conn -> error;
         exit();
      }
   }
   $conn -> close();
}
    header("laporan_dsn.php");
?>

// MYSQLI QUERY UPDATE LIAT SISWA //

<?php
if (isset($_POST['update'])) {
   $server = "localhost";
   $user = "root";
   $pass = "";
   $db = "db_jadwal_baru2";
   

   $conn = new mysqli($server, $user, $pass, $db);
   
   if($conn -> connect_errno)
   {
      echo "Database connection failed!<BR>";
      echo "Reason: ", $conn -> connect_error;
      exit();
   }
   else
   {
      $dosen = $_POST["dos"];
      $tahun_ajaran = $_POST["ta"];
      $semester = $_POST["sem"];
      $masa_ujian = $_POST["mu"];
      
      $sql = "UPDATE pengawasdosen SET kd_thn_ajaran='$tahun_ajaran', 
      kd_semester='$semester', uts_or_uas='$masa_ujian' WHERE nip=$dosen ";
      
      $res = $conn -> query($sql);
      if($res)
      {
         echo "Data inserted into the database successfully!";
         
         // block of code to process further...
      }
      else
      {
         echo "Something went wrong!<BR>";
         echo "Error description: ", $conn -> error;
         exit();
      }
   }
   $conn -> close();
}
    header("laporan_dsn.php");
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
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>

<link rel="stylesheet" href="style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script>
$(document).ready(function(){});
function viewDt(){
var t = $('#ta').val();
var tt = $('#sm').val();
var ttt = $('#hr').val();
	$.ajax({
		url: "getLLLL.php?t="+t+"&tt="+tt+"&ttt="+ttt,
		success: function(msg){
			$('.dtl').html(msg);
		},
		dataType: "html"
		});
}
</script>
<script type="text/javascript">
function printExternal(url) {
    var printWindow = window.open( url, '_blank');
	printWindow.focus();
    printWindow.addEventListener('load', function(){
        printWindow.print();
        //printWindow.close();
    }, true);
}</script>
    
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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">PENGAWAS - DOSEN</h1>
                </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pilih Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">


<?php //$querymatkul = mysql_query("select tawaranmatkul.kodematkul,matakuliah.namamatkul,
//tawaranmatkul.kodethnajaran,tahunajaran.tahunajaran,tawaranmatkul.kodesemester,semester.namasemester from matakuliah
//inner join tahunajaran inner join semester inner join tawaranmatkul on tawaranmatkul.kodematkul=matakuliah.kodematkul and
//tawaranmatkul.kodethnajaran=tahunajaran.kodethnajaran and tawaranmatkul.kodesemester=semester.kodesemester
		//where tawaranmatkul.statustawaran='aktif'") or die (mysql_error());?>

<form action="" method="POST">

    <div class="form-group">
    <label>Dosen</label>
    <select class="form-control dependant" name="dos" id="ta" required onchange="viewDt();">
     <option value="-" selected="selected" class="null">-- Semua --</option>
     <?php
        $querythn = mysqli_query($koneksi,"select * from pegawai where kodejabatan='jab002'") or die (mysqli_error($koneksi));
        //$satuan = $queryjabatan['namajabatan'];
        while($baristhn = mysqli_fetch_array($querythn)){
            echo "<option value='".$baristhn[0]."'>".$baristhn[3]."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>Tahun Ajaran</label>
<select class="form-control dependant" name="ta" id="sm" required onchange="viewDt();">
     <option value="-" selected="selected" class="null">-- Semua --</option>
        <?php
        $querysem = mysqli_query($koneksi,"select * from tahunajaran") or die (mysqli_error($koneksi));
        //$satuan = $queryjabatan['namajabatan'];
        while($barissem = mysqli_fetch_array($querysem)){
            echo "<option value='".$barissem[0]."'>".$barissem[1]."</option>";
        }
        ?>
</select><br>
<a href="" style="text-decoration: none;">Add Tahun Ajaran</a>
</div>
<div class="form-group">
<label>Semester</label>
<select class="form-control dependant" name="sem" id="hr" required onchange="viewDt();">
     <option value="-" selected="selected" class="null">-- Semua --</option>
        <?php
        $querysem = mysqli_query($koneksi,"select * from semester") or die (mysqli_error($koneksi));
        //$satuan = $queryjabatan['namajabatan'];
        while($barissem = mysqli_fetch_array($querysem)){
            echo "<option value='".$barissem[0]."'>".$barissem[1]."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
    <label>Masa Ujian</label>
    <select class="form-control dependant" name="mu" id="hr" required onchange="viewDt();">
        <option value="-" selected="selected" class="null">-- Semua --</option>
        <?php
        // $querysem = mysqli_query($koneksi,"select * from penjadwalan") or die (mysqli_error($koneksi));
        // $satuan = $queryjabatan['namajabatan'];
        // while($barissem = mysqli_fetch_array($querysem)){
        //     echo "<option value='".$barissem[0]."'>".$barissem[3]."</option>";
        // }
        // ?>
        <option value="0">UTS</option>
        <option value="1">UAS</option>
</select><br>
</div>
    <button type="submit" name="simpan" style="background-color:burlywood; border:none; padding:5px;"><a href="#" style="text-decoration: none; color:black; text-transform:uppercase;">simpan</a></button>
</form>	

                                </div>
                                <!-- /.col-lg-6 (nested) -->

                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Penjadwalan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body"><div class="dtl">
                            <?php
echo "<table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>";
echo "<thead>";
echo "<tr>";
	echo "<th style='width:60px'>Dosen</th>";
    echo "<th style='width:100px'>Tahun Ajaran</th>";
    echo "<th style='width:100px'>Semester</th>";
	echo "<th style='width:100px'>Masa Ujian</th>";
	echo "<th style='width:100px'>Aksi</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
// $sqls = mysqli_query($koneksi,"select dk.kodematkul, dt.koderuang, dt.kodehari, dt.kodejam, dt.kodejam2 
//     from detailjadwal dt, detailkelas dk where 
//     dt.kodekelas=dk.kodekelas and dt.kodeprodi=dk.kodeprodi group by dt.iddetail") 
$sql = mysqli_query($koneksi, "select pg.namapegawai, ta.tahunajaran, sem.`NAMASEMESTER`, 
CASE 
    WHEN uts_or_uas=0 THEN  'UTS'
    ELSE  'UAS'
END AS 'MASA UJIAN'
from pengawasdosen pd, pegawai pg, tahunajaran ta, semester sem 
WHERE pd.nip=pg.`NIP`AND ta.`KODETHNAJARAN`=pd.kd_thn_ajaran AND sem.`KODESEMESTER`=pd.kd_semester")
        or die (mysqli_error($koneksi));
mysqli_select_db($koneksi,$nama_db) or die("Gagal memilih database!");
$no = 0;
while ($row = mysqli_fetch_array($sql)){
    $no = $no+1;    
	$ta=mysqli_fetch_array(mysqli_query($koneksi,"select namapegawai from pegawai where nip ='".$row[0]."'"));
// $sm=mysqli_fetch_array(mysqli_query($koneksi,"select  from ruangan where koderuang='".$row[1]."'"));
// $hr=mysqli_fetch_array(mysqli_query($koneksi,"select * from hari where kodehari='".$row[2]."'"));
// $j1=mysqli_fetch_array(mysqli_query($koneksi,"select * from jam where kodejam='".$row[3]."'"));
// $j2=mysqli_fetch_array(mysqli_query($koneksi,"select * from jam where kodejam='".$row[4]."'"));
?>
    <tr>
        <td><?php echo $row[0]; ?> </td>
        <td><?php echo $row[1];?></td>
        <td><?php echo $row[2];?></td>
		<td><?php echo $row[3];?></td>
        <td>
            <button id="editButton" onclick="openPopup()" class="edit-button">
                <ion-icon name="create-outline"></ion-icon>
            </button>
            <button id="deleteButton" class="delete-button">
                <a href="" ><ion-icon name="close-circle-outline"></ion-icon></a>
            </button>
        </td>
        
    </tr>
<?php
}
echo "</tbody>";
echo "</table>";
?>
                            <!-- /.table-responsive -->
                        <form method="post" action="javascript: printExternal('p_laporan_dsn.php')" style="font-size:16px">

						<button type="submit">Cetak</button>
</form>


						</div></div>
                        <!-- /.panel-body -->
						                                    
                    </div>
					
                    <!-- /.panel -->
                </div>
				
                <!-- /.col-lg-12 -->
            </div>
			
                <!-- /.col-lg-12 -->
                    <div class="container">
                        <div id="popUpForm">
                            <div class="popUp">
                            <form method="POST" action="" id="updateForm">
                                <?php
                                include('../../../koneksi.php');   
                                $dosen=$_GET[]
                                $namaDosen = mysqli_query($koneksi, "select namapegawai from pegawai where nip=$dosen");
                                $tahunAjar = mysqli_query($koneksi, "SELECT tahunajaran FROM tahunajaran ta, pengawasdosen pd  where pd.kd_thn_ajaran=ta.kodethnajaran AND nip=$dosen");
                                $sems = mysqli_query($koneksi, "SELECT namasemester FROM semester se, pengawasdosen pd where se.kodesemester=pd.kd_semester AND nip=$dosen");
                                
                                ?>
                                <div class="upper">
                                    
                                    <button class="icon-btn" id="close"><i ><ion-icon name="close-circle-outline"></ion-icon></i></button>
                                </div>
                                <h3>Update Data</h3>
                            <div class="form-group">
                                <label>Dosen</label>
                                <select class="form-control dependant" name="dos" id="ta" required onchange="viewDt();">
                                <option value="" selected="selected" class="null"><?=$namaDosen?></option>
                                
                            </select><br>
                            </div>
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select class="form-control dependant" name="dos" id="ta" required onchange="viewDt();">
                                <option value="-" selected="selected" class="null"><?$tahunAjar?></option>
                                <option value="">1</option>
                                <option value="">1</option>
                            </select><br>
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <select class="form-control dependant" name="dos" id="ta" required onchange="viewDt();">
                                <option value="" selected="selected" class="null"><?$sems?></option>
                                <option value="">1</option>
                                <option value="">1</option>
                            </select><br>
                            </div>
                            <div class="form-group">
                                <label>Masa Ujian</label>
                                <select class="form-control dependant" name="dos" id="ta" required onchange="viewDt();">
                                <option value="-" selected="selected" class="null"></option>
                                
                            </select><br>
                            </div>
                            <button type="submit" name="update" style="background-color:burlywood; border:none; padding:5px;"><a href="#" style="text-decoration: none; color:black; text-transform:uppercase;">simpan</a></button>

                            </form>  
                            </div>
                        </div>
                    </div>
            </div>
			
            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->
        </div>
		
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    <script>
        const openButton = document.getElementById("editButton");
        const closeButton = document.getElementById("close");
        const popupFormContainer = document.getElementById("popUpForm");

        // Event listeners
        // openButton.addEventListener("click", function() {
        // });
        function openPopup() {
            popupFormContainer.style.display = "block";    
        }
        
        closeButton.addEventListener("click", function() {
            popupFormContainer.style.display = "none";
        });

        document.getElementById("updateForm").addEventListener("submit", function(event) {
            event.preventDefault();
        });
        // Optional: Close the form when clicking outside the form container
        // window.addEventListener("click", function(event) {
        //     if (event.target === popupFormContainer) {
        //         popupFormContainer.style.display = "none";
        //     }
        // });
    </script>

    <!-- jQuery -->
    <script src="../../../vendor/jquery/jquery.js"></script>
    <script src="../../../vendor/jquery/jquery-migrate-3.0.0.js"></script>
     <!-- jQuery Chained -->
   	<script src="../../../vendor/jquery/jquery.chained.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../../vendor/raphael/raphael.min.js"></script>
    <script src="../../../vendor/morrisjs/morris.min.js"></script>
    <script src="../../../data/morris-data.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../../dist/js/sb-admin-2.js"></script>


    
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
    <script>
	$(".dependant").each(function() {
  	$(this).chained($("#kodematkul"));
	});

    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>
