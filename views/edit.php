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
    <title>edit selected product as an admin in wona shop</title>
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
                        <h3 class="mt-2"><span class="text-info">Wona</span>-Shop</h3>                   
                </div>
            </div>
        </nav>
    </header>
    <hr>
    <main class="container-fluid">
             <div class="row">
                 <div class="col-md-6 m-auto">
                     <div class="" id="editFormHolder">

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

const productId = urlParams.get('productId');

$.ajax({
        url: "../api/api_controller.php",
        type: "post",
        data: {
            "fetchForEdit": "fetchForEdit",
            "productId" : productId
        },
        dataType: "JSON",
        success: (data) => {
            outputProducts(data);
        }

    })

    function outputProducts(data) {
    if (data.status == "success") {
        $.each(data.data, (i, val) => {
            let output = `
            <form class="form-group" id="editpost" action="../api/api_controller.php"
                                        method="post" enctype="multipart/form-data">
                                        <input type="hidden" value="${val.id}" name="productId" id="productId">
                                        <input type="text" name="title" class="form-control"
                                            value="${val.title}" required important><br>
                                            <div class="d-flex">
                                        <label>Video Preview</label>
                                        <video src="../assets/products/${val.vid}" muted autoplay class="img-thumbnail w-25 h- m-1"></video>
                                        <label>Sample Image</label>
                                        <img src="../assets/products/${val.photo}" class="img-thumbnail w-25 h-25 m-1">
                                        </div><br>
                                        </select><br><br>
                                        <label>Product's current price <span class="badge bg-danger text-white"># ${parseInt(val.price).toLocaleString()}</span></label>
                                        <input type="number" name="price" class="form-control"
                                            value="${parseInt(val.price).toLocaleString()}" required important><br>
                                            <label>Product's quantity</label>
                                        <input type="number" name="quantity" class="form-control"
                                            value="${val.qty}" required important><br>
                                            <label>Product's current discount <span class="badge bg-warning text-white"># ${parseInt(val.discount).toLocaleString()}</strike></span> </label>
                                        <input type="number" name="discount" class="form-control"
                                            placeholder="enter discount by percent"><br>
                                        <textarea class="form-control" name="longdesc"
                                             rows="20px" required
                                            important>${val.description}</textarea><br>
                                        <input type="submit" class="btn btn-primary offset-10" name="editpost"
                                            id="submitbtn" value="Update">
                                    </form>
           `
            $("#editFormHolder").append(output)
        })
    } else {
        console.log(data.message)
    }
}

})
</script>

</html>