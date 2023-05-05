<?php

namespace App\Controller;

use App\Model\UserModel;
use mysql_xdevapi\Exception;

/**
 * Class PostsController
 */
class UserController
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index(): void
    {
        if ($_SESSION['login']) {
            require_once(__DIR__ . '/../View/home.php');
            exit();
        }

        require_once(__DIR__ . '/../View/login.php');
    }

    /**
     * CheckUser method
     *
     * @return bool
     */
    public function checkUser(): bool
    {
        $username = filter_input(INPUT_POST, 'username');
        $password = base64_encode(filter_input(INPUT_POST, 'password'));
        $_SESSION['login'] = $this->userModel->getUser($username, $password);

        if (empty($_SESSION['login'])) {
            return false;
        }

        header('Location: /');
        return true;
    }

    /**
     * LogoutUser method
     *
     * @return void
     */
    public function logoutUser(): void
    {
        $_SESSION['login'] = '';
        header('Location: /login');
    }

    /**
     * LogoutUser method
     *
     * @return void
     */
    public function userGuest(): void
    {
        $_SESSION['login'] =
            [
                '0' =>
                    [
                        'typeUser' => 0
                    ]
            ];
        header('Location: /');
    }

    /**
     * Posts method
     *
     * @return array
     */
    public function allUsers(): array
    {
        return $this->userModel->getAllUsers();
    }

    /**
     * add method
     *
     * @return bool
     */
    public function add(): bool
    {
        try {
            $user = filter_input(INPUT_POST, 'username');
            $password = base64_encode(filter_input(INPUT_POST, 'password'));
            $author = filter_input(INPUT_POST, 'userType') == 'admin' ? 1 : 2;

            if (!$user || !$password) {
                return false;
            }

            $this->userModel->setUser($user, $password, $author);
            header('Location: /admin');

            return true;
        } catch (Exception){
            echo "Não foi possivel adicionar esse post";
        }
    }

    /**
     * delete method
     *
     * @return bool
     */
    public function delete(): bool
    {
        $id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
        $this->userModel->deletePost($id);

        header('Location: /admin');

        return true;
    }
}
