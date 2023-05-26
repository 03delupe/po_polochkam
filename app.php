<?php

/** Основные ф-ции для отображения страниц, для вызова методов контроллеров и т.д. */

/** Подключаем все модели, которые будут использваоться */
include_once('./Models/user.php');
include_once('./Models/priority.php');
include_once('./Models/comment.php');
include_once('./Models/project.php');
include_once('./Models/tag.php');
include_once('./Models/task_tag.php');
include_once('./Models/task_user.php');
include_once('./Models/task.php');

/** Подключаем все конроллеры, которыми будем пользоваться */
include_once('./controller.php');
include_once('./controllers/register.php');
include_once('./controllers/sign_in.php');
include_once('./controllers/user_controller.php');
include_once('./controllers/comment_controller.php');
include_once('./controllers/priority_controller.php');
include_once('./controllers/project_controller.php');
include_once('./controllers/tag_controller.php');
include_once('./controllers/task_controller.php');
include_once('./controllers/task_tag_controller.php');
include_once('./controllers/task_user_controller.php');


/** Подключаем все дополнительные файлы необходимые для работы */
/** Класс, который занимается отрисовкой страницы и переданных на нее данных */
include_once("./ssa/classes/render/render.php");
/** Генератор простейших форм */
include_once("./ssa/classes/moldmaker.php");

/** Подключаем все неймспейсы */

use Render\Render;
use MoldMaker\MoldMaker;
use ssa_files\ssa_files;

use controllers\Register;
use controllers\SignIn;
use controllers\UserController;

use controllers\CommentController;
use controllers\PriorityController;
use controllers\ProjectController;
use controllers\TagController;
use controllers\TaskController;
use controllers\TaskTagController;
use controllers\TaskUserController;

class App
{
    private $userController;
    private $registerController;
    private $signInController;
    private $commentController;
    private $priorityController;
    private $projectController;
    private $tagController;
    private $taskController;
    private $taskTagController;
    private $taskUserController;

    public function __construct()
    {
        $this->userController = new UserController();
        $this->signInController = new SignIn();
        $this->registerController = new Register();
        $this->commentController = new CommentController();
        $this->priorityController = new PriorityController();
        $this->projectController = new ProjectController();
        $this->tagController = new TagController();
        $this->taskController = new TaskController();
        $this->taskTagController = new TaskTagController();
        $this->taskUserController = new TaskUserController();
    }

    /** Проверка существования сессии и редирект на логин если её нет */
    private function checkSession()
    {
        $ret = true;
        if (!isset($_SESSION['todolist'])) {
            header('Location: ' . __URL__ . 'index.php/login');
            $ret = false;
        }
        return $ret;
    }

    /** Проверяем является ли пользователь админом */
    private function isAdmin()
    {
        $ret = true;
        if (isset($_SESSION['todolist']) && $_SESSION['todolist']['role'] != 1) {
            header('Location: ' . __URL__ . 'index.php');
            $ret = false;
        }
        return $ret;
    }

    //Стартовая страница
    function loadStart()
    {
        header('Location: ' . __URL__ . 'index.php/calendar');
    }

    /** Создание */
    function createPriority()
    {
        $this->RunFunc(function () {
            $render = new Render("templates/create_priority.php");
            $render->renderPage();
        }, [], 'checkSession', 'isAdmin');
    }

    function addPriority($input)
    {
        $this->RunFunc(function ($input) {
            $item = new Priority();
            $item->name = $input['name'];
            $item->color = isset($input['color']) ? $input['color'] : '';

            $result = $this->priorityController->create($item);
            if ($result['status'] == 1) {
                header('Location: ' . __URL__ . 'index.php/priorities');
            } else {
                $render = new Render("templates/error_page.php", $result);
                $render->renderPage();
            }
        }, $input, 'checkSession', 'isAdmin');
    }

    function createProject()
    {
        $this->RunFunc(function () {
            $createView = new MoldMaker('ProjectForm', "Создать проект", 'addProject');
            $createView->CreateView();
        }, [], 'checkSession', 'isAdmin');
    }

    function addProject($input)
    {
        $this->RunFunc(function ($input) {
            $item = new Project();
            $item->name = $input['name'];

            $result = $this->projectController->create($item);
            if ($result['status'] == 1) {
                header('Location: ' . __URL__ . 'index.php/projects');
            } else {
                $render = new Render("templates/error_page.php", $result);
                $render->renderPage();
            }
        }, $input, 'checkSession', 'isAdmin');
    }

