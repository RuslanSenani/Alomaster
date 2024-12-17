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
                        <a href="{{Route("suppliers.create")}}" type="button"
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
                            <th class="col-md-3">Tədarükçü Adı</th>
                            <th class="col-md-3">Tədarükçü Kodu</th>
                            <th class="col-md-3">Tədarükçü Emaili</th>
                            <th class="col-md-2">Tədarükçü Telefonu</th>
                            <th class="col-md-1">Əməliyyatlar</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($supplierList as $supplier)

                            <tr>
                                <td>{{$supplier->name}}</td>
                                <td>{{$supplier->code}}</td>
                                <td>{{$supplier->email}}</td>
                                <td>{{$supplier->phone}}</td>
                                <td>
                                    <form id="delete-form" action="{{Route("suppliers.destroy",$supplier->id)}}" method="POST">
                                        <div class="d-flex justify-content-between" role="group">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="delete-button"
                                                    class="btn btn-outline-danger btn-md"><i class="fa fa-trash"></i>
                                            </button>
                                            <a href="{{Route("suppliers.edit",$supplier->id)}}"
                                               class="btn btn-outline-primary btn-md"><i class="fa fa-edit"></i></a>
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
