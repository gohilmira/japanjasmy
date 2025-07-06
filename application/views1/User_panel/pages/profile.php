<?php
$user_id = $this->session->userdata("user_id");
$profile = $this->profile->profile_info($user_id);
?>
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <!--begin::Content wrapper-->
  <div class="d-flex flex-column flex-column-fluid">

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  pt-6 pb-2 ">

      <!--begin::Toolbar container-->
      <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex align-items-stretch ">
        <!--begin::Toolbar wrapper-->
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">


          <!--begin::Page title-->
          <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center  fw-bold fs-3 m-0">
              Profile
            </h1>
            <!--end::Title-->

            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
              

            </ul>
            <!--end::Breadcrumb-->
          </div>
          <!--end::Page title-->
          <!--begin::Actions-->
          <!--end::Actions-->
        </div>
        <!--end::Toolbar wrapper-->
      </div>
      <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
      <!--begin::Content container-->
      <div id="kt_app_content_container" class="app-container  container-fluid ">

        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10">
          <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
              <!--begin: Pic-->
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
                                    <p class=" mb-1"><?= $profile->name; ?>, <?= $profile->country; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
              <!--end::Pic-->

              <!--begin::Info-->
              <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                  <!--begin::User-->
                  <div class="d-flex flex-column">
                    <!--begin::Name-->
                    <!-- <div class="d-flex align-items-center mb-2">
                      <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"><?= $profile->username; ?></a>
                    </div>
                    <h6>Status: <?= $profile->active_status == 1 ? '<span style="color:green";>Active</span>' : '<span style="color:red";>Inactive</span>'; ?> </h6>
                    <div class="d-flex align-items-center mb-2">
                      <a href="#" class="text-gray-900 text-hover-primary fw-bold me-1"><?php
                      $check_existsspo = $this->conn->runQuery('id', 'users', "id='$profile->u_sponsor'");
                      //     if($check_existsspo){
                      //       echo $this->profile->profile_info($profile->u_sponsor)->username;
                      //     }else {
                      //       echo "null";
                      //   }

                      ?></a>
                    </div> -->
                    <!--end::Name-->
                  </div>
                  <!--end::User-->
                </div>
              </div>
            </div>
            <!--end::Details-->
          </div>
        </div>
        <!--end::Navbar-->
        <!--begin::details View-->
        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
          <!--begin::Card header-->
          <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
              <h3 class="fw-bold m-0">Profile Details</h3>
            </div>
            <!--end::Card title-->

            <!--begin::Action-->
            <a href="<?= $panel_path . 'profile/edit-profile'; ?>" class="btn btn-sm btn-primary align-self-center">Edit
              Profile</a>
            <!--end::Action-->
          </div>
          <!--begin::Card header-->

          <!--begin::Card body-->
          <div class="card-body p-9">
            <div class="row mb-7">
              <label class="col-lg-4 fw-semibold text-muted">Sponsor </label>
              <div class="col-lg-8 fv-row">
                <span class="fw-semibold text-gray-800 fs-6"> <?php
                                                              $check_existsspo = $this->conn->runQuery('id', 'users', "id='$profile->u_sponsor'");
                                                              if ($check_existsspo) {
                                                                echo $this->profile->profile_info($profile->u_sponsor)->username;
                                                              } else {
                                                                echo "null";
                                                              }

                                                              ?></span>
              </div>
            </div>

            <div class="row mb-7">
              <label class="col-lg-4 fw-semibold text-muted">Sponsor Name:</label>
              <div class="col-lg-8 fv-row">
                <span class="fw-semibold text-gray-800 fs-6">

                  <?php if ($this->profile && $profile && $profile->u_sponsor) {
                    $sponsor_name = $this->profile->profile_info($profile->u_sponsor)->name;
                    echo $sponsor_name;
                  } else {
                    echo "null";
                  } ?>
                </span>
              </div>
            </div>

            <div class="row mb-7">
              <label class="col-lg-4 fw-semibold text-muted">User Name</label>
              <div class="col-lg-8">
                <span class="fw-bold fs-6 text-gray-800"><?= $profile->name; ?></span>
              </div>
            </div>
            
            

            

            <div class="row mb-7">
              <label class="col-lg-4 fw-semibold text-muted">
                Status
                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i>
              </label>
              <div class="col-lg-8">
                <span class="fw-bold fs-6 text-primary text-800"><?= $profile->active_status == 1 ? '<span style="color:green";>Active</span>' : '<span style="color:red";>Inactive</span>'; ?> </span>
              </div>
            </div>

            <div class="row mb-7">
              <label class="col-lg-4 fw-semibold text-muted">Activation Date</label>
              <div class="col-lg-8">
                <span class="fw-bold fs-6 text-gray-800"><?= $profile->added_on; ?> </span>
              </div>
            </div>
          </div>
          <!--end::Card body-->
        </div>
      </div>
      <!--end::Content container-->
    </div>
    <!--end::Content-->
  </div>
  <!--end::Content wrapper-->