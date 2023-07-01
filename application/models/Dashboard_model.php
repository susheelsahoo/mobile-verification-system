<?php
class Dashboard_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	var $table7 = "login";
	var $select_column7 = array("first_name", "employee_unique_id", "role_group", "status", "total", "inprogress", "out_of_tat", "positive_resolved", "negative_resolved", "positive_verified", "negative_verified");
	var $order_column7 = array("first_name", "employee_unique_id","role_group", "status", "total", "inprogress", "out_of_tat", "positive_resolved", "negative_resolved", "positive_verified", "negative_verified");

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
				
		 $this->db->where_in('role_group', array('FA', 'Client Manager')); // Adjust the condition here
            $this->db->where('status', 'active');
            // $this->db->where('your_additional_condition', 'your_additional_value'); // Add your additional condition here
        } else {
            $this->db->where_in('role_group', array('FA', 'Client Manager')); // Adjust the condition here
            $this->db->where('status', 'active');
            // $this->db->where('your_additional_condition', 'your_additional_value'); // Add your additional condition here
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
	        if (isset($_POST["order"])) {
	            $this->db->order_by($this->order_column7[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } else {
	            $this->db->order_by('id', 'ASC');
	        }
	        $query = $this->db->get();
	        return $query->result();
	    } catch (Exception $ex) {
	        throw $ex;
	    }
	}
	
	
	function make_total_datatables_agent()
	{
	    try {
	        
	        $sql = 'select  "Total" as first_name, 
		           "Test_Total" as employee_unique_id, 
                  "FA" as role_group,
                 (CASE WHEN count(t.id) is not NULL THEN count(t.id) ELSE 0 END) + (CASE WHEN p2.pending_total is not NULL THEN p2.pending_total ELSE 0 END) as total,
                  CASE WHEN t1.inprogress_total is not NULL THEN t1.inprogress_total ELSE 0 END as inprogress_total,
                  CASE WHEN p1.pending_total is not NULL THEN p1.pending_total ELSE 0 END as pending_total,
                  CASE WHEN t2.visit_total is not NULL THEN t2.visit_total ELSE 0 END as visit_total,
                  CASE WHEN t3.outoftat_total is not NULL THEN t3.outoftat_total ELSE 0 END as outoftat_total,
                  CASE WHEN t4.positiveresolved_total is not NULL THEN t4.positiveresolved_total ELSE 0 END as positiveresolved_total,
                  CASE WHEN t5.negativeresolved_total is not NULL THEN t5.negativeresolved_total ELSE 0 END as negativeresolved_total
                  from upload_file as t
                  join (Select count(id) as inprogress_total,code from upload_file where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status=""  and date(created_at) like "%'.date("Y-m-d").'%") as t1
                  join (Select count(id) as pending_total,code from upload_file where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="" and date(created_at)!="'.date("Y-m-d").'") as p1
                  join(Select count(id) as visit_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'")) as t2
                  join(Select count(id) as outoftat_total,code from upload_file where CASE WHEN date(rv_visit_date)="'.date("Y-m-d").'" THEN rv_visit_date > tat_end WHEN date(bv_dt_of_cpv)="'.date("Y-m-d").'" THEN  bv_dt_of_cpv > tat_end END) as t3
                  join(Select count(id) as positiveresolved_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") and rv_fi_status="Positive") as t4
                  join(Select count(id) as negativeresolved_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") and rv_fi_status="Negative") as t5
				   join (Select count(id) as pending_total,code from upload_file where (date(rv_visit_date) like "%'.date("Y-m-d").'%" or date(bv_dt_of_cpv) like "%'.date("Y-m-d").'%") /** and date(created_at)!="'.date("Y-m-d").'" */ ) as p2
                  where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status=""
                  UNION
                  select 
                  first_name,
                  employee_unique_id,
            	   role_group,
            	   
            	    (CASE WHEN t.total is not NULL THEN t.total ELSE 0 END)+(CASE WHEN p2.pending_total is not NULL THEN p2.pending_total ELSE 0 END) as total,
                  CASE WHEN t1.inprogress_total is not NULL THEN t1.inprogress_total ELSE 0 END as inprogress_total,
                  CASE WHEN p1.pending_total is not NULL THEN p1.pending_total ELSE 0 END as pending_total,
                  CASE WHEN t2.visit_total is not NULL THEN t2.visit_total ELSE 0 END as visit_total,
                  CASE WHEN t3.outoftat_total is not NULL THEN t3.outoftat_total ELSE 0 END as outoftat_total,
                  CASE WHEN t4.positiveresolved_total is not NULL THEN t4.positiveresolved_total ELSE 0 END as positiveresolved_total,
                  CASE WHEN t5.negativeresolved_total is not NULL THEN t5.negativeresolved_total ELSE 0 END as negativeresolved_total
                  from login as log
                  left join(Select count(id) as total,code from upload_file where status!="Resolved" group by code) as t on t.code=log.employee_unique_id
                  left join(Select count(id) as inprogress_total,code from upload_file where created_at like "%'.date("Y-m-d").'%" and rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="" group by code) as t1 on t1.code=log.employee_unique_id
                  left join(Select count(id) as pending_total,code from upload_file where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="" and status!="Resolved" and date(created_at)!="'.date("Y-m-d").'" group by code) as p1 on p1.code=log.employee_unique_id
                  left join(Select count(id) as visit_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") group by code) as t2 on t2.code=log.employee_unique_id
                  left join(Select count(id) as outoftat_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") and CASE WHEN rv_visit_date!="0000-00-00 00:00:00" THEN rv_visit_date > tat_end WHEN bv_dt_of_cpv!="0000-00-00 00:00:00" THEN  bv_dt_of_cpv > tat_end END group by code) as t3 on t3.code=log.employee_unique_id
                  left join(Select count(id) as positiveresolved_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") and rv_fi_status="Positive" group by code) as t4 on t4.code=log.employee_unique_id
                  left join(Select count(id) as negativeresolved_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") and rv_fi_status="Negative" group by code) as t5 on t5.code=log.employee_unique_id
				   left join (Select count(id) as pending_total,code from upload_file where (date(rv_visit_date) like "%'.date("Y-m-d").'%" or date(bv_dt_of_cpv) like "%'.date("Y-m-d").'%") /** and date(created_at)!="'.date("Y-m-d").'" */ group by code) as p2 on p2.code=log.employee_unique_id
                 Where role_group="FA" and status="active"
                  ';
	   $query = $this->db->query($sql);
	   return $query->result_array();
	    } catch (Exception $ex) {
	        throw $ex;
	    }
	}


// 	function make_total_datatables_agent()
// 	{
// 	    try {
	        
// 	        $sql = 'select  "Total" as first_name, 
// 		           "Test_Total" as employee_unique_id, 
//                   "FA" as role_group,
//                  (CASE WHEN count(t.id) is not NULL THEN count(t.id) ELSE 0 END) + (CASE WHEN p2.pending_total is not NULL THEN p2.pending_total ELSE 0 END) as total,
//                   CASE WHEN t1.inprogress_total is not NULL THEN t1.inprogress_total ELSE 0 END as inprogress_total,
//                   CASE WHEN p1.pending_total is not NULL THEN p1.pending_total ELSE 0 END as pending_total,
//                   CASE WHEN t2.visit_total is not NULL THEN t2.visit_total ELSE 0 END as visit_total,
//                   CASE WHEN t3.outoftat_total is not NULL THEN t3.outoftat_total ELSE 0 END as outoftat_total,
//                   CASE WHEN t4.positiveresolved_total is not NULL THEN t4.positiveresolved_total ELSE 0 END as positiveresolved_total,
//                   CASE WHEN t5.negativeresolved_total is not NULL THEN t5.negativeresolved_total ELSE 0 END as negativeresolved_total
//                   from upload_file as t
//                   join (Select count(id) as inprogress_total,code from upload_file where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status=""  and date(created_at) like "%'.date("Y-m-d").'%") as t1
//                   join (Select count(id) as pending_total,code from upload_file where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="" and date(created_at)!="'.date("Y-m-d").'") as p1
//                   join(Select count(id) as visit_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'")) as t2
//                   join(Select count(id) as outoftat_total,code from upload_file where CASE WHEN date(rv_visit_date)="'.date("Y-m-d").'" THEN rv_visit_date > tat_end WHEN date(bv_dt_of_cpv)="'.date("Y-m-d").'" THEN  bv_dt_of_cpv > tat_end END) as t3
//                   join(Select count(id) as positiveresolved_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") and rv_fi_status="Positive") as t4
//                   join(Select count(id) as negativeresolved_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") and rv_fi_status="Negative") as t5
// 				   join (Select count(id) as pending_total,code from upload_file where (date(rv_visit_date) like "%'.date("Y-m-d").'%" or date(bv_dt_of_cpv) like "%'.date("Y-m-d").'%") and date(created_at)!="'.date("Y-m-d").'") as p2
//                   where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status=""
//                   UNION
//                   select 
//                   first_name,
//                   employee_unique_id,
//             	   role_group,
            	   
//             	    (CASE WHEN t.total is not NULL THEN t.total ELSE 0 END)+(CASE WHEN p2.pending_total is not NULL THEN p2.pending_total ELSE 0 END) as total,
//                   CASE WHEN t1.inprogress_total is not NULL THEN t1.inprogress_total ELSE 0 END as inprogress_total,
//                   CASE WHEN p1.pending_total is not NULL THEN p1.pending_total ELSE 0 END as pending_total,
//                   CASE WHEN t2.visit_total is not NULL THEN t2.visit_total ELSE 0 END as visit_total,
//                   CASE WHEN t3.outoftat_total is not NULL THEN t3.outoftat_total ELSE 0 END as outoftat_total,
//                   CASE WHEN t4.positiveresolved_total is not NULL THEN t4.positiveresolved_total ELSE 0 END as positiveresolved_total,
//                   CASE WHEN t5.negativeresolved_total is not NULL THEN t5.negativeresolved_total ELSE 0 END as negativeresolved_total
//                   from login as log
//                   left join(Select count(id) as total,code from upload_file where status!="Resolved" group by code) as t on t.code=log.employee_unique_id
//                   left join(Select count(id) as inprogress_total,code from upload_file where created_at like "%'.date("Y-m-d").'%" and rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="" group by code) as t1 on t1.code=log.employee_unique_id
//                   left join(Select count(id) as pending_total,code from upload_file where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="" and status!="Resolved" and date(created_at)!="'.date("Y-m-d").'" group by code) as p1 on p1.code=log.employee_unique_id
//                   left join(Select count(id) as visit_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") group by code) as t2 on t2.code=log.employee_unique_id
//                   left join(Select count(id) as outoftat_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") and CASE WHEN rv_visit_date!="0000-00-00 00:00:00" THEN rv_visit_date > tat_end WHEN bv_dt_of_cpv!="0000-00-00 00:00:00" THEN  bv_dt_of_cpv > tat_end END group by code) as t3 on t3.code=log.employee_unique_id
//                   left join(Select count(id) as positiveresolved_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") and rv_fi_status="Positive" group by code) as t4 on t4.code=log.employee_unique_id
//                   left join(Select count(id) as negativeresolved_total,code from upload_file where (date(rv_visit_date)="'.date("Y-m-d").'" or date(bv_dt_of_cpv)="'.date("Y-m-d").'") and rv_fi_status="Negative" group by code) as t5 on t5.code=log.employee_unique_id
// 				   left join (Select count(id) as pending_total,code from upload_file where (date(rv_visit_date) like "%'.date("Y-m-d").'%" or date(bv_dt_of_cpv) like "%'.date("Y-m-d").'%") and date(created_at)!="'.date("Y-m-d").'" group by code) as p2 on p2.code=log.employee_unique_id
//                  Where role_group="FA" and status="active"
//                   ';
// 	   $query = $this->db->query($sql);
// 	   return $query->result_array();
// 	    } catch (Exception $ex) {
// 	        throw $ex;
// 	    }
// 	}


    function make_total_datatables_agentfilterwise($from, $to)
	{
	    try {
	        
	    $sql = 'select  "Total" as first_name,
		"Test_Total" as employee_unique_id,
        "FA" as role_group,
       (CASE WHEN count(id) is not NULL THEN count(id) ELSE 0 END)+(CASE WHEN p2.pending_total is not NULL THEN p2.pending_total ELSE 0 END) as total,
       CASE WHEN t1.inprogress_total is not NULL THEN t1.inprogress_total ELSE 0 END as inprogress_total,
       CASE WHEN p1.pending_total is not NULL THEN p1.pending_total ELSE 0 END as pending_total,
       CASE WHEN t2.visit_total is not NULL THEN t2.visit_total ELSE 0 END as visit_total,
       CASE WHEN t3.outoftat_total is not NULL THEN t3.outoftat_total ELSE 0 END as outoftat_total,
       CASE WHEN t4.positiveresolved_total is not NULL THEN t4.positiveresolved_total ELSE 0 END as positiveresolved_total,
       CASE WHEN t5.negativeresolved_total is not NULL THEN t5.negativeresolved_total ELSE 0 END as negativeresolved_total
       from upload_file
       join (Select count(id) as inprogress_total,code from upload_file where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="" and created_at like "%'.date("Y-m-d").'%" and date(created_at) between "'.$from.'" and "'.$to.'") as t1
       join (Select count(id) as pending_total,code from upload_file where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="" and date(created_at)!="'.date("Y-m-d").'") as p1
       join(Select count(id) as visit_total,code from upload_file where (date(rv_visit_date) between "'.$from.'" and "'.$to.'" or date(bv_dt_of_cpv) between "'.$from.'" and "'.$to.'")) as t2
       join(Select count(id) as outoftat_total,code from upload_file where CASE WHEN date(rv_visit_date) between "'.$from.'" and "'.$to.'" THEN rv_visit_date > tat_end WHEN date(bv_dt_of_cpv) between "'.$from.'" and "'.$to.'" THEN  bv_dt_of_cpv > tat_end END and date(created_at) between "'.$from.'" and "'.$to.'") as t3
       join(Select count(id) as positiveresolved_total,code from upload_file where (date(rv_visit_date) between "'.$from.'" and "'.$to.'" or date(bv_dt_of_cpv) between "'.$from.'" and "'.$to.'") and rv_fi_status="Positive") as t4
       join(Select count(id) as negativeresolved_total,code from upload_file where (date(rv_visit_date) between "'.$from.'" and "'.$to.'" or date(bv_dt_of_cpv) between "'.$from.'" and "'.$to.'") and rv_fi_status="Negative") as t5
	   join (Select count(id) as pending_total,code from upload_file where (date(rv_visit_date) between "'.$from.'" and "'.$to.'" or date(bv_dt_of_cpv) between "'.$from.'" and "'.$to.'") and date(created_at)!="'.date("Y-m-d").'") as p2
       where (rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="") or (date(created_at) between "'.$from.'" and "'.$to.'" and rv_fi_status="")
       UNION
       select
       first_name,
       employee_unique_id,
	   role_group,
	   (CASE WHEN t.total is not NULL THEN t.total ELSE 0 END)+(CASE WHEN p2.pending_total is not NULL THEN p2.pending_total ELSE 0 END) as total,
       CASE WHEN t1.inprogress_total is not NULL THEN t1.inprogress_total ELSE 0 END as inprogress_total,
       CASE WHEN p1.pending_total is not NULL THEN p1.pending_total ELSE 0 END as pending_total,
       CASE WHEN t2.visit_total is not NULL THEN t2.visit_total ELSE 0 END as visit_total,
       CASE WHEN t3.outoftat_total is not NULL THEN t3.outoftat_total ELSE 0 END as outoftat_total,
       CASE WHEN t4.positiveresolved_total is not NULL THEN t4.positiveresolved_total ELSE 0 END as positiveresolved_total,
       CASE WHEN t5.negativeresolved_total is not NULL THEN t5.negativeresolved_total ELSE 0 END as negativeresolved_total
       from login as log
       left join(Select count(id) as total,code from upload_file where (rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="") or (date(created_at) between "'.$from.'" and "'.$to.'" and rv_fi_status="") group by code) as t on t.code=log.employee_unique_id
       left join(Select count(id) as inprogress_total,code from upload_file where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="" and created_at like "%'.date("Y-m-d").'%" and date(created_at) between "'.$from.'" and "'.$to.'" group by code) as t1 on t1.code=log.employee_unique_id
       left join(Select count(id) as pending_total,code from upload_file where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00" and rv_fi_status="" and date(created_at)!="'.date("Y-m-d").'" group by code) as p1 on p1.code=log.employee_unique_id
       left join(Select count(id) as visit_total,code from upload_file where (date(rv_visit_date) between "'.$from.'" and "'.$to.'" or date(bv_dt_of_cpv) between "'.$from.'" and "'.$to.'") group by code) as t2 on t2.code=log.employee_unique_id
       left join(Select count(id) as outoftat_total,code from upload_file where CASE WHEN date(rv_visit_date) between "'.$from.'" and "'.$to.'" THEN rv_visit_date > tat_end WHEN date(bv_dt_of_cpv) between "'.$from.'" and "'.$to.'" THEN  bv_dt_of_cpv > tat_end END and date(created_at) between "'.$from.'" and "'.$to.'" group by code) as t3 on t3.code=log.employee_unique_id
       left join(Select count(id) as positiveresolved_total,code from upload_file where (date(rv_visit_date) between "'.$from.'" and "'.$to.'" or date(bv_dt_of_cpv) between "'.$from.'" and "'.$to.'") and rv_fi_status="Positive" group by code) as t4 on t4.code=log.employee_unique_id
       left join(Select count(id) as negativeresolved_total,code from upload_file where (date(rv_visit_date) between "'.$from.'" and "'.$to.'" or date(bv_dt_of_cpv) between "'.$from.'" and "'.$to.'") and rv_fi_status="Negative" group by code) as t5 on t5.code=log.employee_unique_id
	   left join (Select count(id) as pending_total,code from upload_file where (date(rv_visit_date) between "'.$from.'" and "'.$to.'" or date(bv_dt_of_cpv) between "'.$from.'" and "'.$to.'") and date(created_at)!="'.date("Y-m-d").'" group by code) as p2 on p2.code=log.employee_unique_id
       Where role_group="FA"';
	        $query = $this->db->query($sql);
	        return $query->result_array();
	    } catch (Exception $ex) {
	        throw $ex;
	    }
	}
    
public function getTotalCountCase($employee_unique_id)
	{
		try {
			$sql = 'select count(id) as total,
                   t1.inprogress_total,
                   t2.visit_total,
                   t3.outoftat_total,
                   t4.positiveresolved_total,
                   t5.negativeresolved_total
                   from upload_file
                   join (Select count(id) as inprogress_total,code from upload_file where rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00") as t1
                   join(Select count(id) as visit_total,code from upload_file where (rv_visit_date!="0000-00-00 00:00:00" or bv_dt_of_cpv!="0000-00-00 00:00:00")) as t2
                   join(Select count(id) as outoftat_total,code from upload_file where CASE WHEN rv_visit_date!="0000-00-00 00:00:00" THEN rv_visit_date > tat_end WHEN bv_dt_of_cpv!="0000-00-00 00:00:00" THEN  bv_dt_of_cpv > tat_end END) as t3
                   join(Select count(id) as positiveresolved_total,code from upload_file where rv_fi_status="Positive") as t4
                   join(Select count(id) as negativeresolved_total,code from upload_file where rv_fi_status="Negative") as t5
                   where 1
                   Union
                   select count(id) as total,
                   t1.inprogress_total,
                   t2.visit_total,
                   t3.outoftat_total,
                   t4.positiveresolved_total,
                   t5.negativeresolved_total
                   from upload_file
                   join(Select count(id) as inprogress_total,code from upload_file where created_at like date("Y-m-d") and rv_visit_date="0000-00-00 00:00:00" and bv_dt_of_cpv="0000-00-00 00:00:00") as t1 
                   join(Select count(id) as visit_total,code from upload_file where created_at like date("Y-m-d") and (rv_visit_date!="0000-00-00 00:00:00" or bv_dt_of_cpv!="0000-00-00 00:00:00")) as t2 
                   join(Select count(id) as outoftat_total,code from upload_file where created_at like date("Y-m-d") and CASE WHEN rv_visit_date!="0000-00-00 00:00:00" THEN rv_visit_date > tat_end WHEN bv_dt_of_cpv!="0000-00-00 00:00:00" THEN  bv_dt_of_cpv > tat_end END) as t3 
                   join(Select count(id) as positiveresolved_total,code from upload_file where created_at like date("Y-m-d") and rv_fi_status="Positive") as t4 
                   join(Select count(id) as negativeresolved_total,code from upload_file where created_at like date("Y-m-d") and rv_fi_status="Negative") as t5 
                   Where created_at like date("Y-m-d")
                   and code="'.$employee_unique_id.'"';
			$query = $this->db->query($sql);
			return $query->result_array();
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

	


// count records and show in dashbaord
public function countAllTotal()
{
	try {
	   //  $this->db->where("code", $employee_unique_id);
    //     $this->db->like("created_at",date('Y-m-d'));
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
	   // $status = "inactive";
       $this->db->where("code", $employee_unique_id);
    //   $this->db->like("created_at",date('Y-m-d'));
        // $this->db->where("status", $status);
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

// function agentfilterwise($val)
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

function agentfilterwise($val)
	{
	   // echo $val;die();
		try {
			// $status = 'FA';


			$this->db->where("uf.first_name", $val);
			// $this->db->where("a.role_group", $status);
			$this->db->select("*");
// 			$this->db->join('login a', 'a.employee_unique_id = uf.code', 'left');
			$this->db->from('login uf');
			$query = $this->db->get();
			// print_r($query->result());die;
			return $query;
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

 public function getAgentVisitDates($employee_unique_id) {
        $this->db->select_min('rv_visit_date', 'first_visit_date');
        $this->db->select_max('rv_visit_date', 'last_visit_date');
        $this->db->like("created_at", date('Y-m-d'));
        $this->db->where("code", $employee_unique_id); // Replace 'agent_name' with the actual column name that stores agent names
        $this->db->from('upload_file'); // Replace 'database' with the actual table name
        $query = $this->db->get();
        
        return $query->row();
    }


	
}
