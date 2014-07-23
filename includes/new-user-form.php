<?php //include 'check-browser-version.php' ?>
<div class="main-wrapper">
    <div class="main-app-wrapper">
        <div id="title-div">
            KUDOBUZZ
        </div>
        <div class="main-app-content">

            <div style="margin: 0px auto 10px auto; width: 100%; overflow: hidden; padding: 0 20px;">
                <div class="pull-left" style="width: 420px;">

                    <h2 style="margin-top: 50px; font-size: 30px" class="main-title">Create an Account</h2>
                    <div class="pull-left" style="width: 400px; margin-right: 20px">
                        <h3 style="color: #d35400">
                            Collecting Social Testimonials<br> made simple
                        </h3>
                        <p style="margin-top: 30px">
                            People are talking about your brand, start showing off positive social buzz easily on your website.
                        </p>
                        <ul>
                            <li>Easy to setup</li>
                            <li>Real-time testimonial updates</li>
                            <li>Clean &amp; easy to customize widget</li>
                        </ul>
                    </div>
                </div>
                <div class="pull-left" style="width: 410px; padding: 40px 20px;">

                    <form role="form" id="new-user-form" class="<?php echo isset($user_id) && !empty($user_id) ? 'hide' : '' ?>">
                        <!-- Email -->

                        <div class="container">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="text" class="form-control input-sm" id="email" value="<?php echo get_settings('admin_email'); ?>" maxlength="50">
                                <br><span class="feedback"></span>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="container">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control input-sm" id="password" placeholder="Password" maxlength="10">
                                <br><span class="feedback"></span>
                            </div>
                        </div>

                        <!-- Account name -->
                        <div class="container">
                            <div class="form-group" style="width: 555px;">
                                <label for="account-name">Site Name</label>
                                <div class="form-control input-sm" style="color: #000; font-weight: bold; width: 350px">
                                    https://kudobuzz.com/<input type="text" id="account-name" placeholder="site_name" class="no-border" maxlength="30" style="width:195px;">
                                </div>
                                <br><span class="feedback" style="width: 225px; font-weight: normal"></span>
                            </div>
                        </div>

                        <div class="container">
                            <div class="form-group" style="width: 352px;">
                                <label for="url">Website URL</label>
                                <div style="color: #000; font-weight: bold;">
                                    <input type="text" id="url" placeholder="http://mywebsite.com" class="form-control" value="<?php echo get_site_url(); ?>" />
                                    <span class="feedback" style="width: 180px; font-weight: normal"></span>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-info btn-sm" id="create-user-btn" onclick="create_account()">Create Account</button>
                        <span id="fb" class="hide" style="margin-left: 10px;"></span>
                        <a href="<?php echo get_admin_url() ?>admin.php?page=Returning-user-without-uid" style="margin-left: 20px; font-weight: bold; font-size: 14px;">Are you an existing user?</a>
                    </form>

                </div>
            </div>
        </div>
        <div id="copyright-div">
            &copy; 2014 Kudobuzz
        </div>
    </div>
</div>



<script>
    var user_id;
