<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->


            <div class="card d-flex justify-content-between">

                <div class="card-header row">
                    <div class="col-md-10">
                        <h3 class="card-title">Məhsullar</h3>
                    </div>
                    <div class="col-md-2 ">
                        <a href="{{Route("products.create")}}" type="button"
                           class="btn btn-block btn-outline-primary btn-sm">
                            <i class="fa fa-plus"></i> Giriş Et
                        </a>
                    </div>
                </div>


                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center col-md-3">Məhsul Adı</th>
                            <th class="text-center col-md-3">Məhsul Kodu</th>
                            <th class="text-center col-md-3">Məhsul Vahidi</th>
                            <th class="text-center col-md-2">Məhsul Məlumatı</th>
                            <th class=" col-md-2">Məhsul Şəkli</th>
                            <th class="text-center col-md-2">Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($productList as $product)
                            <tr>
                                <td class="text-center col-md-3">{{$product->product_name}}</td>
                                <td class="text-center col-md-3">{{$product->product_code}}</td>
                                <td class="text-center col-md-3">{{$product->unit->name}}</td>
                                <td class="text-center col-md-2">{{$product->product_description}}</td>
                                <td class="text-center col-md-2">
                                    <div class="image">
                                        <img
                                            src="{{asset($product->product_img)}}"
                                            alt="Məhsul Şəkli"
                                            width="100%" height="100%">
                                    </div>
                                    <div class="mt-3">
                                        <img id="imagePreview" src="" alt="Şəkil önizləmə"
                                             style="max-width: 300px; display: none;">
                                    </div>
                                </td>
                                <td class="text-center col-md-2">

                                    <form id="delete-form" action="{{Route("products.destroy",$product->id)}}"
                                          method="POST">
                                        <div class="d-flex justify-content-between" role="group">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="delete-button"
                                                    class="btn btn-outline-danger btn-md">Sil
                                            </button>
                                            <a href="{{Route("products.edit",$product->id)}}"
                                               class="btn btn-outline-primary btn-md">Redaktə Et</a>
                                        </div>
                                    </form>

                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
