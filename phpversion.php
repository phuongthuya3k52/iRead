<?php
echo phpversion();
require_once("./db.php");

$sql = "select * from admin";
$pros = query($sql);
echo $pros[0][2];

?>

<br>
<?php
	$sql1= "SELECT email FROM member WHERE memberID = 1 ";
    
    echo($sql1);

    $result=query($sql1);

    echo(count($result));

?>