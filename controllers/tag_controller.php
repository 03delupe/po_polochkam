<?php

namespace controllers;

use Controller\AbstractController;
use Tag;

class TagController extends AbstractController
{
    private $sql = 'SELECT * FROM tags ORDER BY id';
    private $dropSql = 'DELETE FROM tags WHERE id=:id';
    private $updateSql = 'UPDATE tags SET name = ?, id_creator = ? WHERE id = ?';
    private $createSql = 'INSERT INTO tags (name, id_creator) VALUES (?, ?)';

    public function get()
    {
        $dataset = [];
        $result = parent::ExecDBQuery($this->sql, []);

        if (count($result['data']) > 0) {
            for ($i = 0; $i < count($result['data']); $i++) {
                $temp = new Tag();
                $temp->id = $result['data'][$i]['id'];
                $temp->name = $result['data'][$i]['name'];
                $temp->id_creator = $result['data'][$i]['id_creator'];
                array_push($dataset, $temp);
            }
        }

        return $dataset;
    }

    public function create(Tag $item)
    {
        $parms = [
            $item->name,
            $item->id_creator,
        ];

        $result = parent::DbInteraction(
            $this->createSql,
            $parms
        );

        return $result;
    }

    public function update(Tag $item)
    {
        $parms = [
            $item->name,
            $item->id_creator,
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
