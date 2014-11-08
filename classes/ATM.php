<?php
class ATM {
	
	private $currentCash;
	private $ATMSTATUS;
	
	function __construct(){	
		$obj = new dataAccess();
		$res = $obj->select("atm", "*", "id = 1");			
		if($row=mysql_fetch_array($res)){
			$this->ATMSTATUS = $row['status'];
			$this->currentCash = $row['current_cash'];
		}
	}
	
	public function setCurrentCash($cash){
		$this->currentCash = $cash;	
	}
	
	public function getCurrentCash(){
		return $this->currentCash;	
	}
	
	public function updateATMCurrentCash($amount, $type){
			$cCash = $this->getCurrentCash();
			if($type=='less')	$newCash = $cCash - $amount;
			if($type=='add')	$newCash = $cCash + $amount;			
			$obj = new dataAccess();
			$res = $obj->update("atm", "current_cash = $newCash", "id = 1");				
			if($res) return 1;
			else return 0;		
	}
	
	public function getAccountBalance($acc_no){
		$Inquiry = new Inquiry();
		return $Inquiry->getAccountBalance($acc_no);
	}
	
	public function setATMStatus($status){
		$this->ATMSTATUS = $status;
	}
	
	public function getATMStatus(){
		return $this->ATMSTATUS;
	}
	
	public function logOut(){
		unset($_SESSION);	
	}
	
}


?>