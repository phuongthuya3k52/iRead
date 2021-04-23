<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<link rel="canonical" href=" "/>
<title>iRead</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/yamm.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/chosen.css" rel="stylesheet">
<link rel="icon" type="image/png" href="img/favicon.png"/>
<link href="https://plus.google.com/103281900225927837176/" rel="author">
<script src="js/jquery-1.12.4.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/csrf.js"></script>
<style>
	body{padding-top:60px;padding-bottom:40px;height:auto;}
</style>

<!--<script type="text/javascript">
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
    </script>  -->

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
						<a href="./home.php" itemprop="url"><i class="icon-home"></i></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong>Completed Stories</strong></li>
			</ul>

			<div class="row wrapper">
				<?php 
					require_once("./lefts/common_left.php");
				?>
				<div class="span10">
				<!--	<div class="inner">  -->
						<ul class="thumbnails">
						<?php
						// Pagination
							$sql= "SELECT * FROM story WHERE status='Completed' ORDER BY storyName ASC";
							$row=query($sql);

							$allrow = count($row);
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

							$sql1= "SELECT * from story WHERE status='Completed' ORDER BY storyName ASC LIMIT {$beginrow} , {$pagesize}";
							$row1=query($sql1);  

							for ($i=0; $i < count($row1);$i++)
							{

						?>
							
								<li class="span2" style="float: left; height: 250px; width: 160px">
									<a href="storydetail.php?storyID=<?=$row1[$i][0]?>" class="thumbnail">
										<img style="width: 150px; height: 200px;" alt="<?=$row1[$i][1]?>" src="img/<?=$row1[$i][4]?>">
									</a>
									<div class="caption">
										<a href="storydetail.php?storyID=<?=$row1[$i][0]?>">
											<h2><?=decryptString($row1[$i][1])?></h2>

											<?php 
											$sql2= "select * from chapter WHERE storyID = '" .$row1[$i][0] ."' ORDER BY chapterID DESC";
												$row2=query($sql2);
											?>
											<i class="icon-star-empty star"></i>
											<a href="readstory.php?storyID=<?=$row1[$i][0]?>&chapterID=<?=$row2[0][0]?>"><span class="label label-warning">
											<?php

												if(count($row2) > 0){
													echo(decryptString($row2[0][1]));
												}else{
													echo("No chapter");
												}
											?>
											</span></a>
										</a>
									</div>
								</li>  
						<?php
							}
						?>
						</ul>
					<!--<div style="text-align: center; font-size: 15px"> -->
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
									<li class="disable"><a href="home.php?currentpage=<?=$i?>"><?php echo $i ." "; ?></a></li>
							<?php
								}
							}
							?>
							<li class="disable"><a href="">Pages</a></li>
						</ul>
						</div>
					</div>


				<!--	</div>   -->
				</div>
			</div>
			
			<div id="fb-root"></div>
	<!--		<script>
			 (function(d, s, id) { 
				   var js, fjs = d.getElementsByTagName(s)[0]; 
				  	if (d.getElementById(id)) return; 
				   js = d.createElement(s); js.id = id; 
				   js.src = "all.js#xfbml=1&appId=112276442265938" 
				   fjs.parentNode.insertBefore(js, fjs);
				 }(document, 'script', 'facebook-jssdk')); 
			</script>
			<script>
					 (function(){var j=document.createElement('script');j.async=1;j.src='z-1.js' 
					 var __p = "56ed68bae1873f5e001c2f66"; 
				</script>   -->
		<?php 
			require_once("./footer.php");
		?>
	</div>
</div>
<!--<script>(function(d,s,a,i,j,r,l,m,t){try{l=d.getElementsByTagName('a');t=d.createElement('textarea');for(i=0;l.length-i;i++){try{a=l[i].href;s=a.indexOf('/cdn-cgi/l/email-protection');m=a.length;if(a&&s>-1&&m>28){j=28+s;s='';if(j<m){r='0x'+a.substr(j,2)|0;for(j+=2;j<m&&a.charAt(j)!='X';j+=2)s+='%'+('0'+('0x'+a.substr(j,2)^r).toString(16)).slice(-2);j++;s=decodeURIComponent(s)+a.substr(j,m-j)}t.innerHTML=s.replace(/</g,'&lt;').replace(/\>/g,'&gt;');l[i].href='mailto:'+t.value}}catch(e){}}}catch(e){}})(document);</script>  -->
</body>
</html>