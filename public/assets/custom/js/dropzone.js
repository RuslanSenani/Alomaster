$(document).ready(function () {
    Dropzone.options.fileUpload = {
        maxFilesize: 2,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        autoProcessQueue: true,
        uploadMultiple: true,
        parallelUploads: 20,
        maxFiles: 20,
        init: function () {
            //let myDropzone = this;


            this.on("success", function (file, response) {
                console.log("Başarıyla yüklendi:", response);
            });


            this.on("error", function (file, response) {
                console.error("Yükleme hatası:", response);
            });

            //
            // document.querySelector("#startUpload").addEventListener("click", function () {
            //     myDropzone.processQueue();
            // });
        }
    };

})
