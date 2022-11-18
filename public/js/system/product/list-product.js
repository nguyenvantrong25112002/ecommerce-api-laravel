const product = {
    addAttr: function () {
        $('.add_attr').click(function (e) {
            e.preventDefault();
            var id_pro = $(this).attr('data-id_pro');
            // $('#id_pro').val(id_pro);
            $.ajax({
                type: "get",
                url: URL_PRODUCT_ATTR_EDIT,
                data: {
                    id_pro: id_pro,
                },
                success: function (response) {
                    $('#modal_body').html(response);
                },
            });
        });
    },
    deleteProduct: function () {
        $('.deleteProduct').click(function (e) {
            e.preventDefault();
            var id_product = $(this).attr("data-id_pro");
            var name_product = $(this).attr("data-text_namePro");
            var img_product = $(this).attr("data-img_pro");

            Swal.fire({
                title: 'Bạn có chắc chắn muốn sản phẩm này!!!',
                icon: 'question',
                text: name_product,
                imageUrl: '' + img_product + '',
                // imageWidth: auto,
                imageHeight: 200,
                imageAlt: 'Custom image',
                showCancelButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK !!!',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Xóa !!',
                        'Xóa sản phẩm thành công !!',
                        'success',
                    );
                    $.ajax({
                        type: "GET",
                        url: URL_PRODUCT_DELETE,
                        data: {
                            id_product: id_product,
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            })
        });
    },
    changeStatus: function () {
        $('.status_product').click(function (e) {
            e.preventDefault();
            var id_product = $(this).attr("data-id_pro");
            var name_product = $(this).attr("data-text_namePro");
            var status_product = $(this).attr("data-status");
            Swal.fire({
                title: 'Bạn có chắc chắn muốn thay đổi trạng thái sản phẩm !!!',
                text: name_product,
                icon: 'question',
                showCancelButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK !!!',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Cập nhập thành công !!',
                        'Thay đổi trạng thái sản phẩm thành công !!',
                        'success',
                    );
                    $.ajax({
                        type: "GET",
                        url: URL_PRODUCT_STATUS,
                        data: {
                            id_product: id_product,
                            status_product: status_product,
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            })
        });
    },
    filterCategory: function () {

        $('#filter-category').change(function (e) {
            e.preventDefault();
            let val = $(this).val();
            $(this).attr('selected', 'selected');
            window.location.href = URL_MAIN + `category=${val}`
        });
    }
}
product.addAttr();
product.deleteProduct();
product.changeStatus();
product.filterCategory();