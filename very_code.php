<?php 
require_once "connect.php";
$errors = [];
function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charLength - 1)];
  }
  return $randomString;
}
  if (isset($_POST["verification_code"])) {
    $verificationCode = $_POST["verification_code"];
    $sql = "SELECT * FROM user WHERE confirmation_code = '$verificationCode'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // Valid verification code
      // Get user information from a database
      $user = $result->fetch_assoc();
      $userId = $user["id"];

      // Generate new passwords randomly
      $newPassword = generateRandomString(10);

      // Update a new password in the database
      $hashedPassword = sha1($newPassword);
      $sql = "UPDATE user SET password = '$hashedPassword', confirmation_code = NULL WHERE id = '$userId'";
      $conn->query($sql);

          echo "Change password successfully. The new password has been successfully sent to your email address.";
      } else {
          $errors['verification_code'] = "Email delivery failure";
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
<style>
  body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
  padding: 20px;
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

form h1 {
  text-align: center;
}

form input[type="text"] {
  width: 94%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

form button[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin: 1.2rem 0;
}

form button[type="submit"]:hover {
  background-color: #45a049;
}

a {
  display: block;
  margin-top: 10px;
  text-align: center;
  color: #333;
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
<body>

                        <form method="POST" action="">
                            <h1>verification code</h1>
                            <input type="text" id="verification_code" name="verification_code" placeholder="verification code" required>
                            <button type="submit">verify</button>
                            <a href="home.php">go back home</a>
                        </form>
                        
                     
                  
</body>
</html>