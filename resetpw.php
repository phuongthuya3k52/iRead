<?php
session_start();
require_once("./db.php");
// Reset password	

	if(isset($_POST['password']) && isset($_POST['cf_password']) && isset($_POST['email']) && isset($_POST['token'])) 
		{
		
			$error_change_pass = array();
			$password = $_POST['password'];
			$cf_password = $_POST['cf_password'];
			$email = $_POST['email'];
			$token = $_POST['token'];

			if($password != $cf_password){
				$error_change_pass[] = "The Confirm Password and Password are not the same.";
			}

			if(!empty($error_change_pass))
			{ 
				//print_r($error_change_pass);
	?>
			<script>
				//alert("gxxdh");
				alert ("<?php for($i=0; $i<sizeof($error_change_pass); $i++){echo $error_change_pass[$i] . " ";echo(" Please try again!");} ?>");	
			</script>	
	<?php		
			}else{

				//$sql2 = "UPDATE account SET password='" .md5($password) ."' WHERE email='" .$email ."'"; 
				//echo("sql2=".$sql2);
				$sql= "SELECT * FROM account WHERE email='".$email ."'";
				echo(query($sql)[0][1]);

			//	$result2 = execsql($sql2);
			//	echo("result2 = ".$result2);
			/*	if($result2 != null)
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
						window.location.replace("./updatepw.php?email=<?=$email?>&token=<?=$token?>");
					</script>
	<?php							
				}  */
			}  
		}else{
			header("Location:./forgotpw.php?");
		}
?>