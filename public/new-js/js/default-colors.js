$(() => {
    var primaryButton = document.querySelectorAll('.btn-primary');
    var primaryOutlineButton = document.querySelectorAll('.btn-outline-primary');
    var allButtons = document.querySelectorAll('.btn');
    var listGroupItemAction = document.querySelectorAll('.list-group-item-action');
    var listGroupItemActionActive = document.querySelectorAll('.list-group-item-action.active');

    for (let i = 0; i < primaryButton.length; i++) {
        //Silicon theme
        setItemProperty( primaryButton[i], '--si-btn-color', _btn_color);
        setItemProperty( primaryButton[i], '--si-btn-bg', _btn_bg);
        setItemProperty( primaryButton[i], '--si-list-group-action-active-bg', _btn_bg);
        setItemProperty( primaryButton[i], '--si-btn-border-color', _btn_border_color);
        setItemProperty( primaryButton[i], '--si-btn-hover-border-color', _btn_hover_bg);

        //Front theme
        setItemProperty( primaryButton[i], '--bs-btn-bg', _btn_bg);
        setItemProperty( primaryButton[i], '--si-list-group-action-active-bg', _btn_bg);
        setItemProperty( primaryButton[i], '--bs-btn-border-color', _btn_border_color);
        setItemProperty( primaryButton[i], '--bs-btn-hover-border-color', _btn_hover_bg);
        setItemProperty( primaryButton[i], '--bs-btn-hover-bg', _btn_hover_bg);
        setItemProperty( primaryButton[i], 'color', _btn_color);
    }

    for (let i = 0; i < primaryOutlineButton.length; i++) {
        //Silicon theme
        setItemProperty( primaryOutlineButton[i], '--si-btn-color', _btn_color);
        setItemProperty( primaryOutlineButton[i], '--si-btn-bg', _btn_bg);
        setItemProperty( primaryOutlineButton[i], '--si-btn-border-color', _btn_border_color);
        setItemProperty( primaryOutlineButton[i], '--si-btn-hover-bg', _btn_hover_bg);

        //Front theme
        setItemProperty( primaryOutlineButton[i], '--bs-btn-color', _btn_bg);
        setItemProperty( primaryOutlineButton[i], '--bs-btn-active-bg', _btn_bg);
        setItemProperty( primaryOutlineButton[i], '--bs-btn-border-color', _btn_border_color);
        setItemProperty( primaryOutlineButton[i], '--bs-btn-hover-bg', _btn_hover_bg);
    }

    for (let i = 0; i < listGroupItemActionActive.length; i++) {
        setItemProperty( listGroupItemActionActive[i], 'background-color', _btn_bg);
        setItemProperty( listGroupItemActionActive[i], 'border-color', _btn_border_color);
    }
    for (let i = 0; i < listGroupItemAction.length; i++) {
        setItemProperty( listGroupItemAction[i], 'border-color', _btn_border_color);

        listGroupItemAction[i].addEventListener('mouseover', () => {
            setItemProperty( listGroupItemAction[i], 'color', _btn_hover_bg);
        });
        listGroupItemAction[i].addEventListener('mouseout', () => {
            setItemProperty( listGroupItemAction[i], 'color');
        });
    }

    function setItemProperty(item, property, value='') {
        item.style.setProperty(property, value);
    }
});
