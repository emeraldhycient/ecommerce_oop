<?php

include_once"__connection.php";

class vendorsApi extends dbConnection{

    public function createAccount($shopUsername,$address,$phone,$email,$password1,$password2){
        $message = [];
        $id = uniqid();
        $shopUsername = $this->filter($shopUsername);
        $address = $this->filter($address);
        $phone = $this->filter($phone);
        $email = $this->filter($email);
        $password1 = $this->filter($password1);
        $password2 = $this->filter($password2);
        if($password1 === $password2){
            $password = password_hash($password1,PASSWORD_BCRYPT);
        $sql = "INSERT INTO merchant (shop_id,shopusername,office_address,phone,email,pass) VALUES ('$id','$shopUsername',
        '$address','$phone','$email','$password') ";
        $q = $this->conn->query($sql);
        if($q){
            $_SESSION["shop_id"] = $id;
               $message["status"] = "success";
               $message["redirect"] = "./dashboard.php";
            }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = "passwords doesnt match";
        }
        return $message;
    }
    public function login($shopEmail,$password){
        $message = [];
        $shopEmail = $this->filter($shopEmail);
        $password = $this->filter($password);
        $sql = "SELECT * FROM merchant WHERE email='$shopEmail'";
        $q = $this->conn->query($sql);
        if($q){
            if($q->num_rows > 0){
             $row =$q->fetch_object();
             if(password_verify($password,$row->pass)){
             $_SESSION["shop_id"] = $row->shop_id;
             $message["status"] = "success";
             $message["redirect"] = "./dashboard.php";
            }else{
                $message["status"] = "failed";
                $message["message"] = "invalid login credentials";  
             }
            }else{
                $message["status"] = "failed";
                $message["message"] = "invalid login credentials";   
            }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }
    public function fetchTotalVideos(){
                    $shop_id = $_SESSION["shop_id"];
                    $message = [];
                    $sql = "SELECT preview FROM product WHERE shop_id ='$shop_id' ";
                    $query = $this->conn->query($sql);
                    if($query){
                        if($query->num_rows > 0){
                           $message["status"] = "success";
                           $message["totalVideo"] = $query->num_rows;
                    }
                    }else{
                        $message["status"] = "failed";
                        $message["message"] = $this->conn->error;
                    }
                    return $message;
    }

    public function fetchAllVideos(){
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        $sql = "SELECT preview FROM product WHERE shop_id ='$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               $message["Allvideo"] = $query;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
}

    public function fetchTotalImages(){
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        $sql = "SELECT photo FROM product WHERE shop_id ='$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               $message["totalVideo"] = $query->num_rows;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }
    public function fetchAllImages(){
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        $sql = "SELECT photo FROM product WHERE shop_id ='$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               $message["allImages"] = $query;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }
    public function fetchTotalProducts(){
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        $sql = "SELECT productid FROM product WHERE shop_id ='$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               $message["totalVideo"] = $query->num_rows;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }
    public function fetchAllProducts(){
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        $sql = "SELECT * FROM product WHERE shop_id ='$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               $message["allProduct"] = $query;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }
    public function fetchTotalOrders(){
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        $sql = "SELECT productid FROM orders WHERE shop_id ='$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               $message["totalvideo"] = $query->num_rows;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }
    public function fetchAllOrders(){
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        $sql = "SELECT * FROM orders WHERE shop_id ='$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               $message["totalvideo"] = $query;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }
    public function fetchTotalMessages(){
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        $sql = "SELECT chats FROM messages WHERE sender ='$shop_id' OR receiver = '$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               $message["totalvideo"] = $query->num_rows;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }
    
    public function fetchAllMessages(){
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        $sql = "SELECT * FROM messages WHERE sender ='$shop_id' OR receiver = '$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               $message["totalvideo"] = $query;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }

    public function fetchTotalFund(){
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        $sql = "SELECT * FROM wallet WHERE userId ='$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               $result = $query->fetch_object();
               $message["totalvideo"] = $result->amount;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }

    public function fetchAllFund(){
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        $sql = "SELECT * FROM wallet WHERE userId ='$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               $message["totalvideo"] = $query;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }

    public function fetchTotalSales(){
        
    }
    public function logout(){
        session_destroy();
    }


}


?>