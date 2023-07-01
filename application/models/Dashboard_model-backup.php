<?php
class Dashboard_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	var $table7 = "login";
	var $select_column7 = array("first_name", "employee_unique_id", "role_group", "total", "inprogress", "out_of_tat", "positive_resolved", "negative_resolved", "positive_verified", "negative_verified");
	var $order_column7 = array("first_name", "employee_unique_id","role_group", "total", "inprogress", "out_of_tat", "positive_resolved", "negative_resolved", "positive_verified", "negative_verified");

	function make_query_agent()
	{
		try {
			$this->db->select($this->select_column7);
			$this->db->from($this->table7);
			
			if (isset($_POST["search"]["value"])) {
				$this->db->like("first_name", $_POST["search"]["value"]);
				$this->db->like("total", $_POST["search"]["value"]);
				$this->db->like("inprogress", $_POST["search"]["value"]);
				$this->db->like("out_of_tat", $_POST["search"]["value"]);
				$this->db->like("positive_resolved", $_POST["search"]["value"]);
				$this->db->like("negative_resolved", $_POST["search"]["value"]);
				$this->db->like("positive_verified", $_POST["search"]["value"]);
				$this->db->like("negative_verified", $_POST["search"]["value"]);
				$this->db->where('role_group', 'FA');
			}
			if (isset($_POST["order"])) {
				$this->db->order_by($this->order_column7[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else {
				$this->db->order_by('id', 'ASC');
			}
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function make_datatables_agent()
	{
		try {
			$this->make_query_agent();
			if ($_POST["length"] != -1) {
				$this->db->limit($_POST['length'], $_POST['start']);
			}
			$query = $this->db->get();
			return $query->result();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function get_all_data_agent()
	{
		try {
			$this->db->select("*");
			$this->db->from($this->table7);
			$this->db->where('role_group', 'FA');
	
			return $this->db->count_all_results();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

// 	function get_filtered_data_agent()
// 	{
// 		try {
// 			$this->make_query_agent();
// 			$query = $this->db->get();
// 			return $query->num_rows();
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}

	
// 	var $table7 = "login";
// 	var $select_column7 = array("first_name", "employee_unique_id", "role_group", "total", "inprogress", "out_of_tat", "positive_resolved", "negative_resolved", "positive_verified", "negative_verified");
// 	var $order_column7 = array("first_name", "employee_unique_id","role_group", "total", "inprogress", "out_of_tat", "positive_resolved", "negative_resolved", "positive_verified", "negative_verified");

// 	function make_query_agent()
// 	{
// 		try {
		    
// 			$this->db->select($this->select_column7);
// 			$this->db->from($this->table7);
// 		     $this->db->where('role_group', 'FA');
		     
// 			if (isset($_POST["search"]["value"])) {
// 				$this->db->like("first_name", $_POST["search"]["value"]);
// 				$this->db->like("total", $_POST["search"]["value"]);
// 				$this->db->or_like("inprogress", $_POST["search"]["value"]);
// 				$this->db->or_like("out_of_tat", $_POST["search"]["value"]);
// 				$this->db->or_like("positive_resolved", $_POST["search"]["value"]);
// 				$this->db->or_like("negative_resolved", $_POST["search"]["value"]);
// 				$this->db->or_like("positive_verified", $_POST["search"]["value"]);
// 				$this->db->or_like("negative_verified", $_POST["search"]["value"]);
// 			}
// 			if (isset($_POST["order"])) {
// 				$this->db->order_by($this->order_column7[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
// 			} else {
// 				$this->db->order_by('id', 'ASC');
// 			}
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}

// 	function make_datatables_agent()
// 	{
// 		try {
// 			$this->make_query_agent();
// 			if ($_POST["length"] != -1) {
// 				$this->db->limit($_POST['length'], $_POST['start']);
// 			}
// 			$query = $this->db->get();
// 			return $query->result();
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}

// 	function get_all_data_agent()
// 	{
// 		try {
// 			$this->db->select("*");
// 			$this->db->from($this->table7);
// 			$this->db->where('role_group', 'FA');
// 			 //echo $this->db->last_query();
// 			return $this->db->count_all_results();
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}

// 	function get_filtered_data_agent()
// 	{
// 		try {
// 			$this->make_query_agent();
// 			$query = $this->db->get();
// 			return $query->num_rows();
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}



// count records and show in dashbaord
public function countAllTotal()
{
	try {
		$this->db->from('upload_file');
		return $this->db->count_all_results();
	} catch (Exception $ex) {
		throw $ex;
	}
}

// count records per user wise and show in dashbaord
public function countCase($employee_unique_id)
{
	try {
                $this->db->where("code", $employee_unique_id);
		$this->db->from('upload_file');
		return $this->db->count_all_results();
	} catch (Exception $ex) {
		throw $ex;
	}
}

public function totDaywiseCount($employee_unique_id)
{
    
    try {
        $this->db->where("code", $employee_unique_id);
        $this->db->like("created_at",date('Y-m-d'));
        $this->db->from('upload_file');
        return $this->db->count_all_results();
    } catch (Exception $ex) {
        throw $ex;
    }
}

public function inprogressDaywiseCount($employee_unique_id)
{
    try {
        $this->db->where("code", $employee_unique_id);
        $this->db->like("created_at", date('Y-m-d'));
        $where = '(rv_visit_date="" and bv_dt_of_cpv= "")';
        $this->db->where($where);
        $this->db->from('upload_file');
        return $this->db->count_all_results();
    } catch (Exception $ex) {
        throw $ex;
    }
}

public function visitDaywiseCount($employee_unique_id)
{
    try {
        $this->db->where("code", $employee_unique_id);
        $this->db->like("created_at", date('Y-m-d'));
        $where = '(rv_visit_date !="" or bv_dt_of_cpv != "")';
        $this->db->where($where);
        $this->db->from('upload_file');
        return $this->db->count_all_results();
    } catch (Exception $ex) {
        throw $ex;
    }
}

/* public function outOfTatDaywiseCount($employee_unique_id)
{
    try {
        $this->db->where("code", $employee_unique_id);
        $this->db->like("created_at", date('Y-m-d'));
        $this->db->where("rv_visit_date <= ", "tat_end" );
        $this->db->from('upload_file');
        return $this->db->count_all_results();
    } catch (Exception $ex) {
        throw $ex;
    }
} */

public function positiveResolvedDaywiseCount($employee_unique_id)
{
    try {
        $this->db->where("code", $employee_unique_id);
        $this->db->like("created_at", date('Y-m-d'));
        $this->db->where("rv_fi_status", "Positive");
        $this->db->from('upload_file');
        return $this->db->count_all_results();
    } catch (Exception $ex) {
        throw $ex;
    }
}

public function negativeResolvedDaywiseCount($employee_unique_id)
{
    try {
        $this->db->where("code", $employee_unique_id);
        $this->db->like("created_at", date('Y-m-d'));
        $this->db->where("rv_fi_status", "Negative");
        $this->db->from('upload_file');
        return $this->db->count_all_results();
    } catch (Exception $ex) {
        throw $ex;
    }
}


	
}
