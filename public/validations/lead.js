$(document).ready(function () {
    $('#searchButton').click(function () {
        var formData = {
            'leadname': $('#name').val(),
            'leadcompanyname': $('#companyname').val(),
            'leadphone': $('#phone').val(),
            'leademail': $('#email').val(),
            'leadfdate': $('#fdate').val(),
            'leadtdate': $('#tdate').val(),
            'leadstatus': $('#leadstatus').val(),
            'leadsource': $('#lead_source').val()
        };
        $.ajax({
            type: 'POST',
            url: SITE_URL + 'leads/filter',
            data: formData,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (data) {
                var rows = '';
                $.each(data.leads, function (index, lead) {
                    rows += '<tr>' +
                        '<td>' + lead.id + '</td>' +
                        '<td>' + lead.name + '</td>' +
                        '<td>' + lead.company_name + '</td>' +
                        '<td>' + lead.phone + '</td>' +
                        '<td>' + lead.email + '</td>' +
                        '<td>' + lead.lead_status_name + '</td>' +
                        '<td>' + lead.lead_source_name + '</td>' +
                        '<td>' +
                        '<a href="' + SITE_URL + '/leads/add/' + btoa(lead.id) + '"><i class="bi bi-pencil-square mx-1"></i></a>&nbsp;&nbsp;' +
                        '<a href="' + SITE_URL + '/leads/view/' + btoa(lead.id) + '"><i class="text-black bi bi-eye"></i></a>&nbsp;&nbsp;' +
                        '<a href="' + SITE_URL + '/leads/delete/' + btoa(lead.id) + '"><i class="text-black bi bi-trash3"></i></a>' +
                        '</td>' +
                        '</tr>';
                });
                $('#table-content').html(rows);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    

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
