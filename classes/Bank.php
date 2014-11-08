<?php
class Bank {
	
	public $branchCode;
	public $accountNo;
	public $pincode;
	
	function __construct(){
		
	}	
	
	public function getBranchCode(){
		return $this->branchCode;
	}
	
	public function verifyAccountInfo($acc){
		$obj = new dataAccess(); 
		$res = $obj->select("accounts", "id", "account_no = $acc");	
		if($row=mysql_fetch_array($res)){
			$id = $row['id'];
			return true;
		}
		else return false;		
	}
	
	public function processTransferAmount($accountFrom, $accountTo, $amount){			
		$res = $this->UpdateAccountBalance($accountFrom, $amount, 'less');
		if($res)$res2 = $this->UpdateAccountBalance($accountTo, $amount, 'add');	
		return $res2;
	}
	
	public function verifyAccountInformation($pinCode){
		$obj = new dataAccess();
		$res = $obj->select("accounts", "id, account_no", "pincode = $pinCode");			
		if($row=mysql_fetch_array($res)){
			$id = $row['id'];
			$_SESSION['pincode'] = $pinCode;
			$_SESSION['accountNo'] = $row['account_no'];			
			return true;
		}	
		else{			
			$_SESSION['session_message'] = "Sorry We are unable to verify your account information...please provide a valid account.";
			return false;
		}
		
	}
	public function getAccountBalance($acc_no){
		$obj = new dataAccess(); $balance = 0;
		$res = $obj->select("accounts", "balance", "account_no = $acc_no");	
		if($row=mysql_fetch_array($res)){
			$balance= $row['balance'];
		}
		return $balance;	
	}
	
	public function updateAccountBalance($acc_no, $amount, $type){
		$accBalance = $this->getAccountBalance($acc_no); 
		if($type=='less')	$newBalance = $accBalance - $amount;
		if($type=='add')	$newBalance = $accBalance + $amount;			
		$obj = new dataAccess();	
		$res = $obj->update("accounts", "balance = $newBalance", "account_no = $acc_no");			
		if($res) return 1;
		else return 0;		
	}	
	
	public function checkAvailableAmount($requested_amount, $acc_no){
		$balance = $this->getAccountBalance($acc_no);		
		if($balance > $requested_amount) return 1;
		else return 0;
	}	
	
	public function setCurrentCash($cash){
		$this->currentCash = $cash;	
	}
	
	public function getCurrentCash(){
		return $currentCash;	
	}
	
	
}

