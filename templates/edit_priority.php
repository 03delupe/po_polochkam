<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Редактировать приоритет</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input type="text" name="name" id="name" class="form-control" value=<?= $context->name ?> required>
                                </div>
                                <div class="form-group">
                                    <label for="color">Цвет</label>
                                    <div class="input-group my-colorpicker2">
                                        <input type="text" name="color" id="color" value=<?= $context->color ?> class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-square"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="unique_id" value=<?= $context->id ?>>
                                <button type="submit" name="method" value="updatePriority" class="btn btn-primary">Обновить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>