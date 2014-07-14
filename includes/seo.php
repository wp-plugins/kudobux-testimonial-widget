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
            <div class="main-app-content" style="min-height: 440px; margin-bottom: 10px;">

                <div class="content-div-wrapper">

                    <?php include_once 'other-left-panel-links.php'; ?>

                    <div style="width: 87%; margin-left: 180px; padding-top: 20px">
                        <h4>Setup your SEO minisite.</h4>
                        
                        <?php
                            if($plan === '0'){
                                ?>
                        <p>Setting up your SEO minisite allows Kudobuzz Smart SEO engine to optimize and push your reviews to search engines.</p>
                        
                        <p>A few benefits of rich snippets include:</p>
                        <ul>
                            <li style="font-weight: bold;">- Higher rankings in search results.</li>
                            <li style="font-weight: bold;">- Increasing click-through rates.</li>
                            <li style="font-weight: bold;">- More qualified traffic and better conversion rates.</li>
                            <li style="font-weight: bold;">- Drawing a user's attention to your relevant content.</li>
                            <li style="font-weight: bold;">- Providing instant information as related to their query.</li>
                        </ul>
                        <p>
                            <input type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal" value="UPGRADE NOW!" style="width: 120px;" />
                        </p>
                        <?php
                            }else{
                                
                                ?>
                        <div style="padding: 10px 0; font-weight: bold; margin: 10px 0">
                            <p style="font-size: 13px;">Unique Name : <span class="label label-default" style="font-size: 13px;"><?php echo $account_name ?>.kudobuzz.com</span></p>
                        </div>

                        <div style="padding: 10px 0; margin: 10px 0; width: 500px;">
                            <p style="font-size: 13px; font-weight: bold;">Step 1: Create your CNAME </p>

                            <p>
                                Log into your domain provider's admin site, and create a CNAME. 
                                Call this CNAME reviews [reviews.your-domain-name.com] and direct it to your unique name on Kudobuzz. 
                            </p>
                        </div>

                        <div style="padding: 10px 0; margin: 10px 0; width: 500px;">
                            <p style="font-size: 13px; font-weight: bold;">Step 2: Update your CNAME </p>

                            <p>
                                Come back to this page and update the Cname field with the CNAME you created.

                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="cname" class="col-sm-2 control-label">Cname</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputCname" value="<?php echo $cname ?>" placeholder="account_name.kudobuzz.com">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <p>
                                            The name of the page in your site that will use mini-site(e.g. reviews.kudobuzz.com)
                                        </p>
                                        <button type="button" class="btn btn-info" id="update_cname">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                            <div class="validation_feedback alert">

                            </div>

                            <div class="hide"> 
                                <input type="text" class="small " id="vanity" placeholder="mysite" style="height: 22px; width: 235px;" value="<?php echo $account_name?>">.kudobuzz.com<p></p>
                                <div class="validation_feedback"></div>
                                <div id="img_place_holder"></div>
                                <input type="hidden" id="subdomain" placeholder="mysite" value="<?php echo $account_name?>">
                            </div>

                            <p>
                                Follow the guide <a href="http://blog.kudobuzz.com/cname-setup-popular-domain-registrars/" target="_blank" style="color: #d35400; font-weight: bold;">here</a> if you want to learn more about setting up Cnames. We can also set this up for you for free. If you need help setting this up please send us an email <strong>[hello@kudobuzz.com]</strong>
                            </p>
                        </div>
                        <?php
                            }
                        ?>
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