<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/api-libraries/API_Controller.php'; // for load rest controller

class Outstation extends API_Controller {
    /**
	 * @method : cities()
	 * @date : 2022-09-29
	 * @about: This method use for fetch out station city 
	 * */
	 public function cities(){
	     try    
    	{	
    		$this->_apiConfig([
	            'methods' => ['POST'],
	            //'key' => ['header',$this->config->item('api_fixe_header_key')],
	        ]);
            $post = json_decode(file_get_contents('php://input'));
            if(empty($post->pickup_city) || !isset($post->pickup_city)){
		        $this->api_return(array('status' =>false,'message' => lang('error_pickup_city_missing')),self::HTTP_BAD_REQUEST);exit();
	        }
            $origin_city = trim($post->pickup_city);
            $origin_keyword = @trim($post->pickup_keyword);

            $cities = $this->CitiesModel->find_cites_by_name($origin_city)->row();
	        if(empty($cities)){
	            $this->api_return(array('status' =>false,'message' =>lang('server_error')),self::HTTP_SERVER_ERROR);exit();
	        }
            
            //fetch all destination cities by country or by search a key words 
            if($origin_city > 0 && empty($origin_keyword)){
                $result = $this->CitiesModel->fetch_all(array('city_country_id'=>$cities->city_country_id));
            }else if($origin_city > 0 && !empty($origin_keyword)){
                $result = $this->CitiesModel->fetch_all_by_keyword(array('city_country_id'=>$cities->city_country_id),$origin_keyword);
            }
            
            if($result->num_rows() <= 0){
                $this->api_return(array('status' =>true,'message' =>lang('data_found'),'data'=>$result->result()),self::HTTP_OK);exit();
            }

	        $this->api_return(array('status' =>true,'message' =>lang('data_found'),'data'=>$result->result()),self::HTTP_OK);exit();
    	}catch (Exception $e) {
   		 	$this->api_return(array('status' =>false,'message' => $e->getMessage()),self::HTTP_SERVER_ERROR);exit();
		}
	 }
}