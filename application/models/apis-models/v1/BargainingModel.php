<?php defined('BASEPATH') OR exit('No direct script access allowed');

class BargainingModel extends CI_Model {

	function __construct(){
		parent::__construct();
	}

    public function save($data){
		try {
			$this->db->set('bargain_create_at',date('Y-m-d H:i:s'));
			$return = $this->db->insert($this->db->dbprefix('bargaining'),$data);
			return $this->db->insert_id();
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}

	public function update($where,$data){
		try {
			$this->db->set('bargain_create_at',date('Y-m-d H:i:s'));
			return $this->db->where($where)->update($this->db->dbprefix('bargaining'),$data);
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}

	public function fetch_all($where){
		try {
			$this->db->select('*');
			$this->db->from($this->db->dbprefix('bargaining'));
			$this->db->where($where);
			$this->db->order_by('bargain_id','desc');
			$bargaining = $this->db->get();
			return $bargaining;
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}

	public function fetch_single($where){
		try {
			$this->db->select('*');
			$this->db->from($this->db->dbprefix('bargaining'));
			$this->db->where($where);
			$bargaining = $this->db->get()->row();
			return $bargaining;
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}
}