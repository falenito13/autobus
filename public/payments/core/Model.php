<?php

class Model
{
	public		$DB;
	public		$_DefReturnUrl	= 'http://payments.realhome.ge/';

	protected	$_Operator;
	protected	$_OperatorID = 10;
	protected	$_OperatorServiceID = 9;
	protected	$_OrderID		= NULL;
	protected	$_OrderData		= array();
	protected	$_Options		= array();

	function __construct()
	{
		$this->DB 			= new DataBase();
		$this->_Operator	= $this->GetOperator();
		$this->_Options		= $this->GetOperatorOptions();

		$LogName			= strtolower($this->_Operator['name']);

		Logger::SetLog($LogName, $this->DB);
	}

	public function GetOperatorStatus($Reason)
	{
		return $this->DB->getOne('	SELECT	`operator_result_id`
									FROM	`operators_results`
									WHERE	`operator_service_id` = ?i AND (`operator_result` = ?s OR `operator_result` = \'XXX\') LIMIT 1', $this->_OperatorServiceID, $Reason);
	}

	public function GetServiceStatus($ServiceName)
	{
		$ServiceStatus	= $this->DB->getRow('	SELECT	`OS`.`operator_service_id`,
														`OS`.`status_id`,
														`OSM`.`message`
												FROM	`payment_services` AS `PS` LEFT JOIN `operators_services` AS `OS`
													ON	`PS`.`service_id` = `OS`.`payment_service_id` LEFT JOIN `operators_status_messages` AS `OSM`
													ON	`OS`.`operator_service_id` = `OSM`.`operator_service_id`
												WHERE	`PS`.`service_name` = ?s AND `OS`.`operator_id` = ?i AND `OSM`.`lang_id` = ?i', $ServiceName, $this->_OperatorID, Lang::GetLangID());

		if (empty($ServiceStatus)) {
			$ServiceStatus = array(	'operator_service_id'	=> 0,
									'status_id'				=> 0,
									'message'				=> 'Service not found');

		}

		$this->_OperatorServiceID = $ServiceStatus['operator_service_id'];

		return $ServiceStatus;
	}

	public function SetData($Data)
	{
		if (isset($Data['order_id']))
		{
			$this->_OrderID		= $Data['order_id'];
		}

		if (empty($Data['type_id']))
		{
			$Data['type_id']	= 2;  //Confirmed
		}
		if (empty($Data['user_ip']))
		{
			$Data['user_ip']	= $_SERVER['SERVER_ADDR'];
		}
		if (empty($Data['return_url']))
		{
			$Data['return_url']	= $this->_DefReturnUrl;
		}

		if (empty($Data['amount']))
		{
			Logger::Log('Order data is not complete:', 'Empty amount');

			return false;
		}
		if (empty($Data['user_id']))
		{
			Logger::Log('Order data is not complete:', 'Empty user_id');

			return false;
		}
		if (empty($Data['token'])) {
			Logger::Log('Order data is not complete:', 'Empty token');

			return false;
		}

		$this->_OrderData = $Data;

		return true;
	}

	public function CreateOrder($Data = array())
	{
		if (empty($Data))
		{
			$Data							= array();
			$Data['type_id']				= Request::Post('TypeID');
			$Data['user_ip']				= Request::Post('UserIP');
			$Data['return_url']				= Request::Post('ReturnURL');
			$Data['amount']					= Request::Post('Amount');
			$Data['user_id']				= Request::Post('UserID');
			$Data['operator_id']			= $this->_OperatorID;
			$Data['operator_service_id']	= $this->_OperatorServiceID;
		}

		$Data['token'] = md5(sha1(time() . uniqid() . time()));

		$HasData = $this->SetData($Data);
		if (!$HasData)
		{
			return false;
		}

		$PaymentOrders = $this->DB->Query('INSERT INTO `payment_orders` SET ?u', $this->_OrderData);

		if (!$PaymentOrders)
		{
			Logger::Log('Order is not created:', $this->_OrderData);
			return false;
		}

		$this->_OrderID = $this->DB->insertId();
		Logger::Log('Create Order:', $this->_OrderData, $this->_OrderID);

		return $this->_OrderID;
	}

	public function EditOrder($Data)
	{
		$this->DB->Query('UPDATE `payment_orders` SET ?u WHERE `order_id` = ?i', $Data, $this->_OrderID);
	}

	public function GetOrder($OrderID = NULL)
	{
		if (empty($OrderID))
		{
			$TransactionID = Request::Req('TransactionID');
			if (!empty($TransactionID))
			{
				$OrderID	= $this->GetOrderID($TransactionID);
			}
			else
			{
				$OrderID	= Request::Req('OrderID');
			}
		}

		$Order = $this->DB->getRow('SELECT * FROM `payment_orders` WHERE `order_id` = ?s', $OrderID);
		if (!$Order)
		{
			Logger::Log('Order Not Found:', '[Order ID] => ' . $OrderID);
			return false;
		}

		$HasData		= $this->SetData($Order);
		if (!$HasData)
		{
			Logger::Log('Order data is not complete:', '[Order ID] => ' . $OrderID);
			return false;
		}

		return $Order;
	}

	public function CheckOrder()
	{
		$Order = $this->DB->getRow('SELECT * FROM `payment_orders` WHERE `order_id` = ?i AND `is_complete` = 1', $this->_OrderID);
		if (!$Order)
		{
			return false;
		}

		return true;
	}

	public function CompleteOrder($StatusID = NULL)
	{
		$Data					= array();
		$Data['is_complete']	= 1;

		if (!empty($StatusID))
		{
			switch ($StatusID) {
				case '3':
					$Data['is_complete'] = 1;
					break;
				case '4':
					$Data['is_complete'] = 1;
					break;
				case '5':
					$Data['is_complete'] = 5;
					break;
				default:
					$Data['is_complete'] = 0;
					break;
			}
		}

		$this->EditOrder($Data);
	}

	public function GetOption($OptionName, $Index = 0)
	{
		if (is_array($this->_Options[$OptionName]))
		{
			return $this->_Options[$OptionName][$Index];
		}

		return $this->_Options[$OptionName];
	}

	public function GetOperatorOptions()
	{
		$Options	= array();
		$Result		= $this->DB->query('SELECT	`option_name`,
												`option_value`
										FROM	`operators_options`
										WHERE	`operator_id` = ?i', $this->_OperatorID);

		while ($aRow = $this->DB->fetch($Result))
		{
			$Key	= $aRow['option_name'];
			unset($aRow['option_name']);
			$Value	= reset($aRow);
			if (Functions::IsJson($Value))
			{
				$Options[$Key] = json_decode($Value, true);
			}
			else
			{
				$Options[$Key] = $Value;
			}
		}

		return $Options;
	}

	public function ConvertAmount($Amount)
	{
		return $Amount * 100;
	}

	//Services
	public function GetUserID($User, $SiteID)
	{
		return false;
	}

	public function CheckUserExist($User, $SiteID)
	{
		return false;
	}

	public function AddUserAmount()
	{
		return true;
	}

	public function GetSiteName()
	{
		return 'realhome.ge';
	}
	//!Services

	private function GetOrderID($TransactionID)
	{
		return $this->DB->getOne('	SELECT	`order_id`
									FROM	`payment_orders`
									WHERE	`transaction_id` = ?s', $TransactionID);
	}

	private function GetOperator()
	{
		return $this->DB->getRow('	SELECT	*
									FROM	`operators`
									WHERE	`operator_id` = ?i', $this->_OperatorID);
	}
}

?>
