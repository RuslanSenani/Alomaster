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
                        <a href="{{Route("galleries.create")}}" type="button"
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
                            <th class="text-center"><i class="fa-solid fa-list-ol"></i></th>
                            <th class="text-center">#id</th>
                            <th class="text-center">Qalerya Adı</th>
                            <th class="text-center">Qalerya Növü</th>
                            <th class="text-center">Qovluq Adı</th>
                            <th class="text-center">Url</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody class="sortable">


                        @foreach($galleries as $gallery)
                            <tr id="ord-{{$gallery->id}}" data-url="{{route('ajax.gallery-rankSetter')}}">
                                <th class="text-center"><i class="fa-solid fa-list-ol"></i></th>
                                <td class="col-md-1 text-center">#{{$gallery->id}}</td>
                                <td class="col-md-2 text-center">{{$gallery->title}}</td>
                                <td class="col-md-1 text-center">{{$gallery->gallery_type}}</td>
                                <td class="col-md-2 text-center">{{$gallery->folder_name}}</td>
                                <td class="col-md-3 text-center">{{$gallery->url}}</td>
                                <td class="col-md-1 text-center">
                                    <label class="toggle">
                                        <input type="checkbox" class="isActive"
                                               data-url="{{route('ajax.gallery-is-active-setter',$gallery->id)}}"
                                               name="isActive" {{ $gallery->isActive ? 'checked' : '' }} />
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td class="col-md-3 text-center">

                                    <div class="d-flex justify-content-between" role="group">
                                        <button type="submit" id="delete-button"
                                                data-url="{{route('galleries.destroy',$gallery->id)}}"
                                                class="btn btn-outline-danger btn-md remove-btn"><i
                                                class="fa fa-trash"></i>
                                        </button>
                                        @php
                                            if($gallery->gallery_type=="image"){
                                                $button_icon = "fa-image";
                                                $button_url = "images.controller";
                                            }
                                            if($gallery->gallery_type=="video"){
                                                $button_icon = "fa-play-circle";
                                                $button_url = "videos.controller";
                                            }
                                            if($gallery->gallery_type=="file"){
                                                $button_icon = "fa-folder";
                                                $button_url = "file.controller";
                                            }

                                            echo  $gallery->button_icon
                                        @endphp

                                        <a href="{{Route('galleries.edit',$gallery->id)}}"
                                           class="btn btn-outline-primary btn-md">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="{{route($gallery->route,$gallery->id)}}"
                                           class="btn btn-outline-primary btn-md">
                                            <i class="fa {{$gallery->icon}}"></i>
                                        </a>
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
