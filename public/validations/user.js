$(document).ready(function () {

    $("#user_form").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email:true,
            },
            phone: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter a name.",
            },
            email: {
                required: "Please enter an email.",
                email: "Please enter valid email",
            },
            phone: {
                required: "Please enter a phone number.",
            },
        },

        submitHandler: function (form) {
            $("#submitbutton").hide();
            $("#display_processing").css('display', 'block');
            var data = new FormData(form);

            $.ajax({
                type: 'POST',
                url: SITE_URL + 'user/save',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    var result = $.parseJSON(response);
                    if (result.status == 'error' || result.status == 'exist') {
                        $("#submitbutton").show();
                        $("#display_processing").css('display', 'none');
                    }
                    commonStatusMessage(result, SITE_URL + 'user');

                },
                error: function () {
                }
            });
        },
    });
});