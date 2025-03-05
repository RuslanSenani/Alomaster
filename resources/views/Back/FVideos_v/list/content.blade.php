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
                        <a href="{{Route("galleries.videos.create",$gallery)}}" type="button"
                           class="btn btn-block btn-outline-primary btn-sm">
                            <i class="fa fa-plus"></i>Əlavə Et
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
                            <th>Görüntü</th>
                            <th>Url</th>
                            <th>Status</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody class="sortable">
                        @foreach($videos as $video)
                            <tr id="ord-{{$video->id}}" data-url="{{route('ajax.rankSetter-videos')}}">
                                <th><i class="fa-solid fa-list-ol"></i></th>
                                <th class="col-md-1">{{$video->id}}</th>
                                <th class="col-md-1">
                                    <div>
                                        <iframe width="150px" height="150px"
                                                src="{{$video->url}}"
                                                title="Video player"
                                                allow="encrypted-media;"
                                                frameborder="0"
                                                allowfullscreen>
                                        </iframe>
                                    </div>
                                </th>
                                <th class="col-md-8">{{$video->url}}</th>
                                <td class="col-md-1" style="text-align: center">
                                    <label class="toggle">
                                        <input type="checkbox" class="isActive"
                                               data-url="{{route('ajax.is-active-setter-videos',$video->id)}}"
                                               name="isActive" {{ $video->isActive ? 'checked' : '' }}/>

                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td class="col-md-1" style="text-align: center">
                                    <button type="submit" id="delete-button"
                                            data-url="{{route('galleries.videos.destroy',[$gallery,$video])}}"
                                            class="btn btn-outline-danger btn-md remove-btn">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <a href="{{Route('galleries.videos.edit',[$gallery,$video])}}"
                                       class="btn btn-outline-primary btn-md"> <i class="fa fa-edit"></i> </a>
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
