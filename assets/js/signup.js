/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var is_valid = false;
var email_is_valid = false;
var pass_is_valid = false;
var url_is_valid = false;
var vanity_is_valid = false;

$(document).ready(function() {
    $('#signup-btn').click(function() {
        //event.preventDefault();
        validate();
    });

    $('#wp-signup-btn').click(function() {
        //event.preventDefault();
        validate('wp');
    });

    $('#email, #pass1, #url, #vanity').blur(function() {
        validate_hover(this.id);
    });
});

function validate_hover(id) {

    if (id == 'email') { //validate email
        var email = $('#email').val();

        if (!isValidEmailAddress(email)) {
            email_is_valid = false;
            $('.validation_feedback').html('Please specify a valid email.');
            $('#email-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/w.png">');
        }
        else {
            $('#email-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/spinner-circle.gif">');

            var taken = validate_email(email);

            if (taken == 1) {
                email_is_valid = false;
                $('.validation_feedback').html('Sorry email is already taken!');
                $('#email-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/w.png">');
            }
            else {
                email_is_valid = true;
                $('.validation_feedback').html('');
                $('#email-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/ok.png">');
            }

        }
    }
    else if (id == 'pass1') {

        if ($('#pass1').val() == '') {
            pass_is_valid = false;
            $('.validation_feedback').html('Enter your password.');
            $('#pass-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/w.png">');
        }
        else {
            pass_is_valid = true;
            $('#pass-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/ok.png">');
        }
    }
    else if (id == 'url') {
        if ($('#url').val() == '') {
            url_is_valid = false;
            $('.validation_feedback').html('Specify the URL of your website.');
            $('#url-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/w.png">');
        }
        else {

            if (myurl_is_valid($('#url').val()) == 0) {
                url_is_valid = false;
                $('.validation_feedback').html('This is not a valid URL.');
                $('#url-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/w.png">');
            }
            else {

                //Check if url is already in our system
                $('#url-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/spinner-circle.gif">');

                $.get('/check-url', {'url': $('#url').val()}, function(data) {

                    $('#url-wrapper-div').find('#img_place_holder').html('');

                    if (data == 0) {
                        url_is_valid = false;
                        $('.validation_feedback').html('This URL appears to be in our system.');
                        $('#url-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/w.png">');
                    }
                    else {
                        url_is_valid = true;
                        $('.validation_feedback').html('');
                        $('#url-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/ok.png">');
                    }
                });
            }
        }
    }
    else if (id == 'vanity') {

        if ($('#vanity').val() == '') {
            vanity_is_valid = false;
            $('.validation_feedback').html('Specify your vanity name.');
            $('#vanity-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/w.png">');
        }

        else if (hasWhiteSpace($('#vanity').val())) {
            vanity_is_valid = false;
            $('.validation_feedback').html('Vanity name should not contain whitespace');
            $('#vanity-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/w.png">');
        }
        else {
            $('#vanity-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/spinner-circle.gif">');
            $.get('/check-vanity', {'vanity': $('#vanity').val()}, function(data) {
                if (data == 0) {
                    vanity_is_valid = false;
                    $('.validation_feedback').html('This vanity name is already in use.');
                    $('#vanity-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/w.png">');
                }
                else {
                    vanity_is_valid = true;
                    $('.validation_feedback').html('');
                    $('#vanity-wrapper-div').find('#img_place_holder').html('<img src="/public/images/ajax-imgs/ok.png">');
                }
            });
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


function validate() {

    if (email_is_valid == false || pass_is_valid == false || url_is_valid == false || vanity_is_valid == false) {
        $('.validation_feedback').html('Valid the form to proceed.');
    }
    else {
        var email = $('#email').val();
        var pass = $('#pass1').val();
        var url = $('#url').val();
        var vanity_name = $('#vanity').val();

        $('#overlay-div').css({'top':26});
        $('#overlay-div').show();
        
        $.post("/new-user", {'email': email, 'pass': pass, 'url': url, 'vanity_name': vanity_name}, function(user_id) {

            $.post('/user/success', {'email': email, 'user_id': user_id, 'vanity_name': vanity_name, 'pass': pass}, function(data) {

                if (data == 1) {

                    $('#wait-div').hide();
                    $('#user_email').html(email);
                    $('.form-wrapper').fadeOut();

                    //$('#form_kwgdt h5').hide();
                    $('.sign_up_pointerb').css('background', 'none');
                    $('#sign_up_pointer').css('background', 'none');

                    $('#overlay-div').css({'line-height': 50,});
                    var str = '<p style="font-size: 16px; font-weight: bold; color: #000; margin-top: 40px">Success!</p><p>Your account is sucessfully created.</p>';
                    str += '<p>Please check your email: ' + email + ' to confirm your subscription.</p>';
                    $('#overlay-div #status').html(str);

                }
                else {
                    $('#overlay-div #status').html('Oops! Something wrong happened. Please try again.');
                }

            });
        });
    }
}

/*
 * Validate email
 */
function validate_email(email) {
    if (!isValidEmailAddress(email)) {
        return 'not-email';
    }
    else { //Check if email is already in system   

        return $.ajax({
            type: 'post',
            url: '/check-email',
            data: {'email': email},
            async: false
        }).responseText;
    }
}


function myurl_is_valid(url) {
    if (!(/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url))) {
        return 0;
    }
    else {
        return 1;
    }
}