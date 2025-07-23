/* global $, token */

import Core from './core';

$(() => {
    Core.writeLn('Compiled js files.');

    const $el = $('body');

    $el.on('click', '#setting-colors-btn', (e) => {
        const $form = $('#setting-colors-form');
        e.preventDefault();
        $form.LoadingOverlay('show');
        $form.submit();
    });
});
