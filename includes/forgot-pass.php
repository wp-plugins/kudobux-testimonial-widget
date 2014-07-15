<div class="main-wrapper">
    <div class="main-app-wrapper">
        <div id="title-div">
            KUDOBUZZ
        </div>
        <div class="main-app-content">

            <div style="margin: 0px auto 10px auto; width: 100%; overflow: hidden; padding: 0 20px;">
                <div class="pull-left" style="width: 420px;">


                    <div class="pull-left" style="width: 400px; margin-right: 20px; margin-top: 30px;">
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
                    <h2 style="font-size: 30px" class="main-title">Forgot Password? </h2>

                    <form role="form" id="new-user-form" class="<?php echo isset($user_id) && !empty($user_id) ? 'hide' : '' ?>">
                        <!-- Email -->

                        <div class="container">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="text" class="form-control input-sm" id="email" value="<?php echo get_settings('admin_email'); ?>" maxlength="50">
                                <br><span class="feedback"></span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-info btn-sm" id="forgot-pass-btn" style="width: 120px;">SUBMIT</button>
                        <span id="fb" class="hide" style="margin-left: 10px;"></span>
                        <a href="<?php echo get_admin_url() ?>admin.php?page=Returning-user-without-uid " style="margin-left: 20px; font-weight: bold; font-size: 14px;">Back to login</a>
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
    jQuery(document).on("click", "#forgot-pass-btn", function() {

        jQuery('#fb').removeClass("hide");
        jQuery('#fb').html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif" style="width: 14px; height: 14px; vertical-align: middle; margin-right: 5px;"><span style="vertical-align: middle">Please wait...</span>');
        jQuery("#confirm-account").removeClass("btn-info").addClass("btn-default");
        jQuery("#confirm-account").html("Please wait...");

        var mydata = {
            action: "post_recover_pass_action",
            'email': jQuery("#email").val()
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
                var success = obj.success;
                console.log(data);
                
                if(success == 0){
                    var msg = "<div class='alert alert-danger'>Sorry, this email is not in our system.</div>";
                    var title_ = "Email not found!";
                    
                }
                else{
                    var msg = "<div class='alert alert-warning'><p>A new password has been sent into "+jQuery("#email").val()+"</p><p>Use it to login.</p></div>";
                    var title_ = "NEW PASSWORD";
                }
                
                bootbox.dialog({
                    message: msg,
                    title: title_,
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
        });

    });
</script>