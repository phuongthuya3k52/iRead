<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password</title>
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


<?php
	session_start();	
	require_once("./db.php");
	date_default_timezone_set("Asia/Ho_Chi_Minh");

	if (isset($_GET['email']) && isset($_GET['token']))
	{
		$email=$_GET['email'];
		$token=$_GET['token'];

	// Delete expired tokens
		$sql= "SELECT * FROM account WHERE email='".$email ."'";
		$row= query($sql);
		$createtime = strtotime($row[0][5]);
		$currenttime = strtotime(date('Y-m-d H:i:s'));
		if(($currenttime - $createtime) > 60*2000){
			$sql1= "UPDATE account SET token='', createAt='' WHERE email='" .$email ."'";
        	$result1 =execsql($sql1);
        	if($result1 != null){
?>
				<script>
					alert ("This token does not exist or is out of date. Please try again!");	
					window.location.replace("./forgotpw.php");
				</script>	
	<?php			
			} 
		}		
	}else{
		header("Location:./forgotpw.php");
}

// Reset password	

	if(isset($_POST['password']) && isset($_POST['cf_password']) && isset($_POST['email']) && isset($_POST['token'])) 
		{
		
			$error_change_pass = array();
			$pass = $_POST['password'];
			$cf_password = $_POST['cf_password'];
			$email = $_POST['email'];
			$token = $_POST['token'];

			if($pass != $cf_password){
				$error_change_pass[] = "The Confirm Password and Password are not the same.";
			}

			if(!empty($error_change_pass))
			{ 
				//print_r($error_change_pass);
	?>
			<script>
				alert ("<?php for($i=0; $i<sizeof($error_change_pass); $i++){echo $error_change_pass[$i] . " ";echo(" Please try again!");} ?>");	
			</script>	
	<?php		
			}else{  

				$sql2 = "UPDATE account SET password='" .md5($pass) ."' WHERE email='" .$email ."'"; 

				$result2 = execsql($sql2);
			//	echo("result2 = ".$result2);
				if($result2 != null)
				{
	?>				
					<script >
						alert ("Reset password successfully!");
						window.location.replace("./login.php");
					</script>
	<?php 		
				}else{
	?>				
					<script >
						alert ("Reset password is not successfully. Please try again");
					//	window.location.replace("./resetpw.php?email=<?=$email?>&token=<?=$token?>");
					</script>
	<?php							
				}  
			}  
		}

?>

<body>

<div class="yamm navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand iread-logo" href="./login.php">iRead</a>
		</div>
	</div>
</div>

<div class="container">
	<div class="bg-img1">
	
		<div class="container3">
			<h1 h1 class="page-header" style="text-align: center">Reset Password</h1>

			<form action="resetpw.php?email=<?=$email?>&token=<?=$token?>" method="post" role="form">
				<div class="row1">
					<div class="col-25">
						<label for="password" class="control-label requiredField">Password<span class="asteriskField">*</span></label>
					</div>
					<div class="col-75 controls">
						<input style="width: 90%" name="password" placeholder="Password" type="password" class="textinput textInput" id="password" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 6" required = "required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
					</div>
				</div>

				<div class="row1">
					<div class="col-25">
						<label for="password" class="control-label requiredField">Confirm Password<span class="asteriskField">*</span></label>
					</div>
					<div class="col-75 controls">
						<input style="width: 90%" type="password" placeholder="Confirm Password" name="cf_password" required="required" id="cf_password" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 6 characters" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
					</div>
				</div>

				<div class="row1">
					<div class="col-25"></div>
							
					<div class="col-75" >
						<div id="message">
  							<h6>Password must contain the following:</h6>
  							<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  							<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  							<p id="number" class="invalid">A <b>number</b></p>
  							<p id="length" class="invalid">Minimum <b>6 characters</b></p>
  						</div>
  						<div id="message1" style="display: none">
  							<p id="the_same" class="invalid">Confirm Password and Password <b> are the same</b></p>
  						</div>
					</div>	
				</div>

				<div class="row1">
					<div class="col-50">
						<div class="col-25"></div>

						<div class="col-75" style="text-align: center;">
							<input type="hidden" name="email" id="email" value="<?=$email?>">
							<input type="hidden" name="token" id="token" value="<?=$token?>">
							<button type="submit" name="submit" class="btn btn-primary" data-loading-text="Loading" id="submit"  >
									Submit
							</button>
						</div>
					</div>
					<div class="col-50">
						<div class="col-25" style="text-align: left;">
							<button type="reset" class="btn btn-default">Clear</button>
						</div>
					</div>
				</div>
									
							
				<div class="row1" style="font-size: 17px; text-align: center">
					<br>
					<i class="icon-arrow-right"></i> <a href="./login.php">Back to Login</a>		
				</div>
			</form>		
						
		</div>

		</div>
	</div>
</div>
</body>
</html>

<!-- validate password -->
<script>
var myInput = document.getElementById("password");
var myInput1 = document.getElementById("cf_password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
  document.getElementById("message1").style.display = "none";
}
myInput1.onfocus = function() {
  document.getElementById("message").style.display = "none";
  document.getElementById("message1").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}
myInput1.onblur = function() {
  document.getElementById("message1").style.display = "none";
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

myInput1.onkeyup = function() {
  // Validate lowercase letters
  if(myInput1.value == myInput.value) {
    the_same.classList.remove("invalid");
    the_same.classList.add("valid");
  } else {
    the_same.classList.remove("valid");
    the_same.classList.add("invalid");
	}
}
</script>