
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
<!--<link href="http://fonts.googleapis.com/css?family=Patrick+Hand|Noticia+Text:400,400italic&subset=latin,vietnamese" rel='stylesheet' type='text/css'> -->
<link href="css/bootstrap-modal.css" rel="stylesheet">
<title>Đại Chúa Tể - Chương 1432: Phù Đồ Huyền ra tay | TruyệnYY</title>
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
		padding-top:60px;padding-bottom:40px;height:auto;background-image:none;
	}
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
		if(isset($_GET['storyID']) && isset($_GET['chapterID'])){
			$storyID=$_GET['storyID'];
			$chapterID=$_GET['chapterID'];

			$is_paided = 0;

			$sql = "SELECT * FROM chapter WHERE chapterID='" .$chapterID . "'";
			$row = query($sql);
			$view = $row[0][5];

		// Get authorID (memberID)
			$sql1 = "SELECT * FROM story WHERE storyID='" .$storyID . "'";
			$row1 = query($sql1);
			$memberID = $row1[0][2];
			$viewNumber = $row1[0][5];

		// Get readerID
			$sql5 = "SELECT * FROM member WHERE username='" .$_SESSION['username'] . "'";
			$row5 = query($sql5);
			$readerID = $row5[0][0];
			$readerwallet = $row5[0][5];

		//check coin payment 
			if($row[0][4] == 1 && $readerID != $memberID){
				$sql4 = "SELECT * FROM chapter_payment WHERE chapterID='" .$chapterID . "'";

				if(querynull($sql4)!=null){
					$row4 = query($sql4); 

					for($i=0; $i < count($row4); $i++){
						if($row4[$i][1] == $readerID){
							$is_paided = 1;
						}else{
							$is_paided = 0;
						}
					}
				}else{
					$is_paided = 0;
				}  

					if($is_paided == 0){
			?>
					<body onload="activepopup()">
			<?php	
				}else{
				// Update chapter view number 
					$sql6 = "UPDATE chapter SET view='" .$view+1 ."'WHERE chapterID='" .$chapterID ."'";
					$result6 = execsql($sql6);
					$row8 = query($sql);
					$view1 = $row8[0][5];

				// Update story view number 
					$sql9 = "UPDATE story SET viewNumber='" .$viewNumber+1 ."'WHERE storyID='" .$storyID ."'";
					$result9 = execsql($sql9);

			?>
					<body>
			<?php
				} 
			}else{
			// Update chapter view number 
				$sql6 = "UPDATE chapter SET view='" .$view+1 ."'WHERE chapterID='" .$chapterID ."'";
				$result6 = execsql($sql6);
				$row8 = query($sql);
				$view1 = $row8[0][5];

			// Update story view number 
					$sql9 = "UPDATE story SET viewNumber='" .$viewNumber+1 ."'WHERE storyID='" .$storyID ."'";
					$result9 = execsql($sql9);	
		?>
				<body>
		<?php	
			}
		}
	}
?>


<?php 
	require_once("./headers/readstory_header.php");
?>

