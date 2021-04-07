<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta name="description" content="Truyện Hot 24h hay nhất và mới nhất. Đọc truyện online nhiều thể loại tại TruyệnYY - Kho truyện được tuyển chọn và biên tập tốt nhất.">
<meta name="keywords" content="Doc truyen online, truyen kiem hiep, truyen tien hiep, truyen sac hiep, truyen ngon tinh, truyen trinh tham, vong du, truyen convert full text">
<link rel="alternate" type="application/atom+xml" title="Đọc Truyện Online - Truyện Kiếm Hiệp" href="http://feeds.feedburner.com/truyenyy">
<title>Transaction History | iRead</title>
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
// Check transaction status
		if(isset($_GET['transtt'])){
		if($_GET['transtt'] == 1){
?>
    		<script >
				alert ("Successful transaction!");
				window.location.replace("./trans_history.php");
			</script>
<?php
		}else if($_GET['transtt'] == 2){
?>
    		<script >
				alert ("Transaction failed. Please try again!");
				window.location.replace("./trans_history.php");
			</script>
<?php			
		}else if($_GET['transtt'] == 3){
?>
    		<script >
				alert ("Transaction has been canceled!");
				window.location.replace("./trans_history.php");
			</script>
<?php			
		}}


		$sql = "SELECT * FROM member WHERE username = '" .$_SESSION['username'] . "'";
			//echo($sql);
		$row = query($sql);
		$memberID = $row[0][0];
		$walet = $row[0][5];

		$sql1 = "SELECT * FROM transaction WHERE memberID='" .$memberID . "'";
		$row1 = query($sql1);
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
						<a href="./home.php" itemprop="url"><span itemprop="title">Home</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong>Recharge Histories</strong></li>
			</ul>
			<div class="row wrapper">
			<?php 
				require_once("./lefts/member_left.php");
			?>
				<div class="span10">
						
						<h1 style="text-align: center;margin-top: 10px;"><?=$walet?><img src="./img/coin.jpg" style="border-radius: 50%; width: 45px;height: 45px;"></h1>
						<ul class="nav" style="margin-top: 40px; margin-bottom: 40px">
							<li class="disable" style="float:left;width: 50%; color: Orange;"><h2><i class="icon-book icon-large"></i>Total Transactions: <?=count($row1)?></h2></li>

							<li style="float: right;width: 50%"><a href="#recharge_form" data-toggle="modal" style="width: 20%; height: auto; min-height: 25px; float: right; font-size: 15px; background-color: blue"  class="btn btn-primary"><i class="icon-plus icon-large"></i> New</a></li>  
						</ul>

						<p style="margin-top: 120px; width:90%">
						<table class="table" style="margin-top: 30px; width:100%">
							<thead>
								<tr >
								<th style="text-align: center; font-size: 14px; width: 5%;">No.</th>
								<th style="text-align: center; font-size: 14px; width: 20%;">Status</th>
								<th style="text-align: center; font-size: 14px; width: 10%;">Money(VND)</th>
								<th style="text-align: center; font-size: 14px; width: 10%;">Bank</th>
								<th style="text-align: center; font-size: 14px; width: 15%;">Time</th>
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

								$sql2= "SELECT * FROM transaction WHERE memberID='" .$memberID . "' LIMIT {$beginrow} , {$pagesize}";

								$row2=query($sql2);  


								for($i=0; $i < count($row2); $i++)
								{
									$amount = $row2[$i][2];
									$response_code = $row2[$i][4];
									$bank = $row2[$i][6];
									$time = $row2[$i][7];
							?>
								<tr>
									<td style="padding-top: 10px; width: 5%;"><?=$i+1?></td>
									
									<td style="width: 20%">
										<div  style="text-align: center; width: 100%">
											<div class="media-body">
											<?php
												if($response_code == 00){
											?>
													<h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#2D9123;">Success</h2>
											<?php
												}else{
											?>
													<h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#E20404;">Failure</h2>
											<?php
												}
											?>
											</div>		
										</div>
									</td>
									<td style="width: 10%; text-align: center;"><?=$amount?></td>
									<td style="width: 10%; text-align: center;"><?=$bank?></td>
									<td style="width: 15%; text-align: center;"><?=$time?></td>
								</tr>
							<?php
								}
							?>
							</tbody>
						</table>
					</p>
					
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
			require_once("./footer.php");
		?>

		</div>
	</div>
