<?php
 /*require_once("./../../api/api_controller.php");

 if(!isset($_SESSION["user_id"])){
                die("<br><br><center>NO DIRECT ACCESS ALLWED<br><br>
                              <a href='./../../index.html' class='btn btn-warning'>here</a></center>                
                ");
                exit();
 }*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="./../../assets/emojionearea-master/dist/emojionearea.min.css" rel="stylesheet">
    <title>userchat-list all messages</title>
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
    <main class="container">
        <div class="row ">
            <div class="col-md-8 bg-dark m-auto pl-5 pt-3" style="height:400px;">
            <h4 class="text-white">CHATS</h4><hr>
                        <div class="" id="contain">

                        </div>
            </div>
        </div>
    </main>
    <footer class="footer bg-primary pb-5  pt-2 mt-5">
        <div class="col-md-8 m-auto ">
            <div class="bg-white p-5">
                <div class="d-flex mb-3">
                    <div class="p-1 mr-2" style="border-radius:10%;">
                        <i class="fa fa-envelope fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="text-muted">EMAIL SUPPORT</h5>
                        <h6 class="text-muted">igwezehycient86@gmail.com</h6>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="p-1 bg-white mr-2" style="border-radius:10%;">
                        <i class="fa fa-phone fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="text-muted">PHONE SUPPORT</h5>
                        <h6 class="text-muted">07088639675</P>
                    </div>
                </div>
            </div>
            <div class="bg-dark p-5">
                <center>
                    <h6 class="text-muted">GET LATEST DEALS</h6>
                </center>
                <form class="form-group d-flex mb-3" action="" method="POST">
                    <input type="email" id="email" name=" email" class="form-control">
                    <input type="submit" id="subscribe" name=" subscribe" value="subscribe"
                        class="btn btn-primary btn-sm " style="float: right;">
                </form>
                <h6 class="text-white">CONNECT WITH US</h6>
                <div class="links">
                    <i class="fa fa-instagram fa-2x"></i>
                    <i class="fa fa-twitter fa-2x"></i>
                    <i class="fa fa-facebook fa-2x"></i>
                    <i class="fa fa-github fa-2x"></i>
                </div>
            </div>
        </div>

    </footer>
</body>
<script src=" https://code.jquery.com/jquery-3.5.1.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="./../../assets/emojionearea-master/dist/emojionearea.min.js"></script>
<script src="./../../assets/script.js"></script>
<script>
$(document).ready(() => {

    $.ajax({
        url: './../../api/api_controller.php',
        type: 'POST',
        data: {
            "FetchAllMessagesForUser": "FetchAllMessagesForUser"
        },
        dataType: "JSON",
        success: data => {
            listMessages(data)
        }
    })

    function listMessages(data) {
        $.each(data.data, (i, val) => {
            output = `
                <a href="./user_messages.php?shop_id=${val.shop_id}">
                <div class=d-flex text-warning>
                          <div class="bg-light p-4 mr-2" style="border-radius:10000px;"><i class="fa fa-user fa-2x text-warning"></i></div>
                          <div class="text-white">
                          <h5>${val.username}</h5>
                          <p class="text-warning">${val.lastMessage}<small class="pl-2">${val.sentOn}</small></p>
                          </div>
                </div>
                </a><hr class="bg-light">
                `
            $("#contain").append(output)
        })
    }

})
</script>

</html>
    