<?php
error_reporting(0);
$plan_type = $this->session->userdata('reg_plan');
$profile = $this->session->userdata("profile");
$user_id = $this->session->userdata('user_id');
$plan = $this->conn->runQuery("*", 'plan', "1=1");
$website_settings = $this->conn->plan_setting("dashboard");
$currency = $this->conn->company_info('currency');
$incomes = $this->conn->runQuery("*", 'wallet_types', "wallet_type='income' and  status='1' and $plan_type='1'");
$team = $this->conn->runQuery("*", 'wallet_types', "wallet_type='team' and  status='1' and $plan_type='1'");
$wallets = $this->conn->runQuery("*", 'wallet_types', "wallet_type IN ('wallet') and  status='1'  and $plan_type='1'");
$wallets_pin = $this->conn->runQuery("*", 'wallet_types', "wallet_type IN ('pin') and  status='1'  and $plan_type='1'");
$withdrawals = $this->conn->runQuery("*", 'wallet_types', "wallet_type = 'withdrawal' and  status='1'  and $plan_type='1'");
$payouts = $this->conn->runQuery("*", 'wallet_types', "wallet_type = 'payout' and  status='1'  and $plan_type='1'");
$w_balance = $this->conn->runQuery('*', 'user_wallets', "u_code='$user_id'");
$wallet_balance = $w_balance ? $w_balance[0] : array();
$latest_earnings = $this->conn->runQuery('*', 'transaction', "u_code='$user_id' and tx_type='income' order by id desc LIMIT 6");
$total = $this->conn->runQuery('SUM(amount) as total', 'transaction', "u_code='$user_id' and tx_type='income'")[0]->total;
$my_package = $this->business->package($user_id);

$u_sponsorssss = $this->conn->runQuery('u_sponsor', 'users', "id='$user_id' and 1=1");

$spons_id = $u_sponsorssss[0]->u_sponsor;


$u_spos = $this->conn->runQuery('username,name', 'users', "id='$spons_id' and 1=1");

$sponsor_name = $u_spos[0]->name;
$sponsor_username = $u_spos[0]->username;
$sponsor_name = $u_spos["name"];
$sponsor_username = $u_spos["username"];

?>
<style>
    p{
        font-size: initial;
    }
    
    
</style>
<?php
if ($currency == 'Rs') {

    $fas = "fa fa-inr";
} elseif ($currency == '$') {
    $fas = "fa fa-dollar";
}

?>
<?php
$panel_pa = $this->conn->company_info('panel_directory');
$this->load->view($panel_pa . '/pages/dashboard/alert');
?>
<!-- Main container starts -->
<div class="container main-container" id="main-container">
<?php
        $success['param'] = 'success';
        $success['alert_class'] = 'alert-success';
        $success['type'] = 'success';
        $this->show->show_alert($success);
        ?>
        <?php
        $erroralert['param'] = 'error';
        $erroralert['alert_class'] = 'alert-danger';
        $erroralert['type'] = 'error';
        $this->show->show_alert($erroralert);
        ?>
<div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card border-0 shadow-sm mb-4">
                <div class="background-half text-template-primary-opac-10"></div>
                <div class="card-header border-0 bg-none">
                    <div class="row">
                        <div class="col">
                            <p class="fs15">Dashboard<br><small class="text-template-primary-light">
                                    <?= $this->conn->company_info('company_name'); ?>
                                </small>
                            </p>
                        </div>

                    </div>
                </div>
                <div class="card-body text-center">
                    <p class="text-template-primary-light  mb-2">My Package</p>
                    <h4 class="font-weight-light mb-0">
                        <?= $my_package ? $my_package : 0; ?>&nbsp;
                        <?= $currency; ?>
                    </h4>
                    
                </div>
            </div>
        </div>
