const abi = [{ "inputs": [], "stateMutability": "nonpayable", "type": "constructor" }, { "anonymous": false, "inputs": [{ "indexed": true, "internalType": "address", "name": "owner", "type": "address" }, { "indexed": true, "internalType": "address", "name": "spender", "type": "address" }, { "indexed": false, "internalType": "uint256", "name": "value", "type": "uint256" }], "name": "Approval", "type": "event" }, { "anonymous": false, "inputs": [{ "indexed": true, "internalType": "address", "name": "previousOwner", "type": "address" }, { "indexed": true, "internalType": "address", "name": "newOwner", "type": "address" }], "name": "OwnershipTransferred", "type": "event" }, { "anonymous": false, "inputs": [{ "indexed": true, "internalType": "address", "name": "from", "type": "address" }, { "indexed": true, "internalType": "address", "name": "to", "type": "address" }, { "indexed": false, "internalType": "uint256", "name": "value", "type": "uint256" }], "name": "Transfer", "type": "event" }, { "inputs": [{ "internalType": "address", "name": "owner", "type": "address" }, { "internalType": "address", "name": "spender", "type": "address" }], "name": "allowance", "outputs": [{ "internalType": "uint256", "name": "", "type": "uint256" }], "stateMutability": "view", "type": "function" }, { "inputs": [{ "internalType": "address", "name": "spender", "type": "address" }, { "internalType": "uint256", "name": "amount", "type": "uint256" }], "name": "approve", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "stateMutability": "nonpayable", "type": "function" }, { "inputs": [{ "internalType": "address", "name": "account", "type": "address" }], "name": "balanceOf", "outputs": [{ "internalType": "uint256", "name": "", "type": "uint256" }], "stateMutability": "view", "type": "function" }, { "inputs": [{ "internalType": "uint256", "name": "amount", "type": "uint256" }], "name": "burn", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "stateMutability": "nonpayable", "type": "function" }, { "inputs": [], "name": "decimals", "outputs": [{ "internalType": "uint8", "name": "", "type": "uint8" }], "stateMutability": "view", "type": "function" }, { "inputs": [{ "internalType": "address", "name": "spender", "type": "address" }, { "internalType": "uint256", "name": "subtractedValue", "type": "uint256" }], "name": "decreaseAllowance", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "stateMutability": "nonpayable", "type": "function" }, { "inputs": [], "name": "getOwner", "outputs": [{ "internalType": "address", "name": "", "type": "address" }], "stateMutability": "view", "type": "function" }, { "inputs": [{ "internalType": "address", "name": "spender", "type": "address" }, { "internalType": "uint256", "name": "addedValue", "type": "uint256" }], "name": "increaseAllowance", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "stateMutability": "nonpayable", "type": "function" }, { "inputs": [{ "internalType": "string", "name": "name", "type": "string" }, { "internalType": "string", "name": "symbol", "type": "string" }, { "internalType": "uint8", "name": "decimals", "type": "uint8" }, { "internalType": "uint256", "name": "amount", "type": "uint256" }, { "internalType": "bool", "name": "mintable", "type": "bool" }, { "internalType": "address", "name": "owner", "type": "address" }], "name": "initialize", "outputs": [], "stateMutability": "nonpayable", "type": "function" }, { "inputs": [{ "internalType": "uint256", "name": "amount", "type": "uint256" }], "name": "mint", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "stateMutability": "nonpayable", "type": "function" }, { "inputs": [], "name": "mintable", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "stateMutability": "view", "type": "function" }, { "inputs": [], "name": "name", "outputs": [{ "internalType": "string", "name": "", "type": "string" }], "stateMutability": "view", "type": "function" }, { "inputs": [], "name": "renounceOwnership", "outputs": [], "stateMutability": "nonpayable", "type": "function" }, { "inputs": [], "name": "symbol", "outputs": [{ "internalType": "string", "name": "", "type": "string" }], "stateMutability": "view", "type": "function" }, { "inputs": [], "name": "totalSupply", "outputs": [{ "internalType": "uint256", "name": "", "type": "uint256" }], "stateMutability": "view", "type": "function" }, { "inputs": [{ "internalType": "address", "name": "recipient", "type": "address" }, { "internalType": "uint256", "name": "amount", "type": "uint256" }], "name": "transfer", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "stateMutability": "nonpayable", "type": "function" }, { "inputs": [{ "internalType": "address", "name": "sender", "type": "address" }, { "internalType": "address", "name": "recipient", "type": "address" }, { "internalType": "uint256", "name": "amount", "type": "uint256" }], "name": "transferFrom", "outputs": [{ "internalType": "bool", "name": "", "type": "bool" }], "stateMutability": "nonpayable", "type": "function" }, { "inputs": [{ "internalType": "address", "name": "newOwner", "type": "address" }], "name": "transferOwnership", "outputs": [], "stateMutability": "nonpayable", "type": "function" }];

let metaMaskAddressBase58;
window.onload = connect();
function connect() {
    if (typeof web3 !== 'undefined') {
        request();
        $("#loadingSpinner").hide();
    }
    else {
        swal('Alert!', "Install a web3 enabled Wallet. For Ex: Metamask", 'warning');
    }
}

function request() {
    ethereum.enable()
        .then(function (accounts) {
        })
        .catch(function (reason) {
            swal('Alert!', "Connection Request Rejected!", 'warning');
        })
}

