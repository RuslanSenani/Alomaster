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
                        <a href="{{Route("news.create")}}" type="button"
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
                            <th><i class="fa-solid fa-list-ol"></i></th>
                            <th>#id</th>
                            <th>Başlıq</th>
                            <th>Url</th>
                            <th>Açıqlama</th>
                            <th>Xəbər Növü</th>
                            <th>Vizual</th>
                            <th>Status</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody class="sortable">


                        @foreach($news as $new)
                            <tr id="ord-{{$new->id}}" data-url="{{route('ajax-rankSetter')}}">
                                <th><i class="fa-solid fa-list-ol"></i></th>
                                <td class="col-md-1">#{{$new->id}}</td>
                                <td class="col-md-2">{{$new->title}}</td>
                                <td class="col-md-2">{{$new->url}}</td>
                                <td class="col-md-3">{{$new->description}}</td>
                                <td class="col-md-3">{{$new->news_type}}</td>
                                <td class="col-md-3">Goruntu olacaq</td>
                                <td class="col-md-1">
                                    <label class="toggle">
                                        <input type="checkbox" class="isActive"
                                               data-url="{{route('ajax.is-active-setter',$new->id)}}"
                                               name="isActive" {{ $new->isActive ? 'checked' : '' }} />
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td class="col-md-2">

                                    <div class="d-flex justify-content-between" role="group">
                                        <button type="submit" id="delete-button"
                                                data-url="{{route('product.destroy',$new->id)}}"
                                                class="btn btn-outline-danger btn-md remove-btn"><i
                                                class="fa fa-trash"></i>
                                        </button>
                                        <a href="{{Route('product.edit',$new->id)}}"
                                           class="btn btn-outline-primary btn-md"> <i class="fa fa-edit"></i> </a>
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
