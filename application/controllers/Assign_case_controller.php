<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assign_case_controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Assign_case_model');
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



    public function assign_case_function($data)
    {


        $this->load->library('session');
        if ($this->session->userdata('user')) {
            $this->load->model("Assign_case_model");
            $fetch_data['allAgent'] = $this->Assign_case_model->filter_assignee($data);
            $fetch_data['data'] = $data;

            $this->load->view('assign_case', $fetch_data);
        } else {
            redirect('/');
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
                <tr>
                    <td><input type="checkbox" id="assign" value='<?= $rows->uid; ?>' name="assign"></td>
                    <td><?= $rows->uid; ?></td>
                    <td><?= $rows->application_id; ?></td>
                    <td><?= $rows->customer_name; ?></td>
                    <td><?= $rows->business_address; ?></td>
                    <td><?= $rows->fi_to_be_conducted; ?></td>
                    <td><?= $rows->tat_start; ?></td>
                    <td><?= $rows->tat_end; ?></td>
                    <td><?= $rows->status; ?></td>
                    <td>
                        <?php

                        if ($rows->fi_to_be_conducted == 'BV') { ?>
                            <button type="button" name="view" id="<?= $rows->uid; ?>" title="BV View Data" class="btn btn-info btn-sm bv_view_details"><i class="fa fa-users"></i></button>
                        <?php } else { ?>
                            <button type="button" name="view" id="<?= $rows->uid; ?>" title="RV View data" class="btn btn-warning btn-sm fi_type_view_data"><i class="fa fa-users"></i></button>
                        <?php  } ?>
                        ?>
                        <button type="button" name="view" id="<?= $rows->uid; ?>" title="View case" class="btn btn-success btn-sm view_assigned_case"><i class="fa fa-eye"></i></button>
                        <!-- <button type="button" name="view" id="<?= $rows->uid; ?>" title="View App end data" class="btn btn-info btn-sm view_app_end_assigned_case"><i class="fa fa-book"></i></button> -->
                        <button type="button" name="edit" id="<?= $rows->uid; ?>" title="Edit case" class="btn btn-info btn-sm edit_assigned_case"><i class="fa fa-pencil"></i></button>
                        <button type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-primary btn-sm reassigned_case"><i class="fa fa-users"></i></button>
                        <button type="button" name="rv_edit" id="<?= $rows->uid; ?>" title="RV Edit" class="btn btn-info btn-sm rv_edit_details"><i class="fa fa-edit"></i></button>
                        <button type="button" name="bv_edit" id="<?= $rows->uid; ?>" title="BV Edit" class="btn btn-warning btn-sm bv_edit_details"><i class="fa fa-pencil"></i></button>

                    </td>
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


    public function filterfitype()
    {
        $val = $_POST['val'];
        $code = $_POST['code'];

        $tbdy = '';
        $fetch_data = $this->Assign_case_model->filter_fitype($val, $code);
        $numrows = $fetch_data->num_rows();
        if ($numrows > 0) {
        ?>
            <?php foreach ($fetch_data->result() as $key => $rows) :
            ?>
                <tr>
                <tr>
                    <td><input type="checkbox" id="assign" value='<?= $rows->uid; ?>' name="assign"></td>
                    <td><?= $rows->uid; ?></td>
                    <td><?= $rows->application_id; ?></td>
                    <td><?= $rows->customer_name; ?></td>
                    <td><?= $rows->business_address; ?></td>
                    <td><?= $rows->fi_to_be_conducted; ?></td>
                    <td><?= $rows->tat_start; ?></td>
                    <td><?= $rows->tat_end; ?></td>
                    <td><?= $rows->status; ?></td>
                    <td>
                        <button type="button" name="view" id="<?= $rows->uid; ?>" title="View case" class="btn btn-success btn-sm view_assigned_case"><i class="fa fa-eye"></i></button>
                        <!-- <button type="button" name="view" id="<?= $rows->uid; ?>" title="View App end data" class="btn btn-info btn-sm view_app_end_assigned_case"><i class="fa fa-book"></i></button> -->
                        <button type="button" name="edit" id="<?= $rows->uid; ?>" title="Edit case" class="btn btn-info btn-sm edit_assigned_case"><i class="fa fa-pencil"></i></button>
                        <button type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-primary btn-sm reassigned_case"><i class="fa fa-users"></i></button>
                        <button type="button" name="view" id="<?= $rows->uid; ?>" title="RV View data" class="btn btn-warning btn-sm fi_type_view_data"><i class="fa fa-users"></i></button>
                        <button type="button" name="view" id="<?= $rows->uid; ?>" title="BV View Data" class="btn btn-info btn-sm bv_view_details"><i class="fa fa-users"></i></button>
                        <button type="button" name="rv_edit" id="<?= $rows->uid; ?>" title="RV Edit" class="btn btn-info btn-sm rv_edit_details"><i class="fa fa-edit"></i></button>
                        <button type="button" name="bv_edit" id="<?= $rows->uid; ?>" title="BV Edit" class="btn btn-warning btn-sm bv_edit_details"><i class="fa fa-pencil"></i></button>

                    </td>
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


    public function filterStatus()
    {
        $val = $_POST['val'];
        $code = $_POST['code'];

        $tbdy = '';
        $fetch_data = $this->Assign_case_model->filter_status($val, $code);
        $numrows = $fetch_data->num_rows();
        if ($numrows > 0) {
        ?>
            <?php foreach ($fetch_data->result() as $key => $rows) :
            ?>
                <tr>
                <tr>
                    <td><input type="checkbox" id="assign" value='<?= $rows->uid; ?>' name="assign"></td>
                    <td><?= $rows->uid; ?></td>
                    <td><?= $rows->application_id; ?></td>
                    <td><?= $rows->customer_name; ?></td>
                    <td><?= $rows->business_address; ?></td>
                    <td><?= $rows->fi_to_be_conducted; ?></td>
                    <td><?= $rows->tat_start; ?></td>
                    <td><?= $rows->tat_end; ?></td>
                    <td><?= $rows->status; ?></td>
                    <td>
                        <button type="button" name="view" id="<?= $rows->uid; ?>" title="View case" class="btn btn-success btn-sm view_assigned_case"><i class="fa fa-eye"></i></button>
                        <!-- <button type="button" name="view" id="<?= $rows->uid; ?>" title="View App end data" class="btn btn-info btn-sm view_app_end_assigned_case"><i class="fa fa-book"></i></button> -->
                        <button type="button" name="edit" id="<?= $rows->uid; ?>" title="Edit case" class="btn btn-info btn-sm edit_assigned_case"><i class="fa fa-pencil"></i></button>
                        <button type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-primary btn-sm reassigned_case"><i class="fa fa-users"></i></button>
                        <button type="button" name="view" id="<?= $rows->uid; ?>" title="RV View data" class="btn btn-warning btn-sm fi_type_view_data"><i class="fa fa-users"></i></button>
                        <button type="button" name="view" id="<?= $rows->uid; ?>" title="BV View Data" class="btn btn-info btn-sm bv_view_details"><i class="fa fa-users"></i></button>
                        <button type="button" name="rv_edit" id="<?= $rows->uid; ?>" title="RV Edit" class="btn btn-info btn-sm rv_edit_details"><i class="fa fa-edit"></i></button>
                        <button type="button" name="bv_edit" id="<?= $rows->uid; ?>" title="BV Edit" class="btn btn-warning btn-sm bv_edit_details"><i class="fa fa-pencil"></i></button>

                    </td>
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


    function fetch_all_assign_data()
    {
        try {
            $this->load->model("Assign_case_model");
            $fetch_case = $this->Assign_case_model->make_datatables_assign();
            $data = array();

            foreach ($fetch_case as $row) {
                $sub_array = array();
                $buttons = '';
                $buttons .= '';
                $sub_array[] = $row->id;
                $sub_array[] = $row->application_id;
                $sub_array[] = $row->customer_name;
                $sub_array[] = $row->business_address;
                $sub_array[] = $row->fi_to_be_conducted;
                $sub_array[] = $row->tat_start;
                $sub_array[] = $row->tat_end;
                $sub_array[] = $row->status;
                $sub_array[] = $buttons;
                $data[] = $sub_array;
            }
            $output = array(
                "draw" => intval($_POST["draw"]),
                "recordsTotal" => $this->Assign_case_model->get_all_data_assign(),
                "recordsFiltered" => $this->Assign_case_model->get_filtered_data_assign(),
                "data" => $data
            );
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login_page', array('error' => $error));
        }
    }

    function fetch_single_assignee()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_assignee($_POST["user_id"]);
            foreach ($data as $row) {

                $output['application_id'] = $row->application_id;
                $output['customer_name'] = $row->customer_name;
                $output['fi_to_be_conducted'] = $row->fi_to_be_conducted;
                $output['pincode'] = $row->pincode;
                $output['permanent_address'] = $row->permanent_address;
                $output['designation'] = $row->designation;
                $output['product_name'] = $row->product_name;
                $output['residence_address'] = $row->residence_address;
                $output['office_address'] = $row->office_address;
                $output['permanent_address'] = $row->permanent_address;
                $output['dob'] = $row->dob;
                $output['fi_date'] = $row->fi_date;
                $output['source_channel'] = $row->source_channel;
                $output['customer_name'] = $row->customer_name;
                $output['business_address'] = $row->business_address;
                $output['fi_time'] = $row->fi_time;
                $output['fi_flag'] = $row->fi_flag;
                $output['designation'] = $row->designation;
                $output['loan_amount'] = $row->loan_amount;
                $output['station'] = $row->station;
                $output['tat_start'] = $row->tat_start;
                $output['tat_end'] = $row->tat_end;
                $output['business_name'] = $row->business_name;
                $output['assigned_to'] = $row->assigned_to;
                $output['remarks'] = $row->remarks;

                $output['bank_name'] = $row->bank_name;
                $output['city'] = $row->city;
                $output['status'] = $row->status;
                $output['code'] = $row->code;
                $output['amount'] = $row->amount;
                $output['vehicle'] = $row->vehicle;
                $output['co_applicant'] = $row->co_applicant;
                $output['guarantee_name'] = $row->guarantee_name;
                $output['single_agent'] = $row->single_agent;
                $output['geo_limit'] = $row->geo_limit;

                $output['created_at'] = $row->created_at;
                $output['updated_at'] = $row->updated_at;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }

    function fetch_single_rv_data()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_assignee($_POST["user_id"]);
            foreach ($data as $row) {
                $output['application_id'] = $row->application_id;
                $output['customer_name'] = $row->customer_name;
                $output['created_at'] = $row->created_at;
                $output['fi_date'] = $row->fi_date;
                $output['tat_start'] = $row->tat_start;
                $output['city'] = $row->city;
                $output['pincode'] = $row->pincode;
                $output['business_address'] = $row->business_address;
                $output['tat_end'] = $row->tat_end;
                $output['amount'] = $row->amount;
                $output['fi_to_be_conducted'] = $row->fi_to_be_conducted;
                $output['fi_time'] = $row->fi_time;
                $output['bank_name'] = $row->bank_name;
                $output['code'] = $row->code;
                $output['product_name'] = $row->product_name;
                $output['dob'] = $row->dob;
                $output['fi_flag'] = $row->fi_flag;

                $output['geo_limit'] = $row->geo_limit;

                $output['rv_lat'] = $row->rv_lat;
                $output['rv_long'] = $row->rv_long;
                $output['rv_pincode'] = $row->rv_pincode;
                $output['rv_location_add'] = $row->rv_location_add;

                $output['rv_fi_status'] = $row->rv_fi_status;
                $output['rv_make_model'] = $row->rv_make_model;
                $output['rv_loan_amt'] = $row->rv_loan_amt;
                $output['rv_confirm_address'] = $row->rv_confirm_address;
                $output['rv_person_met_details'] = $row->rv_person_met_details;
                $output['rv_relationship'] = $row->rv_relationship;
                $output['rv_residence_ownership'] = $row->rv_residence_ownership;
                $output['rv_stability'] = $row->rv_stability;
                $output['rv_user_permanent_address'] = $row->rv_user_permanent_address;
                $output['rv_rent_per_month'] = $row->rv_rent_per_month;
                $output['rv_details_of_earning_member'] = $row->rv_details_of_earning_member;
                $output['rv_dependent'] = $row->rv_dependent;
                $output['rv_total_family_member'] = $row->rv_total_family_member;
                $output['rv_no_of_earning_members'] = $row->rv_no_of_earning_members;
                $output['rv_user_office_address'] = $row->rv_user_office_address;
                $output['rv_residence_proof'] = $row->rv_residence_proof;
                $output['rv_interior_premises'] = $row->rv_interior_premises;
                $output['rv_exterior_premises'] = $row->rv_exterior_premises;
                $output['rv_agriculture_land'] = $row->rv_agriculture_land;

                $output['rv_neighbour_check1'] = $row->rv_neighbour_check1;
                $output['rv_neighbour_check2'] = $row->rv_neighbour_check2;
                $output['rv_cpv_done_by'] = $row->rv_cpv_done_by;
                $output['rv_visit_date'] = $row->rv_visit_date;
                $output['rv_remarks'] = $row->rv_remarks;
                $output['rv_address_yes_no'] = $row->rv_address_yes_no;
                $output['rv_vehicle_details	'] = $row->rv_vehicle_details;
                $temp_rv_image1 = $row->rv_image1;
                $temp_rv_image2 = $row->rv_image2;
                $temp_rv_image3 = $row->rv_image3;
                $temp_rv_image4 = $row->rv_image4;
                $temp_rv_image5 = $row->rv_image5;
                $temp_rv_image6 = $row->rv_image6;
                $temp_rv_image7 = $row->rv_image7;
                $temp_rv_image8 = $row->rv_image8;
                $temp_rv_image9 = $row->rv_image9;


                if (!empty($row->rv_image1)) {
                    $replace_space_rv = str_replace(' ', '+', $temp_rv_image1);
                    $output['rv_image1'] = '<img class="rv_image1" src="' . $replace_space_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image2)) {
                    $replace_space2_rv = str_replace(' ', '+', $temp_rv_image2);
                    $output['rv_image2'] = '<img class="rv_image2" src="' . $replace_space2_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image3)) {
                    $replace_space3_rv = str_replace(' ', '+', $temp_rv_image3);
                    $output['rv_image3'] = '<img class="rv_image3" src="' . $replace_space3_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image4)) {
                    $replace_space4_rv = str_replace(' ', '+', $temp_rv_image4);
                    $output['rv_image4'] = '<img class="rv_image4" src="' . $replace_space4_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
                
                if (!empty($row->rv_image5)) {
                    $replace_space5_rv = str_replace(' ', '+', $temp_rv_image5);
                    $output['rv_image5'] = '<img class="rv_image5" src="' . $replace_space5_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image6)) {
                    $replace_space6_rv = str_replace(' ', '+', $temp_rv_image6);
                    $output['rv_image6'] = '<img class="rv_image6" src="' . $replace_space6_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
                
                if (!empty($row->rv_image7)) {
                    $replace_space7_rv = str_replace(' ', '+', $temp_rv_image7);
                    $output['rv_image7'] = '<img class="rv_image7" src="' . $replace_space7_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image8)) {
                    $replace_space8_rv = str_replace(' ', '+', $temp_rv_image8);
                    $output['rv_image8'] = '<img class="rv_image8" src="' . $replace_space8_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->rv_image9)) {
                    $replace_space9_rv = str_replace(' ', '+', $temp_rv_image9);
                    $output['rv_image9'] = '<img class="rv_image9" src="' . $replace_space9_rv . '" height="250" width="250">';
                } else {
                    $output['rv_image9'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
                

            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }



    function fetch_single_bv_data()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_assignee($_POST["user_id"]);
            foreach ($data as $row) {

                $output['application_id'] = $row->application_id;
                $output['customer_name'] = $row->customer_name;
                $output['bank_name'] = $row->bank_name;

                $output['fi_to_be_conducted'] = $row->fi_to_be_conducted;
                $output['tcp1_name'] = $row->tcp1_name;
                $output['tcp2_name'] = $row->tcp2_name;
                $output['code'] = $row->code;
                $output['city'] = $row->city;
                $output['pincode'] = $row->pincode;
                $output['amount'] = $row->amount;
                $output['business_address'] = $row->business_address;
                $output['tat_start'] = $row->tat_start;
                $output['tat_end'] = $row->tat_end;
                $output['business_name'] = $row->business_name;
                $output['created_at'] = $row->created_at;
                $output['dob'] = $row->dob;
                $output['fi_time'] = $row->fi_time;
                $output['fi_date'] = $row->fi_date;
                $output['bv_working_since'] = $row->bv_working_since;
                $output['bv_signboard_name'] = $row->bv_signboard_name;
                $output['bv_office_proof'] = $row->bv_office_proof;
                $output['bv_previous_bus_details'] = $row->bv_previous_bus_details;
                $output['bv_fi_status'] = $row->bv_fi_status;

                $output['bv_lat'] = $row->bv_lat;
                $output['bv_long'] = $row->bv_long;
                $output['bv_pincode'] = $row->bv_pincode;
                $output['bv_location_add'] = $row->bv_location_add;

                $output['asset_make'] = $row->asset_make;
                $output['asset_model'] = $row->asset_model;
                $output['amount'] = $row->amount;
                $output['bv_company_name'] = $row->bv_company_name;
                $output['bv_person_met'] = $row->bv_person_met;


                $output['product_name'] = $row->product_name;
                $output['bv_corporate_office'] = $row->bv_corporate_office;
                $output['bv_corporate_office'] = $row->bv_corporate_office;
                $output['bv_person_designation'] = $row->bv_person_designation;
                $output['bv_address_confirmed'] = $row->bv_address_confirmed;
                $output['bv_applicant_designation'] = $row->bv_applicant_designation;
                $output['bv_income'] = $row->bv_income;
                $output['bv_residence_address'] = $row->bv_residence_address;
                $output['bv_business_type'] = $row->bv_business_type;
                $output['bv_no_employee'] = $row->bv_no_employee;
                $output['bv_stocks'] = $row->bv_stocks;
                $output['bv_business_activity'] = $row->bv_business_activity;
                $output['bv_stability'] = $row->bv_stability;
                $output['bv_ownership'] = $row->bv_ownership;
                $output['bv_nature_of_business'] = $row->bv_nature_of_business;
                $output['bv_proof'] = $row->bv_proof;
                $output['bv_vehicle'] = $row->bv_vehicle;
                $output['bv_tcp1'] = $row->bv_tcp1;
                $output['bv_tcp2'] = $row->bv_tcp2;
                $output['bv_verified_name'] = $row->bv_verified_name;
                $output['bv_dt_of_cpv'] = $row->bv_dt_of_cpv;
                $output['bv_remarks'] = $row->bv_remarks;
                $output['status'] = $row->status;

                $temp_bv_image1 = $row->bv_image1;
                $temp_bv_image2 = $row->bv_image2;
                $temp_bv_image3 = $row->bv_image3;
                $temp_bv_image4 = $row->bv_image4;
                $temp_bv_image5 = $row->bv_image5;
                $temp_bv_image6 = $row->bv_image6;
                $temp_bv_image7 = $row->bv_image7;
                $temp_bv_image8 = $row->bv_image8;
                $temp_bv_image9 = $row->bv_image9;


               

                if (!empty($row->bv_image1)) {
                    $replace_space = str_replace(' ', '+', $temp_bv_image1);
                    $output['bv_image1'] = '<img class="bv_image1" src="' . $replace_space . '" height="250" width="250">';
                } else {
                    $output['bv_image1'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image2)) {
                    $replace_space2 = str_replace(' ', '+', $temp_bv_image2);
                    $output['bv_image2'] = '<img class="bv_image2" src="' . $replace_space2 . '" height="250" width="250">';
                } else {
                    $output['bv_image2'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
                if (!empty($row->bv_image3)) {
                    $replace_space3 = str_replace(' ', '+', $temp_bv_image3);
                    $output['bv_image3'] = '<img class="bv_image3" src="' . $replace_space3 . '" height="250" width="250">';
                } else {
                    $output['bv_image3'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image4)) {
                    $replace_space4 = str_replace(' ', '+', $temp_bv_image4);
                    $output['bv_image4'] = '<img class="bv_image4" src="' . $replace_space4 . '" height="250" width="250">';
                } else {
                    $output['bv_image4'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image5)) {
                    $replace_space5 = str_replace(' ', '+', $temp_bv_image5);
                    $output['bv_image5'] = '<img class="bv_image5" src="' . $replace_space5 . '" height="250" width="250">';
                } else {
                    $output['bv_image5'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image6)) {
                    $replace_space6 = str_replace(' ', '+', $temp_bv_image6);
                    $output['bv_image6'] = '<img class="bv_image6" src="' . $replace_space6 . '" height="250" width="250">';
                } else {
                    $output['bv_image6'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image7)) {
                    $replace_space7 = str_replace(' ', '+', $temp_bv_image7);
                    $output['bv_image7'] = '<img class="bv_image7" src="' . $replace_space7 . '" height="250" width="250">';
                } else {
                    $output['bv_image7'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image8)) {
                    $replace_space8 = str_replace(' ', '+', $temp_bv_image8);
                    $output['bv_image8'] = '<img class="bv_image8" src="' . $replace_space8 . '" height="250" width="250">';
                } else {
                    $output['bv_image8'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }

                if (!empty($row->bv_image9)) {
                    $replace_space9 = str_replace(' ', '+', $temp_bv_image9);
                    $output['bv_image9'] = '<img class="bv_image9" src="' . $replace_space9 . '" height="250" width="250">';
                } else {
                    $output['bv_image9'] = '<input type="hidden" name="hidden_user_image" value="" />';
                }
               
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }



    function fetch_single_assignee_from_app_end()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_assignee($_POST["user_id"]);
            foreach ($data as $row) {



                $output['fi_status'] = $row->fi_status;
                $output['make_model'] = $row->make_model;
                $output['loan_amt'] = $row->loan_amt;
                $output['confirm_address'] = $row->confirm_address;
                $output['person_met_details'] = $row->person_met_details;
                $output['relationship'] = $row->relationship;
                $output['stability'] = $row->stability;
                $output['user_permanent_address'] = $row->user_permanent_address;
                $output['rent_per_month'] = $row->rent_per_month;
                $output['total_family_member'] = $row->total_family_member;
                $output['no_of_earning_members'] = $row->no_of_earning_members;
                $output['details_of_earning_members'] = $row->details_of_earning_members;
                $output['dependent'] = $row->dependent;
                $output['user_office_address'] = $row->user_office_address;
                $output['residence_proof'] = $row->residence_proof;
                $output['agriculture_land'] = $row->agriculture_land;
                $output['exterior_premises'] = $row->exterior_premises;
                $output['interior_premises'] = $row->interior_premises;
                $output['cross_verified_info'] = $row->cross_verified_info;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }



    function fetch_single_rv_case()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_case($_POST["user_id"]);
            foreach ($data as $row) {

                $output['id'] = $row->id;
                $output['bank_name'] = $row->bank_name;
                $output['product_name'] = $row->product_name;
               
                $output['rv_fi_status'] = $row->rv_fi_status;
                $output['rv_loan_amt'] = $row->rv_loan_amt;
                $output['rv_confirm_address'] = $row->rv_confirm_address;
                $output['rv_person_met_details'] = $row->rv_person_met_details;
                $output['rv_relationship'] = $row->rv_relationship;
                $output['rv_residence_ownership'] = $row->rv_residence_ownership;
                $output['rv_stability'] = $row->rv_stability;
                $output['rv_user_permanent_address'] = $row->rv_user_permanent_address;
                $output['rv_rent_per_month'] = $row->rv_rent_per_month;
                $output['rv_total_family_member'] = $row->rv_total_family_member;
                $output['rv_dependent'] = $row->rv_dependent;
                $output['rv_user_office_address'] = $row->rv_user_office_address;
                $output['rv_residence_proof'] = $row->rv_residence_proof;
                $output['rv_agriculture_land'] = $row->rv_agriculture_land;
                $output['rv_exterior_premises'] = $row->rv_exterior_premises;
                $output['rv_interior_premises'] = $row->rv_interior_premises;
                $output['rv_cross_verified_info'] = $row->rv_cross_verified_info;
                $output['rv_vehicle_details'] = $row->rv_vehicle_details;
                $output['rv_neighbour_check1'] = $row->rv_neighbour_check1;
                $output['rv_neighbour_check2'] = $row->rv_neighbour_check2;
                $output['rv_cpv_done_by'] = $row->rv_cpv_done_by;
                $output['rv_remarks'] = $row->rv_remarks;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    public function update_rv_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bank_name', 'bank_name', 'required');
            $this->form_validation->set_rules('product_name', 'product_name', 'required');
            $this->form_validation->set_rules('rv_fi_status', 'rv_fi_status', '');
            $this->form_validation->set_rules('rv_loan_amt', 'rv_loan_amt', '');
            $this->form_validation->set_rules('rv_confirm_address', 'rv_confirm_address', '');
            // $this->form_validation->set_rules('rv_address_yes_no', 'rv_address_yes_no', 'required');
            $this->form_validation->set_rules('rv_person_met_details', 'rv_person_met_details', '');
            $this->form_validation->set_rules('rv_relationship', 'rv_relationship', '');
            $this->form_validation->set_rules('rv_residence_ownership', 'rv_residence_ownership', '');
            $this->form_validation->set_rules('rv_stability', 'rv_stability', '');
            $this->form_validation->set_rules('rv_user_permanent_address', 'rv_user_permanent_address', '');
            $this->form_validation->set_rules('rv_rent_per_month', 'rv_rent_per_month', '');
            $this->form_validation->set_rules('rv_total_family_member', 'rv_total_family_member', '');
            $this->form_validation->set_rules('rv_no_of_earning_members', 'rv_no_of_earning_members', '');
            // $this->form_validation->set_rules('rv_details_of_earning_member', 'rv_details_of_earning_member', 'required');
            $this->form_validation->set_rules('rv_dependent', 'rv_dependent', '');
            $this->form_validation->set_rules('rv_user_office_address', 'rv_user_office_address', '');
            $this->form_validation->set_rules('rv_residence_proof', 'rv_residence_proof', '');
            $this->form_validation->set_rules('rv_agriculture_land', 'rv_agriculture_land', '');
            $this->form_validation->set_rules('rv_exterior_premises', 'rv_exterior_premises', '');
            $this->form_validation->set_rules('rv_interior_premises', 'rv_interior_premises', '');
            $this->form_validation->set_rules('rv_cross_verified_info', 'rv_cross_verified_info', '');
            $this->form_validation->set_rules('rv_vehicle_details', 'rv_vehicle_details', '');
            $this->form_validation->set_rules('rv_neighbour_check1', 'rv_neighbour_check1', '');
            $this->form_validation->set_rules('rv_neighbour_check2', 'rv_neighbour_check2', '');
            $this->form_validation->set_rules('rv_cpv_done_by', 'rv_cpv_done_by', '');
            $this->form_validation->set_rules('rv_remarks', 'rv_remarks', '');

            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {

                $rv_cse_id = $_POST["rv_id"];
                $array = array(

                    'bank_name' => $this->input->post('bank_name'),
                    'product_name' => $this->input->post('product_name'),
                    'rv_fi_status' => $this->input->post('rv_fi_status'),
                    'rv_loan_amt' => $this->input->post('rv_loan_amt'),
                    'rv_confirm_address' => $this->input->post('rv_confirm_address'),
                    // 'rv_address_yes_no' => $this->input->post('rv_address_yes_no'),
                    'rv_person_met_details' => $this->input->post('rv_person_met_details'),
                    'rv_relationship' => $this->input->post('rv_relationship'),
                    'rv_residence_ownership' => $this->input->post('rv_residence_ownership'),
                    'rv_stability' => $this->input->post('rv_stability'),
                    'rv_user_permanent_address' => $this->input->post('rv_user_permanent_address'),
                    'rv_rent_per_month' => $this->input->post('rv_rent_per_month'),
                    'rv_total_family_member' => $this->input->post('rv_total_family_member'),
                    'rv_no_of_earning_members' => $this->input->post('rv_no_of_earning_members'),
                    // 'rv_details_of_earning_member' => $this->input->post('rv_details_of_earning_member'),
                    'rv_dependent' => $this->input->post('rv_dependent'),
                    'rv_user_office_address' => $this->input->post('rv_user_office_address'),
                    'rv_residence_proof' => $this->input->post('rv_residence_proof'),
                    'rv_agriculture_land' => $this->input->post('rv_agriculture_land'),
                    'rv_exterior_premises' => $this->input->post('rv_exterior_premises'),
                    'rv_interior_premises' => $this->input->post('rv_interior_premises'),
                    'rv_cross_verified_info' => $this->input->post('rv_cross_verified_info'),
                    'rv_vehicle_details' => $this->input->post('rv_vehicle_details'),
                    'rv_neighbour_check1' => $this->input->post('rv_neighbour_check1'),
                    'rv_neighbour_check2' => $this->input->post('rv_neighbour_check2'),
                    'rv_cpv_done_by' => $this->input->post('rv_cpv_done_by'),
                    'rv_remarks' => $this->input->post('rv_remarks'),

                );

                $this->load->model('Assign_case_model');
                $inserts_id = $this->Assign_case_model->update_rv_data_case($rv_cse_id, $array);
                if ($inserts_id) {
                    $response = array(
                        'success' => true,
                        'message' => "RV Case updated successfully"
                    );
                } else {
                    $response = array(
                        'error' => true,
                        'message' => "Error while saving data !!!!"
                    );
                }
            } else {
                // if error in form validation
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    function fetch_single_bv_case()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_case($_POST["user_id"]);
            foreach ($data as $row) {

                $output['id'] = $row->id;
                $output['bv_corporate_office'] = $row->bv_corporate_office;
                $output['bv_person_designation'] = $row->bv_person_designation;
                $output['bv_address_confirmed'] = $row->bv_address_confirmed;
                $output['bv_applicant_designation'] = $row->bv_applicant_designation;
                $output['bv_income'] = $row->bv_income;
                $output['bv_residence_address'] = $row->bv_residence_address;
                $output['bv_business_type'] = $row->bv_business_type;
                $output['bv_no_employee'] = $row->bv_no_employee;
                $output['bv_stocks'] = $row->bv_stocks;
                $output['bv_business_activity'] = $row->bv_business_activity;
                $output['bv_stability'] = $row->bv_stability;
                $output['bv_ownership'] = $row->bv_ownership;
                $output['bv_nature_of_business'] = $row->bv_nature_of_business;
                $output['bv_proof'] = $row->bv_proof;
                $output['bv_vehicle'] = $row->bv_vehicle;
                $output['bv_tcp1'] = $row->bv_tcp1;
                $output['bv_tcp2'] = $row->bv_tcp2;
                $output['bv_verified_name'] = $row->bv_verified_name;
                $output['bv_dt_of_cpv'] = $row->bv_dt_of_cpv;
                $output['bv_remarks'] = $row->bv_remarks;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }


    function fetch_single_reassign_case()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_case($_POST["user_id"]);
            foreach ($data as $row) {

                $output['id'] = $row->id;
                $output['code'] = $row->code;
                $output['reassign_remarks'] = $row->reassign_remarks;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }




    private function generateOTP()
    {
        // Generate a random OTP using your preferred method
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        // $otp ='1234';
        return $otp;
    }

    public function sendOTP()
    {
        $response = [];
        $email = 'Jainnupur.88@gmail.com';

        // Generate and store the OTP
        $otp = $this->generateOTP();
        // echo $otp;die;
        $responseArray['otp'] = $otp;
        $responseArray['email'] = $email;

        $this->sendOTPEmail($email, $otp);
        $responseArray['msg'] = "Message";
        $responseArray['success'] = 1;
        echo json_encode($responseArray);
        die();
        // echo 'OTP has been sent to your email address.';
    }

    private function sendOTPEmail($email, $otp)
    {
        $this->load->library('email');
        $this->email->from('Jainnupur.88@gmail.com', 'Yogita Sharma');
        $this->email->to($email);
        $this->email->subject('OTP Verification');
        $this->email->message('Please use the following OTP for verification: ' . $otp);

        if (!$this->email->send()) {
            // Handle email sending error if necessary
            echo $this->email->print_debugger();
        }
    }



    public function reassign_case_validation()
    {

        $enteredOtp = $this->input->post('otp');
        $response = [];
        $storedOtp = $this->input->post('store_otp');
        // echo $enteredOtp;
        // echo $storedOtp;die;
        if ($enteredOtp == $storedOtp) {

            $reassign_id = $_POST["r_id"];
            $reassign_multi_id = $_POST["multi_id"];
            $assignfrom = $_POST["assignfrom"];

            $array = array(
                'code' => $this->input->post('code'),
                'reassign_remarks' => $this->input->post('reassign_remarks'),
            );

            $this->load->model('Assign_case_model');
            // $this->Assign_case_model->editData();
            $insert_id = $this->Assign_case_model->update_assignee($reassign_id, $assignfrom, $reassign_multi_id, $array);
            if ($insert_id) {
                $response = array(
                    'success' => 1,
                    'msg' => "Assignee updated successfully"
                );
            } else {
                $response = array(
                    'success' => 0,
                    'msg' => "Error while saving data !!!!"
                );
            }
        } else {
            $response = array(
                'success' => 0,
                'msg' => "please enter valid OTP !!!!"
            );
        }
        echo json_encode($response);
        die;
    }


    // public function reassign_case_validation() {
    //     try {

    //         $this->load->library('form_validation');
    //         $this->form_validation->set_rules('code', 'code', 'required');
    //         $this->form_validation->set_rules('reassign_remarks', 'reassign_remarks', '');

    //         $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    //         if ($this->form_validation->run()) {

    //             $reassign_id = $_POST["r_id"];
    //             $array = array(
    //                 'code' => $this->input->post('code'),
    //                 'reassign_remarks' => $this->input->post('reassign_remarks'),
    //             );

    //             $this->load->model('Assign_case_model');
    //             $insert_id = $this->Assign_case_model->update_assignee($reassign_id, $array);
    //             if ($insert_id) {
    //                 $response = array(
    //                     'success' => true,
    //                     'message' => "Assignee updated successfully"
    //                 );
    //             } else {
    //                 $response = array(
    //                     'error' => true,
    //                     'message' => "Error while saving data !!!!"
    //                 );
    //             }
    //         } else {
    //             // if error in form validation
    //             foreach ($_POST as $key => $value) {
    //                 $response['messages'][$key] = form_error($key);
    //             }
    //         }
    //         echo json_encode($response);
    //     } catch (Exception $ex) {
    //         $error['error'] = TRUE;
    //         $error['message'] = $ex->getMessage();
    //         $this->load->view('login', array('error' => $error));
    //     }
    // }

    
    function fetch_single_case()
    {
        try {
            $output = array();
            $this->load->model("Assign_case_model");
            $data = $this->Assign_case_model->fetch_single_case($_POST["user_id"]);
            foreach ($data as $row) {

                $output['id'] = $row->id;
                $output['bank_name'] = $row->bank_name;
                $output['customer_name'] = $row->customer_name;
                $output['fi_to_be_conducted'] = $row->fi_to_be_conducted;
                $output['product_name'] = $row->product_name;
                $output['business_address'] = $row->business_address;
                $output['fi_intiation_comments'] = $row->fi_intiation_comments;
                $output['source_channel'] = $row->source_channel;
                $output['designation'] = $row->designation;
                $output['geo_limit'] = $row->geo_limit;
                $output['city'] = $row->city;
                $output['fi_date'] = $row->fi_date;
                $output['fi_time'] = $row->fi_time;
                $output['fi_flag'] = $row->fi_flag;
                $output['tat_start'] = $row->tat_start;
                $output['tat_end'] = $row->tat_end;
                $output['dob'] = $row->dob;
                $output['pincode'] = $row->pincode;
                $output['permanent_address'] = $row->permanent_address;
                $output['remarks'] = $row->remarks;
                $output['amount'] = $row->amount;
                $output['vehicle'] = $row->vehicle;
                $output['co_applicant'] = $row->co_applicant;
                $output['guarantee_name'] = $row->guarantee_name;
            }
            echo json_encode($output);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }

    public function update_case_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bank_name', 'bank_name', 'required');
            $this->form_validation->set_rules('customer_name', 'customer_name', 'required');
            $this->form_validation->set_rules('fi_to_be_conducted', 'fi_to_be_conducted', 'required');
            $this->form_validation->set_rules('product_name', 'product_name', 'required');
            $this->form_validation->set_rules('business_address', 'business_address', 'required');
            $this->form_validation->set_rules('fi_date', 'fi_date', '');
            $this->form_validation->set_rules('fi_time', 'fi_time', '');
            $this->form_validation->set_rules('fi_flag', 'fi_flag', '');
            $this->form_validation->set_rules('tat_start', 'tat_start', '');
            $this->form_validation->set_rules('dob', 'dob', '');
            $this->form_validation->set_rules('tat_end', 'tat_end', '');
            $this->form_validation->set_rules('pincode', 'pincode', '');
            $this->form_validation->set_rules('city', 'city', '');
            $this->form_validation->set_rules('permanent_address', 'permanent_address', '');
            $this->form_validation->set_rules('amount', 'amount', 'required');
            $this->form_validation->set_rules('designation', 'designation', '');
            $this->form_validation->set_rules('co_applicant', 'co_applicant', '');
            $this->form_validation->set_rules('guarantee_name', 'guarantee_name', '');



            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {

                $case_id = $_POST["c_id"];
                $array = array(

                    'bank_name' => $this->input->post('bank_name'),
                    'customer_name' => $this->input->post('customer_name'),
                    'fi_to_be_conducted' => $this->input->post('fi_to_be_conducted'),
                    'product_name' => $this->input->post('product_name'),
                    'business_address' => $this->input->post('business_address'),
                    'geo_limit' => $this->input->post('geo_limit'),
                    'city' => $this->input->post('city'),
                    'fi_date' => $this->input->post('fi_date'),
                    'tat_start' => $this->input->post('tat_start'),
                    'tat_end' => $this->input->post('tat_end'),
                    'dob' => $this->input->post('dob'),
                    'fi_time' => $this->input->post('fi_time'),
                    'fi_flag' => $this->input->post('fi_flag'),
                    'permanent_address' => $this->input->post('permanent_address'),
                    'pincode' => $this->input->post('pincode'),
                    'fi_intiation_comments' => $this->input->post('fi_intiation_comments'),
                   
                    'designation' => $this->input->post('designation'),
                    'remarks' => $this->input->post('remarks'),
                    'amount' => $this->input->post('amount'),
                    'vehicle' => $this->input->post('vehicle'),
                    'co_applicant' => $this->input->post('co_applicant'),
                    'guarantee_name' => $this->input->post('guarantee_name'),

                );

                $this->load->model('Assign_case_model');
                $insert_id = $this->Assign_case_model->update_case($case_id, $array);
                if ($insert_id) {
                    $response = array(
                        'success' => true,
                        'message' => "Case updated successfully"
                    );
                } else {
                    $response = array(
                        'error' => true,
                        'message' => "Error while saving data !!!!"
                    );
                }
            } else {
                // if error in form validation
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }

    


    public function update_bv_validation()
    {
        try {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bv_corporate_office', 'bv_corporate_office', 'required');
            $this->form_validation->set_rules('bv_person_designation', 'rv_fi_status', 'required');
            $this->form_validation->set_rules('bv_address_confirmed', 'bv_address_confirmed', 'required');
            $this->form_validation->set_rules('bv_applicant_designation', 'bv_applicant_designation', 'required');
            $this->form_validation->set_rules('bv_income', 'bv_income', 'required');
            $this->form_validation->set_rules('bv_residence_address', 'bv_residence_address', 'required');
            $this->form_validation->set_rules('bv_business_type', 'bv_business_type', 'required');
            $this->form_validation->set_rules('bv_no_employee', 'bv_no_employee', 'required');
            $this->form_validation->set_rules('bv_stocks', 'bv_stocks', 'required');
            $this->form_validation->set_rules('bv_business_activity', 'bv_business_activity', 'required');
            $this->form_validation->set_rules('bv_stability', 'bv_stability', 'required');
            $this->form_validation->set_rules('bv_ownership', 'bv_ownership', 'required');
            $this->form_validation->set_rules('bv_nature_of_business', 'bv_nature_of_business', 'required');
            // $this->form_validation->set_rules('rv_details_of_earning_member', 'rv_details_of_earning_member', 'required');
            $this->form_validation->set_rules('bv_proof', 'bv_proof', 'required');
            $this->form_validation->set_rules('bv_vehicle', 'bv_vehicle', 'required');
            $this->form_validation->set_rules('bv_tcp1', 'bv_tcp1', 'required');
            $this->form_validation->set_rules('bv_tcp2', 'bv_tcp2', 'required');
            // $this->form_validation->set_rules('bv_verified_name', 'bv_verified_name', 'required');
            // $this->form_validation->set_rules('bv_dt_of_cpv', 'bv_dt_of_cpv', 'required');
            // $this->form_validation->set_rules('bv_remarks', 'bv_remarks', 'required');


            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            if ($this->form_validation->run()) {

                $bv_cse_id = $_POST["bv_id"];
                $array = array(

                    'bv_corporate_office' => $this->input->post('bv_corporate_office'),
                    'bv_person_designation' => $this->input->post('bv_person_designation'),
                    'bv_address_confirmed' => $this->input->post('bv_address_confirmed'),
                    'bv_applicant_designation' => $this->input->post('bv_applicant_designation'),
                    'bv_income' => $this->input->post('bv_income'),
                    'bv_residence_address' => $this->input->post('bv_residence_address'),
                    'bv_business_type' => $this->input->post('bv_business_type'),
                    'bv_no_employee' => $this->input->post('bv_no_employee'),
                    'bv_stocks' => $this->input->post('bv_stocks'),
                    'bv_business_activity' => $this->input->post('bv_business_activity'),
                    'bv_stability' => $this->input->post('bv_stability'),
                    'bv_ownership' => $this->input->post('bv_ownership'),
                    'bv_nature_of_business' => $this->input->post('bv_nature_of_business'),
                    // 'rv_details_of_earning_member' => $this->input->post('rv_details_of_earning_member'),
                    'bv_proof' => $this->input->post('bv_proof'),
                    'bv_vehicle' => $this->input->post('bv_vehicle'),
                    'bv_tcp1' => $this->input->post('bv_tcp1'),
                    'bv_tcp2' => $this->input->post('bv_tcp2'),
                    // 'bv_verified_name' => $this->input->post('bv_verified_name'),
                    // 'bv_dt_of_cpv' => $this->input->post('bv_dt_of_cpv'),
                    // 'bv_remarks' => $this->input->post('bv_remarks'),



                );

                $this->load->model('Assign_case_model');
                $inserts_id_bv = $this->Assign_case_model->update_bv_data_case($bv_cse_id, $array);
                if ($inserts_id_bv) {
                    $response = array(
                        'success' => true,
                        'message' => "BV Case updated successfully"
                    );
                } else {
                    $response = array(
                        'error' => true,
                        'message' => "Error while saving data !!!!"
                    );
                }
            } else {
                // if error in form validation
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $error['error'] = TRUE;
            $error['message'] = $ex->getMessage();
            $this->load->view('login', array('error' => $error));
        }
    }
}
