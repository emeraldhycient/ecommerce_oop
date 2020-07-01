<?php 
 include_once"connection.php";

class productApi extends dbConnection{
    
    public function fetchProductForFlashSales(){
    $sql = "SELECT * FROM product LIMIT 3,12";
    $q = $this->conn->query($sql);
    $readData = [];
    if($q){
        if($q->num_rows > 0){
               $readData["message"] = "successful";
               $readData["data"] = $q;
        }else{
           $readData["message"] = "no data found";
        }
    }else{
         $readData["message"] = "failed";
         $readData["error"] = $this->conn->error;
    }
    return $readData;
    }
    public function fetchRecommendedProducts(){
        $sql = "SELECT * FROM product LIMIT 3,9";
        $q = $this->conn->query($sql);
        $readData = [];
        if($q){
            if($q->num_rows > 0){
                   $readData["message"] = "successful";
                   $readData["data"] = $q;
            }else{
               $readData["message"] = "no data found";
            }
        }else{
             $readData["message"] = "failed";
             $readData["error"] = $this->conn->error;
        }
        return $readData;
    }
           
    public function fetchLatestProducts(){
        $sql = "SELECT * FROM product LIMIT 4,9";
        $q = $this->conn->query($sql);
        $readData = [];
        if($q){
            if($q->num_rows > 0){
                   $readData["message"] = "successful";
                   $readData["data"] = $q;
            }else{
               $readData["message"] = "no data found";
            }
        }else{
             $readData["message"] = "failed";
             $readData["error"] = $this->conn->error;
        }
        return $readData;
    }
    public function singleProduct($id){
        $sql = "SELECT * FROM product WHERE id='$id'";
        $q = $this->conn->query($sql);
        $readData = [];
        if($q){
            if($q->num_rows > 0){
                   $readData["message"] = "successful";
                   $readData["data"] = $q;
            }else{
               $readData["message"] = "no data found";
            }
        }else{
             $readData["message"] = "failed";
             $readData["error"] = $this->conn->error;
        }
        return $readData;
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
        $sql = "DELETE FROM product WHERE id='$productid' ";
        $q = $this->conn->query($sql);
        $message = [];
        if($q){
           $message["redirect"] = "<script>location.href='../views/dashboard.php'</script>";
        }else{
               $message["error_message"] = "query could not be excuted";
               $message["error"] = $this->conn->error; 
        }
    }
    public function editProduct(){
        
    }

    public function submitProductReview($productid,$review,$reviewer){
        
    }
    public function fetchReview($productid){
        $productid = $this->filter($productid);
        $sql = "SELECT * FROM reviews WHERE productid='$productid'";
        $q = $this->conn->query($sql);
        $readData = [];
        if($q){
            if($q->num_rows > 0){
                   $readData["message"] = "successful";
                   $readData["data"] = $q;
            }else{
               $readData["message"] = "no data found";
            }
        }else{
             $readData["message"] = "failed";
             $readData["error"] = $this->conn->error;
        }
        return $readData;
    }

}


