$(document).ready(function() {
    $('button[data-loading-text]')
        .on('click', function () {
            var btn = $(this);
            btn.button('loading');
            setTimeout(function () {
                btn.button('reset')
            }, 60000)
        });
});

