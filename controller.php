<?php

/** Абстрактный класс контроллера. Здесь прописаны 3 ф-ции общие для всех контроллеров:
 * это получение подключения к бд, выполнения запросов на выборку данных из бд и 
 * выполнение запросов на вставку, обновление и удаление
 */

namespace Controller;

require_once("./ssa/classes/db/db_connection.php");

use DBConnection\Command;
use DBConnection\DBConnection;

abstract class AbstractController
{
    /** Получение подключения к бд */
    private function get_connection($name)
    {
        $connection = DBConnection::getInstance($GLOBALS['DATABASES'], $name);
        return $connection->Connect();
    }

    /** Запрос на чтение данных */
    protected function ExecDBQuery($query, $params = array(), $db = 'MySql')
    {
        if (!$query) return;

        $cmd = new Command($this->get_connection($db), $query, $params);
        return $cmd->Execute();
    }

    /** Запрос на вставку, обновление, удаление данных */
    protected function DbInteraction($query, $params, $db = 'MySql')
    {
        $cmd = new Command($this->get_connection($db), $query, $params);
        return $cmd->ExecuteNonQuery();
    }
}
