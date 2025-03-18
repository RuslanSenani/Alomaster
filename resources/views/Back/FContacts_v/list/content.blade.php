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
                        <a href="{{Route("contacts.create")}}" type="button"
                           class="btn btn-block btn-outline-primary btn-sm">
                            <i class="fa fa-plus"></i> Giriş Et
                        </a>
                    </div>
                </div>


                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <thead>
                        <tr>
                            <th>#id</th>
                            <th>IP</th>
                            <th>Ad</th>
                            <th>Telefon</th>
                            <th>Mail</th>
                            <th>Başlıq</th>
                            <th>Mesaj</th>
                            <th>Oxundu</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($contacts  as $contact)

                            <tr>

                                <td class="col-md-1">#{{$contact->id}}</td>

                                <td class="col-md-2">{{$contact->ip}}</td>

                                <td class="col-md-2">{{$contact->name}}</td>

                                <td class="col-md-2">{{$contact->phone}}</td>

                                <td class="col-md-2">{{$contact->email}}</td>

                                <td class="col-md-2">{{$contact->subject}}</td>

                                <td class="col-md-4">{{ \Illuminate\Support\Str::limit($contact->message,30,'....')}}</td>




                                <td class="col-md-1">
                                    <label class="toggle">
                                        <input disabled type="checkbox" class="isActive"
                                               name="isActive" {{ $contact->isReadable ? 'checked' : '' }} />
                                        <span class="slider"></span>
                                    </label>
                                </td>

                                <td class="col-md-1 text-center">

                                    <div class="d-flex justify-content-between text-center" role="group">
                                        <a href="{{route('contacts.show',$contact->id)}}"
                                           class="btn btn-outline-primary btn-md"> <i class="fa fa-eye"></i> </a>
                                    </div>


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