async function signin() {
    if (typeof web3 !== 'undefined') {

        try {
            document.getElementById("signindashboard").disabled = true;
            $("#signindashboard").html('Please wait...');

            let metaMaskAddress = metaMaskAddressBase58;
            var txtCity = $("#txtCity").val();
            var txtCountry = $("#txtCountry").val();
            var txtRegion = $("#txtRegion").val();
            var txtLoginip = $("#txtLoginip").val();
            var odL1 = new FormData();
            odL1.append("WalletAddress", metaMaskAddress);
            odL1.append("txtCity", txtCity);
            odL1.append("txtCountry", txtCountry);
            odL1.append("txtRegion", txtRegion);
            odL1.append("txtLoginip", txtLoginip);
            $.ajax({
                url: "Huiyui76jhjk4d/SCVNConnect/Logintodashboard.ashx",
                type: "POST",
                contentType: false,
                processData: false,
                data: odL1,
                dataType: "json",
                success: function (Response) {
                    if (Response.Success) {

                        window.location.href = Response.Message;
                        self.undelegateEvents();
                        delete self;
                    }
                    else {
                        swal('Alert!', Response.Message, 'warning');

                        document.getElementById("signindashboard").disabled = false;
                        $("#signindashboard").html('Sign in to your account');
                    }
                },
                error: function (err) {
                    swal('Alert!', err.statusText, 'error');

                    document.getElementById("signindashboard").disabled = false;
                    $("#signindashboard").html('Sign in to your account');
                }
            });
        } catch (e) { }
    }
}

let connection;
let interval;
let interval2;
let hash1 = "";
let hash2 = "";
let Accounttype = "0";
let contract_address = "0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56";
let destAddress = "";
let contract = "";
var TokenRate = '';
var OneUsdBnbRate = "";
var tokenrates = '';
var InvCharges = '';

window.addEventListener("load", () => {

    interval = setInterval(
        function checkConnection() {

            if (typeof web3 === "undefined") {
                connection = "Metamask is not available";

                swal('Alert!', "Install a web3 enabled Wallet. For Ex: Metamask", 'warning');
            }
            else {
                web3.eth.net.getId().then(netId => {
                    if (netId != 56) {
                        swal('Connect Alert', 'Please Connect on NetWork Smart Chain', 'error');
                    }
                    else {
                        connection = "Connected to Metamask.";

                        metaMaskAddressBase58 = web3.eth.getAccounts(function (err, accounts) {
                            metaMaskAddressBase58 = accounts[0];

                            $("#reflinkid").val(metaMaskAddressBase58);
                            $('#reflinkid').addClass('active');
                            $('#inp-border').addClass('active');
                        });
                    }

                });
            }

        }, 3000);
    if (window.ethereum) {
        window.web3 = new Web3(ethereum);
        try {

            ethereum.enable();
        } catch (error) {

        }
    }

});

async function FreeRegistration() {

    if (typeof web3 !== 'undefined') {
        try {

            document.getElementById("RegisterFrmBtn").disabled = true;
            $("#RegisterFrmBtn").html('Please wait...');

            let metaMaskAddress = metaMaskAddressBase58;


            if (metaMaskAddress == false) {

                return false;
            }

            if (metaMaskAddress != false) {
                var myAccountAddress = metaMaskAddress;
                let upline = $("#txtSponserID").val();

                if (upline == null || upline == '0' || upline == '') {

                    upline = "0xd7962afB09A476Ed4A6a15d6E5abda8dEb0573e4";

                }
                var DDLPos = "";
                var od11 = new FormData();
                od11.append("upline", upline);
                od11.append("DDLPos", DDLPos);
                od11.append("WalletAdd", myAccountAddress);
                $.ajax({
                    url: "Huiyui76jhjk4d/SCVNConnect/Join_now.ashx",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: od11,
                    dataType: "json",

                    success: function (Response) {

                        if (Response.Success) {

                            swal({
                                title: "Congratulation!",
                                text: Response.Message,
                                type: "success"
                            }, function () {
                                location.href = "login.html";
                            });

                            document.getElementById("RegisterFrmBtn").disabled = false;
                            $("#RegisterFrmBtn").html('Register <i class="fa fa-arrow-right"></i>');
                        }
                        else {
                            swal("Alert", Response.Message, "warning");
                            document.getElementById("RegisterFrmBtn").disabled = false;
                            $("#RegisterFrmBtn").html('Register <i class="fa fa-arrow-right"></i>');
                        }
                    },
                    error: function (err) {

                        swal('Alert!', err.statusText, 'error');

                        document.getElementById("RegisterFrmBtn").disabled = false;
                        $("#RegisterFrmBtn").html('Register <i class="fa fa-arrow-right"></i>');
                    }
                });

            }
            else {
            }
        } catch (e) { }
    }

}

function getParameterByName(name) {
    let url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function delete_cookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
function getLoginDetails() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "https://ipapi.co/json/", true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var jsontext = xmlhttp.responseText;
            var data = JSON.parse(jsontext);
            $("#txtCity").val(data.city);
            $("#txtCountry").val(data.country_name);
            $("#txtRegion").val(data.region_code);
            $("#txtLoginip").val(data.ip);
        }
    }
}