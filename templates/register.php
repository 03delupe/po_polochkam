<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TodoList Login</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href=<?php echo __URL__ . "static/ui/plugins/fontawesome-free/css/all.min.css" ?>>
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href=<?php echo __URL__ . "static/ui/plugins/icheck-bootstrap/icheck-bootstrap.min.css" ?>>
    <!-- Theme style -->
    <link rel="stylesheet" href=<?php echo __URL__ . "static/ui/dist/css/adminlte.min.css" ?>>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <span class="h1"><b>По полочкам</b></span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Регистрация</p>

                <form id="register_form" action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="login" class="form-control" placeholder="Логин" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="re_password" class="form-control" placeholder="Повторите пароль" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Войти</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <a href=<?php echo __URL__ . "index.php/login" ?>>На страницу авторизации</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script type="text/javascript" src=<?php echo __URL__ . "static/ui/plugins/jquery/jquery.min.js" ?>></script>
    <!-- Bootstrap 4 -->
    <script type="text/javascript" src=<?php echo __URL__ . "static/ui/plugins/bootstrap/js/bootstrap.bundle.min.js" ?>></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src=<?php echo __URL__ . "static/ui/dist/js/adminlte.min.js" ?>></script>

    <script src=<?php echo __URL__ . "static/js/register.js" ?>></script>
</body>

</html>