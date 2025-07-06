<?php
error_reporting(0);
$user_id = $this->session->userdata('user_id');
$company_payment_methods = $this->conn->runQuery('*', 'company_payment_methods', "status='1'");
$user_payment_methods = $this->conn->runQuery('*', 'user_payment_methods', "status='1' and u_code='$user_id'");
?>
<div class="container pages">

  <div id="kt_app_toolbar" class="app-toolbar  pt-6 pb-2 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex align-items-stretch ">
      <!--begin::Toolbar wrapper-->
      <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
          <!--begin::Title-->
          <h1 class="page-heading d-flex flex-column justify-content-center   fw-bold fs-3 m-0">
            Select Payment Type
          </h1>
          <!--end::Title-->
         
        </div>
      </div>
      <!--end::Toolbar wrapper-->
    </div>
    <!--end::Toolbar container-->
  </div>
  <div class="row">
    <form role="form" method="post" action="" enctype="multipart/form-data" >
    <div class="col-xl-12">
      <div class=" p-3">
        <div class="mb-3">
          <label class="form-label fs-5">Select Payment Type</label>
          <select class="form-select form-control digits" name="account_type" id="account_type" data-response="add_account_sec" data-blursection="blursection" data-loader="account_add_loader">
            <option value="">select type</option>
            <?php
            foreach ($company_payment_methods as $method_details) {
            ?>
              <option value="<?= $method_details->unique_name; ?>"><?= $method_details->method_name; ?></option>
            <?php } ?>
          </select>
        </div>
        <div id="add_account_sec" class="col-lg-12">

        </div>

        <?php
        if ($profile_edited != 'readonly') {
          $account_with_otp = $this->conn->setting('account_with_otp');
          if ($account_with_otp == 'yes') {
            $display = (isset($_SESSION['otp']) ? 'block' : 'none');
        ?>
            <button type="button" data-response_area="action_areap" class="user_btn_button send_otp">Send OTP</button>

            <div id="action_areap" style="display:<?= $display; ?>">
              <div class="form-group">
                <label for="">Enter OTP </label>
                <input type="text" name="otp_input1" id="otp_input1" value="<?= set_value('otp_input1'); ?>" class="form-control user_input_text" placeholder="Enter OTP" aria-describedby="helpId">
                <span class=" "><?= form_error('otp_input1'); ?></span>
              </div>
              <div class="user_form_row_data user_form_content ">
                <div class="user_submit_button mb-2 mt-2">
                  <input type="submit" name="add_btn" value="Add Account" id="" class="user_btn_button">
                </div>

              </div>
            </div>
          <?php
          } else {
          ?>
            <div class="user_submit_button mb-2 mt-2">
              <button type="submit" name="add_btn" class="btn btn-primary waves-effect waves-light">Add Account</button>
            </div>
        <?php
          }
        }


        ?>
      </div>
    </div>
    </form>
    <div class="col-xl-12 mt-4">
      <div class="card">
        <div class="card-body">
          <div class="tab-content" id="myTabContent-4">
            <div class="tab-pane fade show active" id="leftPosition" role="tabpanel" aria-labelledby="home-tab-4">
              <div class=" ">
                <div class="table-responsive">
                  <table class="table table-bordered table-responsive-sm">
                    <?php
                    $this->load->view($panel_directory . '/pages/payment_section/my_accounts');
                    ?>

                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <center>
      <div class="user_form_row_data user_form_content ">
        <div class="user_submit_button mb-2 mt-2">
          <button type="submit" class="btn btn-primary mb-2">Add Account</button>
        </div>
      </div>
    </center>
  </div>
</div>