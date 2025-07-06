<?php
class Register extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        
        $data['page_name']= 'Register';    
        
        
        if(isset($_POST['register'])){
            
            $csrf_test_name=json_encode($_POST);
            $check_ex=$this->conn->runQuery('id','form_request',"request='$csrf_test_name'");
            if(!$check_ex){
                    
                    $request['request']=$csrf_test_name;
                   // $this->db->insert('form_request',$request);
            
            $requires=$this->conn->runQuery("*",'advanced_info',"title='Registration'");
            $value_by_lebel= array_column($requires, 'value', 'label');
          
            if(array_key_exists('is_sponsor_required', $value_by_lebel) && $value_by_lebel['is_sponsor_required']=='yes'){
                
                $this->form_validation->set_rules('u_sponsor', 'Sponsor', 'required|callback_is_sponsor_available');                
               $register['u_sponsor']=$this->profile->id_by_username($_POST['u_sponsor']);
            }else{
                $register['u_sponsor']= 1;
            }
            $sponsor_id=$register['u_sponsor'];
            
             if(array_key_exists('user_gen_method', $value_by_lebel) && $value_by_lebel['user_gen_method']=='manual'){
                 $this->form_validation->set_rules('usename', 'Usename', 'required|trim|callback_is_username_valid');
                 $register['username']= $value_by_lebel['user_gen_prefix'].$_POST['usename'];
             }else{
                 $register['username'] = $this->get_username();
                 
             }
            
              $this->form_validation->set_rules('name', 'Name', 'required');
             
               //$this->form_validation->set_rules('Parentid', 'Parentid', 'trim|required|callback_is_parentid_valid');
              
             if(array_key_exists('email_users', $value_by_lebel)){
                   $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|callback_is_email_valid');
                  $register['email'] =$email= $_POST['email'];
             }
             
             
                   $this->form_validation->set_rules('wallet_address', 'Wallet Address', 'required|callback_is_address_valid');
                  $register['eth_address'] =$email= $_POST['wallet_address'];
            
             
              
              if(array_key_exists('country_code', $value_by_lebel) && $value_by_lebel['country_code']=='yes'){
                   $this->form_validation->set_rules('country_code', 'Country', 'trim|required');
                  $register['country'] = $_POST['country_code'];
              }
               
              
             // if(array_key_exists('reg_type', $value_by_lebel) && $value_by_lebel['reg_type']=='binary'){
                  /* $this->form_validation->set_rules('position', 'Position', 'trim|required');
                  $register['position'] = $_POST['position'];
                  $register['Parentid'] = $this->binary->new_parent($register['u_sponsor'],$_POST['position']);*/
             // }              
              
              if(array_key_exists('mobile_users', $value_by_lebel)){
                   $this->form_validation->set_rules('mobile', 'Mobile', 'required|callback_is_mobile_valid');
                  $register['mobile'] =$mobile= $_POST['mobile'];
              }
              
              
              if(array_key_exists('pass_gen_type', $value_by_lebel)  && $value_by_lebel['pass_gen_type']=='manual'){
                  $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
                    $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|min_length[6]|matches[password]');
                    $pw=$register['password'] = md5($_POST['password']);
              }else{
                  $pw=random_string($value_by_lebel['pass_gen_fun'], $value_by_lebel['pass_gen_digit']);
                  $register['password'] = md5($pw);
              }
              
             // if(array_key_exists('pass_gen_type', $value_by_lebel)  && $value_by_lebel['pass_gen_type']=='manual'){
                  /*$this->form_validation->set_rules('tx_password', 'Tx Password', 'trim|required|min_length[6]');
                    $this->form_validation->set_rules('confirm_tx_password', 'Tx Password Confirmation', 'trim|required|min_length[6]|matches[tx_password]');
                    $tx_password=$_POST['tx_password'];
                    $register['tx_password'] = md5($_POST['tx_password']);*/
              /*}else{
                  $pw=random_string($value_by_lebel['pass_gen_fun'], $value_by_lebel['pass_gen_digit']);
                  $register['password'] = md5($pw);
              }*/
              
              
              
           $country_name=$_POST['country_code'];
           $country_code=$this->conn->runQuery('*','countries',"name='$country_name' and 1=1");
           $email_code=mt_rand(100000,999999);
              
             /*  $tx_pass=mt_rand(100000,999999);
               $tx_password=$register['tx_password']=$tx_pass;
              */
              
              //$this->form_validation->set_rules('accept_terms', 'Accept terms', 'required');
              
               /* $this->form_validation->set_rules('pin', 'Pin', 'required|callback_is_pin_available');                
                $this->form_validation->set_rules('pan', 'Pan', 'required|callback_is_pan_valid');         */       
              
                if($this->form_validation->run() != False){
                    
                    $register['country_code'] =$user_name= $country_code[0]->phonecode;
                    $register['name'] =$user_name= $_POST['name'];
                    $register['user_type'] = 'user';
                    $register['added_on']=date('Y-m-d H:i:s');
                    $register['email_code']=$email_code;
                    $register['is_email_verify']=1;
                    $code=$this->conn->get_insert_id('users',$register);
                    if($code){
                        
                        $inser_wallet=array();
                        $inser_wallet['u_code']=$code;
                        if($this->db->insert('user_wallets',$inser_wallet)){
                            $this->update_ob->add_direct($sponsor_id);
                            $this->update_ob->add_gen($sponsor_id);
                            $this->update_ob->add_gen_user($sponsor_id,$code);
                            
                            $ge=array();
                            $ge['u_code']=$code;
                            $ge['gen_team']="[]";
                            $this->db->insert('user_teams',$ge);
                            
                            if($this->conn->setting('reg_type')=='binary'){
                                $this->update_ob->update_binary($sponsor_id);
                            }
                            
                            ///////////////////////////////active ///////////////////////////////////////////////////
                            
                        }
                        
                    $this->session->set_flashdata("success", "Your Account has been registered. You can login now. Username : ".$register['username']." & Password :".$_POST['password']);
                    }else{
                         $this->session->set_flashdata("error", "Somthing Wrong! Please try again.");
                    }
                         
                        $website=$this->conn->company_info('title');
                         $company_url=$this->conn->company_info('base_url');
                        $msg2="Dear ".$register['name']." , Welcome to $website. Your User ID : ".$register['username'].", Password : ".$_POST['password']." . For more visit $company_url .";
                        //$msg2="Welcome ".$register['name']." . You have been successfully registered as a member of $website.Your login Credentials as follows - Username ".$register['username'].", And Password : ".$_POST['password'].". Thanks! test.com team."; 
                       //$this->message->sms($mobile,$msg2);
                         //$this->message->send_mail($register['email'],'Registration success',$msg2);
                        redirect(base_url('success?username='.$register['username'].'&pass='.$_POST['password'].'&name='.$_POST['name'].'&tx_pass='.$tx_password),"refresh");
                
                
                        //$url_link=base_url('Everify?ucode='.$code.'&emailcode='.$email_code.'&name='.$_POST['name']);
                       // $msg1="$msg2 please click this link $url_link to verify email ";
                       // $this->message->send_mail($register['email'],'Registration Verify',$msg1);
                      //  redirect(base_url('Everify?username='.$register['username'].'&pass='.$_POST['password'].'&name='.$_POST['name']),"refresh");
                
                    }
        }else{
             $this->session->set_flashdata("error", "You can not submit same request within 5 minutes.");
        }
         }
         $this->show->main('register',$data);
    }
    
    public function register_with_dapp(){
        
        $res['res']="fail";
        $data['page_name']= 'Register';    
        
        // $as=array();
        // $as['remark']=json_encode($_POST);
        // $this->db->insert('testing',$as);
         $this->form_validation->set_data($_POST);    
        
        
        if(isset($_POST['register'])){
            
            $requires=$this->conn->runQuery("*",'advanced_info',"title='Registration'");
            $value_by_lebel= array_column($requires, 'value', 'label');
          
            if(array_key_exists('is_sponsor_required', $value_by_lebel) && $value_by_lebel['is_sponsor_required']=='yes'){
                
                $this->form_validation->set_rules('u_sponsor', 'Sponsor', 'required|callback_is_sponsor_available');                
               $register['u_sponsor']=$this->profile->id_by_username($_POST['u_sponsor']);
            }else{
                $register['u_sponsor']= 1;
            }
            $sponsor_id=$register['u_sponsor'];
            
             if(array_key_exists('user_gen_method', $value_by_lebel) && $value_by_lebel['user_gen_method']=='manual'){
                 $this->form_validation->set_rules('usename', 'Usename', 'required|trim');
                 $register['username']= $_POST['usename'];
             }else{
                 
             $register['username'] = $this->get_username();
                 
             }
            $this->form_validation->set_rules('user_address', 'User Address', 'required|trim|callback_is_username_valid');

           //  $this->form_validation->set_rules('name', 'Name', 'required');
              
              
            //   $this->form_validation->set_rules('state', 'State', 'required');
            //     $state_id=$_POST['state'];
              
            //      $states=$this->conn->runQuery("*",'state',"status='Active' and state_id='$state_id'");
            //      $register['state'] =  $states[0]->state_title; //$_POST['state'];
                  
            //     $this->form_validation->set_rules('district', 'District', 'required');
            //     $district_id=$_POST['district'];               
            //     $district=$this->conn->runQuery("*",'district',"district_status='Active' and districtid='$district_id'");
            //     $register['district'] = $district[0]->district_title; 
                
             
               //$this->form_validation->set_rules('Parentid', 'Parentid', 'trim|required|callback_is_parentid_valid');
              
           /* if(array_key_exists('email_users', $value_by_lebel)){
                  $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|callback_is_email_valid');
                  $register['email'] =$email= $_POST['email'];
             }*/
              
              
            //   if(array_key_exists('country_code', $value_by_lebel) && $value_by_lebel['country_code']=='yes'){
            //       $this->form_validation->set_rules('country_code', 'Country', 'trim|required');
            //       $register['country'] = $_POST['country_code'];
            //   }
               
              
            //   if(array_key_exists('reg_type', $value_by_lebel) && $value_by_lebel['reg_type']=='binary'){
            //       $this->form_validation->set_rules('position', 'Position', 'trim|required');
            //       $register['position'] = $_POST['position'];
            //       $register['Parentid'] = $this->binary->new_parent($register['u_sponsor'],$_POST['position']);
            //   }              
              
           /*  if(array_key_exists('mobile_users', $value_by_lebel)){
                  $this->form_validation->set_rules('mobile', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]|callback_is_mobile_valid');
                 $register['mobile'] =$mobile= $_POST['mobile'];
              }*/
              
              
            //   if(array_key_exists('pass_gen_type', $value_by_lebel)  && $value_by_lebel['pass_gen_type']=='manual'){
            //       $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
            //         $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|min_length[6]|matches[password]');
            //         $pw=$register['password'] = md5($_POST['password']);
            //   }else{
            //       $pw=random_string($value_by_lebel['pass_gen_fun'], $value_by_lebel['pass_gen_digit']);
            //       $register['password'] = md5($pw);
            //   }
              
        //   $country_name=$_POST['country_code'];
        //   $country_code=$this->conn->runQuery('*','countries',"name='$country_name' and 1=1");
     
        //   $email_code=mt_rand(100000,999999);
              
              
              
             /*  $tx_pass=mt_rand(100000,999999);
               $tx_password=$register['tx_password']=$tx_pass;
              */
              
              //$this->form_validation->set_rules('accept_terms', 'Accept terms', 'required');
              
                if($this->form_validation->run() != False){
                    // $register['country_code'] =$user_name= $country_code[0]->phonecode;
                    // $register['name'] =$user_name= $_POST['name'];
                    $register['user_address'] = $_POST['user_address'];
                    $register['user_type'] = 'user';
                    $register['added_on']=date('Y-m-d H:i:s');
                    // $register['email_code']=$email_code;
                    $register['is_email_verify']=1;
                    $code=$this->conn->get_insert_id('users',$register);
                    if($code){
                        
                        $inser_wallet=array();
                        $inser_wallet['u_code']=$code;
                        if($this->db->insert('user_wallets',$inser_wallet)){
                            $this->update_ob->add_direct($sponsor_id);
                            $this->update_ob->add_gen($sponsor_id);
                            $this->update_ob->add_gen_user($sponsor_id,$code);
                            
                            $ge=array();
                            $ge['u_code']=$code;
                            $ge['gen_team']="[]";
                            $this->db->insert('user_teams',$ge);
                            
                            if($this->conn->setting('reg_type')=='binary'){
                              //  $this->update_ob->update_binary($sponsor_id);
                            }
                        }
                        

                    $this->session->set_flashdata("success", "Your Account has been registered. You can login now. Username : ".$register['username']);
                    }else{
                         $this->session->set_flashdata("error", "Somthing Wrong! Please try again.");
                    }
                         
                        $website=$this->conn->company_info('title');

                         $company_url=$this->conn->company_info('base_url');
                        $msg2="Dear ".$register['name']." , Welcome to $website. Your User ID : ".$register['username']."For more visit $company_url .";
                        //$msg2="Welcome ".$register['name']." . You have been successfully registered as a member of $website.Your login Credentials as follows - Username ".$register['username'].", And Password : ".$_POST['password'].". Thanks! test.com team."; 
                       //$this->message->sms($mobile,$msg2);
                        //$this->message->send_mail($register['email'],'Registration success',$msg2);
                       // redirect(base_url('success?username='.$register['username'].'&pass='.$_POST['password'].'&name='.$_POST['name'].'&tx_pass='.$tx_password),"refresh");
                
                
                        //$url_link=base_url('Everify?ucode='.$code.'&emailcode='.$email_code.'&name='.$_POST['name']);
                       // $msg1="$msg2 please click this link $url_link to verify email ";
                       // $this->message->send_mail($register['email'],'Registration Verify',$msg1);
                      //  redirect(base_url('Everify?username='.$register['username'].'&pass='.$_POST['password'].'&name='.$_POST['name']),"refresh");
                       $this->session->set_userdata("user_login", true);                            
                            $this->session->set_userdata("user_id", $code);  
                            $profile = $this->profile->profile_info($code);
                            $this->session->set_userdata("profile", $profile);  
                         $res['res']="success";
                        $res['message']="Register Success";
                
                
                    }else{
                        $res['res']="fail";
                        $res['message']=validation_errors();
                    }
                
         }else{
              $res['res']="fail";
                $res['message']="Register Required";
         }
        
        
         print_r(json_encode($res));  
    }

    public  function is_sponsor_available($str){
        $where = array(
            'username' => $str            
        );       
        $details=$this->conn->runQuery('id,active_status','users', $where);
        if($details){
            return true;
        }else{
              $this->form_validation->set_message('is_sponsor_available', "Sponsor not Exists! Please Try another.");
              return false;
        }
    }
    
    public  function check_directs($str){
        $spons=$this->profile->id_by_username($str);
        $my_directs=$this->team->directs($spons);
        $total_directss=COUNT($my_directs);
        if($total_directss<4){
            return true;
        }else{
              $this->form_validation->set_message('check_directs', "Already Reffer 4 ids.");
              return false;
        }
    }
    
    
    
    
    public  function is_pin_available($str){
        $details=$this->conn->runQuery('id','epins',"use_status=0 and pin='$str'");
        if($details){
            return true;
        }else{
          $this->form_validation->set_message('is_pin_available', "Invalid Pin.");
          return false;
        }
    }

    public  function is_username_valid($str){
        $where = array(
            'user_address' => $str            
        );       
        if($this->conn->runQuery('id','users', $where)){
            $this->form_validation->set_message('is_username_valid', "Username Already Exists! Please Try another.");
            return false;
        }else{
              
               return true;
        }
    }

   public  function is_parentid_valid($str){
        $position=$_POST['position'];
        $where = array(
            'username' => $str            
        );
        $result=$this->conn->runQuery('id','users', $where);
        if($result){   
            
             $parent_id=$result[0]->id;
             $result1=$this->conn->runQuery('id','users',"Parentid='$parent_id' and position='$position'");
             if($result1){
                 
                   $this->form_validation->set_message('is_parentid_valid', "Invalid Position.");
                   return false;
                 
             }else{
                 
                    return true;
             }
            
            
        }else{
            $this->form_validation->set_message('is_parentid_valid', "Invalid Parent Id.");
                   return false;
        }
        
    }

