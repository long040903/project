<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/homeADMIN.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="boxcenter">
        <div class="row mb menu">
            <ul>
                <li><i class="fas fa-home"></i><a href="#">home</a></li>
                <li><i class="fa-solid fa-list"></i><a href="#">Danh mục</a></li>
                <li><i class="fa-solid fa-cart-shopping"></i><a href="#">Hàng hóa</a></li>
                <li><i class="fa-solid fa-person"></i><a href="#">Khách hàng</a></li>
                <li><i class="fa-solid fa-comments"></i><a href="#">Bình luận</a></li>
                <li><i class="fa-solid fa-chart-simple"></i><a href="#">Thống kê</a></li>
            </ul>
        </div>
            <div class="row">
                <div class="row frmtitle">
                    <p>THÊM MỚI LOẠI HÀNG HÓA</p>
                </div>
                <div class="row frmcontent">
                    <form action="#" method="post"> 
                        <div class="row mb10">
                            Mã loại<br>
                            <input type="text" name="maloai" disabled>
                        </div>
                        <div class="row mb10">
                            Tên loại<br>
                        <input type="text" name="teloai" disabled>
                        </div>
                        <div class="row mb10">
                            <input type="submit" value="THÊM MỚI">
                            <input type="reset" value="NHẬP LẠI ">
                            <input type="button" value="DANH SÁCH">
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <?php include "./product.php"; ?>
</body>
</html>
