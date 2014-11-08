<?php
session_start();
include("include/db_config.php");
include("classes/includeClasses.php");

if($ATM->getATMStatus()=='OFF'){header("Location: noservice.php"); }
if(!isset($_SESSION['accountNo'])){header("Location: login.php"); }

if(isset($_POST['withdraw-amount'])){
	
	if(empty($_POST['withdraw-amount'])){$_SESSION['session_message'] = "Please enter a valid amount to withdraw.";}
	else{ // process a valid amount	
		
	    // check available balalce
		// check available cash in machine
		$requested_amount = $_POST['withdraw-amount'];
		$accountNo = $_SESSION['accountNo'];
		$isvalidAmount = $bank->checkAvailableAmount($requested_amount, $accountNo);
		if($isvalidAmount){
				$curreCash = $ATM->getCurrentCash();
				if($curreCash > $requested_amount){					
					$ATM->updateATMCurrentCash($requested_amount, 'less'); // less cash from atim 
					$bank->updateAccountBalance($accountNo, $requested_amount, 'less');	 //		minusFromAccountBalance		
					$_SESSION['session_message'] = "Cash Dispenced sucessfully";
				}		
				else{ $_SESSION['session_message'] = "In-sufficient funds in ATM to meet your request."; }
		}else {		
			$_SESSION['session_message'] = "Sorry You do not have enough amount in your account to meet your request.";			
		}
	}
}

    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ATM Demo Application - Withdrawl</title>
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
                        <div id="message" align="center">
		<?php echo $_SESSION['session_message'];unset($_SESSION['session_message'])?>
    	</div>
        <br />                       
        
         
         <div id="form" style="padding-left:10px; padding-top:10px; width:300px">
          <div id="admin_login">Enter Amount</div>      
          <div id="form_contents">          
           <form name="withdraw-form" method="post" >          
            <div class="input">
            <label for="label">Amount&emsp;</label>
            <input name="withdraw-amount" id="withdraw-amount" type="text" maxlength="15" class="txt-box" />
             </div><br>            
          
            <div class="submit"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" onclick="login();" value="Withdraw" />           
            </div>
           </form>
           
          </div><!--Content-->
        
        </div><!--Form-->
                       
                        <!--body ends-->
                    </div>
                    
                    <!-- end div#welcome -->			
                    
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


