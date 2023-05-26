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
                            <h3 class="card-title">Комментарии</h3>

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
                                        <th>Задача</th>
                                        <th>Текст комментария</th>
                                        <th>Пользователь</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($context['comments']) > 0) : ?>
                                        <?php foreach ($context['comments'] as $index => $item) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td>
                                                    <?php
                                                    $filtered = array_filter(
                                                        $context['tasks'],
                                                        function ($obj) use ($item) {
                                                            return $obj->id === $item->id_task;
                                                        }
                                                    );

                                                    if (count($filtered) > 0) {
                                                        foreach ($filtered as $i => $v) {
                                                            echo $v->title;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $item->comment ?></td>
                                                <td>
                                                    <?php
                                                    $filtered = array_filter(
                                                        $context['users'],
                                                        function ($obj) use ($item) {
                                                            return $obj->id === $item->id_user;
                                                        }
                                                    );

                                                    if (count($filtered) > 0) {
                                                        foreach ($filtered as $i => $v) {
                                                            echo $v->login;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href=<?php echo __URL__ . "index.php/deleteComment/" . $item->id . "/" . $item->comment ?> style="color: red" title="Удалить" class="danger-icon"><i class="fa fa-trash"></i></a>
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