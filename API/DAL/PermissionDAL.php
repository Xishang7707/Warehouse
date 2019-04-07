<?php
namespace DAL;

class PermissionDAL
{
	public static function GetInfo($us_id)
	{
		$sql="select * from Permission where id in (select p.permis_id from `User` u, PermissionLog p where u.position_id=p.position_id and u.id='$us_id') order by val";
		$db = new DBHelper();
		$result = $db->Exec($sql, true);
		if(!$result)
			return null;
		return $result;
	}
}