<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Story List | Admin | iRead</title>
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
    if(isset($_GET['storyID'])){
  		$storyID = $_GET['storyID'];
  		$sql1 = "SELECT * FROM story WHERE storyID ='".$storyID."'";
		$row1 = query($sql1);
		$storyName = decryptString($row1[0][1]);

		$sql = "SELECT * FROM chapter WHERE storyID ='".$storyID."'";
		$result = execsql($sql);
				
		if($result != null)
		{
			$row = query($sql);
			$total = count($row);
			// filter
		    if(!isset($_SESSION['require_coin']) && !isset($_POST['is_coin'])){
		  		$_SESSION['require_coin'] = "all";
		  	}
		  	if(!isset($_SESSION['require_coin']) && isset($_POST['is_coin'])){
		  		$_SESSION['require_coin'] = $_GET['is_coin'];
		  	}
		  	if(isset($_SESSION['require_coin']) && !isset($_POST['is_coin'])){
		  		$_SESSION['require_coin'] = $_SESSION['require_coin'];
		  	}
		  	if(isset($_SESSION['require_coin']) && isset($_POST['is_coin'])){
		  		$_SESSION['require_coin'] = $_POST['is_coin'];
		  	}


		    if($_SESSION['require_coin'] == "all"){
			  	$sql = "SELECT * FROM chapter WHERE storyID ='".$storyID."'";
				$row = query($sql);
				$total = count($row);
			}else{
			 	$sql = "SELECT * FROM chapter WHERE storyID ='".$storyID."' AND requireCoin = '".$_SESSION['require_coin']."'";
			    $row = query($sql);
			    $total= count($row);
			}

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

  	}else{
?>
    	<script >
			alert ("You must choose a story");
			window.location.replace("./storylist.php");
		</script>
<?php	
	}
  }
?>

<body>


<div class="container">

<div class="container-fluid">
	<?php 
	require_once("../headers/admin_header.php");
?>
	<div class="row col-md-12 wrapper">
		
			<ul class="breadcrumb">
				<li>
					<div itemscope>
						<a href="admin.php" itemprop="url"><span itemprop="title">Dash board</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li>
					<div itemscope>
						<a href="storylist.php" itemprop="url"><span itemprop="title"><?=$storyName?></span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong>Chapter List</strong></li>
			</ul>
	</div>
	<div class="row wrapper ">
				
		<h1 style="text-align: center;margin-top: 10px;">Chapter List</h1>
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
			<li class="disable" style="float:left;width: 35%; color: #E86C19;">
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

			<li class="disable" style="float:right;width: 55%; color: #E86C19; text-align: center; font-size: 20px; font-weight: bold">
				<form method="POST" action="chapterlist.php?storyID=<?=$storyID?>">
				<?php	
					if($_SESSION['require_coin'] == "all"){
				?>
						Require Coin:	<select name="is_coin" id="is_coin" style="width: 100px;font-size: 15px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 15px;" selected="selected">All</option>
		  						<option value="1" style="font-size: 15px;">Required</option>
		  						<option value="0" style="font-size: 15px;">Free</option>
							</select>
							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php	
						}
						if($_SESSION['require_coin'] == "1"){
					?>
						Require Coin:	<select name="is_coin" id="is_coin" style="width: 100px;font-size: 15px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 15px;">All</option>
		  						<option value="1" style="font-size: 15px;" selected="selected">Required</option>
		  						<option value="0" style="font-size: 15px;">Free</option>
							</select>

							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php
						}
						if($_SESSION['require_coin'] == "0"){
					?>
						Require Coin:	<select name="is_coin" id="is_coin" style="width: 100px;font-size: 15px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 15px;">All</option>
		  						<option value="1" style="font-size: 15px;">Yes</option>
		  						<option value="0" style="font-size: 15px;" selected="selected">No</option>
							</select>

							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php
						}
					?>
				</form>
			</li>
		</ul>
		<ul class="nav" style="font-size: 13px; width: 100%; float:left; color: #E86C19;"> <p style="font-size: 16px; width: 100%;"> The information sheet below shows the list of chapter in order from the latest chapter to older one.</p></ul>
	
		<div class="table-responsive" style="margin-top: 120px; width:100%; " > 
			<table class="table" style="width: 100%; text-align: center;">
				<thead>
					<tr>
						<th style="text-align: center; font-size: 14px; width: 8%; background-color: #F5D7B9">No.</th>
						<th style="text-align: center; font-size: 14px; width: 35%; background-color: #F5D7B9">Chapter Title</th>
						<th style="text-align: center; font-size: 14px; width: 15%;background-color: #F5D7B9">Votes</th>
						<th style="text-align: center; font-size: 14px; width: 15%;background-color: #F5D7B9">Views</th>
						<th style="text-align: center; font-size: 14px; width: 15%;background-color: #F5D7B9">RequireCoin</th>
						<th style="text-align: center; font-size: 14px; width: 12%;background-color: #F5D7B9">Action</th>
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
					if($_SESSION['require_coin'] == "all"){
						$sql2= "SELECT * FROM chapter WHERE storyID='".$storyID."' ORDER BY chapterID DESC LIMIT {$beginrow} , {$pagesize}";

					}else{
						$sql2= "SELECT * FROM chapter WHERE storyID='".$storyID."' AND requireCoin ='".$_SESSION['require_coin'] ."' ORDER BY storyID DESC LIMIT {$beginrow} , {$pagesize}";
					}

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
						$is_coin = $row2[$i][4];

						$sql3 = "SELECT * FROM vote WHERE chapterID='" .$chapterID . "'";
						if(execsql($sql3)){
							$voteNumber = count(query($sql3));
						}else{
							$voteNumber = 0;
						}
						
				?>	
					<tr>
						<td style=" width: 8%; text-align: center;"><?=$i+1+($currentpage-1)*10?></td>
						<td class="nav-list name_list" style="width: 35%">
							<div class="media truyen-item">
								<a href="../readstory.php?storyID=<?=$storyID?>&chapterID=<?=$chapterID?>">
								<h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#333333; text-align: left;"><?=decryptString($chapterName)?></h2>
								</a>
							</div>
										
						</td>
						<td style="width: 15%; text-align: center;">
							<span itemprop="votes"><b> <?=$voteNumber?></b>
							</span>
						</td>
						<td style="width: 15%; text-align: center;">
							<span itemprop="rating"><b> <?=$viewNumber?></b>
							</span>
						</td>

						<td style="width: 15%; text-align: center;">
							<?php
								if($is_coin == "0"){
									echo("<span style='font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#2D9123;'>Free</span>");
								}else{
									echo("<span style='font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#D40C0C;'>Required</span>");
								}
							?>		
						</td>
						<td style="width: 12%; text-align: center; ">
								<!--	<a href="editstory.php?storyID=<?=$storyID?>" class="btn"><i class="icon-edit"></i></a> -->
									<button type="button" name="btn_delete" id="btn_delete<?=$chapterID?>" class="btn btn-warning" data-toggle="modal" data-target="#delete_confirm<?=$chapterID?>"><i class="icon-remove-sign"></i>
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
										<h2>Are you sure to Delete this chapter of story: "<?=$storyName?>"?</h2>
										<img style="width: 230px; height: 230px;" src="../img/remove-chapter.jpg">
										<h5><?=$storyName?></h5>
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


			<div class="row wrapper"></div>			
			<?php 
			require_once("../footers/footer.php");
		?>

		</div>
	</div>
</div>
</body>
</html>