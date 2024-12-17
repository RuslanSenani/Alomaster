$(document).ready(function () {
    $("#product").change(function () {
        const selectedProductId = $(this).val();
        const productCodeDropdown = $("#code");
        const baseUrl = `${window.location.origin}/${window.location.pathname.split('/')[1]}`;

        if (selectedProductId) {
            $.ajax({
                url: baseUrl + "/get-product-details",
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
