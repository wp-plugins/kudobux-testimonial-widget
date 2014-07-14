<?php
ini_set('display_errors', 1);
$kd_uid = get_option('kudobuzz_uid');

if (isset($kd_uid) && $kd_uid != NULL) {

    include_once 'data.php';

    //Get widget settings
    $url = API_DOMAIN . 'api/widget/tab?uid=' . $kd_uid;
    $widget_settings = json_decode(file_get_contents($url));
    $widget_params = $widget_settings->result;

    $widget_type_id = $widget_settings->result->widget_id;
    $show_widget = $widget_settings->result->show_widget;
    $call_to_action_text = $widget_settings->result->call_to_action_text;
    $title = $widget_settings->result->title;
    $write_review_text = $widget_settings->result->write_review_text;
    $title_font_color = $widget_settings->result->title_font_color;
    $top_border_color = $widget_settings->result->top_border_color;
    $font_color = $widget_settings->result->font_color;
    $transition_speed = $widget_settings->result->transition_speed;
    $review_for_text = $widget_settings->result->review_for_text;
    $alignment = $widget_settings->result->alignment;
    $default_state = $widget_settings->result->default_state;

    $review_tab_active = "kdb-active";
    $full_page_active = "";
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

                    <div style="width: 82%; margin-left: 180px; padding-top: 20px; overflow: hidden">
                        <!--<h4>Customize Themes</h4>-->

                        <?php include_once 'customization_form.php' ?>
                    </div>


                    <div style="float: right; width: 70%; min-height: 502px; border: 1px solid #CCC; position: relative">
                        <iframe id="wg-preview-iframe-2" class="wg-preview-iframe" frameborder="0" src="<?php echo API_DOMAIN ?>preview-template/<?php echo $widget_type_id ?>?uid=<?php echo $kd_uid ?>" style="width: 100%; height: 500px !important; overflow-y: hidden;" scrolling="no"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include_once 'footer.php'; ?>
    <?php
} else {
    ?>
    <script>
        jQuery(document).ready(function($) {
                    var kd_uid = '<?php echo $kd_uid ?>';
                    if (kd_uid === '') {
                        var location = '<?php echo get_admin_url() ?>admin.php?page=Signup';
                        window.location = location;
                    }
                });
    </script>
    <?php
}