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

    public function getSectionName()
    {
        $page = $this->io->getQuery('page');
        $page = str_replace('-', '_', $page);
        return $page && is_string($page) ? $page : 'index';
    }

    public function isAdmin()
    {
        $user = $this->io->getSession('user');
        return isset($user->role) && $user->role === 'Administrador';
    }

    public function getArticleCategoryByName($name)
    {
        $password = $this->hashPassword($password);
        $queryString = ""
            . "SELECT * FROM article_categories "
            . "WHERE name LIKE '{$name}%' LIMIT 1";

        $category = $this->db->query($queryString)->getOne();
        return $category ? $category->id : null;
    }

    public function getUserByCredentials($username, $password)
    {
        $password = $this->hashPassword($password);
        $queryString = ""
            . "SELECT users.*, roles.name AS role FROM users "
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

    public function getArticlesByCategory($categoryId, $limit = 4)
    {
        $categoryId = (int) $categoryId;
        $limit = (int) $limit;
        $queryString = ""
            . "SELECT articles.*, "
                . "users.username, "
                . "article_types.name AS article_type, "
                . "article_categories.name AS article_category "
            . "FROM articles "
                . "INNER JOIN article_categories ON articles.id_article_category = article_categories.id "
                . "INNER JOIN article_types ON articles.id_article_type = article_types.id "
                . "INNER JOIN users ON articles.id_author = users.id "
            . "WHERE articles.id_article_category='{$categoryId}' LIMIT {$limit}";

        return $this->db->query($queryString)->getResults();
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