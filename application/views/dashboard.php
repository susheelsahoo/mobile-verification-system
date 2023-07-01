<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Banking System</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">


    <script type="text/javascript">
        BASE_URL = "<?php echo base_url(); ?>"
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            var dataTable = $('#fetch_agent_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url() . 'Dashboard_controller/fetch_all_agent'; ?>",
                    type: "POST",
                },

                columnDefs: [{
                    "defaultContent": "-",
                    "targets": [1, 5],
                    "orderable": false

                }],
                "lengthMenu": [
                    [15, 25, 50, -1],
                    [15, 25, 50, "All"]
                ],
            });
            
            $('#sub_btn').click(function(event) {
                event.preventDefault();

                var from = $('#from').val();
                var to = $('#to').val();
                var datastring = "from=" + from + "&to=" + to;
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>Dashboard_controller/fetch_all_agentfilterwise",
                    // dataType:"json",
                    data: datastring,
                    // contentType: "application/json; charset=utf-8",
                    success: function(data) {
                        //alert(data);
                        $('#fetch_agent_data_body').html(data);

                    },
                    error: function() {
                        // alert("Error");
                    }
                });

            });
            
            //   $('#agent_filter').click(function(event) {
            //     event.preventDefault();

               
            //      var datastring = "val=" + val;
            //     $.ajax({
            //         type: "POST",
            //          url: "<?= base_url() ?>Dashboard_controller/agentFilterDashboard",
            //         // dataType:"json",
            //         data: datastring,
            //         // contentType: "application/json; charset=utf-8",
            //         success: function(data) {
            //             //alert(data);
            //             $('#fetch_agent_data_body').html(data);

            //         },
            //         error: function() {
            //             // alert("Error");
            //         }
            //     });

            // });
            
                                    
   
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

    <!-- <div class="container">
    <h1 class="page-header text-center">Bodvid Private Limited</h1>
    <a href="<?php echo base_url(); ?>Create_cse/create_c" class="btn btn-info">Create Case</a>
  </div> -->

    <div class="mybtn-right">
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
    <a href="<?php echo base_url(); ?>Admin_dashboard_controller/admin_dashboard" class="btn btn-info" style="display:<?php echo $cardDisplay; ?>">Admin</a>
    </div>
    <br>



    <?php
    if (isset($data) & !empty($data)) { //check $data is set or not if not set return false and skip action else return true and perform action.
        $data1 = $data['countTotal']; //here we set the $data value in $active_menu  ($data <-- data comes from controller 
        $countTotal = $data1['countTotal']; //here we set the $data value in $active_menu  ($data <-- data comes from controller 
    }
    ?>
    
    <label>From</label>
    <input type="date" name="from" id="from" required ">
    <label>To</label>
    <input type="date" name="to" id="to" required ">
    <button class="btn btn-warning " name="sub_btn" id="sub_btn"> GET </button>
    
        
    
    
    
    
    <div class="tab-pane container active text-dark" id="home">
        <div class="table-responsive text-dark ">
            <br />
            <table id="fetch_agent_data" class="table table-bordered table-striped">
                <thead>
                    <tr class="">
                        <th width="6%">Agent</th>
                         <!--<th width="6%"><a href="<?php echo base_url(); ?>Assign_case_controller/assign_case_function" id="' . $row->id . '">Agent</a></th> -->
                        <th width="10%">Total</th>
                        <th width="10%">InProgress</th>
                        <th width="10%">Pending</th>
                        <th width="10%">Visit</th>
                        <th width="10%">Out of TAT</th>
                        <th width="10%">Positive resolved</th>
                        <th width="10%">Negative resolved</th>
                        <!--<th width="10%">First Visit</th>-->
                        <!--<th width="10%">Last Visit</th>-->
                    </tr>
                </thead>
                <tbody id="fetch_agent_data_body"></tbody>
        <!--<tr>-->
        <!--    <td></td>-->
        <!--    <td></td>-->
        <!--    <td></td>-->
        <!--    <td></td>-->
        <!--    <td></td>-->
        <!--    <td></td>-->
        <!--    <td></td>-->
        <!--    <td></td>-->
        <!--    <td><?php echo $agentVisitDates->first_visit_date; ?></td>-->
        <!--    <td><?php echo $agentVisitDates->last_visit_date; ?></td>-->
        <!--</tr>-->
            </table>
        </div>
    </div>
    
    
                                        <script type="text/javascript">
                                            
                                                
                                                  function getAgentData(val) {
                                               
                                              var datastring = "val=" + val;
                                                // alert(datastring);
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?= base_url() ?>Dashboard_controller/agentFilterDashboard",
                                                    // dataType:"json",
                                                    data: datastring,
                                                    // contentType: "application/json; charset=utf-8",
                                                    success: function(data) {
                                                        //alert(data);
                                                        $('#fetch_agent_data_body').html(data);

                                                    },
                                                    error: function() {
                                                        // alert("Error");
                                                    }
                                                });
                                            }
                                            
    </script>
</body>

</html>