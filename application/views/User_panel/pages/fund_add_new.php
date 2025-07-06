<style>
input.user_btn_button{
  margin-top:10px;
}

</style>
 <div class="main-content">
           <div class="page-content">

<div class="container pages">
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home /</a></li>            
            <li class="breadcrumb-item"><a href="">Fund /</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> Add Fund</li>
         </ol>
	   </div>
	 
</div>

<?php 
error_reporting(0);
    $success['param']='success';
    $success['alert_class']='alert-success';
    $success['type']='success';
    $this->show->show_alert($success);
    ?>
        <?php 
    $erroralert['param']='error';
    $erroralert['alert_class']='alert-danger';
    $erroralert['type']='error';
    $this->show->show_alert($erroralert);
  

  $gtfilecntnt = $this->curl->simple_get("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=1000&page=1");
  
  $c_array = json_decode($gtfilecntnt,true);

  $admin_address =  $this->conn->company_info('company_smart_chain_address'); 
?>
    
        




<style>
#status {
    
   
     position: inherit !important;
   
    margin: -20px 0 0 -20px;
}
  .pin_top_page_content h5 {
    color: var(--text2);
}
   .pin_top_page_content {
   text-align: end;
   }
   .detail_topup p i {
   font-size: 14px;
   margin-right: 10px;
   }
   span#total_pins{
    color: var(--text2) !important;
   }
   .form_topup {
   margin-top: 20px;
   padding: 1.5rem 1.5rem;
   background: #020b16 !important;
   border:none !important;
   box-shadow: rgb(0 0 0 / 20%) 0px 5px 15px;
   border-radius: 8px;
   }
   button.user_btn_button {
   padding: 6px 18px;
    border: none;
    background: #dfb82a;
    font-size: 14px;
    border-radius: 4px;
    text-transform: capitalize;
    color: #fff;
    font-weight: 500;
    margin-top: 10px;
   }
   .detail_topup {
   padding: 16px 16px;
   border: none;
   background: #5030ab;
   font-size: 14px;
   border-radius: 4px;
   text-transform: capitalize;
   color: #fff;
   font-weight: 500;
   margin-top: 20px;
   }
   .detail_topup h4 {
   font-size: 20px;
   font-weight: 500;
   text-transform: uppercase;
   }
   h4{
    color:#fff;
   }
</style>
</head>
<body>
<?php
$apiKey = 'c397bfc2-33c0-41bb-b0d3-f01a060116b6';
$tokenSymbol = 'JASMY'; // e.g., 'BNB'
$convert = 'USD'; // Currency to convert to

$endpoint = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
$query = http_build_query([
    'symbol' => $tokenSymbol,
    'convert' => $convert,
]);

$headers = [
    'Accepts: application/json',
    'X-CMC_PRO_API_KEY: ' . $apiKey,
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint . '?' . $query);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    $price = 0; // Set price to 0 in case of error
} else {
    $data = json_decode($response, true);
    if (isset($data['data'][$tokenSymbol]['quote'][$convert]['price'])) {
        $price = $data['data'][$tokenSymbol]['quote'][$convert]['price'];
    } else {
        echo "Error fetching price data.";
        $price = 0; // Set price to 0 in case of error
    }
}

