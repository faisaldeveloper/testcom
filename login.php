<?php
session_start();
include("include/db_config.php");
include("classes/includeClasses.php");

if($ATM->getATMStatus()=='OFF'){header("Location: noservice.php"); }

if(isset($_GET['counter'])){ unset($_SESSION['login_counter']); header("Location: index.php"); }

if(!empty($_POST['pincode'])){
	// verify account
	$acc_res = $bank->verifyAccountInformation($_POST['pincode']);	
	if($acc_res){ //validate pincode with bank pincode		
		header("Location: index.php");		}
	else { // calculte failed attempts
		if(!isset($_SESSION['login_counter'])){ $_SESSION['login_counter'] =1; }
		else $_SESSION['login_counter']++;
		if($_SESSION['login_counter'] >=3){	$_SESSION['session_message'] = "Your card is captured.";	}
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
                    <div id="welcome">
                    	<h1 align="center">Welcome to Virtual Bank ATM</h1>
                        
                        <div id="message" align="center">
							<?php echo $_SESSION['session_message']; unset($_SESSION['session_message'])?>
    					</div>
                        <br /> <br /> <br />
        <h3 align="center">Please Enter Your Pin Code</h3>
                        <!--body-->
                       
        <div id="form" style="padding-left:200px; padding-top:10px; width:300px">
          <div id="admin_login">Login</div>      
          <div id="form_contents">
          
          <?php if(!isset($_SESSION['login_counter']) || $_SESSION['login_counter'] < 3){ ?>
           <form name="frm" method="post" >          
            <div class="input">
            <label for="AdminUsername">PinCode&emsp;</label>
            <input name="pincode" id="pincode" type="text" maxlength="15" class="txt-box" />
             </div><br>
            <!-- <div class="input">
            <label for="AdminPassword">Password</label>
            <input name="password" id="password" type="password"  maxlength="15" class="txt-box" />
            </div>
            <br>-->
             <div class="input">
            
            </div>
            <div class="submit"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" onclick="login();" value="Login" />           
            </div>
           </form>
           <?php } else { 
		   echo "Pincode Error: Failed Attempts";
		   ?>
          <a href="login.php?counter=0" style="color:#903">Refresh Here</a>
           <?php }?>
          </div><!--Content-->
        </div><!--Form-->
                       
                        <!--body ends-->
                    </div>
                    
                    <!-- end div#welcome -->			
                    
                </div>
                <!-- end div#content -->
                <div id="sidebar">
                   
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
            <?php include 'include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>


