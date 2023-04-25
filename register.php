<?php
require_once "./connect.php";
$errors=[];
if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password_hash = sha1($password);
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $address = $_POST['address'];

  if(empty($username)){
    $errors['username']='Name is not empty!';
  }
  if(empty($password)){
    $errors['password']='Password is not empty!';
  }
  if(empty($phone)){
    $errors['phone']='Phone is not empty!';
  }
  if(empty($email)){
    $errors['email']='Email is not empty!';
  }
  if(empty($address)){
    $errors['address']='Address is not empty!';
  }
  
  $sql = "SELECT * FROM user WHERE username='$username'";
  $res = $conn->query($sql);
  if($res -> num_rows >0){

    $erros['failed']=" Tài khoản hoặc mật khẩu không chính xác vui lòng đăng nhập lại";
  } else {
    $sql = "INSERT INTO user (username,password,email,phoneNumber,address) VALUES ('$username','$password_hash','$email','$phone','$address')";
  //  var_dump($sql);
    $res = $conn->query($sql);
    if ($res) {
        // $errors['Register']="Đăng kí thành công. Tài khoản $username, số điện thoại $phone đã được tạo.";
        
        header("location:login2.php");
        
    } else {
        $errors['failed']="Đăng kí không thành công.";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        />
        <!-- SweetAlert2 -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/limontesweetalert2/7.2.0/sweetalert2.min.css/>"
        />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
        
        
        <link rel="stylesheet" href="register.css" />
    </head>
    <body>
        
        <div class="container">
            <div class="header">
                
                <div class="header__title">
                    <h2>Registration</h2>
                </div>
            </div><br>
            <form
                action=""
                class="form"
                method="post"
            >
                <div class="form__username">
                    <div class="form__username--icon form__icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="form__username--input form__input">
                        <input
                            type="text"
                            id="username"
                            placeholder="Name"
                            name="username"
                        />
                    </div>
                </div>
                <p id="errorUsername">
                <?php if (!empty($errors['username'])) {
              echo $errors['username'];
      } ?>
                </p>
                <div class="form__password">
                    <div class="form__password--icon form__icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="form__password--input form__input">
                        <input
                            type="password"
                            id="password"
                            placeholder="Password"
                            name="password"
                        />
                    </div>
                </div>
                <p id="errorPassword">
                <?php if (!empty($errors['password'])) {
                  echo $errors['password'];
            } ?>
                </p>
                
                <div class="form__phone">
                    <div class="form__phone--icon form__icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="form__phone--input form__input">
                        <input
                            type="text"
                            id="phone"
                            placeholder="phone"
                            name="phone"
                        />
                    </div>
                </div>
                <p id="errorPhone">
                <?php if (!empty($errors['phone'])) {
                  echo $errors['phone'];
            } ?>
                </p>

                <div class="form__email">
                    <div class="form__email--icon form__icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="form__email--input form__input">
                        <input
                            type="text"
                            id="email"
                            placeholder="email"
                            name="email"
                        />
                    </div>
                </div>
                <p id="errorEmail">
                <?php if (!empty($errors['email'])) {
                  echo $errors['email'];
            } ?>
                </p>

                <div class="form__address">
                    <div class="form__address--icon form__icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="form__address--input form__input">
                        <input
                            type="text"
                            id="address"
                            placeholder="address"
                            name="address"
                        />
                    </div>
                </div>
                <p id="errorAddress">
                <?php if (!empty($errors['address'])) {
                  echo $errors['address'];
            } ?>
                </p><br>
                <div class="form__submit">
                    <button type="submit" name="register">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
        <p id="errorregister">
        <?php
        
        if (!empty($success_message)) {
            echo  $success_message ;
        } else if (!empty($errors['register'])) {
            echo $errors['register'] ;
        }
        
        ?>
        </p>
        
        
            </form>
        

        
    </body>
</html>
