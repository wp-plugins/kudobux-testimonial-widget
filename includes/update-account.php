<?php include 'check-browser-version.php' ?>
<div class="main-wrapper login">
    <div style="width: 500px; margin: 30px auto; text-align: center">
        <p class="main-title">Reconnect Your Account</p>

        <p>Enter your existing email address with Kudobuzz.  </p>
        <p>
            After a successful reconnection you will be redirected to the login page.
        </p>

        <form class="form-inline" role="form">
            <div class="alert alert-danger fb hide" style="padding: 5px; text-align: left; width: 375px; font-size: 12px;; margin-left: 37px;">sdf</div>

            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                <input type="email" style="width: 300px; font-size: 12px" class="form-control" id="email" placeholder="Enter email">
            </div>

            <button type="button" class="btn btn-info" id="update_account" style="font-size: 12px;">Reconnect</button>
            <span style="font-size: 12px" class="loading hide"><img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif">Checking ...</span>
        </form>
    </div>
</div>

<script>
    var message;
    
    jQuery(document).ready(function($) {
        
       $("#update_account").live("click", function() {

            var email = $("#email").val();
            if (email == '') {
                message = "Please enter a valid email address";
                show_error(message);
            }
            else if (validateEmail(email) === false) {
                message = "Please enter a valid email address";
                show_error(message);
            }
            else {

                //Check if this email is in our db
                $(".loading").removeClass("hide");
                $("#update_account").addClass("hide");
                $.get("<?php echo MAIN_HOST ?>user/get_user?email=" + encodeURIComponent(email) + "&include_entities=1", function(data) {
                    var obj = JSON.parse(data);

                    var user_id = obj.user_id;
                    var account_id = obj.account_id;

                    if (isEmpty(obj)) {
                        message = "Sorry this email is not in our system";
                        show_error(message);
                        $(".loading").addClass("hide");
                        $("#update_account").removeClass("hide");
                    }
                    else {
                        $('.fb').addClass("hide");
                        $("#update_account").addClass("hide");
                        $('#email').closest('.form-group').addClass('has-success');
                        $('#email').closest('.form-group').removeClass('has-error');
                        $(".loading").html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif"> Updating, Please wait...');
                        $(".loading").css({'color': 'green'});

                        $.get("<?php echo get_admin_url() ?>admin.php?page=updateUid", {'user_id': user_id, 'account_id': account_id}, function() {
                            window.location.href = "<?php echo get_admin_url(); ?>admin.php?page=Signin";
                        });
                    }
                });
            }
        }); 
    });

    function show_error(message) {
        $('.fb').removeClass('hide');
        $('.fb').addClass('alert-danger');
        $('.fb').html(message);
        $("#email").closest('.form-group').addClass('has-error');
        $("#email").focus();
    }

    function isEmpty(obj) {
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop))
                return false;
        }

        return true;
    }

    /*
     * Check if email is valid
     */
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
</script>