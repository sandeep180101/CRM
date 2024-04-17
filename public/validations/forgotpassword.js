jQuery(document).ready(function () {
    $("#forgot_password_form").validate({
        onfocusout: false,
        errorElement: "div",
        rules: {
            contact_email: {
                required: true,
                email: true,
            },
        },
        messages: {
            contact_email: {
                required: "Please enter your email",
                email: "Please enter a valid email",
            },
        },

    });

    jQuery("#change_password_form").validate({
        onfocusout: false,
        errorElement: "div",
        rules: {
            current_password:{
                required: true,
            },
            new_password: {
                required: true,
            },
            new_confirm_password: {
                required: true,
                equalTo :"#new_password"
            },
        },
        messages: {
            current_password:{
                required: "Please enter current password",

            },
            new_password: {
                required: "Please enter password between 8 to 16",
            },
            new_confirm_password: {
                required: "Confirm password can't be empty",
                equalTo : "Please enter the same password as new password"
            },
        },

    });

});
