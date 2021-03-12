<?php
//Hàm login sau khi mạng xã hội trả dữ liệu về
function loginFromSocialCallBack($socialUser) {
    include './db.php';

    $sql= "SELECT email FROM member WHERE email='".$socialUser['email'] ."'";
    $result=query($sql);

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
        header('Location: ./login.php');
        die();
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