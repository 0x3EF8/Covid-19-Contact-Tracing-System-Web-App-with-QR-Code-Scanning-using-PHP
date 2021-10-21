<?php
require_once('../config.php');
Class Main extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function track(){
		extract($_POST);
		$code_chk = $this->conn->query("SELECT * FROM people where code = '$pcode'")->num_rows;
		if($code_chk <= 0){
			return 3;
		}else{
			$pid = $this->conn->query("SELECT * FROM people where code = '$pcode'")->fetch_array()['id'];
			$eid = $this->conn->query("SELECT * FROM establishment where code = '$ecode'")->fetch_array()['id'];
			$qry = $this->conn->query("INSERT INTO tracks set person_id = '{$pid}',establishment_id = '{$eid}' ");
			if($qry){
				return 1;
			}else{
				return 2;
			}
		}
	}
}

$main = new main();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'track':
		echo $main->track();
	break;
	default:
		// echo $sysset->index();
		break;
}