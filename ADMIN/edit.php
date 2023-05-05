
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
    $id =  $_POST['subjects'];

    if (empty($name)) {
        $errors[] = 'Tên sản phẩm không được để trống';
    }

    if (empty($image)) {
        $errors[] = 'Ảnh sản phẩm không được để trống';
    }

    if (empty($quantity)) {
        $errors[] = 'Số lượng sản phẩm không được để trống';
    }

    if (empty($price)) {
        $errors[] = 'Giá sản phẩm không được để trống';
    }

    if (count($errors) === 0) {


        try {
            $conn->begin_transaction();
            move_uploaded_file($image_tmp, 'uploads/'.$image);
            $sql = "UPDATE product SET name = '$name', img = '$image', quantity = '$quantity', price = '$price' WHERE id = '$id'";
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

?>

<!DOCTYPE html>
<html lang="en">1

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
                <div class="form-group mb-2">
                            <label>Mon hoc</label>
                            <?php
                            foreach($products_display as $subject) : 
                            ?>
                                <input <?php 
                                        foreach($lst_std_subject_selected as $key => $subject_selected) {
                                            if($subject_selected["id"] == $subject['id']) {
                                                echo 'checked';
                                            }
                                        }
                                ?> type="checkbox" name="subjects" value="<?php echo $subject['id'] ?>" /> <?php echo $subject['name'] ?>
                            <?php
                            endforeach;
                            ?>
                            <a href="addnewsj.php" class="btn btn-primary">Them mon</a>
                        </div>
                            ?>
                            <a href="index.php" class="btn btn-primary">Them san pham</a>
                        </div>
                        <a class="btn btn-primary" href="addnewcl.php" id="themsanpham">Add Collection</a>
                    </div>
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
                        <input type="submit" name="updateprd" value="Update Product" class="form-control mb-2 btn btn-warning">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>