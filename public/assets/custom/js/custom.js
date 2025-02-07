//Product
$(document).ready(function () {
    $("#product").change(function () {
        const selectedProductId = $(this).val();
        const baseUrl = document.querySelector('meta[name="base-url"]').getAttribute('content');


        if (selectedProductId) {
            $.ajax({
                url: baseUrl + "/ajax-product",
                method: "GET",
                data: {
                    product_id: selectedProductId
                },
                success: function (response) {
                    $('#unit').val(response.unit);
                    $('#descr').val(response.description);
                    $('#code').val(response.code);
                    $('#imagePath').val(response.imagePath);
                    $('#image').attr('src', response.image).show();

                },
                error: function (error) {

                    console.error('Error fetching product details:', error);
                }
            })
        }

    });

})

//Stock Out
$(document).ready(function () {
    $("#stockOut").change(function () {
        const selectedStockId = $(this).val();
        const baseUrl = document.querySelector('meta[name="base-url"]').getAttribute('content');

        if (selectedStockId) {
            $.ajax({
                url: baseUrl + "/ajax-stock",
                method: "GET",
                data: {
                    stock_id: selectedStockId
                },
                success: function (response) {
                    $('#unit').val(response.unit);
                    $('#descr').val(response.description);
                    $('#code').val(response.code);
                    $('#imagePath').val(response.imagePath);
                    $('#warehouse').val(response.warehouse);
                    $('#category').val(response.category);
                    $('#model').val(response.model);
                    $('#image').attr('src', response.image).show();

                },
                error: function (error) {

                    console.error('Error fetching product details:', error);
                }
            })
        }

    });

})

//File Change
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

$(document).ready(function () {
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2('destroy')

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({icons: {time: 'far fa-clock'}});

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function (event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })

        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    })
// BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

// DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/target-url", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function (file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function () {
            myDropzone.enqueueFile(file)
        }
    })

// Update the total progress bar
    myDropzone.on("totaluploadprogress", function (progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function (file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

// Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function (progress) {
        document.querySelector("#total-progress").style.opacity = "0"
    })

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function () {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function () {
        myDropzone.removeAllFiles(true)
    }
})

$(document).ready(function () {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $(function () {
        const fields = ['#about_us', '#address', '#mission', '#vision', '#description'];
        fields.forEach(function (selector) {
            $('textarea'+selector).summernote({
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






