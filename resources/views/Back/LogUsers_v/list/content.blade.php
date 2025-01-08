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


                <!-- /.card-header -->
                <div class="card-body">
                    @if(count($rateLimitedUsers) > 0)
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ad</th>
                                <th>Email</th>
                                <th>Gözləmə Vaxtı (Saniyə)</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rateLimitedUsers as $rateLimitedUser)

                                <tr>
                                    <td class="col-md-1">{{$rateLimitedUser['user']->id}}</td>
                                    <td class="col-md-3">{{$rateLimitedUser['user']->full_name}}</td>
                                    <td class="col-md-3">{{$rateLimitedUser['user']->email}}</td>
                                    <td class="col-md-3">{{$rateLimitedUser['waitTime']}} (Saniyə)</td>
                                    <td class="col-md-2">

                                        <form id="delete-form" action="{{Route("rate.clear.users")}}"
                                              method="POST">
                                            <div class="d-flex justify-content-between" role="group">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $rateLimitedUser['user']->id }}">

                                                <button type="submit" id="delete-button"
                                                        class="btn btn-outline-success btn-md">Aktivlesdir
                                                </button>
                                            </div>
                                        </form>

                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>

                        </table>
                    @else
                        <p>Vaxt Limitinə Düşən İstifadəçi Yoxdur.</p>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
