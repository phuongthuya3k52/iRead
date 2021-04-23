<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta name="description" content="Truyện Hot 24h hay nhất và mới nhất. Đọc truyện online nhiều thể loại tại TruyệnYY - Kho truyện được tuyển chọn và biên tập tốt nhất.">
<meta name="keywords" content="Doc truyen online, truyen kiem hiep, truyen tien hiep, truyen sac hiep, truyen ngon tinh, truyen trinh tham, vong du, truyen convert full text">
<link rel="alternate" type="application/atom+xml" title="Đọc Truyện Online - Truyện Kiếm Hiệp" href="http://feeds.feedburner.com/truyenyy">
<title>Transaction Histories | Admin | iRead</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<link href="../css/yamm.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="../css/chosen.css" rel="stylesheet">
<link rel="icon" type="image/png" href="../img/favicon.png"/>
<link href="https://plus.google.com/103281900225927837176/" rel="author">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/chosen.jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/csrf.js"></script>
<style>
	body{
		padding-top:60px;padding-bottom:40px;height:auto;
	}
</style>

</head>

<?php
  require_once("../db.php");
  session_start();


    if(!isset($_SESSION['username'])){
?>
      <script >
      alert ("You must login to access this page!");
      window.location.replace("../login.php");
    </script>
<?php
  }else if($_SESSION['role'] != "admin"){
?>
      <script >
      alert ("You do not have permission to access this page!");
      window.location.replace("../home.php");
    </script>
<?php    
  }else{
  	// Fillter

  	if(isset($_SESSION['page']) && $_SESSION['page'] == "admin"){
  		$_SESSION['page'] = "admin";
  	}else{
  		$_SESSION['page'] = "member";
  	}

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
		//echo("sql1 = ".$sql1);
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
  }
?>

<body>
<?php 
	require_once("./header.php");
?>

<div class="container">
<div class="container-fluid">
	<div class="row col-md-12 wrapper">
		
			<ul class="breadcrumb">
				<li>
					<div itemscope>
						<a href="admin.php" itemprop="url"><span itemprop="title">Dash board</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li>
					<div itemscope>
						<a href="./memberlist.php" itemprop="url"><span itemprop="title">Activate Member List</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong>New Account</strong></li>
			</ul>
	</div>
	<div class="row wrapper ">
				
		<h1 style="text-align: center;margin-top: 10px;"> New Account</h1>
	
		<div class="table-responsive" style="margin-top: 40px; width:100%"> 
			<form action="newaccount.php" method="post" role="form">
				<div class="row1">
					<div class="col-25">
						<label for="role" class="control-label requiredField">Role<span class="asteriskField">*</span></label>
					</div>

					<div class="col-75 controls">
					<?php
						if($_SESSION['page'] == "admin"){
					?>
						<select name="type_acc" id="type_acc" style="width: 100px;font-size: 15px;" >
					  		<option value="admin" style="font-size: 15px;" selected="selected">Admin</option>
					  		<option value="member" style="font-size: 15px;">Member</option>
						</select>
										
					<?php
						}
						if($_SESSION['page'] == "member"){
					?>
							<select name="type_acc" id="type_acc" style="width: 100px;font-size: 15px;" >
					  			<option value="admin" style="font-size: 15px;">Admin</option>
					  			<option value="member" style="font-size: 15px;" selected="selected">Member</option>
							</select>
					<?php
						}
					?>
					</div>
				</div>
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
							}elseif($is_exit == 1){

								$emailErr = "Email <b>$email</b> is already exit. Please choose another one.";
							}else{
								$emailErr = "";
							}
							if($emailErr != ""){
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

						<div class="col-75" style="text-align: right;">
							<button type="submit" name="submit" class="btn btn-primary" data-loading-text="Loading" id="submit"  >Submit</button>
						</div>
					</div>
					<div class="col-50">
						<div class="col-25" style="text-align: center;">	
						</div>
						<div class="col-75" style="text-align: center;">
							<button type="reset" class="btn btn-default">Clear</button>
						</div>
					</div>
				</div>

				<div class="row1" style="font-size: 17px; text-align: center">
					<br>
					<div class="col-25"></div>

					<div class="col-75" style="text-align: left;">
						<i class="icon-arrow-right"></i> <a href="./memberlist.php">Back to Account List</a>
					</div>
							
				</div>
			</form>	
			
		</div>

			<div class="row wrapper"></div>			
			<?php 
			require_once("../footer.php");
		?>

		</div>
	</div>
</div>
</body>
</html>

<?php
	if(isset($_POST['type_acc']) && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']))
	{
		$role = $_POST['type_acc'];
		$fullname=$_POST['fullname'];
		$dob=$_POST['dob'];
		$phone=$_POST['phonenumber'];
		$email=$_POST['email'];
		$uname=$_POST['username'];
		$pass=md5($_POST['password']);

		$uname = stripslashes($uname);
		$pass = md5(stripslashes($pass));

		if($errormsg == False){

			$sql2= "Insert into account values ('" .$uname ."','" .$pass."','$role','".$email ."','','','1')";
			$result2 = execsql($sql2);
			//echo('result: =' .$result);
			if($result2 != null)
			{
				$sql3 = "Insert into member values ('','" .$fullname ."','" .$dob ."','" .$phone ."','" .$uname ."','0','default avt.jpg')"; 

				$result3 = execsql($sql3);  
				//echo('result3: =' .$result3);
				if($result3 != null)
				{
			?>				
					<script >
						alert ("Create a new <?=$role?> account successfully");
						window.location.replace("./memberlist.php");
					</script>
			<?php
				}else{
			?>				
					<script >
						alert ("Create a new <?=$role?> account failed. Please Try again");
						window.location.replace("./memberlist.php");
					</script>
		<?php
				}
			}else{
		?>
				<script >
						alert ("Create a new <?=$role?> account failed. Please Try again");
						window.location.replace("./memberlist.php");
					</script>
		<?php
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