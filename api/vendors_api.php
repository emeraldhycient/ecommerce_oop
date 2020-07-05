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
        $sql = "INSERT INTO merchants (shop_id,shopusername,office_address,phone,email,pass) VALUES (?,?,?,?,?,?) ";
        $q = $this->conn->prepare($sql);
        $q->bind_param("ssssss",$id,$shopUsername,
        $address,$phone,$email,$password);
        $q->execute();
        if($q){
            $_SESSION["shop_id"] = $id;
               $message["status"] = "success";
               $message["redirect"] = "<script>location.href='../views/dashboard.php'</script>";
            }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = "passwords doesnt match";
        }
        return $message;
        $q->close();
    }
    public function login($shopEmail,$password){
        $message = [];
        $shopEmail = $this->filter($shopEmail);
        $password = $this->filter($password);
        $sql = "SELECT * FROM merchants WHERE email=?";
        $q = $this->conn->prepare($sql);
        $q->bind_param("s",$shopEmail);
        $q->execute();
        $result =$q->get_result();
        if($q){
            if($result->num_rows > 0){
             $row =$result->fetch_object();
             if(password_verify($password,$row->pass)){
             $_SESSION["shop_id"] = $row->shop_id;
             $message["status"] = "success";
             $message["redirect"] = "<script>location.href='../views/dashboard.php'</script>";
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
        $q->close();
    }


}


?>