<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/api-libraries/API_Controller.php'; // for load rest controller

class Rental extends API_Controller {
	/**
	 * @method : packages()
	 * @date : 2022-09-25
	 * @about: This method use for fetch packages list
	 * 
	 * */
	public function packages(){
		try
    	{	
    		$this->_apiConfig([
	            'methods' => ['GET'],
	            //'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
    		$results = $this->RentalModel->fetch_all();
    		if($results->num_rows() <= 0){
    			$this->api_return(array('status' =>false,'message' =>lang('data_not_found')),self::HTTP_NOT_FOUND);exit();
    		}
    		$this->api_return(array('status' =>true,'message' =>lang('data_found'),"data"=>$results->result()),self::HTTP_OK);exit();
    	}catch (Exception $e) {
   		 	$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
		}
	}

	/**
	 * @method : vehicles()
	 * @date : 2022-09-27
	 * @about: This method use for fetch vehicles fare list
	 * 
	 * */
	public function vehicles(){
		try
    	{	
    		$this->_apiConfig([
	            'methods' => ['POST'],
	            //'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
    		$post = json_decode(file_get_contents('php://input'));
	        if(empty($post->city_name) || !isset($post->city_name)){
		        $this->api_return(array('status' =>false,'message' => lang('error_pickup_city_missing')),self::HTTP_BAD_REQUEST);exit();
	        }

	        $city_name = strtolower($post->city_name);
	        $find_cities = $this->CitiesModel->find_cites_by_name($city_name);
	        if($find_cities->num_rows() <= 0){
	        	$this->api_return(array('status' =>true,'message' => lang('data_not_found'),'data'=>array()),self::HTTP_OK);exit();
	        }
	        $city_id = $find_cities->row()->city_id;

	        $result = $this->RentalFareModel->fetch_packages_fare(array('fare_city_id'=>$city_id));
	        if(empty($result)){
	        	$this->api_return(array('status' =>true,'message' => lang('data_not_found'),'data'=>array()),self::HTTP_OK);exit();
	        }
	        $this->api_return(array('status' =>true,'message' => lang('data_found'),'data'=>$result),self::HTTP_OK);exit();
    	}catch(Exception $e){
    		$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
    	}
	}

	/**
	 * @method : request()
	 * @date : 2022-09-27
	 * @about: This method use for send request for rental
	 * 
	 * */
	public function request(){
		try
    	{	
    		$this->_apiConfig([
	            'methods' => ['POST'],
	            //'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
    		$post = json_decode(file_get_contents('php://input'));
            if (empty($post->user_id) || !isset($post->user_id)) {
                $this->api_return(array('status' => false, 'message' => lang('error_user_id_missing')), self::HTTP_BAD_REQUEST);
                exit();
            }
            if (empty($post->pickup_latitude) || !isset($post->pickup_latitude)) {
                $this->api_return(array('status' => false, 'message' => lang('error_pickup_latitude_missing')), self::HTTP_BAD_REQUEST);
                exit();
            }
            if (empty($post->pickup_longitude) || !isset($post->pickup_longitude)) {
                $this->api_return(array('status' => false, 'message' => lang('error_pickup_longitude_missing')), self::HTTP_BAD_REQUEST);
                exit();
            }
            if (empty($post->pickup_address) || !isset($post->pickup_address)) {
                $this->api_return(array('status' => false, 'message' => lang('error_pickup_address_missing')), self::HTTP_BAD_REQUEST);
                exit();
            }
            if (empty($post->pickup_city) || !isset($post->pickup_city)) {
                $this->api_return(array('status' => false, 'message' => lang('error_pickup_city_missing')), self::HTTP_BAD_REQUEST);
                exit();
            }
            if(empty($post->payment_method) || !isset($post->payment_method)){
		        $this->api_return(array('status' =>false,'message' => lang('error_payment_mode_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->booking_date) || !isset($post->booking_date)){
		        $this->api_return(array('status' =>false,'message' => lang('error_booking_date_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->vehicle_id) || !isset($post->vehicle_id)){
		        $this->api_return(array('status' =>false,'message' => lang('error_vehicle_type_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->city_id) || !isset($post->city_id)){
		        $this->api_return(array('status' =>false,'message' => lang('error_vehicle_type_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        $city_id = $post->city_id;
	        //fetch city id by city name this city id use for fetch city wise price 
	        //get and apply for ride fare 
	        $cities = $this->CitiesModel->fetch_single(array('city_id'=>$city_id))->row();
	        if(empty($cities)){
	        	$this->api_return(array('status' =>false,'message' => lang('error_service_not_available')),self::HTTP_BAD_REQUEST);exit();
	        }
	        //fetch single package details 
	        $rental_id = $post->rental_id;
	        $rental = $this->RentalModel->fetch_single(array('rental_id'=>$rental_id));
	        if(empty($cities)){
	        	$this->api_return(array('status' =>false,'message' =>"invalid rental package id !"),self::HTTP_BAD_REQUEST);exit();
	        }
	        //get package fare 
	        $result = $this->RentalFareModel->fetch_single(
	        	array(
	        		'fare_city_id'=>$city_id,
	        		'fare_rental_id'=>$rental_id
	        	)
	        );
	        if(empty($result)){
	        	$this->api_return(array('status' =>false,'message' =>"fare data not found !"),self::HTTP_BAD_REQUEST);exit();
	        }
	        $total_distance = $rental->rental_distance_value;
	        $total_time  	= $rental->rental_hour_value * 60; //canvert hour to minutes
	        $base_price = $result->fare_base_price;
			$country_id  = $result->country->country_id;
			//amount details manipulation
			$total_amount = $base_price;
			$courrency_code = currency_symbols(@$result->country->country_currency_symbols);
			$amount_details = [
	        	array(
	        		'label'=>'Base Fare',
	        		'value'=>$courrency_code.(string)round($result->fare_base_price),
	        		'is_customer_visible'=>true,
	        		'is_driver_visible'=>true
	        	)
	        ];
			$taxes  = $this->TaxesModel->fetch_taxes(array('tax_country_id'=>$country_id))->result();
			//tax apply this booking
	        $calculate_tax = 0;
	        $taxes_amount  = 0;
	        foreach($taxes as $key => $data){
	            $calculate_tax = round($total_amount / 100 * $data->tax_rate);
	            $taxes_amount  += $calculate_tax;
	        }
			if($taxes_amount > 0){
				array_push(
					$amount_details,
					array(
						'label'=>'Taxes',
						'value'=>$courrency_code.(string)round($taxes_amount),
						'is_customer_visible'=>true,
						'is_driver_visible'=>false
					)
				);
			}
			$request_data['request_amout_details'] = json_encode($amount_details);
	        //store a search request 
			$users = $this->UsersModel->fetch_user_data_for_request_by_id($post->user_id);
            $request_data['request_user_details'] = json_encode($users);
	        $request_data['request_user_id'] = $post->user_id;
	        $request_data['request_pickup_latitude'] = $post->pickup_latitude;
	        $request_data['request_pickup_longitude'] = $post->pickup_longitude;
	        $request_data['request_pickup_address'] = $post->pickup_address;
	        $request_data['request_pickup_city'] = $post->pickup_city;
	        $request_data['request_pickup_city_id'] = $cities->city_id;
	        $request_data['request_pickup_state_id'] = $cities->city_state_id;
	        $request_data['request_pickup_country_id'] = $cities->city_country_id;
	        $request_data['request_distance_value'] = $total_distance;
	        $request_data['request_distance_text'] = $total_distance .' Km.';
	        $request_data['request_time_text'] = $total_time . ' minutes';
	        $request_data['request_time_value'] = $total_time;
	        $request_data['request_vehicle_id']   = $post->vehicle_id;
	        $request_data['request_payments_mode']   = json_encode($post->payment_method);
	        $request_data['request_total_amount'] = $base_price;
	        $request_data['request_package_details'] = json_encode(array('rental_id'=>$rental_id,'city_id'=>$city_id));
	        $request_data['request_mode'] = 'rental';
	        $request_data['request_booking_type'] = 'current_ride';
	        $request_data['request_booking_date'] = $post->booking_date;
	        $request_data['request_status'] = 1;
			
	        if($request_id = $this->RequestModel->save($request_data)){
	        	if(in_array('cash',$post->payment_method,true)){
		        	/*==============================================
		        	  ===================send request===============*/
		        	  $this->under_radius_send_request($request_id);
		        	/*==============================================
		        	  ===================send request===============*/
		        	$result = $this->RequestModel->fetch_single(array('request_id'=>$request_id));
	        		$this->api_return(array('status' =>true,'message' => lang('ride_request_send'),'data'=>$result,'request_id'=>$request_id),self::HTTP_OK);exit();
		        }else{
		        	$this->api_return(array('status' =>false,'message' =>lang('server_error')),self::HTTP_SERVER_ERROR);exit();
		        }
	        }else{
	        	$this->api_return(array('status' =>false,'message' => lang('server_error')),self::HTTP_SERVER_ERROR);exit();
	        }
    	}catch(Exception $e){
    		$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
    	}
    }
    /**
	 * @method : under_radius_send_request()
	 * @date : 2022-06-30
	 * @about: This method use for send request 
	 * */
	public function under_radius_send_request($request_id){
		$result = $this->RequestModel->fetch_single(array('request_id'=>$request_id));
		$pickup_latitude = $result->request_pickup_latitude;
		$pickup_longitude= $result->request_pickup_longitude;
		$vehicle_id      = $result->request_vehicle_id;

		$drivers = $this->DriverModel->under_radius_driver(
			$pickup_latitude,
			$pickup_longitude,
			$vehicle_id
		);

		$request_log   = array();
		$tokens   = array();
		foreach($drivers->result() as $key => $data){
	        array_push($tokens,$data->user_devoice_token);
	        array_push($request_log,array(
	        	'log_request_id'=>$request_id,
	        	'log_user_id'=>$data->user_id,
	        	'log_user_name'=>$data->user_name,
	        	'log_create_at'=>date("Y-m-d H:i:s"),
	        	'log_user_by'=>$result->request_user_id
	        ));
		}
		
		if(!empty($tokens)){
		    $this->load->library('pushnotification/pushnotification');
    	    $config['notification_serverkey'] = $this->data['config']['google_fcm_key'];
    	    $this->pushnotification->initialize($config);
    		$this->pushnotification->subject("New Ride Request Recived !");
    	        $this->pushnotification->message("New Ride Request Recived !");
    	        $this->pushnotification->data(
    	                array(
    	                    "click_action"  =>"FLUTTER_NOTIFICATION_CLICK",
    	                    "sound"         =>"default", 
    	                    "screen" 		=>"",
    	                    "data_id"		=>$request_id,
    	                ));
    	    $this->pushnotification->sendMultiple($tokens);
		}
		if(!empty($request_log)){
		    $this->RequestLogModel->insert_batch($request_log);
		}
	}
	/**
	 * @method : accepte()
	 * @date : 2022-10-14
	 * @about: This method use for accepte driver request
	 * */
	public function accepte(){
		try
    	{
    		$this->_apiConfig([
	            'methods' => ['POST'],
	            //'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
	        $post = json_decode(file_get_contents('php://input'));
    		if(empty($post->user_id) || !isset($post->user_id)){
		        $this->api_return(array('status' =>false,'message' => lang('error_user_id_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        if(empty($post->request_id) || !isset($post->request_id)){
		        $this->api_return(array('status' =>false,'message' => lang('error_request_id_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
	        //check request se
	        if(!$this->RequestModel->is_exist(array('request_id'=>$post->request_id))){
	        	$this->api_return(array('status' =>false,'message' => lang('data_not_found')),self::HTTP_BAD_REQUEST);exit();
	        }
	        
	        $checkrequest = $this->BookingModel->fetch_booking(array('booking_request_id'=>$post->request_id));
	        if(!empty($checkrequest)){
	            $this->api_return(array('status' =>false,'message' => "Booking Already Accepted !"),self::HTTP_OK);exit();
	        }
	        
	        $booking_status = $this->BookingModel->booking_status('booking_accepted');
	        $booking_id = $this->BookingModel->booking_id_ganrate();
	        $request = $this->RequestModel->fetch_single(array('request_id'=>$post->request_id));
	        $driver_details = $this->UsersModel->fetch_user_data_for_request_by_id($post->user_id);
	        
	        $request_data['request_status'] = 2; //for request is accepted or search
		    $this->RequestModel->update(array('request_id'=>$post->request_id),$request_data);
		        
	        $booking['booking_order_id'] = $booking_id;
	        $booking['booking_user_id'] = $request->request_user_id;
	        $booking['booking_driver_id'] = $post->user_id;
	        $booking['booking_driver_details'] = json_encode($driver_details);
	        $booking['booking_vehicle_id'] = $request->request_vehicle_id;
	        $booking['booking_process_id'] = $request->request_process_id;
	        $booking['booking_user_details'] = $request->request_user_details;
	        $booking['booking_total_amount'] = $request->request_total_amount;
	        $booking['booking_amount_details'] = $request->request_coupon_details;
	        $booking['booking_pickup_latitude'] = $request->request_pickup_latitude;
	        $booking['booking_pickup_longitude'] = $request->request_pickup_longitude;
	        $booking['booking_pickup_city'] = $request->request_pickup_city;
	        $booking['booking_pickup_city_id']    = $request->request_pickup_city_id;
	        $booking['booking_pickup_state_id']   = $request->request_pickup_state_id;
	        $booking['booking_pickup_country_id'] = $request->request_pickup_country_id;
	        $booking['booking_pickup_address'] = $request->request_pickup_address;
	        $booking['booking_distance_value'] = $request->request_distance_value;
	        $booking['booking_distance_text'] = $request->request_distance_text;
	        $booking['booking_time_value'] = $request->request_time_value;
	        $booking['booking_time_text'] = $request->request_time_text;
	        $booking['booking_payments_status'] = $request->request_payments_status;
	        $booking['booking_payments_mode'] = $request->request_payments_mode;
	        $booking['booking_transaction_id'] = $request->request_transaction_id;
	        $booking['booking_booking_date'] = $request->request_booking_date;
	        $booking['booking_types'] = $request->request_booking_type;
	        $booking['booking_status'] = $booking_status['status'];
	        $booking['booking_display_status'] = $booking_status['display_status'];
	        $booking['booking_status_history'] = $booking_status['history'];
	        $booking['booking_otp'] = otp_generate(4);
	        $booking['booking_request_id']  = $request->request_id;
	        if($booking_id = $this->BookingModel->save($booking)){
	            foreach($request->request_drop_locations as $key => $data){
		        	$drop['drop_latitude'] = $data->drop_latitude;
			        $drop['drop_longitude'] = $data->drop_longitude;
			        $drop['drop_distance_addresses'] = $data->drop_distance_addresses;
			        $drop['drop_city'] = $data->drop_city;
			        $drop['drop_time_value'] = $data->drop_time_value;
			        $drop['drop_time_text'] = $data->drop_time_text;
			        $drop['drop_distance_value'] = $data->drop_distance_value;
			        $drop['drop_distance_text'] = $data->drop_distance_text;
			        $drop['drop_booking_id'] = $booking_id;
			        $this->BookingDropModel->save($drop);
		        }
	            $result = $this->BookingModel->fetch_booking(array('booking_id'=>$booking_id));
	            $this->api_return(array('status' =>true,'message' => lang('request_accepted'),'data'=>$result),self::HTTP_OK);exit();
	        }else{
	            $this->api_return(array('status' =>false,'message' => lang('server_error')),self::HTTP_OK);exit();
	        }
	    }catch (Exception $e) {
   		 	$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
		}
	}
	/**
    * @method : cancel()
    * @date : 2022-10-14
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
}