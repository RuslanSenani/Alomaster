$(document).ready(function () {

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

    $(".isActive").change(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let data = $(this).prop('checked');
        let data_url = $(this).data('url');

        if (typeof data !== 'undefined' && typeof data_url !== 'undefined') {

            $.post(data_url, {data: data}, function (response) {
            })
        }
    })

    $(".sortable").sortable().on('sortupdate', function (event, ui) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let data = $(this).sortable("serialize");
        let data_url = ui.item.data('url');

        $.post(data_url, {data: data}, function (response) {

        })
    })


})






