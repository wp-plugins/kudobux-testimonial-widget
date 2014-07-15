<div class="main-wrapper">
    <div class="main-app-wrapper">
        <div id="title-div">
            KUDOBUZZ
        </div>
        <div class="main-app-content">

            <div style="margin: 0px auto 10px auto; width: 100%; overflow: hidden; padding: 0 20px;">
                <div class="pull-left" style="width: 420px;">


                    <div class="pull-left" style="width: 400px; margin-right: 20px; margin-top: 40px;">
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
                    <h2 style="font-size: 30px" class="main-title">Login</h2>
                    <p>During your first connection with Kudobuzz, an email containing your password was sent into your inbox <strong><?php echo get_settings('admin_email') ?></strong></p>
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
                        <button type="button" class="btn btn-info btn-sm" id="login-in-btn" style="width: 90px;">LOGIN</button>
                        <span id="fb" class="hide" style="margin-left: 10px;"></span>
                        <a href="<?php echo get_admin_url() ?>admin.php?page=Forgot-password" style="margin-left: 20px; font-weight: bold; font-size: 14px;">Forgot password?</a>
                        <span style="margin: 0 5px">|</span>
                        <a href="<?php echo get_admin_url() ?>admin.php?page=Signup" style="font-weight: bold; font-size: 14px;">Create new Account</a>
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
    jQuery(document).on("click", "#login-in-btn", function() {

        jQuery('#fb').removeClass("hide");
        jQuery('#fb').html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif" style="width: 14px; height: 14px; vertical-align: middle; margin-right: 5px;"><span style="vertical-align: middle">Please wait...</span>');
        jQuery("#confirm-account").removeClass("btn-info").addClass("btn-default");
        jQuery("#confirm-account").html("Please wait...");

        var mydata = {
            action: "post_login_with_pass_action",
            'email': jQuery("#email").val(),
            'password': jQuery("#password").val()
        };

        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: mydata,
            error: function(data) {
                console.log(data);
            },
            success: function(data, textStatus, jqXHR) {
                jQuery('#fb').addClass("hide");
                jQuery("#confirm-account").html("SUBMIT");
                jQuery("#confirm-account").removeClass("btn-default").addClass("btn-info");

                var obj = JSON.parse(data);
                var uid = obj.uid;


                if (uid) {
                    var mydata = {
                        action: "post_confirm_action",
                        'uid': uid
                    };

                    jQuery.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: mydata,
                        error: function(data) {
                            console.log(data);
                        },
                        success: function(data, textStatus, jqXHR) {
                            //console.log(data);
                            window.location = "<?php echo get_admin_url() ?>admin.php?page=ModerateReviews";
                        }
                    });
                }
                else {

                    bootbox.dialog({
                        message: "<div class='alert alert-danger'>Sorry, the combination of email and password does exist in the system.</div>",
                        title: "Wrong login credentials",
                        className: 'fb-pages-modal',
                        buttons: {
                            OK: {
                                label: "OK",
                                className: "btn-primary hide",
                                callback: function() {
                                    add_fb_page();
                                    return false;
                                }
                            }
                        }
                    });
                }

            }
        });

    });
</script>