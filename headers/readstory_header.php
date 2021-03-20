<div class="yamm navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<?php
					for($i=0; $i<7; $i++)
					{
				?>
					<span class="icon-bar"></span>
				
				<?php
					}			
				?>
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
											<input type="hidden" value="<?=$i?>"><a href="./storybycat.php?catergoryID=<?=$category[$i][0]?>"><?=$category[$i][1]?></a>
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
				
					
					<li class="dropdown">
						<a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-wrench"></i><b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#" onclick="return changeBG('#eee')">Grey</a></li>
							<li><a href="#" onclick="return changeBG('BurlyWood')">BurlyWood</a></li>
							<li><a href="#" onclick="return changeBG('Wheat')">Wheat</a></li>
							<li><a href="#" onclick="return changeBG('#f8e49d')">Brown</a></li>
							<li><a href="#" onclick="return changeBG('#DBC382')">Greyish</a></li>
							<li><a href="#" onclick="return changeBG('AntiqueWhite')">AntiqueWhite</a></li>
							<li class="divider"></li>
							<li><a href="#" onclick="return changeBG('White')">Default</a></li>
						</ul>
					</li>
					
					<li class="dropdown">
						<a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-text-width"></i><b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#" onclick="return changeFontSize('16')">16</a></li>
							<li><a href="#" onclick="return changeFontSize('18')">18</a></li>
							<li><a href="#" onclick="return changeFontSize('20')">20</a></li>
							<li><a href="#" onclick="return changeFontSize('22')">22</a></li>
							<li><a href="#" onclick="return changeFontSize('24')">24</a></li>
							<li><a href="#" onclick="return changeFontSize('26')">26</a></li>
							<li><a href="#" onclick="return changeFontSize('28')">28</a></li>
							<li><a href="#" onclick="return changeFontSize('30')">30</a></li>
							<li class="divider"></li>
							<li><a href="#" onclick="return changeFontSize('22')">Default</a></li>
						</ul>
					</li>
					
					<li class="dropdown">
						<a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-font"></i><b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#" onclick="return changeFont('Palatino Linotype')">Palatino</a></li>
							<li><a href="#" onclick="return changeFont('Patrick Hand')">Patrick Hand</a></li>
							<li><a href="#" onclick="return changeFont('Times New Roman')">Times New Roman</a></li>
							<li><a href="#" onclick="return changeFont('Verdana')">Verdana</a></li>
							<li><a href="#" onclick="return changeFont('Tahoma')">Tahoma</a></li>
							<li><a href="#" onclick="return changeFont('Arial')">Arial</a></li>
							<li class="divider"></li>
							<li><a href="#" onclick="return changeFont('Noticia Text')">Default</a></li>
						</ul>
					</li>
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
						<input type="text" name="search" class="search-query span2" placeholder="Enter name...">
						<button class="btn" type="submit" value=""><i class="icon-search"></i></button>
					</div>
				</form>  
			</div>
		</div>
	</div>
</div>
