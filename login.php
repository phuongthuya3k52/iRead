<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta name="description" content="">
<meta name="keywords" content="Doc truyen online, truyen kiem hiep, truyen tien hiep, truyen sac hiep, truyen ngon tinh, truyen trinh tham, vong du, truyen convert full text">
<meta name="robots" content="noindex">
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

		// Clear text box
		$('button[type=reset]').click(function(){
			var label = $('label');
			label.removeClass('animated fadeInLeft fadeOutLeft').addClass('animated fadeOutLeft');
		});

	/*	$('button[type=submit]').button('reset').removeAttr('disabled');

		$('form').submit(function(){
			var form = $(this);
			form.find('button[type=reset]').attr('disabled', 'disabled');
		});   */
	});
</script>

<?php
	require_once("./db.php");
    session_start();

           
	if (isset($_POST['username'])&& isset($_POST['password'])){
		$us=$_POST['username'];
		$pw=md5($_POST['password']);
		$sql= "select * from account where Username='" .$us ."'and Password='".$pw ."'";
		$row=query($sql);

		if ($us != "" && $pw !=""){
			if (count($row)>0){	
				$_SESSION['username'] = $us;

				if ($row[0][2] == 'member'){

					header("Location: ./home.php");
    				die();
				}
				else{
					header("Location: ./admin.php");
					die();
				}
    										
			}			
			else{
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
	<div class="row">
	<!--	<div class="span12">
			<div class="container">
				<div class="row">   -->
					<div class="span12 auth">   
						<h1 class="page-header" style="text-align: center;">LOGIN</h1>

						<div class="row"  >
							<table width="30%" align="center" cellspacing="40px">
								<form action="login.php" method="post" role="form">
								<tr>
									<td>
										<label for="id_username" class="control-label requiredField">Username<span class="asteriskField">*:</span></label>
									</td>

									<td>
										<div class="controls">
											<input name="username" require ="require"maxlength="254" type="text" autofocus="autofocus" required="required" placeholder="Username" class="textinput textInput" id="id_username"/>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="id_password" class="control-label requiredField">Password<span class="asteriskField">*:</span></label>
									</td>
									<td>
										<div class="controls">
											<input name="password" require ="require"placeholder="Password" required="required" type="password" class="textinput textInput" id="id_password"/>
										</div>
									</td>
								</tr>
					 			<tr>
					 				<td></td>
									<td >
										<button type="submit" class="btn btn-primary btn-lg" data-loading-text="Login">
										 Login</button> 

										<button type="reset" class="btn btn-default">Clear</button>
									</td>

								<tr>
									
									<td colspan="2" style="font-size: 17px; text-align: center">
										<br>
										<i class="icon-arrow-right"></i> <a href="registration.php">Register new account</a>
										
								</tr>
							</table>
						
						</div>

					</div>  
			<!--	</div>
			</div>
			-->
	</div>
</div>

</body>
		    

<!--
<script>
	(function(d,s,a,i,j,r,l,m,t){
		try{
			l=d.getElementsByTagName('a');t=d.createElement('textarea');
			for(i=0;l.length-i;i++){
				try{a=l[i].href;s=a.indexOf('/cdn-cgi/l/email-protection');
				m=a.length;if(a&&s>-1&&m>28){j=28+s;s='';

				if(j<m){
					r='0x'+a.substr(j,2)|0;for(j+=2;
					j<m&&a.charAt(j)!='X';
					j+=2)s+='%'+('0'+('0x'+a.substr(j,2)^r).toString(16)).slice(-2);j++;
					s=decodeURIComponent(s)+a.substr(j,m-j)}t.innerHTML=s.replace(/</g,'&lt;').replace(/\>/g,'&gt;');
					l[i].href='mailto:'+t.value}}catch(e){}}}catch(e){}

	})(document);/* ]]> */
</script>
-->
</html>