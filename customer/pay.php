<?php 
session_start();
require 'config.php';
require 'razorpay-php/Razorpay.php';

use Razorpay\Api\Api;

if(isset($_POST)){
    $amount = $_POST['amount'];

    $api = new Api($keyId, $keySecret);

    $orderData = [
        'receipt'   => 'rcptid_11',
        'amount'    => $amount * 100, // rupees in paise
        'currency'  => 'INR'
    ];

    $razorpayOrder = $api->order->create($orderData);
    $orderid = $razorpayOrder -> id;
    // print_r($orderid);

    $response = array("order" => 200, 'orderid' => $orderid );
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>