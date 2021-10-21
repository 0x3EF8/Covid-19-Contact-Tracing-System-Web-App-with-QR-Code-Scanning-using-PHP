<?php
require_once('../config.php');
Class Establishment extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function save_establishment(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if($k != 'id'){
				if(!empty($data)) $data .=" , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if(empty($id)){
			$code="";
			$zone = $this->conn->query("SELECT * FROM barangay_list where id = $zone_id ")->fetch_array()['code'];
			$city = $this->conn->query("SELECT * FROM city_list where id = $city_id ")->fetch_array()['code'];
			$state = $this->conn->query("SELECT * FROM state_list where id in (SELECT state_id  FROM city_list where id = $city_id ) ")->fetch_array()['code'];
			$code=$state.$city.$zone;
			$i=0;
			while($i == 0){
				$nc = $code.(mt_rand(0,99999999999));
				$chk = $this->conn->query("SELECT * FROM establishment where code = $nc ")->num_rows;
				if($chk <=0 ){
					$code = $nc;
					$i = 1;
				}
			}
			$data .=" , code = '{$code}' ";

			
			if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
				$fname = 'uploads/'.strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
				$move = move_uploaded_file($_FILES['img']['tmp_name'],'../'. $fname);
				$data .=" , image_path = '{$fname}' ";
				
			}
			$qry = $this->conn->query("INSERT INTO establishment set {$data}");
			if($qry){
				$this->settings->set_flashdata('success','Establishment successfully saved.');
				return 1;
			}else{
				return 2;
			}

		}else{
			
			if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
				$fname = 'uploads/'.strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
				$move = move_uploaded_file($_FILES['img']['tmp_name'],'../'. $fname);
				$data .=" , image_path = '{$fname}' ";
				
			}
			$qry = $this->conn->query("UPDATE establishment set $data where id = {$id}");
			if($qry){
				$this->settings->set_flashdata('success','Establishment successfully updated.');
				return 1;
			}else{
				return "INSERT INTO establishment set {$data}";
			}
			
		}
	}
	public function delete_establishment(){
		extract($_POST);
		$qry = $this->conn->query("DELETE FROM establishment where id = $id");
		if($qry){
			$this->settings->set_flashdata('success','Establishment successfully deleted.');
			return 1;
		}else{
			return false;
		}
	}
}

$establishment = new Establishment();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save':
		echo $establishment->save_establishment();
	break;
	case 'delete':
		echo $establishment->delete_establishment();
	break;
	default:
		// echo $sysset->index();
		break;
}