curl_close($ch);
?>

   <div class="pin_topup_page">
      <div class="container">
         <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12">
             
               <div class="form_topup">
               <?php  
                $userid=$this->session->userdata('user_id');
                $my_usernasme=$this->profile->profile_info($userid,'username')->username;
                $available_pins=$this->conn->runQuery('count(pin) as cnt','epins',"use_status=0 and u_code='$userid'");
                $cnt_pins=($available_pins ? $available_pins[0]->cnt :0);
                ?>
               
                <div class="pin_top_page_content">
                    
                     <?php
                if($this->conn->setting('topup_type')=='pin'){
                ?>
                 <h5>Pin Available</h5>
                <span id="total_pins" class="text_span"><i class="fa fa-thumb-tack" aria-hidden="true"></i>&nbsp; <?= $cnt_pins;?></span>
                <?php } ?>  
                  </div>
                  <?php
                                            $profile = $this->session->userdata("profile");
                                            ?>
                  <input type="text" name="tx_username" id="tx_username"
                                                    value="<?= $profile->username; ?>" data-response="username_res"
                                                    class="form-control check_username_exist" placeholder="Enter Username"
                                                    aria-describedby="helpId" hidden>
                  <?php
                   
                   $currency=$this->conn->company_info('currency');
                   
                   ?>
                   <span class="text-danger" ><?= form_error('selected_wallet');?></span>
                          <div class="form-group">
                  <label>Select Package*</label>
                  <select class="form-control selected_pins" name="selected_pin" id="selected_pin" data-response="total_pins" required="">
                    <option value="" style=" background: white; ">Select Package</option>
                    <?php
                    $all_pin = $this->conn->runQuery("pin_rate,pin_type,pin_rate2", 'pin_details', "status=1");
                    if ($all_pin) {
                      foreach ($all_pin as $pindetails) {
                    ?><option style=" background: white; " value="<?= $pindetails->pin_type; ?>"><?= $currency; ?>  <?= $pindetails->pin_rate; ?> - <?= $currency; ?>  <?= $pindetails->pin_rate2; ?></option><?php
                      }
                    }
                    ?>
                  </select>
                  <span class="text-danger"><?= form_error('selected_pin'); ?></span>
                </div> 
                     <div class="form-group">
                        
                        <input type="text" name="amnt1" id="amnt1" class="form-control" placeholder="Enter Amount in USDT" aria-describedby="helpId"  oninput="validateAmount()">
                        <input type="text" name="amnt" id="amnt" class="form-control" placeholder="Enter Amount in USDT" aria-describedby="helpId" hidden>
                        <span class="text-danger" ><?= form_error('selected_pin');?></span>  
                        <p id="convertedValue"></p>
                         <p id="helpId" class="form-text text-muted" style="color: red;color: red !important;"></p>
                     </div>
                 
                   <br>
                 <div class="form-group">
                    <select name="" id="tx_type"  class="form-control">
                  
                      <option value="JASMY">JASMY</option>
                      <!--<option value="USDT">USDT </option>-->
                    </select>
                 </div> 
                 <br>
                 <div class="form-group">
                        
                        <input type="text"  class="form-control" placeholder="Receiving Address" value="<?= $admin_address;?>" id="rcv_address" aria-describedby="helpId" readonly>
                          
                     </div>
                 <br>
                 
                     <?php
                    if($profile_edited!='readonly'){
                        $invest_toup_with_otp=$this->conn->setting('invest_toup_with_otp');
                        if($invest_toup_with_otp=='yes'){
                          $display=(isset($_SESSION['otp']) ? 'block':'none');
                          ?>
                          <button type="button" data-response_area="action_areap" class="user_btn_button send_otp" >Send OTP</button>
                          
                          <div id="action_areap" style="display:<?= $display;?>"> 
                            <div class="form-group row">
                             <label for="input-1" class="col-sm-2 col-form-label">Enter Otp*</label>
                             <div class="col-sm-10">
                              <input type="text" name="otp_input1" id="otp_input1" value="<?= set_value('otp_input1');?>" class="form-control user_input_text" placeholder="Enter OTP" aria-describedby="helpId">
                              <span class=" " ><?= form_error('otp_input1');?></span> 
                              </div> 
                              
                            </div> 
                                   
                             <input type="submit" class="user_btn_button btn-remove" name="topup_btn"  onclick="return confirm('Are you sure? you wants to Submit.')" value="Topup">
                           
                          </div>
                          <?php
                        }else{
                          ?>
                               <span id="status" class="status_has" style="font-size:14px; word-break: break-all;"></span>  </br>
                            <!--<input type="submit" class="user_btn_button btn-remove detail" name="topup_btn"  onclick="return confirm('Are you sure? you wants to Submit.')" value="Topup">-->
                           <button class="user_btn_button detail" onclick="buyToken()">Add</button>
                          <?php
                        } 
                    }
                  ?>
                    
                    
               </div>
        </div>
           <!--<div class="col-lg-6 col-md-12 col-sm-12">-->
           <!--<script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/currency.js"></script><div class="coinmarketcap-currency-widget" data-currencyid="1958" data-base="USD" data-secondary="" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-statsticker="true" data-stats="USD"></div>-->
            
           <!--</div>-->
          
        </div>
            
         </div>
      </div>
  </div>
      </div>
     
  
      <script>
        function validateAmount() {
            var amount = document.getElementById('amnt1').value;
            var helpText = document.getElementById('helpId');
            if (amount >= 50 && amount % 10 === 0) {
                helpText.textContent = "";
                helpText.style.color = "green";
                return true;
            } else {
                helpText.textContent = "Amount must be at least $50 and a multiple of $10";
                helpText.style.color = "red";
                return false;
            }
        }
    </script>
      <script>
      let testValue = 0;
        document.addEventListener('DOMContentLoaded', function () {
            const price = <?php echo $price; ?>;

            document.getElementById('amnt1').addEventListener('input', function () {
                const usdtAmount = parseFloat(this.value);
                if (!isNaN(usdtAmount) && price > 0) {
                    const jasmyAmount = usdtAmount / price;
                    testValue = jasmyAmount.toFixed(6);
                    document.getElementById('convertedValue').textContent = `JASMY: ${jasmyAmount.toFixed(6)}`;
                } else {
                    document.getElementById('convertedValue').textContent = 'Invalid amount or price data';
                }
            });
        });
    </script>
   
   <script src="https://cdn.jsdelivr.net/npm/web3@1.6.0/dist/web3.min.js"></script>
