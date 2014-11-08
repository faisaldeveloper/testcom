<?php
class CustomerConsole {
	
	
	
	
	public function loadPage($page){
		include 'views/'.$page.'.php';
	}
	
	public function getPage($route){
	if($route ==0)$page = 'main';
	else if($route ==1)$page = 'inquiry';
	else if($route ==2)$page = 'withdrawl';
	else if($route ==3)$page = 'transfer';
	
	else if($route ==9)$page = 'logout';
	else $page = 'login';
	
	return $page;
}
		
	
}


?>