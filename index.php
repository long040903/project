<?php
 

    $mes = "";

    if(session_id() == "") {
        session_start();
    }
    $ss_admin_id = FALSE;
    $ss_admin = FALSE;
    $c_admin_id = 1;
    $c_admin_loggedin = 2;
    if(isset($_SESSION["loggedin"])) {
        $ss_admin_id = $_SESSION["loggedin"];
    }
    if(isset($_SESSION["admin"])) {
        $ss_admin = $_SESSION["admin"];
    }
    if(isset($_COOKIE["id"])) {
        $c_admin_id = $_COOKIE["id"];
    }
    if(isset($_COOKIE["admin_loggedin"])) {
        $c_admin_loggedin = md5($_COOKIE["admin_loggedin"]);
    }
    if($ss_admin_id == TRUE  && $ss_admin == TRUE || $c_admin_loggedin == $c_admin_id) { 
        header("location: ../CRUD/dashboard.php");
    } 
    
    if(isset($_POST["login"])) {
        if(isset($_POST["l_user_name"])) {
            $p->user_name = $_POST["l_user_name"];
        }
        if(isset($_POST["l_pwd"])) {
            $p->password_hash = sha1($_POST["l_pwd"]);
        }
        if($p->user_name != NULL && $p->password_hash != NULL) {
            if(isset($_POST["saveme"])) {
                $p->saveme = $_POST["saveme"];
            }
            $p->logins();
        } else {
            $mes = "Please enter full information !";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <style>
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-repeat: no-repeat;
            background: linear-gradient(180deg,#39373d,#18061b);
            height:100vh;
        }
        .container {
            background-color: rgba(104, 97, 104, 0.336);
            box-shadow: 2px 2px 5px rgba(238, 130, 238, 0.342);
            background-size: cover;
            background-repeat: no-repeat;
            width: 600px;
            margin: 100px auto 0 auto;
            border-radius: 10px;
        }
        form {
            width: 100%;
            padding: 20px 50px;
        }
        h2 {
            font-size: 30px;
            text-align: center;
            color:aliceblue;
            margin-bottom: 20px;
        }
        .group-item {
            width: 100%;
            display: flex;
            justify-content:space-between;
            margin-bottom: 10px;
        }
        .group-item label {
            width: 100px;
            align-self: center;
            font-weight: 500;
            display: inline-block;
            color: aliceblue;
        }
        .group-item input {
            font-size: 16px;
            width: 300px;
            padding: 10px 10px;
            border: none;
            border-radius: 3px;
        }
        .group-item input:hover {
            border: chocolate;
            box-shadow: 2px 2px 5px violet;
        }
        .remember {
            width: 100%;
            height: 50px;
            color: aliceblue;
        }
        .lable-remember:hover {
            cursor: pointer;
            text-shadow: 0 0 3px #FF0000;
        }
        input[type = "checkbox"] {
            cursor: pointer;
            width: 15px;
            height: 15px;
        }

        input[type="submit"] {
            display:inline-block;
            padding: 10px 60px;
            background-color: yellow;
            font-size: 16px;
            border-radius: 5px;
            text-align:center;
            border: none;
            color: rgb(19, 68, 39);
            cursor: pointer;
        }
        input[type="submit"]:hover {
            box-shadow: 2px 2px 9px rgb(226, 73, 219);
        }
        input[type="submit"]:active {
            transform: translateY(5px);
        }
        .group-btn {
            display: flex;
            justify-content: center;
        }

        .active {
            background-color: violet !important;
            color: rgb(255, 253, 253) !important;
        }

        .mes {
            margin-top: 20px;
            text-align: center;
            color: rgb(245, 253, 206);
        }

        @media (max-width:700px){
            .container {
                width: 90%;
                margin: 100px auto 0 auto;
            }
            form {
                width: 100%;
                padding: 10px 5px;
            }
            .group-item {
                width: 100%;
                display: flex;
                flex-direction: column;
                margin-bottom: 10px;
            }
            .group-item label {
                width: 100%;
                align-self: center;
                font-weight: 500;
                display: inline-block;
                color: aliceblue;
            }
            .group-item input {
                width: 100%;
                font-size: 16px;
                padding: 10px 10px;
                border: none;
                border-radius: 3px;
            }
            }
            @media (max-width:450px){
                .container {
                    width: 90%;
                    margin: 100px auto 0 auto;
                }
            }
    </style>
</head>
<body>
    <div class="container">
        <form id="login-form" action="" method="POST">
            <h2>Login</h2>
            <div class="group-item">
                <label for="">Username</label>
                <input type="text" name="l_user_name" placeholder="User name">
            </div>
            <div class="group-item">
                <label for="">Password</label>
                <input type="password" name="l_pwd" placeholder="Password">
            </div>
            <div class="remember">
                <input type="checkbox" id="save_me" name="saveme" value="saveme">
                <label for="save_me" class="lable-remember">Remember me</label>
            </div>
            <div class="group-btn">
                <input type="submit" name="login" value="login">
            </div>
            <div class="mes">
                <span><?php echo $mes ?></span>
            </div>
        </form>
    </div>
</body>
</html>