<?php
ini_set('display_errors', 1);
$kd_uid = get_option('kudobuzz_uid');


if (isset($kd_uid) && $kd_uid != NULL) {

    include_once 'data.php'
    ?>

    <div class="main-wrapper">
        <div class="main-app-wrapper">
            <div id="title-div">
                <span class="pull-left" style="padding-top:8px">KUDOBUZZ</span>

                <?php include_once 'iframe-link.php' ?>

                <?php include_once 'top-links.php'; ?>
            </div>
            <div class="main-app-content" style="min-height: 500px; margin-bottom: 10px; overflow: hidden; width: 100%">

                <div class="content-div-wrapper">

                    <div style="width: 500px; margin: 20px auto">
                        <form class="add-account" id="add_cs_review" action="<?php echo API_DOMAIN ?>add-custom-feed" method="post" onkeypress="return event.keyCode != 13;">

                            <input type="hidden" name="user_id" class="user_id" value="<?php echo $user_id ?>"/>
                            <input type="hidden" name="account_id" class="account_id" value="<?php echo $account_id ?>"/>
                            <div class="single-input-div form-group">
                                <div class="image_upload_container fileupload fileupload-new pull-left" data-provides="fileupload">
                                    <input type="hidden">
                                    <div class="fileupload-new thumbnail" style="width: 50px; height: 50px; line-height: 50px;">
                                        <img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/user_placeholder.gif" style="margin-top: -10px;"></div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px; line-height: 50px;"></div>
                                    <span class="btn btn-file image_btn_cover">
                                        <span class="fileupload-new add_image btn btn-sm btn-info" >Select image</span>
                                        <span class="fileupload-exists change_image">Change</span>
                                        <input type="file" name="myimage" id="myimage" style="padding:20px 0px"></span>
                                    <span style="color: #999;">(Recommended jpg, jpeg, gif or png)</span>
                                    <a href="#" class=" fileupload-exists remove_image" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div> 
                            
                            <div class="single-input-div form-group">
                                <input type="text" id="cs_kudos_date" class="input-sm form-input" name="cs_kudos_date" autocomplete="off" placeholder="Date" >
                                  <script type="text/javascript">
                                      jQuery(function() {
                                        jQuery( "#cs_kudos_date" ).datepicker();
                                      });
                                    </script>
                            </div>
                            
                            <div class="single-input-div form-group" style="clear: both;">
                                <!--<h5>Name</h5>-->
                                <input class="form-control" id="name" name="name"type="text" required="" placeholder="Name">
                            </div>
                            
                            <div class="single-input-div form-group">
                                <!--<h5>Title</h5>-->
                                <input class="form-control" id="title_input" name="title" type="text" placeholder="Title">
                            </div>
                            <div class="single-input-div form-group" style="position: relative">
                                <!--<h5>Rate</h5>-->
                                <span class="rateit" id="k_rating" name="k_rating" value=""></span>
                                <input type="text" id="rating_place_hoder" name="rating_place_hoder" class="" required="" style="height: 1px; border: 0 !important; width: 1px !important; left: 20px; top: 15px; box-shadow: none; position: absolute; z-index: -1" />
                                <span style="color: red; float: right" id="required-rating" class="hide">Rating is required!</span>
                                <div style="clear: both"></div>
                            </div>
                            
                            <div class="single-input-div form-group">
                                <!--<h5>Testimonial</h5>-->
                                <textarea class="form-control"  id="kb-message" required="" name="message" placeholder="Compose your review" style="height: 120px;"></textarea>

                                <div class="progress">
                                    <div class="bar"></div >
                                    <div class="percent">0%</div >
                                    <input type="hidden" id="status"/>
                                </div>

                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary" id="add_custom_review_btn">Add Review</button>
                                <span id="frm2_feed" class="hide"></span>
                            </div>
                        </form>
                    </div>


                </div>
            </div>

            <script>
                jQuery(document).ready(function() {
                    jQuery('.fileinput').fileinput();
                });
            </script>

            <script>

                var fake_path_to_img;
                var name;
                var message;
                var title;
                var rating;
                var my_rating = '';

                var name_is_valid = 0;
                var rating_is_valid = 0;
                var message_is_valid = 0;
                var title_is_valid = 0;

                jQuery('.rateit').live('rated', function(event, value) {
                    jQuery("#rating_place_hoder").val(value);
                });
                
                jQuery(document).on("keyup", "#cs_kudos_date", function(e){
                    e.preventDefault();
                });

                //Add new custom review
                jQuery("#add_custom_review_btn").live("click", function() {
                    
                    
                    fake_path_to_img = jQuery('#myimage').val();
                    name = jQuery('#name').val();
                    message = jQuery('#kb-message').val();
                    title = jQuery("#title_input").val();
                    rating = jQuery('#k_rating').rateit('value');
                    my_rating = jQuery("#rating_place_hoder").val();

                    if (name == '') {
                        jQuery('#name').css({'border': '1px solid red'});
                        name_is_valid = 0;
                        //jQuery("#name").focus();
                        return false;
                    }
                    else {
                        jQuery('#name').css({'border': '1px solid #CCC'});
                        name_is_valid = 1;
                    }
                    
                    if(title == ''){
                        jQuery('#title_input').css({'border': '1px solid red'});
                        title_is_valid = 0;
                        return false;
                    }
                    else {
                        jQuery('#title_input').css({'border': '1px solid #CCC'});
                        title_is_valid = 1;
                    }

                    if (rating == 0) {
                        jQuery("#required-rating").removeClass("hide");
                        rating_is_valid = 0;
                        return false;
                    }
                    else {
                        rating_is_valid = 1;
                        jQuery("#required-rating").addClass("hide");
                    }

                    if (message == '') {
                        jQuery("#kb-message").css({'border': '1px solid red'});
                        //jQuery("#kb-message").focus();
                        message_is_valid = 0;
                        return false;
                    }
                    else {
                        jQuery("#kb-message").css({'border': '1px solid #CCC'});
                        message_is_valid = 1;
                    }

                    if (name_is_valid == 1 && rating_is_valid == 1 && message_is_valid == 1) {
                        add_custom();
                    }
                });

                function add_custom() {
                    jQuery('#frm2_feed').removeClass("hide");
                    jQuery('#frm2_feed').html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif" style="width: 14px; height: 14px; vertical-align: middle; margin-right: 5px;"><span style="vertical-align: middle">Please wait...</span>');
                    jQuery("#add_custom_review_btn").html("Please wait...");
                    jQuery("#add_custom_review_btn").addClass('disabled');
                    jQuery("#add_custom_review_btn").removeClass('main');
                    var bar = jQuery('.bar');
                    var percent = jQuery('.percent');
                    var status = jQuery('#status');

                    jQuery("#add_cs_review").ajaxForm({
                        beforeSend: function() {
                            status.empty();
                            percentVal = '0%';
                            bar.width(percentVal);
                            percent.html(percentVal);
                        },
                        uploadProgress: function(event, position, total, percentComplete) {
                            var percentVal = percentComplete + '%';
                            bar.width(percentVal);
                            percent.html(percentVal);
                        },
                        success: function(data) {

                            percentVal = '0%';
                            bar.width(percentVal);
                            percent.html(percentVal);
                        },
                        complete: function(xhr) {

                            status.html(xhr.responseText);
                            percentVal = '0%';

                            bar.width(percentVal);
                            percent.html(percentVal);
                            jQuery("input[type!='hidden'], select, textarea").val("");
                            jQuery('.rateit').live("reset"); //disabled
                            jQuery("#add_custom_review_btn").html("Add Review");
                            jQuery("#add_custom_review_btn").removeClass('disabled');
                            jQuery("#add_custom_review_btn").addClass('main');
                            jQuery(".fileupload-preview").html('');
                            jQuery('#frm2_feed').html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png" style="width: 14px; height: 14px; vertical-align: middle; margin-right: 5px;">');
                            //jQuery(".fileupload-exists .fileupload-new, .fileupload-new .fileupload-exists").css("display","none");
                            //jQuery(".fileupload-new").css("display","inline-block");
                        }
                    });

                }
            </script>
            <?php include_once 'footer.php'; ?>
            <?php
        } else {
            ?>
            <script>

                jQuery(document).ready(function($) {
                    var kd_uid = '<?php echo $kd_uid ?>';
                    if (kd_uid === '') {
                        var location = '<?php echo get_admin_url() ?>admin.php?page=Signup';
                        window.location = location;
                    }
                });
            </script>
            <?php
        }
