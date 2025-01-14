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
                        <a href="{{Route("roles.create")}}" type="button"
                           class="btn btn-block btn-outline-primary btn-sm">
                            <i class="fa fa-plus"></i> Rol Yarat
                        </a>
                    </div>
                </div>


                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Rol Adı</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roleList as $role)

                            <tr>

                                <td class="col-md-1">{{$role->id}}</td>
                                <td class="col-md-4">{{$role->name}}</td>
                                <td class="col-md-2">

                                    <form id="delete-form" action="{{Route("roles.destroy",$role->id)}}"
                                          method="POST">
                                        <div class="d-flex justify-content-between" role="group">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="delete-button"
                                                    class="btn btn-outline-danger btn-md"><i class="fas fa-trash"></i>Sil
                                            </button>
                                            <a href="{{Route("roles.edit",$role->id)}}"
                                               class="btn btn-outline-primary btn-md"> <i class="fas fa-edit"></i>
                                                Redaktə Et
                                            </a>
                                            <a href="{{Route("roles.permissions",$role->id)}}"
                                               class="btn btn-outline-dark btn-md"> <i class="fas fa-eye"></i> İcazə Ver
                                            </a>
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
