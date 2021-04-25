<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta name="description" content="Truyện Hot 24h hay nhất và mới nhất. Đọc truyện online nhiều thể loại tại TruyệnYY - Kho truyện được tuyển chọn và biên tập tốt nhất.">
<meta name="keywords" content="Doc truyen online, truyen kiem hiep, truyen tien hiep, truyen sac hiep, truyen ngon tinh, truyen trinh tham, vong du, truyen convert full text">
<link rel="alternate" type="application/atom+xml" title="Đọc Truyện Online - Truyện Kiếm Hiệp" href="http://feeds.feedburner.com/truyenyy">
<title>Transaction Histories | Admin | iRead</title>
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
    $sql = "SELECT * FROM transaction ";
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
						<a href="admin.php" itemprop="url"><span itemprop="title">Dash board</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong>Transaction List</strong></li>
			</ul>
	</div>
	<div class="row wrapper ">
				
		<h1 style="text-align: center;margin-top: 10px;">Transactions List</h1>
		<ul class="nav" style="margin-top: 40px; margin-bottom: 40px">
			<li class="disable" style="float:left;width: 100%; color: #E86C19;">
				<h2><i class="icon-book icon-large"></i>Total Transactions: <?=$total?></h2>
				<p style="font-size: 13px; width: 100%;"> The information sheet below shows the list of transactions in order from the latest story to older one.</p>
			</li>

			<!--<li style="float: right;width: 50%"><a href="./newstory.php?" style="width: 30%; height: auto; min-height: 25px; float: right; font-size: 15px; background-color: blue"  class="btn btn-primary"><i class="icon-plus icon-large"></i> New Story</a></li>-->
		</ul>
	
		<div class="table-responsive" style="margin-top: 120px; width:100%"> 
			<table class="table" style="width: 100%">
				<thead>
					<tr>
						<th style="text-align: center; font-size: 14px; width: 5%; background-color: #F5D7B9">No.</th>
						<th style="text-align: center; font-size: 14px; width: 20%; background-color: #F5D7B9">Full Name</th>
						<th style="text-align: center; font-size: 14px; width: 20%;background-color: #F5D7B9">Bank</th>
						<th style="text-align: center; font-size: 14px; width: 15%;background-color: #F5D7B9">Time</th>
						<th style="text-align: center; font-size: 14px; width: 10%;background-color: #F5D7B9">Amount(VND)</th>
						<th style="text-align: center; font-size: 14px; width: 20%;background-color: #F5D7B9">VNPay Code</th>
						<th style="text-align: center; font-size: 14px; width: 10%;background-color: #F5D7B9">Status</th>
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

					$sql2= "SELECT * FROM transaction ORDER BY transactionID DESC LIMIT {$beginrow} , {$pagesize}";

					$row2=query($sql2);  


					for($i=0; $i < count($row2); $i++)
					{
						$memberID = $row2[$i][1];
						$amount = $row2[$i][2];
						$response_code = $row2[$i][4];
						$vnpay_code = $row2[$i][5];
						$method = $row2[$i][6];
						$time = $row2[$i][7];
				?>	
					<tr>
						<td style="width: 5%; text-align: center;"><?=$i+1+($currentpage-1)*10?></td>
						<td class="nav-list name_list" style="width: 20%">
							<div class="media truyen-item">
								<a class="pull-left" href="chapterlist.php?storyID=<?=$row2[$i][0]?>">
									<h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#333333; text-align: center;">
										<?php
                              				$sql4 = "SELECT * FROM member WHERE memberID='" .$memberID . "'";
                              				$row4 = query($sql4);
                              				$memname = $row4[0][1];
                              				echo($memname);
                            			?>	
                            		</h2>
								</a>
							</div>
										
						</td>
						<td style="width: 20%">
							<div  style="text-align: center; width: 100%">
								<div class="media-body">
								<?=$method?>				
								</div>
							</div>
						</td>
						<td style="width: 15%; text-align: center;">
							<?=$time?>	
						</td>
						<td style="width: 10%; text-align: center;">
 							<b><?=$amount?></b>	
						</td>
						<td style="width: 20%; text-align: center;">
							<b> <?=$vnpay_code?></b>
						</td>

						<td style="width: 10%; text-align: center;">
							<?php
								if($response_code == "00"){
									echo("<span style='font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#2D9123;'>Success</span>");
								}elseif ($response_code == "24"){
									echo("<span style='font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#919191;'>Cancled</span>");# code...
								}else{
									echo("<span style='font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#E20404;'>Failure</span>");
								}
							?>		
						</td>
					<!--			<td style="width: 11%; text-align: center; ">
								<!--	<a href="editstory.php?storyID=<?=$storyID?>" class="btn"><i class="icon-edit"></i></a> 
									<button type="button" name="btn_delete" id="btn_delete<?=$storyID?>" class="btn btn-warning" data-toggle="modal" data-target="#delete_confirm<?=$storyID?>"><i class="icon-remove-sign"></i>
									</button>
									
								</td>  -->
						</tr>

						<!-- Delete confirm modal 
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
								</div>-->
			
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