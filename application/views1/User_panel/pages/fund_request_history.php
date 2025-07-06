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
                      Fund Request History
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
        <div class="col-xl-12 p-3 border">
            <h5 class="user_card_title filter_title fs-4"><i class="fa fa-filter"></i>Filter</h5>
            <form class="form theme-form" action="<?= $panel_path . 'fund/request_history' ?>" method="get">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="mb-3">

                                <select name="limit" id="" class="form-select form-control input-default">
                                    <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit'] == 20 ? 'selected' : ''; ?>>20</option>
                                    <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit'] == 50 ? 'selected' : ''; ?>>50</option>
                                    <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit'] == 100 ? 'selected' : ''; ?>>100</option>
                                    <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit'] == 200 ? 'selected' : ''; ?>>200</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="mb-3">

                                <select name="status" class="form-select form-control input-default">
                                    <option value="all">Select Status</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Rejected</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="mb-3">
                                <input name="start_date" type="date" id="" value='<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date'] : ''); ?>"' class="form-control">

                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="mb-3">
                                <input name="end_date" type="date" id="" value='<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date'] : ''); ?>"' class="form-control">

                            </div>
                        </div>
                    </div>
                    <div class="user_form_row_data" style="display: flex;">
                        <div class="user_submit_button mb-2">
                            <button type="button" class="btn btn-primary waves-effect waves-light">Filter</button>
                        </div>
                        <div class="user_submit_button mb-2 ms-2">

                            <button type="button" href="<?= $panel_path . 'fund/request_history' ?>" class="btn btn-danger waves-effect waves-light">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xl-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent-4">
                        <div class="tab-pane fade show active" id="leftPosition" role="tabpanel" aria-labelledby="home-tab-4">
                            <div class=" ">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>S No.</th>


                                                <th>Amount (<?= $this->conn->company_info('currency'); ?>)</th>
                                                <th> Method</th>
                                                <th> Type</th>
                                                <th>UTR Number</th>
                                                <th>Payment Slip</th>
                                                <th>Status</th>
                                                <th>Reason</th>
                                                <th>Date </th>
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



                                                        <td><?= $t_data['amount']; ?></td>
                                                        <td><?= $t_data['cripto_type']; ?></td>
                                                        <td><?= $t_data['payment_type']; ?></td>
                                                        <td><?= $t_data['cripto_address']; ?></td>
                                                        <td><a href="<?= $t_data['payment_slip']; ?>" target="_blank"><img src="<?= $t_data['payment_slip']; ?>" style="height:50px;width:50px;"></td>
                                                        <td>
                                                            <?php
                                                            switch ($t_data['status']) {
                                                                case '1':
                                                                    echo 'Approved';
                                                                    break;
                                                                case '0':
                                                                    echo 'Pending';
                                                                    break;
                                                                case '2':
                                                                    echo 'Rejected';
                                                                    break;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="text-left"><small><?= $t_data['reason']; ?></small></td>
                                                        <td class="text-left"><?= $t_data['updated_on']; ?></td>

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

<?php echo $this->pagination->create_links(); ?>