/* global $, toastError, toastSuccess, token */

import Core from './core';

$(() => {
    const header = $('#header');
    const $el = $('body');

    token = $('meta[name="csrf-token"]').attr('content');

    toastError = function (message) {
        Core.toastError(message);
    };

    toastSuccess = function (message) {
        Core.toastSuccess(message);
    };

    /* Switchable Details */
    $el.on('click', '.toggle-details-mode', (e) => {
        let target = $(e.target).data('target');

        $(target).find('.details-view-mode, .details-edit-mode').toggle();
    });

    function initializePlugins() {
        // INITIALIZATION OF HEADER
        // =======================================================
        new HSHeader('#header').init();


        // INITIALIZATION OF MEGA MENU
        // =======================================================
        new HSMegaMenu('.js-mega-menu', {
            desktop: {
                position: 'left'
            }
        });


        // INITIALIZATION OF SHOW ANIMATIONS
        // =======================================================
        new HSShowAnimation('.js-animation-link');


        // INITIALIZATION OF BOOTSTRAP VALIDATION
        // =======================================================
        HSBsValidation.init('.js-validate', {
        });


        // INITIALIZATION OF GO TO
        // =======================================================
        new HSGoTo('.js-go-to');


        // INITIALIZATION OF AOS
        // =======================================================
        AOS.init({
            duration: 650,
            once: true
        });

        // INITIALIZATION OF TOGGLE SWITCH
        // =======================================================
        new HSToggleSwitch('.js-toggle-switch');

        // INITIALIZATION OF SWIPER
        // =======================================================
        var swiper = new Swiper('.js-swiper-hero-clients', {
            slidesPerView: 2,
            breakpoints: {
                380: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 15,
                },
            },
        });


        // INITIALIZATION OF NAV SCROLLER
        // =======================================================
        new HsNavScroller('.js-nav-scroller');

        // INITIALIZATION OF BOOTSTRAP DROPDOWN
        // =======================================================
        HSBsDropdown.init();
    }

    if (header.length) {
        initializePlugins();
    }

    $.extend({
        confirm: function (title, message, yesText, yesCallback) {
            $('<div></div>').appendTo('body')
                .html('<div><h6>' + message + '</h6></div>')
                .dialog({
                    buttons: [
                        {
                            text: yesText,
                            click: function () {
                                yesCallback();
                                $(this).remove();
                            }
                        },
                        {
                            text: 'Exit',
                            click: function () {
                                $(this).remove();
                            }
                        }
                    ],
                    close: function (event, ui) {
                        $(this).remove();
                    },
                    resizable: false,
                    title: title,
                    modal: true
                });
        }
    });
});
