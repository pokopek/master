<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

   var $data_ref = array('uri_controllers' => 'pegawai');

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model','pegawai');
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

		$list = $this->pegawai->get_datatables();
		$data = array();
		$no = $_POST['start'];


		foreach ($list as $post) {


				$link_edit = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$post->id_pegawai."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';

				$link_hapus = ' <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$post->id_pegawai."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';


			$no++;
			$row = array();
         	$row[] = $no;
			$row[] = '<b>'.$post->nama.'</b><br>'.$post->badge_number;
         	$row[] = $post->department;
         	$row[] = $post->section;
			$row[] = $link_edit.$link_hapus;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pegawai->count_all(),
						"recordsFiltered" => $this->pegawai->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->pegawai->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{

		// $this->_validate();
		$post_date = time();
		$post_date_format = date('Y-m-d h:i:s', $post_date);
      // $user = $this->ion_auth->user()->row();
		$data = array(
				'badge_number' 	=> $this->input->post('badge_number'),
				'nama' 			=> $this->input->post('nama'),
				'department' 	=> $this->input->post('department'),
				'status' 		=> $this->input->post('status')
		);

		$insert = $this->pegawai->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		// $this->_validate();
		$post_date = time();
		$post_date_format = date('Y-m-d h:i:s', $post_date);

		$data = array(
				'badge_number' 	=> $this->input->post('badge_number'),
				'nama' 			=> $this->input->post('nama'),
				'department' 	=> $this->input->post('department'),
				'status' 		=> $this->input->post('status')
		);
		
		
		$this->pegawai->update(array('id_pegawai' => $this->input->post('id_pegawai')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->pegawai->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}




}
