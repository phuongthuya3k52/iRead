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
<title>New stories | iRead</title>
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
	body{padding-top:60px;padding-bottom:40px;height:auto;background-image:none;}
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
			<ul class="breadcrumb">
				<li>
					<div itemscope>
						<a href="home.php" itemprop="url"><span itemprop="title">Home</span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="ds-theloai">
					<div itemscope>
					 	<span itemprop="title"><a href="newstory.php" itemprop="url">New story</a></span>
					</div>
				</li>
			</ul>
			
			<div class="thumbnails" style="background-color: #f1f1f1">			
				<table width="80%" align="center" border-spacing= "10px"  padding= "5px" border= "1px solid black">
					<form action="registration.php" method="post" role="form">
					<tr>
						<td>
							<img id="img" height="150" width="200">
						</td>
						<td>
							<label for="id_title" class="control-label requiredField">Title<span class="asteriskField">*</span></label>
						</td>
						<td>
							<input name="title" maxlength="200" type="text" required="required" placeholder="Story Title" class="textinput textInput" id="id_fullname" title="Title has maximum of 200 characters"/>
						</td>

					</tr>
					<tr>
						<td>
							<input id="inpImage" type='file'>
						</td>
						<td>
							<label for="id_catergory" class="control-label requiredField">Categories<span class="asteriskField">*</span></label>
						</td>
						<td>
							
						</td>

					</tr>
					<tr>
						<td>
						</td>
						<td></td>
						<td></td>

					</tr>
										
					</form>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
</html>