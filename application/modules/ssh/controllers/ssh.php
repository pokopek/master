<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ssh extends CI_Controller {

   var $data_ref = array('uri_controllers' => 'ssh');

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ssh_model','ssh');
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

	public function ajax_list()
	{

		$list = $this->ssh->get_datatables();
		$data = array();
		$no = $_POST['start'];


		foreach ($list as $post) {


				$link_edit = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$post->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';

				$link_hapus = ' <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$post->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';


			$no++;
			$row = array();
         	$row[] = $no;
			$row[] = $post->KODE_KEL_BRG;
         	$row[] = $post->URAIAN_KEL_BRG;
         	$row[] = $post->ID_SSH;
         	$row[] = $post->KODE_BARANG;
         	$row[] = $post->URAIAN_BARANG;
         	$row[] = $post->SPESIFIKASI;
         	$row[] = $post->SATUAN;
         	$row[] = $post->HARGA_SATUAN;
			$row[] = $link_edit.$link_hapus;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ssh->count_all(),
						"recordsFiltered" => $this->ssh->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->ssh->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{

		// $this->_validate();
		$post_date = time();
		$post_date_format = date('Y-m-d h:i:s', $post_date);
      // $user = $this->ion_auth->user()->row();
		//   tambahan validation
		$this->form_validation->set_rules('KODE_KEL_BRG','kode harus di isi','required');
		if ($this->form_validation->run()== false){
			
		} else {



		$data = array(
				'KODE_KEL_BRG' 	=> $this->input->post('KODE_KEL_BRG'),
				'URAIAN_KEL_BRG' => $this->input->post('URAIAN_KEL_BRG'),
				'ID_SSH' 	=> $this->input->post('ID_SSH'),
				'KODE_BARANG' 	=> $this->input->post('KODE_BARANG'),
				'URAIAN_BARANG' 	=> $this->input->post('URAIAN_BARANG'),
				'SPESIFIKASI' 	=> $this->input->post('SPESIFIKASI'),
				'SATUAN' 	=> $this->input->post('SATUAN'),
				'HARGA_SATUAN' 	=> $this->input->post('HARGA_SATUAN')
				
		);

		$insert = $this->ssh->save($data);
		echo json_encode(array("status" => TRUE));
					}
	}

	public function ajax_update()
	{
		// $this->_validate();
		$post_date = time();
		$post_date_format = date('Y-m-d h:i:s', $post_date);

		$data = array(
			'KODE_KEL_BRG' 	=> $this->input->post('KODE_KEL_BRG'),
			'URAIAN_KEL_BRG' => $this->input->post('URAIAN_KEL_BRG'),
			'ID_SSH' 	=> $this->input->post('ID_SSH'),
			'KODE_BARANG' 	=> $this->input->post('KODE_BARANG'),
			'URAIAN_BARANG' 	=> $this->input->post('URAIAN_BARANG'),
			'SPESIFIKASI' 	=> $this->input->post('SPESIFIKASI'),
			'SATUAN' 	=> $this->input->post('SATUAN'),
			'HARGA_SATUAN' 	=> $this->input->post('HARGA_SATUAN')
		);
		
		
		$this->ssh->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->ssh->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}




}
