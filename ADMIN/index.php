<?php
require_once '../connect.php';
if (isset($_POST['addprd'])) {
    $name = $_POST['product'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $quantity	= $_POST['quantity'];
    $price = $_POST['price'];
    $image = time() . '_' . $image;

    try {
        $conn->begin_transaction();
        $sql = "insert into product(name,img,quantity,price) values('$name','$image', '$quantity','$price')";
        $result = $conn->query($sql);
        move_uploaded_file($image_tmp, 'uploads/' . $image);

        $conn->commit();
        header('Location:index.php');
    } catch (Exception $e) {
        echo $e->getMessage();
        $conn->rollback();
    }
}

$sql = "SELECT * FROM product";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $lst_st = $res->fetch_all(MYSQLI_ASSOC);
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
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add Product</h5>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form">
                        <label for="">Ten san pham: </label>
                        <input type="text" name="product" placeholder="Ten san pham" class="form-control mb-2">
                    </div>
                    <div class="form">
                        <label for="">Gia san pham: </label>
                        <input type="number" name="price" placeholder="Gia san pham" class="form-control mb-2">
                    </div>
                    <div class="form">
                        <label for="">Số lượng: </label>
                        <input type="number" name="quantity" placeholder="Nhập số lượng" class="form-control mb-2">
                    </div>
                    <div class="form">
                        <label for="">Anh san pham: </label>
                        <input type="file" name="image" placeholder="Anh san pham" class="form-control mb-2">
                    </div>
                    </div>
                    <div class="form">
                        <input type="submit" name="addprd" value="Add Product" class="form-control mb-2 btn btn-warning">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>