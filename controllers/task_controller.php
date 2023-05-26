<?php

namespace controllers;

use Controller\AbstractController;
use Task;

class TaskController extends AbstractController
{
    private $sql = 'SELECT * FROM tasks ORDER BY id DESC';
    private $dropSql = 'DELETE FROM tasks WHERE id=:id';
    private $updateSql = 'UPDATE tasks SET title = ?, description = ?, id_priority = ?, dat = ?, id_project = ?, status = ? WHERE id = ?';
    private $createSql = 'INSERT INTO tasks (title, description, id_priority, dat, id_project, status) VALUES (?, ?, ?, ?, ?, ?)';
    private $closeTaskSql = 'UPDATE tasks SET status = 1 WHERE id = ?';

    private $delTasksUser = 'DELETE FROM tasks_users WHERE id_task = ?';
    private $delTasksTag = 'DELETE FROM tasks_tags WHERE id_task = ?';

    public function get()
    {
        $dataset = [];
        $result = parent::ExecDBQuery($this->sql, []);

        if (count($result['data']) > 0) {
            for ($i = 0; $i < count($result['data']); $i++) {
                $temp = new Task();
                $temp->id = $result['data'][$i]['id'];
                $temp->title = $result['data'][$i]['title'];
                $temp->description = $result['data'][$i]['description'];
                $temp->id_priority = $result['data'][$i]['id_priority'];
                $temp->dat = $result['data'][$i]['dat'];
                $temp->id_project = $result['data'][$i]['id_project'];
                $temp->status = $result['data'][$i]['status'];
                array_push($dataset, $temp);
            }
        }

        return $dataset;
    }

    public function create(Task $item)
    {
        $parms = [
            $item->title,
            $item->description,
            $item->id_priority,
            $item->dat,
            $item->id_project,
            $item->status,
        ];

        $result = parent::DbInteraction(
            $this->createSql,
            $parms
        );

        return $result;
    }

    public function update(Task $item)
    {
        $parms = [
            $item->title,
            $item->description,
            $item->id_priority,
            $item->dat,
            $item->id_project,
            $item->status,
            $item->id
        ];

        $result = parent::DbInteraction(
            $this->updateSql,
            $parms
        );

        return $result;
    }

    public function closeTask($id)
    {
        parent::DbInteraction($this->closeTaskSql, [$id]);
    }

    public function delete($id)
    {
        $this->deleteAll($id);
        parent::DbInteraction($this->dropSql, [':id' => $id]);
    }

    private function deleteAll($id)
    {
        $parms = [
            $id
        ];

        parent::DbInteraction($this->delTasksUser, $parms);
        parent::DbInteraction($this->delTasksTag, $parms);
    }
}
