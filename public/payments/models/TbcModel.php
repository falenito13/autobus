<?php

/**
* TBC Bank Model
*/
class TbcModel extends Model
{
	const	OPERATOR_ID				= 10;
	const	SSL_CERT_PATH			= 'tbc/TBCBank';
	const	SSL_PASSWORD			= '-7MbQSmzfxWrhqvH'; //

	private	$_SSL					= array();

	function __construct()
	{
		$this->_OperatorID	= self::OPERATOR_ID;
		$this->_SSL			= array('CertificatePath'	=> CERT_PATH . self::SSL_CERT_PATH,
									'Password'			=> self::SSL_PASSWORD);

		parent::__construct();
	}

	public function CreateTransaction()
	{
		$Amount		= $this->ConvertAmount($this->_OrderData['amount']);
		$SendData	= array('command'			=> 'a',
							'msg_type'			=> 'DMS',
							'amount'			=> $Amount,
							'currency'			=> $this->GetOption('currency_code'),
							'client_ip_addr'	=> $this->_OrderData['user_ip'],
							'description'		=> $this->_OrderID . '-' . $this->_OrderData['user_id'],
							'language'			=> Lang::GetLang());

		Logger::RequestLog('Create Transaction:', $SendData, $this->_OrderID);

		$Result			= Curl::Post($this->GetOption('merchant_url'), $SendData, $this->_SSL);
		$TransactionID	= $Result['TRANSACTION_ID'];

		Logger::ResponseLog('Confirm Create Transaction:', $Result, $this->_OrderID);

		return $TransactionID;
	}
	
	public function CheckTransaction()
	{
		$TransactionID	= urlencode($this->_OrderData['transaction_id']);

		$SendData		= array('command'			=> 'c',
								'trans_id'			=> $TransactionID,
								'client_ip_addr'	=> $this->_OrderData['user_ip']);

		Logger::RequestLog('Check Transaction:', $SendData, $this->_OrderID);

		$Result			= Curl::Post($this->GetOption('merchant_url'), $SendData, $this->_SSL);
		
		Logger::ResponseLog('Check Transaction:', $Result, $this->_OrderID);

		return $Result;
	}

	public function CompleteTransaction()
	{
		$TransactionID	= urlencode($this->_OrderData['transaction_id']);
		$Amount			= $this->ConvertAmount($this->_OrderData['amount']);

		$SendData		= array('command'			=> 't',
								'msg_type'			=> 'DMS',
								'trans_id'			=> $TransactionID,
								'amount'			=> $Amount,
								'currency'			=> $this->GetOption('currency_code'),
								'client_ip_addr'	=> $this->_OrderData['user_ip'],
								'description'		=> $this->_OrderID . '-' . $this->_OrderData['user_id'],
								'language'			=> Lang::GetLang());

		Logger::RequestLog('DMS Confirm:', $SendData, $this->_OrderID);

		$Result			= Curl::Post($this->GetOption('merchant_url'), $SendData, $this->_SSL);

		Logger::ResponseLog('DMS Confirm:', $Result, $this->_OrderID);

		return $Result;
	}

	public function RejectTransaction()
	{
		$TransactionID	= urlencode($this->_OrderData['transaction_id']);
		$Amount			= $this->ConvertAmount($this->_OrderData['amount']);

		$SendData		= array('command'			=> 'r',
								'trans_id'			=> $TransactionID,
								'amount'			=> $Amount);

		Logger::RequestLog('DMS Reject:', $SendData, $this->_OrderID);

		$Result			= Curl::Post($this->GetOption('merchant_url'), $SendData, $this->_SSL);

		Logger::ResponseLog('DMS Reject:', $Result, $this->_OrderID);

		return $Result;
	}
	
	public function EndOfBusinessDay()
	{
		$SendData		= array('command'			=> 'b');

		Logger::RequestLog('EndOfBusinessDay:', $SendData);

		$Result			= Curl::Post($this->GetOption('merchant_url'), $SendData, $this->_SSL);

		Logger::ResponseLog('EndOfBusinessDay:', $Result, $this->_OrderID);
		
		return $Result;
	}

	public function GetMessage($ResultID)
	{
		return $this->DB->getOne('	SELECT	`ORS`.`message`
									FROM	`operators_results` AS `OR` LEFT JOIN `operators_result_messages` AS `ORS`
										ON	`OR`.`operator_result_id` = `ORS`.`operator_result_id`
									WHERE	`OR`.`operator_result_id` = ?i AND `OR`.`operator_service_id` = ?i AND `ORS`.`lang_id` = ?i', $ResultID, $this->_OperatorServiceID, Lang::GetLangID());
	}
}

?>