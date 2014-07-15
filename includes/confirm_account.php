<div class="main-wrapper">
    <div class="main-app-wrapper">
        <div id="title-div">
            KUDOBUZZ
        </div>
        <div class="main-app-content" style="min-height: 440px; margin-bottom: 10px;">

            <div style="margin: 0px auto 10px auto; width: 820px; overflow: hidden;">

                <div class="pull-left" style="width: 400px; padding: 0px 20px;magin: 0 auto;">

                    <p class="main-title" style="margin-top: 45px; font-size: 30px; color: #585858">Welcome Back!</p>
                    <p>It looks like you already have a different account on Kudobuzz with this email: <?php echo $_SESSION['email'] ?></p>
<!--                    <p><strong>Account Name:</strong> <?php echo $_SESSION['account-name'] ?></p>-->
                    <p><strong>Website:</strong> <?php echo $_SESSION['url'] ?></p>
                    <input type="hidden" id="uid" value="<?php echo $_SESSION['live-uid'] ?>" />

                    <p>
                        To confirm and use this account, click the button below or <a href="<?php echo get_admin_url() ?>admin.php?page=Signup">create a new account</a>.
                    </p>
                    <a href="javascript:;" class="btn btn-info" id="confirm-account">Confirm and use account</a>
                    <span id="frm2_feed" class="hide"></span>

                </div>
            </div>
        </div>
        <div id="copyright-div">
            &copy; 2014 Kudobuzz
        </div>
    </div>
</div>


<script>
    jQuery(document).on("click", "#confirm-account", function() {

        jQuery('#frm2_feed').removeClass("hide");
        jQuery('#frm2_feed').html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif" style="width: 14px; height: 14px; vertical-align: middle; margin-right: 5px;"><span style="vertical-align: middle">Please wait...</span>');
        jQuery("#confirm-account").removeClass("btn-info").addClass("btn-default");
        jQuery("#confirm-account").html("Please wait...");

        var mydata = {
            action: "post_confirm_action",
            'uid': '<?php echo $_SESSION['live-uid'] ?>'
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

    });
</script>