<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta name="description" content="">
<meta name="keywords" content="Doc truyen online, truyen kiem hiep, truyen tien hiep, truyen sac hiep, truyen ngon tinh, truyen trinh tham, vong du, truyen convert full text">
<meta name="robots" content="noindex">
<title>Registration | iRead</title>
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
	require_once("./db.php");
	require_once __DIR__."/send_mail/SendMail.php";
	date_default_timezone_set("Asia/Ho_Chi_Minh");

	if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']))
	{
		$fullname=$_POST['fullname'];
		$dob=$_POST['dob'];
		$phone=$_POST['phonenumber'];
		$email=$_POST['email'];
		$uname=$_POST['username'];
		$pass=md5($_POST['password']);

		$uname = stripslashes($uname);
		$pass = md5(stripslashes($pass));

		$errormsg= False;

		$sql= "SELECT username FROM account WHERE username='".$uname ."'";
		$row= query($sql);

		$sql1= "SELECT email FROM account WHERE email='".$email ."'";
		$result1= execsql($sql1); 
		if($result1 != "null"){
			$row1= query($sql1);
			if(count($row1) > 0)
			{
				$is_exit = 1;
			}else{
				$is_exit = 0;
			}
		}else{
			$is_exit = 0;
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
	<!--	<div class="span12">
			<div class="container">
				<div class="row"> -->
					<div class="container3">
						<h1 h1 class="page-header" style="text-align: center">Register</h1>

						<form action="registration.php" method="post" role="form">
						<div class="row1">
							<div class="col-25">
								<label for="id_email" class="control-label requiredField">Email<span class="asteriskField">*</span></label>
							</div>

							<div class="col-75 controls">
							<?php
								if(isset($_POST['email'])){
									if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$^", $email))
									{ 
										$emailErr = "Email <b>$email</b> is invalid. Please try again";	
									}else if($is_exit == 1){

										$emailErr = "Email <b>$email</b> is already exit. Please choose another one";
									}
									else{
										$emailErr = "";
									}
									if(isset($emailErr)){
										echo("<label class='error' id = 'erEmail' style='display: block; width:90%'>".$emailErr ."</label>");
											
										$errormsg = True;
									}
								}	
							?>
								<input style="width: 90%"name="email" type="text" maxlength="100" autofocus="autofocus" required="required" placeholder="Email address" class="textinput textInput" id="id_email"/>
							</div>
						</div>
									
						<div class="row1">
							<div class="col-25">
								<label for="id_fullname" class="control-label requiredField">Fullname<span class="asteriskField">*</span>
								</label>
							</div>
							<div class="col-75">
								<input style="width: 90%" name="fullname" maxlength="254" type="text" required="required" placeholder="Full name" class="textinput textInput" id="id_fullname" title="Max length of Full name is 254 characters"/>
							</div>
						</div>

						<div class="row1">
							<div class="col-25">
								<label for="id_phonenumber" class="control-label"><b>Phone number</b></label>
							</div>
							<div class="col-75">
								<input style="width: 90%" name="phonenumber" maxlength="15" type="text"placeholder="Phone number" class="textinput textInput" id="id_phonenumber" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" title="Please enter the correct format phone number " />
							</div>
						</div>

						<div class="row1">
							<div class="col-25">
								<label for="id_dob" class="control-label"><b>Date of birth</b>
								</label>
							</div>
							<div class="col-75">
								<input style="width: 90%" name="dob" type="date" class="textinput textInput" id="id_dob"/>
							</div>
						</div>

						<div class="row1">
							<div class="col-25">
								<label for="id_username" class="control-label requiredField">Username<span class="asteriskField">*</span></label>
							</div>

							<div class="col-75 controls">
							<?php
								if(isset($_POST['username']) && count($row) > 0){ 

									echo("<label class='error' id = 'erEmail' style='display: block; width:90%'> Username " .$_POST['username'] ." already exists. Please choose another username </label>");
									$errormsg = True;
								}
							?>
									<input style="width: 90%" name="username" maxlength="254" type="text"  required="required" placeholder="Username" class="textinput textInput" id="id_username"/>
							</div>
						</div>

						<div class="row1">
							<div class="col-25">
								<label for="password" class="control-label requiredField">Password<span class="asteriskField">*</span></label>
							</div>
							<div class="col-75 controls">
								<input style="width: 90%" name="password" max="20" min="6" placeholder="Password" type="password" class="textinput textInput" id="password" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 6 characters" required = "required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
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

						<div class="row1" style="text-align: center;">
							<i>Note: When registering an account, you agree with the Website Rules.</i>
										
							<br><br>
						</div>

					 	<div class="row1">
							<div class="col-50">
								<div class="col-25">
								</div>

								<div class="col-75" style="text-align: center;">
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
		<!--		</div>
			</div>
			
			<div class="clearfix"></div>
			<hr/>
			
			</div>  -->
			
			
		</div>
	</div>
</div>
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

		$uname = stripslashes($uname);
		$pass = md5(stripslashes($pass));

		if($errormsg == False){
			$token = substr(md5(rand(0,10000)),0,16);
            $creattime = date('Y-m-d H:i:s');

			$sql2= "Insert into account values ('" .$uname ."','" .$pass."','member','".$email ."','" .$token ."','" .$creattime ."','0')";
			$result2 = execsql($sql2);
			//echo('result: =' .$result);
			$sql5 = "Insert into member values ('','" .$fullname ."','" .$dob ."','" .$phone ."','" .$uname ."','0','default avt.jpg')"; 

			$result5 = execsql($sql5);  
			echo('result5: =' .$result5);

		//Send verification email  
			$title = 'Create Account';
            $content = "<h3> Dear ". $fullname. "</h3>";
            $content .= "<p>We have received a request to create your account recently.</p>";
            $content .= "<p>Please click <a href='http://iread.net/registration.php?email=".$email."&token=".$token."'> here </a> to activate your account .</p>";
            $content .= "<p>This link is valid only within <b>20 minutes</b>.</p>";
            $sendMai = send($title, $content, $fullname, $email);

            if ($sendMai) {  
    ?>				
				<script >
					alert ("We sent you an email please check it to activate your account!");
					window.location.replace("./login.php");
				</script>
	<?php 
            } else {
    ?>				
				<script >
					alert ("An error has occurred, the account cannot be created. Please try again!");
					window.location.replace("./registration.php");
				</script>
	<?php 
            }
									  
		}
	}

// Check token from email
    if (isset($_GET['email']) && isset($_GET['token']))
	{
		$cf_email=$_GET['email'];
		$cf_token=$_GET['token'];
		$sql3= "SELECT * FROM account WHERE email='".$cf_email ."'";
		$row3= query($sql3);
		$status = $row3[0][6];
		$token = $row[0][4];

		if($token != $cf_token){
?>
			<script>
				alert ("This token does not exist. Please try again!");	
					window.location.replace("./forgotpw.php");
			</script>	
	<?php					
		}else{

			$create_time = strtotime($row3[0][5]);
			$currenttime = strtotime(date('Y-m-d H:i:s'));
			if(($currenttime - $create_time) > 60*20 && $status == 0)
			{
				$sql7= "SELECT * FROM account WHERE email='" .$cf_email ."'";
        		$row7 =query($sql7);
        		$user_name = $row7[0][0];

        		$sql8= "DELETE FROM member WHERE username='" .$user_name ."'";
        		$result8 =execsql($sql8);

				$sql4= "DELETE FROM account WHERE email='" .$cf_email ."'";
        		$result4 =execsql($sql4);
        			
        		if($result4 != null){
	?>
					<script>
						alert ("This token is out of date. Please try again!");	
						window.location.replace("./registration.php");
					</script>	
	<?php			
				} 
			}else{
	
				$sql6= "UPDATE account SET token='', createAt='', status =1 WHERE email='" .$cf_email ."'";
				//echo("sql6 = ".$sql6);
        		$result6 = execsql($sql6);
        		//echo('result6: =' .$result6);

        		if($result6 != null){
		?>				
					<script >
						alert ("Account activation is successful!");
						window.location.replace("./login.php");
					</script>
		<?php 		
				}else{
	?>				
					<script >
						alert ("Account activation failed . Please Try again!");
						window.location.replace("./registration.php");
					</script>
	<?php
				} 
			}
		}	
	}
	
?>  
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