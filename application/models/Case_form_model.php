<?php
class Case_form_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function insert_case($data)
	{
		try {
			$this->db->insert('upload_file', $data);
			return $this->db->insert_id();
		} catch (Exception $ex) {
			throw $ex;
		}
	}
	
	  public function getEmailByCode($code)
    {
        $this->db->select('email');
        $this->db->where('employee_unique_id', $code);
        $query = $this->db->get('login');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->email;
        } else {
            return null;
        }
    }
}
