<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<link rel="canonical" href=" "/>
<title>iRead | Profile</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/yamm.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/chosen.css" rel="stylesheet">
<link rel="icon" type="image/png" href="img/favicon.png"/>
<link href="https://plus.google.com/103281900225927837176/" rel="author">
<script src="js/jquery-1.12.4.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/csrf.js"></script>
<style>
	body{padding-top:60px;padding-bottom:40px;height:auto;}
</style>

</head>
<?php
	require_once("./db.php");
    session_start();


    if(!isset($_SESSION['username'])){
?>
    	<script >
			alert ("You must login to access this page!");
			window.location.replace("./login.php");
		</script>
<?php
	}else{
		$sql = "SELECT * FROM member WHERE username = '" .$_SESSION['username'] . "'";
			//echo($sql);
			$row = query($sql);
			$memberID = $row[0][0];
			$memberName = $row[0][1];
			$dob = $row[0][2];
			$phoneNumber = $row[0][3];
			$walet = $row[0][5];
			$image = $row[0][6];

			$sql1 = "SELECT * FROM account WHERE username = '" .$_SESSION['username'] . "'";
			$row1 = query($sql1);
			$user = $row1[0][0];
			$pass = $row1[0][1];
			$email = $row1[0][3];
			//echo($sql1);	
			
			$errormsg = False;
	}

?>

<body>
<?php 
	require_once("./headers/common_header.php");
?>


