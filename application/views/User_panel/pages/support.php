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
                        Support
                    </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="<?= $panel_path . 'dashboard'; ?>" class="text-muted text-hover-primary">
                                Home </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            Pages </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            Support </li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div><br>
    <div class="row">
        <form action="#" method="get">
            <div class="col-12">
                <div class="support_tcket_data">
                    <div class="row align-items-center">

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="ticket_data_detail">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label fs-5" for="formrow-firstname-input">Ticket Id</label>
                                        <input type="text" Placeholder="ticket id" name="ticket" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name'] != '' ? $_REQUEST['name'] : ''; ?>'>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" col-lg-6 col-md-12 col-sm-12">
                            <div class="ticket_data_detail">
                                <div class="form-group">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Status</label>
                                        <select id="formrow-inputState" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="0">Not Replied</option>
                                            <option value="1">Replied</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">

                            <div class="tickets_buttons email_buttons">

                                <button type="button" name="submit" class="me-2  btn btn-primary waves-effect waves-light">Search</button>
                                <button type="button" href="<?= $panel_path . 'support' ?>" class=" btn btn-danger waves-effect waves-light">Reset</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div><br>
    <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
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
            $user_id = $this->session->userdata('user_id');
            $profile = $this->profile->profile_info($user_id);

            $support = $this->conn->runQuery('COUNT(id) as ttl', 'support', "u_code='$user_id'")[0]->ttl;
            $support_not_replied = $this->conn->runQuery('COUNT(id) as ttl', 'support', "u_code='$user_id' and status='0'")[0]->ttl;
            $support_replied = $this->conn->runQuery('COUNT(id) as ttl', 'support', "u_code='$user_id' and status='1'")[0]->ttl;


            ?>
            <div class="support_page_new_design">
                <div class="support_datail">
                    <h4>support detail</h4>
                    <ul>

                        <li>
                            Not Replied inquiry
                            <span class="red_color"><?= ($support_not_replied) ? ($support_not_replied) : 0; ?></span>
                        </li>
                        <li>
                            Replied inquiry
                            <span class="green_color"><?= ($support_replied) ? ($support_replied) : 0; ?></span>
                        </li>
                        <li>
                            Total inquiry
                            <span class="green_color"><?= ($support) ? ($support) : 0; ?></span>
                        </li>
                    </ul>
                </div>
                <div class="urgent_email">
                    <div class="urgent_inner_content">
                        <h4>Urgent inquiry Information</h4>
                        <ul>
                            <li>Name: <?= $profile->name; ?></li>
                            <li>Email: <?= $profile->email; ?></li>
                            <li>Phone: <?= $profile->mobile; ?></li>
                        </ul>
                    </div>

                </div>
                <div class="recent_email_inquiry">
                    <h4>latest ticket</h4>
                    <ul>
                        <?php
                        $support_latest = $this->conn->runQuery('*', 'support', "u_code='$user_id' order by id DESC limit 5");
                        if ($support_latest) {
                            foreach ($support_latest as $support) {
                        ?>
                                <li>
                                    <div class="email_inquiry">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </div>

                                    <div class="email_inquiry_text">
                                        <h6><?= $support->ticket; ?></h6>
                                        <p><?= $support->timestamp; ?></p>
                                        <p><?= $support->message; ?></p>
                                    </div>

                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="total_ticket_number_emil">
                <h4>
                    NEW SUPPORT TICKET
                </h4>
                <p>Would you like to speak to one of our financial advisers over the phone?
                    Just submit your details and we'll be in touch shortly. You can also
                    email us if you would prefer.</p>
                <div class="email_enquiry_form">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputname">name</label>
                                    <input type="text" class="form-control" id="exampleInputname" placeholder="demo" value="<?= $this->session->userdata('profile')->name; ?>" readonly>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputname">Email</label>
                                    <input type="email" id="" class="form-control " value="companyname@gmail.com" value="<?= $this->session->userdata('profile')->email; ?>" readonly>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputname">Description</label>
                                    <textarea required="" class="form-control" rows="4" name="description"></textarea>
                                </div>
                                <div class="email_buttons mt-3">

                                    <button type="button" class="me-2 btn btn-primary waves-effect waves-light">Send</button>
                                    <button type="button" href="<?= $panel_path . 'support' ?>" class=" btn btn-danger waves-effect waves-light">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Support Ticket</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered border-primary mb-0">

                                <thead>
                                    <tr>
                                        <th>Ticket Id</th>
                                        <th>Description</th>
                                        <th>Create Date</th>
                                        <th>Status</th>
                                        <th>Reply</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $user = $this->session->userdata('profile');
                                    if ($table_data) {
                                        foreach ($table_data as $t_data) {
                                            $sr_no++;
                                    ?>
                                            <tr>
                                                <td><?= $t_data['ticket']; ?></td>
                                                <td><?= $t_data['message']; ?></td>
                                                <td><?= $t_data['updated_on']; ?></td>
                                                <td><?php
                                                    $rst = $t_data['reply_status'];
                                                    if ($rst == 0) {
                                                    ?>
                                                        <button class="btn btn-danger">Not Replied</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn btn-success">Replied</button>
                                                    <?php
                                                    }
                                                    ?></th>
                                                <td><?= $t_data['reply']; ?></td>
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