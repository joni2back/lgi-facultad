<?php

class MySQLConnection
{
    private $_dbLink, $_queryResponse;
    public $lastResult;

    public function __construct()
    {
        $this->_connect();
    }

    private function _connect()
    {
        $this->_dbLink = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
        mysqli_select_db($this->_dbLink, MYSQL_DATABASE);
    }

    public function query($query)
    {
        $this->_queryResponse = mysqli_query($this->_dbLink, $query);
        return $this;
    }

    public function getResults()
    {
        $this->lastResult = array();
        if ($this->_queryResponse && !is_bool($this->_queryResponse)) {
            while ($response = mysqli_fetch_object($this->_queryResponse)) {
                $this->lastResult[] = $response;
            }
            mysqli_free_result($this->_queryResponse);
        }
        return $this->lastResult;
    }

    public function getOne()
    {
        $this->lastResult = null;
        if ($this->_queryResponse && !is_bool($this->_queryResponse)) {
            $this->lastResult = mysqli_fetch_object($this->_queryResponse);
            mysqli_free_result($this->_queryResponse);
        }
        return $this->lastResult;
    }

    public function disconnect()
    {
        return mysqli_close($this->_dbLink);
    }
}

