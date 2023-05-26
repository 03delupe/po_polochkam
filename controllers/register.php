<?php

/** Регистрация */

namespace controllers;

use Controller\AbstractController;
use User;

/** Регистрация */
class Register extends AbstractController
{
    private $sql = 'INSERT INTO users (login, password, role) VALUES (?,?,?)';
    private $checkUserSql = 'SELECT id FROM users WHERE login = :login LIMIT 1';

    /**Регистрация пользователя в системе */
    public function rgister(User $user)
    {
        return parent::DbInteraction(
            $this->sql,
            array($user->login, sha1($user->password), $user->role)
        );
    }

    /** Проверить существование пользователя с таким же логином */
    public function checkUser(User $user)
    {
        $result = parent::ExecDBQuery(
            $this->checkUserSql,
            array(':login' => $user->login)
        );

        if (count($result['data']) > 0) {
            return false;
        }

        return true;
    }
}
