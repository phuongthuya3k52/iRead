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

?>

<body>
<?php 
	require_once("./headers/common_header.php");
?>


<div class="container">
	<div class="row">
		<div class="span12">
			<div class="row wrapper">
				<?php 
					require_once("./lefts/common_left.php");
				?>
				<div class="span10">
					<div class="inner">
						<ul class="thumbnails">
						<?php 
							
						?>
							<li class="span2">
								<a href="detail.html" class="thumbnail" target="_blank">
									<img alt="Đại Chúa Tể" width="160" height="210" src="img/72b3e7bd5ecb535c982bcdef49f29705.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Big Boss</h2>
										<i class="icon-star-empty star"></i>
										<a href="detail.html"><span class="label label-warning">Chapter 1434</span></a>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Bất Hủ Phàm Nhân" width="160" height="210" src="img/c37702124653a3903857d0eb81434f6a.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2>
										<i class="icon-star-empty star"></i>
										<span class="label label-warning">Chapter 575</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Toàn Chức Cao Thủ" width="160" height="210" src="img/460cce87dcbbe31843ae8396a9b8f24a.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2>
										<i class="icon-star-empty star"></i>
										<span class="label label-warning">Chapter 832</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Yêu Thần Ký" width="160" height="210" src="img/175ae0d8b6e3eeef1af359f817bfeb30.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2>
										<i class="icon-star-empty star"></i>
										<span class="label label-warning">Chapter 448</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Đế Tôn" width="160" height="210" src="img/a0d1adeadd94ffa868c46ffe70da1f18.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2>
										<i class="icon-star-empty star"></i>
										<span class="label label-warning">Chapter 2802</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="La Phù" width="160" height="210" src="img/0334598de551016f3e129d6a39038040.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2> 
										<i class="icon-star-empty star"></i> 
										<span class="label label-warning">Chapter 795</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Tạo Hóa Chi Môn" width="160" height="210" src="img/b288eb342e5d7d38a883c560c38a3c7e.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2>
										<i class="icon-star-empty star"></i>
										<span class="label label-warning">Chapter 1535</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Cảnh Lộ Quan Đồ" width="160" height="210" src="img/9c107b4ae2dd53280ff6b94fd536ecff.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2>
										<i class="icon-star-empty star"></i> 
										<span class="label label-warning">Chapter 1102</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Thiếu Gia Phong Lưu" width="160" height="210" src="img/250c3deb9cfb184e92fbf5cd8362d25b.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2> 
										<i class="icon-star-empty star"></i>
										<span class="label label-warning">Chapter 485</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Đỉnh Cấp Lưu Manh" width="160" height="210" src="img/f4c26ca4a9b7cc5dd8f5f8fb95ef263d.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2> 
										<i class="icon-star-empty star"></i> 
										<span class="label label-warning">Chapter 1033</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Võ Đạo Đan Tôn" width="160" height="210" src="img/bd8cff5b36f43072fc4a7225323afb65.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2> 
										<i class="icon-star-empty star"></i> 
										<span class="label label-warning">Chapter 1339</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Thần Ma Thiên Tôn​" width="160" height="210" src="img/3dd703f6e11b7a8f4e37ae06cd1a5ad9.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title​</h2>
										<i class="icon-star-empty star">
										</i> <span class="label label-warning">Chapter 1003</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Ma Thiên Ký" width="160" height="210" src="img/b5326673f4b51e461c93afe564c75fd7.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2> 
										<i class="icon-star-empty star"></i>
										<span class="label label-warning">Chapter 1737</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" class="thumbnail" target="_blank">
									<img alt="Thế Giới Tiên Hiệp" width="160" height="210" src="img/0656988c8f7fe08baf95e9c62b32ff31.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2> 
										<i class="icon-star-empty star"></i> 
										<span class="label label-warning">Chapter 410</span>
									</a>
								</div>
							</li>
							
							<li class="span2">
								<a href="#" tppabs=" truyen/chua-te-chi-vuong/" class="thumbnail" target="_blank">
									<img alt="Chúa Tể Chi Vương" width="160" height="210" src="img/21e197588537eaccfeea118731277922.jpg">
								</a>
								<div class="caption">
									<a href="#" target="_blank">
										<h2>Name of Title</h2>
										<i class="icon-star-empty star"></i>
										<span class="label label-warning">Chapter 1350</span>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			
			<div id="fb-root"></div>
			<script>
			<!-- (function(d, s, id) { -->
				  <!-- var js, fjs = d.getElementsByTagName(s)[0]; -->
				  <!-- if (d.getElementById(id)) return; -->
				  <!-- js = d.createElement(s); js.id = id; -->
				  <!-- js.src = "all.js#xfbml=1&appId=112276442265938" -->
				  <!-- fjs.parentNode.insertBefore(js, fjs); -->
				<!-- }(document, 'script', 'facebook-jssdk')); -->
			</script>
			<script>
					<!-- (function(){var j=document.createElement('script');j.async=1;j.src='z-1.js' -->
					<!-- var __p = "56ed68bae1873f5e001c2f66"; -->
				</script>
		<?php 
			require_once("./footer.php");
		?>
	</div>
</div>
<script>(function(d,s,a,i,j,r,l,m,t){try{l=d.getElementsByTagName('a');t=d.createElement('textarea');for(i=0;l.length-i;i++){try{a=l[i].href;s=a.indexOf('/cdn-cgi/l/email-protection');m=a.length;if(a&&s>-1&&m>28){j=28+s;s='';if(j<m){r='0x'+a.substr(j,2)|0;for(j+=2;j<m&&a.charAt(j)!='X';j+=2)s+='%'+('0'+('0x'+a.substr(j,2)^r).toString(16)).slice(-2);j++;s=decodeURIComponent(s)+a.substr(j,m-j)}t.innerHTML=s.replace(/</g,'&lt;').replace(/\>/g,'&gt;');l[i].href='mailto:'+t.value}}catch(e){}}}catch(e){}})(document);</script></body>
</html>