<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sbu extends CI_Controller {

   var $data_ref = array('uri_controllers' => 'sbu');

	public function __construct()
	{
		parent::__construct();
		$this->load->model('sbu_model','sbu');
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

		$list = $this->sbu->get_datatables();
		$data = array();
		$no = $_POST['start'];


		foreach ($list as $post) {


				$link_edit = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$post->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';

				$link_hapus = ' <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$post->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';


			$no++;
			$row = array();
         	$row[] = $no;
			$row[] = $post->kode_kel_brg;
         	$row[] = $post->uraian_kel_brg;
         	$row[] = $post->id_standar_harga;
         	$row[] = $post->kode_brg;
         	$row[] = $post->uraian_brg;
         	$row[] = $post->spesifikasi;
         	$row[] = $post->satuan;
         	$row[] = $post->harga_satuan;
			$row[] = $link_edit.$link_hapus;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->sbu->count_all(),
						"recordsFiltered" => $this->sbu->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->sbu->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{

		// $this->_validate();
		$post_date = time();
		$post_date_format = date('Y-m-d h:i:s', $post_date);
      // $user = $this->ion_auth->user()->row();
		//   tambahan validation
		$this->form_validation->set_rules('kode_kel_brg','kode harus di isi','required');
		if ($this->form_validation->run()== false){
			
		} else {



		$data = array(
				'kode_kel_brg' 	=> $this->input->post('kode_kel_brg'),
				'uraian_kel_brg' => $this->input->post('uraian_kel_brg'),
				'id_standar_harga' 	=> $this->input->post('id_standar_harga'),
				'kode_brg' 	=> $this->input->post('kode_brg'),
				'uraian_brg' 	=> $this->input->post('uraian_brg'),
				'spesifikasi' 	=> $this->input->post('spesifikasi'),
				'satuan' 	=> $this->input->post('satuan'),
				'harga_satuan' 	=> $this->input->post('harga_satuan')
				
		);

		$insert = $this->sbu->save($data);
		echo json_encode(array("status" => TRUE));
					}
	}

	public function ajax_update()
	{
		// $this->_validate();
		$post_date = time();
		$post_date_format = date('Y-m-d h:i:s', $post_date);

		$data = array(
			'kode_kel_brg' 	=> $this->input->post('kode_kel_brg'),
			'uraian_kel_brg' => $this->input->post('uraian_kel_brg'),
			'id_standar_harga' 	=> $this->input->post('id_standar_harga'),
			'kode_brg' 	=> $this->input->post('kode_brg'),
			'uraian_brg' 	=> $this->input->post('uraian_brg'),
			'spesifikasi' 	=> $this->input->post('spesifikasi'),
			'satuan' 	=> $this->input->post('satuan'),
			'harga_satuan' 	=> $this->input->post('harga_satuan')
		);
		
		
		$this->sbu->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->sbu->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}




}
