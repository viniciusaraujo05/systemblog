<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author      Webjump Core Team <dev@webjump.com.br>
 * @copyright   2022 Webjump (http://www.webjump.com.br)
 * @license     http://www.webjump.com.br Copyright
 * @link        http://www.webjump.com.br
 */

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