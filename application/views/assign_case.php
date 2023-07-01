<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/theme1.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- <link rel="Stylesheet" type="text/css" href="assets/global/plugins/bootstrap/css/bootstrap.min.css" /> -->
    <title>Banking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css"> -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

    <script type="text/javascript">
        BASE_URL = "<?php echo base_url(); ?>"
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.view_assigned_case', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Assign_case_controller/fetch_single_assignee",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {

                        $('#assign_view_model').modal('show');

                        $('.s_application_id').html("<b>Reference Number:</b> " + data.application_id);
                        $('.s_customer_name').html("<b>Applicant Name:</b> " + data.customer_name);
                        $('.s_fi_conducted').html("<b>Fi to be Conducted:</b> " + data.fi_to_be_conducted);
                        $('.s_product_name').html("<b>Product Name:</b> " + data.product_name);
                        $('.s_residence_address').html("<b>Residence Address:</b> " + data.residence_address);
                        $('.s_office_address').html("<b>Office Address:</b> " + data.office_address);
                        $('.s_permanent_address').html("<b>Permanent Address:</b> " + data.permanent_address);
                        $('.s_fi_date').html("<b>FI Date:</b> " + data.fi_date);
                        $('.s_fi_time').html("<b>FI Time:</b> " + data.fi_time);
                        $('.s_permanent_add').html("<b>Permanent Address:</b> " + data.permanent_address);
                        $('.s_designation').html("<b>Designation:</b> " + data.designation);
                        $('.s_dob').html("<b>Date of Birth:</b> " + data.dob);
                        $('.s_channel').html("<b>Source Channel:</b> " + data.source_channel);
                        $('.s_fi_flag').html("<b>FI Flag:</b> " + data.fi_flag);
                        $('.s_bus_name').html("<b>Business Name:</b> " + data.business_name);
                      
                        $('.s_station').html("<b>Station:</b> " + data.station);
                        $('.s_tat_start').html("<b>TAT start:</b> " + data.tat_start);
                        $('.s_tat_end').html("<b>TAT end:</b> " + data.tat_end);
                        $('.s_city').html("<b>City:</b> " + data.city);
                        $('.s_pincode').html("<b>Pin Code:</b> " + data.pincode);
                        $('.s_name').html("<b>Name:</b> " + data.customer_name);
                        $('.s_remarks').html("<b>Remarks:</b> " + data.remarks);
                        $('.s_bank_name').html("<b>Bank Name:</b> " + data.bank_name);
                        $('.s_agent_code').html("<b>Agent Code:</b> " + data.code);
                        $('.s_residence_address').html("<b>Address:</b> " + data.business_address);
                        $('.s_amount').html("<b>Amount:</b> " + data.amount);
                        $('.s_vehicle').html("<b>Vehicle:</b> " + data.vehicle);
                        $('.s_co_applicant').html("<b>Co-Applicant:</b> " + data.co_applicant);
                        $('.s_guarantee_name').html("<b>Guarantee Name:</b> " + data.guarantee_name);
                        $('.s_single_agent').html("<b>Single Agent:</b> " + data.single_agent);
                        $('.s_geo_limit').html("<b>Geo Limit:</b> " + data.geo_limit);
                        $('.s_created_at').html("<b>Created At:</b> " + data.created_at);
                        $('.s_updated_at').html("<b>Updated At:</b> " + data.updated_at);
                        $('.s_status').html("<b>Status:</b> " + data.status);
                        $('.s_created_by').html("<b>Created By:</b> " + data.created_by);

                    }
                });
            });
       
            // fetch the data from database to send in update form
            $(document).on('click', '.edit_assigned_case', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Assign_case_controller/fetch_single_case",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#case_edit_model').modal('show');
                        $('#u_bank_name').val(data.bank_name);
                        $('#u_customer_name').val(data.customer_name);
                        $('#u_fi_to_be_conducted').val(data.fi_to_be_conducted);
                        $('#u_product_name').val(data.product_name);
                        $('#u_business_address').val(data.business_address);
                        $('#u_fi_intiation_comments').val(data.fi_intiation_comments);
                        $('#u_asset_make').val(data.asset_make);
                        $('#u_asset_model').val(data.asset_model);
                        $('#u_geo_limit').val(data.geo_limit);
                        $('#u_source_channel').val(data.source_channel);
                        $('#u_remarks').val(data.remarks);
                        $('#u_permanent_address').val(data.permanent_address);
                        $('#u_pincode').val(data.pincode);
                        $('#u_fi_date').val(data.fi_date);
                        $('#u_fi_flag').val(data.fi_flag);
                        $('#u_dob').val(data.dob);
                        $('#u_tat_start').val(data.tat_start);
                        $('#u_tat_end').val(data.tat_end);
                        $('#u_fi_time').val(data.fi_time);
                        $('#u_designation').val(data.designation);
                        $('#u_city').val(data.city);
                        $('#u_amount').val(data.amount);
                        $('#u_vehicle').val(data.vehicle);
                        $('#u_co_applicant').val(data.co_applicant);
                        $('#u_guarantee_name').val(data.guarantee_name);
                        $('#u_case_id').val(user_id);
                        //                     $('#user_uploaded_image').html(data.user_image);  
                        // $('#update_class').val("edit");
                    }
                });
            });
            // end of update data fetch
            $(document).on('click', '.reassigned_case', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Assign_case_controller/fetch_single_reassign_case",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#reassign_case_model').modal('show');
                        $('#u_code').val(data.code);
                        $('#u_reassign_remarks').val(data.reassign_remarks);
                        $('#u_tat_start').val(data.tat_start);
                         $('#u_tat_end').val(data.tat_end);

                        $('#u_reassign_id').val(user_id);
                        $('#update_assignee').val("edit");
                    }
                });
            });
            // $(document).on('click', '.bv_view_details', function() {
            //     var user_id = $(this).attr("id");
            //     $.ajax({
            //         url: "<?php echo base_url(); ?>Assign_case_controller/fetch_single_bv_data",
            //         method: "POST",
            //         data: {
            //             user_id: user_id
            //         },
            //         dataType: "json",
            //         success: function(data) {
            //             $('#bv_type_view_modal').modal('show');
            //             $('.bv_application_id').html("<b>Reference Number:</b> " + data.application_id);
            //             $('.bv_customer_name').html("<b>Applicant Name:</b> " + data.customer_name);
            //             $('.bv_fi_type').html("<b>FI Type:</b> " + data.fi_to_be_conducted);
            //             $('.bv_tat_start').html("<b>TAT Start:</b> " + data.tat_start);
            //             $('.bv_tat_end').html("<b>TAT End:</b> " + data.tat_end);
            //             $('.bv_bus_name').html("<b>Business Name:</b> " + data.business_name);
            //             $('.bv_city').html("<b>City:</b> " + data.city);
            //             $('.bv_agent').html("<b>Agent Code:</b> " + data.code);
            //             $('.bv_pincode').html("<b>Pincode:</b> " + data.pincode);
            //             $('.bv_amount').html("<b>Amount:</b> " + data.amount);
            //             $('.bv_mobile').html("<b>Mobile:</b> ");
            //             $('.bv_address').html("<b>Address:</b> " + data.business_address);
            //             $('.bv_created_at').html("<b>Date:</b> " + data.created_at);
            //             $('.bv_fi_status').html("<b>FI Status:</b> " + data.bv_fi_status);
            //             $('.bv_dob').html("<b>DOB:</b> " + data.dob);
            //             $('.bv_fi_date').html("<b>FI Date:</b> " + data.fi_date);
            //             $('.bv_fi_time').html("<b>FI TIme:</b> " + data.dob);

            //             $('.bv_asset_model').html("<b>Asset Model:</b> " + data.asset_model);
            //             $('.bv_asset_make').html("<b>Asset Make:</b> " + data.asset_make);
            //             $('.bv_amt').html("<b>Loan Amt:</b> " + data.amount);
            //             $('.bv_company_name').html("<b>Company Name:</b> " + data.bv_company_name);
            //             $('.bv_person_met').html("<b>Person Met:</b> " + data.bv_person_met);
                        
            //             $('.bv_tcp2_name').html("<b>TCP 1 Name:</b> " + data.tcp1_name);
            //             $('.bv_tcp1_name').html("<b>TCP 2 Name:</b> " + data.tcp2_name);
            //             $('.bv_bank').html("<b>Bank Name:</b> " + data.bank_name);
            //             $('.bv_product').html("<b>Product Product:</b> " + data.product_name);
            //             $('.bv_nature_of_business').html("<b>Nature of Business:</b> " + data.bv_nature_of_business);

            //             $('.bv_corporate_office').html("<b>Corporate Office:</b> " + data.bv_corporate_office);
            //             $('.bv_person_designation').html("<b>Person Met Designation:</b> " + data.bv_person_designation);
            //             $('.bv_address_confirmed').html("<b>Address Confirmed:</b> " + data.bv_address_confirmed);
            //             $('.bv_applicant_designation').html("<b>Applicant Designation:</b> " + data.bv_applicant_designation);
            //             $('.bv_income').html("<b>Approx Income:</b> " + data.bv_income);
            //             $('.bv_residence_address').html("<b>Residence Address:</b> " + data.bv_residence_address);
            //             $('.bv_business_type').html("<b>Business Type:</b> " + data.bv_business_type);
            //             $('.bv_no_employee').html("<b>Number of Employee:</b> " + data.bv_no_employee);
            //             $('.bv_working_since').html("<b>Working Since:</b> " + data.bv_working_since);
            //             $('.bv_stocks').html("<b>Stocks:</b> " + data.bv_stocks);
            //             $('.bv_signboard_name').html("<b>Name mentioned in Signboard:</b> " + data.bv_signboard_name);
            //             $('.bv_business_activity').html("<b>Business Activity:</b> " + data.bv_business_activity);
            //             $('.bv_stability').html("<b>Stability:</b> " + data.bv_stability);
            //             $('.bv_ownership').html("<b>Office Ownership:</b> " + data.bv_ownership);
            //             // $('.bv_nature_of_business').html("<b>Nature of Business:</b> " + data.bv_nature_of_business);
            //             $('.bv_proof').html("<b>Proof:</b> " + data.bv_proof);
            //             $('.bv_office_proof').html("<b>Office Proof Seen:</b> " + data.bv_office_proof);
            //             $('.bv_vehicle').html("<b>Vehicle:</b> " + data.bv_vehicle);
            //             $('.bv_previous_bus_details').html("<b>Previous Business Details:</b> " + data.bv_previous_bus_details);

            //             $('.bv_lat').html("<b>Latitude:</b> " + data.bv_lat);
            //             $('.bv_long').html("<b>Longitude:</b> " + data.bv_long);
            //             $('.bv_pincode').html("<b>Pincode:</b> " + data.bv_pincode);
            //             $('.bv_location_add').html("<b>Location:</b> " + data.bv_location_add);

            //             $('.bv_tcp1').html("<b>TCP 1:</b> " + data.bv_tcp1);
            //             $('.bv_tcp2').html("<b>TCP 2:</b> " + data.bv_tcp2);
            //             $('.bv_verified_name').html("<b>Verified Name:</b> " + data.bv_verified_name);
            //             $('.bv_dt_of_cpv').html("<b>Visit Date:</b> " + data.bv_dt_of_cpv);
            //             $('.bv_remarks').html("<b>Remarks:</b> " + data.bv_remarks);
            //             $('.bv_status').html("<b>Status:</b> " + data.status);
            //             $(".case_bv_case_img").html('');
            //             $('.case_bv_case_img').append(data.bv_image1);
            //             $('.case_bv_case_img').append(data.bv_image2);
            //             $('.case_bv_case_img').append(data.bv_image3);
            //             $('.case_bv_case_img').append(data.bv_image4);
            //             $('.case_bv_case_img').append(data.bv_image5);
            //             $('.case_bv_case_img').append(data.bv_image6);
            //             $('.case_bv_case_img').append(data.bv_image7);
            //             $('.case_bv_case_img').append(data.bv_image8);
            //             $('.case_bv_case_img').append(data.bv_image9);
            //             // $('.bv_image1').attr("src", data.bv_image1);
            //             // $('.bv_image2').attr("src", data.bv_image2);
            //             // $('.bv_image3').attr("src", data.bv_image3);
            //             // $('.bv_image4').attr("src", data.bv_image4);
            //             // $('.bv_image5').attr("src", data.bv_image5);
            //             // $('.bv_image6').attr("src", data.bv_image6);
            //             // $('.bv_image7').attr("src", data.bv_image7);
            //             // $('.bv_image8').attr("src", data.bv_image8);
            //             // $('.bv_image9').attr("src", data.bv_image9);
            //         }
            //     });
            // });
            
             $(document).on('click', '.bv_view_details', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Assign_case_controller/fetch_single_bv_data",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#bv_type_view_modal').modal('show');
                        $('.bv_application_id').html("<b>Reference Number:</b> " + data.application_id);
                        $('.bv_customer_name').html("<b>Applicant Name:</b> " + data.customer_name);
                        $('.bv_fi_type').html("<b>FI Type:</b> " + data.fi_to_be_conducted);
                        $('.bv_tat_start').html("<b>TAT Start:</b> " + data.tat_start);
                        $('.bv_tat_end').html("<b>TAT End:</b> " + data.tat_end);
                        $('.bv_bus_name').html("<b>Business Name:</b> " + data.business_name);
                        $('.bv_city').html("<b>City:</b> " + data.city);
                        $('.bv_agent').html("<b>Agent Code:</b> " + data.code);
                        $('.bv_pincode').html("<b>Pincode:</b> " + data.pincode);
                        $('.bv_amount').html("<b>Amount:</b> " + data.amount);
                        $('.bv_mobile').html("<b>Mobile:</b> ");
                        $('.bv_address').html("<b>Address:</b> " + data.business_address);
                        $('.bv_created_at').html("<b>Date:</b> " + data.created_at);
                        $('.bv_fi_status').html("<b>FI Status:</b> " + data.rv_fi_status);
                         $('.bv_fi_status_reason').html("<b>Fi Status Reason (if any):</b> " + data.rv_fi_status_reason);
                        $('.bv_dob').html("<b>DOB:</b> " + data.dob);
                        $('.bv_fi_date').html("<b>FI Date:</b> " + data.fi_date);
                        $('.bv_fi_time').html("<b>FI TIme:</b> " + data.dob);

                        $('.bv_asset_model').html("<b>Asset Model:</b> " + data.asset_model);
                        $('.bv_asset_make').html("<b>Asset Make:</b> " + data.asset_make);
                        $('.bv_amt').html("<b>Loan Amt:</b> " + data.amount);
                        $('.bv_company_name').html("<b>Company Name:</b> " + data.bv_company_name);
                        $('.bv_person_met').html("<b>Person Met:</b> " + data.bv_person_met);

                        $('.bv_tcp1_add_des').html("<b>TCP 1 Address/Designation:</b> " + data.bv_tcp1_address);
                        $('.bv_tcp2_add_des').html("<b>TCP 2 Address/Designation:</b> " + data.bv_tcp2_address);
                        $('.bv_tcp2_name').html("<b>TCP 2 Name:</b> " + data.tcp2_name);
                        $('.bv_tcp1_name').html("<b>TCP 1 Name:</b> " + data.tcp1_name);
                        $('.bv_tcp1_contact').html("<b>TCP 1 Contact:</b> " + data.bv_tcp1_contact);
                        $('.bv_tcp2_contact').html("<b>TCP 2 Contact:</b> " + data.bv_tcp2_contact);
                        $('.bv_tcp1_status').html("<b>TCP 1 Feedback Status:</b> " + data.bv_tcp1);
                        $('.bv_tcp2_status').html("<b>TCP 2 Feedback Status:</b> " + data.bv_tcp2);
                        $('.bv_tcp1_neg').html("<b>Feedback Reason:</b> " + data.bv_negative1);
                        $('.bv_tcp2_neg').html("<b>Feedback Reason:</b> " + data.bv_negative2);
                        $('.bv_consolidated_remarks').html(data.consolidated_remark);

                        $('.bv_bank').html("<b>Bank Name:</b> " + data.bank_name);
                        $('.bv_product').html("<b>Product Product:</b> " + data.product_name);
                        $('.bv_nature_of_business').html("<b>Nature of Business:</b> " + data.bv_nature_of_business);

                        $('.bv_corporate_office').html("<b>Corporate Office:</b> " + data.bv_corporate_office);
                        $('.bv_person_designation').html("<b>Person Met Designation:</b> " + data.bv_person_designation);
                        $('.bv_address_confirmed').html("<b>Address Confirmed:</b> " + data.bv_address_confirmed);
                        $('.bv_applicant_designation').html("<b>Applicant Designation:</b> " + data.bv_applicant_designation);
                        
                        $('.bv_type_of_profile').html("<b>Type of Profile:</b> " + data.bv_type_of_profile);
                        $('.bv_ownership_other').html("<b>Ownership (Other):</b> " + data.bv_ownership_other);
                        $('.bv_income').html("<b>Approx Income:</b> " + data.bv_income);
                        $('.bv_apx_sale').html("<b>Approx Sale:</b> " + data.bv_approx_sale);
                        $('.bv_vehicle_type').html("<b>Vehicle Type:</b> " + data.bv_vehicle);

                        $('.bv_loan_ex').html("<b>Loan Existing:</b> " + data.rv_loan_existing);
                        $('.bv_loan').html("<b>Loan Amount:</b> " + data.rv_loan_amt);
                        $('.bv_loan_bank').html("<b>Loan Bank Name:</b> " + data.rv_loan_bankname);
                        $('.bv_loan_emi').html("<b>Loan EMI:</b> " + data.rv_loan_emi);

                        $('.bv_vehicle_detail').html("<b>Vehicle Details:</b> " + data.rv_vehicle_details);
                        $('.bv_office_setup').html("<b>Office Setup:</b> " + data.bv_office_setup);
                        $('.bv_office_setup_desc').html("<b>Office Setup Description:</b> " + data.bv_office_setup_desc);
                        $('.bv_approx_gross').html("<b>Approx Gross Salary:</b> " + data.bv_approx_gross_salary);
                        $('.bv_approx_net').html("<b>Approx Net Salary:</b> " + data.bv_approx_net_salary);
                        $('.bv_residence_address').html("<b>Residence Address:</b> " + data.bv_residence_address);
                        $('.bv_business_type').html("<b>Business Type:</b> " + data.bv_business_type);
                        $('.bv_no_employee').html("<b>Number of Employee:</b> " + data.bv_no_employee);
                        $('.bv_working_since').html("<b>Working Since:</b> " + data.bv_working_since);
                        $('.bv_stocks').html("<b>Stocks:</b> " + data.bv_stocks);
                        $('.bv_signboard_name').html("<b>Name mentioned in Signboard:</b> " + data.bv_signboard_name);
                        $('.bv_business_activity').html("<b>Business Activity:</b> " + data.bv_business_activity);
                        $('.bv_stability').html("<b>Stability:</b> " + data.bv_stability);
                        $('.bv_ownership').html("<b>Office Ownership:</b> " + data.bv_ownership);
                        // $('.bv_nature_of_business').html("<b>Nature of Business:</b> " + data.bv_nature_of_business);
                        $('.bv_proof').html("<b>Proof:</b> " + data.bv_proof);
                        $('.bv_office_proof').html("<b>Office Proof Seen:</b> " + data.bv_office_proof);
                        $('.bv_vehicle').html("<b>Vehicle:</b> " + data.bv_vehicle);
                        $('.bv_previous_bus_details').html("<b>Previous Business Details:</b> " + data.bv_previous_bus_details);

                        $('.bv_lat').html("<b>Latitude:</b> " + data.bv_lat);
                        $('.bv_long').html("<b>Longitude:</b> " + data.bv_long);
                        $('.bv_pincode').html("<b>Pincode:</b> " + data.bv_pincode);
                        $('.bv_location_add').html("<b>Location:</b> " + data.bv_location_add);

                       
                        $('.bv_verified_name').html("<b>Verified Name:</b> " + data.bv_verified_name);
                        $('.bv_dt_of_cpv').html("<b>Visit Date:</b> " + data.bv_dt_of_cpv);
                        $('.bv_remarks').html("<b>Remarks:</b> " + data.bv_remarks);
                        $('.bv_status').html("<b>Status:</b> " + data.status);
                        $(".case_bv_case_img").html('');
                        $('.case_bv_case_img').append(data.rv_image1);
                        $('.case_bv_case_img').append(data.rv_image2);
                        $('.case_bv_case_img').append(data.rv_image3);
                        $('.case_bv_case_img').append(data.rv_image4);
                        $('.case_bv_case_img').append(data.rv_image5);
                        $('.case_bv_case_img').append(data.rv_image6);
                        $('.case_bv_case_img').append(data.rv_image7);
                        $('.case_bv_case_img').append(data.rv_image8);
                        $('.case_bv_case_img').append(data.rv_image9);
                        // $('.bv_image1').attr("src", data.bv_image1);
                        // $('.bv_image2').attr("src", data.bv_image2);
                        // $('.bv_image3').attr("src", data.bv_image3);
                        // $('.bv_image4').attr("src", data.bv_image4);
                        // $('.bv_image5').attr("src", data.bv_image5);
                        // $('.bv_image6').attr("src", data.bv_image6);
                        // $('.bv_image7').attr("src", data.bv_image7);
                        // $('.bv_image8').attr("src", data.bv_image8);
                        // $('.bv_image9').attr("src", data.bv_image9);
                    }
                });
            });
            
            $(document).on('click', '.rv_edit_details', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Assign_case_controller/fetch_single_rv_case",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {

                        $('#rv_edit_model').modal('show');
                        $('#p_bank_name').val(data.bank_name);
                        $('#p_product_name').val(data.product_name);
                        // $('#p_rv_make_model').val(data.rv_make_model);
                        $('#p_rv_fi_status').val(data.rv_fi_status);
                        $('#p_rv_loan_amt').val(data.rv_loan_amt);
                        $('#p_rv_confirm_address').val(data.rv_confirm_address);
                        // $('#u_rv_address_yes_no').val(data.rv_address_yes_no);
                        $('#p_rv_person_met_details').val(data.rv_person_met_details);
                        $('#p_rv_relationship').val(data.rv_relationship);
                        $('#p_rv_residence_ownership').val(data.rv_residence_ownership);
                        $('#p_rv_stability').val(data.rv_stability);
                        $('#p_rv_user_permanent_address').val(data.rv_user_permanent_address);
                        $('#p_rv_rent_per_month').val(data.rv_rent_per_month);
                        $('#p_rv_total_family_member').val(data.rv_total_family_member);
                        $('#p_rv_no_of_earning_members').val(data.rv_no_of_earning_members);
                        // $('#u_rv_details_of_earning_member').val(data.rv_details_of_earning_member);
                        $('#p_rv_dependent').val(data.rv_dependent);
                        $('#p_rv_user_office_address').val(data.rv_user_office_address);
                        $('#p_rv_residence_proof').val(data.rv_residence_proof);
                        $('#p_rv_agriculture_land').val(data.rv_agriculture_land);
                        $('#p_rv_exterior_premises').val(data.rv_exterior_premises);
                        $('#p_rv_interior_premises').val(data.rv_interior_premises);
                        $('#p_rv_cross_verified_info').val(data.rv_cross_verified_info);
                        $('#p_rv_vehicle_details').val(data.rv_vehicle_details);
                        $('#p_rv_neighbour_check1').val(data.rv_neighbour_check1);
                        $('#p_rv_neighbour_check2').val(data.rv_neighbour_check2);
                        $('#p_rv_cpv_done_by').val(data.rv_cpv_done_by);
                        $('#p_rv_remarks').val(data.rv_remarks);


                        $('#rv_case_id').val(user_id);
                        //                     $('#user_uploaded_image').html(data.user_image);  
                        $('#update_rv').val("edit");
                    }
                });
            });
            // end of update data fetch



            // update the form data if we change any
            $('#update_form_reassignee').submit(function(e) {
                // alert("click on update button");
                e.preventDefault();
                var me = $(this);
                var user_id = $(this).attr("id");
                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: me.serialize(),
                    //                        data:new FormData(this),  
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            alert("Assignee Change Successfully!");
                            $('#reassign_case_model').modal('hide');
                            swal.fire({
                                title: "updated",
                                text: response.message,
                                icon: 'success',
                                type: "success",
                                timer: 3000
                            });
                            console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();

                            $('#fetch_assign_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                            alert("Assignee Change Successfully!");
                        } else if (response.error == true) {
                            $('#agent_assign_model').modal('hide');
                            swal.fire({
                                title: "Try Again ! ",
                                text: response.message,
                                icon: 'error',
                                type: "error",
                                timer: 3000
                            });
                            $('#reassign_case_model').modal('hide');
                            //                            console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            //                                $('#teacher_add_model').modal('hide');
                            $('#fetch_assign_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                        } else {
                            $.each(response.messages, function(key, value) {
                                var element = $('#u_' + key);

                                element.closest('div.form-group')
                                    .removeClass('has-error')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('.text-danger')
                                    .remove();
                                element.after(value);
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        //                            swal.fire("Error deleting!", "Please try again later !!!", "error");
                        $('#reassign_case_model').modal('hide');
                        swal.fire({
                            title: "Error saving...",
                            text: "Please try again later !!!",
                            icon: 'error',
                            type: "error",
                            timer: 3000
                        });
                    }
                });
            });
            // end update form data 

            var modal = document.getElementById('add_final_status');
            function disableModal() {
  modal.classList.remove('show'); // Hide the modal
  $(document).off('click', '#add_final_status .modal-content', disableModal); // Remove click event listener
}

               // update the form data if we change any
               $('#add_final_status_form').submit(function(e) {
                //                alert("click on update button");
                e.preventDefault();
                var me = $(this);
                var user_id = $(this).attr("id");
                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: me.serialize(),
                    //                        data:new FormData(this),  
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            alert("Add final status Successfully!");
                            location.reload();
                            $('#add_final_status').modal('hide');
                            swal.fire({
                                title: "updated",
                                text: response.message,
                                icon: 'success',
                                type: "success",
                                timer: 3000
                            });
                            console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();

                            $('#fetch_assign_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();
                            disableModal();
                            alert("Add final status Successfully!");
                        } else if (response.error == true) {
                            $('#agent_assign_model').modal('hide');
                            swal.fire({
                                title: "Try Again ! ",
                                text: response.message,
                                icon: 'error',
                                type: "error",
                                timer: 3000
                            });
                            $('#add_final_status').modal('hide');
                            //                            console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            //                                $('#teacher_add_model').modal('hide');
                            $('#fetch_assign_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();
                         

                        } else {
                            $.each(response.messages, function(key, value) {
                                var element = $('#u_' + key);

                                element.closest('div.form-group')
                                    .removeClass('has-error')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('.text-danger')
                                    .remove();
                                element.after(value);
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        //                            swal.fire("Error deleting!", "Please try again later !!!", "error");
                        $('#add_final_status').modal('hide');
                        swal.fire({
                            title: "Error saving...",
                            text: "Please try again later !!!",
                            icon: 'error',
                            type: "error",
                            timer: 3000
                        });
                    }
                });
            });
            // end update form data 

            $(document).on('click', '.add_final_status', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Assign_case_controller/fetch_single_final_status",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#add_final_status').modal('show');
                        $('#u_add_final_status').val(data.add_final_status);
                        $('#a_status_id').val(user_id);
                        $('#add_final_status_btn').val("edit");
                    }
                });
            });


            $(document).on('click', '.bv_edit_details', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Assign_case_controller/fetch_single_bv_case",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#bv_edit_model').modal('show');
                        $('#u_bv_corporate_office').val(data.bv_corporate_office);
                        $('#u_bv_person_designation').val(data.bv_person_designation);
                        $('#u_bv_address_confirmed').val(data.bv_address_confirmed);
                        $('#u_bv_applicant_designation').val(data.bv_applicant_designation);
                        $('#u_bv_income').val(data.bv_income);
                        $('#u_bv_residence_address').val(data.bv_residence_address);
                        $('#u_bv_business_type').val(data.bv_business_type);
                        $('#u_bv_no_employee').val(data.bv_no_employee);
                        $('#u_bv_stocks').val(data.bv_stocks);
                        $('#u_bv_business_activity').val(data.bv_business_activity);
                        $('#u_bv_stability').val(data.bv_stability);
                        $('#u_bv_ownership').val(data.u_bv_ownership);
                        $('#u_bv_nature_of_business').val(data.bv_nature_of_business);
                        $('#u_bv_proof').val(data.bv_proof);
                        $('#u_bv_vehicle').val(data.bv_vehicle);
                        $('#u_bv_tcp1').val(data.bv_tcp1);
                        $('#u_bv_tcp2').val(data.bv_tcp2);
                        // $('#u_rv_agriculture_land').val(data.rv_agriculture_land);
                        // $('#u_rv_exterior_premises').val(data.rv_exterior_premises);
                        // $('#u_rv_interior_premises').val(data.rv_interior_premises);
                        // $('#u_rv_cross_verified_info').val(data.rv_cross_verified_info);
                        // $('#u_rv_vehicle_details').val(data.rv_vehicle_details);
                        //  $('#u_rv_neighbour_check1').val(data.rv_neighbour_check1);
                        //   $('#u_rv_neighbour_check2').val(data.rv_neighbour_check2);
                        //  $('#u_rv_cpv_done_by').val(data.rv_cpv_done_by);
                        //   $('#u_rv_remarks').val(data.rv_remarks);


                        $('#bv_case_id').val(user_id);
                        //                     $('#user_uploaded_image').html(data.user_image);  
                        $('#update_bv').val("edit");
                    }
                });
            });
            // end of update data fetch



            $(document).on('click', '#update_assignee_data', function() {

                var multiid = [];
                $("input:checkbox[name=assign]:checked").each(function() {
                    multiid.push($(this).val());
                });
                // alert(multiid);
                var assignfrom = $("#assignfrom").val();
                var u_reassign_id = $("#u_reassign_id").val();
                var code = $('#u_code').val();
                var remarks = $("#u_reassign_remarks").val();
                var tat_start= $("#u_tat_start").val();
                var tat_end = $("#u_tat_end").val();
                var otp = $("#otp").val();
                var store_otp = $("#store_otp").val();
                var email = $("#email").val();


                $.ajax({
                    url: "<?php echo base_url(); ?>Assign_case_controller/reassign_case_validation",
                    method: "POST",
                    data: {
                        r_id: u_reassign_id,
                        multi_id: multiid,
                        code: code,
                         tat_start: tat_start,
                          tat_end: tat_end,
                        assignfrom: assignfrom,
                        reassign_remarks: remarks,
                        otp: otp,
                        store_otp: store_otp,
                        email: email


                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 1) {
                            $("#otp_check").show();
                            $("#success_msg").show();
                            $("#success_msg").html(data.msg);
                        } else {
                            $("#error_msg").html(data.msg);

                        }

                    }
                });
            });


            $(document).on('click', '#generate_otp', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Assign_case_controller/sendOTP",
                    method: "POST",
                    data: {

                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 1) {
                            $("#store_otp").val(data.otp);
                            $("#email").val(data.email);
                            $("#otp_check").show();
                            $("#success_msg").html(data.msg);
                        }

                    }
                });
            });



            $(document).on('click', '.fi_type_view_data', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Assign_case_controller/fetch_single_rv_data",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#fi_type_view_modal').modal('show');

                        $('.s_application_id').html("<b>Application ID:</b> " + data.application_id);
                        $('.s_date').html("<b> Created Date:</b> " + data.created_at);
                        $('.s_fi_type').html("<b>FI Type:</b> " + data.fi_to_be_conducted);
                        $('.s_tat_start').html("<b>TAT Start:</b> " + data.tat_start);
                        $('.s_tat_end').html("<b>TAT End:</b> " + data.tat_end);
                        $('.s_fi_date').html("<b>FI Date:</b> " + data.fi_date);
                        $('.s_fi_time').html("<b>FI Time:</b> " + data.fi_time);
                        $('.s_customer_name').html("<b>Applicant Name:</b> " + data.customer_name);
                        $('.s_city').html("<b>City:</b> " + data.city);
                        $('.s_pincode').html("<b>Pincode:</b> " + data.pincode);
                        $('.s_address').html("<b>Address:</b> " + data.business_address);
                        $('.s_bank').html("<b>Bank Name:</b> " + data.bank_name);
                        $('.s_product').html("<b>Product Name:</b> " + data.product_name);
                        $('.s_geo_limit').html("<b>Geo Limit:</b> " + data.geo_limit);
                        $('.s_fi').html("<b>FI Status:</b> " + data.rv_fi_status);
                        $('.s_make_model').html("<b>Make Model:</b> " + data.rv_make_model);
                        $('.s_loan').html("<b>Amount:</b> " + data.amount);
                        $('.r_agent_code').html("<b>Agent Code:</b> " + data.code);
                        $('.s_mobile').html("<b>Mobile:</b> ");
                        // $('.s_cnf_add').html("<b>Confirm Address:</b> " + data.rv_confirm_address);
                        $('.s_person_met_detail').html("<b>Person Met details:</b> " + data.rv_person_met_details);
                        $('.s_relationship').html("<b>Relationship with Applicant:</b> " + data.rv_relationship);
                        $('.s_residence_ownerships').html("<b>Ownership of Residence:</b> " + data.rv_residence_ownership);
                        $('.r_stability').html("<b>Stability:</b> " + data.rv_stability);
                        $('.r_permanent_add').html("<b>Permanent Address:</b> " + data.rv_user_permanent_address);
                        $('.r_rent').html("<b>Rent Per Month:</b> " + data.rv_rent_per_month);
                        $('.r_total_member').html("<b>Total Family Members:</b> " + data.rv_total_family_member);
                        $('.r_no_of_earning_members').html("<b>No. of earning member:</b> " + data.rv_no_of_earning_members);
                        $('.r_details_members').html("<b>Details of Earning Member :</b> " + data.rv_details_of_earning_member);
                        $('.r_dependent').html("<b>Dependent Members:</b> " + data.rv_dependent);
                        $('.r_user_office_add').html("<b>User Office Address:</b> " + data.rv_user_office_address);
                        $('.r_resi_proof').html("<b>Residence Proof:</b> " + data.rv_residence_proof);
                        $('.r_in').html("<b>Interior:</b> " + data.rv_interior_premises);
                        $('.r_in_other').html("<b>Interior Other Detail:</b> " + data.rv_interior_premises);
                        $('.r_ex_other').html("<b>Exterior Other Detail:</b> " + data.rv_interior_premises);
                        $('.r_ex').html("<b>Exterior:</b> " + data.rv_exterior_premises);
                        $('.r_agri').html("<b>Agriculture Lending (if any):</b> " + data.rv_agriculture_land);
                        $('.r_how_much').html("<b>How much Lend:</b> " + data.how_much_land);
                        $('.r_vehicle_type').html("<b>Vehicle Type:</b> " + data.rv_vehicle_type);
                       
                        $('.r_consolidated').html(data.consolidated_remark);
                        $('.r_check1').html("<b>Neighbour 1:</b> " + data.neighbour_name1);
                        $('.r_house1').html("<b>House Details:</b> " + data.neighbour_house_no_1);
                        $('.r_house2').html("<b>House Details:</b> " + data.neighbour_house_no_2);
                        $('.r_contact1').html("<b>Neighbour 1 Contact:</b> " + data.neighbour_contact1);
                        $('.r_contact2').html("<b>Neighbour 2 Contact:</b> " + data.neighbour_contact2);
                        $('.r_feedback1').html("<b>Neighbour 1 Feedback:</b> " + data.neighbour_feedback1);
                        $('.r_feedback2').html("<b>Neighbour 2 Feedback:</b> " + data.neighbour_feedback2);
                        $('.r_neg_feedback1').html("<b>Feedback Reason:</b> " + data.neighbour1_neg_feedback);
                        $('.r_neg_feedback2').html("<b>Feedback Reason:</b> " + data.neighbour2_neg_feedback);
                        $('.r_proof_number').html("<b>Residence Proof Number:</b> " + data.res_proof_number);
                        $('.r_loan').html("<b>Loan Amount:</b> " + data.rv_loan_amt);
                        $('.r_loan_ex').html("<b>Loan Existing:</b> " + data.rv_loan_existing);
                        $('.r_loan_emi').html("<b>Loan EMI:</b> " + data.rv_loan_emi);
                        $('.r_loan_bank').html("<b>Loan Bank Name:</b> " + data.rv_loan_bankname);
                        $('.s_fi_status_reason').html("<b>FI Status Reason:</b> " + data.rv_fi_status_reason);

                        $('.r_lat').html("<b>Latitude:</b> " + data.rv_lat);
                        $('.r_lat').html("<b>Latitude:</b> " + data.rv_lat);
                        $('.r_long').html("<b>Longitude:</b> " + data.rv_long);
                        $('.r_pincode').html("<b>Pincode:</b> " + data.rv_pincode);
                        $('.r_location_add').html("<b>Location Address:</b> " + data.rv_location_add);
                        $('.r_check2').html("<b>Neighbour 2:</b> " + data.neighbour_name2);
                         $('.r_vehicle').html("<b>Vehicle:</b> " + data.rv_vehicle_details);

                        $('.r_cpv').html("<b>CPV done by:</b> " + data.rv_cpv_done_by);
                        $('.r_visit').html("<b>Visit Date:</b> " + data.rv_visit_date);
                        $('.r_remarks').html("<b>Additional Remark:</b> " + data.rv_remarks);
                        $('.r_add_yesno').html("<b>Address Confirmed:</b> " + data.rv_address_yes_no);
                      
                        // case_rv_case_img

                        // $(".case_rv_case_img.zoom").html('');
                        // $('.case_rv_case_img.zoom').append(data.rv_image1);
                        // $('.case_rv_case_img.zoom').append(data.rv_image2);
                        // $('.case_rv_case_img.zoom').append(data.rv_image3);
                        // $('.case_rv_case_img.zoom').append(data.rv_image4);
                        // $('.case_rv_case_img.zoom').append(data.rv_image5);
                        // $('.case_rv_case_img.zoom').append(data.rv_image6);
                        // $('.case_rv_case_img.zoom').append(data.rv_image7);
                        // $('.case_rv_case_img.zoom').append(data.rv_image8);
                        // $('.case_rv_case_img.zoom').append(data.rv_image9);
                        
//                         $(".case_rv_case_img img").eq(0).attr("src", data.rv_image1);
// $(".case_rv_case_img img").eq(1).attr("src", data.rv_image2);
// $(".case_rv_case_img img").eq(2).attr("src", data.rv_image3);
// $(".case_rv_case_img img").eq(3).attr("src", data.rv_image4);
// $(".case_rv_case_img img").eq(3).attr("src", data.rv_image5);
// $(".case_rv_case_img img").eq(3).attr("src", data.rv_image6);
// $(".case_rv_case_img img").eq(3).attr("src", data.rv_image7);
// $(".case_rv_case_img img").eq(3).attr("src", data.rv_image8);

// $(".case_rv_case_img img").eq(3).attr("src", data.rv_image9);
$(".case_rv_case_img").html('');
 $(".case_rv_case_img.img").append(data.rv_image1);
$(".case_rv_case_img.img").append(data.rv_image2);
$(".case_rv_case_img.img").append(data.rv_image3);
$(".case_rv_case_img.img").append(data.rv_image4);
$(".case_rv_case_img img").append(data.rv_image5);
$(".case_rv_case_img img").append(data.rv_image6);
$(".case_rv_case_img img").append(data.rv_image7);
$(".case_rv_case_img img").append(data.rv_image8);

$(".case_rv_case_img img").append(data.rv_image9);


                    }
                });
            });



            // update the form data if we change any
            $('#update_form_case').submit(function(e) {
                //                alert("click on update button");
                e.preventDefault();
                var me = $(this);
                var user_id = $(this).attr("id");

                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: me.serialize(),
                    //                        data:new FormData(this),  
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            alert("update successfully!");
                            $('#case_edit_model').modal('hide');
                            swal.fire({
                                title: "updated",
                                text: response.message,
                                icon: 'success',
                                type: "success",
                                timer: 3000
                            });
                            console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#fetch_assign_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                        } else if (response.error == true) {
                            $('#case_edit_model').modal('hide');
                            swal.fire({
                                title: "Try Again ! ",
                                text: response.message,
                                icon: 'error',
                                type: "error",
                                timer: 3000
                            });
                            $('#case_edit_model').modal('hide');
                            //                            console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            //                                $('#teacher_add_model').modal('hide');
                            $('#fetch_assign_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                        } else {
                            $.each(response.messages, function(key, value) {
                                var element = $('#u_' + key);

                                element.closest('div.form-group')
                                    .removeClass('has-error')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('.text-danger')
                                    .remove();

                                element.after(value);
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        //                            swal.fire("Error deleting!", "Please try again later !!!", "error");
                        $('#case_edit_model').modal('hide');
                        swal.fire({
                            title: "Error saving...",
                            text: "Please try again later !!!",
                            icon: 'error',
                            type: "error",
                            timer: 3000
                        });
                    }
                });
            });
            // end update form data 




            $('#update_rv').submit(function(e) {
                //                alert("click on update button");
                e.preventDefault();
                var me = $(this);
                var user_id = $(this).attr("id");

                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: me.serialize(),
                    //                        data:new FormData(this),  
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            alert("update successfully!");
                            $('#rv_edit_model').modal('hide');
                            swal.fire({
                                title: "updated",
                                text: response.message,
                                icon: 'success',
                                type: "success",
                                timer: 3000
                            });
                            console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#fetch_assign_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                        } else if (response.error == true) {
                            $('#rv_edit_model').modal('hide');
                            swal.fire({
                                title: "Try Again ! ",
                                text: response.message,
                                icon: 'error',
                                type: "error",
                                timer: 3000
                            });
                            $('#rv_edit_model').modal('hide');
                            //                            console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            //                                $('#teacher_add_model').modal('hide');
                            $('#fetch_assign_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                        } else {
                            $.each(response.messages, function(key, value) {
                                var element = $('#u_' + key);

                                element.closest('div.form-group')
                                    .removeClass('has-error')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('.text-danger')
                                    .remove();

                                element.after(value);
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        //                            swal.fire("Error deleting!", "Please try again later !!!", "error");
                        $('#rv_edit_model').modal('hide');
                        swal.fire({
                            title: "Error saving...",
                            text: "Please try again later !!!",
                            icon: 'error',
                            type: "error",
                            timer: 3000
                        });
                    }
                });
            });
            // end update form data 





            $('#update_bv').submit(function(e) {
                //                alert("click on update button");
                e.preventDefault();
                var me = $(this);
                var user_id = $(this).attr("id");

                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: me.serialize(),
                    //                        data:new FormData(this),  
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            alert("BV update successfully!");
                            $('#bv_edit_model').modal('hide');
                            swal.fire({
                                title: "updated",
                                text: response.message,
                                icon: 'success',
                                type: "success",
                                timer: 3000
                            });
                            console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#fetch_assign_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                        } else if (response.error == true) {
                            $('#bv_edit_model').modal('hide');
                            swal.fire({
                                title: "Try Again ! ",
                                text: response.message,
                                icon: 'error',
                                type: "error",
                                timer: 3000
                            });
                            $('#bv_edit_model').modal('hide');
                            //                            console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            //                                $('#teacher_add_model').modal('hide');
                            $('#fetch_assign_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                        } else {
                            $.each(response.messages, function(key, value) {
                                var element = $('#u_' + key);

                                element.closest('div.form-group')
                                    .removeClass('has-error')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('.text-danger')
                                    .remove();

                                element.after(value);
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        //                            swal.fire("Error deleting!", "Please try again later !!!", "error");
                        $('#bv_edit_model').modal('hide');
                        swal.fire({
                            title: "Error saving...",
                            text: "Please try again later !!!",
                            icon: 'error',
                            type: "error",
                            timer: 3000
                        });
                    }
                });
            });
            // end update form data 
            
            
               $(document).on('click', '.delete_case', function (e) {
                            e.preventDefault();
                            var user_id = $(this).attr("id");
                            Swal.fire({
                                title: 'ARE YOU SURE?',
                                text: ' YOU WANT TO DELETE THIS CASE!!!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#009900',
                                cancelButtonColor: '#e60000',
                                confirmButtonText: 'YES, DELETE IT!',
                                cancelButtonText: 'NO, CANCEL!',
                                //  reverseButtons: true
                            }).then(result => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: "<?php echo base_url(); ?>Assign_case_controller/delete_single_case",
                                        method: "POST",
                                        data: {user_id: user_id},
                                        success: function (data)
                                        {
                                            swal.fire({
                                                title: "DELETED!",
                                                text: "It was succesfully deleted!",
                                                icon: 'success',
                                                type: "success",
                                                timer: 3000
                         
                                            });
                                            location.reload();

                                            dataTable.ajax.reload();
                                        },
                                        error: function (xhr, ajaxOptions, thrownError) {
                                            //                            swal.fire("Error deleting!", "Please try again later !!!", "error");
                                            swal.fire({
                                                title: "Error deleting!",
                                                text: "Please try again later !!!",
                                                icon: 'error',
                                                type: "error",
                                                timer: 3000
                                            });
                                        }
                                    });
                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    //        swal.fire("Cancelled", "Your Milestone file is safe :)", "error",1500); 
                                    swal.fire({
                                        title: 'Cancelled',
                                        text: 'Your Case file is safe :)',
                                        icon: 'error',
                                        type: "error",
                                        timer: 3000
                                    })
                                }

                            });
                        });





            $("#u_code").focus(function() {
                $.ajax({
                    url: '<?= base_url() ?>Mini_case_controller/getAgentCode',
                    method: 'post',
                    dataType: 'json',
                    success: function(response) {
                        $('#u_code').find('option').not(':first').remove();
                        $.each(response, function(index, data) {
                            // console.log(data['id']);
                            $('#u_code').append('<option value="' + data['employee_unique_id'] + '">' + data['employee_unique_id'] + '</option>');
                        });
                    }
                });
            });


        });
    </script>
    
    <script>
    
      
    
    // function sendEmailConfirmation(recipient, link) {
    //     if (confirm('Are you sure you want to send the email?\n\nLink Preview:\n' + link)) {
    //         $.ajax({
    //             url: '<?php echo base_url("Assign_case_controller/sendEmailSupervisor"); ?>',
    //             type: 'POST',
    //             data: {
    //                 recipient: recipient,
    //                 link: link
    //             },
    //             success: function(response) {
    //                 console.log(response);
    //             },
    //             error: function(xhr, status, error) {
    //                 console.log(error);
    //             }
    //         });
    //     }
    // }
