<?php 
 include_once"connection.php";

class productApi extends dbConnection{
    
    public function fetchProductForFlashSales(){
    $sql = "SELECT * FROM product LIMIT 3,12";
    $q = $this->conn->prepare($sql);
    $q->execute();
    $result =$q->get_result();
    $readData = [];
    if($q){
        if($result->num_rows > 0){
               $readData["status"] = "successful";
               $readData["data"] = $result;
        }else{
            $readData["status"] = "failed";
           $readData["message"] = "no data found";
        }
    }else{
         $readData["status"] = "failed";
         $readData["error"] = $this->conn->error;
    }
    return $readData;
    $q->close();
    }
    public function fetchRecommendedProducts(){
        $sql = "SELECT * FROM product LIMIT 3,9";
        $q = $this->conn->prepare($sql);
        $q->execute();
        $result = $q->get_result();
        $readData = [];
        if($q){
            if($result->num_rows > 0){
                   $readData["status"] = "success";
                   $readData["data"] = $result;
            }else{
                $readData["status"] = "failed";
                $readData["message"] = "no data found";
            }
        }else{
             $readData["status"] = "failed";
             $readData["error"] = $this->conn->error;
        }
        return $readData;
        $q->close();
    }
           
    public function fetchLatestProducts(){
        $sql = "SELECT * FROM product LIMIT 4,9";
        $q = $this->conn->prepare($sql);
        $q->execute();
        $result = $q->get_result();
        $readData = [];
        if($q){
            if($result->num_rows > 0){
                   $readData["status"] = "successful";
                   $readData["data"] = $result;
            }else{
                $readData["status"] = "failed";
                $readData["message"] = "no data found";
            }
        }else{
             $readData["status"] = "failed";
             $readData["error"] = $this->conn->error;
        }
        return $readData;
        $q->close();
    }
    public function singleProduct($id){
        $id = $this->filter($id);
        $q = $this->conn->prepare("SELECT * FROM product WHERE id= ? ");
        $q->bind_param("s",$id);
        $q->execute();
        $result = $q->get_result();
        $readData = [];
        if($q){
            if($result->num_rows > 0){
                   $readData["status"] = "successful";
                   $readData["data"] = $result;
            }else{
                $readData["status"] = "failed";
               $readData["message"] = "no data found";
            }
        }else{
             $readData["status"] = "failed";
             $readData["error"] = $this->conn->error;
        }
        return $readData;
        $q->close();
    }
    public function insertProduct($title,$shortdes,$longdes,$price,$img,$quantity,$discount,$cat){
        $shopId ="" ;
        $title = "";
        $shortDesc = "";
        $longDesc = "";
        $price = "";
        $img = "";
        $quantity = "";
        $discount = "";
        $cat = "";
         



    }
    public function deleteProduct($productid){
        $productid = $this->filter($productid);
        $q = $this->conn->prepare("DELETE FROM product WHERE id= ? ");
        $q->bind_param("s",$productid);
        $q->execute;
        $message = [];
        if($q){
            $message["status"] = "success";
           $message["redirect"] = "<script>location.href='../views/dashboard.php'</script>";
        }else{
               $message["status"] = "failed";
               $message["error"] = $this->conn->error; 
        }
        $q->close();
    }
    public function editProduct(){
        
    }

    public function submitProductReview($productid,$review,$reviewer){
        $productid = $this->filter($productid);
        $review =  $this->filter($review);
        $reviewer =  $this->filter($reviewer);
        
    }
    public function fetchReview($productid){
        $productid = $this->filter($productid);
        $q = $this->conn->prepare("SELECT * FROM reviews WHERE productid =?");
        $q->bind_param("s",$productid);
        $q->execute();
        $result = $q->get_result();
        $readData = [];
        if($q){
            if($result->num_rows > 0){
                   $readData["status"] = "success";
                   $readData["data"] = $result;
            }else{
                $readData["status"] = "failed";
                $readData["message"] = "no data found";
            }
        }else{
             $readData["status"] = "failed";
             $readData["error"] = $this->conn->error;
        }
        return $readData;
        $q->close();
    }

}


