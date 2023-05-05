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
            $stmt = $this->_connection->prepare(
                "SELECT * FROM users WHERE users = '$user' AND password = '$password'"
            );
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * GetAllPosts method
     *
     * @return bool|array
     */
    public function getAllUsers(): bool|array
    {
        try {
            $stmt = $this->_connection->prepare(
                "SELECT * FROM users"
            );
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * setUser method
     *
     * @param string $user
     * @param string $password
     * @param string $typeUser
     * @return bool
     */
    public function setUser(string $user, string $password, string $typeUser): bool
    {
        try {
            $stm = $this->_connection->prepare(
                "INSERT INTO users (`users`, `password`, `typeUser`) VALUES (?,?,?)"
            );

            $stm->bindValue(1, $user);
            $stm->bindValue(2, $password);
            $stm->bindValue(3, $typeUser);
            $stm->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * UpdatePost method
     *
     * @param int $id
     * @param String $title
     * @param String $description
     *
     * @return bool
     */
    public function updatePost(int $id, string $title, string $description): bool
    {
        try {
            $stm = $this->_connection->prepare(
                "UPDATE users SET title = '$title', description = '$description' WHERE id = $id"
            );
            $stm->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * DeletePost method
     *
     * @param int $id
     *
     * @return bool
     */
    public function deletePost(int $id): bool
    {
        try {
            $stm = $this->_connection->prepare(
                "DELETE FROM users WHERE id = $id"
            );
            $stm->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}