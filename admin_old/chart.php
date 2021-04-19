<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta name="description" content="Truyện Hot 24h hay nhất và mới nhất. Đọc truyện online nhiều thể loại tại TruyệnYY - Kho truyện được tuyển chọn và biên tập tốt nhất.">
<meta name="keywords" content="Doc truyen online, truyen kiem hiep, truyen tien hiep, truyen sac hiep, truyen ngon tinh, truyen trinh tham, vong du, truyen convert full text">
<link rel="alternate" type="application/atom+xml" title="Đọc Truyện Online - Truyện Kiếm Hiệp" href="http://feeds.feedburner.com/truyenyy">
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
	 	$sql = "SELECT * FROM story INNER JOIN story_category ON  story.storyID = story_category.storyID WHERE categoryID = '".$_SESSION['category']."'";
	    $row = query($sql);
	    $total= count($row);

	//Search story name
	if(isset($_GET['search_story']) &&  isset($_GET['search'])){
		if($_GET['search'] == ""){
		?>
    		<script >
				alert ("You must enter at least a keyword to search!");
				window.location.replace("./storylist.php");
			</script>
		<?php	
		}else{
			$search = encryptString($_GET['search']);

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
	require_once("./header.php");
?>

<div class="container">
<div class="container-fluid">
	<div class="row col-md-12 wrapper">
		
			<ul class="breadcrumb">
				<li>
					<div itemscope>
						<a href="admin.php" itemprop="url"><strong itemprop="title">Home</strong></a>
					</div>
				</li>
			</ul>
	</div>
	<div class="row wrapper ">
				
		<h1 style="text-align: center;margin-top: 10px;">Dash Board</h1>
		
		<ul class="nav" style="margin-top: 40px; margin-bottom: 40px">
			<li class="disable" style="float:left;width: 45%; color: #E86C19;">
			<?php  
				if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])){
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
		</ul>
		<ul class="nav" style="font-size: 13px; width: 100%; float:left; color: #E86C19;"> <p style="font-size: 13px; width: 100%;"> The information sheet below shows the list of stories in order from the latest story to older one.</p></ul>

		<ul class="table-responsive" style="width: 100%; ">
			<li>
				<canvas id="income" style="width: 100%; border: 1px solid black" ></canvas>
			</li>
			<li>
				<canvas id="pie-chart" style="width: 100%; border: 1px solid black" ></canvas>
			</li>
			
		</ul>
		<script>
			new Chart(document.getElementById("pie-chart"), {
				    type: 'pie',

				    data: {
				      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
				      datasets: [{
				        label: "Population (millions)",
				        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
				        data: [2478,5267,734,784,433]
				      }]
				    },

				    options: {
				      title: {
				        display: true,
				        text: 'Predicted world population (millions) in 2050'
				      }
				    }
			});
		</script>

		<script>
		// bar chart data
	var barData = {
	labels : ["January","February","March","April","May","June"],
	datasets: [{
	    label: 'My First Dataset',
	    data: [65, 59, 80, 81, 56, 55, 40],
	    backgroundColor: [
	      'rgba(255, 99, 132, 0.2)',
	      'rgba(255, 159, 64, 0.2)',
	      'rgba(255, 205, 86, 0.2)',
	      'rgba(75, 192, 192, 0.2)',
	      'rgba(54, 162, 235, 0.2)',
	      'rgba(153, 102, 255, 0.2)',
	      'rgba(201, 203, 207, 0.2)'
	    ],
	    borderColor: [
	      'rgb(255, 99, 132)',
	      'rgb(255, 159, 64)',
	      'rgb(255, 205, 86)',
	      'rgb(75, 192, 192)',
	      'rgb(54, 162, 235)',
	      'rgb(153, 102, 255)',
	      'rgb(201, 203, 207)'
	    ],
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
	var income = document.getElementById("income").getContext("2d");
	
	// draw bar chart
	//new Chart(income).Bar(barData, barOptions);
 new Chart(income,{
		type: 'bar',
		data: barData,

	});
		</script>
		
		

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

					//Common select
					if($_SESSION['category'] == "all"){
						$sql2= "SELECT * FROM story ORDER BY storyID DESC LIMIT {$beginrow} , {$pagesize}";

					}else{
						$sql2= "SELECT * FROM story INNER JOIN story_category ON  story.storyID = story_category.storyID WHERE categoryID ='".$_SESSION['category'] ."' ORDER BY story.storyID DESC LIMIT {$beginrow} , {$pagesize}";
					}

					//Search
					if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])){
						$sql2= "SELECT * FROM story WHERE storyName LIKE '%" .$search . "%' ORDER BY storyID DESC LIMIT {$beginrow} , {$pagesize}";
					}

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


			<div class="row wrapper"></div>			
			<?php 
			require_once("../footer.php");
		?>

		</div>
	</div>
</div>
</body>
</html>