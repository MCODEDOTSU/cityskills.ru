(function ($) {

    $(document).ready(function (e) {

        $('.centerastrakhan-persons .row-actions .edit a').on('click', function () {

            canselEditor($('table.person-data', $('.person-edit-dialog.visibility')));

            $('.person-edit-dialog.visibility').removeClass('visibility');

            $(`#person-edit-dialog-${$(this).data('id')}`).addClass('visibility');

        });

        $('.centerastrakhan-persons .row-actions .delete a').on('click', function () {

            deletePerson($(`#person-edit-dialog-${$(this).data('id')}`), $(this).parents('tr.short-person-data'));

        });

        $('.centerastrakhan-persons .button-cansel').on('click', function () {

            $(`.person-edit-dialog`).removeClass('visibility');

            canselEditor($(this).parents('table.person-data'));

        });

        $('.centerastrakhan-persons .button-ok').on('click', function () {

            savePerson($(this).parents('table.person-data'));

        });

        $('.centerastrakhan-persons .add-person').on('click', function () {

            addPerson();

        });

        $('.centerastrakhan-persons .add-image').on('click', function () {

            selectImage($(this));

        });

        $('.centerastrakhan-persons .delete-image').on('click', function () {

            deleteImage($(this));

        });

    });

    function canselEditor($parent)
    {

        if($parent.length === 0) {
            return;
        }

        $('.person-field', $parent).each(function() {

            $(this).val($(this).data('save'));

        });

        tinyMCE.get(`person-description-${$('input[name="person-id"]', $parent).val()}`).setContent($('input[name="hidden-description"]', $parent).val());

        let url = $('input[name="photo-url"]', $parent).val();
        let html = `<div class="image-container image" data-id="${$('input[name="person-id"]', $parent).val()}">
            <img src="${url}" class="item-image"/><button class="delete-image page-title-action">Удалить</button></div>`;
        $('.image-container-list', $parent).html(html);

        $('.centerastrakhan-persons .delete-image').on('click', function () {
            deleteImage($(this));
        });

    }

    function savePerson($parent)
    {

        let data = {
            id: $('input[name="person-id"]', $parent).val(),
            firstname: $('input[name="firstname"]', $parent).val(),
            lastname: $('input[name="lastname"]', $parent).val(),
            middlename: $('input[name="middlename"]', $parent).val(),
            post: $('input[name="post"]', $parent).val(),
            description: tinyMCE.get(`person-description-${$('input[name="person-id"]', $parent).val()}`).getContent(),
            photo: $('input[name="photo"]', $parent).val(),
            action: 'mcode_person_save',
        };

        $('.centerastrakhan-persons .notice').hide(300);

        $.post(
            ajaxurl, data,
            function (result) {

                if (result['status'] === 'error') {

                    $('.centerastrakhan-persons .notice.error p').html(`Ошибка: ${result['result']}`);
                    $('.centerastrakhan-persons .notice.error').show(300);

                } else {

                    $('.centerastrakhan-persons .notice.updated p').html(`Данные для персоны "${data['lastname']} ${data['firstname']}" обновлены`);
                    $('.centerastrakhan-persons .notice.updated').show(300);
                    $(`.person-edit-dialog`).removeClass('visibility');

                }

                setTimeout(function () {

                    $('.centerastrakhan-persons .notice').hide(300);

                }, 3000);

            }, 'json'
        );
    }

    function deletePerson($parent, $tr)
    {

        let data = {
            id: $('input[name="person-id"]', $parent).val(),
            action: 'mcode_person_delete',
        };

        if (confirm(`Вы уверены, что хотите удалить персону?`)) {

            $.post(
                ajaxurl, data,
                function (result) {

                    if (result['status'] === 'error') {

                        $('.centerastrakhan-persons .notice.error p').html(`Ошибка: ${result['result']}`);
                        $('.centerastrakhan-persons .notice.error').show(300);

                    } else {

                        $('.centerastrakhan-persons .notice.updated p').html(`Персона удалена`);
                        $('.centerastrakhan-persons .notice.updated').show(300);
                        $(`.person-edit-dialog`).removeClass('visibility');

                    }

                    $tr.hide(300, function () { $tr.remove(); });
                    $parent.hide(300, function () { $parent.remove(); });

                    setTimeout(function () {
                        $('.centerastrakhan-persons .notice').hide(300);
                    }, 3000);

                }, 'json'
            );

        } else {

            $('.centerastrakhan-persons .notice.error p').html(`Запрос на удаление отменён пользователем`);
            $('.centerastrakhan-persons .notice.error').show(300);

        }


    }

    function addPerson()
    {

        $('.centerastrakhan-persons .notice').hide(300);

        let firstname = prompt("Введите имя", "");

        if (firstname) {

            let lastname = prompt("Введите фамилию", "");

            if (lastname) {

                //mcode_person_add

                $.post(
                    ajaxurl, {
                        firstname, lastname,
                        action: "mcode_person_add"
                    },
                    function (result) {

                        if (result['status'] === 'error') {

                            $('.centerastrakhan-persons .notice.error p').html(`Ошибка: ${result['result']}`);
                            $('.centerastrakhan-persons .notice.error').show(300);

                            setTimeout(function () {
                                $('.centerastrakhan-persons .notice').hide(300);
                            }, 3000);

                        } else {

                            $('.centerastrakhan-persons .notice.updated p').html(`Новая персона добавлена. Ожидайте перезагрузки`);
                            $('.centerastrakhan-persons .notice.updated').show(300);

                            setTimeout(function () { location.reload(); }, 3000);

                        }

                    }, 'json'
                );

            } else {
                $('.centerastrakhan-persons .notice.error p').html(`Добавление персоны отменено пользователем: не задана фамилия персоны`);
                $('.centerastrakhan-persons .notice.error').show(300);

                setTimeout(function () {
                    $('.centerastrakhan-persons .notice').hide(300);
                }, 3000);
            }

        } else {

            $('.centerastrakhan-persons .notice.error p').html(`Добавление персоны отменено пользователем: не задано имя персоны`);
            $('.centerastrakhan-persons .notice.error').show(300);

            setTimeout(function () {
                $('.centerastrakhan-persons .notice').hide(300);
            }, 3000);

        }
    }

    /**
     * Выбрать изображение
     */
    function selectImage($element) {

        let $container = $element.parent('.person-image-container');

        $element = $element.parent();

        let image_frame;
        if (image_frame) image_frame.open();

        image_frame = wp.media({
            title: 'Select Media',
            multiple: false,
            library: {type: 'image'}
        });

        image_frame.on('close', function () {
            let item = image_frame.state().get('selection').first();
            let url = item['attributes']['url'];
            let html = `<div class="image-container image" data-id="${item.id}"><img src="${url}" class="item-image"/><button class="delete-image page-title-action">Удалить</button></div>`;
            $('.image-container-list', $container).html(html);
            $('input.images-text-list', $container).val(item.id);

            $('.centerastrakhan-persons .delete-image').on('click', function () {
                deleteImage($(this));
            });

        });

        image_frame.open();
    }

    /**
     * Удалить изображение
     * @param $element
     */
    function deleteImage($element) {
        let $container = $element.parent('.person-image-container');
        $element = $element.parent('.image-container');
        $('input.images-text-list', $container).val('');
        $element.remove();
    }

})(jQuery);