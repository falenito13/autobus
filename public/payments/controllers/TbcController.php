<?php

/**
* TBC Bank Controller kvelaferi chamotvirte aba vnaxot
*/
class Tbc extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->Operator = 'tbc';
	}

	public function Index()
	{
		$this->View->RenderJson(array(
			'Status'	=> '1'
		));
	}

	public function Ecommerce($ReturnStatus = 'fail') {
		if ($ReturnStatus == 'fail')
			$this->ECommerceFail();
		else
			$this->ECommerceOk();
	}

	public function ECommerceOrder()
	{
		$OrderID = $this->Model->CreateOrder();

		if ($OrderID)
		{
			$TransactionID = $this->Model->CreateTransaction();

			$this->Model->EditOrder(array(
				'transaction_id'	=> $TransactionID,
				'status_id'			=> 1
			));

			$this->View->RenderJson(array(
				'StatusID'		=> 1,
				'Operator'		=> $this->Operator,
				'PaymentURL'	=> $this->Model->GetOption('payment_url'),
				'PaymentMethod'	=> $this->Model->GetOption('payment_method'),
				'PaymentData'	=> array('trans_id' => $TransactionID)
			));
		}
		
		$this->View->RenderJson(array(
			'StatusID'	=> 0,
			'Message'	=> '[Amount] and [UserID] parameters is required',
			'Operator'	=> $this->Operator
		));
	}

	protected function ECommerceOk()
	{
		Request::SetReq('TransactionID', Request::Req('trans_id')); //Convert to standart

		$Order		= $this->Model->GetOrder();
		if (!$Order)
		{
			$ReturnURL = Functions::ConcatURL($this->Model->_DefReturnUrl, 'StatusID=0');
			$this->View->Redirect($ReturnURL);
		}

		$CheckOrder	= $this->Model->CheckOrder();
		if ($CheckOrder)
		{
			$ReturnURL = Functions::ConcatURL($Order['return_url'], 'StatusID=0&OrderID=' . urlencode($Order['user_id']) . '&token=' . urlencode($Order['token']));
			$this->View->Redirect($ReturnURL);
		}

		$StatusID			= 4;

		$CheckTransaction	= $this->Model->CheckTransaction();
		$OperatorStatusID	= $this->Model->GetOperatorStatus($CheckTransaction['RESULT_CODE']);

		if ($CheckTransaction['RESULT'] == 'OK')
		{
			$StatusID = 2;
			if ($Order['type_id'] == 2)
			{
				$StatusID	= 3;
				$Complate	= $this->Model->CompleteTransaction();
				if ($Complate['RESULT'] == 'OK')
				{
					$AddAmount = $this->Model->AddUserAmount();
					if (!$AddAmount)
					{
						$StatusID = 6;
					}
				}
				else
				{
					$StatusID = 4;
				}
			}
		}
		
		$this->Model->EditOrder(array(
			'status_id'				=> $StatusID,
			'operator_status_id'	=> $OperatorStatusID
		));

		$this->Model->CompleteOrder($StatusID);

		$ReturnURL = Functions::ConcatURL($Order['return_url'], 'StatusID=' . $StatusID . '&OrderID=' . urlencode($Order['user_id']) . '&token=' . urlencode($Order['token']));
		$this->View->Redirect($ReturnURL);
	}

	protected function ECommerceFail()
	{
		Request::SetReq('TransactionID', Request::Req('trans_id')); //Convert to standart
		$Order = $this->Model->GetOrder();

		if (!$Order)
		{
			$ReturnURL = Functions::ConcatURL($this->Model->_DefReturnUrl, 'StatusID=0');
			$this->View->Redirect($ReturnURL);
		}

		$CheckOrder	= $this->Model->CheckOrder();
		if ($CheckOrder)
		{
			$ReturnURL = Functions::ConcatURL($Order['return_url'], 'StatusID=0&OrderID=' . urlencode($Order['user_id']) . '&token=' . urlencode($Order['token']));
			$this->View->Redirect($ReturnURL);
		}

		$StatusID			= 4;
		$CheckTransaction	= $this->Model->CheckTransaction();
		$OperatorStatusID	= $this->Model->GetOperatorStatus($CheckTransaction['RESULT_CODE']);

		$this->Model->EditOrder(array(
			'status_id'				=> $StatusID,
			'operator_status_id'	=> $OperatorStatusID
		));

		$this->Model->CompleteOrder($StatusID);

		$ReturnURL = Functions::ConcatURL($Order['return_url'], 'StatusID=' . $StatusID . '&OrderID=' . urlencode($Order['user_id']) . '&token=' . urlencode($Order['token']));
		$this->View->Redirect($ReturnURL);
	}

	protected function ECommerceVerify()
	{
		$Order = $this->Model->GetOrder();

		if (!$Order)
		{
			$this->View->RenderJson(array(
				'StatusID'	=> 0,
				'Message'	=> 'Order data is not complete',
				'Operator'	=> $this->Operator
			));
		}
		
		$Message = $this->Model->GetMessage($Order['operator_status_id']);

		$this->View->RenderJson(array(
			'StatusID'	=> $Order['status_id'],
			'Message'	=> $Message,
			'OrderID'	=> $Order['order_id'],
			'Operator'	=> $this->Operator
		));
	}

	public function EndOfBusinessDay()
	{
		$this->Model->EndOfBusinessDay();
	}

	/*
	Need Test
	*/
	protected function ECommerceComplated()
	{
		$Order = $this->Model->GetOrder();

		if (!$Order)
		{
			$this->View->RenderJson(array(
				'StatusID'	=> 0,
				'Message'	=> 'Order data is not complete',
				'Operator'	=> $this->Operator
			));
		}

		$CheckOrder	= $this->Model->CheckOrder();
		if ($CheckOrder)
		{
			$this->View->RenderJson(array(
				'StatusID'	=> 0,
				'Message'	=> 'The order already completed',
				'OrderID'	=> $Order['order_id'],
				'Operator'	=> $this->Operator
			));
		}

		$StatusID = $Order['status_id'];
		if ($StatusID == 2)
		{
			$Complate = $this->Model->CompleteTransaction();
			if ($Complate['RESULT'] == 'OK')
			{
				$StatusID = 3;
				$this->Model->EditOrder(array('status_id' => $StatusID));
				$this->Model->CompleteOrder($StatusID);

				$this->View->RenderJson(array(
					'StatusID'	=> $StatusID,
					'Message'	=> 'OK',
					'OrderID'	=> $Order['order_id'],
					'Operator'	=> $this->Operator
				));
			}
		}

		$this->View->RenderJson(array(
			'StatusID'	=> 0,
			'Message'	=> 'The order can not be complete',
			'OrderID'	=> $Order['order_id'],
			'Operator'	=> $this->Operator
		));
	}

	/*
	Need Test
	*/
	protected function ECommerceCancel()
	{
		$Order = $this->Model->GetOrder();

		if (!$Order)
		{
			$this->View->RenderJson(array(
				'StatusID'	=> 0,
				'Message'	=> 'Order data is not complete',
				'Operator'	=> $this->Operator
			));
		}

		$CheckOrder	= $this->Model->CheckOrder();
		if ($CheckOrder)
		{
			$this->View->RenderJson(array(
				'StatusID'	=> 0,
				'Message'	=> 'The order already returned',
				'OrderID'	=> $Order['order_id'],
				'Operator'	=> $this->Operator
			));
		}

		$StatusID = $Order['status_id'];
		if ($StatusID == 2)
		{
			$this->Model->RejectTransaction();
			$StatusID = 5;
			$this->Model->EditOrder(array('status_id' => $StatusID));
			$this->Model->CompleteOrder($StatusID);

			$this->View->RenderJson(array(
				'StatusID'	=> $StatusID,
				'Message'	=> 'OK',
				'OrderID'	=> $Order['order_id'],
				'Operator'	=> $this->Operator
			));
		}

		$this->View->RenderJson(array(
			'StatusID'	=> 0,
			'Message'	=> 'The order can not be returned',
			'OrderID'	=> $Order['order_id'],
			'Operator'	=> $this->Operator
		));
	}
}

?>