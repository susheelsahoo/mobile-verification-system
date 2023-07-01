<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LinkController extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('LinkModel');
	}

    public function index() {
        $application_id = $this->input->get('application_id'); // Get the reference number from the URL
        // $fi_type = $this->input->get('fi_to_be_conducted'); 
      
        $this->load->model('LinkModel');
        $data['results'] = $this->LinkModel->getData($application_id);

        // Load the view passing the fetched data
        $this->load->view('link_page', $data);
    }
}
