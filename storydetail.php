
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="376408899112473"/>
<meta property="og:type" content="website"/>
<meta property="og:image" content="//truyenyy.com/media/book_covers/DaiChuaTe.jpg"/>
<link rel="alternate" type="application/atom+xml" title="Đọc Truyện Online - Truyện Kiếm Hiệp" href="http://feeds.feedburner.com/">
<title>Big Boss (Lastest - Chapter 1462) | iRead</title>
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
<style>body{padding-top:60px;padding-bottom:40px;height:auto;}</style>
<script type="text/javascript">
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
    </script>
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
						<a href="home.php" itemprop="url"><span itemprop="title">Home</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li><span class="divider">/</span></li>
				<li class="active"><strong>Big Boss Full</strong></li>
			</ul>
			
			<!--<div>
				<div class="rightbar hide-s" style="width: 160px;box-sizing: border-box;float: left;margin-right: 20px;"></div>
				<div class="rightbar hide-x" style="width: 300px;box-sizing: border-box;float: right;margin-left: 20px;">
					<div class="related">
						<h2>STORIES YOU SHOULD READ</h2>
						
						<div class="story">
							<a href="#" target="_blank"><h3><i class="icon-star-empty"></i> Cửu Đỉnh Ký Full </h3></a>
							<span> - Tác Giả: Ngã Cật Tây Hồng Thị</span>
							<br>
							<span> - Thể Loại: Tiên Hiệp</span>
						</div>
						<div class="story">
							<a href="#" target="_blank"><h3><i class="icon-star-empty"></i> Băng Hỏa Ma Trù Full </h3></a>
							<span> - Tác Giả: Đường Gia Tam Thiếu</span>
							<br>
							<span> - Thể Loại: Tiên Hiệp</span>
						</div>
						<div class="story">
							<a href="#" target="_blank"><h3><i class="icon-star-empty"></i> Quang Chi Tử Full </h3></a>
							<span> - Tác Giả: Đường Gia Tam Thiếu</span>
							<br>
							<span> - Thể Loại: Tiên Hiệp</span>
						</div>
						<div class="story">
							<a href="#" target="_blank"><h3><i class="icon-star-empty"></i> Lộng Triều Full </h3></a>
							<span> - Tác Giả: Thụy Căn</span>
							<br>
							<span> - Thể Loại: Đô Thị</span>
						</div>	
						<div class="story">
							<a href="#" target="_blank"><h3><i class="icon-star-empty"></i> Huyền Giới Chi Môn Mới nhất: Chapter 408</h3></a>
							<span> - Tác Giả: Vong Ngữ</span>
							<br>
							<span> - Thể Loại: Tiên Hiệp</span>
						</div>
					
					</div>
					<div class="fb-like-box" data-href="#" data-width="300" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
				</div> -->
				<div class="span10">
					<div class="xfor">
						<div class="thumbnail">
						<img src="img/DaiChuaTe.jpg" alt="Đại Chúa Tể" style="width: 190px;height: 280px;"/>
						</div>
						<div class="lww">
						<p>
						<span class="xleft">Author:</span>
						<span>&nbsp;<a href="-q=Thiên Tàm Thổ Đậu.htm" target="_blank">Nguyen Phuong Thuy</a></span>
						</p>
						<p>
						<span class="xleft">Type:</span>
						<span class="ds-theloai">&nbsp;<span>Something</span><span>Something</span><span>Something</span></span>
						</p>
						<p>
						<span class="xleft">Category:</span>
						<span>&nbsp;From Vietnam</span>
						</p>
						<p>
						<span class="xleft">Views:</span>
						<span>&nbsp;5353009</span>
						</p>
						<p>
						<span class="xleft">Status:</span>
						<span>&nbsp;DONE!</span>
						</p>
						</div>
					</div>
					
					<div class="rofx">
						<h1>BIG BOSS</h1>
						<div style="display: block;margin: 5px auto;text-align: center;">
							<a class="btn btn-mini btn-success" href="#/chuong-1/  #-1/%27" tppabs="#-1/">
								<i class="icon-play icon-white"></i> Read the story from the beginning
							</a>
							<a class="btn btn-mini btn-success" href="#/chuong-1464/  #-1464/%27" tppabs="#-1464/">
								<i class="icon-fire icon-white"></i> Read the latest Chapter
							</a>
							<a type="button" class="btn btn-mini btn-success" href="#dschuong"><i class="icon-leaf icon-white"></i> List of Chapter</a>
							<br><br>
							
							<ul class='foo1 star-rating'>
								<li class='current-rating' id='current-rating' style="width:126px;"></li>
								<li>
									<a href="#" title='2/10' class='star one-star' data-rate='1'>1</a>
								</li>
								<li>
									<a href="#" title='4/10' class='star two-stars' data-rate='2'>2</a>
								</li>
								<li>
									<a href="#" title='6/10' class='star three-stars' data-rate='3'>3</a>
								</li>
								<li>
									<a href="#" title='8/10' class='star four-stars' data-rate='4'>4</a>
								</li>
								<li>
									<a href="#" title='10/10' class='star five-stars' data-rate='5'>5</a>
								</li>
							</ul>
							<span itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
								<span class="foo2">
									<span itemprop="rating" itemscope itemtype="http://data-vocabulary.org/Rating">Point:
										<span itemprop="average">9,7</span>/<span itemprop="best">10</span>
									</span> -
									<span itemprop="votes">179</span> votes
								</span>
							</span>
						</div>
						<div id="desc_story">
							<p>Introduction</p>
							
							<div class="fb-like" style="display:block;float:left;" data-href="#dai-chua-te  #  #%27" data-send="false" data-layout="button_count" data-width="200px" data-show-faces="false" data-font="verdana"></div>
							&nbsp;<div class="g-plusone" data-size="medium" data-href="index-15.htm"></div>
							<p style="float: right;"><em>Source</em></p>
						</div>
						<div class="showmore"><a href="javascript:void(0)" class="btn btn-info btn-mini" onclick="$('#desc_story').css('height','auto');$('.showmore').hide()">Xem thêm »</a></div>
						<span style="font-size: 15px;"><em>The latest chapters are updated:</em></span>
						<ul style="margin: 0 0 10px 0">
							<li class="ip5"><a href="#"><i class="icon-arrow-right"></i> Chapter 1462 - Battle</a></li>
							<li class="ip5"><a href="#"><i class="icon-arrow-right"></i> Chapter 1461 - Sparrows</a></li>
							<li class="ip5"><a href="#"><i class="icon-arrow-right"></i> Chapter 1460 - Spirit</a></li>
							<li class="ip5"><a href="#"><i class="icon-arrow-right"></i> Chapter 1459 - Three elves</a></li>
							<li class="ip5"><a href="#"><i class="icon-arrow-right"></i> Chapter 1458: Sneak attack</a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
					<hr style="margin: 0; border-bottom: 1px solid #eee;">
					<div class="chaplist" id="dschuong">
						<h2>List of Chapter of "Boss"</h2>
						<div><span style="width: 60px;display: inline-block;">1.</span><a class="jblack" href="#" target="_blank"><i class="icon-leaf"></i> Chapter 01</a></div>
						<div><span style="width: 60px;display: inline-block;">2.</span><a class="jblack" href="#" target="_blank"><i class="icon-leaf"></i> Chapter 02</a></div>
						<div><span style="width: 60px;display: inline-block;">3.</span><a class="jblack" href="#" target="_blank"><i class="icon-leaf"></i> Chapter 03</a></div>
						<div><span style="width: 60px;display: inline-block;">4.</span><a class="jblack" href="#" target="_blank"><i class="icon-leaf"></i> Chapter 04</a></div>
						<div><span style="width: 60px;display: inline-block;">5.</span><a class="jblack" href="#" target="_blank"><i class="icon-leaf"></i> Chapter 05</a></div>
						<div><span style="width: 60px;display: inline-block;">6.</span><a class="jblack" href="#" target="_blank"><i class="icon-leaf"></i> Chapter 06</a></div>
						<div><span style="width: 60px;display: inline-block;">7.</span><a class="jblack" href="#" target="_blank"><i class="icon-leaf"></i> Chapter 07</a></div>
						<div><span style="width: 60px;display: inline-block;">8.</span><a class="jblack" href="#" target="_blank"><i class="icon-leaf"></i> Chapter 08</a></div>
						<div><span style="width: 60px;display: inline-block;">9.</span><a class="jblack" href="#" target="_blank"><i class="icon-leaf"></i> Chapter 09</a></div>
						<div><span style="width: 60px;display: inline-block;">10.</span><a class="jblack" href="#" target="_blank"><i class="icon-leaf"></i> Chapter 10</a></div>
						<div><span style="width: 60px;display: inline-block;">11.</span><a class="jblack" href="#" target="_blank"><i class="icon-leaf"></i> Chapter 11</a></div>
						
						<div class="paging">
							<form action="#" method="get" rel="nofollow">
								<span>Go to:</span>
								<input name="page" type="text" value="" style="width:40px;height: 17px;margin: 0;">
								<button class="btn btn-warning btn-small"><i class="icon-arrow-right"></i> <span class="jblack">Go</span></button>
							</form>
							
							<div class="pagination pagination-centered">
								<ul>
									<li class="disabled"><a href="javascript:">&larr;</a></li>
									<li class="active"><a href="javascript:">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="javascript:">...</a></li>
									<li><a href="#">28</a></li>
									<li><a href="">29</a></li>
									<li><a href="#">30</a></li>
									<li><a href="">&rarr;</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<!-- tính năng comment
					<div class="cl"><a href="javascript:void(0)" class="btn btn-info btn-mini" onclick="$('.cc').show();$('.cl').hide()">Xem bình luận truyện Đại Chúa Tể</a></div>
					<div class="cc" style="display:none;">
						<span><b>Do not let a few comments disparage but skip a good series. Please read it yourself before you rate the story. Reading is for enjoyment, not for disparaging, let's comment with culture.</b></span>
						<div class="fb-comments" style="display: block;left:0;" data-href="#" #/dai-chua-te/" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
					</div>
				-->
				</div>
			</div>

			<div class="clearfix"></div>
		<?php 
			require_once("./footer.php");
		?>
	</div>
</div>
<!--<script>(function(d,s,a,i,j,r,l,m,t){try{l=d.getElementsByTagName('a');t=d.createElement('textarea');for(i=0;l.length-i;i++){try{a=l[i].href;s=a.indexOf('/cdn-cgi/l/email-protection');m=a.length;if(a&&s>-1&&m>28){j=28+s;s='';if(j<m){r='0x'+a.substr(j,2)|0;for(j+=2;j<m&&a.charAt(j)!='X';j+=2)s+='%'+('0'+('0x'+a.substr(j,2)^r).toString(16)).slice(-2);j++;s=decodeURIComponent(s)+a.substr(j,m-j)}t.innerHTML=s.replace(/</g,'&lt;').replace(/\>/g,'&gt;');l[i].href='mailto:'+t.value}}catch(e){}}}catch(e){}})(document);</script>  -->
</body>
</html>