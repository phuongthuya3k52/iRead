<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    //Search member name
	if(isset($_POST['search_name']) &&  isset($_POST['search'])){
	/*	if($_GET['search'] == ""){
		?>
    		<script >
				alert ("You must enter at least a keyword to search!");
				window.location.replace("./memberlist.php");
			</script>
		<?php	
		} */
		if($_POST['search'] != ""){
			$search = $_POST['search'];

			$sql = "SELECT * FROM transaction WHERE fullName LIKE '%" .$search . "%'";
			//echo($sql);
			$row = query($sql);	
			$total_search = count($row);		
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
				<li class="active"><strong>Transaction List</strong></li>
			</ul>
	</div>
	<div class="row wrapper ">
				
		<h1 style="text-align: center;margin-top: 10px;">Transactions List</h1>
	<!--	<div style =" width: 100%; text-align: center;" >

			<form action="trans_history.php" method="POST">
			<?php
				if(!isset($_POST['search']) || $_POST['search'] == ""){
			?>
				
				<input type="text" name="search" class=" " placeholder="Enter member name..." style =" width: 60%; margin-top: 25px;margin-left: 25px;">
			<?php
			}else{
			?>
				<input type="text" name="search" class=" " placeholder="Enter member name..." value="<?=$search?>" style =" width: 60%; margin-top: 25px;margin-left: 25px;">
			<?php
			}
			?>
				<button class="btn" type="submit" name="search_name" style="float: right; margin-top: 25px; margin-right: 40px; width: 15%"><i class="icon-search"></i></button>
			</form>
		</div>   -->
		<ul class="nav" style="margin-top: 40px; margin-bottom: 40px">
			<li class="disable" style="float:left;width: 100%; color: #E86C19;">
			<?php  
				if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search']) && $_POST['search'] != "" ){
			?>
					<h2><i class="icon-book icon-large"></i>Total Transactions Of <?=$_POST['search']?>: <?=$total_search?></h2>
			<?php	
				}else{
			?>
					<h2><i class="icon-book icon-large"></i>Total Transactions: <?=$total?></h2>
			<?php	
				}
			?>
				
				<p style="font-size: 16px; width: 100%;"> The information sheet below shows the list of transactions in order from the latest story to older one.</p>
			</li>
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

					$sql2= "SELECT transactionID, transaction.memberID, transaction.money, vnp_response_code, code_vnpay, code_bank, transaction.createAt, member.fullName  FROM transaction INNER JOIN member ON  transaction.memberID = member.memberID ORDER BY transactionID DESC LIMIT {$beginrow} , {$pagesize}";

				/*	//Search
					if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search']) && $_POST['search'] != ""){
						$sql2= "SELECT transactionID, transaction.memberID, transaction.money, vnp_response_code, code_vnpay, code_bank, transaction.createAt, member.fullName  FROM transaction INNER JOIN member ON  transaction.memberID = member.memberID WHERE member.fullName LIKE '%" .$search . "%' ORDER BY transactionID DESC LIMIT {$beginrow} , {$pagesize}";  
					}*/

					$row2=query($sql2);  


					for($i=0; $i < count($row2); $i++)
					{
						$memberID = $row2[$i][1];
						$amount = $row2[$i][2];
						$response_code = $row2[$i][3];
						$vnpay_code = $row2[$i][4];
						$method = $row2[$i][5];
						$time = $row2[$i][6];
						$memname = $row2[$i][7];
				?>	
					<tr>
						<td style="width: 5%; text-align: center;"><?=$i+1+($currentpage-1)*10?></td>
						<td class="nav-list name_list" style="width: 20%">
							<div class="media truyen-item">
								<a class="pull-left" href="memberlist.php?memberID=<?=$memberID?>">
									<h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#333333; text-align: center;">
										<?php
                              				/*$sql4 = "SELECT * FROM member WHERE memberID='" .$memberID . "'";
                              				$row4 = query($sql4);
                              				$memname = $row4[0][1];  */
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

						</tr>

						
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
			require_once("../footers/footer.php");
		?>

		</div>
	</div>
</div>
</body>
</html>