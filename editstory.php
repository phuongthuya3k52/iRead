<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="http://fonts.googleapis.com/css?family=Patrick+Hand|Noticia+Text:400,400italic&subset=latin,vietnamese" rel='stylesheet' type='text/css'>
<link href="css/bootstrap-modal.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
<title>Edit stories | iRead</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/yamm.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/chosen.css" rel="stylesheet">

<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/bootstrap-select.min.css" rel="stylesheet">

<link rel="icon" type="image/png" href="img/favicon.png"/>
<link href="https://plus.google.com/103281900225927837176/" rel="author">
<script src="js/jquery-1.12.4.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/bootstrap.min.js"></script>


<script type="text/javascript" src="js/csrf.js"></script>
<style>
	body{padding-top:60px;padding-bottom:40px;height:auto;background-image:none;}
	table, th, div {
  		<!-- border: 1px solid black; -->
  		border-collapse: collapse;
	}
	th, div {
  		padding: 3px;
	}
</style>


</head>

<?php
	require_once("./db.php");
    session_start();
    if(isset($_SESSION['username'])){
    	$sql= "SELECT memberID FROM member WHERE username='".$_SESSION['username'] ."'";
		$row= query($sql);
		$memberID = $row[0][0];
		$check = 0;

	// Get story information
		if(isset($_GET['storyID'])){
			$storyID = $_GET['storyID'];
			$sql4= "SELECT * FROM story WHERE storyID='".$storyID ."'";
			$row4= query($sql4);

		// Post File on server
			if(isset($_POST['submit'])) {
				if(isset($_FILES['inpImage'])){
			/*		echo "<pre> ";
					print_r($_FILES);
					echo "</pre>";  */

					$error = array();

				// Create folder img to save file
					$target_dir = "img/";

				// Create file URL after uploading
					$target_file = $target_dir.basename($_FILES['inpImage']['name']);

				// Check file upload conditions 

				// 1. Check the file size (10MB <=> 10485760 bytes) 
					if($_FILES['inpImage']['size'] >= 10485760)
					{
						$error['inpImage'] = "Only upload files under 10MB ";
					}

				// 2.Check file type (png; jpg; gif; jpeg) 
					$file_type = pathinfo($_FILES['inpImage']['name'], PATHINFO_EXTENSION);

				// File types allowed 
					$file_type_allow =  array('','png','PNG','jpg','JPG','jpeg','JPEG','gif','GIF');
			
					if(!in_array($file_type, $file_type_allow))
					{
						$error['inpImage'] = "Only upload image type files";
					}

				//	echo("file_type = ".$file_type);
				
			/*		//3. Check for file existence 
					if(file_exists($target_file)){
						$error['inpImage'] = "File already exists ";
					}  */

			/*		print_r($error); */
				// 3. Check and transfer files from clipboard to server 
					if(empty($error)){
						if($file_type != ""){
							if(!move_uploaded_file($_FILES['inpImage']['tmp_name'], $target_file)){
							echo("Upload image failed");
							$check = 1;
							}
						}
					}else{
						$check = 1;
						//print_r($error);
				?>
						<script>
							alert ("Failure to save image! You must upload an image type file under 10MB");	
							//window.location.replace("./editstory.php?storyID=<?=$storyID?>");
						</script>		
				<?php
					}			
				}

			// Update story infomation
				if(!isset($_POST['checkbox'])){
			?>
					<script>
						alert ("You must choose at least one category!");	
						window.location.replace("./newstory.php");
					</script>	
			<?php
				}

				if (empty($error) && isset($_POST['title']) && isset($_POST['checkbox']))
				{
					$title=encryptString($_POST['title']);
					$descriptions=encryptString($_POST['descriptions']);
					$chkbox = $_POST['checkbox'];
					$status = $_POST['status'];
					if(empty($error) && $_FILES['inpImage']['name'] == ""){
						$image = $row4[0][4];
					}elseif (empty($error) && $_FILES['inpImage']['name'] != "") {
						$image = $_FILES['inpImage']['name'];
					}

				//Code update story
					$sql1 = "UPDATE story SET storyName='" .$title ."', description='" .$descriptions ."', image='" .$image ."',status='" .$status ."' WHERE storyID='" .$storyID ."'"; 
					$result1 = execsql($sql1); 

				//Code update story-category
					$sql5 = "DELETE FROM story_category WHERE storyID='" .$storyID ."'";
					$result5 = execsql($sql5);

					if($result5 != null){
						$sql2 = "select * from story where storyID='" .$storyID ."'";   
				
						$row2= query($sql2);

					// Save new story-category in db			
		 				$i = 0;

		 				While($i < sizeof($chkbox))
		 				{
		 							
		 					$sql3= "INSERT INTO story_category VALUES (''," .$row2[0][0] ."," .$chkbox[$i] .")";
							$result3 = execsql($sql3);  
		 					$i++;
		 				} 
				  
			 			if ($result3 != null){
		?>				
							<script >
								alert ("Update story infomation successfull!");
								window.location.replace("./mystories.php?storyID=<?=$storyID?>");
							</script>
		<?php 		
						}else{
		?>				
							<script >
								alert ("Update story information failed. Try again");
							window.location.replace("./editstories.php?storyID=<?=$storyID?>");
							</script>
		<?php
						}   
					}
				}
			} 
		}else{
	?>
			<script >
				alert ("You must choose a story!");
				window.location.replace("./mystories.php");
			</script> 
	<?php 		
		}	
	}else{
?>
		<script >
			alert ("You must login to access this page!");
			window.location.replace("./login.php");
		</script> 
<?php  
	}
?>
				


