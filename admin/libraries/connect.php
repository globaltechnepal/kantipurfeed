<?php
session_start();
class erp_connect
{    
    private $_host = 'localhost';
    private $_username = 'root';
    private $_password = '';
    private $_database = 'kantipurfeed';
    
    protected $connection;
    
    public function __construct()
    {
        if (!isset($this->connection)) {
            
            $this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
	    mysqli_set_charset($this->connection,"utf8");
            
            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
        
        return $this->connection;
    }
}
?>