<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('customade');
		$this->load->library(array('form_validation'));	
		check_login();

	}
	
	public function index()
	{
		$data=array();
		$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
		    );
		$data=array('csrf'=>$csrf);	


		$this->load->view('template/header',$data);
		$this->load->view('dashboard',$data);
		$this->load->view('template/footer',$data);
	}

	public function ajax_edit($id)
	{
		$data = $this->db->query("SELECT * FROM kavling_peta a 
			LEFT JOIN customer b ON a.id_customer=b.id_customer 
			WHERE a.id_kavling = '$id' ")->row_array();
		echo json_encode($data);
	}
	
	
	public function statistik()
	{
	    
    //Total registrasi
    $formulir = $this->db->query("SELECT COUNT(id_formulir) as pengajuan FROM formulir")->row_array();

    //Reg No telp
    $reg = $this->db->query("SELECT COUNT(id_formulir) as regAwal FROM formulir WHERE status = '1'")->row_array();

    //Memilih Kelas
    $kls = $this->db->query("SELECT COUNT(id_formulir) as kelas FROM formulir WHERE status >= '2'")->row_array();
	    
    //Konfirmasi Transfer
    $konfirm = $this->db->query("SELECT COUNT(id_formulir) as transfer FROM formulir WHERE status = '3'")->row_array();

    //Konfirmasi Transfer
    $ferif = $this->db->query("SELECT COUNT(id_formulir) as ferifikasi FROM formulir WHERE status = '4'")->row_array();

    //Konfirmasi Selesai
    $selesai = $this->db->query("SELECT COUNT(id_formulir) as selesai FROM formulir WHERE status = '4'")->row_array();
	    
    //Peserta Ikhwan
    $ikhwan = $this->db->query("SELECT COUNT(id_formulir) as ikhwan FROM formulir WHERE jenis_kelamin = 'LAKI-LAKI'")->row_array();
	    
    //peserta Akhwat
    $akhwat = $this->db->query("SELECT COUNT(id_formulir) as akhwat FROM formulir WHERE jenis_kelamin = 'PEREMPUAN'")->row_array();
	    

	    
		echo '
		<div class="row">
    		<div class="col-md-6">
    		    <h4>Permintaan Formulir</h4>
        		<table class="table table-bordered">
                    <thead>
                      <tr>
                        <th width="5%">#</th>
                        <th width="65%">Jenis Data</th>
                        <th width="15%">Jumlah</th>
                        <th width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Registrasi Awal</td>
                        <td align="center">'.$reg['regAwal'].'</td>
                        <td align="center"><a href="" class="btn btn-xs btn-primary">detail</a></td>
                      </tr>
                      
                      <tr>
                        <td>2</td>
                        <td>Memilih Kelas</td>
                        <td align="center">'.$kls['kelas'].'</td>
                        <td align="center"><a href="" class="btn btn-xs btn-primary">detail</a></td>
                      </tr>
        
                      <tr>
                        <td>3</td>
                        <td>Transfer</td>
                        <td align="center">'.$konfirm['transfer'].'</td>
                        <td align="center"><a href="" class="btn btn-xs btn-primary">detail</a></td>
                      </tr>

                      <tr>
                        <td>4</td>
                        <td>Konfirmasi</td>
                        <td align="center">'.$ferif['ferifikasi'].'</td>
                        <td align="center"><a href="" class="btn btn-xs btn-primary">detail</a></td>
                      </tr>

                      <tr>
                        <td>5</td>
                        <td>Selesai Regisrtasi</td>
                        <td align="center">'.$selesai['selesai'].'</td>
                        <td align="center"><a href="" class="btn btn-xs btn-primary">detail</a></td>
                      </tr>

                      <tr>
                        <td>5</td>
                        <td>Total Regisrtasi</td>
                        <td align="center">'.$formulir['pengajuan'].'</td>
                        <td align="center"><a href="" class="btn btn-xs btn-primary">detail</a></td>
                      </tr>
        
        
                    </tbody>
                  </table>
                </div>
                
                
                <div class="col-md-6">
              <h4>Pembagian Kelas</h4>
              
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="5%">#</th>
                    <th width="65%">Nama Kelas</th>
                    <th width="15%">Jumlah</th>
                    <th width="15%">Detail</th>
                  </tr>
                </thead>
                <tbody>';

                $no = 1;
                $kelas = $this->db->query("SELECT * FROM kelas ORDER BY id_kelas")->result();

                foreach ($kelas as $kls) {
                  echo '<tr>
                    <td>'.$no++.'</td>
                    <td>'.$kls->nama_kelas.'</td>
                    <td align="center"></td>
                    <td align="center"><a href="" class="btn btn-xs btn-primary">detail</a></td>
                  </tr>';
                }
                                  
                  
                echo '</tbody>
              </table>
              </div>
              
        </div>
          
          <div class="col-md-6">
          <h5>Jenis Kelamin</h5>
          
          
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Jenis Data</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Jumlah Banin</td>
                <td>'.$ikhwan['ikhwan'].'</td>
              </tr>
              
              <tr>
                <td>2</td>
                <td>Jumlah Banat</td>
                <td>'.$akhwat['akhwat'].'</td>
              </tr>
            </tbody>
          </table>
          </div>
          ';
	}



	

}