</div>

</body>

</html>
<!-- Recharge modal -->
	<div class="modal hide fade" id="recharge_form" style="display: none;">
	<form  method="POST" role="form" action="./vnpay_php/vnpay_create_payment.php" >
		<div class="modal-header">
			<span class="disable" data-dismiss="modal" aria-hidden="true" style="color: #ff4444; font-size: 44px; font-weight: bold; float: right;cursor:pointer;">&times;</span>
			<h3>Recharge</h3>
										
		</div>
		<div class="modal-body" style="text-align: center; margin-top:-10px">
			<h2>Choose the amount of Coins you want to exchange, at least 50 coins!  </h2>
			
			<div style="width: 100%; text-align: center;">
				<table style="border: 1px solid black; width: 100%">
					<tr>
						<td style="width:30%;"></td>
						<td style="width:70%;"><span style="width:80%;color: red; width: 80% ">(1 coin = 1000 VND)</span></td>
					</tr>
					<tr>
						<td style="width:30%; text-align: right;">
							<label for="amount">Amount<img src="img/coin.jpg" style="width: 20px; height: 20px;"></label>							
						</td>
						<td style="width:70%">
							<input style="width:80%" class="form-control" id="amount"
                               name="amount" type="number" value="50" min="50" />
						</td>
					</tr>
					<tr>
						<td style="width:30%; text-align: right;">
							<label for="bank_code">Bank</label>
						</td>
						<td style="width:70%">
							<select name="bank_code" id="bank_code" class="form-control" style="width:84%">
                            	<option value="">No bank choosen</option>
                            	<option value="NCB">NCB Bank</option>
                            	<option value="AGRIBANK">Agribank</option>
                            	<option value="SCB">SCB bank</option>
                            	<option value="SACOMBANK">SacomBank</option>
                            	<option value="EXIMBANK">EximBank</option>
                            	<option value="MSBANK"> MSBANK</option>
                            	<option value="NAMABANK">NamABank</option>
                            	<option value="VNMART"><b> VnMart e-wallet</b></option>
                            	<option value="VIETINBANK">Vietinbank</option>
                            	<option value="VIETCOMBANK">VCB</option>
                            	<option value="HDBANK">HDBank</option>
                            	<option value="DONGABANK">Dong A Bank</option>
                            	<option value="TPBANK">TPBank</option>
                            	<option value="OJB">OceanBank</option>
                            	<option value="BIDV">BIDV Bank</option>
                            	<option value="TECHCOMBANK">Techcombank</option>
                            	<option value="VPBANK">VPBank</option>
                            	<option value="MBBANK"> MBBank</option>
                            	<option value="ACB">ACB Bank</option>
                            	<option value="OCB">OCB Bank</option>
                            	<option value="IVB">IVB Bank</option>
                            	<option value="VISA"><b> Payment through  VISA/MASTER card</b></option>
                        	</select>
						</td>
					</tr>
				</table>
            </div>

			<input type="hidden" name="trans_type" id="trans_type" value="billpayment">
			<input type="hidden" name="trans_desc" id="trans_desc" value="Coin recharge into account">
			<input type="hidden" name="language" id="language" value="en">
			<input type="hidden" name="memberID" id="memberID" value="<?=$memberID?>">

			<div style="margin-top: 20px">	
				<button type="submit" name="cf_recharge" class="btn btn-primary" style="background-color: blue; width:14% ">Submit</button>&emsp;&emsp;
									
				<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancle</button>
			</div>
		</div>

	</form>
	</div>