</script>
</head>

<body>
    <style>
        body {
            padding-top: 20px;
            padding-right: 80px;
            padding-left: 80px;
            /*font-family: 'Poppins', serif;*/
        }

        .mybtn-right {
            text-align: right;
            padding-right: 180px;
            clear: both;
        }

        .mybtn-left {
            text-align: left;
            padding-left: 180px;
            clear: both;
        }

        input[type=button] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        .veri {
            text-align: center;
        }

        .logout {
            text-align: right;
        }

        .content {
            margin-top: 25px;
            display: flex;
            flex-direction: column;
        }

        .btn-info {
            /* color: #0e88c5; */
            background-color: #0e88c5;
            border-color: #0e88c5
        }
    </style>
    <?php
    //echo $data;die('dsfsd');
    ?>
    

    <div class=" mybtn-right">


        <a href="<?php echo base_url(); ?>home" class="btn btn-info" class="btn btn-info">Dashboard</a>
        <a href="<?php echo base_url(); ?>Create_cse/create_c" class="btn btn-info">Case</a>
        <a href="<?php echo base_url(); ?>Report_controller/report_page_open" class="btn btn-info">Report</a>
            <?php
$sessionData = $this->session->userdata('user');

if ($sessionData['user_status'] === 'banned') {
    $cardDisplay = 'none';
} else {
    $cardDisplay = 'inline-block';
}
?>
    <a href="<?php echo base_url(); ?>Admin_dashboard_controller/admin_dashboard" class="btn btn-info"  style="display: <?php echo $cardDisplay; ?>">Admin</a>
    
    </div>
    <br>
    
    <div style="text-align: center;">
        <h4>You're viewing <?php echo $agent_name; ?>'s Dashboard</h4>
    </div>

