<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta name="description" content="">
<meta name="keywords" content="Doc truyen online, truyen kiem hiep, truyen tien hiep, truyen sac hiep, truyen ngon tinh, truyen trinh tham, vong du, truyen convert full text">
<meta name="robots" content="noindex">
<title>Sign Up</title>
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link href="./css/bootstrap-responsive.css" rel="stylesheet">
<link href="./css/yamm.css" rel="stylesheet">
<link href="./css/style.css" rel="stylesheet">
<link href="./css/chosen.css" rel="stylesheet">
<link rel="icon" type="image/png" href="img/favicon.png"/>
<link href="https://plus.google.com/103281900225927837176/" rel="author">
<script src="js/jquery-1.12.4.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/csrf.js"></script>
<style>
	body{
		padding-top:60px;padding-bottom:40px;height:auto;
	}
</style>
</head>

<script>
	$(document).ready(function(){
		$('input.form-control').keyup(function() {
			var e = $(this);
			var label = e.closest('.form-group').find('label');
			label.removeClass('animated fadeInLeft fadeOutLeft');
						if (e.val()) {
							label.css('visibility', 'visible').addClass('animated fadeInLeft');
						} else{
							label.addClass('animated fadeOutLeft');
							setTimeout(function(){
								label.css('visibility', 'hidden');
							}, 500);
						}
					});

		$('button[type=reset]').click(function(){
			var label = $('label');
			label.removeClass('animated fadeInLeft fadeOutLeft').addClass('animated fadeOutLeft');
			return true;
		});

		$('button[type=submit]').button('reset').removeAttr('disabled');
		$('form').submit(function(){
			var form = $(this);
			form.find('button[type=reset]').attr('disabled', 'disabled');
			form.find('button[type=submit]').button('loading');
		});
	});
</script>



<?php
	require_once("./db.php");

	if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']))
	{
		$fullname=$_POST['fullname'];
		$dob=$_POST['dob'];
		$phone=$_POST['phonenumber'];
		$email=$_POST['email'];
		$uname=$_POST['username'];
		$pass=md5($_POST['password']);
		$errormsg= False;

		$sql= "SELECT username FROM account WHERE username='".$uname ."'";
		$row= query($sql);

		$sql1= "SELECT email FROM account WHERE email='".$email ."'";
		$row1= query($sql1); 
	}
?>

<body>

