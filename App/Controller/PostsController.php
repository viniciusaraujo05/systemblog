<?php

namespace App\Controller;

use App\Model\PostsModel;

/**
 * Class PostsController
 */
class PostsController
{

    private $posts;

    public function __construct()
    {
        $this->posts = new PostsModel();
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index(): void
    {
        require_once(__DIR__ . '/../View/home.php');
    }

    /**
     * Posts method
     *
     * @return array
     */
    public function allPosts(): array
    {
        return $this->posts->getAllPosts();
    }

    /**
     * AddPost method
     *
     * @return bool
     */
    public function add(): bool
    {
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        $author = $_SESSION['login']['0']['users'];

        if (!$title || !$description) {
            return false;
        }

        $this->posts->setPost($title, $description, $author);
        header('Location: /');

        return true;
     }

    /**
     * Update method
     *
     * @return bool
     */
    public function update(): bool
    {
        $id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');

        if (!$title || !$description) {
            return false;
        }

        $this->posts->updatePost($id, $title, $description);

        header('Location: /');

        return true;
    }

    /**
     * Update method
     *
     * @return bool
     */
    public function delete(): bool
    {
        $id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);

        $this->posts->deletePost($id);

        header('Location: /');

        return true;
    }
}
