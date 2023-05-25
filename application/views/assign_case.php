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
                        $('.s_dob').html("<b>Date of Birth:</b> " + data.dob);
                        $('.s_channel').html("<b>Source Channel:</b> " + data.source_channel);
                        $('.s_fi_flag').html("<b>FI Flag:</b> " + data.fi_flag);
                        $('.s_bus_name').html("<b>Business Name:</b> " + data.business_name);
                        $('.s_fi_ini_comments').html("<b>FI Initiation Comments:</b> " + data.fi_intiation_comments);
                        $('.s_asset_make').html("<b>Asset Make:</b> " + data.asset_make);
                        $('.s_asset_model').html("<b>Asset Model:</b> " + data.asset_model);
                        $('.s_station').html("<b>Station:</b> " + data.station);
                        $('.s_tat_start').html("<b>TAT start:</b> " + data.tat_start);
                        $('.s_tat_end').html("<b>TAT end:</b> " + data.tat_end);
                        $('.s_city').html("<b>City:</b> " + data.city);
                        $('.s_pincode').html("<b>Pin Code:</b> " + data.pincode);
                        $('.s_name').html("<b>Name:</b> " + data.customer_name);
                        $('.s_remarks').html("<b>Remarks:</b> " + data.remarks);
                        $('.s_bank_name').html("<b>Bank:</b> " + data.bank_name);
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
                        // $('.s_mobile').html("<b>Mobile:</b> " + data.updated_at);

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
                        // $('#u_residence_address').val(data.residence_address);

                        $('#u_reassign_id').val(user_id);
                        $('#update_assignee').val("edit");
                    }
                });
            });
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
                        $('.bv_application_id').html("<b>Application ID:</b> " + data.application_id);
                        $('.bv_customer_name').html("<b>Customer Name:</b> " + data.customer_name);
                        $('.bv_created_at').html("<b>Date:</b> " + data.created_at);
                        $('.bv_fi_status').html("<b>FI Status:</b> " + data.bv_fi_status);
                        $('.bv_dob').html("<b>DOB:</b> " + data.dob);
                        $('.bv_fi_date').html("<b>FI Date:</b> " + data.fi_date);
                        $('.bv_fi_time').html("<b>FI TIme:</b> " + data.dob);

                        $('.bv_asset_model').html("<b>Asset Model:</b> " + data.asset_model);
                        $('.bv_asset_make').html("<b>Asset Make:</b> " + data.asset_make);
                        $('.bv_amt').html("<b>Loan Amt:</b> " + data.amount);
                        $('.bv_company_name').html("<b>Company Name:</b> " + data.bv_company_name);
                        $('.bv_person_met').html("<b>Person Met:</b> " + data.bv_person_met);


                        $('.bv_bank').html("<b>Bank:</b> " + data.bank_name);
                        $('.bv_product').html("<b>Product:</b> " + data.product_name);
                        $('.bv_nature_of_business').html("<b>Nature of Business:</b> " + data.bv_nature_of_business);

                        $('.bv_corporate_office').html("<b>Corporate Office:</b> " + data.bv_corporate_office);
                        $('.bv_person_designation').html("<b>Person Designation:</b> " + data.bv_person_designation);
                        $('.bv_address_confirmed').html("<b>Address Confirmed:</b> " + data.bv_address_confirmed);
                        $('.bv_applicant_designation').html("<b>Applicant Designation:</b> " + data.bv_applicant_designation);
                        $('.bv_income').html("<b>Income:</b> " + data.bv_income);
                        $('.bv_residence_address').html("<b>Residence Address:</b> " + data.bv_residence_address);
                        $('.bv_business_type').html("<b>Business Type:</b> " + data.bv_business_type);
                        $('.bv_no_employee').html("<b>No. of Employee:</b> " + data.bv_no_employee);
                        $('.bv_working_since').html("<b>Working Since:</b> " + data.bv_working_since);
                        $('.bv_stocks').html("<b>Stocks:</b> " + data.bv_stocks);
                        $('.bv_signboard_name').html("<b>Signboard Name:</b> " + data.bv_signboard_name);
                        $('.bv_business_activity').html("<b>Business Activity:</b> " + data.bv_business_activity);
                        $('.bv_stability').html("<b>Stability:</b> " + data.bv_stability);
                        $('.bv_ownership').html("<b>Ownership:</b> " + data.bv_ownership);
                        // $('.bv_nature_of_business').html("<b>Nature of Business:</b> " + data.bv_nature_of_business);
                        $('.bv_proof').html("<b>Proof:</b> " + data.bv_proof);
                        $('.bv_office_proof').html("<b>Office Proof Seen:</b> " + data.bv_office_proof);
                        $('.bv_vehicle').html("<b>Vehicle:</b> " + data.bv_vehicle);
                        $('.bv_previous_bus_details').html("<b>Previous Business Details:</b> " + data.bv_previous_bus_details);

                        $('.bv_lat').html("<b>Latitude:</b> " + data.bv_lat);
                        $('.bv_long').html("<b>Longitude:</b> " + data.bv_long);
                        $('.bv_pincode').html("<b>Pincode:</b> " + data.bv_pincode);
                        $('.bv_location_add').html("<b>Location:</b> " + data.bv_location_add);

                        $('.bv_tcp1').html("<b>TCP 1:</b> " + data.bv_tcp1);
                        $('.bv_tcp2').html("<b>TCP 2:</b> " + data.bv_tcp2);
                        $('.bv_verified_name').html("<b>Verified Name:</b> " + data.bv_verified_name);
                        $('.bv_dt_of_cpv').html("<b>DT of CPV:</b> " + data.bv_dt_of_cpv);
                        $('.bv_remarks').html("<b>Remarks:</b> " + data.bv_remarks);
                        $('.bv_status').html("<b>Status:</b> " + data.status);
                        $('.bv_image1').attr("src", data.bv_image1);
                        $('.bv_image2').attr("src", data.bv_image2);
                        $('.bv_image3').attr("src", data.bv_image3);
                        $('.bv_image4').attr("src", data.bv_image4);
                        $('.bv_image5').attr("src", data.bv_image5);
                        $('.bv_image6').attr("src", data.bv_image6);
                        $('.bv_image7').attr("src", data.bv_image7);
                        $('.bv_image8').attr("src", data.bv_image8);
                        $('.bv_image9').attr("src", data.bv_image9);
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
                        $('#u_bank_name').val(data.bank_name);
                        $('#u_product_name').val(data.product_name);

                        $('#u_rv_make_model').val(data.rv_make_model);
                        $('#u_rv_fi_status').val(data.rv_fi_status);
                        $('#u_rv_loan_amt').val(data.rv_loan_amt);
                        $('#u_rv_confirm_address').val(data.rv_confirm_address);
                        // $('#u_rv_address_yes_no').val(data.rv_address_yes_no);
                        $('#u_rv_person_met_details').val(data.rv_person_met_details);
                        $('#u_rv_relationship').val(data.rv_relationship);
                        $('#u_rv_residence_ownership').val(data.rv_residence_ownership);
                        $('#u_rv_stability').val(data.rv_stability);
                        $('#u_rv_user_permanent_address').val(data.rv_user_permanent_address);
                        $('#u_rv_rent_per_month').val(data.rv_rent_per_month);

                        $('#u_rv_total_family_member').val(data.rv_total_family_member);
                        $('#u_rv_no_of_earning_members').val(data.rv_no_of_earning_members);
                        // $('#u_rv_details_of_earning_member').val(data.rv_details_of_earning_member);
                        $('#u_rv_dependent').val(data.rv_dependent);
                        $('#u_rv_user_office_address').val(data.rv_user_office_address);
                        $('#u_rv_residence_proof').val(data.rv_residence_proof);
                        $('#u_rv_agriculture_land').val(data.rv_agriculture_land);
                        $('#u_rv_exterior_premises').val(data.rv_exterior_premises);
                        $('#u_rv_interior_premises').val(data.rv_interior_premises);
                        $('#u_rv_cross_verified_info').val(data.rv_cross_verified_info);
                        $('#u_rv_vehicle_details').val(data.rv_vehicle_details);
                        $('#u_rv_neighbour_check1').val(data.rv_neighbour_check1);
                        $('#u_rv_neighbour_check2').val(data.rv_neighbour_check2);
                        $('#u_rv_cpv_done_by').val(data.rv_cpv_done_by);
                        $('#u_rv_remarks').val(data.rv_remarks);


                        $('#rv_case_id').val(user_id);
                        //                     $('#user_uploaded_image').html(data.user_image);  
                        $('#update_rv').val("edit");
                    }
                });
            });
            // end of update data fetch



            // update the form data if we change any
            $('#update_form_reassignee').submit(function(e) {
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
                        $('.s_date').html("<b>Date:</b> " + data.created_at);
                        $('.s_fi_date').html("<b>FI Date:</b> " + data.fi_date);
                        $('.s_fi_time').html("<b>FI Time:</b> " + data.fi_time);
                        $('.s_customer_name').html("<b>Customer Name:</b> " + data.customer_name);
                        $('.s_bank').html("<b>Bank:</b> " + data.bank_name);
                        $('.s_product').html("<b>Product:</b> " + data.product_name);
                        $('.s_geo_limit').html("<b>Geo Limit:</b> " + data.geo_limit);
                        $('.s_fi').html("<b>FI Status:</b> " + data.rv_fi_status);
                        $('.s_make_model').html("<b>Make Model:</b> " + data.rv_make_model);
                        $('.s_loan').html("<b>Amount:</b> " + data.rv_loan_amt);
                        $('.s_cnf_add').html("<b>Confirm Address:</b> " + data.rv_confirm_address);
                        $('.s_person_met_detail').html("<b>Person Met details:</b> " + data.rv_person_met_details);
                        $('.s_relationship').html("<b>Relation:</b> " + data.rv_relationship);
                        $('.s_residence_ownerships').html("<b>Residence by:</b> " + data.rv_residence_ownership);
                        $('.r_stability').html("<b>Stability:</b> " + data.rv_stability);
                        $('.r_permanent_add').html("<b>Permanent Add:</b> " + data.rv_user_permanent_address);
                        $('.r_rent').html("<b>Rent:</b> " + data.rv_rent_per_month);
                        $('.r_total_member').html("<b>total Members:</b> " + data.rv_total_family_member);
                        $('.r_no_of_earning_members').html("<b>No. of earning member:</b> " + data.rv_no_of_earning_members);
                        $('.r_details_members').html("<b>Member Details:</b> " + data.rv_details_of_earning_member);
                        $('.r_dependent').html("<b>Dependent:</b> " + data.rv_dependent);
                        $('.r_user_office_add').html("<b>User Office Add.:</b> " + data.rv_user_office_address);
                        $('.r_resi_proof').html("<b>Residence Proof:</b> " + data.rv_residence_proof);
                        $('.r_in').html("<b>Interior:</b> " + data.rv_interior_premises);
                        $('.r_ex').html("<b>Exterior:</b> " + data.rv_exterior_premises);
                        $('.r_agri').html("<b>Agriculture Landing:</b> " + data.rv_agriculture_land);
                        $('.r_check1').html("<b>Check 1:</b> " + data.rv_neighbour_check1);
                        $('.r_lat').html("<b>Latitude:</b> " + data.rv_lat);
                        $('.r_long').html("<b>Longitude:</b> " + data.rv_long);
                        $('.r_pincode').html("<b>Pincode:</b> " + data.rv_pincode);
                        $('.r_location_add').html("<b>Location Address:</b> " + data.rv_location_add);
                        $('.r_check2').html("<b>Check 2:</b> " + data.rv_neighbour_check2);

                        $('.r_cpv').html("<b>CPV done by:</b> " + data.rv_cpv_done_by);
                        $('.r_visit').html("<b>Visit Date:</b> " + data.rv_visit_date);
                        $('.r_remarks').html("<b>Remarks:</b> " + data.rv_remarks);
                        $('.r_add_yesno').html("<b>Address Confirmed:</b> " + data.rv_address_yes_no);
                        $('.r_vehicle').html("<b>Vehicle:</b> " + data.rv_vehicle_details);
                        $('.rv_image1').attr("src", data.rv_image1);
                        $('.rv_image2').attr("src", data.rv_image2);
                        $('.rv_image3').attr("src", data.rv_image3);
                        $('.rv_image4').attr("src", data.rv_image4);
                        $('.rv_image5').attr("src", data.rv_image5);
                        $('.rv_image6').attr("src", data.rv_image6);
                        $('.rv_image7').attr("src", data.rv_image7);
                        $('.rv_image8').attr("src", data.rv_image8);
                        $('.rv_image9').attr("src", data.rv_image9);
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





            $("#u_code").focus(function() {
                $.ajax({
                    url: '<?= base_url() ?>Mini_case_controller/getAgentCode',
                    method: 'post',
                    dataType: 'json',
                    success: function(response) {
                        $('#u_code').find('option').not(':first').remove();
                        $.each(response, function(index, data) {
                            // console.log(data['id']);
                            $('#u_code').append('<option value="' + data['employee_unique_id'] + '">' + data['first_name'] + '</option>');
                        });
                    }
                });
            });


        });
    </script>
