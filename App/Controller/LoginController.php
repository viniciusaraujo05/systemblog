<?php

namespace App\Controller;

use App\Model\UserModel;
use Couchbase\User;

/**
 * Class PostsController
 */
class LoginController
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
        if($_SESSION['login']) {
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

        if(empty($_SESSION['login'])) {
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
}
