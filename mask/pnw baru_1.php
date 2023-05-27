<?php 
include('../dblib.php'); 
$page='Pemesanan'; include('../header.php'); 
if(empty($_SESSION['user']) && empty($_SESSION['pass'])){
  echo"<script language='javascript'>window.location = '../../index.php'</script>";
}
//if add new corp
if (@$_POST['page']=='corp') {
  insertPerusahaan($_POST['tperusahaan']);
  $_SESSION['pnw']['corp']=mysql_insert_id();
  $corp=mysql_fetch_array(selectPerusahaan($_SESSION['pnw']['corp']));
  $_SESSION['pnw']['cprov']=$corp['provinsi_id'];
  $_SESSION['pnw']['calamat']=$corp['perusahaan_alamat'];
  $_SESSION['pnw']['ckota']=$corp['kota_id'];
}
?>    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">     
    <!-- Main content -->
    <section class="content"> 
      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom" id="tabs">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#">Penawaran Baru</a></li>
              <li><a href="daftar penawaran.php">Daftar Penawaran</a></li>
              <li><a href="daftar pemesanan.php">Daftar Pemesanan</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane"> <?php //echo print_r($_SESSION['pnw']); ?>
                <form action="pnw baru_2.php" method="post" class="form-horizontal" id="form-pelanggan">
                  <input type="hidden" name="page" value="satu">
                  <input type="hidden" name="id" value="<?php echo @$_SESSION['pnw']['id']; ?>">
                  <i><b>(*) Harus diisi</b></i>
                  <h4>Data Pelanggan</h4>
                  <div class="row">                    
                    <div class="form-group">
                      <label class="col-md-1 control-label">Status*</label>                      
                      <?php if(@$_SESSION['pnw']['stat']==0) $a="checked"; else $b="checked";?>
                      <div class="col-md-5">
                        <label class="radio-inline"><input type="radio" name="stat" value="0" <?php echo @$a; ?>>Baru </label>
                        <label class="radio-inline"><input type="radio" name="stat" value="1" <?php echo @$b; ?>>Lama 
                          (<a href="" data-toggle="modal" data-target="#modalPelanggan"> Cari data pelanggan </a>)</label>
                        <label class="radio-inline"></label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group">
                      <label class="col-md-1 control-label">Nama*</label>
                      <div class="col-md-4">
                        <input class="form-control" required type="text" name="nama" value="<?php echo @$_SESSION['pnw']['nama']; ?>">                        
                      </div>
                      <label class="col-md-1 control-label">Perusahaan</label>                      
                      <div class="col-md-4">
                        <div class="input-group">
                          <input type="hidden" id="cprov" name="cprov" value="<?php echo @$_SESSION['pnw']['cprov']; ?>">
                          <input type="hidden" id="ckota" name="ckota" value="<?php echo @$_SESSION['pnw']['ckota']; ?>">
                          <input type="hidden" id="calamat" name="calamat" value="<?php echo @$_SESSION['pnw']['calamat']; ?>">
                          <select class="form-control select2" style="width:100%" name="corp" id="pcorp" onChange="getCorp()">
                            <option selected value="null">Pilih Perusahaan</option>
                            <?php 
                              $res=selectAll('perusahaan');
                              while($row = mysql_fetch_array($res)) { 
                                if($row[0]==@$_SESSION['pnw']['corp'])
                                  echo "<option value=".$row[0]. " selected>" . $row[1]." | ".$row[5]."-".$row[7]."</option>";
                                else
                                  echo "<option value=".$row[0]. ">" . $row[1]." | ".$row[5]."-".$row[7]."</option>"; 
                              }
                            ?>
                          </select>
                          <span class="input-group-btn">
                            <button type="button" class='btn btn-success' title='tambah perusahaan' data-toggle="modal" data-target="#modalPerusahaan"><i class='fa fa-plus'></i></button>
                          </span>
                        </div>                        
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-1 control-label">Jenis Kelamin*</label>
                      <div class="col-md-11">
                        <?php if(@$_SESSION['pnw']['jk']=='L') $l='checked'; else $p='checked';?>
                          <label class="radio-inline"><input type="radio" name="jk" value="L" <?php echo @$l; ?> >Laki-laki</label> 
                          <label class="radio-inline"><input type="radio" name="jk" value="P"<?php echo @$p; ?> >Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="inputTelepon" class="col-md-1 control-label">Telepon*</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="tlp" placeholder="Telepon" data-inputmask='"mask": "999-999-999-999"' data-mask value="<?php echo @$_SESSION['pnw']['tlp']; ?>" required>
                      </div>
                      <label for="inputTelepon" class="col-md-1 control-label">Email</label>
                      <div class="col-md-4">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo @$_SESSION['pnw']['email']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputProvinsi" class="col-md-1 control-label">Provinsi*</label>
                      <div class="col-md-4">
                        <select class="form-control select2" style="width:100%" id="prov" name="pid" required>
                          <?php 
                                $res=selectAll('provinsi');
                                while($row = mysql_fetch_array($res)) {                                                       
                                  if($row[0]==@$_SESSION['pnw']['pid'])
                                    echo "<option value=".$row[0]. " selected>" . $row[1]."</option>";
                                  else
                                    echo "<option value=".$row[0]. ">" . $row[1]."</option>";
                                }
                              ?>
                        </select>                          
                      </div>
                      <label for="kota" class="col-md-1 control-label">Kota*</label>
                      <div class="col-md-4">
                        <select class="form-control select2" style="width:100%" id="kota" name="kid" required>
                          <?php 
                            $res=selectAll('kota');
                            while($row = mysql_fetch_array($res)) {
                              if($row[0]==@$_SESSION['pnw']['kid'])
                                    echo "<option value=".$row[0]. " class=".$row[1]." selected>" . $row[2]."</option>";
                                  else
                                    echo "<option value=".$row[0]. " class=".$row[1].">" . $row[2]."</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputAlamat" class="col-md-1 control-label">Alamat*</label>
                      <div class="col-md-4">
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required placeholder="Alamat"><?php echo @$_SESSION['pnw']['alamat']; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <h4>Data Pengiriman</h4>
                  <div class="row">
                    <div class="col-md-12">
                      <label class="control-label">Menggunakan Pengiriman ?*   </label>
                        <?php 
                          if(isset($_SESSION['pnw']['kstat']) && @$_SESSION['pnw']['kstat']==0){
                            $kb='checked';
                            $d="disabled";
                            echo "<script language='javascript'>$('#dkirim').hide();</script>";
                          }
                          else{
                            $ka='checked';
                            $d="";
                          }
                        ?>
                        <label class="radio-inline"><input type="radio" name="wkirim" onChange="enable(this)" value="1" <?php echo @$ka; ?>> Ya </label>
                        <label class="radio-inline"><input type="radio" name="wkirim" onChange="enable(this)" value="0" <?php echo @$kb; ?>> Tidak </label>
                    </div>
                  </div>
                  <div class="row" id="dkirim">
                    <div class="col-md-5">
                      <label class="control-label">Alamat Pengiriman*</label>
                      <?php 
                        if (empty($_SESSION['pnw']['corp']) || $_SESSION['pnw']['corp']=='null') 
                          $dcorp='disabled';
                        else
                          $dcorp='';                        
                        $spel='';$scorp='';$slain='selected';  
                        if(isset($_SESSION['pnw']['cek']))                      
                        switch (@$_SESSION['pnw']['cek']) {
                          case 0:$spel='selected';$d='disabled';$slain='';
                            break;
                          case 1:$scorp='selected';$d='disabled';$slain='';
                            break;
                          default:$slain='selected';$d='';
                            break;
                        }
                        ?>
                      <select  class="kirim" name="cek" onChange="setAlamat(this)">
                        <option value="0" <?php echo $spel; ?>>Sesuai alamat pelanggan</option>
                        <option value="1"<?php echo $scorp.' '.$dcorp; ?>>Sesuai alamat perusahaan</option>
                        <option value="2"<?php echo $slain; ?>>Lainnya</option>
                      </select><br><br>
                      <textarea class="form-control kirim" <?php echo @$d; ?> required name="kirimalm" id="kirimalm" rows="3"><?php echo @$_SESSION['pnw']['kalamat']; ?></textarea>
                    </div>
                    <div class="col-md-7">
                      <br><br>
                      <div class="form-group">
                        <label class="col-md-2 control-label">Provinsi* </label>
                        <div class="col-md-6">
                          <select class="form-control select2 kirim" <?php echo @$d; ?> style="width:100%" id="kprovinsi" name="kprovinsi"  required>
                            <?php 
                                  $res=selectAll('provinsi');
                                  while($row = mysql_fetch_array($res)) {                                                       
                                    if($row[0]==@$_SESSION['pnw']['kprov'])
                                      echo "<option value=".$row[0]. " selected>" . $row[1]."</option>";
                                    else
                                      echo "<option value=".$row[0]. ">" . $row[1]."</option>";
                                  }
                                ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-2 control-label">Kota* </label>
                        <div class="col-md-6">
                          <select class="form-control select2 kirim" <?php echo @$d; ?> style="width:100%" id="kkota" name="kkota"  required>
                            <?php 
                              $res=selectAll('kota');
                              while($row = mysql_fetch_array($res)) {
                                if($row[0]==@$_SESSION['pnw']['kkota'])
                                  echo "<option value=".$row[0]. " class=".$row[1]." selected>" . $row[2]."</option>";
                                else
                                  echo "<option value=".$row[0]. " class=".$row[1].">" . $row[2]."</option>";
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>                    
                  </div><!-- row -->
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="pull-right">
                        <button type="submit" class="btn btn-primary" name="lanjut" id="lanjut" value="lanjut">Selanjutnya</button>                        
                        <button type="button" class="btn btn-default" name="batal" id="batal" value="batal">Batal</button>
                      </div>
                    </div>
                  </div>                  
                </form>
                <!-- Modal Perusahaan -->
                <div class="modal fade bs-example-modal-lg" id="modalPerusahaan" tabindex="-1" role="dialog" aria-labelledby="modalPerusahaanLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <form class="form-horizontal" method="POST" action="" id="form-corp">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Perusahaan Baru</h4>
                      </div>
                      <div class="modal-body"> 
                        <input type="hidden" name="page" value="corp">
                        <div class="form-group">
                          <label class="col-md-1 control-label">Nama</label>
                          <div class="col-md-11">
                            <input type="text" class="form-control" name="tperusahaan[]" placeholder="Nama Perusahaan" required>
                          </div>
                        </div>    
                        <div class="form-group">
                          <label for="inputTelepon" class="col-md-1 control-label">Telepon</label>
                          <div class="col-md-11">
                            <input type="text" class="form-control" name="tperusahaan[]" placeholder="Telepon" required data-inputmask='"mask": "999-999-999-999"' data-mask>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-1 control-label">Alamat</label>
                          <div class="col-md-11">
                            <textarea class="form-control" name="tperusahaan[]" placeholder="Alamat" required></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="inputProvinsi" class="col-md-2 control-label">Provinsi</label>
                              <div class="col-md-10">
                                <select class="form-control select2" style="width:100%" id="pprov" name="tperusahaan[]"  required>
                                  <?php 
                                        $res=selectAll('provinsi');
                                        while($row = mysql_fetch_array($res)) {                                                       
                                          echo "<option value=".$row[0]. ">" . $row[1]."</option>";
                                        }
                                      ?>
                                </select>                          
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="kota" class="col-md-1 control-label">Kota</label>
                              <div class="col-md-11">
                                <select class="form-control select2" style="width:100%" id="pkota" name="tperusahaan[]"  required>
                                  <?php 
                                    $res=selectAll('kota');
                                    while($row = mysql_fetch_array($res)) {
                                      echo "<option value=".$row[0]. " class=".$row[1].">" . $row[2]."</option>";
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="tcorp" name="tambah" value="T">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>        
                      </div>
                      </form>
                    </div>
                  </div>
                </div><!-- modal --> 
                <!-- Modal Cari Pelanggan -->
                <div class="modal fade bs-example-modal-lg" id="modalPelanggan" tabindex="-1" role="dialog" aria-labelledby="modalPerusahaanLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Cari Data Pelanggan</h4>
                      </div>
                      <div class="modal-body"> 
                        <table class="table table-bordered table-striped">
                          <thead align='center'>
                            <tr>
                              <th>Nama</th>
                              <th>Alamat</th>
                              <th>Kota</th>
                              <th>Telepon</th>
                              <th>Email</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody align='center'>
                          <?php 
                            $res=selectAll('pelanggan');
                            while($row = mysql_fetch_array($res)) {
                              echo "          
                              <tr><td>".$row[1]."<br>".$row[12]. "</td>
                              <td>".$row[5]. "</td>
                              <td>".$row[8]."<br>".$row[10]. "</td>
                              <td>".$row[3]. "</td>
                              <td>".$row[4]. "</td>
                              <td><form action='session pnw baru.php' method='post' id='form-caripelanggan'>
                              <input type='hidden' name='page' value='caripelanggan'>
                              <input type='hidden' name='id' value=".$row[0].">
                              <button type='submit' class='btn bg-navy pilih' title='pilih' value=".$row[0].">Pilih</button>
                              </form></td></tr>";
                            }                            
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div><!-- modal --> 
              </div><!-- /.tab-pane -->              
            </div><!-- /.tab-content -->
          </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
      </div>  <!-- /.row -->    
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  <?php include('../footer.html'); ?> 
</div>
<!-- ./wrapper --> 

<!-- jQuery 2.1.4 --> 
<script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script> 
<!-- jQuery Chained --> 
<script src="../../plugins/jQuery/jQuery.chained.min.js"></script> 
<!-- Bootstrap 3.3.5 --> 
<script src="../../bootstrap/js/bootstrap.min.js"></script> 
<!-- Select2 --> 
<script src="../../plugins/select2/select2.full.min.js"></script> 
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script> 
<!-- InputMask --> 
<script src="../../plugins/input-mask/jquery.inputmask.js"></script> 
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script> 
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script> 
<!-- SlimScroll 1.3.0 --> 
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script> 
<!-- iCheck 1.0.1 --> 
<script src="../../plugins/iCheck/icheck.min.js"></script> 
<!-- FastClick --> 
<script src="../../plugins/fastclick/fastclick.min.js"></script> 
<!-- AdminLTE App --> 
<script src="../../dist/js/app.min.js"></script> 
<!-- Page script --> 
<script>   
  function getCorp(){
    var id=$("#pcorp").val();
    $.ajax({
      type: 'POST',
      url: "session pnw baru.php",
      data: {page : 'corp', cid : id}
    });
    location.reload();
  }
  $.fn.modal.Constructor.prototype.enforceFocus = function () {};
  $('#lanjut').click(function(){
    $.ajax({
      type: 'POST',
      url: "session pnw baru.php",
      data: $("#form-pelanggan").serialize()
    }); 
   });
  $('.pilih').click(function(){ 
    $.ajax({
      type: 'POST',
      url: "session pnw baru.php",
      data: {page : 'caripelanggan', pelid : $(this).val()}
    }); 
  });
  $('#batal').click(function(){
    $.ajax({
      type: 'POST',
      url: "session pnw baru.php",
      data: {page:"destroy"}
    }); 
    location.reload();
   });
  function enable(x){
    if (x.value=='2') { 
      $('.kirim').removeAttr('disabled');
    }
    else {
      $('.kirim').attr('disabled', 'true');
    }
  }
  function setAlamat(x){
    //sesuai pelanggan
    if(x.value==0){
      $('#kirimalm').val($('#alamat').val());
      $('#kirimalm').attr('disabled',true);
      $('#kprovinsi').val($('#prov').val()).change();
      $('#kprovinsi').attr('disabled',true);
      $('#kkota').val($('#kota').val()).change();
      $('#kkota').attr('disabled',true);
    }
    //sesuai perusahaan
    else if(x.value==1){
      $('#kirimalm').val($('#calamat').val());
      $('#kirimalm').attr('disabled',true);
      $('#kprovinsi').val($('#cprov').val()).change();
      $('#kprovinsi').attr('disabled',true);
      $('#kkota').val($('#ckota').val()).change();
      $('#kkota').attr('disabled',true);
    }
    //lainnya
    else{
      $('#kirimalm').attr('disabled',false);
      $('#kprovinsi').attr('disabled',false);
      $('#kkota').attr('disabled',false);
    }
  }
  $(document).on( "change keydown paste input", "input[name=wkirim]", function() { 
    if($(this).val()==1)
      $("#dkirim").show();
    else
      $("#dkirim").hide();
  });
  $(function () { 
    //Initialize Select2 Elements--select dropdown with search
    $(".select2").select2();
    //chained dropdown  
    $("#kkota").chained("#kprovinsi"); 
    $("#kota").chained("#prov");  
    $("#pkota").chained("#pprov");  
    //Initialize datatable
    $('.table').DataTable({          
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "language": {
        "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json"
      }
    });
    $('.table').DataTable().columns.adjust().draw();
    //Money Euro
    $("[data-mask]").inputmask();

  });
</script>
</body>
</html>
