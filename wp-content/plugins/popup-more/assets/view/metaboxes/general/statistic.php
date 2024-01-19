<?php
$postId = 0;
if (!empty($_GET['post'])) {
    $postId = $_GET['post'];
}
$count = (int)get_option('YpmPopupCount'.$postId);
?>
<div class="ycf-bootstrap-wrapper">
    <div class="row form-group">
        <div class="col-md-4"><?php _e('Views')?></div>
        <div class="col-md-8">
            <div class='ypm-count-view-box'><?php echo esc_attr($count); ?></div>
            <?php if (!empty($count)): ?>
                <input type="button" data-id="<?php echo esc_attr($postId); ?>" class="button ypm-reset-count-btn" value="<?php _e('reset', YPM_POPUP_TEXT_DOMAIN)?>">
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="disable-statistic"><?php _e('Disable')?></label>
        </div>
        <div class="col-md-8">
            <label class="ypm-switch">
                <input type="checkbox" id="disable-statistic" name="ypm-popup-disable-statistic" <?php echo $popupTypeObj->getOptionValue('ypm-popup-disable-statistic'); ?>>
                <span class="ypm-slider ypm-round"></span>
            </label>
        </div>
    </div>
</div>