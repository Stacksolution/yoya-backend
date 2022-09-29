<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiclefare extends MY_AdminController {

	public function __construct() {
        parent::__construct(); 
        is_logged_out(); // if user is logout Or session is expired then redirect login
    	$this->data['vehicles'] = $this->VehicleModel->_dropdownlist();
		$this->data['country'] = $this->CountrysModel->_dropdownlist();
    }
    /**
	 * @method : index()
	 * @date : 2022-06-23
	 * @about: This method use for records all vehicle
	 * 
	 * */
	public function index(){
		$this->data['vehiclefare'] = $this->VehiclefareModel->fetch_all_vehiclefare();$this->data['meta'] = array('meta_title'=>'Vehiclefare Manage','meta_description'=>'');
		$this->load->view('back-end/vehiclefare/index-page',$this->data);
	}
	/**
	 * @method : create()
	 * @date : 2022-06-23
	 * @about: This method use for create vehicle
	 * 
	 * */
	public function create(){
	    
        $this->form_validation->set_rules('vehicle_id', 'Vahicle Name', 'required');
		$this->form_validation->set_rules('country_id', 'country name', 'required');
		$this->form_validation->set_rules('state_id',   'state name', 'required');
		$this->form_validation->set_rules('city_id',    'city name', 'required');
		$this->form_validation->set_rules('fare_base_price', 'Base price', 'required');
		$this->form_validation->set_rules('fare_general_price', 'General price', 'required');
		$this->form_validation->set_rules('fare_business_price', 'Business price', 'required');
		$this->form_validation->set_rules('fare_night_price',    'night price', 'required');
		$this->form_validation->set_rules('fare_extra_waiting_price', 'Waiting price', 'required');
		if ($this->form_validation->run() == TRUE){
		    
			$data['fare_vehicle_id']         = $this->input->post('vehicle_id');
			$data['fare_country_id']         = $this->input->post('country_id');
			$data['fare_state_id']           = $this->input->post('state_id');
			$data['fare_city_id']            = $this->input->post('city_id');
			$data['fare_base_price']         = $this->input->post('fare_base_price');
			$data['fare_general_price']      = $this->input->post('fare_general_price');
			$data['fare_business_price']     = $this->input->post('fare_business_price');
			$data['fare_night_price']        = $this->input->post('fare_night_price');
			$data['fare_extra_waiting_price']= $this->input->post('fare_extra_waiting_price');
			$data['fare_stop_price']         = $this->input->post('fare_stop_price');
			$data['fare_commission']         = $this->input->post('fare_commission');
			$data['fare_time_free']          = $this->input->post('fare_time_free');
	     	$data['fare_create_at']          = date('Y-m-d H:i:s');
			if($this->VehiclefareModel->save($data)){
				$this->session->set_flashdata('success','Vahicle Fare successfully created !');
				redirect('admin/vehiclefare');
			}else{
				$this->session->set_flashdata('error','Oops something went wrong please try after some time!');
				redirect('admin/vehiclefare/create');
			}
		}
		$this->data['meta'] = array('meta_title'=>'Vehicle Fare Create','meta_description'=>'');
		$this->load->view('back-end/vehiclefare/create-page',$this->data);
	}
	/**
	 * @method : edit()
	 * @date : 2022-06-23
	 * @about: This method use for edit vehicle 
	 * 
	 * */
	public function edit(){
	    
		$this->data['meta'] = array('meta_title'=>'Vehicle Fare update','meta_description'=>'');
		$vehiclefare_id = $this->uri->segment(4);
		$this->data['vehiclefare_data'] = $this->VehiclefareModel->fetch_vehiclefare_by_id($vehiclefare_id);
		
	    $this->form_validation->set_rules('vehicle_id', 'Vahicle Name', 'required');
		$this->form_validation->set_rules('country_id', 'country name', 'required');
		$this->form_validation->set_rules('state_id',   'state name', 'required');
		$this->form_validation->set_rules('city_id',    'city name', 'required');
		$this->form_validation->set_rules('fare_base_price', 'Base price', 'required');
		$this->form_validation->set_rules('fare_general_price', 'General price', 'required');
		$this->form_validation->set_rules('fare_business_price', 'Business price', 'required');
		$this->form_validation->set_rules('fare_night_price',    'night price', 'required');
		$this->form_validation->set_rules('fare_extra_waiting_price', 'Waiting price', 'required');
		if ($this->form_validation->run() == TRUE){
		    
			$data['fare_vehicle_id']         = $this->input->post('vehicle_id');
			$data['fare_country_id']         = $this->input->post('country_id');
			$data['fare_state_id']           = $this->input->post('state_id');
			$data['fare_city_id']            = $this->input->post('city_id');
			$data['fare_base_price']         = $this->input->post('fare_base_price');
			$data['fare_general_price']      = $this->input->post('fare_general_price');
			$data['fare_business_price']     = $this->input->post('fare_business_price');
			$data['fare_night_price']        = $this->input->post('fare_night_price');
			$data['fare_extra_waiting_price']= $this->input->post('fare_extra_waiting_price');
			$data['fare_stop_price']         = $this->input->post('fare_stop_price');
			$data['fare_commission']         = $this->input->post('fare_commission');
			$data['fare_time_free']          = $this->input->post('fare_time_free');
	     	
			$this->VehiclefareModel->update(array('fare_id'=>$vehiclefare_id),$data);
			$this->session->set_flashdata('success','vehiclefare details successfully updated !');
			redirect('admin/vehiclefare');
		}
		$this->load->view('back-end/vehiclefare/create-edit',$this->data);
	}
}