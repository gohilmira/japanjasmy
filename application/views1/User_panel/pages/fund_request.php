<?php
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
                           Fund Request
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


  $userid = $this->session->userdata('user_id');
  ?>
  
    <div class="container">
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
        <div class="col-xl-6 ">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="">Method</label>
              <select class="form-control select_address" name="address" id="address" data-response="payment_type" required>
                <option value="">Select Method</option>
                <?php $payment_method = $check = $this->conn->runQuery('*', 'payment_method', "status='1' and is_parent='1'");
                if ($payment_method) {
                  foreach ($payment_method as $payment_method1) {
                ?>
                    <option value="<?= $payment_method1->slug; ?>"><?= $payment_method1->name; ?></option>
                <?php

                  }
                }
                ?>
              </select>
            </div>


            <div class="form-group">
              <label for="">Payment Type</label>
              <select class="form-control payment_type" name="payment_type" id="payment_type" data-response="address_res" required>
                <option value="">Select</option>

              </select>
              <span class=" text-warning"><?= form_error('payment_type'); ?></span>
            </div>



            <div class="form-group">
              <label for="">Amount</label>
              <input type="number" name="amount" value="<?= set_value('amount'); ?>" class="form-control" placeholder="" aria-describedby="helpId">
              <span class=" text-warning"><?= form_error('amount'); ?></span>
            </div>

            <div class="form-group">
              <label for="">UTR Number</label>
              <input type="text" name="utr_number" id="utr_number" value="<?= set_value('amount'); ?>" class="form-control" placeholder="" aria-describedby="helpId">
              <span class="text-warning "><?= form_error('utr_number'); ?></span>
            </div>

            <div class="form-group">
              <label for="">Payment Slip</label>
              <input type="file" name="payment_slip" id="payment_slip" value="" class="form-control" placeholder="" aria-describedby="helpId">
              <small id="helpId" class=" text-warning  "><?= (isset($upload_error) ? $upload_error : ''); ?></small>
            </div>


            <br>
            <input type="submit" class="user_btn_button btn btn-primary" name="request_btn" value="Save">


          </form>
        </div>
        <div class=" col-xl-6">


          <div class="card">
            <div class="card-header  fs-4">
              QR Code
            </div>
            <div class=" card-body">
              <img id="address_res" style="width:75%;" src=""><br>

              <b style="color:green" id="res_address"></b>

              <div class="input-group card-bg-2" id="address_div" style="display:none;">
                <input type="text" id="referral_address" class="form-control" value="">
                <div class="input-group-append">
                  <div class="input-group-btn ml-2">
                    <button type="submit" class="btn btn-default" onclick="copyLink11('left')">
                      <i class="fa fa-copy" style="color: #D3B916; font-size: 18px;"></i>
                    </button>

                  </div>
                </div>
              </div>
            </div>


          </div>

        </div>
      </div>
    </div>

  </div>
  <script>
    function copyLink11(iid) {

      / Get the text field /
      var copyText = document.getElementById("referral_address");

      / Select the text field /
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/

      / Copy the text inside the text field /
      document.execCommand("copy");

      / Alert the copied text /
      alert("Copied the text: " + copyText.value);
    }
  </script>