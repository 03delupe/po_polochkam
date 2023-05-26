<?php

namespace controllers;

use Controller\AbstractController;
use Comment;

class CommentController extends AbstractController
{
    private $sql = 'SELECT * FROM comments ORDER BY id';
    private $dropSql = 'DELETE FROM comments WHERE id=:id';
    private $updateSql = 'UPDATE comments SET id_task = ?, comment = ?, id_user = ? WHERE id = ?';
    private $createSql = 'INSERT INTO comments (id_task, comment, id_user) VALUES (?, ?, ?)';

    /** Получить список пользователей */
    public function get()
    {
        $dataset = [];
        $result = parent::ExecDBQuery($this->sql, []);

        if (count($result['data']) > 0) {
            for ($i = 0; $i < count($result['data']); $i++) {
                $temp = new Comment();
                $temp->id = $result['data'][$i]['id'];
                $temp->id_task = $result['data'][$i]['id_task'];
                $temp->comment = $result['data'][$i]['comment'];
                $temp->id_user = $result['data'][$i]['id_user'];
                array_push($dataset, $temp);
            }
        }

        return $dataset;
    }

    public function create(Comment $item)
    {
        $parms = [
            $item->id_task,
            $item->comment,
            $item->id_user
        ];

        $result = parent::DbInteraction(
            $this->createSql,
            $parms
        );

        return $result;
    }

    public function update(Comment $item)
    {
        $parms = [
            $item->id_task,
            $item->comment,
            $item->id_user,
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
