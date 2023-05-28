<<<<<<< HEAD
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Banking System</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

    

    <script type="text/javascript">
        BASE_URL = "<?php echo base_url(); ?>"
    </script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>
</head>

<body>

    <script>
        $(document).ready(function() {

            var password = document.getElementById("password"),
                cnf_password = document.getElementById("cnf_password");

            function validatePassword() {
                if (password.value != cnf_password.value) {
                    cnf_password.setCustomValidity("Password and confirm password are not Matching");
                } else {
                    cnf_password.setCustomValidity('');
                }
            }

            password.onchange = validatePassword;
            cnf_password.onkeyup = validatePassword;

            // swal("Hello World");

            var edit_password = document.getElementById("u_password"),
                edit_cnf_password = document.getElementById("u_cnf_password");

            function validateEditPassword() {
                if (edit_password.value != edit_cnf_password.value) {
                    edit_cnf_password.setCustomValidity("Password and confirm password are not Matching");
                } else {
                    edit_cnf_password.setCustomValidity('');
                }
            }

            edit_password.onchange = validateEditPassword;
            edit_cnf_password.onkeyup = validateEditPassword;


            var dataTable = $('#fetch_user_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "ajax": {
                    url: "<?php echo base_url() . 'Create_user_controller/fetch_all_user'; ?>",
                    type: "POST",
                },
                "columnDefs": [{
                    "targets": [8],
                    "orderable": false
                }],
                "lengthMenu": [
                    [100, 200, 500, -1],
                    [100, 200, 500, "All"]
                ],
                createdRow: function(row, data, rowIndex) {
                    $.each($('td', row), function(colIndex) {
                        if (colIndex == 7) {
                            $(this).attr('data-name', 'status');
                            $(this).attr('class', 'status');
                            $(this).attr('data-type', 'select');
                            $(this).attr('data-pk', data[0]);
                        }
                    });
                }
            });

            $('#fetch_user_data').editable({
                mode: 'inline',
                container: 'body',
                selector: 'td.status',
                url: '<?php echo base_url() . 'Create_user_controller/get_status'; ?>',
                title: 'Status',
                type: 'POST',
                datatype: 'json',
                source: [{
                    value: "active",
                    text: "Active"
                }, {
                    value: "inactive",
                    text: "Inactive"
                }],
                validate: function(value) {
                    if ($.trim(value) == '') {
                        return 'This field is required';
                    }
                }
            });

            $('#role_group').change(function() {
                if ($(this).val() == "FA") {
                    $("#username").hide();
                    $("#user_label").hide();

                    $("#password").hide();
                    $("#pass_label").hide();

                    $("#cnf_password").hide();
                    $("#cnf_label").hide();

                } else {
                    $("#username").show();
                    $("#user_label").show();

                    $("#password").show();
                    $("#pass_label").show();

                    $("#cnf_password").show();
                    $("#cnf_label").show();
                }
            });

            // add new class part
            $('#form_create_user').submit(function(e) {
                e.preventDefault();
                var me = $(this);
                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        // alert("User Generated Successfully!");
                        if (response.success == true) {
                            alert("User Generated Successfully!");
                            location.reload();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#create_user_model').modal('hide');
                            swal.fire({
                                title: "Added",
                                text: "User has been Added",
                                icon: 'success',
                                type: "success",
                                timer: 3000
                            });
                            // $('#fetch_class_show').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();
                            alert("User Generated Successfully!");
                        } else {
                            alert("Please fill the details correctly!");
                            // prepare error
                            $.each(response.messages, function(key, value) {
                                var element = $('#' + key);
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
                        //   swal.fire("Error deleting!", "Please try again later !!!", "error");
                        $('#create_user_model').modal('hide');
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

            // update the form data if we change any
            $('#update_password_form').submit(function(e) {
                // alert("click on update button");
                e.preventDefault();
                var me = $(this);
                var user_id = $(this).attr("id");

                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: me.serialize(),
                    // data:new FormData(this),  
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            alert("Password Updated Successfully!");
                            location.reload();
                            $('#user_password_edit').modal('hide');
                            Swal.fire("Good job!", "You clicked the button!", "success");
                            // swal.fire({
                            //     title: "updated",
                            //     text: response.message,
                            //     icon: 'success',
                            //     type: "success",
                            //     timer: 3000
                            // });
                            console.log(response);
                            alert("Password Updated Successfully!");
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#fetch_user_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                        } else if (response.error == true) {
                            $('#user_password_edit').modal('hide');
                            Swal.fire("Good job!", "You clicked the button!", "error");
                            // swal.fire({
                            //     title: "Try Again ! ",
                            //     text: response.message,
                            //     icon: 'error',
                            //     type: "error",
                            //     timer: 3000
                            // });
                            $('#user_password_edit').modal('hide');
                            //console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            // $('#teacher_add_model').modal('hide');
                            $('#fetch_user_data').DataTable().ajax.reload();
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
                        $('#user_password_edit').modal('hide');
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
            $(document).on('click', '.edit_password', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Create_user_controller/fetch_single_password",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#user_password_edit').modal('show');
                        $('#u_password').val(data.password);
                        $('#u_pass_id').val(user_id);
                        $('#update_password').val("edit");
                    }
                });
            });


            // update the form data if we change any
            $('#update_mobile_form').submit(function(e) {
                // alert("click on update button");
                e.preventDefault();
                var me = $(this);
                var users_id = $(this).attr("id");

                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: me.serialize(),
                    // data:new FormData(this),  
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            alert("Mobile Updated Successfully!");
                            location.reload();
                            $('#user_mobile_edit').modal('hide');
                            Swal.fire("Good job!", "You clicked the button!", "success");
                            console.log(response);
                            alert("Mobile Updated Successfully!");
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#fetch_user_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                        } else if (response.error == true) {
                            $('#user_mobile_edit').modal('hide');
                            Swal.fire("Good job!", "You clicked the button!", "error");
                            // swal.fire({
                            //     title: "Try Again ! ",
                            //     text: response.message,
                            //     icon: 'error',
                            //     type: "error",
                            //     timer: 3000
                            // });
                            $('#user_mobile_edit').modal('hide');
                            //console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            // $('#teacher_add_model').modal('hide');
                            $('#fetch_user_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();
                        } else {
                            $.each(response.messages, function(key, value) {
                                var element = $('#r_' + key);

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
                        $('#user_mobile_edit').modal('hide');
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

            $(document).on('click', '.edit_mobile', function() {
                var users_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Create_user_controller/fetch_single_mobile",
                    method: "POST",
                    data: {
                        users_id: users_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#user_mobile_edit').modal('show');
                        $('#r_mobile').val(data.mobile);
                        $('#r_mobile_id').val(users_id);
                        $('#update_mobile').val("edit");
                    }
                });
            });

        });
    </script>


    <style>
        body {
            padding-top: 20px;
            padding-right: 80px;
            padding-left: 80px;
            font-family: 'Poppins', serif;
        }

        figure {
            width: 1170px;
            height: 625px;
            border-radius: 4px;
            border: 2px solid #ccc;
            position: relative;
            padding: 48px 10px 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }


        figure:before {
            content: attr(data-title);
            position: absolute;
            top: 0px;
            left: 0;
            width: 100%;
            height: 40px;
            line-height: 40px;
            text-indent: 10px;
            border-bottom: 2px solid #ccc;
        }

        .SubmenuBox {
            height: 160px;
            width: 100%;
            margin-bottom: 20px;
            text-align: center;
        }

        .SubmenuText {
            font-size: 16px;
            font-weight: bold;
            display: block;
            padding-bottom: 5px;
            color: #375b91;
        }

        /* .container {
            border-radius: 5px;
            padding: 20px;
            margin-left: 20px;
            margin-right: 20px;
        } */

        .SubmenuBox a {
            height: 100%;
            width: 100%;
            display: block;
            padding: 20px 12px;
            border: 1px solid #eee;
            background: #fcfcfc;
        }

        .SubmenuBox a:hover {
            background: #fff;
            text-decoration: none !important;
            box-shadow: 0 0 10px #eee;
        }

        .SubmenuBox a:focus {
            text-decoration: none !important;
        }

        .SubmenuText2 {
            font-size: 12px;
            font-weight: normal;
            display: block;
            color: #2a2a2a;
        }

        .SubmenuBox img {
            height: 48px;
            width: 48px;
            margin-bottom: 10px;
        }

        td {
            padding: 5px !important;
            border-width: 0 !important;
            border-style: None !important;
            border-radius: 2px;
        }

        td a {
            font-weight: normal !Important;
        }

        td img {
            height: 48px;
            width: 48px;
        }

        .linkthumbnails {
            padding: 15px;
        }

        .card {
            position: relative;
            width: 350px;
            padding: 20px;
            box-shadow: 3px 10px 20px rgba(0, 0, 0, 0.2);
            border-radius: 3px;
            border: 0;
            float: left;
            margin-bottom: 15px;
            margin-left: 15px;
            align-items: center;

        }

        .circle {
            border-radius: 3px;
            width: 130px;
            height: 130px;
            background: black;
            position: absolute;
            right: 0px;
            top: 0;
            background-image: linear-gradient(to top, #28aef0 0%, #0e88c5 100%);
            border-bottom-left-radius: 170px;
        }

        input[type=submit] {
            background-color: #90EE90;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
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

    <div class="container">
        <div class="page-header-inner">
            <div class="col-md-4 col-sm-6">
                <div class="row">
                    <div id="dvTitle" class="product_name">
                        <h3><b>RealBits Coders</b></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="row">
                    <div id="dvTitle" class="veri">
                        <h3><b>Verification System(1.0.0)</b></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="row">
                    <div id="dvTitle" class="logout">
                        <?php
                        $user = $this->session->userdata('user');
                        extract($user);
                        ?>
                        <h3><?php echo $username; ?> <b><a id="lblLogOut" href="<?php echo base_url(); ?>user/logout">LogOut</a></b></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="mybtn-right">
        <a href="<?php echo base_url(); ?>home" class="btn btn-info" class="btn btn-info">Dashboard</a>
        <a href="<?php echo base_url(); ?>Create_cse/create_c" class="btn btn-info">Case</a>
        <a href="<?php echo base_url(); ?>Report_controller/report_page_open" class="btn btn-info">Report</a>
        <a href="<?php echo base_url(); ?>Admin_dashboard_controller/admin_dashboard" class="btn btn-info">Admin</a>
    </div>
    <br>

    <div class="mybtn-left">
        <button type="button" class="btn btn-primary btn-md" data-toggle="modal" id="add_button" data-target="#create_user_model">Create User</button>
    </div>
    <div class="tab-pane container active text-dark" id="home">
        <div class="table-responsive text-dark ">
            <br>

            <style>
                #fetch_user_data .action-button {
                    margin-right: 10px;
                    margin-left: 10px;
                    /* Adjust the value as per your desired spacing */
                }
            </style>
            <table id="fetch_user_data" class="table table-bordered table-striped">
                <thead>
                    <tr class="">
                        <th width="6%">ID</th>
                        <th width="10%">Role Group</th>
                        <th width="10%">First name</th>
                        <th width="10%">User name</th>
                        <th width="10%">Password</th>
                        <th width="10%">Mobile</th>
                        <th width="10%">Org Name</th>
                        <th width="10%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div id="create_user_model" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New User</h4>
                </div>
                <?php echo form_open('Create_user_controller/create_user_validation', array('id' => 'form_create_user')) ?>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="first_name" class="h5">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="last_name" class="h5">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="role_group" class="h5">Role Group</label>
                        <select class="form-control" id="role_group" name="role_group">
                            <option value="yes" selected>-- Choose Role Group --</option>
                            <option value="SA">SA</option>
                            <option value="OA">OA</option>
                            <option value="AM">AM</option>
                            <option value="FA">FA</option>
                            <option value="Client Manager">Client Manager</option>
                            <option value="Back Office Executive">Back Office Executive</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="username" id="user_label" class="h5">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="password" id="pass_label" class="h5">Password</label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cnf_password" id="cnf_label" class="h5">Confirm Password</label>
                        <input type="text" class="form-control" id="cnf_password" name="cnf_password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="mobile" class="h5">Mobile No.</label>
                        <input type="text" class="form-control" id="mobile" name="mobile">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="email" class="h5">Email ID</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="employee_unique_id" class="h5">Employee Unique ID</label>
                        <input type="text" class="form-control" id="employee_unique_id" name="employee_unique_id">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="organization" class="h5">Organization</label>
                        <input type="text" class="form-control" id="organization" name="organization">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="lead_name" class="h5">Lead Name</label>
                        <input type="text" class="form-control" id="lead_name" name="lead_name">
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" name="create_user" id="create_user_data" class="btn btn-primary" value="Add">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
                <?php echo form_close() ?>
            </div>

        </div>
    </div>

    <!-- <div id="user_password_edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Password</h4>
                </div>
                <?php echo form_open("Create_user_controller/update_user_password_validation", array("id" => "update_password_form", "class" => "form-horizontal")) ?>
                <input type="hidden" class="form-control" id="u_pass_id" name="p_id">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="password" class="h5">Password</label>
                        <input type="text" class="form-control" id="u_password" placeholder="Enter Password" name="password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cnf_password" class="h5">Confirm Password</label>
                        <input type="text" class="form-control" id="u_cnf_password" placeholder="Enter Confirm Password" name="cnf_password">
                    </div>
                </div>

                
                <div class="modal-footer">
                    <input type="submit" name="update_password" id="update_pass_data" class="btn btn-primary" value="Edit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->

    <div class="modal fade" id="user_password_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Password</h5>
                </div>
                <?php echo form_open("Create_user_controller/update_user_password_validation", array("id" => "update_password_form", "class" => "form-horizontal")) ?>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="u_pass_id" name="p_id">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="password" class="h5">Password</label>
                            <input type="text" class="form-control" id="u_password" placeholder="Enter Password" name="password">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cnf_password" class="h5">Confirm Password</label>
                            <input type="text" class="form-control" id="u_cnf_password" placeholder="Enter Confirm Password" name="cnf_password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="update_password" id="update_pass_data" class="btn btn-primary" value="Edit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


    <!-- <div id="user_mobile_edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Mobile</h4>
                </div>
                <?php echo form_open("Create_user_controller/update_user_password_validation", array("id" => "update_mobile_form", "class" => "form-horizontal")) ?>
                <input type="hidden" class="form-control" id="r_mobile_id" name="m_id">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="mobile" class="h5">Mobile</label>
                        <input type="text" class="form-control" id="r_mobile" placeholder="Enter Mobile" name="mobile">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="update_mobile" id="update_mobile" class="btn btn-primary" value="submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div> -->

    <div id="user_mobile_edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Mobile</h4>
                </div>
                <?php echo form_open("Create_user_controller/update_mobile", array("id" => "update_mobile_form", "class" => "form-horizontal")) ?>
                <input type="hidden" class="form-control" id="r_mobile_id" name="m_id">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="mobile" class="h5">Mobile</label>
                        <input type="text" class="form-control" id="r_mobile" placeholder="Enter Mobile" name="mobile">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="update_mobile" id="update_mobile" class="btn btn-primary" value="submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


</body>

=======
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Banking System</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

    

    <script type="text/javascript">
        BASE_URL = "<?php echo base_url(); ?>"
    </script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>
</head>

<body>

    <script>
        $(document).ready(function() {

            var password = document.getElementById("password"),
                cnf_password = document.getElementById("cnf_password");

            function validatePassword() {
                if (password.value != cnf_password.value) {
                    cnf_password.setCustomValidity("Password and confirm password are not Matching");
                } else {
                    cnf_password.setCustomValidity('');
                }
            }

            password.onchange = validatePassword;
            cnf_password.onkeyup = validatePassword;

            // swal("Hello World");

            var edit_password = document.getElementById("u_password"),
                edit_cnf_password = document.getElementById("u_cnf_password");

            function validateEditPassword() {
                if (edit_password.value != edit_cnf_password.value) {
                    edit_cnf_password.setCustomValidity("Password and confirm password are not Matching");
                } else {
                    edit_cnf_password.setCustomValidity('');
                }
            }

            edit_password.onchange = validateEditPassword;
            edit_cnf_password.onkeyup = validateEditPassword;


            var dataTable = $('#fetch_user_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "ajax": {
                    url: "<?php echo base_url() . 'Create_user_controller/fetch_all_user'; ?>",
                    type: "POST",
                },
                "columnDefs": [{
                    "targets": [8],
                    "orderable": false
                }],
                "lengthMenu": [
                    [100, 200, 500, -1],
                    [100, 200, 500, "All"]
                ],
                createdRow: function(row, data, rowIndex) {
                    $.each($('td', row), function(colIndex) {
                        if (colIndex == 8) {
                            $(this).attr('data-name', 'status');
                            $(this).attr('class', 'status');
                            $(this).attr('data-type', 'select');
                            $(this).attr('data-pk', data[0]);
                        }
                    });
                }
            });

            $('#fetch_user_data').editable({
                mode: 'inline',
                container: 'body',
                selector: 'td.status',
                url: '<?php echo base_url() . 'Create_user_controller/get_status'; ?>',
                title: 'Status',
                type: 'POST',
                datatype: 'json',
                source: [{
                    value: "active",
                    text: "Active"
                }, {
                    value: "inactive",
                    text: "Inactive"
                }],
                validate: function(value) {
                    if ($.trim(value) == '') {
                        return 'This field is required';
                    }
                }
            });

            $('#role_group').change(function() {
                if ($(this).val() == "FA") {
                    $("#username").hide();
                    $("#user_label").hide();

                    $("#password").hide();
                    $("#pass_label").hide();

                    $("#cnf_password").hide();
                    $("#cnf_label").hide();

                } else {
                    $("#username").show();
                    $("#user_label").show();

                    $("#password").show();
                    $("#pass_label").show();

                    $("#cnf_password").show();
                    $("#cnf_label").show();
                }
            });

            // add new class part
            $('#form_create_user').submit(function(e) {
                e.preventDefault();
                var me = $(this);
                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        // alert("User Generated Successfully!");
                        if (response.success == true) {
                            alert("User Generated Successfully!");
                            location.reload();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#create_user_model').modal('hide');
                            swal.fire({
                                title: "Added",
                                text: "User has been Added",
                                icon: 'success',
                                type: "success",
                                timer: 3000
                            });
                            // $('#fetch_class_show').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();
                            alert("User Generated Successfully!");
                        } else {
                            alert("Please fill the details correctly!");
                            // prepare error
                            $.each(response.messages, function(key, value) {
                                var element = $('#' + key);
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
                        //   swal.fire("Error deleting!", "Please try again later !!!", "error");
                        $('#create_user_model').modal('hide');
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

            // update the form data if we change any
            $('#update_password_form').submit(function(e) {
                // alert("click on update button");
                e.preventDefault();
                var me = $(this);
                var user_id = $(this).attr("id");

                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: me.serialize(),
                    // data:new FormData(this),  
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            alert("Password Updated Successfully!");
                            location.reload();
                            $('#user_password_edit').modal('hide');
                            Swal.fire("Good job!", "You clicked the button!", "success");
                            // swal.fire({
                            //     title: "updated",
                            //     text: response.message,
                            //     icon: 'success',
                            //     type: "success",
                            //     timer: 3000
                            // });
                            console.log(response);
                            alert("Password Updated Successfully!");
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#fetch_user_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                        } else if (response.error == true) {
                            $('#user_password_edit').modal('hide');
                            Swal.fire("Good job!", "You clicked the button!", "error");
                            // swal.fire({
                            //     title: "Try Again ! ",
                            //     text: response.message,
                            //     icon: 'error',
                            //     type: "error",
                            //     timer: 3000
                            // });
                            $('#user_password_edit').modal('hide');
                            //console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            // $('#teacher_add_model').modal('hide');
                            $('#fetch_user_data').DataTable().ajax.reload();
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
                        $('#user_password_edit').modal('hide');
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
            $(document).on('click', '.edit_password', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Create_user_controller/fetch_single_password",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#user_password_edit').modal('show');
                        $('#u_password').val(data.password);
                        $('#u_pass_id').val(user_id);
                        $('#update_password').val("edit");
                    }
                });
            });


            // update the form data if we change any
            $('#update_mobile_form').submit(function(e) {
                // alert("click on update button");
                e.preventDefault();
                var me = $(this);
                var users_id = $(this).attr("id");

                // perform ajax
                $.ajax({
                    url: me.attr('action'),
                    type: 'POST',
                    data: me.serialize(),
                    // data:new FormData(this),  
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            alert("Mobile Updated Successfully!");
                            location.reload();
                            $('#user_mobile_edit').modal('hide');
                            Swal.fire("Good job!", "You clicked the button!", "success");
                            console.log(response);
                            alert("Mobile Updated Successfully!");
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#fetch_user_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();

                        } else if (response.error == true) {
                            $('#user_mobile_edit').modal('hide');
                            Swal.fire("Good job!", "You clicked the button!", "error");
                            // swal.fire({
                            //     title: "Try Again ! ",
                            //     text: response.message,
                            //     icon: 'error',
                            //     type: "error",
                            //     timer: 3000
                            // });
                            $('#user_mobile_edit').modal('hide');
                            //console.log(response);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            // $('#teacher_add_model').modal('hide');
                            $('#fetch_user_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();
                        } else {
                            $.each(response.messages, function(key, value) {
                                var element = $('#r_' + key);

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
                        $('#user_mobile_edit').modal('hide');
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

            $(document).on('click', '.edit_mobile', function() {
                var users_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Create_user_controller/fetch_single_mobile",
                    method: "POST",
                    data: {
                        users_id: users_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#user_mobile_edit').modal('show');
                        $('#r_mobile').val(data.mobile);
                        $('#r_mobile_id').val(users_id);
                        $('#update_mobile').val("edit");
                    }
                });
            });

        });
    </script>


    <style>
        body {
            padding-top: 20px;
            padding-right: 80px;
            padding-left: 80px;
            font-family: 'Poppins', serif;
        }

        figure {
            width: 1170px;
            height: 625px;
            border-radius: 4px;
            border: 2px solid #ccc;
            position: relative;
            padding: 48px 10px 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }


        figure:before {
            content: attr(data-title);
            position: absolute;
            top: 0px;
            left: 0;
            width: 100%;
            height: 40px;
            line-height: 40px;
            text-indent: 10px;
            border-bottom: 2px solid #ccc;
        }

        .SubmenuBox {
            height: 160px;
            width: 100%;
            margin-bottom: 20px;
            text-align: center;
        }

        .SubmenuText {
            font-size: 16px;
            font-weight: bold;
            display: block;
            padding-bottom: 5px;
            color: #375b91;
        }

        /* .container {
            border-radius: 5px;
            padding: 20px;
            margin-left: 20px;
            margin-right: 20px;
        } */

        .SubmenuBox a {
            height: 100%;
            width: 100%;
            display: block;
            padding: 20px 12px;
            border: 1px solid #eee;
            background: #fcfcfc;
        }

        .SubmenuBox a:hover {
            background: #fff;
            text-decoration: none !important;
            box-shadow: 0 0 10px #eee;
        }

        .SubmenuBox a:focus {
            text-decoration: none !important;
        }

        .SubmenuText2 {
            font-size: 12px;
            font-weight: normal;
            display: block;
            color: #2a2a2a;
        }

        .SubmenuBox img {
            height: 48px;
            width: 48px;
            margin-bottom: 10px;
        }

        td {
            padding: 5px !important;
            border-width: 0 !important;
            border-style: None !important;
            border-radius: 2px;
        }

        td a {
            font-weight: normal !Important;
        }

        td img {
            height: 48px;
            width: 48px;
        }

        .linkthumbnails {
            padding: 15px;
        }

        .card {
            position: relative;
            width: 350px;
            padding: 20px;
            box-shadow: 3px 10px 20px rgba(0, 0, 0, 0.2);
            border-radius: 3px;
            border: 0;
            float: left;
            margin-bottom: 15px;
            margin-left: 15px;
            align-items: center;

        }

        .circle {
            border-radius: 3px;
            width: 130px;
            height: 130px;
            background: black;
            position: absolute;
            right: 0px;
            top: 0;
            background-image: linear-gradient(to top, #28aef0 0%, #0e88c5 100%);
            border-bottom-left-radius: 170px;
        }

        input[type=submit] {
            background-color: #90EE90;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
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

    <div class="container">
        <div class="page-header-inner">
            <div class="col-md-4 col-sm-6">
                <div class="row">
                    <div id="dvTitle" class="product_name">
                        <h3><b>RealBits Coders</b></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="row">
                    <div id="dvTitle" class="veri">
                        <h3><b>Verification System(1.0.0)</b></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="row">
                    <div id="dvTitle" class="logout">
                        <?php
                        $user = $this->session->userdata('user');
                        extract($user);
                        ?>
                        <h3><?php echo $username; ?> <b><a id="lblLogOut" href="<?php echo base_url(); ?>user/logout">LogOut</a></b></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="mybtn-right">
        <a href="<?php echo base_url(); ?>home" class="btn btn-info" class="btn btn-info">Dashboard</a>
        <a href="<?php echo base_url(); ?>Create_cse/create_c" class="btn btn-info">Case</a>
        <a href="<?php echo base_url(); ?>Report_controller/report_page_open" class="btn btn-info">Report</a>
        <a href="<?php echo base_url(); ?>Admin_dashboard_controller/admin_dashboard" class="btn btn-info">Admin</a>
    </div>
    <br>

    <div class="mybtn-left">
        <button type="button" class="btn btn-primary btn-md" data-toggle="modal" id="add_button" data-target="#create_user_model">Create User</button>
    </div>
    <div class="tab-pane container active text-dark" id="home">
        <div class="table-responsive text-dark ">
            <br>

            <style>
                #fetch_user_data .action-button {
                    margin-right: 10px;
                    margin-left: 10px;
                    /* Adjust the value as per your desired spacing */
                }
            </style>
            <table id="fetch_user_data" class="table table-bordered table-striped">
                <thead>
                    <tr class="">
                        <th width="6%">ID</th>
                        <th width="10%">Role Group</th>
                        <th width="10%">First name</th>
                        <th width="10%">Agent Code</th>
                        <th width="10%">User name</th>
                        <th width="10%">Password</th>
                        <th width="10%">Mobile</th>
                        <th width="10%">Org Name</th>
                        <th width="10%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div id="create_user_model" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New User</h4>
                </div>
                <?php echo form_open('Create_user_controller/create_user_validation', array('id' => 'form_create_user')) ?>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="first_name" class="h5">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="last_name" class="h5">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="role_group" class="h5">Role Group</label>
                        <select class="form-control" id="role_group" name="role_group">
                            <option value="yes" selected>-- Choose Role Group --</option>
                            <option value="SA">SA</option>
                            <option value="OA">OA</option>
                            <option value="AM">AM</option>
                            <option value="FA">FA</option>
                            <option value="Client Manager">Client Manager</option>
                            <option value="Back Office Executive">Back Office Executive</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="username" id="user_label" class="h5">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="password" id="pass_label" class="h5">Password</label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cnf_password" id="cnf_label" class="h5">Confirm Password</label>
                        <input type="text" class="form-control" id="cnf_password" name="cnf_password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="mobile" class="h5">Mobile No.</label>
                        <input type="text" class="form-control" id="mobile" name="mobile">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="email" class="h5">Email ID</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="employee_unique_id" class="h5">Employee Unique ID</label>
                        <input type="text" class="form-control" id="employee_unique_id" name="employee_unique_id">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="organization" class="h5">Organization</label>
                        <input type="text" class="form-control" id="organization" name="organization">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="lead_name" class="h5">Lead Name</label>
                        <input type="text" class="form-control" id="lead_name" name="lead_name">
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" name="create_user" id="create_user_data" class="btn btn-primary" value="Add">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
                <?php echo form_close() ?>
            </div>

        </div>
    </div>

    <!-- <div id="user_password_edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Password</h4>
                </div>
                <?php echo form_open("Create_user_controller/update_user_password_validation", array("id" => "update_password_form", "class" => "form-horizontal")) ?>
                <input type="hidden" class="form-control" id="u_pass_id" name="p_id">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="password" class="h5">Password</label>
                        <input type="text" class="form-control" id="u_password" placeholder="Enter Password" name="password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cnf_password" class="h5">Confirm Password</label>
                        <input type="text" class="form-control" id="u_cnf_password" placeholder="Enter Confirm Password" name="cnf_password">
                    </div>
                </div>

                
                <div class="modal-footer">
                    <input type="submit" name="update_password" id="update_pass_data" class="btn btn-primary" value="Edit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->

    <div class="modal fade" id="user_password_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Password</h5>
                </div>
                <?php echo form_open("Create_user_controller/update_user_password_validation", array("id" => "update_password_form", "class" => "form-horizontal")) ?>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="u_pass_id" name="p_id">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="password" class="h5">Password</label>
                            <input type="text" class="form-control" id="u_password" placeholder="Enter Password" name="password">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cnf_password" class="h5">Confirm Password</label>
                            <input type="text" class="form-control" id="u_cnf_password" placeholder="Enter Confirm Password" name="cnf_password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="update_password" id="update_pass_data" class="btn btn-primary" value="Edit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


    <!-- <div id="user_mobile_edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Mobile</h4>
                </div>
                <?php echo form_open("Create_user_controller/update_user_password_validation", array("id" => "update_mobile_form", "class" => "form-horizontal")) ?>
                <input type="hidden" class="form-control" id="r_mobile_id" name="m_id">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="mobile" class="h5">Mobile</label>
                        <input type="text" class="form-control" id="r_mobile" placeholder="Enter Mobile" name="mobile">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="update_mobile" id="update_mobile" class="btn btn-primary" value="submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div> -->

    <div id="user_mobile_edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Mobile</h4>
                </div>
                <?php echo form_open("Create_user_controller/update_mobile", array("id" => "update_mobile_form", "class" => "form-horizontal")) ?>
                <input type="hidden" class="form-control" id="r_mobile_id" name="m_id">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="mobile" class="h5">Mobile</label>
                        <input type="text" class="form-control" id="r_mobile" placeholder="Enter Mobile" name="mobile">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="update_mobile" id="update_mobile" class="btn btn-primary" value="submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


</body>

>>>>>>> 83a6e116206f1d242b3309036ceab7bf24510e0d
</html>