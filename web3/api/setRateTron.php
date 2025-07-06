<?php

// require '../lib/autoload.php';
// use IEXBase\TronAPI\Exception\TronException;

// $provider = 'https://api.shasta.trongrid.io';

// $fullNode = new \IEXBase\TronAPI\Provider\HttpProvider($provider);
// $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider($provider);
// $eventServer = new \IEXBase\TronAPI\Provider\HttpProvider($provider);
// print_r($eventServer);
// die();
// try {
//     $tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
// } catch (TronException $e) {
//     exit($e->getMessage());
// }

// // Tron account private key and address
// $account = 'TSUhgRAUzzd9TBkafKX4fnAKGjJvBQ1xB8'; // Tron account address
// $privateKey = 'b3c459b76780524b2c68da973a54a2a51ad23c8216ed321309561f873a17fa17'; // Tron private key

// // Recipient TRX address and amount
// $sendAddress = 'TDWYbCYqbsvcLV1SxzyAGdXp5SkqfAnJUE';
// $trxAmount = '1000000'; // Amount in SUN (1 TRX = 1,000,000 SUN)

// $tron->setAddress($account);
// $tron->setPrivateKey($privateKey);
 
// try {
//     // Perform TRX transfer
//     $send = $tron->send($sendAddress, $trxAmount);

//     // Check the status of the transaction
//     $status = true;
// } catch (TronException $e) {
//     die($e->getMessage());
// }

// $res['message'] = $send;
// $res['success'] = $status;
// $res['res'] = json_encode($_POST);

// print_r(json_encode($res));




 
require 'vendor/autoload.php'; // Make sure to adjust the path based on your project structure

use IEXBase\TronAPI\Exception\TronException;
use IEXBase\TronAPI\Provider\HttpProvider;
use IEXBase\TronAPI\Tron;

$provider = 'https://api.shasta.trongrid.io'; // Use the appropriate TRON network URL
print_R($provider);
die();

$fullNode = new HttpProvider($provider);
$solidityNode = new HttpProvider($provider);
$eventServer = new HttpProvider($provider);

try {
    $tron = new Tron($fullNode, $solidityNode, $eventServer);
} catch (TronException $e) {
    exit($e->getMessage());
}

// Tron account private key and address
$privateKey = 'b3c459b76780524b2c68da973a54a2a51ad23c8216ed321309561f873a17fa17'; // Replace with the sender's private key
$fromAddress = $tron->address->fromPrivateKey($privateKey);
// Recipient TRX address and amount
$toAddress = 'TDWYbCYqbsvcLV1SxzyAGdXp5SkqfAnJUE'; // Replace with the recipient's address
$trxAmount = 1; // Replace with the amount of TRX to send

// Build the transaction
$transaction = [
    'to' => $toAddress,
    'amount' => $tron->toSun($trxAmount), // Convert TRX to Sun
    'from' => $fromAddress,
];

try {
    // Send TRX
    $send = $tron->transactionBuilder->sendTransaction($transaction);
    
    // Check the status of the transaction
    $status = true;
    $transactionHash = $send['txid'];
} catch (TronException $e) {
    $status = false;
    $transactionHash = null;
    die($e->getMessage());
}

$res['message'] = $transactionHash;
$res['success'] = $status;

echo json_encode($res);

