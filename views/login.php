<?php
 require_once("../api/api_controller.php");

 if(isset($_SESSION["shop_id"])){
            header("location: dashboard.php");
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <header>
        <nav class="container">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <h3 class="mt-2"><span class="text-info">Wona</span>-Shop</h3>
                </div>
            </div>
        </nav>
    </header>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="shadow-lg error bg-danger ">
                    <p id="error"></p>
                </div>
            </div>
        </div>
    </div>
    <main class="container-fluid formsHolder">
        <div class="row formsHolderRow">
            <div class="col-md-5 m-auto">
                <center>
                    <h5>Login As A Vendor</h5>
                </center>
                <form method="POST" enctype="multipart/form-data" id="loginform" class="form-group">
                    <label>Email :</label>
                    <input type="email" name="vendor_email_login" id="vendor_email_login" class="form-control mb-2" required important>
                    <label>Password :</label>
                    <input type="password" name="vendor_pass_login" id="vendor_pass_login" class="form-control mb-2" required important>
                    <input type="submit" class="btn btn-success btn-sm" value="login" style="float:right;">
                </form>
                <a href="./register.html" id="registerlink">Become A Vendor</a>
            </div>
            <div class="col-md-5 m-auto registerForm">
                <center>
                    <h5>Become A Vendor</h5>
                    <p class="text-info">Register As A Vendor</p>
                </center>
                <form method="POST" enctype="multipart/form-data" id="registerform" class="form-group">
                    <label>Comapny Name :</label>
                    <input type="text" name="vendor_username" id="vendor_username" class="form-control mb-2" required important>
                    <label>Office Address :</label>
                    <input type="text" name="vendor_address" id="vendor_address" class="form-control mb-2" required important>
                    <label>Phone :</label>
                    <input type="text" name="vendor_phone" id="vendor_phone" class="form-control mb-2" required important>
                    <label>Email :</label>
                    <input type="email" name="vendor_email" id="vendor_email" class="form-control mb-2" required important>
                    <label>Password :</label>
                    <input type="Password" name="vendor_pass" id="vendor_pass" class="form-control mb-2" required important>
                    <label>Confirm Password :</label>
                    <input type="Password" name="vendor_cpass" id="vendor_cpass" class="form-control mb-2" required important>
                    <input type="submit" class="btn btn-primary btn-sm" id="register" value="register" style="float:right;">
                </form>
            </div>
        </div>
    </main><br>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js "></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js "></script>
<script src="../assets/script.js"></script>
</script>

</html>