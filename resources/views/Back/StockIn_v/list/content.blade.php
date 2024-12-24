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
                        <a href="{{Route("stock-in.create")}}" type="button"
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
                            <th>Anbar Adı</th>
                            <th>Mehsul Adı</th>
                            <th>Mehsul Kodu</th>
                            <th>Mehsul Modeli</th>
                            <th>Mehsul Kateqoriyası</th>
                            <th>Mehsul Tədarükçüsü</th>
                            <th>Mehsul Məlumatı</th>
                            <th>Mehsul Şəkili</th>
                            <th>Mehsul Giriş Sayı</th>
                            <th>Mehsul Vahidi</th>
                            <th>Mehsul Vahid Qiyməti</th>
                            <th>Mehsul Giriş Tarixi</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stockList as $stock)




                            <tr>
                                <td>{{$stock->warehouse->name}}</td>
                                <td>{{$stock->product->product_name}}</td>
                                <td>{{$stock->product->product_code}}</td>
                                <td>{{$stock->model->name}}</td>
                                <td>{{$stock->category->name}}</td>
                                <td>{{$stock->supplier->name}}</td>
                                <td>{{$stock->product->product_description}}</td>
                                <td class="text-center col-md-2">
                                    <div class="image">
                                        <img
                                            src="{{asset($stock->product->product_img)}}"
                                            alt="Məhsul Şəkli"
                                            width="100%" height="100%" >
                                    </div>
                                </td>
                                <td>{{$stock->qty}}</td>
                                <td>{{$stock->product_unit}}</td>
                                <td>{{$stock->product_unit_price}}</td>
                                <td>{{Carbon\Carbon::parse($stock->enter_date)->format('d-m-Y')}}</td>

                                <td>

                                    <form id="delete-form" action="{{ Route('stock-in.destroy', $stock->id) }}"
                                          method="POST">
                                        <div class="d-flex justify-content-between" role="group">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="delete-button"
                                                    class="btn btn-outline-danger btn-md"><i class="fa fa-trash"></i>
                                            </button>

                                            <a href="{{Route("stock-in.edit",$stock->id)}}" class="btn btn-outline-primary btn-md"><i class="fa fa-edit"></i></a>
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
