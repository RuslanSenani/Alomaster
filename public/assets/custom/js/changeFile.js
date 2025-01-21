$(document).ready(function () {

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
})
