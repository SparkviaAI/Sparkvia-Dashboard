/* global $, token */

$(() => {
    let ENDPOINT = $('#historyURL').val();
    let page = 1;

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
            page++;
            let lastPage = $('#lastPage').val();
            if (page <= lastPage) {
                infinteLoadMore(page);
            }
        }
    });

    function infinteLoadMore(page) {
        $.ajax({
            url: ENDPOINT + '?page=' + page,
            datatype: 'html',
            type: 'get',
            beforeSend: function () {
                $('.auto-load').show();
            }
        })
            .done(function (response) {
                $('.auto-load').hide();
                $('#data-wrapper').append(response.html);
            });
    }
});
