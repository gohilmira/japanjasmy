<?php error_reporting(0); ?>
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
                Direct
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
        <div class="col-xl-12 p-3">
            <h5 class="user_card_title filter_title fs-4"><i class="fa fa-filter"></i>Filter</h5>
            <form class="form theme-form" action="<?= $panel_path . 'team/team-direct' ?>" method="get">
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
                                <select name="active_status" id="" class="form-select form-control digits">
                                    <option value="">-- Status --</option>
                                    <option value="1" <?php if ($select_status == "1") echo "selected"; ?>>Active</option>
                                    <option value="0" <?php if ($select_status == "0") echo "selected"; ?>>Inactive</option>
                                </select>


                            </div>
                        </div>
                    </div>
                    <div class="user_form_row_data" style="display: flex;">
                        <div class="user_submit_button mb-2">
                            <button type="button" name="submit" value="Filter" id="" class="btn btn-primary waves-effect waves-light">Filter</button>
                        </div>
                        <div class="user_submit_button mb-2 ms-2">

                            <button type="button" href="<?= $panel_path . 'team/team-direct' ?>" class="btn btn-danger waves-effect waves-light">Reset</button>
                        </div>

                    </div>
                </div>

            </form>
        </div>

    </div>

    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered border-primary mb-0">

                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Username</th>
                                <!--<th>Email</th>-->
                                <!--<th>Mobile</th>-->
                                <th>Join Date</th>
                                <th>Status</th>
                                <th>Package</th>
                                <?php $plan_ty = $this->conn->setting('reg_type');
                                if ($plan_ty == 'binary') {
                                ?>
                                    <th>Current Business</th>
                                    <th>Previous Business</th>
                                    <th>Position</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($table_data) {
                                foreach ($table_data as $t_data) {
                                    $sr_no++;

                                    $gen_team = $this->team->my_generation_with_personal($t_data['id']);

                            ?>
                                    <tr>
                                        <td><?= $sr_no; ?></td>
                                        <td><?= $t_data['name']; ?></td>
                                        <td><?= $t_data['username']; ?></td>
                                        <!-- <td><?= $t_data['email']; ?></td>-->
                                        <!--<td><?= $t_data['mobile']; ?></td>-->
                                        <td><?= $t_data['added_on']; ?></td>
                                        <td><?php
                                            if ($t_data['active_status'] == 1) {
                                                echo "Active<br>";
                                                echo $t_data['active_date'];
                                            } else {
                                                echo "Inactive";
                                            }
                                            ?></td>
                                        <td><?= $t_data['active_status'] == 1 ? $this->business->package($t_data['id']) : 0; ?></td>
                                        <?php $plan_ty = $this->conn->setting('reg_type');
                                        if ($plan_ty == 'binary') {
                                        ?>
                                            <td><?= $t_data['active_status'] == 1 ? $this->business->current_session_bv($gen_team) : 0; ?></td>
                                            <td><?= $t_data['active_status'] == 1 ? $this->business->previous_bv($gen_team) : 0; ?></td>
                                            <td><?= $t_data['position'] == 1 ? 'Left' : 'Right'; ?></td>
                                        <?php } ?>
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