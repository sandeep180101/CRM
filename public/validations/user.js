$(document).ready(function () {

    $("#lead_form").validate({
        rules: {
            date: {
                required: true,
            },
            name: {
                required: true,
            },
            company_name: {
                required: true,
            },
            phone: {
                required: true,
            },
            product_details: {
                required: true,
            },
            approximate_amount: {
                required: true,
            },
            lead_status: {
                required: true,
            },
            lead_source: {
                required: true,
            }
        },
        messages: {
            date: {
                required: "Please enter a date.",
            },
            name: {
                required: "Please enter a name.",
            },
            company_name: {
                required: "Please enter a company name.",
            },
            phone: {
                required: "Please enter a phone number.",
            },
            product_details: {
                required: "Please enter a product.",
            },
            approximate_amount: {
                required: "Please enter an approximate amount.",
            },
            lead_status: {
                required: "Please select a lead status.",
            },
            lead_source: {
                required: "Please select a lead source.",
            }
        },

        submitHandler: function (form) {
            $("#submitbutton").hide();
            $("#display_processing").css('display', 'block');
            var data = new FormData(form);

            $.ajax({
                type: 'POST',
                url: SITE_URL + 'leads/save',
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
                    commonStatusMessage(result, SITE_URL + 'leads/view/' + result.encryptid);

                },
                error: function () {
                }
            });
        },
    });
});