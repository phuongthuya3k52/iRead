<div class="clearfix"></div>
			<hr/>
			
			<div class="row footer">
				<div class="inner span3" style="text-align: center">
				<?php
					if($_SESSION['role'] == "admin"){
				?>
						<img src="../img/Logo_index.png" style="width: 60%"><h2>iRead.net</h2>
				<?php
					}else{
				?>
						<img src="./img/Logo_index.png" style="width: 60%"><h2>iRead.net</h2>
				<?php
					}
				?>	
					
				</div>
				<div class="inner span3" ><h2>Something</h2>
					<div style="padding-right: 10px;font-size: 14px;"><b>
						iRead.net </b> - The fastest, most user-friendly, and up-to-date novel reading and writing website. Read online stories, read text stories, full stories, good stories. Supports all browsers and mobile devices.
					</div>
				</div>
				<div class="inner span3 "><h2>Link</h2>
					<ul>
						<li class="hot"><a href="./home.php" tppabs=" ">All Stories</a></li>
						<li class="hot"><a href="./hotstory.php">Hot Stories</a></li>
						<li class="rd"><a href="./completed.php">Completed Stories</a></li>
					</ul>
				</div>
				<div class="right-inner span3"><h2>Contact</h2>
				iread.net.vn@gmail.com 
				</div>
			</div>
			
			<footer class="site-footer row">
			<!--<div class="span6">© 2017 N.T.L</div>  -->
			</footer>
		</div>