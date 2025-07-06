<?php
error_reporting(0);
?>
<style>
  input.user_btn_button {
    margin-top: 10px;
  }


  span#wallet {
    color: #fff;
  }
</style>

<style>
  .pin_top_page_content h5 {
    color: var(--text2);
  }

  span#wallet {
    color: #fff !important;
  }

  .pin_top_page_content {
    text-align: end;
  }

  .detail_topup p i {
    font-size: 14px;
    margin-right: 10px;
  }

  span#total_pins {
    color: var(--text2) !important;
  }

  .form_topup {
    margin-top: 20px;
    padding: 1.5rem 1.5rem;
    background: transparent;
    border: none !important;
    box-shadow: rgb(0 0 0 / 20%) 0px 5px 15px;
    border-radius: 8px;
  }

  button.user_btn_button {
    padding: 6px 12px;
    border: none;
    background: #5030ab;
    font-size: 14px;
    border-radius: 4px;
    text-transform: capitalize;
    color: #fff;
    font-weight: 500;
  }

  .detail_topup {
    padding: 16px 16px;
    border: none;
    background: transparent;
    font-size: 14px;
    border-radius: 4px;
    text-transform: capitalize;
    color: #fff;
    font-weight: 500;
    margin-top: 20px;
  }

  .detail_topup h4 {
    font-size: 20px;
    font-weight: 500;
    text-transform: uppercase;
  }

  h4 {
    color: #fff;
  }

  option {
    background: #2c2d33;
  }
</style>
</head>

<body>


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
              Member Topup
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
    <!-- Page header -->
    <div class="page-header">
      <div class="page-header-content d-lg-flex">
        <div class="d-flex">


          <!-- <a href="#page_header"
								class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
								data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
							</a> -->
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
        <div class="col-lg-6">

          <div class="">
            <div class="form_topup">
              <?php
              $userid = $this->session->userdata('user_id');
              $available_pins = $this->conn->runQuery('count(pin) as cnt', 'epins', "use_status=0 and u_code='$userid'");
              $cnt_pins = ($available_pins ? $available_pins[0]->cnt : 0);
              ?>

              <div class="pin_top_page_content">

                <?php
                if ($this->conn->setting('topup_type') == 'pin') {
                ?>
                  <h5>Pin Available</h5>
                  <span id="total_pins" class="text_span"><i class="fa fa-thumb-tack" aria-hidden="true"></i>&nbsp; <?= $cnt_pins; ?></span>
                <?php } ?>
              </div>
              <form action="" method="post">
                <?php

                $currency = $this->conn->company_info('currency');
                if ($this->conn->setting('topup_type') == 'amount') {


                  $available_wallets = $this->conn->setting('invest_wallets');

                  if ($available_wallets) {
                    $useable_wallet = json_decode($available_wallets);

                    if (count((array)$useable_wallet) > 1) {


                      foreach ($useable_wallet as $wlt_key => $wlt_name) {
                        $balance = round($this->update_ob->wallet($userid, $wlt_key), 2);
                        echo "$wlt_name : $currency $balance <br>";
                      }

                ?>
                      <div class="form-group">
                        <label for="">Select Wallet</label>
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
                      <?php
                    } else {
                      foreach ($useable_wallet as $wlt_key => $wlt_name) {
                        $balance = round($this->update_ob->wallet($userid, $wlt_key), 2);
                        echo "<span id='wallet' style='color:#fff !important;' >$wlt_name : $currency $balance</span>";

                      ?><input type="hidden" name="selected_wallet" value="<?= $wlt_key; ?>"><?php
                                                                                              }
                                                                                            }
                                                                                          }
                                                                                        }
                                                                                                ?>
                <span class="text-danger"><?= form_error('selected_wallet'); ?></span>

                <div class="form-group">
                  <label>Username*</label>
                  <input type="text" name="tx_username" value="<?= set_value('tx_username'); ?>" data-response="username_res" class="form-control check_username_exist" placeholder="Enter Username" aria-describedby="helpId">
                  <span class="" id="username_res"></span>
                  <span class="text-danger" id="username_res"><?= form_error('tx_username'); ?></span>
                </div>
                <!-- <div class="form-group">
                  <label>Select Package*</label>
                  <select class="form-control selected_pins" name="selected_pin" id="selected_pin" data-response="total_pins" required="">
                    <option value="" style=" background: white; ">Select Package</option>
                    <?php
                    $all_pin = $this->conn->runQuery("pin_rate,pin_type,pin_rate2", 'pin_details', "status=1");
                    if ($all_pin) {
                      foreach ($all_pin as $pindetails) {
                    ?><option style=" background: white; " value="<?= $pindetails->pin_type; ?>"><?= $currency; ?>  <?= $pindetails->pin_rate; ?> </option><?php
                                                                                                                                                                        }
                                                                                                                                                                      }
                                                                                                                                                                          ?>
                  </select>
                  <span class="text-danger"><?= form_error('selected_pin'); ?></span>
                </div> -->
                   <input type="hidden" name="selected_pin" value="Package1">
                    <!-- <input type="hidden" name="tx_username" value="<?= $this->session->userdata('profile')->username;?>"> -->
                                              
                  <div class="form-group">
                    <label>Amount*</label>
                    <input type="text" name="amount" value="<?= set_value('amount');?>" class="form-control"
                        placeholder="Enter Amount" aria-describedby="helpId" >
                    <span class="text-danger"><?= form_error('amount');?></span>
                </div>


                <?php
                if ($profile_edited != 'readonly') {
                  $invest_toup_with_otp = $this->conn->setting('invest_toup_with_otp');
                  if ($invest_toup_with_otp == 'yes') {
                    $display = (isset($_SESSION['otp']) ? 'block' : 'none');
                ?>
                    <button type="button" data-response_area="action_areap" class="user_btn_button send_otp">Send OTP</button>

                    <div id="action_areap" style="display:<?= $display; ?>">
                      <div class="form-group row">
                        <label for="input-1" class="col-sm-2 col-form-label">Enter Otp*</label>
                        <div class="col-sm-10">
                          <input type="text" name="otp_input1" id="otp_input1" value="<?= set_value('otp_input1'); ?>" class="form-control user_input_text" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" "><?= form_error('otp_input1'); ?></span>
                        </div>

                      </div>

                      <input type="submit" class="user_btn_button btn-remove" name="topup_btn" onclick="return confirm('Are you sure? you wants to Submit.')" value="Topup">

                    </div>
                  <?php
                  } else {
                  ?>

                    <input type="submit" class="user_btn_button btn-remove detail btn btn-primary " name="topup_btn" onclick="return confirm('Are you sure? you wants to Submit.')" value="Topup">

                <?php
                  }
                }
                ?>

              </form>
            </div>
          </div>
        </div>
        <div class=" col-xl-6 mt-3">

          <div class="card">
            <div class="card-header fs-5">
              STEPS FOR TOPUP
            </div>
            <div class=" card-body">
              <div class="detail_topup">
                <p><i class="fa fa-check-square me-2" aria-hidden="true"></i>You can topup any user id</p>
                <p><i class="fa fa-check-square me-2" aria-hidden="true"></i> Enter username which you want to topup</p>
                <p><i class="fa fa-check-square me-2" aria-hidden="true"></i> Select package from the drop down menu And then click on topup button.</p>
              </div>
            </div>


          </div>

        </div>
      </div>

      <!-- /main charts -->
    </div>
    <!-- /content area -->



  </div>
  </div>
</body>



<script>
  (function($) {
    $(".btn-remove").click(function() {
      $(this).css("display", "none");
    });
  })(jQuery);
</script>