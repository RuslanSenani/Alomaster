<!DOCTYPE html>
<html lang="en">


@include("includes.static.head")

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">


    <!-- Navbar -->

    @include("includes.static.navbar")

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    @include("includes.static.sidebar")

    <!-- Content Wrapper. Contains edit content -->

    @include("Back.Customer_v.edit.content")
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    @include("includes.static.controller")
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include("includes.static.js")
</body>

@include("includes.static.footer")

</html>
