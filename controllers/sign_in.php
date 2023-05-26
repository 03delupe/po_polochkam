<?php

/** Аутентификация */

namespace controllers;

use Controller\AbstractController;
use User;

class SignIn extends AbstractController
{
    private $sql = 'SELECT id, role, login FROM users WHERE login = :login AND password = :password LIMIT 1';

    public function signIn(User $user)
    {
        $result = parent::ExecDBQuery(
            $this->sql,
            array(':login' => $user->login, ':password' => sha1($user->password))
        );

        if (count($result['data']) > 0) {
            $user = new User();
            $user->id = $result['data'][0]['id'];
            $user->login = $result['data'][0]['login'];
            $user->role = $result['data'][0]['role'];

            return $user;
        } else {
            return null;
        }
    }
}
