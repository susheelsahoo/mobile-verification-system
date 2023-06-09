<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/theme1.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="Stylesheet" type="text/css" href="assets/global/plugins/bootstrap/css/bootstrap.min.css" />
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>


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
                    "targets": [1, 8],
                    "orderable": false
                }],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                createdRow: function(row, data, rowIndex) {
                    $.each($('td', row), function(colIndex) {

                        if (colIndex == 8) {
                            $(this).attr('data-name', 'remarks');
                            $(this).attr('class', 'remarks');
                            $(this).attr('data-type', 'text');
                            $(this).attr('data-pk', data[0]);
                        }

                    });
                }
            });




            $('#filter').click(function() {
                jQuery('#fetch_mini_case_data').DataTable().ajax.reload();
            });

            $('#fetch_mini_case_data').editable({
                mode: 'inline',
                container: 'body',
                selector: 'td.remarks',
                url: '<?php echo base_url() . 'View_mini_case_controller/get_remark'; ?>',
                title: 'Remarks',
                type: 'POST',
                validate: function(value) {
                    //			if($.trim(value) == '')
                    //			{
                    //				return 'This field is required';
                    //			}
                }
            });

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
                        $('.s_fi_conducted').html("<b>Fi to be Conducted:</b> " + data.fi_type);
                        $('.s_reference_no').html("<b>Reference no.:</b> " + data.reference_no);
                        $('.s_name').html("<b>Name:</b> " + data.name);
                        $('.s_agent_code').html("<b>Agent code:</b> " + data.code);
                        $('.s_address').html("<b>Address:</b> " + data.address);
                        $('.s_business_name').html("<b>Business Name:</b> " + data.business_name);
                        $('.s_business_add').html("<b>Business Address:</b> " + data.business_add);
                        // $('.s_residence_add').html("<b>Residence Address:</b> " + data.residence_add);
                        $('.s_mobile').html("<b>Mobile:</b> " + data.mobile);
                        $('.bv_lat').html("<b>Latitude:</b> " + data.bv_lat);
                        $('.bv_long').html("<b>Longittude:</b> " + data.bv_long);
                        $('.bv_pincode').html("<b>Pincode:</b> " + data.bv_pincode);
                        $('.bv_location_add').html("<b>location:</b> " + data.bv_location_add);
                        $('.bv_remarks').html("<b>Remarks:</b> " + data.bv_remarks);
                        $('.bv_image1').attr("src", data.bv_image1);
                        $('.bv_image2').attr("src", data.bv_image2);
                        $('.bv_image3').attr("src", data.bv_image3);
                        $('.bv_image4').attr("src", data.bv_image4);
                        $('.bv_image5').attr("src", data.bv_image5);
                        $('.bv_image6').attr("src", data.bv_image6);
                        $('.bv_image7').attr("src", data.bv_image7);
                        $('.bv_image8').attr("src", data.bv_image8);
                        $('.bv_image9').attr("src", data.bv_image9);
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
                        $('.s_reference_no').html("<b>Reference no.:</b> " + data.reference_no);
                        $('.s_name').html("<b>Name:</b> " + data.name);
                        $('.s_agent_code').html("<b>Agent code:</b> " + data.code);
                        $('.s_address').html("<b>Address:</b> " + data.address);
                        $('.s_business_name').html("<b>Business Name:</b> " + data.business_name);
                        $('.s_business_add').html("<b>Business Address:</b> " + data.business_add);
                        // $('.s_residence_add').html("<b>Residence Address:</b> " + data.residence_add);
                        $('.s_mobile').html("<b>Mobile:</b> " + data.mobile);
                        $('.rv_lat').html("<b>Latitude:</b> " + data.rv_lat);
                        $('.rv_long').html("<b>Longittude:</b> " + data.rv_long);
                        $('.rv_pincode').html("<b>Pincode:</b> " + data.rv_pincode);
                        $('.rv_location_add').html("<b>location:</b> " + data.rv_location_add);
                        $('.rv_remarks').html("<b>Remarks:</b> " + data.rv_remarks);
                        $('.mini_case_img').append(data.rv_image1);
                        $('.mini_case_img').append(data.rv_image2);
                        $('.mini_case_img').append(data.rv_image3);
                        $('.mini_case_img').append(data.rv_image4);
                        $('.mini_case_img').append(data.rv_image5);
                        $('.mini_case_img').append(data.rv_image6);
                        $('.mini_case_img').append(data.rv_image7);
                        $('.mini_case_img').append(data.rv_image8);
                        $('.mini_case_img').append(data.rv_image9);
                        // $('.t_teacher_id').text(user_id);
                        // $('.uploaded_image').attr("src", data.photos);

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
        <div class="row">
            <div class="input-daterange">
                <div class="col-md-3">
                    <!-- <label for="start">From date:</label> -->
                    <input type="date" name="from_date" id="from_date" class="form-control" placeholder="FROM DATE">
                </div>

                <div class="col-md-3">
                    <!-- <label for="start">To date:</label> -->
                    <input type="date" name="to_date" id="to_date" class="form-control" placeholder="TO DATE">
                </div>

                <div class="col-md-5">
                    <input type="button" name="filter" id="filter" value="filter" class="btn btn-primary" />
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="tab-pane container active text-dark" id="home">
        <div class="table-responsive text-dark ">
            <br>
            <table id="fetch_mini_case_data" class="table table-bordered table-striped">
                <thead>
                    <tr class="">
                        <th width="6%">ID</th>
                        <th width="10%">Bank Name</th>
                        <th width="10%">ApplicantName</th>
                        <th width="10%">FI Type</th>
                        <th width="10%">Agent</th>
                        <th width="10%">Ref no.</th>
                        <th width="10%">Name</th>
                        <th width="10%">Address</th>
                        <th width="10%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>





    <div class="modal fade" id="mini_case_view_model" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">View Quick case</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                                    <h4 class="s_reference_no">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-6 ">
                                <div class="col-sm-6">
                                    <h4 class="s_name">
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
                            <div class="row pt-6 ">
                                <div class="col-sm-6">
                                    <h4 class="s_address">
                                    </h4>
                                </div>
                                <div class="col-sm-6">
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

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-6 ">
                                <div class="col-sm-6">
                                    <h4 class="bv_remarks">
                                    </h4>
                                </div>
                                <!-- <div class="col-sm-6">
                                                    <h4 class="s_residence_add">
                                                    </h4>
                                                </div> -->
                            </div>
                        </div>
                    </div>



                    <div class="mini_case_img">

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
                                    <h4 class="s_reference_no">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-6 ">
                                <div class="col-sm-6">
                                    <h4 class="s_name">
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
                            <div class="row pt-6 ">
                                <div class="col-sm-6">
                                    <h4 class="s_address">
                                    </h4>
                                </div>
                                <div class="col-sm-6">
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

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row pt-6 ">
                                <div class="col-sm-6">
                                    <h4 class="rv_remarks">
                                    </h4>
                                </div>
                                <!-- <div class="col-sm-6">
                                                    <h4 class="s_residence_add">
                                                    </h4>
                                                </div> -->
                            </div>
                        </div>
                    </div>





                    <img class="rv_image1" height="150" width="150">
                    <img class="rv_image2" height="150" width="150">
                    <img class="rv_image3" height="150" width="150">
                    <img class="rv_image4" height="150" width="150">
                    <img class="rv_image5" height="150" width="150">
                    <img class="rv_image6" height="150" width="150">
                    <img class="rv_image7" height="150" width="150">
                    <img class="rv_image8" height="150" width="150">
                    <img class="rv_image9" height="150" width="150">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>