</div>

    <div class="row mt-3">

   

        <?php
        foreach ($incomes as $income) {
            $slug = $income->wallet_column;
            $source = $income->slug;
            if ($slug == $slug) {
                $col = '3';
                $today_income_all = $this->conn->runQuery('SUM(amount) as today', 'transaction', "u_code='$user_id' and source='$source' and tx_type='income' and date(date)=DATE(NOW())")[0]->today;
            } elseif ($slug == $slug) {
                $col = '3';
                $today_income_all = $this->conn->runQuery('SUM(amount) as today', 'transaction', "u_code='$user_id' and source='$source' and tx_type='income' and date(date)=DATE(NOW())")[0]->today;
            } elseif ($slug == $slug) {
                $col = '3';
                $today_income_all = $this->conn->runQuery('SUM(amount) as today', 'transaction', "u_code='$user_id' and  source='$source' and tx_type='income' and date(date)=DATE(NOW())")[0]->today;
            } elseif ($slug == $slug) {
                $col = '3';
                $today_income_all = $this->conn->runQuery('SUM(amount) as today', 'transaction', "u_code='$user_id' and source='$source' and tx_type='income' and date(date)=DATE(NOW())")[0]->today;
            } else {
                $col = '6';
            }
            ?>

            <?php
            if ($income->name == "Friend add Income") {
                $chart = 'summary-one';
            } elseif ($income->name == "Team Income") {
                $chart = 'summary-two';
            } elseif ($income->name == "Perday Income") {
                $chart = 'circle-green';
            } elseif ($income->name == "Reward Income") {
                $chart = 'summarysparklines';
            }
            ?>

            <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card border-0 shadow-sm overflow-hidden mb-4">
                    <div class="card-body py-0">
                        <div class="row">
                            <div class="col py-2 pr-0">
                                <p>
                                    <?= $income->name; ?>
                                </p><br>
                                <h4 class="font-weight-light mb-0"><small>
                                        <?= $currency; ?>&nbsp;
                                    </small>
                                    <?= $ttl[] = round(!empty($wallet_balance) && round(isset($wallet_balance->$slug),0) ? round($wallet_balance->$slug,2) : 0, 2); ?>
                                </h4>
                            </div>
                            <div class="col-auto bg-primary  text-white py-2">
                                <p class="mb-0"><small><span class="text-mute d-block">
                                            <?= $currency; ?>&nbsp;
                                            <?= round($today_income_all,0) ? round($today_income_all,0) : 0; ?>
                                        </span></small></p>
                                <div class="summary-one"><canvas id="<?= $chart; ?>"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        <?php } ?>
      
        <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card border-0 shadow-sm overflow-hidden mb-4">
                    <div class="card-body py-0">
                        <div class="row">
                            <div class="col py-2 pr-0">
                                <p>
                                Total Income 
                                </p><br>
                                <h4 class="font-weight-light mb-0"><small>
                                        <?= $currency; ?>&nbsp;
                                    </small>
                                    <?= round($total,0) ? round($total,0) : 0;  ?>
                                </h4>
                            </div>
                            <div class="col-auto bg-primary  text-white py-2">
                                <p class="mb-0"><small><span class="text-mute d-block">
                                            <?= $currency; ?>&nbsp;
                                             <?= round($total,0) ? round($total,0) : 0;  ?>
                                        </span></small></p>
                                <div class="summary-one"><canvas id="<?= $chart; ?>"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <div class="row">
    <div class="col-12 col-md-12 col-lg-6 col-xl-6 mx-auto">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header">
                <div class="row ">
                    <!-- <div class="col-auto">
                        <img src="https://maxartkiller.com/website/AdminuxPRO/HTML/assets/img/logoicon.svg" alt=""
                            class="w-50px">
                    </div> -->
                    <div class="col-auto">
                        <h6 class="mt-0 mb-1">Referral Link</h6>
                        <p class="text-mute mb-0">User Dashboard</p>
                    </div>
                    <div class="col text-right">
                        <p class="text-mute">Usename :
                            <?= $this->session->userdata('profile')->username; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row justify-content-center">
                    <div class="col-md-12 mx-auto">
                        <div class="row ">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group ">
                                    <input type="text" class="form-control"
                                        placeholder="<?php echo $left_link = base_url('register?ref=' . $profile->username); ?>"
                                        value="<?php echo $left_link = base_url('register?ref=' . $profile->username); ?>"
                                        id="referral_link_left">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button class="btn btn-primary copyButton" onclick="copyLink1('left')">Copy</button>
            </div>
        </div>
    </div>
      
    <div class="col-12 col-md-12 col-lg-6 col-xl-6">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header border-0 bg-none">
                <div class="row">
                    <div class="col align-self-center">
                        <p class="fs15">Payout Reports<br><small class="text-template-primary-light">Most recent new
                                registrations</small></p>
                    </div>
                </div>
            </div>
            <?php
            $payout_approved = $this->conn->runQuery('SUM(amount) as total', 'transaction', "u_code='$user_id' and tx_type='withdrawal' and status='1'")[0]->total;
            $payout_pending = $this->conn->runQuery('SUM(amount) as total', 'transaction', "u_code='$user_id' and tx_type='withdrawal' and status='0'")[0]->total;
            $payout_rejected = $this->conn->runQuery('SUM(amount) as total', 'transaction', "u_code='$user_id' and tx_type='withdrawal' and status='2'")[0]->total;
            ?>
            <div class="card-body ">
                <div class="row">
                    <div class="col-6 mb-4 text-center">
                        
                        <p class="mb-1">Payout Rejected</p>
                        <p class="text-template-primary-light">
                            <?= $currency; ?>&nbsp;
                            <?= $payout_rejected != '' ? $payout_rejected : 0; ?>
                        </p>
                    </div>
                    <div class="col-6 mb-4 text-center">
                        
                        <p class="mb-1">Payout Released</p>
                        <p class="text-template-primary-light">
                            <?= $currency; ?>&nbsp;
                            <?= $payout_approved != '' ? $payout_approved : 0; ?>
                        </p>
                    </div>
                    <div class="col-6 text-center">
                        
                        <p class="mb-1">Payout Pending</p>
                        <p class="text-template-primary-light">
                            <?= $currency; ?>&nbsp;
                            <?= $payout_pending != '' ? $payout_pending : 0; ?>
                        </p>
                    </div>

                </div>
            </div>
        </div>




    </div>
  
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header border-0 bg-none">


                    <div class="row">
                        <div class="col align-self-center">
                            <p class="fs15">Team Section</p>
                        </div>

                    </div>
                </div>
                <div class="card-body pt-2">
                    <div class="row">
                       
                    
                                    <?php
                                    foreach ($team as $section) {
                                        $slug = $section->wallet_column;
                                        ?>
                            <div class="col-sm-6 col-lg-2 text-center">
                                <p class="mb-1"> <?= $section->name; ?></p>
                                <p class="text-template-primary-light">
                                    
                                    <?= (!empty($wallet_balance) && isset($wallet_balance->$slug) ? $wallet_balance->$slug : 0); ?>
                                </p>
                            </div>
                                    <?php } ?>
                                    <?php
                            foreach ($wallets as $section) {
                                $slug =  $section->wallet_column;
                            ?>
                            <div class="col-sm-6 col-lg-2 text-center">
                                <p class="mb-1"> <?= $section->name; ?></p>
                                <p class="text-template-primary-light">
                                    
                                    <?= (!empty($wallet_balance) && isset($wallet_balance->$slug) ? $wallet_balance->$slug : 0); ?>
                                </p>
                            </div>
                                    <?php } ?>

                                

                        

                    </div>
                </div>
            </div>

        </div>
   
        </div>

    </div>

   
<div class="row">
    
        <div class="col-12 col-md-12 col-lg-11 col-xl-11 " style="margin-left: 5%;">
                <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header border-0 bg-none">
                                        <div class="row">
                                                <div class="col-12 col-md">
                                                    <p class="fs15">Latest Earnings</p>
                                                </div>
                                        
                                        </div>
                                </div>
                                <div class="card-body ">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6"></div>
                                            <div class="col-sm-12 col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table datatable display responsive dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Amount type</th>
                                                            <th>Total amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $currency = $this->conn->company_info('currency');
                                                        if ($latest_earnings) {
                                                            foreach ($latest_earnings as $earnings) {
                                                        ?>
                                                                <tr>
                                                                    <td><?= $earnings->date; ?></td>
                                                                    <td><?= $earnings->source; ?> Income</td>
                                                                    <td><?= $currency; ?><?= $earnings->amount; ?></td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                    </div>
        </div>

    </div>
   
    
</div>
    
</div>
</div>
<!-- Main container ends -->


</div>