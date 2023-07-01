<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('case_form_model');
    }

    public function index()
    {
        //load session library
        $this->load->library('session');
        //restrict users to go back to login if session has been set
        if ($this->session->userdata('user')) {
            redirect('home');
        } else {
            $this->load->view('login_page');
        }
    }

  
    public function dashboard_function()
    {
        //load session library
        $this->load->library('session');
        
        //restrict users to go to home if not logged in
        if ($this->session->userdata('user')) {
            
            $this->load->view('dashboard');
        } else {
            redirect('/');
        }
    }
    
      public function showDataTable() {
        $this->load->model('Dashboard_model');
        $data['agentVisitDates'] = $this->Dashboard_model->getAgentVisitDates();
        $this->load->view('dashboard', $data);
    }




    public function TotalCount() {
        // if ($this->session->userdata('user')) {
            // check user logged in
            $user_data = $this->session->userdata('user');// session data of user store in $user_data variable
            $countTotal = $this->Dashboard_model->countAllTotal();
            $data = [
                'countTotal' => $countTotal,
            ];
            // $this->render_page('assign_case', array('data' => array('active_menu' => 'dashboard', 'countTotal' => $data)));
           $this->load->view('dashboard', array('user' => $user_data, 'data' => array('active_menu' => 'dashboard', 'countTotal' => $data)));
        // } else {
        //     return redirect();
        // }
    }


    function fetch_all_agent()
    {
        try {
            $this->load->model("Dashboard_model");
            $fetch_case = $this->Dashboard_model->make_total_datatables_agent();
            
            $data = array();

            foreach ($fetch_case as $row) {
                $sub_array = array();
                $sub_array[] = '<a href="' .  base_url() . 'index.php/Assign_case_controller/assign_case_function/' . $row['employee_unique_id'] . '">' . $row['first_name'] . '</a>';
                // $sub_array[] = $row->first_name;
                $sub_array[] = $row['total'];//$row->total;
                $sub_array[] = $row['inprogress_total'];
                $sub_array[] = $row['pending_total'];
                $sub_array[] = $row['visit_total'];
                $sub_array[] = $row['outoftat_total'];
                $sub_array[] = $row['positiveresolved_total'];
                $sub_array[] = $row['negativeresolved_total'];
                $sub_array[] = $row->positive_verified;
                $sub_array[] = $row->negative_verified;
                $data[] = $sub_array;
                
            }
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => $this->Dashboard_model->get_all_data_agent(),
                // "recordsFiltered" => $this->Dashboard_model->get_filtered_data_agent(),
                "data" => $data
            );
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login_page', array('error' => $error));
        }
    }
    
   
   
   
    public function fetch_all_agentfilterwise()
    {
        
        $val = $_POST['val'];
        //echo $code;die();
        $tbdy = '';
        $this->load->model("Dashboard_model");
        $fetch_case = $this->Dashboard_model->make_total_datatables_agentfilterwise($from, $to);
        
        $data = array();
        if (count($fetch_case) > 0) {
        foreach ($fetch_case as $row) {
            ?>
            
            </tr>
                <tr>
                     <td><a href='https://verification.realbitscoders.com/Assign_case_controller/assign_case_function/<?php echo $row['employee_unique_id'] ?>'><?= $row['first_name'] ?></a></td>
                    <td><?= $row['total']; ?></td>
                    <td><?= $row['inprogress_total']; ?></td>
                    <td><?= $row['pending_total']; ?></td>
                    <td><?= $row['visit_total']; ?></td>
                    <td><?= $row['outoftat_total']; ?></td>
                    <td><?= $row['positiveresolved_total']; ?></td>
                    <td><?= $row['negativeresolved_total']; ?></td>
               </tr>
                <?php } ?>
        <?php } else { ?>

            <tr>
                <td colspan="5">No Records Found</td>
            </tr>
            <tr></tr>

        <?php }
    }
   
   
    public function agentFilterDashboard()
{
    $val = $_POST['val'];

    $tbdy = '';
    $this->load->model("Dashboard_model");
    $fetch_agent = $this->Dashboard_model->agentfilterwise($val);
    
    // Pass $val as the second argument to the function
    // $total_datatables = $this->Dashboard_model->make_total_datatables_agentfilterwise($val);

    $data = array();
    if (count($fetch_agent) > 0) {
        foreach ($fetch_agent as $row) {
            ?>
            <tr>
                <td><a href='<?php base_url() ?>index.php/Assign_case_controller/assign_case_function/<?php echo $row['employee_unique_id'] ?>'><?= $row['first_name'] ?></a></td>
                <td><?= $row['total']; ?></td>
                <td><?= $row['inprogress_total']; ?></td>
                <td><?= $row['pending_total']; ?></td>
                <td><?= $row['visit_total']; ?></td>
                <td><?= $row['outoftat_total']; ?></td>
                <td><?= $row['positiveresolved_total']; ?></td>
                <td><?= $row['negativeresolved_total']; ?></td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="5">No Records Found</td>
        </tr>
        <?php
    }
}



    // function fetch_all_agent()
    // {
    //     try {
    //         $this->load->model("Dashboard_model");
    //         $fetch_case = $this->Dashboard_model->make_datatables_agent();
    //         $data = array();

    //         foreach ($fetch_case as $row) {
    //             $sub_array = array();
    //             // $sub_array[] = '<a href="' .  base_url() . 'index.php/Assign_case_controller/assign_case_function/' . $row->employee_unique_id . '">' . $row->first_name . '</a>';
    //            $sub_array[] = '<a href="' .  base_url() . 'index.php/Assign_case_controller/assign_case_function/' . $row->agent_code . '">' . $row->agent . '</a>';

    //             $sub_array[] = $row->total;
    //             $sub_array[] = $row->inprogress;
    //             $sub_array[] = $row->out_of_tat;
    //             $sub_array[] = $row->positive_resolved;
    //             $sub_array[] = $row->negative_resolved;
    //             $sub_array[] = $row->positive_verified;
    //             $sub_array[] = $row->negative_verified;
    //             $data[] = $sub_array;
    //         }
    //         $output = array(
    //             "draw" => intval($_POST["draw"]),
    //             "recordsTotal" => $this->Dashboard_model->get_all_data_agent(),
    //             "recordsFiltered" => $this->Dashboard_model->get_filtered_data_agent(),
    //             "data" => $data
    //         );
    //         echo json_encode($output);
    //     } catch (Exception $ex) {
    //         $error['error'] = TRUE;
    //         $error['message'] = $ex->getMessage();
    //         $this->load->view('login_page', array('error' => $error));
    //     }
    // }


    // function fetch_single_case() {
    //     try {
    //         $output = array();
    //         $this->load->model("Dashboard_model");
    //         $data = $this->Dashboard_model->fetch_single_cases($_POST["user_id"]);
    //         foreach ($data as $row) {

    //             $output['id'] = $row->id;
    //             $output['bank_name'] = $row->bank_name;
    //             $output['product'] = $row->product;
    //             // $output['status'] = $row->status;
    //             // $output['value'] = $row->value;
    //             // $output['course_type'] = $row->course_type;
    //             // $output['course_id'] = $row->course_id;
    //         }
    //         echo json_encode($output);
    //     } catch (Exception $ex) {
    //         $error['error'] = TRUE;
    //         $error['message'] = $ex->getMessage();
    //         $this->load->view('login', array('error' => $error));
    //     }
    // }
}