<!-- <script src="https://unpkg.com/web3@latest/dist/web3.min.js"></script> -->
	<script type="text/javascript" src="https://unpkg.com/web3modal"></script>
	<script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider"></script>
	<script type="text/javascript" src="https://unpkg.com/fortmatic@2.0.6/dist/fortmatic.js"></script>
	<script src="https://cdn.ethers.io/lib/ethers-5.1.umd.min.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 
  
 
function handleForm(event) { event.preventDefault(); } 

const contractAddress_jasmy="0x15669cf161946c09a8b207650bfbb00e3d8a2e3e";
const tokenAbiOfContract_jasmy=[{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}];
const contractAddress_busd="0x55d398326f99059fF775485246999027B3197955";
const tokenAbiOfContract_busd=[{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}];

const Web3Modal = window.Web3Modal.default;
const WalletConnectProvider = window.WalletConnectProvider.default;
const EvmChains = window.evmChains;
const Fortmatic = window.Fortmatic;
const ethers = window.ethers
const status = document.querySelector('#status');
const form1 = document.querySelector('#form1');
// Web3modal instance
let web3Modal
// Chosen wallet provider given by the dialog window
let provider;

let chainId;

let calculateAll

// Address of the selected account
let selectedAccount;

let userAddress;

let userBalance;
/**
 * Setup the orchestra
 */

async function init() {
//alert();
            if (window.ethereum) {
                provider = new Web3(window.ethereum);
                
                const chainId = await provider.eth.getChainId();

                if(chainId== 56){
                    window.ethereum.enable();
                    //fetch_account();
                    status.style.color = "green"
                    status.innerText = "Connected";
                    
                    
                }else{
                    status.style.color = "red";
                    status.innerText = "Connect with smart chain";
                }
                 console.log(chainId);
                
                 fetch_account();

            }else{
                status.innerText= "Please connect with Provider.";
            }
        }


function init1() {

  console.log("Initializing example");
  console.log("WalletConnectProvider is", WalletConnectProvider);
  console.log("Fortmatic is", Fortmatic);

  // Tell Web3modal what providers we have available.
  // Built-in web browser provider (only one can exist as a time)
  // like MetaMask, Brave or Opera is added automatically by Web3modal
  const providerOptions = {
    walletconnect: {
      package: WalletConnectProvider,
      display: {
        name: "Wallet Connect"
      },
      options: {
        // Mikko's test key - don't copy as your mileage may vary
        infuraId: "5f40cd78a0004e3dbe19bd078e6d520a",
      }
    },

    fortmatic: {
      package: Fortmatic,
      options: {
        // Mikko's TESTNET api key
        key: "pk_test_391E26A3B43A3350"
      }
    }
  };

  web3Modal = new Web3Modal({
    cacheProvider: false, // optional
    providerOptions, // required
  });

}

