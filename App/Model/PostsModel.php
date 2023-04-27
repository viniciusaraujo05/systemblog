<?php
namespace App\Model;

use Connection\Connection;

use Exception;
use PDO;
use PDOException;

/**
 * Class PostsModel
 */
class PostsModel extends Connection {

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
    public function getAllPosts (): bool|array
    {
        try {
            $stmt = $this->_connection->prepare("SELECT * FROM posts");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }

    /**
     * UpdatePosts method
     *
     * @param $title
     * @param $description
     * @param $author
     *
     * @return void
     */
    public function setPost($title, $description, $author): bool
    {
        try{
            $stm = $this->_connection->prepare(
                "INSERT INTO posts (`title`, `description`, `author`) VALUES (?,?,?)");

            $stm->bindValue(1, $title);
            $stm->bindValue(2, $description);
            $stm->bindValue(3, $author);
            $stm->execute();

            return true;

        } catch (PDOException $e){
            return false;
        }
    }

}