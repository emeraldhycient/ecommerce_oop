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
                           $message["data"] = $query->num_rows;
                    }
                    else{
                        $message["status"] = "failed";
                        $message["message"] = "no data found";
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
        $sql = "SELECT id,p_title,productid,preview FROM product WHERE shop_id ='$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               while($row = $query->fetch_object()){
               $message["data"][$row->id] = array(
                   "id" => $row->id,
                   "productid" => $row->productid,
                   "title" => $row->p_title,
                   "preview" => $row->preview
               ) ;
               }
        }else{
            $message["status"] = "failed";
            $message["message"] = "nothing found"; 
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
               $message["data"] = $query->num_rows;
        }
        else{
            $message["status"] = "failed";
            $message["message"] = "no images found";
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
        $sql = "SELECT id,p_title,productid,photo FROM product WHERE shop_id ='$shop_id' ";
        $query = $this->conn->query($sql);
        if($query){
            if($query->num_rows > 0){
               $message["status"] = "success";
               while($row = $query->fetch_object()){
               $message["data"][$row->id] = array(
                   "id" => $row->id,
                   "productid" => $row->productid,
                   "title" => $row->p_title,
                   "photo" => $row->photo
               ) ;
               }
        }else{
            $message["status"] = "failed";
            $message["message"] = "nothing found"; 
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
               $message["data"] = $query->num_rows;
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
            while($row = $query->fetch_object()){
                        $message["data"][$row->id] = array(
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
        }else{
            $message["status"] = "failed";
            $message["message"] = "nothing found";  
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
               $message["data"] = $query->num_rows;
        }else{
            $message["status"] = "failed";
            $message["message"] = "no order found";
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
               while($row = $query->fetch_object()){
               $message["data"][$row->id] = array(
                   "id" => $row->id,
                   "productid" => $row->productid,
                   "productname" => $row->productname,
                   "price" => $row->price,
                   "discount" => $row->discount,
                   "address" => $row->address,
                       "email" =>$row->email,
                           "paid" => $row->paid,
                           	"delivered" => $row->delivered
               );
               }
        }else{
            $message["status"] = "failed";
            $message["message"] = "no orders found";
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
               while($result = $query->fetch_object()){
               $message["data"] = $result->amount;
               }
            }else{
                $message["status"] = "failed";
                $message["message"] = "Wallet is empty";
            }
        }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error;
        }
        return $message;
    }

    public function fetchTotalSales(){
        
    }

    public function sendMessage($message,$user_id,$file){
        $mssg = $this->filter($message);
        $user_id = $this->filter($user_id);
        $maximumUploadSize = 10000000;
        $shop_id = "5f0dc50e12ced";//$_SESSION["shop_id"];
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
                    $sql = "INSERT INTO messages (sender,receiver,chats,files,ext) VALUES ('$shop_id','$user_id','$mssg','$vidName','$ext')";
                    $query = $this->conn->query($sql);
                    if($query){
                        $message["status"] = "success";
                        $message["message"] = "message sent";
                    }else{
                        $message["status"] = "failed video part";
                        $message["message"] = $this->conn->error;
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
                    $sql = "INSERT INTO messages (sender,receiver,chats,files,ext) VALUES ('$shop_id','$user_id','$mssg','$imgName','$ext')";
                    $query = $this->conn->query($sql);
                    if($query){
                        $message["status"] = "success";
                        $message["message"] = "message sent";
                    }else{
                        $message["status"] = "failed img part";
                        $message["message"] = $this->conn->error;
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
        $sql = "INSERT INTO messages (sender,receiver,chats) VALUES ('$shop_id','$user_id','$mssg')";
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
  
public function fetchMessages($user_id){
    $user_id = $this->filter($user_id);
    $shop_id = "5f0dc50e12ced";//$_SESSION["shop_id"];
    $sql = "SELECT * FROM messages WHERE sender='$shop_id' AND receiver='$user_id' OR  sender='$user_id' AND receiver='$shop_id' ORDER BY id DESC";
    $query = $this->conn->query($sql);
    $message = [];
    if($query){
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
        $message["data"] = $$this->conn->error;
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
           $message["TotalMessages"] = $query->num_rows;
    }
    }else{
        $message["status"] = "failed";
        $message["message"] = $this->conn->error;
    }
    return $message;
}


public function fetchAllMessages(){
    $shop_id = "5f0dc50e12ced";//$_SESSION["shop_id"];
    $message = [];
    $sql = "SELECT * FROM messages WHERE sender='$shop_id' OR receiver='$shop_id' ORDER BY id DESC";
    $query = $this->conn->query($sql);
    if($query){
           if($query->num_rows > 0){
               while($row = $query->fetch_object()){
                   $sql ;
                if($row->sender === $shop_id){
                    $sql = "SELECT * FROM users WHERE users_id ='$row->receiver' ";
                    }else{
                     $sql = "SELECT * FROM users WHERE users_id ='$row->sender' ";
                    }
                    $query = $this->conn->query($sql);
                    if($query){
                     if($query->num_rows > 0){
                         while($row2 = $query->fetch_object()){
                             $message["status"] = "success";
                             $message["data"][$row2->id] = array(
                                 "id" => $row2->id,
                                 "username" => $row2->username,
                                 "user_id" => $row2->users_id,
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

public function usersDetails($user_id){
    $user_id = $this->filter($user_id);
    $sql = "SELECT * FROM users WHERE users_id ='$user_id'";
    $query = $this->conn->query($sql);
    $message = [];
    if($query){
        if($query->num_rows > 0){
             while ($row = $query->fetch_object()){
                $message["status"] = "success";
                $message["data"][$row->id] = array(
                    "id" => $row->id,
                    "username" => $row->username,
                    "address" => $row->home_address,
                    "phone" => $row->phone,
                    "email" => $row->email
                );
             }
        }else{
            $message["status"] = "failed";
            $message["data"] = "no user found";
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