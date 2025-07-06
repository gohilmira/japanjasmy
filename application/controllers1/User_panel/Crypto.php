<?php

class Crypto extends CI_Controller{
    public function __construct()
    {
         
        parent::__construct();
        $api_key=$this->conn->company_info('api_key');
        $this->payment_type =  "CRYPADD";
        $this->api_key =$api_key;
        
    }
    
  
  	public function fee($amnt){
    	if($amnt<200){
        	return 1;
        }else{
        	return $amnt*0.5/100;
        }
    }

      ?>
    <?php     ?>
    <?php     ?>
    <?php  
    
       public function add_fund_history(){ 
        
           $conditions['u_code'] = $this->session->userdata('user_id');        
           $searchdata['from_table']='transaction';
           $conditions['tx_type']='CRYPADD';
        
            if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
               $spo=$this->profile->column_like($_REQUEST['name'],'name'); 
                if($spo){
                    $conditions['u_code'] = $spo;
                }
            }
           if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
                $spo=$this->profile->column_like($_REQUEST['username'],'username'); 
                if($spo){
                    $conditions['u_code'] = $spo;
                }
            }
         
            if(isset($_REQUEST['use_status']) && $_REQUEST['use_status']!=''){
                $conditions['use_status'] = $_REQUEST['use_status'];
            } 
           if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
    			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
    			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
    			$where="(added_on BETWEEN '$start_date' and '$end_date')";
                $searchdata['where'] = $where;
    		}
    		
    		 if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
            $this->limit= $limit;
        }
    		if(!empty($likeconditions)){
                $searchdata['likecondition'] = $likeconditions;
            }
            
            if(!empty($conditions)){
                $searchdata['conditions'] = $conditions;
            }
            
            $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/crypto/add-fund-history');
           
            $this->show->user_panel('crypto/fund_add_history',$data);  
            ///////////////////////////////////////////////////////////////////////////
            
    }
    

    
    
}