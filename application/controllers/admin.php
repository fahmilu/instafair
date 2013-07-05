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
	
	function user(){
		// echo $data['campaign_id'];
		// $data['data_source'] = 1;
		$this->load->library('table');
		$this->load->library('pagination');
		
		echo $this->pagination->create_links();
		$tmpl = array (
			'table_open'          => '<table width="100%" class="default" border="0" cellpadding="4" cellspacing="0">',
			'heading_row_start'   => '<tr>',
			'heading_row_end'     => '</tr>',
			'heading_cell_start'  => '<td class="hed">',
			'heading_cell_end'    => '</td>',
			'row_start'           => '<tr>',
			'row_end'             => '</tr>',
			'cell_start'          => '<td>',
			'cell_end'            => '</td>',
			'row_alt_start'       => '<tr bgcolor="#EBEBEB">',
			'row_alt_end'         => '</tr>',
			'cell_alt_start'      => '<td>',
			'cell_alt_end'        => '</td>',
			'table_close'         => '</table>'
			);
		$this->table->set_template($tmpl);
		$this->table->set_heading('#', 'Facebook Uid', 'Name', 'Email', 'Connect Date', 'Invite Status', 'Order Status');

		$data['page_offset'] = (int)$this->uri->segment(3);
		$config['per_page'] = '20';
		$config['full_tag_open'] = '<p class="pagination">';
		$config['full_tag_close'] = '</p>';
		$config['base_url'] = base_url().'index.php/admin/user';

		$data['total_rows'] = $config['total_rows'] = $this->db->count_all_results('insta_user');
		
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();

		$this->db->select('*');
		$this->db->from('insta_user');
		$this->db->limit($config['per_page'],$data['page_offset']);
		$data['user'] = $this->db->get();
		
		$this->load->view('admin/header');
		$this->load->view('admin/users', $data);
		$this->load->view('admin/footer');		
	}	

	function order(){
		// echo $data['campaign_id'];
		// $data['data_source'] = 1;
		$this->load->library('table');
		$this->load->library('pagination');
		
		echo $this->pagination->create_links();
		$tmpl = array (
			'table_open'          => '<table width="100%" class="default" border="0" cellpadding="4" cellspacing="0">',
			'heading_row_start'   => '<tr>',
			'heading_row_end'     => '</tr>',
			'heading_cell_start'  => '<td class="hed">',
			'heading_cell_end'    => '</td>',
			'row_start'           => '<tr>',
			'row_end'             => '</tr>',
			'cell_start'          => '<td>',
			'cell_end'            => '</td>',
			'row_alt_start'       => '<tr bgcolor="#EBEBEB">',
			'row_alt_end'         => '</tr>',
			'cell_alt_start'      => '<td>',
			'cell_alt_end'        => '</td>',
			'table_close'         => '</table>'
			);
		$this->table->set_template($tmpl);
		$this->table->set_heading('#', 'Facebook Uid','Name', 'Order Item', 'Order Price', 'Order Detail', 'Order Time','Order Status', 'Confirmation Status');

		$data['page_offset'] = (int)$this->uri->segment(3);
		$config['per_page'] = '20';
		$config['full_tag_open'] = '<p class="pagination">';
		$config['full_tag_close'] = '</p>';
		$config['base_url'] = base_url().'index.php/admin/order';

		$data['total_rows'] = $config['total_rows'] = $this->db->count_all_results('orders');
		
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();

		$this->db->select('*');
		$this->db->from('orders');
		$this->db->limit($config['per_page'],$data['page_offset']);
		$data['order'] = $this->db->get();
		
		$this->load->view('admin/header');
		$this->load->view('admin/orders', $data);
		$this->load->view('admin/footer');		
	}

	function confirm($order_id = 0){
		// echo $data['campaign_id'];
		// $data['data_source'] = 1;
		$this->load->library('table');
		$this->load->library('pagination');
		
		echo $this->pagination->create_links();
		$tmpl = array (
			'table_open'          => '<table width="100%" class="default" border="0" cellpadding="4" cellspacing="0">',
			'heading_row_start'   => '<tr>',
			'heading_row_end'     => '</tr>',
			'heading_cell_start'  => '<td class="hed">',
			'heading_cell_end'    => '</td>',
			'row_start'           => '<tr>',
			'row_end'             => '</tr>',
			'cell_start'          => '<td>',
			'cell_end'            => '</td>',
			'row_alt_start'       => '<tr bgcolor="#EBEBEB">',
			'row_alt_end'         => '</tr>',
			'cell_alt_start'      => '<td>',
			'cell_alt_end'        => '</td>',
			'table_close'         => '</table>'
			);
		$this->table->set_template($tmpl);
		$this->table->set_heading('#', 'Facebook Uid','Name', 'Order Item', 'Order Price', 'Bank Account Number','Bank Account Name', 'Approval');
		if($order_id != 0){
			$data['page_offset'] = (int)$this->uri->segment(4);
		}else{
			$data['page_offset'] = (int)$this->uri->segment(3);
		}
		
		$config['per_page'] = '20';
		$config['full_tag_open'] = '<p class="pagination">';
		$config['full_tag_close'] = '</p>';
		$config['base_url'] = base_url().'index.php/admin/order';

		if($order_id != 0){
			$this->db->where('order_id', $order_id);
		}
		$data['total_rows'] = $config['total_rows'] = $this->db->count_all_results('confirms');
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->db->select('confirms.*, orders.*');
		$this->db->from('confirms');
		$this->db->join('orders', 'confirms.order_id = orders.id');
		if($order_id != 0){
			$this->db->where('confirms.order_id', $order_id);
		}
		$this->db->limit($config['per_page'],$data['page_offset']);
		$data['order'] = $this->db->get();
		
		$this->load->view('admin/header');
		$this->load->view('admin/confirms', $data);
		$this->load->view('admin/footer');		
	}

	function approval($order_id){
		$this->db->where('order_id', $order_id);

		if($this->db->update('confirms', array('confirm_status'=>2))){

			$this->session->set_flashdata('message', 'Order Approved');
			redirect('admin/confirm/'.$order_id);

		}
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