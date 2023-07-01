<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('case_form_model');
        // $this->load->model('login');
    }

    public function getUserLogin()
    {
        try {
            if ($this->input->method() == "post") {
                // $this->input->method() == "post";
                $this->load->library('form_validation');
                $this->load->helper('security');
                $validation_rules = [
                    [
                        'field' => "mobile",
                        'label' => "mobile number",
                        'rules' => "trim|required|numeric|min_length[10]|max_length[10]",
                    ],
                ];
                $this->form_validation->set_rules($validation_rules);
                if ($this->form_validation->run() == false) {
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode([
                            'status' => false,
                            'statusCode' => 404,
                            'message' => strip_tags(trim(validation_errors())),
                        ]));
                }

                $mobile = $this->input->post('mobile');
                $sql = 'SELECT * FROM `login` WHERE mobile =' . $mobile;
                $query = $this->db->query($sql);
                $data = $query->result_array();
                if (!empty($data)) {
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode([
                            'status' => true,
                            'statusCode' => 200,
                            'data' => $data,
                        ]));
                    // } else {
                    //     return $this->output
                    //         ->set_content_type('application/json')
                    //         ->set_status_header(500)
                    //         ->set_output(json_encode([
                    //             'status' => true,
                    //             'statusCode' => 200,
                    //             'data' => []
                    //         ]));
                    // }
                }
            }
        } catch (\Exception $ex) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => true,
                    'statusCode' => 500,
                    'message' => $ex->getMessage(),
                ]));
        }
    }

    public function insertTokenid()
    {
        $response = array();
        try {
            // if ($this->input->method() == "post") {
            $mobile = $this->input->post('mobile');
            $token_id = $this->input->post('token_id');


            // print_r($data);die;
            if (!empty($mobile)) {

                $inserttoken = array(

                    'token_id' => $token_id,

                );
                $this->db->where('mobile', $mobile);
                $this->db->update('login', $inserttoken);

                if ($this->db->affected_rows() > 0) {
                    $response = [
                        'status' => "success",
                        'message' => "token inserted successfully",
                    ];
                } else {
                    $response = [
                        'status' => "failure",
                        'message' => "Data insertion failed",
                    ];
                }
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "mobile number not match",
                ];
            }
        } catch (Exception $ex) {
            $response = [
                'status' => "failed",
                'message' => $ex->getMessage(),
            ];
        }
        echo json_encode($response);
    }

    public function sendTatNotificationAlert()
    {
        $response = [];
        try {
            $data_json = [];
            define('API_ACCESS_KEY', 'AAAAWdAq5LA:APA91bGfu2jlR0FpwGEfm-w-WeYx-fsceFV3ARRvEWMkWi96d8LxFrGGLIhnOExg6uCP7z2tn-9XlxVEheArQJoSHVQpAm9fz5XnGNbN40v4KHCj5izxBog3Apqz9HRXsZptTC7fpWzG');
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

            $agent_code = $this->input->post('code');
            $sql =  'SELECT log.token_id, log.employee_unique_id, uf.id, uf.bank_name, uf.product_name, uf.application_id, TIME_FORMAT(Time(uf.tat_start),"%H:%i") as tat_start, TIME_FORMAT(Time(uf.tat_end),"%H:%i") as tat_end,	STR_TO_DATE(uf.tat_end,"%Y-%m-%d %H:%i") as str_tat_end, STR_TO_DATE((NOW() + INTERVAL 360 MINUTE),"%Y-%m-%d %H:%i") as now_datetime FROM login as log join upload_file as uf on log.employee_unique_id=uf.code where STR_TO_DATE(uf.tat_end,"%Y-%m-%d %H:%i") = STR_TO_DATE((NOW() + INTERVAL 360 MINUTE),"%Y-%m-%d %H:%i")';

            $query = $this->db->query($sql);
            $data = $query->result_array();

            if ($data) {
                foreach ($data as $key => $val) {
                    // APP token id to whom notification send//
                    //echo "<pre>";print_r($val);
                    //$token='cUcmZwNHT1GuWyuTlU5iVZ:APA91bEIf52mc9SizfjBg_zKfPxic78zlJfPHou6W3-64V9gdo9zCtUvSFwJX74W-vYWzpny1cRYSWvai830iqIv4qewDi4VIxbjeU8PsNy39wpznGaeBAPnRxWMCB3SxhUE5vydXn4B';
                    $token = $val['token_id'];
                    // Notification msg //
                    $notification = [
                        'title' => 'Tat expiry main case notification',
                        'body' => "We would like to inform you that the Tat Start Time for your Product-(" . $val['bank_name'] . ") Bank (" . $val['product_name'] . ")with reference number (" . $val['application_id'] . ") is (" . $val['tat_start'] . "), and the Tat End Time is (" . $val['tat_end'] . ") will expired in half an hour.",
                        //'icon' =>'myIcon',
                        //'sound' => 'mySound'
                    ];

                    $extraNotificationData = ["message" => $notification, "moredata" => 'dd'];

                    $fcmNotification = [
                        //'registration_ids' => $tokenList, //multple token array
                        'to'        => $token, //single token
                        'notification' => $notification,
                        'data' => $extraNotificationData
                    ];

                    $headers = [
                        'Authorization: key=' . API_ACCESS_KEY,
                        'Content-Type: application/json'
                    ];


                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);
                    //echo $result;
                    $result_array = json_decode($result, true);
                    $save_notification = 'N';
                    if ($result_array['success'] == 1) {
                        $insertdata = array(
                            'case_id' => $val['id'],
                            'application_id' => $val['application_id'],
                            'employee_code' => $val['employee_unique_id'],
                            'push_notification' => $notification['body'],
                            'created_date' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('main_case_push_notification', $insertdata);

                        if ($this->db->affected_rows() > 0) {
                            $save_notification = 'Y';
                        }
                        if ($save_notification == 'Y') {
                            $response = [
                                'status' => "Success",
                                'message' => "Push Notification sent successfully",
                                'db_insert' => "Success",
                            ];
                        } else {
                            $response = [
                                'status' => "Success",
                                'message' => "Push Notification sent successfully",
                                'db_insert' => "Failure",
                            ];
                        }
                    } else {
                        $response = [
                            'status' => "Failure",
                            'message' => "Push Notification failed",
                        ];
                    }
                }
            } else {
                $response = "No Data Found";
            }
            $response = [
                'status' => "success",
                'data' => $response,
            ];
            // $response = $data;

            echo json_encode($response);
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
    }

    public function sendQuickTatNotificationAlert()
    {
        $response = [];
        try {
            $data_json = [];
            define('API_ACCESS_KEY', 'AAAAWdAq5LA:APA91bGfu2jlR0FpwGEfm-w-WeYx-fsceFV3ARRvEWMkWi96d8LxFrGGLIhnOExg6uCP7z2tn-9XlxVEheArQJoSHVQpAm9fz5XnGNbN40v4KHCj5izxBog3Apqz9HRXsZptTC7fpWzG');
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

            $agent_code = $this->input->post('code');
            $sql =  'SELECT log.token_id, log.employee_unique_id, mc.id, mc.bank, mc.product, mc.reference_no, TIME_FORMAT(Time(mc.tat_start),"%H:%i") as tat_start, TIME_FORMAT(Time(mc.tat_end),"%H:%i") as tat_end, STR_TO_DATE(mc.tat_end,"%Y-%m-%d %H:%i") as str_tat_end, STR_TO_DATE((NOW() + INTERVAL 360 MINUTE),"%Y-%m-%d %H:%i") as now_datetime FROM login as log join mini_case as mc on log.employee_unique_id=mc.code where STR_TO_DATE(mc.tat_end,"%Y-%m-%d %H:%i") = STR_TO_DATE((NOW() + INTERVAL 360 MINUTE),"%Y-%m-%d %H:%i")';

            $query = $this->db->query($sql);
            $data = $query->result_array();

            if ($data) {
                foreach ($data as $key => $val) {
                    // APP token id to whom notification send//
                    //echo "<pre>";print_r($val);
                    //$token='cUcmZwNHT1GuWyuTlU5iVZ:APA91bEIf52mc9SizfjBg_zKfPxic78zlJfPHou6W3-64V9gdo9zCtUvSFwJX74W-vYWzpny1cRYSWvai830iqIv4qewDi4VIxbjeU8PsNy39wpznGaeBAPnRxWMCB3SxhUE5vydXn4B';
                    $token = $val['token_id'];
                    // Notification msg //
                    $notification = [
                        'title' => 'Tat expiry quick case notification',
                        'body' => "We would like to inform you that the Tat Start Time for your Product-(" . $val['bank'] . ") Bank (" . $val['product'] . ")with reference number (" . $val['reference_no'] . ") is (" . $val['tat_start'] . "), and the Tat End Time is (" . $val['tat_end'] . ") will expired in half an hour.",
                        //'icon' =>'myIcon',
                        //'sound' => 'mySound'
                    ];

                    $extraNotificationData = ["message" => $notification, "moredata" => 'dd'];

                    $fcmNotification = [
                        //'registration_ids' => $tokenList, //multple token array
                        'to'        => $token, //single token
                        'notification' => $notification,
                        'data' => $extraNotificationData
                    ];

                    $headers = [
                        'Authorization: key=' . API_ACCESS_KEY,
                        'Content-Type: application/json'
                    ];


                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);
                    //echo $result;
                    $result_array = json_decode($result, true);
                    $save_notification = 'N';
                    if ($result_array['success'] == 1) {
                        $insertdata = array(
                            'case_id' => $val['id'],
                            'reference_no' => $val['reference_no'],
                            'employee_code' => $val['employee_unique_id'],
                            'push_notification' => $notification['body'],
                            'created_date' => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('mini_case_push_notification', $insertdata);

                        if ($this->db->affected_rows() > 0) {
                            $save_notification = 'Y';
                        }
                        if ($save_notification == 'Y') {
                            $response = [
                                'status' => "Success",
                                'message' => "Push Notification sent successfully",
                                'db_insert' => "Success",
                            ];
                        } else {
                            $response = [
                                'status' => "Success",
                                'message' => "Push Notification sent successfully",
                                'db_insert' => "Failure",
                            ];
                        }
                    } else {
                        $response = [
                            'status' => "Failure",
                            'message' => "Push Notification failed",
                        ];
                    }
                }
            } else {
                $response = "No Data Found";
            }
            $response = [
                'status' => "success",
                'data' => $response,
            ];
            // $response = $data;

            echo json_encode($response);
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
    }

    // public function getMiniCasesType()
    // {
    //     $response = [];
    //     try {
    //         if ($this->input->method() == "post") {
    //             $fi_type = $this->input->post('fi_type');
    //             $sql = 'SELECT id,bank,product,fi_type FROM mini_case WHERE fi_type = "' . $fi_type . '"';
    //             $query = $this->db->query($sql);
    //             $data = $query->result_array();
    //             $response = [
    //                 'status' => "success",
    //                 'data' => $data,
    //             ];
    //             // $response = $data;
    //         } else {
    //             $response = [
    //                 'status' => "failure",
    //                 'message' => "Input method should be in post",
    //             ];
    //         }
    //         echo json_encode($response);
    //     } catch (Exception $ex) {
    //         $response = [
    //             'status' => "failure",
    //             'message' => $ex->getMessage(),
    //         ];
    //     }
    // }

    public function getMiniCases()
    {
        $response = [];
        try {
            if ($this->input->method() == "post") {
                $reference_no = $this->input->post('reference_no');
                $agent_code = $this->input->post('agent_code');
                $sql = 'SELECT * FROM mini_case WHERE reference_no = "' . $reference_no . '" AND code = "' . $agent_code . '"';
                $query = $this->db->query($sql);
                $data = $query->result_array();
                $response = [
                    'status' => "success",
                    'data' => $data,
                ];
                // $response = $data;
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Input method should be in post",
                ];
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
    }


    public function caseCount()
    {
        $response = [];
        try {
            if ($this->input->method() == "post") {

                $employee_unique_id = $this->input->post('employee_unique_id');
                $sql = 'SELECT id,day_wise_case,monthly_resolved,out_of_tat_daily_count FROM login WHERE employee_unique_id = "' . $employee_unique_id . '"';
                $query = $this->db->query($sql);
                $data = $query->result_array();
                $response = [
                    'status' => "success",
                    'data' => $data,
                ];
                // $response = $data;
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Input method should be in post",
                ];
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
    }



    public function getMiniCaseLists()
    {
        $response = [];
        try {
            if ($this->input->method() == "post") {
                $agent_code = $this->input->post('agent_code');
                $fi_type = $this->input->post('fi_type');
                $bank = $this->input->post('bank');
                // $fi_type = $this->input->post('fi_type');
                // $sql = 'SELECT * FROM mini_case WHERE code = "' . $agent_code . '"';
                $sql = 'SELECT * FROM mini_case WHERE fi_type = "' . $fi_type . '" AND code = "' . $agent_code . '" AND bank = "' . $bank . '"';
                $query = $this->db->query($sql);
                $data = $query->result_array();
                $response = [
                    'status' => "success",
                    'data' => $data,
                ];
                // $response = $data;
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Input method should be in post",
                ];
            }
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
        echo json_encode($response);
    }

    public function insertMiniCases()
    {
        $response = array();
        try {
            // if ($this->input->method() == "post") {
            $reference_no = $this->input->post('reference_no');
            $remarks = $this->input->post('remarks');
            // $photos = $this->input->post('photos');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $image1 = $this->input->post('image1');
            $image2 = $this->input->post('image2');
            $image3 = $this->input->post('image3');
            $image4 = $this->input->post('image4');
            $image5 = $this->input->post('image5');
            $image6 = $this->input->post('image6');
            $image7 = $this->input->post('image7');
            $image8 = $this->input->post('image8');
            $image9 = $this->input->post('image9');

            // print_r($data);die;
            if (!empty($reference_no)) {

                $insertdata = array(
                    'remarks' => $remarks,
                    // 'photos' => $photos,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'image1' => $image1,
                    'image2' => $image2,
                    'image3' => $image3,
                    'image4' => $image4,
                    'image5' => $image5,
                    'image6' => $image6,
                    'image7' => $image7,
                    'image8' => $image8,
                    'image9' => $image9,
                    'status' => "active",
                );
                $this->db->where('reference_no', $reference_no);
                $this->db->update('mini_case', $insertdata);

                if ($this->db->affected_rows() > 0) {
                    $response = [
                        'status' => "success",
                        'message' => "Data inserted successfully",
                    ];
                } else {
                    $response = [
                        'status' => "failure",
                        'message' => "Data insertion failed",
                    ];
                }
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Reference number not match",
                ];
            }
        } catch (Exception $ex) {
            $response = [
                'status' => "failed",
                'message' => $ex->getMessage(),
            ];
        }
        echo json_encode($response);
    }

    public function getCases()
    {
        $response = [];
        try {
            if ($this->input->method() == "post") {
                $application_id = $this->input->post('application_id');
                $code = $this->input->post('code');
                $sql = 'SELECT id,application_id,customer_name,bank_name,product_name,fi_to_be_conducted,source_channel,application_id,co_applicant,guarantee_name,business_address,city,pincode,vehicle,tat_start,tat_end,remarks,status,geo_limit,fi_date,created_at,business_name,random_no,office_address,dob,code,mobile,designation,amount FROM upload_file WHERE application_id = "' . $application_id . '" AND code = "' . $code . '"';


                $query = $this->db->query($sql);
                $data = $query->result_array();
                $response = [
                    'status' => "success",
                    'data' => $data,
                ];
                // $response = $data;
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Input method should be in post",
                ];
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
    }


    public function getCasesNew()
    {
        $response = [];
        try {
            if ($this->input->method() == "post") {
                $application_id = $this->input->post('application_id');
                $code = $this->input->post('code');
                $sql = 'SELECT application_id, customer_name, random_no,created_at,business_address,city FROM upload_file WHERE application_id = "' . $application_id . '" AND code = "' . $code . '"';
                $query = $this->db->query($sql);
                $data = $query->result_array();
                $response = [
                    'status' => "success",
                    'data' => $data,
                ];
                // $response = $data;
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Input method should be in post",
                ];
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
    }

    // public function getCasesLists()
    // {
    //     $response = [];
    //     try {
    //         if ($this->input->method() == "post") {
    //             $code = $this->input->post('agent_code');
    //             $fi_type = $this->input->post('fi_type');
    //             $bank = $this->input->post('bank');
    //             // $fi_type = $this->input->post('fi_type');
    //             // $sql = 'SELECT id,fi_to_be_conducted,product_name,residence_address,application_id,customer_name,created_at FROM upload_file WHERE code = "' . $code . '"';
    //             // $sql = 'SELECT * FROM upload_file WHERE code = "' . $code . '"';
    //             $sql = 'SELECT * FROM upload_file WHERE fi_to_be_conducted = "' . $fi_type . '" AND code = "' . $code . '" AND bank_name = "' . $bank . '"';
    //             $query = $this->db->query($sql);
    //             $data = $query->result_array();
    //             $response = [
    //                 'status' => "success",
    //                 'data' => $data,
    //             ];
    //             // $response = $data;
    //         } else {
    //             $response = [
    //                 'status' => "failure",
    //                 'message' => "Input method should be in post",
    //             ];
    //         }
    //         echo json_encode($response);
    //     } catch (Exception $ex) {
    //         $response = [
    //             'status' => "failure",
    //             'message' => $ex->getMessage(),
    //         ];
    //     }
    // }

    public function getCasesLists()
    {
        $response = [];
        try {
            if ($this->input->method() == "post") {
                $code = $this->input->post('agent_code');
                $fi_to_be_conducted = $this->input->post('fi_to_be_conducted');
                $bank = $this->input->post('bank');
                // $fi_type = $this->input->post('fi_type');
                // $sql = 'SELECT id,fi_to_be_conducted,product_name,residence_address,application_id,customer_name,created_at FROM upload_file WHERE code = "' . $code . '"';
                // $sql = 'SELECT * FROM upload_file WHERE code = "' . $code . '"';
                //  $sql = 'SELECT application_id,customer_name,random_no,created_at,business_address,city FROM upload_file WHERE application_id = "' . $application_id . '" AND code = "' . $code . '"';
                $sql = 'SELECT id,application_id,customer_name,random_no,created_at,business_address,city,fi_to_be_conducted,status FROM upload_file WHERE fi_to_be_conducted = "' . $fi_to_be_conducted . '" AND code = "' . $code . '" AND bank_name = "' . $bank . '"';
                $query = $this->db->query($sql);
                $data = $query->result_array();
                $response = [
                    'status' => "success",
                    'data' => $data,
                ];
                // $response = $data;
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Input method should be in post",
                ];
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
    }

    public function insertCasesDetails()
    {
        $response = array();
        try {
            $application_id = $this->input->post('application_id');
            $fi_status = $this->input->post('fi_status');

            if (!empty($application_id)) {
                $insertdata = array(
                    'application_id' => $application_id,
                    'fi_status' => $fi_status,
                );
                $this->db->where('application_id', $application_id);
                $this->db->insert('mobile_data_app', $insertdata);

                if ($this->db->affected_rows() > 0) {
                    $response = [
                        'status' => "success",
                        'message' => "Data inserted successfully",
                    ];
                } else {
                    $response = [
                        'status' => "failure",
                        'message' => "Data insertion failed",
                    ];
                }
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Reference number not match",
                ];
            }
        } catch (Exception $ex) {
            $response = [
                'status' => "failed",
                'message' => $ex->getMessage(),
            ];
        }
        echo json_encode($response);
    }

    public function insertrvQuickCases()
    {
        $response = array();
        try {
            // if ($this->input->method() == "post") {
            $reference_no = $this->input->post('reference_no');
            $fi_type = $this->input->post('fi_type');
            $rv_long = $this->input->post('rv_long');
            $rv_lat = $this->input->post('rv_lat');
            $rv_pincode = $this->input->post('rv_pincode');
            $rv_location_add = $this->input->post('rv_location_add');
            $rv_visit_date = $this->input->post('rv_visit_date');

            $remarks = $this->input->post('rv_remarks');
            $rv_image1 = $this->input->post('rv_image1');
            $rv_image2 = $this->input->post('rv_image2');
            $rv_image3 = $this->input->post('rv_image3');
            $rv_image4 = $this->input->post('rv_image4');
            $rv_image5 = $this->input->post('rv_image5');
            $rv_image6 = $this->input->post('rv_image6');
            $rv_image7 = $this->input->post('rv_image7');
            $rv_image8 = $this->input->post('rv_image8');
            $rv_image9 = $this->input->post('rv_image9');

            // print_r($data);die;
            if (!empty($reference_no)) {

                $insertQuickcase = array(

                    'rv_long' => $rv_long,
                    'rv_lat' => $rv_lat,
                    'rv_pincode' => $rv_pincode,
                    'rv_location_add' => $rv_location_add,
                    'rv_visit_date' => $rv_visit_date,
                    'remarks' => $remarks,
                    'rv_image1' => $rv_image1,
                    'rv_image2' => $rv_image2,
                    'rv_image3' => $rv_image3,
                    'rv_image4' => $rv_image4,
                    'rv_image5' => $rv_image5,
                    'rv_image6' => $rv_image6,
                    'rv_image7' => $rv_image7,
                    'rv_image8' => $rv_image8,
                    'rv_image9' => $rv_image9,
                    'status' => "Resolved",
                );

                $this->db->where('reference_no', $reference_no);
                $this->db->where('fi_type', $fi_type);
                $this->db->update('mini_case', $insertQuickcase);

                if ($this->db->affected_rows() > 0) {
                    $response = [
                        'status' => "success",
                        'message' => "Quick Case RV Data inserted successfully",
                    ];
                } else {
                    $response = [
                        'status' => "failure",
                        'message' => "Data insertion failed",
                    ];
                }
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Reference number not match",
                ];
            }
        } catch (Exception $ex) {
            $response = [
                'status' => "failed",
                'message' => $ex->getMessage(),
            ];
        }
        echo json_encode($response);
    }


    public function insertBvQuickCases()
    {
        $response = array();
        try {
            // if ($this->input->method() == "post") {
            $reference_no = $this->input->post('reference_no');
            $fi_type = $this->input->post('fi_type');
            $bv_lat = $this->input->post('bv_lat');
            $bv_long = $this->input->post('bv_long');
            $bv_pincode = $this->input->post('bv_pincode');
            $bv_location_add = $this->input->post('bv_location_add');
            $bv_visit_date = $this->input->post('bv_visit_date');


            $remarks = $this->input->post('bv_remarks');
            $bv_image1 = $this->input->post('bv_image1');
            $bv_image2 = $this->input->post('bv_image2');
            $bv_image3 = $this->input->post('bv_image3');
            $bv_image4 = $this->input->post('bv_image4');
            $bv_image5 = $this->input->post('bv_image5');
            $bv_image6 = $this->input->post('bv_image6');
            $bv_image7 = $this->input->post('bv_image7');
            $bv_image8 = $this->input->post('bv_image8');
            $bv_image9 = $this->input->post('bv_image9');

            // print_r($data);die;
            if (!empty($reference_no)) {

                $insertQuickcase = array(

                    'bv_location_add' => $bv_location_add,
                    'bv_pincode' => $bv_pincode,
                    'bv_long' => $bv_long,
                    'bv_lat' => $bv_lat,
                    'bv_visit_date' => $bv_visit_date,
                    'remarks' => $remarks,
                    'bv_image1' => $bv_image1,
                    'bv_image2' => $bv_image2,
                    'bv_image3' => $bv_image3,
                    'bv_image4' => $bv_image4,
                    'bv_image5' => $bv_image5,
                    'bv_image6' => $bv_image6,
                    'bv_image7' => $bv_image7,
                    'bv_image8' => $bv_image8,
                    'bv_image9' => $bv_image9,
                    'status' => "Resolved",
                );
                $this->db->where('reference_no', $reference_no);
                $this->db->where('fi_type', $fi_type);
                $this->db->update('mini_case', $insertQuickcase);

                if ($this->db->affected_rows() > 0) {
                    $response = [
                        'status' => "success",
                        'message' => "Quick Case BV Data inserted successfully",
                    ];
                } else {
                    $response = [
                        'status' => "failure",
                        'message' => "Data insertion failed",
                    ];
                }
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Reference number not match",
                ];
            }
        } catch (Exception $ex) {
            $response = [
                'status' => "failed",
                'message' => $ex->getMessage(),
            ];
        }
        echo json_encode($response);
    }


    // public function miniCaseBankType()
    // {
    //     $response = [];
    //     try {
    //         if ($this->input->method() == "post") {
    //             $agent_code = $this->input->post('agent_code');
    //             $sql = 'SELECT id,bank,fi_type FROM mini_case WHERE agent_code = "' . $agent_code . '"';
    //             $query = $this->db->query($sql);
    //             $data = $query->result_array();
    //             $response = [
    //                 'status' => "success",
    //                 'data' => $data,
    //             ];
    //             // $response = $data;
    //         } else {
    //             $response = [
    //                 'status' => "failure",
    //                 'message' => "Input method should be in post",
    //             ];
    //         }
    //         echo json_encode($response);
    //     } catch (Exception $ex) {
    //         $response = [
    //             'status' => "failure",
    //             'message' => $ex->getMessage(),
    //         ];
    //     }
    // }


    public function insertrvMainCases()
    {
        $response = array();
        try {
            // if ($this->input->method() == "post") {
            $application_id = $this->input->post('application_id');
            $random_no = $this->input->post('random_no');
            $fi_to_be_conducted = $this->input->post('fi_to_be_conducted');
            $rv_fi_status = $this->input->post('rv_fi_status');
            $rv_fi_status_reason = $this->input->post('rv_fi_status_reason');
            $rv_loan_amt = $this->input->post('rv_loan_amt');
            $rv_confirm_address = $this->input->post('rv_confirm_address');
            $rv_address_yes_no = $this->input->post('rv_address_yes_no');
            $rv_person_met_details = $this->input->post('rv_person_met_details');
            $rv_relationship = $this->input->post('rv_relationship');
            $rv_residence_ownership = $this->input->post('rv_residence_ownership');
            $rv_stability = $this->input->post('rv_stability');
            $rv_user_permanent_address = $this->input->post('rv_user_permanent_address');
            $rv_rent_per_month = $this->input->post('rv_rent_per_month');
            $rv_total_family_member = $this->input->post('rv_total_family_member');
            $rv_no_of_earning_members = $this->input->post('rv_no_of_earning_members');
            $rv_details_of_earning_member = $this->input->post('rv_details_of_earning_member');
            $rv_dependent = $this->input->post('rv_dependent');
            $rv_user_office_address = $this->input->post('rv_user_office_address');
            $rv_residence_proof = $this->input->post('rv_residence_proof');
            $rv_agriculture_land = $this->input->post('rv_agriculture_land');
            $rv_exterior_premises = $this->input->post('rv_exterior_premises');
            $rv_interior_premises = $this->input->post('rv_interior_premises');
            $rv_cross_verified_info = $this->input->post('rv_cross_verified_info');
            $rv_vehicle_details = $this->input->post('rv_vehicle_details');

            $neighbour_name1 = $this->input->post('neighbour_name1');
            $neighbour_name2 = $this->input->post('neighbour_name2');
            $neighbour_house_no_1 = $this->input->post('neighbour_house_no_1');
            $neighbour_house_no_2 = $this->input->post('neighbour_house_no_2');
            $neighbour_feedback1 = $this->input->post('neighbour_feedback1');
            $neighbour_feedback2 = $this->input->post('neighbour_feedback2');
            $neighbour1_neg_feedback = $this->input->post('neighbour1_neg_feedback');
            $neighbour2_neg_feedback = $this->input->post('neighbour2_neg_feedback');
            $neighbour_contact1 = $this->input->post('neighbour_contact1');
            $neighbour_contact2 = $this->input->post('neighbour_contact2');

            $consolidated_remark = $this->input->post('consolidated_remark');
            $res_proof_number = $this->input->post('res_proof_number');

            $how_much_land = $this->input->post('how_much_land');
            $rv_vehicle_type = $this->input->post('rv_vehicle_type');
            $rv_loan_existing = $this->input->post('rv_loan_existing');
            $rv_loan_bankname = $this->input->post('rv_loan_bankname');
            $rv_loan_emi = $this->input->post('rv_loan_emi');


            $rv_cpv_done_by = $this->input->post('rv_cpv_done_by');

            // $rv_visit_date = $this->input->post('rv_visit_date');

            $rv_visit_date = $this->input->post('rv_visit_date');
            // $rv_visit_date = date('Y-m-d H:i:s', strtotime($rv_visit_date));
            $formatted_rv_visit_date = date('Y-m-d H:i:s', strtotime($rv_visit_date));

            //      $rv_visit_date = DateTime::createFromFormat('Y-m-d H:i:s', $rv_visit_date);
            // $formatted_rv_visit_date = $rv_visit_date->format('Y-m-d H:i:s');

            $rv_remarks = $this->input->post('rv_remarks');
            $rv_lat = $this->input->post('rv_lat');
            $rv_long = $this->input->post('rv_long');
            $rv_pincode = $this->input->post('rv_pincode');
            $rv_location_add = $this->input->post('rv_location_add');

            $rv_image1 = $this->input->post('rv_image1');
            $rv_image2 = $this->input->post('rv_image2');
            $rv_image3 = $this->input->post('rv_image3');
            $rv_image4 = $this->input->post('rv_image4');
            $rv_image5 = $this->input->post('rv_image5');
            $rv_image6 = $this->input->post('rv_image6');
            $rv_image7 = $this->input->post('rv_image7');
            $rv_image8 = $this->input->post('rv_image8');
            $rv_image9 = $this->input->post('rv_image9');

            // print_r($data);die;
            if (!empty($application_id)) {

                $insertcase = array(
                    'rv_fi_status' => $rv_fi_status,
                    'rv_fi_status_reason' => $rv_fi_status_reason,
                    'rv_loan_amt' => $rv_loan_amt,
                    'rv_confirm_address' => $rv_confirm_address,
                    'rv_address_yes_no' => $rv_address_yes_no,
                    'rv_person_met_details' => $rv_person_met_details,
                    'rv_relationship' => $rv_relationship,
                    'rv_residence_ownership' => $rv_residence_ownership,
                    'rv_stability' => $rv_stability,
                    'rv_user_permanent_address' => $rv_user_permanent_address,
                    'rv_rent_per_month' => $rv_rent_per_month,
                    'rv_total_family_member' => $rv_total_family_member,
                    'rv_no_of_earning_members' => $rv_no_of_earning_members,
                    'rv_details_of_earning_member' => $rv_details_of_earning_member,
                    'rv_dependent' => $rv_dependent,
                    'rv_lat' => $rv_lat,
                    'rv_long' => $rv_long,
                    'rv_pincode' => $rv_pincode,
                    'rv_location_add' => $rv_location_add,
                    'rv_user_office_address' => $rv_user_office_address,
                    'rv_residence_proof' => $rv_residence_proof,
                    'rv_agriculture_land' => $rv_agriculture_land,
                    'rv_exterior_premises' => $rv_exterior_premises,
                    'rv_interior_premises' => $rv_interior_premises,
                    'rv_cross_verified_info' => $rv_cross_verified_info,
                    'rv_vehicle_details' => $rv_vehicle_details,
                    'neighbour_name1' => $neighbour_name1,
                    'neighbour_name2' => $neighbour_name2,
                    'neighbour_feedback1' => $neighbour_feedback1,
                    'neighbour_feedback2' => $neighbour_feedback2,
                    'neighbour1_neg_feedback' => $neighbour1_neg_feedback,
                    'neighbour2_neg_feedback' => $neighbour2_neg_feedback,
                    'neighbour_contact1' => $neighbour_contact1,
                    'neighbour_contact2' => $neighbour_contact2,

                    'consolidated_remark' => $consolidated_remark,
                    'res_proof_number' => $res_proof_number,
                    'how_much_land' => $how_much_land,
                    'rv_vehicle_type' => $rv_vehicle_type,
                    'rv_loan_existing' => $rv_loan_existing,
                    'rv_loan_bankname' => $rv_loan_bankname,
                    'rv_loan_emi' => $rv_loan_emi,
                    'rv_cpv_done_by' => $rv_cpv_done_by,

                    // 'rv_visit_date' => $rv_visit_date,
                    'rv_visit_date' => $formatted_rv_visit_date,

                    'rv_remarks' => $rv_remarks,
                    'rv_image1' => $rv_image1,
                    'rv_image2' => $rv_image2,
                    'rv_image3' => $rv_image3,
                    'rv_image4' => $rv_image4,
                    'rv_image5' => $rv_image5,
                    'rv_image6' => $rv_image6,
                    'rv_image7' => $rv_image7,
                    'rv_image8' => $rv_image8,
                    'rv_image9' => $rv_image9,
                    'status' => "Resolved",
                );
                $this->db->where('application_id', $application_id);
                $this->db->where('random_no', $random_no);
                $this->db->where('fi_to_be_conducted', $fi_to_be_conducted);
                $this->db->update('upload_file', $insertcase);

                if ($this->db->affected_rows() > 0) {
                    $response = [
                        'status' => "success",
                        'message' => "Data inserted successfully",
                    ];
                } else {
                    $response = [
                        'status' => "failure",
                        'message' => "Data insertion failed",
                    ];
                }
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Application number not match",
                ];
            }
        } catch (Exception $ex) {
            $response = [
                'status' => "failed",
                'message' => $ex->getMessage(),
            ];
        }
        echo json_encode($response);
    }



    public function insertBvMainCases()
    {
        $response = array();
        try {
            // if ($this->input->method() == "post") {
            $application_id = $this->input->post('application_id');
            $random_no = $this->input->post('random_no');
            $fi_to_be_conducted = $this->input->post('fi_to_be_conducted');
            $bv_corporate_office = $this->input->post('bv_corporate_office');
            $bv_type_of_profile = $this->input->post('bv_type_of_profile');
            $bv_company_name = $this->input->post('bv_company_name');
            $bv_person_met = $this->input->post('bv_person_met');
            $bv_person_designation = $this->input->post('bv_person_designation');
            $bv_signboard_name = $this->input->post('bv_signboard_name');
            $bv_address_confirmed = $this->input->post('bv_address_confirmed');
            $bv_applicant_designation = $this->input->post('bv_applicant_designation');
            $bv_income = $this->input->post('bv_income');
            $bv_approx_sale = $this->input->post('bv_approx_sale');
            $bv_approx_gross_salary = $this->input->post('bv_approx_gross_salary');
            $bv_approx_net_salary = $this->input->post('bv_approx_net_salary');
            $bv_working_since = $this->input->post('bv_working_since');

            $bv_residence_address = $this->input->post('bv_residence_address');
            $bv_business_type = $this->input->post('bv_business_type');
            $bv_no_employee = $this->input->post('bv_no_employee');
            $bv_stocks = $this->input->post('bv_stocks');
            $bv_business_activity = $this->input->post('bv_business_activity');
            $bv_stability = $this->input->post('bv_stability');
            $bv_ownership = $this->input->post('bv_ownership');
            $bv_ownership_other = $this->input->post('bv_ownership_other');
            $bv_nature_of_business = $this->input->post('bv_nature_of_business');
            $bv_proof = $this->input->post('bv_proof');
            $bv_previous_bus_details = $this->input->post('bv_previous_bus_details');
            $bv_office_proof = $this->input->post('bv_office_proof');

            $bv_vehicle = $this->input->post('bv_vehicle');
            $rv_vehicle_details = $this->input->post('rv_vehicle_details');
            $bv_tcp1 = $this->input->post('bv_tcp1');
            $bv_tcp2 = $this->input->post('bv_tcp2');
            $bv_nature_of_job = $this->input->post('bv_nature_of_job');
            $bv_office_setup = $this->input->post('bv_office_setup');
            $bv_office_setup_desc = $this->input->post('bv_office_setup_desc');

            $tcp1_name = $this->input->post('tcp1_name');
            $tcp2_name = $this->input->post('tcp2_name');
            $bv_tcp1_address = $this->input->post('bv_tcp1_address');
            $bv_tcp2_address = $this->input->post('bv_tcp2_address');
            // $bv_tcp1_designation = $this->input->post('bv_tcp1_designation');
            // $bv_tcp2_designation = $this->input->post('bv_tcp2_designation');
            $bv_tcp1_contact = $this->input->post('bv_tcp1_contact');
            $bv_tcp2_contact = $this->input->post('bv_tcp2_contact');
            $bv_negative1 = $this->input->post('bv_negative1');
            $bv_negative2 = $this->input->post('bv_negative2');

            $bv_verified_name = $this->input->post('bv_verified_name');

            $rv_visit_date = $this->input->post('rv_visit_date');
            $formatted_bv_visit_date = date('Y-m-d H:i:s', strtotime($rv_visit_date));


            $bv_remarks = $this->input->post('bv_remarks');
            $bv_lat = $this->input->post('bv_lat');
            $bv_long = $this->input->post('bv_long');
            $bv_pincode = $this->input->post('bv_pincode');
            $bv_location_add = $this->input->post('bv_location_add');


            $rv_fi_status = $this->input->post('rv_fi_status');
            $rv_fi_status_reason = $this->input->post('rv_fi_status_reason');
            $rv_loan_amt = $this->input->post('rv_loan_amt');
            $rv_loan_existing = $this->input->post('rv_loan_existing');
            $rv_loan_bankname = $this->input->post('rv_loan_bankname');
            $rv_loan_emi = $this->input->post('rv_loan_emi');
            $consolidated_remark = $this->input->post('consolidated_remark');

            // $bv_image1 = $this->input->post('bv_image1');
            // $bv_image2 = $this->input->post('bv_image2');
            // $bv_image3 = $this->input->post('bv_image3');
            // $bv_image4 = $this->input->post('bv_image4');
            // $bv_image5 = $this->input->post('bv_image5');
            // $bv_image6 = $this->input->post('bv_image6');
            // $bv_image7 = $this->input->post('bv_image7');
            // $bv_image8 = $this->input->post('bv_image8');
            // $bv_image9 = $this->input->post('bv_image9');

            $rv_image1 = $this->input->post('rv_image1');
            $rv_image2 = $this->input->post('rv_image2');
            $rv_image3 = $this->input->post('rv_image3');
            $rv_image4 = $this->input->post('rv_image4');
            $rv_image5 = $this->input->post('rv_image5');
            $rv_image6 = $this->input->post('rv_image6');
            $rv_image7 = $this->input->post('rv_image7');
            $rv_image8 = $this->input->post('rv_image8');
            $rv_image9 = $this->input->post('rv_image9');

            // print_r($data);die;
            if (!empty($application_id)) {

                $insertcase = array(


                    'consolidated_remark' => $consolidated_remark,
                    'rv_loan_emi' => $rv_loan_emi,
                    'rv_loan_bankname' => $rv_loan_bankname,
                    'rv_loan_existing' => $rv_loan_existing,
                    'rv_loan_amt' => $rv_loan_amt,
                    'rv_fi_status_reason' => $rv_fi_status_reason,
                    'rv_fi_status' => $rv_fi_status,
                    'bv_negative2' => $bv_negative2,
                    'bv_negative1' => $bv_negative1,
                    'bv_tcp2_contact' => $bv_tcp2_contact,
                    'bv_tcp1_contact' => $bv_tcp1_contact,
                    //   'bv_tcp2_designation' => $bv_tcp2_designation,
                    //   'bv_tcp1_designation' => $bv_tcp1_designation,
                    'bv_tcp2_address' => $bv_tcp2_address,
                    'bv_tcp1_address' => $bv_tcp1_address,
                    'tcp2_name' => $tcp2_name,
                    'tcp1_name' => $tcp1_name,
                    'bv_office_setup_desc' => $bv_office_setup_desc,
                    'bv_office_setup' => $bv_office_setup,
                    'rv_vehicle_details' => $rv_vehicle_details,
                    'bv_office_proof' => $bv_office_proof,
                    'bv_previous_bus_details' => $bv_previous_bus_details,
                    'bv_working_since' => $bv_working_since,
                    'bv_approx_net_salary' => $bv_approx_net_salary,
                    'bv_approx_gross_salary' => $bv_approx_gross_salary,
                    'bv_approx_sale' => $bv_approx_sale,
                    'bv_signboard_name' => $bv_signboard_name,
                    'bv_person_met' => $bv_person_met,
                    'bv_company_name' => $bv_company_name,
                    'bv_type_of_profile' => $bv_type_of_profile,

                    'bv_corporate_office' => $bv_corporate_office,
                    'bv_person_designation' => $bv_person_designation,
                    'bv_address_confirmed' => $bv_address_confirmed,
                    'bv_applicant_designation' => $bv_applicant_designation,
                    'bv_income' => $bv_income,
                    'bv_residence_address' => $bv_residence_address,
                    'bv_business_type' => $bv_business_type,
                    'bv_no_employee' => $bv_no_employee,
                    'bv_stocks' => $bv_stocks,
                    'bv_lat' => $bv_lat,
                    'bv_long' => $bv_long,
                    'bv_pincode' => $bv_pincode,
                    'bv_location_add' => $bv_location_add,
                    'bv_business_activity' => $bv_business_activity,
                    'bv_stability' => $bv_stability,
                    'bv_ownership' => $bv_ownership,
                    'bv_ownership_other' => $bv_ownership_other,
                    'bv_nature_of_business' => $bv_nature_of_business,
                    'bv_proof' => $bv_proof,
                    'bv_vehicle' => $bv_vehicle,
                    'bv_tcp1' => $bv_tcp1,
                    'tcp1_name' => $tcp1_name,
                    'tcp2_name' => $tcp2_name,
                    'bv_nature_of_job' => $bv_nature_of_job,
                    'bv_tcp2' => $bv_tcp2,
                    'bv_verified_name' => $bv_verified_name,
                    'rv_visit_date' => $formatted_bv_visit_date,
                    'bv_remarks' => $bv_remarks,
                    // 'bv_image1' => $bv_image1,
                    // 'bv_image2' => $bv_image2,
                    // 'bv_image3' => $bv_image3,
                    // 'bv_image4' => $bv_image4,
                    // 'bv_image5' => $bv_image5,
                    // 'bv_image6' => $bv_image6,
                    // 'bv_image7' => $bv_image7,
                    // 'bv_image8' => $bv_image8,
                    // 'bv_image9' => $bv_image9,


                    'rv_image1' => $rv_image1,
                    'rv_image2' => $rv_image2,
                    'rv_image3' => $rv_image3,
                    'rv_image4' => $rv_image4,
                    'rv_image5' => $rv_image5,
                    'rv_image6' => $rv_image6,
                    'rv_image7' => $rv_image7,
                    'rv_image8' => $rv_image8,
                    'rv_image9' => $rv_image9,
                    'status' => "Resolved",
                );
                $this->db->where('application_id', $application_id);
                $this->db->where('random_no', $random_no);
                $this->db->where('fi_to_be_conducted', $fi_to_be_conducted);
                $this->db->update('upload_file', $insertcase);

                if ($this->db->affected_rows() > 0) {
                    $response = [
                        'status' => "success",
                        'message' => "Data inserted successfully",
                    ];
                } else {
                    $response = [
                        'status' => "failure",
                        'message' => "Data insertion failed",
                    ];
                }
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Application number not match",
                ];
            }
        } catch (Exception $ex) {
            $response = [
                'status' => "failed",
                'message' => $ex->getMessage(),
            ];
        }
        echo json_encode($response);
    }




    public function mainBankCaseType()
    {

        $response = [];
        try {
            $data_json = [];

            if ($this->input->method() == "post") {
                $agent_code = $this->input->post('agent_code');
                // $sql = 'SELECT application_id,fi_to_be_conducted, COUNT(1) count, bank_name,code FROM `upload_file` 
                // WHERE agent_code = "' . $agent_code . '  GROUP BY bank_name"';
                $sql =  'SELECT fi_to_be_conducted, COUNT(1) total, bank_name FROM `upload_file` 
                where code = "' . $agent_code . '" and status = "inactive" GROUP BY bank_name, fi_to_be_conducted
                ORDER BY `upload_file`.`bank_name` DESC';
                // print_r($sql);die;
                // echo "<br/>";
                // die;
                $query = $this->db->query($sql);
                $data = $query->result_array();
                if ($data) {
                    foreach ($data as $key => $val) {
                        $res_data = [];
                        $bank_name = $val['bank_name'];
                        $fi_to_be_conducted = $val['fi_to_be_conducted'];
                        $selectsql =  'SELECT id,fi_to_be_conducted, bank_name,code FROM `upload_file` 
                        where code = "' . $agent_code . '" and bank_name = "' . $bank_name . '" and fi_to_be_conducted = "' . $fi_to_be_conducted . '" and status = "inactive"';
                        // print_r($selectsql);die;
                        // echo "<br/>";
                        $query = $this->db->query($selectsql);
                        $res_data = $query->result_array();
                        $val['res_data'] = $res_data;
                        array_push($data_json, $val);
                    }
                }
                $response = [
                    'status' => "success",
                    'data' => $data_json,
                ];
                // $response = $data;
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Input method should be in post",
                ];
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
    }


    public function miniCaseBankType()
    {

        $response = [];
        try {
            $data_json = [];

            if ($this->input->method() == "post") {
                $agent_code = $this->input->post('code');

                // $sql = 'SELECT application_id,fi_to_be_conducted, COUNT(1) count, bank_name,code FROM `upload_file` 
                // WHERE agent_code = "' . $agent_code . '  GROUP BY bank"';
                $sql =  'SELECT fi_type, COUNT(1) total, bank FROM `mini_case` 
                where code = "' . $agent_code . '" and status = "inactive" GROUP BY bank, fi_type
                ORDER BY `mini_case`.`bank` DESC';
                // print_r($sql);die;
                // echo "<br/>";
                // die;
                $query = $this->db->query($sql);
                $data = $query->result_array();
                if ($data) {
                    foreach ($data as $key => $val) {
                        $res_data = [];
                        $bank_name = $val['bank'];
                        $fi_type = $val['fi_type'];
                        $selectsql =  'SELECT id,fi_type, bank,code FROM `mini_case` 
                        where code = "' . $agent_code . '" and bank = "' . $bank_name . '" and fi_type = "' . $fi_type . '" and status = "inactive"';
                        // print_r($selectsql);die;
                        // echo "<br/>";
                        $query = $this->db->query($selectsql);
                        $res_data = $query->result_array();
                        $val['res_data'] = $res_data;
                        array_push($data_json, $val);
                    }
                }
                $response = [
                    'status' => "success",
                    'data' => $data_json,
                ];
                // $response = $data;
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Input method should be in post",
                ];
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
    }




    public function getMainCaseNotification()
    {
        $response = [];
        try {
            if ($this->input->method() == "post") {
                // $application_id = $this->input->post('application_id');
                $employee_code = $this->input->post('employee_code');
                $sql = 'SELECT * FROM main_case_push_notification WHERE employee_code = "' . $employee_code . '" and status = "unseen"';
                $query = $this->db->query($sql);
                $data = $query->result_array();
                $response = [
                    'status' => "success",
                    'data' => $data,
                ];
                // $response = $data;
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Input method should be in post",
                ];
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
    }

    public function getQuickCaseNotification()
    {
        $response = [];
        try {
            if ($this->input->method() == "post") {
                // $application_id = $this->input->post('application_id');
                $employee_code = $this->input->post('employee_code');
                $sql = 'SELECT * FROM mini_case_push_notification WHERE employee_code = "' . $employee_code . '" and status = "unseen"';
                $query = $this->db->query($sql);
                $data = $query->result_array();
                $response = [
                    'status' => "success",
                    'data' => $data,
                ];
                // $response = $data;
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Input method should be in post",
                ];
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $response = [
                'status' => "failure",
                'message' => $ex->getMessage(),
            ];
        }
    }


    public function insertQuickCaseNotification()
    {
        $response = array();
        try {
            // if ($this->input->method() == "post") {
            $reference_no = $this->input->post('reference_no');
            $case_id = $this->input->post('case_id');


            // print_r($data);die;
            if (!empty($reference_no)) {

                $insertQuick = array(
                    'status' => "seen",
                );
                $this->db->where('reference_no', $reference_no);
                $this->db->where('case_id', $case_id);
                $this->db->update('mini_case_push_notification', $insertQuick);

                if ($this->db->affected_rows() > 0) {
                    $response = [
                        'status' => "success",
                        'message' => "Quick Case Notification Status inserted successfully",
                    ];
                } else {
                    $response = [
                        'status' => "failure",
                        'message' => "Data insertion failed",
                    ];
                }
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Reference number not match",
                ];
            }
        } catch (Exception $ex) {
            $response = [
                'status' => "failed",
                'message' => $ex->getMessage(),
            ];
        }
        echo json_encode($response);
    }


    public function insertMainCaseNotification()
    {
        $response = array();
        try {
            // if ($this->input->method() == "post") {
            $application_id = $this->input->post('application_id');
            $case_id = $this->input->post('case_id');

            // print_r($data);die;
            if (!empty($application_id)) {

                $insertMain = array(
                    'status' => "seen",
                );
                $this->db->where('application_id', $application_id);
                $this->db->where('case_id', $case_id);
                $this->db->update('main_case_push_notification', $insertMain);

                if ($this->db->affected_rows() > 0) {
                    $response = [
                        'status' => "success",
                        'message' => "Main Case Notification Status inserted successfully",
                    ];
                } else {
                    $response = [
                        'status' => "failure",
                        'message' => "Data insertion failed",
                    ];
                }
            } else {
                $response = [
                    'status' => "failure",
                    'message' => "Application Id not match",
                ];
            }
        } catch (Exception $ex) {
            $response = [
                'status' => "failed",
                'message' => $ex->getMessage(),
            ];
        }
        echo json_encode($response);
    }



    //  public function getUploadFileCount(){
    // try {
    //      if ($this->input->method() == "post") {
    //           $agent_code = $this->input->post('code');

    //              $this->db->select('COUNT(id) as outoftat_total, code');
    //         $this->db->from('upload_file');
    //         $this->db->where("code", $agent_code); // Add the condition here
    //         $this->db->group_start();
    //         $this->db->where('DATE(rv_visit_date)', date('Y-m-d'));
    //         $this->db->where('rv_visit_date >', 'tat_end', false);
    //         $this->db->or_where('DATE(bv_dt_of_cpv)', date('Y-m-d'));
    //         $this->db->where('bv_dt_of_cpv >', 'tat_end', false);
    //         $this->db->group_end();
    //         $query = $this->db->get();
    //         $result = $query->result_array();

    //         $response = array('outoftat_total' => $result[0]['outoftat_total'], 'code' => $result[0]['code']);
    //         $this->output
    //             ->set_content_type('application/json')
    //             ->set_output(json_encode($response));
    //      } else {
    //                 $response = [
    //                     'status' => "failure",
    //                     'message' => "Input method should be in post",
    //                 ];
    //             }
    //             // echo json_encode($response);
    //         } catch (Exception $ex) {
    //             throw $ex;
    //         }
    // }

    public function getUploadFileCount()
    {
        try {
            if ($this->input->method() == "post") {
                $agent_code = $this->input->post('code');

                $this->db->select('COUNT(id) as count');
                $this->db->from('upload_file');
                $this->db->where("code", $agent_code);
                $this->db->group_start();
                $this->db->where('DATE(rv_visit_date)', date('Y-m-d'));
                $this->db->where('rv_visit_date >', 'tat_end', false);
                $this->db->or_where('DATE(bv_dt_of_cpv)', date('Y-m-d'));
                $this->db->where('bv_dt_of_cpv >', 'tat_end', false);
                $this->db->group_end();
                $query = $this->db->get();
                $result = $query->row_array();

                $count = $result['count'];
            } else {
                $count = 0; // Default count if the request method is not POST
            }
        } catch (Exception $ex) {
            $count = 0; // Default count if there's an exception
        }

        echo $count;
    }

    public function getCaseCountByAgent()
    {
        try {
            if ($this->input->method() == "post") {
                $agent_code = $this->input->post('code');

                $this->db->select('COUNT(id) as case_count');
                $this->db->from('upload_file');
                $this->db->where('code', $agent_code);
                // $this->db->where('DATE(created_at)', date('Y-m-d'));
                // $this->db->where('status', 'Resolved');
                $query = $this->db->get();
                $result = $query->row_array();

                $case_count = $result['case_count'];
                // print_r($case_count);die;
            } else {
                $case_count = 1; // Default case count if the request method is not POST
            }
        } catch (Exception $ex) {
            $case_count = 2; // Default case count if there's an exception
        }

        echo $case_count;
    }



    //  public function miniCaseBankType()
    //     {

    //         $response = [];
    //         try {
    //             $data_json = [];

    //             if ($this->input->method() == "post") {
    //                 $agent_code = $this->input->post('code');
    //                 $fi_type = $this->input->post('fi_type');
    //                 $bank = $this->input->post('bank');
    //                 // $sql = 'SELECT application_id,fi_to_be_conducted, COUNT(1) count, bank_name,code FROM `upload_file` 
    //                 // WHERE agent_code = "' . $agent_code . '  GROUP BY bank"';
    //                 $sql =  'SELECT fi_type, COUNT(1) total, bank FROM `mini_case` 

    //                 where code = "' . $agent_code . '" and status = "inactive" GROUP BY bank, fi_type
    //                 ORDER BY `mini_case`.`bank` DESC';
    //                 // print_r($sql);die;
    //                 // echo "<br/>";
    //                 // die;
    //                 $query = $this->db->query($sql);
    //                 $data = $query->result_array();
    //                 if ($data) {
    //                     foreach ($data as $key => $val) {
    //                         $res_data = [];
    //                         $bank_name = $val['bank'];
    //                         $fi_type = $val['fi_type'];
    //                         $selectsql =  'SELECT id,fi_type, bank,code FROM `mini_case` 
    //                         where code = "' . $agent_code . '" and bank = "' . $bank . '" and fi_type = "' . $fi_type . '" and status = "inactive"';
    //                         // print_r($selectsql);die;
    //                         // echo "<br/>";
    //                         $query = $this->db->query($selectsql);
    //                         $res_data = $query->result_array();
    //                         $val['res_data'] = $res_data;
    //                         array_push($data_json, $val);
    //                     }
    //                 }
    //                 $response = [
    //                     'status' => "success",
    //                     'data' => $data_json,
    //                 ];
    //                 // $response = $data;
    //             } else {
    //                 $response = [
    //                     'status' => "failure",
    //                     'message' => "Input method should be in post",
    //                 ];
    //             }
    //             echo json_encode($response);
    //         } catch (Exception $ex) {
    //             $response = [
    //                 'status' => "failure",
    //                 'message' => $ex->getMessage(),
    //             ];
    //         }
    //     }

    // public function insertMainCases()
    // {
    //     $response = array();
    //     try {
    //         // if ($this->input->method() == "post") {
    //         $application_id = $this->input->post('application_id');
    //         $fi_status = $this->input->post('fi_status');
    //         $make_model = $this->input->post('make_model');
    //         $loan_amt = $this->input->post('loan_amt');
    //         $confirm_address = $this->input->post('confirm_address');
    //         $person_met_details = $this->input->post('person_met_details');
    //         $relationship = $this->input->post('relationship');
    //         $residence_ownership = $this->input->post('residence_ownership');
    //         $stability = $this->input->post('stability');
    //         $user_permanent_address = $this->input->post('user_permanent_address');
    //         $rent_per_month = $this->input->post('rent_per_month');
    //         $total_family_member = $this->input->post('total_family_member');
    //         $no_of_earning_members = $this->input->post('no_of_earning_members');
    //         $details_of_earning_member = $this->input->post('details_of_earning_member');
    //         $dependent = $this->input->post('dependent');
    //         $user_office_address = $this->input->post('user_office_address');
    //         $residence_proof = $this->input->post('residence_proof');
    //         $agriculture_land = $this->input->post('agriculture_land');
    //         $exterior_premises = $this->input->post('exterior_premises');
    //         $interior_premises = $this->input->post('interior_premises');
    //         $image1 = $this->input->post('image1');
    //         $image2 = $this->input->post('image2');
    //         $image3 = $this->input->post('image3');
    //         $image4 = $this->input->post('image4');
    //         $image5 = $this->input->post('image5');
    //         $image6 = $this->input->post('image6');
    //         $image7 = $this->input->post('image7');
    //         $image8 = $this->input->post('image8');
    //         $image9 = $this->input->post('image9');

    //         // print_r($data);die;
    //         if (!empty($application_id)) {

    //             $insertcase = array(
    //                 'make_model' => $make_model,
    //                 'fi_status' => $fi_status,
    //                 'loan_amt' => $loan_amt,
    //                 'confirm_address' => $confirm_address,
    //                 'person_met_details' => $person_met_details,
    //                 'relationship' => $relationship,
    //                 'residence_ownership' => $residence_ownership,
    //                 'stability' => $stability,
    //                 'user_permanent_address' => $user_permanent_address,
    //                 'rent_per_month' => $rent_per_month,
    //                 'total_family_member' => $total_family_member,
    //                 'no_of_earning_members' => $no_of_earning_members,
    //                 'details_of_earning_member' => $details_of_earning_member,
    //                 'dependent' => $dependent,
    //                 'user_office_address' => $user_office_address,
    //                 'residence_proof' => $residence_proof,
    //                 'agriculture_land' => $agriculture_land,
    //                 'exterior_premises' => $exterior_premises,
    //                 'interior_premises' => $interior_premises,
    //                 'image1' => $image1,
    //                 'image2' => $image2,
    //                 'image3' => $image3,
    //                 'image4' => $image4,
    //                 'image5' => $image5,
    //                 'image6' => $image6,
    //                 'image7' => $image7,
    //                 'image8' => $image8,
    //                 'image9' => $image9,
    //                 'status' => "active",
    //             );
    //             $this->db->where('application_id', $application_id);
    //             $this->db->update('upload_file', $insertcase);

    //             if ($this->db->affected_rows() > 0) {
    //                 $response = [
    //                     'status' => "success",
    //                     'message' => "Data inserted successfully",
    //                 ];
    //             } else {
    //                 $response = [
    //                     'status' => "failure",
    //                     'message' => "Data insertion failed",
    //                 ];
    //             }
    //         } else {
    //             $response = [
    //                 'status' => "failure",
    //                 'message' => "Application number not match",
    //             ];
    //         }

    //     } catch (Exception $ex) {
    //         $response = [
    //             'status' => "failed",
    //             'message' => $ex->getMessage(),
    //         ];
    //     }
    //     echo json_encode($response);
    // }
}
