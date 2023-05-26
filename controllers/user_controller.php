<?php

/** Контроллер для пользователей */

namespace controllers;

use Controller\AbstractController;
use User;

class UserController extends AbstractController
{
    private $sql = 'SELECT id, login, role FROM users ORDER BY id';
    private $dropSql = 'DELETE FROM users WHERE id=:id';
    private $updateSql = 'UPDATE users SET login = ?, role = ? ';

    /** Получить список пользователей */
    public function get()
    {
        $usersList = [];
        $result = parent::ExecDBQuery($this->sql, []);

        if (count($result['data']) > 0) {
            for ($i = 0; $i < count($result['data']); $i++) {
                $temp = new User();
                $temp->id = $result['data'][$i]['id'];
                $temp->login = $result['data'][$i]['login'];
                $temp->role = $result['data'][$i]['role'];
                array_push($usersList, $temp);
            }
        }

        return $usersList;
    }

    /** Обновить пользовательские данные */
    public function update(User $user)
    {
        $parms = [
            $user->login,
            $user->role,
        ];

        if ($user->password != '') {
            $this->updateSql .= ', password=?';
            array_push($parms, $user->password);
        }

        $this->updateSql .= ' WHERE id=?';

        array_push($parms, $user->id);

        $result = parent::DbInteraction(
            $this->updateSql,
            $parms
        );

        return $result;
    }

    /** Удаление учетной записи пользователя */
    public function delete($id)
    {
        parent::DbInteraction($this->dropSql, [':id' => $id]);
    }
}
