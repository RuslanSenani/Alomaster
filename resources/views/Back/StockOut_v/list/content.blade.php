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

                    </div>
                    <div class="col-md-2 ">
                        <a href="{{Route("stock-out.create")}}" type="button"
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

                            <th>Mehsul Adı</th>
                            <th>Anbar Adı</th>
                            <th>Mehsul Kodu</th>
                            <th>Mehsul Modeli</th>
                            <th>Mehsul Kateqoriyası</th>
                            <th>Müştəri</th>
                            <th>Mehsul Məlumatı</th>
                            <th>Mehsul Şəkili</th>
                            <th>Mehsul Çıxış Sayı</th>
                            <th>Mehsul Vahidi</th>
                            <th>Mehsul Satış Qiyməti</th>
                            <th>Mehsul Çıxış Tarixi</th>
{{--                            <th>Əməliyyatlar</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stockOutList as $stockOut)

                            <tr>
                                <td>{{$stockOut->product_name}}</td>
                                <td>{{$stockOut->warehouse_name}}</td>
                                <td>{{$stockOut->product_code}}</td>
                                <td>{{$stockOut->model_name}}</td>
                                <td>{{$stockOut->category_name}}</td>
                                <td>{{$stockOut->customer->name}}</td>
                                <td>{{$stockOut->product_description}}</td>
                                <td class="text-center col-md-2">
                                    <div class="image">
                                        <img
                                                src="{{asset($stockOut->product_img)}}"
                                                alt="Məhsul Şəkli"
                                                width="100%" height="100%">
                                    </div>
                                </td>
                                <td>{{$stockOut->qty}}</td>
                                <td>{{$stockOut->product_unit}}</td>
                                <td>{{$stockOut->product_unit_sale_price}}</td>
                                <td>{{Carbon\Carbon::parse($stockOut->exit_date)->format('d-m-Y')}}</td>

{{--                                <td>--}}

{{--                                    <form id="delete-form" action="{{ Route('stock-out.destroy', $stockOut->id) }}"--}}
{{--                                          method="POST">--}}
{{--                                        <div class="d-flex justify-content-between" role="group">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" id="delete-button"--}}
{{--                                                    class="btn btn-outline-danger btn-md"><i class="fa fa-trash"></i>--}}
{{--                                            </button>--}}

{{--                                            <a href="{{Route("stock-out.edit",$stockOut->id)}}"--}}
{{--                                               class="btn btn-outline-primary btn-md"><i class="fa fa-edit"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}

{{--                                </td>--}}

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
