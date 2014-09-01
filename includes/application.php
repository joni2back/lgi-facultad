<?php

class Application
{
    protected $db;
    public $io;

    public function __construct(MySQLConnection $db, InputData $io)
    {
        @session_start();
        $this->db = $db;
        $this->io = $io;
    }

    public function getUserByCredentials($username, $password)
    {
        $password = $this->hashPassword($password);
        $queryString = ""
            . "SELECT users.*, roles.name FROM users "
            . "INNER JOIN roles ON users.id_role = roles.id "
            . "WHERE username='{$username}' AND password='{$password}' LIMIT 1";

        return $this->db->query($queryString)->getOne();
    }

    public function getArticleById($id)
    {
        $id = (int) $id;
        $queryString = ""
            . "SELECT articles.*, "
                . "users.username, "
                . "article_types.name AS article_type, "
                . "article_categories.name AS article_category "
            . "FROM articles "
                . "INNER JOIN article_categories ON articles.id_article_category = article_categories.id "
                . "INNER JOIN article_types ON articles.id_article_type = article_types.id "
                . "INNER JOIN users ON articles.id_author = users.id "
            . "WHERE articles.id='{$id}' LIMIT 1";

        return $this->db->query($queryString)->getOne();
    }

    public function loginUser($userResult)
    {
        @session_start();
        if (! (isset($userResult->id) && isset($userResult->username))) {
            return false;
        }

        $this->io->setSession('user', $userResult);
        $this->io->setSession('username', $userResult->username);
        return true;
    }

    public function hashPassword($password)
    {
        return md5('lgi:' . $password);
    }

    public function logout()
    {
        @session_start();
        $this->io->setSession('user', null);
        $this->io->setSession('username', null);
        @session_destroy();
    }

}