<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta name="description" content="Truyện Hot 24h hay nhất và mới nhất. Đọc truyện online nhiều thể loại tại TruyệnYY - Kho truyện được tuyển chọn và biên tập tốt nhất.">
<meta name="keywords" content="Doc truyen online, truyen kiem hiep, truyen tien hiep, truyen sac hiep, truyen ngon tinh, truyen trinh tham, vong du, truyen convert full text">
<link rel="alternate" type="application/atom+xml" title="Đọc Truyện Online - Truyện Kiếm Hiệp" href="http://feeds.feedburner.com/truyenyy">
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

	$sql= "SELECT * FROM category";
			//echo($sql);
	$row = query($sql);	
	$total= count($row);		

// Update category name
  	 if(isset($_POST['cat_name']) && isset($_POST['cat_ID'])){
  	 	$catname = $_POST['cat_name'];
  	 	$categoryID = $_POST['cat_ID'];

  	 	$sql1 = "UPDATE category SET categoryName = '".$catname."' WHERE categoryID ='".$categoryID."' ";
  	 	//echo("sql1 =".$sql1);
    	$result1 = execsql($sql1);
    	//echo("result1 = ".$result1);
    	if($result1 != null){
    ?>
			<script>
				alert ("The category name has been updated successfully!");
				window.location.replace("./categorylist.php");
			</script> 
	<?php
		}else{	
	?>
			<script>
				alert ("Failed to update the category name. Please try again!");
				window.location.replace("./categorylist.php");
			</script> 
	<?php
		}		
    }

