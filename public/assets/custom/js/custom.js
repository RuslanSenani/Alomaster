$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });

    $(function () {
        const fields = ['#about_us', '#address', '#mission', '#vision'];
        fields.forEach(function (selector) {
            $(selector).summernote({
                height: '300px', width: '100%',
            });
        });
    });

    $(document).on("change", ".isActive", function () {

        let checked = $(this);
        let data = checked.prop('checked');
        let data_url = checked.data('url');

        if (typeof data !== 'undefined' && typeof data_url !== 'undefined') {

            $.post(data_url, {data: data}, function (response) {
            })
        }
    });

    $(document).on("change", ".isCover", function () {
        initializeSortable()
        let checked = $(this);
        let data = checked.prop('checked');
        let data_url = checked.data('url');

        if (typeof data !== 'undefined' && typeof data_url !== 'undefined') {

            $.post(data_url, {data: data}, function (response) {
                $(".image-list-container").html(response);
                initializeSortable()
            })
        }
    });

    function initializeSortable() {
        $(".sortable").sortable().on('sortupdate', function (event, ui) {


            let data = $(this).sortable("serialize");
            let data_url = ui.item.data('url');

            $.post(data_url, {data: data}, function (response) {

            })
        });
    }


    $(document).on("click", ".remove-btn", function (e) {
        e.preventDefault();

        let button = $(this);
        let data_url = button.data('url');

        Swal.fire({
            title: 'Silinmə!',
            text: 'Silmək istədiyinizdən əminsiziz ?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sil',
            cancelButtonText: 'Ləğv Et',

        }).then((function (result) {

            if (result.value) {

                $.ajax({
                    url: data_url,
                    type: 'DELETE',
                    success: function (response) {

                        window.location.href = response.redirect_url

                    }

                })
            }
        }))
    });

    $(document).ready(function () {
        initializeSortable()
        let uploadSection = Dropzone.forElement("#fileUpload");

        uploadSection.on('complete', function (file) {
            //console.log(file);
            let data_url = $('#fileUpload').data('url');
            $.post(data_url, {}, function (response) {
                $(".image-list-container").html(response);
                initializeSortable()
            })

        })
    })


})






