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
</head>
<body>
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
                            <input type="submit" name="delete" value="delete product">
                            </form>
</body>
</html>