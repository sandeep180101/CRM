$(document).ready(function () {
    $("#state_form").validate({
        rules: {
            state_name: {
                required: true
            },
            country_id: {
                required: true
            },
            status: {
                required: true
            }
        },
        messages: {
            state_name: {
                required: "Please enter a state name."
            },
            country_id: {
                required: "Please select a country."
            },
            status: {
                required: "Please select a status."
            }
        },
        submitHandler: function (form) {
            $("#submitbutton").hide();
            $("#display_processing").css('display', 'block');
            var data = new FormData(form);
                $.ajax({
                    type: 'POST',
                    url: SITE_URL + 'states/save',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        var result = $.parseJSON(response);
                        if (result.status == 'error') {
                            $("#submitbutton").show();
                            $("#display_processing").css('display', 'none');
                        } else if (result.status == 'exist') {
                            $("#submitbutton").show();
                            $("#display_processing").css('display', 'none');
                        }
                        commonStatusMessage(result, SITE_URL + 'states');
                    },
                    error: function () {
                    }
                });
        
        }
    });
});