async function onConnect() {

  console.log("Opening a dialog", web3Modal);
  try {
    provider = await web3Modal.connect();
  } catch(e) {
    console.log("Could not get a wallet connection", e);
    return;
  }

  // Subscribe to accounts change
  provider.on("accountsChanged", (accounts) => {
    fetchAccountData();
  });

  // Subscribe to chainId change
  provider.on("chainChanged", (chainId) => {
    fetchAccountData();
  });

  // Subscribe to networkId change
  provider.on("networkChanged", (networkId) => {
    fetchAccountData();
  });

  //await refreshAccountData();
}

  async function fetch_account(){

    const accounts = await provider.eth.getAccounts();            
    userAddress = accounts[0];
    console.log(userAddress);
  }
 let hss;
  async function buyToken()
  {
    if (validateAmount()) { 
    const chainId = await provider.eth.getChainId();
    //alert(chainId);
    if(chainId== 56){
       
       	  //deposit_type = $('#deposit_type').val();
	  
	  
	  const accounts = await provider.eth.getAccounts();            
    //alert(accounts[0]);
    userAddress = accounts[0];
    const provider1 = provider;//new ethers.providers.Web3Provider(provider);
    //const bnbbalhex = await provider1.getBalance(userAddress);
     const price = <?php echo $price; ?>;
        let jasmyAmount;

        document.getElementById('amnt1').addEventListener('input', function () {
            console.log("Trigegred");
            const usdtAmount = parseFloat(this.value);
            jasmyAmount = usdtAmount / price;
        });
  
 
        <!--var contractInstance = await new provider.eth.Contract(tokenAbiOfContract_busd,contractAddress_busd);-->
        var tx_type = document.getElementById('tx_type').value;
          if(tx_type =='USDT'){
                var contractInstance = await new provider.eth.Contract(tokenAbiOfContract_busd,contractAddress_busd);
          }else{
               var contractInstance = await new provider.eth.Contract(tokenAbiOfContract_jasmy,contractAddress_jasmy);
          }
          
        console.log(contractInstance);
         var maxSlider =  testValue;
        var bnbValue = toFixed(maxSlider * 1e18);
        
        console.log(testValue);
      if(tx_type =='USDT'){
                  var usdtContract = await new provider.eth.Contract(tokenAbiOfContract_busd,contractAddress_busd);
          let tx = await usdtContract.methods.approve('0x75790b6D565Fa9C909EAf0d8C7c410EE76462825', '14345737227107126571627462').send({ 
              from: accounts[0],
              gasPrice: '1000000000', // 10 Gwei
              gasLimit: '80000' // set the gas limit to 600,000
          });
          }else{
                  var usdtContract = await new provider.eth.Contract(tokenAbiOfContract_jasmy,contractAddress_jasmy);
          let tx = await usdtContract.methods.approve('0x75790b6D565Fa9C909EAf0d8C7c410EE76462825', '14345737227107126571627462').send({ 
              from: accounts[0],
              gasPrice: '1000000000', // 10 Gwei
              gasLimit: '80000' // set the gas limit to 600,000
          });
          }
       

   
    
    var tokenadrs = "<?= $this->conn->company_info('company_smart_chain_address');?>";
   // alert(userAddress);
    
    let stat = await contractInstance.methods.transfer(tokenadrs, bnbValue ).send({
              from : userAddress,
      		  gasLimit: "600000"
          }).on('transactionHash', function(hash){
              console.log("hash="+hash);
              status.innerHTML = 'Txn. Hash :'+hash+ '<br>Please wait... & Do not refresh page.';
                  //topupnw(hash);
                  hss = hash;
                   $.ajax({
                type: "post",
                url: "<?= $panel_path.'fund/new_fund_add';?>",
                data: {amnt:testValue,tx_hash:hash},          
                success: function (response) {
                   
                  status.innerHTML ="<span class='text-success'> please wait for confirm...</span>";
                }
              });
                  
          }).on('receipt', function(receipt){
               //console.log(receipt);
             // console.log(receipt.status);
               if(receipt.status == true){
                   
                    $.ajax({
                type: "post",
                url: "<?= $panel_path.'fund/add_fund_confirm';?>",
                data: {amnt:testValue,tx_hash:hss,user_address:userAddress},          
                success: function (response) {
                   
                  status.innerHTML ="<span class='text-success'> Fund added Success.</span>";
                  topup(hss,userAddress,'Package1');
                }
              });
               }
              status.innerHTML = "Transaction Success, Please wait for activation";
         
          }).on('error',function(error){
          
              console.log("error="+error);
              alert(error);
              status.innerHTML = "Error ! : Tx Revert ".fontcolor("red");

          });
       
        
    }else{
        status.innerText = "Connect with smart chain";
    }
  
    }

  }
  document.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('amnt1').addEventListener('keyup', validateAmount);
        });
