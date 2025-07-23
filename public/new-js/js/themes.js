/* global $, token */

$(() => {
    $(document).on('change', '#setting_theme_mode', function (event) {
        $('#theme-row').LoadingOverlay('show');
        $('#frm_update_theme_mode').submit();
        $('#theme-row').LoadingOverlay('hide');
    });
});
