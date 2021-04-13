<?php
// For Admin	
	require_once("../db.php");
    session_start(); 


// Delete chapter
    echo("cf_del_chapter = ".isset($_POST['cf_del_chapter']));
    echo("chapter_id = ".isset($_POST['chapter_id']));
    echo("story_id = ".isset($_POST['story_id'])); 
	if(isset($_POST['cf_del_chapter']) && isset($_POST['chapter_id']) && isset($_POST['story_id']))
	{
		$chapterID = $_POST['chapter_id'];
		$storyID = $_POST['story_id'];

		$sql = "DELETE FROM vote WHERE chapterID='" .$chapterID ."'";
		$result = execsql($sql);
		echo ("result = " .$result);

		$sql1 = "DELETE FROM chapter_payment WHERE chapterID='" .$chapterID ."'";
		$result1 = execsql($sql1);
		echo ("result1 = " .$result1);

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
			echo ("result4 = " .$result4);

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
	echo("cf_del_story = ".isset($_POST['cf_del_story']));
    echo("story_id = ".isset($_POST['story_id']));

	if(isset($_POST['cf_del_story']) && isset($_POST['story_id']))
	{
		$storyID = $_POST['story_id'];

		$sql1 = "SELECT * FROM chapter WHERE storyID='" .$storyID . "'";
		$result1 = querynull($sql1);

		if(!$result1){
			$row1 = query($sql1);
			for($i=0; $i < count($row1); $i++){
				$is_chapter_del = false;
				$chapterID = $row1[$i][0];

				$sql2 = "DELETE FROM vote WHERE chapterID='" .$chapterID ."'";
				$result2 = execsql($sql2);
				echo ("result2 = " .$result2);

				$sql3 = "DELETE FROM chapter_payment WHERE chapterID='" .$chapterID ."'";
				$result3 = execsql($sql3);
				echo ("result3 = " .$result3);

				if($result2 != null && $result3 != null){
					$sql4 = "DELETE FROM chapter WHERE chapterID='" .$chapterID ."'";
					$result4 = execsql($sql4);
					echo ("result4 = " .$result4);
					$is_chapter_del = true;
				}else{
					exit;
				}
			}
		}else{
			$is_chapter_del = true;
		}

		
		echo("is_chapter_del = " .$is_chapter_del);

		if($is_chapter_del == true)
		{
			$sql5 = "DELETE FROM story_category WHERE storyID='" .$storyID ."'";
			$result5 = execsql($sql5);
			echo ("result5 = " .$result5);


			if($result5 != null) 
			{			

				$sql6 = "DELETE FROM story WHERE storyID='" .$storyID ."'";
				$result6 = execsql($sql6);
				echo ("result6 = " .$result6);

				if($result6 != null) 
				{
			?>
				<script>
					alert ("The story has been deleted successfully!");
					window.location.replace("./storylist.php?");
				</script> 
			<?php
				}else{	
			?>	
				<script>
					alert ("Failed to delete the story. Please try again!");
					window.location.replace("./storylist.php?");
				</script> 	
	<?php
				}
			}else{
		?>
				<script>
					alert ("Failed to delete the story. Please try again!");
					window.location.replace("./storylist.php?");
				</script> 
		<?php	
			}
			
		}else{
	?>
			<script>
					alert ("Failed to delete the story. Please try again!");
					window.location.replace("./storylist.php?");
				</script>  
		<?php	
		}
	} 

// Delete account and member infnomation
	echo("cf_del_member = ".isset($_POST['cf_del_member']));
    echo("member_id = ".isset($_POST['member_id']));
    echo("usname = ".isset($_POST['usname']));

	if(isset($_POST['cf_del_member']) && isset($_POST['member_id']) && isset($_POST['usname']))
	{
		
		$memberID = $_POST['member_id'];
		$usname = $_POST['usname']);
		$is_chapter_del = false;

		//Delete Account
		$sql = "DELETE FROM account WHERE username='" .$usname ."'";
		$result = execsql($sql);
		echo ("result = " .$result);

		$sql1 = "UPDATE member SET fullName='', dob='null', phoneNumber='', username ='', walet ='', image= '' WHERE memberID='" .$memberID ."'";
		$result1 = execsql($sql1);
		echo ("result1 = " .$result1);
		if($result1 != null){
?>				
			<script >
					alert ("Account information has been updated successfully!");
					window.location.replace("./profile.php");
			</script>
<?php 		
		}else{
?>				
			<script >
					alert ("Failure to update account information. Try again!");
					window.location.replace("./profile.php");
			</script>
<?php
		}
	}
?>