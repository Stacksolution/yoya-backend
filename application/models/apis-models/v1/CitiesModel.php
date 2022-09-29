<?php defined('BASEPATH') OR exit('No direct script access allowed');
class CitiesModel extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function find_cites_by_name($keywords){
		try {
			$this->db->select('*');
			$this->db->from($this->db->dbprefix('cities'));
			$this->db->like('city_name',$keywords);
			$return = $this->db->get();
			return $return;
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}

	public function fetch_single($where = null){
		try {
			$this->db->select('*');
			$this->db->from($this->db->dbprefix('cities'));
			if(!empty($where)){
				$this->db->where($where);
			}
			$return = $this->db->get();
			return $return;
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}
}