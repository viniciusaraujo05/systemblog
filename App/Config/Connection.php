<?php

namespace Connection;

use Exception;
use PDO;

class Connection {

    public $_connection = null;

    /**
     * @throws Exception
     */
    public function __construct()
    {
//        try {
            $db_host = getenv('DB_HOST');
            $db_name = getenv('DB_NAME');
            $db_port = (int) getenv('DB_PORT');
            $db_user = getenv('DB_USER');
            $db_password = getenv('DB_PASSWORD');
            $this->_connection = new PDO("mysql:host={$db_host};port={$db_port};dbname={$db_name}", $db_user, $db_password, array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_EMULATE_PREPARES => true));

//        } catch (Exception $e) {
//
//            throw new Exception("Unable to connect to database. Error: " . json_encode(['dbhost' => $db_host, 'database_port' => $db_port, 'db_name' => $db_name]). $_SERVER['REQUEST_URI']);
//        }
    }

    public function __destruct()
    {
        $this->_connection = null;
    }
}
