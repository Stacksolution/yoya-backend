<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Transport extends MY_AdminController {

    public function __construct() {
        parent::__construct();
        is_logged_out(); // if user is logout Or session is expired then redirect login
        $this->data['country'] = $this->CountrysModel->_dropdownlist();
        $this->data['states'] = $this->StateModel->_dropdownlist();
        $this->data['cities'] = $this->CitysModel->_dropdownslist();
        $this->data['vehicles'] = $this->VehicleModel->_dropdownlist();
    }
    /**
     * @method : rules()
     * @date : 2022-10-18
     * @about: This method use for set common rules of create and updated time in
     */
    public function rules() {
        $config = array(
        	array(
        		'field' => 'vehicle_id',
        		'label' => 'vehicle',
        		'rules' => 'required|numeric|trim'
        	), array(
        		'field' => 'country_id', 
        		'label' => 'Country', 
        		'rules' => 'required|numeric|trim'
        	), array(
        		'field' => 'state_id',
        		'label' => 'State', 
        		'rules' => 'required|numeric|trim'
        	), array(
        		'field' => 'city_id', 
        		'label' => 'City', 
        		'rules' => 'required|numeric|trim'
        	), array(
        		'field' => 'fare_base_price', 
        		'label' => 'Base Price', 
        		'rules' => 'required|numeric|trim'
        	), array(
        		'field' => 'fare_rental_id', 
        		'label' => 'Package id', 
        		'rules' => 'required|numeric|trim'
        	), array(
        		'field' => 'fare_per_minutes', 
        		'label' => 'Per minutes cost', 
        		'rules' => 'required|numeric|trim'
        	), 
        );
        $this->form_validation->set_rules($config);
    }
     /**
     * @method : index()
     * @date : 2022-10-18
     * @about: This method use for records all vehicle
     */
    public function index() {
        $this->data['transport'] = $this->RentalFareModel->fetch_all();
        $this->load->view('back-end/transport/index-page', $this->data);
    }
}