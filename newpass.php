<?php
require_once "./connect.php";
$erros=[];
if(isset($_POST['Change'])){
    $Name=$_POST['UserName'];
    $Pass=$_POST['password'];
    $Email=$_POST['email'];
    $Pass_sha1 = sha1($Pass);
    $Newpass=$_POST['Newpassword'];
    if(empty($Name)){
        $erros[]="Tên đăng nhập không được bỏ trống";
    }
    if(empty($Pass)){
        $erros[]="Mật khẩu không được bỏ trống";
    }
    if(empty($Email)){
      $erros[]="Email không được bỏ trống";
  }
    if(empty($Newpass)){
        $erros[]="Vui lòng nhập mật khẩu mới ";
    }
    $sql ="SELECT * from user where Username ='$Name' and  password ='$Pass_sha1'";
    $res = $conn->query($sql);
    if($res -> num_rows ===0){
        $erros[]=" Tài khoản và mật khẩu không chính xác vui lòng nhập lại";
    }
    if(count($erros)== 0){
        $Newpass_hash=sha1($Newpass);
    $sql= "UPDATE user set  password = '$Newpass_hash' where  Username ='$Name'";
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
    <title>Document</title>
</head>
<body>
    <h3>Change password form</h3>
    <form action="" method="post">
    <label for="Username">UserName:</label> <input type="text" name="UserName" id="username"><br>
    <label for="Password"> Password:</label> <input type="Password" name="password" id="password"><br>
    <label for="Email"> Email:</label> <input type="email" name="email" id="email"><br>
    <label for="Newpassword">New password:</label> <input type="Password" name="Newpassword" id="Newpassword"><br>
    <input type="submit"value="Đổi mật khẩu"name="Change">
    </form>
    <?php
    foreach($erros as $error){
        echo($error);
    }
    ?>
</body>
</html>