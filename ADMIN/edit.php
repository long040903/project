
<?php
require_once '../connect.php';
require_once 'utils.php';


$errors = [];
$lst_std_subject_selected = [];

if (isset($_POST['updateprd'])) {
    $name = $_POST['product'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image = time() . '_' . $image;
    $id =  $_POST['all_prd'];
    $cateid_id = $_POST['cate'];


    if (empty($name)) {
        $errors[] = 'name product not empty!';
    }

    if (empty($image)) {
        $errors[] = 'image product not empty!';
    }

    if (empty($quantity)) {
        $errors[] = 'quantity product not empty!';
    }

    if (empty($price)) {
        $errors[] = 'price product not empty!';
    }

    if (count($errors) === 0) {


        try {
            $conn->begin_transaction();
            move_uploaded_file($image_tmp, 'uploads/'.$image);
            $sql = "UPDATE product SET name = '$name', img = '$image', quantity = '$quantity',cateId='$cateid_id', price = '$price'  WHERE id = '$id'";
            $res = $conn->query($sql);
            
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            $errors[] = $e->getMessage();
        }
    }
}

// get all products
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
$sql = "SELECT * FROM cate";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $lst_cate = $res->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
 <!-- Font Awesome -->
 <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        />
  </head>
  <style>
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
  </style>

<body>
  <a href="../qladmin.php"><i class="fas fa-arrow-left"></i></a>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add Product</h5>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group mb-2">
                           <div class="form">
                        <label for=""> product: </label>
                        <select name="all_prd" class="form-control mb-2">
                                    <?php
                                    foreach ($products_display as $prd) {
                                      
                                        echo "<option value='{$prd['id']}'>{$prd['name']}</option>";
                                    }
                                    ?>
                                </select>
         
                    </div>
                        </div>
                     
                            <a href="index.php" class="btn btn-primary">add product</a>
                        </div>
                        <a class="btn btn-primary" href="addnewcl.php" id="themsanpham">Add Collection</a>
                    </div>
                    <div class="form">
                        <label for="">name product: </label>
                        <input type="text" name="product" placeholder="name product" class="form-control mb-2">
                    </div>
                    <div class="form">
                        <label for="">price: </label>
                        <input type="number" name="price" placeholder="price" class="form-control mb-2">
                    </div>
                    <div class="form">
                        <label for="">quantity: </label>
                        <input type="number" name="quantity" placeholder=" quantity" class="form-control mb-2">
                    </div>
                    <div class="form">
                        <label for="">image: </label>
                        <input type="file" name="image" placeholder="image" class="form-control mb-2">
                    </div>
               
                    <div class="form">
                                <label for="">category products: </label>
                                <select name="cate" class="form-control mb-2">
                                    <?php
                                    foreach ($lst_cate as $cl) {
                                      
                                        echo "<option value='{$cl['id']}'>{$cl['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                    </div> 
                    <div class="form">
                        <input type="submit" name="updateprd" value="Update Product" class="form-control mb-2 btn btn-warning">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>