<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reassign_report_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->model('Reassign_report_model');
	}

	public function index(){
		//load session library
		$this->load->library('session');

		//restrict users to go back to login if session has been set
		if($this->session->userdata('user')){
			redirect('home');
		}
		else{
			$this->load->view('login_page');
		}
	}

	
	public function reassign_page(){
		//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('user')){
			$this->load->view('reassign_report');
		}
		else{
			redirect('/');
		}
		
	}



}
