$(document).ready(() => {

    $("#registerform").submit((e) => {
        e.preventDefault();
        vendor_username = $("#vendor_username").val();
        vendor_address = $("#vendor_address").val();
        vendor_phone = $("#vendor_phone").val();
        vendor_email = $("#vendor_email").val();
        vendor_pass = $("#vendor_pass").val();
        vendor_cpass = $("#vendor_cpass").val();
        if (vendor_pass.length >= 8) {
            if (vendor_cpass === vendor_pass) {
                $.ajax({
                    url: '../api/api_controller.php',
                    type: 'POST',
                    data: {
                        "vendor_username": vendor_username,
                        "vendor_address": vendor_address,
                        "vendor_phone": vendor_phone,
                        "vendor_email": vendor_email,
                        "vendor_pass": vendor_pass,
                        "vendor_cpass": vendor_cpass
                    },
                    dataType: "JSON",
                    success: data => {
                        if (data.status == "success") {
                            location.href = data.redirect
                        } else {
                            $("#error").text(data.message)
                            setTimeout(function() {
                                $("#error").text("");
                            }, 2000)
                        }
                    }
                })

            } else {
                $("#error").text("passwords doesnt match")

                setTimeout(function() {
                    $("#error").text("");
                }, 2000)
            }
        } else {
            $("#error").text("password too short")

            setTimeout(function() {
                $("#error").text("");
            }, 2000)
        }
    });

    $("#loginform").submit((e) => {
        e.preventDefault();
        vendor_email_login = $("#vendor_email_login").val();
        vendor_pass_login = $("#vendor_pass_login").val();
        $.ajax({
            url: '../api/api_controller.php',
            type: 'POST',
            data: {
                "vendor_email_login": vendor_email_login,
                "vendor_pass_login": vendor_pass_login,
            },
            dataType: "JSON",
            success: data => {
                if (data.status == "success") {
                    location.href = data.redirect
                } else {
                    $("#error").text(data.message)
                    setTimeout(function() {
                        $("#error").text("");
                    }, 2000);

                }
            }
        })

    });


    $("#logout").click(() => {
        $.ajax({
            url: '../api/api_controller.php',
            type: 'POST',
            data: {
                "vendor_logout": "vendor_logout"
            },
            dataType: "JSON",
            success: data => {
                location.href = "./login.html"
            }
        })
    });

})