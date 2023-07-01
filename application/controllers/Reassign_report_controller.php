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

    
    public function fetch_all_transferedCases()
    {
        try {
            $this->load->model("Reassign_report_model");
            $fetch_reassign_case = $this->Reassign_report_model->make_datatables_Transactions();
            $data = array();
            // $i=1;

            foreach ($fetch_reassign_case as $row) {
                $sub_array = array();

                
               
                // $sub_array[] = $i;
                $sub_array[] = $row->id;
                $sub_array[] = $row->application_id;
                // $sub_array[] = $row->id;
                $sub_array[] = $row->bank_name;
                $sub_array[] = $row->fi_to_be_conducted;
                $sub_array[] = $row->assign_from;
                $sub_array[] = $row->assign_to;
                $sub_array[] = formatdate($row->transfer_date,'d-m-Y h:i A');
                $sub_array[] = formatdate($row->created_at,'d-m-Y h:i A');
                $sub_array[] = $row->reassign_remarks;
                // $sub_array[] = $row->remarks;
                // $i++;
               
                $data[] = $sub_array;
            }
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => $this->Reassign_report_model->get_all_data_Transactions(),
                "recordsFiltered" => $this->Reassign_report_model->get_filtered_data_Transactions(),
                "data" => $data,
            );
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = true;
            $error['message'] = $ex->getMessage();
            echo json_encode($error);
            // $this->load->view('login_page', array('error' => $error));
        }
    }


    public function filterDatewise()
    {

        $from = $_POST['from'];
        $to = $_POST['to'];
        $code = $_POST['code'];
        //echo $code;die();
        $tbdy = '';
        $fetch_data = $this->Assign_case_model->filter_Createdate($from, $to, $code);
        $numrows = $fetch_data->num_rows();
        //echo $numrows;die("iii");
        if ($numrows > 0) {
?>
            <?php foreach ($fetch_data->result() as $key => $rows) :
            ?>
                <tr>

                <th width="6%">ID</th>
                        <th width="10%">Application ID</th>
                        <!-- <th width="10%">ID name</th> -->
                        <th width="10%">Bank</th>
                        <th width="10%">FI Type</th>
                        <th width="10%">From</th>
                        <th width="10%">To</th>
                        <th width="10%">Transfer Date</th>
                        <th width="10%">Case Created Date</th>
                        <th width="10%">Remark</th>
                <tr>
                    <td><?= $rows->uid; ?></td>
                    <td><?= $rows->application_id; ?></td>
                    <td><?= $rows->bank_name; ?></td>
                    <td><?= $rows->fi_type; ?></td>
                    <td><?= $rows->assign_from; ?></td>
                    <td><?= $rows->assign_to; ?></td>
                    <td><?= $rows->status; ?></td>
                   
                </tr>
            <?php endforeach; ?>
            <tr></tr>
        <?php } else { ?>

            <tr>
                <td colspan="5">No Records Found</td>
            </tr>
            <tr></tr>

        <?php }
    }




}
