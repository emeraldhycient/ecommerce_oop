$(document).ready(() => {
    $("#registerform").submit((e) => {
        e.preventDefault();
        vendor_username = $("#vendor_username").val();
        vendor_address = $("#vendor_address").val();
        vendor_phone = $("#vendor_phone").val();
        vendor_email = $("#vendor_email").val();
        vendor_pass = $("#vendor_pass").val();
        vendor_cpass = $("#vendor_cpass").val();
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
                success: data => {
                    console.log(data.status);

                    /*if (data.status === "success") {
                        location.href = data.redirect;
                    } else {
                        alert(data.message)
                    }*/
                }
            })
        } else {
            $("#error").text("passwords doesnt match")

            setTimeout(function() {
                $("#error").text("");
            }, 2000)
        }
    });

    $("#loginform").submit((e) => {
        e.preventDefault();
        vendor_username = $("#vendor_username").val();
        vendor_pass = $("#vendor_pass").val();
        if (vendor_cpass === vendor_pass) {
            $.ajax({
                url: '../api/api_controller.php',
                type: 'POST',
                data: {

                    "vendor_email": vendor_email,
                    "vendor_pass": vendor_pass,
                },
                success: data => {
                    alert(data);
                }
            })
        } else {
            $("#error").text("passwords doesnt match")

            setTimeout(function() {
                $("#error").text("");
            }, 2000)
        }
    });

})