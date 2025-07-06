
<?php 
$profile=$this->session->userdata("profile"); 
$user_id=$this->session->userdata("user_id"); 
?>
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Reward</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Rewards</li>
         </ol>
	   </div>
	 
</div>

 
             <div class="card card-body card-bg-1">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
<div class="table-responsive">
    <table class="<?= $this->conn->setting('table_classes'); ?>">
    <thead>
                                    <tr>
                                        <th>S No.</th>
                                        <th>Total Team Business Required</th>
                                        <th>Leg 1 Required</th>    
                                        <th>Leg 2 Required</th> 
                                        <th>Other leg Required</th>
                                        <th>Reward</th>              
                                        <th>Royalty</th>              
                                        <th>Status</th>                
                                        
                                         
                                    </tr>
                                </thead>
                                <tbody>
          
                                <?php
                                     
                                 $my_plan =$this->db->query("SELECT * FROM plan")->result(); 
                              // print_r($my_plan);
                                $top_legs1=$this->business->top_legs($user_id);
                                
                                $active_direct_val = $this->db->query("SELECT c9 FROM user_wallets WHERE u_code='$user_id'")->row();
                                $active_direct = $active_direct_val->c9;
                               if($active_direct >= 2){
                                //   print_r($top_legs1);
                                $leg1_business=$top_legs1[0];
                                $leg2_business=$top_legs1[1];
                                //echo "<br>";
                                $other_leg=array_sum($top_legs1)-$leg1_business-$leg2_business; 
                               }else{
                                   $goalstatus = 'Pending';
                                   $leg1_business = 0;
                                   $leg2_business = 0;
                                   $other_leg = 0;
                                   
                               }
                               
                                if($my_plan){
                                    $sno=0;
                                     
                                    for($i=0;$i<8;$i++){
                                        // $namely_business=4545;
                                        $requried_business=$my_plan[$i]->reward_business;
                                        $our_rank=$my_plan[$i]->rank;
                                        $reward = $my_plan[$i]->reward;
                                        $royalty = $my_plan[$i]->royalty;
                                        //$reward = 2500000*$reward_per/100;
                                        $leg1req = $requried_business*40/100;
                                        $leg2req = $requried_business*40/100;
                                        $otherlegreq = $requried_business*20/100;
                                        // $table_data =  $this->db->query("SELECT * FROM tbl_users WHERE sponser='$user_name'  ORDER BY tbl_users.id DESC")->result(); 
                                        //     $k=0;
                                        //     $s=0;
                                        //             foreach($table_data as $t_data){
                                        //              $total_current_team_business=array_sum($this->Order_model->top_legs($t_data->id));
                                        //               $direct_business=$t_data->status==1 ? $this->Order_model->package($t_data->id):0;
                                        //                 $total_business=$total_current_team_business+$direct_business;
                                                    
                                        //           if($total_business >= $requried_business*40/100 ){   
                                        //              $k+=1;   
                                        //             }
                                        //           if($total_business >= $requried_business*20/100 ){
                                        //              $s+=1;   
                                        //             }
                                                   
                                        //         }  
                                                 
                                        
                            		
                                       
                                        $goalstatus=($leg1_business>=$leg1req && $leg2_business >=$leg2req && $other_leg>=$otherlegreq ? 'Achieved':'Pending');
                                        // echo "<br>goalstatus--".$goalstatus;
                                        //  die();
                                        if($goalstatus=="Achieved" ){
                                          $check_rank_=  $this->db->query("SELECT u_code FROM rank WHERE rank_id='$i' and u_code='$user_id' and rank='$our_rank'")->row();
                                          
                                                if(!$check_rank_){
                                                    $rankinsert['u_code']=$user_id;
                                                    $rankinsert['rank']=$our_rank;
                                                    $rankinsert['is_complete']=1;
                                                    $rankinsert['rank_id']=$i;
                                                    $this->db->insert('rank',$rankinsert);
                                                    
                                                    $source="reward";
                                                    $income=array(); 
                                    				$income['u_code']=$user_id;
                                    				$income['tx_type']='income';
                                    				$income['source']=$source;
                                    				$income['debit_credit']='credit';
                                    				$income['amount']=$reward; 
                                    				$income['date']=date('Y-m-d H:i:s');             
                                    				$income['added_on']=date('Y-m-d H:i:s');
                                    				$income['status']=1;
                                    			         
                                    				$income['wallet_type']='income_wallet';
                                    				$income['remark']="Recieve $reward $ Award and reward.";
                                    				
                                    				if($this->db->insert('transaction',$income)){
                                    					$income_lvl=$income['amount'];//-$income['tx_charge'];
                                    					
                                    					   $columnName2 = 'c15';
                                                            $c15 = "UPDATE user_wallets SET c15 = $columnName2 + $income_lvl where u_code ='$user_id'";
                                                            $this->db->query($c15);
                                                           
                                                            
                                                            $columnName3 = 'c1';
                                                            $c1 = "UPDATE user_wallets SET c1 = $columnName3 + $income_lvl where u_code ='$user_id'";
                                                            $this->db->query($c1);

                                    					
                                    			   }
                                                    
                                                }
                                        }    
                                        ?>
                                        <tr>
                                            <td ><?= $i+1;?></td>
                                            <td ><?= $requried_business;?></td>
                                            <td><?= $leg1req;?>/<?= $leg1_business;?></td>
                                            <td><?= $leg2req;?>/<?= $leg2_business;?></td>
                                            <td><?= $otherlegreq;?>/<?= $other_leg;?></td>
                                            <td><?= $reward;?></td>
                                            <td><?= $royalty;?>%</td>
                                             
                                             <?php
                                            if($goalstatus=="Achieved"){
                                                echo " <th style='color:green'>$goalstatus</th>";
                                                 
                                            }
                                            else{
                                                 
                                                echo " <th>$goalstatus</th>"; 
                                                 
                                            }
                                             
                                             ?>
                                             
                                      
                                           
                                        </tr>
                                        <?php   // die();
                                    }
                                }
                                ?>
                            </tbody>
        
    </table>
</div>
    
    </div>
</div>
</div>
