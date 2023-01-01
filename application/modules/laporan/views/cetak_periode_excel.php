<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan.xls");
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  
<style type="text/css">
  .bege{
    background: #bfc7c1;
  }
  .besar{
    font-size: 24px;
  }
</style>
</head>
<body>
  <table>
<!--   <tr>
    <td align="left" colspan="2"><img src="<?=base_url('assets/logo1.jpg');?>" width="10px"></td>
    <td align="center" colspan="2"></td>
    <td align="right" colspan="2"><img src="<?=base_url('assets/logo2.jpg');?>" width="10px"></td>
  </tr> -->
  <tr>
    <td align="center" colspan="6" class="besar">Data Absen <?=$jenis;?>
  </tr>
  <tr>
    <td></td>
    <td>Site</td>
    <td>: Indexim - Kaliorang / Pengadan</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>Tanggal</td>
    <td>: <?=tgl_indo($tanggal);?></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>

<table border="1">
  <tr>
    <td width="50px" align="center" class="bege">NO</td>
    <td width="100px" align="center" class="bege">KODE</td>
    <td width="300px" align="center" class="bege">NAMA KARYAWAN</td>
    <td width="100px" align="center" class="bege">DEPARTMENT</td>
    <td width="100px" align="center" class="bege">SECTION</td>
    <td width="100px" align="center" class="bege">WAKTU</td>
  </tr>
<?php
$no =1;
foreach ($dataPeriode as $daper) {

  echo '<tr>
          <td>'.$no++.'</td>
          <td>'.$daper->badge_number.'</td>
          <td>'.$daper->nama.'</td>
          <td>'.$daper->department.'</td>
          <td>'.$daper->section.'</td>
          <td>'.substr($daper->jam_absen, 11,8).'</td>
        </tr>';

}

?>


</table>


<table>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  <tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>
      
      <table border="1">
        <tr>
          <td align="center" class="bege">DEPARTMENT</td>
          <td align="center" class="bege">TOTAL</td>
        </tr>

        <?php
        $gtot = 0;
        $query = "SELECT DISTINCT(department) as bagian FROM pegawai";
        $department = $this->db->query($query)->result();
        foreach ($department as $dpm) {
          $query2 = "SELECT COUNT(department) as jum FROM absen 
          LEFT JOIN pegawai ON absen.badge_number = pegawai.badge_number
          WHERE absen.jam_absen like '%$tanggal%' AND absen.jenis_absen = '$jenis' AND pegawai.department = '$dpm->bagian'";
          $dipart = $this->db->query($query2)->row_array();

          echo '<tr>
                  <td>'.$dpm->bagian.'</td>
                  <td align="center">'.$dipart['jum'].'</td>
                </tr>';

          $gtot = $gtot + $dipart['jum'];
        }

        
        ?>
        <tr>
          <td align="center" class="bege">TOTAL</td>       
          <td align="center" class="bege"><?=$gtot;?></td>
        </tr>
      </table>
    </td>
    <td></td>
    <td>
      <table border="0">
        <tr>
          <td colspan="3">Kaliorang, 01 November 2020</td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>Prepared By,</td>
        </tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
        <tr><td>PT. Abadi Raya Commerce</td></tr>

        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
        <tr><td>PT. Indexim Coalindo</td></tr>
        
      </table>
    </td>
  </tr>


         
</table>


</body>
</html>