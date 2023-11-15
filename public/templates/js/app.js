function msgbox_error(message) {
    $.growl({
        icon: 'fa fa-comments',
        title: ' ',
        message: message,
        url: ''
    }, {
        element: 'body',
        type: 'danger',
        allow_dismiss: true,
        placement: {
            from: 'top',
            align: 'center'
        },
        offset: {
            x: 30,
            y: 30
        },
        spacing: 10,
        z_index: 999999,
        delay: 2500,
        timer: 1000,
        url_target: '_blank',
        mouse_over: false,
        icon_type: 'class',
        template: '<div data-growl="container" class="alert background-danger" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Close</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<span data-growl="title"></span>' +
            '<span data-growl="message"></span>' +
            '<a href="#" data-growl="url"></a>' +
            '</div>'
    });
};

function msgbox_success(message) {
    $.growl({
        icon: 'fa fa-bell-o',
        title: ' ',
        message: message,
        url: ''
    }, {
        element: 'body',
        type: 'success',
        allow_dismiss: true,
        placement: {
            from: 'top',
            align: 'center'
        },
        offset: {
            x: 30,
            y: 30
        },
        spacing: 10,
        z_index: 999999,
        delay: 2500,
        timer: 1000,
        url_target: '_blank',
        mouse_over: false,
        icon_type: 'class',
        template: '<div data-growl="container" class="alert background-success" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Close</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<span data-growl="title"></span>' +
            '<span data-growl="message"></span>' +
            '<a href="#" data-growl="url"></a>' +
            '</div>'
    });
};

function redirect_url(url) {
    window.location.href = url;
}