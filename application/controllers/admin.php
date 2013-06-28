<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model', 'admin');
				if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}

	function index()
	{
		$this->session->set_userdata('username', $this->tank_auth->get_username());
		redirect('admin/dashboard');
	}
	
	function dashboard(){
		$this->load->view('admin/header');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
	
	function setting(){
		$data['dt'] = $this->admin->get_setting();

		$this->load->view('admin/header');
		$this->load->view('admin/setting', $data);
		$this->load->view('admin/footer');
	}
	
	function update_setting(){
		$config['upload_path'] = './upload/banner/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '1024';
		$config['max_width']  = '1024';
		$config['max_height']  = '1024';
		
		$data['banner'] = $this->input->post('banner');
		$data['kurs'] = $this->input->post('kurs');
		
		$this->load->library('upload', $config);
		if($_FILES['image']['name'] != ''){
			if ( ! $this->upload->do_upload('image')){
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}
			else{
				$dt = array('upload_data' => $this->upload->data());
				$data['banner_pict'] = $dt['upload_data']['file_name'];
			}			
		}
		if($this->db->update('setting', $data)) redirect('admin/setting');
	}
	
	function pre_employee(){
		if($_POST){
			$dt['title'] = $_POST['title'];
			$dt['content_en'] = $_POST['content_en'];
			$dt['content_id'] = $_POST['content_id'];
			$dt['case_status'] = $_POST['case_status'];
			$dt['case_en'] = $_POST['case_en'];
			$dt['case_id'] = $_POST['case_id'];

			$this->db->where('id', 1);
			$this->db->update('pages', $dt);
		}
		
		$dt = $this->db->get_where('pages', array('id'=>1));
		$data['pre'] = $dt->row(); 
		$data['redirect'] = 'pre_employee';
		$this->load->view('admin/header');
		$this->load->view('admin/pre_employee', $data);
		$this->load->view('admin/footer');

		
	}

	function vendor(){
		if($_POST){
			$dt['title'] = $_POST['title'];
			$dt['content_en'] = $_POST['content_en'];
			$dt['content_id'] = $_POST['content_id'];
			$dt['case_status'] = $_POST['case_status'];
			$dt['case_en'] = $_POST['case_en'];
			$dt['case_id'] = $_POST['case_id'];

			$this->db->where('id', 2);
			$this->db->update('pages', $dt);
		}
		
		$dt = $this->db->get_where('pages', array('id'=>2));
		$data['pre'] = $dt->row(); 
		$data['redirect'] = 'vendor';

		$this->load->view('admin/header');
		$this->load->view('admin/pre_employee', $data);
		$this->load->view('admin/footer');
		
	}

	function know_customer(){
		if($_POST){
			$dt['title'] = $_POST['title'];
			$dt['content_en'] = $_POST['content_en'];
			$dt['content_id'] = $_POST['content_id'];
			$dt['case_status'] = $_POST['case_status'];
			$dt['case_en'] = $_POST['case_en'];
			$dt['case_id'] = $_POST['case_id'];

			$this->db->where('id', 3);
			$this->db->update('pages', $dt);
		}
		
		$dt = $this->db->get_where('pages', array('id'=>3));
		$data['pre'] = $dt->row(); 
		$data['redirect'] = 'know_customer';

		$this->load->view('admin/header');
		$this->load->view('admin/pre_employee', $data);
		$this->load->view('admin/footer');
		
	}

	function background_check(){
		if($_POST){
			$dt['title'] = $_POST['title'];
			$dt['content_en'] = $_POST['content_en'];
			$dt['content_id'] = $_POST['content_id'];
			$dt['case_status'] = $_POST['case_status'];
			$dt['case_en'] = $_POST['case_en'];
			$dt['case_id'] = $_POST['case_id'];

			$this->db->where('id', 4);
			$this->db->update('pages', $dt);
		}
		
		$dt = $this->db->get_where('pages', array('id'=>4));
		$data['pre'] = $dt->row(); 
		$data['redirect'] = 'background_check';

		$this->load->view('admin/header');
		$this->load->view('admin/pre_employee', $data);
		$this->load->view('admin/footer');
		
	}

	function about(){
		if($_POST){
			$dt['title'] = $_POST['title'];
			$dt['content_en'] = $_POST['content_en'];
			$dt['content_id'] = $_POST['content_id'];
			$dt['case_status'] = $_POST['case_status'];
			$dt['case_en'] = $_POST['case_en'];
			$dt['case_id'] = $_POST['case_id'];

			$this->db->where('id', 5);
			$this->db->update('pages', $dt);
		}
		
		$dt = $this->db->get_where('pages', array('id'=>5));
		$data['pre'] = $dt->row(); 
		$data['redirect'] = 'about';

		$this->load->view('admin/header');
		$this->load->view('admin/pre_employee', $data);
		$this->load->view('admin/footer');		
	}	

	function fcpa(){
		if($_POST){
			$dt['title'] = $_POST['title'];
			$dt['content_en'] = $_POST['content_en'];
			$dt['content_id'] = $_POST['content_id'];
			$dt['case_status'] = $_POST['case_status'];
			$dt['case_en'] = $_POST['case_en'];
			$dt['case_id'] = $_POST['case_id'];

			$this->db->where('id', 6);
			$this->db->update('pages', $dt);
		}
		
		$dt = $this->db->get_where('pages', array('id'=>6));
		$data['pre'] = $dt->row(); 
		$data['redirect'] = 'fcpa';

		$this->load->view('admin/header');
		$this->load->view('admin/pre_employee', $data);
		$this->load->view('admin/footer');		
	}

	function change_password(){
		$data['redirect_url'] = 'admin/dashboard';
		$this->load->view('admin/header');
		$this->load->view('admin/change_password', $data);
		$this->load->view('admin/footer');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */