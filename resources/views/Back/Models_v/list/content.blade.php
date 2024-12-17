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
                        <a href="{{Route("models.create")}}" type="button"
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
                            <th>Model Adı</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modelList as $model)

                            <tr>

                                <td class="col-md-10">{{$model->name}}</td>
                                <td class="col-md-2">

                                    <form id="delete-form" action="{{Route("models.destroy",$model->id)}}" method="POST">
                                        <div class="d-flex justify-content-between" role="group">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="delete-button"
                                                    class="btn btn-outline-danger btn-md">Sil
                                            </button>
                                            <a href="{{Route("models.edit",$model->id)}}" class="btn btn-outline-primary btn-md">Redaktə Et</a>
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
