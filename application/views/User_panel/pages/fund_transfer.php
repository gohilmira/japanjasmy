<?php
error_reporting(0);
$profile = $this->session->userdata("profile");

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
                Fund Transfer
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
    ?>
    <div class="row">
      <div class="col-xl-12 col-lg-6">
        <div class="card ">
          <div class="card-body">

            <?php
            echo form_open($panel_path . 'fund/fund-transfer');

            $userid = $this->session->userdata('user_id');
            $currency = $this->conn->company_info('currency');
            $available_wallets = $this->conn->setting('transfer_wallets');

            if ($available_wallets) {
              $useable_wallet = json_decode($available_wallets);

              if (count((array)$useable_wallet) > 1) {
                foreach ($useable_wallet as $wlt_key => $wlt_name) {
                  $balance = $this->update_ob->wallet($userid, $wlt_key);
                  echo "<p class=' '>$wlt_name : $currency</p> round($balance) <br>";
                }

            ?>
                <div class="row">
                  <div class="form-group col-lg-3">
                    <label for="" style='color:#fff;'>Select Wallet</label>
                    <select name="selected_wallet" id="" class="form-control">
                      <option value="">Select Wallet</option>
                      <?php
                      foreach ($useable_wallet as $wlt_key => $wlt_name) {
                      ?>
                        <option value="<?= $wlt_key; ?>"><?= $wlt_name; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <?php
              } else {
                foreach ($useable_wallet as $wlt_key => $wlt_name) {
                  $balance = $this->update_ob->wallet($userid, $wlt_key);
                  echo "<span style='color:#fff;'>$wlt_name : $currency $balance</span>";
                ?><input type="hidden" name="selected_wallet" value="<?= $wlt_key; ?>"><?php
                                                                                      }
                                                                                    }
                                                                                  }
                                                                                        ?>
            <span class=" "><?= form_error('selected_wallet'); ?></span>
            <div class="row">
              <div class="form-group col-lg-3">
                <label for="" class="">Username</label>
                <input type="text" name="tx_username" value="<?= set_value('tx_username'); ?>" data-response="username_res" class="form-control check_username_exist" placeholder="Enter Username" aria-describedby="helpId">
                <span class="text-danger " id="username_res"><?= form_error('tx_username'); ?></span>
              </div>
              <div class="form-group col-lg-3">
                <label for="" class="">Enter Amount</label>
                <input type="number" name="amount" id="amount" value="<?= set_value('amount'); ?>" class="form-control" placeholder="Enter Amount" aria-describedby="helpId">
                <span class="text-danger "><?= form_error('amount'); ?></span>
              </div>
            </div>
            <?php
            if ($profile_edited != 'readonly') {
              $fund_transfer_with_otp = $this->conn->setting('fund_transfer_with_otp');
              if ($fund_transfer_with_otp == 'yes') {
                $display = (isset($_SESSION['otp']) ? 'block' : 'none');
            ?>
                <button type="button" data-response_area="action_areap" class="user_btn_button send_otp">Send OTP</button>

                <div id="action_areap" style="display:<?= $display; ?>">
                  <div class="form-group">
                    <label for="">Enter OTP </label>
                    <input type="text" name="otp_input1" id="otp_input1" value="<?= set_value('otp_input1'); ?>" class="form-control user_input_text" placeholder="Enter OTP" aria-describedby="helpId">
                    <span class=" "><?= form_error('otp_input1'); ?></span>
                  </div>

                  <div class="user_form_row_data  ">
                    <div class="user_submit_button mb-2 mt-2">
                      <input type="submit" class="user_btn_button btn-remove" name="transfer_btn" value="Transfer">

                    </div>

                  </div>

                </div>
              <?php
              } else {
              ?>

                <div class="user_form_row_data  ">
                  <div class="user_submit_button mb-2 mt-2">
                    <input type="submit" class="user_btn_button btn-remove btn btn-primary" name="transfer_btn" value="Transfer">

                  </div>

                </div>

            <?php
              }
            }


            ?>

            </form>
          </div>

        </div>
      </div>
    </div>
  </div>


  <script>
    (function($) {
      $(".btn-remove").click(function() {
        $(this).css("display", "none");
      });
    })(jQuery);
  </script>