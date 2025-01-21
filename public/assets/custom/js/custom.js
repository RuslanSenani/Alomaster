// document.getElementById('delete-button').addEventListener('click', function (event) {
//     event.preventDefault();
//     Swal.fire({
//         title: 'Əminsiz?',
//         text: "Bu Proses Geri Qaytarılmır!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Bəli, Sil!',
//         cancelButtonText: 'Xeyir, Ləğv et',
//         reverseButtons: true
//     }).then((result) => {
//         if (result.isConfirmed) {
//             document.getElementById('delete-form').submit();
//         }
//     })
// })


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