// Create new category
  	if(isset($_POST['newcat']) && isset($_POST['cf_new_category'])){
  	 	$catname = $_POST['newcat'];
  	 	$check = true;
  	 	if(strlen($catname) > 50){
  	 ?>
			<script>
				alert ("Max length of the Category Name is 50 characters. Please try again!");
				window.location.replace("./categorylist.php");
		</script> 
	<?php
		}else{	

	  	 	for($i=0; $i<count($row); $i++){
	  	 		if($catname == $row[$i][1]){
	  	 			$check = true;
	?>
		  			<script>
						alert ("The category name has already exists. Please try again!");
						window.location.replace("./categorylist.php");
					</script> 
			<?php
					exit;
				}else{
					$check = false;
				}
			}
			if($check == false){
				$sql1 = "INSERT INTO category VALUES ('','".$catname ."')";
			  	//echo("sql1 =".$sql1);
			   	$result1 = execsql($sql1);
			    //echo("result1 = ".$result1);
			    if($result1 != null){
			?>
					<script>
						alert ("The category has been save successfully!");
						window.location.replace("./categorylist.php");
					</script> 
			<?php
				}else{	
			?>
				<script>
					alert ("Failed to save the category. Please try again!");
					window.location.replace("./categorylist.php");
				</script> 
			<?php
				}  
			}
	  	 	
	  	}		
    }

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
						<a href="admin.php" itemprop="url"><span itemprop="title">Dash board</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong>Category List</strong></li>
			</ul>
	</div>
	<div class="row wrapper ">
				
		<h1 style="text-align: center;margin-top: 10px;">Category List</h1>
	<!--	<div style =" width: 100%; text-align: center;" >

			<form action="categorylist.php" method="GET">
			<?php
				if(!isset($_GET['search'])){
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
		</div>  -->
		<ul class="nav" style="margin-top: 40px; margin-bottom: 40px">
			<li class="disable" style="float:left;width: 35%; color: #E86C19;">
			
				<h2><i class="icon-book icon-large"></i>Total: <?=$total?></h2>
			</li>

			
			<li style="float: right;width: 30%;margin-top: 10px;"><a href="#new_category" style="max-width:80px; width: 70%; height: auto; min-height: 25px; float: right; font-size: 15px; background-color: blue; "  class="btn btn-primary" data-toggle="modal"><i class="icon-plus icon-large"></i> New</a></li>
		</ul>
		<ul class="nav" style="font-size: 13px; width: 100%; float:left; color: #E86C19;"> <p style="font-size: 13px; width: 100%;"> The information sheet below shows the list of categories in order from the latest categories to older one.</p></ul>
	
		<div class="table-responsive" style="margin-top: 120px; width:100%; text-align: center"> 
			<table class="table" style="width: 100%; text-align: center">
				<thead>
					<tr>
						<th style="text-align: center; font-size: 14px; width: 10%; background-color: #F5D7B9">No.</th>
						<th style="text-align: center; font-size: 14px; width: 50%; background-color: #F5D7B9">Category Title</th>
						<th style="text-align: center; font-size: 14px; width: 25%;background-color: #F5D7B9">Total Story</th>
						<th style="text-align: center; font-size: 14px; width: 15%;background-color: #F5D7B9">Action</th>
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
					$sql2= "SELECT * FROM category ORDER BY categoryID DESC LIMIT {$beginrow} , {$pagesize}";

					
					$row2=query($sql2);  


					for($i=0; $i < count($row2); $i++)
					{
						$categoryID = $row2[$i][0];
						$categoryName = $row2[$i][1];

				?>	
					<tr>
						<td style=" width: 10%; text-align: center;"><?=$i+1+($currentpage-1)*10?></td>
						<td class="nav-list name_list" style="width: 50%">
							<div class="media-body" style="text-align: center;">
								<form method="POST" action="categorylist.php">
									<a href="chapterlist.php?storyID=<?=$storyID?>">
										<input type="text" name="cat_name" value="<?=$categoryName?>" style="font-size: 15px; height: 30px; margin: 0;padding: 0;font-weight: bold;color:#333333; text-align: left;">
									<!--	<h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#333333; text-align: left;"><?=$categoryName?></h2>  -->
									</a>
									<input type="hidden" name="cat_ID" value="<?=$categoryID?>">
									<button type="submit" class="btn" style="margin-top: 0px; width: 40px;"><i class="icon-ok icon-large"></i></button>
								</form>
							</div>
										
						</td>
						<td style="width: 25%">
							<div  style="text-align: center; width: 100%">
								<div class="media-body">
												
								<?php
									$sql3 = "Select * from  story_category  WHERE categoryID='" .$categoryID . "'";
									if(execsql($sql3) != null){
										$row3 = query($sql3);
										$total_story = count($row3);
									}else{
										$total_story = 0;
									}
								?>	
										<span class="list-category" style="font-size: 12px; text-align: justify;">
											<span><a href="./storylist.php?categoryID=<?=$categoryID?>"><?=$total_story?></a></span>
										</span>
							</div>

						</td>
								
								<td style="width: 15%; text-align: center; ">
								<!--	<a href="cat.php?storyID=<?=$storyID?>" class="btn"><i class="icon-edit"></i></a> &emsp;  -->
								<?php

									if($categoryName != "No name"){
								?>
									<button type="button" name="btn_delete" id="btn_delete<?=$storyID?>" class="btn btn-warning" data-toggle="modal" data-target="#delete_confirm<?=$categoryID?>"><i class="icon-remove-sign"></i>
									</button>
								<?php }  ?>
								</td>
							</tr>

						<!-- Delete confirm modal -->
								<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
								<script type="text/javascript" src="js/bootstrap-modal.js"></script>

								<div class="modal hide fade" id="delete_confirm<?=$categoryID?>" style="display: none;">
									<form  method="POST" action="delete.php" >
									<div class="modal-header">
										<span class="disable" data-dismiss="modal" aria-hidden="true" style="color: #ff4444; font-size: 44px; font-weight: bold; float: right;cursor:pointer;">&times;</span>
										<h3>Delete Category</h3>
										
									</div>
									<div class="modal-body" style="text-align: center; margin-top:0px">
										<h2>Are you sure to Delete this category?</h2>
										
										<h4 style="color: #FB7A3A"><?=$categoryName?></h4><br>
										<input type="hidden" name="cat_id" value="<?=$categoryID?>">
									

										<button type="submit" name="cf_del_category" class="btn btn-primary" style="background-color: blue; width:14% ">Yes</button>&emsp;&emsp;
									
										<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancle</button>
									</div>

									</form>
								</div>

				<!-- New category modal -->

						<div class="modal hide fade" id="new_category" style="display: none;">
							<form  method="POST" action="categorylist.php" >
							<div class="modal-header">
								<span class="disable" data-dismiss="modal" aria-hidden="true" style="color: #ff4444; font-size: 44px; font-weight: bold; float: right;cursor:pointer;">&times;</span>
									<h3>New Category</h3>
											
							</div>
							<div class="modal-body" style="text-align: center; margin-top:0px">
											
								<div>
									<h2 style="font-weight: bold; color: #FD9322;">Category Name</h2>
									<input type="text" name="newcat" maxlength="50" required="required" title="The Category Name is up to 50 characters long " >
								</div><br>

								<button type="submit" name="cf_new_category" class="btn btn-primary" style="background-color: blue; width:14% ">Yes</button>&emsp;&emsp;
										
								<button type="button" name= "cf_new_category" class="btn" data-dismiss="modal" aria-hidden="true">Cancle</button>
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
									<li class="disable"><a href="categorylist.php?currentpage=<?=$i?>"><?php echo $i ." "; ?></a></li>
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