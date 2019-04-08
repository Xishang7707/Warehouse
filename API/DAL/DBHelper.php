<?php
namespace DAL;

class DBHelper
{
	protected static $dbconfig;
	protected $conn;
	public static function Init($config)
	{
		self::$dbconfig=$config;
	}
	
	public function __construct()
	{
		$this->conn = new \mysqli(
						self::$dbconfig['host'],
						self::$dbconfig['username'], 
						self::$dbconfig['password'],
						self::$dbconfig['dbname']);

		if(!$this->conn)
			throw new \Exception('数据库连接失败');
		$this->conn->query('SET NAMES utf8');
	}

	public function Exec($sql, $is_arr=false)
	{
		$result = $this->conn->query($sql);
		
		if(!$result)
			return null;

		if($is_arr)
		{
			
			$ret_json = array();
			while ($dt = $result->fetch_assoc())
				array_push($ret_json, $dt);
			return $ret_json;
		}
		return $result;
	}
	public function Close()
	{
		$this->conn->close();
	}
	/**
	 * 开启事务
	 */
	public function Autocommit($flag=false)
	{
		$this->conn->autocommit($flag);
	}
	
	/**
	 * 提交事务
	 */
	public function Commit()
	{
		$this->conn->commit();
	}
	/**
	 * 回滚事务
	 */
	public function Rollback()
	{
		$this->conn->rollback();
	}
	/**
	 * 错误
	 */
	public function Errno()
	{
		return $this->conn->errno;
	}
}