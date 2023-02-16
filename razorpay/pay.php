<?php
session_start();
require('config.php');
require('razorpay-php/Razorpay.php');



// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => $_SESSION["razorpay_receipt"],
    'amount'          => $_SESSION["razorpay_amount"] * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "Vimla Prints",
    "description"       => "Sarees - Checkout",
    "image"             => "https://www.vimlaprints.com/image/catalog/logo_new_final.png",
    "prefill"           => [
    "name"              => $_SESSION["razorpay_name"], //customer name
    "email"             => $_SESSION["razorpay_email"], //customer email address
    "contact"           => $_SESSION["razorpay_contact"], //customer phone number
    ],
    "notes"             => [
    "address"           => "B-15, Adajan Pal main Road, Surat",
    "merchant_order_id" => $_SESSION["razorpay_receipt"],
    ],
    "theme"             => [
    "color"             => "#1a1ec6"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("checkout/{$checkout}.php");
