<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "juice";
$conn = new mysqli($servername,$username,$password);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
try{
    $sql = "CREATE DATABASE IF NOT EXISTS $database";
    $conn->query($sql);

    $conn->select_db($database);

    $sql = "CREATE table if not exists user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username varchar(100),
    password varchar(100),
    email varchar(100),
    isAdmin varchar(10),
    phone VARCHAR(10),
    address nvarchar(100)
      )";
    $conn->query($sql);
    $res = $conn->query($sql);

    $sql="CREATE table if not exists `cate`(
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `name` varchar(100)
      )";
      $conn->query($sql);
      $res = $conn->query($sql);
       
    $sql = "CREATE table if not exists `product` (
      `id` int  primary key AUTO_INCREMENT,
      `name` varchar(100),
      `img` varchar(100),
      `quantity` int,
      `cateId` int,
      `price` float,
      FOREIGN KEY (`cateId`) REFERENCES `cate`(`id`)
    )";

    $conn->query($sql);
    $res = $conn->query($sql);

   
    $sql = "CREATE table if not exists `cart` (
      `id` int  primary key AUTO_INCREMENT ,
      productId int,
     `userId` int,
      `quantity` int,
      FOREIGN KEY (`userId`) REFERENCES `user`(`id`),
     FOREIGN KEY (`productId`) REFERENCES `product`(`id`)

    )";
   
  
    $conn->query($sql);
    $res = $conn->query($sql);
    
    $sql = "CREATE TABLE IF NOT EXISTS `order` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `userId` INT,
      `productId` INT ,
      `totalPrice` FLOAT,
      `quantity` INT,
      `status` INT,
      FOREIGN KEY (`productId`) REFERENCES `product`(`id`)
    );";
       
  
       $conn->query($sql);
       $res = $conn->query($sql);

    
    $sql="CREATE TABLE IF NOT EXISTS `orderDetail` (
      `orderId` INT  AUTO_INCREMENT,
      `productId` INT,
      `quantity` INT,
      `totalPrice` FLOAT,
      FOREIGN KEY (`orderId`) REFERENCES `order`(`id`),
      FOREIGN KEY (`productId`) REFERENCES `product`(`id`)
    )";
       
  
       $conn->query($sql);
       $res = $conn->query($sql);



       $sql = "CREATE TABLE IF NOT EXISTS `contact` (
        `id` INT(11) NOT NULL AUTO_INCREMENT primary key,
        `userId` int,
        `username` VARCHAR(100) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `message` TEXT NOT NULL,
        FOREIGN KEY (`userId`) REFERENCES `user`(`id`)
        
      )" ;

      $conn->query($sql);
      $res = $conn->query($sql);
      
   
    $sql ="CREATE TABLE IF NOT EXISTS `FeedBack` (
      `id` INT  AUTO_INCREMENT primary key ,
      `userId` INT,
      `content` VARCHAR(100),
      `rating` INT,
      `productId` INT,
      FOREIGN KEY (`userId`) REFERENCES `user`(`id`),
      FOREIGN KEY (`productId`) REFERENCES `product`(`id`)
    )";
       
  
       $conn->query($sql);
       $res = $conn->query($sql);



    $conn->query($sql);
    $res = $conn->query($sql);

    
}catch(Exception $e){
    echo "Error creating database: " . $e->getMessage();
}