<!-- Notice popup -->
<div class="tbpopup" id="tbpopup-1">
	<div class="tboverlay"></div>
	<div class="tbcontent">
		<?php
		if($readerwallet>1)
		{
		?>
		<form method="get" action="chapterpayment.php">
			<div class="modal-header">
				<h4>You have <?=$readerwallet?> coins. Would you like to pay 1 coin for read this chapter?</h4>
			<!--	<div class="tbclose-btn" onclick="thongbaopopup()">&times;</div> -->
			</div>
			<div class="modal-body">
				<img src="img/coin.jpg" style="width: 80%; height: auto;">
				<input type="hidden" name="story_id" value="<?=$storyID?>">
				<input type="hidden" name="chapter_id" value="<?=$chapterID?>"> 
				<input type="hidden" name="member_id" value="<?=$memberID?>">
			</div>
				<button type="submit" name="submit" class="btn btn-primary">Yes</button>&emsp;
				<a data-toggle="modal" href="#chap_jump" class="btn btn-warning"><i class="icon-move icon-white"></i></a>&emsp;
				<a href="storydetail.php?storyID=<?=$storyID?>" class="btn">No</a>
			<!--	<a href="#" class="btn" onclick="activepopup()">Cancel</a>  
			</div>-->
		</form>
		<?php
		}else{
		?>
	<!--Recharge form-->
		<form  method="POST" role="form" action="./vnpay_php/vnpay_create_payment.php" >
		<div class="modal-header">
			<h4>You need to pay at least <span style="color: red">1 coin</span> to read this chapter.</h4>
										
		</div>
		<div class="modal-body" style="text-align: center; margin-top:-10px">
			<h2>Choose the amount of Coins you want to exchange (at least 50 coins)!  </h2>
			
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

			<div class="form-group">

                
            </div>

			<input type="hidden" name="trans_type" id="trans_type" value="billpayment">
			<input type="hidden" name="trans_desc" id="trans_desc" value="Coin recharge into account">
			<input type="hidden" name="language" id="language" value="en">
			<input type="hidden" name="memberID" id="memberID" value="<?=$readerID?>">

			<div style="margin-top: 20px">	
				<button type="submit" name="cf_recharge" class="btn btn-primary" style="background-color: blue; ">Submit</button>&emsp;
				<a data-toggle="modal" href="#chap_jump" class="btn btn-warning"><i class="icon-move icon-white"></i></a>&emsp;
				<a href="storydetail.php?storyID=<?=$storyID?>" class="btn">No</a>
			</div>
		</div>

		</form>
		<?php
		}
		?>
</div>
<script>
	function activepopup(){
		document.getElementById("tbpopup-1").classList.toggle("active");
	}
