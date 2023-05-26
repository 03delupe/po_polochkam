<!-- Пользователь не найден -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="color: darkred">Удаление</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Вы действительно хотите удалить выбранный элемент (<?php echo urldecode($context["name"]) ?>) ?</h3>
            </div>
            <div class="card-body">
                <p>
                    <a class="btn btn-md btn-danger btn_in_bottom" href=<?php echo __URL__ . "index.php/Drop/" . $context["id"] . "/" . $context["controller"] ?> role="button" style="margin: 12px;">
                        <span class="fa fa-trash" aria-hidden="true"></span> Удалить</a>
                    <a class="btn btn-md btn-default btn_in_bottom" href=<?php echo __URL__ . "index.php/GoBack" ?> role="button" style="margin: 12px;">Отменить</a>
                </p>
            </div>
        </div>
    </section>
</div>