<div class="container">
	<div class="row">
		<div class="span12">
			<ul class="breadcrumb">
				<li>
					<div itemscope>
						<a href="home.php" itemprop="url"><span itemprop="title">Home</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong>My Profile</strong></li>
			</ul>

			<div class="row wrapper">
				<?php 
					require_once("./lefts/common_left.php");
				?>
				<div class="span10">

				<!-- Result of member -->
					<div class="thumbnails">
						<div class="bg-img">
  								<img src="./img/<?=$image?>" class="avatar" style="border-radius: 50%;  ">
						</div>
						<h3 style="text-align: center;position: relative; margin-top:100px; top: 50%; left: 50%; transform: translate(-50%, -25%)"><?=$memberName?></h3>
						<div style="text-align: center;position: relative; font-size: 20px; font-weight: bold;">
							<a href="" style="color: black"><img src="./img/coin.jpg" style="border-radius: 50%; width: 35px;height: 35px;"><?=$walet?></a>
						</div>
						

					<div class="thumbnails">
					
						<h3 style="color: #D36337">Profile</h3>
						<hr>
						<div class="container1">
							<form action="./profile.php" method="POST">
    							<div class="row1">
      								<div class="col-25 input-prepend">	
    									<span class="add-on"><i class="icon-user"></i></span>
    									<input style="width: 70%" id="id_fullname" type="text" placeholder="Full name" name="fullname" maxlength="254" required="required" title="Max length of Full name is 254 characters" value="<?=$memberName?>"><span class="required">*</span>
  								
      								</div>
      								<div class="col-75 input-prepend">
      									<?php
												if(isset($_POST['email'])){
													$new_email = $_POST['email'];
													$sql8 = "SELECT * FROM account WHERE email = '" .$new_email . "'";
													$row8 = query($sql8);
													if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$^", $new_email))
													{ 
														$emailErr = "Email is invalid. Please try again";	
													}else if(count($row8) > 0 && $new_email != $email){

														$emailErr = "Email is already exit. Please choose another one";
													}
													if(isset($emailErr)){
														echo("<label class='error' id = 'erEmail' style='display: block;'>".$emailErr ."</label>");
											
														$errormsg = True;
													}
												}	
											?>	
        								<span class="add-on"><i class="icon-envelope"></i></span>
    									<input style="width: 70%" name ="email" type="text" placeholder="Email address" value="<?=$email?>" required="required"><span class="required">*</span>       								
      								</div>
    							</div>

    							<div class="row1">
      								<div class="col-25 input-prepend">
    									<span class="add-on"><img src="./img/icon-phone.jpg" style="width: 16px; height: 16px;"></span>
    									<input style="width: 70%" type="text" placeholder="Phone Number" name="phonenumber" id="id_phonenumber" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" title="Please enter the correct format phone number" value="<?=$phoneNumber?>">
      								</div>
      								<div class="col-75 input-prepend">
      									<span class="add-on"><i class="icon-calendar"></i></span>
    									<input style="width: 70%" name="dob" type="date" value="<?=$dob?>">
      								</div>
    							</div>
  								
    							<div class="row1">
    								<div class="col-25" style="text-align: center; margin-top: 15px">
      									<button type="submit" name="info_submit" class="btn btn-primary">Submit </button>
      								</div>
      								<div class="col-75" style="text-align: center; margin-top: 10px">
      									<button type="button" name="change_pw" id="change_pw" class="btn btn-warning" data-toggle="modal" data-target="#change_pw_confirm"><i class="icon-edit icon-4x"></i> Password </button>
      								</div>
    							</div>
  							</form>
						</div>	  
					
				  	
					
				<!-- Result of Story  -->
					<div class="thumbnails" style="margin-top: 80px">
					<?php
						$sql5= "SELECT * FROM story WHERE memberID= '" .$memberID . "'";

						$row5=query($sql5);
					?>
						<a href="./mystories.php"><h3 style="color: #D36337">Uploaded Stories (<?=count($row5)?>)</h3></a>
						<hr>
					<?php 
					if(count($row5) == 0){
					?>
						<div style="text-align: center"><img src="./img/nothing.jpg?>"  style="border-radius: 10%; width: 50%"></div>
					<?php
					}else{
					?>	  
						<ul class="thumbnails">

						<?php
						// Pagination

							$allrow = count($row1);
							$pagesize = 10;
							$allpage = 1;

							//Calculate how many pages there are all 
							if($allrow % $pagesize == 0){
								$allpage = $allrow / $pagesize;
							}else{
								$allpage = (int)($allrow / $pagesize) + 1;
							}

							$beginrow = 1;
							$currentpage = 1;

							// If the current page is page 1, then select from the first row


							if((!isset($_GET['currentpage'])) || ($_GET['currentpage'] == '1'))
							{
								$beginrow = 0;
								$currentpage = 1;
							}else{
								// Select the starting row and get current page
								$beginrow = ($_GET['currentpage'] - 1) * $pagesize;
								$currentpage = $_GET['currentpage'];
							}

							$sql3= "SELECT * FROM story WHERE memberID= '" .$memberID . "' LIMIT {$beginrow} , {$pagesize}";

							$row3=query($sql3);  

							for ($i=0; $i < count($row3);$i++)
							{

						?>
							
								<li class="span2" style="float: left; height: 270px; width: 180px">
									<a href="storydetail.php?storyID=<?=$row3[$i][0]?>" class="thumbnail" >
										<img style="width: 170px; height: 220px;" alt="<?=$row3[$i][1]?>" src="img/<?=$row3[$i][4]?>">
									</a>
									<div class="caption">
										<a href="storydetail.php?storyID=<?=$row3[$i][0]?>" >
											<h2 style="width: 100%; height: auto;"><?=decryptString($row3[$i][1])?></h2>

											<?php 
											$sql4= "select * from chapter WHERE storyID = '" .$row3[$i][0] ."' ORDER BY chapterID DESC";
												$row4=query($sql4);
											?>
											<i class="icon-star-empty star"></i>
											<a href="readstory.php?storyID=<?=$row4[$i][0]?>&chapterID=<?=$row4[0][0]?>"><span class="label label-warning">
											<?php

												if(count($row4) > 0){
													echo(decryptString($row4[0][1]));
												}else{
													echo("No chapter");
												}
											?>
											</span></a>
										</a>
									</div>
								</li>  
						<?php
							}
						?>
						</ul>
					
					<!--<div style="text-align: center; font-size: 15px"> -->
					<div class="paging">
						<div class="pagination pagination-centered">
						<ul>
							<li class="disable"><a href="" style="color: #6C6A6A">Pages</a></li>	
							<?php
							// Link pagination
							for($i = 1; $i <= $allpage; $i++)
							{
								if($currentpage == $i){
								?>
									<li class="active"><a href=""><?=$i?></a></li> 
								<?php
								}else{
							?>
									<li class="disable"><a href="home.php?currentpage=<?=$i?>"><?php echo $i ." "; ?></a></li>
							<?php
								}
							}
							?>
							<li class="disable"><a href="" style="color: #6C6A6A">Pages</a></li>
						</ul>
						</div>
					</div>
					<?php
						}
					?>

					</div>  
				</div>
			</div>
			
			<div id="fb-root"></div>
		<?php 
			require_once("./footer.php");
		?>
	</div>
