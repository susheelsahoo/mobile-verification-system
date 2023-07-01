<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LinkModel extends CI_Model {
    
    	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

   public function getData($application_id) {
        $this->db->where('application_id', $application_id);
        //  $this->db->where('fi_to_be_conducted', $fi_type);
       
        $query = $this->db->get('upload_file'); // Replace 'your_table_name' with the actual table name

        return $query->result();
    }
}


  