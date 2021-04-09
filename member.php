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
		if(!isset($_GET['memberID'])){
		?>
    		<script >
				alert ("There is no member");
				window.location.replace("./home.php");
			</script>
		<?php	
		}else{
			$memberID = $_GET['memberID'];

			$sql = "SELECT * FROM member WHERE memberID = '" .$memberID . "'";
			//echo($sql);
			$row = query($sql);
			$memberName = $row[0][1];
			$image = $row[0][6];

			$sql1 = "SELECT * FROM story WHERE memberID = '" .$memberID . "'";
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
				<li class="active"><strong>Member</strong></li>
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

						
				  
					
				<!-- Result of Story  -->
					<div class="thumbnails">
					<?php
					if(count($row1) == 0){
					?>
						<div style="text-align: center"><img src="./img/nothing.jpg?>"  style="border-radius: 10%; width: 50%"></div>
					<?php
					}else{
					?>
						<h3 style="color: #D36337">Uploaded Stories (<?=count($row1)?>)</h3>
						<hr>	  
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
</body>
</html>