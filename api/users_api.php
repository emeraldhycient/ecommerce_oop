<?php

include_once"__connection.php";

class usersApi extends dbConnection{

    public function createAccount($shopUsername,$address,$phone,$email,$password1,$password2,$firstName,$lastName){
        $message = [];
        $id = uniqid();
        $shopUsername = $this->filter($shopUsername);
        $address = $this->filter($address);
        $phone = $this->filter($phone);
        $email = $this->filter($email);
        $password1 = $this->filter($password1);
        $password2 = $this->filter($password2);
        $firstName = $this->filter($firstName);
        $lastName = $this->filter($lastName);
        if($password1 === $password2){
            $password = password_hash($password1,PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (id,username,email,pass,personal_address,phone,firstname,lastname) VALUES (?,?,?,?,?,?,?,?) ";
        $q = $this->conn->prepare($sql);
        $q->bind_param("ssssssss",$id,$shopUsername,$email,$password,$address,$phone,$firstName,$lastName);
        $q->execute();
        if($q){
            $_SESSION["user_id"] = $id;
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
        $shopEmail= $this->filter($shopEmail);
        $password = $this->filter($password);
        $sql = "SELECT * FROM users WHERE email= ? ";
        $q = $this->conn->prepare($sql);
        $q->bind_param("s",$shopEmail);
        $q->execute();
        $result = $q->get_result();
        if($q){
            if($result->num_rows > 0){
             $row =$result->fetch_object();
             if(password_verify($password,$row->pass)){
             $_SESSION["user_id"] = $row->id;
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