<?php	
	require_once("./db.php");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] != 'POST'){
    ?>
		<script>
			alert ("You cannot access this page");
			window.location.replace("./home.php");
		</script> 
	<?php	
	}	


// Delete chapter
	if(isset($_POST['cf_del_chapter']) && isset($_POST['chapter_id']) && isset($_POST['story_id']))
	{
		$chapterID = $_POST['chapter_id'];
		$storyID = $_POST['story_id'];

		$sql = "DELETE FROM vote WHERE chapterID='" .$chapterID ."'";
		$result = execsql($sql);
		//echo ("result = " .$result);

		$sql1 = "DELETE FROM chapter_payment WHERE chapterID='" .$chapterID ."'";
		$result1 = execsql($sql1);
		//echo ("result1 = " .$result1);

	// Get view of chapter
		$sql2 = "SELECT * FROM chapter WHERE chapterID='" .$chapterID . "'";
		$row2 = query($sql2);
		$chapterview = $row2[0][5];

	// Get view of story
		$sql3 = "SELECT * FROM story WHERE storyID='" .$storyID . "'";
		$row3 = query($sql3);
		$storyview = $row3[0][5];


		if($result != null && $result1 != null){
			$sql4 = "DELETE FROM chapter WHERE chapterID='" .$chapterID ."'";
			$result4 = execsql($sql4);
			//echo ("result4 = " .$result4);

			if($result4 != null){

			// Update views of story	
				$sql5 = "UPDATE story SET  viewNumber='" .$storyview - $chapterview ."' WHERE storyID= '".$storyID."'"; 
				$result5 = execsql($sql5);
		?>
				<script>
					alert ("The chapter has been deleted successfully!");
					window.location.replace("./chapterlist.php?storyID=<?=$storyID?>");
				</script> 
		<?php
			}else{	
		?>
			<script>
				alert ("Failed to delete the chapter. Please try again!");
				window.location.replace("./chapterlist.php?storyID=<?=$storyID?>");
			</script> 
		<?php
			}
		}else{
		?>
			<script>
				alert ("Failed to delete the chapter. Please try again!");
				window.location.replace("./chapterlist.php?storyID=<?=$storyID?>");
			</script> 
		<?php	
		}
	}

// Delete story
	//echo("cf_del_story = ".isset($_POST['cf_del_story']));
    //echo("story_id = ".isset($_POST['story_id']));

	if(isset($_POST['cf_del_story']) && isset($_POST['story_id']))
	{
		$storyID = $_POST['story_id'];
		$sql1 = "SELECT * FROM chapter WHERE storyID='" .$storyID . "'";
		$result1 = execsql($sql1);

		if($result1 != null){
			$row1 = query($sql1);
			for($i=0; $i < count($row1); $i++){
				$is_chapter_del = false;
				$chapterID = $row1[$i][0];

				// Delete votes of chapter
				$sql2 = "DELETE FROM vote WHERE chapterID='" .$chapterID ."'";
				$result2 = execsql($sql2);
				// Delete chapter payment
				$sql3 = "DELETE FROM chapter_payment WHERE chapterID='" .$chapterID ."'";
				$result3 = execsql($sql3);

				// Delete chapter
				$sql4 = "DELETE FROM chapter WHERE chapterID='" .$chapterID ."'";
					$result4 = execsql($sql4);
					echo("result4 = ". $result4);
					$is_chapter_del = true;
			}
		}else{
			$is_chapter_del = true;
		}
		echo("is_chapter_del = ". $is_chapter_del);
		// Delete chapter successfull
		if($is_chapter_del == true)
		{
			// Delete category of story
			$sql5 = "DELETE FROM story_category WHERE storyID='" .$storyID ."'";
			$result5 = execsql($sql5);

			// Delete category successfull
			if($result5 != null) 
			{			
				// Delete story
				$sql6 = "DELETE FROM story WHERE storyID='" .$storyID ."'";
				$result6 = execsql($sql6);

				if($result6 != null) 
				{
			?>
					<script>
						alert ("The story has been deleted successfully!");
						window.location.replace("./mystories.php?");
					</script> 
			<?php
				}else{	
			?>	
					<script>
						alert ("Failed to delete the story. Please try again!");
						window.location.replace("./mystories.php?");
					</script> 	
	<?php
				}
			}else{
		?>
				<script>
					alert ("Failed to delete the story. Please try again!");
					window.location.replace("./mystories.php?");
				</script> 
		<?php	
			}
			
		}else{
	?>
			<script>
					alert ("Failed to delete the story. Please try again!");
					window.location.replace("./mystories.php?");
				</script>  
		<?php	
		}
	} 
?>