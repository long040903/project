<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.css" integrity="sha512-yqCpLPABHnpDe3/QgEm1OO4Ohq0BBlBtJGMh5JbhdYEb6nahIm7sbtjilfSFyzUhxdXHS/cm8+FYfNstfpxcrg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<?php
   require_once "connect.php";
    // Random string generator
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
        return $randomString;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connect to the database
     

        $email = $_POST["email"];

        // Check email validity
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Địa chỉ email không hợp lệ";
        } else {
            // Check email in the database
            $sql = "SELECT * FROM user WHERE email = '$email'";
        
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Generate random verification code
                $verificationCode = generateRandomString(6);

                // Save the verification code to the database
                $sql = "UPDATE user SET confirmation_code = '$verificationCode' WHERE email = '$email'";
                $conn->query($sql);

                // Send an email with the verification code
                $to = $email;
                $subject = "Verification Code";
                $message = "Your verification code is: " . $verificationCode;
                $headers = "From: yourname@yourwebsite.com\r\n";
                $headers .= "Reply-To: yourname@yourwebsite.com\r\n";
                $headers .= "Content-Type: text/html\r\n";

                // Check if the email was sent successfully
                if (mail($to, $subject, $message, $headers)) {
                    // Redirect to the verification code entry form
                    header("Location: ./very_code.php");
                    exit;
                }
            } else {
               echo "email không hợp lệ";
            }
        }

        $conn->close();
    }
?>
<style>
    body {
        font-family: Arial, sans-serif  ;
         background-color: #f2f2f2;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 0;
    font-size: 1.2rem;
    background: #ededed;
}

form button[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    color: #615f5f;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 1.5rem;
    margin: 1.5rem 0;
}

form button[type="submit"]:hover {
    background: #bac34e;
    color: white;
}

form button[type="submit"]:focus {
    outline: none;
}

.error-message {
    color: red;
    margin-top: 10px;
    font-size: 14px;
}

form .box {
    display: flex;
}

form .box .icon {
    font-size: 1.2rem;
    width: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ededed;
}

form .box .input {
    width: 83%;
}

form .box .input input:hover {
    background: #bac34e;
    color: white;
}

@media screen and (max-width: 480px) {
    form {
        padding: 10px;
    }

    form button[type="submit"] {
        font-size: 14px;
        padding: 8px;
    }
}
</style>

<form method="POST" action="">
    <h1>Forgot Password</h1>
    <div class="box">
        <div class="icon">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="input">
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
    </div>
    <button type="submit"><i class="fas fa-arrow-right"></i></button>

</form>
</body>
</html>
