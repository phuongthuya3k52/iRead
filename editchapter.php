<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta name="description" content="
    Đại Chúa Tể Chương 1432: Phù Đồ Huyền ra tay. Tác Giả: Thiên Tàm Thổ Đậu ở TruyệnYY.com, kho truyện được tuyển chọn và biên tập tốt nhất.
">
<meta name="keywords" content="Doc truyen online, truyen kiem hiep, truyen tien hiep, truyen sac hiep, truyen ngon tinh, truyen trinh tham, vong du, truyen convert full text">
<meta name="dcterms.rightsHolder" content="truyenyy.com">
<link href="http://fonts.googleapis.com/css?family=Patrick+Hand|Noticia+Text:400,400italic&subset=latin,vietnamese" rel='stylesheet' type='text/css'>
<link href="css/bootstrap-modal.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
<title>Writing stories | iRead</title>
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

<script src="ckeditor/ckeditor.js"></script> 


<style>
	body{
		padding-top:60px;padding-bottom:40px;height:auto;background-image:none;
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
		if(isset($_GET['storyID']))
		{
			$storyID=$_GET['storyID'];
			$sql = "Select * from story where storyID='" .$storyID . "'";
			$row = query($sql);

			if(isset($_POST['requireCoin'])){
				$requireCoin=1;
			}
			else{
				$requireCoin=0;
			}

			if(isset($_POST['title'])){				
				$title=encryptString($_POST['title']);
				$content=$_POST['content'];
				
				$sql1 = "Insert into chapter values ('','" .$title ."','" .$storyID ."','" .$content ."','" .$requireCoin ."','0')"; 
				
				$result1 = execsql($sql1);

				if ($result1 != null){
?>				
					<script>
						alert("New chapter is saved succesfully!");
						window.location.replace("./newchapter.php?storyID=<?=$row2[0][0]?>");
					</script>
<?php 		
				}else{
?>				
					<script >
						alert ("New chapter is not saved. Try again!");
						window.location.replace("./newchapter.php?storyID=<?=$row2[0][0]?>");
					</script>
<?php
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
	<div class="row">
		<div class="span12">

			<ul class="breadcrumb">

				<li class="ds-theloai">
					<div itemscope>
						<a href="home.php" itemprop="url"><span itemprop="title">Home</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="ds-theloai">
					<div itemscope>
						<a href="mystories.php" itemprop="url"><span itemprop="title">My stories</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="ds-theloai">
					<div itemscope>
						<a href="./mystory.php?storyID=<?=$row[0][0]?>" itemprop="url"><?=decryptString($row[0][1])?></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active">
						<strong>New Chapter</strong>
				</li>	
			</ul>
			
<!--			<div class="container-fluid chap_content">
				<div id="noidungtruyen">sghfhfx

				</div>
			</div>  -->
			
			<div class="clearfix" style="background-color: #f2f2f2">

				<table width="90%" style=" margin-top: 20px; margin-bottom: 20px " align="center" border-spacing= "10px"  padding= "5px">
					<form action="newchapter.php?storyID=<?=$row[0][0]?>" method="post" role="form">
					<tr>
						<td colspan="3">
							<input style="width: 20px; height: 20px; " type="checkbox" id="requireCoin" name="requireCoin" value="1"> Require Coin 
						</td>
					</tr>
					<tr><td colspan="3">
						<br>
					</td></tr>
					<tr>
						<td colspan="3">
							<input style= "width: 99%; height: 40px; font-size: 20px; font-weight: bold; text-align: center;" align="center" name="title" maxlength="200" type="text" required="required" placeholder="Story Title" class="breadcrumb" id="id_title" title="Title has maximum of 200 characters"/>
						</td>

					
					</tr>
				
				<!--	<hr class="end-chap">  -->
					
					<script type="text/javascript">
				   		function getContext(){
			            var data = CKEDITOR.instances.write.getData();
			            alert(data)
			        }
				   	</script>
				  	<tr>
					
      					<td colspan="3">
      						<textarea style= "width: 90%;" name="content" id="content" required="required"></textarea>
				      	<script>CKEDITOR.replace('content');</script> 

      					</td>
				    	
				  	</tr>
				  	<tr>
				  		<td></td>
				  		<td style="width: 40%">
							<div style="text-align: center; margin:20px 0;">				  			<button style="width: 35%; height: 35px; float: left; font-size: 15px; text-align: center;" type="submit" class="btn btn-primary" data-loading-text="Loading" value="Submit">
								Save
							</button>
							<a href="./mystories.php" style="width: 30%; height: 25px; float: right; font-size: 15px"  class="btn btn-default"> Cancle</a>
							</div>


				  		<!--	<div class="mobi-chuyentrang">
							<a href="#" class="btn btn-small btn-warning">
								<i class="fa fa-floppy-o" aria-hidden="true" onclick="getContext()"></i> Save
							</a>
						
							<a href="#" class="btn btn-small btn-warning">
								<i class="fa fa-floppy-o" aria-hidden="true"></i> Draft
							</a>
						</div>   -->
				  		</td>
				  		<td></td>
				  	</tr>
				
				   	</form>
				</table>
			</div>

			<div class="hide-x" style="width:300px; float: right;margin: 25px 35px 0 0;">
			</div>
			<div class="clearfix"></div>
			<!--	<div style="text-align:center;font-weight:bold" class=""><a href="#" rel="nofollow" target="_blank">Báo Lỗi Truyện</a></div>  -->
			</div>
			
		</div>
	</div>
</div>
</body>
</html>