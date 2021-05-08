
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Story | iRead</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/yamm.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/chosen.css" rel="stylesheet">
<link rel="icon" type="image/png" href="img/favicon.png"/>
<link href="https://plus.google.com/103281900225927837176/" rel="author">
<script src="js/jquery-1.12.4.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/csrf.js"></script>
<style>
	body{
		padding-top:60px;padding-bottom:40px;height:auto;
	}
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
		if(isset($_GET['storyID'])){
			$storyID=$_GET['storyID'];
			$sql = "Select * from story where storyID='" .$storyID . "'";
			$row = query($sql);
			$memberID = $row[0][2];
			$viewNumber = $row[0][5];
			$voteNumber = $row[0][6];


			$sql1 = "Select * from member where memberID='" .$memberID . "'";
			$row1 = query($sql1);
			$authorid = $row1[0][0];
			$authorname = $row1[0][1];
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
	<!--	<div class="span10">  -->
			<ul class="breadcrumb">
				<li>
					<div itemscope>
						<a href="./home.php" itemprop="url"><i class="icon-home"></i></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong><?=decryptString($row[0][1])?></strong></li>
			</ul>
			
			
			<div class="row wrapper">  
			<?php 
				require_once("./lefts/common_left.php");
			?>	
				<div class="span10">
					<div class="xfor" style="font-size: 18px">
						<div class="thumbnail">
						<img src="img/<?=$row[0][4]?>" alt="<?=$row[0][1]?>" style="width: 100%;height: 300px;"/>
						</div>
						<div class="lww">
						<p>
						<span class="xleft">Author:</span>
						<span>&nbsp;<a href="./member.php?memberID=<?=$authorid?>"><?=$authorname?></a></span>
						</p>

						<p>
						<span class="xleft">Type:</span>
						<span class="list-category">&nbsp;
						<?php
							$sql2 = "Select * from category INNER JOIN story_category ON category.categoryID = story_category.categoryID WHERE storyID='" .$storyID . "'";

							$row2 = query($sql2);

							for ($i=0; $i < count($row2);$i++)
							{ 
						?>	
								<span><a href="./storybycat.php?categoryID=<?=$row2[$i][0]?>"><?=$row2[$i][1]?></a></span>
						<?php
							}
						?>
						</span>
						</p>

						<p>
						<span class="xleft">Status:</span>
						<span style=" color: #FA8424; font-weight: bold;">&nbsp;<?=$row[0][7]?></span>
						</p>
						<p>
						<span class="xleft">Votes:</span>
						<span>&nbsp;<?=$voteNumber?></span>
						</p>
						<p>
						<span class="xleft">Views:</span>
						<span>&nbsp;<?=$viewNumber?></span>
						</p>						
						</div>
					</div>
					
					<div class="rofx">
						<h1 style="font-size: 26px;"><?=decryptString($row[0][1])?></h1>
						<div class="foo2" style="text-align: center; font-size: 20px; font-weight: bold; color: #FA8424">
								<span itemprop="votes">Votes: <?=$voteNumber?></span>
								</span> - 
								<span itemprop="rating">Views: <?=$viewNumber?>
								</span>
									
						</div>
						<div style="display: block;margin: 5px auto;text-align: center;">
						<?php
							$sql3 = "Select chapterID, chapterName from chapter WHERE storyID='" .$storyID . "' ORDER BY chapterID ASC";

							$row3 = query($sql3);


							$sql4 = "Select chapterID, chapterName from chapter WHERE storyID='" .$storyID . "' ORDER BY chapterID DESC";

							$row4 = query($sql4);

						?>
							<a class="btn btn-mini btn-success" href="readstory.php?storyID=<?=$storyID?>&chapterID=<?=$row3[0][0]?>" style="font-size: 14px;">
								<i class="icon-play icon-white"></i> Read from the beginning
							</a>
							<a class="btn btn-mini btn-success" href="readstory.php?storyID=<?=$storyID?>&chapterID=<?=$row4[0][0]?>" style="font-size: 14px;">
								<i class="icon-fire icon-white"></i> Read the latest Chapter
							</a>
							<a type="button" class="btn btn-mini btn-success" style="font-size: 14px;" href="#dschuong"><i class="icon-leaf icon-white"></i> List of Chapters</a>
							<br><br>
	  
						</div>

						<div id="desc_story" style=" font-size: 14px">
							<p><?=decryptString($row[0][3])?></p>
						</div>
					</div>  

					<div class="clearfix"></div>
					<hr style="margin: 0; border-bottom: 1px solid #eee;">
					<div class="chaplist" style="width: 100%;font-size: 15px;"" id="dschuong">
						<h4>List Chapter of <?=decryptString($row[0][1])?></h4>
						<ul class="thumbnails" style="width: 100%; margin-left: 0px; margin-right: -30px">
						<?php
							// Pagination

							$allrow = count($row3);
							$pagesize = 60;
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

							$sql5= "SELECT chapterID, chapterName, requireCoin FROM chapter WHERE storyID='" .$storyID . "'LIMIT {$beginrow} , {$pagesize}";
							$row5=query($sql5);  

							for ($i=0; $i < count($row5);$i++)
							{
								if($row5[$i][2] == 0){	

						?>
									<li style="float: left; width: 20%;">
										<span style="width: 10%;display: inline-block;"><?=$i+1?>.</span><a class="jblack" href="readstory.php?storyID=<?=$storyID?>&chapterID=<?=$row3[$i][0]?>"><i class="icon-leaf"></i><?=decryptString($row5[$i][1])?></a>
									</li>
						<?php
								}else{
						?>
									<li style="float: left; width: 20%;">
										<span style="width: 10%;display: inline-block;"><?=$i+1?>.</span><a class="jblack" href="readstory.php?storyID=<?=$storyID?>&chapterID=<?=$row3[$i][0]?>"><i class="icon-leaf"></i><?=decryptString($row5[$i][1])?></a><i class="icon-lock"></i>
									</li>
						<?php

								}
							}
						?>
						</ul>
					</div>

						
					<div class="paging">
							
						<div class="pagination pagination-centered">
							<form action="storydetail.php?storyID=<?=$storyID?>" method="POST">
								<span>Go to chapter:</span>
								<input name="chap" type="text" value="" style="width:40px;height: 17px;margin: 0;">
								<button class="btn btn-warning btn-small"><i class="icon-arrow-right"></i> <span class="jblack">Go</span></button>
							</form>
							<?php
								if(isset($_POST['chap'])){
									$chap = $_POST['chap'];
									if ($chap > count($row3)){
									?>
										<script >
										alert ("This story have <?=count($row3)?> chapters. Please try again!");
										</script>
									<?php
									}
									for ($i=0; $i < count($row3);$i++){
										if($i == $chap-1){
											$chapID=$row3[$i][0];
										?>
											<script >
												window.location.replace("./readstory.php?storyID=<?=$storyID?>&chapterID=<?=$chapID?>");
											</script>
										<?php
										}	
											//header("location: ./readstory.php?storyID=$storyID&chapterID=$chapID");
									}
								}
							?>
							
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
									<li class="disable"><a href="storydetail.php?storyID=<?=$storyID?>&currentpage=<?=$i?>"><?php echo $i ." "; ?></a></li>
							<?php
								}
							}
							?>
								<li class="disable"><a href="">Pages</a></li>
							</ul>

						</div>
					</div>
				</div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="clearfix"></div>
		<?php 
			require_once("./footers/footer.php");
		?>
		</div>
	</div>
</div>
</body>
</html>