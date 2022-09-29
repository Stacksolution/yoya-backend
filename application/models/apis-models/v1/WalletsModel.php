<?php defined('BASEPATH') OR exit('No direct script access allowed');
class WalletsModel extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function balance($where){
		try {
		    $this->db->select('(case when wallet_transaction_type="1" then wallet_amount else -wallet_amount end) as balance');
		   	$this->db->where($where);
		   	$this->db->where('wallet_status','1');
			$return = $this->db->get($this->db->dbprefix('wallets'));
			$balance = 0;
			if($return->num_rows() > 0){
				$balance = $return->row()->balance;
			}

			return $balance;
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}

	public function save($data){
		try {
		    $this->db->set('wallet_create_at',date('Y-m-d H:i:s'));
		    $this->db->set('wallet_update_at',date('Y-m-d H:i:s'));
			$return = $this->db->insert($this->db->dbprefix('wallets'),$data);
			return $this->db->insert_id();
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}

	public function update($where,$data){
		try {
		    $this->db->set('wallet_update_at',date('Y-m-d H:i:s'));
			return $this->db->where($where)->update($this->db->dbprefix('wallets'),$data);
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}
	
	public function pay_booking_amount($request){
	    try {
	        $booking_amount = ($request->booking_total_amount + $request->booking_tax_amount) - $request->booking_coupon_amount;
	        $wallet['wallet_amount']  = $booking_amount; 
	        $wallet['wallet_description'] = 'Trip charge !';
	        $wallet['wallet_transaction_type'] = 0;
	        $wallet['wallet_status'] = 1;
	        $wallet['wallet_user_id'] = $request->booking_user_id;
	        $wallet['wallet_uses'] = 'pay_booking_amount';
	        $this->save($wallet);
	        return $this->db->insert_id();
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}
	
	public function applied_service_charge($request){
	    try {
	        $vehicle  = $this->VehicleModel->fetch_vehicle_for_ride_where(array('fare_vehicle_id'=>1,'fare_city_id'=>$request->booking_pickup_city_id));
	        $fare_commission = 0;
	        if($vehicle->num_rows() > 0 ){
	            $fare_commission = $vehicle->row()->fare_commission;
	        }
	        
	        $service_charge = $request->booking_total_amount / 100 * $fare_commission;
	        $wallet['wallet_amount']  = $service_charge;
	        $wallet['wallet_description'] = 'Service charge !';
	        $wallet['wallet_transaction_type'] = 0;
	        $wallet['wallet_status'] = 1;
	        $wallet['wallet_user_id'] = $request->booking_driver_id;
	        $wallet['wallet_uses'] = 'applied_service_charge';
	        $this->save($wallet);
	        return $this->db->insert_id();
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}
	
	public function settelment_booking_amount($request){
	    try {
		    $wallet['wallet_amount']  = $request->booking_total_amount;
	        $wallet['wallet_description'] = 'Trip amount received !';
	        $wallet['wallet_transaction_type'] = 1;
	        $wallet['wallet_status'] = 1;
	        $wallet['wallet_user_id'] = $request->booking_driver_id;
	        $wallet['wallet_uses'] = 'settelment_booking_amount';
	        $this->save($wallet);
	        return $this->db->insert_id();
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}
} 