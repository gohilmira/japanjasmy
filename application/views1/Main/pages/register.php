<style>
.header-top {
    background: #0b164e;
   
}
.intro-text {
    display: none;
}

.intro-img {
    display: none;
}
.navbar .navbar-nav .nav-item .nav-link {
   color: #000000;
 }
  @media only screen and (max-width: 767px) {
    .navbar {
        background-color: #e1bef7;
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
.error-massage-id p {
    color: red;
}
select#country_code {
    height: 50px;
    width: 100%;
    border-radius: 4px;
    padding: 10px;
}
.login_container_content_project {
    margin: 70px 0px 52px 0px;
}
        .login_container_project_register {
            width: 840px;
            height: 780px;
           
            margin: auto;
            
            margin-bottom: 20px;
            border: 1px solid #80808070;
        }
         .login_container_img_project {
            background-size: cover;
            height: 100%;
            flex: 50%;
            background-position: center;
             background-repeat: no-repeat;
        }
        
        .text_project_field a {
            text-transform: capitalize;
        }
        
        .login_container_img_project h1 {
            display: grid;
            text-align: center;
            color: white;
            margin-top: 58%;
            padding-left: 20px;
            padding-right: 20px;
            letter-spacing: 2px;
            margin-bottom: 10px;
            text-transform: capitalize;
        }
        
        .login_container_img_project h1 span {
            text-align: center;
            font-size: 16px;
        }
        
        .login_container_content_project {
            flex: 50%;
            background: white;
            text-align: center;
           
            align-items: center;
           
            padding: 10px;
        }
        
        form.login_form_project {
            padding: 2px;
            width: 100%;
        }
        p.field_projects {
   
    margin-bottom: 10px;
}
        .login_form_project h1 {
            text-transform: uppercase;
            font-size: 30px;
            margin-bottom: 26px
        }
        
        .submit_btn_project {
            width: 100%;
            display:block;
            padding:10px;
            position: relative;
            background: linear-gradient(to right, rgba(57, 100, 208, 1) 0%, rgba(45, 193, 201, 1) 100%);
            color: white;
            outline: none;
            border-style: none;
            border-radius: 15px;
            transition: 0.3s ease-in-out;
        }
        
        .text_project_field {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        p.field_projects label {
            width: 100%;
            text-align: initial;
            font-weight: 600;
        }
        
        p.field_projects input {
            outline: none;
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: 1px solid grey;
            width: 100%;
            margin-bottom:0px !important;
            padding:12px !important;
            border-radius:6px;
        }
        
        p.field_projects {
            text-align: initial;
        }
        
       
        @media screen and (max-width: 576px) {
    .login_container_project_register {
        flex-direction: column;
    }
    .login_container_project_register {
   
    margin-top: 31px;
   
}
    .login_container_img_project h1 {
        margin-top: 0px;
        padding: 69px;
       font-size: 29px;
        font-weight: 700;
    }
    .login_container_project_register {
        width: 100%;
        height:auto;
    }
    
}
p.create_project_link {
    color: #fff;
}

p.create_project_link a {
    color: #53e8f9;
}
.login_container_project_register{
    width: 500px;
    height: auto;
}

p.field_projects label {
   
    color: #fff;
}
p.field_projects input {
   
    color: #000;
}
    .login_container_project_register{
        width: 500px;
    height: auto;
    }
      .login_container_content_project {
    border-radius: 6px;
    background:linear-gradient(270deg, #470073 48.14%, #1C0F7A 108.6%);
    padding: 10px 20px;
}


img.bothpage_logo {
    width: 118px;

}
.login_container_project_register{
    border:none;
}
   @media only screen and (max-width: 768px) {
  .login_container_project_register{
        width: 100%;
  }
}
p.field_projects {
    position: relative;
}
input#mobile {
    padding-left: 48px !important;
}
span#mobile_code {
    position: absolute;
    top: 32px;
    background: #d1d1d1;
    padding: 10px 12px;
    height: 53px;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
    left: 0px;
}
input#mobile {
    padding-left: 55px !important;
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
        <div class="login_container_project_register">
            
            <div class="login_container_content_project">
                <!--<form action="<?= base_url('register');?>" class="login_form_project" method="post">-->
                <?php 
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
           ?><img src="<?= $this->conn->company_info('logo');?>" alt="<?= $this->conn->company_info('company_name');?>" style="width:<?php echo $this->conn->company_info('logo_width');?>;height:<?php echo $this->conn->company_info('logo_height');?>"></a>
                    <!--<img src="<?= $panel_url;?>images/bas4455.png" alt="" class="bothpage_logo">-->
                     <?php 
                        $requires=$this->conn->runQuery("*",'advanced_info',"title='Registration'");
                        $value_by_lebel= array_column($requires, 'value', 'label');
                    
                    
                        ?>
					
                   	<?php if(array_key_exists('is_sponsor_required', $value_by_lebel) && $value_by_lebel['is_sponsor_required']=='yes'){ ?>
                    <p class="field_projects">
                        <label>Sponsor</label>
                        <input type="text" name="u_sponsor" class="check_sponsor_exist no_space " id="u_sponsor" placeholder="Sponsor ID"  data-response="sponsor_res" value="<?php
                        if(isset($_REQUEST['ref'])){
                            echo $_REQUEST['ref'];
                        }else{
                            echo set_value('u_sponsor');
                        }
                        ?>" />
                        <small class="" id="sponsor_res"><?php echo form_error('u_sponsor');?></small>
                    </p>
                    	<?php } ?>
                    
                   
                    	<!--<p class="field_projects">
                        <label>Name</label>
                            <input autocomplete="off"  type="text" class="" autocomplete="none" id="name" autocomplete="none" name="name" placeholder="Name" data-response="name_res" value="<?php echo set_value('name');?>">
                            <div class="error-massage-id"  id="name_res">
                                  <?php echo form_error('name');?>
                            </div>
                        </p> 
                        
                        <p class="field_projects">
                        <label>BEP20 USDT Address</label>
                            <input autocomplete="off"  type="text" class="check_wallet_valid" autocomplete="none" id="wallet_address" autocomplete="none" name="wallet_address" placeholder="BEP20 USDT Address"  value="<?php echo set_value('wallet_address');?>">
                            <div class="error-massage-id" >
                                  <?php echo form_error('wallet_address');?>
                            </div>
                        </p> 
                        
                          <?php if(array_key_exists('country_code', $value_by_lebel) && $value_by_lebel['country_code']=='yes'){?>
                           <p class="field_projects">
                          <label>Select Country</label>
                                <select id="country_code" data-response="mobile_code" class="form-control select_data country" name="country_code"> 
                                    <option value="">Select Country</option>
                                        <?php
                                        $countries=$this->conn->runQuery('*','countries','1=1');
                                        if($countries){
                                            foreach($countries as $country){
                                                ?> <option data-sortname="<?= $country->sortname;?>" data-phonecode="<?= $country->phonecode;?>" value="<?= $country->name;?>"  ><?= $country->name;?></option><?php
                                            }
                                        }
                                        ?>
                                </select>
                          </P>
                        <?php } ?>
                        <p class="field_projects">
                             <span id="mobile_code" style="color:#000">0</span>
                        <label>Mobile</label>
                            <input autocomplete="off"  type="number" class="mobile no_space check_mobile_valid" autocomplete="none" id="mobile" name="mobile"  data-response="mobile_res" value="<?= set_value('mobile');?>" placeholder="Mobile" >
                            <div class="error-massage-id"  id="mobile_res">
                                  <?php echo form_error('mobile');?>
                            </div>
                        </p> 
                        
                        <p class="field_projects">
                        <label>Email</label>
                            <input autocomplete="off"  type="email" class="check_email_valid" autocomplete="none" id="email" name="email"  data-response="email_res" value="<?= set_value('email');?>" placeholder="Email" >
                            <div class="error-massage-id"  id="email_res">
                                  <?php echo form_error('email');?>
                            </div>
                        </p> 
                        
                        
                        <p class="field_projects">
                        <label>Password</label>
                            <input autocomplete="off"  type="password" class="no_space" autocomplete="none" id="password" name="password" placeholder="Password" data-response="password_res" value="<?php echo set_value('password');?>" >
                            <div class="error-massage-id"  id="password_res">
                                  <?php echo form_error('password');?>
                            </div>
                        </p> 
                        
                        
                        <p class="field_projects">
                        <label>Confirm Password</label>
                            <input autocomplete="off"  type="password" class="no_space" autocomplete="none" id="confirm_password" name="confirm_password" placeholder="Confirm Password" data-response="confirm_password_res" value="<?php echo set_value('confirm_password');?>">
                            <div class="error-massage-id"  id="confirm_password_res">
                                  <?php echo form_error('confirm_password');?>
                            </div>
                        </p>
                       -->
                       
                      <!--  <p class="field_projects">
                        <label>Transaction Password</label>
                            <input autocomplete="off"  type="password" class="no_space" autocomplete="none" id="tx_password" name="tx_password" placeholder="Transaction Password" data-response="tx_password_res" value="<?php echo set_value('tx_password');?>" >
                            <div class="error-massage-id"  id="tx_password_res">
                                  <?php echo form_error('tx_password');?>
                            </div>
                        </p> 
                       
                        <p class="field_projects">
                        <label>Confirm Transaction Password</label>
                            <input autocomplete="off"  type="password" class="no_space" autocomplete="none" id="confirm_tx_password" name="confirm_tx_password" placeholder="Confirm Transaction Password" data-response="confirm_tx_password_res" value="<?php echo set_value('confirm_tx_password');?>">
                            <div class="error-massage-id"  id="confirm_tx_password_res">
                                  <?php echo form_error('confirm_tx_password');?>
                            </div>
                        </p>
                        -->
                        
                    <span id="status"></span>
                    <button type="submit" class="submit_btn_project" onclick="register()" name="register">Register</button>
                    <p class="create_project_link">Already have an account ?<a href="<?=  base_url();?>login">login</a></p>
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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   <script type="text/javascript" src="https://unpkg.com/web3modal"></script>
   <script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
   <script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider"></script>
   <script type="text/javascript" src="https://unpkg.com/fortmatic@2.0.6/dist/fortmatic.js"></script>
   <script src="https://cdn.ethers.io/lib/ethers-5.1.umd.min.js" type="text/javascript"></script>
   <!-- Include jQuery from CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Include Bootstrap's JavaScript from CDN -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-BmbxuPwQa2lc/FNdD4Z0jDJjg0FndbERhrDHcz4v1/Z5bsAjzZ7Cu8x1JKb0UKV5" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

	<script src="https://unpkg.com/web3@latest/dist/web3.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>

   <script>
   
    
  
      function handleForm(event) { event.preventDefault(); }  
      
        
       //const spenderAddress  = "0x9Bf169563594dfC75c4C0ADBf24f63aCa7ED5d88";
    //  const spenderAddress  = "0x6d0B62d0fD0d68B1126063d6Ca64173145a9fB98"; //testing
     // const contractAddress_busd="0x76eBa1Ed175561ce732b82C13D0d103aaC59C365"; 
     // const contractAddress_busd="0x7B5E2af1a89a1a23D8031077a24A2454D81b3fbd"; //testing
   //  const tokenAbiOfContract_busd=[{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"renounceOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"}];
    //const tokenAbiOfContract_busd = [{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}];
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
      
      async function init() {
      
            if (window.ethereum) {
                provider = new Web3(window.ethereum);
                
                 chainId = await provider.eth.getChainId();
      console.log(chainId);
                if(chainId== 56){
                    window.ethereum.enable();
                    //fetch_account();
                    status.style.color = "green"
                    status.innerText = "Connected";
                    
                    
                }else{
                    status.style.color = "red";
                    status.innerText = "Connect With Mainnet chain";
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
      
      async function register() {
          
         
    try {
        status.innerHTML = "<span class='text-success'>Please wait...</span>";

        if (!window.ethereum) {
            throw new Error("<span class='text-danger'>MetaMask not detected. Please install MetaMask first.</span>");
        }
     
        if (chainId != 56) {
            throw new Error("<span class='text-danger'>Connect with Mainnet chain.</span>");
        }

        const provider = new ethers.providers.Web3Provider(window.ethereum);
        await provider.send("eth_requestAccounts", []);
        const address = await provider.getSigner().getAddress();

     
     
        const sponsor = document.getElementById('u_sponsor').value;
       /* const email = document.getElementById('email').value;
        const mobile = document.getElementById('mobile').value;
        const name = document.getElementById('name').value;*/
    
        
       

        // Your AJAX request goes here
        
        $.ajax({
            type: "post",
            url: '<?= base_url('register/register_with_dapp'); ?>',
            data: {register: 1, u_sponsor: sponsor,user_address:address},
            success: function(response) {
            //console.log(response);
            var resspn = JSON.parse(response);
            if(resspn.res == 'success'){
                     window.location.href="/user/dashboard"
                   // status.innerHTML = "<span class='text-success'>Your add fund request on the blockchain has been received and is currently undergoing verification for confirmation.Please Refresh page and check your fund wallet</span>";
            }else{
                   status.innerHTML = "<span class='text-success'>" + resspn.message + "</span>";
            }
                <!--console.log("Server response:", response);-->
                
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                status.innerHTML = "<span class='text-danger'>Error processing your request. Please try again later.</span>";
            },
            complete: function() {
                // Remove the loader or perform any cleanup
            }
        });

        status.innerHTML = "<span class='text-success'>Register successful!</span>";
    } catch (error) {
        console.error("Error:", error);
        status.innerHTML = error.message || "<span class='text-danger'>Error processing your request. Please try again later.</span>";
    }
}

       
    function showLoader() {
        // Add the loader element to the status container
        status.innerHTML = "<div class='loader'></div>";
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
     // document.querySelector("#btn-connect").addEventListener("click", invest_condition);
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
     
</script>

	