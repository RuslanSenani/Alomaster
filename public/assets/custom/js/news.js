$(document).ready(function () {

    $(document).on('change', '.news_type_select', function (event) {
        if ($(this).val() === 'image') {
            $(".image_upload_container").show();
            $(".video_url_container").hide();

            // $(".video_url_container input").prop('disabled', true);
            //
            // $(".image_upload_container input").prop('disabled', false);

        } else if ($(this).val() === 'video') {
            $(".video_url_container").show();
            $(".image_upload_container").hide();

            // $(".video_url_container input").prop('disabled', false);
            //
            // $(".image_upload_container input").prop('disabled', true);
        }
    })

})
