<!-- Content Wrapper. Contains edit content -->
<hr>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header text-center">
                            <h5 class="mb-4">
                                <i class="fas fa-envelope-open-text"></i> Əlaqə Məlumatları
                            </h5>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->


                        <div class="card-body">

                            <div class="from-group col-md-12">
                                <div class="col">
                                    <div class="form-group mb-4 p-4 rounded shadow-sm position-relative"
                                         style="background-color: #f8f9fa; border: 1px solid #dee2e6;">


                                        <div class="d-flex justify-content-end mb-3">

                                            <button id="isReadable"
                                                    data-url="{{route('ajax.is-readable-setter-contacts',$contact->id)}}"
                                                    type="submit"
                                                    {{$contact->isReadable ? 'disabled': ''}}
                                                    class="btn  {{$contact->isReadable ? 'btn-success': 'btn-danger'}} btn-sm">
                                                <i class="fas {{$contact->isReadable ? 'fa-check-circle': 'fa-times-circle'}}"></i>
                                                {{$contact->isReadable ? 'Oxundu': 'Oxunmadı'}}
                                            </button>

                                        </div>


                                        <div class="row mb-2">
                                            <div class="col-sm-3 text-secondary">
                                                <i class="fas fa-network-wired"></i> IP:
                                            </div>
                                            <div class="col-sm-9 text-dark">{{ $contact->ip }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-sm-3 text-secondary">
                                                <i class="fas fa-user"></i> Ad:
                                            </div>
                                            <div class="col-sm-9 text-dark">{{ $contact->name }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-sm-3 text-secondary">
                                                <i class="fas fa-phone"></i> Telefon:
                                            </div>
                                            <div class="col-sm-9 text-dark">{{ $contact->phone }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-sm-3 text-secondary">
                                                <i class="fas fa-envelope"></i> Mail:
                                            </div>
                                            <div class="col-sm-9 text-dark">{{ $contact->email }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-sm-3 text-secondary">
                                                <i class="fas fa-heading"></i> Başlık:
                                            </div>
                                            <div class="col-sm-9 text-dark">{{ $contact->subject }}</div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="text-secondary" for="description"><i
                                                class="fas fa-comment-dots"></i> Mesaj:</label>
                                        <textarea style="width: 100%; height: 200px;" class="form-control"
                                                  disabled>{{ $contact->message }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">

                                <div class="col-md-12">
                                    <a href="{{Route("contacts.index")}}" type="submit"
                                       class="btn  btn-outline-danger btn-block">
                                        <i class="fa fa-arrow-left" aria-hidden="true"> Geri</i>
                                    </a>
                                </div>
                            </div>
                        </div>


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
