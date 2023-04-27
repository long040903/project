<?php
session_start();
require_once "./connect.php";
$errors=[];

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password= $_POST['password'];
    $password_hash = sha1($password);
    
    if(empty($username)){
        $errors['username']='Name is not empty!';
    }
    if(empty($password)){
        $errors['password']='Password is not empty!';
    }
    
        if (empty($errors)) {
            $sql = "SELECT * FROM user WHERE username='$username' and password='$password_hash'";
            $res = $conn->query($sql);
            if (($res->num_rows) > 0 ) {
              header("location:home-page.php");
            } else {
                $errors['failed']="Name or password invalid";
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
        
        
        <link rel="stylesheet" href="login1.css" />
    </head>
    <body>
        
        <div class="container">
            <div class="header">
                <div class="header__icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="header__title">
                    <h2>User Login</h2>
                </div>
            </div>
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
                <a href="./forgot.php">Forgot password</a><br>
                <div class="form__submit">
                    <button type="submit" name="login">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                <p style="font-size: 1.5rem;color: rgb(248, 61, 61);margin: -1rem 1rem;">
                    <?php
        
                        if (!empty($success_message)) {
                            echo   $success_message ;
                        } else if (!empty($errors['failed'])) {
                            echo  $errors['failed'] ;
                        }
                    
                    ?>
                </p>
        <div class="register" style="height: 10px;">
            <div class="member" ><p class="p">Not a member?</p></div>
            <div class="signup" ><a href="./register.php" class="a">Signup now</a></div>
        </div>
        
        
            </form>
        

        
    </body>
</html>
