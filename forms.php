<?php


class CommentForm
{
    function form_presentation()
    {
        $form_presentation = [
            "comment" => ["type" => "textarea", "label_text" => "Комментарий", "id" => "name"],
        ];

        return $form_presentation;
    }
}

class ProjectForm
{
    function form_presentation()
    {
        $form_presentation = [
            "name" => ["type" => "text", "label_text" => "Наименование", "id" => "name"],
        ];

        return $form_presentation;
    }
}

class TagForm
{
    function form_presentation()
    {
        $form_presentation = [
            "name" => ["type" => "text", "label_text" => "Наименование", "id" => "name"],
        ];

        return $form_presentation;
    }
}

/** Форма пользователей */
class UserForm
{
    function form_presentation()
    {

        $form_presentation = [
            "login" => ["type" => "text", "label_text" => "Логин", "id" => "login"],
            "password" => ["type" => "password", "label_text" => "Пароль", "id" => "password"],
            "role" => ["type" => "select_assoc", "label_text" => "Роль", "id" => "role", "class" => "form-control select", "data" => [
                1 => "Администратор",
                2 => "Пользователь"
            ]]
        ];

        return $form_presentation;
    }
}
