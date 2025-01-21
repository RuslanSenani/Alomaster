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

$(function () {
    bsCustomFileInput.init();
});


const fileInput = document.getElementById('fileInput');
const previewImage = document.getElementById('previewImage');


fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();


        reader.onload = (e) => {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };


        reader.readAsDataURL(file);
    }
});

