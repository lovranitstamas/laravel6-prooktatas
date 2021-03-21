//4.óra
$(document).ready(function () {
    $('#not-own-posts').click(function () {

        if (confirm("biztos a törlésben")) {
            let token = $(this).data('token');
            let url = $(this).data('url');
            let customerId = $(this).data('id');
            if (url !== undefined) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {'_token': token},
                    dataType: 'json',
                    success: function (data) {
                        if (data.message) {
                            $('#customer-' + customerId).remove();
                            alert(data.message);
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                    //  dataType: 'mycustomtype'
                });
            }
        }
    });

    $('#own-posts').click(function () {

        if (confirm("biztos a törlésben")) {
            let token = $(this).data('token');
            let url = $(this).data('url');
            let target = $(this).data('target');
            if (url !== undefined) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {'_token': token},
                    dataType: 'json',
                    success: function (data) {
                        if (data.message) {
                            $(target).remove();
                            alert(data.message);
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                    //  dataType: 'mycustomtype'
                });
            }
        }
    });
});

$(document).ready(function () {
    $('.tags').select2({
        locale: "hu"
    })
});