<div class="yamm navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand truyenyy-logo" href="index.html">iRead</a>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
	<!--	<div class="span12">
			<div class="container">
				<div class="row"> -->
					<div class="span12 auth">
						<h1 h1 class="page-header" style="text-align: center">Register</h1>

						<div class="row">
								<table width="80%" align="center" border-spacing= "10px"  padding= "5px" >
								<form action="registration.php" method="post" role="form">
									<tr>
										<td>
											<label for="id_email" class="control-label requiredField">Email<span class="asteriskField">*</span></label>
										</td>

										<td>
											<div class="controls">
											<?php
												if(isset($_POST['email'])){
													if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$^", $email))
													{ 
														$emailErr = "Email is invalid. Please try again";	
													}else if(count($row1) > 0){

														$emailErr = "Email is already exit. Please choose another one";
													}
													if(isset($emailErr)){
														echo("<label class='error' id = 'erEmail' style='display: block;'>".$emailErr ."</label>");
											
														$errormsg = True;
													}
												}	
											?>
												<input name="email" type="text" maxlength="100" autofocus="autofocus" required="required" placeholder="Email address" class="textinput textInput" id="id_email"/>
											</div>
										</td>
									
										<td></td>

										<td>
											<label for="id_fullname" class="control-label requiredField">Fullname<span class="asteriskField">*</span>
											</label>
										</td>
										<td>
											<input name="fullname" maxlength="254" type="text" required="required" placeholder="Full name" class="textinput textInput" id="id_fullname" title="Max length of Full name is 254 characters"/>
										</td>
									</tr>

									<tr>
										<td>
											<label for="id_username" class="control-label requiredField">Username<span class="asteriskField">*</span></label>
										</td>

										<td>
											<div class="controls">
											<?php
												if(isset($_POST['username']) && count($row) > 0){ 

													echo("<label class='error' id = 'erEmail' style='display: block;'> Username already exists. Please choose another username </label>");
													$errormsg = True;
												}
											?>
												<input name="username" maxlength="254" type="text"  required="required" placeholder="Username" class="textinput textInput" id="id_username"/>
											</div>
										</td>

										<td></td>

										<td>
											<label for="id_dob" class="control-label">Date of birth
											</label>
										</td>
										<td>
											<input name="dob" type="date" class="textinput textInput" id="id_dob"/>
										</td>
									</tr>

									<tr>
										<td>
											<label for="password" class="control-label requiredField">Password<span class="asteriskField">*</span></label>
										</td>
										<td>
											<div class="controls">
											<input name="password" placeholder="Password" type="password" class="textinput textInput" id="password" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 6" required = "required">
										<!--	<label class='error' id = 'erPassword' style="display: none;"> This username already exists. Please choose another username </label>  -->
										</td>
									
										<td></td>
										<td>
											<label for="id_phonenumber" class="control-label">Phone number</label>
										</td>
										<td>
											<input name="phonenumber" maxlength="15" type="text"placeholder="Phone number" class="textinput textInput" id="id_phonenumber" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" title="Please enter the correct format phone number " />
										</td>
									
									</tr>

									<tr>
										<td colspan="3">
											<div id="message">
  												<h6>Password must contain the following:</h6>
  												<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  												<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  												<p id="number" class="invalid">A <b>number</b></p>
  												<p id="length" class="invalid">Minimum <b>6 characters</b></p>
											</div>	
										</td>

										<td></td>
										<td></td>
									
									</tr>

									<tr>
										<td colspan="5" class="small" style="text-align: center;">
											<i>Note: When registering an account, you agree with the Website Rules.</i>
										
											<br><br>
										</td>
									</tr>

					 				<tr>
					 					<td></td>
										<td style="text-align: center;">
											<button type="submit" class="btn btn-primary" data-loading-text="Loading" value="Submit">
											Submit
											</button>
										<td></td>
										<td></td>
										<td style="text-align: left;">
											<button type="reset" class="btn btn-default">Clear</button>
										</td>
									
									</tr>
								
									<tr>	
										<td colspan="5" style="font-size: 17px; text-align: center">
											<br>
											<i class="icon-arrow-right"></i> <a href="./login.php">Back to Login</a>		
									</tr>
								</form>
							</table>		
						
					</div>
		<!--		</div>
			</div>
			
			<div class="clearfix"></div>
			<hr/>
			
			</div>  -->
			
			
		</div>
	</div>
</div>

<!-- validate password -->
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

</body>
</html>
<?php 
	if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']))
	{
		$fullname=$_POST['fullname'];
		$dob=$_POST['dob'];
		$phone=$_POST['phonenumber'];
		$email=$_POST['email'];
		$uname=$_POST['username'];
		$pass=md5($_POST['password']);

		if($errormsg == False){
			$sql= "Insert into account values ('" .$uname ."','" .$pass."','member','".$email ."')";

			$sql1 = "Insert into member values ('','" .$fullname ."','" .$dob ."','" .$phone ."','" .$uname ."','0','default avt.jpg')";  

			$result = execsql($sql);
			echo('result: =' .$result);
			$result1 = execsql($sql1);  
			echo('result1: =' .$result1);			
						
			if ($result != null && $result1 != null){
?>				
				<script >
					alert ("Sign up successfully");
					window.location.replace("./login.php");
				</script>
<?php 		
			}else{
?>				
				<script >
					alert ("Sign up is not successfully. Try again");
					window.location.replace("./registration.php");
				</script>
<?php
			}   
		}
	}
	
?>