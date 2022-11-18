$(document).ready(function () {

    var dataKey = "data-key";
    var dataKeySort = "data-key-sort";
    var dataKeyColumn = "data-key-column";

    var keyParams = [
        'sort-by',
        'limit',
        'search',
    ];
    var url = new URL(document.URL);
    var pathURL = location.pathname;
    var params = new URLSearchParams(window.location.search);
    var urlSearchParams = url.searchParams

    function loadTast(text = "Đang chạy ...", type = "info") {

        main.setUpPluginsToastr("toastr-top-left");
        if (type === "info" || type === 'in') toastr.info(text);
        if (type === "success" || type === 'su') toastr.success(text);
        if (type === "error" || type === 'er') toastr.error(text)
        if (type === "warning" || type === 'wa') toastr.warning(text)
    }

    function loadToUrl(url = '') {
        return window.location.href = pathURL + "?" + url;
    }

    function hasParameter(parameterName) {
        return urlSearchParams.has(parameterName);
    }

    function getParameter(parameterName) {
        return urlSearchParams.get(parameterName);
    }

    function deleteParameter(parameterName) {
        return urlSearchParams.delete(parameterName);
    }

    function toStringParameter() {
        return urlSearchParams.toString();
    }

    function checkDataKey(params) {
        var itemKey = keyParams.filter((item) => {
            return item == params;
        });
        if (itemKey.length > 0) {
            return true;
        }
        return false;
    }

    function setParameter(key, val) {
        console.log(val);
        if (!checkDataKey(key)) {
            loadTast('Data key chưa tồn tại', 'er');
            return;
        }
        if (hasParameter(key)) {
            deleteParameter(key)
        }
        if (!(val === 'null' || val == 0)) {
            urlSearchParams.set(key, val)
        }
        return loadToUrl(toStringParameter());
    }
    function setParameterSort(key, sort, column) {
        if (!checkDataKey(key)) {
            loadTast('Data key chưa tồn tại', 'er');
            return;
        }
        if (hasParameter(key)) deleteParameter(key)
        if (hasParameter('sort')) deleteParameter('sort')
        urlSearchParams.set('sort', sort)
        urlSearchParams.set(key, column)
        return loadToUrl(toStringParameter());
    }
    const listData = {
        filterToggle: function () {
            $('#filter_show').on('click', function (e) {
                e.preventDefault();
                $('#filter').slideToggle(1000, 'swing');

            });
        },
        resetPage: function () {
            $('button#reset-page').click(function (e) {
                e.preventDefault();
                return window.location.href = pathURL
            });
        },

        limitPage: function (elemenSelect) {
            $(document).on('change', elemenSelect, function (e) {
                var valLimit = $(this).val();
                const datakey = $(this).attr(dataKey);
                return setParameter(datakey, valLimit)
            });
        },
        search: function (elemenInput) {
            $(elemenInput).on('keypress', function (e) {
                if (e.which == 13) {
                    var valInput = $(this).val();
                    const datakey = $(this).attr(dataKey);
                    return setParameter(datakey, valInput)
                }
            });
        },

        sortBy: function (ele) {
            $(ele).on('click', function (e) {
                e.preventDefault();
                const datakey = $(this).attr(dataKey);
                const datakeycolumn = $(this).attr(dataKeyColumn);
                const datakeysort = $(this).attr(dataKeySort);

                setParameterSort(datakey, datakeysort, datakeycolumn)
            });
        }
    }

    listData.filterToggle();
    listData.resetPage();
    listData.limitPage("select#limit-page")
    listData.search("input#search")
    listData.sortBy("span.sort-by")

});


