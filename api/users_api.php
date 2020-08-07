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

    public function sendMessage($message,$shop_id,$file){
        $mssg = $this->filter($message);
        $shop_id = $this->filter($shop_id);
        $maximumUploadSize = 10000000;
        $user_id = "dgwxocam";//$_SESSION["user_id"];
        $message = [];
        if(!empty($file["name"])){
            $genFileName = $this->generatecharacters();
            if( ($file["size"] <= $maximumUploadSize) && ($file["size"] != 0)){
            $ext = pathinfo($file["name"],PATHINFO_EXTENSION);
            if(in_array($ext,['mp4','mpg','mpeg','m4v']) )
            {
                $vidpath ="../assets/products/".$genFileName.".".$ext;
                $vidName = $genFileName.".".$ext;
                if(move_uploaded_file($file["tmp_name"],$vidpath) ){
                    $sql = "INSERT INTO messages (sender,receiver,chats,files,ext) VALUES ('$user_id','$shop_id','$mssg','$vidName','$ext')";
                    $query = $this->conn->query($sql);
                    if($query){
                        $message["status"] = "success";
                        $message["message"] = "message sent";
                    }else{
                        $message["status"] = "failed video part";
                        $message["message"] = "<p>video part</p>".$this->conn->error;
                    }
                }
                else{
                    $message["status"] = "failed";
                    $message["message"] = "unable to save file";
                }

            }elseif(in_array($ext,['gif','png','jpeg','jpg'])){
                $imgPath ="../assets/products/".$genFileName.".".$ext;
                $imgName = $genFileName.".".$ext;
                if(move_uploaded_file($file["tmp_name"],$imgPath) ){
                    $sql = "INSERT INTO messages (sender,receiver,chats,files,ext) VALUES ('$user_id','$shop_id','$mssg','$imgName','$ext')";
                    $query = $this->conn->query($sql);
                    if($query){
                        $message["status"] = "success";
                        $message["message"] = "message sent";
                    }else{
                        $message["status"] = "failed";
                        $message["message"] = "<p>img part</p>".$this->conn->error;
                    }
            }
            else{
                $message["status"] = "failed";
                $message["message"] = "unable to save file";
            }
             }else{
                $message["status"] = "failed";
                $message["message"] = "invalid file format ";
             }
            }else{
                $message["status"] = "failed";
                $message["message"] = "file too large";
            }
        }else{
        $sql = "INSERT INTO messages(sender,receiver,chats) VALUES ('$user_id','$shop_id','$mssg')";
        $query = $this->conn->query($sql);
        if($query){
            $message["status"] = "success";
            $message["message"] = "message sent";
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
    }
    return $message;
}
    public function fetchMessages($shop_id){
        $shop_id = $this->filter($shop_id);
        $user_id = "dgwxocam";//$_SESSION["user_id"];
        $sql = "SELECT * FROM messages WHERE sender='$user_id' AND receiver='$shop_id' OR sender='$shop_id' AND receiver='$user_id' ORDER BY id DESC";
        $query = $this->conn->query($sql);
        $message = [];
        if($query){
            if($query->num_rows > 0){
           $message["status"] = "success";
           while($row = $query->fetch_object()){
           $message["data"][$row->id] = array(
               "sender" => $row->sender,
               "receiver" => $row->receiver,
               "message" => $row->chats,
               "files" => $row->files,
               "ext" => $row->ext,
               "sentOn" => $row->SentOn,
               "receivedOn" => $row->receivedOn
           );
           }
        }else{
            $message["status"] = "failed";
            $message["data"] = "no message found";
        }
        }else{
            $message["status"] = "failed";
            $message["data"] = $this->conn->error;
        }
        return $message;
    }
            
        public function fetchAllMessages(){
            $user_id = "dgwxocam";//$_SESSION["user_id"];
            $message = [];
            $sql = "SELECT * FROM messages WHERE sender='$user_id' OR receiver='$user_id' ORDER BY id DESC";
            $query = $this->conn->query($sql);
            if($query){
                   if($query->num_rows > 0){
                       while($row = $query->fetch_object()){
                           $sql ;
                        if($row->sender === $user_id){
                            $sql = "SELECT * FROM merchant WHERE shop_id ='$row->receiver' ";
                            }else{
                             $sql = "SELECT * FROM merchant WHERE shop_id ='$row->sender' ";
                            }
                            $query = $this->conn->query($sql);
                            if($query){
                             if($query->num_rows > 0){
                                 while($row2 = $query->fetch_object()){
                                     $message["status"] = "success";
                                     $message["data"][$row2->id] = array(
                                         "id" => $row2->id,
                                         "username" => $row2->shopusername,
                                         "shop_id" => $row2->shop_id,
                                         "lastMessage" => $row->chats,
                                         "sentOn" => $row->SentOn
                                     );
                                 }
                             }else{
                                 $message["status"] = "failed";
                                 $message["data"] = "no receipent or sender found";
                             }
                            }else{
                             $message["status"] = "failed";
                             $message["data"] = $this->conn->error;
                            }
                       }
                   }else{
                    $message["status"] = "failed";
                    $message["data"] = "no message found";
                }
            }else{
                $message["status"] = "failed";
                $message["data"] = $this->conn->error;
            }
            return $message;
        }

    public function vendorsDetails($shop_id){
        $shop_id = $this->filter($shop_id);
        $sql = "SELECT * FROM merchant WHERE shop_id ='$shop_id'";
        $query = $this->conn->query($sql);
        $message = [];
        if($query){
            if($query->num_rows > 0){
                 while ($row = $query->fetch_object()){
                    $message["status"] = "success";
                    $message["data"][$row->id] = array(
                        "id" => $row->id,
                        "shop_username" => $row->shopusername,
                        "office_address" => $row->office_address,
                        "phone" => $row->phone,
                        "email" => $row->email
                    );
                 }
            }else{
                $message["status"] = "failed";
                $message["data"] = "no vendor found";
            }
        }else{
            $message["status"] = "failed";
            $message["data"] = $this->conn->error;
        }
        return $message;
    }

    public function logout(){
        session_destroy();
    }


}


?>