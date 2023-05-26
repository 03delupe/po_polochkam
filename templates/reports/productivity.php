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
                            <h3 class="card-title">Продуктивность</h3>

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
                                        <th>Месяц</th>
                                        <th>Выполнено задач</th>
                                        <th>Не выполнено</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($context['productivity']) > 0) : ?>
                                        <?php foreach ($context['productivity'] as $index => $item) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td>
                                                    <?php
                                                    if ($item->month == 1) {
                                                        echo 'Январь';
                                                    }
                                                    if ($item->month == 2) {
                                                        echo 'Февраль';
                                                    }
                                                    if ($item->month == 3) {
                                                        echo 'Март';
                                                    }
                                                    if ($item->month == 4) {
                                                        echo 'Апрель';
                                                    }
                                                    if ($item->month == 5) {
                                                        echo 'Май';
                                                    }
                                                    if ($item->month == 6) {
                                                        echo 'Июнь';
                                                    }
                                                    if ($item->month == 7) {
                                                        echo 'Июль';
                                                    }
                                                    if ($item->month == 8) {
                                                        echo 'Август';
                                                    }
                                                    if ($item->month == 9) {
                                                        echo 'Сентябрь';
                                                    }
                                                    if ($item->month == 10) {
                                                        echo 'Октябрь';
                                                    }
                                                    if ($item->month == 11) {
                                                        echo 'Ноябрь';
                                                    }
                                                    if ($item->month == 12) {
                                                        echo 'Декабрь';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $item->closed ?></td>
                                                <td><?= $item->no_closed ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <span class='card-title'>Выполнено за последние 7 дней</span>
                            <br>
                            <br>
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Дата</th>
                                        <th>Количество</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($context['last7']) > 0) : ?>
                                        <?php foreach ($context['last7'] as $index => $item) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $item->dat ?></td>
                                                <td><?= $item->qty ?></td>
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