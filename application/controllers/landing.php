<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Landing extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_instafair');
	}

	function index() {

		$result = $this->model_instafair->get_user();
		
		if ($result['is_true']) {
			$this->session->set_userdata(array('facebook_uid' => $result['facebook_uid'], 'is_logged_in' => TRUE));
			redirect('instafair', 'refresh');
			// $at = $this->model_instafair->get_access_token();
			// print_r($at);
		} else {
			$this->load->view('header');
			$this->load->view('landing');
			$this->load->view('footer');
		}
	}
	
	function logout() {
		$this->auth->logout();
	}
}