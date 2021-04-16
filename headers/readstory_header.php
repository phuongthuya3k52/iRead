<?php
date_default_timezone_set("Asia/Ho_Chi_Minh"); 
	
$sql1 = "SELECT * FROM member WHERE username = '" .$_SESSION['username'] . "'";
			//echo($sql);
$row1 = query($sql1);
$memberID1 = $row1[0][0];
$wallet1 = $row1[0][5];

$sql2 = "SELECT * FROM attendance WHERE memberID = '" .$memberID1 . "'";
//echo($sql);
$result2 = execsql($sql2);

if(isset($_POST['time'])){
	//echo("time=" .$_POST['time']);
	if($result2 != null){
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
?>
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
				
					<li><a href="#check_attendance" data-toggle="modal"><i class=" fa fa-calendar-check-o" aria-hidden="true"></i> Attendence</a></li>
				
					
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
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i><b class="caret"></b></a>
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
						<button class="btn" type="submit"  value=""><i class="icon-search"></i></button>
					</div>
				</form>  
			</div>
		</div>
	</div>
</div>
<!--Check attendance modal -->
<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="js/bootstrap-modal.js"></script>

<form method="POST" action="<?=getCurrentPageURL()?>" role="form" class="modal hide fade" id="check_attendance" style="display: none;width: 50%; height: auto; background-color: white">
<?php

	if($result2 != null)
	{
		$row2 = query($sql2);

		if(count($row2) > 0){
			$create_time = strtotime($row2[0][2]);
			$current_date = getdate();
			$begin_date = mktime(00,00,00,$current_date['mon'],$current_date['mday'],$current_date['year']);
			if( ($create_time - $begin_date) >= 0)
			{
		?>
				<div class="modal-header" style="text-align: center">
					<span class="disable" data-dismiss="modal" aria-hidden="true" style="color: #ff4444; font-size: 44px; font-weight: bold; float: right;cursor:pointer;">&times;</span>
					<h4>You have taken attendance. Come back tomorrow!</h4>
					<!--	<div class="tbclose-btn" onclick="thongbaopopup()">&times;</div> -->
				</div>
				<div class="modal-body" style="text-align: center">
					<img src="img/attendance_checked.png" style="width: 50%; height: 50%;">
				</div>
		<?php

			}else{
		?>
				<div class="modal-header" style="text-align: center">
					<h4>Attendance successful! You get 1 coin plus</h4>
					<!--	<div class="tbclose-btn" onclick="thongbaopopup()">&times;</div> -->
				</div>
				<div class="modal-body" style="text-align: center">
					<img src="img/one_coin.jpg" style="width: 50%; height: 50%;">
					<div>
						<input type="hidden" name="time" value="<?=date('Y-m-d H:i:s')?>">
						<button type="submit" name="cf_attendance" class="btn btn-primary" style="background-color: blue; width:14%;height: 10%; font-size: 15px">OK</button>
					</div>
				</div>
					
	<?php
			}
		}else{
?>
		<div class="modal-header" style="text-align: center">
				<h4>Attendance successful! You get 1 coin plus</h4>
				<!--	<div class="tbclose-btn" onclick="thongbaopopup()">&times;</div> -->
			</div>
			<div class="modal-body" style="text-align: center">
				<img src="img/one_coin.jpg" style="width: 50%; height: 50%;">
				<div>
					<input type="hidden" name="time" value="<?=date('Y-m-d H:i:s')?>">
					<button type="submit" name="cf_attendance" class="btn btn-primary" style="background-color: blue; width:14%;height: 10%; font-size: 18px">OK</button>
				</div>
			</div>
			
<?php
		}
	}else{
?>
		<div class="modal-header" style="text-align: center">
				<h4>Attendance successful! You get 1 coin plus</h4>
				<!--	<div class="tbclose-btn" onclick="thongbaopopup()">&times;</div> -->
			</div>
			<div class="modal-body" style="text-align: center">
				<img src="img/one_coin.jpg" style="width: 50%; height: 50%;">
				<div>
					<input type="hidden" name="time" value="<?=date('Y-m-d H:i:s')?>">
					<button type="submit" name="cf_attendance" class="btn btn-primary" style="background-color: blue; width:14%;height: 10%; font-size: 18px">OK</button>
				</div>
			</div>
			
<?php
	}
?>
</form>