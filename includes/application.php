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

    public function getArticleCategories()
    {
        $queryString = "SELECT * FROM article_categories";
        return $this->db->query($queryString)->getResults();
    }

    public function getArticleTypes()
    {
        $queryString = "SELECT * FROM article_types";
        return $this->db->query($queryString)->getResults();
    }

    public function getArticles()
    {
        $queryString = "SELECT id_article, title FROM articles";
        return $this->db->query($queryString)->getResults();
    }

    public function getArticleCategoryByName($name)
    {
        $password = $this->hashPassword($password);
        $queryString = ""
            . "SELECT * FROM article_categories "
            . "WHERE name LIKE '{$name}%' LIMIT 1";

        $category = $this->db->query($queryString)->getOne();
        return $category ? $category->id_article_category : null;
    }

    public function getUserByCredentials($username, $password)
    {
        $password = $this->hashPassword($password);
        $queryString = ""
            . "SELECT users.*, roles.name AS role FROM users "
            . "INNER JOIN roles ON users.id_role = roles.id_role "
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
                . "INNER JOIN article_categories ON articles.id_article_category = article_categories.id_article_category "
                . "INNER JOIN article_types ON articles.id_article_type = article_types.id_article_type "
                . "INNER JOIN users ON articles.id_author = users.id_user "
            . "WHERE articles.id_article='{$id}' LIMIT 1";

        return $this->db->query($queryString)->getOne();
    }

    public function getArticlesByCategory($categoryId, $limit = 4, $except = null)
    {
        $categoryId = (int) $categoryId;
        $limit = (int) $limit;
        $except = (int) $except;
        $queryString = ""
            . "SELECT articles.*, "
                . "users.username, "
                . "article_types.name AS article_type, "
                . "article_categories.name AS article_category "
            . "FROM articles "
                . "INNER JOIN article_categories ON articles.id_article_category = article_categories.id_article_category "
                . "INNER JOIN article_types ON articles.id_article_type = article_types.id_article_type "
                . "INNER JOIN users ON articles.id_author = users.id_user "
            . "WHERE articles.id_article_category='{$categoryId}' AND articles.id_article != '{$except}' LIMIT {$limit}";

        return $this->db->query($queryString)->getResults();
    }

    public function addArticle($article, $userId)
    {
        $article = (object) $article;
        $article->price = (float) str_replace(',', '.', $article->price);
        $queryString = ""
            . "INSERT INTO articles ("
                . "id_article_category, id_article_type, id_author,"
                . "title, description, location, address, price)"
            . "VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');";

        $queryString = sprintf($queryString,
            $this->db->escape($article->id_article_category),
            $this->db->escape($article->id_article_type),
            $this->db->escape((int) $userId),
            $this->db->escape($article->title),
            $this->db->escape($article->description),
            $this->db->escape($article->location),
            $this->db->escape($article->address),
            $this->db->escape($article->price)
        );
        $success = $this->db->query($queryString)->getResponse();
        return $success ? $this->db->getLastRecordId() : false;
    }

    public function getQuestions($limit = 50)
    {
        $limit = (int) $limit;
        $queryString = ""
            . "SELECT consultas.*, "
                . "articles.title AS article_title, "
                . "article_types.name AS article_type, "
                . "article_categories.name AS article_category "
            . "FROM consultas "
                . "INNER JOIN articles ON consultas.id_article = articles.id_article "
                . "INNER JOIN article_categories ON articles.id_article_category = article_categories.id_article_category "
                . "INNER JOIN article_types ON articles.id_article_type = article_types.id_article_type "
            . "LIMIT {$limit}";

        return $this->db->query($queryString)->getResults();
    }

    public function addQuestion($question, $articleId)
    {
        $question = (object) $question;

        $queryString = ""
            . "INSERT INTO consultas ("
                . "id_article, name, email, phone, message, ip)"
            . "VALUES ('%s', '%s', '%s', '%s', '%s', '%s');";

        $queryString = sprintf($queryString,
            $this->db->escape($articleId),
            $this->db->escape($question->name),
            $this->db->escape($question->email),
            $this->db->escape($question->phone),
            $this->db->escape($question->message),
            $this->db->escape($this->io->getServer('REMOTE_ADDR'))
        );
        $success = $this->db->query($queryString)->getResponse();
        return $success ? $this->db->getLastRecordId() : false;
    }

    public function editArticle($id, $article)
    {
        $article = (object) $article;
        $article->price = (float) str_replace(',', '.', $article->price);
        $queryString = ""
            . "UPDATE articles SET "
                . "id_article_category = '%s', id_article_type = '%s', "
                . "title = '%s', description = '%s', location = '%s', "
                . "address = '%s', price = '%s' "
            . " WHERE id_article = '%s';";

        $queryString = sprintf($queryString,
            $this->db->escape($article->id_article_category),
            $this->db->escape($article->id_article_type),
            $this->db->escape($article->title),
            $this->db->escape($article->description),
            $this->db->escape($article->location),
            $this->db->escape($article->address),
            $this->db->escape($article->price),
            $this->db->escape((int) $id)
        );

        return $this->db->query($queryString)->getResponse();
    }

    public function deleteArticle($id)
    {
        $id = (int) $id;
        $queryString = "DELETE FROM articles WHERE id_article = '{$id}';";
        return $this->db->query($queryString)->getResponse();
    }

    public function loginUser($userResult)
    {
        @session_start();
        if (! (isset($userResult->id_user) && isset($userResult->username))) {
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