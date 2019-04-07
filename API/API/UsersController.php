<?php
namespace API;
use Framework\Base\APIController;
use Tools\OpenSSL;
use DAL\UserDAL;
use DAL\VerifyDAL;
use DAL\PermissionDAL;

class UsersController extends APIController
{
	public function MakeUser($data)
	{
		try{

			$id = isset($data['id'])?$data['id']:null;
			$name = isset($data['name'])?$data['name']:null;
			$password = isset($data['password'])?$data['password']:null;
			$position_id = isset($data['position_id'])?$data['position_id']:null;

			if($id===null||
				$name===null||
				$password===null||
				$position_id===null)
				throw new \Exception('请求错误', 400);

			$exists = UserDAL::Exists($id);
			if($exists)
			{
				throw new \Exception('用户工号已存在', 10001);
			}

			$dec_pwd = OpenSSL::prv_decrypt(base64_decode($password), $this->config['PrvKey']);

			if($dec_pwd===FALSE)
				throw new \Exception('请求错误', 400);

			$result = UserDAL::MakeUser($id, $name, $dec_pwd, $position_id);
			
			if(!$result)
				throw new \Exception('请求错误', 400);
			$this->SendData(200, '成功');
		}catch(\Exception $e)
		{
			$this->SendData($e->getCode(), $e->getMessage());
		}
	}
	/**
	 * 登录
	 */
	public function Login($data)
	{
		try{
			$id = isset($data['id'])?$data['id']:null;
			$password = isset($data['password'])?$data['password']:null;

			if($id===null||
				$password===null)
				throw new \Exception('请求错误', 400);
			
			$dec_pwd = OpenSSL::prv_decrypt(base64_decode($password), $this->config['PrvKey']);

			if($dec_pwd===FALSE)
				throw new \Exception('请求错误', 400);
			//print_r($dec_pwd);
			$result = UserDAL::Login($id, $dec_pwd);
			if(!$result)
				throw new \Exception('账号密码验证错误', 10002);
			$_SESSION['us_info']=$result;
			$this->SendData(200, '成功');
		}catch(\Exception $e)
		{
			$this->SendData($e->getCode(), $e->getMessage());
		}
	}
	
	public function GetInfo($data)
	{
		try{
			$us_info = $_SESSION['us_info'];
			if(
			!$us_info||
			!$us_info['id']||
			!$us_info['password']||
			!VerifyDAL::VerifyLogin($us_info['id'], $us_info['password'])
			)
				throw new \Exception('未登录', 10003);
				
			unset($us_info['password']);
			unset($us_info['salt']);
			unset($us_info['ct_time']);
			
			$pms_log = PermissionDAL::GetInfo($us_info['id']);
			
			$ret_data = array(
			'us-info'=>$us_info,
			'permis-list'=>$pms_log
			);
			$this->SendData(200, '成功', $ret_data);
		}catch(\Exception $e)
		{
			$this->SendData($e->getCode(), $e->getMessage());
		}
	}
}