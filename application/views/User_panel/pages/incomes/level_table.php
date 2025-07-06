<?php
$u_code = $this->session->userdata('user_id');

$ttl_income = $this->conn->runQuery('(SUM(amount) - SUM(tx_charge)) as amnt,SUM(amount) as ttl', 'transaction', "u_code='$u_code' and tx_type='income' and source='$source'");
$total =  $ttl_income[0]->ttl != '' ? $ttl_income[0]->ttl : 0;
$payable =  $ttl_income[0]->amnt != '' ? $ttl_income[0]->amnt : 0;


?>
<div class="container pages">
<div id="kt_app_toolbar" class="app-toolbar  pt-6 pb-2 ">

<!--begin::Toolbar container-->
<div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex align-items-stretch ">
    <!--begin::Toolbar wrapper-->
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">


        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center   fw-bold fs-3 m-0">
            <?=ucfirst($source);?> Income
            </h1>
            <!--end::Title-->

            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
             

            </ul>
            <!--end::Breadcrumb-->
        </div>
    </div>
    <!--end::Toolbar wrapper-->
</div>
<!--end::Toolbar container-->
</div>
        <div class="row">
            <div class="col-xl-12  p-3">
                <h5 class="user_card_title filter_title fs-4"><i class="fa fa-filter"></i>Filter</h5>
                <form class="form theme-form" action="<?= $panel_path . 'income/details' ?>" method="get">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="mb-3">
                                    <input name="name" type="text" id="" value='<?= isset($_REQUEST['name']) && $_REQUEST['name'] != '' ? $_REQUEST['name'] : ''; ?>' class="form-control" placeholder="Search by Name">

                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="mb-3">
                                    <input name="username" type="text" id="" value='<?= isset($_REQUEST['username']) && $_REQUEST['username'] != '' ? $_REQUEST['username'] : ''; ?>' class="form-control" placeholder="Search by User ID">

                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="mb-3">
                                    <input name="start_date" type="date" id="" class="form-control" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date'] : ''); ?>" placeholder="From Registration Date">


                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="mb-3">
                                    <input name="end_date" type="date" id="end_date" class="form-control" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date'] : ''); ?>" placeholder="To Registration Date">

                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="mb-3">
                                    <select name="select_level" id="" class="form-select form-control digits">
                                        <option value="">Select Level</option>
                                        <?php
                                        for ($f = 1; $f <= 5; $f++) {
                                        ?>
                                            <option value="<?= $f; ?>" <?= isset($_REQUEST['select_level']) && $_REQUEST['select_level'] == $f ? 'selected' : ''; ?>>Level <?= $f; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                            <div class="col-xl-3">
                                <div class="mb-3">

                                    <select name="limit" id="" class="form-select form-control digits">
                                        <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit'] == 20 ? 'selected' : ''; ?>>20</option>
                                        <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit'] == 50 ? 'selected' : ''; ?>>50</option>
                                        <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit'] == 100 ? 'selected' : ''; ?>>100</option>
                                        <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit'] == 200 ? 'selected' : ''; ?>>200</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="user_form_row_data" style="display: flex;">
                            <div class="user_submit_button mb-2">
                                <button type="button" class="user_btn_button btn btn-primary">Filter</button>
                            </div>
                            <div class="user_submit_button mb-2 ms-2">

                                <button type="button" href="<?= $panel_path . 'income/details' ?>" class="user_btn_button btn btn-danger">Reset</button>
                            </div>

                        </div>
                    </div>

                </form>
            </div>

        </div>
        <div class="direct_in mb-4 mt-3">
            <div class="income_direct">
                <h5>Total Income</h5>
                <p><?= $total ? $total : 0; ?></p>
            </div>
            <div class="income_direct">
                <h5>Payable Income</h5>
                <p><?= $payable ? $payable : 0; ?></p>
            </div>
            <?php
            $is_payout = $this->conn->setting('earning_type');
            if ($is_payout == 'payout') {
                $generated_amts = $this->wallet->generated_payout_by_income($u_code, $source);
                $pending_amts = $this->wallet->pending_payout_by_income($u_code, $source);
            ?>
                | Generated Payout : <?= $generated_amts != '' ? $generated_amts : 0; ?>
                | Expected Payout : <?= $pending_amts != '' ? $pending_amts : 0; ?>
            <?php
            }

            ?>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered border-primary mb-0">

                            <thead>
                                <tr>
                                    <th class="text-left border-right">S No.</th>
                                    <th class="text-left">User</th>
                                    <th class="text-left">From</th>
                                    <th class="text-left">Level</th>
                                    <th class="text-right">Amount (<?= $this->conn->company_info('currency'); ?>)</th>
                                    <!-- <th  class="text-right" >Extra Charges (<?= $this->conn->company_info('currency'); ?>)</th>-->
                                    <th class="text-left">Remark</th>
                                    <th class="text-left">Date </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user = $this->session->userdata('profile');
                                if ($table_data) {

                                    foreach ($table_data as $t_data) {
                                        $tx_profile = false;
                                        $tx_profile = $this->profile->profile_info($t_data['tx_u_code']);
                                        $sr_no++;
                                ?>
                                        <tr>
                                            <td class="text-left border-right"><?= $sr_no; ?></td>
                                            <td class="text-left"><?= $user->name; ?> (<?= $user->username; ?>) </td>
                                            <td class="text-left"><?= $tx_profile ? $tx_profile->name : ''; ?> ( <?= $tx_profile ? $tx_profile->username : ''; ?> )</td>
                                            <td class="text-left"><?= $t_data['tx_record']; ?></td>
                                            <td class="text-right"><?= round($t_data['amount'], 2); ?></td>
                                            <!--  <td class="text-right"><?= round($t_data['tx_charge'], 2); ?></td>-->
                                            <td class="text-left"><small><?= $t_data['remark']; ?></small></td>
                                            <td class="text-left"><?= $t_data['date']; ?></td>

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
        <?php echo $this->pagination->create_links(); ?>
    </div>

</div>