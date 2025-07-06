

    </div>
    <!-- wrapper ends -->

    <!-- Chat  window and buttons starts -->
    <div class="wrap-fixed-float wrap-fixed-bottom-left">
        <!-- <button class="btn btn-primary  btn-rounded-circle shadow chat-btn"><i class="material-icons vm">comment</i></button> -->
        <div class="chat-window card shadow">
            <div class="card-header border-0 bg-none">
                <h5 class="d-inline-block fs15 mb-0">Quick Chat</h5>
                <button class="btn btn-sm p-0 float-right chat-close text-white">
                    <span class="rounded avatar avatar-20">
                        <i class="material-icons fs15 vm text-mute">close</i>
                    </span>
                </button>
            </div>
            <div class="card-body chat-list scroll-y p-0 ">
                <div class="p-3">
                    <div class="row left-chat">
                        <div class="col-auto">
                            <figure class="avatar avatar-20">
                                <img src="<?= $panel_url; ?>assets/img/user1.png" alt="">
                            </figure>
                        </div>
                        <div class="col pl-0">
                            <div class="chat-block">
                                <div class="row">
                                    <div class="col">
                                        How are you? AdminuxPRO we were waitedsince long to be here.
                                        <p class="text-mute small mt-2">8:00 pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row right-chat">
                        <div class="col pr-0">
                            <div class="chat-block">
                                <div class="row">
                                    <div class="col">
                                        How are you? AdminuxPRO we were waited since long to be here.
                                        <p class="text-mute small mt-2">8:00 pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <figure class="avatar avatar-20">
                                <img src="<?= $panel_url; ?>assets/img/user3.png" alt="">
                            </figure>
                        </div>
                    </div>
                    <div class="row left-chat">
                        <div class="col-auto">
                            <figure class="avatar avatar-20">
                                <img src="<?= $panel_url; ?>assets/img/user1.png" alt="">
                            </figure>
                        </div>
                        <div class="col pl-0">
                            <div class="chat-block">
                                <div class="row">
                                    <div class="col">
                                        How are you? AdminuxPRO we were waited since long to be here.
                                        <p class="text-mute small mt-2">8:00 pm</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row right-chat">
                        <div class="col pr-0">
                            <div class="chat-block">
                                <div class="row">
                                    <div class="col">
                                        <p>AdminuxPRO is HTML template can be used in various business domains like Manufacturing, inventory, IT, administration etc. for admin dashbaords </p>
                                        <p class="text-mute small mt-2">8:00 pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <figure class="avatar avatar-20">
                                <img src="<?= $panel_url; ?>assets/img/user3.png" alt="">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer px-0">
                <div class="input-group">
                    <div class="input-group-prepend ">
                        <button class="btn btn-link fs15 py-0 " type="button" id="button-addon4"><i class="material-icons vm">attachment</i></button>
                    </div>
                    <input type="text" class="form-control form-control-sm rounded" placeholder="Type Message..." aria-label="Message">
                    <div class="input-group-append ">
                        <button class="btn btn-link py-0 " type="button" id="button-addon5">
                            <i class="material-icons fs15 vm">send</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Chat  window and buttons ends -->

   
    <!-- Modal -->
    <div class="modal fade" id="themepicker" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg-dark overflow-hidden">
                <button type="button" class="closePersonalize" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="modal-body">
                    <div class="background h-320">
                        <img src="<?= $panel_url; ?>assets/img/background-part.png" alt="">
                    </div>
                    <div class="text-center pb-5">
                        <h1 class="mt-3 mb-0 text-white">Personalize</h1>
                        <h4 class="mb-5 text-white font-weight-light">Make it more like yours</h4>
                    </div>

                    <div class="row top-60">
                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="card border-0 shadow bg-white h-100">
                                <div class="card-body text-center">
                                    <i class="avatar avatar-60 md-36 material-icons text-template-primary my-3">format_shapes</i>
                                    <h6 class="mb-3">Font Size</h6>
                                    <div class="row">
                                        <div class="col-12 px-0">
                                            <ul class="list-group list-group-flush mb-0 text-left">
                                                <li class="list-group-item">
                                                    XS
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="radio" name="fontsize" class="custom-control-input" id="xsmallfs">
                                                        <label class="custom-control-label" for="xsmallfs"></label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    S
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="radio" name="fontsize" class="custom-control-input" id="smallfs" checked>
                                                        <label class="custom-control-label" for="smallfs"></label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    M
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="radio" name="fontsize" class="custom-control-input" id="mediumfs">
                                                        <label class="custom-control-label" for="mediumfs"></label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    L
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="radio" name="fontsize" class="custom-control-input" id="largefs">
                                                        <label class="custom-control-label" for="largefs"></label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="card border-0 shadow bg-white h-100">
                                <div class="card-body text-center">
                                    <i class="avatar avatar-60 md-36 material-icons bg-light-warning text-warning my-3">style</i>
                                    <h6 class="mb-3">Sidebar</h6>
                                    <div class="row">
                                        <div class="col-12 px-0">
                                            <ul class="list-group list-group-flush mb-0 text-left">
                                                <li class="list-group-item">
                                                    Normal
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="radio" name="sidebar" class="custom-control-input" id="sidebarfull" checked>
                                                        <label class="custom-control-label" for="sidebarfull"></label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    Compact
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="radio" name="sidebar" class="custom-control-input" id="sidebarCompact">
                                                        <label class="custom-control-label" for="sidebarCompact"></label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    Iconic
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="radio" name="sidebar" class="custom-control-input" id="sidebarIconic">
                                                        <label class="custom-control-label" for="sidebarIconic"></label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    Fill Color
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="checkbox" class="custom-control-input" id="sidebarFill">
                                                        <label class="custom-control-label" for="sidebarFill"></label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="card border-0 shadow bg-white h-100">
                                <div class="card-body text-center">
                                    <i class="avatar avatar-60 md-36 material-icons bg-light-danger text-danger my-3">menu</i>
                                    <h6 class="mb-3">Header</h6>
                                    <div class="row">
                                        <div class="col-12 px-0">
                                            <ul class="list-group list-group-flush mb-0 text-left">
                                                <li class="list-group-item">
                                                    Fixed Top
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="checkbox" class="custom-control-input" id="headerfixed">
                                                        <label class="custom-control-label" for="headerfixed"></label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    Fixed Width
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="checkbox" class="custom-control-input" id="headercontainer">
                                                        <label class="custom-control-label" for="headercontainer"></label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    Fill Color
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="checkbox" class="custom-control-input" id="headerfillcolor">
                                                        <label class="custom-control-label" for="headerfillcolor"></label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="card border-0 shadow bg-white h-100">
                                <div class="card-body text-center">
                                    <i class="avatar avatar-60 md-36 material-icons bg-light-success text-success my-3">subtitles</i>
                                    <h6 class="mb-3">Content</h6>
                                    <div class="row">
                                        <div class="col-12 px-0">
                                            <ul class="list-group list-group-flush mb-0 text-left">
                                                <li class="list-group-item">
                                                    Square
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="checkbox" name="sidebar" class="custom-control-input" id="wrapperCorner">
                                                        <label class="custom-control-label" for="wrapperCorner"></label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    Full Width
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="checkbox" name="sidebar" class="custom-control-input" id="contentWidth">
                                                        <label class="custom-control-label" for="contentWidth"></label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    Spacious
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="checkbox" name="sidebar" class="custom-control-input" id="moderntouch">
                                                        <label class="custom-control-label" for="moderntouch"></label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    Fullscreen
                                                    <div class="custom-control custom-switch float-right">
                                                        <input type="checkbox" name="sidebar" class="custom-control-input" id="fullscreen">
                                                        <label class="custom-control-label" for="fullscreen"></label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer border-0 pt-0">
                    <div class="row w-100 mx-0">
                        <div class="col-12 col-md-6 text-center">
                            <h6><i class="material-icons vm mr-1">brightness_2</i> Dark</h6>
                            <div class="avatar avatar-30 bg-dark style-picker" data-target='style-black-dark'></div>
                            <div class="avatar avatar-30 bg-darkblue style-picker" data-target='style-darkblue-dark'></div>
                            <div class="avatar avatar-30 bg-purple style-picker" data-target='style-purple-dark'></div>
                            <div class="avatar avatar-30 bg-blue style-picker" data-target='style-blue-dark'></div>
                            <div class="avatar avatar-30 bg-green style-picker" data-target='style-green-dark'></div>
                            <div class="avatar avatar-30 bg-pista style-picker" data-target='style-pista-dark'></div>
                            <div class="avatar avatar-30 bg-orange style-picker" data-target='style-orange-dark'></div>
                            <div class="avatar avatar-30 bg-tomato style-picker" data-target='style-tomato-dark'></div>
                        </div>
                        <div class="col-12 col-md-6 text-center">
                            <h6><i class="material-icons vm mr-1">brightness_7</i> Light</h6>
                            <div class="avatar avatar-30 bg-dark style-picker" data-target='style-black-light'></div>
                            <div class="avatar avatar-30 bg-darkblue style-picker" data-target='style-darkblue-light'></div>
                            <div class="avatar avatar-30 bg-purple style-picker" data-target='style-purple-light'></div>
                            <div class="avatar avatar-30 bg-blue style-picker" data-target='style-blue-light'></div>
                            <div class="avatar avatar-30 bg-green style-picker" data-target='style-green-light'></div>
                            <div class="avatar avatar-30 bg-pista style-picker" data-target='style-pista-light'></div>
                            <div class="avatar avatar-30 bg-orange style-picker" data-target='style-orange-light'></div>
                            <div class="avatar avatar-30 bg-tomato style-picker" data-target='style-tomato-light'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Theme style picker modal window and options ends -->

    <!-- Global js mandatory -->
    <script src="<?= $panel_url; ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= $panel_url; ?>assets/js/popper.min.js"></script>
    <script src="<?= $panel_url; ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script><script src="<?= $panel_url; ?>assets/vendor/cookie/jquery.cookie.js"></script>
    <!-- Global js ends -->

    <!-- Vendor or 3rd party js -->

    <!-- date range picker -->
    <script src="<?= $panel_url; ?>assets/vendor/daterangepicker-master/moment.min.js"></script>
    <script src="<?= $panel_url; ?>assets/vendor/daterangepicker-master/daterangepicker.js"></script>
    <!-- Chart js -->
    <script src="<?= $panel_url; ?>assets/vendor/chartjs/Chart.min.js"></script>
    <script src="<?= $panel_url; ?>assets/vendor/chartjs/utils.js"></script>
    <!-- Circular progress js  -->
    <script src="<?= $panel_url; ?>assets/vendor/circle-progress/circle-progress.min.js"></script>
    <!-- Sparklines js  -->
    <script src="<?= $panel_url; ?>assets/vendor/sparklines/jquery.sparkline.min.js"></script>
    <!-- DataTables js  -->
    <script src="<?= $panel_url; ?>assets/vendor/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="<?= $panel_url; ?>assets/vendor/DataTables-1.10.18/js/dataTables.responsive.min.js"></script>
    <script src="<?= $panel_url; ?>assets/vendor/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <!-- vector maps js  -->
    <script src="<?= $panel_url; ?>assets/vendor/jquery-jvectormap/jquery-jvectormap.js"></script>
    <script src="<?= $panel_url; ?>assets/vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- vector maps js  -->
    <script src="<?= $panel_url; ?>assets/vendor/jquery-toast-plugin-master/dist/jquery.toast.min.js"></script>
    
    <!-- Vendor or 3rd party js ends -->

    <!-- Customized template js mandatory -->
    <script src="<?= $panel_url; ?>assets/js/main.js"></script>
    <!-- Customized template js ends -->

    <!-- theme picker -->
    <script src="<?= $panel_url; ?>assets/js/style-picker.js"></script>
    <!-- theme picker ends -->

    <!-- Customized page level js -->
    <script src="<?= $panel_url; ?>assets/js/production-dashboard.js"></script>
    <script>
    </script>

