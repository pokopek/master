<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

   var $data_ref = array('uri_controllers' => 'pengaduan');

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengaduan_model','pengaduan');
		// $this->load->model('Group/Group_model','group');
		check_login();
	}

	public function index()
	{

		$user_data['tambah_view'] = 1;
		$user_data['lihat_view'] = 1;

		$user_data['data_ref'] = $this->data_ref;
		$user_data['title'] = 'Menu';
		$user_data['menu_active'] = 'Data Referensi';
		$user_data['sub_menu_active'] = 'Menu';
     	
      	// $this->load->view('header',$user_data);
     	$this->load->view('template/header');
		$this->load->view('view',$user_data);
		// $this->load->view('template/footer');
	}


	public function summary()
	{

		$user_data['data_ref'] = $this->data_ref;
     	
     	$this->load->view('template/header');
		$this->load->view('summary',$user_data);

	}

    public function summary_tampil()
    {

        $user_data['data_ref'] = $this->data_ref;
        
        $this->load->view('template/header');
        $this->load->view('summary_tampil',$user_data);

    }


	public function periode()
	{

		$user_data['data_ref'] = $this->data_ref;
     	

     	$this->load->view('template/header');
		$this->load->view('periode',$user_data);

	}

    public function periode_excel()
    {

        $user_data['data_ref'] = $this->data_ref;
        

        $this->load->view('template/header');
        $this->load->view('periode_excel',$user_data);

    }

	function cetak_periode(){

        $jenis 		= $this->input->post('jenis');
        $tanggal 	= $this->input->post('tanggal');
        $tahun		= date('Y');


        // $tanggal_awal = '01-'.$bulan.'-'.$tahun;
        // $tanggal_akhir = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun).'-'.$bulan.'-'.$tahun;;

        // $tglAwal = strtotime($tanggal_awal);
        // $tglAkhir = strtotime($tanggal_akhir);


        // $from   = '01-'.$bulan.'-'.$tahun;
        // $to     = '29-'.$bulan.'-'.$tahun;

        // $from   = convertDate($tanggal_awal);
        // $to     = convertDate($tanggal_akhir);

        //  $bulan = substr($tanggal_awal,3,2);
        //  $bulan2 = substr($tanggal_akhir,3,2);


        //  $tahun = substr($tanggal_awal,6,4);

        
        

        $config=array('orientation'=>'P','size'=>'A4');
        $this->load->library('MyPDF',$config);
        $this->mypdf->SetFont('Arial','B',10);
        $this->mypdf->SetLeftMargin(10);
        $this->mypdf->addPage();
        $this->mypdf->setTitle('Laporan Absensi');
        $this->mypdf->SetFont('Arial','B',14);
        $this->mypdf->Cell(200,7,'Laporan Detail',0,0,'C');
        $this->mypdf->Ln();
       

        $this->mypdf->SetFont('Arial','',8);
        $this->mypdf->text(10,23,"Jenis Waktu Makan");
        $this->mypdf->text(35,23," : ");
        $this->mypdf->text(40,23,$jenis);

        $this->mypdf->text(10,27,"Tanggal");
        $this->mypdf->text(35,27," : ");
        $this->mypdf->text(40,27, $tanggal);


 
        $this->mypdf->Ln();
        $this->mypdf->Ln();
        $this->mypdf->Ln();


        //Judul Tabel
        $this->mypdf->SetFillColor(70,130,180);
        $header = array('No','Bagde Number','Name','Jam');
        $w = array(10, 40, 60, 40);
        $this->mypdf->SetFont('Arial','B',7);
        for($i=0;$i<count($header);$i++)$this->mypdf->Cell($w[$i],5,$header[$i],1,0,'C');


     //    $dataAbsen = $this->db->query("SELECT * FROM absen")->result();
    	// foreach ($dataAbsen as $abs){

	        // $this->mypdf->setAligns(array('C','C','C','C','C','C','C'));
	        $this->mypdf->Row(array('q')); 

	    // }
        

        
        $posisi = $this->mypdf->GetY();


        $this->mypdf->Output();
    }


    function cetak_periode_excel(){

        $jenis      = $this->input->post('jenis');
        $tanggal    = $this->input->post('tanggal');
        $tahun      = date('Y');

        $user_data['tanggal'] =  $tanggal;
        $user_data['jenis'] =  $jenis;
        $user_data['dataPeriode'] = $this->db->query("SELECT * FROM absen 
            LEFT JOIN pegawai ON absen.badge_number = pegawai.badge_number 
            WHERE absen.jenis_absen='$jenis' AND absen.jam_absen like '$tanggal%' ORDER BY department")->result();

        $this->load->view('cetak_periode_excel',$user_data);

    }


    function cetak_periode_pdf(){


        $jenis = $this->input->post('jenis');
        $tanggal = $this->input->post('tanggal');
        

        $config=array('orientation'=>'P','size'=>'A4');
        $this->load->library('MyPDF',$config);
        $this->mypdf->SetFont('Arial','B',10);
        $this->mypdf->SetLeftMargin(20);
        $this->mypdf->addPage();


        $this->mypdf->Image('http://localhost/absen_makan/assets/logo1.jpg',20,13,40);
        $this->mypdf->Image('http://localhost/absen_makan/assets/logo2.jpg',165,12,20);
        $this->mypdf->setTitle('Laporan Absensi');
        $this->mypdf->SetFont('Arial','B',14);


        $this->mypdf->Cell(170,20,'Absensi '.$jenis. ' Karyawan',0,1,'C');
        $this->mypdf->SetFont('Arial','',9);
        $this->mypdf->Cell(30,5,'Site',0,0,'l');
        $this->mypdf->Cell(50,5,': Indexim - Kaliorang',0,1,'l');
        $this->mypdf->Cell(30,5,'Tanggal',0,0,'l');
        $this->mypdf->Cell(50,5,': '.tgl_indo($tanggal),0,0,'l');
        $this->mypdf->Ln();    


        
        //Judul Tabel
        $this->mypdf->SetFillColor(70,130,180);
        $header = array('No','Badge Number','Nama Karyawan','Department','Jam Makan');
        $w = array(6, 25, 65, 50, 20);
        $this->mypdf->SetFont('Arial','B',8);
        for($i=0;$i<count($header);$i++)
            $this->mypdf->Cell($w[$i],8,$header[$i],1,0,'C');


        $this->mypdf->Ln();
        $this->mypdf->SetFont('Arial','',8);
        $no=1;
        $this->mypdf->SetWidths($w);   
        //Master Baris

        $isiAbsen = $this->db->query("SELECT * FROM absen 
        LEFT JOIN pegawai ON absen.badge_number = pegawai.badge_number 
        WHERE absen.jenis_absen='$jenis' AND absen.jam_absen like '$tanggal%'")->result();
        $no = 1;
        foreach ($isiAbsen as $abs) {
            
                $this->mypdf->setAligns(array('C', 'C', 'L', 'L', 'C'));
                $this->mypdf->Row(array($no++ , $abs->badge_number, $abs->nama, $abs->department, substr($abs->jam_absen, 11,8) )); 
        }

        $jumlah = $this->db->query("SELECT count(absen.badge_number) as jumAbsen FROM absen 
        LEFT JOIN pegawai ON absen.badge_number = pegawai.badge_number 
        WHERE absen.jenis_absen='$jenis' AND absen.jam_absen like '$tanggal%'")->row_array();
        
        $this->mypdf->SetFont('Arial','B',8);

        
        $this->mypdf->Ln();   
        $this->mypdf->Cell(70,5,'',0,0,'l');
        $this->mypdf->Cell(40,5,'TOTAL IC',0,0,'l');
        $this->mypdf->Cell(30,5,$jumlah['jumAbsen'],0,1,'R');

        $this->mypdf->Cell(70,5,'',0,0,'l');
        $this->mypdf->Cell(40,5,'TOTAL KONTRAKTOR',0,0,'l');
        $this->mypdf->Cell(30,5,'0',0,1,'R');

        $x = $this->mypdf->getX()+1;
        $y = $this->mypdf->getY();
        $this->mypdf->SetLineWidth(0.3);
        $this->mypdf->Line(90,$y,163,$y);

        $this->mypdf->Cell(70,5,'',0,0,'l');
        $this->mypdf->Cell(40,5,'GRAND TOTAL',0,0,'l');
        $this->mypdf->Cell(30,5,$jumlah['jumAbsen'],0,1,'R');



        $this->mypdf->Ln();   
        $this->mypdf->Ln();   
        $this->mypdf->Ln();   
        $this->mypdf->Cell(100,5,'',0,0,'l');
        $this->mypdf->Cell(40,5,'Kaliorang, '.tgl_indo($tanggal),0,1,'C');

        $this->mypdf->Cell(20,5,'',0,0,'l');
        $this->mypdf->Cell(40,5,'Prepared By,',0,0,'C');
        $this->mypdf->Cell(40,5,'',0,0,'l');
        $this->mypdf->Cell(40,5,'Aknowledge By,',0,0,'C');

        $this->mypdf->Ln();  
        $this->mypdf->Ln();  
        $this->mypdf->Ln();  
        $this->mypdf->Ln();  
        $this->mypdf->Ln();  


        $this->mypdf->Cell(20,5,'',0,0,'l');
        $this->mypdf->Cell(40,5,'(                                    )',0,0,'C');
        $this->mypdf->Cell(40,5,'',0,0,'l');
        $this->mypdf->Cell(40,5,'(                                    )',0,1,'C');

        $this->mypdf->Cell(20,5,'',0,0,'l');
        $this->mypdf->Cell(40,5,'PT. Abadi Raya Commerce',0,0,'C');
        $this->mypdf->Cell(40,5,'',0,0,'l');
        $this->mypdf->Cell(40,5,'PT. Indexim Coalindo',0,0,'C');

        $this->mypdf->Output();
    }





    function template(){



        

        $config=array('orientation'=>'P','size'=>'A4');
        $this->load->library('MyPDF',$config);
        $this->mypdf->SetFont('Arial','B',10);
        $this->mypdf->SetLeftMargin(10);
        $this->mypdf->addPage();
        $this->mypdf->setTitle('Laporan Absensi');
        $this->mypdf->SetFont('Arial','B',14);
        $this->mypdf->Cell(200,7,'Laporan Absensi Pegawai',0,0,'C');
        $this->mypdf->Ln();
       

        $this->mypdf->SetFont('Arial','',8);
        $this->mypdf->text(10,23,"Nama Pegawai");
        $this->mypdf->text(35,23," : ");

        $this->mypdf->text(10,27,"NIP / NIK");
        $this->mypdf->text(35,27," : ");

        $this->mypdf->text(10,31,"Periode Absen");
        $this->mypdf->text(35,31," : ");


 
        $this->mypdf->Ln();
        $this->mypdf->Ln();
        $this->mypdf->Ln();

        
        //Judul Tabel
        $this->mypdf->SetFillColor(70,130,180);
        $header = array('No','Hari','Tanggal','A Masuk','A Pulang','Keterangan');
        $w = array(6, 25, 35, 25, 25, 25, 25);
        $this->mypdf->SetFont('Arial','B',7);
        for($i=0;$i<count($header);$i++)
            $this->mypdf->Cell($w[$i],5,$header[$i],1,0,'C');


        $this->mypdf->Ln();
        $this->mypdf->SetFont('Arial','',9);
        $no=1;
        $this->mypdf->SetWidths($w);   
        //Master Baris


        for ($i=1; $i <=5; $i++) { 

            
                $this->mypdf->setAligns(array('C'));
                $this->mypdf->Row(array($i, 'as','','','','')); 


        }

        
        $posisi = $this->mypdf->GetY();
        
        $this->mypdf->SetFont('Arial','',8);
        $this->mypdf->text(11,$posisi+ 15,"KETERANGAN IJIN : . ");

        $no=1;
        $y=$posisi+ 20;




        $this->mypdf->text(145,$y+10," KEPALA Dinas KOMINFO" );
        $this->mypdf->text(156,$y+30,"SUTADI");
        $this->mypdf->text(145,$y+36,"196603151987011001");

        $this->mypdf->Output();
    }

}
