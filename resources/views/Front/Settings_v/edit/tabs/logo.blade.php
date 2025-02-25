<div class="tab-pane fade" id="custom-content-below-logo" role="tabpanel"
     aria-labelledby="custom-content-below-logo-tab">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            Logo
                        </h3>
                    </div>
                    <div class="card-body">

                        <div class="from-group col-md-12">
                            <div class="row">

                                <div class="form-group col-md-4">
{{--                                    <label for="previewImage">Seçilmiş Şəkli:</label>--}}
                                    <img id="previewImage" alt="Seçilmiş Şəkli"
                                         src="{{asset($setting->logo)}}"
                                         class="img-thumbnail rounded mx-auto d-block"
                                         style="width: 80%;height: 150px; display: none;">
                                </div>

                                <div class="form-group col-md-4">

                                    <div class="form-group">
                                        <label for="exampleInputFile">Logo Seçin:</label>
                                        <div class="input-group">

                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="fileInput"
                                                       accept="image/*">
                                                <label class="custom-file-label" for="fileInput">Logo
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
    </section>
</div>
