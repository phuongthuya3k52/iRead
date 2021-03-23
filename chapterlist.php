<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta name="description" content="Truyện Hot 24h hay nhất và mới nhất. Đọc truyện online nhiều thể loại tại TruyệnYY - Kho truyện được tuyển chọn và biên tập tốt nhất.">
<meta name="keywords" content="Doc truyen online, truyen kiem hiep, truyen tien hiep, truyen sac hiep, truyen ngon tinh, truyen trinh tham, vong du, truyen convert full text">
<link rel="alternate" type="application/atom+xml" title="Đọc Truyện Online - Truyện Kiếm Hiệp" href="http://feeds.feedburner.com/truyenyy">
<title>Truyện Hot 24h - Đọc truyện online | TruyệnYY</title>
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

<!-- <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-37191528-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script> -->
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
		$storyID = $_GET["storyID"];

		$sql = "SELECT * FROM story WHERE storyID='" .$storyID . "'";
		$row = query($sql);
		$storyName = decryptString($row[0][1]);

		$sql1 = "SELECT * FROM chapter WHERE storyID='" .$storyID . "'";
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
				<li>
					<div itemscope>
						<a href="./mystories.php" itemprop="url"><span itemprop="title">My Stories</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li>
					<div itemscope>
						<a href="./mystories.php" itemprop="url"><span itemprop="title"><?=$storyName?></span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong>Chapter list</strong></li>
			</ul>
			<div class="row wrapper">
				<?php 
				require_once("./lefts/common_left.php");
			?>
				<div class="span10">
						
						<h1 style="text-align: center;margin-top: 10px;"><?=$storyName?></h1>
						<ul class="nav" style="margin-top: 40px; margin-bottom: 40px">
							<li class="disable" style="float:left;width: 50%; color: Orange;"><h2><i class="icon-book icon-large"></i>Total Chapter: <?=count($row1)?></h2></li>

							<li style="float: right;width: 50%"><a href="./editchapter.php?" style="width: 30%; height: auto; min-height: 25px; float: right; font-size: 15px; background-color: blue"  class="btn btn-primary"><i class="icon-plus icon-large"></i> New chapter</a></li>
						</ul>

						<div style="margin-top: 120px; width:100%">
						<table class="table" style="margin-top: 30px">
							<thead>
								<tr >
								<th style="text-align: center; font-size: 14px; width: 5%;">No.</th>
								<th style="text-align: center; font-size: 14px; width: 20%;">Chapter Title</th>
								<th style="text-align: center; font-size: 14px; width: 10%;">Views</th>
								<th style="text-align: center; font-size: 14px; width: 10%;">Votes</th>
								<th style="text-align: center; font-size: 14px; width: 15%;">Required Coins</th>
								<th style="text-align: center; font-size: 14px; width: 11%;">Action</th>
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

								$sql2= "SELECT * FROM chapter WHERE storyID='" .$storyID . "' LIMIT {$beginrow} , {$pagesize}";

								$row2=query($sql2);  


								for($i=0; $i < count($row2); $i++)
								{
									$chapterID = $row2[$i][0];
									$viewNumber = $row2[$i][5];
							?>
								<tr>
									<td style="padding-top: 10px; width: 5%;"><?=$i+1?></td>
									
									<td style="width: 20%">
										<div  style="text-align: center; width: 100%">
											<div class="media-body">
												<a href="storydetail.php?storyID=<?=$chapterID?>" target="_blank"><h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#333333;"><?=decryptString($row2[$i][1])?></h2></a>

											</div>		
										</div>
									</td>
									<td style="width: 10%; text-align: center;"><?=$viewNumber?></td>
									<td style="width: 10%; text-align: center;">
									<?php
										$sql3 = "SELECT * FROM vote WHERE chapterID='" .$chapterID . "'";
										$row3 = query($sql3);
										$voteNumber = count($row3);
										echo($voteNumber);
									?>	
									</td>
									<td style="width: 15%; text-align: center;">
									<?php
										if($row2[$i][4] == 0){
											echo("No");
										}else{
											echo("Yes");
										}
									?>	
									</td>
									<td style="width: 11%; text-align: center; ">
										<a href="editchapter.php?chapterID=<?=$chapterID?>" class="btn"><i class="icon-edit icon-large"></i></a>
										<a href="#delete_confirm" class="btn btn-warning" ><i class="icon-remove-sign icon-large"></i></a>
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


	<!-- Modal delete confirm -->
		<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
		<script type="text/javascript" src="js/bootstrap-modal.js"></script>
		<script type="text/javascript" src="js/jquery-scrolltofixed-min.js"></script>
			
			<form class="modal hide fade" id="delete_confirm" method="get" action="choosechapter.php">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4>Going to chapter</h4>
				</div>
				<div class="modal-body">
					<label>Choose chapter (1-<?=count($row2)?>):</label>
				<?php
					for($i=0; $i< count($row2);$i++)
					{
						if($row2[$i][0] == $chapterID){
							$curentchap = $i+1;
						}
					}
				?>
					<input class="slider" type="range" min="1" max="<?=count($row2)?>" step="1" name="destinaton_chap" value="<?=$curentchap?>">
					<input type="text" value="<?=$curentchap?>" class="slider-input input-mini" require="require" min="1" max="<?=count($row2)?>" title="Please input number between 1-<?=count($row2)?>">
					<input type="hidden" name="story_id" value="<?=$storyID?>">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info">Go</button>
					<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
				</div>
			</form>
			<?php
				if(isset($_GET['destinaton_chap'])){
				echo('destinaton_chap');
			}
			?>

		</div>
	</div>
</div>
<!--<script>(function(d,s,a,i,j,r,l,m,t){try{l=d.getElementsByTagName('a');t=d.createElement('textarea');for(i=0;l.length-i;i++){try{a=l[i].href;s=a.indexOf('/cdn-cgi/l/email-protection');m=a.length;if(a&&s>-1&&m>28){j=28+s;s='';if(j<m){r='0x'+a.substr(j,2)|0;for(j+=2;j<m&&a.charAt(j)!='X';j+=2)s+='%'+('0'+('0x'+a.substr(j,2)^r).toString(16)).slice(-2);j++;s=decodeURIComponent(s)+a.substr(j,m-j)}t.innerHTML=s.replace(/</g,'&lt;').replace(/\>/g,'&gt;');l[i].href='mailto:'+t.value}}catch(e){}}}catch(e){}})(document);</script>  -->
</body>
</html>