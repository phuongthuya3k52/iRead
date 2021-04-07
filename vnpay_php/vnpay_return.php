<?php
    ob_start();
    session_start();
    require_once("../db.php");
    if(isset($_SESSION['username'])){
        $sql = "SELECT * FROM member WHERE username = '" .$_SESSION['username'] . "'";
            //echo($sql);
            $row = query($sql);
            $memberID = $row[0][0];
            $wallet = $row[0][5];
    }
    require_once("./config.php");
    $check = false;

    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }
    unset($inputData['vnp_SecureHashType']);
    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . $key . "=" . $value;
        } else {
            $hashData = $hashData . $key . "=" . $value;
            $i = 1;
        }
    }

    //$secureHash = md5($vnp_HashSecret . $hashData);
	$secureHash = hash('sha256',$vnp_HashSecret . $hashData);
    if ($secureHash == $vnp_SecureHash) {
        $trans_id = $_GET['vnp_TxnRef'];
        $note = $_GET['vnp_OrderInfo'];
        $vnp_response_code = $_GET['vnp_ResponseCode'];
        $code_vnpay = $_GET['vnp_TransactionNo'];
        $code_bank = $_GET['vnp_BankCode'];
        $time = $_GET['vnp_PayDate'];
        $date_time = substr($time, 0, 4) . '-' . substr($time, 4, 2) . '-' . substr($time, 6, 2) . ' ' . substr($time, 8, 2) . ' ' . substr($time, 10, 2) . ' ' . substr($time, 12, 2);
        if ($_GET['vnp_ResponseCode'] == '24') {
            $sql4 = "DELETE FROM transaction  WHERE transactionID = '$trans_id'";
                $result4 = execsql($sql4);
            header("Location: ../trans_history.php?transtt=3");
        }else {           
            
            $sql1 = "SELECT * FROM transaction WHERE transactionID = '$trans_id' AND memberID = '$memberID'";
            $row1 = query($sql1);
                                
            if(count($row1)>0)
            {
                $sql2 = "UPDATE transaction SET transactionID = '$trans_id', note = '$note', vnp_response_code = '$vnp_response_code', code_vnpay = '$code_vnpay', code_bank = '$code_bank' WHERE transactionID = '$trans_id' AND memberID = '$memberID'";
                $result2 = execsql($sql2);
                $check = true;
            }
        }                    
    } else {
        $check = false;
        //echo "Chu ky khong hop le";
        header("Location: ../trans_history.php?transtt=2");
    }
    echo("GET['vnp_ResponseCode'] = " .$_GET['vnp_ResponseCode']);

    if($check == true){
        $row1 = query($sql1);
        $money = $row1[0][2]/1000;
        $sql3 = "UPDATE member SET wallet = $wallet + $money WHERE memberID = '$memberID'";
        //echo($sql3);
        $result3 = execsql($sql3);
        //echo("result3 = " .$result3);
        if($result3 != null){
            header("Location: ../trans_history.php?transtt=1");
        }else{
            header("Location: ../trans_history.php?transtt=2");
        }
    }

?>

      
