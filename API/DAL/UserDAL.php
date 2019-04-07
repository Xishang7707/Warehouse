<?php
namespace DAL;
use Tools\Tools;
class UserDAL
{
	/**
	 * 注册用户
	 */
	public static function MakeUser($id, $name, $pwd, $position_id)
	{
		$salt = Tools::MakeSalt();
		$password = Tools::encrypt_pwd($pwd, $salt);
		$sql = "insert User(id, name, password, salt, position_id) 
				values('$id', '$name', '$password', '$salt', $position_id)";
		
		$db = new DBHelper();

		$result = $db->Exec($sql);
		if(!$result)
			return null;
		return $result;
	}
	/**
	 * 判断用户是否存在
	 */
	public static function Exists($id)
	{
		$sql = sprintf("select * from User where id='%s'", $id);
		$db = new DBHelper();
		$result = $db->Exec($sql);
		return $result->num_rows>0?true:false;
	}
	
	public static function GetInfo($id)
	{
		$sql = "select * from User where id='$id'";
		$db = new DBHelper();
		$result = $db->Exec($sql, true);
		
		if(count($result)<=0)
			return null;
		else return $result[0];
	}
	
	public static function Login($id, $pwd)
	{
		$us_info = self::GetInfo($id);
		if($us_info===null)
			return false;
		$enc = Tools::encrypt_pwd($pwd, $us_info['salt']);
		
		if($us_info['password']!==$enc)
			return false;
		return $us_info;
	}
}