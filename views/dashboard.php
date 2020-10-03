<?php
 require_once("../api/api_controller.php");

 if(!isset($_SESSION["shop_id"])){
                die("<br><br><center>NO DIRECT ACCESS ALLWED<br><br>
                             please login or create account  <a href='./login.php'>here</a></center>                
                ");
                exit();
 }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>views/dashboard</title>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <header>
        <nav class="container">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <div class="d-flex mb-2">
                    <button class="navbar-toggler first-button mt-1" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent20" aria-controls="navbarSupportedContent20"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <div class="animated-icon1"><span></span><span></span><span></span></div>
                    </button>
                    <h3 class="mt-2"><span class="text-info">Wona</span>-Shop</h3>
                    </div>
                    <form class="form-inline mt-1" id="searchbar1" action="./searchProduct.html">
                        <input type="text" class="form-control col mr-1" name="searchQuery">
                        <button type="submit" class="btn btn-tone-4 btn-sm"><i class="fa fa-location-arrow"></i></button>
                    </form>                 
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="collapse navbar-collapse" id="navbarSupportedContent20">
                    <hr>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item bg-warning">
                            <h6> <a href="" class="text-white"><i class="fa fa-dashboard  p-2"></i>dashboard</a></h6>
                        </li>
                        <li class="nav-item active">
                            <h6> <a href="./dashboard.php?action=fetchProducts" class=""><i
                                        class="fa fa-cloud-upload p-2"></i>Products</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="./dashboard.php?action=fetchImages" class=""><i
                                        class="fa fa-image p-2"></i>Images</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="./dashboard.php?action=fetchVideos" class=""><i
                                        class="fa fa-camera p-2"></i>videos</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="./chats/dashboard_chat.php" class=""><i
                                        class="fa fa-envelope p-2"></i>Messages</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="./dashboard.php?action=fetchOrders" class=""><i
                                        class="fa fa-bell p-2"></i>Orders</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="" class=""><i class="fa fa-cart-arrow-down  p-2"></i>Sold out</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="./dashboard.php?action=fetchAccount" class=""><i
                                        class="fa fa-money p-2"></i>Wallet</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="" class=""><i class="fa fa-cogs p-2"></i>Settings</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6 id="logout"><a class=""><i class="fa fa-sign-out p-2"></i>logout</a></h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <main class="container-fluid">
        <div class="row">
            <div class="col-md-2 side">
                <ul class="pt-2">
                    <li class="bg-warning p-2">
                        <h6> <a href="" class="text-white "><i class="fa fa-dashboard p-2"></i>dashboard</a></h6>
                    </li><br>
                    <li class="">
                        <h6> <a href="./dashboard.php?action=fetchProducts" class="text-white "><i
                                    class="fa fa-cloud-upload p-2"></i>Products</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="./dashboard.php?action=fetchImages" class="text-white"><i
                                    class="fa fa-image p-2"></i>Images</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="./dashboard.php?action=fetchVideos" class="text-white"><i
                                    class="fa fa-camera p-2"></i>videos</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="./dashboard.php?action=fetchOrders" class="text-white"><i
                                    class="fa fa-bell p-2"></i>Orders</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="./dashboard.php?action=fetchAccount" class="text-white"><i
                                    class="fa fa-money p-2"></i>Wallet</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="./chats/dashboard_chat.php" class="text-white"><i
                                    class="fa fa-envelope p-2"></i>Messages</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="" class="text-white"><i class="fa fa-cart-arrow-down p-2"></i>Sold out</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="" class="text-white"><i class="fa fa-cogs p-2"></i>Settings</a></h6>
                    </li>
                    <li>
                        <h6 id="logout2"><a class="text-white"><i class="fa fa-sign-out p-2"></i>logout</a>
                        </h6>
                    </li><br><br>
                </ul>

            </div>
            <div class="col-md-10 m-auto">
                <div class="addnew">
                    <button class="btn btn-info btn-sm m-2 newpost1" data-toggle="modal"
                        data-target="#exampleModal"><b>+</b>post</button>
                </div><br><br>
                <div class="container-fluid boxes">
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-group" id="newpost" action="../api/api_controller.php"
                                        method="post" enctype="multipart/form-data">
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Product's name" required important><br>
                                        <label>Video Preview</label>
                                        <input type="file" name="video" class="form-control" required important>
                                        <label>Sample Images</label>
                                        <input type="file" name="photo" class="form-control mb-2" required important>
                                        <select name="category" class="bg-primary text-white">
                                            <option>select category</option>
                                            <option value="Furniture">Furniture</option>
                                            <option value="Kitchen_Accessories">Kitchen Accessories</option>
                                            <option value="Fashion_Wears">Fashion Wears</option>
                                            <option value="Electronics">Electronics</option>
                                            <option value="General_Office_Home_fittens">General Office/Home fittens
                                            </option>
                                        </select><br><br>
                                        <input type="number" name="price" class="form-control"
                                            placeholder="Product's price" required important><br>
                                        <input type="number" name="quantity" class="form-control"
                                            placeholder="quantity of product" required important><br>
                                        <input type="text" name="discount" class="form-control"
                                            placeholder="available discount by percent"><br>
                                        <textarea class="form-control" name="longdesc"
                                            placeholder="...Product detailed description" rows="7px" required
                                            important></textarea><br>
                                        <input type="submit" class="btn btn-primary offset-10" name="submitpost"
                                            id="submitbtn" value="post">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 card mt-2 bg-danger text-white">
                            <div class="d-flex">
                                <i class="fa fa-cloud-upload fa-2x mt-3 pr-2"></i>
                                <div>
                                    <center>
                                        <h6 class="mt-2">Total Products</h5>
                                            <span class="badge bg-info p-1"><b>30</b></span>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card mt-2 bg-warning text-white">
                            <div class="d-flex">
                                <i class="fa fa-camera fa-2x mt-3 pr-2"></i>
                                <div>
                                    <center>
                                        <h6 class="mt-2">Total Videos</h5>
                                            <span class="badge bg-info p-1"><b>30</b></span>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card mt-2 bg-info text-warning">
                            <div class="d-flex">
                                <i class="fa fa-image fa-2x mt-3 pr-2"></i>
                                <div>
                                    <center>
                                        <h6 class="mt-2">Total Images</h5>
                                            <span class="badge bg-info p-1"><b>30</b></span>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card mt-2 bg-primary text-white">
                            <div class="d-flex">
                                <i class="fa fa-bell mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h6 class="mt-2">Total Orders</h5>
                                            <span class="badge bg-info p-1"><b>30</b></span>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card mt-2 bg-light text-warning">
                            <div class="d-flex">
                                <i class="fa fa-money mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h6 class="mt-2">Total Wallet</h5>
                                            <span class="badge bg-info p-1"><b>30</b></span>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card mt-2 bg-success text-warning">
                            <div class="d-flex">
                                <i class="fa fa-envelope mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h6 class="mt-2">Total Messages</h6>
                                        <span class="badge bg-info p-1"><b>30</b></span>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card mt-2 bg-dark text-warning text-white">
                            <div class="d-flex">
                                <i class="fa fa-cart-arrow-down mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h6 class="mt-2">Total Sales</h6>
                                        <span class="badge bg-info p-1"><b>30</b></span>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contentbox">
                    <center>
                        <h4 class="m-5" id="navTitle"></h4>
                    </center>
                    <div class="row" id="contentholder">

                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer bg-primary  pb-5  pt-2 mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-8 m-auto">
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
        <div class="col-md-2"></div>
    </footer>
</body>
<script src=" https://code.jquery.com/jquery-3.5.1.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js "></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js "></script>
<script src="../assets/script.js"></script>
<script>
    $(document).ready(()=>{

const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

const action = urlParams.get('action');

switch (action) {
    case "fetchProducts":
        customFetch("fetchProducts", outputProducts)
        break;
    case "fetchImages":
        customFetch("fetchImages", outputImages)
        break;
    case "fetchVideos":
        customFetch("fetchVideos", outputVideos)
        break;
    case "fetchOrders":
        customFetch("fetchOrders", outputOrders)
        break;
    case "fetchAccount":
        customFetch("fetchAccount", outputAccount)
        break;
    default:
        customFetch("fetchProducts", outputProducts)
}

function customFetch(data, outputFunction) {
    $.ajax({
        url: "../api/api_controller.php",
        type: "post",
        data: {
            "dashboardAction": data
        },
        dataType: "JSON",
        success: (data) => {
            outputFunction(data);
        }

    })
}

function outputProducts(data) {
    if (data.status == "success") {
        $.each(data.data, (i, val) => {
            let output = `
           <div class="col-md-5" id="box">
                <div class="card">
                <div class="card-body">
                    <div class="row" id="mediabox">
                        <div class="col-md-6">
                        <video src="../assets/products/${val.vid}" muted autoplay class="img-thumbnail"></video>
                        </div>
                        <div class="col-md-6">
                        <img src="../assets/products/${val.photo}" class="img-thumbnail">
                        </div>
                        </div>
                    </div>
                    <div class="card-footer">
                         <h6 class="card-title">${val.title}</h6>
                         <h6>QTY Available : ${val.qty} <span class="badge bg-info text-white">Category : ${val.category}</h6>
                        <div>${val.description}</div> 
                        <hr>
                        <div class="btn-group">
                        <form action="../api/api_controller.php" method="post">
                        <input type="hidden" name="productid" value="${val.id}">
                         <button type="submit" name="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-2x"></i></button>
                         </form>
                         <button class="btn btn-info btn-sm text-white"><a href="./edit.php?productId=${val.productid}"><i class="fa fa-edit fa-2x text-white"></i></a></button>
                         </div>
                    </div>
                </div>
           </div>
           `
            $("#contentholder").append(output)
        })
        $("#navTitle").text("Products")
    } else {
        console.log(data.message)
    }
}

function outputImages(data) {
    if (data.status == "success") {
        $.each(data.data, (i, val) => {
            let output = `
           <div class="col-md-5" id="box">
                <div class="card">
                <div class="card-body">
                        <img src="../assets/products/${val.photo}" class="img-thumbnail">
                    </div>
                    <div class="card-footer">
                         <h6 class="card-title">${val.title}</h6>
                         <h6>QTY Available : ${val.qty} <span class="badge bg-info text-white">Category : ${val.category}</h6>
                         <hr><div class="btn-group">
                         </div>
                    </div>
                </div>
           </div>
           `
            $("#contentholder").append(output)
        })
        $("#navTitle").text("Images")
    } else {
        console.log(data.message)
    }
}

function outputVideos(data) {
    if (data.status == "success") {
        $.each(data.data, (i, val) => {
            let output = `
           <div class="col-md-5" id="box">
                <div class="card">
                <div class="card-body">
                        <video src="../assets/products/${val.preview}" muted autoplay class="img-thumbnail"></video>
                    </div>
                    <div class="card-footer">
                         <h6 class="card-title">${val.title}</h6>
                         <h6>QTY Available : ${val.qty} <span class="badge bg-info text-white">Category : ${val.category}</h6>
                         <hr><div class="btn-group">
                         </div>
                    </div>
                </div>
           </div>
           `
            $("#contentholder").append(output)
        })
        $("#navTitle").text("Videos")
    } else {
        console.log(data.message)
    }
}

function outputOrders(data) {
    if (data.status == "success") {
        $.each(data.data, (i, val) => {
            console.log(val.vid);
        })
    } else {
        console.log(data.message)
    }
}

function outputAccount(data) {
    if (data.status == "success") {
        $.each(data, (i, val) => {
            console.log(val.data);
        })
    } else {
        console.log(data.message)
    }
}

})
</script>

</html>