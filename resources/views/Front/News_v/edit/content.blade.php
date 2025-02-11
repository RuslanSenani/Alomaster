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
                        <form method="POST" action="{{Route("news.update",$news->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="from-group col-md-12">
                                    <div class="col">

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="url">Url:</label>
                                                <input type="text" value="{{$news->url}}"
                                                       name="url"
                                                       class="form-control" id="url"
                                                       placeholder="Url">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="title">Başlıq:</label>
                                                <input type="text" value="{{$news->title}}"
                                                       name="title"
                                                       class="form-control" id="title"
                                                       placeholder="Başlıq">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="description">Açıqlama:</label>
                                                <textarea id="description" name="description" placeholder="Açıqlama">               {{$news->description}}
                                                </textarea>

                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label>Xəbər Növü:</label>
                                                <select name="news_type"
                                                        class="form-control select2bs4 news_type_select">
                                                    <option {{$news->news_type=="image"?'selected':''}} value="image"
                                                            selected="selected">Şəkil
                                                    </option>
                                                    <option {{$news->news_type=="video"?'selected':''}} value="video">
                                                        Video
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 video_url_container"
                                             style="display: {{$news->news_type=="video" ? 'block' : 'none'}}">
                                            <div class="form-group">
                                                <label for="video_url">Video Url:</label>
                                                <input type="text" value="{{$news->video_url}}"
                                                       name="video_url"
                                                       class="form-control" id="video_url"
                                                       placeholder="Video Url">
                                            </div>
                                        </div>

                                        <div class="row image_upload_container"
                                             style="display: {{$news->news_type=="image" ? 'block' : 'none'}}">

                                            <div class="form-group col-md-2">
                                                <label for="previewImage">Seçilmiş Şəkli:</label>
                                                <img id="previewImage"
                                                     alt="Seçilmiş Şəkli"
                                                     src="{{asset($news->img_url)}}"
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
                                                                   id="fileInput" >
                                                            <label class="custom-file-label" for="fileInput">Şəkil
                                                                Seç</label>
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
                                        <a href="{{Route("news.index")}}" type="submit"
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
