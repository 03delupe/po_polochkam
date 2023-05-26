<?php

namespace controllers;

use Controller\AbstractController;
use Project;

class ProjectController extends AbstractController
{
    private $sql = 'SELECT * FROM projects ORDER BY id';
    private $dropSql = 'DELETE FROM projects WHERE id=:id';
    private $updateSql = 'UPDATE projects SET name = ? WHERE id = ?';
    private $createSql = 'INSERT INTO projects (name) VALUES (?)';

    public function get()
    {
        $dataset = [];
        $result = parent::ExecDBQuery($this->sql, []);

        if (count($result['data']) > 0) {
            for ($i = 0; $i < count($result['data']); $i++) {
                $temp = new Project();
                $temp->id = $result['data'][$i]['id'];
                $temp->name = $result['data'][$i]['name'];
                array_push($dataset, $temp);
            }
        }

        return $dataset;
    }

    public function create(Project $item)
    {
        $parms = [
            $item->name
        ];

        $result = parent::DbInteraction(
            $this->createSql,
            $parms
        );

        return $result;
    }

    public function update(Project $item)
    {
        $parms = [
            $item->name,
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