</script>


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
				<li >
					<div itemscope>
						<a href="storydetail.php?storyID=<?=$storyID?>" itemprop="url"><span itemprop="title"><?=decryptString($row1[0][1])?></span></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li class="active"><strong><?=decryptString($row[0][1])?></strong></li>
			</ul>
			
	<!--		<a href="javascript:">
				<div class="pre_btn"><i class="icon-sign icon-chevron-left"></i></div>
			</a>
			<script type="text/javascript">
				$(function(){
					$('.close-ads').click(function(){
						$('.pre_btn_ads').hide();
						$('.next_btn_ads').hide();
						$(this).hide();
						return false;
					});
				});
				</script>   
			<a href="javascript:">
				<div class="next_btn"><i class="icon-sign icon-chevron-right"></i></div>
			</a>  -->
			
			<div class="row wrapper">
			<?php 
				require_once("./lefts/common_left.php");
			?>
				<div class="span10">
					<div id="noidungtruyen">
						<h1 style="text-align: center;text-transform: uppercase; font-weight: bold;"><?=decryptString($row[0][1])?></h1>

					<!-- Vote	-->
						<div style="text-align: center; font-size: 16px;">
						<?php
							$is_vote = 0;
							$sql7 = "SELECT * FROM vote WHERE chapterID='" .$chapterID . "'";

							if(querynull($sql7)!=null){
								$row7 = query($sql7);
								$vote = count($row7);

								for($i=0; $i < count($row7); $i++){
									if($row7[$i][1] == $readerID){
										$is_vote = 1;
									}else{
										$is_vote = 0;
									}
								}
							}else{
								$is_vote = 0;
							}  
						
							if($is_vote == 0){
						?>
								<form method="post" action="chaptervote.php">
									<button type="submit" name="vote_submit" class="btn-warning">Vote</button> <?=$vote?> votes - 
									<span itemprop="votes"><?=$view1?> views</span>

									<input type="hidden" name="story_id" value="<?=$storyID?>">
									<input type="hidden" name="chapter_id" value="<?=$chapterID?>"> 
									<input type="hidden" name="reader_id" value="<?=$readerID?>">
								</form>
						<?php
							}else{
						?>
								<form method="post" action="chaptervote.php">
									<button type="submit" name="unvote_submit" class="btn">Voted</button> <?=$vote?> votes - 
									<span itemprop="votes"><?=$view1?> views</span>

									<input type="hidden" name="story_id" value="<?=$storyID?>">
									<input type="hidden" name="chapter_id" value="<?=$chapterID?>"> 
									<input type="hidden" name="reader_id" value="<?=$readerID?>">
								</form>
						<?php
							}
						?>
							
						</div>
						
						<hr class="start-chap">
						<div class="text-truyen" id="id_noidung_chuong" style="margin:50px;">
							<?=decryptString($row[0][3])?>
						
						</div>
					</div>
			
					
					<div class="chapfoot" style=" width:100%; float:left; ">
					<h2 style="text-align: center;text-transform: uppercase; font-weight: bold;"><?=decryptString($row[0][1])?></h2>
					<div style="text-align: center; font-size: 16px">
						<?php
							$is_vote = 0;
							$sql7 = "SELECT * FROM vote WHERE chapterID='" .$chapterID . "'";

							if(querynull($sql7)!=null){
								$row7 = query($sql7);
								$vote = count($row7);

								for($i=0; $i < count($row7); $i++){
									if($row7[$i][1] == $readerID){
										$is_vote = 1;
									}else{
										$is_vote = 0;
									}
								}
							}else{
								$is_vote = 0;
							}  
						
							if($is_vote == 0){
						?>
								<form method="post" action="chaptervote.php">
									<button type="submit" name="vote_submit" class="btn-warning">Vote</button> <?=$vote?> votes - 
									<span itemprop="votes"><?=$view1?> views</span>

									<input type="hidden" name="story_id" value="<?=$storyID?>">
									<input type="hidden" name="chapter_id" value="<?=$chapterID?>"> 
									<input type="hidden" name="reader_id" value="<?=$readerID?>">
								</form>
						<?php
							}else{
						?>
								<form method="post" action="chaptervote.php">
									<button type="submit" name="unvote_submit" class="btn">Voted</button> <?=$vote?> votes - 
									<span itemprop="votes"><?=$view1?> views</span>

									<input type="hidden" name="story_id" value="<?=$storyID?>">
									<input type="hidden" name="chapter_id" value="<?=$chapterID?>"> 
									<input type="hidden" name="reader_id" value="<?=$readerID?>">
								</form>
						<?php
							}
						?>
					</div>
					<hr class="end-chap">
					

					<?php
					$sql2 = "Select * from chapter where storyID='" .$storyID . "'";
					$row2 = query($sql2);

					if(count($row2) > 1)
					{
					?>
					<div class="mobi-chuyentrang">
						<?php

							$sql3 = "Select chapterID, chapterName from chapter WHERE storyID='" .$storyID . "' ORDER BY chapterID DESC";
							$row3 = query($sql3);
  

							if($row2[0][0] == $chapterID)
							{
						?>
								<a data-toggle="modal" href="#chap_jump" class="btn btn-small btn-warning">
									<i class="icon-move icon-white"></i>
								</a>
								<a href="readstory.php?storyID=<?=$storyID?>&chapterID=<?=$row2[1][0]?>" class="btn btn-small btn-warning">
									<i class="icon-arrow-right icon-white"></i> Next
								</a>
						<?php
							}else if($row3[0][0] == $chapterID)
							{
						?>
								<a href="readstory.php?storyID=<?=$storyID?>&chapterID=<?=$row3[1][0]?>" class="btn btn-small btn-warning">
									<i class="icon-arrow-left icon-white"></i> Previous
								</a>
								<a data-toggle="modal" href="#chap_jump" class="btn btn-small btn-warning">
									<i class="icon-move icon-white"></i>
								</a>
						<?php			
							}else{
								for($i=1; $i< count($row2);$i++)
								{
									if($row2[$i][0] == $chapterID){
						?>
									<a href="readstory.php?storyID=<?=$storyID?>&chapterID=<?=$row2[$i-1][0]?>" class="btn btn-small btn-warning">
										<i class="icon-arrow-left icon-white"></i> Previous
									</a>
									<a data-toggle="modal" href="#chap_jump" class="btn btn-small btn-warning">
										<i class="icon-move icon-white"></i>
									</a>
									<a href="readstory.php?storyID=<?=$storyID?>&chapterID=<?=$row2[$i+1][0]?>" class="btn btn-small btn-warning">
										<i class="icon-arrow-right icon-white"></i> Next
									</a>
						<?php
									}
								
								}

							}
						?>
					</div>
					<?php
						}
					?>
				</div>
				<div class="hide-x" style="width:300px; float: right;margin: 25px 35px 0 0;">
				</div>
				<div class="clearfix"></div>
			</div>
		<?php 
			require_once("./footer.php");
		?>
			
			<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
			<script type="text/javascript" src="js/bootstrap-modal.js"></script>
			<script type="text/javascript" src="js/jquery-scrolltofixed-min.js"></script>
			
			<form class="modal hide fade" id="chap_jump" method="get" action="choosechapter.php">
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

			

		<!--	<script type="text/javascript" src="js/jquery.scrollTo.min.js"></script>  -->

				<script type="text/javascript">
				/*	$.post( '/ajax/hit/',
					{ hitcount_pk : '138' },
					function(data, status) {
						if (data.status == 'error') {
							// do something for error?
						}
					},
					'json'); */
								
					$(function () {

						$('.icon-sign').css('margin-top', $(window).height()/2 + 'px');
						// init font, fontsize, progressbar
						var init_bg = localStorage.getItem('background-color');
						var init_font = localStorage.getItem('font-truyen');
						var init_fontsize = localStorage.getItem('font-size');
						var init_prgb = localStorage.getItem('progress-bar');

						if (init_bg) {
							$('body').css('background-color', init_bg);
						}
						else {$('body').css('background-color', '#eee');}
						if (init_font) {
							$('#id_noidung_chuong').css('font-family', init_font+', sans serif');
						}
						if (init_fontsize) {
							$('#id_noidung_chuong').css('font-size', init_fontsize+'px');
						}
						
							$('#bottom_progressbar').hide();

					/*	var go2top = $('.go_to_top');

						go2top.click(function () {
							$.scrollTo('0', 800);
							return false;
						});


						$(document).keyup(function (e) {
							if (e.keyCode == 37){
								var x = $(document).scrollTop() - ($(window).height() - 80);
								if (x < 0) {
									x = 0;
								}
								$.scrollTo(x, 100);
							}
							else if (e.keyCode == 39) {
								$.scrollTo($(document).scrollTop() + ($(window).height() - 80), 100);
							}
						});     */


					/*	var godown = $('.next_btn');
						var gotop = $('.pre_btn');
						godown.click(function () {
							$.scrollTo($(document).scrollTop() + ($(window).height() - $(".navbar").height() - 40), 100);
						});
						gotop.click(function () {
							var x = $(document).scrollTop() - ($(window).height() - $(".navbar").height() - 40);
							if(x<0){x=0;}
							$.scrollTo(x, 100);
						});  */
					});

					function changeFont(font_name){
						$('#noidungtruyen').css('font-family', font_name+', sans-serif');
						localStorage.setItem('font-truyen', font_name);
						return false;
					}

					function changeFontSize(font_size){
						$('#noidungtruyen').css('font-size', font_size+'px');
						localStorage.setItem('font-size', font_size);
						return false;
					}

					function changeBG(color){
						$('body').css('background-color', color);
						localStorage.setItem('background-color', color);
						return false;
					}

					function toggleProgressbar() {
						var prgb = $("#bottom_progressbar");
						prgb.toggle();
						if (prgb.is(':hidden')) {
							localStorage.setItem('progress-bar', 0);
						}
						else
							localStorage.setItem('progress-bar', 1);

						return false;
					}     

					$('.slider-input').keyup(function(){
						$('.slider').val($(this).val());

					});

					$('.slider').change(function(){
						$('.slider-input').val($(this).val());
					})

				</script>
				<script>
				(function (d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s);
						js.id = id;
						js.src = "js/all.js#xfbml=1&appId=376408899112473"
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>
	</div>
</div>
</body>
</html>