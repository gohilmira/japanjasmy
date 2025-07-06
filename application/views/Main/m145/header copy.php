<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demo.themewinter.com/html/exhibz/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 May 2023 06:46:26 GMT -->
<head>
   <!-- Basic Page Needs ================================================== -->
   <meta charset="utf-8">

   <!-- Mobile Specific Metas ================================================== -->
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

   <!-- Site Title -->
   <title><?= $this->conn->company_info('company_name');?></title>


   <!-- CSS
         ================================================== -->
   <!-- Bootstrap -->
   <link rel="stylesheet" href="<?= $panel_url;?>assets/css/bootstrap.min.css">

   <!-- FontAwesome -->
   <link rel="stylesheet" href="<?= $panel_url;?>assets/css/font-awesome.min.css">
   <!-- Animation -->
   <link rel="stylesheet" href="<?= $panel_url;?>assets/css/animate.css">
   <!-- magnific -->
   <link rel="stylesheet" href="<?= $panel_url;?>assets/css/magnific-popup.css">
   <!-- carousel -->
   <link rel="stylesheet" href="<?= $panel_url;?>assets/css/owl.carousel.min.css">
   <!-- isotop -->
   <link rel="stylesheet" href="<?= $panel_url;?>assets/css/isotop.css">
   <!-- ico fonts -->
   <link rel="stylesheet" href="<?= $panel_url;?>assets/css/xsIcon.css">
   <!-- Template styles-->
   <link rel="stylesheet" href="<?= $panel_url;?>assets/css/style.css">
   <!-- Responsive styles-->
   <link rel="stylesheet" href="<?= $panel_url;?>assets/css/responsive.css">

   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

</head>

<body>
   <div class="body-inner">
      <!-- Header start -->
      <header id="header" class="header header-classic">
         <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
               <!-- logo-->
               <a class="navbar-brand" href="index.html">
                  <img src="<?= $this->conn->company_info('logo');?>" alt="" style="width: 20%;">
               </a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                  aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"><i class="icon icon-menu"></i></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNavDropdown">
                  <ul class="navbar-nav ml-auto">
                     <li class="dropdown nav-item active">
                        <a href="<?= base_url();?>index">Home </a>
                     
                     </li>
                     <li class="dropdown nav-item">
                        <a href="<?= base_url();?>about">About </a>
                     
                     </li>
                    
                     <li class="nav-item">
                        <a href="<?= base_url();?>contact">Contact</a>
                     </li>
                     <li class="header-ticket nav-item">
                        <a class="ticket-btn btn" href="<?= base_url();?>login"> Login
                        </a>
                     </li>
                  </ul>
               </div>
            </nav>
         </div><!-- container end-->
      </header>
      <!--/ Header end -->