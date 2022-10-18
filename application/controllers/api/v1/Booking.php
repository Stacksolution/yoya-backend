<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/api-libraries/API_Controller.php'; // for load rest controller

class Booking extends API_Controller {
    /**
	 * @method : index()
	 * @date : 2022-07-23
	 * @about: This method use for fetch booking details
	 * */
	 public function index(){
	    try
    	{
    	    $this->_apiConfig([
	            'methods' => ['POST'],
	            'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
	        $post = json_decode(file_get_contents('php://input'));
	        if(empty($post->booking_id) || !isset($post->booking_id)){
		        $this->api_return(array('status' =>false,'message' => lang('error_booking_id_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        $booking_id = $post->booking_id;
	        $result = $this->BookingModel->fetch_booking(array('booking_id'=>$booking_id));
	        if(!empty($result)){
	            $this->api_return(array('status' =>true,'message' => lang('data_found'),'data'=>$result),self::HTTP_OK);exit();
	        }else{
	            $this->api_return(array('status' =>false,'message' => lang('data_not_found')),self::HTTP_OK);exit();
	        }
    	}catch (Exception $e) {
   		 	$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
		}
	 }
	 /**
	 * @method : booking_by_request()
	 * @date : 2022-07-23
	 * @about: This method use for fetch booking details
	 * */
	 public function booking_by_request(){
	    try
    	{
    	    $this->_apiConfig([
	            'methods' => ['POST'],
	            'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
	        $post = json_decode(file_get_contents('php://input'));
	        if(empty($post->request_id) || !isset($post->request_id)){
		        $this->api_return(array('status' =>false,'message' => lang('error_request_id_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        $request_id = $post->request_id;
	        $result = $this->BookingModel->fetch_booking(array('booking_request_id'=>$request_id));
	        if(!empty($result)){
	            $this->api_return(array('status' =>true,'message' => lang('data_found'),'data'=>$result),self::HTTP_OK);exit();
	        }else{
	            $this->api_return(array('status' =>false,'message' => lang('data_not_found')),self::HTTP_OK);exit();
	        }
    	}catch (Exception $e) {
   		 	$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
		}
	 }
	/**
	 * @method : start()
	 * @date : 2022-07-12
	 * @about: This method use for start bokking
	 * */
	 public function start(){
	     try
    	{	
    		$this->_apiConfig([
	            'methods' => ['POST'],
	            'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
	        $post = json_decode(file_get_contents('php://input'));
	        if(empty($post->request_id) || !isset($post->request_id)){
		        $this->api_return(array('status' =>false,'message' => lang('error_request_id_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->pickup_longitude) || !isset($post->pickup_longitude)){
		        $this->api_return(array('status' =>false,'message' => lang('error_pickup_longitude_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->pickup_latitude) || !isset($post->pickup_latitude)){
		        $this->api_return(array('status' =>false,'message' => lang('error_pickup_latitude_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->booking_otp) || !isset($post->booking_otp)){
		        $this->api_return(array('status' =>false,'message' => lang('error_otp_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        
	        $request_id = $post->request_id;
	       
	        $result = $this->BookingModel->fetch_booking(array('booking_request_id'=>$request_id));
	        if(empty($result)){
	            $this->api_return(array('status' =>false,'message' => lang('data_not_found')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if($result->booking_otp == $post->booking_otp){
	            $booking_status = $this->BookingModel->booking_status('booking_started',$result->booking_id);
	            
	            $chekpoint = $this->BookingModel->check_location_distance_point(array('booking_id'=>$result->booking_id,'booking_pickup_latitude'=>$post->pickup_latitude,'booking_pickup_longitude'=>$post->pickup_longitude));
    	        if($chekpoint->num_rows() <= 0){
    	             //$this->api_return(array('status' =>false,'message' => 'You are not at pickup location. Kindly reach at puckup location to pickup the booking !'),self::HTTP_OK);exit;
    	        }
    	        
    	        $booking['booking_status'] = $booking_status['status'];
    	        $booking['booking_display_status'] = $booking_status['display_status'];
    	        $booking['booking_status_history'] = $booking_status['history'];
    	        if($this->BookingModel->update(array('booking_id'=>$result->booking_id),$booking)){
    	             $result = $this->BookingModel->fetch_booking(array('booking_id'=>$result->booking_id));
    	             $this->api_return(array('status' =>true,'message' => lang('booking_start'),'booking_id'=>$result->booking_id),self::HTTP_OK);exit();
    	        }else{
    	            $this->api_return(array('status' =>false,'message' => lang('server_error')),self::HTTP_OK);exit();
    	        } 
	        }else{
	            $this->api_return(array('status' =>false,'message' => lang('error_otp_invaild')),self::HTTP_OK);exit();
	        }
    	}catch (Exception $e) {
   		 	$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
		}
	 }
	 /**
	 * @method : complete()
	 * @date : 2022-07-18
	 * @about: This method use for complte booking
	 * 
	 * */
	 public function complete(){
	     try
    	{	
    		$this->_apiConfig([
	            'methods' => ['POST'],
	            'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
	        $post = json_decode(file_get_contents('php://input'));
	        if(empty($post->booking_id) || !isset($post->booking_id)){
		        $this->api_return(array('status' =>false,'message' => lang('error_booking_id_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->pickup_longitude) || !isset($post->pickup_longitude)){
		        $this->api_return(array('status' =>false,'message' => lang('error_pickup_longitude_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->pickup_latitude) || !isset($post->pickup_latitude)){
		        $this->api_return(array('status' =>false,'message' => lang('error_pickup_latitude_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        
	        $booking_id = $post->booking_id;
	        $booking_status = $this->BookingModel->booking_status('booking_completed',$booking_id);
	        
	        $result = $this->BookingModel->fetch_booking(array('booking_id'=>$booking_id));
	        $request_data['request_status'] = 4; //request is complete
	        $this->RequestModel->update(array('request_id'=>$result->booking_request_id),$request_data);
	        $taxes  = $this->TaxesModel->fetch_taxes(array('tax_country_id'=>$result->booking_pickup_country_id))->result();
	        
	        $booking['booking_status'] = $booking_status['status'];
	        $booking['booking_display_status'] = $booking_status['display_status'];
	        $booking['booking_status_history'] = $booking_status['history'];
	        
	        //booking total calculation with extra time and Other charge
	        $booking_amount = $result->booking_total_amount;
	        $coupon_amount  = $result->booking_coupon_amount;
	        $discountable_amount = $booking_amount - $coupon_amount;
	      
	        //total booking amount in search time 
    
	        //get cuntry details 
	        $country = $this->CountryModel->_fetch_single(array('country_id'=>$result->booking_pickup_country_id));
	        $courrency_code = currency_symbols(@$country->country_currency_symbols);
	        //get cuntry details 
	        
	        $amount_details = [
	        	array(
	        		'label'=>'Trip Charge',
	        		'value'=>$courrency_code.(string)round($booking_amount),
	        		'is_customer_visible'=>true,
	        		'is_driver_visible'=>true
	        	)
	        ];
	        //if apply discount this booking
	        if($coupon_amount > 0){
	            array_push(
	            	$amount_details,
	            	array(
	            		'label'=>'Trip Discount',
	            		'value'=>$courrency_code.(string)round($coupon_amount),
	            		'is_customer_visible'=>true,
	            		'is_driver_visible'=>false
	            	)
	            );
	        }
	        //tax apply this booking
	        if(count($taxes) > 0){
	            array_push(
	            	$amount_details,
	            	array(
	            		'label'=>'Befor Tax',
	            		'value'=>$courrency_code.(string)round($discountable_amount),
	            		'is_customer_visible'=>true,
	            		'is_driver_visible'=>true
	            	)
	            );
	        }
	        $calculate_tax = 0;
	        $taxes_amount  = 0;
	        foreach($taxes as $key => $data){
	            $calculate_tax = round($discountable_amount / 100 * $data->tax_rate);
	            $taxes_amount  += $calculate_tax;
	            array_push(
	            	$amount_details,
	            	array(
	            		'label'=>$data->tax_name,
	            		'value'=>$courrency_code.(string)round($calculate_tax),
	            		'is_customer_visible'=>true,
	            		'is_driver_visible'=>true
	            	)
	            );
	        }

	        array_push(
	        	$amount_details,
	        	array(
	        		'label'=>'Subtotal',
	        		'value'=>$courrency_code.(string)round($discountable_amount + $taxes_amount),
	        		'is_customer_visible'=>true,
	        		'is_driver_visible'=>true
	        	)
	        );
        
	        $booking['booking_amount_details'] = json_encode($amount_details);
	        $booking['booking_tax_amount']     = $taxes_amount;
	        if($this->BookingModel->update(array('booking_id'=>$booking_id),$booking)){
	            //settelment booking amount start
	            $result = $this->BookingModel->fetch_booking(array('booking_id'=>$booking_id));
	            $this->booking_amount_settelment($result);
	            //settelment booking amount end
	            $this->api_return(array('status' =>true,'message' => lang('booking_completed'),'data'=>$result),self::HTTP_OK);exit();
	        }else{
	            $this->api_return(array('status' =>false,'message' => lang('server_error')),self::HTTP_OK);exit();
	        } 
    	}catch (Exception $e) {
   		 	$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
		}
	 }
	 
	 public function booking_amount_settelment($result){
	     $payment_modes = json_decode($result->booking_payments_mode);
	     if(in_array('cash',$payment_modes)){
	         $this->WalletsModel->applied_service_charge($result);
	     }else if(in_array('wallets',$payment_modes)){
	         $this->WalletsModel->applied_service_charge($result);
	         $this->WalletsModel->settelment_booking_amount($result);
	         $this->WalletsModel->pay_booking_amount($result);
	     }
	 }
	 /**
	 * @method : cancel()
	 * @date : 2022-07-19
	 * @about: This method use for cancel booking
	 * */
	 public function cancel(){
	     try
    	{	
    		$this->_apiConfig([
	            'methods' => ['POST'],
	            //'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
	        $post = json_decode(file_get_contents('php://input'));
	        if(empty($post->booking_id) || !isset($post->booking_id)){
		        $this->api_return(array('status' =>false,'message' => lang('error_booking_id_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->pickup_longitude) || !isset($post->pickup_longitude)){
		        $this->api_return(array('status' =>false,'message' => lang('error_pickup_longitude_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->pickup_latitude) || !isset($post->pickup_latitude)){
		        $this->api_return(array('status' =>false,'message' => lang('error_pickup_latitude_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->cancelled_by) || !isset($post->cancelled_by)){
		        $this->api_return(array('status' =>false,'message' => 'cancelled By missing or empty !'),self::HTTP_BAD_REQUEST);exit();
	        }
	        
	        $booking_id = $post->booking_id;
	        if($post->cancelled_by == 'driver'){
	            $booking_status = $this->BookingModel->booking_status('booking_cancel_by_driver',$booking_id);
	        }else{
	            $booking_status = $this->BookingModel->booking_status('booking_cancel_by_customer',$booking_id);
	        }
	        $result = $this->BookingModel->fetch_booking(array('booking_id'=>$booking_id));
	        $request_data['request_status'] = 3; //request is cancel
	        $this->RequestModel->update(array('request_id'=>$result->booking_request_id),$request_data);
	        //booking total calculation with extra time and Other charge
	        $taxes  = $this->TaxesModel->fetch_taxes(array('tax_country_id'=>$result->booking_pickup_country_id))->result();
	        $booking_amount = $result->booking_total_amount;
	        $coupon_amount  = $result->booking_coupon_amount;
	        $discountable_amount = $booking_amount - $coupon_amount;
	        
	        //total booking amount in search time 

	        //get cuntry details 
	        $country = $this->CountryModel->_fetch_single(array('country_id'=>$result->booking_pickup_country_id));
	        $currency_symbols = currency_symbols(@$country->country_currency_symbols);
	        //get cuntry details 

	        $amount_details = [
	        	array(
	        		'label'=>'Trip Charge',
	        		'value'=>$currency_symbols.(string)round($booking_amount),
	        		'is_customer_visible'=>true,
	        		'is_driver_visible'=>true
	        	)
	        ];
	        //if apply discount this booking
	        if($coupon_amount > 0){
	            array_push($amount_details,
	            	array(
	            		'label'=>'Trip Discount',
	            		'value'=>$currency_symbols.(string)round($coupon_amount),
	            		'is_customer_visible'=>true,
	            		'is_driver_visible'=>false
	            	)
	            );
	        }
	        //tax apply this booking
	        if(count($taxes) > 0){
	            array_push($amount_details,
	            	array(
	            		'label'=>'Befor Tax',
	            		'value'=>$currency_symbols.(string)round($discountable_amount),
	            		'is_customer_visible'=>true,
	            		'is_driver_visible'=>true
	            	)
	            );
	        }
	        $calculate_tax = 0;
	        $taxes_amount  = 0;
	        foreach($taxes as $key => $data){
	            $calculate_tax = round($discountable_amount / 100 * $data->tax_rate);
	            $taxes_amount  += $calculate_tax;
	            array_push($amount_details,
	            	array(
	            		'label'=>$data->tax_name,
	            		'value'=>$currency_symbols.(string)round($calculate_tax),
	            		'is_customer_visible'=>true,
	            		'is_driver_visible'=>true
	            	)
	            );
	        }
	        
	        if($post->cancelled_by == 'driver'){
	            array_push($amount_details,
	            	array(
	            		'label'=>'Cancel Charge',
	            		'value'=>$currency_symbols.'0',
	            		'is_customer_visible'=>false,
	            		'is_driver_visible'=>true
	            	)
	            );
	        }else{
	            array_push($amount_details,
	            	array(
	            		'label'=>'Cancel Charge',
	            		'value'=>$currency_symbols.'0',
	            		'is_customer_visible'=>true,
	            		'is_driver_visible'=>false
	            	)
	            );
	        }
	        
	        array_push($amount_details,
	        	array(
	        		'label'=>'Subtotal',
	        		'value'=>$currency_symbols.(string)round($discountable_amount + $taxes_amount),
	        		'is_customer_visible'=>true,
	        		'is_driver_visible'=>true
	        	)
	        );
	        
	        $booking['booking_amount_details'] = json_encode($amount_details);
	        $booking['booking_tax_amount']     = $taxes_amount;
	        
	        $booking['booking_status'] = $booking_status['status'];
	        $booking['booking_display_status'] = $booking_status['display_status'];
	        $booking['booking_status_history'] = $booking_status['history'];
	        $booking['booking_cancelled_by'] = $post->cancelled_by;
	        
	        
	   
	        if($this->BookingModel->update(array('booking_id'=>$booking_id),$booking)){
	            $this->api_return(array('status' =>true,'message' => lang('booking_cancelled')),self::HTTP_OK);exit();
	        }else{
	            $this->api_return(array('status' =>false,'message' => lang('server_error')),self::HTTP_OK);exit();
	        } 
    	}catch (Exception $e) {
   		 	$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
		}
	}
	/**
	 * @method : driver_booking_complete()
	 * @date : 2022-07-22
	 * @about: This method use for fetch all booking by driver id
	 * */
	 public function driver_booking_complete(){
	     try
    	{	
    		$this->_apiConfig([
	            'methods' => ['POST'],
	            'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
	        $post = json_decode(file_get_contents('php://input'));
	        if(empty($post->user_id) || !isset($post->user_id)){
		        $this->api_return(array('status' =>false,'message' => lang('error_user_id_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        $result = $this->BookingModel->fetch_all_booking(array('booking_driver_id'=>$post->user_id,));
	        if($result->num_rows() > 0){
	            $this->api_return(array('status' =>false,'message' => lang('data_found'),'data'=>$result->result()),self::HTTP_OK);exit();
	        }else{
	            $this->api_return(array('status' =>false,'message' => lang('data_not_found')),self::HTTP_OK);exit();
	        }
    	}catch (Exception $e) {
   		 	$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
		}
	 }
	 /**
	 * @method : customer_booking_complete()
	 * @date : 2022-07-22
	 * @about: This method use for fetch all booking by user id
	 * */
	 public function customer_booking_complete(){
	     try
    	{	
    		$this->_apiConfig([
	            'methods' => ['POST'],
	            'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
	        $post = json_decode(file_get_contents('php://input'));
	        if(empty($post->user_id) || !isset($post->user_id)){
		        $this->api_return(array('status' =>false,'message' => lang('error_user_id_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        $result = $this->BookingModel->fetch_all_booking(array('booking_user_id'=>$post->user_id,));
	        if($result->num_rows() > 0){
	            $this->api_return(array('status' =>false,'message' => lang('data_found'),'data'=>$result->result()),self::HTTP_OK);exit();
	        }else{
	            $this->api_return(array('status' =>false,'message' => lang('data_not_found')),self::HTTP_OK);exit();
	        }
    	}catch (Exception $e) {
   		 	$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
		}
	 }
}