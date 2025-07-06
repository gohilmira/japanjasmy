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
                News & Events
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
</div><br>
      <div class="row">
         <div class="col-lg-7 col-md-12 col-sm-12">
            <div class="recent_new">
               <h4>Lastest News</h4>
               <?php
               $news_event = $this->conn->runQuery('*', 'notice_board', "status='1' order by id asc");
               if ($news_event) {
                  foreach ($news_event as $news_event1) {
               ?>
                     <div class="news_page">
                        <h4><?= $news_event1->title; ?></h4>
                        <span><?= $news_event1->added_on; ?></span>
                        <p><?= $news_event1->description; ?></p>
                     </div>
               <?php
                  }
               }
               ?>
            </div>
         </div>
         <div class="col-lg-5 col-md-12 col-sm-12">
            <div class="recent_event_deatil">
               <h4>Recent Events</h4>
               <div class="recent_activity">
                  <h5>About The Event
                  </h5>
                  <?php
                  $news_event = $this->conn->runQuery('*', 'notice_board', "status='1' order by id desc limit 5");
                  if ($news_event) {
                     foreach ($news_event as $news_event1) {
                  ?>
                        <h6><strong><?= $news_event1->title; ?></strong></h6>
                        <h6> <strong><?= $news_event1->added_on; ?></strong></h6>
                        <p><?= $news_event1->description; ?></p>
                  <?php
                     }
                  }
                  ?>
               </div>

            </div>
         </div>
      </div>
   </div>

</div>