<?php
session_start();
include("include/db_config.php");
include("classes/includeClasses.php");

if($ATM->getATMStatus()=='OFF'){header("Location: noservice.php"); }
if(!isset($_SESSION['accountNo'])){header("Location: login.php"); }

if(isset($_POST['transfer-account'])){
	
	if(empty($_POST['transfer-account'])){ unset($_SESSION['transfer-account']);  $_SESSION['session_message'] = "Please Enter a Valid Account No";}
	else{ // process a valid amount	
		$transfer_account = $_POST['transfer-account'];
		
		$isvalidAccount = $Transfer->verifyAccountInformation($transfer_account);
		if($isvalidAccount) { // account verified ...enter amount 
			$_SESSION['transfer-account'] = $transfer_account;			
			unset($_POST['transfer-account']);			
		}else {$_SESSION['session_message'] = "Invalid Account No";}
		
	}
}

if(isset($_POST['transfer-amount'])){
	if(empty($_POST['transfer-amount'])){$_SESSION['session_message'] = "Please enter a valid amount.";}
	else{
		$requested_amount = $_POST['transfer-amount'];
		$accountFrom = $_SESSION['accountNo'];
		
		
		$isvalidAmount = $bank->checkAvailableAmount($requested_amount, $accountFrom);	
		if($isvalidAmount){ // amount verified .... do trasfer process
			$accountTo = $_SESSION['transfer-account'];
			$res = $bank->processTransferAmount($accountFrom, $accountTo, $requested_amount);	
			if($res) { $_SESSION['session_message'] = "Amount is Transfered Successfully."; }
			else { $_SESSION['session_message'] = "Sorry We are unable to process your request."; }
			unset($_SESSION['transfer-account']);	
		}
		else {		
			$_SESSION['session_message'] = "Sorry You do not have enough amount in your account to meet your request.";			
		}
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ATM Demo Application</title>
        <meta name="keywords" content="itinerary, list" />
        <meta name="description" content="This page provides a list of all itineraries" />
        <link href="css/default.css" rel="stylesheet" type="text/css" />
        
     
        
    <style type="text/css">
    a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
    </style>
    </head>
    
    
<body>
        <div id="wrapper">
        <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome" align="center">
                        <h1 align="center">Welcome to Virtual Bank ATM</h1>
                        <div id="message"><?php echo $_SESSION['session_message'];unset($_SESSION['session_message'])?></div>
        <br />
                        <!--body-->
                        
                 <?php if($isvalidAccount){ ?>      
                 		 <div id="form" style="padding-left:50px; padding-top:10px; width:400px">
                  <div id="admin_login">Enter Transfer Amount</div>      
                  	<div id="form_contents">          
                   		<form name="transfer-form" method="post" >          
                    		<div class="input">
                    		<label for="label">Trasfer Amount No&emsp;</label>
                    		<input name="transfer-amount" id="transfer-amount" type="text" size="15" maxlength="10" class="txt-box" />
                     		</div><br> 
                         
                  
                    <div class="submit"><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    <input type="submit" onclick="login();" value="Verify Trasfer Account" />           
                    </div>
                   </form>
                   
                  </div><!--Form Content-->                       
                </div><!--form-->
                 
                 
                 <?php }else { ?>                
                <div id="form" style="padding-left:50px; padding-top:10px; width:400px">
                  <div id="admin_login">Enter Transfer Account  No</div>      
                  	<div id="form_contents">          
                   		<form name="transfer-account-form" method="post" >          
                    		<div class="input">
                    		<label for="label">Trasfer Account No&emsp;</label>
                    		<input name="transfer-account" id="transfer-account" type="text" size="15" maxlength="10" class="txt-box" />
                     		</div><br> 
                         
                  
                    <div class="submit"><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    <input type="submit" onclick="login();" value="Verify Trasfer Account" />           
                    </div>
                   </form>
                   
                  </div><!--Form Content-->                       
                </div><!--form-->
                
                <?php } ?>
                
                
                    
                 </div>   <!-- end div#welcome -->	                   
                </div>
                <!-- end div#content -->
                <div id="sidebar">
                    <ul>
                    <?php include 'include/nav.php'; ?>
                        <!-- end navigation -->
                        <?php //include 'include/updates.php'; ?>
                        <!-- end updates -->
                        <li></li>
                    </ul>
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
            <?php include 'include/footer.php'; ?>
        </div>
       
        <!-- end div#wrapper -->
    </body>
</html>


