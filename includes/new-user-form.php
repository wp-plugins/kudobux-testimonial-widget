<div class="alert alert-info <?php echo isset($user_id) && !empty($user_id)?'':'hide'?>" style="font-size: 12px; width: 50%">
    <p style="text-transform: uppercase; font-size: 11px">Welcome back!</p>
    <p>
        You may login to dashboard and add more kudos to your basket.
    </p>
    <p>
        <a href="<?PHP echo MAIN_HOST?>login" target="_blank" class="btn btn-sm btn-default">Click to login</a>
    </p>
    
</div>

<form role="form" id="new-user-form" class="<?php echo isset($user_id) && !empty($user_id)?'hide':''?>">
    <!-- Email -->
    
    <div class="container">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="text" class="form-control input-sm" id="email" value="<?php echo get_settings('admin_email');?>" maxlength="50">
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
        <div class="form-group" style="width: 352px;">
            <label for="account-name">Site Name</label>
            <div class="form-control input-sm" style="color: #000; font-weight: bold;">
                https://kudobuzz.com/<input type="text" id="account-name" placeholder="site_name" class="no-border" maxlength="30" style="width:195px;">
            </div>
            <br><span class="feedback" style="width: 225px;"></span>
        </div>
    </div>

    <div class="container">
        <div class="form-group" style="width: 352px;">
            <label for="url">Website URL</label>
            <div style="color: #000; font-weight: bold;">
                <input type="text" id="url" class="form-control" value="<?php echo get_site_url(); ?>" />
                <span class="feedback" style="width: 180px"></span>
            </div>
        </div>
    </div>

    


    <button type="button" class="btn btn-success btn-sm" onclick="create_account()" style="margin-left: 8px;">Next Step</button>
</form>

<script>
    var user_id;
<?php
    if (isset($GLOBALS['user_id']) && !empty($GLOBALS['user_id'])) {
?>
    user_id = <?php echo $GLOBALS['user_id']?>;
    //$('#myTab a[href="#profile"]').tab('show');
<?php
    }