<br>

    <label>From</label>
    <input type="text" name="from" id="from" required value="<?php echo date("Y-m-d"); ?>">
    <label>To</label>
    <input type="text" name="to" id="to" required value="<?php echo date("Y-m-d"); ?>">
    <button class="btn btn-warning " name="sub_btn" id="sub_btn"> GET </button>
    <label>Select FI Type</label>
    <select id="fitype" name="fitype" onchange="getFitype(this.value)">FI Type
    <option value="" selected>Select FI Type</option>
        <option id="RV">RV</option>
        <option id="BV">BV</option>
    </select>

    <label>Select Status</label>
    <select id="casestatus" name="casestatus" onchange="getCasestatus(this.value)">Status
      <option value="" selected>Select Status</option>
        <option id="inactive">inactive</option>
        <option id="Resolved">Resolved</option>
    </select>

    <button id="assigncasebutton" style="display:none;" type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-warning btn-md reassigned_case">Assign case</button>
    
    <label>Select Agent</label>
    <select id="agent" name="agent" onchange="getAgentData(this.value)">Status
     <option value="" selected>Select agent</option>
         <?php  $this->val =$this->db->query("Select * from login WHERE role_group = 'FA'");
         foreach($this->val->result_array() as $row){ ?>
        
        <option value="<?php echo $row['employee_unique_id']?>"><?php echo $row['first_name']?></option>
        <?php } ?>
       
    </select>

