<?php
if(isset($_SERVER['REMOTE_ADDR']) AND ( $_SERVER['REMOTE_ADDR'] !== $_SERVER['SERVER_ADDR'] )){
     $this->output->set_status_header(400, 'No Remote Access Allowed');
      die(' Access Denied, Your IP: ' . $_SERVER['REMOTE_ADDR'] );
      exit;
     }

include_once"products_api.php";
include_once"users_api.php";
include_once"vendors_api.php";

$productApi = new productApi;
$usersApi = new usersApi;
$vendorApi = new vendorsApi;



?>