?>

    var email_is_valid = 0;
    var pass_is_valid = 0;
    var url_is_valid = 1;
    var site_name_is_valid = 0;
    $("#email, #password, #url, #account-name").live("blur", function() {
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
        var email = $("#email").val();
        var pass = $("#password").val();
        var url = $("#url").val();
        var account_name = $("#account-name").val();
        if (email_is_valid == 1 && pass_is_valid == 1 && url_is_valid == 1 && site_name_is_valid == 1) {

            var dataSet = {
                'email': email,
                'pass': pass,
                'url': url,
                'vanity_name': account_name,
                'platform_type': 1
            };
            $.post("<?php echo MAIN_HOST ?>user/create", dataSet, function(data) {
                user_id = data;
                $("#form-li a").removeAttr('data-toggle');
                $("#widgets-li a").tab('show');

                //Insert code in the header
                $.get("<?php echo plugins_url() ?>/kudobux-testimonial-widget/includes/after-user-registration.php?user_id=" + user_id, function(data) {
                    console.log(data);
                });
            });
        }
        else {
            //alert('not ready');
        }
    }

    /*
     * Validate account name
     */
    function validate_account_name(account_name) {
        if (account_name === '') {

            $("#account-name").closest(".form-group").addClass('has-error');
            $("#account-name").closest(".form-group").find("span").fadeIn();
            $("#account-name").closest(".container").find("span").css({'color': 'crimson'});
            $("#account-name").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Choose a site name");
            site_name_is_valid = 0;
        }
        else {
            $("#account-name").closest(".container").find("span").fadeIn();
            $("#account-name").closest(".container").find("span").css({'color': 'rgb(138, 138, 138)'});
            $("#account-name").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif' style='margin-right: 5px'> Checking site name. Please wait...");
            $.get("<?php echo MAIN_HOST ?>account/check_vanity?vanity=" + account_name, function(data) {

                if (data == 0) { // existing url

                    $("#account-name").closest(".form-group").addClass('has-error');
                    $("#account-name").closest(".form-group").find("span").fadeIn();
                    $("#account-name").closest(".container").find("span").css({'color': 'crimson'});
                    $("#account-name").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > This site name is already in use.");
                    site_name_is_valid = 0;
                }
                else if (data == 1) { //Cool
                    $("#account-name").closest(".form-group").addClass('has-success');
                    $("#account-name").closest(".form-group").find("span").fadeIn();
                    $("#account-name").closest(".container").find("span").css({'color': 'green'});
                    $("#account-name").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png' style='margin-right: 5px' > Awesome!");
                    site_name_is_valid = 1;
                }

            });
        }
    }

    /*
     * Validate url
     */
    function validate_url(url) {

        if (url === '') {
            $("#url").closest(".form-group").addClass('has-error');
            $("#url").closest(".form-group").find("span").fadeIn();
            $("#url").closest(".container").find("span").css({'color': 'crimson'});
            $("#url").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter your website URL");
            url_is_valid = 0;
        }
        else if (validURL(url) === false) {
            $("#url").closest(".form-group").addClass('has-error');
            $("#url").closest(".form-group").find("span").fadeIn();
            $("#url").closest(".container").find("span").css({'color': 'crimson'});
            $("#url").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter a valid website URL");
            url_is_valid = 0;
        }
        else if (validURL(url) === true) {

            $("#url").closest(".container").find("span").css({'color': 'rgb(138, 138, 138)'});
            $("#url").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif' style='margin-right: 5px'> Checking url. Please wait...");
            $("#url").closest(".container").find("span").fadeIn();
            $.get('<?php echo MAIN_HOST ?>account/check_url?url=' + encodeURIComponent(url), function(data) {

                if (data == 0) { // existing url

                    $("#url").closest(".form-group").addClass('has-error');
                    $("#url").closest(".form-group").find("span").fadeIn();
                    $("#url").closest(".container").find("span").css({'color': 'crimson'});
                    $("#url").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > This URL is already in use.");
                    url_is_valid = 0;
                }
                else if (data == 1) { //Cool
                    $("#url").closest(".form-group").addClass('has-success');
                    $("#url").closest(".form-group").find("span").fadeIn();
                    $("#url").closest(".container").find("span").css({'color': 'green'});
                    $("#url").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png' style='margin-right: 5px' > Awesome!");
                    url_is_valid = 1;
                }
            });
        }

    }

    /*
     * Validate password
     **/
    function validate_pass(pass) {

        if (pass === '') {

            $("#password").closest(".form-group").addClass('has-error');
            $("#password").closest(".form-group").find("span").fadeIn();
            $("#password").closest(".container").find("span").css({'color': 'crimson'});
            $("#password").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter a password.");
            pass_is_valid = 0;
        }
        else if (pass.length < 5) {

            $("#password").closest(".form-group").addClass('has-error');
            $("#password").closest(".form-group").find("span").fadeIn();
            $("#password").closest(".container").find("span").css({'color': 'crimson'});
            $("#password").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Password should have 5 characters minimum.");
            pass_is_valid = 0;
        }
        else {
            $("#password").closest(".form-group").addClass('has-success');
            $("#password").closest(".form-group").find("span").fadeIn();
            $("#password").closest(".container").find("span").css({'color': 'green'});
            $("#password").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png' style='margin-right: 5px' > Yay!");
            pass_is_valid = 1;
        }

    }

    /*
     * Valid email
     **/
    function validate_email(email) {

        if (email == '') {
            $("#email").closest(".form-group").addClass('has-error');
            $("#email").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter your email.");
            $("#email").closest(".container").find("span").fadeIn();
            $("#email").closest(".container").find("span").css({'color': 'crimson'});
            email_is_valid = 0;
        }
        else if (validateEmail(email) === false) {
            $("#email").closest(".form-group").addClass('has-error');
            $("#email").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > Enter a valid email.");
            $("#email").closest(".container").find("span").fadeIn();
            $("#email").closest(".container").find("span").css({'color': 'crimson'});
            email_is_valid = 0;
        }
        else if (validateEmail(email) === true) {

            //Check if this email is already registered
            $("#email").closest(".container").find("span").css({'color': 'rgb(138, 138, 138)'});
            $("#email").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif' style='margin-right: 5px'> Checking email. Please wait...");
            $("#email").closest(".container").find("span").fadeIn();
            $.post("<?php echo MAIN_HOST ?>check-email", {'email': email}, function(data) {

                if (data == 1) {
                    $("#email").closest(".form-group").addClass('has-error');
                    $("#email").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png' style='margin-right: 5px' > This email is in use.");
                    $("#email").closest(".container").find("span").fadeIn();
                    $("#email").closest(".container").find("span").css({'color': 'crimson'});
                    email_is_valid = 0;
                }
                else if (data == 0) {
                    $("#email").closest(".form-group").addClass('has-success');
                    $("#email").closest(".container").find("span").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png' style='margin-right: 5px'> Awesome!");
                    $("#email").closest(".container").find("span").fadeIn();
                    $("#email").closest(".container").find("span").css({'color': 'green'});
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

    $('.choose-wdg-type').live("click", function() {

        var widget_type_id = this.value;
        var btn_id = this.id;
        
        show_widget_type(widget_type_id);
        
        $('.choose-wdg-type').closest(".button-div").find("#fd-choose").html("");
        $(".widget-type").removeClass('active-wdg-id');

        $(this).closest('.button-div').find("#fd-choose").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader.gif' style='margin-right: 5px; width: 16px !important;'> Please wait...");
        $(this).hide();
        
        $(".next-to-code").addClass("hide");
        
        var update_widget_type_url = '';
        if(widget_type_id == '8' || widget_type_id == '9'){
            
            update_widget_type_url = "<?php echo plugins_url() ?>/kudobux-testimonial-widget/includes/update_embedable_widget.php";
        }
        else if(widget_type_id == '3' || widget_type_id == '12'){
            
            update_widget_type_url = "<?php echo MAIN_HOST ?>widget/update";
        }
		$.post(update_widget_type_url, {'user_id': user_id, "widget_type_id": widget_type_id}, function(data) {
            //console.log(data); return false;
            $("#" + btn_id).show();
            $("#" + btn_id).closest('.button-div').find("#fd-choose").html("<img src='../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png' style='margin-right: 5px; width: 16px !important;'> You may refresh your frontend");
            $(".widget-type").css("border", "2px solid transparent");
            $("#" + btn_id).closest(".widget-type").css("border", "2px solid green");
            //$(".next-to-code").removeClass("hide");
            
            setTimeout(function(){
                $("#instructions-li a").tab('show');
            }, 700);
        });
    });
    
    function show_widget_type(widget_type_id){
        
        $("#kudobuzz-slider-widget-div").addClass("hide");
        $("#kudobuzz-fullpage-widget-div").addClass("hide");
        
        switch(widget_type_id){
            case '9':
                $("#kudobuzz-slider-widget-div").removeClass("hide");
                $("#normal-widget-div").addClass("hide");
                break;
                
            case '8':
                $("#kudobuzz-fullpage-widget-div").removeClass("hide");
                $("#normal-widget-div").addClass("hide");
                break;
                
            default :
                $("#kudobuzz-slider-widget-div").addClass("hide");
                $("#kudobuzz-fullpage-widget-div").addClass("hide");
                $("#normal-widget-div").removeClass("hide");
                break;
        }
        
    
    }
    
    $(document).ready(function(){
        $("#next-btn").live("click", function(){
            $("#instructions-li a").tab('show');
        });
    });
</script>