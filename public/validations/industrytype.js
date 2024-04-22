jQuery(document).ready(function () {
    $("#industry_form").validate({
        rules: {
            industry_name: {
                required: true,
            },
            status: {
                required: true,
            },
        },
        messages: {
            industry_name: {
                required: "Please enter an industry name.",
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
                url: SITE_URL +'industry-type/save',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response); 
                    var result = $.parseJSON(response);
                    if(result.status == 'error') {
                        $("#submitbutton").show();
                        $("#display_processing").css('display', 'none');
                    }
                    else if(result.status == 'exist') {
                        $("#submitbutton").show();
                        $("#display_processing").css('display', 'none');
                    }
                    commonStatusMessage(result, SITE_URL + 'industry-type/add');

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
