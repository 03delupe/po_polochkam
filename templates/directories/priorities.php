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
                            <h3 class="card-title">Приоритеты</h3>

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
                                        <th style="text-align: center">Цвет</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($context['priorities']) > 0) : ?>
                                        <?php foreach ($context['priorities'] as $index => $item) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $item->name ?></td>
                                                <td align="center">
                                                    <?php if (isset($item->color) && $item->color != '') : ?>
                                                        <div style="width: 20px; height: 20px; background-color: <?= $item->color ?>"></div>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href=<?php echo __URL__ . "index.php/editPriority/" . $item->id ?> title="Редактировать" class="edit-icon"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href=<?php echo __URL__ . "index.php/deletePriority/" . $item->id . "/" . $item->name ?> style="color: red" title="Удалить" class="danger-icon"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-1">
                                    <a href=<?php echo __URL__ . "index.php/createPriority" ?> class="btn btn-primary btn-block">Создать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>