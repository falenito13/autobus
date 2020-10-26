<?php

class View
{
	public $Method;

	public function Render($HTML)
	{
		echo $HTML;
	}

	public function RenderJson($Response)
	{
		header('Content-type: application/json');

		echo json_encode($Response, JSON_UNESCAPED_UNICODE);
		
		exit();
	}

	public function RenderXML($Response, $RootName)
	{
		header('Content-type: application/xml');

		$Converter = new ArrayToXML();

		echo $Converter->buildXML($Response, $RootName);

		exit();
	}

	public function Redirect($URL)
	{
		ob_clean();
		header('Location: ' . $URL);
		exit();
	}

	public function Error($ErrorCode){
		http_response_code($ErrorCode);
		exit();
	}
}

?>