<?php

include_once"__connection.php";

class usersApi extends dbConnection{

    public function createAccount($userEmail,$address,$phone,$email,$password1,$password2,$lastname,$firstname){
        $message = [];
        $id = uniqid();
        $firstname = $this->filter($firstname);
        $lastname = $this->filter($lastname);
        $userEmail = $this->filter($userEmail);
        $address = $this->filter($address);
        $phone = $this->filter($phone);
        $email = $this->filter($email);
        $password1 = $this->filter($password1);
        $password2 = $this->filter($password2);
        if($password1 === $password2){
            $password = password_hash($password1,PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (users_id,username,email,pass,home_address,phone,firstname,lastname) VALUES ('$id','$userEmail',
        '$email','$password','$address','$phone','$firstname','$lastname') ";
        $q = $this->conn->query($sql);
        if($q){
            $_SESSION["user_id"] = $id;
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
    public function login($userEmail,$password){
        $message = [];
        $userEmail = $this->filter($userEmail);
        $password = $this->filter($password);
        $sql = "SELECT * FROM users WHERE email='$userEmail'";
        $q = $this->conn->query($sql);
        if($q){
            if($q->num_rows > 0){
             $row =$q->fetch_object();
             if(password_verify($password,$row->pass)){
                $_SESSION["user_id"]  = $row->shop_id;
             $message["status"] = "success";
             $message["redirect"] = "./settings.php";
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

    public function logout(){
        session_destroy();
    }


}


?>