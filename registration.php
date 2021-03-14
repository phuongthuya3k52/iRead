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
											<label for="id_fullname" class="control-label requiredField">Fullname<span class="asteriskField">*</span>
											</label></td>
										<td>
											<input name="fullname" maxlength="254" type="text" autofocus="autofocus" required="required" placeholder="Fullname" class="textinput textInput" id="id_fullname"/>
										</td>
										<td></td>
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
											
									</td>
								</tr>
								<tr>
									<td>
											<label for="id_dob" class="control-label">Date of birth
											</label></td>
										<td>
											<input name="dob" type="date" class="textinput textInput" id="id_dob"/>
										</td>
										<td></td>
									<td>
										<label for="id_password" class="control-label requiredField">Password<span class="asteriskField">*</span></label>
									</td>
									<td>
										<div class="controls">
											<input name="password" placeholder="Password" required="required" type="password" class="textinput textInput" id="id_password"/>
										<!--	<label class='error' id = 'erPassword' style="display: none;"> This username already exists. Please choose another username </label>  -->
									</td>
								</tr>
								<tr>
									<td>
										<label for="id_phonenumber" class="control-label">Phone number</label>
									</td>
										<td>
											<input name="phonenumber" maxlength="15" type="text" autofocus="placeholder="Phone number" class="textinput textInput" id="id_phonenumber"/>
										</td>
										<td></td>
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
											<input name="email" type="text" maxlength="100" required="required" placeholder="Email address" class="textinput textInput" id="id_email"/>
											
										</div>
									</td>
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
										<button type="submit" class="btn btn-primary" data-loading-text="Loading">
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
										<i class="icon-arrow-right"></i> <a href="login.php">Back to Login</a>
										
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
</html>
<?php 
	if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']))
	{
		if($errormsg == False){
			$sql = "Insert into member values (" .",'" .$fullname ."','" .$dob ."','" .$phone ."','" .$uname ."',0)";

			

			$sql1= "Insert into account values ('" .$uname ."','" .$pass."','member','".$email ."')";

			echo($sql);
			echo($sql1);

			$result = execsql($sql);
		/*	$result1 = execsql($sql1);  */
						
			if ($result != null && $result1 != null){
				echo ('<span style="color:red; font-size: 20px">Sign up successfully</span>');
				header("Location: ./login.php");
    				die();
			}else{
				echo ('<span style="color:red; font-size: 20px">Try again</span>');
			}
		}
	}

	
?>