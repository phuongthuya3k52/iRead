<!<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<?php 
if(isset($_POST['submit'])){
	echo("<pre>");
	print_r($_FILES);
	echo ("</pre>");

	$error = array();

	//Tạo folder img để chứa file
	$target_dir = "img/";
	// Tạo dường dẫn file sau khi upload
	$target_file = $target_dir.basename($_FILES['fileUpload']['name']);
	echo($target_file);

	//Kiểm tra điều kiện upload

	//1. Kiểm tra kích thước file(5MB <=> 5242880 bytes)
	if($_FILES['fileUpload']['size'] <= 5242880){
		$error['fileUpload'] = "Chỉ được upload file dưới 5MB";
	}

	//2..Kiểm tra loại file (png;jpg;gif;jpeg)
	$file_type = pathinfo($_FILES['fileUpload']['name'], PATHINFO_EXTENSION);

	// các loại file đc phép
	$file_type_allow =  array('png','PNG','jpg','JPG','jpeg','JPEG','gif','GIF');
	if(!in_array($file_type, $file_type_allow)){
		$error['fileUpload'] = "Chỉ được upload file ảnh";
	}

	echo($file_type);
	
	//3. Kiểm tra sự tồn tại của file
	if(file_exists($target_file)){
		$error['fileUpload'] = "File đã tồn tại";
	}

	//3. Kiểm tra và chuyển file từ bộ nhớ tạm lên server
	if(empty($error)){
		if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target_file)){
			echo("Upload thành công");
		}else{
			echo("Upload thất bại");
		}
	}

	
}
?>

<body>
	
	<div id="content">
		<h1>Upload file</h1>
		<form id="form_upload" enctype="multipart/form-data"  method="POST">
			<input type="file" name="fileUpload" id="fileUpload"> <br>
			<input type="submit" name="submit">
			
		</form>
		
	</div>

</body>
</html>