<label>Reference No</label>
    <input type="text" name="appno" placeholder="Enter Application Id" id="appno" required value="">
    <button class="btn btn-warning " name="searchappno" id="searchappno" onclick="getAppData()"> GET </button>
    
    <!--<br>-->
    
    <label>Mobile No</label>
    <input type="text" name="mobno" placeholder="Enter Mobile no." id="mobno" required value="">
    <button class="btn btn-info " name="searchmobno" id="searchmobno" onclick="getMobData()"> GET </button>



    <div class="tab-pane container active text-dark" id="home">
        <div class="table-responsive text-dark ">
            <br />
            <table id="fetch_assign_data" class="table table-bordered table-striped" cellspacing="0" style="width:100%">
                <thead>
                    <tr class="">
                        <th width="2%"></th>
                       
                        <th>App ID</th>
                        <th>Bank</th>
                         <th>Product</th>
                          <th>FI Type</th>
                          <th>Applicant Name</th>
                          <th>Address</th>
                          <th>Agent Name</th>
                          <th>TAT Start</th>
                        <th>TAT End</th>
                         <th>Visit Date</th>
                        <th width="9%">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbdy">
                    <?php $i = 1;
        
    
     // Sort the $allAgent array based on rv_visit_date in descending order
    usort($allAgent, function($a, $b) {
        return strtotime($b->rv_visit_date) - strtotime($a->rv_visit_date);
    });
    
    // $allowedAgents = array("NUP1234", "AS08121991","raj123","YOGI1606");
                    foreach ($allAgent as $key => $rows) :
                    ?>
                        <tr>
                            <td><input type="checkbox" onclick="showassignbutton(<?php echo $i ?>)" id="assign<?php echo $i ?>" value='<?= $rows->uid; ?>' name="assign"></td>
                            
                            <td><?= $rows->application_id; ?></td>
                            <td><?= $rows->bank_name; ?></td>
                            <td><?= $rows->product_name; ?></td>
                             <td><?= $rows->fi_to_be_conducted; ?></td>
                              <td><?= $rows->customer_name; ?></td>
                               <td><?= $rows->business_address; ?></td>
                                <td> <?php echo $agent_name; ?></td>
                                 <td><?= formatdate($rows->tat_start,'d-m-Y h:i A'); ?></td>
                            <td><?= formatdate($rows->tat_end,'d-m-Y h:i A'); ?></td>
                              <td><?= $rows->rv_visit_date; ?></td>
                           
                           
                           
                          
                            <td><?= $rows->status; ?></td>
                            <td>

                                <button type="button" name="view" id="<?= $rows->uid; ?>" title="View case" class="btn btn-success btn-sm view_assigned_case"><i class="fa fa-eye"></i></button>
                                <button type="button" name="edit" id="<?= $rows->uid; ?>" title="Edit case" class="btn btn-info btn-sm edit_assigned_case"><i class="fa fa-pencil"></i></button>
                                <button type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-primary btn-sm reassigned_case"><i class="fa fa-users"></i></button>
                                
                                 
                                <!--<button type="button" name="delete" id="<?= $rows->uid; ?>" title="delete case" class="btn btn-danger btn-sm delete_case"><i class="fa fa-trash"></i></button>-->
                                
                                              <?php if ($sessionData['user_status'] !== 'banned'): ?>
                                                 <button type="button" name="delete" id="<?= $rows->uid; ?>" title="delete case" class="btn btn-danger btn-sm delete_case"><i class="fa fa-trash"></i></button>
                                              <?php endif; ?>
                    
                                
                                 
                                 <button type="button" name="download" id="<?= $rows->uid; ?>" title="Download Images" class="btn btn-success btn-sm download_image"><i class="fa fa-download"></i></button>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('index.php/assign_case_controller/upload_images/'.$rows->uid);?>" title="Upload Images"><i class="fa fa-upload" aria-hidden="true"></i></a>
                                
                                 <?php
                                if (empty($rows->add_final_status)) { ?>
                                <button type="button" name="final_status" id="<?= $rows->uid; ?>" title="Add Final Status" class="btn btn-warning btn-sm add_final_status"><i class="fa fa-user"></i></button>
                                <?php } 
                                ?>
                                
                               
                                <?php
                                if ($rows->fi_to_be_conducted == 'BV') { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="BV View Data" class="btn btn-info btn-sm bv_view_details"><i class="fa fa-users"></i></button>
                                    <button type="button" name="bv_edit" id="<?= $rows->uid; ?>" title="BV Edit" class="btn btn-warning btn-sm bv_edit_details"><i class="fa fa-pencil"></i></button>
                                    
                                    <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openBVDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                    
                                    
                                    
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-warning btn-sm send-email-bv"><i class="fa fa-envelope"></i></button>
                                    
                                    
                                <?php } else { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="RV View data" class="btn btn-warning btn-sm fi_type_view_data"><i class="fa fa-users"></i></button>
                                    <button type="button" name="rv_edit" id="<?= $rows->uid; ?>" title="RV Edit" class="btn btn-info btn-sm rv_edit_details"><i class="fa fa-edit"></i></button>
                                    
                                     <button type="button" name="view_page" id="<?= $rows->uid; ?>" title="View Case Page" class="btn btn-primary btn-sm" onclick="openDetails(<?= $rows->uid; ?>)"> <i class="fa fa-eye"></i></button>
                                     
                                     <button type="button" name="email" id="<?= $rows->uid; ?>" title="Send email to Supervisor" class="btn btn-success btn-sm send-email"><i class="fa fa-envelope"></i></button>
                                <?php  } ?>
                                
                                  
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </div>
    
   
    
