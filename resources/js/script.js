$(document).ready(function () {
    $('.del-button').click(function () {
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
                onerror: function (err) {
                    alert(err.error);
                }
                //  dataType: 'mycustomtype'
            });
        }
    });
});
