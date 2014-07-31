<?php
ini_set('display_errors', 1);
$kd_uid = get_option('kudobuzz_uid');

if (isset($kd_uid) && $kd_uid != NULL) {

    include_once 'data.php';

    $company_name = $user_account->account->company_name;
    $logo = $user_account->account->company_logo;
    $company_desc = $user_account->account->description;

    $settings_active = "kdb-active";
    $translation_active = "";
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

                    <div style="width: 87%; margin-left: 180px; padding-top: 20px; overflow: hidden" class="content-87">
                        <h4>Settings</h4>

                        <div class="pull-left" style="width: 45%; margin-right: 30px; margin-bottom: 30px">
                            <h5 style="padding-bottom: 5px; border-bottom: 1px solid #CCC">Basic Info</h5>

                            <form action="<?php echo API_DOMAIN ?>account/update" method="post" id="update-profile-form-2" enctype="multipart/form-data">
                                <input type="hidden" name="account_id" value="<?php echo $account_id ?>" />
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" value="<?php echo $company_name ?>">
                                </div>
                                <div class="form-group" style="overflow: hidden">
                                    <label for="">Company Logo</label>
                                    <div class="image_upload_container fileupload fileupload-new pull-left" data-provides="fileupload">
                                        <input type="hidden">
                                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px; line-height: 50px;">
                                            <img src="<?php echo isset($logo) && !empty($logo) ? API_DOMAIN . "public/user_images/logo/" . $logo : '../wp-content/plugins/kudobux-testimonial-widget/assets/img/user_placeholder.gif' ?>" style="margin-top: -10px;"></div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px; line-height: 50px;"></div>
                                        <span class="btn btn-file image_btn_cover">
                                            <span class="fileupload-new add_image" >Select image</span>
                                            <span class="fileupload-exists change_image">Change</span>
                                            <input type="file" name="company_logo" id="company_logo" style="padding:20px 0px"></span>
                                        <span style="color: #999;">(Recommended jpg, jpeg, gif or png)</span>
                                        <a href="#" class=" fileupload-exists remove_image" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>

                                <div class="form-group hide">
                                    <label for="">Primary Facebook Account</label>
                                    <select class="form-control" id="facebook_page" name="facebook_page">
                                        <option value="">-Select-</option>
                                        <?php
                                        if (count($social_accounts->facebook_accounts) > 0) {
                                            foreach ($social_accounts->facebook_accounts as $fb) {
                                                ?>
                                                <option value="<?php echo $fb->social_profile_id ?>"><?php echo $fb->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group hide">
                                    <label for="">Primary Twitter Account</label>
                                    <select class="form-control" id="twitter_account" name="twitter_account">
                                        <option value="">-Select-</option>
                                        <?php
                                        if (count($social_accounts->twitter_accounts) > 0) {
                                            foreach ($social_accounts->twitter_accounts as $tw) {
                                                ?>
                                                <option value="<?php echo $tw->id ?>">@<?php echo $tw->screen_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Company Description</label>
                                    <textarea style="height: 120px" class="form-control" placeholder="Company Description" id="page_desc" name="page_desc"><?php echo $company_desc ?></textarea>

                                    <div class="progress">
                                        <div class="bar"></div >
                                        <div class="percent">0%</div >
                                        <input type="hidden" id="status"/>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-info" id="save-info-btn">Save Changes</button>
                            </form>
                        </div>


                        <div class="pull-left" style="width: 45%;">

                            <h5 style="padding-bottom: 5px; border-bottom: 1px solid #CCC">Change Password</h5>

                            <form method="POST" action="<?php echo API_DOMAIN ?>user/update" class="form-horizontal" id="update-profile-form" enctype="multipart/form-data" >
                                <div class="form-group input-div">
                                    <div class="show_output"></div>
                                    <label for="">Current Password</label>
                                    <input type="password" class="form-control" id="cur_pass" name="cur_pass" placeholder="Current Password" maxlength="10">
                                </div>
                                <div class="form-group input-div" style="overflow: hidden">
                                    <div class="show_output"></div>
                                    <label for="">New Password</label>
                                    <input type="password" class="form-control" id="pass_1" name="pass_1" placeholder="New Password" maxlength="10" disabled="true">
                                </div>
                                <div class="form-group input-div" style="overflow: hidden">
                                    <div class="show_output"></div>
                                    <label for="">Confirm Password</label>
                                    <input type="password" class="form-control" id="pass_2" name="pass_2" placeholder="Confirm Password" maxlength="10" disabled="true">
                                </div>

                                <input type="hidden" id="user_email" name="email" value="<?php echo $email ?>">
                                <div class="form-group" style="overflow: hidden">
                                    <button type="button" class="btn btn-info" id="update_pass_btn">Save Changes</button> <span id="finish-icon" class="hide"><img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png" /></span>
                                </div>
                            </form>
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