<!--<div id="confirmation-modal" class="modal">-->
<!--        <div class="modal-content">-->
<!--            <p>Are you sure you want to send an email to the Supervisor?</p>-->
<!--            <p>Link Preview: <span id="link-preview"></span></p>-->
<!--            <div>-->
<!--                <label for="email-input">Email Addresses:</label>-->
<!--                <input type="text" id="email-input" placeholder="Enter email addresses">-->
<!--            </div>-->
            
<!--            <div class="modal-button-container">-->
<!--                <button id="confirmation-yes">Yes</button>-->
<!--                <button id="confirmation-no">No</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<style>
    .confirmation-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .confirmation-modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border-radius: 5px;
        max-width: 600px;
        text-align: center;
    }

    .confirmation-modal h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .confirmation-modal p {
        color: #666;
        margin-bottom: 20px;
    }

    .confirmation-modal #link-preview {
        display: inline-block;
        background-color: #f5f5f5;
        padding: 5px 10px;
        border-radius: 4px;
        margin-top: 10px;
    }

    .confirmation-modal input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .confirmation-modal-button-container {
        display: flex;
        justify-content: center;
    }

    .confirmation-modal-button-container button {
        padding: 10px 20px;
        margin: 0 5px;
        border: none;
        border-radius: 4px;
        color: #fff;
        background-color: #4CAF50;
        cursor: pointer;
    }

    .confirmation-modal-button-container button:hover {
        background-color: #45a049;
    }

    /* Additional CSS for confirmation-modal-bv */

    .confirmation-modal-bv {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .confirmation-modal-content-bv {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border-radius: 5px;
        max-width: 600px;
        text-align: center;
    }

    .confirmation-modal-bv h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .confirmation-modal-bv p {
        color: #666;
        margin-bottom: 20px;
    }

    .confirmation-modal-bv #link-preview-bv {
        display: inline-block;
        background-color: #f5f5f5;
        padding: 5px 10px;
        border-radius: 4px;
        margin-top: 10px;
    }

    .confirmation-modal-bv input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .confirmation-modal-button-container-bv {
        display: flex;
        justify-content: center;
    }

    .confirmation-modal-button-container-bv button {
        padding: 10px 20px;
        margin: 0 5px;
        border: none;
        border-radius: 4px;
        color: #fff;
        background-color: #4CAF50;
        cursor: pointer;
    }

    .confirmation-modal-button-container-bv button:hover {
        background-color: #45a049;
    }
</style>


<div id="confirmation-modal" class="confirmation-modal">
    <div class="confirmation-modal-content">
        <h2>Confirmation</h2>
        <p>Are you sure you want to send an email to the Supervisor?</p>
        <p>Link Preview: <span id="link-preview"></span></p>
        <div>
            <label for="email-input">Email Addresses:</label>
            <input type="text" id="email-input" placeholder="Enter email addresses">
        </div>
        
        <div class="confirmation-modal-button-container">
            <button id="confirmation-yes">Yes</button>
            <button id="confirmation-no">No</button>
        </div>
    </div>
</div>

    
     <div id="confirmation-modal-bv" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to send an email to the Supervisor?</p>
            <p>Link Preview: <span id="link-preview-bv"></span></p>
            <div>
                <label for="email-input-bv">Email Addresses:</label>
                <input type="text" id="email-input-bv" placeholder="Enter email addresses">
            </div>
            
            <div class="modal-button-container">
                <button id="confirmation-yes-bv">Yes</button>
                <button id="confirmation-no-bv">No</button>
            </div>
        </div>
    </div>
    
    
<!--<div id="confirmation-modal" class="modal fade">-->
<!--  <div class="modal-dialog bg-light">-->
<!--    <div class="modal-content"style="width:800px;">-->
      
<!--      <div class="modal-body">-->
<!--       <p>Are you sure you want to send an email to the Supervisor?</p>-->
<!--            <p>Link Preview: <span id="link-preview"></span></p>-->
<!--            <div>-->
<!--                <label for="email-input">Email Addresses:</label>-->
<!--                <input type="text" id="email-input" placeholder="Enter email addresses seperated by commas">-->
<!--            </div>-->
            
