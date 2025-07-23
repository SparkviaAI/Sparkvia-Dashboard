/* global $, token */

import Core from './core';

$(() => {
    const menu_id = $('#menu_id').val();
    const removeText = $('#removeText').val();
    let linkNameText = $('#linkNameText').val();
    const updateMenuURL = $('#updateMenuURL').val();
    const categoryText = $('#categoryText').val();
    const promptText = $('#promptText').val();
    const contentPageText = $('#contentPageText').val();
    const customLinkText = $('#customLinkText').val();
    const openInNewTabText = $('#openInNewTabText').val();
    const linkText = $('#linkText').val();
    const $menuList = $('#menu_list');
    const $menuRow = $('#main-row');

    let menuBuilder = {
        int: function () {
            $('#nestable2').nestable({
                group: 1, maxDepth: 2
            });
        },
        cloneMenuItem: function (record) {
            let item =
                '  <li class="dd-item  dd3-item " data-id="' + record.id + '">' +
                '   <div class="dd-handle  dd3-handle"><span class="tab-title  menu-item-input">' + record.title + '</span>' +
                '        <input type="hidden" id="menu-item-category" value="' + record.categoryType + '"/> </div>' +
                '         <div class="dd3-content"><a href="#collapse' + record.id + '" class="toggle pull-right" data-toggle="collapse">' +
                '            <span class="item-category">' + record.categoryTitle + '</span><i class="caret"> </i></a>' +
                '        </div>' +
                '        <div class="collapse" id="collapse' + record.id + '">' +
                '        <div class="input-box">';
            if (record.categoryType === 'custom_link') {
                item +=
                    ' <div class="form-group">\n' +
                    '   <label>URL</label>\n' +
                    '   <input type="text" name="slug" value="' + record.url + '" class="form-control">\n' +
                    '  </div>\n' +
                    '  <div class="form-group">\n' +
                    '       <input type="checkbox" name="target" value=""  />' + openInNewTabText +
                    '  </div>';
                linkNameText = linkText;
            }

            item +=
                '  <div class="form-group">' +
                '    <label>' + linkNameText + '</label>' +
                '     <input type="text" name="name" value="' + record.title + '"  class="form-control update-menu-item">' +
                '  </div>  ' +
                '  <div class="form-group">' +
                '    <button class="btn btn-sm btn-danger remove-menu-item"  data-id="' + record.id + '" >' + removeText + '</button>' +
                '   </div>   </div>' +
                '    </div><ol class="dd-list"></ol></li>';
            $menuList.append(item);
        },
        prepareData: function (level, depth) {
            let array = [], item = {}, items = level.children('li');
            items.each(function () {
                let li = $(this);
                let targetElem = li.find('input[type="checkbox"]');
                let target = '';
                if (targetElem.length && targetElem[0].checked) target = '_blank';
                item = {
                    id: li.data('id'),
                    title: li.find('input[name="name"]').val(),
                    url: li.find('input[name="slug"]').val(),
                    category: li.find('input[type="hidden"]').val(),
                    target: target
                };
                let sub = li.children('ol');
                if (sub.length) {
                    item.children = menuBuilder.prepareData(sub, 3);
                }
                array.push(item);
            });
            return array;
        },
        updateMenu: function () {
            $('#btnUpdateMenu').click(function () {
                let list = $('.dd').nestable();
                let level = list.find('ol').first();
                let params = menuBuilder.prepareData(level, 2);

                if (params.length == 0) {
                    return false;
                }
                $menuRow.LoadingOverlay('show');
                $.ajax({
                    type: 'PUT',
                    url: updateMenuURL,
                    data: {params, menu_id},
                    success: function (response) {
                        $menuRow.LoadingOverlay('hide');
                        Core.toastSuccess(response.message);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        $menuRow.LoadingOverlay('hide');
                        const res = JSON.parse(xhr.responseText);
                        Core.toastError(res.message);
                    }
                });
            });
        },
        removeItem: function () {
            $(document).on('click', '.remove-menu-item', function () {
                let item = $(this).closest('.dd-item');
                item.remove();
            });
        },
        updateItemTitle: function () {
            $(document).on('change', '.update-menu-item', function (e) {
                let item = $(this).closest('.dd-item').find('.menu-item-input')[0];
                item.innerHTML= this.value;
            });
        },
        addCategory: function () {
            $('#add-categories').click(function () {
                let n = $('input[name="select-category[]"]:checked').length;
                let array = $('input[name="select-category[]"]:checked');
                let record = {};
                for (let i = 0; i < n; i++) {
                    record = {
                        id: array.eq(i).val(),
                        title: array.eq(i).data('title'),
                        categoryTitle: categoryText,
                        categoryType: 'category',
                        url: '',
                        link: ''
                    };
                    menuBuilder.cloneMenuItem(record);
                }
            });
        },
        addPrompt: function () {
            $('#add-prompts').click(function () {
                let n = $('input[name="select-prompt[]"]:checked').length;
                let array = $('input[name="select-prompt[]"]:checked');
                let params = [];
                let record = {};
                for (let i = 0; i < n; i++) {
                    record = {
                        id: array.eq(i).val(),
                        title: array.eq(i).data('title'),
                        categoryTitle: promptText,
                        categoryType: 'prompt',
                        url: '',
                        link: ''
                    };

                    menuBuilder.cloneMenuItem(record);
                    params.push(record);
                }
            });
        },
        addContentPage: function () {
            $('#add-pages').click(function () {
                let n = $('input[name="select-pages[]"]:checked').length;
                let array = $('input[name="select-pages[]"]:checked');
                let params = [];
                let record = {};
                for (let i = 0; i < n; i++) {
                    record = {
                        id: array.eq(i).val(),
                        title: array.eq(i).data('title'),
                        categoryTitle: contentPageText,
                        categoryType: 'contentPage',
                        url: '',
                        link: ''
                    };

                    menuBuilder.cloneMenuItem(record);
                    params.push(record);
                }
            });
        },
        addCustomLink: function () {
            $('#add-custom-link').click(function () {
                let record = {};
                let title = $('#linktext').val();
                record = {
                    id: Date.now(),
                    title: title,
                    url: $('#url').val(),
                    link: title,
                    categoryTitle: customLinkText,
                    categoryType: 'custom_link'
                };
                menuBuilder.cloneMenuItem(record);

            });
        }
    };

    menuBuilder.int();
    menuBuilder.removeItem();
    menuBuilder.updateMenu();
    menuBuilder.updateItemTitle();
    menuBuilder.addCategory();
    menuBuilder.addPrompt();
    menuBuilder.addContentPage();
    menuBuilder.addCustomLink();


    $('#menu-items .collapse').on('show.bs.collapse', function (e) {
        let actives = $('#menu-items').find('.show, .collapse');
        actives.each( function (index, element) {
            $(element).collapse('hide');
        });
    });

    $('#select-all-categories').click(function (event) {
        if (this.checked) {
            $('#categories-list :checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $('#categories-list :checkbox').each(function () {
                this.checked = false;
            });
        }
    });

    $('#select-all-prompts').click(function (event) {
        if (this.checked) {
            $('#prompts-list :checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $('#prompts-list :checkbox').each(function () {
                this.checked = false;
            });
        }
    });

    $('#select-all-pages').click(function (event) {
        if (this.checked) {
            $('#pages-list :checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $('#pages-list :checkbox').each(function () {
                this.checked = false;
            });
        }
    });
});