    function createTag()
    {
        $this->RunFunc(function () {
            $createView = new MoldMaker('TagForm', "Создать метку", 'addTag');
            $createView->CreateView();
        }, [], 'checkSession', 'isAdmin');
    }

    function addTag($input)
    {
        $this->RunFunc(function ($input) {
            $item = new Tag();
            $item->name = $input['name'];
            $item->id_creator = $_SESSION['todolist']['id'];

            $result = $this->tagController->create($item);
            if ($result['status'] == 1) {
                header('Location: ' . __URL__ . 'index.php/labels');
            } else {
                $render = new Render("templates/error_page.php", $result);
                $render->renderPage();
            }
        }, $input, 'checkSession', 'isAdmin');
    }

    /** Обновление данных */
    function editUser($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $context = $this->userController->get();
            $context = $this->getItemById($context, $parms[0]);
            $editView = new MoldMaker('UserForm', 'Редактирование', 'updateUser');
            $editView->EditView($context);
        }, $parms, 'checkSession', 'isAdmin');
    }

    function updateUser($input)
    {
        $this->RunFunc(function ($input) {
            $item = new User();
            $item->id = $input['unique_id'];
            $item->login = $input['login'];
            $item->password = $input['password'];
            $item->role = $input['role'];

            $result = $this->userController->update($item);

            if ($result['status'] == 1) {
                header('Location: ' . __URL__ . 'index.php/users');
            }
        }, $input, 'checkSession', 'isAdmin');
    }

    function editProject($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $context = $this->projectController->get();
            $context = $this->getItemById($context, $parms[0]);
            $editView = new MoldMaker('ProjectForm', 'Редактирование', 'updateProject');
            $editView->EditView($context);
        }, $parms, 'checkSession', 'isAdmin');
    }

    function updateProject($input)
    {
        $this->RunFunc(function ($input) {
            $item = new Project();
            $item->id = $input['unique_id'];
            $item->name = $input['name'];

            $result = $this->projectController->update($item);

            if ($result['status'] == 1) {
                header('Location: ' . __URL__ . 'index.php/projects');
            }
        }, $input, 'checkSession', 'isAdmin');
    }

    function editTag($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $context = $this->tagController->get();
            $context = $this->getItemById($context, $parms[0]);
            $editView = new MoldMaker('TagForm', 'Редактирование', 'updateTag');
            $editView->EditView($context);
        }, $parms, 'checkSession', 'isAdmin');
    }

    function updateTag($input)
    {
        $this->RunFunc(function ($input) {
            $item = new Tag();
            $item->id = $input['unique_id'];
            $item->name = $input['name'];
            $item->id_creator = $_SESSION['todolist']['id'];

            $result = $this->tagController->update($item);

            if ($result['status'] == 1) {
                header('Location: ' . __URL__ . 'index.php/labels');
            }
        }, $input, 'checkSession', 'isAdmin');
    }

    function editPriority($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $context = $this->priorityController->get();
            $context = $this->getItemById($context, $parms[0]);
            $render = new Render("templates/edit_priority.php", $context);
            $render->renderPage();
        }, $parms, 'checkSession', 'isAdmin');
    }

    function updatePriority($input)
    {
        $this->RunFunc(function ($input) {
            $item = new Priority();
            $item->id = $input['unique_id'];
            $item->name = $input['name'];
            $item->color = isset($input['color']) ? $input['color'] : '';

            $result = $this->priorityController->update($item);
            if ($result['status'] == 1) {
                header('Location: ' . __URL__ . 'index.php/priorities');
            } else {
                $render = new Render("templates/error_page.php", $result);
                $render->renderPage();
            }
        }, $input, 'checkSession', 'isAdmin');
    }



    function getItemById($context, $id)
    {
        foreach ($context as $item) {
            if ($item->id == $id) return $item;
        }
    }

    /** Удаление */

    function deleteUser($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $this->DropConfirmation('userController', $parms[0], $parms[1]);
        }, $parms, 'checkSession', 'isAdmin');
    }

    function deleteProject($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $this->DropConfirmation('projectController', $parms[0], $parms[1]);
        }, $parms, 'checkSession', 'isAdmin');
    }

    function deleteTag($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $this->DropConfirmation('tagController', $parms[0], $parms[1]);
        }, $parms, 'checkSession', 'isAdmin');
    }

    function deletePriority($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $this->DropConfirmation('priorityController', $parms[0], $parms[1]);
        }, $parms, 'checkSession', 'isAdmin');
    }

    function deleteTask($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $this->DropConfirmation('taskController', $parms[0], $parms[1]);
        }, $parms, 'checkSession', 'isAdmin');
    }

    //Стартовая страница
    function Home()
    {
        $this->RunFunc(function () {
            $render = new Render("templates/calendar.php");
            $render->renderPage();
        }, [], 'checkSession');
    }

    function calendar()
    {
        $this->RunFunc(function () {
            $render = new Render("templates/calendar.php");
            $render->renderPage();
        }, [], 'checkSession');
    }

    /** Справочики */

    function priorities()
    {
        $this->RunFunc(function () {
            $context['priorities'] = $this->priorityController->get();

            $render = new Render("templates/directories/priorities.php", $context);
            $render->renderPage();
        }, [], 'checkSession');
    }

    function comments()
    {
        $this->RunFunc(function () {
            $context['users'] = $this->userController->get();
            $context['comments'] = $this->commentController->get();
            $context['tasks'] = $this->taskController->get();

            $render = new Render("templates/directories/comments.php", $context);
            $render->renderPage();
        }, [], 'checkSession');
    }

    function users()
    {
        $this->RunFunc(function () {
            $context['users'] = $this->userController->get();

            $render = new Render("templates/directories/users.php", $context);
            $render->renderPage();
        }, [], 'checkSession');
    }

    function projects()
    {
        $this->RunFunc(function () {
            $context['projects'] = $this->projectController->get();

            $render = new Render("templates/directories/projects.php", $context);
            $render->renderPage();
        }, [], 'checkSession');
    }

    function labels()
    {
        $this->RunFunc(function () {
            $context['tags'] = $this->tagController->get();

            $render = new Render("templates/directories/tags.php", $context);
            $render->renderPage();
        }, [], 'checkSession');
    }

    function getEvents()
    {
        $this->RunFunc(function () {
            $user_id = $_SESSION['todolist']['id'];
            $context['tasks'] = [];
            $tasks = $this->taskController->get();
            $tasks_users = $this->taskUserController->get();
            foreach ($tasks_users as $item) {
                if ($item->id_user == $user_id) {
                    $task = $this->getItemById($tasks, $item->id_task);
                    if ($task->status == 0) {
                        array_push($context['tasks'], $task);
                    }
                }
            }

            echo json_encode($context);
        }, [], 'checkSession');
    }

    function upcoming()
    {
        $this->RunFunc(function () {
            $user_id = $_SESSION['todolist']['id'];

            $context['tasks'] = [];
            $tasks = $this->taskController->get();
            $tasks_users = $this->taskUserController->get();
            foreach ($tasks_users as $item) {
                if ($item->id_user == $user_id) {
                    $task = $this->getItemById($tasks, $item->id_task);
                    array_push($context['tasks'], $task);
                }
            }

            $context['tasks_tags'] = $this->taskTagController->get();
            $context['tags'] = $this->tagController->get();
            $context['priorities'] = $this->priorityController->get();
            $context['projects'] = $this->projectController->get();

            $render = new Render("templates/calendar.php", $context);
            $render->renderPage();
        }, [], 'checkSession');
    }

    function today()
    {
        $this->RunFunc(function () {
            $user_id = $_SESSION['todolist']['id'];

            $context['tasks'] = [];
            $tasks = $this->taskController->get();
            $tasks_users = $this->taskUserController->get();
            foreach ($tasks_users as $item) {
                if ($item->id_user == $user_id) {
                    $task = $this->getItemById($tasks, $item->id_task);
                    if ($task->status == 0) {
                        $current_date = date('Y-m-d');
                        $obj = new stdClass();
                        $obj->id = $task->id;
                        $obj->title = $task->title;
                        $obj->description = $task->description;
                        $obj->dat = $task->dat;
                        $obj->id_project = $task->id_project;
                        $obj->id_priority = $task->id_priority;

                        $status = '';
                        if ($current_date > $task->dat) {
                            $status = 'Просрочено';
                        }

                        $obj->status = $status;

                        array_push($context['tasks'], $obj);
                    }
                }
            }

            $context['priorities'] = $this->priorityController->get();
            $context['projects'] = $this->projectController->get();

            $render = new Render("templates/today.php", $context);
            $render->renderPage();
        }, [], 'checkSession');
    }

    function tasks()
    {
        $this->RunFunc(function () {
            $user_id = $_SESSION['todolist']['id'];

            $context['tasks'] = [];
            $tasks = $this->taskController->get();
            $tasks_users = $this->taskUserController->get();
            foreach ($tasks_users as $item) {
                if ($item->id_user == $user_id) {
                    $task = $this->getItemById($tasks, $item->id_task);
                    array_push($context['tasks'], $task);
                }
            }

            $context['tasks_tags'] = $this->taskTagController->get();
            $context['tags'] = $this->tagController->get();
            $context['priorities'] = $this->priorityController->get();
            $context['projects'] = $this->projectController->get();

            $render = new Render("templates/tasks.php", $context);
            $render->renderPage();
        }, [], 'checkSession');
    }

    function task($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $context = $this->taskController->get();
            $context['task'] = $this->getItemById($context, $parms[0]);
            $context['priorities'] = $this->priorityController->get();
            $context['projects'] = $this->projectController->get();
            $context['tags'] = $this->tagController->get();
            $taskTags = $this->taskTagController->get();
            $context['taskTags'] = [];
            foreach ($taskTags as $t) {
                if ($t->id_task == $parms[0]) {
                    array_push($context['taskTags'], $t);
                }
            }
            $context['users'] = $this->userController->get();
            $context['comments'] = [];
            $comments = $this->commentController->get();
            foreach ($comments as $c) {
                if ($c->id_task == $parms[0]) {
                    array_push($context['comments'], $c);
                }
            }

            $render = new Render("templates/task.php", $context);
            $render->renderPage();
        }, $parms, 'checkSession');
    }

    function postComment($input)
    {
        $this->RunFunc(function ($input) {
            $id_user = $_SESSION['todolist']['id'];
            $comment = $input['comment'];
            $id_task = $input['idTask'];

            $model = new Comment();
            $model->id_task =  $id_task;
            $model->comment = $comment;
            $model->id_user = $id_user;

            $result = $this->commentController->create($model);
            if ($result['status'] == 1) {
                $this->task([], [$id_task]);
            }
        }, $input, 'checkSession');
    }

    function createTask()
    {
        $this->RunFunc(function () {
            $context['priorities'] = $this->priorityController->get();
            $context['projects'] = $this->projectController->get();
            $context['tags'] = $this->tagController->get();
            $render = new Render("templates/create_task.php", $context);
            $render->renderPage();
        }, [], 'checkSession', 'isAdmin');
    }

    function addTask($input)
    {
        $this->RunFunc(function ($input) {
            $item = new Task();
            $item->title = $input['title'];
            $item->description = $input['description'];
            $item->id_priority = $input['id_priority'];
            $item->dat = $input['dat'];
            $item->id_project = $input['id_project'];
            $item->status = 0;

            $result = $this->taskController->create($item);
            if ($result['status'] == 1) {
                $tasks = $this->taskController->get();
                $last = $tasks[0];
                $id = $last->id;
                $id_user = $_SESSION['todolist']['id'];

                $item2 = new TaskUser();
                $item2->id_task = $id;
                $item2->id_user = $id_user;

                $result2 = $this->taskUserController->create($item2);

                if ($result2['status'] == 1) {
                    if (isset($input['tags']) && count($input['tags']) > 0) {
                        $tags = $input['tags'];
                        $flag = true;
                        foreach ($tags as $tag) {
                            $model = new TaskTag();
                            $model->id_task = $id;
                            $model->id_tag = $tag;

                            $r = $this->taskTagController->create($model);
                            if ($r['status'] != 1) {
                                $flag = false;
                            }
                        }

                        if ($flag) {
                            header('Location: ' . __URL__ . 'index.php/tasks');
                        } else {
                            $render = new Render("templates/error_page.php", $result);
                            $render->renderPage();
                        }
                    } else {
                        header('Location: ' . __URL__ . 'index.php/tasks');
                    }
                } else {
                    $render = new Render("templates/error_page.php", $result);
                    $render->renderPage();
                }
            } else {
                $render = new Render("templates/error_page.php", $result);
                $render->renderPage();
            }
        }, $input, 'checkSession', 'isAdmin');
    }

    function editTask($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $context = $this->taskController->get();
            $context['task'] = $this->getItemById($context, $parms[0]);

            if ($context['task']->status == 1) {
                $this->tasks();
                return;
            }

            $context['priorities'] = $this->priorityController->get();
            $context['projects'] = $this->projectController->get();
            $context['tags'] = $this->tagController->get();
            $taskTags = $this->taskTagController->get();
            $context['taskTags'] = [];
            foreach ($taskTags as $t) {
                if ($t->id_task == $parms[0]) {
                    array_push($context['taskTags'], $t);
                }
            }

            $render = new Render("templates/edit_task.php", $context);
            $render->renderPage();
        }, $parms, 'checkSession', 'isAdmin');
    }

    function updateTask($input)
    {
        $this->RunFunc(function ($input) {
            $item = new Task();
            $item->id = $input['unique_id'];
            $item->title = $input['title'];
            $item->description = $input['description'];
            $item->id_priority = $input['id_priority'];
            $item->dat = $input['dat'];
            $item->id_project = $input['id_project'];
            $item->status = 0;

            $taskTags = $this->taskTagController->get();
            foreach ($taskTags as $t) {
                if ($t->id_task == $item->id) {
                    $t_id = $t->id;
                    $this->taskTagController->delete($t_id);
                }
            }

            $result = $this->taskController->update($item);
            if ($result['status'] == 1) {
                $id = $item->id;

                if (isset($input['tags']) && count($input['tags']) > 0) {
                    $tags = $input['tags'];
                    $flag = true;
                    foreach ($tags as $tag) {
                        $model = new TaskTag();
                        $model->id_task = $id;
                        $model->id_tag = $tag;

                        $r = $this->taskTagController->create($model);
                        if ($r['status'] != 1) {
                            $flag = false;
                        }
                    }

                    if ($flag) {
                        header('Location: ' . __URL__ . 'index.php/tasks');
                    } else {
                        $render = new Render("templates/error_page.php", $result);
                        $render->renderPage();
                    }
                } else {
                    header('Location: ' . __URL__ . 'index.php/tasks');
                }
            } else {
                $render = new Render("templates/error_page.php", $result);
                $render->renderPage();
            }
        }, $input, 'checkSession', 'isAdmin');
    }

    function closeTask($input, $parms)
    {
        $this->RunFunc(function ($parms) {
            $id_task = $parms[0];
            $this->taskController->closeTask($id_task);

            $this->tasks();
        }, $parms, 'checkSession', 'isAdmin');
    }

    //Авторизация
    function login()
    {
        $render = new Render("templates/login.php", null, 'standalone');
        $render->renderPage();
    }

    //Регистрация
    function register()
    {
        $render = new Render("templates/register.php", null, 'standalone');
        $render->renderPage();
    }

    //Создание нового пользователя
    function signUp($input)
    {
        if (isset($input)) {
            if ($input['login'] == "" || $input['password'] == "") {
                echo 1;
                return;
            }

            $user = new User($input['login'], sha1($input['password']));

            $register = new Register();

            if (!$register->checkUser($user)) {
                echo 'loginDanger';
                return;
            }

            $result = $register->rgister($user);

            if ($result['status'] == 1) {
                $this->doLogin($input);
                echo 0;
            } else {
                print_r($result['log']);
            }
        } else {
            echo 'Что-то пошло не так! Нету значения input!';
        }
    }

    /** Аутентификация */
    function doLogin($input)
    {
        if (isset($input)) {
            $login = $input['login'];
            $psw = $input['password'];

            $user = new User();
            $user->login = $login;
            $user->password = $psw;

            $result = $this->signInController->signIn($user);

            if ($result != null) {
                $this->createUserSession($result);
                header('Location: ' . __URL__ . 'index.php');
            } else {
                $render = new Render("service_files/user_not_found.php");
                $render->renderPage();
            }
        } else {
            echo 'Что-то пошло не так! Нету значения input!';
        }
    }

    function registration($input)
    {
        $data = array();

        foreach (explode('&', $input['data']) as $val) {
            preg_match_all("#([^,\s]+)=([^\*]+)#s", $val, $out);
            unset($out[0]);

            $out = array_combine($out[1], $out[2]);
            $data = array_merge($data, $out);
        }

        if (count($data) == 0) {
            echo 'Нет данных!';
            return;
        }

        if ($data['password'] != $data['re_password']) {
            echo 'Пароли не совпадают!';
            return;
        }

        $user = new User;
        $user->login = $data['login'];
        if (!$this->registerController->checkUser($user)) {
            echo 'Пользователь с таким именем уже существует!';
        }

        $user->password = $data['password'];
        $user->role = 2;

        $result = $this->registerController->rgister($user);
        if ($result['status'] == 1) {
            echo 0;
            return;
        } else {
            echo json_encode($result);
        }
    }

    function getProductivityByMonths()
    {
        $user_id = $_SESSION['todolist']['id'];

        $context['tasks'] = [];

        $tasks = $this->taskController->get();
        $tasks_users = $this->taskUserController->get();
        foreach ($tasks_users as $item) {
            if ($item->id_user == $user_id) {
                $task = $this->getItemById($tasks, $item->id_task);
                array_push($context['tasks'], $task);
            }
        }

        $data = [];
        foreach ($context['tasks'] as $task) {
            $item = new stdClass();
            $item->status = $task->status;
            $item->month = date('m', strtotime($task->dat));
            array_push($data, $item);
        }

        $result = [];

        for ($i = 1; $i <= 12; $i++) {
            $sum_closed = 0;
            $sum_no_closed = 0;
            $item = new stdClass();
            foreach ($data as $d) {
                if (($d->month * 1) == $i) {
                    if ($d->status == 1) {
                        $sum_closed += 1;
                    } else {
                        $sum_no_closed += 1;
                    }
                }
            }

            $item->month = $i;
            $item->closed = $sum_closed;
            $item->no_closed = $sum_no_closed;

            array_push($result, $item);
        }

        return $result;
    }

    function getLast7DaysProductivity()
    {
        $user_id = $_SESSION['todolist']['id'];

        $context['tasks'] = [];

        $tasks = $this->taskController->get();
        $tasks_users = $this->taskUserController->get();
        foreach ($tasks_users as $item) {
            if ($item->id_user == $user_id) {
                $task = $this->getItemById($tasks, $item->id_task);
                array_push($context['tasks'], $task);
            }
        }

        $current_date = date('Y-m-d');
        $start_date = date('Y-m-d', strtotime($current_date . ' - 7 days'));

        $result = [];

        while ($start_date <= $current_date) {
            $item = new stdClass();
            $item->dat = $start_date;

            $sum  = 0;
            foreach ($context['tasks'] as $t) {
                $t_dat = date('Y-m-d', strtotime($t->dat));
                if ($t_dat == $start_date) {
                    if ($t->status == 1) {
                        $sum += 1;
                    }
                }
            }

            $item->qty = $sum;

            array_push($result, $item);

            $start_date = date('Y-m-d', strtotime($start_date . ' + 1 days'));
        }

        return $result;
    }

    function productivity()
    {
        $context['productivity'] = $this->getProductivityByMonths();
        $context['last7'] = $this->getLast7DaysProductivity();
        $render = new Render("templates/reports/productivity.php", $context);
        return $render->renderPage();
    }

    /** Создание пользовательской сессии */
    function createUserSession(User $user)
    {
        $session_data = ['login' => $user->login, 'id' => $user->id, 'role' => $user->role];
        $_SESSION['todolist'] = $session_data;
    }

    /** Завершить сессию */
    function logout()
    {
        unset($_SESSION['todolist']);
        header('Location: ' . __URL__ . 'index.php');
    }

    /** Подтверждение удаления */
    function DropConfirmation($controller, $id, $name)
    {
        $render = new Render("templates/delete_view.php", ['name' => $name, 'id' => $id, 'controller' => $controller]);
        return $render->renderPage();
    }

    /** Выполнение запроса на удаление */
    function Drop($input, $parms)
    {
        $id = $parms[0];
        $controller = $parms[1];

        try {
            if (!method_exists($this->$controller, 'delete'))
                throw new Exception("Method does not exists!");

            $this->$controller->delete($id);
            $this->GoBack();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /** Загрузка ф-ций */
    function RunFunc($callback, $input, ...$rest)
    {
        $res = true;
        foreach ($rest as $func) {
            $res &= $this->$func();
        }
        if ($res == true) {
            $callback($input);
        }
    }

    /** Возвращение на предыдущие страницы */
    function GoBack()
    {
        echo '<script>
            window.history.go(-2);
        </script>';
    }
}
