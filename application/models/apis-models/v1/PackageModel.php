<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PackageModel extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function check_location_service($where){
		try {
			$this->db->select('*');
			$this->db->from($this->db->dbprefix('vehicles_package_fare'));
			$this->db->where($where);
			$return = $this->db->get();
			return $return;
		} catch (Exception $e) {
		  log_message('error',$e->getMessage());
		  return;
		}
	}

	public function package_amount_calculate($where,$array){
		$total_distance = $array['total_distance'] ;
		$total_time = $array['total_time'];
		$bookdate = !empty($bookdate) ? $bookdate : date('Y-m-d H:i');
        $bussines_time_tart = date('Y-m-d H:i',strtotime(date('Y-m-d').' 10:00'));
        $bussines_time_end  = date('Y-m-d H:i',strtotime(date('Y-m-d').' 17:00'));
        $night_time_start   = date('Y-m-d H:i',strtotime(date('Y-m-d').' 17:00')); 
        $night_time_end     = date('Y-m-d H:i',strtotime(date('Y-m-d').' 02:00'));
        $booking_start_date = date('Y-m-d H:i',strtotime($bookdate));
        $booking_end_date   = date('Y-m-d H:i',strtotime($bookdate));

        /*=======================get price=====================*/
        $this->db->select('
				vehicle_id,
				vehicle_name,
				vehicle_icon,'.$this->db->dbprefix('vehicles_package_fare').'.*');
		$this->db->from($this->db->dbprefix('vehicles_package_fare'));
		$this->db->join($this->db->dbprefix('vehicles'),$this->db->dbprefix('vehicles').'.vehicle_id ='.$this->db->dbprefix('vehicles_package_fare').'.fare_vehicle_id','left');
		$this->db->where('fare_kilometre_from <',$total_distance);
		$this->db->where('fare_kilometre_to >',$total_distance);
		$this->db->where($where);
		$result = $this->db->get();
		foreach($result->result() as $key => $data){
			$result->result()[$key]->vehicle_icon = image_assets($data->vehicle_icon); 
		}
		
		/*=======================get price=====================*/
		$total_amount = 0;
		foreach($result->result() as $key => $data){
			$result->result()[$key]->fare_total_time   = $total_time;
			if(strtotime($bussines_time_tart) <= strtotime($booking_start_date) && strtotime($bussines_time_end) >= strtotime($booking_end_date)){
				$total_amount = $data->fare_base_price;
			}else if(strtotime($night_time_start) <= strtotime($booking_start_date) && strtotime($booking_end_date) >= strtotime($night_time_end)){
				$total_amount = $data->fare_base_price;
			}else{
	            $total_amount = $data->fare_base_price;
	        }

	        if($data->fare_kilometre_price > 0){
	        	$result->result()[$key]->fare_total_amount = $data->fare_kilometre_price * $total_distance + $data->fare_base_price;
	        }else{
	        	$result->result()[$key]->fare_total_amount = $total_amount;
	        }
	        $result->result()[$key]->fare_total_distance = $total_distance .' Km.';
		}
		return $result;
	}
}