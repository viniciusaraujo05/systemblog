<?php

namespace App\Model;

use Connection\Connection;

use Exception;
use PDO;
use PDOException;

/**
 * Class PostsModel
 */
class UserModel extends Connection
{

    /**
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * GetAllPosts method
     *
     * @return bool|array
     */
    public function getUser($user, $password): bool|array
    {
        try {
            $stmt = $this->_connection->prepare("SELECT * FROM users WHERE users = '$user' AND password = '$password'");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }
}