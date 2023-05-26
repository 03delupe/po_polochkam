<?php

namespace controllers;

use Controller\AbstractController;
use TaskUser;

class TaskUserController extends AbstractController
{
    private $sql = 'SELECT * FROM tasks_users ORDER BY id';
    private $dropSql = 'DELETE FROM tasks_users WHERE id=:id';
    private $updateSql = 'UPDATE tasks_users SET id_user = ?, id_task = ? WHERE id = ?';
    private $createSql = 'INSERT INTO tasks_users (id_user, id_task) VALUES (?, ?)';

    public function get()
    {
        $dataset = [];
        $result = parent::ExecDBQuery($this->sql, []);

        if (count($result['data']) > 0) {
            for ($i = 0; $i < count($result['data']); $i++) {
                $temp = new TaskUser();
                $temp->id = $result['data'][$i]['id'];
                $temp->id_user = $result['data'][$i]['id_user'];
                $temp->id_task = $result['data'][$i]['id_task'];
                array_push($dataset, $temp);
            }
        }

        return $dataset;
    }

    public function create(TaskUser $item)
    {
        $parms = [
            $item->id_user,
            $item->id_task,
        ];

        $result = parent::DbInteraction(
            $this->createSql,
            $parms
        );

        return $result;
    }

    public function update(TaskUser $item)
    {
        $parms = [
            $item->id_user,
            $item->id_task,
            $item->id
        ];

        $result = parent::DbInteraction(
            $this->updateSql,
            $parms
        );

        return $result;
    }

    public function delete($id)
    {
        parent::DbInteraction($this->dropSql, [':id' => $id]);
    }
}
