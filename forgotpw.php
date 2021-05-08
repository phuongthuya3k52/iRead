<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex">
<title>Forgot Password</title>
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

<?php
	require_once("./db.php");
    session_start();
    $error = '';
    $success = '';
    if (isset($_SESSION['errors'])) {
        $error = $_SESSION['errors'];
    }

	if (isset($_SESSION['success'])) {
    	$success = $_SESSION['success'];
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
						<h3 class="page-header" style="text-align: center;">Forgot Password</h3>
							
						<form action="sendmail.php" method="post" role="form">
							<div class="row1"  >
								<div class="col-25">
										<label for="email" class="control-label requiredField" style="margin-left: 10%">Email</label>
								</div>
								
								<div class="col-75 controls">
											<input style="width: 90%"name="email" type="text" maxlength="100" autofocus="autofocus" required="required" placeholder="Email address" class="textinput textInput" id="id_email"/>
									<?php
                        			if (!empty($error)) {
                            			echo "<div class='alert alert-danger' style='width: 80%'>$error</div>";
                        			}
                   				 ?>

                    			<?php
                        			if (!empty($success)) {
                        				echo "<div class='alert alert-success' style='width: 80%'>$success</div>";
                    				}
                    			?>
							</div>
							<div class="row1"  >
								<div class="col-25"></div>
								<div class="col-75">
										<button type="submit" class="btn btn-primary btn-lg" name="forgotpw" value = "forgotpw"data-loading-text="Login">
										 Send Email</button>
								</div>
							</div>		
							<div class="row1">
								<div class="col-25"></div>
								<div class="col-75" style="font-size: 16px; text-align: left">
										<br>
										<i class="icon-arrow-right"></i> <a href="login.php" >Back to login</a><br>

										<i class="icon-arrow-right"></i> <a href="registration.php">  Register new account</a> <br>
								</div>
							</div>						
						</form>
					</div>  
			<!--	</div>
			</div>
			-->
	</div>
</div>
<?php unset($_SESSION['errors']); unset($_SESSION['success']) ?>
</body>
</html>