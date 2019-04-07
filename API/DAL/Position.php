<?php
namespace DAL;

class PositionDAL
{
	/**
	 * 获取职位信息
	 */
	public function GetInfo($id)
	{
		$sql = "select * from Position where id=$id";
		$db = new DBHelper();
		$result = $db->Exec($sql, true);
		if(!result)
			return null;
		return $result[0];
	}
}