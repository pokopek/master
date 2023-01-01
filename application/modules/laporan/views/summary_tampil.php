
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url('dashboard');?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="">Laporan</a></li>
                </ul>
                <h4>Waktu Makan </h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Laporan Jenis</h4>
            <p>Laporan Berdasarkan .</p>

            
        </div><!-- panel-heading -->

        <div class="panel-body">


          <table class="table table-bordered">
            <tr>
              <th width="5%">#</th>
              <th width="10%">Hari</th>
              <th width="45%">Tanggal</th>
              <th width="10%">Breakfast</th>
              <th width="10%">Lunc</th>
              <th width="10%">Dinner</th>
              <th width="10%">Jumlah</th>
            </tr>

          <?php

            $subBreak = 0;
            $subLunch = 0;
            $subDinner = 0;
            $subTot = 0;

            $tahun = $this->input->post('tahun');
            $bulan = $this->input->post('bulan');
            $jumHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            // $jumHari = 7;
            for ($i=1; $i <= $jumHari; $i++) { 

              $tgl = sprintf("%02d", $i);
              $tanggal    = $tahun.'-'.$bulan.'-'.$tgl;
              $namaHari = namaHari($tanggal);

              //Breakfast
              $pagi = $this->db->query("SELECT COUNT(badge_number) as jum FROM absen WHERE jenis_absen='Breakfast' AND jam_absen like '$tanggal%'")->row_array();

              //LUNCH
              $siang = $this->db->query("SELECT COUNT(badge_number) as jum FROM absen WHERE jenis_absen='Lunch' AND jam_absen like '$tanggal%'")->row_array();

              //Dinner
              $malam = $this->db->query("SELECT COUNT(badge_number) as jum FROM absen WHERE jenis_absen='Dinner' AND jam_absen like '$tanggal%'")->row_array();

              echo '<td>'.$i.'</td>
              <td>'.$namaHari.'</td>
              <td>'.tgl_indo($tanggal).'</td>
              <td align="center">'.$pagi['jum'].'</td>
              <td align="center">'.$siang['jum'].'</td>
              <td align="center">'.$malam['jum'].'</td>
              <td align="center">'.($pagi['jum'] + $siang['jum'] + $malam['jum']).'</td>
            </tr>';

              $subBreak = $subBreak + $pagi['jum'];
              $subLunch = $subLunch + $siang['jum'];
              $subDinner = $subDinner + $malam['jum'];


            }
            ?>

            <tr>
              <td width="60%" colspan="3" align="right"><b>Total</b></th>
              <td align="center" width="10%"><b><?=$subBreak;?></b></th>
              <td align="center" width="10%"><b><?=$subLunch;?></b></th>
              <td align="center" width="10%"><b><?=$subDinner;?></b></th>
              <td align="center" width="10%"><b></b></th>
            </tr>
          </table>
     

    </div>

    </div><!-- contentpanel -->
   
</div>





<?php  $this->load->view('template/footer'); ?>
