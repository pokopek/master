<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manual extends CI_Controller {

   var $data_ref = array('uri_controllers' => 'manual');

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Manual_model','manual');
	}

	public function index()
	{

     	$this->load->view('template/header-kosong');
		$this->load->view('manual');

	}


	public function tampil()
	{
		$jenis = pengaturan()['status'];

     	echo '<div class="row">';
     	$no = 0;
     	$hariini = tgl_now();
     	$dataAbsen = $this->db->query("SELECT * FROM absen a 
     		LEFT JOIN pegawai p ON a.badge_number = p.badge_number 
     		WHERE a.jenis_absen='$jenis' AND jam_absen like '$hariini%'
     		ORDER BY a.id_trans DESC LIMIT 0,12")->result();
     	foreach ($dataAbsen as $absn) {

            // echo '<div class="col-md-6">
            //   <div class="media">
            //       <a class="pull-left" href="#">
            //           <img class="media-object img-circle" src="'.base_url('foto/download.png').'" alt="" />
            //       </a>
            //       <div class="media-body">
            //           <h3 class="follower-name">'.$absn->nama.'</h3>
            //           <div><i class="fa fa-map-marker"></i> '.$absn->badge_number.'</div>
            //           <div><i class="fa fa-briefcase"></i> '.$absn->jenis_absen.'</div>
            //           <div>  '.$absn->jam_absen.'</div>
            //       </div>
            //   </div>
            // </div>';
            // $no++;
            // if($no % 2 == 0){
            // 	echo '.<hr>';

            echo "
<div class='col-md-2'>
    <div class='text-center card-box'>
        <div class='clearfix'></div>
        <div class='member-card' style='height: 180px;'>
            <div align=center>
            <img class='media-object img-circle' src='".base_url('foto/download.png')."' alt='' />
            ";

echo "
             </div>
             <div class='clearfix'></div>
            <div class=''>
                <b class='m-b-5'>$absn->nama</b><br>
				$absn->badge_number<br>
				<a href='#' class='btn btn-success btn-rounded btn-xs waves-effect waves-light m-r-5 m-b-10'><i class='fa fa-clock-o'></i> ".substr($absn->jam_absen, 11, 8)."</a>
                
            </div>

        </div>

    </div>

</div>";

            // }
        }

          echo '</div>';

	}





	public function get($badge){

		$jenisMakan = pengaturan()['status'];

		$badge = str_replace('%20', ' ', $badge);

		$query = "SELECT * FROM pegawai WHERE badge_number ='$badge' OR nama = '$badge'";
		$cek 		 = $this->db->query($query)->num_rows();
		$dataPegawai = $this->db->query($query)->row_array();

		$sekarang = tgl_now();
		if($cek){

			//cek barcode berupa ID atau NAMA
			//cek ID 
			$kolom = '';
			$cekID = $this->db->query("SELECT * FROM pegawai WHERE badge_number ='$badge'")->num_rows();
			if($cekID){
				$kolom = 'badge_number';
			}

			$cekNama = $this->db->query("SELECT * FROM pegawai WHERE nama = '$badge'")->num_rows();
			if($cekNama){
				$kolom = 'badge_number';
			}


			//Cek apakah sudah absen hari ini untuk jenis yang makan dimaksud
			$cekMakan = $this->db->query("SELECT * FROM absen 
				WHERE (badge_number ='$badge' OR nama = '$badge') AND jenis_absen='$jenisMakan' AND jam_absen like '$sekarang%'")->num_rows();

			if($cekMakan){
				//Jika sudah ambil makan tidak usah disimpan
				echo json_encode(array("status" => FALSE)); 
			}else{
				//simpan sebagai data baru
				$param = [
					'badge_number' => $dataPegawai['badge_number'],
					'nama' => $dataPegawai['nama'],
					'jenis_absen' => $jenisMakan,
					'jam_absen' => tglTime_now()
				];
				$this->db->insert('absen', $param);
				echo json_encode(array("status" => TRUE));  
			}
			
		}else{
			// $item = $this->db->query("SELECT * FROM pegawai WHERE badge_number ='$badge' ")->row_array();
        	echo json_encode(array("status" => FALSE));  
		}
           
    }




}
