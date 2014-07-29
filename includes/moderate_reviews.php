<?php
ini_set('display_errors', 1);
$kd_uid = get_option('kudobuzz_uid');


if (isset($kd_uid) && $kd_uid != NULL) {

    include_once 'data.php';
    ?>

    <div class="main-wrapper">
        <div class="main-app-wrapper">
            <div id="title-div">
                <span class="pull-left" style="padding-top:8px">KUDOBUZZ</span>

                <?php include_once 'iframe-link.php' ?>

                <?php include_once 'top-links.php'; ?>
            </div>
            <div class="main-app-content" style="height: 635px; margin-bottom: 10px;">

                <div class="content-div-wrapper">

                    <?php include_once 'left-panel-links.php'; ?>

                    <div style="width: 87%; margin-left: 150px;">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-ul" role="tablist" id="myTab" style="overflow: hidden" >
                            <li class="active"><a href="#suggested" role="tab" data-toggle="tab">Incoming Reviews</a></li>
                            <li><a href="#all" role="tab" data-toggle="tab">All Reviews</a></li>
                            <li><a href="#published" role="tab" data-toggle="tab">Published Reviews</a></li>
                            <li><a href="#unpublished" role="tab" data-toggle="tab">Unpublished</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content" id="myTabContent" style="position: relative">
                            <div class="alert alert-info hide loading-more">Loading more feeds...</div>
                            <div class="loading-fb hide">
                                <img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader-big.gif' style='margin-top: 100px' >
                            </div>

                            <div class="tab-pane active" id="suggested">
                                <div class="content" style="padding: 0 0 0 20px">
                                    <table class="table table-hover table-striped" style="margin-bottom: 0">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">Rating</th>
                                                <th class="col-md-4">Review</th>
                                                <th class="col-md-1">Date</th>
                                                <th class="col-md-1">Status</th>
                                                <th class="col-md-1">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="nano feed_list_scroll"  style="height: 385px; ">
                                        <div class="nano-content feeds-div"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="all">
                                <div class="content" style="padding: 0 0 0 20px">
                                    <table class="table table-hover table-striped" style="margin-bottom: 0">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">Rating</th>
                                                <th class="col-md-4">Review</th>
                                                <th class="col-md-1">Date</th>
                                                <th class="col-md-1">Status</th>
                                                <th class="col-md-1">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="nano feed_list_scroll" style="height: 385px; ">
                                        <div class="nano-content feeds-div"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="published">
                                <div class="content" style="padding: 0 0 0 20px">
                                    <table class="table table-hover table-striped" style="margin-bottom: 0">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">Rating</th>
                                                <th class="col-md-4">Review</th>
                                                <th class="col-md-1">Date</th>
                                                <th class="col-md-1">Status</th>
                                                <th class="col-md-1">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="nano feed_list_scroll"  style="height: 385px; ">
                                        <div class="nano-content feeds-div">

                                        </div>
                                    </div>
                                </div></div>
                            <div class="tab-pane" id="unpublished">
                                <div class="content" style="padding: 0 0 0 20px">
                                    <table class="table table-hover table-striped" style="margin-bottom: 0">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">Rating</th>
                                                <th class="col-md-4">Review</th>
                                                <th class="col-md-1">Date</th>
                                                <th class="col-md-1">Status</th>
                                                <th class="col-md-1">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="nano feed_list_scroll" style="height: 385px; ">
                                        <div class="nano-content feeds-div">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once 'footer.php'; ?>
            <?php
        } else {
            ?>
            <script>
                jQuery(document).ready(function($) {
                    var kd_uid = '<?php echo $kd_uid ?>';
                    if (kd_uid == '') {
                        var location = '<?php echo get_admin_url() ?>admin.php?page=Signup';
                        window.location = location;
                    }
                });
            </script>
            <?php
        }