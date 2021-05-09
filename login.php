<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/yamm.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/chosen.css" rel="stylesheet">
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
		
		// Clear text box
		$('button[type=reset]').click(function(){
			var label = $('label');
			label.removeClass('animated fadeInLeft fadeOutLeft').addClass('animated fadeOutLeft');
		});

	});
</script>

<?php
	require_once("./db.php");
    session_start();
    unset($_SESSION['success']);

           
	if (isset($_POST['username'])&& isset($_POST['password'])){
		$us=$_POST['username'];
		$pw=md5($_POST['password']);

		$us = stripslashes($us);
		$pw = md5(stripslashes($pw));


		$sql= "select * from account where Username='" .$us ."'and Password='".$pw ."'";
		$row=query($sql);
		$role = $row[0][2];
		$email = $row[0][3];
		$status = $row[0][6];



		if ($us != "" && $pw !=""){
			if (count($row)>0 && $status == 1){	
				$_SESSION['username'] = $us;
				$_SESSION['role'] = $role;

				if ($role == 'member'){

					$_SESSION['username'] = $us;
					header("Location: ./home.php");
    				die();
				}
				else{
					$_SESSION['username'] = $us;
					header("Location: ./admin/admin.php");
					die();
				}
    										
			}elseif (count($row)>0 && $status != 1) {
?>				<script >
					alert ("The account is not activated. Please check the registered email to activate your account  ");
					window.location.replace("./login.php");
				</script>
			<?php 
			}else{
?>				<script >
					alert ("Username or Password is not correct");
					window.location.replace("./login.php");
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
	<!--	<div class="span12">
			<div class="container">
				<div class="row">   -->
					<div class="container2">   
						<h1 class="page-header" style="text-align: center;">LOGIN</h1>
							
						<form action="login.php" method="post" role="form">
							<div class="row1"  >
								<div class="col-25">
										<label for="id_username" class="control-label requiredField">Username<span class="asteriskField">*</span></label>
								</div>
								
								<div class="col-75 controls">
											<input style="width: 90%" name="username" require ="require"maxlength="20" type="text" autofocus="autofocus" required="required" placeholder="Username" class="textinput textInput" id="id_username"/>
							</div>
							<div class="row1"  >
								<div class="col-25">
										<label for="id_password" class="control-label requiredField">Password<span class="asteriskField">*</span></label>
								</div>
								<div class="col-75 controls">
											<input style="width: 90%" name="password" require ="require"placeholder="Password" required="required" maxlength="25"type="password" class="textinput textInput" id="id_password"/>
								</div>
							</div>
							<div class="row1"  >
								<div class="col-25"></div>
								<div class="col-75">
										<button type="submit" class="btn btn-primary btn-lg" data-loading-text="Login">
										 Login</button>&emsp;&emsp; 

										<button type="reset" class="btn btn-default">Clear</button>
								</div>
							</div>		
							<div class="row1">
								<div class="col-25"></div>
								<div class="col-75" style="font-size: 16px; text-align: left">
										<br>
										<i class="icon-arrow-right"></i> <a href="registration.php">  Register new account</a> <br>

										<i class="icon-arrow-right"></i> <a href="forgotpw.php">Forgot password</a>
								</div>
							</div>						

					</div>  
			<!--	</div>
			</div>
			-->
	</div>
</div>

</body>
</html>