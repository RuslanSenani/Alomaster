$(document).ready(function () {

    $(document).on('change', '.news_type_select', function (event) {
        if ($(this).val() === 'image') {
            $(".image_upload_container").show();
            $(".video_url_container").hide();

        } else if ($(this).val() === 'video') {
            $(".video_url_container").show();
            $(".image_upload_container").hide();

        }
    })

})
