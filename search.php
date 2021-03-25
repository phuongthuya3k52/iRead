<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<link rel="canonical" href=" "/>
<title>iRead | Search</title>
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
		if(!isset($_GET['search']) && !isset($_GET['search_home']) || $_GET['search' ] == ""){
		?>
    		<script >
				alert ("You must enter at least a keyword to search!");
				window.location.replace("./home.php");
			</script>
		<?php	
		}else{
			$search = $_GET['search'];

			$sql = "SELECT * FROM member WHERE fullName LIKE '%" .$search . "%'";
			//echo($sql);
			$row = query($sql);

			$sql1 = "SELECT * FROM story WHERE storyName LIKE '%" .$search . "%'";
			$row1 = query($sql1);
			//echo($sql1);

			
		}
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
				<li class="active"><strong>Search</strong></li>
			</ul>

			<div class="row wrapper">
				<?php 
					require_once("./lefts/common_left.php");
				?>
				<div class="span10">

				<!-- Result of member -->
					<div class="thumbnails">
						<div style =" width: 90%; text-align: center; float: left; margin-top: 200px>

						<form action="search.php" method="GET">
							<input type="text" name="search" class=" " placeholder="Enter story name..." id = "myInput" value="<?=$search?>" style =" width: 90%; ">
							<button class="btn" type="submit" name="search_home" style="float: right"><i class="icon-search"></i></button>

						</form>
						</div>


						<h3 style="color: orange">Members	</h3>
						<hr>	
						<h2 style="color: orange">About: <?=count($row)?> results</h2>  
						<ul class="thumbnails">
							<table class="table" style="width: 100%">

						<?php
						// Pagination

							$allrow = count($row);
							$pagesize = 5;
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

							$sql2= "SELECT * FROM member WHERE fullName LIKE '%" .$search . "%' LIMIT {$beginrow} , {$pagesize}";
							$row2=query($sql2); 


							for ($i=0; $i < count($row2);$i++)
							{
								$memberID = $row2[$i][0];
								$memberName = $row2[$i][1];
								$image = $row2[$i][6];
						?>

							
								<li style="float: left; width: 100%" >
									<a href="storydetail.php?storyID=<?=$memberID?>" class="thumbnail"style= "width: 96%; height: 62px;">
										<img style="width: 60px; height: 60px; float: left;" alt="<?=$memberName?>" src="img/<?=$image?>">
							
									<h5 style="width: 80%; height: auto; margin-left: 80px"><?=$memberName?></h5>
										</a>
								</li>  
						<?php
							}
						?>
							</table>
						</ul>
					<!--<div style="text-align: center; font-size: 15px"> -->
					<div class="paging">
						<div class="pagination pagination-centered">
						<ul>
							<li class="disable"><a href="">Pages</a></li>	
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
							<li class="disable"><a href="">Pages</a></li>
						</ul>
						</div>
					</div>
				</div>

					
				<!-- Result of Story  -->
					<div class="thumbnails">
						<h3 style="color: orange">Stories	</h3>
						<hr>	
						<h2 style="color: orange">About: <?=count($row1)?> results</h2>  
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

							$sql3= "SELECT * FROM story WHERE storyName LIKE '%" .$search . "%' LIMIT {$beginrow} , {$pagesize}";

							$row3=query($sql3);  

							for ($i=0; $i < count($row3);$i++)
							{

						?>
							
								<li class="span2" style="float: left; height: 250px; width: 160px">
									<a href="storydetail.php?storyID=<?=$ro3[$i][0]?>" class="thumbnail" >
										<img style="width: 150px; height: 200px;" alt="<?=$row3[$i][1]?>" src="img/<?=$row3[$i][4]?>">
									</a>
									<div class="caption">
										<a href="storydetail.php?storyID=<?=$row3[$i][0]?>" >
											<h2 style="width: 100%; height: auto;"><?=decryptString($row3[$i][1])?></h2>

											<?php 
											$sql3= "select * from chapter WHERE storyID = '" .$row3[$i][0] ."' ORDER BY chapterID DESC";
												$row3=query($sql2);
											?>
											<i class="icon-star-empty star"></i>
											<a href="readstory.php?storyID=<?=$row3[$i][0]?>&chapterID=<?=$row3[0][0]?>"><span class="label label-warning">
											<?php

												if(count($row3) > 0){
													echo(decryptString($row3[0][1]));
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
							<li class="disable"><a href="">Pages</a></li>	
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
							<li class="disable"><a href="">Pages</a></li>
						</ul>
						</div>
					</div>

					</div>  
				</div>
			</div>
			
			<div id="fb-root"></div>
		<?php 
			require_once("./footer.php");
		?>
	</div>
</div>
</body>
</html>