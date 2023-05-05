<?php

namespace App\Model;

use Connection\Connection;

use Exception;
use PDO;
use PDOException;

/**
 * Class PostsModel
 */
class PostsModel extends Connection
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
    public function getAllPosts(): bool|array
    {
        try {
            $stmt = $this->_connection->prepare(
                "SELECT * FROM posts"
            );
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * GetPosts method
     *
     * @return bool|array
     */
    public function getPost($id): bool|array
    {
        try {
            $stmt = $this->_connection->prepare(
                "SELECT * FROM posts WHERE id = ?"
            );
            $stmt->bindValue(1, $id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }


    /**
     * setPost method
     *
     * @param $title
     * @param $description
     * @param $author
     *
     * @return void
     */
    public function setPost($title, $description, $author): bool
    {
        try {
            $stm = $this->_connection->prepare(
                "INSERT INTO posts (`title`, `description`, `author`) VALUES (?,?,?)"
            );

            $stm->bindValue(1, $title);
            $stm->bindValue(2, $description);
            $stm->bindValue(3, $author);
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
                "UPDATE posts SET title = '$title', description = '$description' WHERE id = $id"
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
                "DELETE FROM posts WHERE id = $id"
            );
            $stm->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}