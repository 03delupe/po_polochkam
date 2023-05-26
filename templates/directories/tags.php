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
                            <h3 class="card-title">Метки</h3>

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
                                        <th>Наименование</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($context['tags']) > 0) : ?>
                                        <?php foreach ($context['tags'] as $index => $item) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $item->name ?></td>
                                                <td style="text-align: center">
                                                    <a href=<?php echo __URL__ . "index.php/editTag/" . $item->id ?> title="Редактировать" class="edit-icon"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href=<?php echo __URL__ . "index.php/deleteTag/" . $item->id . "/" . $item->name ?> style="color: red" title="Удалить" class="danger-icon"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-1">
                                    <a href=<?php echo __URL__ . "index.php/createTag" ?> class="btn btn-primary btn-block">Создать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>