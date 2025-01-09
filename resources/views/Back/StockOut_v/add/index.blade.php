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

    <!-- Content Wrapper. Contains edit content -->

    @include("Back.StockOut_v.add.content")

    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    @include("Back.includes.static.controller")
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include("Back.includes.static.js")
@include("Back.includes.static.customJs")
@include("Back.includes.static.dropdownJs")


</body>

@include("Back.includes.static.footer")

</html>