</div>


<!-- Change_pw_confirm modal -->
	<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
	<script type="text/javascript" src="js/bootstrap-modal.js"></script>

	<div class="modal hide fade" id="change_pw_confirm" style="display: none;">
	<form  method="POST" action="profile.php" >
		<div class="modal-header">
			<span class="disable" data-dismiss="modal" aria-hidden="true" style="color: #ff4444; font-size: 44px; font-weight: bold; float: right;cursor:pointer;">&times;</span>
			<h3>Change Password</h3>
										
		</div>
		<div class="modal-body" style="text-align: left; margin-top:0px">
			<div class="container1" style="padding: 10px">
				<div class="row1">
      				<div class="col-25">	
    					<label><b>Old Password</b></label>
    					<div class="control"><input style="width: 70%" type="password" placeholder="Old Password" name="old_password" required="required" id="old_password" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 6 characters"></span></div>	

    					<label><b>New Password</b></label>
    					<div class="control"><input style="width: 70%" type="password" placeholder="New Password" name="new_password" required="required" id="new_password" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 6 characters"></span></div>	

    					<label><b>Confirm New Password</b></label>
    					<div class="control"><input style="width: 70%" type="password" placeholder="Confirm New Password" name="cf_new_password" required="required" id="cf_new_password" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 6 characters"></span></div>
      				</div>

      				<div  class="col-25">
  						<div id="message">
  							<h6>Password must contain the following:</h6>
  							<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  							<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  							<p id="number" class="invalid">A <b>number</b></p>
  							<p id="length" class="invalid">Minimum <b>6 characters</b></p>
  						</div>
  						<div id="message1" style="display: none">
  							<p id="the_same" class="invalid">Confirm New Password and New Password <b> are the same</b></p>
  						</div>
					</div>

      			</div>
			</div>
			
			<input type="hidden" name="story_id" value="<?=$storyID?>">
									

			<button type="submit" name="cf_del_story" class="btn btn-primary" style="background-color: blue; width:14% ">Yes</button>&emsp;&emsp;
									
			<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancle</button>
		</div>

	</form>
	</div>

</body>
</html>



<?php
// Update Infomation
	if(isset($_POST['info_submit']))
	{
		echo("POST['info_submit'] = ".$_POST['info_submit']);
		if(isset($_POST['fullname']) && isset($_POST['email']) && $_POST['fullname'] != "" && $_POST['email'] != "")
		{
			$fullname=$_POST['fullname'];
			$dob=$_POST['dob'];
			$phone=$_POST['phonenumber'];
			$email=$_POST['email'];
			echo("fullname=".$fullname);
			echo("dob=".$dob);
			echo("phone=".$phone);
			echo("email=".$email);

			if($errormsg == False){
				$sql6 = "UPDATE account SET email='" .$email ."' WHERE username='" .$user ."'"; 
				echo("sql6=".$sql6);
				$result6 = execsql($sql6);
				//echo("$result6=".$result6);

				$sql7 = "UPDATE member SET fullName='" .$fullname ."', dob='" .$dob ."', phoneNumber='" .$phone ."' WHERE memberID='" .$memberID ."'"; 
				echo("sql7=".$sql7);
				$result7 = execsql($sql7);
				//echo("$result7=".$result7);
			}
			

			if($result6 != null && $result7 != null){
?>				
				<script >
					alert ("Account information has been updated successfully!");
					window.location.replace("./profile.php");
				</script>
<?php 		
			}else{
?>				
				<script >
					alert ("Failure to update account information. Try again!");
					window.location.replace("./profile.php");
				</script>
<?php
			}
			 				
		}
	}
?>

<!-- validate password -->
<script>
var myInput = document.getElementById("new_password");
var myInput1 = document.getElementById("cf_new_password");
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

