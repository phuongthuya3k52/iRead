<?php	
	require_once("./db.php");
    session_start();

	if(isset($_GET['submit']) && isset($_GET['story_id']) && isset($_GET['chapter_id'])&& isset($_GET['member_id']))
	{
		$storyID = $_GET['story_id'];
		$chapterID = $_GET['chapter_id'];
		$authorID = $_GET['member_id'];

		$sql = "SELECT * FROM member WHERE username='" .$_SESSION['username'] . "'";
		$row = query($sql);
		$readerID = $row[0][0];
		$readerwallet = $row[0][5];


		$sql1 = "SELECT * FROM member WHERE memberID='" .$authorID . "'";
		$row1 = query($sql1);
		$authorwallet = $row1[0][5];

		echo($readerID ." + " .$authorID ." + " .$storyID." + " .$chapterID);

		if($readerwallet > 0){
			$sql2 = "UPDATE member SET wallet='" .$readerwallet-1 ."'WHERE memberID='" .$readerID ."'";
			$result2 = execsql($sql2);

			$sql3 = "UPDATE member SET wallet='" .$authorwallet+1 ."'WHERE memberID='" .$authorID ."'";
			$result3 = execsql($sql3);
			
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$timecreate = date('Y-m-d H:i:s');

			if ($result2 != null && $result3 != null){
				$sql4 = "INSERT INTO chapter_payment VALUES ('', '" .$readerID ."','" .$chapterID ."','1','".$timecreate ."')";
				$result4 = execsql($sql4);
			}   
			if($result4 != null){
				header("location: readstory.php?storyID=$storyID&chapterID=$chapterID");
			}

		}else{
		?>
			<script>
				alert ("You do not have enough coins. Please recharge and try again!");
				window.location.replace("./readstory.php?storyID=<?=$storyID?>&chapterID=<?=$chapterID?>");
			</script> 
		<?php	

	}
	}
?>