<div class="wrap centerastrakhan-persons">

    <h1>Персоны <a href="#add" class="page-title-action add-person">Добавить новую</a></h1>

    <div class="error notice">
        <p></p>
    </div>

    <div class="updated notice">
        <p></p>
    </div>

    <table class="wp-list-table widefat fixed striped posts persons-list" role="presentation">

        <thead>
        <tr>
            <th class="manage-column column-cb">ФИО</th>
            <th class="manage-column column-title column-primary">Должность</th>
        </tr>
        </thead>

        <tbody>

        <?php foreach ($persons as $i => $person): ?>

            <tr class="short-person-data">

                <td class="title column-title has-row-actions column-primary page-title">
                    <strong><?= $person['lastname'] ?> <?= $person['firstname'] ?> <?= $person['middlename'] ?></strong>
                    <div class="row-actions">
                        <span class="edit"><a data-id="<?= $person['id'] ?>" href="#edit" aria-label="Редактировать «<?= $person['lastname'] ?> <?= $person['firstname'] ?> <?= $person['middlename'] ?>»">Изменить</a> | </span>
                        <span class="delete"><a data-id="<?= $person['id'] ?>" href="#delete" aria-label="Удалить «<?= $person['lastname'] ?> <?= $person['firstname'] ?> <?= $person['middlename'] ?>»">Удалить</a></span>
                    </div>
                </td>
                <td class="title column-title"><?= $person['post'] ?></td>

            </tr>

            <tr class="person-edit-dialog" id="person-edit-dialog-<?= $person['id'] ?>">

                <td class="title column-title has-row-actions column-primary page-title" colspan="2">

                    <table width="100%" class="wp-list-table widefat fixed striped posts person-data">
                        <tr>
                            <td rowspan="3" class="person-image-container">

                                <div class="image-container-list">

                                    <?php if (!empty($person['photo'])): ?>

                                        <?php $url = wp_get_attachment_url($person['photo']); ?>

                                        <div class="image-container image">
                                            <img src="<?= $url ?>" class="item-image"/>
                                            <button class="delete-image page-title-action">Удалить</button>
                                        </div>

                                    <?php endif; ?>
                                </div>

                                <div class="add-image page-title-action">Выбрать</div>

                                <input class="images-text-list person-field" name="photo" type="hidden" value="<?= $person['photo'] ?>" data-save="<?= $person['photo'] ?>"  />
                                <input name="photo-url" type="hidden" value="<?= $url ?>"  />

                            </td>
                            <td>Фамилия: *</td>
                            <td class="input">
                                <input type="text" name="lastname" value="<?= $person['lastname'] ?>" data-save="<?= $person['lastname'] ?>" class="person-field" />
                            </td>
                        </tr>
                        <tr>
                            <td>Имя: *</td>
                            <td class="input">
                                <input type="text" name="firstname" value="<?= $person['firstname'] ?>" data-save="<?= $person['firstname'] ?>"  class="person-field" />
                            </td>
                        </tr>
                        <tr>
                            <td>Отчество:</td>
                            <td class="input">
                                <input type="text" name="middlename" value="<?= $person['middlename'] ?>" data-save="<?= $person['middlename'] ?>"  class="person-field" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Должность:</td>
                            <td class="input">
                                <input type="text" name="post" value="<?= $person['post'] ?>" data-save="<?= $person['post'] ?>"  class="person-field" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Описание:</td>
                            <td class="input">
                                <?php wp_editor($person['description'], "person-description-{$person['id']}", ['textarea_name' => 'content', 'media_buttons' => false]); ?>
                                <input type="hidden" name="hidden-description" value="<?= $person['description'] ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td align="right">
                                <a href="#cansel" class="page-title-action button-cansel">Закрыть без сохранения</a>
                                <a href="#ok" class="page-title-action button-primary button-ok">Сохранить</a>
                                <input type="hidden" name="person-id" value="<?= $person['id'] ?>"/>
                            </td>
                        </tr>
                    </table>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>