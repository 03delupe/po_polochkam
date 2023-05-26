<?php

namespace controllers;

use Controller\AbstractController;
use TaskTag;

class TaskTagController extends AbstractController
{
    private $sql = 'SELECT * FROM tasks_tags ORDER BY id';
    private $dropSql = 'DELETE FROM tasks_tags WHERE id=:id';
    private $updateSql = 'UPDATE tasks_tags SET id_task = ?, id_tag = ? WHERE id = ?';
    private $createSql = 'INSERT INTO tasks_tags (id_task, id_tag) VALUES (?, ?)';

    public function get()
    {
        $dataset = [];
        $result = parent::ExecDBQuery($this->sql, []);

        if (count($result['data']) > 0) {
            for ($i = 0; $i < count($result['data']); $i++) {
                $temp = new TaskTag();
                $temp->id = $result['data'][$i]['id'];
                $temp->id_task = $result['data'][$i]['id_task'];
                $temp->id_tag = $result['data'][$i]['id_tag'];
                array_push($dataset, $temp);
            }
        }

        return $dataset;
    }

    public function create(TaskTag $item)
    {
        $parms = [
            $item->id_task,
            $item->id_tag,
        ];

        $result = parent::DbInteraction(
            $this->createSql,
            $parms
        );

        return $result;
    }

    public function update(TaskTag $item)
    {
        $parms = [
            $item->id_task,
            $item->id_tag,
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
