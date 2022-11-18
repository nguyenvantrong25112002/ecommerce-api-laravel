const product = {
    saleOFFPRICE: function (elePrice, eleSaleOff, elePriceSale, end_price_sale) {
        function ketqua(price, sale_off) {
            $(end_price_sale).val((Number(price) * Number(sale_off)) / 100);
            $(elePriceSale).val(price - ((Number(price) * Number(sale_off)) / 100));

            if (price == null && sale_off == null) {
                $(end_price_sale).val(null);
                $(elePriceSale).val(null);
            }
        }

        ketqua($(elePrice).val(), $(eleSaleOff).val());
        $(elePrice).on('keyup focus', function (e) {

            return ketqua($(this).val(), $(eleSaleOff).val())
        });

        $(eleSaleOff).on('keyup focus', function (e) {
            if (Number($(this).val()) > 100) {
                $(this).val(99)
            } else if (Number($(this).val()) < 0) {
                $(this).val(null)
            }
            return ketqua($(elePrice).val(), $(this).val())
        });
    },
    selectParent: function () {
        var elementInput = "input[name='category_id[]']";

        function check(params, isCheck = true) {
            const elementInput = `input[name='category_id[]'][value=${params}]`
            $(elementInput).prop('checked', isCheck);
            const data_parent = $(elementInput).attr('data-parent');
            if (data_parent != 'null') {
                check_2(data_parent, isCheck)
            }
            return;
        }

        function check_2(params, isCheck = true) {
            const elementInput = `input[name='category_id[]'][value=${params}]`
            $(elementInput).prop('checked', isCheck);
            const data_parent = $(elementInput).attr('data-parent');
            if (data_parent != 'null') {
                check(data_parent, isCheck)
            }
            return;
        }

        function unCheckParent(params) {
            const elementInput = `input[name='category_id[]'][data-parent=${params}]`

            if (!($(elementInput).is(':checked'))) return;
            $(elementInput).prop('checked', false);
            const value = $(elementInput).val();
            unCheckParent_2(value);
            return;
        }

        function unCheckParent_2(params) {
            const elementInput = `input[name='category_id[]'][data-parent=${params}]`
            if (!($(elementInput).is(':checked'))) return;
            $(elementInput).prop('checked', false);
            const value = $(elementInput).val();
            unCheckParent(value);
            return;
        }

        $(elementInput).on('change', function () {
            var $this = $(this);
            const value = $this.val();
            const data_parent = $(this).attr('data-parent');
            if ($this.is(':checked')) {
                if (data_parent != 'null') {
                    check(data_parent, true)
                }
                return;
            } else {
                if (data_parent != 'null') {
                    unCheckParent(data_parent)
                }
                unCheckParent(value)
                return;
            }
        });
    }
}
product.selectParent();
