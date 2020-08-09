<?php
      if(isset($_GET["shop_id"])){
          $id = $_GET["shop_id"] ; 
       }

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
    <title> chat with suplier before buying</title>
    <style>
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    body {
        background-color: rgb(229, 236, 236);
    }

    .fa {
        color: teal;
    }

    @media only screen and (max-width:500px) {
        footer {
            display: flex;
            background-color: rgb(129, 136, 158);
            padding: 10px;
        }

        .footer {
            display: flex;
            background-color: rgb(129, 136, 158);
            height: 35px;
        }

        ul {
            display: flex;
            padding: 5px;
            margin: auto;
        }

        ul li {
            display: flex;
            padding-left: 20px;
            padding-right: 20px;
            color: whitesmoke;
            align-items: center;
        }

        ul li a {
            display: flex;
            align-items: center;
            color: whitesmoke;
        }

        ul li a:hover {
            display: flex;
            align-items: center;
            background-color: whitesmoke;
            text-decoration: none;
            color: rgb(148, 93, 165);
        }

        .containz {
            position: static;
            height: 85vh;
            overflow-y: scroll;
        }

        .lef a img {
            margin-right: 10%;
            width: 200px;
            height: 150px;
        }

        .righ a img {
            margin-left: 10%;
            width: 200px;
            height: 150px;
        }

        .lef a video {
            margin-right: 10%;
            width: 200px;
            height: 150px;
        }

        .righ a video {
            margin-left: 10%;
            width: 200px;
            height: 150px;
        }

        .col-md-3 {
            display: none;
        }
    }

    @media only screen and (min-width:500px) {
        footer {
            display: flex;
            background-color: rgb(129, 136, 158);
            padding: 10px;
        }

        .footer {
            display: flex;
            background-color: rgb(129, 136, 158);
            height: 35px;
        }

        ul {
            display: flex;
            padding: 5px;
            margin: auto;
        }

        ul li {
            display: flex;
            align-items: center;
            padding-left: 100px;
            color: whitesmoke;
        }

        ul li a i {
            display: flex;
            align-items: center;
            padding-left: 70px;
            color: whitesmoke;
        }

        ul li a i:hover {
            padding: 5px;
            display: flex;
            text-decoration: none;
            background-color: whitesmoke;
            color: tomato;
        }

        .containz {
            display: block;
            position: static;
            height: 85vh;
            overflow-y: scroll;
            border-right: 2px solid teal;
            border-left: 2px solid teal;
        }

        .lef a img {
            margin-right: 30%;
            width: 200px;
            height: 150px;
        }

        .righ a img {
            margin-left: 30%;
            width: 200px;
            height: 150px;
        }

        .lef a video {
            margin-right: 30%;
            width: 50%;
            height: 150px;
        }

        .righ a video {
            margin-left: 30%;
            width: 200px;
            height: 150px;
        }
    }

    #message {
        width: 80%;
    }

    form {
        display: flex;
        align-items: center;
        margin-top: 4px;
    }

    form i {
        padding: 3px;
        margin: 2px;
    }

    form button {
        margin-right: -10px;
    }

    .chathead {
        background-color: green;
        background: linear-gradient(90deg, rgba(32, 129, 108, 1), rgba(32, 71, 129, 1));
        color: white;
        font-weight: bolder;
        display: flex;
        align-items: center;
        align-content: center;
    }

    #chatheaditemcontainer {
        font-weight: bolder;
        display: flex;
        align-items: center;
        align-content: center;
        margin: auto;
        padding: 2px;
    }

    .nametag {
        padding-right: 10px;
    }

    .lef {
        float: left;
        margin: 5px;
        width: 80%;
    }

    .lef p {
        float: left;
        background-color: green;
        color: whitesmoke;
        width: 100%;
        padding: 5px;
        border-top-right-radius: 12px;
        border-top-left-radius: 10px;
        border-bottom-right-radius: 10px;

    }

    .righ {
        float: right;
        width: 80%;
        margin: 5px;
    }

    .righ p {
        padding: 5px;
        width: 100%;
        border-top-right-radius: 12px;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        background-color: blueviolet;
        color: whitesmoke;
    }

    .conx {
        overflow-y: auto;
    }

    li .fa {
        color: whitesmoke;
    }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 m-auto">
                <div class="chathead">
                </div>
                <div class="containz bg-light">
                </div>
                <form class="form-group" action="./../../api/api_controller.php" method="post"
                    enctype="multipart/form-data" id="msgform">
                    <input type="hidden" name="receiverid" value="" class="receiverid">
                    <i class="fa fa-camera"></i>
                    <i class="fa fa-image pic"></i>
                    <input type="file" name="capture" id="capture" class="form-control" style="display:none"
                        accept="/*">
                    <input name="message" placeholder="enter mmessage here" class="form-control" id="message">
                    <button class="btn" name="sendchat"><i class="fa fa-location-arrow"></i></button>
                </form>
            </div>
            <div class="col-md-3 sidepane">

            </div>
        </div>
    </div>
