<?php

class MySQLConnection
{
    private $_dbLink, $_queryResponse;
    public $lastResult;

    public function __construct($user, $pass, $host, $database)
    {
        $this->connect($user, $pass, $host, $database);
        @register_shutdown_function(array($this, 'disconnect'));
    }

    public function connect($user, $pass, $host, $database)
    {
        $this->_dbLink = mysqli_connect($host, $user, $pass);
        mysqli_select_db($this->_dbLink, $database);
    }

    public function escape($string)
    {
        return mysqli_real_escape_string($this->_dbLink, $string);
    }

    public function query($query)
    {
        $this->_queryResponse = mysqli_query($this->_dbLink, $query);
        return $this;
    }

    public function getResponse()
    {
        return $this->_queryResponse;
    }

    public function getLastRecordId()
    {
        return mysqli_insert_id($this->_dbLink);
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

