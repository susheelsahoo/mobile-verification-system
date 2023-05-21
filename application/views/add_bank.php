<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/theme1.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="Stylesheet" type="text/css" href="assets/global/plugins/bootstrap/css/bootstrap.min.css" />
    <title>Banking System</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">


    <script type="text/javascript">
        BASE_URL = "<?php echo base_url(); ?>"
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>
</head>


<body>

    <script>
        $(document).ready(function() {


            var dataTable = $('#fetch_bank_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url() . 'Add_bank_controller/fetch_all_bank'; ?>",
                    type: "POST",
                },
                "columnDefs": [{
                    "targets": [3],
                    "orderable": false
                }],
                "lengthMenu": [
                    [10, 20, 50, -1],
                    [10, 20, 50, "All"]
                ],
                createdRow: function(row, data, rowIndex) {
                    $.each($('td', row), function(colIndex) {
                        if (colIndex == 3) {
                            $(this).attr('data-name', 'status');
                            $(this).attr('class', 'status');
                            $(this).attr('data-type', 'select');
                            $(this).attr('data-pk', data[0]);
                        }
                    });
                }
            });

            $('#fetch_bank_data').editable({
                mode: 'inline',
                container: 'body',
                selector: 'td.status',
                url: '<?php echo base_url() . 'Add_bank_controller/get_status_bank'; ?>',
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

            $('#form_add_bank').submit(function(e) {
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
                        // alert("bank Generated Successfully!");
                        if (response.success == true) {
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#add_bank_model').modal('hide');
                            alert("bank Generated Successfully!");
                            swal.fire({
                                title: "Added",
                                text: "bank has been Added",
                                icon: 'success',
                                type: "success",
                                timer: 3000
                            });
                            $('#fetch_bank_data').DataTable().ajax.reload();
                            // reset the form
                            me[0].reset();
                            alert("Bank add Successfully!");
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
                        $('#add_bank_model').modal('hide');
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
    <div class="mybtn-left">
        <button type="button" class="btn btn-primary btn-md" data-toggle="modal" id="add_button" data-target="#add_bank_model">Add Bank</button>
    </div>

    <div class="tab-pane container active text-dark" id="home">
        <div class="table-responsive text-dark ">
            <br>
            <table id="fetch_bank_data" class="table table-bordered table-striped">
                <thead>
                    <tr class="">
                        <th width="6%">ID</th>
                        <th width="10%">Bank</th>
                        <th width="10%">Description</th>
                        <th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div id="add_bank_model" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Bank</h4>
                </div>
                <?php echo form_open('Add_bank_controller/add_bank_validation', array('id' => 'form_add_bank')) ?>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="bank_name" class="h5">Bank</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description" class="h5">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" name="add_bank" id="add_bank_data" class="btn btn-primary" value="Add">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
                <?php echo form_close() ?>
            </div>

        </div>
    </div>