/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var is_valid = true;
var pass_is_valid = false;
var pass_curr_is_valid = false;
var pass_1_is_valid = false;

//$.noConflict();
jQuery(document).ready(function() {

    var API_DOMAIN = jQuery("#api_domain").val();

    jQuery(document).on("click", "#update-profile-btn", function() {
        update_account();
    });

    jQuery(document).on("click", "#main_detials_update_btn", function() {
        update_main_account();
    });

    /*
     * 
     */

    jQuery(document).on("blur", "#cur_pass", function() {
        if (jQuery('#cur_pass').val() != "") {
            validate_hover(this.id);
        }
    });

    jQuery(document).on("blur", "#pass_1", function() {
        if (jQuery('#cur_pass').val() != "") {
            validate_hover(this.id);
        }
    });

    jQuery(document).on("blur", "#pass_2", function() {
        if (jQuery('#pass_1').val() != "") {
            validate_hover(this.id);
        }
    });




    function update_account() {

        var new_pass = jQuery('#pass_2').val();

        if ((pass_curr_is_valid == false && new_pass == '') || (pass_curr_is_valid == true && new_pass == '') || (pass_curr_is_valid == true && pass_is_valid == true)) {
            save_profile_info()
        }
        else if (pass_curr_is_valid == true && (new_pass != '' && pass_is_valid == false)) {
            alert('nope');
        }
    }

    /*
     * Validate user profile form
     */
    function validate_profile_frm() {
        if (jQuery('#vanity').val() == '') {

            //vanity_is_valid = false;
            jQuery('.validation_feedback').html('Specify your vanity name.');
            jQuery('#vanity-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/w.png">');
            return false;
        }

        else if (hasWhiteSpace(jQuery('#vanity').val())) {
            //vanity_is_valid = false;
            jQuery('.validation_success_feedback').html("");
            //alert("here");
            jQuery('.validation_feedback').html('Vanity name should not contain whitespace');
            jQuery('#vanity-wrapper-div').find('#img_place_holder').html('<img class="update_img" src="/public/images/ajax-imgs/w.png">');
            return false;
        }
        else {

            var account_id = jQuery("#account_id").val();

            jQuery('#vanity-wrapper-div').find('#img_place_holder').html('<img class="update_img" src="/public/images/ajax-imgs/spinner-circle.gif">');

            $vanity_is_available = jQuery.ajax({
                type: 'get',
                url: API_DOMAIN + 'account/check_vanity',
                data: {'vanity': jQuery('#vanity').val(), 'account_id': account_id},
                async: false
            }).responseText;

            if (jQueryvanity_is_available == 0) {
                vanity_is_valid = false;
                jQuery('.validation_feedback').html('This vanity name is already in use.');
                jQuery('#vanity-wrapper-div').find('#img_place_holder').html('<img class="update_img" src="/public/images/ajax-imgs/w.png">');
                return false;
            }
            else {
                vanity_is_valid = true;
                jQuery('.validation_feedback').html('');
                jQuery('#vanity-wrapper-div').find('#img_place_holder').html('<img class="update_img" src="/public/images/ajax-imgs/ok.png" style="height: 20px; width: 20px;">');
            }
        }
        return true;
    }


    function save_profile_info() {

        var bar = jQuery('.bar');
        var percent = jQuery('.percent');
        var status = jQuery('#status');
        var percentVal = '0%';
        jQuery('#update-profile-form').ajaxForm({
            //beforeSubmit: validate_profile_frm,
            beforeSend: function() {
                status.empty();
                percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
                jQuery('#update-profile-btn').hide();
                jQuery('#progress-div').fadeIn();
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            success: function() {
                var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);
                //jQuery('.validation_success_feedback').html('<img class="update_img" src="/public/images/ajax-imgs/ok.png" style="vertical-align: middle; margin-right: 10px"> <span>User details have been updated</span>');
                jQuery('.validation_feedback').html('');
                jQuery("#img_place_holder").html('');
                //window.location.href = "/settings";
            },
            complete: function(xhr) {
                status.html(xhr.responseText);
                jQuery('#update-profile-form')[0].reset();
                jQuery('#success-img').fadeIn(function() {
                    setTimeout(function() {
                        jQuery('#progress-div').hide();
                        jQuery('#update-profile-btn').fadeIn();
                    }, 2000)
                });
                //jQuery('#progress-div').hide();
                //jQuery('#update-profile-btn').fadeIn();
            }
        });
    }

    function validate_hover(id) {


        if (id == 'cur_pass') {
            var email = jQuery('#user_email').val();

            jQuery.post(API_DOMAIN + 'check-password', {'password': jQuery('#cur_pass').val(), 'email': email}, function(data) {
                if (data == 0) {
                    pass_curr_is_valid = false;

                    jQuery('#cur_pass').closest('.input-div').find(".show_output").html('Wrong password!');
                    jQuery('#cur_pass').closest('.input-div').find(".show_output").css({"display": "block", "background-color": "#FFE3E3"});
                }
                else {
                    pass_curr_is_valid = true;
                    jQuery('.validation_feedback').html('');
                    jQuery('#cur_pass').closest('.input-div').find(".show_output").css("display", "block");
                    jQuery('#cur_pass').closest('.input-div').find(".show_output").css({"display": "block", "background-color": "#AFE9BD"});
                    jQuery('#cur_pass').closest('.input-div').find(".show_output").html('Ok');
                    jQuery('#pass_1').attr('disabled', false);
                    jQuery('#pass_1').focus();
                }
            });
        }
        else if (id == 'pass_1') {

            if (jQuery('#pass_1').val() != '') {
                pass_1_is_valid = true;
                jQuery('#pass_1').closest('.input-div').find(".show_output").html('');
                jQuery('#pass_1').closest('.input-div').find(".show_output").addClass("hide");
                jQuery('#pass_2').attr('disabled', false);
                jQuery('#pass_2').focus();
            }
            else {
                jQuery('#pass_1').focus();
                jQuery('#pass_1').closest('.input-div').find(".show_output").html('');
                jQuery('#pass_1').closest('.input-div').find(".show_output").css({"display": "block", "background-color": "#FFE3E3"});
                jQuery('#pass_1').closest('.input-div').find(".show_output").html('Password cannot be empty.');
            }
        }
        else if (id == 'pass_2') {

            if (jQuery('#pass_1').val() != jQuery('#pass_2').val()) {
                pass_is_valid = false;
                jQuery('#pass_2').closest('.input-div').find(".show_output").css({"display": "block", "background-color": "#FFE3E3"});
                jQuery('#pass_2').closest('.input-div').find(".show_output").html('Passwords do not match.');
            }
            else if (jQuery('#cur_pass').val() != '' && (jQuery('#pass_1').val() == "" || jQuery('#pass_1').val() == "")) {
                pass_is_valid = false;
                jQuery('#pass_2').closest('.input-div').find(".show_output").css({"display": "block", "background-color": "#FFE3E3"});
                jQuery('#pass_2').closest('.input-div').find(".show_output").html('Password is required');
            }
            else {
                pass_is_valid = true;
                jQuery('#pass_1').closest('.input-div').find(".show_output").css({"display": "block", "background-color": "#AFE9BD"});
                jQuery('#pass_2').closest('.input-div').find(".show_output").css({"display": "block", "background-color": "#AFE9BD"});
                jQuery('#pass_2').closest('.input-div').find(".show_output").html('Ok');
            }
        }
    }

    /*
     * 
     * String has whitespace
     */
    function hasWhiteSpace(s) {
        return /\s/g.test(s);
    }




    function myurl_is_valid(url) {
        if (!(/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url))) {
            return 0;
        }
        else {
            return 1;
        }
    }



    /*
     * Update password
     */
    jQuery(document).on("click", "#update_pass_btn", function() {

        var pass = jQuery("#pass_2").val();

        if (pass_is_valid == false || pass_curr_is_valid == false || pass_1_is_valid == false) {
            alert("Please validate the form and proceed");
        }
        else { //Great now let update it

            var user_id = jQuery("#user_id").val();
            jQuery("#update_pass_btn").html("Saving...");
            jQuery.post(API_DOMAIN + "api/password/update", {"user_id": user_id, "pass": pass}, function(data) {
                jQuery("#update_pass_btn").html("Save changes");
                jQuery("#finish-icon").removeClass("hide");
            });
        }
    });

    jQuery(document).on("click", "#save-info-btn", function() {
        var bar = jQuery('.bar');
        var percent = jQuery('.percent');
        var status = jQuery('#status');
        var percentVal = '0%';

        jQuery('#update-profile-form-2').ajaxForm({
            
            beforeSend: function() {
                status.empty();
                percentVal = '0%';
                bar.width(percentVal);
                percent.html(percentVal);
                jQuery('#update-profile-btn').hide();
                jQuery('#progress-div').fadeIn();
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            success: function() {
                var percentVal = '100%';
                bar.width(percentVal);
                percent.html(percentVal);
                jQuery('.validation_feedback').html('');
                jQuery("#img_place_holder").html('');
            },
            complete: function(xhr) {
                status.html(xhr.responseText);
                jQuery('#update-profile-form')[0].reset();
                jQuery('#success-img').fadeIn(function() {

                    setTimeout(function() {
                        jQuery('#progress-div').hide();
                        jQuery('#update-profile-btn').fadeIn();
                    }, 2000);
                });
            }
        });
    });
});