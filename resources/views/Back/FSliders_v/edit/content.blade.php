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
                        <form method="POST" action="{{Route("sliders.update",$slider->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="from-group col-md-12">
                                    <div class="col">


                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="title">Başlıq:</label>
                                                <input type="text" value="{{$slider->title}}"
                                                       name="title"
                                                       class="form-control" id="title"
                                                       placeholder="Başlıq">
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="description">Açıqlama:</label>
                                                <textarea id="description" name="description" placeholder="Açıqlama">               {{$slider->description}}
                                                </textarea>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="button">Button:</label>
                                            <br>
                                            <label class="toggle">
                                                <input type="checkbox" {{($slider->allowButton)=="on" ? 'checked' : ''}} class="form-control button_usage_btn"
                                                       name="allowButton"/>
                                                <span class="slider"></span>
                                            </label>

                                        </div>

                                        <div class="container button-information-container"
                                             style="display:{{($slider->allowButton)=="on" ? 'block' : 'none'}}">
                                            <div class="form-group">
                                                <label for="button_caption">Button Başlıq:</label>
                                                <input type="text" value="{{$slider->button_caption}}"
                                                       name="button_caption"
                                                       class="form-control" id="button_caption"
                                                       placeholder="Button Üstündəki Yazı">
                                            </div>
                                            <div class="form-group">
                                                <label for="button_url">Url Məlumatı:</label>
                                                <input type="text" value="{{$slider->button_url}}"
                                                       name="button_url"
                                                       class="form-control" id="button_url"
                                                       placeholder="Button Basıldığında gedecek olan ( URL )">
                                            </div>
                                        </div>


                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label for="previewImage">Seçilmiş Şəkli:</label>
                                                        <img id="previewImage"
                                                             alt="Seçilmiş Şəkli"
                                                             src="{{asset($slider->img_url)}}"
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
                                                                           id="fileInput" accept="image/*">
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
                                        <a href="{{Route("sliders.index")}}" type="submit"
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
