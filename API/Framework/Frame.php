<?php
namespace Framework;
use DAL\DBHelper;

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
		try{
			spl_autoload_register(array(
				$this,
				'LoadClass'
			));
			
			DBHelper::Init($this->config['DB']);
			
			$this->Route();        
		}catch(\Exception $e)
		{
			if($this->config['DEBUG'])
				echo $this->SendData(400, $e);
			else
				echo $this->SendData(400, '请求错误');
		}
    }

    protected function Route()
    {

		$urls = explode('/', $_SERVER['REQUEST_URI']);
		$urls = array_filter($urls);
		$urls = array_values($urls);
		
		if($urls[0]!=='api')
		{
			throw new \Exception('接口请求错误');
		}
		
 		$api = isset($urls[1])?$urls[1]:false;
 		$action = isset($urls[2])?$urls[2]:false;


		if(!$api||!$action)
		{
			throw new \Exception('接口请求错误');
		}
		
		$api_ctl = 'API\\'.$api.'Controller';
		
		if(!class_exists($api_ctl)||
		   !method_exists($api_ctl, $action))
		{
			throw new \Exception('ctl或action不存在');
		}
		$dispatch = new $api_ctl($api_ctl, $action, $this->config);
		
		call_user_func_array(array(
		    $dispatch,
		    $action
		), array($_POST));
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