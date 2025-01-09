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

                        <form method="POST" action="{{Route("users.update",$user->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="from-group col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="userName">İstifadəçi Adı:</label>
                                                <input type="text" value="{{$user->user_name}}" name="userName"
                                                       class="form-control" id="userName"
                                                       placeholder="İstifadəçi Adı">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="from-group col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="fullName">Ad Soyad:</label>
                                                <input type="text" value="{{$user->full_name}}" name="fullName"
                                                       class="form-control" id="fullName"
                                                       placeholder="Ad Soyad">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="from-group col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="userEmail">Ad Soyad:</label>
                                                <input type="text" value="{{$user->email}}" name="userEmail"
                                                       class="form-control" id="userEmail"
                                                       placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-header bg-primary text-white">
                                            Profil Şəkili
                                        </div>
                                        <div class="card-body">
                                            <img id="previewImage"
                                                 alt="Seçilmiş Şəkil"
                                                 src="{{ $user->user_image ? asset($user->user_image) : asset('assets/dist/img/profilPicture.jpeg') }}"
                                                 class="img-thumbnail"
                                                 style="width: 150px; height: 150px; border: 2px dashed #007bff;">
                                            <p class="mt-2 text-muted">Şəkil seçmək üçün aşağıdan faylı yükləyin.</p>
                                        </div>
                                        <div class="card-footer">
                                            <label class="btn btn-primary btn-sm">
                                                Şəkil Seç <input type="file" name="image" class="d-none" id="fileInput" accept="image/*">
                                            </label>
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
                                            <a href="{{url()->previous()}}" type="submit"
                                               class="btn  btn-outline-danger btn-md">Ləğv Et</a>
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
