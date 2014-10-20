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

    public function getArticleCategory($categoryId)
    {
        $categoryId = (int) $categoryId;
        $queryString = ""
            . "SELECT * FROM article_categories "
            . "WHERE article_categories.id_article_category = '{$categoryId}' "
            . "LIMIT 1";
        return $this->db->query($queryString)->getOne();
    }

    public function getRoles()
    {
        $queryString = "SELECT * FROM roles";
        return $this->db->query($queryString)->getResults();
    }

    public function getFormasPago()
    {
        $queryString = "SELECT * FROM formas_pago";
        return $this->db->query($queryString)->getResults();
    }

    public function getBancos()
    {
        $queryString = "SELECT * FROM bancos";
        return $this->db->query($queryString)->getResults();
    }

    public function getTipoCheques()
    {
        $queryString = "SELECT * FROM tipo_cheques";
        return $this->db->query($queryString)->getResults();
    }

    public function getConceptos()
    {
        $queryString = "SELECT * FROM conceptos";
        return $this->db->query($queryString)->getResults();
    }

    public function getUsers()
    {
        $queryString = "SELECT * FROM users";
        return $this->db->query($queryString)->getResults();
    }

    public function getCheques()
    {
        $queryString = ""
            . "SELECT cheques.*, bancos.nombre as banco, tipo_cheques.detalle as tipo_cheque "
            . "FROM cheques "
            . "INNER JOIN tipo_cheques ON cheques.id_tipo_cheque = tipo_cheques.id_tipo_cheque "
            . "INNER JOIN bancos ON cheques.id_banco = bancos.id_banco "
            . "ORDER BY cheques.fecha_emision ASC ";
        return $this->db->query($queryString)->getResults();
    }

    public function getArticleTypes()
    {
        $queryString = "SELECT * FROM article_types";
        return $this->db->query($queryString)->getResults();
    }

    public function getArticles($filterOfertas = false)
    {
        $queryString = $filterOfertas ?
            "SELECT id_article, title, id_article_category FROM articles WHERE oferta > 0" :
            "SELECT id_article, title, id_article_category FROM articles";
        return $this->db->query($queryString)->getResults();
    }

    public function getArticleCategoryByName($name)
    {
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

    public function getUserById($userId)
    {
        $queryString = ""
            . "SELECT users.*, roles.name AS role FROM users "
            . "INNER JOIN roles ON users.id_role = roles.id_role "
            . "WHERE id_user='{$userId}' LIMIT 1";

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
            . "WHERE articles.id_article_category='{$categoryId}' AND articles.id_article != '{$except}' "
            . "ORDER BY articles.id_article_type, articles.id_article DESC LIMIT {$limit}";

        return $this->db->query($queryString)->getResults();
    }

    public function addArticle($article, $userId)
    {
        $article = (object) $article;
        $article->price = (float) str_replace(',', '.', $article->price);
        $queryString = ""
            . "INSERT INTO articles ("
                . "id_article_category, id_article_type, id_author,"
                . "title, description, location, address, price, oferta)"
            . "VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');";

        $queryString = sprintf($queryString,
            $this->db->escape($article->id_article_category),
            $this->db->escape($article->id_article_type),
            $this->db->escape((int) $userId),
            $this->db->escape($article->title),
            $this->db->escape($article->description),
            $this->db->escape($article->location),
            $this->db->escape($article->address),
            $this->db->escape($article->price),
            $this->db->escape($article->oferta)
        );
        $success = $this->db->query($queryString)->getResponse();
        return $success ? $this->db->getLastRecordId() : false;
    }

    public function addUser($user)
    {
        $user = (object) $user;
        $user->password = $this->hashPassword($user->password);

        $queryString = ""
            . "INSERT INTO users ("
                . "id_role, username, password, first_name, last_name) "
            . "VALUES ('%s', '%s', '%s', '%s', '%s');";

        $queryString = sprintf($queryString,
            $this->db->escape((int) $user->id_role),
            $this->db->escape($user->username),
            $this->db->escape($user->password),
            $this->db->escape($user->first_name),
            $this->db->escape($user->last_name)
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

    public function getMovimientos($limit = 50)
    {
        $limit = (int) $limit;
        $queryString = ""
            . "SELECT movimientos_diarios.*, "
                . "users.*, "
                . "conceptos.detalle AS concepto_detalle, "
                . "conceptos.tipos_movimientos AS tipo_movimiento, "
                . "formas_pago.detalle AS forma_pago_detalle "
            . "FROM movimientos_diarios "
                . "INNER JOIN formas_pago ON movimientos_diarios.id_forma_pago = formas_pago.id_forma_pago "
                . "INNER JOIN conceptos ON movimientos_diarios.id_concepto = conceptos.id_concepto "
                . "INNER JOIN users ON movimientos_diarios.id_user = users.id_user "
            . "ORDER BY movimientos_diarios.fecha, movimientos_diarios.id_movimiento DESC LIMIT {$limit}";

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

    public function addBank($bank)
    {
        $bank = (object) $bank;

        $queryString = ""
            . "INSERT INTO bancos ("
                . "nombre, sucursal, direccion)"
            . "VALUES ('%s', '%s', '%s');";

        $queryString = sprintf($queryString,
            $this->db->escape($bank->nombre),
            $this->db->escape($bank->sucursal),
            $this->db->escape($bank->direccion)
        );
        $success = $this->db->query($queryString)->getResponse();
        return $success ? $this->db->getLastRecordId() : false;
    }

    public function addMovimientoDiario($mov)
    {
        $mov = (object) $mov;
        $mov->debe = str_replace(',', '.', $mov->debe);
        $mov->haber = str_replace(',', '.', $mov->haber);
        $mov->iva = isset($mov->iva) ? $mov->iva : 0;

        $queryString = ""
            . "INSERT INTO movimientos_diarios ("
                . "id_user, id_concepto, id_forma_pago, fecha, debe, haber, iva)"
            . "VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');";

        $queryString = sprintf($queryString,
            $this->db->escape($mov->id_user),
            $this->db->escape($mov->id_concepto),
            $this->db->escape($mov->id_forma_pago),
            $this->db->escape($mov->fecha),
            $this->db->escape($mov->debe),
            $this->db->escape($mov->haber),
            $this->db->escape($mov->iva)
        );
        $success = $this->db->query($queryString)->getResponse();
        return $success ? $this->db->getLastRecordId() : false;
    }

    public function addCheque($cheque)
    {
        $cheque = (object) $cheque;
        $queryString = ""
            . "INSERT INTO cheques ("
                . "id_tipo_cheque, id_banco, numero, importe, fecha_emision, fecha_cobro, fecha_vencimiento)"
            . "VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');";

        $queryString = sprintf($queryString,
            $this->db->escape($cheque->id_tipo_cheque),
            $this->db->escape($cheque->id_banco),
            $this->db->escape($cheque->numero),
            $this->db->escape($cheque->importe),
            $this->db->escape($cheque->fecha_emision),
            $this->db->escape($cheque->fecha_cobro),
            $this->db->escape($cheque->fecha_vencimiento)
        );
        $success = $this->db->query($queryString)->getResponse();
        return $success ? $this->db->getLastRecordId() : false;
    }

    public function addChequeTipo($chequeType)
    {
        $chequeType = (object) $chequeType;

        $queryString = ""
            . "INSERT INTO tipo_cheques ("
                . "detalle)"
            . "VALUES ('%s');";

        $queryString = sprintf($queryString,
            $this->db->escape($chequeType->detalle)
        );
        $success = $this->db->query($queryString)->getResponse();
        return $success ? $this->db->getLastRecordId() : false;
    }

    public function addFormaPago($formaPago)
    {
        $formaPago = (object) $formaPago;

        $queryString = ""
            . "INSERT INTO formas_pago ("
                . "detalle)"
            . "VALUES ('%s');";

        $queryString = sprintf($queryString,
            $this->db->escape($formaPago->detalle)
        );
        $success = $this->db->query($queryString)->getResponse();
        return $success ? $this->db->getLastRecordId() : false;
    }

    public function addConcepto($concepto)
    {
        $concepto = (object) $concepto;

        $queryString = ""
            . "INSERT INTO conceptos ("
                . "tipos_movimientos, detalle)"
            . "VALUES ('%s', '%s');";

        $queryString = sprintf($queryString,
            $this->db->escape($concepto->tipos_movimientos),
            $this->db->escape($concepto->detalle)
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
                . "address = '%s', price = '%s', oferta = '%s' "
            . " WHERE id_article = '%s';";

        $queryString = sprintf($queryString,
            $this->db->escape($article->id_article_category),
            $this->db->escape($article->id_article_type),
            $this->db->escape($article->title),
            $this->db->escape($article->description),
            $this->db->escape($article->location),
            $this->db->escape($article->address),
            $this->db->escape($article->price),
            $this->db->escape(isset($article->oferta) ? $article->oferta : 0),
            $this->db->escape((int) $id)
        );

        return $this->db->query($queryString)->getResponse();
    }

    public function editUser($id, $user)
    {
        $user = (object) $user;
        $user->password = $this->hashPassword($user->password);
        $queryString = ""
            . "UPDATE users SET "
                . "id_role = '%s', username = '%s', "
                . "password = '%s', first_name = '%s', last_name = '%s' "
            . " WHERE id_user = '%s';";

        $queryString = sprintf($queryString,
            $this->db->escape($user->id_role),
            $this->db->escape($user->username),
            $this->db->escape($user->password),
            $this->db->escape($user->first_name),
            $this->db->escape($user->last_name),
            $this->db->escape((int) $id)
        );

        $success = $this->db->query($queryString)->getResponse();
        if ($success && $id === $this->io->getSession('user')->id_user) {
            $this->loginUser($this->getUserById($id));
        }
        return $success;
    }

    public function getSaldoActual()
    {
        $suma_debe = $suma_haber = 0;
        foreach($this->getMovimientos() as $mov) {
            $debe_iva = ($mov->debe * $mov->iva / 100) + $mov->debe;
            $haber_iva = ($mov->haber * $mov->iva / 100) + $mov->haber;
            $suma_debe += $debe_iva;
            $suma_haber += $haber_iva;
        }
        return $suma_haber - $suma_debe;
    }

    public function getSaldoCarteraCheques()
    {
        $suma = 0;
        foreach($this->getCheques() as $cheque) {
            $suma += $cheque->importe;
        }
        return $suma;
    }

    public function deleteUser($id)
    {
        $id = (int) $id;
        $queryString = "DELETE FROM users WHERE id_user = '{$id}';";
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

    public function getImageByCategory($categoryId)
    {
        $images = array(
            '1' => 'assets/images/depto-mini.jpg',
            '2' => 'assets/images/parking-mini.jpg',
            '3' => 'assets/images/piso-mini.jpg',
            '4' => 'assets/images/local-mini.jpg',
        );
        return isset($images[$categoryId]) ? $images[$categoryId] : '';
    }

}