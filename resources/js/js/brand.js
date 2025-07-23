let message = '';
const storeMediaURL =$('#storeMediaURL').val();
const _token =$('#_token').val();

Dropzone.options.brandLogoDropzone = {
    url: storeMediaURL,
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif,.svg',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
        'X-CSRF-TOKEN': _token
    },
    params: {
        size: 10,
        width: 4096,
        height: 4096
    },
    success: function (file, response) {
        $('form').find('input[name="brand_logo"]').remove();
        $('form').append('<input type="hidden" name="brand_logo" value="' + response.name + '">');
    },
    removedfile: function (file) {
        file.previewElement.remove();
        if (file.status !== 'error') {
            $('form').find('input[name="brand_logo"]').remove();
            this.options.maxFiles = this.options.maxFiles + 1;
        }
    },
    init: function () {
        let file = JSON.parse($('#brandLogo').val());
        if (file) {
            this.options.addedfile.call(this, file);
            this.options.thumbnail.call(this, file, file.preview ? file.preview : file.preview_url);
            file.previewElement.classList.add('dz-complete');
            $('form').append('<input type="hidden" name="brand_logo" value="' + file.file_name + '">');
            this.options.maxFiles = this.options.maxFiles - 1;
        }
    },
    error: function(file, response, xhr) {
        if (typeof xhr !== 'undefined') {
            this.defaultOptions.error(file,xhr.statusText);// use xhr err (from server)
        } else {
            this.defaultOptions.error(file,response);// use default (from dropzone)
        }
        $('#logo_error').html(response);
    }
};

Dropzone.options.faviconDropzone = {
    url: storeMediaURL,
    maxFilesize: 2, // MB
    maxFiles: 1,
    acceptedFiles: '.jpeg,.jpg,.png,.gif,.svg,.ico',
    addRemoveLinks: true,
    headers: {
        'X-CSRF-TOKEN': _token
    },
    params: {
        size: 2
    },
    success: function (file, response) {
        $('form').find('input[name="brand_favicon"]').remove();
        $('form').append('<input type="hidden" name="brand_favicon" value="' + response.name + '">');
    },
    removedfile: function (file) {
        file.previewElement.remove();
        if (file.status !== 'error') {
            $('form').find('input[name="brand_favicon"]').remove();
            this.options.maxFiles = this.options.maxFiles + 1;
        }
    },
    init: function () {
        let iconFile = JSON.parse($('#brandIcon').val());
        if (iconFile) {
            this.options.addedfile.call(this, iconFile);
            this.options.thumbnail.call(this, iconFile, iconFile.preview ? iconFile.preview : iconFile.preview_url);
            iconFile.previewElement.classList.add('dz-complete');
            $('form').append('<input type="hidden" name="brand_favicon" value="' + iconFile.file_name + '">');
            this.options.maxFiles = this.options.maxFiles - 1;
        }
    },
    error: function(file, response, xhr) {
        if (typeof xhr !== 'undefined') {
            this.defaultOptions.error(file,xhr.statusText);// use xhr err (from server)
        } else {
            this.defaultOptions.error(file,response);// use default (from dropzone)
        }
        $('#logo_error').html(response);
    }
};

Dropzone.options.authLogoDropzone = {
    url: storeMediaURL,
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
        'X-CSRF-TOKEN': _token
    },
    params: {
        size: 10,
        width: 4096,
        height: 4096
    },
    success: function (file, response) {
        $('form').find('input[name="auth_logo"]').remove();
        $('form').append('<input type="hidden" name="auth_logo" value="' + response.name + '">');
    },
    removedfile: function (file) {
        file.previewElement.remove();
        if (file.status !== 'error') {
            $('form').find('input[name="auth_logo"]').remove();
            this.options.maxFiles = this.options.maxFiles + 1;
        }
    },
    init: function () {
        let file = JSON.parse($('#fileLogo').val());
        console.log(file);
        if (file) {
            this.options.addedfile.call(this, file);
            this.options.thumbnail.call(this, file, file.preview ? file.preview : file.preview_url);
            file.previewElement.classList.add('dz-complete');
            $('form').append('<input type="hidden" name="auth_logo" value="' + file.file_name + '">');
            this.options.maxFiles = this.options.maxFiles - 1;
        }
    },
    error: function(file, response, xhr) {
        if (typeof xhr !== 'undefined') {
            this.defaultOptions.error(file,xhr.statusText);// use xhr err (from server)
        } else {
            this.defaultOptions.error(file,response);// use default (from dropzone)
        }
        $('#logo_error').html(response);
    }
};
