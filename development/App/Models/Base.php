<?php

class App_Models_Base {
    protected static $config = array(
        'host'     => '127.0.0.1',
        'username' => 'root',
        'password' => '1234',
        'dbname'   => 'cdcol'
    );    
    protected static $connection;
    protected $db;
	protected static function getDb ()
	{
		if (!self::$connection) {
            self::$connection = Zend_Db::factory("Pdo_Mysql", self::$config)->getConnection();
        }
        return self::$connection;
	}
    public function __construct() {
		$this->db = self::getDb();
    }
	public function __set ($name, $value)
	{
		$this->$name = $value;
	}
	public function _get ($name)
	{
		if (isset($this->$name)) return $this->$name;
		return NULL;
	}
}

