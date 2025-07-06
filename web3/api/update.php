<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../lib/autoload.php'; 
use Sop\CryptoTypes\Asymmetric\EC\ECPublicKey;
use Sop\CryptoTypes\Asymmetric\EC\ECPrivateKey;
use Sop\CryptoEncoding\PEM;
use kornrunner\Keccak;
use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3p\EthereumTx\Transaction;
use Web3\Utils;
use Web3\Contract;
include 'functions.php';   //change
include '../inc/database.php';  //change


// $provider = 'https://rpc-mumbai.maticvigil.com/';// polygon testing
$provider = 'https://data-seed-prebsc-1-s1.binance.org:8545/';//testing
// $provider = 'https://bsc-dataseed.binance.org/';

 $web3 = new Web3(new HttpProvider(new HttpRequestManager($provider, 5)));
 $contractABI = json_decode('[
	{
		"inputs": [],
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "address",
				"name": "Owner",
				"type": "address"
			},
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "Divident",
				"type": "uint256"
			},
			{
				"indexed": false,
				"internalType": "address",
				"name": "DepositToken",
				"type": "address"
			}
		],
		"name": "Init",
		"type": "event"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "sponsor",
				"type": "address"
			}
		],
		"name": "_register",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "baseDiv",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "bool",
				"name": "st",
				"type": "bool"
			}
		],
		"name": "changeD_status",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"name": "currentslotupdate",
		"outputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "depositToken",
		"outputs": [
			{
				"internalType": "contract BEP20",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			},
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "directs",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "distribute_royalty",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint40",
				"name": "slot_no",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "lvl",
				"type": "uint40"
			}
		],
		"name": "findPlacement",
		"outputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "addr",
				"type": "address"
			},
			{
				"internalType": "uint40",
				"name": "slt",
				"type": "uint40"
			}
		],
		"name": "getSlotUsers",
		"outputs": [
			{
				"internalType": "uint256[]",
				"name": "",
				"type": "uint256[]"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "idToAddress",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"name": "incomes",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "level",
				"type": "uint256"
			},
			{
				"internalType": "uint256",
				"name": "slot",
				"type": "uint256"
			},
			{
				"internalType": "uint256",
				"name": "direct",
				"type": "uint256"
			},
			{
				"internalType": "uint256",
				"name": "royalty",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_royaltyusr",
				"type": "address"
			},
			{
				"internalType": "address",
				"name": "_owner",
				"type": "address"
			},
			{
				"internalType": "uint256",
				"name": "divd",
				"type": "uint256"
			},
			{
				"internalType": "address",
				"name": "_depositToken",
				"type": "address"
			}
		],
		"name": "init",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "init1",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "init2",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "init3",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "levelIncome",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "myadd",
				"type": "address"
			}
		],
		"name": "mydirects",
		"outputs": [
			{
				"internalType": "address[]",
				"name": "",
				"type": "address[]"
			},
			{
				"internalType": "uint40[]",
				"name": "",
				"type": "uint40[]"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			},
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "myslot",
		"outputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"name": "nextslotupdate",
		"outputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "owner",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "pkgs",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "addr",
				"type": "address"
			},
			{
				"internalType": "uint40",
				"name": "slt",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "lvl",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "prnt",
				"type": "uint40"
			}
		],
		"name": "poolData",
		"outputs": [
			{
				"internalType": "address[]",
				"name": "",
				"type": "address[]"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_usr",
				"type": "address"
			},
			{
				"internalType": "address",
				"name": "sponsor",
				"type": "address"
			}
		],
		"name": "registerExt",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "royalty",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "royaltyusers",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			},
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "slotChilds",
		"outputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "addr",
				"type": "address"
			}
		],
		"name": "slotData",
		"outputs": [
			{
				"internalType": "uint256[]",
				"name": "",
				"type": "uint256[]"
			},
			{
				"internalType": "uint256[]",
				"name": "",
				"type": "uint256[]"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"name": "slotincome",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"name": "slotusers",
		"outputs": [
			{
				"internalType": "uint40",
				"name": "id",
				"type": "uint40"
			},
			{
				"internalType": "uint256",
				"name": "userId",
				"type": "uint256"
			},
			{
				"internalType": "uint40",
				"name": "parentId",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "downline",
				"type": "uint40"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"name": "slotusersCount",
		"outputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint40",
				"name": "indx",
				"type": "uint40"
			},
			{
				"internalType": "address",
				"name": "usr",
				"type": "address"
			}
		],
		"name": "upgrade",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"name": "userMaxSlot",
		"outputs": [
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"name": "users",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "id",
				"type": "uint256"
			},
			{
				"internalType": "address",
				"name": "sponsor",
				"type": "address"
			},
			{
				"internalType": "uint40",
				"name": "directs",
				"type": "uint40"
			},
			{
				"internalType": "uint40",
				"name": "activePkg",
				"type": "uint40"
			},
			{
				"internalType": "uint256",
				"name": "balance",
				"type": "uint256"
			},
			{
				"internalType": "bool",
				"name": "royalty_status",
				"type": "bool"
			},
			{
				"internalType": "uint40",
				"name": "myRoyaltyusers",
				"type": "uint40"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			},
			{
				"internalType": "uint40",
				"name": "",
				"type": "uint40"
			}
		],
		"name": "userslotIncome",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "amount",
				"type": "uint256"
			},
			{
				"internalType": "contract BEP20",
				"name": "tkn",
				"type": "address"
			}
		],
		"name": "withdraw",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	}
]');
// $tokenContractABI = json_decode('[{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]');
            
