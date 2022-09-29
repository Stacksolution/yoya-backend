<?php defined('BASEPATH') OR exit('No direct script access allowed');
class WalletModel extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function fetch_all_where($where){
		try {
			$this->db->select('*');
			$this->db->from($this->db->dbprefix('wallets'));
			$this->db->order_by('wallet_id','desc');
			$this->db->where($where);
			$return = $this->db->get();
			return $return;
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}
	
}