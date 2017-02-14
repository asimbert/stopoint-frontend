/**
 * Theme Customizer custom scripts
 * Control of show/hide events on feature slider type selection
 */
(function($) {
    //Add More Theme Options Button
    $('.preview-notice').prepend('<span id="catchevolution_upgrade"><a target="_blank" class="button btn-upgrade" href="' + catchevolution_misc_links.upgrade_link + '">' + catchevolution_misc_links.upgrade_text + '</a></span>');
    jQuery('#customize-info .btn-upgrade, .misc_links').click(function(event) {
        event.stopPropagation();
    });
})(jQuery);