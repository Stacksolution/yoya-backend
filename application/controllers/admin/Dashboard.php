<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_AdminController {
	public function __construct() {
        parent::__construct(); 
        is_logged_out(); // if user is logout Or session is expired then redirect login
    }
	public function index(){
		$this->data['meta'] = array('meta_title'=>'Dashboard','meta_description'=>'');
		$this->load->view('back-end/dashboard',$this->data);
	}
}