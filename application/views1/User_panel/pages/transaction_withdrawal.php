<style>
    .card1 {
    margin-bottom: 1.875rem;
    background-color: #ffffff14;
    transition: all .5s ease-in-out;
    position: relative;
    border: 0rem solid transparent;
    border-radius: 0.75rem;
    /* height: calc(100% - 30px); */
    box-shadow: 0px 4px 2px 0px #00000005;
}
</style>
<?php

$userid = $this->session->userdata('user_id');
$total_withdrawal = $this->conn->runQuery("SUM(amount) as amt", 'transaction', "u_code='$userid' and tx_type='withdrawal'");
$total_paid_withdrawal = $this->conn->runQuery("SUM(amount) as amt", 'transaction', "u_code='$userid' and tx_type='withdrawal' and status='1'");
$total_reject_withdrawal = $this->conn->runQuery("SUM(amount) as amt", 'transaction', "u_code='$userid' and tx_type='withdrawal' and status='2'");
?>
<div class="content-body">
			<div class="container">
                <div class="row mb-5">
                            
					<div class="col-sm-6">
						<div class="page-title-box">
							<h4>Withdrawal Report</h4>
								
						</div>
					</div>
					
				</div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="widthrawal_innce_report">
                            <form action="" method="post">
                            <div class="withdrawal_ecxel">
                                <button type="button" name="export_to_excel" class="btn btn-primary waves-effect waves-light">Export to excel </button>
                                <input type="hidden" name="userid" value="<?= $userid; ?>">
                                
                            </div>
                            </form>
                            <ul class="mt-2">
                                <li>
                                    <h6 class="fs-5">Total Withdrawal</h6>
                                    <p><?= $this->conn->company_info('currency'); ?>&nbsp;<?= ($total_withdrawal[0]->amt != '' ? $total_withdrawal[0]->amt : 0); ?></p>
                                </li>
                                <li>
                                    <h6 class="fs-5">Paid Withdrawal</h6>
                                    <p><?= $this->conn->company_info('currency'); ?>&nbsp;<?= ($total_paid_withdrawal[0]->amt != '' ? $total_paid_withdrawal[0]->amt : 0); ?></p>
                                </li>
                                <li>
                                    <h6 class="fs-5">Reject Withdrawal</h6>
                                    <p><?= $this->conn->company_info('currency'); ?>&nbsp;<?= ($total_reject_withdrawal[0]->amt != '' ? $total_reject_withdrawal[0]->amt : 0); ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card1">
                            <div class="card-body">
                                   
                                <div class="table-responsive">
                                    <table class="table table-bordered border-primary mb-0">

                                        <thead>
                                            <tr>
                                            <th>S No.</th>
                                    <th>Amount ($)</th>
                                    <!--<th>TDS(5%)</th>-->
                                    <th>Withdrawal charge ($)</th>
                                    <th>Autopool Purchase</th>
                                    <th>Payable Amount ($)</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                    <th>Date </th>
                                            </tr>
                                            <?php
                                $user = $this->session->userdata('profile');
                                if ($table_data) {

                                    foreach ($table_data as $t_data) {
                                        $tx_profile = false;
                                        $tx_profile = $this->profile->profile_info($t_data['tx_u_code']);
                                        $sr_no++;
                                ?>
                                        <tr>
                                            <td><?= $sr_no; ?></td>
                                            <td><?= $ttl = $t_data['amount'] + $t_data['tx_charge']; ?></td>

                                            <td><?= $t_data['tx_charge']; ?></td>
                                            <td><?= $t_data['autopool_amount']; ?></td>
                                            <td><?= $t_data['amount']; ?></td>
                                            <td><?php
                                                switch ($t_data['status']) {
                                                    case 1:
                                                        echo 'Approved';
                                                        break;
                                                    case 0:
                                                        echo 'Pending';
                                                        break;
                                                    case 2:
                                                        echo 'Rejected';
                                                        break;
                                                }
                                                ?></td>
                                            <td><?= $t_data['reason']; ?></td>
                                            <td><?= $t_data['date']; ?></td>

                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
			</div>

		</div>