	<?php
	header('Access-Control-Allow-Origin: *');

	use Web3\Web3;
	use Web3\Providers\HttpProvider;
	use Web3\RequestManagers\HttpRequestManager;
	use Web3p\EthereumTx\Transaction;
	use Web3\Utils;
	use Web3\Contract;

	class Crons extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function tttsss()
		{

			$dss = array(
				array('label' => 'January', 'income' => 21, 'sales' => 41),
				array('label' => 'February', 'income' => 25, 'sales' => 76),
				array('label' => 'March', 'income' => 56, 'sales' => 23),
				array('label' => 'April', 'income' => 23, 'sales' => 53),
				array('label' => 'May', 'income' => 75, 'sales' => 23),
				array('label' => 'June', 'income' => 35, 'sales' => 32),
			);
			print_r(json_encode($dss));
		}


		private function transfer($to, $amount)
		{
			// $tokenAddress  = "0x15669CF161946C09a8B207650BfBB00e3d8A2E3E";
			// $account = strtolower('0x81cA8F3fd0e0c7A2F7779b7EE0A8AAeA13bc7E8d');
			// $privateKey = 'f8d99e650ad3c959650c77d9249489d36b0128f00d600e71d7d39b6979ff4b22';
			$sendaddress = strtolower($to);
			$payAmnt = $amount;

			try {
				$url = "http://62.72.23.66:3000/transfer/jasmy"; // Ensure this is the correct full URL
				$data = [
					"to" => $sendaddress,
					"amount" => $payAmnt,
				];

				$options = array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => json_encode($data),
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					),
				);

				$ch = curl_init();
				curl_setopt_array($ch, $options);

				$response = curl_exec($ch);

				if (curl_errno($ch)) {
					echo 'Error:' . curl_error($ch);
				} else {
					return $response;
				}

				curl_close($ch);
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public function auto_withdrawal()
		{


			$account = $this->conn->company_info('company_account');
			$account_2 = $this->conn->company_info('company_2_account');
			$privateKey = $this->conn->company_info('company_private_key');
			$datetime = date('Y-m-d');
			$all_cr_array = $this->conn->runQuery('*', 'users', "active_status=1");

			$min_wd_limit = $this->conn->setting('min_withdrawal_limit');
			$crncy = $this->conn->company_info('currency');
			$insertincome = array();

			foreach ($all_cr_array as $user_details) {
				// $userid = 2;
				$userid = $user_details->id;

				$wallet_amt = $this->update_ob->wallet($userid, 'main_wallet');

				$bank_details = $this->profile->my_default_account($userid);
				$direct_details = $this->team->my_actives($userid);


				$info = $this->profile->profile_info($userid);
				$address = $user_details->user_address;
				$wallet_amt;
				$min_wd_limit;




				if ($wallet_amt >= $min_wd_limit && !empty($user_address)) {

					$wallet_amt = $min_wd_limit;
					echo "<br>final _wd_limit--" . $min_wd_limit;
					$bank_details = $bank_details = $this->profile->my_default_account($userid); //$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
					$inserttrans['bank_details'] = json_encode($bank_details);

					$crncy = $this->conn->company_info('currency');

					$inserttrans['wallet_type'] = 'main_wallet';
					$inserttrans['tx_type'] = 'withdrawal';
					$inserttrans['debit_credit'] = "debit";
					$inserttrans['u_code'] = $userid;
					$inserttrans['date'] = date('Y-m-d H:i:s');
					$amnt = abs($wallet_amt); //100
					$tx_charge = $amnt * 2 / 100; // 20
					$tx_charge3 = $amnt * 3 / 100; // 20
					$inserttrans['amount'] = $payable = $amnt - $tx_charge - $tx_charge3; //80
					$inserttrans['tx_charge'] = $tx_charge;

					$inserttrans['open_wallet'] = $this->update_ob->wallet($userid, 'main_wallet');
					$inserttrans['closing_wallet'] = $inserttrans['open_wallet'] - $inserttrans['amount'];
					$inserttrans['remark'] = " Withdraw  $crncy $amnt";
					echo "<br>net-amount--" . $amnt;
					echo "<br>tx_charget 2%--" . $tx_charge;
					echo "<br>tx_charget 3%---" . $tx_charge3;
					echo "<br>payablet--" . $payable;



					$r = json_decode($this->transfer($account, $payable));
					if ($r->success) {
						$t = json_decode($this->transfer($account_2, $tx_charge));

						if ($t->success) {
							$transactionhash = $r->transactionHash;
							$inserttrans['status'] = 1;
							$inserttrans['txs_res'] = $transactionhash;
							if ($this->db->insert('transaction', $inserttrans)) {
								$wlt_amts = round($amnt, 2);
								//$this->update_ob->add_amnt($tx_u_code,$wallet_type,$amnt);
								$this->update_ob->add_amnt($userid, 'main_wallet', -$wlt_amts);
								$this->update_ob->add_amnt($userid, 'total_withdrawal', $wlt_amts);
							}
						}
					}
				}
			}
		}



		public function roi_closing()
		{
			$source = "roi";
			$datetime = date('Y-m-d H:i:s');
			$all_cr_array = $this->conn->runQuery('*', 'orders', "status=1 and payout_status=0");

			foreach ($all_cr_array as $user_details) {

				$userid = $user_details->u_code;
				$tx = $user_details->id;
				$order_amount = $user_details->order_amount;
				$active_date = $user_details->added_on;
				$tx_type = $user_details->tx_type;
				$times = $user_details->times;
				$next_times = $times - 1;
				$user_active_date = $this->conn->runQuery('*', 'users', "id=$userid ")[0]->active_date;
				// Calculate the activation date plus 7 days
				$activation_date_plus_7_days = date('Y-m-d H:i:s', strtotime($user_active_date . ' + 7 days'));
				// die;
				// Check if the current date is greater than or equal to the activation date plus 7 days
				if ($datetime >= $activation_date_plus_7_days) {

					if ($times == 0) {
						$this->db->set('payout_status', 1)
							->where('u_code', $userid)
							->where('status', 1)
							->where('id', $tx)
							->update('orders');
					}

					$roi  = $user_details->roi;
					$payable_amt1 = $order_amount * $roi / 100;

					if ($payable_amt1 > 0 && $times > 0) {
						$income = array();
						$income['u_code'] = $userid;
						$income['tx_type'] = 'income';
						$income['source'] = $source;
						$income['debit_credit'] = 'credit';
						$income['amount'] = $payable_amt1;
						$income['date'] = $datetime;
						$income['added_on'] = $datetime;
						$income['status'] = 1;
						$income['tx_record'] = $tx;
						$income['txs_res'] = 1;
						$income['wallet_type'] = 'main_wallet';
						$income['remark'] = "Receive $source income of amount $payable_amt1";

						if ($this->db->insert('transaction', $income)) {
							$income_lvl = $income['amount'];
							$this->update_ob->add_amnt($userid, $source, $income_lvl);
							$this->update_ob->add_amnt($userid, 'main_wallet', $income_lvl);

							$this->db->set('times', $next_times)
								->where('u_code', $userid)
								->where('payout_status', 0)
								->where('id', $tx)
								->update('orders');
						}
					}
				}
			}
		}
		public function royalty_closing(){  
      
			$all_cr_array =$this->conn->runQuery('*','users',"1=1");
		
		  foreach($all_cr_array as $user_details){
			$my_plan =$this->db->query("SELECT * FROM plan")->result(); 
			// print_r($my_plan);
			$user_id = $user_details->id;
			  $top_legs1=$this->business->top_legs($user_id);
			  
			  $active_direct_val = $this->db->query("SELECT c9 FROM user_wallets WHERE u_code='$user_id'")->row();
			  $active_direct = $active_direct_val->c9;
			
			  //   print_r($top_legs1);
			  $leg1_business=$top_legs1[0];
			  $leg2_business=$top_legs1[1];
			  //echo "<br>";
			  $other_leg=array_sum($top_legs1)-$leg1_business-$leg2_business; 
			
		  if($my_plan){
			 for($i=3;$i<7;$i++){
					 // $srr=$arr[$i]->reward_business;
										  
					 // $reward=(float)$arr[$i]->reward;
					 $self_package=$this->business->package(2); 
					  $royalty_per=(float)$arr[$i]->reward;
					  $royalty=$self_package*$royalty_per/100;
				  
					$requried_business=$my_plan[$i]->reward_business;
					$our_rank=$my_plan[$i]->rank;
					//$reward = $my_plan[$i]->reward;
					//$reward = 2500000*$reward_per/100;
					$leg1req = $requried_business*40/100;
					$leg2req = $requried_business*40/100;
					$otherlegreq = $requried_business*20/100;

					$goalstatus=($leg1_business>=$leg1req && $leg2_business >=$leg2req && $other_leg>=$otherlegreq ? 'Achieved':'Pending');

					   if($goalstatus=="Achieved"){
			   
						   $rankinsert['u_code']=$user_id;
						   $rankinsert['royalty']=$our_rank;
						   $rankinsert['is_complete']=1;
						   $rankinsert['royalty_id']=$i;
						   $this->db->insert('royalty',$rankinsert);
						   
						   $source="royalty";
						   $income=array(); 
						   $income['u_code']=$user_id;
						   $income['tx_type']='income';
						   $income['source']=$source;
						   $income['debit_credit']='credit';
						   $income['amount']=$royalty; 
						   $income['date']=date('Y-m-d H:i:s');             
						   $income['added_on']=date('Y-m-d H:i:s');
						   $income['status']=1;
								
						   $income['wallet_type']='main_wallet';
						   $income['remark']="Recieve $royalty $ Award and reward.";
						   
						   if($this->db->insert('transaction',$income)){
							   $income_lvl=$income['amount'];//-$income['tx_charge'];
							   $this->update_ob->add_amnt($user_id,$source,$income_lvl);
							   $this->update_ob->add_amnt($user_id,'main_wallet',$income_lvl);                    
							   
						  }
						   
					  
					  
				   }    
			 }
		  }
		  }
	  }
		// 	public function aojdjaisdbnauto_withdrawal(){
		// 		$datetime=date('Y-m-d');
		// 	   $all_cr_array =$this->conn->runQuery('id,name,username,my_rank,active_date,user_address','users',"active_status=1");
		// 	   $min_wd_limit=$this->conn->setting('min_withdrawal_limit');
		// 	   $crncy=$this->conn->company_info('currency');
		// 	   $apiKey='37xyn84f765f8745gfs438sadwhd8hew8hhfjdfjqed34';
		// 	   $tx_charge_per=$this->conn->company_info('withdrawal_tx_charge');
		// 	   $insertincome=array(); 
		// 	   // print_r($all_cr_array);die;

		// 	   foreach($all_cr_array as $user_details){

		// 		   $userid=$user_details->id;
		// 		   $user_address='0x210bb0d22208bBdC226A8124e397f716af404bE5';
		// 		   $wallet_amt=0.1;
		// 		   // $bank_details=$this->profile->my_default_account($userid);
		// 		   $direct_details=$this->team->my_actives($userid);
		// 		   $active_directs= count($direct_details);
		// 		   //  echo "<br><br>user==".$userid=$user_details->id;
		// 		   //  echo "<br><br>active_directs==".$active_directs;
		// 		   //  die();

		// 		   if($wallet_amt>=$min_wd_limit && !empty($user_address)){
		// 			   // $bank_details=$bank_details=$this->profile->my_default_account($userid);//$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
		// 			   $inserttrans['bank_details']=$user_address;
		// 				echo "<br><br>useraddress==".$user_address;
		//    // 			echo "ok";die;
		// 			   $crncy=$this->conn->company_info('currency');

		// 			  $inserttrans['wallet_type']='main_wallet';
		// 			  $inserttrans['tx_type']='withdrawal';
		// 			  $inserttrans['debit_credit']="debit";             
		// 			   $inserttrans['u_code']=$userid;
		// 			  $inserttrans['date']=date('Y-m-d H:i:s');
		// 			  $amnt=abs($wallet_amt);
		// 			 // $tx_charge=$amnt*10/100;
		// 			  $inserttrans['amount']=$transferAmts=$amnt;
		// 			  $inserttrans['tx_charge']=$tx_charge;
		// 			  //$inserttrans['status']=0;
		// 			  $inserttrans['open_wallet']=$this->update_ob->wallet($userid,'main_wallet');
		// 			  $inserttrans['closing_wallet']=$inserttrans['open_wallet']-$amnt;
		// 			  $inserttrans['remark']=" Withdraw  $crncy $amnt";

		// 				////////////////////////////////api/////////////////////////////////////////////////
		// 					  // $bank_details111=$this->profile->my_default_account($this->session->userdata('user_id'));

		// 					   $withdrawal_ty1="USDT-BEP20";
		// 					   $url =  "https://appon3042.companywebsite.in/digiforce";
		// 						   $curl = curl_init($url);
		// 						   curl_setopt($curl, CURLOPT_URL, $url);
		// 						   curl_setopt($curl, CURLOPT_POST, true);
		// 						   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		// 						   $headers = [
		// 							 "Content-Type: application/json"
		// 						   ];

		// 						   curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		// 							$data = [
		// 								   "api_key" => $apiKey,
		// 								   "to_address" => $user_address,
		// 								   "payment_amount" => $transferAmts,
		// 								   ];

		// 								   $json_data = json_encode($data);

		// 						   curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);

		// 						   $result = json_decode(curl_exec($curl), true);

		// 						   curl_close($curl);

		// 						 $msg= $result['message'];
		// 					   $success= $result['success'];
		// 					   print_r($result); die;
		// 					//  echo "<br>".$success."<br>";

		// 						   if($success == "true"){ 
		// 							   // echo "result 1";
		// 							   $hash=$result['message'];
		// 							   $inserttrans['tx_hash']=$hash;
		// 							   $inserttrans['status']=1;

		// 							   $this->db->insert('transaction',$inserttrans);

		// 							   $this->update_ob->add_amnt($userid,'main_wallet',-$amnt);
		// 							   $this->distribute->withdraw_level_destribute($userid,$amnt,1);
		// 							   $this->update_ob->add_amnt($userid,'total_withdrawal',$amnt);

		// 							   $smsg="Withdrawal request success of amount  $crncy $amnt .";
		// 							   $this->session->set_flashdata("success", $smsg);
		// 							   redirect(base_url(uri_string()));

		// 						   }elseif($success == "false"){
		// 							   //  echo "result 0";
		// 							   $hash=$result['message'];
		// 							   $inserttrans['status']=0;
		// 							   $this->db->insert('transaction',$inserttrans);

		// 							   $this->update_ob->add_amnt($userid,'main_wallet',-$amnt);
		// 							   $this->distribute->withdraw_level_destribute($userid,$amnt,1);
		// 							   $this->update_ob->add_amnt($userid,'total_withdrawal',$amnt);

		// 							   $smsg="Withdrawal request success of amount  $crncy $amnt .";
		// 							   $this->session->set_flashdata("success", $smsg);
		// 							   redirect(base_url(uri_string()));
		// 							   $this->session->set_flashdata("error", $msg);
		// 				   }
		// 			   /////////////////////////////////////////////////////////////////////////////////	




		// 		   }
		// 	   }
		//    }

		public function matching_closing()
		{
			$arr = array();
			$source = 'binary';
			$crncy = $this->conn->company_info('currency');
			$all_users = $this->conn->runQuery('id', 'users', "active_status=1 ");
			$plan = $this->conn->runQuery('*', 'plan', "id='1'")[0];

			if ($all_users) {
				foreach ($all_users as $user_details) {
					$user_id = $user_details->id;
					$my_actives_left = $this->team->my_actives_position($user_id, 1);
					$ttl_actives_left = $my_actives_left != '' ? COUNT($my_actives_left) : 0;
					$my_actives_right = $this->team->my_actives_position($user_id, 2);
					$ttl_actives_right = $my_actives_right != '' ? COUNT($my_actives_right) : 0;
					//die();
					// if($ttl_actives_left>=1 && $ttl_actives_right>=1){

					$my_left = $this->team->team_by_pv($user_id, 1);
					$my_right = $this->team->team_by_pv($user_id, 2);
					//print_R($my_left);
					// 	 echo $user_id."<br>";
					echo "left" . $cout_my_left = $my_left . "<br>";
					echo "right" . $cout_my_right = $my_right . "<br>";
					// die();
					//echo "leftBV".$my_left_business=$this->team->team_by_business($user_id,1)."<br>";                	 
					// echo "rightBV".$my_right_business=$this->team->team_by_business($user_id,2)."<br>";
					$my_left_business = $this->team->team_by_business($user_id, 1);
					$my_right_business = $this->team->team_by_business($user_id, 2);
					if (($cout_my_left >= 1 && $cout_my_right >= 1) || ($cout_my_left >= 1 && $cout_my_right >= 1)) {
						//   echo "ewew";
						//   die();
						//echo "ttl_ben--".$ttl_ben=$this->team->ben_pairs($user_id);
						$ttl_ben = $this->team->ben_pairs($user_id);

						$ttl_matchings = min($my_left_business, $my_right_business);



						$ttl_max_matchings = max($my_left_business, $my_right_business);
						echo  "match1----" . $ttl_matchings . "<br>";
						//   echo  "match2----".$ttl_max_matchings."<br>";

						$carry_bes = ((int)$ttl_max_matchings - (int)$ttl_matchings);

						//   echo  "carry_bes----".$carry_bes."<br>";
						if ($my_left_business == $my_right_business) {
							$pos = "left";
						} elseif ($my_left_business > $my_right_business) {
							$pos = "left";
						} else {
							$pos = "right";
						}

						$ben_business = ((int)$ttl_matchings - (int)$ttl_ben);
						$my_pkgs = $this->business->package($user_id);



						$total_capping = $my_pkgs * 5;
						$per_pair = 10;
						$binary_amt1 = $ben_business * $per_pair / 100;
						$binary_amt = $binary_amt1;
						$flash = 0;
						$ben_pair = $binary_amt / $per_pair;



						echo "tt--" .
							$total_amount = $this->conn->runQuery('SUM(order_amount) as amts', 'orders', "u_code='$user_id' and status='1' ")[0]->amts;
						echo "<br>tamt" . $total_amount;
						$payable2 = $binary_amt + $total_amount;

						if ($total_capping > $payable2) {
							$payable = $binary_amt;
							$flash = 0;
						} else {
							$payable = $total_capping - $total_amount;
						}

						echo "<br>payable---" . $payable;
						//die();
						if ($payable > 0) {


							$arr1['source'] = $source;
							$arr1['u_code'] = $user_id;
							$arr1['tx_type'] = 'income';
							$arr1['debit_credit'] = 'credit';
							$arr1['wallet_type'] = 'income_wallet';

							$arr1['amount'] = $payable;
							$arr1['date'] = date('Y-m-d H:i:s');
							$arr1['status'] = 1;

							$arr1['remark'] = "Recieve $payable $crncy Matching Bonus ";
							$qury = $this->conn->get_insert_id('transaction', $arr1);
							echo "last" . $this->db->last_query();
							//die();
							if ($qury) {

								$mtching = array();
								$mtching['matching'] = $ben_business;
								$mtching['ben_matching'] = $ben_business;
								$mtching['flash'] = $flash;
								$mtching['u_code'] = $user_id;
								$mtching['tx_id'] = $qury;
								$mtching['status'] = 1;
								$this->db->insert('binary_matching', $mtching);
							}

							$this->update_ob->add_amnt($user_id, $source, $payable);
							$this->update_ob->any_update($user_id, 'matching', $ttl_matchings);
							$this->update_ob->any_update($user_id, 'carry', $carry_bes);
							$this->update_ob->add_amnt($user_id, 'main_wallet', $payable);
						}
					}
				}
				// }

			}
		}



		public function reward_closing()
		{
			$arr = array();
			$datetime = date('Y-m-d H:i:s');
			$source = 'reward';
			$crncy = $this->conn->company_info('currency');
			$all_users = $this->conn->runQuery('*', 'users', "active_status=1 and my_rank IS NOT NULL");
			if ($all_users) {
				foreach ($all_users as $user_details) {
					$user_id = $user_details->id;
					$rank_id = $user_details->my_rank;

					$plan_details = $this->conn->runQuery('*', 'plan', "package_name='$rank_id'");
					$rewards = $plan_details[0]->reward;
					$tx = $plan_details[0]->id;
					$max_rewards = $plan_details[0]->max_reward;

					$check_tx = $this->conn->runQuery('SUM(amount) as amts', 'transaction', "u_code='$user_id' and tx_type='income' and tx_record='$tx' and source='reward' ")[0]->amts;
					$total_amts = $check_tx + $rewards;
					if ($total_amts < $max_rewards) {
						$pay = $rewards;
					} else {
						$pay = $total_amts - $check_tx;
					}

					if ($pay > 0) {
						$income = array();
						$income['u_code'] = $user_id;
						$income['tx_type'] = 'income';
						$income['source'] = 'reward';
						$income['debit_credit'] = 'credit';
						$income['amount'] = $pay;
						$income['date'] = date('Y-m-d H:i:s');
						$income['added_on'] = date('Y-m-d H:i:s');
						$income['status'] = 1;
						$income['tx_record'] = $tx;
						$income['txs_res'] = 1;
						$income['wallet_type'] = 'reward';
						$income['remark'] = "Recieve $pay $ from Reward Income";

						if ($this->db->insert('transaction', $income)) {
							$income_lvl = $income['amount']; //-$income['tx_charge'];
							$this->update_ob->add_amnt($user_id, 'reward', $income_lvl);
							$this->update_ob->add_amnt($user_id, 'main_wallet', $income_lvl);
						}
					}
				}
			}
		}



		public function clear_form_submit()
		{
			$this->db->empty_table('form_request');
		}


		// 		public function auto_withdrawal()
		// 		{
		// 			$datetime = date('Y-m-d');
		// 			$all_cr_array = $this->conn->runQuery('id,name,username,my_rank,active_date', 'users', "active_status=1");


		// 			$min_wd_limit = $this->conn->setting('min_withdrawal_limit');
		// 			$crncy = $this->conn->company_info('currency');
		// 			$insertincome = array();

		// 			foreach ($all_cr_array as $user_details) {
		// 				echo $userid = $user_details->id;
		// 				$wallet_amt = $this->update_ob->wallet($userid, 'main_wallet');
		// 				$bank_details = $this->profile->my_default_account($userid);
		// 				$direct_details = $this->team->my_actives($userid);
		// 				if (!empty($bank_details)) {
		// 					if ($wallet_amt > $min_wd_limit  && count($direct_details) >= 2) {
		// 						$bank_details = $bank_details = $this->profile->my_default_account($userid); //$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
		// 						$inserttrans['bank_details'] = json_encode($bank_details);

		// 						$crncy = $this->conn->company_info('currency');

		// 						$inserttrans['wallet_type'] = 'main_wallet';
		// 						$inserttrans['tx_type'] = 'withdrawal';
		// 						$inserttrans['debit_credit'] = "debit";
		// 						$inserttrans['u_code'] = $userid;
		// 						$inserttrans['date'] = date('Y-m-d H:i:s');
		// 						$amnt = abs($wallet_amt);
		// 						$tx_charge = $amnt * 15 / 100;
		// 						$inserttrans['amount'] = $amnt - $tx_charge;
		// 						$inserttrans['tx_charge'] = $tx_charge;
		// 						$inserttrans['status'] = 0;
		// 						$inserttrans['open_wallet'] = $this->update_ob->wallet($userid, 'main_wallet');
		// 						$inserttrans['closing_wallet'] = $inserttrans['open_wallet'] - $inserttrans['amount'];
		// 						$inserttrans['remark'] = " Withdraw  $crncy $amnt";

		// 						if ($this->db->insert('transaction', $inserttrans)) {

		// 							//$this->update_ob->add_amnt($tx_u_code,$wallet_type,$amnt);
		// 							$this->update_ob->add_amnt($userid, 'main_wallet', -$amnt);
		// 							$this->update_ob->add_amnt($userid, 'total_withdrawal', $amnt);
		// 						}
		// 					}
		// 				}
		// 			}
		// 		}


		public function check()
		{
			$team = $this->team->my_generation(1);
			$team_details = $this->team->my_level_team(1);
			print_R($team_details);
		}


		public function checkss()
		{

			$with_dts = "2022-09-10 16:29:06"; //$user_withdrawals[0]->date;
			$current_days = date("Y-m-d");
			$from = date("Y-m-d", strtotime($with_dts));
			$dStart = new DateTime($from);
			$dEnd  = new DateTime($current_days);
			$dDiff = $dStart->diff($dEnd);
			echo $ttl_dt_diff = $dDiff->format('%r%a');
			die();
		}
	}