public  function is_mobile_valid($str){
        $where = array(
            'mobile' => $str            
        );
        $result=$this->conn->runQuery('id','users', $where);
        if($result){            
            $mobile_users=$this->conn->setting('mobile_users');
            if(count($result)>=$mobile_users){
                  $this->form_validation->set_message('is_mobile_valid', "You exceed maximum number of mobile use limit! Please Try another.");
                 return false;                
            }else{
                return true;
            }
        }else{
            return true;
        }
    }
    
    
    public  function is_email_valid($str){
        $where = array(
            'email' => $str            
        );
        $result=$this->conn->runQuery('id','users', $where);
        if($result){           
            $email_users=$this->conn->setting('email_users');
            if(count($result)>=$email_users){               
                  $this->form_validation->set_message('is_email_valid', "You exceed maximum number of email use limit! Please Try another.");
                   return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }
    
    
    public function is_address_valid($str){
        $where = array(
            'eth_address' => $str            
        );
        $result=$this->conn->runQuery('id','users', $where);
        if($result){           
           
            if(count($result)>=1){               
                  $this->form_validation->set_message('is_address_valid', "You exceed maximum number of account use limit! Please Try another.");
                   return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }
    

    public  function check_mobile_valid(){
        
       
            $where = array(
                'mobile' => $_POST['mobile']            
            );
            $result=$this->conn->runQuery('id','users', $where);
            if($result){            
                $mobile_users=$this->conn->setting('mobile_users');
                if(count($result)>=$mobile_users){
                    $res['error']=true; 
                    $res['msg']="You exceed maximum number of mobile use limit! Please Try another.";                
                }else{
                    $res['error']=false; 
                    $res['msg']="Valid mobile.";
                }
            }else{
                $res['error']=false; 
                $res['msg']="Valid mobile.";
            }
       
        print_r(json_encode($res)); 
    }

    public  function check_email_valid(){
        
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $where = array(
                'email' => $_POST['email']            
            );
            $result=$this->conn->runQuery('id','users', $where);
            if($result){           
                $email_users=$this->conn->setting('email_users');
                if(count($result)>=$email_users){               
                    $res['error']=true; 
                    $res['msg']="You exceed maximum number of email use limit! Please Try another.";
                }else{
                    $res['error']=false; 
                    $res['msg']="Valid Email.";
                }
            }else{
                $res['error']=false; 
                $res['msg']="Valid Email.";
            }
        }else{
            $res['error']=true; 
            $res['msg']="Invalid Email ! Please Enter valid Email.";
        }
        print_r(json_encode($res)); 
    }
    
    public  function check_pan_valid(){
       
        $where = array(
            'pan_no' => $_POST['pan']            
        );
        $result=$this->conn->runQuery('id','users', $where);
        if($result){           
            $email_users=3;//$this->conn->setting('email_users');
            if(count($result)>=$email_users){               
                $res['error']=true; 
                $res['msg']="You exceed maximum number of pan use limit! Please Try another.";
            }else{
                $res['error']=false; 
                $res['msg']="Valid Pan.";
            }
        }else{
            $res['error']=false; 
            $res['msg']="Valid Pan.";
        }
        
        print_r(json_encode($res)); 
    }
    
    
    
    public  function is_pan_valid($str){
        $where = array(
            'pan_no' => $str            
        );
        $result=$this->conn->runQuery('id','users', $where);
        if($result){           
            $email_users=3;//$this->conn->setting('email_users');
            if(count($result)>=$email_users){               
                  $this->form_validation->set_message('is_pan_valid', "You exceed maximum number of pan use limit! Please Try another.");
                   return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }
    
    public  function check_pin_valid(){
            $pin=$_POST['pin']; 
            $result=$this->conn->runQuery('id','epins',"use_status=0 and pin='$pin'");
            if($result){       
                
                $res['error']=false; 
                $res['msg']="Valid Pin.";
             
            }else{
                $res['error']=true; 
                $res['msg']="Invalid Pin.";
            }
        
        print_r(json_encode($res)); 
    }
    

    public  function check_sponsor_exist(){
        $res['error']=true;
        $where = array(
            'username' => $_POST['u_sponsor']          
        );  
        $details  =  $this->conn->runQuery('id,name,active_status','users', $where);        
        if($details){
           
                $res['msg']=$details[0]->name;
                $res['error']=false;
           
        }else{              
            $res['msg']="Sponsor not exist";
        }
        print_r(json_encode($res));
    }

    public  function check_username_exist(){
        if(isset($_POST['username']) && $_POST['username']!=''){
            $where['username']=trim($this->conn->setting('user_gen_prefix').$_POST['username']);
            $details  =  $this->conn->runQuery('name','users', $where);        
            if($details){            
                $res['name'] = $details[0]->name;
                $res['error']=true; 
                $res['msg']="Username Exists";
            }else{            
                
                $res['error']=false;
                $res['msg']="Valid username";
            }
        }else{
            $res['error']=true;            
            $res['msg']="Please Enter username";
        } 
        print_r(json_encode($res));      
    }

    public function get_username(){
        $selected='no';
        $user_gen_prefix=$this->conn->setting('user_gen_prefix');
        $user_gen_digit=$this->conn->setting('user_gen_digit');
        $user_gen_fun=$this->conn->setting('user_gen_fun');
        while($selected=='no'){
            $selected='yes';
            $username=$user_gen_prefix.random_string($user_gen_fun, $user_gen_digit);
            $check_username_exists=$this->conn->runQuery('username','users',"username='$username'");
            if($check_username_exists){
                $selected='no';
            }
        }        
        return $username;
    }
    
}