// // $contractAddress = '0x96D1D0c5F9BADfC1E6B4AE58De23C9B06Cb88f8A';
// $contractAddress = '0xd3b440071fDCc4894Eef967646878b4F1efb9944'; // polygon test
$contractAddress = '0x0B0e34085Bca9Af0f6753af68A4Ebfe93aE2F703'; 
// // $tokenAddress  = "0x70c0D95A3Ceb94b3D1b516c57F4116A4104fF259"; WebDX
// $tokenAddress  = "0x55d398326f99059fF775485246999027B3197955";

$servername = "localhost";
$username = "demorudramsoft_user";
$password = "rramt@0521";
$dbname = "demorudramsoft_max_world";
// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);



// $api_url = "https://api.bscscan.com/api?module=account&action=txlist&address=0x6D60A2786790f57483A587c1cbb78C1DF4a499d5&startblock=0&endblock=99999999999&page=1&offset=1000&sort=asc&apikey=6B5GRTPUEKGZ2ZYFP3WMNQWWCMPRFPJVTJ";
                
           
                   

// $curl = curl_init();

// curl_setopt_array($curl, [
//   CURLOPT_URL => $api_url,
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "GET",
//   CURLOPT_HTTPHEADER => [
//     "Accept: */*",
//     "User-Agent: Thunder Client (https://www.thunderclient.com)"
//   ],
// ]);

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);
 
// $rdata=json_decode($response,true);
// $result = $rdata['result'];
 

// foreach($result as $item){
//     $funname = $item['functionName'];
//     $inputD = $item['input'];
//     $methodId = $item['methodId'];
//     $hash = $item['hash'];
//     $from = $item['from'];
   
//     $sponsor = ''; 
//     $level = ''; 
//     $usr = ''; 
                                
     
    
//     if($funname=="register(address key)"){
        
       
        
//         $functionParameters = substr($inputD, 10);
//         $data_val = $functionParameters;
//         $data_cleaned = str_replace("0x" , "" , $data_val);
//         $data_split =  str_split($data_cleaned, 64);
        
//         $hexValue1 = $data_split[0];
//         $val = $data_split[1];
        
//         // Convert hexadecimal to Ethereum address
//         $address = '0x' . substr($hexValue1, -40); // Assuming Ethereum address is 20 bytes (40 characters).
        
//         // echo '<pre>';
//         // print_r($address);
//         // echo '</pre>';  
//         $sponsor = $address;
        
//     }
    
