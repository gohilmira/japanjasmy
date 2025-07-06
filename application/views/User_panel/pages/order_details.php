<?php
$profile = $this->session->userdata("profile");
$user_id = $this->session->userdata("user_id");
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
                Orders 
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
            <?php
            $userid = $this->session->userdata('user_id');
            $ttl = $this->conn->runQuery('sum(order_amount)as total,sum(order_bv)as bv', 'orders', "u_code='$user_id'");
            $ttl_amnt = $ttl[0]->total;
            $ttl_tx_charge = $ttl[0]->bv;
            ?>
            <div class="direct_in mb-5">
                <div class="income_direct">
                    <h3>Total Package Amount</h3>
                    <p class="fs-4"><?= round($ttl_amnt) ?></p>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered border-primary mb-0">

                                <thead>
                                    <tr>
                                        <th>S No.</th>
                                        <th>Package ID</th>
                                        <th>Package amount</th>
                                        <!--<th>Package BV</th>                -->
                                        <th>Package Date</th>
                                        <th>Package Status</th>
                                        <!--<th>Action</th>-->
                                    </tr>
                                    <?php
                                    $my_orders = $this->conn->runQuery('*', 'orders', "u_code='$user_id' ");

                                    if ($my_orders) {
                                        $sno = 0;
                                        foreach ($my_orders as $my_order) {
                                            $sno++;
                                    ?>
                                            <tr>
                                                <td><?= $sno; ?></td>
                                                <td>#<?= $my_order->id; ?></td>
                                                <td><?=$my_order->order_amount; ?></td>
                                                <!--<td><?= round($my_order->order_bv); ?></td>-->
                                                <td><?= $my_order->added_on; ?></td>
                                                <td><?= $my_order->status == 1 ? "Approved" : "Pending"; ?> </td>
                                                <!--<td><a href="<?= $panel_path . 'orders/bill?id=' . $my_order->id; ?>" class="user_btn_button">View Details</a></td>-->
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