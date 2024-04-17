$(document).ready(function () {

    $("#city_form").validate({
        rules: {
            city_name: {
                required: true,
            },
            state_id: {
                required: true,
            },
            country_id: {
                required: true,
            },
            status: {
                required: true,
            },
        },
        messages: {
            city_name: {
                required: "Please enter a city name.",
            },
            state_id: {
                required: "Please select state.",
            },
            country_id: {
                required: "Please select country.",
            },
            status: {
                required: "Please select status.",
            },
        },
        
        submitHandler: function (form) {
            $("#submitbutton").hide();
            $("#display_processing").css('display', 'block');
            var data = new FormData(form);
            console.log(data);  
            $.ajax({
                type: 'POST',
                url: SITE_URL +'cities/save',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    var result = $.parseJSON(response);
                    if(result.status == 'error') {
                        $("#submitbutton").show();
                        $("#display_processing").css('display', 'none');
                    }
                    else if(result.status == 'exist') {
                        $("#submitbutton").show();
                        $("#display_processing").css('display', 'none');
                    }
                    commonStatusMessage(result, SITE_URL + 'cities');

                },
                error: function() {
               }
            });
        },        
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        }
    });
});
