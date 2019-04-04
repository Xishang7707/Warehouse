<?php
namespace Framework;


defined('CODE_PATH') or define('CODE_PATH', __DIR__);

class Framework{
	protected $config;
	protected $Error;
	public function __construct($conf)
	{
		$this->config=$conf;	
	}
	
	public function Run()
    {
        spl_autoload_register(array(
            $this,
            'LoadClass'
        ));

		$this->Route();        
    }

    protected function Route()
    {

		$urls = explode('/', $_SERVER['REQUEST_URI']);
		$urls = array_filter($urls);
		$urls = array_values($urls);
		
		if($urls[0]!=='api')
		{
			echo $this->SendData(400, '请求错误');
			exit();
		}
		
		$api = isset($urls[1])?$urls[1]:false;
		$action = isset($urls[2])?$urls[2]:false;

		if(!$api||!$action)
		{
			echo $this->SendData(400, '请求错误');
			exit();
		}
		
		$api_ctl = 'API\\'.$api.'Controller';
		if(!class_exists($api_ctl)||
		   !method_exists($api_ctl, $action))
		{
			echo $this->SendData(404, '未找到请求');
			exit();
		}
		$dispatch = new $api_ctl($api_ctl, $action);
		
		call_user_func_array(array(
		    $dispatch,
		    $action
		), $_POST);
//      $dispatch = new $controller($controllerName, $action);
//
//      call_user_func_array(array(
//          $dispatch,
//          $action
//      ), $params);
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
		return json_encode($dt);
	}

    protected function LoadClass($className)
    {
        $classMap = $this->LoadMap();

        if (class_exists($className)) {
            $file = $classMap[$className];
        } else if (strpos($className, '\\') !== false) {
            $file = APP_PATH . str_replace('\\', '/', $className) . '.php';
			if(!file_exists($file))
			return;
        } else
            return;
        include $file;
    }

    protected function LoadMap()
    {
        return [
            'Framework\Base' => CODE_PATH . '/Base/APIController.php'
        ];
    }
}