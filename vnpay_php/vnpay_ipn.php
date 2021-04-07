<?php
session_start();
/*
 * IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
 * Các bước thực hiện:
 * Kiểm tra checksum 
 * Tìm giao dịch trong database
 * Kiểm tra tình trạng của giao dịch trước khi cập nhật
 * Cập nhật kết quả vào Database
 * Trả kết quả ghi nhận lại cho VNPAY
 */

require_once("./config.php");
$inputData = array();
$returnData = array();
$data = $_REQUEST;
foreach ($data as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

$vnp_SecureHash = $inputData['vnp_SecureHash'];
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
$vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
$vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
//$secureHash = md5($vnp_HashSecret . $hashData);
$secureHash = hash('sha256',$vnp_HashSecret . $hashData);
$Status = 0;
$orderId = $inputData['vnp_TxnRef'];

try {
    //Check Orderid    
    //Kiểm tra checksum của dữ liệu
    if ($secureHash == $vnp_SecureHash) {
        //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
        //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
        //Giả sử: $order = mysqli_fetch_assoc($result);   
        $order = NULL;
        if ($order != NULL) {
            if ($order["Status"] != NULL && $order["Status"] == 0) {
                if ($inputData['vnp_ResponseCode'] == '00') {
                    $Status = 1;
                } else {
                    $Status = 2;
                }
                //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                //
                //
                //
                //Trả kết quả về cho VNPAY: Website TMĐT ghi nhận yêu cầu thành công 
                $trans_id = $_GET['vnp_TxnRef'];
                                $money = $_GET['vnp_Amount']/100;
                                $note = $_GET['vnp_OrderInfo'];
                                $vnp_response_code = $_GET['vnp_ResponseCode'];
                                $code_vnpay = $_GET['vnp_TransactionNo'];
                                $code_bank = $_GET['vnp_BankCode'];
                                $time = $_GET['vnp_PayDate'];
                                $date_time = substr($time, 0, 4) . '-' . substr($time, 4, 2) . '-' . substr($time, 6, 2) . ' ' . substr($time, 8, 2) . ' ' . substr($time, 10, 2) . ' ' . substr($time, 12, 2);
                                $sql1 = "SELECT * FROM transaction WHERE order_id = '$order_id' AND memberID = '$memberID'";
                                $query1 = mysqli_query($conn, $sql1);
                                $row1 = mysqli_num_rows($query1);
                                
                                if ($row1 > 0) {
                                    $sql2 = "UPDATE transaction SET transactionID = '$trans_id', quantity = '$money/1000', note = '$note', vnp_response_code = '$vnp_response_code', code_vnpay = '$code_vnpay', code_bank = '$code_bank' WHERE transactionID = '$trans_id' AND memberID = '$memberID'";
                                   
                                    mysqli_query($conn, $sql2);
                                } else {
                                    $sql3 = "INSERT INTO transaction(transactionID, memberID, quantity, note, vnp_response_code, code_vnpay, code_bank, createAt) VALUES ('$trans_id', '$memberID', '$money/1000', '$note', '$vnp_response_code', '$code_vnpay', '$code_bank','$date_time')";
                                    mysqli_query($conn, $sql3);
                                }               
                $returnData['RspCode'] = '00';
                $returnData['Message'] = 'Confirm Success';
            } else {
                $returnData['RspCode'] = '02';
                $returnData['Message'] = 'Order already confirmed';
            }
        } else {
            $returnData['RspCode'] = '01';
            $returnData['Message'] = 'Order not found';
        }
    } else {
        $returnData['RspCode'] = '97';
        $returnData['Message'] = 'Chu ky khong hop le';
    }
} catch (Exception $e) {
    $returnData['RspCode'] = '99';
    $returnData['Message'] = 'Unknow error';
}
//Trả lại VNPAY theo định dạng JSON
echo json_encode($returnData);
