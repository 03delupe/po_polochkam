<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR | E_PARSE);

session_start();

/** Объединяем все входящие параметры в один массив, чтобы легче было обрабатывать в ф-циях в app.php */
if (isset($_POST) || isset($_GET) || isset($_FILES)) $input = array_merge($_GET, $_POST, $_FILES);

/** Настройки */
include_once("settings.php");
/** Функционал приложения */
include_once("app.php");
/** Маршрутизатор */
include_once("router.php");
