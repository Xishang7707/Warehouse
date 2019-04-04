<?php
namespace Framework\Base;

class APIController
{
	protected $api;
	protected $action;
	
	public function __construct($api=null, $action=null)
	{
		$this->api = $api;
		$this->action = $action;
	}
	
	/**
	 * 发送json数据
	 */
	public function SendData($data=null, $code=200, $status='成功')
	{
		$dt=array(
			'code'=>$code,
			'status'=>$status,
			'data'=>$data
		);
		return json_encode($dt);
	}
}