<body>
<?php 
	require_once("./headers/common_header.php");
?>


<div class="container">
<div class="container-fluid">	
	<div class="row">
		<div class="span12 row wrapper" >
			<ul class="breadcrumb">
				<li>
					<div itemscope>
						<a href="./home.php" itemprop="url"><i class="icon-home"></i></a>
						<span class="divider">/</span>
					</div>
				</li>
				<li>
					<div itemscope>
						<a href="./mystories.php" itemprop="url"><span itemprop="title"><?=decryptString($row4[0][1])?></span></a>
						<span class="divider">/</span>
					</div>
				</li>
				
				<li class="active">
					<strong>Edit</strong>
				</li>
			</ul>
		</div>
			
	<!--		<div class="thumbnails" >			-->
		<div class=" span12 row wrapper" style="background-color: #f2f2f2" >
				
				<div style="margin-top: 20px; margin-bottom: 20px; width:100%;">
					<form action="editstory.php?storyID=<?=$storyID?>" method="post" role="form" enctype="multipart/form-data">
					<div class="row1">
						<div class="col-20" style="text-align: center; float: left">
							<label for="id_title" class="control-label requiredField"> Cover image<span class="asteriskField">*</span></label>

							<img style="background-color: white;width: 80%; height: auto;min-width:200px; min-height: 200px; margin-top: 0px; " id="image" src="./img/<?=$row4[0][4]?>"/>
							<input style = "width: 100%; " id="inpImage" type='file' name="inpImage" value="<?=$row4[0][4]?>">

							<script type="text/javascript">
							// Change URL of image to base64
								function readFile() {

            						if (this.files && this.files[0]) {

                						var fileReader = new FileReader();

                						fileReader.addEventListener("load", function (e) {
                    						document.getElementById("image").src = e.target.result;
                						});

                						fileReader.readAsDataURL(this.files[0]);
            						}
        						}

        					// Show image to review
								window.onload = function () {
            						document.getElementById("inpImage").addEventListener("change", readFile);
        						};
							</script>	 
						</div>	
						
						<div class="col-80 controls">
							<div class="row1">
								<div class="col-20">
									<label for="id_title" class="control-label requiredField">Status<span class="asteriskField">*</span></label>
								</div>
								<div class="col-80 controls">
									
									<select name="status" id="status" style="width: 90%">
									<?php
									if($row4[0][7] == "On going"){
									?>
		      							<option selected value="On going">On going</option>
		      							<option value="Completed">Complete</option>
		      						<?php
		      						}else{
									?>
										<option value="On going">On going</option>
		      							<option selected value="Completed">Completed</option>
									<?php
									}
									?>
		      						</select>
								</div>
							</div>

							<div class="row1">
								<div class="col-20">
									<label for="id_title" class="control-label requiredField">Title<span class="asteriskField">*</span></label>
								</div>
								<div class="col-80 controls">
									<input style= "width: 88%;" value="<?=decryptString($row4[0][1])?>" name="title" maxlength="200" type="text" required="required" placeholder="Story Title" class="textinput textInput" id="id_title" title="Title has maximum of 200 characters"/>
								</div>
							</div>

							<div class="row1">
								<div class="col-20">
									<label for="id_catergory" class="control-label requiredField">Categories<span class="asteriskField">*</span></label>
								</div>
								<div class="col-80 controls">
								
									<?php
										$sql = "select * from category";
										$category = query($sql);

										$sql6 = "SELECT categoryID FROM story_category WHERE storyID='".$storyID."'";
										$row6 = query($sql6);
										//print_r($row6);

										for($i=0; $i < count($category); $i++)
										{
											if(in_array($category[$i][0],array_column($row6, '0')))
											{
										?>	
												<ul class="span2 unstyled">
													<li style="width:100%; font-size: 14px; float: left;">
														<input id="checkbox" type="checkbox" name="checkbox[]" checked="checked" value="<?=$category[$i][0]?>"><?=$category[$i][1]?>
													</li>
												</ul>
		                				<?php
		                					}else{
		                				?>
		                						<ul class="span2 unstyled">
													<li style="width:100%;  font-size: 14px; float: left;">
														<input type="checkbox" name="checkbox[]" value="<?=$category[$i][0]?>"><?=$category[$i][1]?>
													</li>
												</ul>
										<?php
											}
										}
										?>							
								</div>
							</div>

							<div class="row1">
								<div class="col-20">
									<label for="id_description" class="control-label requiredField">Descriptions</label>
								</div>
								<div class="col-80 controls">
									<textarea style= "width: 88%; resize: none;" name="descriptions" type="textarea" rows="15" placeholder="Story Descriptions" class="textinput textInput" id="id_description" /><?=decryptString($row4[0][3])?></textarea> 
								</div>
							</div>

							<div class="row1">
								<div class="col-20"></div>
								<div class="col-80 controls" style="text-align: center;">
									<button style="width: 85px; height: 35px; font-size: 15" type="submit" name ="submit" class="btn btn-primary" data-loading-text="Loading" value="Submit">
										Save
									</button>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
									<button style="width: 85px; height: 35px; font-size: 15" type="reset" class="btn btn-default" onclick="Clear()">Clear</button>

									<script type="text/javascript">
										//Clear function
										function Clear(){
											//document.getElementById("image").src = "";
											document.getElementById("image").removeAttribute("src");
											document.getElementById("checkbox").removeAttribute("checked");
										}
									</script>
								</div>
							</div>	

						</div>

					</div>
				</form>
			</div>
		</div>
		<?php 
			require_once("./footers/footer.php");
		?>
	</div>
</div>
</div>
</body>
</html>