<!--            <div class="modal-button-container">-->
<!--                <button id="confirmation-yes">Yes</button>-->
<!--                <button id="confirmation-no">No</button>-->
<!--            </div>-->
<!--      </div>-->
     
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
    

    <div id="assign_view_model" class="modal fade ">
        <div class="modal-dialog bg-light">
            <div class="modal-content" style="width:800px;">
                <div class="card ">
                    <header class="card-header bg-primary">
                        <h6 class="title "><b>View Case</b></h6>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                                <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_application_id" style="color:blue;">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_bank_name">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                 <div class="col-sm-6">
                                                    <h4 class="s_product_name">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_fi_conducted">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12">
                                                <div class="col-sm-12">
                                                    <h4 class="s_customer_name">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">

                                            <h4 class="s_updated_at">
                                            </h4>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="s_bus_name">
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <div class="col-sm-6">
                                                    <h4 class="s_residence_address">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="s_permanent_add">
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="s_designation">
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <div class="col-sm-6">
                                                    <h4 class="s_city">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_pincode">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_amount">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_vehicle">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_guarantee_name">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   

                                   
                           
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_co_applicant">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_fi_date">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_fi_time">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_fi_flag">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_geo_limit">
                                                    </h4>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_channel">
                                                    </h4>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_tat_start">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_tat_end">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-6">
                                                    <h4 class="s_remarks">
                                                    </h4>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                            <div class="col-sm-6">
                                                    <h4 class="s_dob">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="s_status">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                
                                                <div class="col-sm-6">
                                                    <h4 class="s_agent_code">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                
                                                <div class="col-sm-6">
                                                    <h4 class="s_created_by">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    



                                    


                                    


                                </div>
                            </div>
                            <div class="model-footer">
                                <button type="button" class="btn btn-primary float-right col-sm-12" data-bs-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--view assign case model end-->
    <div id="case_edit_model" class="modal fade ">
        <div class="modal-dialog">
            <!--<form method="post" id="user_form">-->
            <div class="modal-content" style="width:800px;">
                <?php echo form_open("Assign_case_controller/update_case_validation", array("id" => "update_form_case", "class" => "form-horizontal")) ?>
                <div class="card ">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Case</h4>
                    </div>

                    <div class="card-body">
                        <style>
                            .form-group {
                                margin-bottom: 5px !important;
                            }

                            form,
                            input,
                            label {
                                color: black;

                            }
                        </style>

                        <input type="text" class="form-control" hidden id="u_case_id" name="c_id">

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bank_name" class="h6">Bank Name</label>
                                <input type="text" class="form-control" id="u_bank_name" placeholder="Bank name here" name="bank_name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="customer_name" class="h6">Applicant Name</label>
                                <input type="text" class="form-control" id="u_customer_name" placeholder="Applicant name here" name="customer_name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="fi_to_be_conducted" class="h6">FI Type</label>
                                <select class="form-control" id="u_fi_to_be_conducted" name="fi_to_be_conducted">
                                    <option value="" selected>-- SELECT FI TYPE --</option>
                                    <option value="RV">RV</option>
                                    <option value="BV">BV</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="product_name" class="h6">Product Name</label>
                                <input type="text" class="form-control" id="u_product_name" placeholder="Product name here" name="product_name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="business_address" class="h6">Address</label>
                                <input type="text" class="form-control" id="u_business_address" name="business_address">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="source_channel" class="h6">Source Channel</label>
                                <input type="text" class="form-control" id="u_source_channel" name="source_channel">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="city" class="h6">City</label>
                                <input type="text" class="form-control" id="u_city" name="city">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="pincode" class="h6">Pincode</label>
                                <input type="text" class="form-control" id="u_pincode" name="pincode">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="permanent_address" class="h6">Permanent Address</label>
                                <input type="text" class="form-control" id="u_permanent_address" name="permanent_address">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="designation" class="h6">Designation</label>
                                <input type="text" class="form-control" id="u_designation" name="designation">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="fi_date" class="h6">FI Date</label>
                                <input type="text" class="form-control" id="u_fi_date" name="fi_date">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="fi_time" class="h6">FI Time</label>
                                <input type="text" class="form-control" id="u_fi_time" name="fi_time">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="fi_flag" class="h6">FI Flag</label>
                                <input type="text" class="form-control" id="u_fi_flag" name="fi_flag">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="tat_start" class="h6">TAT Start</label>
                                <input class="form-control" id="u_tat_start" name="tat_start" placeholder="yyyy-mm-dd HH:MM:SS" type="text" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="tat_end" class="h6">TAT End</label>
                                <input class="form-control" id="u_tat_end" name="tat_end" placeholder="yyyy-mm-dd HH:MM:SS" type="text" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="dob" class="h6">Date of Birth</label>
                                <input type="text" class="form-control" id="u_dob" name="dob">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="geo_limit" class="h6">Geo Limit</label>
                                <select class="form-control" id="u_geo_limit" name="geo_limit">
                                    <option value="" selected>-- SELECT GEO LIMIT --</option>
                                    <option value="Out Station">Out Station</option>
                                    <option value="Local">Local</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="remarks" class="h6">remarks</label>
                                <input type="text" class="form-control" id="u_remarks" placeholder="remarks here" name="remarks">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="amount" class="h6">amount</label>
                                <input type="text" class="form-control" id="u_amount" placeholder="amount here" name="amount">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="vehicle" class="h6">vehicle</label>
                                <input type="text" class="form-control" id="u_vehicle" placeholder="vehicle here" name="vehicle">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="co_applicant" class="h6">co applicant</label>
                                <input type="text" class="form-control" id="u_co_applicant" placeholder="co_applicant here" name="co_applicant">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="guarantee_name" class="h6">guarantee name</label>
                                <input type="text" class="form-control" id="u_guarantee_name" placeholder="guarantee_name here" name="guarantee_name">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="submit" name="update_case" id="update_case_data" class="btn btn-primary" value="SAVE">

                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        </div>
                        <?php echo form_close() ?>

                    </div> <!-- model content -->
                </div> <!-- card body end  -->
            </div> <!-- card end  -->
        </div>
    </div>
    
    <div id="bv_edit_model" class="modal fade">
        <div class="modal-dialog modal-fullscreen">
            <!--<form method="post" id="user_form">-->
            <div class="modal-content">
                <?php echo form_open("Assign_case_controller/update_bv_validation", array("id" => "update_bv", "class" => "form-horizontal")) ?>
                <div class="card ">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update BV Details</h4>
                    </div>

                    <div class="card-body">
                        <style>
                            .form-group {
                                margin-bottom: 5px !important;
                            }

                            form,
                            input,
                            label {
                                color: black;

                            }
                        </style>

                        <input type="text" class="form-control" hidden id="bv_case_id" name="bv_id">

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_corporate_office" class="h6"> Corporate Office<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_corporate_office" placeholder="" name="bv_corporate_office">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_address_confirmed" class="h6">Address Confirmed<span class=""> *</span></label>
                                <select class="form-control" id="u_bv_address_confirmed" name="bv_address_confirmed">
                                    <option value="" selected>-- SELECT Address --</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_person_designation" class="h6">Person Deisgnation<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_person_designation" name="bv_person_designation">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_applicant_designation" class="h6">Applicant Designation<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_applicant_designation" name="bv_applicant_designation">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_income" class="h6"> Income <span class=""> *</span></label>
                                <input type="number" class="form-control" id="u_bv_income" name="bv_income">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_residence_address" class="h6">Residence Address<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_residence_address" name="bv_residence_address">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_business_type" class="h6">Business Type<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_business_type" name="bv_business_type">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_no_employee" class="h6">No. of Employee<span class=""> *</span></label>
                                <input type="number" class="form-control" id="u_bv_no_employee" name="bv_no_employee">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_stocks" class="h6">Stocks<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_stocks" name="bv_stocks">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_business_activity" class="h6">Business Activity<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_business_activity" name="bv_business_activity">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_stability" class="h6">Stability<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_stability" name="bv_stability">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_ownership" class="h6">Ownership<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_ownership" name="bv_ownership">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_nature_of_business" class="h6">Nature of Buisness<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_nature_of_business" name="bv_nature_of_business">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_proof" class="h6">Proof<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_proof" name="bv_proof">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_vehicle" class="h6">Vehicle<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_vehicle" name="bv_vehicle">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_agriculture_land" class="h6">Agriculture Land<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_rv_agriculture_land" placeholder="Agriculture Land here" name="rv_agriculture_land">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_exterior_premises" class="h6">Exterior Premises<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_rv_exterior_premises" placeholder="Exterior Premises here" name="rv_exterior_premises">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_interior_premises" class="h6">Interior Premises<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_rv_interior_premises" placeholder="Interior Premises here" name="rv_interior_premises">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_cross_verified_info" class="h6">Cross Verified Info<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_rv_cross_verified_info" placeholder="Cross Verified Info here" name="rv_cross_verified_info">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_vehicle_details" class="h6">Vehicle Details here<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_rv_vehicle_details" name="rv_vehicle_details">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_tcp1" class="h6">TCP 1<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_tcp1" name="bv_tcp1">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bv_tcp2" class="h6">TCP 2<span class=""> *</span></label>
                                <input type="text" class="form-control" id="u_bv_tcp2" name="bv_tcp2">
                            </div>
                        </div>



                        <div class="modal-footer">
                            <input type="submit" name="update_rv" id="update_rv_data" class="btn btn-primary" value="edit">

                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        </div>
                        <?php echo form_close() ?>

                    </div> <!-- model content -->
                </div> <!-- card body end  -->
            </div> <!-- card end  -->
        </div>
    </div>
    
    <div id="rv_edit_model" class="modal fade">
        <div class="modal-dialog modal-fullscreen">
            <!--<form method="post" id="user_form">-->
            <div class="modal-content">
                <?php echo form_open("Assign_case_controller/update_rv_validation", array("id" => "update_rv", "class" => "form-horizontal")) ?>
                <div class="card ">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit RV Details</h4>
                    </div>

                    <div class="card-body">
                        <style>
                            .form-group {
                                margin-bottom: 5px !important;
                            }

                            form,
                            input,
                            label {
                                color: black;

                            }
                        </style>

                        <input type="text" class="form-control" hidden id="rv_case_id" name="rv_id">


                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bank_name" class="h6">Bank</label>
                                <input type="text" class="form-control" id="p_bank_name" placeholder="Bank name here" name="bank_name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="product_name" class="h6">Product</label>
                                <input type="text" class="form-control" id="p_product_name" placeholder="Product name here" name="product_name">
                            </div>
                        </div>
                       
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_fi_status" class="h6">FI Type</label>
                                <select class="form-control" id="p_rv_fi_status" name="rv_fi_status">
                                    <option value="" selected>-- SELECT FI STATUS --</option>
                                    <option value="Positive">Positive</option>
                                    <option value="Negative">Negative</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_loan_amt" class="h6">Loan Amount</label>
                                <input type="number" class="form-control" id="p_rv_loan_amt" placeholder="Loan amount" name="rv_loan_amt">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_confirm_address" class="h6">Residence Address</label>
                                <input type="text" class="form-control" id="p_rv_confirm_address" placeholder="Confirm address here" name="rv_confirm_address">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_person_met_details" class="h6">Person Met Details</label>
                                <input type="text" class="form-control" id="p_rv_person_met_details" placeholder="Person Met details here" name="rv_person_met_details">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_relationship" class="h6">Relationship</label>
                                <input type="text" class="form-control" id="p_rv_relationship" placeholder="office address here" name="rv_relationship">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_residence_ownership" class="h6">Residence Ownership</label>
                                <input type="text" class="form-control" id="p_rv_residence_ownership" placeholder="Residence Ownership here" name="rv_residence_ownership">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_stability" class="h6">Stability</label>
                                <input type="text" class="form-control" id="p_rv_stability" placeholder="Stability here" name="rv_stability">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_user_permanent_address" class="h6">User Permanent Address</label>
                                <input type="text" class="form-control" id="p_rv_user_permanent_address" placeholder="User Permanent Address here" name="rv_user_permanent_address">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_rent_per_month" class="h6">Rent Per month</label>
                                <input type="number" class="form-control" id="p_rv_rent_per_month" placeholder="Rent Per month here" name="rv_rent_per_month">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_total_family_member" class="h6">Total Family Members</label>
                                <input type="number" class="form-control" id="p_rv_total_family_member" placeholder="Total Family Members" name="rv_total_family_member">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_no_of_earning_members" class="h6">No. of Earning Member</label>
                                <input type="number" class="form-control" id="p_rv_no_of_earning_members" placeholder="No. of Earning Members here" name="rv_no_of_earning_members">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_dependent" class="h6">Dependent Member details</label>
                                <input type="text" class="form-control" id="p_rv_dependent" placeholder="Dependent members here" name="rv_dependent">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_user_office_address" class="h6">User office Address</label>
                                <input type="text" class="form-control" id="p_rv_user_office_address" placeholder="User Office Address here" name="rv_user_office_address">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_residence_proof" class="h6">amount</label>
                                <input type="text" class="form-control" id="p_rv_residence_proof" placeholder="Residence Proof here" name="rv_residence_proof">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_agriculture_land" class="h6">Agriculture Land</label>
                                <input type="text" class="form-control" id="p_rv_agriculture_land" placeholder="Agriculture Land here" name="rv_agriculture_land">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_exterior_premises" class="h6">Exterior Premises</label>
                                <input type="text" class="form-control" id="p_rv_exterior_premises" placeholder="Exterior Premises here" name="rv_exterior_premises">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_interior_premises" class="h6">Interior Premises</label>
                                <input type="text" class="form-control" id="p_rv_interior_premises" placeholder="Interior Premises here" name="rv_interior_premises">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_cross_verified_info" class="h6">Cross Verified Info</label>
                                <input type="text" class="form-control" id="p_rv_cross_verified_info" placeholder="Cross Verified Info here" name="rv_cross_verified_info">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_vehicle_details" class="h6">Vehicle Details here</label>
                                <input type="text" class="form-control" id="p_rv_vehicle_details" placeholder="Vehicle here" name="rv_vehicle_details">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_neighbour_check1" class="h6">Neighbour Check 1</label>
                                <input type="text" class="form-control" id="p_rv_neighbour_check1" placeholder="Neighbour Check" name="rv_neighbour_check1">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_neighbour_check2" class="h6">Neighbour Check 2</label>
                                <input type="text" class="form-control" id="p_rv_neighbour_check2" placeholder="Neighbour Check" name="rv_neighbour_check2">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_cpv_done_by" class="h6">CPV</label>
                                <input type="text" class="form-control" id="p_rv_cpv_done_by" placeholder="CPV done by" name="rv_cpv_done_by">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_remarks" class="h6">Remarks</label>
                                <input type="text" class="form-control" id="p_rv_remarks" placeholder="Add Remarks (if any) here" name="rv_remarks">
                            </div>
                        </div>


                        <div class="modal-footer">
                            <input type="submit" name="update_rv" id="update_rv_data" class="btn btn-primary" value="Save">

                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        </div>
                        <?php echo form_close() ?>

                    </div> <!-- model content -->
                </div> <!-- card body end  -->
            </div> <!-- card end  -->
        </div>
    </div>

    <div id="reassign_case_model" class="modal fade ">
        <div class="modal-dialog">
            <!--<form method="post" id="user_form">-->
            <div class="modal-content" style="width:800px;">
                <?php echo form_open("Assign_case_controller/reassign_case_validation", array("id" => "update_form_reassignee", "class" => "form-horizontal")) ?>
                <div class="card ">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Reassign Case</h4>
                    </div>

                    <div class="card-body">
                        <style>
                            .form-group {
                                margin-bottom: 5px !important;
                            }

                            form,
                            input,
                            label {
                                color: black;

                            }
                        </style>

                        <input type="text" class="form-control" hidden id="u_reassign_id" name="r_id">
                        <input type="hidden" class="form-control" hidden id="store_otp" name="store_otp">
                        <input type="hidden" class="form-control" hidden id="email" name="email">

                        <input type="hidden" class="form-control" hidden id="assignfrom" name="assignfrom" value="<?php echo $data ?>">


                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="code" class="h6">Agent</label>
                                <select class="form-control" id="u_code" name="code">
                                    <option value="" selected>-- SELECT AGENT --</option>
                                </select>
                            </div>
                        </div>
                        
                          <div class="row">
            <div class="col-md-3">
                <label for="tat">TAT Start<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-3">
                <input type="datetime-local" id="u_tat_start" name="tat_start" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="tat">TAT End<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-4">
                <input type="datetime-local" id="u_tat_end" name="tat_end" class="form-control">
            </div>
        </div>

                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="reassign_remarks" class="h6">Remarks</label>
                                <input type="text" class="form-control" id="u_reassign_remarks" placeholder="Reassign_remarks" name="Reassign remarks">
                            </div>
                        </div>
                        <br>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="otp" class="h6">Enter OTP (OTP send to your Admin's Email ID)</label>
                                <input type="text" class="form-control" name="otp" id="otp" required />
                            </div>
                        </div>

                        <style>
                            #success_msg {
                                display: none;
                            }

                            #error_msg {
                                display: none;
                            }
                        </style>

                        <button type="button" id="generate_otp" class="btn btn-warning">Generate OTP<button>

                                <div class="alert alert-success" id="success_msg"></div>
                                <div class="alert alert-danger" id="error_msg"></div>


                                <div class="modal-footer" id="otp_check">
                                    <style>
                                        #otp_check {
                                            display: none;
                                        }
                                    </style>
                                    <button type="button" name="update_assignee" id="update_assignee_data" class="btn btn-primary">Verify OTP and Reassign Case</button>

                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                </div>
                                <?php echo form_close() ?>



                    </div> <!-- model content -->

                </div> <!-- card body end  -->
            </div> <!-- card end  -->
        </div>
    </div>

    <div class="modal fade" id="add_final_status" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Final Status</h5>
                </div>
                <?php echo form_open("Assign_case_controller/add_final_status_validation", array("id" => "add_final_status_form", "class" => "form-horizontal")) ?>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="a_status_id" name="a_id">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="password" class="h5">Verify and Seen by</label>
                            <input type="text" class="form-control" name="add_final_status" id="u_add_final_status" placeholder="Enter Your Agent Code" required />
                        </div>
                    </div>

                    <input type="radio" value="YES">
                   <label>YES</label> 
                </div>
                <div class="modal-footer">
                    <input type="submit" name="add_final_status_btn" id="add_final_status_form_btn" class="btn btn-primary" value="ADD">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
 
    <div id="fi_type_view_modal" class="modal fade " aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="card ">
                    <div class="card-body">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        <?php ?>
                        <div class="row">
                            <div class="col-sm-12 ">
                                <h3 style="color:blue;">Basic Information</h3>


                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="s_application_id" style="color:blue;" >
                                                </h4>

                                            </div>
                                                <!-- <div class="col-sm-6">
                                                    <h4 class="s_date">
                                                    </h4>
                                                </div> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="s_bank">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="s_product">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="s_fi_type">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="s_date">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="s_tat_start">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="s_tat_end">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                


                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <!-- <div class="col-sm-6">
                                                <h4 class="s_geo_limit">
                                                </h4>
                                            </div> -->
                                            <div class="col-sm-6">
                                                <h4 class="s_customer_name">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="s_address">
                                                </h4>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="s_city">
                                                </h4>

                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="s_pincode">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="s_loan">
                                                </h4>

                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="s_mobile">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="r_vehicle">
                                                </h4>

                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="s_make_model">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                

                                <hr>

                                <h3 style="color:blue;">Address Confirmation</h3>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="r_add_yesno">
                                                </h4>
                                            </div>
                                            <!-- <div class="col-sm-6">
                                                <h4 class="s_cnf_add">
                                                </h4>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                
                                    <hr>

                                    <h3 style="color:blue;">Name of Person Met</h3>

                                    <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="s_person_met_detail">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="s_relationship">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <!-- <div class="col-sm-6">
                                                    <h4 class="s_residence_ownerships">
                                                    </h4>
                                                </div> -->
                                                <div class="col-sm-6">
                                                    <h4 class="r_stability">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   
                                    
                                    <hr>
                                    <h3 style="color:blue;">Residence details</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <div class="col-sm-6">
                                                    <h4 class="s_residence_ownerships">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_rent">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="r_permanent_add">
                                                    </h4>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                   
                                    <hr>

                                    <h3 style="color:blue;">Family Information</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <div class="col-sm-6">
                                                    <h4 class="r_total_member">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_no_of_earning_members">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <div class="col-sm-6">
                                                    <h4 class="r_details_members">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_dependent">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <h3 style="color:blue;">Other Information</h3>

