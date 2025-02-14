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
                        <a href="{{Route("courses.create")}}" type="button"
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
                            <th>Tarix</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody class="sortable">


                        @foreach($courses  as $course)

                            <tr id="ord-{{$course->id}}" data-url="{{route('ajax-courses-rankSetter')}}">

                                <th><i class="fa-solid fa-list-ol"></i></th>

                                <td class="col-md-1">#{{$course->id}}</td>

                                <td class="col-md-2">{{$course->title}}</td>

                                <td class="col-md-2">{{$course->url}}</td>

                                <td class="col-md-2">
                                    {!! $course->description !!}
                                </td>

                                <td class="col-md-2">{{$course->event_date}}</td>

                                <td class="col-md-1">
                                    <div class="image">
                                        <img
                                            src="{{asset($course->img_url)}}"
                                            alt="Course Şəkli"
                                            width="100%" height="100%">
                                    </div>
                                </td>


                                <td class="col-md-1">
                                    <label class="toggle">
                                        <input type="checkbox" class="isActive"
                                               data-url="{{route('ajax.courses-is-active-setter',$course->id)}}"
                                               name="isActive" {{ $course->isActive ? 'checked' : '' }} />
                                        <span class="slider"></span>
                                    </label>
                                </td>

                                <td class="col-md-2">

                                    <div class="d-flex justify-content-between" role="group">
                                        <button type="submit" id="delete-button"
                                                data-url="{{route('courses.destroy',$course->id)}}"
                                                class="btn btn-outline-danger btn-md remove-btn"><i
                                                class="fa fa-trash"></i>
                                        </button>
                                        <a href="{{route('courses.edit',$course->id)}}"
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
