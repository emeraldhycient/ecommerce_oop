<?php 
 include_once"__connection.php";

class productApi extends dbConnection{
    
    public function fetchProductForFlashSales(){
    $sql = "SELECT * FROM product LIMIT 3,6";
    $q = $this->conn->query($sql);
    $readData = [];
    if($q){
        if($q->num_rows > 0){
               $readData["status"] = "success";
               $readData["data"] = $q;
        }else{
            $readData["status"] = "failed";
           $readData["message"] = "no data found";
        }
    }else{
         $readData["status"] = "failed";
         $readData["message"] = $this->conn->error;
    }
    return $readData;
    }
    public function fetchRecommendedProducts(){
        $sql = "SELECT * FROM product LIMIT 3,9";
        $q = $this->conn->query($sql);
        $readData = [];
        if($q){
            if($q->num_rows > 0){
                   $readData["status"] = "success";
                   $readData["data"] = $q;
            }else{
                $readData["status"] = "failed";
                $readData["message"] = "no data found";
            }
        }else{
             $readData["status"] = "failed";
             $readData["message"] = $this->conn->error;
        }
        return $readData;
    }
           
    public function fetchLatestProducts(){
        $sql = "SELECT * FROM product LIMIT 7,15";
    $q = $this->conn->query($sql);
    $readData = [];
    if($q){
        if($q->num_rows > 0){
               $readData["status"] = "success";
               $readData["data"] = $q;
        }else{
            $readData["status"] = "failed";
           $readData["message"] = "no data found";
        }
    }else{
         $readData["status"] = "failed";
         $readData["message"] = $this->conn->error;
    }
    return $readData;
    }
    public function singleProduct($id){
        $id = $this->filter($id);
        $q = $this->conn->query("SELECT * FROM product WHERE productid= '$id' ");

        $readData = [];
        if($q){
            if($q->num_rows > 0){
                   $readData["status"] = "success";
                   $readData["data"] = $q;
            }else{
                $readData["status"] = "failed";
               $readData["message"] = "no data found";
            }
        }else{
             $readData["status"] = "failed";
             $readData["message"] = $this->conn->error;
        }
        return $readData;
    }
    public function selectProductCategory($category){
        $category = $this->filter($category);
        $q = $this->conn->query("SELECT * FROM product WHERE cat= '$category' LIMIT 6");

        $readData = [];
        if($q){
            if($q->num_rows > 0){
                   $readData["status"] = "success";
                   $readData["data"] = $q;
            }else{
                $readData["status"] = "failed";
               $readData["message"] = "no data found";
            }
        }else{
             $readData["status"] = "failed";
             $readData["message"] = $this->conn->error;
        }
        return $readData;
    }
    public function generatecharacters(){
        $randomCharacters = "gywjsibd234raeiozfd5789052kjnEJHEGSBaHDDHJ4566Kiajnhoi75aqaDZJAJKdf46hsujbkjiuKJ568AKBJBIAN74883uddbhszmzJKFZKJKAZM";
        $genCharacter = substr(str_shuffle($randomCharacters),0,7);
        return $genCharacter;
    }
    public function insertProduct($title,$longdesc,$price,$img,$quantity,$discount,$category,$video){
        $maximumUploadSize = 1000000;
        $genFileName = $this->generatecharacters();
        $productId = uniqid() ;
        $title = $this->filter($title);
        $longDesc = $this->filter($longdesc);
        $price = $this->filter($price);
        $imgExt = pathinfo($img["name"],PATHINFO_EXTENSION);
        $imgPath ="../assets/products/Img".$genFileName.".".$imgExt;
        $imgName = "Img".$genFileName.".".$imgExt;
        $imgSize = $img["size"];
        $vidExt = pathinfo($video["name"],PATHINFO_EXTENSION);
        $vidPath = "../assets/products/Vid".$genFileName.".".$vidExt;
        $vidSize = $video["size"];
        $vidName = "Vid".$genFileName.".".$vidExt;
        $quantity = $this->filter($quantity);
        $discountByPercent = $this->filter($discount);
        $discount = ($discountByPercent/100)*$price;
        $category = $this->filter($category);
        $shop_id = $_SESSION["shop_id"];
        $message = [];
         if( ($vidSize <= $maximumUploadSize && $imgSize <= $maximumUploadSize) && ($vidSize != 0 && $imgSize != 0)){
             if(in_array($vidExt,['mp4','mpg','mpeg','m4v']) && in_array($imgExt,['gif','png','jpeg','jpg'])){
                 if(move_uploaded_file($img["tmp_name"],$imgPath) && move_uploaded_file($video["tmp_name"],$vidPath) ){
                     $sql = "INSERT INTO product (	productid,p_title,longdesc,shop_id,photo,preview,quantity,price,discount,cat)
                      VALUES ('$productId','$title','$longDesc','$shop_id','$imgName','$vidName','$quantity','$price','$discount','$category')";
                     $q = $this->conn->query($sql);
                     if($q){
                $message["status"] = "success";
                $message["redirect"] = "<script>window.location.href='../views/dashboard.php'</script>";
                     }else{
                        $message["status"] = "failed";
                        $message["message"] = $this->conn->error;
                     }
                 }else{
                    $message["status"] = "failed";
                    $message["message"] = "unable to upload your file to the server"; 
                 }
         }else{
            $message["status"] = "failed";
            $message["message"] = "only upload 'mp4','mpg','mpeg','m4v','gif','png','jpeg','jpg'"; 
         }
         }else{
            $message["status"] = "failed";
            $message["message"] = "<P></P>file size too large.</p><p>current file size,video : ".ceil($vidSize/$maximumUploadSize)."gb
             picture : ".ceil($imgSize/$maximumUploadSize)."gb</p>
            <p>expected file size should be 1gb or lesser</p>
            "; 
         }
         return $message;

    }
    public function deleteProduct($productid){
        $productid = $this->filter($productid);
        $q = $this->conn->query("DELETE FROM product WHERE id= '$productid' ");
        $message = [];
        if($q){
            $message["status"] = "success";
           $message["redirect"] = "<script>location.href='../views/dashboard.php'</script>";
        }else{
               $message["status"] = "failed";
               $message["message"] = $this->conn->error; 
        }
        return $message;
    }
    public function editProduct($title,$longdesc,$price,$img,$quantity,$discount,$category,$video,$productId){
        $maximumUploadSize = 1000000;
        $genFileName = $this->generatecharacters();
        $productId = $productId;
        $title = $this->filter($title);
        $longDesc = $this->filter($longdesc);
        $price = $this->filter($price);
        $quantity = $this->filter($quantity);
        $discount = $this->filter($discount);
        $category = $this->filter($category);
        $shop_id = $_SESSION["shop_id"];
        $message = [];
        if(!empty($video) && !empty($img)){
            $imgExt = pathinfo($img["name"],PATHINFO_EXTENSION);
        $imgPath ="../assets/products/".$genFileName.$imgExt;
        $imgName = $genFileName.".".$imgExt;
        $imgSize = $img["size"];
        $vidExt = pathinfo($video["name"],PATHINFO_EXTENSION);
        $vidPath = "../assets/products/".$genFileName.$vidExt;
        $vidSize = $video["size"];
        $vidName = $genFileName.".".$vidExt;
        if( ($vidSize <= $maximumUploadSize && $imgSize <= $maximumUploadSize) && ($vidSize != 0 && $imgSize != 0)){
            if(in_array($vidExt,['mp4','mpg','mpeg','m4v']) && in_array($imgExt,['gif','png','jpeg','jpg'])){
                if(move_uploaded_file($img["tmp_name"],$imgPath) && move_uploaded_file($video["tmp_name"],$vidPath) ){
                    $sql = "UPDATE product SET id = '$productId',p_title = '$title',longdesc = '$longDesc' ,shop_id = '$shop_id'
                     ,photo = '$imgName' ,preview = '$vidName' ,quantity = '$quantity',price = '$price' ,discount ='$discount' ,cat = '$category' ";
                    $q = $this->conn->query($sql);
                    if($q){
               $message["status"] = "success";
               $message["message"] = "file properties okay and file names are vid:".$vidName."while img:".$imgName;
                    }else{
                       $message["status"] = "failed";
                       $message["message"] = $this->conn->error;
                    }
                }else{
                   $message["status"] = "failed";
                   $message["message"] = "unable to upload your file to the server"; 
                }
        }else{
           $message["status"] = "failed";
           $message["message"] = "only upload 'mp4','mpg','mpeg','m4v','gif','png','jpeg','jpg'"; 
        }
        }else{
            $message["status"] = "failed";
            $message["message"] = "<P></P>file size too large.</p><p>current file size,video : ".ceil($vidSize/$maximumUploadSize)."gb
             picture : ".ceil($imgSize/$maximumUploadSize)."gb</p>
            <p>expected file size should be 1gb or lesser</p>
            "; 
        }
        }else{
            $sql = "UPDATE product SET id = '$productId',p_title = '$title',longdesc = '$longDesc' ,shop_id = '$shop_id'
                     ,quantity = '$quantity',price = '$price' ,discount ='$discount' ,cat = '$category' ";
                    $q = $this->conn->query($sql);
            if($q){
       $message["status"] = "success";
       $message["message"] = "UPDATED SUCCESSFULLY";
            }else{
               $message["status"] = "failed";
               $message["message"] = $this->conn->error;
            }
        }
         
         return $message;

    }

    public function submitProductReview($productid,$review,$reviewer){
        $productid = $this->filter($productid);
        $review =  $this->filter($review);
        $reviewer =  $this->filter($reviewer);
        $message = [];
        $sql = "INSERT INTO reviews(productid,review,reviewer) VALUES ('$productid','$review','$reviewer')";
        $q = $this->conn->query($sql);
         if($q){
            $message["status"] = "success";
            $message["message"] = "review submitted successfully"; 
         }else{
            $message["status"] = "failed";
            $message["message"] = $this->conn->error; 
         }
         return $message;
        
    }
    public function fetchReview($productid){
        $productid = $this->filter($productid);
        $q = $this->conn->query("SELECT * FROM reviews WHERE productid ='$productid'");
        $readData = [];
        if($q){
            if($q->num_rows > 0){
                   $readData["status"] = "success";
                   $readData["data"] = $q;
            }else{
                $readData["status"] = "failed";
                $readData["message"] = "no data found";
            }
        }else{
             $readData["status"] = "failed";
             $readData["message"] = $this->conn->error;
        }
        return $readData;
    }

}