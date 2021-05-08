<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | Admin | iRead</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<link href="../css/yamm.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="../css/chosen.css" rel="stylesheet">
<link rel="icon" type="image/png" href="../img/favicon.png"/>
<link href="https://plus.google.com/103281900225927837176/" rel="author">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/chosen.jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/csrf.js"></script>
<script src="../js/chart.min.js"></script>
<style>
	body{
		padding-top:60px;padding-bottom:40px;height:auto;
	}
</style>

</head>

<?php
  require_once("../db.php");
    session_start();


    if(!isset($_SESSION['username'])){
?>
      <script >
      alert ("You must login to access this page!");
      window.location.replace("../login.php");
    </script>
<?php
  }else if($_SESSION['role'] != "admin"){
?>
      <script >
      alert ("You do not have permission to access this page!");
      window.location.replace("../home.php");
    </script>
<?php    
  }else{
	  	$sql = "SELECT * FROM story";
		$row = query($sql);
		$total = count($row);

	
  }
?>

<body>
<?php 
	require_once("../headers/admin_header.php");
?>

<div class="container">
<div class="container-fluid">
	<div class="row col-md-12 wrapper">
		
			<ul class="breadcrumb">
				<li>
					<div itemscope>
						<a href="admin.php" itemprop="url"><strong itemprop="title">Dash board</strong></a>
					</div>
				</li>
			</ul>
	</div>
	<div class="row wrapper ">
				
		<h1 style="text-align: center;margin-top: 10px;">Dash Board</h1>
		
		<ul class="nav" style="margin-top: 40px; margin-bottom: 40px;">
			<li class="disable" style="float:left;width: 100%; color: #E86C19;">
				<h2><i class="icon-book icon-large"></i>Total Stories: <?=$total?></h2>
			</li>
		</ul>
	<!--	<ul class="nav" style="font-size: 13px; width: 100%; float:left; color: #E86C19;"> <p style="font-size: 13px; width: 100%;"> The information sheet below shows the list of stories in order from the latest story to older one.</p></ul>  -->

		<ul class="nav" style="width: 100%;">
			<li style="width: 100%; height: 250px">
				<canvas id="bar_chart" style="margin: auto; min-width: 250px; width: 50%; height: 100%"></canvas>
			</li>			
		</ul><br>
		<?php  
			$sql = "SELECT * FROM category";
		    $row = query($sql);
		    for($i=0; $i<count($row); $i++){
		    	$categoryID = $row[$i][0];
		    	$label[] = $row[$i][1];
			 //echo json_encode($test);
		    	$sql1 = "SELECT * FROM story_category WHERE categoryID = '".$categoryID."'";
			    $result1 = execsql($sql1);
			    if($result1 != null){
			    	$data[] = count(query($sql1));
			    }else{
			    	$data[] = 0;
			    } 
		    }   
		?>
		<script>
		// bar chart data
			var barData = {
			labels :<?php echo json_encode($label);?>,
			datasets: [{
			    label: 'Total number of stories by category ',
			    data: <?php echo json_encode($data);?>,
			    backgroundColor: 'rgba(54, 162, 235, 0.2)',
			    borderColor: 'rgb(54, 162, 235)', 
			    borderWidth: 1
			  }]
			};
			var barOptions = {
		        scales: {
			      y: {
			        beginAtZero: true
			      }
			    }
		    }
			// get bar chart canvas
			var barchart = document.getElementById("bar_chart").getContext("2d");
			
				// draw bar chart
				//new Chart(income).Bar(barData, barOptions);
			 new Chart(barchart,{
					type: 'bar',
					data: barData,
				});
		</script>

		
		<ul class="nav" style="margin-top: 40px; margin-bottom: 40px">
			<li class="disable" style="float:left;width: 100%; color: #E86C19;">
				<h2><i class="icon-book icon-large"></i>Top 10 stories with the most read times</h2>
			</li>
		</ul>

		<div class="table-responsive" style="margin-top: 120px; width:100%"> 
			<table class="table" style="width: 100%">
				<thead>
					<tr>
						<th style="text-align: center; font-size: 14px; width: 5%; background-color: #F5D7B9">No.</th>
						<th style="text-align: center; font-size: 14px; width: 25%; background-color: #F5D7B9">Story Title</th>
						<th style="text-align: center; font-size: 14px; width: 20%%;background-color: #F5D7B9">Category</th>
						<th style="text-align: center; font-size: 14px; width: 5%;background-color: #F5D7B9">Chapters</th>
						<th style="text-align: center; font-size: 14px; width: 10%;background-color: #F5D7B9">Votes</th>
						<th style="text-align: center; font-size: 14px; width: 10%;background-color: #F5D7B9">Views</th>
						<th style="text-align: center; font-size: 14px; width: 14%;background-color: #F5D7B9">MemberID</th>
						<th style="text-align: center; font-size: 14px; width: 11%;background-color: #F5D7B9">Action</th>
					</tr>
				</thead>
				<tbody>
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


					if((!isset($_GET['currentpage_view'])) || ($_GET['currentpage_view'] == '1'))
					{
						$beginrow = 0;
						$currentpage = 1;
					}else{
					// Select the starting row and get current page
					$beginrow = ($_GET['currentpage_view'] - 1) * $pagesize;
					$currentpage = $_GET['currentpage_view'];
					}

					//Common select
					$sql2= "SELECT * FROM story ORDER BY viewNumber DESC LIMIT {$beginrow} , {$pagesize}";

					$row2=query($sql2);  


					for($i=0; $i < count($row2); $i++)
					{
						$storyID = $row2[$i][0];
						$storyName = $row2[$i][1];
						$storyImage = $row2[$i][4];
						$viewNumber = $row2[$i][5];
						$voteNumber = $row2[$i][6];
						$memberID = $row2[$i][2];
				?>	
					<tr>
						<td style=" width: 5%; text-align: center;"><?=$i+1+($currentpage-1)*10?></td>
						<td class="nav-list name_list" style="width: 25%">
							<div class="media-body">
								<a href="chapterlist.php?storyID=<?=$storyID?>">
									<h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#333333; text-align: left;"><?=decryptString($storyName)?></h2>
								</a>
							</div>
										
						</td>
						<td style="width: 20%">
							<div  style="text-align: center; width: 100%">
								<div class="media-body">
												
								<?php
									$sql3 = "Select * from category INNER JOIN story_category ON category.categoryID = story_category.categoryID WHERE storyID='" .$storyID . "'";
									$row3 = query($sql3);

									for ($j=0; $j < count($row3);$j++)
									{
								?>	
										<span class="list-category" style="font-size: 12px; text-align: justify;">
											<span><a href="./storybycat.php?categoryID=<?=$row3[$j][0]?>"><?=$row3[$j][1]?></a></span>,
										</span>
								<?php
									}
								?>
								</div>

								</td>
								<td style="width: 5%; text-align: center;">
								<?php
									$sql4 = "SELECT * FROM chapter WHERE storyID='" .$storyID . "'";
									$row4 = query($sql4);

									echo('<a href="./chapterlist.php?storyID='.$storyID.'">'.count($row4).'</a>');
								?>
								</td>
								<td style="width: 5%; text-align: center;">
									<span itemprop="votes"><b> <?=$voteNumber?></b>
									</span>
								</td>
								<td style="width: 5%; text-align: center;">
									<span itemprop="rating"><b> <?=$viewNumber?></b>
									</span>
								</td>

								<td style="width: 14%; text-align: center;">
									<a href="memberlist.php?memberID=<?=$memberID?>"><?=$memberID?></a>	
								</td>
								<td style="width: 11%; text-align: center; ">
								<!--	<a href="editstory.php?storyID=<?=$storyID?>" class="btn"><i class="icon-edit"></i></a> -->
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
										<img style="width: 150px; height: 200px;" src="../img/<?=$storyImage?>">
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
									<li class="disable"><a href="admin.php?currentpage_view=<?=$i?>"><?php echo $i ." "; ?></a></li>
							<?php
								}
							}
							?>
						<li class="disable"><a href="">Pages</a></li>
					</ul>
				</div>
			</div> <br>


