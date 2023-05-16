<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.css" integrity="sha512-yqCpLPABHnpDe3/QgEm1OO4Ohq0BBlBtJGMh5JbhdYEb6nahIm7sbtjilfSFyzUhxdXHS/cm8+FYfNstfpxcrg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="login.css" />
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
</head>
<body>
    <?php
        session_start();
        require_once "connect.php";
        $errors = [];
        error_reporting(0);

        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_hash = sha1($password);
            $email = $_POST['email'];

            if (empty($username)) {
                $errors['username'] = 'name is not empty!';
            }
            if (empty($password)) {
                $errors['password'] = 'password is not empty!';
            }
            if (empty($email)) {
                $errors['email'] = 'Email is not empty!';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email invalid!';
            }

            if (empty($errors)) {
                $sql = "SELECT * FROM user WHERE username='$username' AND password='$password_hash' AND email='$email'";
                $res = $conn->query($sql);

                if ($res && $res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $id_nguoi_dung = $row['id'];
                    $_SESSION['login'] = $id_nguoi_dung;

                    echo "<script>
                        Swal.fire({
                            title: 'Successful login!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = 'home.php';
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Incorrect name or password!',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = 'login.php';
                        });
                    </script>";
                }
            }
        }
    ?>

    <div class="container">
    <div class="header">
            <div class="header__icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="header__title">
                <h2>login</h2>
            </div>
        </div>
        <form action="" class="form" method="post">
            <div class="form__username">
                <div class="form__username--icon form__icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="form__username--input form__input">
                    <input type="text" id="username" placeholder="name" name="username" />
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
                    <input type="password" id="password" placeholder="password" name="password" />
                </div>
            </div>
            <p id="errorPassword">
                <?php if (!empty($errors['password'])) {
                    echo $errors['password'];
                } ?>
            </p>
            <div class="form__email">
                <div class="form__email--icon form__icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="form__email--input form__input">
                    <input type="email" id="email" placeholder="Email" name="email" />
                </div>
            </div>
            <p id="errorEmail">
                <?php if (!empty($errors['email'])) {
                    echo $errors['email'];
                } ?>
            </p>
            <a href="./forgot.php">forgot password</a><br>
            <div class="form__submit">
                <button type="submit" name="login">
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
            <p style="font-size: 1.5rem;color: rgb(248, 61, 61);margin: -1rem 1rem;">
                <?php
                    if (!empty($success_message)) {
                        echo $success_message;
                    } else if (!empty($errors['failed'])) {
                        echo $errors['failed'];
                    }
                ?>
            </p>
            <div class="login" style="height: 10px;">
                <div class="member"><p class="p">not a member?</p></div>
                <div class="signup"><a href="./register.php" class="a">register now</a></div>
            </div>
        </form>
    </div>
</body>
</html>
