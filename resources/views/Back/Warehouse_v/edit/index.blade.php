<!DOCTYPE html>
<html lang="en">


@include("Back.includes.static.head")

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">


    <!-- Navbar -->

    @include("Back.includes.static.navbar")

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    @include("Back.includes.static.sidebar")

    <!-- Content Wrapper. Contains page content -->

    @include("Back.Warehouse_v.edit.content")
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    @include("Back.includes.static.controller")
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include("Back.includes.static.js")
</body>

@include("Back.includes.static.footer")

</html>
