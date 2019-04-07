<?php
namespace Tools;

class Tools
{
	/**
	 * 生成密码salt
	 */
	public static function MakeSalt()
	{
		return md5(microtime(true));
	}
	/**
	 * 加密密码
	 */
	public static function encrypt_pwd($pwd, $salt)
	{
		return md5(md5($pwd).md5($salt));
	}
}