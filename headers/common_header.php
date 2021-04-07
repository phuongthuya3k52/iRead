<div class="yamm navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>				
			</a>
			<a class="brand iread-logo" href="home.php"></a>
			<div class="nav-collapse">
				<ul class="nav">
					<li class="disable"><a href="home.php"><i class="icon-home"></i> Home</a></li>
					<li class="dropdown">
						<a href="javascript:" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-book"></i> Category<b class="caret"></b></a>

						<ul class="dropdown-menu">
							<li class="yamm-content">
								<?php
									$sql = "select * from category";
									$category = query($sql);

									for ($i=0; $i<count($category);$i++)
									{
								?>	
									<ul class="span2 unstyled" style="width:158px;">
										<li>
											<input type="hidden" value="<?=$i?>"><a href="./storybycat.php?categoryID=<?=$category[$i][0]?>"><?=$category[$i][1]?></a>
										</li>
									</ul>
								<?php 
									}
								?>							
							</li>
						</ul>					
					</li>
				
					<li><a href="#check_attendence" data-toggle="modal"><i class=" fa fa-calendar-check-o" aria-hidden="true"></i> Attendence</a></li>
					<li><a href="./newstory.php"><i class="icon-book"></i>New story</a></li>
				</ul>
				
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i></a>
						<ul class="dropdown-menu">
							<li><a href="./profile.php"><i class="icon-user" aria-hidden="true"></i>My Account</a></li>
							<li><a href="./mystories.php"><i class="icon-folder-open"></i>My Stories</a></li>
							<li><a href="./logout.php"><i class="icon-arrow-right"></i> Logout</a></li>
							
						</ul>
					</li>
				</ul>
				<form class="navbar-search form-search pull-right" action="search.php" method="GET">
					<div class="input-append">
						<input type="text" name="search" class="search-query span2" placeholder="Enter name...">
						<button class="btn" type="submit" name="search_home" value=""><i class="icon-search"></i></button>
					</div>
				</form> 



			</div>

		</div>
		
	</div>
	<form method="get" class="modal hide fade" id="check_attendence" style="display: none;width: 50%; height: auto; background-color: white">
	<?php
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$begin_date = 
		if(date("H:i:s") == "00:00:00"){$check = 0;}
		if($check == 0){
			$check = 1;
	?>
		<div class="modal-header" style="text-align: center">
			<span class="disable" data-dismiss="modal" aria-hidden="true" style="color: #ff4444; font-size: 44px; font-weight: bold; float: right;cursor:pointer;">&times;</span>
			<h4>Attendance successful! You get 1 coin plus</h4>
			<!--	<div class="tbclose-btn" onclick="thongbaopopup()">&times;</div> -->
		</div>
		<div class="modal-body" style="text-align: center">
			<img src="img/one_coin.jpg" style="width: 60%; height: 60%;">
		</div>
	<?php
		}else if($check == 1){
	?>
		<div class="modal-header" style="text-align: center">
			<span class="disable" data-dismiss="modal" aria-hidden="true" style="color: #ff4444; font-size: 44px; font-weight: bold; float: right;cursor:pointer;">&times;</span>
			<h4>You have taken attendance. Come back tomorrow!</h4>
			<!--	<div class="tbclose-btn" onclick="thongbaopopup()">&times;</div> -->
		</div>
		<div class="modal-body" style="text-align: center">
			<img src="img/attendance_checked.png" style="width: 60%; height: 60%;">
		</div>
	<?php
		}
	?>
	</div>
</form>
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

