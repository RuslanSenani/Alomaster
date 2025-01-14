<!-- Content Wrapper. Contains edit content -->
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


                        <form method="POST" action="{{Route('user.update.roles',$user->id)}}">
                            @csrf
                            <div class="form-group">
                                <div class="row ml-5">

                                    @foreach($roles as $role)
                                        <div class="col-md-3">
                                            <div class="form-check form-check-inline">

                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="roles[]"
                                                    id="role-{{ $role->id }}"
                                                    value="{{ $role->name }}"
                                                    {{ $user->hasRole($role->name) ? 'checked' : '' }}
                                                >
                                                <label
                                                    class="form-check-label"
                                                    for="role-{{ $role->id }}">
                                                    {{ ucfirst($role->name) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-success btn-md">
                                            <i class="fas fa-save"></i> Saxla
                                        </button>
                                        <a href="{{Route('users.index')}}" class="btn btn-secondary btn-md">
                                            <i class="fas fa-arrow-left"></i> Geri
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
