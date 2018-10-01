
// voert code uit wanneer de pagina volledig geladen is
$(document).ready(function () {
    // checked title van pagina


    validation = {

        checkEmpty: function (elem, textPlace, msg) {
            if(elem.val().length < 1) {
                textPlace.html(msg);
                textPlace.slideDown('fast');
            } else {
                textPlace.slideUp('fast');
            }
        },

        checkLength: function (elem, min, max, textPlace, msg) {
            if(elem.val().length > 0 && elem.val().length <= min || elem.val().length >= max) {
                textPlace.html(msg);
                textPlace.slideDown('fast');
            } else {
                textPlace.slideUp('fast');
            }
        },

        checkEqual: function (first, second, textPlace, msg) {
            if(first.val() != second.val()) {
                textPlace.html(msg);
                textPlace.slideDown('fast');
            } else {
                textPlace.slideUp('fast');
            }
        },

        checkUsernameExists: function (username, textPlace, msg) {
            $.ajax({
                type: "POST",
                url: "ajax/checkRegister.php",
                data: {
                    check: "user",
                    username: username
                },
                success: function (data) {
                    console.log(data);
                    if(data == 1 && username.length > 0) {
                        textPlace.html(msg);
                        textPlace.slideDown('fast');

                    } else {
                        if(username > 0) {
                            textPlace.slideUp('fast');
                        }

                    }
                }
            })
        },

        checkEmailExists: function (email, textPlace, msg) {
            $.ajax({
                type: "POST",
                url: "ajax/checkRegister.php",
                data: {
                    check: "email",
                    email: email
                },
                success: function (data) {
                    console.log(data);
                    if(data == 1 && email.length > 0) {
                        textPlace.html(msg);
                        textPlace.slideDown('fast');


                    } else {
                        if(email > 0) {
                            textPlace.slideUp('fast');
                        }
                    }
                }
            })
        }
    };
    

    $('.login-forum input').on("keyup", function () {
        validation.checkEmpty($(this), $(this).next(), 'Field is empty');
    });

    $('.register-forum .form-confirm-password').on("change", function () {
        validation.checkEqual($('.form-password'), $(this), $(this).next(), "Confirm password is not equal to password")
    });

    $('#register-username').on("change", function () {
        validation.checkUsernameExists($(this).val(), $(this).next(), 'Username already exists');
    });

    $('#register-username').on("change", function () {
        validation.checkLength($(this), 3, 20, $(this).next(), 'Username too long or too short')
    });

    $('#register-email').on("change", function () {
        validation.checkEmailExists($(this).val(), $(this).next(), 'Email already exists');
    });

    $('.register-forum input').on("keyup", function () {
        validation.checkEmpty($(this), $(this).next(), 'Field is empty');
    });


   
});
