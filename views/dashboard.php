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
                    <form class="form-inline offset-6">
                        <input type="text" name="searchbar" class="form-control col" id="searchbar">
                        <button class="btn btn-info btn-sm" id="searchbtn"><i class="fa fa-search"></i></button>
                    </form>
                    <button class="navbar-toggler first-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent20" aria-controls="navbarSupportedContent20" aria-expanded="false" aria-label="Toggle navigation">
                            <div class="animated-icon1"><span></span><span></span><span></span></div>
                    </button>
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
                            <h6> <a href="" class=""><i class="fa fa-cloud-upload p-2"></i>Products</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="" class=""><i class="fa fa-image p-2"></i>Images</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="" class=""><i class="fa fa-camera p-2"></i>videos</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="" class=""><i class="fa fa-envelope p-2"></i>Messages</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="" class=""><i class="fa fa-bell p-2"></i>Orders</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="" class=""><i class="fa fa-cart-arrow-down  p-2"></i>Sold out</a></h6>
                        </li>
                        <li class="nav-item">
                            <h6><a href="" class=""><i class="fa fa-money p-2"></i>Wallet</a></h6>
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
                        <h6> <a href="" class="text-white "><i class="fa fa-cloud-upload p-2"></i>Products</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="" class="text-white"><i class="fa fa-image p-2"></i>Images</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="" class="text-white"><i class="fa fa-camera p-2"></i>videos</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="" class="text-white"><i class="fa fa-bell p-2"></i>Orders</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="" class="text-white"><i class="fa fa-money p-2"></i>Wallet</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="" class="text-white"><i class="fa fa-envelope p-2"></i>Messages</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="" class="text-white"><i class="fa fa-cart-arrow-down p-2"></i>Sold out</a></h6>
                    </li><br>
                    <li>
                        <h6><a href="" class="text-white"><i class="fa fa-cogs p-2"></i>Settings</a></h6>
                    </li>
                    <li>
                    <h6 id="logout"><a class="text-white"><i class="fa fa-sign-out p-2"></i>logout</a></h6>
                    </li><br><br>
                </ul>

            </div>
            <div class="col-md-10 m-auto">
                <div class="addnew">
                    <button class="btn btn-info btn-sm m-2 newpost1" data-toggle="modal" data-target="#exampleModal"><b>+</b>post</button>
                </div><br><br>
                <div class="container-fluid boxes">
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-group" id="newpost" action="../api/api_controller.php" method="post" enctype="multipart/form-data">
                                        <input type="text" name="title" class="form-control" placeholder="Product's name" required important><br>
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
                                                <option value="General_Office_Home_fittens">General Office/Home fittens</option>
                                        </select><br><br>
                                        <input type="number" name="price" class="form-control" placeholder="Product's price" required important><br>
                                        <input type="number" name="quantity" class="form-control" placeholder="quantity of product" required important><br>
                                        <input type="text" name="discount" class="form-control" placeholder="available discount by percent"><br>
                                        <textarea class="form-control" name="longdesc" placeholder="...Product detailed description" rows="7px" required important></textarea><br>
                                        <input type="submit" class="btn btn-primary offset-10" name="submitpost" id="submitbtn" value="post">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 card m-2 bg-danger text-white">
                            <div class="d-flex">
                                <i class="fa fa-cloud-upload mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h5>Total Products</h5>
                                        <h6><b>30</b></h6>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card m-2 bg-warning text-white">
                            <div class="d-flex">
                                <i class="fa fa-camera mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h5>Total Videos</h5>
                                        <h6><b>30</b></h6>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card m-2 bg-info text-white">
                            <div class="d-flex">
                                <i class="fa fa-image mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h5>Total Images</h5>
                                        <h6><b>30</b></h6>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card m-2 bg-primary text-white">
                            <div class="d-flex">
                                <i class="fa fa-bell mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h5>Total Orders</h5>
                                        <h6><b>30</b></h6>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card m-2 bg-light text-warning">
                            <div class="d-flex">
                                <i class="fa fa-money mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h5>Total Wallet</h5>
                                        <h6><b>30</b></h6>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card m-2 bg-success text-white">
                            <div class="d-flex">
                                <i class="fa fa-envelope mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h5>Total Messages</h5>
                                        <h6><b>30</b></h6>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card m-2 bg-muted text-warning text-white">
                            <div class="d-flex">
                                <i class="fa fa-cart-arrow-down mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h5>Total Sales</h5>
                                        <h6><b>30</b></h6>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 card m-2 bg-dark text-white">
                            <div class="d-flex">
                                <i class="fa fa-cloud-upload mt-3 pr-2" style="font-size:2em;"></i>
                                <div>
                                    <center>
                                        <h5>Total Products</h5>
                                        <h6><b>30</b></h6>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
</body>
<script src=" https://code.jquery.com/jquery-3.5.1.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js "></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js "></script>
<script src="../assets/script.js"></script>
<script>
    /*
    
    SELECT COUNT( * ) as "Number of Rows"
FROM orders
WHERE ord_amount>1500;
    
    
    const queryString = window.location.search;

        const urlParams = new URLSearchParams(queryString);

        const cat = urlParams.get('cat');*/
</script>

</html>