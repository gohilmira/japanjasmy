<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>


<?php
error_reporting(0);
$user_id = $this->session->userdata('user_id');
$type = $_REQUEST['income_type'];
$currency = $this->config->item('currency');
$reg_plan = $this->session->userdata('reg_plan');

$all_incomes = $this->conn->runQuery('*', 'wallet_types', "wallet_type='income' and $reg_plan='1'");
$all_income_arr = array();

if ($type == 'all') {
    $total = $this->conn->runQuery('SUM(amount) as total', 'transaction', "tx_type='income' and u_code='$user_id'")[0]->total;
    if ($all_incomes) {
        foreach ($all_incomes as $income) {
            $src = $income->slug;
            $name = $income->name;
            $all_income_arr[$name] = $this->conn->runQuery('SUM(amount) as total', 'transaction', "tx_type='income' and source='$src' and u_code='$user_id'")[0]->total;
        }
    }
}
if ($type == 'today') {
    $total = $this->conn->runQuery('SUM(amount) as total', 'transaction', "tx_type='income' and u_code='$user_id' and date(date)=DATE(NOW()) ")[0]->total;
    if ($all_incomes) {
        foreach ($all_incomes as $income) {
            $src = $income->slug;
            $name = $income->name;
            $all_income_arr[$name] = $this->conn->runQuery('SUM(amount) as total', 'transaction', "tx_type='income' and u_code='$user_id' and source='$src' and date(date)=DATE(NOW())")[0]->total;
        }
    }
}
if ($type == '24hour') {
    $yesterday = date('Y-m-d', strtotime($date . ' -1 days'));
    $total = $this->conn->runQuery('SUM(amount) as total', 'transaction', "tx_type='income' and u_code='$user_id' and (DATE(date)=DATE('$yesterday'))")[0]->total;
    if ($all_incomes) {
        foreach ($all_incomes as $income) {
            $src = $income->slug;
            $name = $income->name;
            $all_income_arr[$name] = $this->conn->runQuery('SUM(amount) as total', 'transaction', "tx_type='income' and u_code='$user_id' and source='$src' and (DATE(date)=DATE('$yesterday'))")[0]->total;
        }
    }
}
if ($type == 'currweek') {
    $total = $this->conn->runQuery('SUM(amount) as total', 'transaction', "tx_type='income' and u_code='$user_id' and WEEKOFYEAR(date)=WEEKOFYEAR(NOW())")[0]->total;
    if ($all_incomes) {
        foreach ($all_incomes as $income) {
            $src = $income->slug;
            $name = $income->name;
            $all_income_arr[$name] = $this->conn->runQuery('SUM(amount) as total', 'transaction', "tx_type='income' and u_code='$user_id' and source='$src' and WEEKOFYEAR(date)=WEEKOFYEAR(NOW())")[0]->total;
        }
    }
}
if ($type == 'lastweek') {
    $total = $this->conn->runQuery('SUM(amount) as total', 'transaction', "tx_type='income' and u_code='$user_id' and (WEEKOFYEAR(date)=WEEKOFYEAR(NOW())-1)")[0]->total;
    if ($all_incomes) {
        foreach ($all_incomes as $income) {
            $src = $income->slug;
            $name = $income->name;
            $all_income_arr[$name] = $this->conn->runQuery('SUM(amount) as total', 'transaction', "tx_type='income' and u_code='$user_id' and source='$src' and (WEEKOFYEAR(date)=WEEKOFYEAR(NOW())-1)")[0]->total;
        }
    }
}

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
                Reports
            </h1>
            <!--end::Title-->

            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                <!--begin::Item-->
                
            </ul>
            <!--end::Breadcrumb-->
        </div>
    </div>
    <!--end::Toolbar wrapper-->
</div>
<!--end::Toolbar container-->
</div><br>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="total_report_data">
                    <h4>Total Report</h4>
                    <form action="" method="get">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="report_table">
                                    <div class="form-group">
                                        <label class="control-label">Date wise income</label>

                                        <select name="income_type" id="income_type" class="form-control form-select">
                                            <option selected="" value="all" <?= ($type == 'all' ? 'selected' : '') ?>>Overall</option>
                                            <option value="today" <?= ($type == 'today' ? 'selected' : '') ?>>Today</option>
                                            <option value="24hour" <?= ($type == '24hour' ? 'selected' : '') ?>>Yesterday</option>
                                            <option value="currweek" <?= ($type == 'currweek' ? 'selected' : '') ?>>Current Week</option>
                                            <option value="lastweek" <?= ($type == 'lastweek' ? 'selected' : '') ?>>Last Week</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center" style="margin-top:35px;">
                                <div class="report_data_new">
                                    <button type="submit" name="btn_submit" class="btn btn-primary waves-effect waves-light ">View</button>
                                    <button onclick="printDiv('report_section')" class="btn btn-danger waves-effect waves-light ">Print </button>

                                    <a class="btn btn-primary waves-effect waves-light " href="<?= $panel_path . 'report/income?income_type=all'; ?>"><i class="fa fa-refresh" aria-hidden="true"></i></a>

                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="total_number">
                    <h4>Username</h4>

                    <span class="fs-5">
                        <?php
                        $user_id = $this->session->userdata('user_id');
                        $profile = $this->profile->profile_info($user_id);
                        echo $profile->username;
                        ?>

                    </span>
                    <h4>Total Income</h4>
                    <span class="fs-5"> <?= $currency; ?> <?= $total != '' ? round($total) : 0; ?></span>
                    <br>

                </div>

            </div>
            <div class="col-lg-12">
                <div class="card mt-5">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered border-primary mb-0">

                                <tbody>
                                    <?php
                                    if (!empty($all_income_arr)) {
                                        foreach ($all_income_arr as $income_name => $income) {
                                    ?>
                                            <tr>
                                                <th><?= $income_name; ?></th>
                                                <th><?= $currency; ?> <?= $income != '' ? round($income) : 0; ?></th>
                                            </tr>
                                    <?php
                                        }
                                    }

                                    ?>

                                    <tr class="text-black f-w-900">
                                        <td><b>Total</b></td>
                                        <td><b><?= $currency; ?> <?= $total != '' ? round($total) : 0; ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function printDiv(divName) {
        //alert('test');
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }

    // 		window.onload = function () {
    // document.getElementById("download")
    //     .addEventListener("click", () => {
    //         const income = this.document.getElementById("income");
    //         console.log(income);
    //         console.log(window);
    //         var opt = {
    //             margin: 1,
    //             filename: 'myfile.pdf',
    //             image: { type: 'jpeg', quality: 0.98 },
    //             html2canvas: { scale: 2 },
    //             jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    //         };
    //         html2pdf().from(income).set(opt).save();
    //     })
    //}	
</script>