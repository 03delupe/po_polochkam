<?php

namespace MoldMaker;

/** 16.04.2022 */
/** Создание формы на основании класса из forms.php 
 * Можно создавать простейшие формы для create, update операций 
 */

/** Формы */
include("forms.php");

use Render\Render;

class MoldMaker
{
    /** класс формы */
    var $_class;
    var $_header;
    var $_mainTitle = '';
    var $_model_name;
    private $top;
    private $bottom = '</div>' .
        '</form>' .
        '</div>' .
        '</div>' .
        '</div>' .
        '</div>' .
        '</section>' .
        '</div>';

    function __construct()
    {
        $objects = func_get_args();
        $i = func_num_args();
        if ($i > 0) {
            $this->_class = new $objects[0];
            $this->_header = $objects[1];
            $this->_model_name = $objects[2];
        }
        $this->Top();
    }

    private function Top()
    {
        $this->top = '<div class="content-wrapper">' .
            '<section class="content-header">' .
            '<div class="container-fluid">' .
            '<div class="row mb-2">' .
            '<div class="col-sm-6">' .
            '<h1>' . $this->_mainTitle . '</h1>' .
            '</div>' .
            '</div>' .
            '</div>' .
            '</section>' .

            '<section class="content">' .
            '<div class="container-fluid">' .
            '<div class="row">' .
            '<div class="col-md-6">' .
            '<div class="card card-primary">' .
            '<div class="card-header">' .
            '<h3 class="card-title">' . $this->_header . '</h3>' .
            '</div>' .
            '<form>' .
            '<div class="card-body">';
    }

