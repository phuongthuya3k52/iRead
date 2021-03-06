<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Stories | iRead</title>
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
		$sql = "SELECT * FROM member WHERE username='" .$_SESSION['username'] . "'";
		$row = query($sql);
		$memberID = $row[0][0];

		$sql1 = "SELECT * FROM story WHERE memberID='" .$memberID . "'";
		$row1 = query($sql1);
		$total = count($row1);

		//Search story name
		if(isset($_POST['search_story']) &&  isset($_POST['search'])){
		 /*	if($_GET['search'] == ""){
			?>
	    		<script >
					alert ("You must enter at least a keyword to search!");
					window.location.replace("./storylist.php");
				</script>
			<?php	
			}  */
			if($_POST['search'] != ""){
				$search = encryptString($_POST['search']);

				$sql = "SELECT * FROM story WHERE storyName LIKE '%" .$search . "%'";
				//echo($sql);
				$row = query($sql);	
				$total_search = count($row);		
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
				<li class="active"><strong>My Stories</strong></li>
			</ul>
			<div class="row wrapper">
				<?php 
				require_once("./lefts/member_left.php");
			?>
				<div class="span10">
						
						<h1 style="text-align: center;margin-top: 10px;">My Stories</h1>
						<div style =" width: 100%; text-align: center;" >

							<form action="mystories.php" method="POST">
							<?php
								if(!isset($_POST['search']) || $_POST['search'] == ""){
							?>
								
								<input type="text" name="search" class=" " placeholder="Enter story name..." style =" width: 60%; margin-top: 25px;margin-left: 25px;">
							<?php
							}else{
							?>
								<input type="text" name="search" class=" " placeholder="Enter story name..." value="<?=$search?>" style =" width: 60%; margin-top: 25px;margin-left: 25px;">
							<?php
							}
							?>
								<button class="btn" type="submit" name="search_story" style="float: right; margin-top: 25px; margin-right: 40px; width: 15%"><i class="icon-search"></i></button>
							</form>
						</div>
						<ul class="nav" style="margin-top: 40px; margin-bottom: 40px">
							<li class="disable" style="float:left;width: 50%; color: Orange;">
								<?php  
									if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search']) && $_POST['search'] != ""){
								?>	
										<h2><i class="icon-book icon-large"></i>Search Results: <?=$total_search?></h2>
								<?php
									}else{
								?>
									<h2><i class="icon-book icon-large"></i>Total Stories: <?=$total?></h2>
								<?php	
									}
								?>

							</li>

							<li style="float: right;width: 50%"><a href="./newstory.php?" style="width: 30%; height: auto; min-height: 25px; float: right; font-size: 15px; background-color: blue"  class="btn btn-primary"><i class="icon-plus icon-large"></i> New Story</a></li>
						</ul>

						<div class="table-responsive" style="margin-top: 120px; width:100%"> 
						<table class="table" style="width: 100%">
							<thead>
								<tr >
								<th style="text-align: center; font-size: 14px; width: 5%;">No.</th>
								<th style="text-align: center; font-size: 14px; width: 20%;">Image</th>
								<th style="text-align: center; font-size: 14px; width: 47%;">Information</th>
								<th style="text-align: center; font-size: 14px; width: 7%;">Chapters</th>
								<th style="text-align: center; font-size: 14px; width: 10%;">Status</th>
								<th style="text-align: center; font-size: 14px; width: 11%;">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							// Pagination
								
								$allrow = count($row1);
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

								$sql2= "SELECT * FROM story WHERE memberID='" .$memberID . "' LIMIT {$beginrow} , {$pagesize}";

								//Search
								if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search']) && $_POST['search'] != ""){
									$sql2= "SELECT * FROM story WHERE memberID='" .$memberID . "' AND storyName LIKE '%" .$search . "%' ORDER BY storyID DESC LIMIT {$beginrow} , {$pagesize}";
								}

								$row2=query($sql2);  


								for($i=0; $i < count($row2); $i++)
								{
									$storyID = $row2[$i][0];
									$storyName = $row2[$i][1];
									$storyImage = $row2[$i][4];
									$viewNumber = $row2[$i][5];
									$voteNumber = $row2[$i][6];
							?>	
								<tr>
									<td style="padding-top: 20px; width: 5%;"><?=$i+1?></td>
									<td class="nav-list name_list" style="width: 20%">
										<div class="media truyen-item">
											<a class="pull-left" href="chapterlist.php?storyID=<?=$row2[$i][0]?>">
												<img class="media-object" alt="<?=$row2[$i][1]?>" style="width: 150px; height: 170px;" src="img/<?=$storyImage?>">
											</a>
										</div>
										
									</td>
									<td style="width: 47%">
										<div  style="text-align: center; width: 100%">
											<div class="media-body">
												<a href="chapterlist.php?storyID=<?=$storyID?>"><h2 class="media-heading" style="font-size: 18px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#333333;"><?=decryptString($storyName)?></h2></a>
												
												<?php
													$sql3 = "Select * from category INNER JOIN story_category ON category.categoryID = story_category.categoryID WHERE storyID='" .$storyID . "'";

													$row3 = query($sql3);

													for ($j=0; $j < count($row3);$j++)
													{
												?>	
														<span class="list-category" style="font-size: 14px; text-align: justify;">
															<span><a href="./storybycat.php?categoryID=<?=$row3[$j][0]?>"><?=$row3[$j][1]?></a></span>,
														</span>
												<?php
													}
												?>
											</div>

											<span itemprop="votes" style="color: #FA8424; font-size: 14px"><b> <?=$voteNumber?> Votes</b>
											</span> - 
											<span itemprop="rating" style="color: #FA8424;font-size: 14px"><b> <?=$viewNumber?> Views</b>
											</span>


											<p style="text-align: justify;"><?=decryptString($row2[$i][3])?></p>			
										</div>
									</td>
									<td style="width: 7%; text-align: center;">
									<?php
										$sql4 = "SELECT * FROM chapter WHERE storyID='" .$storyID . "'";
										$row4 = query($sql4);

										echo('<a href="./chapterlist.php?storyID='.$storyID.'" >'.count($row4).'</a>');
									?>
									</td>
									<td style="width: 10%; text-align: center;"><?=$row2[$i][7]?></td>
									<td style="width: 11%; text-align: center; ">
										<a href="editstory.php?storyID=<?=$storyID?>" class="btn"><i class="icon-edit"></i></a>
										<button type="button" name="btn_delete" id="btn_delete<?=$storyID?>" class="btn btn-warning" data-toggle="modal" data-target="#delete_confirm<?=$storyID?>"><i class="icon-remove-sign"></i>
											</button>
									
									</td>
								</tr>

						<!-- Delete confirm modal -->
								<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
								<script type="text/javascript" src="js/bootstrap-modal.js"></script>

								<div class="modal hide fade" id="delete_confirm<?=$storyID?>" style="display: none;">
									<form  method="POST" action="delete.php" >
									<div class="modal-header">
										<span class="disable" data-dismiss="modal" aria-hidden="true" style="color: #ff4444; font-size: 44px; font-weight: bold; float: right;cursor:pointer;">&times;</span>
										<h3>Delete Story</h3>
										
									</div>
									<div class="modal-body" style="text-align: center; margin-top:0px">
										<h2>Are you sure to Delete this story?</h2>
										<img style="width: 150px; height: 200px;" src="img/<?=$storyImage?>">
										<h5><?=decryptString($storyName)?></h5>
										<input type="hidden" name="story_id" value="<?=$storyID?>">
									

										<button type="submit" name="cf_del_story" class="btn btn-primary" style="background-color: blue; width:14% ">Yes</button>&emsp;&emsp;
									
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
									<li class="disable"><a href="mystories.php?currentpage=<?=$i?>"><?php echo $i ." "; ?></a></li>
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