<?php
class CashDispenser {
	
	private $intialCash;
	
	public function setCurrentCash($cash){
		$this->currentCash = $cash;	
	}
	
	public function verifyAccountInformation($acc){
			$bank = new Bank();
			$ans = $bank->verifyAccountInfo($acc);
			if($acc==$_SESSION['accountNo']) $ans = false;
			return $ans;
	}
	
	
}


?>