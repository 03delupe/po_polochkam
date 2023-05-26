<?php

namespace controllers;

use Controller\AbstractController;
use Priority;

class PriorityController extends AbstractController
{
    private $sql = 'SELECT * FROM priorities ORDER BY id';
    private $dropSql = 'DELETE FROM priorities WHERE id=:id';
    private $updateSql = 'UPDATE priorities SET name = ?, color = ? WHERE id = ?';
    private $createSql = 'INSERT INTO priorities (name, color) VALUES (?, ?)';

    public function get()
    {
        $dataset = [];
        $result = parent::ExecDBQuery($this->sql, []);

        if (count($result['data']) > 0) {
            for ($i = 0; $i < count($result['data']); $i++) {
                $temp = new Priority();
                $temp->id = $result['data'][$i]['id'];
                $temp->name = $result['data'][$i]['name'];
                $temp->color = $result['data'][$i]['color'];
                array_push($dataset, $temp);
            }
        }

        return $dataset;
    }

    public function create(Priority $item)
    {
        $parms = [
            $item->name,
            $item->color,
        ];

        $result = parent::DbInteraction(
            $this->createSql,
            $parms
        );

        return $result;
    }

    public function update(Priority $item)
    {
        $parms = [
            $item->name,
            $item->color,
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
