<div style="height: 34px;" class="hide">
    <div style="width: 847px; overflow: hidden; " class="next-to-code hide">   
        <a href="javascript:void(0);" class="btn btn-success pull-right" id="next-btn">Next</a>
    </div>
</div>

<div style="margin-bottom: 20px;"></div>
<center><p>Select one of the following widget types to install on your website. <a href = "http://kudobuzz.com/demo target = "_blank">  Check Live Demos Here </a></p></center>
<br />

<div class="btn-group" data-toggle="buttons-radio">
    <div class="widget-type pull-left <?php echo isset($GLOBALS['widget_type_id']) && $GLOBALS['widget_type_id'] == 12 ? 'active-wdg-id':''?>">
        <p> Neptune Review Tab </p>
        <div class="img-div">
            <img src="../wp-content/plugins/kudobuzz/assets/img/templates/neptune.jpg" />
        </div>
        <div class="button-div" >
            <button type="button" name="att" value="12" id="btn-12" class="btn btn-default btn-sm choose-wdg-type">Choose</button>
            <br><span id="fd-choose"></span>
        </div>
    </div>

    <div class="widget-type pull-left <?php echo isset($GLOBALS['widget_type_id']) && $GLOBALS['widget_type_id'] == 3 ? 'active-wdg-id':''?>">
         <p> Classic Review Tab </p>
        <div class="img-div">
            <img src="../wp-content/plugins/kudobuzz/assets/img/templates/classic.jpg" style="margin-top: 45px;" />
        </div>
        <div class ="button-div" >
            <button type="button" name="att" value="3" id="btn-3" class="btn btn-default btn-sm choose-wdg-type">Choose</button>
            <br><span id="fd-choose"></span>
        </div>
    </div>

    <div class="widget-type pull-left <?php echo isset($GLOBALS['slider_widget_added']) && $GLOBALS['slider_widget_added'] == 9 ? 'active-wdg-id':''?>">
        <p> Embedable Slider Widget </p>
        <div class="img-div">
            <img src="../wp-content/plugins/kudobuzz/assets/img/templates/slider.jpg" style="margin-top: 70px;" />
        </div>
        <div class="button-div">
            <button type="button" name="att" value="9" id="btn-9" class="btn btn-default btn-sm choose-wdg-type">Choose</button>
            <br><span id="fd-choose"></span>
        </div>
    </div>

    <div class="widget-type pull-left <?php echo isset($GLOBALS['full_page_widget_added']) && $GLOBALS['full_page_widget_added'] == 8 ? 'active-wdg-id':''?>">
         <p> Full Page Widget </p>
        <div class="img-div">
            <img src="../wp-content/plugins/kudobuzz/assets/img/templates/full-page.jpg"  style="margin-top:50px;" />
        </div>
        <div class="button-div">
            <button type="button" name="att" value="8" id="btn-8" class="btn btn-default btn-sm choose-wdg-type">Choose</button>
            <br><span id="fd-choose"></span>
        </div>
    </div>
</div>