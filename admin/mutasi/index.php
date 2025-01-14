<?php include '../../lib/autoload.php'; ?>
<?php include '../../lib/session_checker.php'; ?>
<?php include '../../theme/partial/header.php'; ?>
<?php include '../../theme/partial/topbar.php'; ?>
<?php include '../../theme/partial/sidebar.php'; ?>
<?php 
use Lib\Database\Pegawai;
use Lib\Database\Mutasi;
use Lib\Database\Master;
$pegawaiObj = new Pegawai;
$mutasiObj = new Mutasi;
$masterData = new Master;
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><i class="fa fa-users"></i> Data Pengguna</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=BASE_URL?>">Home</a></li>
            <li class="breadcrumb-item active">Data Pengguna</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
                 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- INI BAGIAN ISI UNTUK JUDUL TABEL -->
                        <div class="panel-heading bg-aqua">
                            <i class="fa fa-line-chart fa-fw"></i> Data Mutasi Pegawai
                        </div>

                        <!-- INI BAGIAN ISI UTAMA -->
                        <div class="panel-body table-responsive">
                            <!-- INI BAGIAN TABEL -->
                           
                             <table width="100%" id="tabel" class="table table-striped table-bordered table-hover" style="font-size:16px;">
                                <thead>
                                    <tr class="odd bg-gray">
                                        <th rowspan="2" width="1%" valign="top">No</th>
                                        <th rowspan="2"><center>Nip</center></th>
                                        <th rowspan="2"><center>Nama Pegawai</center></th>
                                        <th rowspan="2"><center>Jabatan</center></th>
                                        <th rowspan="2">
                                            <center>Pangkat/Golongan
                                                    <br>TMT
                                            </center></th>
                                        <th colspan="4"><center>Perkembangan Mutasi</center></th>
                                        <th rowspan="2"><center>Aksi</center></th>
                                    </tr>
                                    <tr class="odd bg-gray">
                                        <th>
                                            <center>Kenaikan Pangkat
                                                    <br> TMT
                                            </center>
                                        </th>
                                        <th>
                                            <center>Kenaikan Gaji Berkala
                                                    <br> TMT
                                            </center>
                                        </th>
                                        <th>
                                            <center>Pensuinan
                                                    <br> TMT
                                            </center>
                                        </th>
                                        <th>
                                            <center>Penyesuaian Ijasah
                                                    <br> TMT
                                            </center>
                                        </th>
                                    </tr>
                                </thead>
                                <!-- INI UNTUK MENERIMA DATA DARI CONTROLLER -->
                                <tbody>
                                <?php
                                    // SET NOMOR URUT DATA
                                    $nomor          =   1;
                                    
                                    // CEK DATA YANG DITERIMA
                                    $data_pegawai = $pegawaiObj->getPegawai();
                                    if(isset($data_pegawai)) {
                                        while($row_pegawai  = mysqli_fetch_array($data_pegawai)) {
                                ?>
                                
                                    <tr class="odd gradeX">
                                        <td><?php echo $nomor; ?></td>
                                        <td><?php echo $row_pegawai['nip']; ?></td>
                                        <td><?php echo $row_pegawai['nama']; ?></td>
                                        <td><?php echo $row_pegawai['jabatan']; ?></td>
                                        <td align="center"><?php echo $row_pegawai['pangkat']; ?>
                                            <br><?php echo TanggalIndo($row_pegawai['tmt_golongan']); ?>
                                        </td>
                                        <?php 
                                        $q_mutasi = $mutasiObj->getByNip($row_pegawai['nip']);
                                        $mutasi= mysqli_fetch_array($q_mutasi);
                                        ?>
                                        <!-- pangkat -->
                                        <td align="center">
                                        <?php

                                        if(date('Y-m-d')>$mutasi['tmt_kenaikan']){
                                            echo "<label class='label label-danger'>Tidak Ada Kenaikan Pangkat</label>";
                                        }else{
                                                if ($mutasi['kenaikan_pangkat']=="") {
                                                    echo "<label class='label label-danger'>Tidak Ada Kenaikan Pangkat</label>";
                                                 }else{ echo $mutasi['kenaikan_pangkat'];
                                             }
                                                 ?>
                                            <br>
                                                <?php
                                                if ($mutasi['tmt_kenaikan']=="" OR $mutasi['tmt_kenaikan']=="0000-00-00") {
                                                 }else{ 
                                                  echo TanggalIndo($mutasi['tmt_kenaikan']);
                                              }
                                        }
                                        ?>

                                        </td>
                                        <!-- gaji -->
                                        <td align="center">
                                        <?php

                                        if(date('Y-m-d')>$mutasi['tmt_gaji']){
                                            echo "<label class='label label-danger'>Tidak Ada Kenaikan Gaji</label>";
                                        }else{
                                                if ($mutasi['kenaikan_gaji']=="0" OR $mutasi['kenaikan_gaji']=="") {
                                                    echo "<label class='label label-danger'>Tidak Ada Kenaikan Gaji</label>";
                                                 }else{ 
                                                  echo "<a style='color:black;' class='pull-left'>Rp. </a> <a class='pull-right' style='color:black;'>". number_format($mutasi['kenaikan_gaji'],0,".",".") ."</a>";
                                              }
                                                 ?>
                                            <br>
                                                <?php
                                                if ($mutasi['tmt_gaji']=="" OR $mutasi['tmt_gaji']=="0000-00-00") {
                                                 }else{ 
                                                  echo TanggalIndo($mutasi['tmt_gaji']);
                                              }
                                          }
                                        ?>
                                        </td>
                                        <!-- pensiunan -->
                                        <td align="center">
                                            <?php

                                          $tgl_cek = date('Y-m-d');

                                            $birthDt= new DateTime($row_pegawai['tgl_lahir']);
                                            //tanggal hari ini
                                              $today = new DateTime($tgl_cek);
                                              //tahun
                                              $y = $today->diff($birthDt)->y;
                                              //bulan
                                              $m = $today->diff($birthDt)->m;
                                              //hari
                                              $d = $today->diff($birthDt)->d;
                                              //echo "Umur: " . $y . " tahun " . $m . " bulan " . $d . " hari";

                                                if ($mutasi['pensiun']=="") {
                                                    echo "<label class='label label-danger'>Tidak Ada Data</label>";
                                                 }else{ 
                                                  echo "( ".$y." ) / ". $mutasi['pensiun']." Tahun";
                                              }
                                                 ?>
                                            <br>
                                                <?php
                                                if ($mutasi['tmt_pensiun']=="" OR $mutasi['tmt_pensiun']=="0000-00-00") {
                                                 }else{ 
                                                  echo TanggalIndo($mutasi['tmt_pensiun']); 
                                              }
                                                 ?>
                                        </td>
                                        <!-- ijasah -->
                                        <td>
                                            <?php
                                                if ($mutasi['ijasah']=="") {
                                                    echo "<label class='label label-danger'>Tidak Ada Penyesuaian</label>";
                                                 }else{ 
                                                  echo $mutasi['ijasah'];
                                              }
                                                 ?>
                                            <br>
                                                <?php
                                                if ($mutasi['tmt_ijasah']=="" OR $mutasi['tmt_pensiun']=="0000-00-00") {
                                                 }else{ 
                                                  echo TanggalIndo($mutasi['tmt_ijasah']);
                                              }
                                                 ?>
                                        </td>

                                        <td>
                                        <center>
                                         <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-pangkat<?php echo $row_pegawai['nip'];?>"><li class="fa fa-info"></li> Detail</button>

                                         <!--Modal Untuk Tambah Data -->
<div class="modal modal-primary fade" id="modal-pangkat<?php echo $row_pegawai['nip'];?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
               <h4 class="modal-title">Mutasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <form role="form" method="POST" action="<?=BASE_URL?>/admin/mutasi/update.php" enctype="multipart/form-data" onsubmit="return validasi();">
                  <table width="100%" id="tabel" class="table table-striped table-bordered table-hover">
                  <input type="hidden" name="nip" value="<?php echo $row_pegawai['nip'];?>"></input>
                  <?php 
                    $x_mutasi = $mutasiObj->getByNip($row_pegawai['nip']);
                    $mutasi_x= mysqli_fetch_array($x_mutasi);
                  ?>
                                <thead>
                                    <tr>
                                        <td align="center" colspan="4">
                                            <label>Pangkat / Golongan : <?php echo $row_pegawai['pangkat'];?> 
                                                </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                             <label>Nama Pegawai : <?php echo $row_pegawai['nama'];?> </label>
                                        </td>
                                        <td colspan="2" align="center">
                                            <label>NIP : <?php echo $row_pegawai['nip'];?> 
                                                </label>
                                        </td>
                                    </tr>

                                    <tr class="odd bg-gray">
                                        
                                        <th colspan="4"><center>Perkembangan Mutasi</center></th>
                                    </tr>
                                    <tr class="odd bg-gray">
                                        <th width="25%">
                                            <center>Kenaikan Pangkat
                                                    <br> TMT
                                            </center>
                                        </th>
                                        <th width="25%">
                                            <center>Kenaikan Gaji Berkala
                                                    <br> TMT
                                            </center>
                                        </th>
                                        <th width="20%">
                                            <center>Pensuinan
                                                    <br> TMT
                                            </center>
                                        </th>
                                        <th width="25%">
                                            <center>Penyesuaian Ijasah
                                                    <br> TMT
                                            </center>
                                        </th>
                                    </tr>
                                </thead>
                                <!-- INI UNTUK MENERIMA DATA DARI CONTROLLER -->
                                <tbody>
                                    <tr class="odd gradeX">
                                        <!-- data mutasi -->
                                        
                                        <td align="center">
                                        <?php
                                        if ($mutasi_x['kenaikan_pangkat']=="") {
                                        ?>
                                        <select name="pangkat" style="width: 100%" id="pangkat" class="form-control select2">
                                                <option value=" ">- Pilih Pangkat / Golongan -</option>
                                                <?php 
                                                      $pangkat = $masterData->getPangkat();
                                                        while($row_pangkat = mysqli_fetch_array($pangkat)) {     
                                                        // MENAMPILKAN OPSI Kategori
                                                        echo "<option value='$row_pangkat[nama]'>$row_pangkat[nama]</option>"; 
                                                      }
                                                    ?>
                                            </select>
                                        <?php }
                                        else
                                        {   
                                        ?>
                                           <select name="pangkat" style="width: 100%" id="pangkat" class="form-control select2">
                                                <?php
                                                      $pangkat = $masterData->getPangkat();
                                                        while($row_pangkat = mysqli_fetch_array($pangkat)) {     
                                                        // MENAMPILKAN OPSI Kategori

                                                        if ($mutasi_x['kenaikan_pangkat']=="$row_pangkat[nama]") {

                                                            
                                                              echo "<option value='".$row_pangkat['nama']."' selected >".$row_pangkat['nama']."</option>";
                                                            }
                                                            else 
                                                            {
                                                              echo "<option value='".$row_pangkat['nama']."'>".$row_pangkat['nama']."</option>";
                                                            }
                                                        
                                                      }
                                                    ?>
                                            </select> 
                                       <?php 
                                        }
                                        ?>
                                        <br><br>
                                        <table width="100%">
                                    <td width="50%">

                                    <?php
                                   $cek_bulan= date('m',strtotime($mutasi_x['tmt_kenaikan']));
                                    ?>
                                      <select name="bulan" style="color: black;width: 100%" class="form-control select2">
                                      <?php
                                      if($cek_bulan=="04")
                                        {
                                          echo "<option value='04' selected >April</option>";
                                        }
                                        else 
                                        {
                                          echo "<option value='04'>April</option>";
                                        }
                                        if($cek_bulan=="10")
                                        {
                                          echo "<option value='10' selected >Oktober</option>";
                                        }
                                        else 
                                        {
                                          echo "<option value='10'>Oktober</option>";
                                        }
                                        ?>
                                      </select>
                                    </td>
                                    <td width="50%"  style="padding-left: 5px;">
                                      <select name="tahun" style="color: black;width: 100%" class="form-control select2">
                                        <option value="">Tahun</option>
                                        <?php
                                        $cek_tahun = date('Y',strtotime($mutasi_x['tmt_kenaikan']));

                                         for($tahun=date('Y')+5; $tahun>=2000; $tahun--)
                                        {
                                        if($cek_tahun=="$tahun")
                                        {
                                          echo "<option value='$tahun' selected >".$tahun."</option>";
                                        }
                                        else 
                                        {
                                          echo "<option value='$tahun'>".$tahun."</option>";
                                        }
                                     } ?>
                                      </select>
                                    </td>
                                    </table>
                                        </td>

                                        <!-- gaji -->
                                        <td>
                                            <input name="gaji" value="<?php echo number_format($mutasi_x['kenaikan_gaji'],0,".",".");?>" id="kenaikan_gaji" style="width: 100%" class="form-control"></input>

                                        <br>
                                            <div class="form-group input-group date" id="ex2" data-date="" data-date-format="yyyy-mm-dd">
                                            <?php 
                                            if($mutasi_x['tmt_gaji']=="0000-00-00" OR $mutasi_x['tmt_gaji']==""){
                                            ?>
                                                <input name="tmt_gaji"  class="form-control datepicker" autocomplete="off" style="z-index: 1050 !important" placeholder="Masukkan Tanggal">
                                            <?php } else {
                                            ?>  
                                                <input name="tmt_gaji"  class="form-control datepicker" autocomplete="off" style="z-index: 1050 !important" placeholder="Masukkan Tanggal" value="<?php echo $mutasi_x['tmt_gaji']; ?>">
                                            <?php } ?>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            
                                            </div>
                                        </td>
                                        <!-- pensiunan -->
                                        <td>
                                            <input type="number" min="0" name="pensiun" class="form-control" style="width: 100%" value="<?php echo $mutasi_x['pensiun'];?>" ></input>
                                            <br>
                                            <div class="form-group input-group date" id="ex2" data-date="" data-date-format="yyyy-mm-dd">
                                            <?php 
                                            if($mutasi_x['tmt_pensiun']=="0000-00-00" OR $mutasi_x['tmt_pensiun']==""){
                                            ?>
                                                <input name="tmt_pensiun"  class="form-control datepicker" autocomplete="off" style="z-index: 1050 !important" placeholder="Masukkan Tanggal">
                                            <?php } else {
                                            ?>  
                                                <input name="tmt_pensiun"  class="form-control datepicker" autocomplete="off" style="z-index: 1050 !important" placeholder="Masukkan Tanggal" value="<?php echo $mutasi_x['tmt_pensiun']; ?>">
                                            <?php } ?>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            
                                            </div>
                                        </td>
                                        <!-- ijasah -->
                                        <td>
                                            <?php
                                        if ($mutasi_x['ijasah']=="") {
                                        ?>
                                        <select name="ijasah" style="width: 100%" id="pangkat" class="form-control select2">
                                                <option value=" ">- Pilih Golongan -</option>
                                                <?php
                                                    $query_golongan = "select * from golongan"; 
                                                      $golongan = $masterData->getGolonganIjazah();
                                                        while($row_golongan = mysqli_fetch_array($golongan)) {     
                                                        // MENAMPILKAN OPSI Kategori
                                                        echo "<option value='$row_golongan[golongan]'>$row_golongan[golongan] / $row_golongan[keterangan] </option>"; 
                                                      }
                                                    ?>
                                            </select>
                                        <?php }
                                        else
                                        {   
                                        ?>
                                           <select name="ijasah" style="width: 100%" id="pangkat" class="form-control select2">
                                                <?php
                                                      $golongan = $masterData->getGolonganIjazah();

                                                        while($row_golongan = mysqli_fetch_array($golongan)) {         
                                                        // MENAMPILKAN OPSI Kategori
                                                        if ($mutasi_x['ijasah']=="$row_golongan[golongan]") {

                                                            
                                                              echo "<option value='".$row_golongan['golongan']."' selected >".$row_golongan['golongan']." / ".$row_golongan['keterangan']."</option>";
                                                            }
                                                            else 
                                                            {
                                                              echo "<option value='".$row_golongan['golongan']."'>".$row_golongan['golongan']." / ".$row_golongan['keterangan']."</option>";
                                                            }
                                                        
                                                      }
                                                    ?>
                                            </select> 
                                       <?php 
                                        }
                                        ?>
                                        <br>
                                        <div class="form-group input-group date" id="ex2" data-date="" data-date-format="yyyy-mm-dd">
                                        <?php 
                                            if($mutasi_x['tmt_ijasah']=="0000-00-00" OR $mutasi_x['tmt_ijasah']==""){
                                            ?>
                                                <input name="tmt_ijasah"  class="form-control datepicker" autocomplete="off" style="z-index: 1050 !important" placeholder="Masukkan Tanggal" >
                                            <?php } else {
                                            ?>
                                                <input name="tmt_ijasah"  class="form-control datepicker" autocomplete="off" style="z-index: 1050 !important" placeholder="Masukkan Tanggal" value="<?php echo $mutasi_x['tmt_ijasah']; ?>">
                                            <?php } ?>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <input id="button" type="submit" name="submit" class="btn btn-outline btn-xl"  value="Simpan" data-toggle="tooltip" data-placement="top" title="Simpan">
              </div>
          </form>
                       
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

                                        </center>
 
                                        </td>
                                    </tr>
                                
                                <?php
                                        // INCREMENT NOMOR URUT
                                        $nomor++;

                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include '../../theme/partial/footer.php'; ?>
  <!-- DataTables  & Plugins -->
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/jszip/jszip.min.js"></script>
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?=BASE_URL?>/theme/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
    // $('#table').DataTable();
  </script>
<?php if (!empty($_SESSION['updateSuccess'])) { unset($_SESSION['updateSuccess'])?>
  <script>
    Swal.fire('Berhasil', 'Data Mutasi telah dirubah', 'success');
  </script>
<?php }?>

  <script language='javascript'>
  function validasi()
  {
    if (document.kategori.bulan.selectedIndex==0)
    {
      alert("Pilih Bulan Kelahiran");
      document.kategori.bulan.focus();
      return false;
    }
    if (document.kategori.tahun.selectedIndex==0)
    {
      alert("Pilih Tahun Kelahiran");
      document.kategori.tahun.focus();
      return false;
    }
    if (document.kategori.pangkat.selectedIndex==0)
    {
      alert("Pilih Pangkat / Golongan");
      document.kategori.pangkat.focus();
      return false;
    }
    return true
  }
</script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "1950:2070"
    });
  } );

  </script>