<script>
	$(document).ready(function () {
		$('[data-toggle="popover"]').popover();
	});
</script>
<script>
	$(document).ready(function () {
		$('[data-toggle="popover1"]').popover();
	});


	$('.no_space').keyup(function (e) {
		var TCode = $(this).val();
		var res_area = $(this).attr('data-response');
		if (/[^a-zA-Z0-9@!#$%&?|_\-\/]/.test(TCode)) {
			$(this).val('');

			$('#' + res_area).html('Space Not Allowed.').css('color', 'red');
			return false;
		}
	});
</script>
<script>

	$(".right_side_hamburger_button").click(function () {
		$(".user_panel_header").toggleClass("active");
	});
	// $(".dropdowm_mlm_list").click(function() {
	//     $(this).find(".text_dropdown").slideToggle("fast");
	//     $(".dropdowm_mlm_list").not(this).find(".text_dropdown").slideUp("fast");
	// });
	$('.select_address').change(function () {
		var ths = $(this);
		var res_area = $(ths).attr('data-response');
		var s = $(this).children('option:selected').attr('value');
		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'fund/get_payment_method'; ?>",
			data: { connection_type: s },
			success: function (response) {
				//alert(response);
				$('#' + res_area).html(response);

			}
		});
	});

	$('.payment_type').change(function () {
		// alert(s);
		var ths = $(this);
		var res_area = $(ths).attr('data-response');
		var s = $(this).children('option:selected').attr('value');
		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'fund/get_payment_method_image'; ?>",
			data: { connection_type: s },
			success: function (response) {
				var res = JSON.parse(response);
				//alert(res.address);
				//var loc = $(this).attr("src");
				$('#' + res_area).attr("src", res.msg);
				$('#address_div ').show();
				$('#' + res_area).html(response);
				//$('#res_address').html("Address :"+res.address);  
				$('#referral_address').val(res.address);
				$('#res_address').html("Address :" + res.address);

			}
		});

	});



	function MobileinputSpace(event) {
		var k = event ? event.which : window.event.keyCode;
		if (k == 10) return false;
	}


	$('.selected_cripto').change(function () {

		var ths = $(this);
		var res_area = $(ths).attr('data-response');

		var s = $(this).children('option:selected').attr('value');
		//alert(s);
		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'fund/cripto_detail'; ?>",
			data: { selected_address: s },
			success: function (response) {
				//alert(response);
				$('#' + res_area).html(response);

			}
		});
	});


	$('.add_to_cart').click(function (e) {
		$(this).html('<i class="fa fa-spinner fa-spin"></i>');
		var ths = $(this);
		var productId = $(this).attr('data-productId');
		var qty = $('#qty_' + productId).val();

		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'product/add_to_cart'; ?>",
			data: { productId: productId, qty: qty },
			success: function (response) {
				var res = JSON.parse(response);
				if (res.error == false) {
					location.reload();
				} else {
					$(ths).html('Add to cart');
					alert(response);
				}

			}
		});
	});

	$('.update_cart').click(function (e) {
		$(this).html('<i class="fa fa-spinner fa-spin"></i>');
		var ths = $(this);
		var productId = $(this).attr('data-productId');
		var rowid = $(this).attr('data-rowid');
		var qty = $('#qty_' + productId).val();

		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'product/update'; ?>",
			data: { productId: productId, qty: qty, rowid: rowid },
			success: function (response) {
				// alert(response);
				var res = JSON.parse(response);
				if (res.error == false) {
					location.reload();
				} else {
					$(ths).html('Update');
					alert(response);
				}

			}
		});
	});

	$('.remove_from_cart').click(function (e) {
		$(this).html('<i class="fa fa-spinner fa-spin"></i>');
		var ths = $(this);
		var rowid = $(this).attr('data-rowid');
		// var productId = $(this).attr('data-productId'); 
		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'product/remove'; ?>",
			data: { rowid: rowid },
			success: function (response) {

				location.reload();
			}
		});
	});




	$('.check_username_exist').change(function (e) {
		var ths = $(this);
		var res_area = $(ths).attr('data-response');
		var username = $(this).val();
		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'profile/verify_username'; ?>",
			data: { username: username },
			success: function (response) {
				// alert(response);
				var res = JSON.parse(response);

				if (res.error == true) {
					$('#' + res_area).html(res.msg).css('color', 'red');

				} else {
					$('#' + res_area).html(res.msg).css('color', 'green');
				}
			}
		});
	});

	$('.send_otp').click(function (e) {
		$(this).html('<i class="fa fa-refresh fa-spin"></i>');
		var res_area = $(this).attr('data-response_area');

		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'profile/send_otp'; ?>",
			data: { gen_otp: 1 },
			success: function (response) {
				// alert(response);
				$(this).html('Resend OTP');
				$('#' + res_area).css('display', 'block');
			}
		});


	});

	$('.send_otp_withdrawal').click(function (e) {
		$(this).html('<i class="fa fa-refresh fa-spin"></i>');
		var res_area = $(this).attr('data-response_area');

		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'fund/send_otp'; ?>",
			data: { gen_otp: 1 },
			success: function (response) {
				// alert(response);
				$(this).html('Resend OTP');
				$('#' + res_area).css('display', 'block');
			}
		});


	});

	$('.pin_transfer_btn').click(function (e) {
		$(this).html('<i class="fa fa-refresh fa-spin"></i>');
		//$(this).prop('disabled', true); 

		var tx_username = $(this).attr('data-tx_username');
		var selected_pin = $(this).attr('data-selected_pin');
		var no_of_pins = $(this).attr('data-no_of_pins');

		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'pin/ajax_pin_transfer'; ?>",
			data: { pin_transfer_btn: 1, tx_username: $('#' + tx_username).val(), selected_pin: $('#' + selected_pin).val(), no_of_pins: $('#' + no_of_pins).val() },
			success: function (response) {
				alert(response);
				var resp = JSON.parse(response);
				if (resp.error == true) {
					$('#' + tx_username + '_error').html(resp.tx_username);
					$('#' + selected_pin + '_error').html(resp.selected_pin);
					$('#' + no_of_pins + '_error').html(resp.no_of_pins);
					$(this).html('Transfer');
				} else {
					$('#message_success').html(resp.msg);
					$(this).hide();
					//location.reload();
				}

			}
		});

		return false;
	});

	$('.selected_pins').change(function () {

		var ths = $(this);
		var res_area = $(ths).attr('data-response');
		var s = $(this).children('option:selected').attr('value');
		//alert(s);
		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'invest/pin_detail'; ?>",
			data: { selected_pin: s },
			success: function (response) {
				//alert(response);
				$('#' + res_area).html(response);

			}
		});
	});

	$('.check_balance').change(function (e) {

		var ths = $(this);
		var res_area = $(ths).attr('data-response');
		var wallet = $(this).val();
		//alert(res_area);      
		$.ajax({
			type: "post",
			url: "<?= $panel_path . 'fund/wallet_balance'; ?>",
			data: { wallet: wallet },
			success: function (response) {
				//alert(response);
				var res = JSON.parse(response);
				if (res.error == true) {
					$('#' + res_area).html(res.message).css('color', 'red');
				} else {
					$('#' + res_area).html(res.message).css('color', 'green');
				}
			}
		});
	});


	function copyLink(iid) {
		/ Get the text field /
		var copyText = document.getElementById("referral_link_right");

		/ Select the text field /
		copyText.select();
		copyText.setSelectionRange(0, 99999); /*For mobile devices*/

		/ Copy the text inside the text field /
		document.execCommand("copy");

		/ Alert the copied text /
		alert("Copied the text: " + copyText.value);
	}

	function copyLink1(iid) {

		/ Get the text field /
		var copyText = document.getElementById("referral_link_left");

		/ Select the text field /
		copyText.select();
		copyText.setSelectionRange(0, 99999); /*For mobile devices*/

		/ Copy the text inside the text field /
		document.execCommand("copy");

		/ Alert the copied text /
		alert("Copied the text: " + copyText.value);
	}
	<?php
	$get_alert = $this->conn->runQuery('*', 'notice_board', "type='popup' and status='1'");

	if ($get_alert) {
		?>

		$("#panel_popup").modal();
		<?php
	}
	if (!$this->session->has_userdata('need_set')) {
		?>

		$('#need_form').modal({
			backdrop: 'static',
			keyboard: false
		});
		//$("#need_form").modal();
		<?php
	}
	?>

</script>
<?php
$this->load->view($panel_directory . '/pages/payment_section/scripts');
?>
    <!-- Customized page level js ends -->
</body>

<!-- Body ends -->


<!-- Mirrored from maxartkiller.com/website/AdminuxPRO/HTML/pages/dashboard-production.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Nov 2023 07:17:06 GMT -->
</html>