//     if($funname=="upgrade(uint40 indx,address usr)"){
        
       
        
//         $functionParameters = substr($inputD, 10);
//         $data_val = $functionParameters;
//         $data_cleaned = str_replace("0x" , "" , $data_val);
//         $data_split =  str_split($data_cleaned, 64);
        
//         $hexValue1 = $data_split[0];
//         $val = $data_split[1];
        
//         // Convert hexadecimal to Ethereum address
//         $val1 =  substr($hexValue1, -1); // Assuming Ethereum address is 20 bytes (40 characters).
//         $val2 = '0x' . substr($val, -40); // Assuming Ethereum address is 20 bytes (40 characters).
        
//         // echo '<pre>';
//         // print_r($val1);
//         // //print_r($val2);
//         // echo '</pre>';  
//          $level = $val1; 
//          $usr = $val2; 
//     }
 
//  $sql = "INSERT INTO crowd7data (functionName, inputData, fromUser, hash, methodId, sponsor, level, usr) VALUES ('$funname', '$inputD', '$from','$hash','$methodId','$sponsor','$level','$usr')";
    
//   // $conn->query($sql);
// }

$sql = "SELECT * FROM crowd7data WHERE status='0' ORDER by id ASC limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    
    $trstatus = false;
 $eth = $web3->eth;
$account="0x349BCeD1D704d0c73B5cbB98Eece234f86D30621";
  $nonce = 0;
        $eth->getTransactionCount($account, function ($err, $result) use (&$nonce) {

            $msg= $nonce =$result->value;
        });
echo 'nonse'.$nonce;
 $contract = new Contract($provider, $contractABI);
 if($row["functionName"]=="register(address key)"){
      $data = '0x' . $contract->at($contractAddress)->getData('registerExt', $row["fromUser"], $row["sponsor"]);
                        
        $newNonce = $nonce;
        $transaction = [
                'nonce' => '0x' . dechex($newNonce),
                'from' => $account,
                'to' => $contractAddress,
                'gas' => '0x' . bcdechex(5000000),
                'gasPrice' => '0x' . bcdechex(5000000000),
                'chainId' => strval(97),
                'value' => 0,
                'data' => $data
            ];
            
            
            $txs = new Transaction($transaction);
            $signedTxs = '0x' . $txs->sign("505bf2784236449c499f0398ef16bc526b014c8103ef90131969fbb47fd5bef7");
            $txResults = null;
           
            $eth->sendRawTransaction($signedTxs, function ($err, $txResults) use (&$msg,&$trstatus) {
                if($err) { 
                   echo $msg =  $err;
                    $trstatus=false;
                } else {
                   echo $msg =  $txResults;
                    $trstatus=true;
                    
                }
            });
 }
 
   if($row["functionName"]=="upgrade(uint40 indx,address usr)"){
      $data = '0x' . $contract->at($contractAddress)->getData('upgrade', $row["level"], $row["usr"]);
                        
        $newNonce = $nonce;
        $transaction = [
                'nonce' => '0x' . dechex($newNonce),
                'from' => $account,
                'to' => $contractAddress,
                'gas' => '0x' . bcdechex(1000000),
                'gasPrice' => '0x' . bcdechex(5000000000),
                'chainId' => strval(97),
                'value' => 0,
                'data' => $data
            ];
            
            
            $txs = new Transaction($transaction);
            $signedTxs = '0x' . $txs->sign("505bf2784236449c499f0398ef16bc526b014c8103ef90131969fbb47fd5bef7");
            $txResults = null;
           
            $eth->sendRawTransaction($signedTxs, function ($err, $txResults) use (&$msg,&$trstatus) {
                if($err) { 
                   echo $msg =  $err;
                    $trstatus=false;
                } else {
                   echo $msg =  $txResults;
                    $trstatus=true;
                    
                }
            });
 }       
 $idd=$row["id"];
   $sql = "UPDATE crowd7data SET status='1' WHERE id='$idd'";  
   $conn->query($sql);
  }
}

 

