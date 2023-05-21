<?php
class Assign_case_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	var $table7 = "upload_file";
	var $select_column7 = array("id","application_id","customer_name", "business_address", "fi_to_be_conducted", "updated_at","status");
	var $order_column7 = array("id","application_id","customer_name", "business_address", "fi_to_be_conducted", "updated_at","status");

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
				$this->db->or_like("updated_at", $_POST["search"]["value"]);
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

	function fetch_single_assignee($user_id)
	{
		try {
			$this->db->where("id", $user_id);
			$query = $this->db->get('upload_file');
			return $query->result();
		} catch (Exception $ex) {
			throw $ex;
		}
	}


	function filter_assignee($data){
		try {
            $this->db->where("uf.code",$data);
            $this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code, uf.application_id,uf.customer_name,uf.business_address,uf.fi_to_be_conducted,uf.updated_at,uf.status");
            $this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');
            $this->db->from('upload_file uf');
            $query = $this->db->get();
			// print_r($query->result());die;
            return $query->result();
        } catch (Exception $ex) {
            throw $ex;
        }
	}

        function filter_Createdate($from,$to,$code){
	try {
             $from=$from.' 00:00:01';
             $to=$to.' 23:59:59';
            // echo $from.'--'.$to.'--'.$data;die();
            $this->db->where("uf.code",$code);
            $this->db->where('uf.updated_at >=', $from);
            $this->db->where('uf.updated_at <=', $to);
            $this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code, uf.application_id,uf.customer_name,uf.business_address,uf.fi_to_be_conducted,uf.updated_at,uf.status");
            $this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');
            
            $this->db->from('upload_file uf');
            $query = $this->db->get();
			// print_r($query->result());die;
            return $query;
        } catch (Exception $ex) {
            throw $ex;
        }
	}
        
    function filter_fitype($val,$code){
	try {
           $this->db->where("uf.code",$code);
            $this->db->where('uf.fi_to_be_conducted =', $val);
            $this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code, uf.application_id,uf.customer_name,uf.business_address,uf.fi_to_be_conducted,uf.updated_at,uf.status");
            $this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');
            
            $this->db->from('upload_file uf');
            $query = $this->db->get();
			// print_r($query->result());die;
            return $query;
        } catch (Exception $ex) {
            throw $ex;
        }
	}

	function filter_status($val,$status){
		try {
			   $this->db->where("uf.code",$code);
				$this->db->where('uf.status =', $val);
				$this->db->select("uf.id as uid,a.employee_unique_id AS agent_code,uf.id,uf.code, uf.application_id,uf.customer_name,uf.business_address,uf.fi_to_be_conducted,uf.updated_at,uf.status");
				$this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');
				
				$this->db->from('upload_file uf');
				$query = $this->db->get();
				// print_r($query->result());die;
				return $query;
			} catch (Exception $ex) {
				throw $ex;
			}
		}
	// function filter_assignee($data){
	// 	try {
    //         $this->db->where("uf.code",$data);
    //         $this->db->select("uf.id as uid,a.agent_code AS agent_code,uf.id,uf.code, uf.application_id,uf.customer_name,uf.residence_address,uf.fi_to_be_conducted,uf.fi_date");
    //         $this->db->join('agent a', 'a.agent_code = uf.code', 'left');
    //         $this->db->from('upload_file uf');
    //         $query = $this->db->get();
	// 		// print_r($query->result());die;
    //         return $query->result();
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

	function update_assignee($reassign_id,$assignfrom, $reassign_multi_id,$data)
	{
		try {
                    
                    if(!empty($reassign_multi_id)){
                        foreach ($reassign_multi_id as $val){
                            //echo ($val.'--'.$assignfrom);die();
                           // print_r($data);die();
                            $this->db->where("id", $val);
                            $this->db->update("upload_file", $data);
                            $transfer_date=date('Y-m-d H:i:s');
                            
                            $history=$this->db->query("INSERT into case_transfer_history (assign_from,assign_to,application_id,transfer_date)values"
                                    . "('$assignfrom','$data[code]','$val',\"$transfer_date\")");
                        }
                        return '1';
                    }
                    if(!empty($reassign_id)){
                        $transfer_date=date('Y-m-d H:i:s');
			$this->db->where("id", $reassign_id);
			//        print_r($data);die;
			$return_data = $this->db->update("upload_file", $data);
                        $history=$this->db->query("INSERT into case_transfer_history (assign_from,assign_to,application_id,transfer_date)values"
                                    . "('$assignfrom','$data[code]','$reassign_id',\"$transfer_date\")");
			return $return_data;
                    }
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function getDataById($id) {
        // Assuming 'your_table' is the name of your database table
        $query = $this->db->get_where('upload_file', array('id' => $id));
        
        return $query->row_array();
    }

	

}