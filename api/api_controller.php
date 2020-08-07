<?php
if(isset($_SERVER['REMOTE_ADDR']) AND ( $_SERVER['REMOTE_ADDR'] !== $_SERVER['SERVER_ADDR'] )){
     $this->output->set_status_header(400, 'No Remote Access Allowed');
      die(' Access Denied, Your IP: ' . $_SERVER['REMOTE_ADDR'] );
     }
include_once"products_api.php";
include_once"users_api.php";
include_once"vendors_api.php";

$productApi = new productApi;
$usersApi = new usersApi;
$vendorApi = new vendorsApi;

//echo json_encode($vendorApi->fetchAllOrders());

//fetchallmessages for user 
if(isset($_POST["FetchAllMessagesForUser"])){
echo json_encode($usersApi->fetchAllMessages());
}

//FetchAllMessages for vendor
if(isset($_POST["FetchAllMessages"])){
echo json_encode($vendorApi->fetchAllMessages());
}

//user sends message
if(isset($_POST["vendorMess"])){
     $mssg = $vendorApi->sendMessage($_POST["message"],$_POST["receiverid"],$_FILES["capture"]);
     echo json_encode($mssg);
}

//fetch mesages for vendor
if(isset($_POST["FetchmessagesVendor"])){
     echo json_encode($vendorApi->fetchMessages($_POST["user_id"]));
}

//fetch users details
if(isset($_POST["userDetails"])){
     echo json_encode($vendorApi->usersDetails($_POST["user_id"]));
}

//fetch messages for user 
if(isset($_POST["Fetchmessages"])){
     echo json_encode($usersApi->fetchMessages($_POST["shop_id"]));
}

// fetch vendor details for user 
if(isset($_POST["vendorDetails"])){
echo json_encode($usersApi->vendorsDetails("5f0dc50e12ced"));
}

//user sends message
if(isset($_POST["message"])){
     $mssg = $usersApi->sendMessage($_POST["message"],$_POST["receiverid"],$_FILES["capture"]);
     echo json_encode($mssg);
}

//fetch product review
if(isset($_POST["fetchreview"])){
     $prod = $productApi->fetchReview($_POST["productid"]);
     $data = [];
     if($prod["status"] === "success"){
              while ($row  = $prod["data"]->fetch_object()){
                   $data[$row->id] = array(
                        "id" => $row->id,
                        "productid" => $row->productid,
                        "review" => $row->review,
                        "reviewer" => $row->reviewer
                   );
              }
              echo json_encode($data);
     }else{
          echo  json_encode($prod);
     }
}

//submit product review
if(isset($_POST["submitreview"])){
     $prod = $productApi->submitProductReview($_POST["productid"],$_POST["review"],$_POST["reviewer"]);
     echo json_encode($prod);
}


// fetch product for flash sales category
if(isset($_POST["fetchProductForFlashSales"])){
    $prod =$productApi->fetchProductForFlashSales();
     $data = [];
if($prod["status"] === "success"){
 while ($row = $prod["data"]->fetch_object()){
      $data[$row->id] = array(
           "id" => $row->id,
           "productid" => $row->productid,
           "title" => $row->p_title,
           "description" => $row->longdesc,
           "qty" => $row->quantity,
           "photo" => $row->photo,
           "vid" => $row->preview,
           "price"  => $row->price,
           "discount" => $row->discount,
           "category" => $row->cat
      );
 }
 echo json_encode($data);
}else{
     echo json_encode($prod);
}
}


// view single product
if(isset($_POST["single_view"])){
     $prod =$productApi->singleProduct($_POST["productid"]);
      $data = [];
 if($prod["status"] === "success"){
  while ($row = $prod["data"]->fetch_object()){
       $data[$row->id] = array(
            "id" => $row->id,
            "productid" => $row->productid,
            "shop_id" => $row->shop_id,
            "title" => $row->p_title,
            "description" => $row->longdesc,
            "qty" => $row->quantity,
            "photo" => $row->photo,
            "vid" => $row->preview,
            "price"  => $row->price,
            "discount" => $row->discount,
            "category" => $row->cat
       );
  }
  echo json_encode($data);
 }else{
      echo json_encode($prod);
 }
 }


 // select other related product
 if(isset($_POST["selectCategory"])){
     $prod =$productApi->selectProductCategory($_POST["category"]);
      $data = [];
 if($prod["status"] === "success"){
  while ($row = $prod["data"]->fetch_object()){
       $data[$row->id] = array(
            "id" => $row->id,
            "productid" => $row->productid,
            "title" => $row->p_title,
            "description" => $row->longdesc,
            "qty" => $row->quantity,
            "photo" => $row->photo,
            "vid" => $row->preview,
            "price"  => $row->price,
            "discount" => $row->discount,
            "category" => $row->cat
       );
  }
  echo json_encode($data);
 }else{
      echo json_encode($prod);
 }
 }

 //fetch product for latest deal section
if(isset($_POST["latestdeal"])){
     $prod =$productApi->fetchLatestProducts();
      $data = [];
 if($prod["status"] === "success"){
  while ($row = $prod["data"]->fetch_object()){
       $data[$row->id] = array(
            "id" => $row->id,
            "productid" => $row->productid,
            "title" => $row->p_title,
            " description" => $row->longdesc,
            "qty" => $row->quantity,
            "photo" => $row->photo,
            "vid" => $row->preview,
            "price"  => $row->price,
            "discount" => $row->discount,
            "category" => $row->cat
       );
  }
  echo json_encode($data);
 }else{
      echo json_encode($prod);
 }
 }


  //fetch product for  handpicked section
if(isset($_POST["handpicked"])){
     $prod =$productApi->fetchRecommendedProducts();
      $data = [];
 if($prod["status"] === "success"){
  while ($row = $prod["data"]->fetch_object()){
       $data[$row->id] = array(
            "id" => $row->id,
            "productid" => $row->productid,
            "title" => $row->p_title,
            " description" => $row->longdesc,
            "qty" => $row->quantity,
            "photo" => $row->photo,
            "vid" => $row->preview,
            "price"  => $row->price,
            "discount" => $row->discount,
            "category" => $row->cat
       );
  }
  echo json_encode($data);
 }else{
      echo json_encode($prod);
 }
 }


 //submit post by vendors
if(isset($_POST["submitpost"])){
    $product = $productApi->insertProduct($_POST["title"],$_POST["longdesc"],$_POST["price"],$_FILES["photo"],$_POST["quantity"]
     ,$_POST["discount"],$_POST["category"],$_FILES["video"]);
     if($product['status'] === 'success'){
              echo $product['redirect'];
     }else{
                  echo $product["message"];
     }
}

// vendor create account
if(isset($_POST["vendor_username"])){
     $vendor = $vendorApi->createAccount($_POST["vendor_username"],$_POST["vendor_address"]
     ,$_POST["vendor_phone"],$_POST["vendor_email"],$_POST["vendor_pass"],$_POST["vendor_cpass"]);
     if($vendor["status"] === "success"){
          echo json_encode($vendor);
     }else{
          echo json_encode($vendor);
     }
}

// login for vendors
if(isset($_POST["vendor_email_login"])){
     $vendor = $vendorApi->login($_POST["vendor_email_login"],$_POST["vendor_pass_login"]);
     if($vendor["status"] === "success"){
          echo json_encode($vendor);
     }else{
          echo json_encode($vendor);
     }
}

// logout for vendors
if(isset($_POST["vendor_logout"])){
      $vendorApi->logout();
}
?>