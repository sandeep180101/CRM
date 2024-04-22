jQuery(document).ready(function () {
    $("#lead_for_form").validate({
        rules: {
            lead_for_name: {
                required: true,
            },
            status: {
                required: true,
            },
        },
        messages: {
            lead_for_name: {
                required: "Please enter a lead for name.",
            },
            status: {
                required: "Please select a status.",
            },
        },
        
        submitHandler: function (form) {
            $("#submitbutton").hide();
            $("#display_processing").css('display', 'block');
            var data = new FormData(form);
            console.log(data);  
            $.ajax({
                type: 'POST',
                url: SITE_URL +'lead_for/save',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    var result = $.parseJSON(response);
                    if(result.source == 'error') {
                        $("#submitbutton").show();
                        $("#display_processing").css('display', 'none');
                    }
                    else if(result.source == 'exist') {
                        $("#submitbutton").show();
                        $("#display_processing").css('display', 'none');
                    }
                    commonStatusMessage(result, SITE_URL + 'lead_for/add');

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
