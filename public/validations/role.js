$(document).ready(function () {
        $("#kt_modal_role_form").validate({
            rules: {
                role_name: {
                    required: true,
                    alphabetic: true,
                },
            },
            messages: {
                role_name: {
                    required: "Please enter a role name",
                    alphabetic: "Only alphabetic characters are allowed",
                }
            },
        });

    });

