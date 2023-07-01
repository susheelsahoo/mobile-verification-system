<?php
class Tat_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
// 	public function getRecords()
//     {
//         // Retrieve the data from the database
//         $query = $this->db->get('upload_file');
//         return $query->result_array();
//     }
    
    
    //  public function getRecords()
    // {
    //     // Join the necessary table to retrieve the first_name column
    //     $this->db->select('upload_file.*, login.first_name');
    //     $this->db->from('upload_file');
    //     $this->db->join('login', 'upload_file.code = login.employee_unique_id', 'left');
        
    //     $query = $this->db->get();

    //     return $query->result_array();
    // }
    
    
      public function getRecords($fromDate = null, $toDate = null)
    {
        $this->db->select('upload_file.*, login.first_name');
        $this->db->from('upload_file');
        $this->db->join('login', 'upload_file.code = login.employee_unique_id', 'left');
        
        
        if ($fromDate && $toDate) {
            $this->db->where('upload_file.created_at >=', $fromDate);
            $this->db->where('upload_file.created_at <=', $toDate);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    public function getFilteredRecords($fromDate, $toDate)
{
    // Join the necessary table to retrieve the first_name column
    $this->db->select('upload_file.*, login.first_name');
    $this->db->from('upload_file');
    $this->db->join('login', 'upload_file.code = login.employee_unique_id', 'left');
    $this->db->group_start();
    $this->db->where('upload_file.created_at >=', $fromDate);
    $this->db->where('upload_file.created_at <=', $toDate);
    $this->db->group_end();

    $query = $this->db->get();

   $dsd =  $query->result_array();
   
   return $dsd;
//   echo '<pre>';
// print_r($dsd);
// echo '<pre>';
   
   
}
    
    function agent_filter($val)
{
    try {
        $this->db->select('upload_file.*, login.first_name');
        $this->db->from('upload_file');
        $this->db->join('login', 'upload_file.code = login.employee_unique_id', 'left');
        $this->db->where("upload_file.code", $val);
        $this->db->select("upload_file.id as uid, login.employee_unique_id AS agent_code, upload_file.id, upload_file.code, upload_file.application_id, upload_file.customer_name, upload_file.bank_name, upload_file.product_name, upload_file.rv_visit_date, upload_file.business_address, upload_file.fi_to_be_conducted, upload_file.tat_start, upload_file.tat_end, upload_file.status");
        $query = $this->db->get();

        return $query;
    } catch (Exception $ex) {
        throw $ex;
    }
}
   
}