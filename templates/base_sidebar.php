<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href=<?php echo __URL__ . "index.php" ?> class="brand-link">
        <img src=<?php echo __URL__ . "static/images/AdminLTELogo.png" ?> alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">По полочкам</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src=<?php echo __URL__ . "static/images/avatar5.png" ?> class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $_SESSION['todolist']['login'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo __URL__ . "index.php/tasks" ?>" class="nav-link">
                        <i class="nav-icon far fa-calendar"></i>
                        <p>
                            Задачи
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo __URL__ . "index.php/today" ?>" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Сегодня
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo __URL__ . "index.php/upcoming" ?>" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>
                            Предстоящие
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo __URL__ . "index.php/labels" ?>" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Метки
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo __URL__ . "index.php/projects" ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Проекты
                        </p>
                    </a>
                </li>
                <?php if (isset($_SESSION['todolist']) && $_SESSION['todolist']['role'] == 1) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-edit"></i>
                            <p>
                                Справочники
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href=<?php echo __URL__ . "index.php/priorities" ?> class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Приоритеты</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href=<?php echo __URL__ . "index.php/comments" ?> class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Комментарии</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href=<?php echo __URL__ . "index.php/users" ?> class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Пользователи</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-flag"></i>
                        <p>
                            Отчеты
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href=<?php echo __URL__ . "index.php/productivity" ?> class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Продуктивность</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>