<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Admin_dashboard_model');
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

    public function admin_dashboard(){
		//load session library
		$this->load->library('session');
		//restrict users to go to home if not logged in
		if($this->session->userdata('user')){
			$this->load->view('admin_dashboard');
		}
		else{
			redirect('/');
		}
	}


    }
	