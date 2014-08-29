<?php

class Application
{
    protected $db;
    public $io;
    protected $userId;

    public function __construct(MySQLConnection $db, InputData $io)
    {
        @session_start();
        $this->db = $db;
        $this->io = $io;
    }

    public function getUserByCredentials($username, $password)
    {
        $queryString = "SELECT * FROM users WHERE username='{$username}' AND password='{$password}' LIMIT 1";
        return $this->db->query($queryString)->getOne();
    }

    public function loginUser($userResult)
    {
        @session_start();
        if (! (isset($userResult->id) && isset($userResult->username))) {
            return false;
        }

        $this->userId = $userResult->id;
        $this->io->setSession('user', $userResult);
        $this->io->setSession('username', $userResult->username);
        return true;
    }

    public function logout()
    {
        @session_start();
        $this->io->setSession('user', null);
        $this->io->setSession('username', null);
        @session_destroy();
    }

}