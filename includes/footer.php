<div id="copyright-div">
    &copy; 2014 Kudobuzz
</div>
</div>
</div>
<input type="hidden" id="feeds-category" value="social" />
<input type="hidden" id="type" value="suggested" />
<input type="hidden" id="api_domain" value="<?php echo API_DOMAIN ?>" />
<input type="hidden" id="user_id" value="<?php echo $user_id ?>" />
<input type="hidden" id="selected_widget_type_id" value="<?php echo isset($widget_type_id) ? $widget_type_id : '' ?>" />
<input type="hidden" id="uid" value="<?php echo $kd_uid ?>" />
<input type="hidden" id="total_connected" value="<?php echo $total_connected?>" />

<?php $template_url = API_DOMAIN . "preview-template/" . $widget_params->widget_id . "?uid=" . $kd_uid ?>
<input type="hidden" id="template_url" value="<?php echo $template_url ?>">

<script>
    var suggested_page_num, all_page_num, published_page_num, unpublished_page_num, fb_page_id;
    var active_tab = "suggested";
    var category = "social";
    var search;
    var social_filter = 'All Reviews';
    var total_accounts =<?php echo $total_connected ?>;
    var plan = '<?php echo $plan ?>';
    var total_kudos = <?php echo $total_kudos ?>;

    jQuery(document).on("click", ".left-panel a", function() {

        jQuery(".left-panel a").removeClass("kdb-active");
        jQuery(this).addClass("kdb-active");

        if (jQuery(this).html().trim() === 'Social Reviews') {
            jQuery("#feeds-category").val('social');
        }
        else if (jQuery(this).html().trim() === 'Custom Reviews') {
            jQuery("#feeds-category").val('custom');
        }
        else if (jQuery(this).html().trim() === 'Website Reviews') {
            jQuery("#feeds-category").val('website');
        }


        var mydata = {
            action: "get_feeds_options",
            'type': jQuery("#type").val(),
            'page': eval("all_page_num"),
            'category': jQuery("#feeds-category").val(),
            'social_filter': "All Reviews",
            'uid': '<?php echo $kd_uid ?>',
            'total_connected' : $("#total_connected").val()
        };

        suggested_page_num = 1;
        all_page_num = 1;
        published_page_num = 1;
        unpublished_page_num = 1;

        //LOAD FETCH WHEN THE WINDOW LOADS
        fetch_feeds(mydata);
    });

    function load_feed() {

        if (active_tab === 'suggested') {
            suggested_page_num++;
            var mydata = {
                action: "get_feeds_options",
                'type': jQuery("#type").val(),
                'page': suggested_page_num,
                'category': category,
                'uid': '<?php echo $kd_uid ?>',
                'search': search,
                'social_filter': social_filter,
                'total_connected' : $("#total_connected").val()
            };


            fetch_feeds(mydata, 1);

        } else if (active_tab == 'all') {
            all_page_num++;
            var mydata = {
                action: "get_feeds_options",
                'type': jQuery("#type").val(),
                'page': all_page_num,
                'category': category,
                'uid': '<?php echo $kd_uid ?>',
                'search': search,
                'social_filter': social_filter,
                'total_connected' : $("#total_connected").val()
            };


            fetch_feeds(mydata, 1);

        } else if (active_tab == 'published') {

            published_page_num++;
            var mydata = {
                action: "get_feeds_options",
                'type': jQuery("#type").val(),
                'page': published_page_num,
                'category': category,
                'uid': '<?php echo $kd_uid ?>',
                'search': search,
                'social_filter': social_filter,
                'total_connected' : $("#total_connected").val()
            };

            fetch_feeds(mydata, 1);
        } else if (active_tab == 'unpublished') {
            unpublished_page_num++;

            var mydata = {
                action: "get_feeds_options",
                'type': jQuery("#type").val(),
                'page': unpublished_page_num,
                'category': category,
                'uid': '<?php echo $kd_uid ?>',
                'search': search,
                'social_filter': social_filter,
                'total_connected' : $("#total_connected").val()
            };
            fetch_feeds(mydata, 1);
        }
    }
    
    //$.noConflict();
    jQuery(document).ready(function($) {
    	
    	jQuery("#feeds-category").val("social");
        jQuery(".feed_list_scroll").live("scrollend", load_feed);

        jQuery('.kwdgt_color').each(function() {

            jQuery(this).minicolors({
                control: jQuery(this).attr('data-control') || 'hue',
                defaultValue: jQuery(this).attr('data-defaultValue') || '',
                inline: jQuery(this).attr('data-inline') === 'true',
                letterCase: jQuery(this).attr('data-letterCase') || 'lowercase',
                opacity: jQuery(this).attr('data-opacity'),
                position: jQuery(this).attr('data-position') || 'bottom left',
                change: function(hex, opacity) {
                    var log;
                    try {
                        log = hex ? hex : 'transparent';
                        if (opacity)
                            log += ', ' + opacity;
                        console.log(log);
                    } catch (e) {
                    }
                },
                theme: 'bootstrap'
            });

        });

        var mydata = {
            action: "get_feeds_options",
            'type': 'suggested',
            'page': eval("all_page_num"),
            'category': jQuery("#feeds-category").val(),
            'social_filter': "All Reviews",
            'uid': '<?php echo $kd_uid ?>',
            'total_connected' : $("#total_connected").val()
        };

        suggested_page_num = 1;
        all_page_num = 1;
        published_page_num = 1;
        unpublished_page_num = 1;

        //LOAD FETCH WHEN THE WINDOW LOADS
        fetch_feeds(mydata);

        //Nano scroller
        jQuery(".nano").nanoScroller();

        /*
         * Load tab content 
         */
        jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

            var social_list = this.innerHTML;

            social_filter = social_list.replace(/(<([^>]+)>)/ig, "");
            jQuery('.social_filter_source').html(social_filter);

            suggested_page_num = 1;
            all_page_num = 1;
            published_page_num = 1;
            unpublished_page_num = 1;

            var target = jQuery(e.target).attr("href"); // activated tab
            active_tab = target.split("#")[1];
            var category = category;
            var social_filter = 'All Reviews';

            jQuery("#type").val(active_tab.trim());

            var mydata = {
                action: "get_feeds_options",
                'type': active_tab,
                'page': eval(active_tab + "_page_num"),
                'category': jQuery("#feeds-category").val(),
                'social_filter': social_filter,
                'uid': '<?php echo $kd_uid ?>',
                'total_connected' : $("#total_connected").val()
            };

            if (!jQuery(target).is(':empty')) {

                fetch_feeds(mydata);
            }
        });

        jQuery(document).on("click", "#update_cname", function() {

            jQuery('.validation_feedback').removeClass("hide");
            jQuery('.validation_feedback').addClass("alert-info");
            jQuery('.validation_feedback').removeClass("alert-success");
            jQuery('.validation_feedback').removeClass("alert-danger");

            jQuery('.validation_feedback').html("Please wait...");


            if (jQuery('#vanity').val() === '') {

                jQuery('.validation_feedback').removeClass("hide");
                jQuery('.validation_feedback').removeClass("alert-info");
                jQuery('.validation_feedback').removeClass("alert-success");
                jQuery('.validation_feedback').addClass("alert-danger");

                jQuery('.validation_feedback').html('Specify your vanity name.');
                jQuery('#vanity-wrapper-div').find('#img_place_holder').html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png">');
                return false;
            }
            if (hasWhiteSpace(jQuery('#vanity').val())) {
                vanity_is_valid = false;
                jQuery('.validation_feedback').html('Account name should not contain whitespace');
                jQuery('#vanity-wrapper-div').find('#img_place_holder').html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png">');
                return false;
            }
            if ((jQuery('#vanity').val().substr(0, 7) === "http://") || jQuery('#vanity').val().substr(0, 8) === "https://") {
                vanity_is_valid = false;
                jQuery('.validation_feedback').html('Account name should not contain http or https');
                jQuery('#vanity-wrapper-div').find('#img_place_holder').html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png">');
                return false;
            }

            jQuery.get('<?php echo API_DOMAIN ?>account/check_vanity', {'vanity': jQuery('#vanity').val()}, function(data) {
                if (data == 0 && (jQuery('#vanity').val() != jQuery('#subdomain').val())) {

                    jQuery('.validation_feedback').removeClass("hide");
                    jQuery('.validation_feedback').removeClass("alert-info");
                    jQuery('.validation_feedback').removeClass("alert-success");
                    jQuery('.validation_feedback').addClass("alert-danger");

                    jQuery('.validation_feedback').html('This account name is already in use.');
                    jQuery('#vanity-wrapper-div').find('#img_place_holder').html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/w.png">');
                }
                else {
                    jQuery('.validation_feedback').removeClass("hide");
                    jQuery('.validation_feedback').addClass("alert-info");
                    jQuery('.validation_feedback').removeClass("alert-success");
                    jQuery('.validation_feedback').removeClass("alert-danger");

                    jQuery('.validation_feedback').html("Please wait...");
                    jQuery('#vanity-wrapper-div').find('#img_place_holder').html('');

                    var params = {'account_id': <?php echo $account_id ?>, 'vanity_url': jQuery('#vanity').val().toLowerCase(), 'cname': jQuery('#inputCname').val()};

                    jQuery.post('<?php echo API_DOMAIN ?>account/update', params, function(data) {

                        jQuery('.validation_feedback').removeClass("hide");
                        jQuery('.validation_feedback').removeClass("alert-info");
                        jQuery('.validation_feedback').addClass("alert-success");
                        jQuery('.validation_feedback').removeClass("alert-danger");

                        jQuery('.validation_feedback').html('Success!');
                    });
                }
            });
        });


        var id_wdg = jQuery('input:radio[name=wg]:checked').val();
        customize_frm(id_wdg);

        jQuery("input:radio[name=wg]").change(function() {

            id_wdg = jQuery('input:radio[name=wg]:checked').val();
            jQuery("#selected_widget_type_id").val(id_wdg);

            //alert(jQuery("#selected_widget_type_id").val());


            customize_frm(id_wdg);

            load_iframe(id_wdg);
        });
    });

    function customize_frm(value) {
        if (value == 3) {
            jQuery('.wdg-title-div').show();
            //jQuery('.title-font-div').show();
            //jQuery('.title-font-size-div').show();
            jQuery('.title-font-color-div').show();
            jQuery('.default-state-div').show();
            jQuery('.alignment-div').show();
            jQuery('.bg_dev').show();
        }
        else if (value == 12) {
            jQuery('.wdg-title-div').show();
            jQuery('.title-font-div').hide();
            jQuery('.title-font-size-div').hide();
            jQuery('.title-font-color-div').show();
            jQuery('.default-state-div').show();
            jQuery('.alignment-div').show();
            jQuery('.bg_dev').show();
        }
        else {
            jQuery('.wdg-title-div').hide();
            jQuery('.title-font-div').hide();
            jQuery('.title-font-size-div').hide();
            jQuery('.title-font-color-div').hide();
            jQuery('.default-state-div').hide();
            jQuery('.alignment-div').hide();
            jQuery('.bg_dev').hide();
        }
    }

    function load_iframe(id_wdg) {

        jQuery(".loading-widget-div").removeClass("hide");
        var iframe = jQuery('.wg-preview-iframe');

        var url = "<?php echo API_DOMAIN ?>preview-template/" + id_wdg + "?uid=<?php echo $kd_uid ?>";
        iframe.attr("src", url);
    }

    function hasWhiteSpace(s) {
        return /\s/g.test(s);
    }

    /*
     * TWITTER AUTHENCATION
     */
    jQuery(document).on("click", "#add-tw-account", function() {

        if (plan === '0' && total_accounts >= 1) {

            bootbox.dialog({
                message: "<p>You can add only one social account with the free plan.</p><p>You may upgrade to a paid plan in other to add more.</p><p><input type='button' value='UPGRADE NOW!' class='btn btn-primary show-upgrade-modal'></p>",
                title: "Upgrade",
                buttons: {
                    success: {
                        label: "Ok",
                        className: "btn-default"
                    }
                }
            });
            return false;
        }

        var targetFrame = jQuery('#parent-iframe')[0];
        targetFrame.contentWindow.postMessage('tw-<?php echo $user_id ?>-<?php echo $account_id ?>-<?php echo $email ?>', '<?php echo API_DOMAIN ?>');
    });
    
    $(document).on("click", ".show-upgrade-modal", function(){
        $(".modal").modal("hide");
        $(".upgrade-form").modal("show");
    });

    /*
     * FACEBOOK AUTHENCATION
     */
    jQuery(document).on("click", "#add-fb-account", function() {

        if (plan === '0' && total_accounts >= 1) {

            bootbox.dialog({
                message: "<p>You can add only one social account with the free plan.</p><p>You may upgrade to a paid account in other to add more.</p><p><input type='button' value='UPGRADE NOW!' class='btn btn-primary show-upgrade-modal'></p>",
                title: "Upgrade",
                buttons: {
                    success: {
                        label: "Ok",
                        className: "btn-default"
                    }
                }
            });
            return false;
        }

        var targetFrame = jQuery('#parent-iframe')[0];
        targetFrame.contentWindow.postMessage('fb-<?php echo $user_id ?>-<?php echo $account_id ?>-<?php echo $email ?>', '<?php echo API_DOMAIN ?>');
    });



    /*
     * Publish feed
     */
    jQuery(document).on("click", ".publish", function() {

        if (plan === '0' && total_kudos >= 10) {

            bootbox.dialog({
                message: "<p>You can add only 10 social reviews with the free plan.</p><p>You may upgrade to a paid plan in other to add more.</p><p><input type='button' value='UPGRADE NOW!' class='btn btn-primary show-upgrade-modal'></p>",
                title: "Upgrade",
                buttons: {
                    success: {
                        label: "Ok",
                        className: "btn-default"
                    }
                }
            });
            return false;
        }

        var entity_id = jQuery(this).closest("tr").attr("id");
        var channel = jQuery(this).closest("tr").find("#channel").val();

        var from_user_name = jQuery(this).closest("tr").find(".from_user_name").html();
        var from_user_img = jQuery(this).closest("tr").find(".from_user_img").attr("src");
        var from_twitter_message = jQuery(this).closest("tr").find(".from_twitter_message").html();
        var created_at = jQuery(this).closest("tr").find(".created_at").html();
        var rating = jQuery(this).closest("tr").find(".rating-value").val();

        var $this_id = jQuery(this).closest("tr").attr("id");

        var mydata = {
            action: "post_publish_action",
            'uid': '<?php echo $kd_uid ?>',
            'entity_id': entity_id,
            'channel': channel,
            'from_user_name': from_user_name.trim(),
            'from_user_img': from_user_img,
            'from_twitter_message': from_twitter_message.trim(),
            'created_at': created_at
        };

        jQuery("#" + $this_id).find(".publish").html("Publishing...");

        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: mydata,
            error: function(data) {
                console.log(data.responseText);
            },
            success: function(data, textStatus, jqXHR) {

                jQuery("#" + $this_id).find(".publish").addClass("hide");
                jQuery("#" + $this_id).find(".unpublish").removeClass("hide");

                jQuery("#" + $this_id).find(".feed-statu").html("Published");
                jQuery("#" + $this_id).find(".feed-statu").removeClass("label-danger").addClass("label-success");
                jQuery("#" + $this_id).find(".publish").html("Unpublish");


                total_kudos++;
                console.log(total_kudos);

            }
        });

    });

    /*
     * Unpublish feeds   
     */
    function remove_kudo(entityid, type, id) {
        var channel_id = 0;
        if (type == 'fb') {
            channel_id = 2;
        } else if (type == 'tw') {
            channel_id = 1;
        } else if (type == 'cs') {
            channel_id = 3;
        } else if (type == 'sh') {
            channel_id = 8;
        } else if (type == 'rev') {
            channel_id = 9;
        } else if (type == 'in') {
            channel_id = 10;
        }
        if (channel_id != 0) {
            var user_id = jQuery("#user_id").val();
            var message = "Are you sure?";
            var params = {"user_id": user_id, "entity_id": entityid, 'channel_id': channel_id};

            bootbox.confirm(message, function(result) {
                if (result) {
                    console.log("#" + type + "-" + id);
                    jQuery("#published_tb_feed #" + type + "-" + id).fadeOut();
                    jQuery(".published_status-" + type + "-" + id).html('not published');
                    jQuery(".feed" + type + "-" + id).removeClass("just_published");
                    jQuery("." + type + "-" + id).removeClass("kudo_added");

                    jQuery("#" + entityid).find(".unpublish").html("Unpublishing...");

                    jQuery.post("<?php echo API_DOMAIN ?>kudos/delete", params, function(data) {

                        total_kudos--;
                        console.log(total_kudos);

                        jQuery("#" + entityid).find(".unpublish").addClass("hide");
                        jQuery("#" + entityid).find(".unpublish").html("Unpublish");
                        jQuery("#" + entityid).find(".publish").removeClass("hide");

                        jQuery("#" + entityid).find(".feed-statu").html("Unpublished");
                        jQuery("#" + entityid).find(".feed-statu").removeClass("label-success").addClass("label-danger");
                    });
                }
            });

        }
    }

    /*
     * Fetch 
     */

    function fetch_feeds(mydata, append) {
        if (!append) {
            jQuery(".loading-fb").removeClass("hide");
        }
        else {
            jQuery(".loading-more").removeClass("hide");
        }

        jQuery.ajax({
            type: "GET",
            url: ajaxurl,
            dataType: "html",
            data: mydata,
            error: function(data) {
                console.log(data.responseText);
            },
            success: function(data, textStatus, jqXHR) {
                jQuery(".loading-fb").addClass("hide");
                jQuery(".loading-more").addClass("hide");

                if (append) {
                    jQuery("#" + mydata.type).find('.feeds-div').append(data);
                } else {
                    jQuery('.feeds-div').html("");
                    jQuery("#" + mydata.type).find('.feeds-div').html(data);
                }

                jQuery(".rateit").rateit();
            }
        });
    }

    /*
     * Get social accounts 
     */
    function get_social_accounts(param) {
        console.log("Total accounts: " + total_accounts);
        //Get connected accounts
        var url = '<?php echo API_DOMAIN ?>social_connected_accounts?user_id=<?php echo $user_id ?>&account_id=<?php echo $account_id ?>';

                jQuery.get(url, function(data) {

                    var social_accounts = JSON.parse(data);

                    var tw_accounts = social_accounts.twitter_accounts;
                    var fb_accounts = social_accounts.facebook_accounts;
                    var in_accounts = social_accounts.instagram_accounts;

                    var str = '<div class="social-accounts-div">';

                    has_tw_account = 0;
                    has_fb_account = 0;
                    has_in_account = 0;

                    str += '<div style="margin-bottom: 5px; border-bottom: 1px dotted #CCC">';
                    str += '<div style="width: 100%; overflow: hidden"><h5 class="pull-left">Twitter Accounts:</h5> <a style="margin-top: 5px" class="btn btn-xs btn-default pull-right" id="add-tw-account" href="javascript:;">Add Twitter Account</a></div>';

                    str += '<p style="margin-bottom:0px">';
                    if (!isEmpty(tw_accounts)) {
                        str += '<div style="width: 100%; overflow: hidden;">';
                        jQuery.each(tw_accounts, function(t, tw) {
                            str += '<div class="social-account-wrapper"><span class="delete-icon-span hide"><img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/close-sm.png" id="' + tw.screen_name + '" class="delete-account-icon" /></span><img data-toggle="tooltip" data-placement="top" title="@' + tw.screen_name + '" class="img-rounded img-thumbnail custom-img-thumbnail social-account-img" style="width: 100%" id="' + tw.id + '" src="' + tw.profile_image_url + '" /></div>';
                        });
                        str += '</div>';
                        str += '</p>';

                        has_tw_account = 1;
                    }
                    else {
                        str += '<p>No Twitter account has been added.</p>';
                    }
                    str += '</div>';

                    str += '<div style="margin-bottom: 5px; border-bottom: 0px dotted #CCC">';


                    str += '<div style="width: 100%; overflow: hidden"><h5 class="pull-left">Facebook Pages:</h5> <a style="margin-top: 5px" class="btn btn-xs btn-default pull-right" id="add-fb-account" href="javascript:;">Add Facebook Pages</a></div>';

                    str += '<p style="margin-bottom: 0px">';

                    if (!isEmpty(fb_accounts)) {

                        str += '<div style="width: 100%; overflow: hidden;">';
                        jQuery.each(fb_accounts, function(t, fb) {
                            str += '<div class="social-account-wrapper"><span class="delete-icon-span hide"><img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/close-sm.png" id="' + fb.social_profile_id + '" class="delete-account-icon" /></span><img data-toggle="tooltip" data-placement="top" title="' + fb.name + '" class="img-rounded img-thumbnail custom-img-thumbnail social-account-img" style="width: 100%" id="' + fb.social_profile_id + '" src="https://graph.facebook.com/' + fb.social_profile_id + '/picture?redirect=true&type=large" /></div>';
                        });
                        str += '</div>';

                        str += '</p>';

                        has_fb_account = 1;
                    }
                    else {
                        str += '<p>No Facebook page has been added.</p>';
                    }
                    str += '</div>';


                    str += '<div style="display:none">';
                    str += '<div style="width: 100%; overflow: hidden; "><h5 class="pull-left">Instagram Accounts:</h5> <a style="margin-top: 5px" class="btn btn-xs btn-default pull-right" add-ins-account href="javascript:;">Add Instagram Accounts</a></div>';
                    str += '<p style="margin-bottom: 20px">';
                    if (!isEmpty(in_accounts)) {
                        jQuery.each(in_accounts, function(i, ins) {
                            str += '<div><button id="' + ins.social_profile_id + '" onclick="delete_in(' + ins.social_profile_id + ')" class="confirm-tooltip" style="margin-bottom: 5px; cursor: pointer;">' + ins.name + '</button></div>';
                        });
                        str += '</p>';

                        has_in_account = 1;
                    }
                    else {

                        str += '<p>No Instagram account has been added.</p>';
                    }
                    str += '</div>';


                    if (has_tw_account == 1 || has_fb_account == 1 || has_in_account == 1) {

                        jQuery(".connected").html(str);
                        jQuery('.no-accounts').addClass('hidden');
                        jQuery('.connected-accounts-div').removeClass('hidden');
                    }
                    else {
                        jQuery(".connected").html('');
                        jQuery('.no-accounts').removeClass('hidden');
                        jQuery('.connected-accounts-div').addClass('hidden');
                    }

                    if (!param) {
                        show_social_accounts(str);
                    }
                    else {
                        jQuery(".social-accounts-div").html(str);
                    }
                });
            }

            //Delete account
            jQuery(document).on("click", ".delete-account-icon", function() {

                delete_tw(this.id);
            });

            //Show accounts
            function show_social_accounts(str) {

                //Show connected account in modal
                bootbox.dialog({
                    message: str,
                    title: "Social Accounts",
                    buttons: {
                        OK: {
                            label: "OK",
                            className: "btn-primary",
                            callback: function() {
                                //Example.show("Primary button");
                            }
                        }
                    }
                });
            }


            function delete_tw(name) {

                var url = '<?php echo API_DOMAIN ?>twitter/delete_account';
                var user_id = <?php echo $user_id ?>;
                var account_id = <?php echo $account_id ?>;

                jQuery.post(url, {'name': name, 'user_id': user_id, 'account_id': account_id}, function(data) {
                    jQuery("#" + name).closest(".social-account-wrapper").fadeOut();

                    total_accounts--;
                    get_social_accounts(1);
                });
            }



            function delete_fb(id) {

                //notify-deletions-div
                jQuery(".notify-deletions-div").removeClass("hidden");
                acc_id = id;
                return false;

                var url = '<?php echo API_DOMAIN ?>facebook/delete_page';
                var name = jQuery("#" + id).text();


                var user_id = kdz_user_id;
                var account_id = kdz_account_id;

                jQuery.post(url, {'name': name, 'user_id': user_id, 'account_id': account_id}, function(data) {
                    jQuery("#" + id).fadeOut();

                    //Decrease the total number of connected accounts
                    total_accounts--;
                    get_connected_accounts(user_id, account_id);
                });
            }

            function delete_in(id) {
                var url = '<?php echo API_DOMAIN ?>instagram/delete_account';
                var name = jQuery("#ins-" + id).text();
                var user_id = <?php echo $user_id ?>;
                var account_id = <?php echo $account_id ?>;

                jQuery.post(url, {'name': name, 'user_id': user_id, 'account_id': account_id}, function(data) {
                    jQuery("#" + id).fadeOut();

                    //Decrease the total number of connected accounts
                    total_accounts--;
                    get_connected_accounts(user_id, account_id);
                });
            }

            function get_obj_length(obj) {
                count = 0;
                for (i in obj) {
                    if (obj.hasOwnProperty(i)) {
                        count++;
                    }
                }
                return count;
            }

            /*
             * Check if obj is empty or not
             */
            function isEmpty(obj) {
                for (var prop in obj) {
                    if (obj.hasOwnProperty(prop))
                        return false;
                }
                return true;
            }

            jQuery(".social-account-wrapper").live("mouseover", function() {
                jQuery(this).find(".delete-icon-span").removeClass("hide");
            });

            jQuery(".social-account-wrapper").live("mouseout", function() {
                jQuery(this).find(".delete-icon-span").addClass("hide");
            });

            jQuery(document).on("click", ".social-accounts-btn", function() {

                get_social_accounts();
            });


            // Create IE + others compatible event handler
            var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
            var eventer = window[eventMethod];
            var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

            // Listen to message from child window
            eventer(messageEvent, function(e) {
                console.log('starting... ');

                //console.log(e.data); 
                if (e.data === 'account-is-added') {
                    total_accounts++;
                    get_social_accounts(1);
                }
                else if ((e.data).substr(0, 11) === 'fb-is-added') {
                    var arr = (e.data).split("**");
                    var user_details_obj = JSON.parse(arr[1]);
                    var page_details_obj = JSON.parse(arr[2]);

                    //Display facebook pages
                    display_fb_pages(page_details_obj, user_details_obj);
                }

            }, false);

            /*
             * Display facebook pages
             */
            function display_fb_pages(fb_pages_obj, user_details_obj) {

                var str = '<input type="hidden" id="token" value=' + user_details_obj.access_token + ' />';
                str += '<div class="nano" style="height: 350px;">';
                str += '<div class="nano-content">';
                var chose = '';

                var count = 0;
                var i;

                for (i in fb_pages_obj) {
                    if (fb_pages_obj.hasOwnProperty(i)) {
                        count++;
                    }
                }
                if (count > 0) {


                    active_account = "<?php echo $account_name ?>";
                    uid = <?php echo $user_id ?>;
                    platform = 1;
                    user_email = "<?php echo $email ?>";

                    var user_fb_pages = '';
                    jQuery.each(fb_pages_obj, function(i, item) {

                        user_fb_pages += item.name + ", ";

                        if (item.active == 1) {
                            chose = 'checked="checked"';
                        }
                        else {
                            chose = '';
                        }

                        str += '<div class="single-fb-page">';
                        str += '<input type="hidden" id="token" value=' + item.access_token + ' />';
                        str += '<div id="checkbox-div">';
                        str += '<input type="hidden" id="name-' + item.id + '" value="' + item.name + '">';
                        str += '<input type="hidden" id="access-token-' + item.id + '" value="' + item.access_token + '">';
                        str += '<input type="hidden" id="category-' + item.category + '">';
                        str += '<input type="hidden" id="fb_user_id" value="' + user_details_obj.fb_user_id + '">';
                        str += '<input type="radio" value="' + item.id + '" class="channel-checkbox" id="c' + i + '" name="fb_page"' + chose + '/>';
                        str += '<label for="c' + i + '"><span></span></label>';
                        str += '</div>';
                        str += '<div id="channel-img-div">';
                        str += '<img class="img-rounded img-thumbnail custom-img-thumbnail" src="' + 'https://graph.facebook.com/' + item.id + '/picture?redirect=true&type=large' + '">';
                        str += '</div>';
                        str += '<div id="channel-text-wrapper">';
                        str += '<div id="title">' + item.name + '</div>';
                        str += '</div>';
                        str += '</div>';
                    });
                    str += '</div></div>';

                    jQuery(".nano").nanoScroller();
                    //jQuery(".connect-div").addClass("hidden");
                    jQuery(".facebook-pages-wrappers").removeClass("hidden");
                    jQuery(".facebook-pages").html(str);
                    //console.log(str);
                }
                else {

                    console.log("No page found for this account.");
                }

                //Show facebook pages
                bootbox.dialog({
                    message: str,
                    title: "SELECT FACEBOOK PAGE",
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

            jQuery(document).on("change", "input:radio[name=fb_page]", function() {
                jQuery(".modal-footer button").removeClass("hide");
                fb_page_id = jQuery("input:radio[name=fb_page]:checked").val();
            });
            
            jQuery(document).on("change", "input:radio[name=pro-price]", function() {
                var plan = jQuery(this).attr("checked", true).val();
                if(plan === 'monthly'){
                    jQuery(this).closest(".plan-div").find("#price-tag").html("4.99");
                    jQuery("#hidden-pricing").val(4.99);
                    jQuery("#hidden-pricing-desc").val("1 Month Professional Plan");
                    jQuery("#hidden-pricing-duration").val(30);
                    jQuery("#hidden-pricing-plan").val(1);
                    jQuery("#hidden-plan-id").val("100");
                }
                else if(plan === 'yearly'){
                    jQuery(this).closest(".plan-div").find("#price-tag").html("3.99");
                    jQuery("#hidden-pricing").val(3.99*12);
                    jQuery("#hidden-pricing-desc").val("1 Year Professional Plan");
                    jQuery("#hidden-pricing-duration").val(365);
                    jQuery("#hidden-pricing-plan").val(2);
                    jQuery("#hidden-plan-id").val("200");
                }
            });

            /*
             * Add facebook page
             */
            function add_fb_page() {

                var selected_fb_page_id = fb_page_id;

                jQuery("#add-fb-status").html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/ajax-loader.gif" style="vertical-align: middle"> <span style="color: green">Adding new account</span>');

                var user_id = <?php echo $user_id ?>;
                var account_id = <?php echo $account_id ?>;
                var page_id = selected_fb_page_id;
                var access_token = jQuery('#access-token-' + page_id).val();
                var name = jQuery('#name-' + page_id).val();
                var fb_user_id = jQuery('#access-token-' + page_id).closest(".single-fb-page").find("#fb_user_id").val();
                var account_token = jQuery('#token').val();

                var params = {
                    'page_id': selected_fb_page_id,
                    'access_token': access_token,
                    'name': name,
                    'fb_user_id': fb_user_id,
                    'user_id': user_id,
                    'account_token': account_token
                };

                var active_account = "<?php echo $account_name ?>";

                jQuery.ajax({
                    url: '<?php echo API_DOMAIN ?>save-page',
                    data: {'params': params, 'active_account': active_account},
                    type: 'POST',
                    crossDomain: true,
                    success: function(data) {
                        total_accounts++;
                        console.log(data);

                        jQuery(".fb-pages-modal").modal("hide");
                        get_social_accounts(1);

                        //Trigger the crawler to crawl feeds for this particular page
                        jQuery.post("<?php echo API_DOMAIN ?>facebook/crawl", {'user_id': user_id, 'page_id': selected_fb_page_id, 'fetch_type': 1}, function(result) {
                            console.log(result);
                        });
                    },
                    error: function() {
                        alert('Failed!');
                    }
                });
            }


            function save_translation() {
                var active_account = "<?php echo $account_name ?>";
                var uid = <?php echo $user_id ?>;
                var platform = 1;
                var user_email = "<?php echo $email ?>";

                var dataArray = {
                    'account_id': <?php echo $account_id ?>,
                    'submit_review_button': jQuery('#submit-review-button').val(),
                    'review_title_placeholder': jQuery('#title-placeholder').val(),
                    'review_content_placeholder': jQuery('#content-placeholder').val(),
                    'signin_with_text': jQuery('#signin-with-text').val(),
                    'signin_email_text': jQuery('#signin-email-text').val(),
                    'name_placeholder': jQuery('#name-placeholder').val(),
                    'email_placeholder': jQuery('#email-placeholder').val(),
                    'cancel': jQuery('#cancel').val(),
                    'title_message': jQuery('#title_message').val(),
                    'review_button_text': jQuery('#review-button-text').val(),
                    'closed_review_form_message': jQuery('#closed-review-form-message').val(),
                    'read_more': jQuery('#read-more').val(),
                    'read_less': jQuery('#read-less').val(),
                    'review_text': jQuery('#review-text').val(),
                    'reviews_text': jQuery('#reviews-text').val(),
                    'thumbs_up_down_message': jQuery('#thumbs-up-down-message').val(),
                    'thanks_for_review': jQuery('#thanks-for-review').val(),
                    'select_rating': jQuery('#select-rating').val(),
                    'enter_review_text': jQuery('#enter-review-text').val(),
                    'share_review_text': jQuery('#share-review-text').val(),
                    'give_a_title': jQuery('#give-a-title').val(),
                    'sign_up_or_authenticate': jQuery('#sign-up-or-authenticate').val(),
                    'review_length': jQuery('#review-length').val(),
                    'view_full_post': jQuery('#view_full_post').val(),
                    'user_id': jQuery('#user_id').val()};

                jQuery('#save-btn').hide();

                jQuery.ajax({
                    url: "<?php echo API_DOMAIN ?>reviews/update_form_setting",
                    type: 'POST',
                    data: dataArray,
                    dataType: 'html',
                    success: function(data) {
                        var response = JSON.parse(data);
                        console.log(data);
                        if (response == 1) {
                            jQuery('#save-btn').show();
                            jQuery('#save_status').html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png" style="width: 14px; height: 14px; vertical-align: middle; margin-right: 5px;" /><span style="vertical-align: middle; color: green">Success</span>');
                        }
                    }
                });
            }
</script>


<div class="modal fade upgrade-form" id="myModal" tabindex="999" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Kudobuzz Pricing Plans</h4>
            </div>
            <div class="modal-body">
                <div style="width: 100%; overflow: hidden">
                    <div class="plan-div free-plan-div">
                        <div id="title">
                            Free Plan
                        </div>
                        <div id="plan-price">
                            <p id="price-desc">
                                <span style="font-size: 20px; vertical-align: top; color: #CDC7C4">$</span>
                                <span id="price-tag">0</span><br>
                                <span style="color: #CDC7C4">Per Month</span>
                            </p>
                        </div>
                        <div id="content">
                            <div id="feature">
                                1 Social Account
                            </div>
                            <div id="feature">
                                10 Social Reviews
                            </div>
                            <div id="feature"  style="border: 0">
                                Unlimited Custom Reviwes
                            </div>
                        </div>
                        <div class="btn-div">
                            <input type="button" class="btn btn-default" value="Total Free" style="width: 100px" />
                        </div>
                    </div>

                    <div class="plan-div free-plan-div">
                        <div id="title">
                            Professional
                        </div>
                        <div id="plan-price">
                            <p id="price-desc">
                                <span style="font-size: 20px; vertical-align: top; color: #CDC7C4">$</span>
                                <span id="price-tag">4.99</span><br>
                                <span style="color: #CDC7C4">Per Month</span>
                            </p>
                        </div>

                        <div id="content">
                            <div id="feature">
                                Unlimited Social Accounts
                            </div>
                            <div id="feature">
                                Unlimited Social Reviews
                            </div>
                            <div id="feature">
                                Unlimited Custom Reviwes
                            </div>
                            <div id="feature">
                                Google Rich Snippet
                            </div>
                            <div id="feature">
                                Advance Widget Customization
                            </div>
                            <div id="feature"  style="border: 0; width: 205px; margin: 0 auto">

                                <div class="pull-left">
                                    <label class="radio checked">
                                        <input type="radio" name="pro-price" value="monthly" data-toggle="radio" checked="">
                                        Monthly
                                    </label>
                                </div>

                                <div class="pull-left">                         
                                    <label class="radio">
                                        <input type="radio" name="pro-price" value="yearly" data-toggle="radio">
                                        Yearly
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="btn-div">
                            <script src="https://checkout.stripe.com/checkout.js"></script>

                            <button id="professional" class="btn btn-default">Purchase</button>
                            <input type="hidden" id="hidden-pricing" value="4.99" />
                            <input type="hidden" id="hidden-pricing-desc" value="1 Month Professional Plan" />
                            <input type="hidden" id="hidden-pricing-duration" value="30" />
                            <input type="hidden" id="hidden-pricing-plan" value="1" />
                            <input type="hidden" id="hidden-plan-id" value="100" />

                            <script>
                                var handler = StripeCheckout.configure({
                                    key: '<?php echo STRIPE_PUBLISHABLE_KEY ?>',
                                    image: '../wp-content/plugins/kudobux-testimonial-widget/assets/img/kudobuzz-logo.png',
                                    token: function(token) {
                                        var params = {
                                            'token': token,
                                            'uid': '<?php echo $kd_uid ?>',
                                            'payment_duration': jQuery("#hidden-pricing-duration").val(),
                                            'payment_plan': jQuery("#hidden-pricing-plan").val(),
                                            'amount': jQuery("#hidden-pricing").val() * 100,
                                            'plan_id': jQuery("#hidden-plan-id").val()
                                        };
                                        jQuery(".upgrade-form").modal("hide");
                                        bootbox.dialog({
                                            message: '<div class="upgrade-modal-div"><div style="text-align: center; padding: 20px 0"><img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader-big.gif" /></div></div>',
                                            title: "Upgrading...",
                                            className: 'small-modal'
                                        });
                                        jQuery(".small-modal .bootbox-close-button").addClass("hide");
                                        jQuery.ajax({
                                            url: '<?php echo API_DOMAIN ?>api/plan/upgrade',
                                            type: 'POST',
                                            data: params,
                                            success: function(result) {

                                                jQuery(".small-modal .modal-title").html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png" style="margin-right: 5px;" />Success');
                                                jQuery(".upgrade-modal-div").html("<h3>Success!</h3><p>Your account has been successfully upgraded. Please click the button below to complete the process.</p><a href='javascript:;' onclick='location.reload();' class='btn btn-primary'>Done</a>");
                                            }
                                        });
                                    }
                                });

                                document.getElementById('professional').addEventListener('click', function(e) {
                                    // Open Checkout with further options
                                    handler.open({
                                        name: 'Kudobuzz',
                                        description: jQuery("#hidden-pricing-desc").val() + ' ($' + jQuery("#hidden-pricing").val() + ')',
                                        amount: jQuery("#hidden-pricing").val() * 100
                                    });
                                    e.preventDefault();
                                });
                            </script>
                        </div>
                    </div>

                    <div class="plan-div pro-plan-div" style="margin: 0">
                        <div id="title">
                            Lifetime
                        </div>
                        <div id="plan-price">
                            <p id="price-desc">
                                <span style="font-size: 20px; vertical-align: top; color: #CDC7C4">$</span>
                                <span id="price-tag">99.99</span><br>
                                <span style="color: #CDC7C4">One time, Life time</span>
                            </p>
                        </div>

                        <div id="content">
                            <div id="feature">
                                Unlimited Social Accounts
                            </div>
                            <div id="feature">
                                Unlimited Social Reviews
                            </div>
                            <div id="feature">
                                Unlimited Custom Reviwes
                            </div>
                            <div id="feature">
                                Google Rich Snippet
                            </div>
                            <div id="feature" style="border: 0">
                                Advance Widget Customization
                            </div>
                        </div>

                        <div class="btn-div">
                            <script src="https://checkout.stripe.com/checkout.js"></script>

                            <button id="lifetime" class="btn btn-default">Purchase</button>

                            <script>
                                var handler_2 = StripeCheckout.configure({
                                    key: '<?php echo STRIPE_PUBLISHABLE_KEY ?>',
                                    image: '../wp-content/plugins/kudobux-testimonial-widget/assets/img/kudobuzz-logo.png',
                                    token: function(token) {
                                        var params = {
                                            'token': token,
                                            'uid': '<?php echo $kd_uid ?>',
                                            'payment_duration': jQuery("#hidden-pricing-duration").val(),
                                            'payment_plan': jQuery("#hidden-pricing-plan").val(),
                                            'amount': 99.99 * 100
                                        };
                                        jQuery(".upgrade-form").modal("hide");
                                        bootbox.dialog({
                                            message: '<div class="upgrade-modal-div"><div style="text-align: center; padding: 20px 0"><img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/loader-big.gif" /></div></div>',
                                            title: "Upgrading...",
                                            className: 'small-modal'
                                        });
                                        jQuery(".small-modal .bootbox-close-button").addClass("hide");
                                        jQuery.ajax({
                                            url: '<?php echo API_DOMAIN ?>api/plan/upgrade',
                                            type: 'POST',
                                            data: params,
                                            success: function(result) {

                                                jQuery(".small-modal .modal-title").html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png" style="margin-right: 5px;" />Success');
                                                jQuery(".upgrade-modal-div").html("<h3>Success!</h3><p>Your account has been successfully upgraded. Please click the button below to complete the process.</p><a href='javascript:;' onclick='location.reload();' class='btn btn-primary'>Done</a>");
                                            }
                                        });
                                    }
                                });

                                document.getElementById('lifetime').addEventListener('click', function(e) {
                                    // Open Checkout with further options
                                    handler_2.open({
                                        name: 'Kudobuzz',
                                        description: 'One time, Life time',
                                        amount: 99.99 * 100
                                    });
                                    e.preventDefault();
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer hide">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
