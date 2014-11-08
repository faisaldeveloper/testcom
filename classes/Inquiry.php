<?php
class Inquiry {
	
	private $currentCash;
	
	public function setCurrentCash($cash){
		$this->currentCash = $cash;	
	}
	
	public function getCurrentCash(){
		return $currentCash;	
	}
	
	public function getAccountBalance($acc_no){
		$Bank = new Bank();
		return $Bank->getAccountBalance($acc_no);
	}
	
}


?>