<div class="row">
    <div class="col-sm-12">
        <div class="row pt-12">
            <div class="col-sm-12">
                <h4 class="r_user_office_add">
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6">
            <div class="col-sm-6">
                <h4 class="r_resi_proof">
                </h4>
            </div>
            <div class="col-sm-6">
                  <h4 class="r_proof_number">
                  </h4>
             </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6 ">
            <div class="col-sm-6">
                <h4 class="r_ex">
                </h4>
            </div>
            <div class="col-sm-6">
                <h4 class="r_ex_other">
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6 ">
            <div class="col-sm-6">
                <h4 class="r_in">
                </h4>
            </div>
            <div class="col-sm-6">
                <h4 class="r_in_other">
                </h4>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6 ">
            <div class="col-sm-6">
                <h4 class="r_agri">
                </h4>
            </div>
            <div class="col-sm-6">
                <h4 class="r_how_much">
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6 ">
            <div class="col-sm-6">
                <h4 class="r_vehicle_type">
                </h4>
            </div>
            <div class="col-sm-6">
                <h4 class="r_vehicle">
                </h4>
            </div>
        </div>
    </div>
</div>
<hr>

<h3 style="color:blue;">Loan Information</h3>

<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6">
            <div class="col-sm-6">
                <h4 class="r_loan_ex">
                </h4>
            </div>
            <div class="col-sm-6">
                <h4 class="r_loan">
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6">
            <div class="col-sm-6">
                <h4 class="r_loan_bank">
                </h4>
            </div>
            <div class="col-sm-6">
                <h4 class="r_loan_emi">
                </h4>
            </div>
        </div>
    </div>
</div>
<hr>

                                    <h3 style="color:blue;">Neighbour Check</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6">
                                                <div class="col-sm-6">
                                                    <h4 class="r_check1">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_check2">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6">
                                                <div class="col-sm-6">
                                                    <h4 class="r_house1">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_house2">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6">
                                                <div class="col-sm-6">
                                                    <h4 class="r_contact1">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_contact2">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6">
                                                <div class="col-sm-6">
                                                    <h4 class="r_feedback1">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_feedback2">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6">
                                                <div class="col-sm-6">
                                                    <h4 class="r_neg_feedback1">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_neg_feedback2">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

         

                                   


                                   

                                    <h3 style="color:blue;">Remark</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="r_consolidated">
                                                    </h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <h3 style="color:blue;">Additional Remark</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-12 ">
                                                <div class="col-sm-12">
                                                    <h4 class="r_remarks">
                                                    </h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <h3 style="color:blue;">Status</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <div class="col-sm-6">
                                                    <h4 class="s_fi">
                                                    </h4>
                                                </div>

                                                <div class="col-sm-6">
                                                    <h4 class="s_fi_status_reason">
                                                    </h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>

<style>
  .case_rv_case_img.img {
    transition: transform 0.3s ease;
  }

  .case_rv_case_img.img:hover {
    transform: scale(1.2);
    /*z-index: 1;*/
  }
  
  
</style>
                                    <div class="case_rv_case_img img">
  <!--<img src="" alt="RV Image 1">-->
  <!--<img src="" alt="RV Image 2">-->
  <!--<img src="" alt="RV Image 3">-->
  <!--<img src="" alt="RV Image 4">-->
  <!-- <img src="" alt="RV Image 5">-->
  <!--  <img src="" alt="RV Image 6">-->
  <!--   <img src="" alt="RV Image 7">-->
  <!--    <img src="" alt="RV Image 8">-->
  <!--     <img src="" alt="RV Image 9">-->
</div>
                                  

                                    

                                    <h3 style="color:blue;">Location</h3>

<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6 ">
            <div class="col-sm-6">
                <h4 class="r_lat">
                </h4>
            </div>
            <div class="col-sm-6">
                <h4 class="r_long">
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6 ">
            <div class="col-sm-6">
                <h4 class="r_pincode">
                </h4>
            </div>
            <div class="col-sm-6">
                <h4 class="r_location_add">
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6 ">
            <div class="col-sm-6">
                <h4 class="r_agent_code">
                </h4>
            </div>
            
        </div>
    </div>
</div>

<div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <div class="col-sm-6">
                                                    <h4 class="r_cpv">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_visit">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


<hr>

                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="bv_detail"></div>
                                </div>
                            </div>
                            <div class="model-footer">
                                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                    <!--add model end-->
                </div>
                <!--view question model end-->
            </div>
            <!--add model end-->
        </div>
    </div>




  <div id="bv_type_view_modal" class="modal fade " aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="card ">
                    <div class="card-body">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        <?php ?>
                        <div class="row">
                            <div class="col-sm-12 ">
                                <h3 style="color:blue;">BUSINESS VERIFICATION REPORT
                                    (Strictly Private & Confidential)</h3>

                                    <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-12 ">
                                            <div class="col-sm-12">
                                                <h4 class="bv_application_id" style="color:blue;">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="bv_bank">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="bv_product">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="bv_fi_type">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="bv_created_at">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="bv_tat_start">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="bv_tat_end">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-12 ">
                                            <div class="col-sm-12">
                                                <h4 class="bv_customer_name">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-12 ">
                                            <div class="col-sm-12">
                                                <h4 class="bv_bus_name">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-12 ">
                                            <div class="col-sm-12">
                                                <h4 class="bv_address">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="bv_city">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="bv_pincode">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="bv_mobile">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="bv_amount">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <hr>

             

                                <h3 style="color:blue;">Personal details</h3>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="bv_company_name">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="bv_person_met">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <div class="col-sm-6">
                                                    <h4 class="bv_person_designation">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="bv_address_confirmed">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row pt-6">
                                                   
                                                    <div class="col-sm-6">
                                                        <h4 class="bv_applicant_designation">
                                                        </h4>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h4 class="bv_type_of_profile">
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row pt-12 ">
                                                    <div class="col-sm-12">
                                                        <h4 class="bv_nature_of_business">
                                                        </h4>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row pt-12 ">
                                                        <div class="col-sm-12">
                                                            <h4 class="bv_residence_address">
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <hr>

                                                <h3 style="color:blue;">Business Details</h3>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row pt-6 ">
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_ownership">
                                                                </h4>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_ownership_other">
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row pt-6 ">
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_working_since">
                                                                </h4>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <h4 class="bv_apx_sale">
                                                                </h4>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row pt-6 ">
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_income">
                                                                </h4>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_no_employee">
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row pt-6 ">
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_approx_gross">
                                                                </h4>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_approx_net">
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row pt-6 ">
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_stocks">
                                                                </h4>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                        <h4 class="bv_stability">
                                                                        </h4>
                                                                    </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                
                                                <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="row pt-6 ">
                                                                <div class="col-sm-6">
                                                                    <h4 class="bv_office_proof">
                                                                    </h4>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <h4 class="bv_proof">
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>

                                                <hr>

                                                <h3 style="color:blue;">Other details</h3>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row pt-6 ">
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_business_activity">
                                                                </h4>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_signboard_name">
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <!-- <hr> -->





                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="row pt-6 ">
                                                                    <!-- <div class="col-sm-6">
                                                                        <h4 class="bv_stability">
                                                                        </h4>
                                                                    </div> -->
                                                                    <div class="col-sm-6">
                                                                        <h4 class="bv_previous_bus_details">
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="row pt-6 ">
                                                                    <div class="col-sm-6">
                                                                        <h4 class="bv_office_setup">
                                                                        </h4>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <h4 class="bv_office_setup_desc">
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="row pt-6 ">
                                                                    <div class="col-sm-6">
                                                                        <h4 class="bv_vehicle_type">
                                                                        </h4>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <h4 class="bv_vehicle_detail">
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <hr>

                                                            
<h3 style="color:blue;">Loan Information</h3>

