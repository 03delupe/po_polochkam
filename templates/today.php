<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
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
                            <h3 class="card-title">Мои задачи</h3>

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
                                        <th>Название</th>
                                        <th>Описание</th>
                                        <th>Приоритет</th>
                                        <th>Дата выполнения</th>
                                        <th>Проект</th>
                                        <th>Статус</th>
                                        <th style="text-align: center">Закрыть</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($context['tasks']) > 0) : ?>
                                        <?php foreach ($context['tasks'] as $index => $item) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td>
                                                    <a href=<?php echo __URL__ . "index.php/editTask/" . $item->id ?> style="color: #000" title="Открыть"><?= $item->title ?></i></a>
                                                </td>
                                                <td><?= $item->description ?></td>
                                                <td>
                                                    <?php
                                                    $filtered = array_filter(
                                                        $context['priorities'],
                                                        function ($obj) use ($item) {
                                                            return $obj->id === $item->id_priority;
                                                        }
                                                    );

                                                    if (count($filtered) > 0) {
                                                        foreach ($filtered as $i => $v) {
                                                            echo "<span><i style='color: $v->color;' class='fa fa-fire'></i></span> &nbsp$v->name";
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $item->dat ?></td>
                                                <td>
                                                    <?php
                                                    $filtered = array_filter(
                                                        $context['projects'],
                                                        function ($obj) use ($item) {
                                                            return $obj->id === $item->id_project;
                                                        }
                                                    );

                                                    if (count($filtered) > 0) {
                                                        foreach ($filtered as $i => $v) {
                                                            echo $v->name;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($item->status != '') {
                                                        echo "<strong style='color: darkred;'>$item->status</strong>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php if ($item->status == 0) : ?>
                                                        <a href=<?php echo __URL__ . "index.php/closeTask/" . $item->id ?> style="color: orange" title="Завершить" class="edit-icon"><i class="fa fa-circle"></i></a>
                                                    <?php else :  ?>
                                                        <span style="color: green" title="Завершена" class="edit-icon"><i class="fa fa-check-circle"></i></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <br>
                            <div class="row">
                                <div class="col-1">
                                    <a href=<?php echo __URL__ . "index.php/createTask" ?> class="btn btn-primary btn-block">Создать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>