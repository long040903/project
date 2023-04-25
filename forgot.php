<?php
require_once "./connect.php";
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
</head>
<body>
    <h3>Vui lòng nhập email để lấy lại mật khẩu</h3>
    <form action="" method="post" name="confirm">
    <label for="Username">Email:</label> <input type="email" name="email" id="email"><br>
    <label for="confirmation_code">Xác nhận mật khẩu:</label> <input type="password" name="confirmation_code" id="confirmation_code"><br>
    
    
 
    <input type="submit"value="Change"name="Change">
    </form>

</body>
</html>
