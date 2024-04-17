var filter  = new Object();
var start = 0;
var limit = 10;
var element = $('.card-body');

$(document).ready(function () {
     
    filter.start       = start;
    filter.limit       = limit;

    element.on('change','#search_limits',function(){
        start = 0;
        limit = $(this).val();
        filter.start = start; 
        filter.limit = limit; 
        filtering(filter);                 
    });

    element.on('click','#pagination ul li.filter',function(){
        filter.start = $(this).attr('data-start');
        filter.limit = $(this).attr('data-limit');
        filtering(filter);      
    });
    
    $("#kt_modal_upload_form").validate({
        onkeydown: false,
        onkeyup: false,
        onfocusin: false,
        onfocusout: false,
        errorElement: "div",
        rules: {
            contact_name: {
                required: true,
            },
            contact_email: {
                required: true,
            },

            contact_phone: {
                required: true,
            },

            contact_address: {
                required: true,
            },


        },
        messages: {
            contact_name: {
                required: "Please enter a Contact name",
            },
            contact_email: {
                required: "Please enter a Contact email",
            },
            contact_phone: {
                required: "Please enter a Contact phone",
            },
            contact_address: {
                required: "Please enter a Contact address",
            },
        },
        
        submitHandler: function (form) {
            $("#submitbutton").hide();
            $("#display_processing").css('display', 'block');
            var data = new FormData(form);
            console.log(data);  
            $.ajax({
                type: 'POST',
                url: SITE_URL +'contacts/save',
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
                    commonStatusMessage(result, SITE_URL + 'contacts');

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
