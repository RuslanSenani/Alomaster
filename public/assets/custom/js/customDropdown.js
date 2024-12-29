$(document).ready(function () {
    $("#product").change(function () {
        const selectedProductId = $(this).val();
        //const baseUrl = document.querySelector('meta[name="base-url"]').getAttribute('content');

        const baseUrl = "http://127.0.0.1:8080/admin"

        alert(baseUrl);
        if (selectedProductId) {
            $.ajax({
                url: baseUrl + "/ajax-product",
                method: "GET",
                data: {
                    product_id: selectedProductId
                },
                success: function (response) {
                    $('#unit').val(response.unit);
                    $('#description').val(response.description);
                    $('#code').val(response.code);
                    $('#imagePath').val(response.imagePath);
                    $('#image').attr('src', response.image).show();

                },
                error: function (error) {

                    console.error('Error fetching product details:', error);
                }
            })
        }

    });

})
$(document).ready(function () {
    $("#stockOut").change(function () {
        const selectedStockId = $(this).val();
        const baseUrl = document.querySelector('meta[name="base-url"]').getAttribute('content');

        if (selectedStockId) {
            $.ajax({
                url: baseUrl + "/ajax-stock",
                method: "GET",
                data: {
                    stock_id: selectedStockId
                },
                success: function (response) {
                    $('#unit').val(response.unit);
                    $('#description').val(response.description);
                    $('#code').val(response.code);
                    $('#imagePath').val(response.imagePath);
                    $('#warehouse').val(response.warehouse);
                    $('#category').val(response.category);
                    $('#model').val(response.model);
                    $('#image').attr('src', response.image).show();

                },
                error: function (error) {

                    console.error('Error fetching product details:', error);
                }
            })
        }

    });

})
