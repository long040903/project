<?php
require_once 'header.php'
?>





<div class="heading">
    <h1>contact us</h1>
    <p><a href="home.php">home >></a> contact</p>
</div>

<section class="contact">

    <div class="icons-container">

        <div class="icons">
            <i class="fas fa-phone"></i>
            <h3>our phone</h3>
            <a href="tel:0386296319">+84 386-296-319</a>
        </div>

        <div class="icons">
            <i class="fas fa-envelope"></i>
            <h3>our email</h3>
            <a href="mailto:long200312a1@gmail.com">long200312a1@gmail.com</a>
        </div>

        <div class="icons">
            <i class="fas fa-location-dot"></i>
            <h3>our address</h3>
            <p>Aptech Computer Education</p>
            <p>APTECH Building, Doi Can 285, Lieu Giai, Ba Dinh</p>
            <p>Ha Noi</p>
        </div>

    </div>

    <?php
require_once 'connect.php';

$errors = [];
$success = false;

if (isset($_POST['contact'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);

    // Kiểm tra nếu các trường thông tin được nhập đầy đủ
    if(empty($name)){
        $errors['name'] = 'Please enter your name';
    }
    if(empty($email)){
        $errors['email'] = 'Please enter your email';
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'Invalid email format';
    }
    if(empty($phone)){
        $errors['phone'] = 'Please enter your phone number';
    }
    if(empty($message)){
        $errors['message'] = 'Please enter your message';
    }

    if(count($errors) === 0) {
        // Lưu thông tin contact vào cơ sở dữ liệu
        $sql = "INSERT INTO contact (username, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
        if (mysqli_query($conn, $sql)) {
            $success = true;
        } else {
            $errors['contact'] ='Failed to save contact information';
        }
    }
} 

mysqli_close($conn);
?>

<div class="row">
    <form action="" method="post">
        <h3>get in touch</h3>
        <?php if(count($errors) > 0): ?>
            <div class="errors">
                <?php foreach($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php elseif($success): ?>
            <div class="success">
                <p>Your contact information has been saved successfully!</p>
            </div>
        <?php endif; ?>
        <div class="inputBox">
            <input type="text" id="name" name="name" placeholder="enter your name" class="box" value="<?php echo isset($name) ? $name : ''; ?>">
            <input type="email" id="email" name="email" placeholder="enter your email" class="box" value="<?php echo isset($email) ? $email : ''; ?>">
        </div>
        <div class="inputBox">
            <input type="number" id="phone" name="phone" placeholder="enter your phone" class="box" value="<?php echo isset($phone) ? $phone : ''; ?>">
        </div>
        <textarea placeholder="enter your message" id="message" name="message" cols="30" rows="10"><?php echo isset($message) ? $message : ''; ?></textarea>
        <input type="submit" value="send message" class="btn" name="contact">
    </form>
    <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9265585566764!2d105.81637567512936!3d21.035624380615356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab0d6e603741%3A0x208a848932ac2109!2sAptech%20Computer%20Education!5e0!3m2!1svi!2s!4v1683116487043!5m2!1svi!2s"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


    </div>

</section>


















































<?php
require_once 'footer.php'
?>