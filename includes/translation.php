<?php
ini_set('display_errors', 1);
$kd_uid = get_option('kudobuzz_uid');

if (isset($kd_uid) && $kd_uid != NULL) {

    include_once 'data.php';

    $company_name = $user_account->account->company_name;
    $logo = $user_account->account->company_logo;
    $company_desc = $user_account->account->description;

    $url = API_DOMAIN . "api/widget/product?uid=" . $kd_uid;
    $form_settings = json_decode($kdwp->run_curl($url, "GET"));
    
    $review_form_settings = $form_settings->result;

    $settings_active = "";
    $translation_active = "kdb-active";
    ?>

    <div class="main-wrapper">
        <div class="main-app-wrapper">
            <div id="title-div">
                <span class="pull-left" style="padding-top:8px">KUDOBUZZ</span>

                <?php include_once 'iframe-link.php' ?>

                <?php include_once 'top-links.php'; ?>
            </div>
            <div class="main-app-content" style="min-height: 440px; margin-bottom: 10px;">

                <div class="content-div-wrapper">

                    <?php include_once 'settings-links.php'; ?>

                    <div style="width: 87%; margin-left: 180px; padding-top: 20px; overflow: hidden">
                        <h4>Translation</h4>

                        <div class="pull-left" style="width: 100%; margin-right: 30px; margin-bottom: 30px">

                            <?php
                            if ($plan === '0') {
                                ?>
                            <div style="width: 50%">
                                <p style="font-weight: bold; font-size: 15px !important;">Have an international audience?</p>
                            <p>Rewrite all the text on widgets and in automated emails in your preferred language by upgrading to Kudobuzz premium.</p>
                            
                            <p>
                                <input type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal" value="UPGRADE NOW!" style="width: 120px;" />
                             </p>
                            </div>
                                <?php
                            } else {
                                ?>
                                <form action="" method="post" id="translate-frm" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Write A Review</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="review-button-text" value="<?php echo (isset($review_form_settings->review_button_text) && !empty($review_form_settings->review_button_text)) ? stripslashes($review_form_settings->review_button_text) : "WRITE REVIEW" ?>" placeholder="Write A Review">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Title here</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="title-placeholder" value="<?php echo (isset($review_form_settings->review_title_placeholder) && !empty($review_form_settings->review_title_placeholder)) ? stripslashes($review_form_settings->review_title_placeholder) : "Compose your review title here!" ?>" placeholder="Title here">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Compose your review</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="content-placeholder" value="<?php echo (isset($review_form_settings->review_content_placeholder) && !empty($review_form_settings->review_content_placeholder)) ? stripslashes($review_form_settings->review_content_placeholder) : "Compose your review!" ?>" placeholder="Compose your review">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Login</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="signin-with-text" value="<?php echo (isset($review_form_settings->signin_with_text) && !empty($review_form_settings->signin_with_text)) ? stripslashes($review_form_settings->signin_with_text) : "SIGNIN WITH" ?>" placeholder="Login">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Or use this</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="signin-email-text" value="<?php echo (isset($review_form_settings->signin_email_text) && !empty($review_form_settings->signin_email_text)) ? stripslashes($review_form_settings->signin_email_text) : "OR USE THIS" ?>" placeholder="Or use this">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Your Name Here</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="name-placeholder" value="<?php echo (isset($review_form_settings->name_placeholder) && !empty($review_form_settings->name_placeholder)) ? stripslashes($review_form_settings->name_placeholder) : "Your name here" ?>" placeholder="Your Name Here">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Your Email Here</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="email-placeholder" value="<?php echo (isset($review_form_settings->email_placeholder) && !empty($review_form_settings->email_placeholder)) ? stripslashes($review_form_settings->email_placeholder) : "Your email here" ?>" placeholder="Your Email Here">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Submit Review</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="submit-review-button" value="<?php echo (isset($review_form_settings->submit_review_button) && !empty($review_form_settings->submit_review_button)) ? stripslashes($review_form_settings->submit_review_button) : "Post" ?>" placeholder="Post">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Cancel</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="cancel" value="<?php echo (isset($review_form_settings->cancel) && !empty($review_form_settings->cancel)) ? stripslashes($review_form_settings->cancel) : "Cancel" ?>" placeholder="Cancel">
                                        </div>
                                    </div>
                                    <div class="form-group hide">
                                        <label for="inputPassword" class="col-sm-3 control-label">There is no testimonial------</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputPassword" placeholder="There is no testimonial"> 
                                        </div>
                                    </div>
                                    <div class="form-group hide">
                                        <label for="inputPassword" class="col-sm-3 control-label">Please wait------</label> 
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputPassword" placeholder="Please wait">
                                        </div>
                                    </div>
                                    <div class="form-group hide">
                                        <label for="inputPassword" class="col-sm-3 control-label">No Reviews------</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputPassword" placeholder="No Reviews">
                                        </div>
                                    </div>
                                    <div class="form-group hide">
                                        <label for="inputPassword" class="col-sm-3 control-label">Testimonial------</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputPassword" placeholder="Testimonial">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Be the first to review this product</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="closed-review-form-message" value="<?php echo (isset($review_form_settings->closed_review_form_message) && !empty($review_form_settings->closed_review_form_message)) ? stripslashes($review_form_settings->closed_review_form_message) : "Be the first to review this product" ?>" placeholder="Be the first to review this product">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Title Message</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="title_message" value="<?php echo (isset($review_form_settings->title_message) && !empty($review_form_settings->title_message)) ? stripslashes($review_form_settings->title_message) : "Did you like using " . $account_name . "? Share your thoughts with us." ?>" placeholder="View Full Post">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Was this helpful</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="thumbs-up-down-message" value="<?php echo (isset($review_form_settings->thumbs_up_down_message) && !empty($review_form_settings->thumbs_up_down_message)) ? stripslashes($review_form_settings->thumbs_up_down_message) : "Was this helpful" ?>" placeholder="Was this helpful">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Reviews</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="reviews-text" value="<?php echo (isset($review_form_settings->reviews_text) && !empty($review_form_settings->reviews_text)) ? stripslashes($review_form_settings->reviews_text) : "reviews" ?>" placeholder="Reviews">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Review</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="review-text" value="<?php echo (isset($review_form_settings->review_text) && !empty($review_form_settings->review_text)) ? stripslashes($review_form_settings->review_text) : "review" ?>" placeholder="Review">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Read More</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="read-more" value="<?php echo (isset($review_form_settings->read_more) && !empty($review_form_settings->read_more)) ? stripslashes($review_form_settings->read_more) : "Read More" ?>" placeholder="Read More">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Read Less</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="read-less" value="<?php echo (isset($review_form_settings->read_less) && !empty($review_form_settings->read_less)) ? stripslashes($review_form_settings->read_less) : "Read Less" ?>" placeholder="Read Less">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Thank You For The Review</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="thanks-for-review" value="<?php echo (isset($review_form_settings->thanks_for_review) && !empty($review_form_settings->thanks_for_review)) ? stripslashes($review_form_settings->thanks_for_review) : "Thanks For The Review" ?>" placeholder="Thank For The Review">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Be more awesome by sharing your review</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="share-review-text" value="<?php echo (isset($review_form_settings->share_review_text) && !empty($review_form_settings->share_review_text)) ? stripslashes($review_form_settings->share_review_text) : "Be more awesome by sharing your review :)" ?>" placeholder="Be more awesome by sharing your review">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Please select your rating</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="select-rating" value="<?php echo (isset($review_form_settings->select_rating) && !empty($review_form_settings->select_rating)) ? stripslashes($review_form_settings->select_rating) : "Please select your rating" ?>" placeholder="Please select your rating">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Please give the review a title</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="give-a-title" value="<?php echo (isset($review_form_settings->give_a_title) && !empty($review_form_settings->give_a_title)) ? stripslashes($review_form_settings->give_a_title) : "Please give the review a title" ?>" placeholder="Please give the review a title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Please compose your review</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="enter-review-text" value="<?php echo (isset($review_form_settings->enter_review_text) && !empty($review_form_settings->enter_review_text)) ? stripslashes($review_form_settings->enter_review_text) : "Please enter your review" ?>" placeholder="Please compose your review">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Review content must be at least 4 words long</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="review-length" value="<?php echo (isset($review_form_settings->review_length) && !empty($review_form_settings->review_length)) ? stripslashes($review_form_settings->review_length) : "Review must be at least 4 words long" ?>" placeholder="Review content must be at least 4 words long">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">Please enter your name or authenticate with your social media account</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="sign-up-or-authenticate" value="<?php echo (isset($review_form_settings->enter_review_text) && !empty($review_form_settings->sign_up_or_authenticate)) ? stripslashes($review_form_settings->sign_up_or_authenticate) : "Please enter your name or authenticate with your social media account" ?>" placeholder="Please enter your name or authenticate with your social media account">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-3 control-label">View Full Post</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="view_full_post" value="<?php echo (isset($review_form_settings->view_full_post) && !empty($review_form_settings->view_full_post)) ? stripslashes($review_form_settings->view_full_post) : "View Full Post" ?>" placeholder="View Full Post">
                                        </div>
                                    </div>
                                    <input type="button" value="Save changes" onclick="save_translation();" class="btn btn-primary" id="update-profile-btn" style="width: 130px !important; height: 44px !important; font-size: 13px"><div id="save_status"></div>
                                </form>
                                <?php
                            }
                            ?>
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
                    if (kd_uid === '') {
                        var location = '<?php echo get_admin_url() ?>admin.php?page=Signup';
                        window.location = location;
                    }
            });
        </script>
        <?php
    }