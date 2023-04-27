<?php

namespace App\Controller;

use App\Model\PostsModel;

/**
 * Class PostsController
 */
class PostsController
{
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
        $posts = new PostsModel();
        return $posts->getAllPosts();
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
        $author = 'Anonymous';

        if (!$title || !$description) {
            return false;
        }

        $posts = new PostsModel();
        $posts->setPost($title, $description, $author);
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

        $posts = new PostsModel();
        $posts->updatePost($id, $title, $description);

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

        $posts = new PostsModel();
        $posts->deletePost($id);

        header('Location: /');

        return true;
    }
}
