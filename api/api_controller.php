<?php

include_once"products_api.php";
include_once"users_api.php";
include_once"vendors_api.php";

$productApi = new productApi;
$usersApi = new usersApi;
$vendorApi = new vendorsApi;

if(isset($_FILES["vid"])){
     $product =$productApi->insertProduct("","","",$_FILES["image"],"","","",$_FILES["vid"]);
     echo json_encode($product);
}

/*$product = $productApi->fetchReview(23);

if($product["status"] == "success" )
{
     while($row = $product["data"]->fetch_object()){
          echo $row->review;
     }
}else{
    echo json_encode($product);
}

$vendor = $vendorApi->login("email","sedfrer");

if($vendor["status"] == "success" )
{
     while($row = $vendor["data"]->fetch_object()){
          echo $row->email;
     }
}else{
    echo json_encode($vendor);
}
$user = $usersApi->login("eudj","dhdimx");
if($user["status"] == "success" )
{
     while($row = $vendor["data"]->fetch_object()){
          echo $row->email;
     }
}else{
    echo json_encode($user);
}

*/





?>