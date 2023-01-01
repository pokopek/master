<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

   var $data_ref = array('uri_controllers' => 'pengguna');

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengguna_model','pengguna');
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

	public function setingabsen()
	{

		$user_data['tambah_view'] = 1;
		$user_data['lihat_view'] = 1;

		$user_data['data_ref'] = $this->data_ref;
		$user_data['title'] = 'Menu';
		$user_data['menu_active'] = 'Data Referensi';
		$user_data['setingan'] = $this->db->query("SELECT * FROM pengaturan WHERE id_pengaturan='1'")->row_array();
     	
      	// $this->load->view('header',$user_data);
     	$this->load->view('template/header');
		$this->load->view('view_seting',$user_data);
		// $this->load->view('template/footer');
	}

	public function ajax_list()
	{

		$list = $this->pengguna->get_datatables();
		$data = array();
		$no = $_POST['start'];


		foreach ($list as $post) {


				$link_edit = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$post->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';

				$link_hapus = ' <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$post->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';


			$no++;
			$row = array();
         	$row[] = $no;
         	$row[] = $post->surname;
			$row[] = $post->username;
         	$row[] = $post->email;
         	$row[] = $post->no_hp;
			//add html for action
			$row[] = $link_edit.$link_hapus;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pengguna->count_all(),
						"recordsFiltered" => $this->pengguna->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->pengguna->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{

		$this->_validate();
		$post_date = time();
		$post_date_format = date('Y-m-d h:i:s', $post_date);
      // $user = $this->ion_auth->user()->row();
		$data = array(
				'surname' 		=> $this->input->post('surname'),
				'username' 		=> $this->input->post('username'),
            	'password' 		=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            	'email' 		=> $this->input->post('email'),
				'no_hp' 		=> $this->input->post('no_hp'),
            	'is_trash' 		=> 0
		);

		$insert = $this->pengguna->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$post_date = time();
		$post_date_format = date('Y-m-d h:i:s', $post_date);

		if($this->input->post('password') == ''){
			$data = array(
				'surname' 		=> $this->input->post('surname'),
				'username' 		=> $this->input->post('username'),
            	'email' 		=> $this->input->post('email'),
				'no_hp' 		=> $this->input->post('no_hp'),
				'is_admin' 		=> 1,
				'role' 			=> $this->input->post('role'),
            	'is_trash' 		=> 0
			);
		}else{
			$data = array(
				'surname' 		=> $this->input->post('surname'),
				'username' 		=> $this->input->post('username'),
            	'password' 		=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            	'email' 		=> $this->input->post('email'),
				'no_hp' 		=> $this->input->post('no_hp'),
				'is_admin' 		=> 1,
				'role' 			=> $this->input->post('role'),
            	'is_trash' 		=> 0
			);
		}
		
		
		$this->pengguna->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}



	public function ajax_update_pengaturan()
	{

			$data = array(
				'n_perusahaan' 		=> $this->input->post('n_perusahaan'),
				'n_rekanan' 		=> $this->input->post('n_rekanan'),
            	'n_site' 		=> $this->input->post('n_site'),
				'status' 		=> $this->input->post('status'),
			);
		
		
		$this->db->update('pengaturan', $data, array('id_pengaturan' => $this->input->post('id')));
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->db->delete('users', ['id'=> $id]);
		echo json_encode(array("status" => TRUE));
	}


	public function profile()
	{
		$user_data['tambah_view'] = 1;
		$user_data['lihat_view'] = 1;

		$user_data['data_ref'] = $this->data_ref;
		$user_data['title'] = 'Menu';
		$user_data['menu_active'] = 'Data Referensi';
		$user_data['sub_menu_active'] = 'Menu';
     	
     	$id = $this->encryption->decrypt($this->session->userdata('id'));
      	$user_data['profile'] = $this->db->query("SELECT * FROM users WHERE id ='$id'")->row_array();
     	$this->load->view('template/header');
		$this->load->view('profile',$user_data);
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('surname') == '')
		{
			$data['inputerror'][] = 'surname';
			$data['error_string'][] = 'Nama Lengkap harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'username harus diisi';
			$data['status'] = FALSE;
		}

		// if($this->input->post('password') == '')
		// {
		// 	$data['inputerror'][] = 'password';
		// 	$data['error_string'][] = 'Password harus diisi';
		// 	$data['status'] = FALSE;
		// }

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}



}
