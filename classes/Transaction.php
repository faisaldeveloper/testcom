<?php
class Transaction {
	
	
	public function verifyAccountInformation($acc){
			$bank = new Bank();
			$ans = $bank->verifyAccountInfo($acc);
			if($acc==$_SESSION['accountNo']) $ans = false;
			return $ans;
	}
	
}


?>