</body>
<script src=" https://code.jquery.com/jquery-3.5.1.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="./../../assets/emojionearea-master/dist/emojionearea.min.js"></script>
<script src="./../../assets/script.js"></script>
<script>
$(document).ready(() => {
    const queryString = window.location.search;

    const urlParams = new URLSearchParams(queryString);

    const shop_id = urlParams.get('shop_id');

    $(".receiverid").val(shop_id)

    setTimeout(fetchmessage, 1000)

    function fetchmessage() {
        $.ajax({
            url: './../../api/api_controller.php',
            type: 'POST',
            data: {
                "Fetchmessages": "Fetchmessages",
                "shop_id": shop_id
            },
            dataType: "JSON",
            success: data => {
                outputmessages(data)
            }
        })
    }

    function outputmessages(data) {
        output = ""
        $.each(data.data, (i, val) => {
            if (val.sender == shop_id) {
                if (val.files != "") {
                    output = `
                    <div class=" card lef">
                    <div class="card-body">
                    ${generateMediaTag(val.files,val.ext,"left","right")}
                    </div>  
                    <div class="card-footer">
                    <p class="p-2 text-white">${val.message}</p>
                    <small>${val.sentOn}</small>
                    </div>                       
                     </div>
                    `
                } else {
                    output = `
                    <div class=" card lef"> 
                    <div class="card-footer">
                    <p class="p-2 text-white">${val.message}</p>
                    <small>${val.sentOn}</small>
                    </div>                       
                     </div>
                    `
                }
            } else {
                if (val.files != "") {
                    output = `
                    <div class=" card righ">
                    <div class="card-body">
                    ${generateMediaTag(val.files,val.ext,"right","left")}
                    </div>  
                    <div class="card-footer">
                    <p class="p-2 text-white">${val.message}</p>
                    <small>${val.sentOn}</small>
                    </div>                       
                     </div>
                    `
                } else {
                    output = `
                    <div class=" card righ">
                    <div class="card-footer">
                    <p class="p-2 text-white">${val.message}</p>
                    <small>${val.sentOn}</small>
                    </div>                       
                     </div>
                    `
                }
            }
            $(".containz").append(output)
        })
    }

    function generateMediaTag(filepath, ext, float, margin) {
        imgarray = ['gif', 'png', 'jpeg', 'jpg']
        vidarray = ['mp4', 'mpg', 'mpeg', "m4v"]
        tag = ""
        if (imgarray.includes(ext)) {
            tag =
                `<a href="./../../assets/products/${filepath}" download><img src="./../../assets/products/${filepath}" class='rounded img-thumbnail' style='width:100%; height:100px;float:${float};margin-${margin} :60px;' ></a>`
        } else if (vidarray.includes(ext)) {
            tag =
                `<a href="./../../assets/products/${filepath}" download><video src="./../../assets/products/${filepath}" class='rounded img-thumbnail' controls style='width:100%; height:100px;float:${float};margin-${margin} :60px;'></video></a>`
        }
        return tag
    }

    $("form#msgform").submit((e) => {
        e.preventDefault()
        var form = $("#msgform")
        var formData = new FormData(form[0]);
        $.ajax({
            url: './../../api/api_controller.php',
            type: 'POST',
            data: formData,
            success: data => {
                if (data.status == "success") {
                    form.reset()
                } else {
                    alert(data)
                }
            },
            cache: false,
            contentType: false,
            processData: false
        })
    });


    fetchShopDetails(shop_id)

    function fetchShopDetails(shop_id) {
        $.ajax({
            url: './../../api/api_controller.php',
            type: 'POST',
            data: {
                "vendorDetails": "vendorDetails",
                "shop_id": shop_id
            },
            dataType: "JSON",
            success: data => {
                if (data.status == "success") {
                    createheader(data)
                    sidepane(data)
                } else {
                    console.log(data)
                }
            }
        })
    }

    function createheader(data) {
        $.each(data.data, (i, val) => {
            output = `
                <center id='chatheaditemcontainer'>
                <h4 class='nametag'><i class="fa fa-user mr-2 text-primary bg-light p-2" style="border-radius:1000px;"></i>${val.shop_username}</h4>
                </center>
              `
            $(".chathead").append(output)
        })

    }

    function sidepane(data) {
        $.each(data.data, (i, val) => {
            output = `
                        <div class="card">
                                <div class="card-header bg-dark">
                                    <h4 class="text-warning"><i class="fa fa-user fa-2x mr-2 bg-light p-2" style="border-radius:1000px;"></i>${val.shop_username}</h4>
                                </div>
                                <div class="card-body text-warning bg-dark">
                                <h6><i class="fa fa-dashboard mr-2"></i>Address : ${val.office_address}</h6>
                                <h6><i class="fa fa-phone mr-2"></i>Phone : ${val.phone}</h6>
                                <h6><i class="fa fa-envelope mr-2"></i>Email : ${val.email}</h6>
                                </div>
                         </div>
                `
            $(".sidepane").append(output)
        })
    }

    $(".fa-camera").click(() => {
        $("#capture").attr("capture", "camera")
        $("#capture").trigger("click")
    });
    $(".pic").click(() => {
        $("#capture").removeAttr("capture")
        $("#capture").trigger("click")
    });
    $("#message").emojioneArea()
})
</script>

</html>