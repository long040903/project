<?php
require_once '../connect.php';

$errors = array();

if (isset($_POST['addprd'])) {
    $name = $_POST['product'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image = time() . '_' . $image;
    $cateid_id = $_POST['cate'];

    if (empty($name)) {
        $errors['product'] = 'Product name is required!';
    }

    if (empty($image)) {
        $errors['image'] = 'Image is required!';
    } else {

        $allowed_extensions = array('jpg', 'jpeg', 'png','webp');
        $image_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));

        if (!in_array($image_extension, $allowed_extensions)) {
            $errors['image'] = 'Invalid image file type! Only JPG, JPEG, and PNG are allowed.';
        }

        $max_file_size = 2 * 1024 * 1024; // 2MB
        if ($_FILES['image']['size'] > $max_file_size) {
            $errors['image'] = 'Image file size exceeds the limit (2MB).';
        }
    }

    if (empty($errors)) {
        try {
            $conn->begin_transaction();
            $sql = "INSERT INTO product (name, img, quantity, cateId, price) VALUES ('$name', '$image', '$quantity', '$cateid_id', '$price')";
            $result = $conn->query($sql);
            move_uploaded_file($image_tmp, 'uploads/' . $image);

            $conn->commit();
            $success_message = "Thêm sản phẩm thành công";
        } catch (Exception $e) {
            echo $e->getMessage();
            $conn->rollback();
            $error_message = "Thêm sản phẩm thất bại";
        }
    }
}

$sql = "SELECT * FROM product";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $list_product = $res->fetch_all(MYSQLI_ASSOC);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
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
  <a href="../list_products.php"><i class="fas fa-arrow-left"></i></a>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 style="text-align:center;" class="mb-0">Add Product</h5>
            </div>
            <div class="card-body">
                <?php if (isset($error_message)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($success_message)) : ?>
                <div class="alert alert-success">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form">
                    <label for="">Name product: </label>
                    <input type="text" name="product" placeholder="Name product" class="form-control mb-2">
                    <?php if (isset($errors['product'])) : ?>
                        <div class="text-danger">
                            <?php echo $errors['product']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form">
                    <label for="">Price: </label>
                    <input type="number" name="price" placeholder="Price" class="form-control mb-2">
                </div>
                <div class="form">
                    <label for="">Quantity: </label>
                    <input type="number" name="quantity" placeholder="Quantity" class="form-control mb-2">
                </div>
                <div class="form">
                    <label for="">Image: </label>
                    <input type="file" name="image" placeholder="Image" class="form-control mb-2">
                    <?php if (isset($errors['image'])) : ?>
                        <div class="text-danger">
                            <?php echo $errors['image']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form">
                    <label for="">Category products: </label>
                    <select name="cate" class="form-control mb-2">
                        <?php
                        foreach ($lst_cate as $cl) {
                            echo "<option value='{$cl['id']}'>{$cl['name']}</option>";
                        }
                        ?>
                    </select>
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
