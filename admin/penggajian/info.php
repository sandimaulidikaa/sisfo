<?php include '../../lib/autoload.php'; ?>
<?php include '../../lib/session_checker.php'; ?>
<?php include '../../theme/partial/header.php'; ?>
<?php include '../../theme/partial/topbar.php'; ?>
<?php include '../../theme/partial/sidebar.php'; ?>

<?php
use Lib\Database\Pegawai;
use Lib\Database\Gaji;
$pegawaiObj = new Pegawai;
$gajiObj = new Gaji;
$pegawai = $pegawaiObj->getByNip($_GET['nip']);
date_default_timezone_set('Asia/Jakarta');
    $tahun=$_GET['tahun'];
    $bulan=$_GET['bulan'];
    $row_pegawai  = mysqli_fetch_array($pegawai);
$data_gaji = $gajiObj->getGajiBulanan($_GET['nip'], $bulan, $tahun);
    $row_gaji  = mysqli_fetch_array($data_gaji);
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><i class="fa fa-street-view"></i> Data Gaji Pegawai</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=BASE_URL?>">Home</a></li>
            <li class="breadcrumb-item active">Data Gaji Pegawai</li>
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
                            <i class="fa fa-money fa-fw"></i> 

                            <div class="float-right">
                                <label class="label" style="font-size: 15px;"> Pegawai : <?php echo $row_pegawai['nama'];?>
                                </label>
                            </div>
                        </div>

                        <!-- INI BAGIAN ISI UTAMA -->
                        <div class="panel-body table-responsive">
                            <!-- INI BAGIAN TABEL -->
                            <div class="">
                                <label>Data Detail Gaji Bulan ||
                             <?php
                                            if ($bulan=="01") {
                                                echo "Januari";
                                             }
                                            elseif ($bulan=="02") {
                                                echo "Februari";
                                             }
                                            elseif ($bulan=="03") {
                                                echo "Maret";
                                             }
                                            elseif ($bulan=="04") {
                                                echo "April";
                                             }
                                            elseif ($bulan=="05") {
                                                echo "Mei";
                                             }
                                            elseif ($bulan=="06") {
                                                echo "Juni";
                                             }
                                            elseif ($bulan=="07") {
                                                echo "Juli";
                                             }
                                            elseif ($bulan=="08") {
                                                echo "Agustus";
                                             }
                                            elseif ($bulan=="09") {
                                                echo "September";
                                             }
                                            elseif ($bulan=="10") {
                                                echo "Oktober";
                                             }
                                            elseif ($bulan=="11") {
                                                echo "November";
                                             }
                                            elseif ($bulan=="12") {
                                                echo "Desember";
                                             }
                                echo " / ".$tahun;?> || </label><br>
                                <label class="label" style="font-size: 15px;color: black;">NIP: <?php echo $row_pegawai['nip'];?> / <?php echo $row_pegawai['nama'];?>
                                </label>
                                <div class="float-right">
                                <form action="slip_gaji.php" method="post" target="_blank">
                                    <input type="hidden" name="nip" value="<?php echo $row_pegawai['nip'];?>"></input>
                                    <input type="hidden" name="bulan" value="<?php echo $bulan;?>"></input>
                                    <input type="hidden" name="tahun" value="<?php echo $tahun;?>"></input>
                                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Cetak"><i class="fa fa-print"></i></button>
                                </form>
                                </div>
                                <div class="float-right" style="padding-right: 20px;">
                                    <a href="<?=BASE_URL?>/admin/penggajian/edit.php?&id=<?php echo $row_gaji['id'];?>"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit fa-fw fa-fw"></i>Edit</a>
                                </div>
                            </div>
                <input name="nip" type="hidden" value="<?php echo $row_pegawai['nip'];?>"></input>
                <input name="tgl" type="hidden" value="<?php echo $tahun.'-'.$bulan.'-'.'01';?>"></input>
                <input name="bulan" type="hidden" value="<?php echo $bulan;?>"></input>
                <input name="tahun" type="hidden" value="<?php echo $tahun;?>"></input>
                    <table width="100%">
                        <hr>
                            <tr style="height: 30px;">
                                <td colspan="4" align="center" class="bg-success">
                                    <label>Tunjangan</label>
                                </td>
                                <td colspan="4" class="bg-warning" align="center">
                                    <label>Potongan</label>
                                </td>
                            </tr>
                            <tr style="height: 30px;">
                                
                            </tr>
                            <!--baris 1-->
                            <tr>
                                <td width="17%">
                                    <div class="form-group">
                                    Gaji Pokok
                                    </div>
                                </td>
                                <td width="3%" >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td width="30%" align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['gaji_pokok'],0,"",".");?>
                                    </div>
                                </td>
                                <td width="1%" ></td>
                                <td width="22%">
                                    <div class="form-group">
                                    Potongan Pajak
                                    </div>
                                </td>
                                <td width="3%" >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td width="23%" align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['pot_pajak'],0,"",".");?>
                                    </div>
                                </td>
                            </tr>
                            <!--baris 2-->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunj Istri / Suami
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                       <?php echo number_format($row_gaji['tunj_istri'],0,"",".");?>
                                    </div>
                                </td>
                                <td ></td>
                                <td>
                                    <div class="form-group">
                                    Pot BPJS Kes 
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['pot_bpjs'],0,"",".");?>
                                    </div>
                                </td>
                            </tr>
                            <!-- baris 3 -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunjangan Anak
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['tunj_anak'],0,"",".");?>
                                    </div>
                                </td>
                                <td ></td>
                                <td>
                                    <div class="form-group">
                                    Pot IWP 21
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['pot_iwp_21'],0,"",".");?>
                                    </div>
                                </td>
                            </tr>
                            <!-- baris 4 -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunjangan Hselon
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['tunj_hselon'],0,"",".");?>
                                    </div>
                                </td>
                                <td ></td>
                                <td>
                                    <div class="form-group">
                                    Pot IWP 81
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['pot_iwp_01'],0,"",".");?>
                                    </div>
                                </td>
                            </tr>
                            <!-- baris 5 -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunj Fung Umum
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['tunj_fung_umum'],0,"",".");?>
                                    </div>
                                </td>
                                <td ></td>
                                <td>
                                    <div class="form-group">
                                    Pot Tapebum
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['pot_tapebum'],0,"",".");?>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- baris 6  -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunj Fungsional
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['tunj_fungsional'],0,"",".");?>
                                    </div>
                                </td>
                                <td ></td>
                                <td>
                                    <div class="form-group">
                                    Potongan JKK
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['pot_jkk'],0,"",".");?>
                                    </div>
                                </td>
                            </tr>
                            <!-- baris 6  -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunjangan Khusus
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['tunj_khusus'],0,"",".");?>
                                    </div>
                                </td>
                                <td ></td>
                                <td>
                                    <div class="form-group">
                                     Potongan JKM
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['pot_jkm'],0,"",".");?>
                                    </div>
                                </td>
                            </tr>
                             <!-- baris 7  -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunjangan Terpencil
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['tunj_terpencil'],0,"",".");?>
                                    </div>
                                </td>
                                <td ></td>
                                <td>
                                    <div class="form-group">
                                    Hutang /Lain"
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['hutang'],0,"",".");?>
                                    </div>
                                </td>
                            </tr>
                             <!-- baris 8  -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    TKD
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['tkd'],0,"",".");?>
                                    </div>
                                </td>
                                <td ></td>
                                <td>
                                    <div class="form-group">
                                    BULOG
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['bulog'],0,"",".");?>
                                    </div>
                                </td>
                            </tr>
                            <!-- baris 9  -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunjangan Beras
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['tunj_beras'],0,"",".");?>
                                    </div>
                                </td>
                                <td ></td>
                                <td>
                                    <div class="form-group">
                                    Sewa Rumah
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group input-group">
                                        <?php echo number_format($row_gaji['sewa_rumah'],0,"",".");?>
                                    </div>
                                </td>
                            </tr>
                            <!-- baris 10  -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunjangan Pajak
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['tunj_pajak'],0,"",".");?>
                                    </div>
                                </td>
                                <td ></td>
                                <td>
                                    <div class="form-group">
                                    <b>POTONGAN</b>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <b>
                                        <?php echo number_format($row_gaji['pot_pajak']+$row_gaji['pot_bpjs']+$row_gaji['pot_iwp_21']+$row_gaji['pot_iwp_01']+$row_gaji['pot_tapebum']+$row_gaji['pot_jkk']+$row_gaji['pot_jkm']+$row_gaji['hutang']+$row_gaji['bulog']+$row_gaji['sewa_rumah'],0,"",".");?>
                                    </b>
                                    </div>
                                </td>
                            </tr>
                            <!-- baris 11 -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunjangan BPJS
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['tunj_bpjs'],0,"",".");?>
                                    </div>
                                </td>
                                <td class="4" ></td>
                            </tr>
                            <!-- baris 12 -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunjangan JKK
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['tunj_jkk'],0,"",".");?>
                                    </div>
                                </td>
                                <td class="4" ></td>
                            </tr>
                            <!-- baris 11 -->
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Tunjangan JKM
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['tunj_jkm'],0,"",".");?>
                                    </div>
                                </td>
                                <td class="4" ></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                    Pembulatan
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <?php echo number_format($row_gaji['pembulatan'],0,"",".");?>
                                    </div>
                                </td>
                                <td class="4" ></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                    <b>JUMLAH KOTOR</b>
                                    </div>
                                </td>
                                <td >
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <b>
                                    <?php echo number_format($row_gaji['gaji_pokok']+$row_gaji['tunj_anak']+$row_gaji['tunj_istri']+$row_gaji['tunj_hselon']+$row_gaji['tunj_fung_umum']+$row_gaji['tunj_fungsional']+$row_gaji['tunj_khusus']+$row_gaji['tunj_terpencil']+$row_gaji['tkd']+$row_gaji['tunj_beras']+$row_gaji['tunj_pajak']+$row_gaji['tunj_bpjs']+$row_gaji['tunj_jkk']+$row_gaji['tunj_jkm']+$row_gaji['pembulatan'],0,"",".");?>
                                    </b>
                                    </div>
                                </td>
                                <td class="4" ></td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <hr>
                                </td>
                            </tr>
                            <tr><td colspan="4"></td>
                                <td>
                                    <div class="form-group">
                                    <b>JUMLAH BERSIH</b>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    :
                                    </div>
                                </td>
                                <td align="right" style="padding-right:10%;">
                                    <div class="form-group">
                                    <b>
                                    <?php echo number_format($row_gaji['gaji_bersih'],0,"",".");?>
                                    </b>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <hr>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
                  <!-- /.container-fluid -->
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
  $('#table').DataTable();

</script>

<?php if (!empty($_SESSION['insertSuccess'])) { unset($_SESSION['insertSuccess'])?>
  <script>
    Swal.fire('Berhasil', 'Data Gaji telah ditambahkan', 'success');
  </script>
<?php }?>