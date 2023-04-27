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
    public function posts(): array
    {
        $posts = new PostsModel();
        return $posts->getAllPosts();
    }

    /**
     * AddPost method
     *
     * @return bool
     */
    public function addPost(): bool
    {
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        $author = 0;

        if (!$title || !$description) {
            return false;
        }

        $posts = new PostsModel();
        $posts->setPost($title, $description, $author);

        return true;
     }
}
