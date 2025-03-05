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
                        <form method="POST" action="{{Route("galleries.store")}}">
                            @csrf
                            <div class="card-body">

                                <div class="from-group col-md-12">
                                    <div class="col">


                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="title">Qalerya Adı:</label>
                                                <input type="text" value="{{old('title')}}"
                                                       name="title"
                                                       class="form-control" id="title"
                                                       placeholder="Qalerya Adı">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label>Qalerya Növü:</label>
                                                <select name="gallery_type"
                                                        class="form-control select2bs4">
                                                    <option
                                                        value="image" {{ old('gallery_type', 'image') == 'image' ? 'selected' : '' }}>
                                                        Şəkil
                                                    </option>
                                                    <option
                                                        value="video" {{ old('gallery_type') == 'video' ? 'selected' : '' }}>
                                                        Video
                                                    </option>
                                                    <option
                                                        value="file" {{ old('gallery_type') == 'file'  ? 'selected' : '' }}>
                                                        Fayl
                                                    </option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>


                            <!-- /.card-body -->

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-1">
                                        <button type="submit" class="btn  btn-outline-primary btn-md"><i
                                                class="fa fa-check" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{Route("galleries.index")}}" type="submit"
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
