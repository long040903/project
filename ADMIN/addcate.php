<?php
require_once '../connect.php';
if (isset($_POST['name'])) {
    $name_category = $_POST['name'];

    $sql = "INSERT INTO cate(name) VALUES ('$name_category')";
    $res = $conn->query($sql);
    if ($res) {
        echo "add successfully";
    }
}

$sql = "SELECT * FROM cate";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $list_category = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $list_category = [];
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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
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
    <a href="../list_categorys.php"><i class="fas fa-arrow-left"></i></a>
            <div class="col-auto col-md-10" style="margin-left: 10%;">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Add new Category</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="text" name="name" placeholder="name cate" class="form-control mb-2">
                            <button class="btn btn-primary mb-2">Add Category</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">List Category</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-reponsive">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>add</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($list_category as $category) :
                                    $i++;
                                
                                ?>
                                    <tr>
                                      
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $category['name'] ?></td>
                                        <td>
                                            <a  href="deletecate.php?id=<?php echo $category['id']; ?>" class="btn btn-danger" id="btn-xoa">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        document.querySelectorAll('#btn-xoa').forEach(function(elm, index) {
            elm.addEventListener('click', function(e) {
                console.log(e);
                e.preventDefault();
                let url = e.target.href;
                let isDelete = confirm('do you want to delete this?');
                if (isDelete === true) {
                    window.location.href = url;
                }
            });
        })
    </script>
</body>

</html>