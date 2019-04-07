<?php
namespace Framework\Base;

class APIController
{
	protected $api;
	protected $action;
	protected $config;
	public function __construct($api=null, $action=null, $config)
	{
		$this->api = $api;
		$this->action = $action;
		$this->config = $config;
	}
	
	/**
	 * 发送json数据
	 */
	public function SendData($code=200, $status='成功', $data=null)
	{
		$dt=array(
			'code'=>$code,
			'status'=>$status,
			'data'=>$data
		);
		echo json_encode($dt);
	}
}
