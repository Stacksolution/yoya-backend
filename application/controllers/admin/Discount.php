<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Discount extends MY_AdminController {

	public function __construct() {
        parent::__construct(); 
        is_logged_out(); // if user is logout Or session is expired then redirect login
		$this->data['country'] = $this->CountrysModel->_dropdownlist();
		$this->data['states'] = $this->StateModel->_dropdownlist();
        $this->data['cities'] = $this->CitysModel->_dropdownslist();
		$this->data['process'] = $this->JobprocessModel->_dropdownslist();
        $this->data['vehicletype'] = $this->VehicleTypeModel->_dropdownlist();
		$this->data['vehicle'] = $this->VehicleModel->_dropdownlist();
	}
	/**
     * @method : rules_for_create()
     * @date : 2022-09-24
     * @about: This method use for set common rules of create and updated time in
     */
    public function rules_for_create() {
        $config = array(
			array(
        		'field' => 'discount_code',
        		'label' => 'Discount Value',
        		'rules' => 'required|trim'
        	),
			array(
        		'field' => 'discount_code',
        		'label' => 'Discount Code',
        		'rules' => 'required|trim|is_unique[discount.discount_code]'
        	), array(
        		'field' => 'discount_start_date',
        		'label' => 'Start Date', 
        		'rules' => 'required|trim'
        	), array(
        		'field' => 'discount_end_date',
        		'label' => 'End Date', 
        		'rules' => 'required|trim'
        	),
        );
        $this->form_validation->set_rules($config);
    }
	/**
     * @method : rules_for_update()
     * @date : 2022-09-24
     * @about: This method use for set common rules of create and updated time in
     */
    public function rules_for_update() {
        $config = array(
			array(
        		'field' => 'discount_amount',
        		'label' => 'Discount Value',
        		'rules' => 'required|trim'
        	),
			array(
        		'field' => 'discount_code',
        		'label' => 'Discount Code',
        		'rules' => 'required|trim'
        	), array(
        		'field' => 'discount_start_date',
        		'label' => 'Start Date', 
        		'rules' => 'required|trim'
        	), array(
        		'field' => 'discount_end_date',
        		'label' => 'End Date', 
        		'rules' => 'required|trim'
        	),
        );
        $this->form_validation->set_rules($config);
    }
    /**
	 * @method : index()
	 * @date : 2022-06-27
	 * @about: This method use for records all Discount
	 * */
	public function index(){
		$this->data['discounts'] = $this->DiscountModel->fetch_all_discount_records();
		
		$this->data['meta'] = array('meta_title'=>'Discount Manage','meta_description'=>'');
		$this->load->view('back-end/discount/index-page',$this->data);
	}
	/**
	 * @method : create()
	 * @date : 2022-06-27
	 * @about: This method use for create Discount
	 * 
	 * */
	public function create(){
		$this->rules_for_create();
		if ($this->form_validation->run() == TRUE){
			//------------------------------------------------------------------
			$data['discount_country_id']     = $this->input->post('country_id');
			$data['discount_state_id']       = $this->input->post('state_id');
			$data['discount_city_id']        = $this->input->post('city_id');
			//------------------------------------------------------------------
			//------------------------------------------------------------------
			$data['discount_start_date']     = $this->input->post('discount_start_date');
			$data['discount_end_date']       = $this->input->post('discount_end_date');
			//------------------------------------------------------------------
			//------------------------------------------------------------------
			$data['discount_job_process_id']    = $this->input->post('discount_job_process_id');
		    $data['discount_vehicle_type_id']   = $this->input->post('discount_vehicle_type_id');
			$data['discount_vehicle_id']   = $this->input->post('discount_vehicle_id');
			$data['discount_max_amount']   = $this->input->post('discount_max_amount');
			//------------------------------------------------------------------
			//------------------------------------------------------------------
			$data['discount_value']          = $this->input->post('discount_amount');
		    $data['discount_code']           = $this->input->post('discount_code');
			$data['discount_type']           = $this->input->post('discount_type');
			$data['discount_description']    = $this->input->post('discount_description');
			//------------------------------------------------------------------
			//------------------------------------------------------------------
			$data['discount_minimum_amount'] = 1;
			if(!empty($this->input->post('discount_minimum_amount'))){
				$data['discount_minimum_amount'] = $this->input->post('discount_minimum_amount');
			}
			$data['discount_user_uses_at_time'] = $this->input->post('discount_user_uses_at_time');
			
			if($this->DiscountModel->save($data)){
				$this->session->set_flashdata('success','Discount successfully created !');
				redirect('admin/discount');
			}else{
				$this->session->set_flashdata('error','Oops something went wrong please try after some time!');
				redirect('admin/discount/create');
			}
		}
		$this->data['meta'] = array('meta_title'=>'Discount Fare Create','meta_description'=>'');
		$this->load->view('back-end/discount/create-page',$this->data);
	}
	/**
	 * @method : edit()
	 * @date : 2022-06-27
	 * @about: This method use for edit discount 
	 * 
	 * */
	public function edit(){
		$this->data['meta'] = array('meta_title'=>'Discount update','meta_description'=>'');
		$discount_id = $this->uri->segment(4);
		$this->data['discounts'] = $this->DiscountModel->fetch_discount_by_id($discount_id);
	  	$this->rules_for_update();
		if ($this->form_validation->run() == TRUE){
		    
		    //------------------------------------------------------------------
			$data['discount_country_id']     = $this->input->post('country_id');
			$data['discount_state_id']       = $this->input->post('state_id');
			$data['discount_city_id']        = $this->input->post('city_id');
			//------------------------------------------------------------------
			//------------------------------------------------------------------
			$data['discount_start_date']     = $this->input->post('discount_start_date');
			$data['discount_end_date']       = $this->input->post('discount_end_date');
			//------------------------------------------------------------------
			//------------------------------------------------------------------
			$data['discount_job_process_id']    = $this->input->post('discount_job_process_id');
		    $data['discount_vehicle_type_id']   = $this->input->post('discount_vehicle_type_id');
			$data['discount_vehicle_id']   = $this->input->post('discount_vehicle_id');
			$data['discount_max_amount']   = $this->input->post('discount_max_amount');
			//------------------------------------------------------------------
			//------------------------------------------------------------------
		    $data['discount_value']          = $this->input->post('discount_amount');
			$data['discount_code']           = $this->input->post('discount_code');
			$data['discount_type']           = $this->input->post('discount_type');
			$data['discount_description']    = $this->input->post('discount_description');
			//------------------------------------------------------------------
			//------------------------------------------------------------------
			$data['discount_minimum_amount'] = 1;
			if(!empty($this->input->post('discount_minimum_amount'))){
				$data['discount_minimum_amount'] = $this->input->post('discount_minimum_amount');
			}
			$data['discount_user_uses_at_time'] = $this->input->post('discount_user_uses_at_time');
	     	
			$this->DiscountModel->update(array('discount_id'=>$discount_id),$data);
			$this->session->set_flashdata('success','Discount details successfully updated !');
			redirect('admin/discount');
		}
		$this->load->view('back-end/discount/create-edit',$this->data);
	}
}