    /** Конструирование формы создания */
    function CreateView()
    {
        if (isset($this->_class->form_presentation))
            $form_presentation = $this->_class->form_presentation;
        else
            $form_presentation = $this->_class->form_presentation();

        $count = count($form_presentation);

        if ($count > 0) {
            $middle = '';
            foreach ($form_presentation as $key => $val) {
                $special_attribute =  isset($val['sp_attr']) ? $val['sp_attr'] : "";
                $default_val = isset($val['default_val']) ? $val['default_val'] : "";
                $a_ = isset($val['autofocus_']) ? $val['autofocus_'] : "";
                $r_ = isset($val['required_']) ? $val['required_'] : "";
                $id = isset($val['id']) ? $val['id'] : "";
                if ($val["type"] == "text") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<input type="' . $val["type"] . '" name="' . $key . '" class="form-control" id="' . $id . '" value="' . $default_val . '" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '> ';
                    $middle .= '</div>';
                } else if ($val["type"] == "password") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<input type="password" name="' . $key . '" class="form-control" id="' . $id . '" value="' . $default_val . '" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '> ';
                    $middle .= '</div>';
                } else if ($val["type"] == "number") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<input type="number" name="' . $key . '" class="form-control" id="' . $id . '" value="' . $default_val . '" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '> ';
                    $middle .= '</div>';
                } else if ($val["type"] == "date") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<input type="date" name="' . $key . '" class="form-control" id="' . $id . '" value="' . $default_val . '" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '> ';
                    $middle .= '</div>';
                } else if ($val["type"] == "time") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<input type="time" name="' . $key . '" class="form-control" id="' . $id . '" value="' . $default_val . '" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '> ';
                    $middle .= '</div>';
                } else if ($val["type"] == "file") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for="' . $id . '">' . $val["label_text"] . '</label>';
                    $middle .= '<input type="' . $val["type"] . '" name="' . $key . '" id="' . $id . '">';
                    $middle .= '</div>';
                } else if ($val["type"] == "textarea") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<textarea name="' . $key . '" class="form-control" id="' . $id . '" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '>' . $default_val . '</textarea>';
                    $middle .= '</div>';
                } else if ($val["type"] == "password") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<input type="' . $val["type"] . '" name="' . $key . '" class="form-control" id="' . $id . '">';
                    $middle .= '</div>';
                } else if ($val["type"] == "select_assoc") {
                    $middle .= "  <div class='form-group'>";
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<select name="' . $key . '" id="' . $val["id"] . '" class="' . $val["class"] . '">';
                    foreach ($val["data"] as $k => $v) {
                        $middle .= '<option value="' . $k . '">' . $v . '</option>';
                    }
                    $middle .= '</select>';
                    $middle .= '</div>';
                } else if ($val["type"] == "hidden") {
                    $middle .= '<input type="' . $val["type"] . '" name="' . $key . '" id="' . $key . '" value="' . $default_val . '">';
                }
            }
            $middle .= '<div class="card-footer">';
            $middle .= '<button type="submit" class="btn btn-primary" name="method" value="' . $this->_model_name . '">Добавить</button>';
            $middle .= '</div>';

            $content = $this->top . $middle . $this->bottom;

            $render = new Render($content, null, "html");
            $render->renderPage();
        } else
            echo 'Не удается найти класс формы';
    }

    /** Конструирование формы редактирования */
    function EditView($context, $attachments = null, $unique_key = 'id')
    {
        if (isset($this->_class->form_presentation))
            $form_presentation = $this->_class->form_presentation;
        else
            $form_presentation = $this->_class->form_presentation();

        $count = count($form_presentation);

        if ($count > 0) {
            $middle = '<div class="box-body">';
            $middle .= '<input type="hidden" name="unique_id" value=' . $context->$unique_key . '>';
            foreach ($form_presentation as $key => $val) {
                $special_attribute =  isset($val['sp_attr']) ? $val['sp_attr'] : "";
                $a_ = isset($val['autofocus_']) ? $val['autofocus_'] : "";
                $r_ = isset($val['required_']) ? $val['required_'] : "";
                $id = isset($val['id']) ? $val['id'] : "";

                if ($val["type"] == "text") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<input type="' . $val["type"] . '" name="' . $key . '" class="form-control" id="' . $id . '" value="' . $context->$key . '" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '>';
                    $middle .= '</div>';
                } else if ($val["type"] == "password") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<input type="password" name="' . $key . '" class="form-control" id="' . $id . '" value="" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '> ';
                    $middle .= '</div>';
                } else if ($val["type"] == "number") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<input type="number" name="' . $key . '" class="form-control" id="' . $id . '" value="' .  $context->$key . '" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '> ';
                    $middle .= '</div>';
                } else if ($val["type"] == "time") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<input type="time" name="' . $key . '" class="form-control" id="' . $id . '" value="' .  $context->$key . '" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '> ';
                    $middle .= '</div>';
                } else if ($val["type"] == "date") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<input type="date" name="' . $key . '" class="form-control" id="' . $id . '" value="' .  $context->$key . '" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '> ';
                    $middle .= '</div>';
                } else if ($val["type"] == "file") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for="' . $id . '">' . $val["label_text"] . '</label>';
                    $middle .= '<input type="' . $val["type"] . '" name="' . $key . '" id="' . $id . '">';
                    $middle .= '</div>';
                } else if ($val["type"] == "select_assoc") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<select name="' . $key . '" id="' . $id . '" class="' . $val["class"] . '" ' . $special_attribute . '>';
                    foreach ($val["data"] as $k => $v) {
                        if ($k == $context->$key)
                            $middle .= '<option value="' . $k . '" selected>' . $v . '</option>';
                        else
                            $middle .= '<option value="' . $k . '">' . $v . '</option>';
                    }
                    $middle .= '</select>';
                    $middle .= '</div>';
                } else if ($val["type"] == "textarea") {
                    $middle .= '<div class="form-group">';
                    $middle .= '<label for=' . $key . '>' . $val["label_text"] . '</label>';
                    $middle .= '<textarea name="' . $key . '" class="form-control" id="' . $id . '" ' . $special_attribute . ' ' . $a_ . ' ' . $r_ . '>' . $context->$key . '</textarea>';
                    $middle .= '</div>';
                } else if ($val["type"] == "hidden") {
                    $middle .= '<input type="' . $val["type"] . '" name="' . $key . '" id="' . $key . '" value="' . $context->$key . '">';
                } else if ($val["type"] == 'attachments') {
                    $middle .= "<div class='box box-default'>";
                    $middle .=  "<div class='box-header with-border'>";
                    $middle .=  "<h3 class='box-title'> Файлы:</h3>";
                    $middle .=  "</div>";
                    $middle .=  "<div class='box-body'>";
                    $middle .=  "<table id='users_table' class='table table-bordered table-hover' style='width: 100%''>";
                    $middle .=  "<tbody>";
                    if (count($attachments) > 0) {
                        foreach ($attachments as $file) {
                            $full_path = explode('/', $file->path);
                            $file_name = $full_path[1];
                            $middle .=  "<tr>";
                            $middle .= "<td><span class='glyphicon glyphicon-folder-open' style='font-size: 50px; color: #21292d;'></span></td>";
                            $middle .=  "<td><b>" . substr($file_name, 10, strlen($file_name)) . "</b></td>";
                            $middle .=  "<td><a href='" . __URL__ . "index.php/Download/" . $file->id . "'><i class='fa fa-download'></i> <span>Скачать</span></a> </td>";
                            $middle .=  "<td><a href='" . __URL__ . "index.php/DropFile/" . $file->id . "'><i class='fa fa-trash'></i> <span>Удалить</span></a></td>";
                            $middle .=  "</tr>";
                        }
                    }
                    $middle .= "</tbody>";
                    $middle .= "</table>";
                    $middle .= "</div>";
                    $middle .= "</div>";
                }
            }
            $middle .= '</div>';
            $middle .= '<div class="box-footer">';
            $middle .= '<button type="submit" class="btn btn-primary" name="method" value="' . $this->_model_name . '">Обновить</button>';
            $middle .= '</div>';

            $content = $this->top . $middle . $this->bottom;

            $render = new Render($content, null, "html");
            $render->renderPage();
        } else
            echo 'Не удается найти класс формы';
    }
}
