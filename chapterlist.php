<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chapter List | iRead</title>
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
		$storyID = $_GET["storyID"];

		$sql = "SELECT * FROM story WHERE storyID='" .$storyID . "'";
		$row = query($sql);
		$storyName = decryptString($row[0][1]);

		$sql1 = "SELECT * FROM chapter WHERE storyID='" .$storyID . "'";
		$row1 = query($sql1);
		$total = count($row1);

		//Search chapter name
			if(isset($_POST['search_chapter']) &&  isset($_POST['search'])){
			/*	if($_POST['search'] == ""){
				?>
		    		<script >
						alert ("You must enter at least a keyword to search!");
						window.location.replace("./chapterlist.php?storyID=<?=$storyID?>");
					</script>
				<?php	
				} */
				if($_POST['search'] != ""){
					$search = encryptString($_POST['search']);

					$sql = "SELECT * FROM chapter WHERE storyID ='".$storyID."' AND chapterName LIKE '%" .$search . "%'";
					//echo($sql);
					if(execsql($sql) != null){
						$row = query($sql);
						$total_search = count($row);
					}else{
						$total_search = 0;
					}
				}			
			}
	}
?>

<body>
<?php 
	require_once("./headers/common_header.php");
?>

<div class="container">
<div class="container-fluid">	
	<div class="row">
		<div class="span12 row wrapper">
			<ul class="breadcrumb">
				<li>
					<div itemscope>
						<a href="./home.php" itemprop="url"><i class="icon-home"></i></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li>
					<div itemscope>
						<a href="./mystories.php" itemprop="url"><span itemprop="title">My Stories</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li>
					<div itemscope>
						<a href="./mystories.php" itemprop="url"><span itemprop="title"><?=$storyName?></span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong>Chapter List</strong></li>
			</ul>
			<div class="row wrapper">
				<?php 
				require_once("./lefts/member_left.php");
			?>
				<div class="span10">
						
						<h1 style="text-align: center;margin-top: 10px;"><?=$storyName?></h1>
						<div style =" width: 100%; text-align: center;" >

							<form action="./chapterlist.php?storyID=<?=$storyID?>" method="POST">
							<?php
								if(!isset($_POST['search']) || $_POST['search'] == ""){
							?>
								
								<input type="text" name="search" class=" " placeholder="Enter chapter name..." style =" width: 60%; margin-top: 25px;margin-left: 25px;">
							<?php
							}else{
							?>
								<input type="text" name="search" class=" " placeholder="Enter chapter name..." value="<?=$search?>" style =" width: 60%; margin-top: 25px;margin-left: 25px;">
							<?php
							}
							?>
								
								<button class="btn" type="submit" name="search_chapter" style="float: right; margin-top: 25px; margin-right: 40px; width: 15%"><i class="icon-search"></i></button>
							</form>
						</div>
						<ul class="nav" style="margin-top: 40px; margin-bottom: 40px">
							<li class="disable" style="float:left;width: 50%; color:#E86C19;">
							<?php  
								if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search']) && $_POST['search'] != ""){
							?>	
									<h2><i class="icon-book icon-large"></i>Search Results: <?=$total_search?></h2>
							<?php
								}else{
							?>
								<h3 style="color: #E86C19; font-size: 20px; font-weight: bold;"><i class="icon-book icon-large"></i>Total Chapters: <?=$total?></h3>
							<?php	
								}
							?>
							</li>

							<li style="float: right;width: 50%"><a href="./newchapter.php?storyID=<?=$storyID?>" style="width: 30%; height: auto; min-height: 25px; float: right; font-size: 15px; background-color: blue"  class="btn btn-primary"><i class="icon-plus icon-large"></i> New chapter</a></li>
						</ul>

						<div class="table-responsive" style="margin-top: 120px; width:100%">
						<table class="table" style="margin-top: 30px; width:100%">
							<thead>
								<tr >
								<th style="text-align: center; font-size: 14px; width: 5%;">No.</th>
								<th style="text-align: center; font-size: 14px; width: 20%;">Chapter Title</th>
								<th style="text-align: center; font-size: 14px; width: 10%;">Views</th>
								<th style="text-align: center; font-size: 14px; width: 10%;">Votes</th>
								<th style="text-align: center; font-size: 14px; width: 15%;">Required Coins</th>
								<th style="text-align: center; font-size: 14px; width: 11%;">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							// Pagination
								
								$allrow = count($row1);
								$pagesize = 15;
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

								$sql2= "SELECT * FROM chapter WHERE storyID='" .$storyID . "' LIMIT {$beginrow} , {$pagesize}";

								//Search
								if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search']) && $_POST['search'] != ""){
									$sql2= "SELECT * FROM chapter WHERE storyID='".$storyID."' AND chapterName LIKE '%" .$search . "%' ORDER BY storyID DESC LIMIT {$beginrow} , {$pagesize}";
								}

								$row2=query($sql2);  


								for($i=0; $i < count($row2); $i++)
								{
									$chapterID = $row2[$i][0];
									$chapterName = $row2[$i][1];
									$viewNumber = $row2[$i][5];
							?>
								<tr>
									<td style="padding-top: 10px; width: 5%;"><?=$i+1?></td>
									
									<td style="width: 20%">
										<div  style="text-align: center; width: 100%">
											<div class="media-body">
												<a href="readstory.php?storyID=<?=$storyID?>&chapterID=<?=$chapterID?>"><h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#333333;"><?=decryptString($row2[$i][1])?></h2></a>

											</div>		
										</div>
									</td>
									<td style="width: 10%; text-align: center;"><?=$viewNumber?></td>
									<td style="width: 10%; text-align: center;">
									<?php
										$sql3 = "SELECT * FROM vote WHERE chapterID='" .$chapterID . "'";
										$row3 = query($sql3);
										$voteNumber = count($row3);
										echo($voteNumber);
									?>	
									</td>
									<td style="width: 15%; text-align: center;">
									<?php
										if($row2[$i][4] == 0){
											echo("No");
										}else{
											echo("Yes");
										}
									?>	
									</td>
									<td style="width: 11%; text-align: center; ">
										<a href="editchapter.php?chapterID=<?=$chapterID?>" class="btn"><i class="icon-edit icon-large"></i></a>
										<button type="button" name="btn_delete" id="btn_delete<?=$storyID?>" class="btn btn-warning" data-toggle="modal" data-target="#delete_confirm<?=$chapterID?>"><i class="icon-remove-sign"></i>
											</button>
									</td>
								</tr>
							<!-- Delete confirm modal -->
								<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
								<script type="text/javascript" src="js/bootstrap-modal.js"></script>

								<div class="modal hide fade" id="delete_confirm<?=$chapterID?>" style="display: none;">
									<form  method="POST" action="delete.php" >
									<div class="modal-header">
										<span class="disable" data-dismiss="modal" aria-hidden="true" style="color: #ff4444; font-size: 44px; font-weight: bold; float: right;cursor:pointer;">&times;</span>
										<h3>Delete Chapter</h3>
										
									</div>
									<div class="modal-body" style="text-align: center; margin-top:0px">
										<h2>Are you sure to Delete this chapter of story: "<?=decryptString($storyName)?>"?</h2>
										<img style="width: 200px; height: 200px;" src="img/remove-chapter.jpg">
										<h5><?=decryptString($chapterName)?></h5>

										<input type="hidden" name="chapter_id" value="<?=$chapterID?>">
										<input type="hidden" name="story_id" value="<?=$storyID?>">

										<button type="submit" name="cf_del_chapter" class="btn btn-primary" style="background-color: blue; width:14% ">Yes</button>&emsp;&emsp;
									
										<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancle</button>
									</div>

									</form>
								</div>
							<?php
								}
							?>
							</tbody>
						</table>
					</div>
					
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
									<li class="disable"><a href="chapterlist.php?currentpage=<?=$i?>"><?php echo $i ." "; ?></a></li>
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
			<?php 
			require_once("./footers/footer.php");
		?>

		</div>
	</div>
</div>
</div>
</body>
</html>

<!-- add target="_blank" into <a> tag to open URL in new tab -->