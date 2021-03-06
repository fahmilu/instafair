<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Instafair extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_instafair');
	}

	function index(){

		$result = $this->model_instafair->get_user();
		// print_r($result);

		// if(isset($_GET['code'])){
		// 	echo "<script>";
		// 	echo "window.location = \"".$this->facebook->getLoginURL($this->config->item('facebook_login_parameters'))."\";";
		// 	echo "</script>";
		// }

		if ($this->facebook->getUser()) {

			$this->session->set_userdata(array('facebook_uid' => $result['facebook_uid'], 'is_logged_in' => TRUE));

			$at = $this->model_instafair->get_access_token();

			if ($result['is_true']) {

				$this->session->set_userdata(array('access_token' => $at['access_token']));

			} else {

				$this->session->set_userdata(array('access_token' => FALSE));

			}

			$uid = $this->session->userdata('facebook_uid');
			// $myFB = $this->model_instafair->get_facebook_user($result['facebook_uid'], $at['access_token']);
			// print_r($myFB);
			// exit();

			$dt = $this->model_instafair->check_fbuser($uid);
			
			if ($dt == 0){
				$myFB = $this->facebook->api("/$uid");
				$dat['facebook_id'] = $uid;
				$dat['fullname'] = $myFB['name'];
				$dat['email'] = $myFB['email'];
				$dat['connect_date'] = date('Y-m-d H:i:s');
				
				$this->db->insert('insta_user', $dat);

				$text = 'test kirim';
				$image = 'https://fbstatic-a.akamaihd.net/rsrc.php/v2/y_/r/9myDd8iyu0B.gif';
				$link = 'http://192.168.1.135/instafair';
				$description = 'ini description';

				$this->pushtowall($text, $uid, $image, $link ,$description);
			}

			if(!$this->model_instafair->check_invite_status($uid)){
				
				redirect('instafair/invite');

			}else if(!$this->model_instafair->check_order_status($uid)){

				redirect('instafair/orderpage');
			
			}else if($this->model_instafair->check_order_konfirmasi_status($uid) == 1){
				redirect('instafair/confirmation');
			}else if($this->model_instafair->check_order_konfirmasi_status($uid) == 2){
				redirect('instafair/waitingapproval');
			}else if($this->model_instafair->check_order_konfirmasi_status($uid) == 3){
				redirect('instafair/invite');
			}
			

		} else {

			$this->load->view('header');
			$this->load->view('home');
			$this->load->view('footer');

		}
	}

	function pushtowall($text, $uid, $image, $link, $description){
		$at = $this->session->userdata('access_token');
		$teks = $text;

		$attachment = array(
			'name' => '',
			'href' => $link, 
			'description' => $description,
			'media' => array(array('type' => 'image',
			'src' => $image,
			'href' => $link)),
		);

		$action_links = array(
			array('text' => 'Test Apps',
			'href' => $link));

		$attachment = json_encode($attachment);
		$action_links = json_encode($action_links);

		$attach = json_encode($attachment);

		$publish = 'https://api.facebook.com/method/stream.publish?message='.urlencode($teks).'&attachment='.urlencode($attachment).'&action_links='.urlencode($action_links).'&access_token='.$at;
		file_get_contents($publish);
	}


	function invite(){

		$result = $this->model_instafair->get_user();

		if(!$result['is_true']) redirect('instafair');

		$uid = $this->session->userdata('facebook_uid');

		$dt = $this->model_instafair->check_fbuser($uid);

		if($dt == 0) { redirect('instafair');}
		else if(!$this->model_instafair->check_order_status($uid)){ redirect('instafair/orderpage'); }
		else if($this->model_instafair->check_order_konfirmasi_status($uid) == 1){ redirect('instafair/confirmation'); }
		else if($this->model_instafair->check_order_konfirmasi_status($uid) == 2){ redirect('instafair/waitingapproval'); }

		$this->load->view('header');
		$this->load->view('invite');
		$this->load->view('footer');
	}

	function submit_invite(){
		$id_friend = $this->input->post('id_invite');
		$fbuid = $this->session->userdata('facebook_uid');
		$id_friend = json_decode($id_friend);

		foreach ($id_friend as $key => $value) {
			$this->model_instafair->add_invite($fbuid, $value);
		}
	}

	function orderpage(){
		$result = $this->model_instafair->get_user();

		if(!$result['is_true']) redirect('instafair');

		$data['fbuid'] = $uid = $this->session->userdata('facebook_uid');

		if(!$data['fbuid']) redirect('instafair');

		$dt = $this->model_instafair->check_fbuser($uid);

		if($dt == 0) redirect('instafair');
		else if(!$this->model_instafair->check_invite_status($uid)) redirect('instafair/invite');
		else if($this->model_instafair->check_order_status($uid) and $this->model_instafair->check_order_konfirmasi_status($uid) == 1) redirect('instafair/confirmation');
		else if($this->model_instafair->check_order_status($uid) and $this->model_instafair->check_order_konfirmasi_status($uid) == 2) redirect('instafair/waitingapproval');
		else if($this->model_instafair->check_order_status($uid) and $this->model_instafair->check_order_konfirmasi_status($uid) == 3) redirect('instafair/invite');

		$this->load->view('header');
		$this->load->view('registrasi', $data);
		$this->load->view('footer');
		
	}

	function submitorder(){
		if($this->model_instafair->submit_order()){
			//pushtowall
			echo site_url('instafair/confirmation');
		}else{
			echo site_url('instafair/orderpage');
		}
	}

	function confirmation(){
		$result = $this->model_instafair->get_user();

		if(!$result['is_true']) redirect('instafair');

		$uid = $this->session->userdata('facebook_uid');

		$dt = $this->model_instafair->check_fbuser($uid);

		if($dt == 0) { redirect('instafair');}
		else if(!$this->model_instafair->check_invite_status($uid)){ redirect('instafair/invite'); }
		else if(!$this->model_instafair->check_order_status($uid)){ redirect('instafair/orderpage'); }
		else if($this->model_instafair->check_order_konfirmasi_status($uid) == 3){ redirect('instafair/invite'); }
		else if($this->model_instafair->check_order_konfirmasi_status($uid) == 2){ redirect('instafair/waitingapproval'); }

		$data['order'] = $this->model_instafair->get_orders($uid);

		$orderdate = $enddate = $data['order']->date_order;

		$orderdate = $enddate = strtotime($enddate);
		$enddate = strtotime("+7 day", $enddate);
		$data['enddate'] = date('d/m/Y', $enddate);

		$data['orderdate'] = date('d/m/Y', $orderdate);

		$this->load->view('header');
		$this->load->view('konfirmasi', $data);
		$this->load->view('footer');
	}

	function submitconfirm(){
		if($this->model_instafair->submit_confirm()){
			//pushtowall
			redirect('instafair/waitingapproval');
		}else{
			redirect('instafair/confirmation');
		}
	}

	function orderdetail($id){
		$result = $this->model_instafair->get_user();

		if(!$result['is_true']) redirect('instafair');

		$uid = $this->session->userdata('facebook_uid');

		$dt = $this->model_instafair->check_fbuser($uid);

		if($dt == 0) { redirect('instafair');}
		else if(!$this->model_instafair->check_invite_status($uid)){ redirect('instafair/invite'); }
		else if(!$this->model_instafair->check_order_status($uid)){ redirect('instafair/orderpage'); }

		$data['order'] = $this->model_instafair->get_orders($uid);

		$orderdate = $enddate = $data['order']->date_order;

		$orderdate = $enddate = strtotime($enddate);
		$enddate = strtotime("+7 day", $enddate);
		$data['enddate'] = date('d/m/Y', $enddate);

		$data['orderdate'] = date('d/m/Y', $orderdate);

		$this->load->view('header');
		$this->load->view('orderdetail', $data);
		$this->load->view('footer');
	}

	function waitingapproval(){
		$result = $this->model_instafair->get_user();

		if(!$result['is_true']) redirect('instafair');

		$uid = $this->session->userdata('facebook_uid');

		$dt = $this->model_instafair->check_fbuser($uid);

		if($dt == 0) { redirect('instafair');}
		else if(!$this->model_instafair->check_invite_status($uid)){ redirect('instafair/invite'); }
		else if(!$this->model_instafair->check_order_status($uid)){ redirect('instafair/orderpage'); }
		else if($this->model_instafair->check_order_konfirmasi_status($uid) == 3){ redirect('instafair/invite'); }
		else if($this->model_instafair->check_order_konfirmasi_status($uid) == 1){ redirect('instafair/confirmation'); }

		$data['order'] = $this->model_instafair->get_orders($uid);

		$orderdate = $enddate = $data['order']->date_order;

		$orderdate = $enddate = strtotime($enddate);
		$enddate = strtotime("+7 day", $enddate);
		$data['enddate'] = date('d/m/Y', $enddate);

		$data['orderdate'] = date('d/m/Y', $orderdate);

		$data['confirm_status'] = $this->model_instafair->get_confirm_status($data['order']->id);

		$this->load->view('header');
		$this->load->view('waitingapproval', $data);
		$this->load->view('footer');
	}
	function logout() {
		$this->fbauth->logout();
	}
}