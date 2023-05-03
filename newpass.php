<?php
require_once "./connect.php";
$errors=[];
if(isset($_POST['Change'])){
    $Name=$_POST['UserName'];
    $Pass=$_POST['password'];
    $Email=$_POST['email'];
    $Pass_sha1 = sha1($Pass);
    $Newpass=$_POST['newpassword'];
    if(empty($Name)){
        $errors['UserName']="Name is not empty!";
    }
    if(empty($Pass)){
        $errors['password']="Password is not empty!";
    }
    if(empty($Email)){
      $errors['email']="Email is not empty!";
  }
    if(empty($Newpass)){
        $errors['newpassword']="Please enter a new password";
    }
    $sql ="SELECT * from user where UserName ='$Name' and  password ='$Pass_sha1'";
    $res = $conn->query($sql);
    if(empty($res -> num_rows ===0)){
        $errors['Change']=" Tài khoản và mật khẩu không chính xác vui lòng nhập lại";
    }
    if(count($errors)== 0){
        $Newpass_hash=sha1($Newpass);
    $sql= "UPDATE user set  password = '$Newpass_hash' where  UserName ='$Name'";
    $res = $conn->query($sql);
    if($res){
        echo "Thay đổi mật khẩu thành công";
    }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        />

    <link rel="stylesheet" href="newpass1.css" />
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header__title">
                <h2>Change password form</h2>
            </div>
        </div><br>
    
    
    <form action="" method="post" class="form">
        <div class="form__username">
            <div class="form__username--icon form__icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="form__username--input form__input">
                <input type="text" name="UserName" id="username" placeholder="Name">
            </div>
        </div>
        <p id="errorUsername">
        <?php if (!empty($errors['UserName'])) {
                echo $errors['UserName'];
            } 
        ?>
        </p>

        <div class="form__password">
            <div class="form__password--icon form__icon">
                <i class="fas fa-lock"></i>
            </div>
            <div class="form__password--input form__input">
                <input type="password" name="password" id="password" placeholder="old password">
            </div>
        </div>
        <p id="errorPassword">
        <?php if (!empty($errors['password'])) {
                echo $errors['password'];
            } 
        ?>
        </p>
        <div class="form__email">
            <div class="form__email--icon form__icon">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="form__email--input form__input">
                <input type="email" name="email" id="email" placeholder="email">
            </div>
        </div>
        <p id="errorEmail">
        <?php if (!empty($errors['email'])) {
                echo $errors['email'];
            } 
        ?>
        </p>
     
        <div class="form__newpassword">
            <div class="form__newpassword--icon form__icon">
                <i class="fas fa-lock"></i>
            </div>
            <div class="form__newpassword--input form__input">
                <input type="password" name="newpassword" id="newpassword" placeholder="new password">
            </div>
        </div>
        <p id="errorNewpassword">
        <?php if (!empty($errors['newpassword'])) {
                echo $errors['newpassword'];
            } 
        ?>
        </p>

        <div class="form__submit">
                        <button type="submit" name="Change">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
            <p id="errorChange">
            <?php
            
            if (!empty($success_message)) {
                echo  $success_message ;
            } else if (!empty($errors['Change'])) {
                echo $errors['Change'] ;
            }
            
            ?>
    
    </form>
    </div>
</body>
</html>