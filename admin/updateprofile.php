<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

// Get infomation
	if (isset($_GET['memberID']))
	{
		$memberID = $_GET['memberID'];
		$sql= "SELECT * FROM member WHERE memberID='".$memberID ."'";
		$row= query($sql);
		$full_name=$row[0][1];
		$dob=$row[0][2];
		if($row[0][3] == null){
			$phone="";
		}else{
			$phone=$row[0][3];
		}
		
		$uname=$row[0][4];
		$image=$row[0][6];

		$sql1= "SELECT * FROM account WHERE username='".$uname ."'";
		$row1= query($sql1);
		$role=$row1[0][2];
		$email=$row1[0][3];
	}

  	if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['inpImage']) && isset($_POST['type_acc']))
	{
		$fullname=$_POST['fullname'];
		$dob=$_POST['dob'];
		$phone=$_POST['phonenumber'];
		$new_email=$_POST['email'];
		$avatar = $_POST['inpImage'];
		$role_mem = $_POST['type_acc'];

		$errormsg= False;

		$sql= "SELECT username FROM account WHERE username='".$uname ."'";
		$row= query($sql);

		if($email != $new_email){
			$sql1= "SELECT email FROM account WHERE email='".$new_email ."'";
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
		}else{
			$is_exit = 0;
		}
	}
  }
?>

<body>
<?php 
	require_once("../headers/admin_header.php");
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
				<li class="active"><strong>Update User Profile</strong></li>
			</ul>
	</div>
	<div class="row wrapper ">
				
		<h1 style="text-align: center;margin-top: 10px;">Update User Profile</h1>
	
		<div class="table-responsive" style="margin-top: 40px; width:100%"> 
			<form action="updateprofile.php?memberID=<?=$memberID?>" method="post" role="form">
				<div class = "row1">
					<div class="col-25">
						<label for="id_title" class="control-label requiredField"> Cover image<span class="asteriskField">*</span></label>
						<img style="background-color: white; width:200px; height: 200px; margin-top: 0px; " id="image" src="../img/<?=$image?>"/>
							<input style = "width: 100%;" id="inpImage" type='file' name="inpImage" value="<?=$image?>">

							<script type="text/javascript">
							// Change URL of image to base64
								function readFile() {

            						if (this.files && this.files[0]) {

                						var fileReader = new FileReader();

                						fileReader.addEventListener("load", function (e) {
                    						document.getElementById("image").src = e.target.result;
                						});

                						fileReader.readAsDataURL(this.files[0]);
            						}
        						}

        					// Show image to review
								window.onload = function () {
            						document.getElementById("inpImage").addEventListener("change", readFile);
        						};
							</script>
					</div>
					<div class="col-75 controls">
						<div class="row1">
							<div class="col-25">
								<label for="role" class="control-label requiredField">Role<span class="asteriskField">*</span></label>
							</div>

							<div class="col-75 controls">
							<?php
								if($role == "admin"){
							?>
								<select name="type_acc" id="type_acc" style="width: 100px;font-size: 15px;" >
							  		<option value="admin" style="font-size: 15px;" selected="selected">Admin</option>
							  		<option value="member" style="font-size: 15px;">Member</option>
								</select>
												
							<?php
								}
								if($role == "member"){
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
								<input style="width: 90%"name="email" type="text" maxlength="100" autofocus="autofocus" required="required" placeholder="Email address" class="textinput textInput" id="id_email" value="<?=$email?>" />
							</div>
						</div>
											
						<div class="row1">
							<div class="col-25">
								<label for="id_fullname" class="control-label requiredField">Fullname<span class="asteriskField">*</span>
								</label>
							</div>
							<div class="col-75">
								<input style="width: 90%" value="<?=$full_name?>"name="fullname" maxlength="254" type="text" required="required" placeholder="Full name" class="textinput textInput" id="id_fullname" title="Max length of Full name is 254 characters"/>
							</div>
						</div>

						<div class="row1">
							<div class="col-25">
								<label for="id_phonenumber" class="control-label"><b>Phone number</b></label>
							</div>
							<div class="col-75">
								<input style="width: 90%" value="<?=$phone?>" name="phonenumber" maxlength="15" type="text"placeholder="Phone number" class="textinput textInput" id="id_phonenumber" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" title="Please enter the correct format phone number " />
							</div>
						</div>

						<div class="row1">
							<div class="col-25">
								<label for="id_dob" class="control-label"><b>Date of birth</b>
								</label>
							</div>
							<div class="col-75">
								<input style="width: 90%" name="dob" type="date" class="textinput textInput" id="id_dob" value="<?=$dob?>"/>
							</div>
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
			require_once("../footers/footer.php");
		?>

		</div>
	</div>
</div>
</body>
</html>

<?php
	if(isset($_POST['type_acc']) && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['inpImage']))
	{
		$role = $_POST['type_acc'];
		$fullname=$_POST['fullname'];
		$dob=$_POST['dob'];
		$phone=$_POST['phonenumber'];
		$email=$_POST['email'];
		if($_POST['inpImage'] == ""){
			$avatar = $image;
		}else{
			$avatar = $_POST['inpImage'];
		}
		$role_mem = $_POST['type_acc'];

		if($errormsg == False){

			$sql2= "UPDATE account SET role ='".$role_mem ."',email ='".$email ."' WHERE username='" .$uname ."'";
			$result2 = execsql($sql2);
			//echo('result2: =' .$result2);
			if($result2 != null)
			{
				$sql3 = "UPDATE member SET fullName='" .$fullname ."', dob='" .$dob ."', phoneNumber='" .$phone ."', image='".$avatar."' WHERE memberID='" .$memberID ."'";

				//echo("$sql3 = ".$sql3);
				$result3 = execsql($sql3);  
				//echo('result3: =' .$result3);
				if($result3 != null)
				{
			?>				
					<script >
						alert ("Update account successfully");
						window.location.replace("./memberlist.php");
					</script>
			<?php
				}else{
			?>				
					<script >
						alert ("Update account failed. Please Try again");
						window.location.replace("./memberlist.php");
					</script>
		<?php
				} 
			}else{
		?>
				<script >
						alert ("Update account failed. Please Try again");
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