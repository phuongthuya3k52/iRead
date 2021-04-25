<div class="clearfix"></div>
			<hr/>
			
			<div class="row footer">
				<div class="inner span3" style="text-align: center">
				<?php
					if($_SESSION['role'] == "admin"){
				?>
						<img src="../img/Logo_index.png" style="width: 60%"><h3>iRead.net</h3>
				<?php
					}else{
				?>
						<img src="./img/Logo_index.png" style="width: 60%"><h3>iRead.net</h3>
				<?php
					}
				?>	
					
				</div>
				<div class="inner span3" ><h3>Something</h3>
					<div style="padding-right: 10px;font-size: 11px;"><b>
						iRead.net </b> - The fastest, most user-friendly, and up-to-date novel reading and writing website. Read online stories, read text stories, full stories, good stories. Supports all browsers and mobile devices.
					</div>
				</div>
				<div class="inner span3 "><h3>Link</h3>
					<ul>
						<li class="hot"><a href="./home.php" tppabs=" ">All Stories</a></li>
						<li class="hot"><a href="./hotstory.php">Hot Stories</a></li>
						<li class="rd"><a href="./completed.php">Completed Stories</a></li>
					</ul>
				</div>
				<div class="right-inner span3"><h3>Contact</h3>
				iread.net.vn@gmail.com 
				</div>
			</div>
			
			<footer class="site-footer row">
			<!--<div class="span6">© 2017 N.T.L</div>  -->
			</footer>
		</div>