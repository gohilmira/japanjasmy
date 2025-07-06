<?php
class Invest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->conn->plan_setting('invest_section') != 1) {
            $panel_path = $this->conn->company_info('panel_path');
            redirect(base_url($panel_path . '/dashboard'));
            $this->currency = $this->conn->company_info('currency');
        }
        $this->panel_url = $this->conn->company_info('panel_path');
    }

    public function investment()
    {
        //  $this->show->user_panel('coming_soon');
        $u_Code = $this->session->userdata('user_id');
        $csrf_test_name = json_encode($_POST);
        if (isset($_POST['topup_btn'])) {

            $pinvalidation = '';
            // $check_ex=$this->conn->runQuery('id','form_request',"request='$csrf_test_name' and u_code='$u_Code'");
            // if($check_ex){
            // //   $this->session->set_flashdata("error", "You can not submit same request within 5 minutes.");
            //      redirect($_SERVER["HTTP_REFERER"]);
            // }else{
            $request['u_code'] = $u_Code;
            $request['request'] = $csrf_test_name;
            $this->db->insert('form_request', $request);

            if ($this->conn->setting('topup_type') == 'amount') {
                $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required|callback_check_wallet_balance');
            } elseif ($this->conn->setting('topup_type') == 'pin') {
                $pinvalidation = "|callback_check_pin_available";
            }

            $this->form_validation->set_rules('tx_username', 'Username', 'required|callback_valid_username|callback_already_topup');
            $this->form_validation->set_rules('selected_pin', 'Package', "required");

            $invest_toup_with_otp = $this->conn->setting('invest_toup_with_otp');
            if ($invest_toup_with_otp == 'yes') {
                $this->form_validation->set_rules('otp_input1', 'OTP', 'required|trim|callback_check_otp_valid');
            }

            if ($this->form_validation->run() != False) {
                $mx_id = $this->conn->runQuery('MAX(active_id) as mx', 'users', "active_status='1'")[0]->mx;
                $active_id = ($mx_id ? $mx_id : 0) + 1;

                $currenct_payout_id = $this->wallet->currenct_payout_id();
                $tx_username = $_POST['tx_username'];
                $tx_u_code = $this->profile->id_by_username($tx_username);
                $pin_type = $_POST['selected_pin'];
                $pin_details = $this->pin->pin_details($pin_type);
                $token = $this->conn->company_info('token_rate');

                $orders['u_code'] = $tx_u_code;
                $orders['tx_type'] = 'purchase';
                $orders['order_amount'] = $pin_details->pin_rate;
                $orders['order_bv'] = $pin_details->pin_rate;
                $orders['pv'] = $pin_details->pin_value;
                $orders['status'] = 1;
                $orders['payout_id'] = $currenct_payout_id;
                $orders['payout_status'] = 0;
                $orders['active_id'] = $active_id;

                if ($this->db->insert('orders', $orders)) {

                    $update = array(
                        'active_id' => $active_id,
                        'active_status' => 1,
                        'active_date' => date('Y-m-d H:i:s'),
                    );
                    $this->db->where('id', $tx_u_code);
                    $this->db->update('users', $update);

                    $this->db->set('active_id', $active_id);
                    $this->db->where('u_code', $tx_u_code);
                    $this->db->update('user_wallets');

                    if ($this->conn->setting('topup_type') == 'amount') {
                        $username = $this->session->userdata('profile')->username;

                        $transaction['u_code'] = $this->session->userdata('user_id');
                        $transaction['tx_u_code'] = $tx_u_code;
                        $transaction['tx_type'] = "topup";
                        $transaction['debit_credit'] = "debit";
                        // $transaction['wallet_type'] = $_POST['selected_wallet'];
                        $transaction['amount'] = $pin_details->pin_rate;
                        $transaction['date'] = date('Y-m-d H:i:s');
                        $transaction['status'] = 1;
                        // $transaction['open_wallet'] = $this->update_ob->wallet($this->session->userdata('user_id'), $_POST['selected_wallet']);
                        // $transaction['closing_wallet'] = $transaction['open_wallet'] - $transaction['amount'];
                        $transaction['remark'] = "$username topup $tx_username of amount $pin_details->pin_rate";

                        if ($this->db->insert('transaction', $transaction)) {
                            // $amnt = $transaction['amount'];
                            // $this->update_ob->add_amnt($this->session->userdata('user_id'), $_POST['selected_wallet'], -$amnt);
                        }
                    } elseif ($this->conn->setting('topup_type') == 'pin') {
                        $pin_update_details = $this->pin->user_pins_by_type($this->session->userdata('user_id'), $pin_type);
                        $pin_id = $pin_update_details[0]->id;
                        $update_details['use_status'] = 1;
                        $update_details['used_in'] = 'topup';
                        $update_details['usefor'] = $tx_u_code;
                        $this->db->where('id', $pin_id);
                        $this->db->update('epins', $update_details);


                        $cnt_tx_pre_pins = ($pin_update_details ? count($pin_update_details) : 0);

                        $pin_history['user_id'] = $this->session->userdata('user_id');
                        $pin_history['debit'] = 1;
                        $pin_history['prev_pin'] = $cnt_tx_pre_pins;
                        $pin_history['curr_pin'] = $cnt_tx_pre_pins - 1;
                        $pin_history['pin_type'] = $pin_details->pin_type;
                        $pin_history['tx_type'] = 'debit';
                        $name = $this->session->userdata('profile')->name;
                        $username = $this->session->userdata('profile')->username;
                        $pin_history['remark'] = "$name ( $username ) Topup $tx_username ";
                        $this->db->insert('pin_history', $pin_history);

                        $this->update_ob->used_pin($this->session->userdata('user_id'));
                    }

                    if ($this->conn->setting('level_distribution_on_topup') == 'yes') {
                        $this->distribute->level_destribute($tx_u_code, $pin_details->pin_rate, 1);
                    }


                    $sponsor_info = $this->profile->sponsor_info($tx_u_code, 'mobile,id');

                    if ($sponsor_info) {
                        $sponsor_mobile = $sponsor_info->mobile;
                        $tx_profile_info = $this->profile->profile_info($tx_u_code, 'name');
                        $tx_name = $tx_profile_info->name;
                        $website = $this->conn->company_info('title');
                        $msg = "Congratulations!! $tx_name Has activated his Position. Team $website";
                        //$this->message->sms($sponsor_mobile,$msg);
                        $this->update_ob->active_gen($sponsor_info->id);
                        $this->update_ob->active_direct($sponsor_info->id);
                    }

                    if ($this->conn->plan_setting('matrix') == '1') {
                        $this->distribute->gen_pool($tx_u_code, $pin_details->pin_rate, $pin_details->pool_type, $pin_details->pin_type);
                    }

                    $plan_type = $this->session->userdata('reg_plan');
                    if ($plan_type == 'single_leg') {
                        $this->update_ob->update_single_leg($tx_u_code, $active_id);
                    }



                    $this->session->set_flashdata("success", "Package $pin_details->pin_type Activated successfully.");
                    redirect(base_url(uri_string()));
                } else {
                    $this->session->set_flashdata("error", "Something wrong.");
                }
            }
            // }
        }


        $this->show->user_panel('invest_topup');
    }


    public function invest_request()
    {

        $username = $_POST['tx_username'];
        $hash = $_POST['hash'];
        $check_exists = $this->conn->runQuery('*', 'topup_requests', "hash='$hash'");
        $user_address = $this->conn->runQuery('user_address', 'users', "username='$username'")[0]->user_address;
        // echo "<br>useraddress---".$user_address;die;
        $res['error'] = true;
        if (!$check_exists) {
            $selected_pin = $_POST['selected_pin'];
            $contractAddress_busd = $_POST['contractAddress_busd'];
            $pin_details = $this->pin->pin_details($selected_pin);
            // echo  $pin_details->roi; die;
            $amount = $_POST['amount'];
            $invester_address = $user_address;

            $insert = array();
            $insert['u_code'] = $this->session->userdata('user_id');
            $insert['hash'] = $hash;
            $insert['username'] = $username;
            $insert['invester_address'] = $invester_address;
            $insert['amount'] = $amount;
            $insert['selected_pin'] = $selected_pin;
            $insert['tx_type'] = 'repurchase';
            $insert['contractAddress_busd'] = $contractAddress_busd;
            $insert['created'] = date('Y-m-d H:i:s');
            //   print_r($insert); die;
            $this->db->insert('topup_requests', $insert);
            // $this->fetch_trx();
            $res['error'] = false;
            $res['message'] = "Topup request generated.Please wait for activation ";
        } else {
            $res['message'] = "Request already generated.";
        }
        print_r(json_encode($res));
    }


    public function boost_invest_request()
    {

        $username = $_POST['tx_username'];
        $hash = $_POST['hash'];
        $check_exists = $this->conn->runQuery('*', 'topup_requests', "hash='$hash'");
        $user_address = $this->conn->runQuery('user_address', 'users', "username='$username'")[0]->user_address;
        $res['error'] = true;
        if (!$check_exists) {
            $selected_pin = $_POST['selected_pin'];
            $contractAddress_busd = $_POST['contractAddress_busd'];

            $amount = $_POST['amount'];
            $invester_address = $user_address;

            $insert = array();
            $insert['u_code'] = $this->session->userdata('user_id');
            $insert['hash'] = $hash;
            $insert['username'] = $username;
            $insert['invester_address'] = $invester_address;
            $insert['amount'] = $amount;
            $insert['selected_pin'] = $selected_pin;
            $insert['tx_type'] = 'purchase';
            $insert['contractAddress_busd'] = $contractAddress_busd;
            $insert['created'] = date('Y-m-d H:i:s');
            $this->db->insert('topup_requests', $insert);
            $res['error'] = false;
            $res['message'] = "Topup request generated.Please wait for activation ";
        } else {
            $res['message'] = "Request already generated.";
        }
        print_r(json_encode($res));
    }

    public function invest_condition()
    {

        if (isset($_POST['tx_username']) && $_POST['tx_username'] != '') {
            $username = $_POST['tx_username'];
            $check_username = $this->conn->runQuery("id,active_status", 'users', "username='$username'");
            if ($check_username) {
                if (isset($_POST['selected_pin']) && $_POST['selected_pin'] != '') {
                    $select_pin = $_POST['selected_pin'];

                    //$roi_per=$check_username[0]->roi_per;
                    $u_codess = $check_username[0]->id;
                    $active_statuss = $check_username[0]->active_status;
                    if (1 == 1) {
                        $check_select = $this->conn->runQuery("id", 'pin_details', "pin_type='$select_pin' and status=1");
                        // print_r($_POST); die;
                        if ($check_select) {
                            if (isset($_POST['amount']) && $_POST['amount'] != '') {
                                $amt = $_POST['amount'];

                                // $token_rate=$this->conn->company_info('token_rate');
                                $amt1 = $amt;
                                // 			if($amt>=$min_amt && $amt<=$max_amt){
                                //if($amt>=500){


                                $res['error'] = false;
                                $res['msg'] = "Success";


                                //                         }else{								
                                // 				$res['error']=true;            
                                // 				$res['msg']="Invalid Package! Amount Minimum $min_amt and Maximum $max_amt.";
                                // 			}
                            } else {
                                $res['error'] = true;
                                $res['msg'] = "Invalid Amount";
                            }
                        } else {
                            $res['error'] = true;
                            $res['msg'] = "Invalid Package";
                        }
                    } else {
                        $res['error'] = true;
                        $res['msg'] = "User already active";
                    }
                } else {
                    $res['error'] = true;
                    $res['msg'] = "Invalid Package";
                }
            } else {
                $res['error'] = true;
                $res['msg'] = "This User already stake!";
            }
        } else {
            $res['error'] = true;
            $res['msg'] = "Empty Username";
        }

        print_r(json_encode($res));
    }
    public function boost_invest_condition()
    {

        if (isset($_POST['tx_username']) && $_POST['tx_username'] != '') {
            $username = $_POST['tx_username'];
            $check_username = $this->conn->runQuery("id,active_status", 'users', "username='$username'");
            if ($check_username) {
                if (isset($_POST['selected_pin']) && $_POST['selected_pin'] != '') {
                    $select_pin = $_POST['selected_pin'];
                    //$roi_per=$check_username[0]->roi_per;
                    $u_codess = $check_username[0]->id;
                    $active_statuss = $check_username[0]->active_status;
                    if (1 == 1) {
                        $check_select = $this->conn->runQuery("id", 'pin_details', "pin_type='$select_pin' and status=1");
                        if ($check_select) {
                            if (isset($_POST['amount']) && $_POST['amount'] != '') {
                                $amt = $_POST['amount'];

                                // $token_rate=$this->conn->company_info('token_rate');
                                $amt1 = $amt;
                                // 			if($amt>=$min_amt && $amt<=$max_amt){
                                //if($amt>=500){


                                $res['error'] = false;
                                $res['msg'] = "Success";


                                //                         }else{								
                                // 				$res['error']=true;            
                                // 				$res['msg']="Invalid Package! Amount Minimum $min_amt and Maximum $max_amt.";
                                // 			}
                            } else {
                                $res['error'] = true;
                                $res['msg'] = "Invalid Amount";
                            }
                        } else {
                            $res['error'] = true;
                            $res['msg'] = "Invalid Package";
                        }
                    } else {
                        $res['error'] = true;
                        $res['msg'] = "User already active";
                    }
                } else {
                    $res['error'] = true;
                    $res['msg'] = "Invalid Package";
                }
            } else {
                $res['error'] = true;
                $res['msg'] = "This User already stake!";
            }
        } else {
            $res['error'] = true;
            $res['msg'] = "Empty Username";
        }

        print_r(json_encode($res));
    }
    public function investment_new()
    {
       

                
             $username = $_POST['tx_username'];
            $selected_pin = $_POST['selected_pin'];
            //$hash = $panding_data->hash;
            // $userAddress = $panding_data->invester_address;
            $amount = $_POST['amount'];
            // $roi = $panding_data->roi;
            // $capping = $panding_data->capping;
            //$deposit_type = $panding_data->deposit_type;
            if ($username != '') {
                // echo "<br><br>id===". $id;die;
               
                $check_username = $this->conn->runQuery("id", 'users', "username='$username'");
                if ($check_username) {
                    
                    if ($selected_pin != '') {

                        $check_select = $this->conn->runQuery("id", 'pin_details', "pin_type='$selected_pin' and status=1");

                        if ($check_select) {

                            if ($amount != '') {
                                $amt = $amount;
                               
                                $check_username_staus = $this->conn->runQuery("id", 'users', "username='$username' and active_status=0");
                                if ($check_username_staus) {
                                    $st = "yes";
                                } else {
                                    $st = "no";
                                }

                                if ($st == "yes") {

                                    $mx_id = $this->conn->runQuery('MAX(active_id) as mx', 'users', "active_status='1'")[0]->mx;
                                    $active_id = ($mx_id ? $mx_id : 0) + 1;
                                    $tx_ty = "purchase";
                                    $tiktok = 0;
                                } else {
                                    $active_id = 0;
                                    $tx_ty = "repurchase";
                                    $tiktok = 1;
                                }
                                echo "<br><br>id===". $tx_ty;
                               
                                $currenct_payout_id = $this->wallet->currenct_payout_id();
                                $tx_username = $username;
                                $tx_u_code = $this->profile->id_by_username($tx_username);
                                $pin_type = $selected_pin;
                                ///	$userAddr=$userAddress;								
                                //$txhash = $hash;


                                $pin_details = $this->pin->pin_details($selected_pin);
                                print_r($pin_details);
                                $amount = $amount;
                                $orders['u_code'] = $tx_u_code;
                                $orders['tx_type'] = $tx_ty;
                                $orders['order_amount'] =  $amount;
                                $orders['order_bv'] = $amount;
                                $orders['roi'] =  $pin_details->roi;
                                $orders['pv'] =  $pin_details->pin_value;
                                $orders['times'] =  $pin_details->times;
                                $orders['status'] = 1;
                                $orders['payout_id'] = $currenct_payout_id;
                                $orders['payout_status'] = 0;
                                $orders['active_id'] = $active_id;
                                $orders['added_on'] = date('Y-m-d H:i:s');

                               
                                if ($this->db->insert('orders', $orders)) {

                                    if ($st == "yes") {
                                        $update = array(

                                            'active_id' => $active_id,
                                            'active_status' => 1,
                                            'active_date' => date('Y-m-d H:i:s'),
                                        );
                                        $this->db->where('id', $tx_u_code);
                                        $this->db->update('users', $update);

                                        $this->db->set('active_id', $active_id);
                                        $this->db->where('u_code', $tx_u_code);
                                        $this->db->update('user_wallets');
                                    }

                                    if ($this->conn->setting('topup_type') == 'amount') {
                                        $username = $this->session->userdata('profile')->username;

                                        $transaction['u_code'] = $tx_u_code;
                                        $transaction['tx_u_code'] = $tx_u_code;
                                        $transaction['tx_type'] = $tx_ty;
                                        $transaction['debit_credit'] = "debit";
                                        // $transaction['wallet_type'] = $_POST['selected_wallet'];
                                        $transaction['amount'] =  $amount;
                                        $transaction['date'] = date('Y-m-d H:i:s');
                                        $transaction['status'] = 1;
                                        $transaction['remark'] = "$username topup $tx_username of amount  $amount";
                                        if ($this->db->insert('transaction', $transaction)) {
                                            $amnt = $transaction['amount'];
                                             $this->update_ob->add_amnt($this->session->userdata('user_id'), 'fund_wallet', -$amnt);
                                        }
                                        
                                    } elseif ($this->conn->setting('topup_type') == 'pin') {
                                        $pin_update_details = $this->pin->user_pins_by_type($id, $pin_type);
                                        $pin_id = $pin_update_details[0]->id;
                                        $update_details['use_status'] = 1;
                                        $update_details['used_in'] = 'retopup';
                                        $update_details['usefor'] = $tx_u_code;
                                        $this->db->where('id', $pin_id);
                                        $this->db->update('epins', $update_details);

                                        $cnt_tx_pre_pins = ($pin_update_details ? count($pin_update_details) : 0);

                                        $pin_history['user_id'] = $id;
                                        $pin_history['debit'] = 1;
                                        $pin_history['prev_pin'] = $cnt_tx_pre_pins;
                                        $pin_history['curr_pin'] = $cnt_tx_pre_pins - 1;
                                        $pin_history['pin_type'] = $pin_details->pin_type;
                                        $pin_history['tx_type'] = 'debit';
                                        $name = $this->session->userdata('profile')->name;
                                        $username = $this->session->userdata('profile')->username;
                                        $pin_history['remark'] = "$name ( $username ) Topup $tx_username ";
                                        $this->db->insert('pin_history', $pin_history);

                                        $this->update_ob->used_pin($id);
                                    }


                                    $sponsor_info = $this->profile->sponsor_info($tx_u_code, 'mobile,id');

                                    if ($st == "yes") {


                                        if ($sponsor_info) {
                                            $sponsor_mobile = $sponsor_info->mobile;
                                            $tx_profile_info = $this->profile->profile_info($tx_u_code, 'name');
                                            $tx_name = $tx_profile_info->name;
                                            $website = $this->conn->company_info('title');
                                            $msg = "Congratulations!! $tx_name Has activated his Position. Team $website";
                                            //$this->message->sms($sponsor_mobile,$msg);
                                            $this->update_ob->active_gen($sponsor_info->id);
                                            $this->update_ob->active_direct($sponsor_info->id);
                                        }
                                    }

                                    if ($this->conn->setting('level_distribution_on_topup') == 'yes') {
                                        $this->distribute->level_destribute($tx_u_code, $amount, 5);
                                       
                                    }
                           
                                    $sponsor_info = $this->profile->sponsor_info($tx_u_code, 'mobile,id');
                                    if ($this->conn->setting('reg_type') == 'binary') {
                                        $this->update_ob->update_binary($sponsor_info->id);
                                    }

                                    $plan_type = $this->session->userdata('reg_plan');
                                    if ($plan_type == 'single_leg') {
                                        $this->update_ob->update_single_leg($tx_u_code, $active_id);
                                    }
                                       

                                    $res['error'] = false;
                                    $res['msg'] = "Activation Success";


                                } else {
                                    $res['error'] = true;
                                    $res['msg'] = "Invalid Amount";
                                }
                            } else {

                                $res['error'] = true;
                                $res['msg'] = "Invalid Package! Please select valid package.";
                            }
                        } else {

                            $res['error'] = true;
                            $res['msg'] = "Invalid Package";
                        }
                    } else {
                        $res['error'] = true;
                        $res['msg'] = "Invalid Username";
                    }
                } else {
                    $res['error'] = true;
                    $res['msg'] = "Invalid Address";
                }
            }

            $result = json_encode($res);
            return $result;
        
    }
    public function boost_investment_new($id)
    {
        $panding_data1 = $this->conn->runQuery('*', 'topup_requests', "id=$id");

        echo "<br>panding data====" . print_r($panding_data1, true);


        if ($panding_data1) {
            echo "<br>id===" . $id;
            $panding_data = $panding_data1[0];
            $username = $panding_data->username;
            $selected_pin = $panding_data->selected_pin;
            $hash = $panding_data->hash;
            // $userAddress = $panding_data->invester_address;
            $amount = $panding_data->amount;
            //$deposit_type = $panding_data->deposit_type;

            if ($username != '') {

                $check_username = $this->conn->runQuery("id", 'users', "username='$username'");
                if ($check_username) {

                    if ($selected_pin != '') {

                        $check_select = $this->conn->runQuery("id", 'pin_details', "pin_type='$selected_pin' and status=1");

                        if ($check_select) {

                            if ($amount != '') {
                                $amt = $amount;

                                $check_username_staus = $this->conn->runQuery("id", 'users', "username='$username' and active_status=0");

                                echo "<br><br>username===" . $username;
                                echo "<br>amount===" . $amount;


                                if ($check_username_staus) {
                                    $st = "yes";
                                } else {
                                    $st = "no";
                                }

                                if ($st == "yes") {

                                    $mx_id = $this->conn->runQuery('MAX(active_id) as mx', 'users', "active_status='1'")[0]->mx;
                                    $active_id = ($mx_id ? $mx_id : 0) + 1;
                                    $tx_ty = "topup";
                                } else {
                                    $active_id = 0;
                                    $tx_ty = "retopup";
                                }
                                $currenct_payout_id = $this->wallet->currenct_payout_id();
                                $tx_username = $username;
                                $tx_u_code = $this->profile->id_by_username($tx_username);
                                $pin_type = $selected_pin;
                                $pin_details = $this->pin->pin_details($selected_pin);
                                $amount = $amount;

                                $orders['u_code'] = $tx_u_code;
                                $orders['tx_type'] = "purchase";
                                $orders['order_amount'] = $amount;
                                $orders['order_bv'] = $amount;
                                $orders['pv'] = $pin_details->pin_value;
                                $orders['status'] = 1;
                                $orders['payout_id'] = $currenct_payout_id;
                                $orders['payout_status'] = 1;
                                $orders['active_id'] = $active_id;
                                $orders['added_on'] = date('Y-m-d H:i:s');

                                if ($this->db->insert('orders', $orders)) {

                                    if ($st == "yes") {
                                        $update = array(

                                            'active_id' => $active_id,
                                            'active_status' => 1,
                                            'active_date' => date('Y-m-d H:i:s'),
                                        );
                                        $this->db->where('id', $tx_u_code);
                                        $this->db->update('users', $update);

                                        $this->db->set('active_id', $active_id);
                                        $this->db->where('u_code', $tx_u_code);
                                        $this->db->update('user_wallets');
                                    }

                                    if ($this->conn->setting('topup_type') == 'amount') {
                                        $username = $this->session->userdata('profile')->username;

                                        $transaction['u_code'] = $this->session->userdata('user_id');
                                        $transaction['tx_u_code'] = $tx_u_code;
                                        $transaction['tx_type'] = "topup";
                                        $transaction['debit_credit'] = "debit";
                                        $transaction['wallet_type'] = 'main_wallet';
                                        $transaction['amount'] = $amount;
                                        $transaction['txs_res'] = $hash;
                                        $transaction['date'] = date('Y-m-d H:i:s');
                                        $transaction['status'] = 1;
                                        $transaction['remark'] = "$username topup $tx_username of amount $amt";
                                        $this->db->insert('transaction', $transaction);

                                    } elseif ($this->conn->setting('topup_type') == 'pin') {
                                        $pin_update_details = $this->pin->user_pins_by_type($this->session->userdata('user_id'), $pin_type);
                                        $pin_id = $pin_update_details[0]->id;
                                        $update_details['use_status'] = 1;
                                        $update_details['used_in'] = 'topup';
                                        $update_details['usefor'] = $tx_u_code;
                                        $this->db->where('id', $pin_id);
                                        $this->db->update('epins', $update_details);


                                        $cnt_tx_pre_pins = ($pin_update_details ? count($pin_update_details) : 0);

                                        $pin_history['user_id'] = $this->session->userdata('user_id');
                                        $pin_history['debit'] = 1;
                                        $pin_history['prev_pin'] = $cnt_tx_pre_pins;
                                        $pin_history['curr_pin'] = $cnt_tx_pre_pins - 1;
                                        $pin_history['pin_type'] = $pin_details->pin_type;
                                        $pin_history['tx_type'] = 'debit';
                                        $name = $this->session->userdata('profile')->name;
                                        $username = $this->session->userdata('profile')->username;
                                        $pin_history['remark'] = "$name ( $username ) Topup $tx_username ";
                                        $this->db->insert('pin_history', $pin_history);

                                        $this->update_ob->used_pin($this->session->userdata('user_id'));
                                    }

                                    if ($this->conn->setting('level_distribution_on_topup') == 'yes') {
                                        $this->distribute->level_destribute($tx_u_code, $amount, 1);
                                    }

                                    $sponsor_info = $this->profile->sponsor_info($tx_u_code, 'mobile,id');

                                    if ($st == "yes") {

                                        if ($sponsor_info) {
                                            $sponsor_mobile = $sponsor_info->mobile;
                                            $tx_profile_info = $this->profile->profile_info($tx_u_code, 'name');
                                            $tx_name = $tx_profile_info->name;
                                            $website = $this->conn->company_info('title');
                                            $msg = "Congratulations!! $tx_name Has activated his Position. Team $website";
                                            //$this->message->sms($sponsor_mobile,$msg);
                                            $this->update_ob->active_gen($sponsor_info->id);
                                            $this->update_ob->active_direct($sponsor_info->id);
                                        }
                                    }

                                    $sponsor_info = $this->profile->sponsor_info($tx_u_code, 'mobile,id');
                                    if ($this->conn->setting('reg_type') == 'binary') {
                                        $this->update_ob->update_binary($sponsor_info->id);
                                    }

                                    $plan_type = $this->session->userdata('reg_plan');
                                    if ($plan_type == 'single_leg') {
                                        $this->update_ob->update_single_leg($tx_u_code, $active_id);
                                    }

                                    $res['error'] = false;
                                    $res['msg'] = "Activation Success";

                                } else {
                                    $res['error'] = true;
                                    $res['msg'] = "Invalid Amount";
                                }
                            } else {

                                $res['error'] = true;
                                $res['msg'] = "Invalid Package! Please select valid package.";
                            }
                        } else {

                            $res['error'] = true;
                            $res['msg'] = "Invalid Package";
                        }
                    } else {
                        $res['error'] = true;
                        $res['msg'] = "Invalid Username";
                    }
                } else {
                    $res['error'] = true;
                    $res['msg'] = "Invalid Address";
                }
            }

            $result = json_encode($res);
            return $result;
        }
    }


    public function fetch_trx()
    {
        $all_panding_te = $this->conn->runQuery('*', 'topup_requests', "status='0'");

        print_r($all_panding_te);
        if ($all_panding_te) {

            foreach ($all_panding_te as $addfundtrx) {

                $userid = $addfundtrx->u_code;
                $txid = $addfundtrx->id;
                $amnt = $addfundtrx->amount;
                $hash = $addfundtrx->hash;
                $useraddress = $addfundtrx->invester_address;
                $selected_pin = $addfundtrx->selected_pin;
                $tx_type = $addfundtrx->tx_type;
                $contractAddress_busd = $addfundtrx->contractAddress_busd;

                echo "<br>userid==" . $userid;
                echo "<br>txid==" . $txid;
                echo "<br>amnt==" . $amnt;
                echo "<br>hash==" . $hash;
                echo "<br>useraddress==" . $useraddress;
                echo "<br>contractAddress_busd==" . $contractAddress_busd . "<br>";

                $url = "https://appon3042.companywebsite.in/verify-deposits";

                $data = array(
                    "txHash" => $hash,
                    "from" => $useraddress,
                    "amount" => $amnt,
                    "to" => $contractAddress_busd,
                    "httpprovider" => "https://data-seed-prebsc-1-s1.binance.org:8545/"
                );

                $json_data = json_encode($data);

                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                $result = curl_exec($curl);

                curl_close($curl);

                $result = json_decode($result, true);
                print_r($result);
                $status = $result['status'];

                echo "<br>tx-type===" .$tx_type;

                if ($status == "success") {
                    if ($tx_type == "purchase") {
                        $result1 = $this->boost_investment_new($txid);
                        $up = array();
                        $up['status'] = 1;
                        $this->db->where('id', $txid);
                        $this->db->update('topup_requests', $up);
                        echo "topup";
                    } elseif($tx_type == "repurchase") {

                        $result1 = $this->investment_new($txid);
                        
                        $up = array();
                        $up['status'] = 1;
                        $this->db->where('id', $txid);
                        $this->db->update('topup_requests', $up);
                        echo "<br>upgrade";
                    }
                    $result_in = json_decode($result1, true);
                    if ($result_in['error'] == false) {
                        echo "ok";

                    }

                    // if ($status == "success") {

                    //     // $result1 = $this->investment_new($userid);

                    //     $result1 = $this->boost_investment_new($userid);
                    //   echo "<br>upgrade";
                    //     $up = array();
                    //         $up['status'] = 1;
                    //         $this->db->where('id', $txid);
                    //         $this->db->update('topup_requests', $up);
                    //         $res['error'] = false;
                    //     $result_in = json_decode($result1, true);
                    //     if ($result_in['error'] == false) {
                    //         echo "ok";

                    //     }
                    // }

                }
            }
        }
    }
    public function reinvestment()
    {
        //  $this->show->user_panel('coming_soon');

        if (isset($_POST['topup_btn'])) {
            $pinvalidation = '';

            if ($this->conn->setting('retopup_type') == 'amount') {
                $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required|callback_check_wallet_useable|callback_check_wallet_balance');
            } elseif ($this->conn->setting('retopup_type') == 'pin') {
                $pinvalidation = "|callback_check_pin_available";
            }


            $this->form_validation->set_rules('tx_username', 'Username', 'required|callback_valid_username|callback_check_topup');
            $this->form_validation->set_rules('selected_pin', 'Package', "required|callback_valid_package" . $pinvalidation);


            $reinvest_toup_with_otp = $this->conn->setting('reinvest_toup_with_otp');
            if ($reinvest_toup_with_otp == 'yes') {
                $this->form_validation->set_rules('otp_input1', 'OTP', 'required|trim|callback_check_otp_valid');
            }
            if ($this->form_validation->run() != False) {
                $tx_username = $_POST['tx_username'];
                $tx_u_code = $this->profile->id_by_username($tx_username);
                $pin_type = $_POST['selected_pin'];
                $pin_details = $this->pin->pin_details($pin_type);
                $currenct_payout_id = $this->wallet->currenct_payout_id();
                $token = $this->conn->company_info('token_rate');

                $orders['u_code'] = $tx_u_code;
                $orders['tx_type'] = 'repurchase';
                $orders['order_amount'] = $pin_details->pin_rate;
                $orders['order_bv'] = $pin_details->pin_rate;
                $orders['leadership_bonus_capping'] = $pin_details->leadership_bonus_capping;
                $orders['autopool_capping'] = $pin_details->autopool_capping;
                $orders['pv'] = $pin_details->pin_value;
                $orders['status'] = 1;
                $orders['payout_id'] = $currenct_payout_id;
                $orders['payout_status'] = 0;


                if ($this->db->insert('orders', $orders)) {

                    $update = array(
                        'retopup_status' => 1,
                        'retopup_date' => date('Y-m-d H:i:s'),
                    );
                    $this->db->where('id', $tx_u_code);
                    $this->db->update('users', $update);

                    if ($this->conn->setting('retopup_type') == 'amount') {
                        $username = $this->session->userdata('profile')->username;

                        $transaction['u_code'] = $this->session->userdata('user_id');
                        $transaction['tx_u_code'] = $tx_u_code;
                        $transaction['tx_type'] = "topup";
                        $transaction['debit_credit'] = "debit";
                        $transaction['amount'] = $pin_details->pin_rate;
                        $transaction['date'] = date('Y-m-d H:i:s');
                        $transaction['status'] = 1;
                        $transaction['remark'] = "$username topup $tx_username of amount $pin_details->pin_rate";

                        if ($this->db->insert('transaction', $transaction)) {
                            $amnt = $transaction['amount'];
                        }
                    } elseif ($this->conn->setting('retopup_type') == 'pin') {
                        $pin_update_details = $this->pin->user_pins_by_type($this->session->userdata('user_id'), $pin_type);
                        $pin_id = $pin_update_details[0]->id;
                        $update_details['use_status'] = 1;
                        $update_details['used_in'] = 'retopup';
                        $update_details['usefor'] = $tx_u_code;
                        $this->db->where('id', $pin_id);
                        $this->db->update('epins', $update_details);

                        $cnt_tx_pre_pins = ($pin_update_details ? count($pin_update_details) : 0);
                        $pin_history['user_id'] = $this->session->userdata('user_id');
                        $pin_history['debit'] = 1;
                        $pin_history['prev_pin'] = $cnt_tx_pre_pins;
                        $pin_history['curr_pin'] = $cnt_tx_pre_pins - 1;
                        $pin_history['pin_type'] = $pin_details->pin_type;
                        $pin_history['tx_type'] = 'debit';
                        $name = $this->session->userdata('profile')->name;
                        $username = $this->session->userdata('profile')->username;
                        $pin_history['remark'] = "$name ( $username ) Retopup $tx_username ";
                        $this->db->insert('pin_history', $pin_history);

                        $this->update_ob->used_pin($this->session->userdata('user_id'));
                    }

                    if ($this->conn->setting('level_distribution_on_topup') == 'yes') {
                        $this->distribute->level_destribute($tx_u_code, $pin_details->pin_rate, 1);

                    }

                    $this->session->set_flashdata("success", "Package $pin_details->pin_type Activated successfully.");
                    redirect(base_url(uri_string()));
                } else {
                    $this->session->set_flashdata("error", "Something wrong.");
                }
            }
        }
        $this->show->user_panel('invest_retopup');
    }


    public function valid_username($str)
    {

        $check_username = $this->conn->runQuery("id", 'users', "username='$str'");
        if ($check_username) {
            return true;
        } else {
            $this->form_validation->set_message('valid_username', "Invalid Username! Please check username.");
            return false;
        }
    }

    public function valid_package($str)
    {
        $check_username = $this->conn->runQuery("id", 'pin_details', "pin_type='$str' and status=1");
        if ($check_username) {
            return true;
        } else {
            $this->form_validation->set_message('valid_package', "Invalid Package! Please select valid package.");
            return false;
        }
    }
    public function valid_amount($str)
    {
        $user_id = $this->session->userdata('user_id');
        $order_amount = $this->conn->runQuery("order_amount", 'orders', "(tx_type= 'repurchase' OR tx_type= 'purchase') AND u_code= '$user_id'  order by id DESC")[0]->order_amount;
        $order_amount3x = $order_amount * 3;
        if ($order_amount3x >= $str) {
            return true;
        } else {
            $this->form_validation->set_message('valid_amount', "Invalid Boosting Amount! Please Enter Amount Should be 3X on last Order .");
            return false;
        }
    }

    public function valid_package_min_amount($str)
    {
        $pin_type = $_POST['selected_pin'];
        $check_username = $this->conn->runQuery("id,pin_rate,pin_rate2", 'pin_details', "pin_type='$pin_type' and status=1");
        if ($check_username) {
            $package_rate_min = $check_username[0]->pin_rate;
            if ($str >= $package_rate_min) {
                return true;
            } else {
                $this->form_validation->set_message('valid_package_min_amount', "Invalid Amount! Amount Minimum $package_rate_min $ required.");
                return false;
            }
        }
    }

    public function valid_package_max_amount($str)
    {
        $pin_type = $_POST['selected_pin'];
        $check_username = $this->conn->runQuery("id,pin_rate,pin_rate2", 'pin_details', "pin_type='$pin_type' and status=1");
        if ($check_username) {
            $package_rate_max = $check_username[0]->pin_rate2;

            if ($str <= $package_rate_max) {
                return true;
            } else {
                $this->form_validation->set_message('valid_package_max_amount', "Invalid Amount! Amount Maximum $package_rate_max $ required.");
                return false;
            }
        }
    }


    public function check_pin_available($str)
    {
        $user_pins = $this->pin->user_pins_by_type($this->session->userdata('user_id'), $str);
        if ($user_pins) {
            return true;
        } else {
            $this->form_validation->set_message('check_pin_available', "Insufficient pin in account .");
            return false;
        }
    }

    public function check_wallet_useable($str)
    {
        $available_wallets = $this->conn->setting('invest_wallets');
        $useable_wallet = json_decode($available_wallets, true);
        if (array_key_exists($str, $useable_wallet)) {
            return true;
        } else {
            $this->form_validation->set_message('check_wallet_useable', "You can not Topup from this wallet");
            return false;
        }
    }

    public function check_wallet_balance($str)
    {
        if (isset($_POST['selected_pin']) && $_POST['selected_pin'] != '') {

            $checkable = $this->pin->pin_details($_POST['selected_pin'])->pin_rate;
            $balance = $this->update_ob->wallet($this->session->userdata('user_id'), $str);
            if ($balance >= $checkable) {
                return true;
            } else {
                $this->form_validation->set_message('check_wallet_balance', "Insufficient Fund in wallet.");
                return false;
            }
        } else {
            $this->form_validation->set_message('check_wallet_balance', "Please Select valid pin.");
            return false;
        }
    }

    public function already_topup($str)
    {
        if ($str != '') {

            $chk = $this->conn->runQuery("id", 'users', "username='$str' and active_status='1'");
            if ($chk) {
                $this->form_validation->set_message('already_topup', "User already have active package.");
                return false;
            } else {
                return true;
            }
        } else {
            $this->form_validation->set_message('already_topup', "Please enter username.");
            return false;
        }
    }

    public function check_topup($str)
    {
        if ($str != '') {

            $chk = $this->conn->runQuery("id", 'users', "username='$str' and active_status='1'");
            if ($chk) {
                return true;
            } else {

                $this->form_validation->set_message('check_topup', "First topup account.");
                return false;
            }
        } else {
            $this->form_validation->set_message('check_topup', "Please enter username.");
            return false;
        }
    }

    public function pin_detail()
    {
        $type = trim($_POST['selected_pin']);
        $u_id = $this->session->userdata('user_id');
        $res = '';
        $get_pin_detail = $this->conn->runQuery('*', "epins", "pin_type LIKE '%$type%' and use_status='0' and u_code='$u_id'");
        //echo  $sql = $this->db->last_query();
        if ($get_pin_detail) {
            $res = count($get_pin_detail);
        } else {
            $res = 0;
        }
        echo $res;
    }


    public function check_otp_valid($str)
    {
        if (isset($_SESSION['otp'])) {
            if ($_SESSION['otp'] == $str) {
                return true;
            } else {
                $this->form_validation->set_message('check_otp_valid', "Incorect OTP. Please try again.");
                return false;
            }
        } else {
            $this->form_validation->set_message('check_otp_valid', "OTP not Valid.");
            return false;
        }
    }

    public function topup_history()
    {
        $data = array();
        $limit = $this->limit;

        $conditions['u_code'] = $this->session->userdata('user_id');
        $data['from_table'] = 'transaction';
        $conditions['tx_type'] = ['topup', 'retopup'];
        $data['base_url'] = $base_url = base_url() . $this->panel_url . '/invest/topup-history';

        if (isset($_REQUEST['reset'])) {
            redirect(base_url($base_url));
        }
        if (isset($_REQUEST['tx_type']) && $_REQUEST['tx_type'] != 'all') {
            $conditions['tx_type'] = $_REQUEST['tx_type'];
        }

        if (isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != '' && isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != '') {
            $data['where'] = "date>='" . $_REQUEST['start_date'] . "' and date<='" . $_REQUEST['end_date'] . "'";
        }
        if (isset($_REQUEST['limit']) && $_REQUEST['limit'] != '') {
            $limit = $_REQUEST['limit'];
        }

        $data['conditions'] = $conditions;
        $data = $this->paging->search_response($data, $limit, $base_url);

        $data['base_url'] = $base_url;

        $this->show->user_panel('invest_history', $data);
    }
}