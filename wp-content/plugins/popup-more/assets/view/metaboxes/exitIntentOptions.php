<div class="row ypm-margin-bottom-15">
    <div class="col-xs-3">
        <label class="control-label" for="ypm-popup-exit-enable"><?php _e('Enable', YPM_POPUP_TEXT_DOMAIN);?>:</label>
    </div>
    <div class="col-xs-4">
        <label class="ypm-switch">
            <input type="checkbox" id="ypm-popup-exit-enable" name="ypm-popup-exit-enable" <?php echo $popupTypeObj->getOptionValue('ypm-popup-exit-enable');?>>
            <span class="ypm-slider ypm-round"></span>
        </label>
        <br>
    </div>
</div>
<div class="row ypm-margin-bottom-15">
    <div class="col-xs-3">
        <label class="control-label" for="textinput"><?php _e('Mode', YPM_POPUP_TEXT_DOMAIN);?>:</label>
    </div>
    <div class="col-xs-4">
        <?php echo YpmFunctions::createSelectBox($exitModeData, $popupTypeObj->getOptionValue('ypm-popup-exit-mode'), array('name' => 'ypm-popup-exit-mode', 'class' => 'js-basic-select form-control')); ?><br>
    </div>
</div>
<div class="row">
    <div class="col-xs-3">
        <label class="control-label" for="textinput"><?php _e('Show Popup per day(s)', YPM_POPUP_TEXT_DOMAIN);?>:</label>
    </div>
    <div class="col-xs-4">
        <input type="number" class="form-control" name="ypm-exit-per-day" value="<?php echo $popupTypeObj->getOptionValue('ypm-exit-per-day')?>"><br>
    </div>
</div>
<div class="row ypm-margin-bottom-15">
    <div class="col-xs-3">
        <label class="control-label" for="ypm-exit-page-lavel"><?php _e('Page level cookie saving', YPM_POPUP_TEXT_DOMAIN);?>:</label>
    </div>
    <div class="col-xs-4">
        <label class="ypm-switch">
            <input type="checkbox" id="ypm-exit-page-lavel" name="ypm-exit-page-lavel" <?php echo $popupTypeObj->getOptionValue('ypm-exit-page-lavel')?>>
            <span class="ypm-slider ypm-round"></span>
        </label>
    </div>
</div>
<div class="row ypm-margin-bottom-15">
    <div class="col-xs-3">
        <label class="control-label" for="ypm-exit-leave-top"><?php _e('Detect exit only from top bar', YPM_POPUP_TEXT_DOMAIN);?>:</label>
    </div>
    <div class="col-xs-4">
        <label class="ypm-switch">
            <input type="checkbox" id="ypm-exit-leave-top" name="ypm-exit-leave-top" <?php echo $popupTypeObj->getOptionValue('ypm-exit-leave-top')?>>
            <span class="ypm-slider ypm-round"></span>
        </label>
    </div>
</div>