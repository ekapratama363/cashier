<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

		if($this->session->userdata('is_login') != "true"){
			redirect(base_url("auth/login"));
        }
        
        // for load helper
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('Product_model');
    }

    public function index($type) 
    {
        $data['page'] = "report/index";
        $data['type'] = $type;

        $this->load->view('app', $data);
    }

    public function dashboard()
    {
        $data['page'] = 'report/dashboard';
        $this->load->view('app', $data);
    }
}