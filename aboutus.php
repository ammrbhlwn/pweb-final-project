<?php
include("function/login.php");
include("function/customer_signup.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title>Demis</title>
	<link rel="icon" href="img/logoDemis.jpeg" />
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/button.js"></script>
	<script src="js/dropdown.js"></script>
	<script src="js/tab.js"></script>
	<script src="js/tooltip.js"></script>
	<script src="js/popover.js"></script>
	<script src="js/collapse.js"></script>
	<script src="js/modal.js"></script>
	<script src="js/scrollspy.js"></script>
	<script src="js/alert.js"></script>
	<script src="js/transition.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div id="header">
		<img src="img/logoDemis.jpeg">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="aboutus.php">About</a></li>
			<li><a href="product.php">Merch</a></li>
		</ul>
		<ul>
			<li><a href="#signup" data-toggle="modal">Sign Up</a></li>
			<li><a href="#login" data-toggle="modal">Login</a></li>
		</ul>
	</div>

	<div id="login" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel">Login...</h3>
		</div>
		<div class="modal-body">
			<form method="post">
				<center>
					<input type="email" name="email" placeholder="Email" style="width:250px;">
					<input type="password" name="password" placeholder="Password" style="width:250px;">
				</center>
		</div>
		<div class="modal-footer">
			<input class="btn btn-primary" type="submit" name="login" value="Login">
			<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
			</form>
		</div>
	</div>

	<div id="signup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:700px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel">Sign Up Here...</h3>
		</div>
		<div class="modal-body">
			<center>
				<form method="post">
					<input type="text" name="firstname" placeholder="Firstname" required>
					<input type="text" name="mi" placeholder="Middle Initial" maxlength="1" required>
					<input type="text" name="lastname" placeholder="Lastname" required>
					<input type="text" name="address" placeholder="Address" style="width:430px;" required>
					<input type="text" name="country" placeholder="Province" required>
					<input type="text" name="zipcode" placeholder="ZIP Code" required maxlength="4">
					<input type="text" name="mobile" placeholder="Mobile Number" maxlength="11">
					<input type="text" name="telephone" placeholder="Telephone Number" maxlength="8">
					<input type="email" name="email" placeholder="Email" required>
					<input type="password" name="password" placeholder="Password" required>
			</center>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="signup" value="Sign Up">
			<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
		</form>
	</div>

	<br>
	<div id="about-container">
		<div class="content-about">
			<img src="img/about1.jpg" style="width:1150px; height:250px; border:1px solid #000; ">
			<h1 class="header-about">About Us</h1>
			<p class="body-about">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Assumenda suscipit libero dolorem magni praesentium incidunt nemo. Eius error vitae dolor magni, quae voluptatum doloribus omnis dicta nostrum libero, aspernatur dolorum aperiam, minima id fugiat obcaecati dolores consequatur tempora rerum ratione? Amet, eos? Iure magni ratione quidem optio in, nulla porro sint praesentium dicta quaerat sit et at quos nemo eius quae eveniet sed, aspernatur voluptas, dolores ea laudantium quo recusandae placeat. Ut dicta beatae consequuntur tempore consectetur necessitatibus quas eum voluptates a. Libero ex esse repudiandae, laborum magni adipisci perferendis! Reiciendis illum quo, beatae doloribus accusantium dolores autem similique unde!</p>
		</div>
		<br />
	</div>
	<br />
	<div id="footer">
		<div class="foot">
			<label style="font-size:17px;"> Copyrght &copy; </label>
			<p style="font-size:25px;">Demis Inc. 2024</p>
		</div>
	</div>
</body>

</html>