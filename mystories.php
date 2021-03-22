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
		$sql = "Select * from member where username='" .$_SESSION['username'] . "'";
		$row = query($sql);
		$memberID = $row[0][0];

		$sql1 = "SELECT * FROM story WHERE memberID='" .$memberID . "'";
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
						<a href="home.php" itemprop="url"><span itemprop="title">Home</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong>My Stories</strong></li>
			</ul>

			<div class="row wrapper">
				<?php 
				require_once("./lefts/common_left.php");
			?>
				<div class="span10">
						
						<h1 style="text-align: center;margin-top: 5px;">My Stories</h1>
						<table class="table">
							<thead>
								<tr >
								<th style="text-align: center; font-size: 14px; width: 5%;">No.</th>
								<th style="text-align: center; font-size: 14px; width: 20%;">Story Title</th>
								<th style="text-align: center; font-size: 14px; width: 54%;">Innomation</th>
								<th style="text-align: center; font-size: 14px; width: 10%;">Status</th>
								<th style="text-align: center; font-size: 14px; width: 11%;">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								for($i=0; $i < count($row1); $i++)
								{
									$storyID = $row1[$i][0];
									$viewNumber = $row1[$i][5];
									$voteNumber = $row1[$i][6];
							?>	
								<tr>
									<td style="padding-top: 20px; width: 5%;"><?=$i+1?></td>
									<td class="nav-list name_list" style="width: 20%">
										<div class="media truyen-item">
											<a class="pull-left" href="storydetail.php?storyID=<?=$row1[$i][0]?>">
												<img class="media-object" alt="<?=$row1[$i][1]?>" style="width: 100%; height: auto;" src="img/<?=$row1[$i][4]?>">
											</a>
										</div>
										
									</td>
									<td style="width: 54%">
										<div  style="text-align: center; width: 100%">
											<div class="media-body">
												<a href="storydetail.php?storyID=<?=$row1[$i][0]?>" target="_blank"><h2 class="media-heading" style="font-size: 15px;line-height:20px;margin: 0;padding: 0;font-weight: bold;color:#333333;"><?=$row1[$i][1]?></h2></a>
												
												<?php
													$sql2 = "Select * from category INNER JOIN story_category ON category.categoryID = story_category.categoryID WHERE storyID='" .$storyID . "'";

													$row2 = query($sql2);

													for ($j=0; $j < count($row2);$j++)
													{
												?>	
														<span class="list-category" style="font-size: 14px;">
															<span><a href="./storybycat.php?categoryID=<?=$row2[$i][0]?>"><?=$row2[$j][1]?></a></span>,
														</span>
												<?php
													}
												?>
											</div>

											<span itemprop="votes"><b> <?=$voteNumber?> Votes</b>
											</span> - 
											<span itemprop="rating"><b> <?=$viewNumber?> Views</b>
											</span>


											<p style="text-align: justify;"><?=$row1[$i][3]?></p>			
										</div>
									</td>
									<td style="width: 10%; text-align: center;"><?=$row1[$i][7]?></td>
									<td style="width: 11%; text-align: center; ">
										<a href="editstory.php?storyID=<?=$storyID?>" class="btn"><i class="icon-edit"></i></a>
										<a href="#delete_confirm" class="btn btn-warning" ><i class="icon-remove-sign"></i></a>
									</td>
								</tr>
							<?php
								}
							?>
							</tbody>
						</table>
					
					<div class="pagination pagination-centered">
						<ul>
							<li class="disabled"><a href="javascript:">&larr;</a></li>
							<li class="active"><a href="javascript:">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">&rarr;</a></li>
						</ul>
					</div>
					<div class="fb-comments" style="display: block;left: 0;margin-top: 5px;" data-href="index-3.htm" data-width="" data-num-posts="10"></div>
				
			</div>


			<div class="clearfix"></div>			
			<?php 
			require_once("./footer.php");
		?>

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