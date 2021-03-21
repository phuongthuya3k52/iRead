<?php
	require_once("./db.php");
    session_start();

	if(isset($_GET['destinaton_chap']) && isset($_GET['story_id'])){
		$destinaton_chap = $_GET['destinaton_chap'];
		$storyID = $_GET['story_id'];

		echo($destinaton_chap ." + ".$storyID);
		
		$sql = "Select * from chapter where storyID='" .$storyID . "'";
		$row = query($sql);
		echo("row = ".count($row));

		for($i=0; $i< count($row);$i++)
		{
			if($i+1 == $destinaton_chap){
				$chapterID = $row[$i][0];
				header("location: readstory.php?storyID=$storyID&chapterID=$chapterID");  
			}
		}
	}
	else{
?>
		<script >
			alert ("Get data failed!");
			window.location.replace("./home.php");
		</script>
<?php
	}
			
	?>