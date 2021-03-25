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
				
					<li><a href=""><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Attendence</a></li>
					<li><a href=""><i class="fa fa-user" aria-hidden="true"></i></i> My Account</a></li>
				</ul>
				
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i></a>
						<ul class="dropdown-menu">
							<li><a href="./newstory.php"><i class="icon-refresh"></i>New story</a></li>
							<li><a href="./mystories.php"><i class="icon-refresh"></i>My stories</a></li>
							<li><a href="./logout.php"><i class="icon-arrow-right"></i> Logout</a></li>
							
						</ul>
					</li>
				</ul>
				<form class="navbar-search form-search pull-right" action="search.php" method="GET">
					
					<div class="input-append">
							<input type="text" name="search" class="search-query span2" placeholder="Enter story name..." id = "myInput" onkeyup="filterFunction()" onclick="myFunction()">
							<button class="btn" type="submit" name="search_home"><i class="icon-search"></i></button>
					</div>
				</form>
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