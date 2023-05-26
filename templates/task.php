<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $context['task']->title ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea disabled name="description" id="description" class="form-control" required><?= $context['task']->description ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="id_priority">Приоритет</label>
                                    <select disabled class="form-control select" name="id_priority" id="id_priority" required>
                                        <option value="" selected></option>
                                        <?php foreach ($context['priorities'] as $item) : ?>
                                            <?php if ($context['task']->id_priority == $item->id) : ?>
                                                <option value=<?= $item->id ?> selected><?= $item->name ?></option>
                                            <?php else : ?>
                                                <option value=<?= $item->id ?>><?= $item->name ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dat">Срок выполнения</label>
                                    <input disabled type="date" value=<?= $context['task']->dat ?> name="dat" id="dat" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label for="id_project">Проект</label>
                                    <select disabled class="form-control select" name="id_project" id="id_project">
                                        <option value="" selected></option>
                                        <?php foreach ($context['projects'] as $item) : ?>
                                            <?php if ($context['task']->id_project == $item->id) : ?>
                                                <option value=<?= $item->id ?> selected><?= $item->name ?></option>
                                            <?php else : ?>
                                                <option value=<?= $item->id ?>><?= $item->name ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Тэги</label>
                                    <select disabled name="tags[]" class="select2" multiple="multiple" data-placeholder="Добавить тэг" style="width: 100%;">
                                        <?php if (count($context['taskTags']) > 0) : ?>
                                            <?php foreach ($context['tags'] as $item) : ?>
                                                <?php
                                                $filtered = array_filter(
                                                    $context['taskTags'],
                                                    function ($obj) use ($item) {
                                                        return $obj->id_tag === $item->id;
                                                    }
                                                );

                                                $selected = false;
                                                if (count($filtered) > 0) {
                                                    $selected = true;
                                                }
                                                ?>
                                                <?php if ($selected) : ?>
                                                    <option value=<?= $item->id ?> selected><?= $item->name ?></option>
                                                <?php else : ?>
                                                    <option value=<?= $item->id ?>><?= $item->name ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <?php foreach ($context['tags'] as $item) : ?>
                                                <option value=<?= $item->id ?>><?= $item->name ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <h3 class="card-title">Комментарии:</h3>
                                <br>
                                <div class="card-footer card-comments">
                                    <?php if (count($context['comments']) > 0) : ?>
                                        <?php foreach ($context['comments'] as $item) : ?>
                                            <div class="card-comment">
                                                <div class="comment-text">
                                                    <span class="username">
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
                                                    </span>
                                                    <?= $item->comment ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <form action="" method="post">
                            <div class="img-push">
                                <input type="hidden" name="idTask" value=<?= $context['task']->id ?>>
                                <input name="comment" type="text" class="form-control form-control-sm" placeholder="Комментарий" required>
                                <button type="submit" name="method" value="postComment" style="width: 140px; margin-top: 12px;" class="btn btn-sm btn-primary">OK</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>