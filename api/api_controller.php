<?php

include_once"products_api.php";
include_once"users_api.php";
include_once"vendors_api.php";

$productApi = new productApi;
$usersApi = new usersApi;
$vendorApi = new vendorsApi;

$product = $productApi->fetchReview(23);

if($product["status"] == "success" )
{
     while($row = $product["data"]->fetch_object()){
          echo $row->review;
     }
}else{
    echo json_encode($product);
}









?>