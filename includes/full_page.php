<?php
ini_set('display_errors', 1);
$kd_uid = get_option('kudobuzz_uid');

if (isset($kd_uid) && $kd_uid != NULL) {

    include_once 'data.php';

    //Get widget settings
    $url = API_DOMAIN . 'api/widget/full_page?uid=' . $kd_uid;

    $params = json_decode($kdwp->run_curl($url, "GET"));
    

    $widget_settings = $params->result[0];

    $review_tab_active = "";
    $full_page_active = "kdb-active";
    ?>

    <div class="main-wrapper">
        <div class="main-app-wrapper">
            <div id="title-div">
                <span class="pull-left" style="padding-top:8px">KUDOBUZZ</span>

                <?php include_once 'iframe-link.php' ?>

                <?php include_once 'top-links.php'; ?>
            </div>
            <div class="main-app-content" style="min-height: 440px; margin-bottom: 10px;">

                <div class="content-div-wrapper">

                    <?php include_once 'customisation-links.php'; ?>

                    <div style="width: 84%; margin-left: 180px; padding-top: 20px; overflow: hidden">
                        <!--<h4>Customize Themes</h4>-->

                        <div style="margin: 0 auto; width: 300px; overflow: hidden">
                            <div class="pull-left wg_list pull-left" style="width: 120px">                         
                                <label class="radio">
                                    <input type="radio" id="pin_select" name="wg" value="8" data-toggle="radio" <?php echo $widget_settings->widget_type_id == 8 ? 'checked="checked"' : '' ?>>
                                    Tile View<span class="cust_tips"><span class="fui-alert dash_tooltip" data-toggle="tooltip" data-placement="bottom" data-tooltip-style="light" title="Full page testimonial widget showing tiles of your reviews at a glance"></span></span>
                                </label>
                            </div>

                            <div class="pull-left wg_list pull-left" style="width: 110px">                         
                                <label class="radio">
                                    <input type="radio" id="slider_select" name="wg" value="11" data-toggle="radio" <?php echo $widget_settings->widget_type_id == 11 ? 'checked="checked"' : '' ?>>
                                    List View<span class="cust_tips"><span class="fui-alert dash_tooltip" data-toggle="tooltip" data-placement="bottom" data-tooltip-style="light" title="List widget is an embeddable widget, which shows a list of your reviews"></span></span>
                                </label>
                            </div>
                        </div>
                        <div class="upper_section">

                            <div class="upper_section_innner" style="overflow: hidden">

                                <div style="width: 500px; margin: 0 auto" class="full-page-wdg">

                                    <form id="product-review-frm" method="post">
                                        <input type="hidden" name="account_id" id="account_id" value="<?php echo $account_id; ?>" />

                                        <div class="form-group" style="position: relative !important">

                                            <label class="control-label" for="inputBackgroundColor">Background color</label> <br>
                                            <div class="input-prepend ft_color" style="width: 122px;">
                                                <input type="text" id="background_color" class="small kwdgt_color input-sm" name="post_background_color"  style="width: 50% !important;" value="<?php echo $widget_settings->background_color; ?>" />
                                            </div>
                                        </div>
                                        <div style="clear: both"></div>

                                        <div class="form-group" style="position: relative !important">

                                            <div style="float: left;">
                                                <label class="control-label" for="inputTextColor">Text color</label><br>
                                            <div class="input-prepend ft_color" style="width: 122px;">
                                                <input type="text" id="review_text_color" class="small kwdgt_color input-sm" name="text_font_color"  style="width: 50% !important;" value="<?php echo $widget_settings->review_text_color; ?>" />
                                            </div>
                                            </div>

                                            <div style="float: left;">
                                                <label class="control-label" for="inputTextColor">Name Text Color</label><br>
                                            <div class="input-prepend ft_color" style="width: 122px;">
                                                <input type="text" id="name_text_color" class="small kwdgt_color input-sm" name="text_font_color" style="width: 50% !important;" value="<?php echo $widget_settings->name_text_color; ?>" />
                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-group hide" style="position: relative !important">

                                            <label class="control-label" for="inputTimeToSend">Max Width</label>
                                            <div class="input-prepend ft_color" style="width: 122px;">
                                                <span class="add-on fm_append_small" style="line-height: 30px !important; font-size: 14px; padding: 5px 10px">px</span>
                                                <input type="text" class="small aln fm_input_small input-sm" name="widget_width" id="max_width" style="width: 45px !important;" value='<?php echo $widget_settings->max_width; ?>' />
                                            </div>
                                        </div>

                                        <div class="form-group" style="position: relative !important">

                                            <label class="control-label" for="inputTimeToSend">Write Review Text  Link </label>                             
                                            <input type="text" id="review_link_text" class="small input-sm form-control" placeholder="" value="<?php
                                            if (!isset($widget_settings->review_link_text) || (isset($widget_settings->review_link_text) && empty($widget_settings->review_link_text))) {
                                                $widget_settings->review_link_text = 'Add your review';
                                            } echo $widget_settings->review_link_text;
                                            ?>">
                                        </div>
                                    </form>
                                </div>


                                <div class="controls" style="clear: both; width: 495px; margin: 0 auto 30px auto">
                                    <input type="button" id="save-btn" class="btn btn-small btn-primary" value="Save Changes" onclick="save_settings();">
                                    <span id="frm2_feed"style="display:none"><img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/ajax-loader.gif" style="width: 14px; height: 14px; vertical-align: middle; margin-right: 5px;"><span style="vertical-align: middle">Please wait...</span></span>
                                </div>
                            </div>
                        </div> 
                        <div class="lower_section">
                            <h4 style="width: 93%; margin: 0 auto 25px auto; font-size: 20px;border-bottom: 1px solid #f0f1f5;padding-bottom: 5px;">Preview</h4>
                            <div id="pdr_rev_preview" style="height: 100%;">
                                <input type="hidden"  id="iframe_url" value="<?php echo API_DOMAIN; ?>reviews/one_page_widget?uid=<?php echo $kd_uid; ?>&widget_id=<?php echo $widget_settings->widget_type_id; ?>&review_text_color=<?php echo $widget_settings->review_text_color; ?>&background_color=<?php echo $widget_settings->background_color; ?>&image_background_color=<?php echo $widget_settings->image_background_color; ?>&name_text_color=<?php echo $widget_settings->name_text_color; ?>&review_link_text=<?php echo $widget_settings->review_link_text; ?>" />

                            </div> 
                        </div> 
                    </div>


                    <div style="float: right; width: 83%; min-height: 502px; border: 0px solid #CCC; position: relative; margin-right: 10px">
                        <iframe id="kudobuzz_one_page_kudo" width="700px"  height="400" frameborder="0" src="<?php echo API_DOMAIN; ?>reviews/one_page_widget?uid=<?php echo $kd_uid; ?>&widget_id=<?php echo $widget_settings->widget_type_id; ?>&review_text_color=<?php echo $widget_settings->review_text_color; ?>&background_color=<?php echo $widget_settings->background_color; ?>&image_background_color=<?php echo $widget_settings->image_background_color; ?>&name_text_color=<?php echo $widget_settings->name_text_color; ?>&review_link_text=<?php echo $widget_settings->review_link_text; ?>"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        (function($) {
            var id_wdg = $('input:radio[name=wg]:checked').val();
            show_options(id_wdg);

            $("input:radio[name=wg]").change(function() {
                var id_wdg = $('input:radio[name=wg]:checked').val();

                show_options(id_wdg);
                reload_form();
            });



            var template_url = $("#iframe_url").val();
            var win = $("#kudobuzz_one_page_kudo")[0];
            var arr = [];

            $("#review_text_color, #background_color, #image_background_color, #name_text_color, #review_link_text").blur(function() {
                arr["selected_wdg_id"] = $('input:radio[name=wg]:checked').val();

                if (this.id === "background_color") {
                    arr["type"] = "background_color";
                    arr["background_color"] = this.value;
                }
                else if (this.id === "review_text_color") {
                    arr["type"] = "review_text_color";
                    arr["review_text_color"] = this.value;
                }
                else if (this.id === "image_background_color") {
                    arr["type"] = "image_background_color";
                    arr["image_background_color"] = this.value;
                }
                else if (this.id === "name_text_color") {
                    arr["type"] = "name_text_color";
                    arr["name_text_color"] = this.value;
                } else if (this.id === "review_link_text") {
                    arr["type"] = "review_link_text";
                    arr["review_link_text"] = this.value;
                }
                win.contentWindow.postMessage(arr, template_url);

            });
        })(jQuery);

        function show_options(id_wdg) {
            if (id_wdg === '8') {
                $('#image-background-div').hide();
            }
            else if (id_wdg === '11') {
                $('#image-background-div').show();
            }
        }

        function reload_form() {
            var id_wdg = $('input:radio[name=wg]:checked').val();
            var review_text_color = $('#review_text_color').val();
            var background_color = $('#background_color').val();
            var image_background_color = $('#image_background_color').val();
            var name_text_color = $('#name_text_color').val();
            var one_paged_frame = $('#kudobuzz_one_page_kudo');
            var review_link_text = $('#review_link_text').val();
            var url = "<?php echo API_DOMAIN; ?>reviews/one_page_widget?uid=<?php echo $kd_uid; ?>&preview=1" + "&widget_id=" + id_wdg + "&review_text_color=" + review_text_color + "&background_color=" + background_color + "&image_background_color=" + image_background_color + "&name_text_color=" + name_text_color + "&review_link_text=" + review_link_text;
            one_paged_frame.attr("src", url);
            $('#kudobuzz_one_page_kudo').load(function() {
                var template_url = $("#iframe_url").val();
                var win = $("#kudobuzz_one_page_kudo")[0];
                var arr = [];
                arr["selected_wdg_id"] = $('input:radio[name=wg]:checked').val();
                arr["name_text_color"] = $('#name_text_color').val();
                arr["review_text_color"] = $('#review_text_color').val();
                arr["background_color"] = $('#background_color').val();
                win.contentWindow.postMessage(arr, template_url);
            });

        }


        function save_settings() {
            var id_wdg = $('input:radio[name=wg]:checked').val();
            var review_text_color = $('#review_text_color').val();
            var background_color = $('#background_color').val();
            var image_background_color = $('#image_background_color').val();
            var name_text_color = $('#name_text_color').val();
            var max_width = $('#max_width').val();
            var review_link_text = $('#review_link_text').val();

            var wdg_params = {
                'widget_type_id': id_wdg,
                'review_text_color': review_text_color,
                'background_color': background_color,
                'image_background_color': image_background_color,
                'name_text_color': name_text_color,
                'max_width': max_width,
                'review_link_text': review_link_text
            };

            $('#save-btn').hide();
            $('#frm2_feed').fadeIn();
            var uid = $('#uid').val();

            var values = {
                'wdg_params': wdg_params,
                'account_id':<?php echo $account_id; ?>,
                'user_id':<?php echo $user_id; ?>,
                'uid': '<?php echo $kd_uid; ?>'
            };

            $.post("<?php echo API_DOMAIN ?>widget/save_one_page_widget_settings", values, function(data) {
                $('#frm2_feed').html('<img src="../wp-content/plugins/kudobux-testimonial-widget/assets/img/ok.png" style="width: 14px; height: 14px; vertical-align: middle; margin-right: 5px;" /><span style="vertical-align: middle; color: green">Success</span>');
                $('#save-btn').show();
                if (data == 1) {
                }
            });
            return 1;
        }
    </script>

    <?php include_once 'footer.php'; ?>
    <?php
} else {
    ?>
    <script>
        jQuery(document).ready(function($) {
            var kd_uid = '<?php echo $kd_uid ?>';
            if (kd_uid == '') {
                var location = '<?php echo get_admin_url() ?>admin.php?page=Signup';
                window.location = location;
            }
        });
    </script>
    <?php
}