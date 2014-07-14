<div  id="wdg-main-frm" style="width: 27%; float: left; padding-bottom: 20px;">

    <div class="request_kudos_container" style="border: 0px solid red; width: 100%; float: left">

        <p style="margin-top: 0px; margin-bottom: 10px; font-family: arial; font-size: 12px; color: #8b99a3; ">
            Widget Type     <span class="cust_tips"><span class="fui-alert dash_tooltip" data-toggle="tooltip" data-placement="bottom" data-tooltip-style="light" title="" data-original-title="Classic widget appears on the bottom of your page. Neptune widget appears on the side of your page"></span></span>

        </p>

        <div class="pull-left wg_list pull-left" style="width: 120px">                         
            <label class="radio">
                <input type="radio" name="wg" value="3" data-toggle="radio" <?php echo $widget_params->widget_id == 3 ? 'checked="checked"' : '' ?>>
                Classic 
            </label>
        </div>

        <div class="pull-left wg_list pull-left" style="width: 110px">                         
            <label class="radio">
                <input type="radio" name="wg" value="12" data-toggle="radio" <?php echo $widget_params->widget_id == 12 ? 'checked="checked"' : '' ?>>
                Neptune
            </label>
        </div>
        <div class="clearfix"></div>
    </div>
    <div style="clear: both"></div>

    <div class="wdg-title-div" style="<?php echo ($widget_type_id == "10" || $widget_type_id == "11") ? "display:none" : "" ?>">
        <p>Title:<span class="cust_tips"><span class="fui-alert dash_tooltip" data-toggle="tooltip" data-tooltip-style="light" data-placement="right" title="This text is displayed when widget is collapsed"></span></span></p>                            
        <input type="text" id="wg-title" class="small form-control input-sm" placeholder="Reviews" value="<?php echo isset($widget_params->title) ? $widget_params->title : $default_widget_title; ?>" />
        <input type="hidden" id="title_width">
    </div>
    <div class="pull-left title-font-div" style="border: 0px solid red; width: 150px; display:none !important">
        <p>Title Font:</p>
        <select name="fonts" id="title-font" class="mbn" onchange="">
            <option  value="Arial" <?php echo (isset($widget_params->title_font) && $widget_params->title_font == "Arial") ? 'selected="seleted"' : '' ?>>Arial</option>
            <option  value="Open Sans" <?php echo (isset($widget_params->title_font) && $widget_params->title_font == "Open Sans") ? 'selected="seleted"' : '' ?>>Open Sans</option>
            <option  value="Georgia" <?php echo (isset($widget_params->title_font) && $widget_params->title_font == "Georgia") ? 'selected="seleted"' : '' ?>>Georgia</option>
            <option  value="Serif" <?php echo (isset($widget_params->title_font) && $widget_params->title_font == "Serif") ? 'selected="seleted"' : '' ?>>Serif</option>
            <option  value="Times" <?php echo (isset($widget_params->title_font) && $widget_params->title_font == "Times") ? 'selected="seleted"' : '' ?>>Times</option>
            <option  value="Ubuntu" <?php echo (isset($widget_params->title_font) && $widget_params->title_font == "Ubuntu") ? 'selected="seleted"' : '' ?>>Ubuntu</option>
            <option  value="Josefin Slab" <?php echo (isset($widget_params->title_font) && $widget_params->title_font == "Josefin Slab") ? 'selected="selected"' : '' ?>>Josefin Slab</option>
            <option  value="Caudex" <?php echo (isset($widget_params->title_font) && $widget_params->title_font == "Caudex") ? 'selected="selected"' : '' ?>>Caudex</option>
                                <!--  <option  value="Quattrocento" <?php //echo (isset($widget_params->title_font) && $widget_params->title_font == "Quattrocento") ? 'selected="selected"' : ''                                                  ?>>Quattrocento</option>
            <option  value="Share Tech" <?php //echo (isset($widget_params->title_font) && $widget_params->title_font == "Share Tech") ? 'selected="selected"' : ''                                                  ?>>Share Tech</option>-->
        </select>
    </div>
    <div class="pull-left title-font-size-div" style="display:none !important; width: 130px">
        <p>Font Size:</p>
        <div class="controls input-prepend font-size" style="width:120px;">  
            <?php
            $wdg_title_font_size = "";

            if (!isset($widget_params->title_font_size)) {
                $wdg_title_font_size = $default_title_font_size;
            }
            ?>
            <select  name="title_font_size" class="mbn" id="title_font_size">                                            
                <option value="12" <?php echo $wdg_title_font_size == 12 ? "selected='selected'" : "" ?>>12px</option>
                <option value="13" <?php echo $wdg_title_font_size == 13 ? "selected='selected'" : "" ?>>13px</option>
                <option value="14" <?php echo $wdg_title_font_size == 14 ? "selected='selected'" : "" ?>>14px</option>
                <option value="15" <?php echo $wdg_title_font_size == 15 ? "selected='selected'" : "" ?>>15px</option>
                <option value="16" <?php echo $wdg_title_font_size == 16 ? "selected='selected'" : "" ?>>16px</option>
                <option value="17" <?php echo $wdg_title_font_size == 17 ? "selected='selected'" : "" ?>>17px</option>
                <option value="18" <?php echo $wdg_title_font_size == 18 ? "selected='selected'" : "" ?>>18px</option>
                <option value="19" <?php echo $wdg_title_font_size == 19 ? "selected='selected'" : "" ?>>19px</option>
                <option value="20" <?php echo $wdg_title_font_size == 20 ? "selected='selected'" : "" ?>>20px</option>
            </select>
            <!--<input type="text" class="small aln fm_input_small" placeholder="14" name="title_font_size" id="title_font_size" style="width: 45px !important;" value='<?php echo isset($widget_params->title_font_size) ? $widget_params->title_font_size : "14" ?>' />-->
            <!--<span class="add-on fm_append_small" style="height: 13px !important;">px</span>-->
        </div>
    </div>
    <div style="display:none !important">
        <div class="pull-left" style="width: 150px;">
            <p>Content Font:</p>
            <?php
            $content_font_family = "";

            if (!isset($widget_params->title_font)) {
                $content_font_family = $default_content_font_family;
            } else {
                $content_font_family = $widget_params->title_font;
            }
            ?>

            <select name="fonts" id="content-font" class="mbn" onchange="">
                <option  value="Arial" <?php echo $content_font_family == "Arial" ? 'selected="seleted"' : '' ?>>Arial</option>
                <option  value="Open Sans" <?php echo $content_font_family == "Open Sans" ? 'selected="seleted"' : '' ?>>Open Sans</option>
                <option  value="Georgia" <?php echo $content_font_family == "Georgia" ? 'selected="seleted"' : '' ?>>Georgia</option>
                <option  value="Serif" <?php echo $content_font_family == "Serif" ? 'selected="seleted"' : '' ?>>Serif</option>
                <option  value="Times New Roman" <?php echo $content_font_family == "Times New Roman" ? 'selected="seleted"' : '' ?>>Times New Roman</option>
                <option  value="Varela Round" <?php echo$content_font_family == "Varela Round" ? 'selected="seleted"' : '' ?>>Varela Round</option>
                <option  value="Karla" <?php echo $content_font_family == "Karla" ? 'selected="selected"' : '' ?>>Karla</option>

            </select>

        </div>

        <div class="pull-left" style="width:130px;margin-left: 0px; ">
            <?php
            $content_font_size = "";

            if (!isset($widget_params->content_font_size)) {
                $content_font_size = $default_content_font_size;
            } else {
                $content_font_size = $widget_params->content_font_size;
            }
            ?>
            <p>Font Size:</p>
            <div class="controls input-prepend font-size" style="width:120px;">  
                <select  name="content_font_size" class="mbn" id="content_font_size">                                            
                    <option value="12" <?php echo $content_font_size == 12 ? "selected='selected'" : "" ?>>12px</option>
                    <option value="13" <?php echo $content_font_size == 13 ? "selected='selected'" : "" ?>>13px</option>
                    <option value="14" <?php echo $content_font_size == 14 ? "selected='selected'" : "" ?>>14px</option>
                    <option value="15" <?php echo $content_font_size == 15 ? "selected='selected'" : "" ?>>15px</option>
                </select>
               <!--<input type="text" class="small aln fm_input_small" placeholder="14" name="title_font_size" id="title_font_size" style="width: 45px !important;" value='<?php echo isset($widget_params->title_font_size) ? $widget_params->title_font_size : "14" ?>' />-->
               <!--<span class="add-on fm_append_small" style="height: 13px !important;">px</span>-->
            </div>
        </div>
    </div>


    <div style="clear: both"></div>

    <div class="pull-left title-font-color-div" style="width: 50%; <?php echo ($widget_type_id == "10" || $widget_type_id == "11") ? "display:none" : "" ?>">
        <p>Title font color:</p>
        <div class="controls input-prepend ft_color" style="width: 100%;">
            <input type="text" id="title-font-color" class="small kwdgt_color form-control input-sm" placeholder="222222" name="title_font_color" style="width: 50% !important;" value="<?php echo isset($widget_params->title_font_colour) ? $widget_params->title_font_colour : $default_title_font_color ?>" />
        </div>
    </div>

    <div class="pull-left" id="bg_dev" style="width: 125px;display:none;">
        <p>Content font color:</p>
        <?php
        $content_font_color = "";
        if (!isset($widget_params->font_colour)) {
            $content_font_color = $default_content_font_color;
        } else {
            $content_font_color = $widget_params->font_colour;
        }
        ?>
        <div class="controls input-prepend" style="width: 90%;">
            <input type="text" id="content-font-color" class="small kwdgt_color" placeholder="222222" value="<?php echo $content_font_color ?>" name="background_color" id="bg_color" style="height: 14px !important;width: 62% !important;" <?php //echo isset($widget_type_id) && $widget_type_id == 1 ? "disabled" : ""                                                             ?>  />
        </div>
    </div>
    <!--                                    <div style="clear: both"></div>-->

    <div class="pull-left" id="bg_dev" style="width: 135px; float: right;display:none; ">
        <p>Background color:</p>

        <?php
        $wdg_background_color = "";
        if (!isset($widget_params->background_colour)) {
            $wdg_background_color = $default_bg_color;
        } else {
            $wdg_background_color = $widget_params->background_colour;
        }
        ?>
        <div class="controls input-prepend" style="width: 122px;">
            <input type="text" id="bg_color" class="small kwdgt_color" placeholder="222222" value="<?php echo $wdg_background_color ?>" name="background_color" id="bg_color" style="height: 14px !important;width: 62% !important;" <?php //echo isset($widget_type_id) && $widget_type_id == 1 ? "disabled" : ""                                                            ?>  />
        </div>
    </div>

    <div class="pull-left" id="bg_dev" style="width: 50%; <?php echo ($widget_type_id == "10" || $widget_type_id == "11") ? "display:none" : "" ?>">
        <p>Collapsed color:</p>

        <?php
        $wdg_top_border_color = "";
        if (!isset($widget_params->top_border_color)) {
            $wdg_top_border_color = $default_top_border_color;
        } else {
            $wdg_top_border_color = $widget_params->top_border_color;
        }
        ?>

        <div class="controls input-prepend" style="width: 100%;">
            <input type="text" id="hd_color" class="small kwdgt_color form-control input-sm" placeholder="222222" value="<?php echo $wdg_top_border_color ?>" name="header_color" style="width: 62% !important;" <?php //echo isset($widget_type_id) && $widget_type_id == 1 ? "disabled" : ""                                                            ?>  />
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="default-state-div" style="<?php echo ($widget_type_id == "10" || $widget_type_id == "11") ? "display:none" : "display: block !important" ?>">
        <p>Default State:<span class="cust_tips"><span class="fui-alert dash_tooltip" data-toggle="tooltip" data-tooltip-style="light" title="Set the initial state of widget when your page loads"></span></span></p>

        <?php
        if (!isset($widget_params->wdg_default_state)) {
            $st = "collapsed";
        } elseif (isset($widget_params->wdg_default_state) && empty($widget_params->wdg_default_state)) {
            $st = "collapsed";
        } elseif (isset($widget_params->wdg_default_state) && $widget_params->wdg_default_state == "collapsed") {
            $st = "collapsed";
        } elseif (isset($widget_params->wdg_default_state) && $widget_params->wdg_default_state == "expanded") {
            $st = "expanded";
        }
        ?>

        <div class="pull-left"  style="width: 135px;">
            <label class="radio">
                <input type="radio" name="default_state" value="collapsed" data-toggle="radio" <?php echo isset($st) && $st == 'collapsed' ? 'checked' : '' ?>>
                Collapsed
            </label>
        </div>

        <div class="pull-left">                         
            <label class="radio">
                <input type="radio" name="default_state" value="expanded" <?php echo isset($st) && $st == 'expanded' ? 'checked' : '' ?> data-toggle="radio">
                Expanded
            </label>
        </div>
    </div>
    <div style="clear: both"></div>
    <div class="alignment-div" style="<?php echo ($widget_type_id == "10" || $widget_type_id == "11") ? "display:none" : "display:block !important" ?>">
        <p>Alignment:<span class="cust_tips"><span class="fui-alert dash_tooltip" data-toggle="tooltip" data-tooltip-style="light" title="Set the alignment state, where widget is aligned on your page"></span></span></p>

        <?php
        if (!isset($widget_params->alignment)) {
            $al = "left";
        } elseif (isset($widget_params->alignment) && empty($widget_params->alignment)) {
            $al = "left";
        } elseif (isset($widget_params->alignment) && $widget_params->alignment == "left") {
            $al = "left";
        } elseif (isset($widget_params->alignment) && $widget_params->alignment == "right") {
            $al = "right";
        }
        ?>

        <div class="pull-left" style="width: 135px;"><label class="radio">
                <input type="radio" name="alignment" value="left" data-toggle="radio" <?php echo isset($al) && $al == 'left' ? 'checked' : '' ?>>
                Left
            </label>
        </div>               
        <div class="pull-left" >                         
            <label class="radio">
                <input type="radio" name="alignment" value="right" <?php echo isset($al) && $al == 'right' ? 'checked' : '' ?> data-toggle="radio">
                Right
            </label>
        </div> 
    </div>
    <div class="clearfix"></div> 

    <div class="wdg-title-div" style="<?php echo ($widget_type_id == "10" || $widget_type_id == "11") ? "display:none" : "" ?>; margin-bottom: 15px">
        <p>Call to action text:
            <span class="cust_tips">
                <span class="fui-alert dash_tooltip" data-toggle="tooltip" data-tooltip-style="light" title="Invite text message"></span>                        
            </span>
        </p>                            
        <input type="text" id="wg-invite" class="small form-control input-sm" placeholder="Please tell us what you think" value="<?php echo isset($widget_params->call_to_action_text) ? $widget_params->call_to_action_text : "Please tell us what you think" ?>" />
    </div>
    <div class="clearfix"></div> 

    <div  class="control-group" style="margin-bottom: 15px">
        <label class="control-label" for="widgetTransitionSpeed" style="width: 220px;">Widget Transition Speed<span class="cust_tips" style='top: 1px;left: 1px;'><span class="fui-alert dash_tooltip" data-toggle="tooltip" data-placement="right" data-tooltip-style="light" title="The speed of the widget text transitioning"></span></label>                              
        <div class="controls " style="width: 322px;">
            <?php $transition_speed = (isset($widget_params->widget_transition_speed) && !empty($widget_params->widget_transition_speed)) ? $widget_params->widget_transition_speed : "20000" ?>
            <select name='widget_transition_speed' id="widget_transition_speed">
                <option value='5000' <?php
                if ($transition_speed == "5000") {
                    echo "selected=\"selected\"";
                }
                ?> >5</option>
                <option value='10000' <?php
                if ($transition_speed == "10000") {
                    echo "selected=\"selected\"";
                }
                ?> >10</option>
                <option value='15000' <?php
                if ($transition_speed == "15000") {
                    echo "selected=\"selected\"";
                }
                ?> >15</option>
                <option value='20000' <?php
                if ($transition_speed == "20000") {
                    echo "selected=\"selected\"";
                }
                ?> >20</option>
                <option value='25000' <?php
                if ($transition_speed == "25000") {
                    echo "selected=\"selected\"";
                }
                ?> >25</option>
                <option value='30000' <?php
                if ($transition_speed == "30000") {
                    echo "selected=\"selected\"";
                }
                ?> >30</option>
            </select>
        </div>
    </div> 
    <div class="clearfix"></div> 
    <div id="widget_status" name="visibility" class="control-group visibility" style="margin-bottom: 15px">
        <label class="control-label pull-left" for="inputWidgetStatus">Widget Status<span class="cust_tips" style='top: 1px;left: 1px;'><span class="fui-alert dash_tooltip" data-toggle="tooltip" data-placement="bottom" data-tooltip-style="light" title="Display or hide widget on your website"></span></span></label>
        <input type="checkbox" <?php echo $widget_params->show_widget == '1' ? "checked" : "" ?> data-toggle="switch" id="widget_status_input"  value="<?php echo $widget_params->show_widget ?>" />
    </div>
    <div class="clearfix"></div> 
    <?php if (isset($_SESSION['user_details']['plan']) && ($_SESSION['user_details']['plan'] >= 1)) { ?>
        <div class="accordion hide" id="form_language">  
            <div class="accordion-group">  
                <div class="accordion-heading">  
                    <a class="accordion-toggle col" data-toggle="collapse" data-parent="#form_language" href="#form_language_text" id="accord_cust_wf" onclick="icon_change(this.id)" style="color: #e87e04;text-transform: initial;margin: 0px 0 2px 0px;font-size: 15px;">  
                        Advanced customization<span class="fui-cross-inverted hide" id="accord_cross" style="font-size:13px !important;"></span><span class="fui-plus-inverted " id="accord_plus"></span>
                    </a>  
                </div>  
                <div id="form_language_text" class="accordion-body collapse" style="height: 0px; ">  
                    <div class="accordion-inner">  
                        <div id="pro_rev_ad_cust_left" class="pull-left" style="width: 100%;">


                            <div class="wdg-review-text-div" >
                                <p>Write Review Button Text:</p>                               
                                <input type="text" id="wg-review-btn-text" class="small" placeholder="" value="<?php echo!empty($widget_params->review_button_text) ? $widget_params->review_button_text : $wdg_default_review_button_text; ?>" />
                            </div>
                            <div class="wdg-review-text-div" >
                                <p>Review For:<br/>Example: John's [review for] <?php echo $account_name; ?></p>                               
                                <input type="text" id="wg-review-for-text" class="small" placeholder="" value="<?php echo!empty($widget_params->review_for_text) ? $widget_params->review_for_text : $wdg_default_review_for_text; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
    <div class="clearfix"></div> 
    <?php
    $wdg_width = "";
    if (!isset($widget_params->width)) {
        $wdg_width = $default_width;
    } else {
        $wdg_width = $widget_params->width;
    }

    $wdg_height = "";
    if (!isset($widget_params->height)) {
        $wdg_height = $default_height;
    } else {
        $wdg_height = $widget_params->height;
    }

    $hide_dim = "";

    $widget_type_id_arr = array("1", "3", "4", "6", "2", "12");
    if (in_array($widget_type_id, $widget_type_id_arr)) {
        $hide_dim = "display:none";
    } else {
        $hide_dim = "display:block !important";
    }
    ?>

    <div class="pull-left" style="width: 120px; <?php echo $hide_dim ?>">
        <p>Width:</p>
        <div class="controls input-prepend" style="width: 226px;">
            <!--<input type="text" class="small aln fm_input_small" placeholder="400" name="widget_width" id="widget_width" style="width: 45px !important;" <?php echo ($widget_type_id == 1) || ($widget_type_id == 3) || ($widget_type_id == 4) || ($widget_type_id == 6) || ($widget_type_id == 2) ? "disabled" : "" ?> value='<?php echo ($widget_type_id == 5) ? $width : "" ?>' />-->
            <input type="text" class="small aln fm_input_small" placeholder="400" name="widget_width" id="widget_width" style="width: 45px !important;" value='<?php echo $wdg_width ?>' />
            <span class="add-on fm_append_small" style="height: 13px !important;">px</span>
        </div>
    </div>
    <div class="pull-left" style="width: 125px;margin-left: 16px; <?php echo $hide_dim ?>">
        <p>Height:</p>
        <div class="controls input-prepend" style="width: 226px;">
            <input type="text" class="small aln fm_input_small" placeholder="150" name="widget_height" id="widget_height" style="width: 45px !important;" value='<?php echo $wdg_height ?>'/>
            <span class="add-on fm_append_small" style="height: 13px !important;">px</span>
        </div>
    </div>
    <div style="clear: both"></div>

    <div style="border: 0px solid red; overflow: hidden">
        <a class="btn social-btn btn-primary btn-small scroll"  href="javascript:;" onclick="save_wdg_config()" id="wdg-save-btn" style="width: 130px !important;">Save changes</a>                                    
        <span style="margin-left: 5px;" class="ok-span hide">
            <img src="<?php echo plugins_url() ?>/kudobux-testimonial-widget/assets/img/ok.png" />
        </span>
    </div>
</div>
<div  id="wdg-save-feedback" style="font-size: 15px; color: blue; display:none; text-align: center; padding-top: 200px;height: 300px">
    <div id="wdg-saving">
        <img src="/public/images/ajax-imgs/spinner-circle.gif" style="width: 14px; height: 14px;" /> Saving widget settings...
    </div>
    <div id="wdg-saved" style="display:none">
        <img src="/public/images/ajax-imgs/ok.png" style="width: 14px; height: 14px" /> <span style=" color: green">Widget Settings are saved!</span>
        <div style="clear:both; margin-bottom: 20px"></div>
        <a class="btn social-btn btn-fb btn-small"  href="javascript:void(0)" id="wdg-edit-btn" style="width: 90px">Edit Again</a>
        <!--<a class="btn social-btn btn-fb btn-small" href="javascript:void(0)" style="margin: 0 5px; margin: 0 5px; border: 0px; background: none !important; color: #000; width: 15px; box-shadow: none; font-size: 12px; height: 41px">Or</a>-->
        <a class="btn social-btn btn-fb btn-small scroll"   href="#get_widget_code" id="wdg-save-btn" style="width: 90px; background: green !important;">Next &rsaquo;</a>
    </div>
