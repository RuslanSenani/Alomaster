<?php


use RealRashid\SweetAlert\Facades\Alert;

if (!function_exists('draggableAlert')) {
    function draggableAlert($title = "Drag me!", $icon = "success"): void
    {
        Alert::html($title, '', $icon)
            ->position('center')
            ->toHtml()
            ->persistent(true);


        echo "<script>
            Swal.fire({
                title: '{$title}',
                icon: '{$icon}',
                position:'top-right'
            });
        </script>";
    }
}
