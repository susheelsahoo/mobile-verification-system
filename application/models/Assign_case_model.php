<?php
class Assign_case_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	var $table7 = "upload_file";
	var $select_column7 = array("id", "application_id", "customer_name", "business_address", "fi_to_be_conducted", "tat_start", "tat_end", "status");
	var $order_column7 = array("id", "application_id", "customer_name", "business_address", "fi_to_be_conducted", "tat_start", "tat_end", "status");

	function make_query_assign()
	{
		try {
			$this->db->select($this->select_column7);
			$this->db->from($this->table7);
			if (isset($_POST["search"]["value"])) {
				$this->db->like("id", $_POST["search"]["value"]);
				$this->db->like("application_id", $_POST["search"]["value"]);
				$this->db->like("customer_name", $_POST["search"]["value"]);
				$this->db->or_like("business_address", $_POST["search"]["value"]);
				$this->db->or_like("fi_to_be_conducted", $_POST["search"]["value"]);
				$this->db->or_like("tat_start", $_POST["search"]["value"]);
				$this->db->or_like("tat_end", $_POST["search"]["value"]);
				$this->db->or_like("status", $_POST["search"]["value"]);
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

	function make_datatables_assign()
	{
		try {
			$this->make_query_assign();
			if ($_POST["length"] != -1) {
				$this->db->limit($_POST['length'], $_POST['start']);
			}
			$query = $this->db->get();
			return $query->result();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function get_all_data_assign()
	{
		try {
			$this->db->select("*");
			$this->db->from($this->table7);
			return $this->db->count_all_results();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function get_filtered_data_assign()
	{
		try {
			$this->make_query_assign();
			$query = $this->db->get();
			return $query->num_rows();
		} catch (Exception $ex) {
			throw $ex;
		}
	}
	
	function add_final_status($status_id, $data)
	{
		try {
			$this->db->where("id", $status_id);
			// print_r($data);die;
			$return_data = $this->db->update("upload_file", $data);
			return $return_data;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function fetch_single_assignee($user_id)
	{
		try {
			$this->db->select("uf.*, l.first_name as agent_name");
			$this->db->where("uf.id", $user_id);
			$this->db->join('login l', 'l.employee_unique_id = uf.code', 'left');
			$query = $this->db->get('upload_file uf');
			return $query->result();
		} catch (Exception $ex) {
			throw $ex;
		}

		// try {
		// 	$this->db->where("id", $user_id);
		// 	$query = $this->db->get('upload_file');
		// 	return $query->result();
		// } catch (Exception $ex) {
		// 	throw $ex;
		// }
	}


// 	function filter_assignee($data)
// 	{
// 		try {
// 			$this->db->where("uf.code", $data);
// 			$this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code,uf.bank_name, uf.application_id,uf.customer_name,uf.business_address,uf.fi_to_be_conducted,uf.tat_start,uf.tat_end,uf.status,uf.add_final_status");
// 			$this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');
// 			$this->db->from('upload_file uf');
// 			$query = $this->db->get();
// 			// print_r($query->result());die;
// 			return $query->result();
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}
	
	
// 	function filter_assignee($data)
// {
//     try {
//         $today = date('Y-m-d');
//         // $status = "inactive";
//         $this->db->where("uf.code", $data);
//         // $this->db->where("uf.status", $status);
//         $this->db->where("DATE(uf.created_at)", $today); // Add the condition to check if created_date is equal to today's date
//         $this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code,uf.bank_name,uf.product_name, uf.application_id,uf.customer_name,uf.business_address,uf.fi_to_be_conducted,uf.tat_start,uf.tat_end,uf.status,uf.add_final_status,uf.created_at");
//         $this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');
//         $this->db->from('upload_file uf');
//         $query = $this->db->get();
//         return $query->result();
//     } catch (Exception $ex) {
//         throw $ex;
//     }
// }

// function filter_assignee($data)
// {
//     try {
//         $today = date('Y-m-d');
//         $status = "inactive";
//         $this->db->where("uf.code", $data);
//         $this->db->where("uf.status", $status);
//         $this->db->group_start();
//             $this->db->where("DATE(uf.created_at)", $today); // Condition to check if created_date is equal to today's date
//             $this->db->or_group_start();
//                 $this->db->where("DATE(uf.created_at) <", $today); // Condition to check if created_date is earlier than today's date
//                 $this->db->where("uf.status", "inactive"); // Condition to check if previous_case_status is "pending"
//             $this->db->group_end();
//         $this->db->group_end();
//         $this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code,uf.bank_name,uf.product_name, uf.application_id,uf.customer_name,uf.business_address,uf.fi_to_be_conducted,uf.tat_start,uf.tat_end,uf.status,uf.add_final_status,uf.created_at");
//         $this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');
//         $this->db->from('upload_file uf');
//         $query = $this->db->get();
//         return $query->result();
//     } catch (Exception $ex) {
//         throw $ex;
//     }
// }

// updated code ashwini sir
function filter_assignee($data)
{
    try {
        
        $today = date('Y-m-d');
        $status = "inactive";
        $this->db->where("uf.code", $data);
        $this->db->group_start();
        $this->db->group_start();
        $this->db->where("DATE(uf.rv_visit_date)", $today);
        $this->db->or_where("DATE(uf.bv_dt_of_cpv)", $today);
        $this->db->group_end();
      // $this->db->where("DATE(uf.created_at) != ", $today);
        $this->db->or_group_start();
        $this->db->where("uf.status", $status);
        $this->db->group_end();
        $this->db->group_end();
        $this->db->select("uf.id as uid, a.employee_unique_id AS agent_code, uf.id, uf.code, uf.bank_name, uf.product_name, uf.rv_visit_date, uf.application_id, uf.customer_name, uf.business_address, uf.fi_to_be_conducted, uf.tat_start, uf.tat_end, uf.status, uf.add_final_status, uf.created_at");
        $this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');
        $this->db->from('upload_file uf');
        $query = $this->db->get();
        $result = $query->result();
        
        // Echo the generated query
      //  echo $this->db->last_query();
        
        return $result;
    } catch (Exception $ex) {
        throw $ex;
    }
}

// function filter_assignee($data)
// {
//     try {
//         $today = date('Y-m-d');
//         $status = "inactive";
        
//         $this->db->select("uf.id as uid, login.employee_unique_id AS agent_code, uf.id, uf.code, uf.bank_name, uf.product_name, uf.rv_visit_date, uf.application_id, uf.customer_name, uf.business_address, uf.fi_to_be_conducted, uf.tat_start, uf.tat_end, uf.status, uf.add_final_status, uf.created_at, login.first_name");
//         $this->db->from('upload_file uf');
//         $this->db->join('login', 'upload_file.code = login.employee_unique_id', 'left');
        
//         $this->db->where("uf.code", $data);
//         $this->db->group_start();
//         $this->db->group_start();
//         $this->db->where("DATE(uf.rv_visit_date)", $today);
//         $this->db->or_where("DATE(uf.bv_dt_of_cpv)", $today);
//         $this->db->group_end();
//         $this->db->or_group_start();
//         $this->db->where("uf.status", $status);
//         $this->db->group_end();
//         $this->db->group_end();
        
//         $query = $this->db->get();
//         $result = $query->result();
        
//         // Echo the generated query
//         // echo $this->db->last_query();
        
//         return $result;
//     } catch (Exception $ex) {
//         throw $ex;
//     }
// }






public function getAgentName($employee_unique_id)
{
    // Assuming you have a database table named 'agents' with a column 'employee_unique_id' and 'first_name'
    $this->db->select('first_name');
    $this->db->where('employee_unique_id', $employee_unique_id);
    $query = $this->db->get('login');

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->first_name;
    }

    return ''; // Return empty string if no agent found
}

// 	function filter_Createdate($from, $to, $code)
// 	{
// 		try {
// 			$from = $from . ' 00:00:01';
// 			$to = $to . ' 23:59:59';
// 			// echo $from.'--'.$to.'--'.$data;die();
// 			$this->db->where("uf.code", $code);
// 			$this->db->where('uf.created_at >=', $from);
// 			$this->db->where('uf.created_at <=', $to);
// 			$this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code,uf.bank_name,uf.product_name,uf.rv_visit_date, uf.application_id,uf.customer_name,uf.business_address,uf.fi_to_be_conducted,uf.tat_start,uf.tat_end,uf.status");
// 			$this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');

// 			$this->db->from('upload_file uf');
// 			$query = $this->db->get();
// 			// print_r($query->result());die;
// 			return $query;
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}

function filter_Createdate($from, $to, $code)
{
    try {
        $from = $from . ' 00:00:01';
        $to = $to . ' 23:59:59';

        $this->db->select('upload_file.*, login.first_name');
        $this->db->from('upload_file');
        $this->db->join('login', 'upload_file.code = login.employee_unique_id', 'left');
        $this->db->where("upload_file.code", $code);
        $this->db->where('upload_file.created_at >=', $from);
        $this->db->where('upload_file.created_at <=', $to);
        $this->db->select("upload_file.id as uid, a.employee_unique_id AS agent_code, upload_file.id, upload_file.code, upload_file.bank_name, upload_file.product_name, upload_file.rv_visit_date, upload_file.application_id, upload_file.customer_name, upload_file.business_address, upload_file.fi_to_be_conducted, upload_file.tat_start, upload_file.tat_end, upload_file.status");
        $this->db->join('login a', 'a.employee_unique_id = upload_file.code', 'left');
        $query = $this->db->get();

        return $query;
    } catch (Exception $ex) {
        throw $ex;
    }
}



// 	function filter_fitype($val, $code)
// 	{
// 		try {
// 			$this->db->where("uf.code", $code);
// 			$this->db->where('uf.fi_to_be_conducted =', $val);
// 			$this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code,uf.bank_name,uf.product_name, uf.rv_visit_date, uf.application_id,uf.customer_name,uf.business_address,uf.fi_to_be_conducted,uf.tat_start,uf.tat_end,uf.status");
// 			$this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');

// 			$this->db->from('upload_file uf');
// 			$query = $this->db->get();
// 			// print_r($query->result());die;
// 			return $query;
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}

function filter_fitype($val, $code)
{
    try {
        $this->db->select('upload_file.*, login.first_name');
        $this->db->from('upload_file');
        $this->db->join('login', 'upload_file.code = login.employee_unique_id', 'left');
        $this->db->where("upload_file.code", $code);
        $this->db->where('upload_file.fi_to_be_conducted', $val);
        $query = $this->db->get();

        return $query;
    } catch (Exception $ex) {
        throw $ex;
    }
}





// 	function filter_status($val, $code)
// 	{
// 		try {
// 			$this->db->where("uf.code", $code);
// 			$this->db->where('uf.status =', $val);
// 				$this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code,uf.bank_name,uf.product_name, uf.rv_visit_date, uf.application_id,uf.customer_name,uf.business_address,uf.fi_to_be_conducted,uf.tat_start,uf.tat_end,uf.status");
// // 			$this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code, uf.application_id,uf.customer_name,uf.business_address,uf.fi_to_be_conducted,uf.tat_start,uf.tat_end,uf.status");
// 			$this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');

// 			$this->db->from('upload_file uf');
// 			$query = $this->db->get();
// 			// print_r($query->result());die;
// 			return $query;
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}

function filter_status($val, $code)
{
    try {
        $this->db->select('upload_file.*, login.first_name');
        $this->db->from('upload_file');
        $this->db->join('login', 'upload_file.code = login.employee_unique_id', 'left');
        $this->db->where("upload_file.status", $val);
        	$this->db->where("upload_file.code", $code);
        $this->db->select("upload_file.id as uid, login.employee_unique_id AS agent_code, upload_file.id, upload_file.code, upload_file.application_id, upload_file.customer_name, upload_file.bank_name, upload_file.product_name, upload_file.rv_visit_date, upload_file.business_address, upload_file.fi_to_be_conducted, upload_file.tat_start, upload_file.tat_end, upload_file.status");
        $query = $this->db->get();

        return $query;
    } catch (Exception $ex) {
        throw $ex;
    }
}


// function filter_status($val, $code)
// {
//     try {
//         $this->db->select('upload_file.*, login.first_name');
//         $this->db->from('upload_file');
//         $this->db->join('login', 'login.employee_unique_id = upload_file.code', 'left');
//         $this->db->where("upload_file.code", $code);
//         $this->db->where('upload_file.status', $val);
//         $query = $this->db->get();

//         return $query;
//     } catch (Exception $ex) {
//         throw $ex;
//     }
// }

	
	


	function fetch_single_case($user_id)
	{
		try {
			$this->db->where("id", $user_id);
			$query = $this->db->get('upload_file');
			return $query->result();
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function update_case($case_id, $data)
	{
		try {
			$this->db->where("id", $case_id);
			//        print_r($data);die;
			$return_data = $this->db->update("upload_file", $data);
			return $return_data;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function update_bv_data_case($bv_cse_id, $data)
	{
		try {
			$this->db->where("id", $bv_cse_id);
			//        print_r($data);die;
			$return_data = $this->db->update("upload_file", $data);
			return $return_data;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function update_rv_data_case($rv_cse_id, $data)
	{
		try {
			$this->db->where("id", $rv_cse_id);
			//        print_r($data);die;
			$return_data = $this->db->update("upload_file", $data);
			return $return_data;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	function update_assignee($reassign_id, $assignfrom, $reassign_multi_id, $data)
	{
		try {

			if (!empty($reassign_multi_id)) {
				foreach ($reassign_multi_id as $val) {
					//echo ($val.'--'.$assignfrom);die();
					// print_r($data);die();
					$this->db->where("id", $val);
					$this->db->update("upload_file", $data);
					$transfer_date = date('Y-m-d H:i:s');

					$history = $this->db->query("INSERT into case_transfer_history (assign_from,assign_to,application_id,transfer_date)values"
						. "('$assignfrom','$data[code]','$val',\"$transfer_date\")");
				}
				return '1';
			}
			if (!empty($reassign_id)) {
				$transfer_date = date('Y-m-d H:i:s');
				$this->db->where("id", $reassign_id);
				//        print_r($data);die;
				$return_data = $this->db->update("upload_file", $data);
				$history = $this->db->query("INSERT into case_transfer_history (assign_from,assign_to,application_id,transfer_date)values"
					. "('$assignfrom','$data[code]','$reassign_id',\"$transfer_date\")");
				return $return_data;
			}
		} catch (Exception $ex) {
			throw $ex;
		}
	}


// function agent_filter($val, $code)
// 	{//echo $val;die();
// 		try {
// 			// $status = 'FA';


// 			$this->db->where("uf.code", $val);
// 			// $this->db->where("a.role_group", $status);
// 			$this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code, uf.application_id,uf.customer_name,uf.bank_name,uf.product_name, uf.rv_visit_date,uf.business_address,uf.fi_to_be_conducted,uf.tat_start,uf.tat_end,uf.status");
// 			$this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');
// 			$this->db->from('upload_file uf');
// 			$query = $this->db->get();
// 			// print_r($query->result());die;
// 			return $query;
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}

function agent_filter($val, $code)
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

        
//         function app_data($val, $code)
// 	{
// 		try {
//                         $this->db->where("uf.application_id", $val);
// // 			$this->db->where("uf.code", $code);
// 			$this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code, uf.application_id,uf.customer_name,uf.bank_name,uf.rv_visit_date,uf.product_name,uf.business_address,uf.fi_to_be_conducted,uf.tat_start,uf.tat_end,uf.status");
// 			$this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');

// 			$this->db->from('upload_file uf');
// 			$query = $this->db->get();
// 			// print_r($query->result());die;
// 			return $query;
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}


function app_data($val, $code)
{
    try {
        $this->db->select('upload_file.*, login.first_name');
        $this->db->from('upload_file');
        $this->db->join('login', 'upload_file.code = login.employee_unique_id', 'left');
        $this->db->where("upload_file.application_id", $val);
        // 	$this->db->where("upload_file.code", $code);
        $this->db->select("upload_file.id as uid, login.employee_unique_id AS agent_code, upload_file.id, upload_file.code, upload_file.application_id, upload_file.customer_name, upload_file.bank_name, upload_file.product_name, upload_file.rv_visit_date, upload_file.business_address, upload_file.fi_to_be_conducted, upload_file.tat_start, upload_file.tat_end, upload_file.status");
        $query = $this->db->get();

        return $query;
    } catch (Exception $ex) {
        throw $ex;
    }
}






//   function mob_data($val, $code)
// 	{
// 		try {
//                         $this->db->where("uf.mobile", $val);
// // 			$this->db->where("uf.code", $code);
// 			$this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code, uf.application_id,uf.mobile,uf.customer_name, uf.rv_visit_date,uf.bank_name,uf.product_name,uf.business_address,uf.fi_to_be_conducted,uf.tat_start,uf.tat_end,uf.status");
// 			$this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');

// 			$this->db->from('upload_file uf');
// 			$query = $this->db->get();
// 			// print_r($query->result());die;
// 			return $query;
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}

function mob_data($val, $code)
{
    try {
        $this->db->select('upload_file.*, login.first_name');
        $this->db->from('upload_file');
        $this->db->join('login', 'upload_file.code = login.employee_unique_id', 'left');
        $this->db->where("upload_file.mobile", $val);
        // 	$this->db->where("upload_file.code", $code);
        $this->db->select("upload_file.id as uid, login.employee_unique_id AS agent_code, upload_file.id, upload_file.code, upload_file.application_id, upload_file.customer_name, upload_file.bank_name, upload_file.product_name, upload_file.rv_visit_date, upload_file.business_address, upload_file.fi_to_be_conducted, upload_file.tat_start, upload_file.tat_end, upload_file.status");
        $query = $this->db->get();

        return $query;
    } catch (Exception $ex) {
        throw $ex;
    }
}

//  function mob_data($val, $code)
// 	{
// 		try {
//                   $this->db->select('upload_file.*, login.first_name');
//         $this->db->from('upload_file');
//         $this->db->join('login', 'login.employee_unique_id = upload_file.code', 'left');
//         $this->db->where('upload_file.mobile', $val);
// 			$query = $this->db->get();
			
// 			return $query;
// 		} catch (Exception $ex) {
// 			throw $ex;
// 		}
// 	}

	public function getDataById($id)
	{
		// Assuming 'your_table' is the name of your database table
		$query = $this->db->get_where('upload_file', array('id' => $id));

		return $query->row_array();
	}
	
	function delete_single_case($user_id)
	{
		try {
			$this->db->where("id", $user_id);
			$return = $this->db->delete("upload_file");
			return $return;
			//DELETE FROM users WHERE id = '$user_id'  
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	
	public function getuf($uid) {
		$this->db->select('*');
		$this->db->where('id',$uid);
		$resultArray = $this->db->get('upload_file')->row_array();
		if(!empty($resultArray)) {
			return $resultArray;
		} else {
			return false;
		}
	}
	
	 public function getDetails($id) {
        $query = $this->db->get_where('upload_file', array('id' => $id));
        return $query->row_array();
    }


 public function getbvDetails($id) {
        // Retrieve the row details from your database
        $query = $this->db->get_where('upload_file', array('id' => $id));
        return $query->row_array();
    }

    //  public function getbvDetails($id) {
    //     $this->db->where('id', $id);
    //     //  $this->db->where('fi_to_be_conducted', $fi_type);
       
    //     $query = $this->db->get('upload_file'); // Replace 'your_table_name' with the actual table name

    //     return $query->result();
    // }
    
	
	public function getImageDataById($id)
	{
	    try {
	        $this->db->select("uf.rv_image1, uf.rv_image2, uf.rv_image3, uf.rv_image4, uf.rv_image5, uf.rv_image6, uf.rv_image7, uf.rv_image8, uf.rv_image9");
	        $this->db->where("uf.id", $id);
	        $query = $this->db->get('upload_file uf');
	        return $query->result();
	    } catch (Exception $ex) {
	        throw $ex;
	    }
	}
}