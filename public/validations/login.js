$(document).ready(function () {
    $("#login_form").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Please enter a valid email id",
                email: "Please enter a valid email id"
            },
            password: {
                required: "Please provide a password"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("#register_form").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            user_type:{
                required: true,
            },
            password: {
                required: true,
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"

            }
        },
        messages: {
            name: {
                required: "Please enter a name",
            },
            email: {
                required: "Please enter a valid email id",
                email: "Please enter a valid email id"
            },
            user_type: {
                required: "Please select a user type",
            },
            password: {
                required: "Please provide a password"
            },
            password_confirmation: {
                required: "Please provide a password",
                equalTo: "Please enter same password"
            }
        },

    });


});

