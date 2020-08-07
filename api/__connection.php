<?php 
session_start();

 class dbConnection {
     protected $conn;

     function __construct()
     {
         $this->connection();
     }
     private function connection(){
         $this->conn = new mysqli("localhost","root","","ecommerce");
         if($this->conn){
            return $this->conn;
         }else{
             return "couldnt connect";
         }
     }
     public function filter($hackvar){
        $hackvar = trim($hackvar);
        $hackvar = stripslashes($hackvar);
        $hackvar = htmlspecialchars($hackvar);
               return $this->conn->real_escape_string($hackvar); 
    }
    public function generatecharacters(){
        $randomCharacters = "gywjsibd234raeiozfd5789052kjnEJHEGSBaHDDHJ4566Kiajnhoi75aqaDZJAJKdf46hsujbkjiuKJ568AKBJBIAN74883uddbhszmzJKFZKJKAZM";
        $genCharacter = substr(str_shuffle($randomCharacters),0,7);
        return $genCharacter;
    }

 }