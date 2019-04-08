<?php
namespace DAL;

class PrivilegeDAL
{
	public static function GetInfo($us_id)
	{
		$sql_parent="select m.id, m.name, m.url from Privilege p, Menu m where p.menu_id=m.id and m.parent is NULL and p.rule_id=(select rule_id from User where id='$us_id')";
		
		$db = new DBHelper();
		$result_parent = $db->Exec($sql_parent, true);
		if(!$result_parent)
		{
			$db->Close();
			return null;
		}
		$ret_json = array();
		foreach($result_parent as $p_val)
		{
			$p_id = $p_val['id'];
			$sql_child="select m.id, m.name, m.url from Privilege p, Menu m where p.menu_id=m.id and m.parent=$p_id and p.rule_id=(select rule_id from User where id='$us_id')";
			$result_child = $db->Exec($sql_child, true);
			
			$p_val['menu-list']=$result_child;
			array_push($ret_json, $p_val);
		}
		$db->Close();
		return $ret_json;
	}
}