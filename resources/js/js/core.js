/* global _, global */
// core module

const Core = {
    writeLn: function (text) {
        console.log(text);
    },
    toastError: function (message) {
        $.toast({
            heading: global.error,
            text: message ? message : global.general_error,
            showHideTransition: 'fade',
            icon: 'error',
            position: 'top-right'
        });
    },
    toastSuccess: function (message) {
        $.toast({
            heading: global.success,
            text: message ? message : global.create_success,
            showHideTransition: 'fade',
            icon: 'success',
            position: 'top-right'
        });
    },
};

export {
    Core as default
};
