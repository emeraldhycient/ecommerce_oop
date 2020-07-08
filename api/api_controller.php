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



if(isset($_POST["submitpost"])){
    $product = $productApi->insertProduct($_POST["title"],$_POST["longdesc"],$_POST["price"],$_FILES["photo"],$_POST["quantity"]
     ,$_POST["discount"],$_POST["category"],$_FILES["video"]);
     if($product['status'] === 'success'){
              echo $product['redirect'];
     }else{
                  echo $product["message"];
     }
}elseif($_POST["vendor_username"]){
     $vendor = $vendorApi->createAccount($_POST["vendor_username"],$_POST["vendor_address"]
     ,$_POST["vendor_phone"],$_POST["vendor_email"],$_POST["vendor_pass"],$_POST["vendor_cpass"]);
     if($vendor["status"] === "success"){
           echo json_encode($vendor);
     }else{
          echo json_encode($vendor);
     }
}

?>