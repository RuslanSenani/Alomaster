<!-- Content Wrapper. Contains page content -->

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
                        <form method="POST" action="{{Route("products.store")}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="from-group col-md-12">
                                    <div class="row">


                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="name">Məhsul Adı:</label>
                                                <input type="text" value="{{old('name')}}" name="name"
                                                       class="form-control" id="name"
                                                       placeholder="Məhsul Adı">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="code">Məhsul Kodu:</label>
                                                <input type="text" value="{{old('code')}}" name="code"
                                                       class="form-control" id="code"
                                                       placeholder="Məhsul Kodu">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Məhsul Vahidi:</label>
                                                <select name="unit" class="form-control select2bs4">
                                                    <option value="" selected="selected"> --Vahid Seç--</option>
                                                    @foreach($units as $unit)
                                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="previewImage">Seçilmiş Şəkli:</label>
                                            <img id="previewImage"
                                                 alt="Seçilmiş Şəkli"
                                                 src="{{asset("assets/dist/img/chosePhoto.png")}}"
                                                 class="img-thumbnail rounded mx-auto d-block"
                                                 style="width: 100%;height: 209px; display: none;">
                                        </div>
                                        <div class="form-group col-md-9">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="info">Məhsul Məlumati</label>
                                                        <textarea class="form-control" name="info" rows="8"
                                                                  placeholder="Məhsul Məlumatlarını daxil edin"></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Məhsul Şəkli:</label>
                                                <div class="input-group">

                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input"
                                                               id="fileInput" accept="image/*">
                                                        <label class="custom-file-label" for="fileInput">Şəkil
                                                            Seç</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <button type="submit" class="btn  btn-outline-primary btn-md">Saxla</button>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="{{Route("products.index")}}" type="submit" class="btn  btn-outline-danger btn-md">Ləğv Et</a>
                                        </div>
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