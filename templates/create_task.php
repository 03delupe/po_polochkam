<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Создание</h1>
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
                            <h3 class="card-title">Создать новую задачу</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Наименование</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea name="description" id="description" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="id_priority">Приоритет</label>
                                    <select class="form-control select" name="id_priority" id="id_priority" required>
                                        <option value="" selected></option>
                                        <?php foreach ($context['priorities'] as $item) : ?>
                                            <option value=<?= $item->id ?>><?= $item->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dat">Срок выполнения</label>
                                    <input type="date" name="dat" id="dat" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label for="id_project">Проект</label>
                                    <select class="form-control select" name="id_project" id="id_project">
                                        <option value="" selected></option>
                                        <?php foreach ($context['projects'] as $item) : ?>
                                            <option value=<?= $item->id ?>><?= $item->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Тэги</label>
                                    <select name="tags[]" class="select2" multiple="multiple" data-placeholder="Добавить тэг" style="width: 100%;">
                                        <?php foreach ($context['tags'] as $item) : ?>
                                            <option value=<?= $item->id ?>><?= $item->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="method" value="addTask" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>