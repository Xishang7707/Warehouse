<?php
namespace DAL;

class VerifyDAL
{
	public static function VerifyLogin($id, $password)
	{
		$sql = "select * from User where id='$id' and password='$password'";
		$db = new DBHelper();
		$result = $db->Exec($sql, true);
		if(count($result)!=1)
		{
			return false;
		}
		return true;
	}
}