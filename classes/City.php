<?php
require_once('../config.php');
Class City extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function save_city(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if($k != 'id'){
				if(!empty($data)) $data .=" , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if(empty($id)){
			$chk = $this->conn->query("SELECT * FROM city_list where code = '$code' ")->num_rows;
			if($chk > 0){
				return 3;
			}else{
				$qry = $this->conn->query("INSERT INTO city_list set {$data}");
				if($qry){
					$this->settings->set_flashdata('success','City successfully saved.');
					return 1;
				}else{
					return 2;
				}
			}

		}else{
			$chk = $this->conn->query("SELECT * FROM city_list where code = '$code' and id != $id")->num_rows;
			if($chk > 0){
				return 3;
			}else{
				$qry = $this->conn->query("UPDATE city_list set $data where id = {$id}");
				if($qry){
					$this->settings->set_flashdata('success','City successfully updated.');
					return 1;
				}else{
					return "INSERT INTO city_list set {$data}";
				}
			}
			
		}
	}
	public function delete_city(){
		extract($_POST);
		$qry = $this->conn->query("DELETE FROM city_list where id = $id");
		if($qry){
			$this->settings->set_flashdata('success','City successfully deleted.');
			return 1;
		}else{
			return false;
		}
	}
}

$city = new city();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save':
		echo $city->save_city();
	break;
	case 'delete':
		echo $city->delete_city();
	break;
	default:
		// echo $sysset->index();
		break;
}