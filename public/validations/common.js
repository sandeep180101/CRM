function exportModule(controller){
    window.location.href = controller;
}

function showError(error, element)
{
    if (element.is(":radio")) {
        error.insertAfter(element.parent().parent());
        error.removeClass('valid-feedback').addClass('invalid-feedback');
        element.removeClass('is-valid').addClass('is-invalid');
    } else { // This is the default behavior of the script
        if (element.attr('name') == "mobile" || element.attr('name') == "phone" || element.attr('type') == 'date' || element.attr('type') == 'email') {
            error.insertAfter(element);
            error.removeClass('valid-feedback').addClass('invalid-feedback');
            element.removeClass('is-valid').addClass('is-invalid');
        } else {
            error.insertAfter(element);
            error.removeClass('valid-feedback').addClass('invalid-feedback');
            element.removeClass('is-valid').addClass('is-invalid');
        }
    }
}

function commonStatusMessage(data, indexUrl) {
    if (data.status == 'success') { //0
        toastr.success(data.message);
        if (indexUrl) {
            window.location.href = indexUrl;
        }
        return true;
    } else if (data.status == 'error') { //1
        // toastr.error(data.message); 
        $.each(data.errors, function (i) {
            $('#' + i).parent().find('.invalid-feedback').remove();
            $.each(data.errors[i], function (key, val) {
                $('#' + i).addClass('is-invalid');
                $('#' + i).parent().append('<div class="invalid-feedback" for="' + i + '">' + val + '</div>');
            });
        });

        toastr.error(data.message)
    } else if (data.status == 'exist') { //2
        toastr.warning(data.message);
    } else if (data.status == 'warning') { //2
        toastr.warning(data.message);
    }
}


function commonConfirmDelete(deleteUrl, indexUrl) {
    swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: deleteUrl,
                type: "POST",
                data: {'_method': 'POST', "_token": "{{ csrf_token() }}"},
                dataType: 'json',
                processing: true,
                serverSide: true,
                success: function (data) {
                    swal.fire(
                            'Deleted!',
                            data.message,
                            'success'
                            );
                    window.location.href = indexUrl;
                },
                error: function (data) {
                    console.log(data.statusText);
                    swal.fire({
                        title: 'Opps...',
                        text: data.statusText,
                        type: 'error',
                        timer: '1500'
                    });
                }
            })
        }
    });
}

function commonConfirmation(deleteUrl, indexUrl) {
    swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, allow it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: deleteUrl,
                type: "POST",
                data: {'_method': 'POST'},
                dataType: 'json',
                processing: true,
                serverSide: true,
                success: function (data) {
                    swal.fire(
                            'Allow!',
                            data.message,
                            'success'
                            );
                    window.location.href = indexUrl;
                },
                error: function (data) {
                    console.log(data.statusText);
                    swal.fire({
                        title: 'Opps...',
                        text: data.statusText,
                        type: 'error',
                        timer: '1500'
                    });
                }
            })
        }
    });
}

function getCity(state_id,selectedCityId){
    if(state_id){
        $.ajax({
           type: 'POST',
           url: SITE_URL+'get-cities',
           data: {
               state_id:state_id
           },success: function(response){
              var obj = $.parseJSON(response);
              if(obj){
                    var cities = obj.results;
                   $("#city_id").empty();
                   $("#city_id").append('<option value="">Select</option>');
                   for(var i=0;i<cities.length;i++){
                       $("#city_id").append('<option value="'+cities[i]['id']+'">'+cities[i]['city_name']+'</option>');
                   }
                   if(selectedCityId!=''){
                      $('#city_id').val(selectedCityId).trigger('change');
                   }
              }else{
                   $("#city_id").append('<option value="">Data not found</option>');
              }
           }
        })
    }
}