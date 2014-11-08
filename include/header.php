<!-- Common Header for our site -->
<?php
$usertype=$_SESSION['session_user_type'];
$userid=$_SESSION['session_user_id'];

$style_tab = "style=\"background-image: url(css/images/img03.gif);color: #AA2808; text-decoration:none\"";


$string = $_SERVER['REQUEST_URI'];
if (strpos($string,"user")){
$user_tab = $style_tab;
}else if(strpos($string,"inq")){
$inq_tab = $style_tab;
}else if(strpos($string,"quot")){
$quot_tab = $style_tab;
}else if(strpos($string,"pos")){
$pos_tab = $style_tab;
}else if(strpos($string,"client")){
$client_tab = $style_tab;
}else if(strpos($string,"principal")){
$principal_tab = $style_tab;
}else if(strpos($string,"product")){
$product_tab = $style_tab;
}



?>

<div id="header">
    <div id="logo">
    	<?php if($userid > 0){?>
        <h1><a href="index2.php">ATM Demo Application</a></h1>
        <?php }else{?>
       	<h1><a href="index.php">ATM Demo Application</a></h1>
        <?php }?>
    </div>
    
    <!-- end div#logo -->
    <div id="menu">
        <ul>
        	<?php if($usertype == "Admin"){?>
            <li><a href="user.php" <?php echo $user_tab;?> >Users</a></li>
            
            <?php }
			if($userid > 0 ){//user related menu
			?>
                        
            <li><a href="inq.php" <?php echo $inq_tab;?> >Inquiries</a></li>
            <li><a href="quotations.php" <?php echo $quot_tab;?> >Quotations</a></li>
            <li><a href="pos.php"  <?php echo $pos_tab;?> >P / O</a></li>
           	<li><a href="clients.php" <?php echo $client_tab;?> >Clients</a></li>
            <li><a href="principals.php" <?php echo $principal_tab;?> >Principals</a></li>
            <li><a href="products.php" <?php echo $product_tab;?> >Products</a></li>
            
            
            
            
            <?php }?>
            
            
        </ul>
    </div>
    <!-- end div#menu -->
</div>