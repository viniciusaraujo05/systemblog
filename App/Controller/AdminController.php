<?php
declare(strict_types=1);

namespace App\Controller;

class AdminController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index(): void
    {
        if ($_SESSION['login']['0']['typeUser'] == 1 ) {
            require_once(__DIR__ . '/../View/admin.php');
            exit();
        }
        require_once(__DIR__ . '/../View/home.php');
    }
}
