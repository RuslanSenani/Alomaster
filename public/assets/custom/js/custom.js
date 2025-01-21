$(document).ready(function () {
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })

    $(function () {
        const fields = ['#about_us', '#address', '#mission', '#vision'];
        fields.forEach(function (selector) {
            $(selector).summernote({
                height: '300px',
                width: '100%',
            });
        });
    });
})






