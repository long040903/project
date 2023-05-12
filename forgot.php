<?php
require_once "connect.php";
$errors = [];
if(isset($_POST['forgot'])){
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    if(empty($email)){
        $errors['email'] = 'please enter your email!';
    }
    if(empty($password)){
        $errors['password'] = 'please enter your password!';
    }
}
// Hàm tạo mật khẩu mới ngẫu nhiên
function generateRandomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password = array();
    $alphabetLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, $alphabetLength);
        $password[] = $alphabet[$n];  
    }
    return implode($password);
}

// Thực hiện gửi email chứa mã xác nhận đến người dùng
function sendConfirmationCode($email, $confirmationCode) {
    $to = $email;
    $subject = 'Mã xác nhận đổi mật khẩu';
    $message = 'Mã xác nhận của bạn là: ' . $confirmationCode;
    $headers = 'From: team2@example.com' . "\r\n" .
               'Reply-To: noreply@example.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    return mail($to, $subject, $message, $headers);
}

// Xử lý form đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Kiểm tra xem địa chỉ email có tồn tại trong cơ sở dữ liệu không
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Nếu địa chỉ email tồn tại, tạo mật khẩu mới ngẫu nhiên
        $newPassword = generateRandomPassword();

        // Lưu mật khẩu mới vào cơ sở dữ liệu
        $hashedPassword = sha1($newPassword);
        $query = "UPDATE user SET password = '$hashedPassword' WHERE email = '$email'";
        mysqli_query($conn, $query);

        // Tạo mã xác nhận và gửi email chứa mã xác nhận đến người dùng
        $confirmationCode = generateRandomPassword();
        sendConfirmationCode($email, $confirmationCode);

        // Lưu mã xác nhận vào cơ sở dữ liệu để kiểm tra sau này
        $query = "UPDATE user SET confirmation_code = '$confirmationCode' WHERE email = '$email'";
        mysqli_query($conn, $query);
    }

    // Chuyển hướng người dùng đến trang thông báo thành công
    echo "thay đổi mk thành công";
    exit();
  }

      // Xử lý form xác nhận mã
      if (isset($_POST['confirm']))  {
    $eamil = $_POST["email"];
    $confirmationCode = $_POST["confirmation_code"];
    
    

    // Kiểm tra xem mã xác nhận có chính xác không
    $query = "SELECT * FROM users WHERE email = '$email' AND confirmation_code = '$confirmationCode'";
    $result = mysqli_query($conn, $query);
      }


    // Kiểm tra xem mã xác nhận có chính xác

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="forgot.css" />
</head>
<body>
    
    
 
    <input type="submit"value="Change"name="Change">
    </form>

        <div class="container">
            <div class="header">
                <div class="header__icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="header__title">
                    <h2>forgot password</h2>
                </div>
            </div>
            <form
                action=""
                class="form"
                method="post"
                name="confirm"
            >
                <div class="form__email">
                    <div class="form__email--icon form__icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="form__email--input form__input">
                        <input
                            type="email"
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
                <div class="form__password">
                    <div class="form__password--icon form__icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="form__password--input form__input">
                        <input
                            type="password"
                            id="confirmation_code"
                            placeholder="password confirmation"
                            name="confirmation_code"
                        />
                    </div>
                </div>
                <p id="errorPassword">
                <?php if (!empty($errors['password'])) {
                    echo $errors['password'];
                } ?>
                </p>
            </form>
        </div>
      
</body>
</html>
