/* global landing_url */

$(() => {
    function initListjs() {
        // INITIALIZATION OF LISTJS COMPONENT
        // =======================================================
        const docsSearch = HSCore.components.HSList.init('#docsSearch');

        fetch(landing_url)
            .then((response) => response.json())
            .then((data) => {
                docsSearch.getItem(0).add(data);
            });
    }

    initListjs();
});
