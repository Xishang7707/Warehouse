<?php
namespace API;

use Framework\Base\APIController;

class ErrorController extends APIController
{
	public function Init($data)
	{
		echo $this->SendData($data);
	}
}