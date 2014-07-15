jQuery(document).ready(function() {



    var selected_wdg_id = jQuery("#selected_widget_type_id").val();

    //alert(selected_wdg_id);

    var template_url = jQuery("#template_url").val();

    var win = jQuery("#wg-preview-iframe-2")[0];
    var arr = [];

    jQuery(document).on("blur", "#wg-invite, #wg-title, #title-font, #content-font, #widget_height, #bg_color, #widget_width, #title-font-color, #title_font_size, #content_font_size, #content-font-color, #hd_color, #wg-review-btn-text, #wg-review-for-text,  #widget_transition_speed", function() {


        if (this.id === "wg-title") { //Change the title
            var title_width = jQuery('#title_width').val();
            arr["type"] = "title";
            arr["title"] = jQuery("#wg-title").val();
            arr['title_width'] = title_width;
            console.log(arr);
            win.contentWindow.postMessage(arr, template_url);
        }
        else if (this.id === "title-font-color") {
            arr["type"] = "title-font-color";
            arr["title-font-color"] = this.value;
            
            win.contentWindow.postMessage(arr, template_url);
        }
        else if (this.id === "widget_height") {
            arr["type"] = "widget_height";
            arr["widget_height"] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        }
        else if (this.id === "widget_width") {
            arr["type"] = "widget_width";
            arr["widget_width"] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        }
        else if (this.id === "bg_color") {
            arr["type"] = "bg_color";
            arr["bg_color"] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        }
        else if (this.id === "content-font-color") {
            arr["type"] = "content-font-color";
            arr["content-font-color"] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        }
        else if (this.id === "hd_color") {
            arr["type"] = "hd_color";
            arr["top-border-color"] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        }
        else if (this.id === "wg-invite") {

            arr['type'] = "invite_txt";
            arr['invite_txt'] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        }
        else if (this.id === "wg-review-btn-text") {

            arr['type'] = "review_btn_text";
            arr['review_btn_text'] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        } else if (this.id === "wg-review-for-text") {

            arr['type'] = "review_for_text";
            arr['review_for_text'] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        } else if (this.id === "widget_transition_speed") {

            arr['type'] = "widget_transition_speed";
            arr['widget_transition_speed'] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        }

        jQuery("#widget_status_input").change(function() {
            arr['type'] = 'show_widget';
            arr['show_widget'] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        });

        jQuery("#title-font").change(function() {
            arr["type"] = "title-font";
            arr["title-font"] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        });

        jQuery("#content-font").change(function() {
            arr["type"] = "content_font";
            arr["content_font"] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        });

        jQuery("#title_font_size").change(function() {
            arr["type"] = "title_font_size";
            arr["title_font_size"] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        });

        jQuery("#content_font_size").change(function() {
            arr["type"] = "content_font_size";
            arr["content_font_size"] = this.value;
            win.contentWindow.postMessage(arr, template_url);
        });


        jQuery("input:radio[name=alignment]").change(function() {
            var value = jQuery('input:radio[name=alignment]:checked').val();
            arr["type"] = "alignment";
            arr["alignment"] = value;
            var title_width = jQuery('#title_width').val();
            arr['title_width'] = title_width;
            win.contentWindow.postMessage(arr, template_url);
        });

        jQuery("input:radio[name=wg]").change(function() {
            var value = jQuery('input:radio[name=wg]:checked').val();
            arr['type'] = 'kb_widget_type';
            arr['kb_widget_type'] = value;
            win.contentWindow.postMessage(arr, template_url);
        });

        jQuery("input:radio[name=default_state]").change(function() {

            var value = jQuery('input:radio[name=default_state]:checked').val();
            arr['type'] = 'default-state';
            arr['default-state'] = value;
            var title_width = jQuery('#title_width').val();
            arr['title_width'] = title_width;
            win.contentWindow.postMessage(arr, template_url);
        });

        jQuery('#wdg-edit-btn').live("click", function() {
            jQuery('#wdg-save-feedback').hide();
            jQuery('#wdg-main-frm').fadeIn();
        });
    });


    jQuery('#wg-preview-iframe-2').load(function() {
        
        var value = jQuery('input:radio[name=wg]:checked').val();
        
        var wgt = [];
        //Send the widget details to the iframe
        wgt["title"] = jQuery("#wg-title").val();
        wgt["title-font"] = jQuery("#title-font").val();
        wgt["content_font"] = jQuery("#content-font").val();
        wgt["title_font_color"] = jQuery("#title-font-color").val();
        wgt["widget_height"] = jQuery("#widget_height").val();
        wgt["widget_width"] = jQuery("#widget_width").val();
        wgt["content_font_size"] = jQuery("#content_font_size").val();
        wgt["title_font_size"] = jQuery("#title_font_size").val();
        wgt["content-font-color"] = jQuery("#content-font-color").val();
        wgt["top-border-color"] = jQuery("#hd_color").val();
        wgt["kb_widget_type"] = value;
        

        if (jQuery('input:radio[name=alignment]:checked').val()) {
            wgt["alignment"] = jQuery('input:radio[name=alignment]:checked').val();
        }
        else {
            wgt["alignment"] = "left";
        }

        if (jQuery('input:radio[name=default_state]:checked').val()) {
            wgt["default-state"] = jQuery('input:radio[name=default_state]:checked').val();
        }
        else {
            wgt["default-state"] = "expanded";
        }

        wgt["bg_color"] = jQuery("#bg_color").val();
        win.contentWindow.postMessage(wgt, template_url);
        console.log(wgt);
    });


});

