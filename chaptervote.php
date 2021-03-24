<?php	
	require_once("./db.php");
    session_start();

 //   echo("vote_submit = ".isset($_POST['vote_submit']));

 //   echo("unvote_submit = ".isset($_POST['unvote_submit']));

// Vote feature
	if(isset($_POST['vote_submit']) && isset($_POST['story_id']) && isset($_POST['chapter_id'])&& isset($_POST['reader_id']))
	{
		$storyID = $_POST['story_id'];
		$chapterID = $_POST['chapter_id'];
		$readerID = $_POST['reader_id'];

		$sql = "INSERT INTO vote VALUES ('', '" .$readerID ."','" .$storyID ."','" .$chapterID ."')";
		$result = execsql($sql);

		if($result != null){
			$sql1 = "SELECT * FROM chapter WHERE chapterID='" .$chapterID . "'";
			$row1 = query($sql1);
			$view = $row1[0][5];

		// Update chapter view number	
			$sql2 = "UPDATE chapter SET view='" .$view-1 ."'WHERE chapterID='" .$chapterID ."'";
			$result2 = execsql($sql2);

		// Update story vote number
			$sql3 = "SELECT * FROM story WHERE storyID='" .$storyID . "'";
			$row3 = query($sql3);
			$voteNumber = $row3[0][6];
			$viewNumber = $row3[0][5];
		/*	echo "voteNumber: " .$voteNumber;
			echo "viewNumber: " .$viewNumber;  */

			$sql4 = "UPDATE story SET voteNumber='" .$voteNumber+1 ." ', viewNumber='".$viewNumber-1 ."' WHERE storyID='" .$storyID ."'";
			$result4 = execsql($sql4);
			 
			header("location: readstory.php?storyID=$storyID&chapterID=$chapterID"); 
		}else{
		?>
			<script>
				alert ("Vote failed. Please try again!");
				window.location.replace("./readstory.php?storyID=<?=$storyID?>&chapterID=<?=$chapterID?>");
			</script> 
		<?php	
		}
	}

// UnVote feature
	if(isset($_POST['unvote_submit']) && isset($_POST['story_id']) && isset($_POST['chapter_id'])&& isset($_POST['reader_id']))
	{
		$storyID = $_POST['story_id'];
		$chapterID = $_POST['chapter_id'];
		$readerID = $_POST['reader_id'];

		$sql = "DELETE FROM vote WHERE memberID='" .$readerID ."' AND storyID='" .$storyID ."' AND chapterID='" .$chapterID ."'";
		$result = execsql($sql);

		if($result != null){
			$sql1 = "SELECT * FROM chapter WHERE chapterID='" .$chapterID . "'";
			$row1 = query($sql1);
			$view = $row1[0][5];

		// Update chapter view number
			$sql2 = "UPDATE chapter SET view='" .$view-1 ."'WHERE chapterID='" .$chapterID ."'";
			$result2 = execsql($sql2); 

		// Update story vote number
			$sql3 = "SELECT * FROM story WHERE storyID='" .$storyID . "'";
			$row3 = query($sql3);
			$voteNumber = $row3[0][6];
			$viewNumber = $row3[0][5];
		/*	echo "voteNumber: " .$voteNumber;
			echo "viewNumber: " .$viewNumber;  */

			$sql4 = "UPDATE story SET voteNumber='" .$voteNumber-1 ." ', viewNumber='".$viewNumber-1 ."' WHERE storyID='" .$storyID ."'";
			$result4 = execsql($sql4);

			header("location: readstory.php?storyID=$storyID&chapterID=$chapterID"); 
		}else{
		?>
			<script>
				alert ("Unvote failed. Please try again!");
				window.location.replace("./readstory.php?storyID=<?=$storyID?>&chapterID=<?=$chapterID?>");
			</script> 
		<?php	
		}
	} 
?>