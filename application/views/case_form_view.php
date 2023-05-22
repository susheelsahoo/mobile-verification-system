<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <script type="text/javascript">
        BASE_URL = "<?php echo base_url(); ?>"
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>



    <style>
        body {
            box-sizing: border-box;
            left: 200px;
            font-family: 'Poppins', serif;
        }

        input[type=text],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=reset] {
            background-color: #008CBA;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=reset]:hover {
            background-color: #24a0ed;
        }

        div {
            padding-right: 30px;
            padding-left: 80px;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        header {
            background-color: #0e88c5;
            color: #fff;
            padding: 20px;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }



        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .mybtn-right {
            text-align: right;
            padding-right: 180px;
            clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    </style>

    <style>
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
            background-color: #0e88c5;
            border-color: #0e88c5
        }
    </style>


    <script>
        $(document).ready(function() {


            $('#form_bank').submit(function(e) {
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

                        // me[0].reset();
                        if (response.success == true) {
                            alert("Case Generated Successfully!");
                            location.reload();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success');
                            $('.text-danger').remove();
                            $('#menu1').modal('hide');
                            swal.fire({
                                title: "Added",
                                text: "Case has been Generated!",
                                icon: 'success',
                                type: "success",
                                timer: 3000
                            });
                            dataTable.ajax.reload();
                            // reset the form
                            // me[0].reset();
                            alert("Case Generated Successfully!");
                            // $('#form-coupons')[0].reset();

                        } else {
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
                        //  swal.fire("Error deleting!", "Please try again later !!!", "error");

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
            $('.fi_to_be_conducted_bv').change(function() {
                if ($('.fi_to_be_conducted_bv:checked').length == 0) {
                    $('#business_section').addClass('hide');
                    $('#BV_agent').addClass('hide');
                } else {
                    $('#business_section').removeClass('hide');
                    $('#BV_agent').removeClass('hide');
                }
            });
            $('.fi_to_be_conducted_rv').change(function() {
                if ($('.fi_to_be_conducted_rv:checked').length == 0) {
                    $('#residence_section').addClass('hide');
                    $('#RV_agent').addClass('hide');
                } else {
                    $('#residence_section').removeClass('hide');
                    $('#RV_agent').removeClass('hide');

                }
            });
        });
    </script>
</head>

<body>
    <div class="">
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
        <a href="<?php echo base_url(); ?>home" class="btn btn-info">Dashboard</a>
        <a href="<?php echo base_url(); ?>Create_cse/create_c" class="btn btn-info">Case</a>
        <a href="<?php echo base_url(); ?>Report_controller/report_page_open" class="btn btn-info">Report</a>
        <a href="<?php echo base_url(); ?>Admin_dashboard_controller/admin_dashboard" class="btn btn-info">Admin</a>
    </div>
    <br>

    <div class="container" id="menu1">
        <header>
            <h4>Create Case</h4>
        </header>
        <?php echo form_open('Case_form/create_case_form_submit', array("id" => "form_bank", "class" => "form-horizontal")); ?>
        <div class="row">
            <div class="col-md-3">
                <label for="bank_name">
                    Bank<span class="text-danger"> *</span>
                </label>
            </div>
            <div class="col-md-9">
                <select class="form-control" id="bank_name" name="bank_name">
                    <option value="" selected>-- SELECT BANK --</option>
                    <?php foreach ($bank_names as $bank) { ?>
                        <option value="<?= $bank['bank_name']; ?>"><?= $bank['bank_name']; ?></option>
                    <?php } ?>
                </select>

            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="product_name">Product<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <select class="form-control" id="product_name" name="product_name">
                    <option value="" selected>-- SELECT PRODUCT --</option>
                    <?php foreach ($product_data as $product) { ?>
                        <option value="<?= $product['product']; ?>"><?= $product['product']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="fi_to_be_conducted">Fi type<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <input type="checkbox" class="fi_to_be_conducted_bv" name="fi_to_be_conducted[]" value="BV">
                <label for="fi_to_be_conducted"> BV</label>
                <input type="checkbox" class="fi_to_be_conducted_rv" name="fi_to_be_conducted[]" value="RV">
                <label for="fi_to_be_conducted"> RV</label>

            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="application_id">Reference No.<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <input class="form-control" type="text" id="application_id" name="application_id" placeholder="Enter your Reference Number">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="customer_name">Applicant Name<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <input class="form-control" type="text" id="customer_name" name="customer_name" placeholder="Enter your Applicant Name">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="dob">DOB</label>
            </div>
            <div class="col-md-9">
                <input class="form-control" id="dob" name="dob" placeholder="start Date and Time" type="date" value="" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="amount">Amount<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <input class="form-control" type="number" id="amount" name="amount" placeholder="Enter Amount">
            </div>
        </div>
        <span id="business_section" class="hide">

            <div class="row">
                <div class="col-md-3">
                    <label for="business_name">Business Name</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control" type="text" id="business_name" name="name[]" placeholder="Enter Business name">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="business_address">Business Add.</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control" type="text" id="business_address" name="address[]" placeholder="Enter Business Address">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="city">Business City</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control" type="text" id="business_city" name="city[]" placeholder="Enter Business City">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="pincode">Business Pincode</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control" type="number" id="business_pincode" name="pincode[]" placeholder="Enter Business pincode">
                </div>
            </div>
        </span>
        <span id="residence_section" class="hide">
            <div class="row">
                <div class="col-md-3">
                    <label for="residence_address">Residence Add.</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control" type="text" id="residence_address" name="address[]" placeholder="Enter Residence Address">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="city">Residence City</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control" type="text" id="residence_city" name="city[]" placeholder="Enter Residence City">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="pincode">Pincode</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control" type="number" id="residence_pincode" name="pincode[]" placeholder="Enter Residence pincode">
                </div>
            </div>
        </span>


        <div class="row">
            <div class="col-md-3">
                <label for="vehicle">Vehicle<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <input class="form-control" type="text" id="vehicle" name="vehicle" placeholder="Enter Vehicle">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="co_applicant">Co-Applicant<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <input class="form-control" type="text" id="co_applicant" name="co_applicant" placeholder="Enter your Co - Applicant Name">
            </div>
        </div>


        <div class="row">
            <div class="col-md-3">
                <label for="guarantee_name">Guarantee Name<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <input class="form-control" type="text" id="guarantee_name" name="guarantee_name" placeholder="Enter your Guarantee Name">
            </div>
        </div>
        <div class="row hide" id="BV_agent">
            <div class="col-md-3">
                <label for="code"> BV Agent <span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <select class="form-control code" id="bv_agent" name="bv_agent">
                    <option value="" selected>-- SELECT AGENT CODE --</option>
                    <?php foreach ($agent_code as $agent) { ?>
                        <option value="<?= $agent['employee_unique_id']; ?>"><?= $agent['first_name'] . ' - ' . $agent['employee_unique_id']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row hide" id="RV_agent">
            <div class="col-md-3">
                <label for="code">RV Agent <span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <select class="form-control code" id="rv_agent" name="rv_agent">
                    <option value="" selected>-- SELECT AGENT CODE --</option>
                    <?php foreach ($agent_code as $agent) { ?>
                        <option value="<?= $agent['employee_unique_id']; ?>"><?= $agent['first_name'] . ' - ' . $agent['employee_unique_id']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>


        <div class="row">
            <div class="col-md-3">
                <label for="geo_limit">Geo Limit<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <select class="form-control" id="geo_limit" name="geo_limit">
                    <option value="" selected>-- SELECT GEO LIMIT --</option>
                    <option value="local">LOCAL</option>
                    <option value="outstation">OUTSTATION</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="tat">TAT Start<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-3">
                <input type="datetime-local" id="tat_start" name="tat_start" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="tat">TAT End<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-4">
                <input type="datetime-local" id="tat_end" name="tat_end" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="remarks">Remarks<span class="text-danger"> *</span></label>
            </div>
            <div class="col-md-9">
                <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks" type="text"></textarea>
            </div>
        </div>

        <br>

        <div class="row">
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>

        <?php echo form_close(); ?>

    </div>


</body>



</html>