<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	private $setting_tb	= 'setting';			
	private $category_tb	= 'category';	
	private $product_tb	= 'product';	

	function __construct()
	{
		parent::__construct();
		$ci =& get_instance();
	}

	function get_setting()
	{
		$query = $this->db->get($this->setting_tb);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	
	function addcategory(){
		$data['name'] = $_POST['category'];
		$data['description'] = $_POST['description'];
		if($this->db->insert($this->category_tb, $data)) return true;
	}
	
	function getCategory(){
		return $this->db->get_where($this->category_tb, array('delete'=> 0));
	}
	
	function updateCategory($id){
		$data['name'] = $_POST['category'];
		$data['description'] = $_POST['description'];
		$this->db->where('id', $id);
		if($this->db->update($this->category_tb, $data)) return true;	
	}
	
	function deleteCategory($id){
		$data['delete'] = 1;
		$this->db->where('id', $id);
		if($this->db->update($this->category_tb, $data)) return true;	
	}
	
	function getProduct($category){
		if($category != 'all'){
			$dt_cat = $this->db->get_where($this->category_tb, array('name' => $category));
			$dtcat = $dt_cat->row();
			return $this->db->get_where($this->product_tb, array('deleted'=>0, 'category_id' => $dtcat->id));
			$this->db->where();
		}else{
			return $this->db->get_where($this->product_tb, array('deleted'=>0));
			}
	}

	function getSingleProduct($id){
		$data = $this->db->get_where($this->product_tb, array('id' => $id));
		return $data->row();
	}
	function add_product($data, $act){
		$data['catalogueid'] = $_POST['catalogueID'];
		$data['productname'] = $_POST['productName'];
		$data['subtitle'] = $_POST['subtitle'];
		$data['tags'] = $_POST['tags'];
		$data['price_idr'] = $_POST['price_idr'];
		$data['price_usd'] = $_POST['price_usd'];
		$data['sale_price_idr'] = $_POST['sale_price_idr'];
		$data['sale_price_usd'] = $_POST['sale_price_usd'];
		$data['label'] = $_POST['label'];
		$data['category_id'] = $_POST['category_id'];
		$data['status'] = $_POST['status'];
		$data['stock'] = $_POST['stock'];
		$data['published'] = $_POST['published'];
		$data['description'] = $_POST['description'];
		
		if($act == 'insert'){
			$this->db->insert($this->product_tb, $data);
			return TRUE;
		}elseif ($act == 'update') {
			$this->db->where('id', $_POST['id']);
			$this->db->update($this->product_tb, $data);
			return TRUE;
		}
	}

	function deleteProduct($id){
		$data['deleted'] = 1;
		$this->db->where('id', $id);
		if($this->db->update($this->product_tb, $data)) return true;	
	}

}