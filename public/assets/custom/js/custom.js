$(document).ready(function () {


    $(".sortable").sortable();

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
                height: '300px',
                width: '100%',
            });
        });
    });

    // $(".isActive").change(function (){
    //     var $data = $(this).prop('checked');
    //     var $data_url = $(this).data('url');
    //     if(typeof $data !== 'undefined' && typeof $data_url !== 'undefined'){
    //         $data_url = $data_url.replace('{0}', $data_url);
    //     }
    // })

    $(".sortable").on('sortupdate', function (event, ui) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        const baseUrl = document.querySelector('meta[name="base-url"]').getAttribute('content');
        let $data = $(this).sortable("serialize");
        let $data_url = baseUrl + '/ajax-rankSetter';

        $.post($data_url, {data: $data}, function (response) {
        })
    })


})