/*
 * Save widget configuration
 */
function save_wdg_config() {

    jQuery("#wdg-save-btn").html("Saving...");
    jQuery("#wdg-save-btn").removeClass("btn-primary");
    jQuery("#wdg-save-btn").addClass("btn-default");

    var account_name = jQuery('#active_account').val();
    selected_wdg_id = jQuery("#selected_widget_type_id").val();

    save_configurations(account_name, selected_wdg_id);

    /*var active_account = jQuery('#active_account').val();
     var uid = jQuery("#user_id").val();
     var platform = jQuery("#platform_type").val();
     var user_email = jQuery("#user_email").val();
     
     if (jQuery("#widget_status_input").val() > 0) {
     //personalize_grab_code();
     }
     else {
     var alert_msg = '<h5 style="font-size: 25px; text-align: center; color: #d35400">Widget Deactivated</h5>';
     alert_msg += '<p>You have successfully deactivated the widget. </p>';
     alert_msg += '<p>To activate it again, turn the Widget Status on.</p>';
     
     //Display modal
     bootbox.alert(alert_msg);
     }*/
}

function save_configurations(account_name, widget_type_id, show_wdg) {

    var result;
    title = jQuery("#wg-title").val();
    title_font = jQuery("#title_font").val();
    content_family = jQuery("#wdg_content_family").val();
    title_color = jQuery("#title-font-color").val();
    wdg_alignment = jQuery('input:radio[name=alignment]:checked').val()
    bg_color = jQuery("#background_colour").val();
    title_size = jQuery("#title_font_size").val();
    wdg_content_size = jQuery("#content_font_size").val();
    content_color = "#000000";
    wdg_width = jQuery("#wdg_width").val();
    wdg_height = jQuery("#wdg_height").val();
    top_border_color = jQuery("#hd_color").val();
    wdg_default_state = jQuery('input:radio[name=default_state]:checked').val();
    wdg_invite_user_txt = jQuery('#wg-invite').val();
    wdg_show_widget = jQuery("#widget_status_input").val();
    wdg_father_chritmas = jQuery("#wdg_father_chritmas").val();
    var wdg_params = {
        'title': title,
        'font_title': title_font,
        'content_font': content_family,
        'title_font_color': title_color,
        'alignment': wdg_alignment,
        'bg_color': bg_color,
        'title_size': title_size,
        'content_size': wdg_content_size,
        'content_font_color': content_color,
        'height': wdg_height,
        'width': wdg_width,
        'top_border_color': top_border_color,
        'wdg_default_state': wdg_default_state,
        'wdg_invite_user_txt': wdg_invite_user_txt,
        'wdg_father_chritmas': wdg_father_chritmas,
        'wdg_show_widget': wdg_show_widget,
        'review_button_text': jQuery('#wdg_review_btn_text').val(),
        'review_for_text': jQuery('#wdg_review_for_text').val(),
        'widget_transition_speed': jQuery('#widget_transition_speed').val()
    };

    var values = {
        'uid': jQuery("#uid").val(),
        'wdg_params': wdg_params,
        'widget_type_id': widget_type_id
    };

    var API_DOMAIN = jQuery("#api_domain").val();

    jQuery.post(API_DOMAIN + "api/widget/save_widget_config", values, function(data) {
        console.log(data);
        jQuery("#wdg-save-btn").html("Save Changes");
        jQuery("#wdg-save-btn").removeClass("btn-default");
        jQuery("#wdg-save-btn").addClass("btn-primary");
        jQuery(".ok-span").removeClass("hide");

    });
    return 1;
}