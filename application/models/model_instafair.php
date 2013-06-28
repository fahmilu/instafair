<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_instafair extends CI_Model {

	function get_user() {

		$query = $this->facebook->getUser();
	

		if ($query) {

			$data['is_true'] = TRUE;
			$data['facebook_uid'] = $query;

			return $data;

		} else {

			$data['is_true'] = FALSE;
			return $data;

		}

	}

	

	function get_access_token() {

		$query = $this->facebook->getAccessToken();

		

		if ($query) {

			$data['is_true'] = TRUE;

			$data['access_token'] = $query;

			return $data;

		} else {

			$data['is_true'] = FALSE;

			return $data;

		}

	}

	

	function get_api_secret() {

		$query = $this->facebook->getApiSecret();

		

		if ($query) {

			$data['is_true'] = TRUE;

			$data['api_secret'] = $query;

			return $data;

		} else {

			$data['is_true'] = FALSE;

			return $data;

		}

	}



	function get_app_id() {

		$query = $this->facebook->getApiSecret();

		

		if ($query) {

			$data['is_true'] = TRUE;

			$data['app_id'] = $query;

			return $data;

		} else {

			$data['is_true'] = FALSE;

			return $data;

		}

	}

	

	function get_logout_url() {

		$query = $this->facebook->getLogoutUrl(array('next' => base_url()));

		

		if ($query) {

			$data['is_true'] = TRUE;

			$data['logout_url'] = $query;

			return $data;

		} else {

			$data['is_true'] = FALSE;

			return $data;

		}

	}

	

	function get_signed_request() {

		$query = $this->facebook->getSignedRequest();

		

		if ($query) {

			$data['is_true'] = TRUE;

			$data['signed_request'] = $query;

			return $data;

		} else {

			$data['is_true'] = FALSE;

			return $data;

		}

	}

	

	function set_access_token($access_token) {

		$query = $this->facebook->setAccessToken($access_token);

		

		if ($query) {

			$data['is_true'] = TRUE;

			return $data;

		} else {

			$data['is_true'] = FALSE;

			return $data;

		}

	}

	

	function set_api_secret($app_secret) {

		$query = $this->facebook->setApiSecret($app_secret);

		

		if ($query) {

			$data['is_true'] = TRUE;

			return $data;

		} else {

			$data['is_true'] = FALSE;

			return $data;

		}

	}

	

	function set_app_id($app_id) {

		$query = $this->facebook->setAppId($app_id);

		

		if ($query) {

			$data['is_true'] = TRUE;

			return $data;

		} else {

			$data['is_true'] = FALSE;

			return $data;

		}

	}

	

	//function is formatted for the following

	//https://graph.facebook.com/ID/CONNECTION_TYPE?access_token=123456
	function get_facebook_user($facebook_uid, $access_token){
		// $fb_connect = curl_init();  

		// curl_setopt($fb_connect, CURLOPT_URL, 'https://graph.facebook.com/'.$facebook_uid.'?access_token='.$access_token);  

		// curl_setopt($fb_connect, CURLOPT_RETURNTRANSFER, 1);  

		$output = file_get_contents('https://graph.facebook.com/'.$facebook_uid.'?access_token='.$access_token);  

		// curl_close($fb_connect);  

		$result = json_decode($output);
		print_r($result);
		exit();

	}

	function get_facebook_object($object, $facebook_uid, $access_token) {

		$fb_connect = curl_init();  

		curl_setopt($fb_connect, CURLOPT_URL, 'https://graph.facebook.com/'.$facebook_uid.'/'.$object.'?access_token='.$access_token);  

		curl_setopt($fb_connect, CURLOPT_RETURNTRANSFER, 1);  

		$output = curl_exec($fb_connect);  

		curl_close($fb_connect);  

		$result = json_decode($output);

		print_r($result);
		exit();

		if (isset($result->error)) {

			$data['is_true'] = FALSE;

			$data['message'] = $result->error->message;

			$data['type'] = $result->error->type;

			$data['code'] = $result->error->code;

		

			return $data;

		} else {

			$data['is_true'] = TRUE;

			$data['data'] = $result->data;

			

			return $data;

		}

	}

	function add_invite($fbuid, $id_invite){
		$dt = $this->db->get_where('invites', array('facebook_id'=>$fbuid, 'invite_facebook_id'=>$id_invite));
		if($dt->num_rows() == 0){
			$data['facebook_id'] = $fbuid;
			$data['invite_facebook_id'] = $id_invite;
			$data['invite_created'] = date('Y-m-d H:i:s');

			if($this->db->insert('invites', $data)){
				$dta = $this->db->get_where('insta_user', array('facebook_id'=>$fbuid));
				$status_invite = $dta->row()->status_invite;
				if($status_invite > 0){
					$this->db->where('facebook_id', $fbuid);
					if($this->db->update('insta_user', array('status_invite'=> ($status_invite - 1)))){
						return TRUE;
					}
				}
			}
		}
	}	

	function check_fbuser($fbuid){
		$dt = $this->db->get_where('insta_user', array('facebook_id'=>$fbuid));

		return $dt->num_rows();
	}	

	function check_invite_status($fbuid){
		$dt = $this->db->get_where('insta_user', array('facebook_id'=>$fbuid));
		$r = $dt->row();

		if($r->status_invite == 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}	

	function check_order_status($fbuid){
		$dt = $this->db->get_where('insta_user', array('facebook_id'=>$fbuid));
		$r = $dt->row();

		if($r->status_order == 1){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function check_order_konfirmasi_status($fbuid){
		$dt = $this->db->get_where('orders', array('facebook_id'=>$fbuid));
		$r = $dt->row();

		return $r->order_status;
	}

}