<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6">
            <div class="col-sm-6">
                <h4 class="bv_loan_ex">
                </h4>
            </div>
            <div class="col-sm-6">
                <h4 class="bv_loan">
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="row pt-6">
            <div class="col-sm-6">
                <h4 class="bv_loan_bank">
                </h4>
            </div>
            <div class="col-sm-6">
                <h4 class="bv_loan_emi">
                </h4>
            </div>
        </div>
    </div>
</div>
<hr>

                                                            <h3 style="color:blue;">TCP Information</h3>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-6">
                                                                                    
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_tcp1_name">
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_tcp2_name">
                                                                                        </h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-6">
                                                                                   
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_tcp1_add_des">
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_tcp2_add_des">
                                                                                        </h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-6">
                                                                                   
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_tcp1_contact">
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_tcp2_contact">
                                                                                        </h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-6">
                                                                                   
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_tcp1_status">
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_tcp2_status">
                                                                                        </h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-6">
                                                                                   
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_tcp1_neg">
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_tcp2_neg">
                                                                                        </h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                            <h3 style="color:blue;">Status</h3>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="row pt-6 ">
                                                                        <div class="col-sm-6">
                                                                            <h4 class="bv_fi_status">
                                                                            </h4>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                                        <h4 class="bv_status">
                                                                                        </h4>
                                                                                    </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="row pt-12">
                                                                        <div class="col-sm-12">
                                                                            <h4 class="bv_fi_status_reason">
                                                                            </h4>
                                                                        </div>
                                                                      

                                                                    </div>
                                                                </div>


                                                                <hr>



                                                                <h3 style="color:blue;">Consolidated Remark</h3>
                                                                <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-12">
                                                                                    
                                                                                    <div class="col-sm-12">
                                                                                        <h4 class="bv_consolidated_remarks">
                                                                                        </h4>
                                                                                    </div>

                                                                                   
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                       

                                                                <hr>
                                                                <h3 style="color:blue;">Remark</h3>
                                                                <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-12 ">
                                                                                    
                                                                                    <div class="col-sm-12">
                                                                                        <h4 class="bv_remarks">
                                                                                        </h4>
                                                                                    </div>

                                                                                   
                                                                                </div>
                                                                            </div>
                                                                        </div>




                                                                       

                                                                    

                                                                        <div class="case_bv_case_img"></div>
                                                                     

                                                                        
                                                                <h3 style="color:blue;">Location</h3>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="row pt-6 ">
                                                                            <div class="col-sm-6">
                                                                                <h4 class="bv_lat">
                                                                                </h4>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <h4 class="bv_long">
                                                                                </h4>
                                                                            </div>


                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="row pt-6 ">
                                                                                <div class="col-sm-6">
                                                                                    <h4 class="bv_pincode">
                                                                                    </h4>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <h4 class="bv_location_add">
                                                                                    </h4>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-12">
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_agent">
                                                                                        </h4>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-6 ">
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_dt_of_cpv">
                                                                                        </h4>
                                                                                    </div>
                                                                                   

                                                                                   
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                </div>
                                                                <div class="model-footer">
                                                                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--add model end-->
                                                    </div>
                                                    <!--view question model end-->
                                                </div>
                                                <!--add model end-->
                                            </div>
                                        </div>





                                        <script>
                                            $(document).ready(function() {
                                                
                                                  var id;
            var linkPreview;

            

            // Handle click event on the "Send Email" button
            $('.send-email').click(function () {
                id = $(this).attr('id');
                // var id = $(this).attr("id");
                linkPreview = 'https://verification.realbitscoders.com/Assign_case_controller/show/' + id;
                $('#link-preview').text(linkPreview);
                $('#confirmation-modal').show();
            });


// Handle click event on the "Send Email" button
            $('.send-email-bv').click(function () {
                id = $(this).attr('id');
                // var id = $(this).attr("id");
                linkPreviewbv = 'https://verification.realbitscoders.com/Assign_case_controller/show_bv/' + id;
                $('#link-preview-bv').text(linkPreviewbv);
                $('#confirmation-modal-bv').show();
            });
            
            
            // Handle click event on the "Yes" button in the confirmation modal
            $('#confirmation-yes').click(function () {
                // Close the modal
                $('#confirmation-modal').hide();
                
                // Retrieve the email input value
                var emailAddresses = $('#email-input').val();


                // Send AJAX request to the server
                $.ajax({
                    url: '<?= base_url('Assign_case_controller/send_email_supervisor'); ?>',
                    method: 'POST',
                    data: {id: id, link: linkPreview, emails: emailAddresses},
                    success: function (response) {
                        alert('Email sent to admin!');
                    },
                    error: function (xhr, status, error) {
                        alert('An error occurred while sending the email: ' + error);
                    }
                });
            });

            // Handle click event on the "No" button in the confirmation modal
            $('#confirmation-no').click(function () {
                // Close the modal
                $('#confirmation-modal').hide();
            });
            
            
              
            // Handle click event on the "Yes" button in the confirmation modal
            $('#confirmation-yes-bv').click(function () {
                // Close the modal
                $('#confirmation-modal-bv').hide();
                
                // Retrieve the email input value
                var emailAddressesbv = $('#email-input-bv').val();


                // Send AJAX request to the server
                $.ajax({
                    url: '<?= base_url('Assign_case_controller/send_email_supervisor_bv'); ?>',
                    method: 'POST',
                    data: {id: id, link: linkPreviewbv, emails: emailAddressesbv},
                    success: function (response) {
                        alert('Email sent to admin!');
                    },
                    error: function (xhr, status, error) {
                        alert('An error occurred while sending the email: ' + error);
                    }
                });
            });

            // Handle click event on the "No" button in the confirmation modal
            $('#confirmation-no-bv').click(function () {
                // Close the modal
                $('#confirmation-modal-bv').hide();
            });
                                                
                                                
                                                
                                                $("#from").datepicker({
                                                    dateFormat: "yy-mm-dd",

                                                });

                                                $("#to").datepicker({
                                                    dateFormat: "yy-mm-dd",

                                                });
                                            });
                                        </script>

                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                
                                                  $(document).on('click', '.download_image', function(e) {
            	  debugger;
                  e.preventDefault();
                  var id = $(this).attr("id");
                  downloadImages(id);
              });
        	  function downloadImages(id) {
        		  $.ajax({
        			    type: 'POST',
        			    url: "<?php echo base_url(); ?>Assign_case_controller/download_images",
        			    data: { id: id },
        			    xhrFields: {
        			        responseType: 'blob'
        			    },
        			    success: function(data) {
        			        // Create a blob URL from the response data
        			        var blobUrl = URL.createObjectURL(data);
        			        
        			        // Create a temporary anchor element to trigger the download
        			        var downloadLink = document.createElement('a');
        			        downloadLink.href = blobUrl;
        			        downloadLink.download = 'images.zip';
        			        downloadLink.click();
        			        
        			        // Clean up the blob URL
        			        URL.revokeObjectURL(blobUrl);
        			    },
        			    error: function(xhr, status, error) {
        			        console.log('AJAX error:', error);
        			        // Handle the AJAX error
        			    }
        			});
              }
                  
                
                                                
                                                         
   
                                                
                                                
                                                $('#sub_btn').click(function(event) {
                                                    event.preventDefault();

                                                    var from = $('#from').val();
                                                    var to = $('#to').val();
                                                    var code = '<?php echo $data; ?>';
                                                    //alert(code);

                                                    var datastring = "from=" + from + "&to=" + to + "&code=" + code;
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "<?= base_url() ?>Assign_case_controller/filterDatewise",
                                                        // dataType:"json",
                                                        data: datastring,
                                                        // contentType: "application/json; charset=utf-8",
                                                        success: function(data) {
                                                            //alert(data);
                                                            $('#tbdy').html(data);

                                                        },
                                                        error: function() {
                                                            // alert("Error");
                                                        }
                                                    });

                                                });

                                            });


                                            function getFitype(val) {
                                                var code = '<?php echo $data; ?>';
                                                var datastring = "val=" + val + "&code=" + code;
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?= base_url() ?>Assign_case_controller/filterfitype",
                                                    // dataType:"json",
                                                    data: datastring,
                                                    // contentType: "application/json; charset=utf-8",
                                                    success: function(data) {
                                                        //alert(data);
                                                        $('#tbdy').html(data);

                                                    },
                                                    error: function() {
                                                        // alert("Error");
                                                    }
                                                });
                                            }

                                            function getCasestatus(val) {
                                                var code = '<?php echo $data; ?>';
                                                var datastring = "val=" + val + "&code=" + code;
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?= base_url() ?>Assign_case_controller/filterStatus",
                                                    // dataType:"json",
                                                    data: datastring,
                                                    // contentType: "application/json; charset=utf-8",
                                                    success: function(data) {
                                                        //alert(data);
                                                        $('#tbdy').html(data);

                                                    },
                                                    error: function() {
                                                        // alert("Error");
                                                    }
                                                });
                                            }
                                            
                                               function getAgentData(val) {
                                                var code = '<?php echo $data; ?>';
                                               var datastring = "val=" + val + "&code=" + code;
                                                // alert(datastring);
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?= base_url() ?>Assign_case_controller/agentFilter",
                                                    // dataType:"json",
                                                    data: datastring,
                                                    // contentType: "application/json; charset=utf-8",
                                                    success: function(data) {
                                                        //alert(data);
                                                        $('#tbdy').html(data);

                                                    },
                                                    error: function() {
                                                        // alert("Error");
                                                    }
                                                });
                                            }
                                            
                                            function getAppData(val) {
                                                var code = '<?php echo $data; ?>';
                                                var appno = $("#appno").val().trim();
                                                var datastring = "appno=" + appno + "&code=" + code;
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?= base_url() ?>Assign_case_controller/AppData",
                                                    // dataType:"json",
                                                    data: datastring,
                                                    // contentType: "application/json; charset=utf-8",
                                                    success: function(data) {
                                                        //alert(data);
                                                        $('#tbdy').html(data);

                                                    },
                                                    error: function() {
                                                        // alert("Error");
                                                    }
                                                });
                                            }
                                            
                                             function getMobData(val) {
                                                var code = '<?php echo $data; ?>';
                                                var mobno=$("#mobno").val().trim();
                                                var datastring = "mobno=" + mobno + "&code=" + code;
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?= base_url() ?>Assign_case_controller/MobData",
                                                    // dataType:"json",
                                                    data: datastring,
                                                    // contentType: "application/json; charset=utf-8",
                                                    success: function(data) {
                                                        //alert(data);
                                                        $('#tbdy').html(data);

                                                    },
                                                    error: function() {
                                                        // alert("Error");
                                                    }
                                                });
                                            }
                                        </script>


                                        <script>
                                            function showassignbutton(val) {
                                                if ($("#assign" + val).is(':checked')) {
                                                    $("#assigncasebutton").show();

                                                }
                                            }
                                        </script>
                                        <script>
    function openDetails(id) {
        var url = '<?php echo base_url("Assign_case_controller/show/") ?>' + id;
        window.open(url, '_blank');
    }
    
    
    function openBVDetails(id) {
        var url = '<?php echo base_url("Assign_case_controller/show_bv/") ?>' + id;
        window.open(url, '_blank');
    }
</script>

</body>

</html>