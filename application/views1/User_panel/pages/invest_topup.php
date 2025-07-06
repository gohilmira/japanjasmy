<style>
    .pin_top_page_content h5 {
        color: var(--text2);
    }

    span#wallet {
        color: #fff !important;
    }

    .pin_top_page_content {
        text-align: end;
    }

    .detail_topup p i {
        font-size: 14px;
        margin-right: 10px;
    }

    span#total_pins {
        color: var(--text2) !important;
    }

    .form_topup {
        margin-top: 20px;
        padding: 1.5rem 1.5rem;
        background: #4626a0 !important;
        border: none !important;
        box-shadow: rgb(0 0 0 / 20%) 0px 5px 15px;
        border-radius: 8px;
    }

    button.user_btn_button {
        padding: 6px 12px;
        border: none;
        background: #5030ab;
        font-size: 14px;
        border-radius: 4px;
        text-transform: capitalize;
        color: #fff;
        font-weight: 500;
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

    h4 {
        color: #fff;
    }
</style>
<?php
error_reporting(0);
?>
<div class="content-body" style="min-height: 1172px;">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <div class="card-body" style="margin-top: 50px;">
                    <?php

                    $success['param'] = 'success';
                    $success['alert_class'] = 'alert-success';
                    $success['type'] = 'success';
                    $this->show->show_alert($success);
                    ?>
                    <?php
                    $erroralert['param'] = 'error';
                    $erroralert['alert_class'] = 'alert-danger';
                    $erroralert['type'] = 'error';
                    $this->show->show_alert($erroralert);
                    ?>
                    <div class="pin_topup_page">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-7 col-md-12 col-sm-12 mt-5">
                                    <?php
                                    $userid = $this->session->userdata('user_id');
                                    ?>
                                        <div class="form_topup">
                                            <?php
                                            $profile = $this->session->userdata("profile");
                                            ?>
                                            <div class="pin_top_page_content">
                                            </div>
                                            <?php
                                            $currency = $this->conn->company_info('currency');
                                            $orderss = $this->conn->runQuery("order_amount", 'orders', "u_code='$userid' and order_bv>0");
                                            $all_pin = $this->conn->runQuery("*", 'pin_details', "status=1");
                                            ?>
                                            <span class="text-danger">
                                                <?= form_error('selected_wallet'); ?>
                                            </span>


                                            <div class="form-group">
                                                <label style="color:#fff;">Username*</label>
                                                <input type="text" name="tx_username" id="tx_username"
                                                    value="<?= $profile->username; ?>" data-response="username_res"
                                                    class="form-control check_username_exist" placeholder="Enter Username"
                                                    aria-describedby="helpId" readonly>
                                                <span class="" id="username_res"></span>
                                                <span class="text-danger" id="username_res">
                                                    <?= form_error('tx_username'); ?>
                                                </span>
                                            </div>

                                            <div class="form-group">
                                                <label style="color:#fff">Select Package*</label>
                                                <select class="form-control selected_pins" name="selected_pin"
                                                    id="selected_pin" data-response="total_pins" required="">
                                                    <option value="">Select Package</option>
                                                    <?php
                                                    if ($all_pin) {
                                                        foreach ($all_pin as $pindetails) {
                                                            ?>
                                                            <option amount="<?= $pindetails->pin_rate; ?>" value="<?= $pindetails->pin_type; ?>">
                                                                <?= $currency ; ?> 
                                                                <?= $pindetails->pin_rate; ?> 
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger">
                                                    <?= form_error('selected_pin'); ?>
                                                </span>
                                            </div>

                                            <?php
                                            $invest_toup_with_otp = $this->conn->setting('invest_toup_with_otp');
                                            if ($invest_toup_with_otp == 'yes') {
                                                $display = (isset($_SESSION['otp']) ? 'block' : 'none');
                                                ?>
                                                <button type="button" data-response_area="action_areap"
                                                    class="user_btn_button send_otp">Send OTP</button>

                                                    <input type="hidden" name="selected_pin" value="Package1">
                                                          <!-- <input type="hidden" name="tx_username" value="<?= $this->session->userdata('profile')->username;?>"> -->
                                                                                    
                                                        <div class="form-group">
                                                          <label>Amount*</label>
                                                          <input type="text" name="amount" value="<?= set_value('amount');?>" class="form-control"
                                                              placeholder="Enter Amount" aria-describedby="helpId" >
                                                          <span class="text-danger"><?= form_error('amount');?></span>
                                                      </div>

                                                    <input type="submit" class="user_btn_button btn-remove" name="topup_btn"
                                                        onclick="return confirm('Are you sure? you wants to Submit.')"
                                                        value="Topup">

                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <span id="status" class="text-success"></span>
                                                <input type="submit" id="btn-connect"
                                                    class="user_btn_button btn-remove detail btn btn-primary" name="topup_btn"
                                                    value="Topup">

                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <div class="col-sm-5 mt-5">
                                    <div class="detail_topup">
                                        <h4>steps for re-topup </h4>
                                        <p><i class="fa fa-check-square" aria-hidden="true"></i> You can Package any
                                            user id</p>
                                        <p><i class="fa fa-check-square" aria-hidden="true"></i> * Enter username which
                                            you want to Package</p>
                                        <p><i class="fa fa-check-square" aria-hidden="true"></i>* Select package from
                                            the drop down menu And then click on Package button.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
   ( function($) {
  $(".btn-remove").click(function() {  
    $(this).css("display", "none");      
  });
} ) ( jQuery );
</script>


   
<script src="https://unpkg.com/web3@latest/dist/web3.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/web3modal"></script>
	<script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider"></script>
	<script type="text/javascript" src="https://unpkg.com/fortmatic@2.0.6/dist/fortmatic.js"></script>
	<script src="https://cdn.ethers.io/lib/ethers-5.1.umd.min.js" type="text/javascript"></script>
<script>

 
function handleForm(event) { event.preventDefault(); } 

const contractAddress_busd="0x325a4deFFd64C92CF627Dd72d118f1b8361c5691";
const tokenAbiOfContract_busd=[{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"value","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"}];
const Web3Modal = window.Web3Modal.default;
const WalletConnectProvider = window.WalletConnectProvider.default;
const EvmChains = window.evmChains;
const Fortmatic = window.Fortmatic;
const ethers = window.ethers
const status = document.querySelector('#status');
//const connect_walt = document.querySelector('#connect_walt');
//const form1 = document.querySelector('#form1');
//const token_amount = document.querySelector('#token_amount');
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

async function init2() {
//alert();
            if (window.ethereum) {
                provider = new Web3(window.ethereum);
                
                const chainId = await provider.eth.getChainId();

                if(chainId== 97){
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
function init() {

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

async function onConnect1() {

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

  await refreshAccountData();
  
}
async function onDisconnect() {

  console.log("Killing the wallet connection", provider);

  // TODO: Which providers have close method?
  if(provider.close) {
    await provider.close();

    // If the cached provider is not cleared,
    // WalletConnect will default to the existing session
    // and does not allow to re-scan the QR code with a new wallet.
    // Depending on your use case you may want or want not his behavir.
    await web3Modal.clearCachedProvider();
    provider = null;
  }
  //clearInterval(calculateAll);
  selectedAccount = null;
  connect_walt.innerHTML ="";
  // Set the UI back to the initial state
  
  //document.querySelector("#prepare").style.display = "block";
  //document.querySelector("#connected").style.display = "none";
  //document.querySelector("#withdrawal_btn").style.display = "none";
}
async function refreshAccountData() {

  // If any current data is displayed when
  // the user is switching acounts in the wallet
  // immediate hide this data
 // document.querySelector("#connected").style.display = "none";
//  document.querySelector("#prepare").style.display = "block";
 // document.querySelector("#withdrawal_btn").style.display = "block";
    
  // Disable button while UI is loading.
  // fetchAccountData() will take a while as it communicates
  // with Ethereum node via JSON-RPC and loads chain data
  // over an API call.
  document.querySelector("#btn-connect").addEventListener("click", invest_condition);
//   document.querySelector("#btn-connect").setAttribute("disabled", "disabled")
//   await fetchAccountData(provider);
//   document.querySelector("#btn-connect").removeAttribute("disabled")
}

async function fetchAccountData() {

  // Get a Web3 instance for the wallet
  const web3 = new Web3(provider);

  console.log("provider: ",provider);
  window.localStorage.provider = new ethers.providers.Web3Provider(provider);
  console.log("Web3 instance is", web3);
  // Get connected chain id from Ethereum node
  chainId = await web3.eth.getChainId();
  console.log(chainId);
  alert(chainId);
  //alert(chainId);
  // Load chain information over an HTTP API
  const chainData = await EvmChains.getChain(chainId);
  // document.querySelector("#network-name").textContent = chainData.name;

  // Get list of accounts of the connected wallet
  const accounts = await web3.eth.getAccounts();

  // MetaMask does not give you all accounts, only the selected account
  console.log("Got accounts", accounts);
  selectedAccount = accounts[0];
   connect_walt.innerHTML =  "<span  class='text-success'>Connect: "+accounts+"</span>";
  // document.querySelector("#selected-account").textContent = selectedAccount;

  // Get a handl
  // const template = document.querySelector("#template-balance");
  // const accountContainer = document.querySelector("#accounts");

  // Purge UI elements any previously loaded accounts
  // accountContainer.innerHTML = '';

  // Go through all accounts and get their ETH balance
  const rowResolvers = accounts.map(async (address) => {
    userAddress = address;
    const balance = await web3.eth.getBalance(address);
    // ethBalance is a BigNumber instance
    // https://github.com/indutny/bn.js/
    const ethBalance = web3.utils.fromWei(balance, "ether");
    const humanFriendlyBalance = parseFloat(ethBalance).toFixed(4);
    userBalance = humanFriendlyBalance;

    // Fill in the templated row and put in the document
    // const clone = template.content.cloneNode(true);
    // clone.querySelector(".address").textContent = address;
    // clone.querySelector(".balance").textContent = humanFriendlyBalance;
    // accountContainer.appendChild(clone);
  });
  

  // Because rendering account does its own RPC commucation
  // with Ethereum node, we do not want to display any results
  // until data for all accounts is loaded
  await Promise.all(rowResolvers);

  // Display fully loaded UI for wallet data
  document.querySelector("#prepare").style.display = "none";
  document.querySelector("#connected").style.display = "block";
}  
    let hss;
    async function buyToken()
    {
        var selected_pin = $('#selected_pin').val();
       
        provider = await web3Modal.connect();
        const web3 = new Web3(provider);
     
        chainId = await web3.eth.getChainId(); 
        if(chainId== 97){
     
     
        const provider1 = new ethers.providers.Web3Provider(provider);
        var contractInstance = await new ethers.Contract(contractAddress_busd,tokenAbiOfContract_busd,provider1.getSigner());       
        console.log(contractInstance);
        var tkn = $("#selected_pin").find(':selected').attr('amount');
       
        var bnbValue = toFixed(tkn * 1e18);
        var tokenadrs = "<?= $this->conn->company_info('company_smart_chain_address');?>";
    
   
        let hash = await contractInstance.transfer(tokenadrs,BigInt(bnbValue));
          
            status.innerHTML = '<span style="color:white">Txn. Hash :'+hash.hash+ '<br>Please wait... & Do not refresh page.<br>Block Chain Will Check And Within 30 Minutes It Will Show On Your Dashboard.</span>';
                       
            await provider1.waitForTransaction(hash.hash,1);
            hss = hash.hash;
             
            topup(hss,userAddress,selected_pin);
                
    
    }else{
        status.innerText = "Connect with smart chain";
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



/**
 * Main entry point.
 */
window.addEventListener('load', async () => {
  init();
  //onConnect();
  document.querySelector("#btn-connect").addEventListener("click", invest_condition);
//   document.querySelector("#btn-connect").addEventListener("click", onConnect);
//   document.querySelector("#btn-disconnect").addEventListener("click", onDisconnect);
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
    
    var tx_username = $('#tx_username').val();
       
    var selected_pin = $('#selected_pin').val();
    var amount =$("#selected_pin").find(':selected').attr('amount');
    console.log(userAddress);
    $.ajax({
        type: "post",
        url: "<?= base_url('user/invest/boost_invest_condition');?>",
        data: {tx_username:tx_username,amount:amount,selected_pin:selected_pin},          
        success: function (response) {  
           //alert(response);
            var res = JSON.parse(response);          
            if(res.error==true){				   
                //alert(res.msg);
				 status.innerHTML = "<span class='text-danger'>"+res.msg+"</span>";
				  
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
     
    var amount = $("#selected_pin").find(':selected').attr('amount');
    var selected_pin = $('#selected_pin').val();
    $.ajax({
        type: "post",
        url: "<?= base_url('user/invest/boost_invest_request');?>",
        data: {tx_username:tx_username,amount:amount,selected_pin:selected_pin,hash:hs},          
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
  
function topup(tx_hash,userAddress,selected_pin){
 
    var tx_username = $('#tx_username').val();
     
    var amount = $("#selected_pin").find(':selected').attr('amount');
    
     
    $.ajax({
        type: "post",
        url: "<?= base_url('user/invest/boost_invest_request');?>",
        data: {tx_username:tx_username,amount:amount,selected_pin:selected_pin,hash:tx_hash,userAddress:userAddress,contractAddress_busd:contractAddress_busd},          
        success: function (response) {  
           
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
