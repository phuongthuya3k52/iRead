<?php
session_start();
    require_once __DIR__."/send_mail/SendMail.php";
    require_once('db.php');

    // Kiểm tra nếu thực hiện thao tác cập nhật quyền của người dùng
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $errors = '';
        $email = '';
        //echo(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));
        // kiem tra email co ton tai va dung dinh dang
        if(isset($_POST['forgotpw'])){
            echo($_POST['forgotpw']);
        }
        if(isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
        {
            $email = $_POST['email'];
        }
        else
        {
            $errors = "email";
        }
        if (empty($_POST['email'])) {
            $_SESSION['errors'] = 'Please enter your email';
            header('Location: forgotpw.php');
            exit();
        }  

        if (!empty($errors)) {
            $_SESSION['errors'] = 'Email address is invalid';
            header('Location: forgotpw.php');
            exit();
        }
        if (empty($errors) && !empty($email)) {
            $sql= "select * from account where email='" .$email ."'";
            $row=query($sql);

            if (empty($row)) {
                $_SESSION['errors'] = 'Email address does not exist ';
                header('Location: forgotpw.php');
                exit();
            }

            $token = substr(md5(rand(0,10000)),0,16);
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $creattime = date('Y-m-d H:i:s');

            $sql1= "UPDATE account SET token='" .$token ."', createAt='".$creattime ."' WHERE email='" .$email ."'";
            $result1 =execsql($sql1);

            $sql2= "select * from member where username='" .$row[0][0] ."'";
            $row2 =query($sql2);
            $fullname = $row2[0][1];
            

            $title = 'Update Password';
            $content = "<h3> Dear ". $fullname. "</h3>";
            $content .= "<p>We have received a request to re-issue your password recently.</p>";
            $content .= "<p>Please click <a href='http://iread.net/resetpw.php?email=".$email."&token=".$token."'> here </a> to update your new password.</p>";
            $content .= "<p>This link is valid only within <b>20 minutes</b>.</p>";
            $sendMai = send($title, $content, $fullname, $email);

           if ($sendMai) {  
    /*            $hash = password_hash($randPassword, PASSWORD_DEFAULT);
                $sqlUpdate = "UPDATE `account` SET `Pass`= '". $hash ."' WHERE `IdAccount` = ". $account['IdAccount'];
                $conn->query($sqlUpdate);  */
               $_SESSION['success'] = 'We sent you an email please check it';
                header('Location: forgotpw.php');
            } else {
                $_SESSION['errors'] = 'An error has occurred, the password cannot be retrieved. Please try again! ';
                header('Location: forgotpw.php');
                exit();
            }  
        } 

    }else{
        header('Location: forgotpw.php');
    }  
?>
