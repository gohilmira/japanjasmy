<style>
    .card_profile_footer {
        display: flex;
        align-items: center;
    }

    .profile_card_bottom {
        display: flex;
        align-items: center;
    }
</style>
<?php
$profile = $this->session->userdata("profile");
$user_id = $profile->id;
?>


<div class="container pages">
    <div class="container" style="margin-top:100px">
        <div class="main-body">
            <div id="kt_app_toolbar" class="app-toolbar  pt-6 pb-2 ">

                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex align-items-stretch ">
                    <!--begin::Toolbar wrapper-->
                    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">


                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                            <!--begin::Title-->
                            <h1 class="page-heading d-flex flex-column justify-content-center   fw-bold fs-3 m-0">
                                Edit profile
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
            </div>  <?php
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

              
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <?php if ($profile->img != '') { ?>
                                    <img src="<?= base_url('images/users/') . $profile->img; ?>" alt="images" class="rounded-circle p-1 bg-primary" width="110">
                                <?php } else { ?>
                                    <img src="<?= $this->conn->company_info('logo'); ?>" alt="images" width="110">
                                <?php } ?>
                                <div class="mt-3">
                                    <h4><?= $profile->username; ?></h4>
                                    <p class="  mb-1"><?= $profile->name; ?>, <?= $profile->country; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card">
                            <form action="" method="post" enctype='multipart/form-data'>
                                <div class="card-body">
                                    <p class="text-muted font-size-sm">
                                    <h4>Edit Profile</h4>
                                    </p>
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0" for="exampleInputname">Username</h6>
                                        </div>
                                        <div class="col-sm-8  ">
                                            <input type="text" class="form-control" id="exampleInputname" placeholder="" value="<?= $profile->username; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0" for="exampleInputname">Name</h6>
                                        </div>
                                        <div class="col-sm-8  ">
                                            <input type="text" class="form-control" id="exampleInputname" placeholder="Name" name="name" value="<?= $profile->name; ?>">

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0" for="exampleInputEmail1">Profile Pic</h6>
                                        </div>
                                        <div class="col-sm-8  ">
                                            <input type="file" class="form-control" name="profile_pic" id="exampleInputEmail1" placeholder="Email Address">
                                            <span class="text-danger"><?= (isset($upload_error) ? $upload_error : ''); ?></span>
                                        </div>
                                    </div>
                                    

                                    <?php
                                    //  if($profile_edited!='readonly'){
                                    $edit_profile_with_otp = $this->conn->setting('edit_profile_with_otp');
                                    if ($edit_profile_with_otp == 'yes') {
                                        $display = (isset($_SESSION['otp']) ? 'block' : 'none');
                                    ?>
                                        <button type="button" data-response_area="action_areap" class="user_btn_button send_otp">Send OTP</button>

                                        <div id="action_areap" style="display:<?= $display; ?>">
                                            <!--<p> Resend OTP in <span id="countdowntimer">30 </span> Seconds</p>-->
                                            <!-- <button type="button" data-response_area="action_areap" id="proceed" class="user_btn_button send_otp" >Re-Send OTP</button>-->

                                            <div class="row">
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-8  ">
                                                    <label for="">Enter OTP </label>
                                                    <input type="text" class="btn btn-primary px-4" name="otp_input1" id="otp_input1" value="<?= set_value('otp_input1'); ?>" placeholder="Enter OTP" aria-describedby="helpId">
                                                    <span class=" "><?= form_error('otp_input1'); ?></span>
                                                    <a href="<?= $panel_path . 'profile/edit-profile'; ?>" class="cancel_data btn btn-danger">
                                                        Cancel</a>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-8  ">
                                                    <button type="button" class="btn btn-primary px-4" value="" name="edit_btn">Save</button>
                                                    <a href="<?= $panel_path . 'profile/edit-profile'; ?>" class="cancel_data btn btn-danger">
                                                        Cancel</a>
                                                </div>
                                            </div>

                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="row">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-8  ">
                                                <button type="submit" class="btn btn-primary px-4" value="" name="edit_btn">Save</button>
                                                <a href="<?= $panel_path . 'profile/edit-profile'; ?>" class="cancel_data btn btn-danger">
                                                    Cancel</a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    //   }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                


            </div>
        </div>
    </div>
</div>