<?php
if (isset($GLOBALS['user_id']) && !empty($GLOBALS['user_id'])) {
    ?>
        user_id = <?php echo $GLOBALS['user_id'] ?>;
    <?php
}
?>

    var email_is_valid = 0;
    var pass_is_valid = 0;
    var url_is_valid = 1;
    var site_name_is_valid = 0;
    jQuery("#email, #password, #url, #account-name").live("blur", function() {
        if (this.id === 'email') {
            validate_email(this.value);
        }
        else if (this.id === 'password') {
            validate_pass(this.value);
        }
        else if (this.id === 'url') {
            validate_url(this.value);
        }
        else if (this.id === 'account-name') {
            validate_account_name(this.value);
        }
    });
    function create_account() {

        var email = jQuery("#email").val();
        var pass = jQuery("#password").val();
        var url = jQuery("#url").val();
        var account_name = jQuery("#account-name").val();


        if (email_is_valid == 1 && pass_is_valid == 1 && url_is_valid == 1 && site_name_is_valid == 1) {

            jQuery("#fb").css({'color': 'green'});
            jQuery("#fb").removeClass('hide');
            jQuery("#fb").html('<img src="<?php echo plugins_url() ?>/kudobux-testimonial-widget/assets/img/loader.gif" /> <span>Please wait...</span>');

            jQuery("#create-user-btn").addClass('hide');
            jQuery("input").prop("disabled", true);

            var dataSet = {
                'email': email,
                'pass': pass,
                'url': url,
                'vanity_name': account_name,
                'platform_type': 1
            };
            jQuery.post("<?php echo MAIN_HOST ?>user/create", dataSet, function(data) {
                user_id = data;
                jQuery("#form-li a").removeAttr('data-toggle');
                jQuery("#widgets-li a").tab('show');

                window.location.href = "admin.php?page=Inject_code&user_id=" + user_id;
            });
        }
        else {
            jQuery("#fb").removeClass('hide');
            jQuery("#fb").css({'color': 'red'});
            jQuery("#fb").html('Please enter appropriate data.');
        }
    }

    /*
     * Validate account name
     */
    function validate_account_name(account_name) {
        if (account_name === '') {

            jQuery("#account-name").closest(".form-group").addClass('has-error');
            jQuery("#account-name").closest(".form-group").find("span").fadeIn();
            jQuery("#account-name").closest(".container").find("span").css({'color': 'crimson'});
            jQuery("#account-name").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Choose a site name");
            site_name_is_valid = 0;
        }
        else {
            jQuery("#account-name").closest(".container").find("span").fadeIn();
            jQuery("#account-name").closest(".container").find("span").css({'color': 'rgb(138, 138, 138)'});
            jQuery("#account-name").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif' style='margin-right: 5px'> Checking site name. Please wait...");
            jQuery.get("<?php echo MAIN_HOST ?>account/check_vanity?vanity=" + account_name, function(data) {

                if (data == 0) { // existing url

                    jQuery("#account-name").closest(".form-group").addClass('has-error');
                    jQuery("#account-name").closest(".form-group").find("span").fadeIn();
                    jQuery("#account-name").closest(".container").find("span").css({'color': 'crimson'});
                    jQuery("#account-name").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > This site name is already in use.");
                    site_name_is_valid = 0;
                }
                else if (data == 1) { //Cool
                    jQuery("#account-name").closest(".form-group").addClass('has-success');
                    jQuery("#account-name").closest(".form-group").find("span").fadeIn();
                    jQuery("#account-name").closest(".container").find("span").css({'color': 'green'});
                    jQuery("#account-name").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png' style='margin-right: 5px' > Awesome!");
                    site_name_is_valid = 1;
                }

            });
        }
    }

    /*
     * Validate url
     */
    function validate_url(url) {

        var url_without_protocol = url.replace(/.*?:\/\//g, "");
        var url_without_trailing_slash = url_without_protocol.replace(/\/$/, "");

        if (url === '') {
            jQuery("#url").closest(".form-group").addClass('has-error');
            jQuery("#url").closest(".form-group").find("span").fadeIn();
            jQuery("#url").closest(".container").find("span").css({'color': 'crimson'});
            jQuery("#url").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter your website URL");
            url_is_valid = 0;
        }
        else if (validURL(url) === false) {
            jQuery("#url").closest(".form-group").addClass('has-error');
            jQuery("#url").closest(".form-group").find("span").fadeIn();
            jQuery("#url").closest(".container").find("span").css({'color': 'crimson'});
            jQuery("#url").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter a valid website URL");
            url_is_valid = 0;
        }
        else if (url.indexOf("localhost") >= 0) {
            jQuery("#url").closest(".form-group").addClass('has-error');
            jQuery("#url").closest(".form-group").find("span").fadeIn();
            jQuery("#url").closest(".container").find("span").css({'color': 'crimson'});
            jQuery("#url").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter a valid website URL");
            url_is_valid = 0;
        }
        else if (url_without_trailing_slash == '127.0.0.1') {
            jQuery("#url").closest(".form-group").addClass('has-error');
            jQuery("#url").closest(".form-group").find("span").fadeIn();
            jQuery("#url").closest(".container").find("span").css({'color': 'crimson'});
            jQuery("#url").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter a valid website URL");
            url_is_valid = 0;
        }
        else if (validURL(url) === true) {

            jQuery("#url").closest(".container").find("span").css({'color': 'rgb(138, 138, 138)'});
            jQuery("#url").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif' style='margin-right: 5px'> Checking url. Please wait...");
            jQuery("#url").closest(".container").find("span").fadeIn();

            jQuery("#url").closest(".form-group").addClass('has-success');
            jQuery("#url").closest(".form-group").find("span").fadeIn();
            jQuery("#url").closest(".container").find("span").css({'color': 'green'});
            jQuery("#url").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png' style='margin-right: 5px' > Awesome!");
            url_is_valid = 1;
        }
    }

    /*
     * Validate password
     **/
    function validate_pass(pass) {

        if (pass === '') {

            jQuery("#password").closest(".form-group").addClass('has-error');
            jQuery("#password").closest(".form-group").find("span").fadeIn();
            jQuery("#password").closest(".container").find("span").css({'color': 'crimson'});
            jQuery("#password").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter a password.");
            pass_is_valid = 0;
        }
        else if (pass.length < 5) {

            jQuery("#password").closest(".form-group").addClass('has-error');
            jQuery("#password").closest(".form-group").find("span").fadeIn();
            jQuery("#password").closest(".container").find("span").css({'color': 'crimson'});
            jQuery("#password").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > 5 characters minimum");
            pass_is_valid = 0;
        }
        else {
            jQuery("#password").closest(".form-group").addClass('has-success');
            jQuery("#password").closest(".form-group").find("span").fadeIn();
            jQuery("#password").closest(".container").find("span").css({'color': 'green'});
            jQuery("#password").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png' style='margin-right: 5px' > Yay!");
            pass_is_valid = 1;
        }

    }

    /*
     * Valid email
     **/
    function validate_email(email) {

        if (email == '') {
            jQuery("#email").closest(".form-group").addClass('has-error');
            jQuery("#email").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter your email.");
            jQuery("#email").closest(".container").find("span").fadeIn();
            jQuery("#email").closest(".container").find("span").css({'color': 'crimson'});
            email_is_valid = 0;
        }
        else if (validateEmail(email) === false) {
            jQuery("#email").closest(".form-group").addClass('has-error');
            jQuery("#email").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter a valid email.");
            jQuery("#email").closest(".container").find("span").fadeIn();
            jQuery("#email").closest(".container").find("span").css({'color': 'crimson'});
            email_is_valid = 0;
        }
        else if (validateEmail(email) === true) {

            //Check if this email is already registered
            jQuery("#email").closest(".container").find("span").css({'color': 'rgb(138, 138, 138)'});
            jQuery("#email").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif' style='margin-right: 5px'> Checking email. Please wait...");
            jQuery("#email").closest(".container").find("span").fadeIn();
            jQuery.post("<?php echo MAIN_HOST ?>check-email", {'email': email}, function(data) {

                if (data == 1) {
                    jQuery("#email").closest(".form-group").addClass('has-error');
                    jQuery("#email").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > This email is in use.");
                    jQuery("#email").closest(".container").find("span").fadeIn();
                    jQuery("#email").closest(".container").find("span").css({'color': 'crimson'});
                    email_is_valid = 0;
                }
                else if (data == 0) {
                    jQuery("#email").closest(".form-group").addClass('has-success');
                    jQuery("#email").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png' style='margin-right: 5px'> Awesome!");
                    jQuery("#email").closest(".container").find("span").fadeIn();
                    jQuery("#email").closest(".container").find("span").css({'color': 'green'});
                    email_is_valid = 1;
                }
            });
        }
    }

    /*
     * Check if email is valid
     */
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    /*
     * Validate url
     */
    function validURL(str) {

        var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
        if (!pattern.test(str)) {
            return false;
        } else {
            return true;
        }
    }

    jQuery('.choose-wdg-type').live("click", function() {

        var widget_type_id = this.value;
        var btn_id = this.id;

        show_widget_type(widget_type_id);

        jQuery('.choose-wdg-type').closest(".button-div").find("#fd-choose").html("");
        jQuery(".widget-type").removeClass('active-wdg-id');

        jQuery(this).closest('.button-div').find("#fd-choose").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif' style='margin-right: 5px; width: 16px !important;'> Please wait...");
        jQuery(this).hide();

        jQuery(".next-to-code").addClass("hide");

        var update_widget_type_url = '';
        if (widget_type_id == '8' || widget_type_id == '9') {

            update_widget_type_url = "<?php echo plugins_url() ?>/kudobux-testimonial-widget/includes/update_embedable_widget.php";
        }
        else if (widget_type_id == '3' || widget_type_id == '12') {

            update_widget_type_url = "<?php echo MAIN_HOST ?>widget/update";
        }
        jQuery.post(update_widget_type_url, {'user_id': user_id, "widget_type_id": widget_type_id}, function(data) {

            jQuery("#" + btn_id).show();
            jQuery("#" + btn_id).closest('.button-div').find("#fd-choose").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png' style='margin-right: 5px; width: 16px !important;'> You may refresh your frontend");
            jQuery(".widget-type").css("border", "2px solid transparent");
            jQuery("#" + btn_id).closest(".widget-type").css("border", "2px solid green");
            //jQuery(".next-to-code").removeClass("hide");

            setTimeout(function() {
                jQuery("#instructions-li a").tab('show');
            }, 700);
        });
    });

    function show_widget_type(widget_type_id) {

        jQuery("#kudobuzz-slider-widget-div").addClass("hide");
        jQuery("#kudobuzz-fullpage-widget-div").addClass("hide");

        switch (widget_type_id) {
            case '9':
                jQuery("#kudobuzz-slider-widget-div").removeClass("hide");
                jQuery("#normal-widget-div").addClass("hide");
                break;

            case '8':
                jQuery("#kudobuzz-fullpage-widget-div").removeClass("hide");
                jQuery("#normal-widget-div").addClass("hide");
                break;

            default :
                jQuery("#kudobuzz-slider-widget-div").addClass("hide");
                jQuery("#kudobuzz-fullpage-widget-div").addClass("hide");
                jQuery("#normal-widget-div").removeClass("hide");
                break;
        }


    }
    jQuery(document).ready(function($) {
        
       jQuery("#email").focus();
        jQuery("#next-btn").live("click", function() {
            jQuery("#instructions-li a").tab('show');
        }); 
    });
</script>