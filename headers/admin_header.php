<?php
date_default_timezone_set("Asia/Ho_Chi_Minh"); 
	
$sql1 = "SELECT * FROM member WHERE username = '" .$_SESSION['username'] . "'";
//echo($sql1);
$row1 = query($sql1);
$fullname = $row1[0][1];
//Check for case admin delete his account
if(count($row1)!= 0){	
	$memberID1 = $row1[0][0];
	$wallet1 = $row1[0][5];
}else{
	header("Location: ../login.php");
}

if(isset($memberID1)){
	$sql2 = "SELECT * FROM attendance WHERE memberID = '" .$memberID1 . "'";
	//echo($sql);
	$row2 = query($sql2);
	$result2 = execsql($sql2);

	if(isset($_POST['time'])){
		//echo("time=" .$_POST['time']);
		if(count($row2) != 0){
			$sql3 = "UPDATE attendance SET createAt='" .$_POST['time'] ."' WHERE memberID = '" .$memberID1 . "'"; 
			//echo("sql3=".$sql3);
			$result3 = execsql($sql3);
			if($result3 != null){
				$sql5 = "UPDATE member SET wallet='" .$wallet1 + 1 ."' WHERE memberID = '" .$memberID1 . "'"; 
				//echo("sql5=".$sql5);
				$result5 = execsql($sql5);
			}

		}else{
			$sql4 = "INSERT INTO attendance VALUES ('','" .$memberID1 ."','".$_POST['time'] ."')";
			//echo("sql4=".$sql4);
	    	$result4 = execsql($sql4);
	    	//echo("result4=".$result4);
			if($result4 != null){
				$sql5 = "UPDATE member SET wallet='" .$wallet1 + 1 ."' WHERE memberID = '" .$memberID1 . "'"; 
				//echo("sql5=".$sql5);
				$result5 = execsql($sql5);
			}
		}
	}
}
?>
<div class="yamm navbar navbar-fixed-top">
	<div class="navbar-inner">

			<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<?php
					for($i=0; $i<5; $i++)
					{
				?>
					<span class="icon-bar"></span>
				
				<?php
					}			
				?>
			</a>
			<a class="brand iread-logo" href="admin.php"></a>
			<div class="nav-collapse">
				<ul class="nav">
					<li class="disable"><a href="../home.php"><i class="icon-home"></i> Home</a></li>
					<li class="dropdown">
						<a href="javascript:" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-book"></i> Management<b class="caret"></b></a>

						<ul class="dropdown-menu" style="width:550px ">
							<li class="yamm-content">
									
								<ul class="span2 unstyled" style="width:150px;">
									<li>
										<a href="./memberlist.php">Member</a>
									</li>
								</ul>
								<ul class="span2 unstyled" style="width:150px;">
									<li>
										<a href="./storylist.php">Story</a>
									</li>
								</ul>
								<ul class="span2 unstyled" style="width:150px;">
									<li>
										<a href="./categorylist.php">Category</a>
									</li>
								</ul>
								<ul class="span2 unstyled" style="width:150px;">
									<li>
										<a href="./trans_history.php">Transaction History</a>
									</li>
								</ul>
							</li>

						</ul>					
					</li>
				
			<!--		<li><a href="#check_attendance" data-toggle="modal"><i class=" fa fa-calendar-check-o" aria-hidden="true"></i> Attendence</a></li>  -->
					<li><a href="../newstory.php"><i class="icon-book"></i>New story</a></li>
				</ul>
				
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i><b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li style="text-align: center; margin:10px">Welcome <b><?=$fullname?></b></li>
							<hr>
							<li><a href="./profile.php"><i class="icon-user" aria-hidden="true"></i>My Profile</a>
							</li>
							<li><a href="../mystories.php"><i class="icon-folder-open"></i>My Stories</a></li>
							<li><a href="../logout.php"><i class="icon-arrow-right"></i> Logout</a></li>
							
						</ul>
					</li>
				</ul>
			<!--	<form class="navbar-search form-search pull-right" action="search.php" method="GET">
					<div class="input-append">
						<input type="text" name="search" class="search-query span2" placeholder="Enter name...">
						<button class="btn" type="submit" name="search_home" value=""><i class="icon-search"></i></button>
					</div>
				</form> -->

			</div>

		</div>
	</div>
</div>



<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
</script>

