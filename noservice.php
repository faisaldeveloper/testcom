<?php
session_start();
$_SESSION['session_message'] = "Out of Service";
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
                    	<h1 align="center">This ATM is Not Working at the moment.</h1>
                        
                        <div id="message" align="center">
							<?php echo $_SESSION['session_message']; unset($_SESSION['session_message'])?>
    					</div>
                        <br /> <br />
                        
         <p align="center">    <a href="index.php" align="center">Try Again</a> </p>
                        <!--body-->
                       
        <div id="form" style="padding-left:200px; padding-top:10px; width:300px">         
          
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



