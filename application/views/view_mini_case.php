<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Report Mini Case</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>
    
    
    <script>
        $(document).ready(function() {
            var dataTable = $('#fetch_mini_case_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "ajax": {
                    url: "<?php echo base_url() . 'View_mini_case_controller/fetch_all_mini_case'; ?>",
                    type: "POST",

                    "data": function(data) {
                        // custom filter data
                        data.from_date = $('#from_date').val();
                        data.to_date = $('#to_date').val();
                    }
                },

                columnDefs: [{
                    "defaultContent": "-",
"className": 'select-checkbox',
            // "targets":   0
                    "targets": [1, 9],
                    "orderable": false
                }],

                select: {
            style:    'os',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]],

                "lengthMenu": [
                    [15, 25, 50, -1],
                    [15, 25, 50, "All"]
                ],
                // createdRow: function(row, data, rowIndex) {
                //     $.each($('td', row), function(colIndex) {

                //         if (colIndex == 7) {
                //             $(this).attr('data-name', 'remarks');
                //             $(this).attr('class', 'remarks');
                //             $(this).attr('data-type', 'text');
                //             $(this).attr('data-pk', data[0]);
                //         }

                //     });
                // }
            });




            $('#filter').click(function() {
                jQuery('#fetch_mini_case_data').DataTable().ajax.reload();
            });

            // $('#fetch_mini_case_data').editable({
            //     mode: 'inline',
            //     container: 'body',
            //     selector: 'td.remarks',
            //     url: '<?php echo base_url() . 'View_mini_case_controller/get_remark'; ?>',
            //     title: 'Remarks',
            //     type: 'POST',
            //     validate: function(value) {
            //         //			if($.trim(value) == '')
            //         //			{
            //         //				return 'This field is required';
            //         //			}
            //     }
            // });

            $(document).on('click', '.view_quick_case', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>View_mini_case_controller/fetch_single_mini_case",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#mini_case_view_model').modal('show');
                        $('.s_bank').html("<b>Bank:</b> " + data.bank);
                        $('.s_product').html("<b>Product:</b> " + data.product);
                        $('.s_fi_conducted').html("<b>Fi type:</b> " + data.fi_type);
                        $('.s_reference_no').html("<b>Reference no.:</b> " + data.reference_no);
                        $('.s_name').html("<b> Applicant Name:</b> " + data.name);
                        $('.s_agent_code').html("<b>Agent code:</b> " + data.code);
                        $('.s_address').html("<b>Address:</b> " + data.business_add);
                        $('.s_business_name').html("<b>Business Name:</b> " + data.business_name);
                        $('.s_business_add').html("<b>Business Address:</b> " + data.business_add);
                        $('.s_city').html("<b>City:</b> " + data.city);
                        $('.s_residence_add').html("<b>City:</b> " + data.city);
                        $('.s_mobile').html("<b>Mobile:</b> " + data.mobile);
                        $('.bv_lat').html("<b>Latitude:</b> " + data.bv_lat);
                        $('.bv_long').html("<b>Longitude:</b> " + data.bv_long);
                        $('.bv_pincode').html("<b>Pincode:</b> " + data.bv_pincode);
                        $('.bv_location_add').html("<b>location:</b> " + data.bv_location_add);
                        $('.remarks').html("<b>Remarks:</b> " + data.remarks);
                        $(".mini_bv_case_img").html('');
                        $('.mini_bv_case_img').append(data.bv_image1);
                        $('.mini_bv_case_img').append(data.bv_image2);
                        $('.mini_bv_case_img').append(data.bv_image3);
                        $('.mini_bv_case_img').append(data.bv_image4);
                        $('.mini_bv_case_img').append(data.bv_image5);
                        $('.mini_bv_case_img').append(data.bv_image6);
                        $('.mini_bv_case_img').append(data.bv_image7);
                        $('.mini_bv_case_img').append(data.bv_image8);
                        $('.mini_bv_case_img').append(data.bv_image9);
                        // $('.t_teacher_id').text(user_id);
                        // $('.uploaded_image').attr("src", data.photos);

                    }
                });
            });

            $(document).on('click', '.view_rv_case', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>View_mini_case_controller/fetch_single_rv_mini_case",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#mini_case_rv_view_model').modal('show');
                        $('.s_bank').html("<b>Bank:</b> " + data.bank);
                        $('.s_product').html("<b>Product:</b> " + data.product);
                        $('.s_fi_conducted').html("<b>Fi to be Conducted:</b> " + data.fi_type);
                        $('.s_reference_no').html("<b>Reference no :</b> " + data.reference_no);
                        $('.s_name').html("<b>Name:</b> " + data.name);
                        $('.s_agent_code').html("<b>Agent code:</b> " + data.code);
                        $('.s_address').html("<b>Address:</b> " + data.business_add);
                        $('.s_business_name').html("<b>Business Name:</b> " + data.business_name);
                        $('.s_business_add').html("<b>Business Address:</b> " + data.business_add);
                        // $('.s_residence_add').html("<b>Residence Address:</b> " + data.residence_add);
                        $('.s_mobile').html("<b>Mobile:</b> " + data.mobile);
                        $('.rv_lat').html("<b>Latitude:</b> " + data.rv_lat);
                        $('.rv_long').html("<b>Longitude:</b> " + data.rv_long);
                        $('.rv_pincode').html("<b>Pincode:</b> " + data.rv_pincode);
                        $('.rv_location_add').html("<b>location:</b> " + data.rv_location_add);
                        $('.remarks').html("<b>Remarks:</b> " + data.remarks);
                        $('.rv_city').html("<b>City:</b> " + data.city);
                        $(".mini_rv_case_img").html('');
                        $('.mini_rv_case_img').append(data.rv_image1);
                        $('.mini_rv_case_img').append(data.rv_image2);
                        $('.mini_rv_case_img').append(data.rv_image3);
                        $('.mini_rv_case_img').append(data.rv_image4);
                        $('.mini_rv_case_img').append(data.rv_image5);
                        $('.mini_rv_case_img').append(data.rv_image6);
                        $('.mini_rv_case_img').append(data.rv_image7);
                        $('.mini_rv_case_img').append(data.rv_image8);
                        $('.mini_rv_case_img').append(data.rv_image9);
                        // $('.t_teacher_id').text(user_id);
                        // $('.uploaded_image').attr("src", data.photos);

                    }
                });
            });


            
            $(document).on('click', '.reassign_case', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>Assign_case_controller/fetch_single_reassign_case",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#reassign_case_model_mc').modal('show');
                        $('#u_code').val(data.code);
                        $('#u_reassign_remarks').val(data.reassign_remarks);
                        // $('#u_residence_address').val(data.residence_address);

                        $('#u_reassign_id').val(user_id);
                        $('#update_assignee').val("edit");
                    }
                });
            });




            $(document).on('click', '.edit_bv', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>View_mini_case_controller/fetch_remarks",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data)
                        $('#user_bv_remarks_edit').modal('show');
                        $('.minicase_remarks').val(data.remarks);
                        $('.minicase_id').val(user_id);
                    }
                });
            });

            $(document).on('click', '.edit_rv', function() {
                var user_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>View_mini_case_controller/fetch_remarks",
                    method: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#user_rv_remarks_edit').modal('show');
                        $('.minicase_remarks').val(data.remarks);
                        $('.minicase_id').val(user_id);
                    }
                });
            });
            // update the form data if we change any


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
    url: "<?php echo base_url(); ?>View_mini_case_controller/reassign_case_validation_mini_case",
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

            // end update form data 



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
                        <h3><b>Bodvid Private Limited</b></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="row">
                    <div id="dvTitle" class="veri">
                        <h3><b>Verification System (1.0.0)</b></h3>
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
    <div class="container">

    <label>From</label>
        <input type="text" name="from" id="from" required value="<?php echo date("Y-m-d"); ?>">
        <label>To</label>
        <input type="text" name="to" id="to" required value="<?php echo date("Y-m-d"); ?>">
        <button class="btn btn-warning " name="sub_btn" id="sub_btn"> GET </button>


    <br>
    <div class="tab-pane container active text-dark" id="home">
        <div class="table-responsive text-dark ">
            <br>
            <?php
            include('components/flash.php');
            ?>

            <table id="fetch_mini_case_data" class="table table-bordered table-striped">
                <thead>
                    <tr class="">
                        <th width="2%"></th>
                        <th width="6%">ID</th>
                        <th width="10%">Bank Name</th>
                        <th width="10%">Applicant Name</th>
                        <th width="10%">FI Type</th>
                        <th width="10%">Agent</th>
                        <th width="10%">Ref no.</th>
                        <!-- <th width="10%">Name</th> -->
                        <th width="10%">Address</th>
                        <th width="10%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
               <tbody id="tbdy"> 
               <?php $i = 1;  ?>
                        <tr>
                        <td><input type="checkbox" onclick="showassignbutton(<?php echo $i ?>)" id="assign<?php echo $i ?>" value='<?= $rows->uid; ?>' name="assign"></td>
                        <td><?= $rows->uid; ?></td>
                            <td><?= $rows->bank; ?></td>
                            <td><?= $rows->name; ?></td>
                            <td><?= $rows->fi_type; ?></td>
                            <td><?= $rows->code; ?></td>
                            <td><?= $rows->reference_no; ?></td>
                            <td><?= $rows->business_add; ?></td>
                            <td><?= $rows->status; ?></td>
                            <td>

                                 <?php
                                if ($row->fi_type == 'BV') {
                                    $buttons .= '<button type="button" title="View Case" name="view" id="' . $row->id . '" class="btn btn-primary btn-sm view_quick_case"><i class="fa fa-eye" ></i></button>';
                                    $buttons .= '<button type="button" title="BV Remarks" name="view" id="' . $row->id . '" class="btn btn-success btn-sm edit_bv"><i class="fa fa-pencil" ></i></button>';
                                    $buttons .= '<button type="button" title="Reassign Case" name="view" id="' . $row->id . '" class="btn btn-success btn-sm reassign_case"><i class="fa fa-edit" ></i></button>';

                                } else {
                                    $buttons .= '<button type="button" title="View RV Case" name="view" id="' . $row->id . '" class="btn btn-primary btn-sm view_rv_case"><i class="fa fa-eye" ></i></button>';
                                    $buttons .= '<button type="button" title="RV Remarks" name="view" id="' . $row->id . '" class="btn btn-warning btn-sm edit_rv"><i class="fa fa-pencil" ></i></button>';
                                    $buttons .= '<button type="button" title="Reassign Case" name="view" id="' . $row->id . '" class="btn btn-success btn-sm reassign_case"><i class="fa fa-edit" ></i></button>';

                                }
                                ?>
                            </td>
                        </tr>
                        
                    <tr></tr>
                </tbody> 
            </table>
        </div>
    </div>



    <div id="reassign_case_model_mc" class="modal fade ">
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


    <div class="modal fade" id="mini_case_view_model" tabindex="-1" role="dialog" aria-hidden="true">
        <div class=" modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">View BV Case</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-6 ">
                                <div class="col-sm-6">
                                <h3 class="s_reference_no" style="color:blue;">Reference Number : </h3>
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
                                    <h4 class="s_fi_conducted">
                                    </h4>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="s_name">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-12 ">
                                <div class="col-sm-12">
                                    <h4 class="s_business_name">
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
                                    <h4 class="s_city">
                                    </h4>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="s_agent_code">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-12">
                                <div class="col-sm-12">
                                    <h4 class="remarks">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mini_bv_case_img">

                    </div>

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

                   

                 

                    


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="mini_case_rv_view_model" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">View RV case</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-12">
                                <div class="col-sm-12">
                                <h3 class="s_reference_no" style="color:blue;">Reference Number : </h3>
                                    
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
                                    <h4 class="s_fi_conducted">
                                    </h4>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="s_name">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-12">
                                <div class="col-sm-12">
                                    <h4 class="s_business_name">
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
                                <div class="col-sm-6">
                                    <h4 class="rv_pincode">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-6">
                                <div class="col-sm-6">
                                    <h4 class="rv_city">
                                    </h4>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="s_agent_code">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-12 ">
                                <div class="col-sm-12">
                                    <h4 class="remarks">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mini_rv_case_img"></div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-6 ">
                                <div class="col-sm-6">
                                    <h4 class="rv_lat">
                                    </h4>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="rv_long">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-6 ">
                                <div class="col-sm-6">
                                    <h4 class="rv_pincode">
                                    </h4>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="rv_location_add">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_rv_remarks_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update RV Remarks</h5>
                </div>
                <?php echo form_open("View_mini_case_controller/update_remarks_validation", array("id" => "update_bv_remarks", "class" => "form-horizontal")) ?>
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" class="form-control minicase_id" name="minicase_id">
                        <div class="form-group col-md-12">
                            <label for="bv_remarks" class="h5">BV Remarks</label>
                            <textarea type="text" class="form-control minicase_remarks" placeholder="Enter rv Remarks" name="remarks"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="update_bv_remarks" class="btn btn-primary" value="Update">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>


    <div class="modal fade" id="user_bv_remarks_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update BV Remarks</h5>
                </div>
                <?php echo form_open("View_mini_case_controller/update_remarks_validation", array("id" => "update_bv_remarks", "class" => "form-horizontal")) ?>
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" class="form-control minicase_id" name="minicase_id">

                        <div class="form-group col-md-12">
                            <label for="bv_remarks" class="h5">BV Remarks</label>
                            <textarea type="text" class="form-control minicase_remarks" placeholder="Enter bv Remarks" name="remarks"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="update_bv_remarks" class="btn btn-primary" value="Update">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                <?php echo form_close(); ?>
            </div>

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

                                                    var datastring = "from=" + from + "&to=" + to;
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "<?= base_url() ?>View_mini_case_controller/filterDatewiseMiniCase",
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


                                            // function getFitype(val) {
                                            //     var code = '<?php echo $data; ?>';
                                            //     var datastring = "val=" + val + "&code=" + code;
                                            //     $.ajax({
                                            //         type: "POST",
                                            //         url: "<?= base_url() ?>Assign_case_controller/filterfitype",
                                            //         // dataType:"json",
                                            //         data: datastring,
                                            //         // contentType: "application/json; charset=utf-8",
                                            //         success: function(data) {
                                            //             //alert(data);
                                            //             $('#tbdy').html(data);

                                            //         },
                                            //         error: function() {
                                            //             // alert("Error");
                                            //         }
                                            //     });
                                            // }

                                            // function getCasestatus(val) {
                                            //     var code = '<?php echo $data; ?>';
                                            //     var datastring = "val=" + val + "&code=" + code;
                                            //     $.ajax({
                                            //         type: "POST",
                                            //         url: "<?= base_url() ?>Assign_case_controller/filterStatus",
                                            //         // dataType:"json",
                                            //         data: datastring,
                                            //         // contentType: "application/json; charset=utf-8",
                                            //         success: function(data) {
                                            //             //alert(data);
                                            //             $('#tbdy').html(data);

                                            //         },
                                            //         error: function() {
                                            //             // alert("Error");
                                            //         }
                                            //     });
                                            // }
                                        </script>
