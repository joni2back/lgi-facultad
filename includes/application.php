<?php

class Application
{
    protected $db;
    protected $userId;

    public function __construct(MySQLConnection $db)
    {
        @session_start();
        $this->db = $db;
    }

    public function getUserByCredentials($username, $password)
    {
        $queryString = "SELECT * FROM usuarios WHERE username='{$username}' AND password='$password' LIMIT 1";
        $queryString = "SHOW DATABASES";
        return $this->db->query($queryString)->getOne();
    }

    public function loginUser(\stdClass $userResult)
    {
        @session_start();
        if (! (isset($userResult->id) && isset($userResult->username))) {
            return false;
        }

        $this->userId = $userResult->id;
        $this->setSessionVar('user', $userResult);
        $this->setSessionVar('username', $userResult->username);
        return true;
    }

    public function logout()
    {
        @session_start();
        $_SESSION['username'] = $_SESSION['userId'] = null;
        @session_destroy();
    }

    public function getSessionVar($name, $default = null)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : $default;
    }

    public function setSessionVar($name, $value)
    {
        return $_SESSION[$name] = $value;
    }
}
