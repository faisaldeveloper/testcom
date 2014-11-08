<?php
session_start();
include("include/db_config.php");
include("classes/includeClasses.php");


if(isset($_GET['action']) && $_GET['action'] =='off'){ unset($_SESSION['admincode']); }
if(!isset($_SESSION['admincode'])){header("Location: adminlogin.php"); }

if(!empty($_POST['machinestatus']) && !empty($_POST['currCash'])){			 
		$obj = new dataAccess();
		$res = $obj->update("atm", "status = '".$_POST['machinestatus']."', current_cash = ".$_POST['currCash'], "id = 1");	
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
                        <h1 align="center">Admin Control - Virtual Bank ATM</h1>
                        <div id="message">
		<?php echo $_SESSION['session_message'];unset($_SESSION['session_message'])?>
    	</div>
        <br />
                        <!--body-->
                       
        <div id="form" style="padding-left:200px; padding-top:50px; width:400px">
        	<?php 
			 $ATMStatus = $ATM->getATMStatus();
			 $CURR_CASH = $ATM->getCurrentCash();
			?>
         
         	<label for="AdminUsername">Machine Status : &emsp; <?php echo $ATMStatus; ?></label>            
            <br /> <br />            
            <label for="AdminUsername">Current Cash : &emsp;<?php echo number_format($CURR_CASH, 2); ?></label>
            <hr />
            
            <br /> <br />      
            <form name="frm" method="post" >          
            <div class="input">
            <label for="machinestatus">Change Machine Status :&emsp;</label> 
            <select name="machinestatus" id="machinestatus">
            <option value="ON"> ON </option>
            <option value="OFF"> OFF </option>
            </select>             
            </div>
            
            <div class="input">
            <label for="currCash">Change Machine Status :&emsp;</label> 
            <input name="currCash" id="currCash" value="<?php echo $CURR_CASH; ?>" type="text" maxlength="15" class="txt-box" />     
            </div>
            
                   
            <div class="submit"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="btn" value="Save" />           
            </div>
            
            </form>
            
         
        </div><!--Form-->
                       
                       
        </div>    
                   	
                    
                </div>
                <!-- end div#content -->
                <div id="sidebar">        
                <li id="submenu">
                    <h2>Finish Current Session</h2>  
                     <ul>            
                            <li><a href="admin.php?action=off" onclick="return confirm('Are you sure?')">Logout</a></li>          
                            
                    </ul>
                </li>         
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
            <?php include 'include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>