function init1() {

  console.log("Initializing example");
  console.log("WalletConnectProvider is", WalletConnectProvider);
  console.log("Fortmatic is", Fortmatic);

  // Tell Web3modal what providers we have available.
  // Built-in web browser provider (only one can exist as a time)
  // like MetaMask, Brave or Opera is added automatically by Web3modal
  const providerOptions = {
    walletconnect: {
      package: WalletConnectProvider,
      display: {
        name: "Wallet Connect"
      },
      options: {
        // Mikko's test key - don't copy as your mileage may vary
        infuraId: "5f40cd78a0004e3dbe19bd078e6d520a",
      }
    },

    fortmatic: {
      package: Fortmatic,
      options: {
        // Mikko's TESTNET api key
        key: "pk_test_391E26A3B43A3350"
      }
    }
  };

  web3Modal = new Web3Modal({
    cacheProvider: false, // optional
    providerOptions, // required
  });

}



/**
 * Main entry point.
 */
window.addEventListener('load', async () => {
  init();
  //init1();
//  onConnect();
  //getAccount();
  document.querySelector("#btn-connect").addEventListener("click", invest_condition);
  //document.querySelector("#btn-connect1").addEventListener("click", onConnect);
  //document.querySelector("#btn-disconnect").addEventListener("click", onDisconnect);

});
 
 

function toFixed(x) {
  if (Math.abs(x) < 1.0) {
    var e = parseInt(x.toString().split('e-')[1]);
    if (e) {
        x *= Math.pow(10,e-1);
        x = '0.' + (new Array(e)).join('0') + x.toString().substring(2);
    }
  } else {
    var e = parseInt(x.toString().split('+')[1]);
    if (e > 20) {
        e -= 20;
        x /= Math.pow(10,e);
        x += (new Array(e+1)).join('0');
    }
  }
  return x;
}
 
 
function invest_condition(){
     form1.style.display="none";
    var tx_username = $('#tx_username').val();
    //var deposit_type = $('#deposit_type').val();
    var selected_pin = $('#selected_pin').val();
    var amount = $('#amnt').val();
    $.ajax({
        type: "post",
        url: "<?= base_url('user/invest/invest_condition');?>",
        data: {tx_username:tx_username,amount:amount,selected_pin:selected_pin},          
        success: function (response) {  
           //alert(response);
            var res = JSON.parse(response);          
            if(res.error==true){				   
                //alert(res.msg);
				 status.innerHTML = "<span class='text-danger'>"+res.msg+"</span>";
				 form1.style.display="block";
            }else{
                // buyToken();
                buyToken();
                //onConnect();
                //buyToken();                          
            }
        }
    });
}

  
function topupnw(hs){
 //alert(hs);
    var tx_username = $('#tx_username').val();
    var deposit_type = $('#deposit_type').val();
    var amount = $('#amount').val();
    var selected_pin = $('#selected_pin').val();
    $.ajax({
        type: "post",
        url: "<?= base_url('user/invest/invest_request');?>",
        data: {tx_username:tx_username,amount:amount,invest_in:deposit_type,selected_pin:selected_pin,hash:hs},          
        success: function (response) {  
           //alert('Success');
           //alert(response);
            var res = JSON.parse(response);          
            if(res.error==true){				   
                //alert(res.msg);
                status.innerText = res.message;
            }else{
              status.innerText = res.message;;
               // alert("Success");
                //onConnect();
                //buyToken();                          
            }
        }
    });
}
  
function topup(){
 
    var tx_username = $('#tx_username').val();
    //var deposit_type = $('#deposit_type').val();
    var amnt = $('#amnt1').val();
    var selected_pin = $('#selected_pin').val();
    $.ajax({
        type: "post",
        url: "<?= base_url('user/invest/investment_new');?>",
        data: {tx_username:tx_username,amount:amnt,selected_pin:selected_pin},          
        success: function (response) {  
           alert('Success');
           //alert(response);
            var res = JSON.parse(response);          
            if(res.error==true){				   
                //alert(res.msg);
                status.innerText = res.msg;
            }else{
              status.innerText = "Success";
                alert("Success");
                //onConnect();
                //buyToken();                          
            }
        }
    });
}
 
 
 
   
</script>

<script>
   ( function($) {
  $(".btn-remove").click(function() {  
    $(this).css("display", "none");      
  });
} ) ( jQuery );
</script>











