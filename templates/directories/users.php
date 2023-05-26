<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Справочники</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Пользователи</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Логин</th>
                                        <th>Роль</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($context['users']) > 0) : ?>
                                        <?php foreach ($context['users'] as $index => $item) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $item->login ?></td>
                                                <td>
                                                    <?php
                                                    if ($item->role == 1) {
                                                        echo 'Администратор';
                                                    } else if ($item->role == 2) {
                                                        echo 'Пользователь';
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href=<?php echo __URL__ . "index.php/editUser/" . $item->id ?> title="Редактировать" class="edit-icon"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href=<?php echo __URL__ . "index.php/deleteUser/" . $item->id . "/" . $item->login ?> style="color: red" title="Удалить" class="danger-icon"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>