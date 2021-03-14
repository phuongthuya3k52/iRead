<?php
//Hàm login sau khi mạng xã hội trả dữ liệu về
function loginFromSocialCallBack($socialUser) {
    require_once("./db.php");

    $sql1= "SELECT email FROM member WHERE memberID = 1 ";
    
    echo($sql1);

    $result=query($sql1);

    echo(count($result));

    $sql1 = "select * from admin";
$pros = query($sql1);
echo $pros[0][2];

    $sql= "SELECT email FROM member WHERE email='".$socialUser['email'] ."'";
    echo($sql);

    

    

    $result=query($sql1);

    echo(count($sql1));

    if(count($result) == 0){
        $sql1 = "Insert into member values ('" ."','" ."','" ."','" .$socialUser['email'] ."','" ."',1)";
        $rs = execsql($sql1);

        $sql= "SELECT email FROM member WHERE email='".$socialUser['email'] ."'";
        $result=query($sql);
    }
    if(count($result) > 0){
        $user = mysqli_fetch_assoc($result);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['current_user'] = $user;
        header('Location: ./logintest.php');
        die();
    }
}

/*    $result = mysqli_query($con, "Select `id`,`username`,`email`,`fullname` from `user` WHERE `email` ='" . $socialUser['email'] . "'");
    if ($result->num_rows == 0) {
        $result = mysqli_query($con, "INSERT INTO `user` (`fullname`,`email`, `status`, `created_time`, `last_updated`) VALUES ('" . $socialUser['name'] . "', '" . $socialUser['email'] . "', 1, " . time() . ", '" . time() . "');");
        if (!$result) {
            echo mysqli_error($con);
            exit;
        }
        $result = mysqli_query($con, "Select `id`,`username`,`email`,`fullname` from `user` WHERE `email` ='" . $socialUser['email'] . "'");
    }
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['current_user'] = $user;
        header('Location: ./login.php');
    }
}

*/