</head>

<body>
    <style>
        body {
            padding-top: 20px;
            padding-right: 80px;
            padding-left: 80px;
            font-family: 'Poppins', serif;
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
        <a href="<?php echo base_url(); ?>Admin_dashboard_controller/admin_dashboard" class="btn btn-info">Admin</a>
    </div>
    <br>

    <label>From</label>
    <input type="text" name="from" id="from" required value="<?php echo date("Y-m-d"); ?>">
    <label>To</label>
    <input type="text" name="to" id="to" required value="<?php echo date("Y-m-d"); ?>">
    <button class="btn btn-warning " name="sub_btn" id="sub_btn"> GET </button>
    <label>Select FI Type</label>
    <select id="fitype" name="fitype" onchange="getFitype(this.value)">FI Type
        <option id="RV">RV</option>
        <option id="BV">BV</option>
    </select>

    <label>Select Status</label>
    <select id="casestatus" name="casestatus" onchange="getCasestatus(this.value)">Status
        <option id="inactive">inactive</option>
        <option id="Resolved">Resolved</option>
    </select>

    <button id="assigncasebutton" style="display:none;" type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-warning btn-md reassigned_case">Assign case</button>


    <div class="tab-pane container active text-dark" id="home">
        <div class="table-responsive text-dark ">
            <br />
            <table id="fetch_assign_data" class="table table-bordered table-striped" cellspacing="0" style="width:100%">
                <thead>
                    <tr class="">
                        <th width="2%"></th>
                        <th width="6%">ID</th>
                        <th>App ID</th>
                        <th>Bank</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Type</th>
                        <th>TAT Start</th>
                        <th>TAT End</th>
                        <th width="9%">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbdy">
                    <?php $i = 1;
                    foreach ($allAgent as $key => $rows) :
                    ?>
                        <tr>
                            <td><input type="checkbox" onclick="showassignbutton(<?php echo $i ?>)" id="assign<?php echo $i ?>" value='<?= $rows->uid; ?>' name="assign"></td>
                            <td><?= $rows->uid; ?></td>
                            <td><?= $rows->application_id; ?></td>
                            <td><?= $rows->bank_name; ?></td>
                            <td><?= $rows->customer_name; ?></td>
                            <td><?= $rows->business_address; ?></td>
                            <td><?= $rows->fi_to_be_conducted; ?></td>
                            <td><?= readableDateIST($rows->tat_start); ?></td>
                            <td><?= readableDateIST($rows->tat_end); ?></td>
                            <td><?= $rows->status; ?></td>
                            <td>

                                <button type="button" name="view" id="<?= $rows->uid; ?>" title="View case" class="btn btn-success btn-sm view_assigned_case"><i class="fa fa-eye"></i></button>
                                <button type="button" name="edit" id="<?= $rows->uid; ?>" title="Edit case" class="btn btn-info btn-sm edit_assigned_case"><i class="fa fa-pencil"></i></button>
                                <button type="button" name="reassign" id="<?= $rows->uid; ?>" title="Assign case" class="btn btn-primary btn-sm reassigned_case"><i class="fa fa-users"></i></button>
                                <?php
                                if ($rows->fi_to_be_conducted == 'BV') { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="BV View Data" class="btn btn-info btn-sm bv_view_details"><i class="fa fa-users"></i></button>
                                    <button type="button" name="bv_edit" id="<?= $rows->uid; ?>" title="BV Edit" class="btn btn-warning btn-sm bv_edit_details"><i class="fa fa-pencil"></i></button>
                                <?php } else { ?>
                                    <button type="button" name="view" id="<?= $rows->uid; ?>" title="RV View data" class="btn btn-warning btn-sm fi_type_view_data"><i class="fa fa-users"></i></button>
                                    <button type="button" name="rv_edit" id="<?= $rows->uid; ?>" title="RV Edit" class="btn btn-info btn-sm rv_edit_details"><i class="fa fa-edit"></i></button>
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
                                                    <h4 class="s_application_id">
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
                                                    <h4 class="s_fi_ini_comments">
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
                                <label for="customer_name" class="h6">Customer Name</label>
                                <input type="text" class="form-control" id="u_customer_name" placeholder="Customer name here" name="customer_name">
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
                                <label for="fi_intiation_comments" class="h6">Fi initiation comments</label>
                                <input type="text" class="form-control" id="u_fi_intiation_comments" placeholder="fi intiation comments here" name="fi_intiation_comments">
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
                                <input type="text" class="form-control" id="u_bank_name" placeholder="Bank name here" name="bank_name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="product_name" class="h6">Product</label>
                                <input type="text" class="form-control" id="u_product_name" placeholder="Product name here" name="product_name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_make_model" class="h6">Make Model</label>
                                <input type="text" class="form-control" id="u_rv_make_model" placeholder="RV modal here" name="rv_make_model">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_fi_status" class="h6">FI Type</label>
                                <select class="form-control" id="u_rv_fi_status" name="rv_fi_status">
                                    <option value="" selected>-- SELECT FI STATUS --</option>
                                    <option value="Positive">Positive</option>
                                    <option value="Negative">Negative</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_loan_amt" class="h6">Loan Amount</label>
                                <input type="number" class="form-control" id="u_rv_loan_amt" placeholder="Loan amount" name="rv_loan_amt">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_confirm_address" class="h6">Residence Address</label>
                                <input type="text" class="form-control" id="u_rv_confirm_address" placeholder="Confirm address here" name="rv_confirm_address">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_person_met_details" class="h6">Person Met Details</label>
                                <input type="text" class="form-control" id="u_rv_person_met_details" placeholder="Person Met details here" name="rv_person_met_details">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_relationship" class="h6">Relationship</label>
                                <input type="text" class="form-control" id="u_rv_relationship" placeholder="office address here" name="rv_relationship">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_residence_ownership" class="h6">Residence Ownership</label>
                                <input type="text" class="form-control" id="u_rv_residence_ownership" placeholder="Residence Ownership here" name="rv_residence_ownership">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_stability" class="h6">Stability</label>
                                <input type="text" class="form-control" id="u_rv_stability" placeholder="Stability here" name="rv_stability">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_user_permanent_address" class="h6">User Permanent Address</label>
                                <input type="text" class="form-control" id="u_rv_user_permanent_address" placeholder="User Permanent Address here" name="rv_user_permanent_address">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_rent_per_month" class="h6">Rent Per month</label>
                                <input type="number" class="form-control" id="u_rv_rent_per_month" placeholder="Rent Per month here" name="rv_rent_per_month">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_total_family_member" class="h6">Total Family Members</label>
                                <input type="number" class="form-control" id="u_rv_total_family_member" placeholder="Total Family Members" name="rv_total_family_member">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_no_of_earning_members" class="h6">No. of Earning Member</label>
                                <input type="number" class="form-control" id="u_rv_no_of_earning_members" placeholder="No. of Earning Members here" name="rv_no_of_earning_members">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_dependent" class="h6">Dependent Member details</label>
                                <input type="text" class="form-control" id="u_rv_dependent" placeholder="Dependent members here" name="rv_dependent">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_user_office_address" class="h6">User office Address</label>
                                <input type="text" class="form-control" id="u_rv_user_office_address" placeholder="User Office Address here" name="rv_user_office_address">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_residence_proof" class="h6">amount</label>
                                <input type="text" class="form-control" id="u_rv_residence_proof" placeholder="Residence Proof here" name="rv_residence_proof">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_agriculture_land" class="h6">Agriculture Land</label>
                                <input type="text" class="form-control" id="u_rv_agriculture_land" placeholder="Agriculture Land here" name="rv_agriculture_land">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_exterior_premises" class="h6">Exterior Premises</label>
                                <input type="text" class="form-control" id="u_rv_exterior_premises" placeholder="Exterior Premises here" name="rv_exterior_premises">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_interior_premises" class="h6">Interior Premises</label>
                                <input type="text" class="form-control" id="u_rv_interior_premises" placeholder="Interior Premises here" name="rv_interior_premises">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_cross_verified_info" class="h6">Cross Verified Info</label>
                                <input type="text" class="form-control" id="u_rv_cross_verified_info" placeholder="Cross Verified Info here" name="rv_cross_verified_info">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_vehicle_details" class="h6">Vehicle Details here</label>
                                <input type="text" class="form-control" id="u_rv_vehicle_details" placeholder="Vehicle here" name="rv_vehicle_details">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_neighbour_check1" class="h6">Neighbour Check 1</label>
                                <input type="text" class="form-control" id="u_rv_neighbour_check1" placeholder="Neighbour Check" name="rv_neighbour_check1">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_neighbour_check2" class="h6">Neighbour Check 2</label>
                                <input type="text" class="form-control" id="u_rv_neighbour_check2" placeholder="Neighbour Check" name="rv_neighbour_check2">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_cpv_done_by" class="h6">CPV</label>
                                <input type="text" class="form-control" id="u_rv_cpv_done_by" placeholder="CPV done by" name="rv_cpv_done_by">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rv_remarks" class="h6">Remarks</label>
                                <input type="text" class="form-control" id="u_rv_remarks" placeholder="Add Remarks (if any) here" name="rv_remarks">
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
                                                <h4 class="s_application_id">
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
                                                <h4 class="s_fi_date">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="s_fi_time">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="s_fi_flag">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="s_dob">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="s_geo_limit">
                                                </h4>
                                            </div>
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
                                                <h4 class="r_vehicle">
                                                </h4>

                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="s_make_model">
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

                                        </div>
                                    </div>
                                </div>


                                <hr>

                                <h3 style="color:blue;">Address Confirmation</h3>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="r_add_yesno">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="s_cnf_add">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                    <hr>

                                    <h3 style="color:blue;">Personal details</h3>


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
                                    <h3 style="color:blue;">Residence details</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <div class="col-sm-6">
                                                    <h4 class="s_residence_ownerships">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_stability">
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <div class="col-sm-6">
                                                    <h4 class="r_permanent_add">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_rent">
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
                                    <hr>
                                    <h3 style="color:blue;">Other Information</h3>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6">
                                                <div class="col-sm-6">
                                                    <h4 class="r_user_office_add">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="r_resi_proof">
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
                                                    <h4 class="r_in">
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

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-6 ">
                                                <div class="col-sm-6">
                                                    <h4 class="r_agri">
                                                    </h4>
                                                </div>
                                                <div class="col-sm-6">
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

                                            </div>
                                        </div>
                                    </div>
                                    <hr>


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


                                    <hr>

                                    <h3 style="color:blue;">Picture's Taken</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-4">
                                                <div class="col-sm-4">
                                                    <img class="rv_image1" height="200" width="200">
                                                </div>
                                                <div class="col-sm-4">
                                                    <img class="rv_image2" height="200" width="200">
                                                </div>
                                                <div class="col-sm-4">
                                                    <img class="rv_image3" height="200" width="200">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-4">
                                                <div class="col-sm-4">
                                                    <img class="rv_image4" height="200" width="200">
                                                </div>
                                                <div class="col-sm-4">
                                                    <img class="rv_image5" height="200" width="200">
                                                </div>
                                                <div class="col-sm-4">
                                                    <img class="rv_image6" height="200" width="200">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row pt-4">
                                                <div class="col-sm-4">
                                                    <img class="rv_image7" height="200" width="200">
                                                </div>
                                                <div class="col-sm-4">
                                                    <img class="rv_image8" height="200" width="200">
                                                </div>
                                                <div class="col-sm-4">
                                                    <img class="rv_image9" height="200" width="200">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

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
                                                <h4 class="bv_application_id">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="bv_customer_name">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="bv_created_at">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="bv_dob">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="bv_fi_date">
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4 class="bv_fi_time">
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-6 ">
                                            <div class="col-sm-6">
                                                <h4 class="bv_corporate_office">
                                                </h4>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <h3 style="color:blue;">Details of which loan is applied</h3>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row pt-4 ">
                                            <div class="col-sm-4">
                                                <h4 class="bv_asset_make">
                                                </h4>
                                            </div>
                                            <div class="col-sm-4">
                                                <h4 class="bv_asset_model">
                                                </h4>
                                            </div>
                                            <div class="col-sm-4">
                                                <h4 class="bv_amt">
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
                                                <div class="row pt-6 ">
                                                    <div class="col-sm-6">
                                                        <h4 class="bv_address_confirmed">
                                                        </h4>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h4 class="bv_applicant_designation">
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

                                                <h3 style="color:blue;">Business Details</h3>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row pt-6 ">
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_working_since">
                                                                </h4>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <h4 class="bv_ownership">
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
                                                        <div class="row pt-12 ">
                                                            <div class="col-sm-12">
                                                                <h4 class="bv_stocks">
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
                                                    <!-- <hr> -->




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




                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="row pt-6 ">
                                                                    <div class="col-sm-6">
                                                                        <h4 class="bv_stability">
                                                                        </h4>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <h4 class="bv_previous_bus_details">
                                                                        </h4>
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

                                                                    </div>
                                                                </div>


                                                                <hr>


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


                                                                        <hr>







                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-6 ">
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_vehicle">
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_verified_name">
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
                                                                                        <h4 class="bv_tcp1">
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <h4 class="bv_tcp2">
                                                                                        </h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>


                                                                        <!-- <h3 style="color:blue;">Other Information</h3> -->
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-4 ">
                                                                                    <div class="col-sm-4">
                                                                                        <h4 class="bv_dt_of_cpv">
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                        <h4 class="bv_remarks">
                                                                                        </h4>
                                                                                    </div>

                                                                                    <div class="col-sm-4">
                                                                                        <h4 class="bv_status">
                                                                                        </h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <hr>
                                                                        <h3 style="color:blue;">Picture's Taken</h3>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-4">
                                                                                    <div class="col-sm-4">
                                                                                        <img class="bv_image1" height="200" width="200">
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                        <img class="bv_image2" height="200" width="200">
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                        <img class="bv_image3" height="200" width="200">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-4">
                                                                                    <div class="col-sm-4">
                                                                                        <img class="bv_image4" height="200" width="200">
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                        <img class="bv_image5" height="200" width="200">
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                        <img class="bv_image6" height="200" width="200">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>

                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row pt-4">
                                                                                    <div class="col-sm-4">
                                                                                        <img class="bv_image7" height="200" width="200">
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                        <img class="bv_image8" height="200" width="200">
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                        <img class="bv_image9" height="200" width="200">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>
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
                                        </script>


                                        <script>
                                            function showassignbutton(val) {
                                                if ($("#assign" + val).is(':checked')) {
                                                    $("#assigncasebutton").show();

                                                }
                                            }
                                        </script>

</body>

</html>