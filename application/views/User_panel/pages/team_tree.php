<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<div class="content-inner">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Tree
                </h4>


            </div>

            <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
                <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">

                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content pt-0">

        <!-- Main charts -->


        <div class="row">
            <?php
            $userid = $this->session->userdata('user_id');


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

            <?php
            if ($node_id) {
                $_user_profile = $this->profile->profile_info($node_id);

                $sponsor_details = $this->profile->profile_info($_user_profile->u_sponsor);
            }
            $total_active = $this->team->actives();
            $left_teams = $this->team->team_by_position($node_id, 1);
            $active_left_team = array_intersect($total_active, $left_teams);
            $left_team = count($left_teams);

            $right_teams = $this->team->team_by_position($node_id, 2);
            $active_right_team = array_intersect($total_active, $right_teams);
            $right_team = count($right_teams);

            $active_left = $this->team->actives_left_right(1);
            $active_lefts = count($active_left);


            $red_units = $this->team->inactives();
            $inactive_right_team = array_intersect($red_units, $right_teams);
            $inactive_left_team = array_intersect($red_units, $left_teams);

            $total_direct_greens = $this->team->my_actives($node_id);
            $total_direct_green = count($total_direct_greens);

            $total_direct_reds = $this->team->my_inactives($node_id);
            $total_direct_red = count($total_direct_reds);

            $total_green_unit_left = $this->team->my_actives_left_right($node_id, 1);
            $total_green_unit_lefts = count($total_green_unit_left);

            $total_green_unit_right = $this->team->my_actives_left_right($node_id, 2);
            $total_green_unit_rights = count($total_green_unit_right);

            $total_direct_red_left = $this->team->my_inactives_left_right($node_id, 1);
            $total_direct_red_lefts = count($total_direct_red_left);

            $total_direct_red_right = $this->team->my_inactives_left_right($node_id, 2);
            $total_direct_red_rights = count($total_direct_red_right);

            $package = $this->business->package($node_id);

            $pv_bv = $this->conn->setting('binary_count_type');
            ?>
            <div class="col-xl-6">
                <div class="ca_rd">
                    <h5>Left Team</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>

                                        <th scope="col">Member</th>
                                        <th scope="col">BV</th>
                                        <!-- <?php if ($pv_bv == 'pv') { ?><th scope="col">P.V</th><?php } ?>-->

                                        <th scope="col">Green Unit </th>
                                        <th scope="col">Green Direct</th>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= $left_team != '' ? $left_team : '0'; ?></td>
                                        <td scope="row"> <?= $this->business->team_business_volume($node_id, 1); ?></td>

                                        <!-- <?php if ($pv_bv == 'pv') { ?><td><?= $this->business->team_pv($node_id, 1); ?></td><?php } ?>-->
                                        <td><?= COUNT($active_left_team) != '' ? count($active_left_team) : '0'; ?></td>
                                        <td><?= $total_green_unit_lefts != '' ? $total_green_unit_lefts : '0'; ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="ca_rd">
                    <h5>Right Team</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th scope="col">Member</th>
                                        <th scope="col">BV</th>
                                        <!-- <?php if ($pv_bv == 'pv') { ?><th scope="col">P.V</th><?php } ?>-->
                                        <th scope="col"> Green Unit </th>
                                        <th scope="col"> Green Direct</th>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= $right_team != '' ? $right_team : '0'; ?></td>
                                        <td scope="row"> <?= $this->business->team_business_volume($node_id, 2); ?></td>
                                        <!--<?php if ($pv_bv == 'pv') { ?><td> <?= $this->business->team_pv($node_id, 2); ?></td><?php } ?>-->
                                        <td><?= COUNT($active_right_team) != '' ? COUNT($active_right_team) : '0'; ?></td>
                                        <td><?= $total_green_unit_rights != '' ? $total_green_unit_rights : '0'; ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ca_rd">

            <form action="<?= $panel_path . 'team/team-tree'; ?>" class="form-inline my-2 my-lg-0" method="post">
                <input type="text" Placeholder="Enter Username" name="username" class="form-control mr-sm-2" value='<?= isset($_POST['username']) && $_POST['username'] != '' ? $_POST['username'] : ''; ?>' required />
                <select class="form-control mr-sm-2 selected_detail_data" name="selected_postion" id="" required>
                    <option value=''>Select</option>
                    <option value=''>Whole Team</option>
                    <option value='right'>Right Team</option>
                    <option value='left'>Left Team</option>

                </select>

                <input type="submit" name="" value="Filter" id="" class="user_btn_button btn btn-primary">&nbsp;
                <input type="submit" name="" value="Reset" id="" class="user_btn_button btn btn-danger">
            </form>
        </div>


        <div class="row">
            <div class="card">

                <div style="text-align: center;">

                    <center>

                        <div class="flex text-muted">
                            <div class="flex-item" style="--item-width:100% ">

                                <span <?php if ($node_id) { ?> data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?= $_user_profile ? $_user_profile->name : ''; ?><br>Sponsor Id:                                <?= $sponsor_details ? $sponsor_details->username : ''; ?><br> Total Member:&nbsp; L:<?= $left_team != '' ? $left_team : '0'; ?>&nbsp;R:<?= $right_team != '' ? $right_team : '0'; ?>
                <br>Kit :&nbsp;&nbsp; <?= $package; ?><br> Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team) != '' ? count($active_left_team) : '0'; ?>&nbsp;R:<?= COUNT($active_right_team) != '' ? COUNT($active_right_team) : '0'; ?> <br> Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_team) != '' ? COUNT($inactive_left_team) : '0'; ?>&nbsp;R:<?= COUNT($inactive_left_team) != '' ? COUNT($inactive_right_team) : '0'; ?>
                <br> Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts != '' ? $total_green_unit_lefts : '0'; ?>&nbsp;R:<?= $total_green_unit_rights != '' ? $total_green_unit_rights : '0'; ?><br> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts != '' ? $total_direct_red_lefts : '0'; ?>&nbsp;R:<?= $total_direct_red_rights != '' ? $total_direct_red_rights : '0'; ?><br> Time :<?= $_user_profile->active_date ? $_user_profile->active_date : ''; ?>" <?php } ?>>
                                    <img class="user" src="<?= base_url('images/users/tree_user.png'); ?>">

                                </span>
                                </br>

                                <?= $_user_profile->username; ?>
                                </br>
                                <span>
                                    <?= ($_user_profile->active_status == '1' ? 'Active' : 'Inactive'); ?>
                                </span>
                            </div>
                        </div>


                        <?php
                        $this->team->tree(1, $node_id);
                        ?>
                    </center>
                </div>
            </div>
        </div>
        <!-- /main charts -->
    </div>
    <!-- /content area -->

</div>