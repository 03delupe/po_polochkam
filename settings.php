<?php

/** Здесь прописываем настройки для подключения к бд */
$DATABASES = [
    "MySql" => [
        "NAME" => "todo_list",
        "HOST" => "localhost",
        "USER" => "root",
        "PASSWORD" => "mysql",
        "CHARSET" => "SET NAMES utf8",
        "DRIVER" => "mysql"
    ]
];

/** Основной файл шаблонов. Служит как точка входа при отображении страниц */
define("__BASE_FILE__", "base.php");
/** Ссылка, чтобы каждый раз руками не прописывать везде */
define("__URL__", "http://localhost/todolist/");
