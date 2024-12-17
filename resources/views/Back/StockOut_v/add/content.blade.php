<!-- Content Wrapper. Contains page content -->
<hr>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{$pageName}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">

                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="enterDate">Çıxış Tarixi:</label>
                                                <input type="date" class="form-control" id="enterDate"
                                                       placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="from-group col-md-12">
                                    <div class="row">

                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="productName">Məhsul Adı:</label>
                                                <input type="text" class="form-control" id="productName"
                                                       placeholder="Məhsul Adı">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="productCode">Məhsul Kodu:</label>
                                                <input type="text" class="form-control" id="productCode"
                                                       placeholder="Məhsul Kodu">
                                            </div>
                                        </div>


                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="productCategory">Kateqoria:</label>
                                                <input type="text" class="form-control" id="productCategory"
                                                       placeholder="Kateqoria">
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="productExitCount">Çıxan Say:</label>
                                                <input type="text" class="form-control" id="productExitCount"
                                                       placeholder="Çıxan Sayı">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="productUnit">Vahid:</label>
                                                <input type="text" class="form-control" id="productUnit"
                                                       placeholder="Vahid">
                                            </div>

                                        </div>

                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="productUnitSalePrice">Satış Qiyməti:</label>
                                                <input type="text" class="form-control" id="productUnitSalePrice"
                                                       placeholder="Satış Qiyməti">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <button type="submit" class="btn  btn-outline-primary btn-md">Saxla
                                            </button>
                                        </div>
                                        <div class="col-md-1">
                                            <a type="submit" class="btn  btn-outline-danger btn-md">Ləğv Et</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
