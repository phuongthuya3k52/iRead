<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta name="description" content="Truyện Hot 24h hay nhất và mới nhất. Đọc truyện online nhiều thể loại tại TruyệnYY - Kho truyện được tuyển chọn và biên tập tốt nhất.">
<meta name="keywords" content="Doc truyen online, truyen kiem hiep, truyen tien hiep, truyen sac hiep, truyen ngon tinh, truyen trinh tham, vong du, truyen convert full text">
<link rel="alternate" type="application/atom+xml" title="Đọc Truyện Online - Truyện Kiếm Hiệp" href="http://feeds.feedburner.com/truyenyy">
<title>Member List | Admin | iRead</title>
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
  	// Fillter

  	if(!isset($_SESSION['page']) && !isset($_POST['type_acc'])){
  		$_SESSION['page'] = "all";
  	}
  	if(!isset($_SESSION['page']) && isset($_POST['type_acc'])){
  		$_SESSION['page'] = $_POST['type_acc'];
  	}
  	if(isset($_SESSION['page']) && !isset($_POST['type_acc'])){
  		$_SESSION['page'] = $_SESSION['page'];
  	}
  	if(isset($_SESSION['page']) && isset($_POST['type_acc'])){
  		$_SESSION['page'] = $_POST['type_acc'];
  	}

  	if(!isset($_SESSION['status']) && !isset($_POST['status_acc'])){
  		$_SESSION['status'] = "all";
  	}
  	if(!isset($_SESSION['status']) && isset($_POST['status_acc'])){
  		$_SESSION['status'] = $_POST['status_acc'];
  	}
  	if(isset($_SESSION['status']) && !isset($_POST['status_acc'])){
  		$_SESSION['status'] = $_SESSION['status'];
  	}
  	if(isset($_SESSION['status']) && isset($_POST['status_acc'])){
  		$_SESSION['status'] = $_POST['status_acc'];
  	}

  		if($_SESSION['page'] == "all" && ($_SESSION['status']) == "all"){
	  		$sql = "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON member.username = account.username";
		    $row = query($sql);
		    $total = count($row);
	  	}
	  	if($_SESSION['page'] == "all" && $_SESSION['status'] == "active"){
	  		$sql = "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON member.username = account.username WHERE member.username !='null' ";
	    	$row = query($sql);
	    	$total = count($row);
	  	}
	  	if($_SESSION['page'] == "all" && $_SESSION['status'] == "deleted"){
	  		$sql = "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON member.username = account.username WHERE member.username =='null' ";
	    	$row = query($sql);
	    	$total = count($row);
	  	}


	  	if($_SESSION['page'] != "all" && $_SESSION['status'] == "all"){
	  		$sql = "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON  member.username = account.username WHERE role = '".$_SESSION['page']."'";
		    $row = query($sql);
		    $total = count($row);
	  	}
	  	if($_SESSION['page'] != "all" && $_SESSION['status'] == "active"){
	  		$sql = "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON member.username = account.username WHERE role = '".$_SESSION['page']."' && member.username !='null' ";
	    	$row = query($sql);
	    	$total = count($row);
	  	}
	  	if($_SESSION['page'] != "all" && $_SESSION['status'] == "deleted"){
	  		$sql = "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON member.username = account.username WHERE role = '".$_SESSION['page']."' && member.username =='null' ";
	    	$row = query($sql);
	    	$total = count($row);
	  	}
  	
  	
  	// Update role
  	 if(isset($_POST['mem_role']) && isset($_POST['user_name']) && isset($_POST['memberID'])){
  	 	$role = $_POST['mem_role'];
  	 	$us = $_POST['user_name'];
  	 	$memberID = $_POST['memberID'];

  	 	$sql1 = "UPDATE account SET role = '".$role."' WHERE username ='".$us."' ";
  	 	//echo("sql1 =".$sql1);
    	$result1 = execsql($sql1);
    	//echo("result1 = ".$result1);
    	if($result1 != null){
    ?>
			<script>
				alert ("The account role has been updated successfully!");
				window.location.replace("./accountlist.php");
			</script> 
	<?php
		}else{	
	?>
			<script>
				alert ("Failed to update the account role. Please try again!");
				window.location.replace("./accountlist.php");
			</script> 
	<?php
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
						<a href="home.php" itemprop="url"><span itemprop="title">Home</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong>Member List</strong></li>
			</ul>
	</div>
	<div class="row wrapper ">
				
		<h1 style="text-align: center;margin-top: 10px;">Account List</h1>
		<ul class="nav" style="margin-top: 40px;">
			<form method="POST" action="accountlist.php">
				<li class="disable" style="float:left;width: 25%; color: #E86C19; text-align: center;">
				
					<?php
						if($_SESSION['page'] == "all"){
					?>
							<select name="type_acc" id="type_acc" style="width: 100px;font-size: 17px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 17px;" selected="selected">All</option>
		  						<option value="admin" style="font-size: 17px;">Admin</option>
		  						<option value="member" style="font-size: 17px;">Member</option>
							</select>
							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php	
						}
						if($_SESSION['page'] == "admin"){
					?>
							<select name="type_acc" id="type_acc" style="width: 100px;font-size: 17px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 17px;">All</option>
		  						<option value="admin" style="font-size: 17px;" selected="selected">Admin</option>
		  						<option value="member" style="font-size: 17px;">Member</option>
							</select>
							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php
						}
						if($_SESSION['page'] == "member"){
					?>
							<select name="type_acc" id="type_acc" style="width: 100px;font-size: 17px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 17px;">All</option>
		  						<option value="admin" style="font-size: 17px;">Admin</option>
		  						<option value="member" style="font-size: 17px;" selected="selected">Member</option>
							</select>
							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php
						}
					?>
				</li>
				<li class="disable" style="float:left;width: 25%; color: #E86C19; text-align: center;">
				
					<?php
						if($_SESSION['status'] == "all"){
					?>
							<select name="status_acc" id="type_acc" style="width: 100px;font-size: 17px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 17px;" selected="selected">All</option>
		  						<option value="active" style="font-size: 17px;">Active</option>
		  						<option value="deleted" style="font-size: 17px;">Deleted</option>
							</select>
							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php	
						}
						if($_SESSION['status'] == "active"){
					?>
							<select name="status_acc" id="type_acc" style="width: 100px;font-size: 17px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 17px;">All</option>
		  						<option value="active" style="font-size: 17px;" selected="selected">Active</option>
		  						<option value="deleted" style="font-size: 17px;">Deleted</option>
							</select>
							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php
						}
						if($_SESSION['status'] == "deleted"){
					?>
							<select name="status_acc" id="type_acc" style="width: 100px;font-size: 17px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 17px;">All</option>
		  						<option value="active" style="font-size: 17px;">Active</option>
		  						<option value="deleted" style="font-size: 17px;" selected="selected">Deleted</option>
							</select>
							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php
						}
					?>
				</li>
			</form>
		</ul><br>
		<ul class="nav" style="margin-top: 40px;">
			<li class="disable" style="float:left;width: 45%; color: #E86C19;">
				<h2><i class="icon-book icon-large"></i>Total Member: <?=$total?></h2>
			<!--	<p style="font-size: 13px; width: 100%;"> The information sheet below shows the list of transactions in order from the latest story to older one.</p>  -->
			</li>

		<!--	<li class="disable" style="float:left;width: 25%; color: #E86C19; text-align: center;">
				<form method="POST" action="accountlist.php">
					<?php
						if($_SESSION['page'] == "all"){
					?>
							<select name="type_acc" id="type_acc" style="width: 100px;font-size: 17px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 17px;" selected="selected">All</option>
		  						<option value="admin" style="font-size: 17px;">Admin</option>
		  						<option value="member" style="font-size: 17px;">Member</option>
							</select>
							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php	
						}
						if($_SESSION['page'] == "admin"){
					?>
							<select name="type_acc" id="type_acc" style="width: 100px;font-size: 17px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 17px;">All</option>
		  						<option value="admin" style="font-size: 17px;" selected="selected">Admin</option>
		  						<option value="member" style="font-size: 17px;">Member</option>
							</select>
							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php
						}
						if($_SESSION['page'] == "member"){
					?>
							<select name="type_acc" id="type_acc" style="width: 100px;font-size: 17px; margin-top: 15px;" >
		  						<option value="all" style="font-size: 17px;">All</option>
		  						<option value="admin" style="font-size: 17px;">Admin</option>
		  						<option value="member" style="font-size: 17px;" selected="selected">Member</option>
							</select>
							<button type="submit" class="btn" style="margin-top: 5px;"><i class="icon-filter icon-large"></i></button>
					<?php
						}
					?>
						
					
				</form>
			</li>  -->

			<li style="float: right;width: 30%; margin-top: 10px"><a href="./newaccount.php" style="width: 30%; height: auto; min-height: 25px; float: right; font-size: 15px; background-color: blue"  class="btn btn-primary"><i class="icon-plus icon-large"></i> New</a></li>
		</ul>
		<ul class="nav" style="font-size: 13px; width: 100%; float:left; color: #E86C19;"> The information sheet below shows the list of transactions in order from the latest story to older one.</ul>
	
		<div class="table-responsive" style="margin-top: 120px; width:100%"> 
			<table class="table" style="width: 100%">
				<thead>
					<tr>
						<th style="text-align: center; font-size: 14px; width: 5%; background-color: #F5D7B9">No.</th>
						<th style="text-align: center; font-size: 14px; width: 10%; background-color: #F5D7B9">Full Name</th>
						<th style="text-align: center; font-size: 14px; width: 15%;background-color: #F5D7B9">DOB</th>
						<th style="text-align: center; font-size: 14px; width: 15%;background-color: #F5D7B9">Phone Number</th>
						<th style="text-align: center; font-size: 14px; width: 10%;background-color: #F5D7B9">Wallet (Coin)</th>
						<th style="text-align: center; font-size: 14px; width: 15%;background-color: #F5D7B9">User Name</th>
						<th style="text-align: center; font-size: 14px; width: 15%;background-color: #F5D7B9">Email</th>
						<th style="text-align: center; font-size: 14px; width: 15%;background-color: #F5D7B9">Role</th>
						<th style="text-align: center; font-size: 14px; width: 5%;background-color: #F5D7B9">Stories</th>
						<th style="text-align: center; font-size: 14px; width: 5%;background-color: #F5D7B9">Action</th>
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

					if($_SESSION['page'] == "all" && $_SESSION['status'] == "all"){
						$sql2= "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON member.username = account.username ORDER BY memberID DESC LIMIT {$beginrow} , {$pagesize}";
					}
					if($_SESSION['page'] == "all" && $_SESSION['status'] == "active"){
						$sql2= "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON member.username = account.username WHERE member.username !='null' ORDER BY memberID DESC LIMIT {$beginrow} , {$pagesize}";
					}
					if($_SESSION['page'] == "all" && $_SESSION['status'] == "deleted"){
						$sql2= "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON member.username = account.username WHERE member.username =='null' ORDER BY memberID DESC LIMIT {$beginrow} , {$pagesize}";
					}


					if($_SESSION['page'] != "all" && $_SESSION['status'] == "all"){
						$sql2= "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON member.username = account.username WHERE role ='".$_SESSION['page'] ."' ORDER BY memberID DESC LIMIT {$beginrow} , {$pagesize}";
					}
					if($_SESSION['page'] != "all" && $_SESSION['status'] == "all"){
						$sql2= "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON member.username = account.username WHERE role ='".$_SESSION['page'] ."' && member.username !='null' ORDER BY memberID DESC LIMIT {$beginrow} , {$pagesize}";
					}
					if($_SESSION['page'] != "all" && $_SESSION['status'] == "all"){
						$sql2= "SELECT memberID, fullName, dob, phoneNumber, member.username, wallet, image, role, email FROM member INNER JOIN account ON member.username = account.username WHERE role ='".$_SESSION['page'] ."' && member.username =='null' ORDER BY memberID DESC LIMIT {$beginrow} , {$pagesize}";
					}
					$row2=query($sql2);


					for($i=0; $i < count($row2); $i++)
					{
						$memberID = $row2[$i][0];
						$memname = $row2[$i][1];
						$dob = $row2[$i][2];
						$phone = $row2[$i][3];
						$usname = $row2[$i][4];
						$wallet = $row2[$i][5];
						$image = $row2[$i][6];
						
						$rolemember = $row2[$i][7];
						$email = $row2[$i][8];

												
						
						$sql3 = "SELECT * FROM story WHERE memberID='" .$memberID . "'";
                        $result3 = execsql($sql3);
                        if($result3 != "null"){
                        	$total_story = count(query($sql3));
                        }else{
                        	$total_story = "";
                        }
				?>	
					<tr>
						<td style="width: 5%; text-align: center;"><?=$i+1+($currentpage-1)*10?></td>
						<td class="nav-list name_list" style="width: 13%">
							<div class="media truyen-item">
								<a class="pull-left" href="chapterlist.php?storyID=<?=$row2[$i][0]?>">
									<h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#333333; text-align: center;">
										<?=$memname?>	
                            		</h2>
								</a>
							</div>
										
						</td>
						<td style="width: 15%">
							<div  style="text-align: center; width: 100%">
								<div class="media-body">
								<?=$dob?>				
								</div>
							</div>
						</td>
						<td style="width: 15%; text-align: center;">
							<?=$phone?>	
						</td>
						<td style="width: 10%; text-align: center;">
 							<b><?=$wallet?></b>	
						</td>
						<td style="width: 12%; text-align: center;">
							<b> <?=$usname?></b>
						</td>

						<td style="width: 10%; text-align: center;">
							<?=$email?>		
						</td>
						<td style="width: 10%; text-align: center;">
							<form method="POST" action="accountlist.php">
							<?php
								if($rolemember == "admin"){
							?>
									<select name="mem_role" id="mem_role" style="width: 80px;font-size: 12px; margin-top:0px;">
				  						<option value="admin" style="font-size: 12px;" selected="selected">Admin</option>
				  						<option value="member" style="font-size: 12px;">Member</option>
									</select>
									<input type="hidden" name="user_name" value="<?=$usname?>">
									<input type="hidden" name="memberID" value="<?=$memberID?>">
									<button type="submit" class="btn" style="margin-top: 0px; width: 40px;"><i class="icon-ok icon-large"></i></button>
							<?php
								}
								if($rolemember == "member") {
							?>
									<select name="mem_role" id="mem_role" style="width: 80px;font-size: 12px; margin-top:0px;">
				  						<option value="admin" style="font-size: 12px;">Admin</option>
				  						<option value="member" style="font-size: 12px;" selected="selected">Member</option>
									</select>
									<input type="hidden" name="user_name" value="<?=$usname?>">
									<input type="hidden" name="memberID" value="<?=$memberID?>">
									<button type="submit" class="btn" style="margin-top: 0px; width: 40px;"><i class="icon-ok icon-large"></i></button>
							<?php
								}
							?>								
							</form>
								
						</td>

						<td style="width: 5%; text-align: center; ">
							<?=$total_story?>
									
						</td>

						<td style="width: 5%; text-align: center; ">
						<!--	<a href="editstory.php?storyID=<?=$storyID?>" class="btn"><i class="icon-edit"></i></a> -->
							<button type="button" name="btn_delete" id="btn_delete<?=$memberID?>" class="btn btn-warning" data-toggle="modal" data-target="#delete_confirm<?=$memberID?>"><i class="icon-remove-sign"></i>
							</button>
									
						</td>  
					</tr>

					<!-- Delete confirm modal   -->
						<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
						<script type="text/javascript" src="js/bootstrap-modal.js"></script>

						<div class="modal hide fade" id="delete_confirm<?=$memberID?>" style="display: none;">
							<form  method="POST" action="delete.php" >
								<div class="modal-header">
									<span class="disable" data-dismiss="modal" aria-hidden="true" style="color: #ff4444; font-size: 44px; font-weight: bold; float: right;cursor:pointer;">&times;</span>
										<h3>Delete Account</h3>	
								</div>
								<div class="modal-body" style="text-align: center; margin-top:0px">
									<h2>Are you sure to <span style="color: red">Delete</span> this account?</h2>
									<img style="width: 150px; height: 150px; border-radius: 50%; border: 0.5px solid black" src="../img/<?=$image?>">
									<h5>Full name: <?=$memname?></h5>
									<h5>User name: <?=$usname?></h5>
									<input type="hidden" name="member_id" value="<?=$memberID?>">
									<input type="hidden" name="usname" value="<?=$usname?>">
									

									<button type="submit" name="cf_del_member" class="btn btn-primary" style="background-color: blue; width:14% ">Yes</button>&emsp;&emsp;
									
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
									<li class="disable"><a href="accountlist.php?currentpage=<?=$i?>"><?php echo $i ." "; ?></a></li>
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