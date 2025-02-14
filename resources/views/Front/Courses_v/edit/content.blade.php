<!-- Content Wrapper. Contains edit content -->
<hr>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">

                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{Route("courses.update",$course->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="from-group col-md-12">
                                    <div class="col">

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="title">Başlıq:</label>
                                                <input type="text" value="{{$course->title}}"
                                                       name="title"
                                                       class="form-control" id="title"
                                                       placeholder="Başlıq">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="url">Url:</label>
                                                <input type="text" value="{{$course->url}}"
                                                       name="url"
                                                       class="form-control" id="url"
                                                       placeholder="Url">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="description">Açıqlama:</label>
                                                <textarea id="description" name="description" placeholder="Açıqlama">               {{$course->description}}
                                                </textarea>

                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label for="previewImage">Seçilmiş Şəkli:</label>
                                                        <img id="previewImage"
                                                             alt="Seçilmiş Şəkli"
                                                             src="{{asset($course->img_url)}}"
                                                             class="img-thumbnail rounded mx-auto d-block"
                                                             style="width: 150px;height: 150px; display: none;">
                                                    </div>

                                                    <div class="form-group col-md-9">
                                                        <div class="form-group">
                                                            <label for="exampleInputFile">Məhsul Şəkli:</label>
                                                            <div class="input-group">

                                                                <div class="custom-file">
                                                                    <input type="file" name="image"
                                                                           class="custom-file-input"
                                                                           id="fileInput">
                                                                    <label class="custom-file-label" for="fileInput">Şəkil
                                                                        Seç</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group col-md-12">
                                                    <label>Hadisə Tarixi: </label>
                                                    <div class="input-group date" id="reservationdate"
                                                         data-target-input="nearest">
                                                        <input name="event_date" type="text"
                                                               value="{{\Carbon\Carbon::parse($course->event_date)->format('m/d/Y')}}"
                                                               class="form-control datetimepicker-input"
                                                               data-target="#reservationdate"/>
                                                        <div class="input-group-append" data-target="#reservationdate"
                                                             data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-1">
                                        <button type="submit" class="btn  btn-outline-primary btn-md"><i
                                                class="fa fa-check" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{Route("courses.index")}}" type="submit"
                                           class="btn  btn-outline-danger btn-md"><i class="fa fa-window-close"
                                                                                     aria-hidden="true"></i>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