<!------Top votes ------------------------------------------------------------------------------ -->
			<ul class="nav" style="margin-top: 40px; margin-bottom: 40px">
			<li class="disable" style="float:left;width: 100%; color: #E86C19;">
				<h2><i class="icon-book icon-large"></i>Top 10 stories with the most votes</h2>
			</li>
		</ul>

		<div class="table-responsive" style="margin-top: 120px; width:100%"> 
			<table class="table" style="width: 100%">
				<thead>
					<tr>
						<th style="text-align: center; font-size: 14px; width: 5%; background-color: #F5D7B9">No.</th>
						<th style="text-align: center; font-size: 14px; width: 25%; background-color: #F5D7B9">Story Title</th>
						<th style="text-align: center; font-size: 14px; width: 20%%;background-color: #F5D7B9">Category</th>
						<th style="text-align: center; font-size: 14px; width: 5%;background-color: #F5D7B9">Chapters</th>
						<th style="text-align: center; font-size: 14px; width: 10%;background-color: #F5D7B9">Votes</th>
						<th style="text-align: center; font-size: 14px; width: 10%;background-color: #F5D7B9">Views</th>
						<th style="text-align: center; font-size: 14px; width: 14%;background-color: #F5D7B9">MemberID</th>
						<th style="text-align: center; font-size: 14px; width: 11%;background-color: #F5D7B9">Action</th>
					</tr>
				</thead>
				<tbody>
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


					if((!isset($_GET['currentpage_vote'])) || ($_GET['currentpage_vote'] == '1'))
					{
						$beginrow = 0;
						$currentpage = 1;
					}else{
					// Select the starting row and get current page
					$beginrow = ($_GET['currentpage_vote'] - 1) * $pagesize;
					$currentpage = $_GET['currentpage_vote'];
					}

					//Common select
					$sql2= "SELECT * FROM story ORDER BY voteNumber DESC LIMIT {$beginrow} , {$pagesize}";

					$row2=query($sql2);  


					for($i=0; $i < count($row2); $i++)
					{
						$storyID = $row2[$i][0];
						$storyName = $row2[$i][1];
						$storyImage = $row2[$i][4];
						$viewNumber = $row2[$i][5];
						$voteNumber = $row2[$i][6];
						$memberID = $row2[$i][2];
				?>	
					<tr>
						<td style=" width: 5%; text-align: center;"><?=$i+1+($currentpage-1)*10?></td>
						<td class="nav-list name_list" style="width: 25%">
							<div class="media-body">
								<a href="chapterlist.php?storyID=<?=$storyID?>">
									<h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#333333; text-align: left;"><?=decryptString($storyName)?></h2>
								</a>
							</div>
										
						</td>
						<td style="width: 20%">
							<div  style="text-align: center; width: 100%">
								<div class="media-body">
												
								<?php
									$sql3 = "Select * from category INNER JOIN story_category ON category.categoryID = story_category.categoryID WHERE storyID='" .$storyID . "'";
									$row3 = query($sql3);

									for ($j=0; $j < count($row3);$j++)
									{
								?>	
										<span class="list-category" style="font-size: 12px; text-align: justify;">
											<span><a href="./storybycat.php?categoryID=<?=$row3[$j][0]?>"><?=$row3[$j][1]?></a></span>,
										</span>
								<?php
									}
								?>
								</div>

								</td>
								<td style="width: 5%; text-align: center;">
								<?php
									$sql4 = "SELECT * FROM chapter WHERE storyID='" .$storyID . "'";
									$row4 = query($sql4);

									echo('<a href="./chapterlist.php?storyID='.$storyID.'">'.count($row4).'</a>');
								?>
								</td>
								<td style="width: 5%; text-align: center;">
									<span itemprop="votes"><b> <?=$voteNumber?></b>
									</span>
								</td>
								<td style="width: 5%; text-align: center;">
									<span itemprop="rating"><b> <?=$viewNumber?></b>
									</span>
								</td>

								<td style="width: 14%; text-align: center;">
									<a href="memberlist.php?memberID=<?=$memberID?>"><?=$memberID?></a>	
								</td>
								<td style="width: 11%; text-align: center; ">
								<!--	<a href="editstory.php?storyID=<?=$storyID?>" class="btn"><i class="icon-edit"></i></a> -->
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
										<img style="width: 150px; height: 200px;" src="../img/<?=$storyImage?>">
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
									<li class="disable"><a href="admin.php?currentpage_vote=<?=$i?>"><?php echo $i ." "; ?></a></li>
							<?php
								}
							}
							?>
						<li class="disable"><a href="">Pages</a></li>
					</ul>
				</div>
			</div>
				
			</div>


			<div class="row wrapper"></div>			
			<?php 
			require_once("../footers/footer.php");
		?>

		</div>
	</div>
</div>
</body>
</html>