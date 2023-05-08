<?php
require_once "connect.php";

if (isset($_POST['submit'])) {

$name = sanitize($_POST['name']);
$rating = sanitize($_POST['rating']);
$comment = sanitize($_POST['comment']);

// Tạo câu truy vấn SQL để lưu đánh giá vào cơ sở dữ liệu
$sql = "INSERT INTO feedback (name, rating, comment) VALUES (:name, :rating, :comment)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':rating', $rating);
$stmt->bindParam(':comment', $comment);
$stmt->execute();
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Form đánh giá</title>
	<style>
		form {
			max-width: 600px;
			margin: 0 auto;
			padding: 20px;
			background-color: #f5f5f5;
			border: 1px solid #ccc;
			border-radius: 5px;
		}

		h2 {
			text-align: center;
			margin-bottom: 20px;
		}

		.star-rating {
			display: inline-block;
			font-size: 0;
			cursor: pointer;
		}

		.star-rating input[type="radio"] {
			display: none;
		}

		.star-rating label {
			display: inline-block;
			font-size: 30px;
			color: #ccc;
			margin: 0 2px;
			transition: color 0.2s;
		}

		.star-rating input[type="radio"]:checked + label {
			color: gold;
		}

		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}

		textarea {
			display: block;
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 20px;
		}

		button[type="submit"] {
			display: block;
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			margin-top: 20px;
			cursor: pointer;
		}

		button[type="submit"]:hover {
			background-color: #3e8e41;
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			$(".star-rating input[type='radio']").click(function(e) {
				$(".star-rating label").css("color", "#ccc");
        $(".star-rating input").attr('checked',false);
        // console.log(e.target);
        console.log(e.target.value);
        $(e.target).attr('checked',true);
        $('.star-rating label').each(function(index,elm){
            console.log(elm)
            let data_star = $(elm).attr('for').split('-');
            if(data_star.length > 1){
              let star = parseInt(data_star[1]);
                if(star <= parseInt(e.target.value)){
                  console.log($(elm).prev());
                  $(elm).css('color','gold');
                }
            }
        });
			});
		});
	</script>
</head>
<body>
	<form action="process_review.php" method="post">
		<h2>Đánh giá sản phẩm</h2>
		<label for="name">Tên của bạn:</label>
		<input type="text" id="name" name="name" required>
		<label for="rating">Đánh giá:</label>
		<div class="star-rating">
			<input type="radio" id="star-1" name="rating" value="1" /><label for="star-1">★</label>
			<input type="radio" id="star-2" name="rating" value="2" /><label for="star-2">★
      </label>
<input type="radio" id="star-3" name="rating" value="3" /><label for="star-3">★</label>
<input type="radio" id="star-4" name="rating" value="4" /><label for="star-4">★</label>
<input type="radio" id="star-5" name="rating" value="5" /><label for="star-5">★</label>
</div>
<label for="review">Nhận xét của bạn:</label>
<textarea id="review" name="review" rows="6" required></textarea>
<button type="submit" name="submit">Gửi đánh giá</button>
</form>

</body>
</html>