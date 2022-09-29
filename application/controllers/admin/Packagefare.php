<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Packagefare extends MY_AdminController {

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
     * @date : 2022-09-24
     * @about: This method use for set common rules of create and updated time in
     *
     *
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
        		'field' => 'fare_kilometre_price', 
        		'label' => 'Per Km. Price', 
        		'rules' => 'required|numeric|trim'
        	), array(
        		'field' => 'fare_kilometre_from', 
        		'label' => 'From', 
        		'rules' => 'required|numeric|trim'
        	), array(
        		'field' => 'fare_kilometre_to', 
        		'label' => 'To', 
        		'rules' => 'required|numeric|trim'
        	),
        );
        $this->form_validation->set_rules($config);
    }
    /**
     * @method : index()
     * @date : 2022-09-24
     * @about: This method use for records all vehicle
     *
     *
     */
    public function index() {
        $this->data['packagefares'] = $this->PackageFareModel->fetch_all();
        $this->load->view('back-end/package/fare-index-page', $this->data);
    }
    /**
     * @method : create()
     * @date : 2022-09-24
     * @about: This method use for create vehicle
     *
     *
     */
    public function create() {
        $this->rules();
        if ($this->form_validation->run() == TRUE) {
            $data['fare_vehicle_id'] = $this->input->post('vehicle_id');
            $data['fare_country_id'] = $this->input->post('country_id');
            $data['fare_state_id'] = $this->input->post('state_id');
            $data['fare_base_price'] = $this->input->post('fare_base_price');
            $data['fare_kilometre_price'] = $this->input->post('fare_kilometre_price');
            $data['fare_kilometre_to'] = $this->input->post('fare_kilometre_to');
            $data['fare_kilometre_from'] = $this->input->post('fare_kilometre_from');
            if ($this->PackageFareModel->save($data)) {
                $this->session->set_flashdata('success', 'Package Fare successfully created !');
                redirect('admin/packagefare');
            } else {
                $this->session->set_flashdata('error', 'Oops something went wrong please try after some time!');
                redirect('admin/packagefare/create');
            }
        }
        $this->load->view('back-end/package/fare-create-page', $this->data);
    }
    /**
     * @method : edit()
     * @date : 2022-09-25
     * @about: This method use for update vihicle package fare 
     *
     *
     */
    public function update() {
    	$this->rules();
        if ($this->form_validation->run() == TRUE) {
            $data['fare_vehicle_id'] = $this->input->post('vehicle_id');
            $data['fare_country_id'] = $this->input->post('country_id');
            $data['fare_state_id'] = $this->input->post('state_id');
            $data['fare_base_price'] = $this->input->post('fare_base_price');
            $data['fare_kilometre_price'] = $this->input->post('fare_kilometre_price');
            $data['fare_kilometre_to'] = $this->input->post('fare_kilometre_to');
            $data['fare_kilometre_from'] = $this->input->post('fare_kilometre_from');
            if ($this->PackageFareModel->update(array('fare_id'=>$this->uri->segment(4)),$data)) {
                $this->session->set_flashdata('success', 'Package Fare successfully updated !');
                redirect('admin/packagefare');
            } else {
                $this->session->set_flashdata('error', 'Oops something went wrong please try after some time!');
                redirect('admin/packagefare/create');
            }
        }
        $this->data['single'] = $this->PackageFareModel->single(array('fare_id'=>$this->uri->segment(4)));
        $this->load->view('back-end/package/fare-update-page', $this->data);
    }
    /**
     * @method : remove()
     * @date : 2022-09-25
     * @about: This method use for remove vehicle pakage fare
     *
     *
     */
    public function remove() {
        if ($this->PackageFareModel->delete(array('fare_id' => $this->uri->segment(4)))) {
            $this->session->set_flashdata('success', 'Package Fare successfully removed !');
            redirect('admin/packagefare');
        } else {
            $this->session->set_flashdata('error', 'Oops something went wrong please try after some time!');
            redirect('admin/packagefare');
        }
    }
}
