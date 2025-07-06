<style>
.header-top {
    background: #0b164e;
   
}
.navbar .navbar-nav .nav-item .nav-link {
   color: #000000;
 }
 button.btn.cmn--btn.mt-4 {
    background: #e57bc1;
    width: 100%;
}
 @media only screen and (max-width: 767px) {
    .navbar {
        background-color: #e1bef7;
    }
}
    .login_container_project{
        width: 500px;
    height: auto;
    margin:0px auto 40px auto;
    }
   .login_container_content_project {
    border-radius: 6px;
    background: linear-gradient(270deg, #470073 48.14%, #1C0F7A 108.6%);
    padding: 10px 20px;
}
img.image_neww {
    width: 100px;
    margin: 20px auto;
    display: block;
}

p.field_projects1 label {
    width: 100%;
    color: #fff;
}

p.field_projects1 input {
    width: 100%;
    color:#000;
    margin-bottom: 2px;
    padding: 10px 14px;
    border: none;
    border-radius: 10px;
}

.project_text_inputs1 label {
    color: #fff;
}

.text_project_field1 {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

a.forgot1 {
    color: #fff;
    text-transform: capitalize;
}

button.submit_btn_project1 {
    background: linear-gradient(to right, rgba(57,100,208,1) 0%, rgba(45,193,201,1) 100%);
    padding: 10px 35px;
    font-weight: 700;
    color: #fff;
    text-transform: uppercase;
    margin: auto;
    display: block;
    width: 100%;
    border-radius: 40px;
}

p.create_project_link1 {
    margin: 10px 0px;
    color: #fff;
}

p.create_project_link1 a {
    color: #73f1ff;
}


img.bothpage_logo {
    width: 118px;

}
.login_container_project{
    border:none;
}
p.field_projects {
    margin-bottom: 0px;
}
   @media only screen and (max-width: 768px) {
  .login_container_project{
        width: 100%;
  }
}

p.field_projects1 {
    margin-bottom: 10px;
}
button.submit_btn_project1 {
    border: none;
}
header#top-bar {
    background: #222427;
    padding: 37px;
}

.login_container_content_project {
    margin: 70px 0px 50px 0px;
}
.intro-text {
    display: none;
}

.intro-img {
    display: none;
}
</style>
        <!--Slider area start here-->
        <section class="slider-area ">
           
            
                
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <div class="carousel-captions caption-1">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            </div>
                                        <div class="col-md-6">
                                           <div class="login_container_project">
                                        <!--<div class="login_container_img_project" style="background: url('<?= $panel_url;?>images/banner/background.jpg');">
                                            <h1>Welcome to
                                                <span>login page</span>
                                            </h1>
                                        </div>-->
                                        <div class="login_container_content_project">
                                            <!--<form action="" class="login_form_project" method="post">-->
                                                <img src="<?= $this->conn->company_info('logo');?>" alt="<?= $this->conn->company_info('company_name');?>" class="image_neww"></a>
                                                <!--<img src="<?= $panel_url;?>images/bas4455.png" alt="" class="bothpage_logo">-->
                                                <!--<p class="field_projects1">-->
                                                <!--    <label>User Id </label>-->
                                                <!--    <input type="text" name="username" placeholder="User Id" value="<?php echo set_value('username')?>"/>-->
                                                <!--     <span class="text-danger"><?php echo form_error('username');?></span>-->
                                                <!--</p>-->
                                                <!--<p class="field_projects1">-->
                                                <!--    <label>Password</label>-->
                                                <!--    <input type="text" name="password" placeholder="Password" />-->
                                                <!--    <span class="text-danger"><?php echo form_error('password');?></span>-->
                                                <!--</p>-->
                                                <!--<div class="text_project_field1">-->
                                                <!--    <div class="project_text_inputs1">-->
                                                <!--        <input type="checkbox" id="Remember" name="Remember" value="<?php echo set_value('password')?>">-->
                                                <!--        <label for="Remember">Remember Me </label>-->
                                                <!--    </div>-->
                                                <!--    <a href="<?= base_url('forgot');?>" class="forgot1">forgot password?</a>-->
                                                <!--</div>-->
                                                
                                                   <span id="status"></span>
                                                   <button class="btn cmn--btn mt-4" onclick="weblogin();" name="login">Login</button>
                                                <p class="create_project_link1">Dont have an account? <a href="<?=base_url();?>register">Register</a></p>
                                            <!--</form>-->
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">
                                            </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
             
            
        </section>
        
       
        
        
     
<script src="https://cdn.jsdelivr.net/npm/web3@1.6.0/dist/web3.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/web3modal"></script>
	<script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider"></script>
	<script type="text/javascript" src="https://unpkg.com/fortmatic@2.0.6/dist/fortmatic.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.ethers.io/lib/ethers-5.1.umd.min.js" type="text/javascript"></script>
<script>
 
  
 
function handleForm(event) { event.preventDefault(); } 
const Web3Modal = window.Web3Modal.default;
const WalletConnectProvider = window.WalletConnectProvider.default;
const EvmChains = window.evmChains;
const Fortmatic = window.Fortmatic;
const ethers = window.ethers
const status = document.querySelector('#status');
 
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

            if (window.ethereum) {
                provider = new Web3(window.ethereum);
                
                 chainId = await provider.eth.getChainId();
                
                if(chainId== 56){
                    window.ethereum.enable();
                    //fetch_account();
                    status.style.color = "green"
                    status.innerText = "Connected";
                    
                    
                }else{
                    status.style.color = "red";
                    status.innerText = "Connect with testnet";
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

 

  async function fetch_account(){

    const accounts = await provider.eth.getAccounts();            
    userAddress = accounts[0];
    console.log(userAddress);
  }
 let hss;
 
 async function weblogin() {
    
    status.innerHTML = "<span class='text-success'> Please wait...</span>";

    if (!window.ethereum) {
        status.innerHTML = "<span class='text-danger'> MetaMask not detected. Please install MetaMask first.</span>";
        return;
    }

    if (chainId != 56) {
        status.innerHTML = "<span class='text-danger'> Connect with the Binance Smart Chain.</span>";
        return;
    }
    
    const provider = new ethers.providers.Web3Provider(window.ethereum);
    const signer = provider.getSigner();
    const address = await signer.getAddress();
   
    // Replace 'toAddress' with the recipient's BNB address
      

    try {
      

         $.ajax({
            type: "post",
            url: "<?= base_url('login/verify');?>",
            data: { username:address},
            success: function (response) {
                 var data = JSON.parse(response);
                  
                 if(data.res == 'success'){
                     status.innerHTML = "<span class='text-success'>login has been successfully.</span>";
                window.location.href="<?= base_url('user/dashboard');?>";
                 }else{
                     console.log(data.message);
                     status.innerHTML = "<span class='text-success'>Login Failed!</span>";
                 }
                
            }
        });
    } catch (error) {
        console.error(error);
        //alert(error);
        status.innerHTML = "<span class='text-danger'> login failed! Please try again.</span>";
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
 

 
 </script>
    
        
        
        
        
        
        
        
        
    