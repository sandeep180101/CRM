var filter = new Object();
var start = 0;
var limit = 10;
var element = $('.card-body');

$(document).ready(function () {

    filter.start = start;
    filter.limit = limit;

    element.on('change', '#search_limits', function () {
        start = 0;
        limit = $(this).val();
        filter.start = start;
        filter.limit = limit;
        filtering(filter);
    });

    element.on('click', '#pagination ul li.filter', function () {
        filter.start = $(this).attr('data-start');
        filter.limit = $(this).attr('data-limit');
        filtering(filter);
    });

    $("#party_form").validate({
        rules: {
            name: {
                required: true,
            },
            code: {
                required: true,
            },
            status: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter a name.",
            },
            code: {
                required: "Please enter your code.",
            },
            status: {
                required: "Please select status.",
            },
        },

        submitHandler: function (form) {
            $("#submitbutton").hide();
            $("#display_processing").css('display', 'block');
            var data = new FormData(form);

            $.ajax({
                type: 'POST',
                url: SITE_URL + 'party/save',
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
                    commonStatusMessage(result, SITE_URL + 'party/view/' + result.encryptid);

                },
                error: function () {
                }
            });
        },
    });
    
    $("#party_search").on("click", function () {
        filter.name = $('#name').val();
        filter.code = $('#code').val();
        filter.party_type = $('#party_type').val();
        filter.phone = $('#phone').val();
        filter.email = $('#email').val();
        filter.status = $('#status').val();
        filter.start = start;
        filter.limit = limit;
        filtering(filter);
        console.log(filter);
    });

    function filtering(filter) {
        let start = filter.start;
        const date = new Date();
        $("#party_search").hide();
        $("#search_display_processing").css('display', 'block');
        $.ajax({
            type: 'POST',
            url: SITE_URL + 'party/filter',
            data: filter,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                let obj;
                if (typeof response === 'object') {
                    obj = response;
                } else {
                    obj = $.parseJSON(response);
                }
                if (obj.status == 'success') {
                    $("#party_search").show();
                    $("#search_display_processing").css('display', 'none');
                    if (obj.totalCount > 0) {
                        let html = '';
                        let user = obj.parties;
                        console.log(user);
                        for (let i = 0; i < user.length; i++) {
                            html += '<tr id="follow_up_row' + i + '">';
                            html += '<td>' + user[i]['name'] + '</td>';
                            html += '<td>' + user[i]['code'] + '</td>';
                            html += '<td>' + user[i]['party_type'] + '</td>';
                            html += '<td>' + user[i]['phone'] + '</td>';
                            html += '<td>' + user[i]['email'] + '</td>';
                            html += '<td>' + user[i]['status'] + '</td>';
                            html += '<td>'
                            + '<a href="' + SITE_URL + 'party/add/' + user[i]['encrypted_id'] + '"><i class="bi bi-pencil-square mx-1"></i></a>&nbsp;&nbsp;'
                            + '<a href="' + SITE_URL + 'party/view/' + user[i]['encrypted_id'] + '"><i class="text-black bi bi-eye"></i></a>&nbsp;&nbsp;'                            
                                + '</td>';
                            html += '</tr>';
                        }
                        $('#table-content').html(html);
                        $('.pagination').show();
                        $('#showing').show();
                        $('#showing').html(obj.message);
                        var remaining = obj.totalCount % filter.limit;
                        var total_page = (remaining > 0) ? parseInt(obj.totalCount / filter.limit) + 1 : parseInt(obj.totalCount / filter.limit);
                        $('#pagination').find('ul li.strt').attr('data-start', 0);
                        $('#pagination').find('ul li.prev').attr('data-start', (parseInt(filter.start) - parseInt(filter.limit)) < 0 ? 0 : (parseInt(filter.start) - parseInt(filter.limit)));
                        $('#pagination').find('ul li a.disp').text(parseInt(parseInt(filter.start) / parseInt(filter.limit)) + 1);
                        $('#pagination').find('ul li.filter').attr('data-limit', limit);
                        if (total_page != parseInt($('#pagination').find('ul li a.disp').text())) {
                            if (obj.limit == 10000000) {
                                $('#pagination').find('ul li.next').attr('data-start', 0);
                            } else {
                                $('#pagination').find('ul li.next').attr('data-start', (parseInt(filter.start) + parseInt(filter.limit)));
                            }
                        } else {
                            $('#pagination').find('ul li.next').attr('data-start', (parseInt((total_page - 1) * filter.limit)));
                        }
                        if (obj.limit == 10000000) {
                            $('#pagination').find('ul li.last').attr('data-start', 0);
                        } else {
                            $('#pagination').find('ul li.last').attr('data-start', (parseInt((total_page - 1) * filter.limit)));
                        }
                    } else {
                        $("#party_search").show();
                        $("#search_display_processing").css('display', 'none');
                        $('#table-content').html('<tr><td colspan="12" class="fieldEdit" style="text-align: center;">No record found.</td></tr>');
                        $('#showing').hide();
                    }
                } else {
                    $("#party_search").show();
                    $("#search_display_processing").css('display', 'none');
                    $('#table-content').html('<tr><td colspan="12" class="fieldEdit" style="text-align: center;">No record found.</td></tr>');
                    $('#showing').hide();
                }
            }
        })
    }

});
