<?php
$config = [
    'baseUrl' => 'https://tecometatwo.com/web3/',
    'dbHost' => 'localhost',
    'dbName' => 'tecometatwo_db',
    'dbUser' => 'tecometatwo_user',
    'dbPass' => '+=3+B)t.HZ=a',
    'web3Url' => 'https://polygon-mainnet.infura.io',
    'web3Gas' => '50000',
    'web3GasPrice' => '10000000000',
    'web3ChainId' => '137',
    'cronKey' => 'a0c9417dbd2106aa3f01da427417f863',
    'precision' => '10',
    'apiVersion' => 1
];
$config['web3Gas'] = intval($config['web3Gas']);
$config['web3GasPrice'] = intval($config['web3GasPrice']);
$config['web3ChainId'] = intval($config['web3ChainId']);
$config['precision'] = intval($config['precision']);
return $config;