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
                    <div class="col-md-9">

                    </div>
                    <div class="col-md-3 ">
                        <a href="{{Route("rate.limited.users")}}" type="button"
                           class="btn btn-block btn-outline-primary btn-sm">
                            <i class="fas fa-user-slash"></i> Bloklanmış İstifadəçilər
                        </a>
                    </div>
                </div>


                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>İstifadəçi Adı</th>
                            <th>Adı Soyadı</th>
                            <th>Poçtu</th>
                            <th>Aktiv</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)

                            <tr>

                                <td class="col-md-3">{{$user->user_name}}</td>
                                <td class="col-md-3">{{$user->full_name}}</td>
                                <td class="col-md-3">{{$user->email}}</td>
                                <td class="col-md-1 text-center">
                                    <label class="toggle">
                                        <input type="checkbox" id="btnToggle"
                                               name="isActive" {{ $user->isActive ? 'checked' : '' }} />
                                        <span class="slider"></span>
                                    </label>
                                </td>

                                <td class="col-md-3">

                                    <a href="{{Route('user.roles',$user->id)}}"
                                       class="btn btn-outline-primary btn-md"> <i class="fas fa-users-cog"></i>
                                        Rol
                                    </a>

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
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
    <!-- /.content -->
</div>
