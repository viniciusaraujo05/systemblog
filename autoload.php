<?php
spl_autoload_register(function ($class_name) {
    $class_file = str_replace('\\', '/', $class_name) . '.php';
    require_once __DIR__ . '/App/Config/Connection.php';
    if (file_exists($class_file)) {
        require_once $class_file;
    }
});
