<?php




require_once '../connect.php';
require_once 'utils.php';

if (isset($_POST['delete'])) {
  $id =  $_POST['subjects'];
    try {
        $conn->begin_transaction();
        $sql = "DELETE FROM product WHERE id = $id";
        $conn->query($sql);
        $conn->commit();
      
    } catch (Exception $e) {
        echo $e->getMessage();
        $conn->rollback();
    }
}
$lst_std_subject_selected = [];
$products_display = [];
try {
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $products_display = $result->fetch_all(MYSQLI_ASSOC);
    }
} catch (Exception $e) {
    $errors[] = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>  
  <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        />
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      padding: 20px;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      font-weight: bold;
    }

    .form-group {
      margin-bottom: 10px;
    }

    .mb-2 {
      margin-bottom: 20px;
      display: flex;
      flex-wrap: wrap;
    }

    .checkbox {
      margin-bottom: 10px;
      width: 230px;
    }

    .checkbox img {
      width: 169px;
    height: 120px;
    margin-right: 10px;
    object-fit: cover;
    }
    .checkbox span{
      margin-left: 46px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      width: 115px;
    height: 43px;
    display: flex;
    justify-content: center;
    margin-top: 38px;
    margin-left: 50px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
    
  a .fa-arrow-left{
    width: 67px;
    text-align: center;
    font-size: 1.5rem;
    margin: 1rem;
    /* border: 1px solid black; */
    border-radius: 5px;
    color: white;
    background: #0d6efd;
    height: 35px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
form h1{
  text-align: center;
}
  </style>
</head>
<body>
  <a href="../qladmin.php"><i class="fas fa-arrow-left"></i></a>
  <form action="" method="post" enctype="multipart/form-data">
  <h1>list products</h1>
    <div class="form-group mb-2">
      
      <?php foreach($products_display as $subject) : ?>
        <div class="checkbox">
          <input <?php 
            foreach($lst_std_subject_selected as $key => $subject_selected) {
              if($subject_selected["id"] == $subject['id']) {
                echo 'checked';
              }
            }
          ?> type="checkbox" name="subjects" value="<?php echo $subject['id'] ?>" />
          <img src="./uploads/<?php echo $subject['img'] ?>" alt="" />
          <span><?php echo $subject['name'] ?></span>
          
        </div>
      <?php endforeach; ?>
      <input type="submit" name="delete" value="delete product">
    </div>
  </form>
</body>
</html>