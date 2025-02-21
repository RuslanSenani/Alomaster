<table class="table table-bordered table-striped image-list-container">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <thead>
    <tr>
        <th><i class="fa-solid fa-list-ol"></i></th>
        <th>#id</th>
        <th>Görüntü</th>
        <th>Fayl Adı</th>
        <th>Status</th>
        <th>Əməliyyatlar</th>
    </tr>
    </thead>
    <tbody class="sortable">
    @foreach($files as $file)
        <tr id="ord-{{$file->id}}" data-url="{{route('ajax.files-rankSetter-file')}}">
            <th><i class="fa-solid fa-list-ol"></i></th>
            <th class="col-md-1">{{$file->id}}</th>
            <th class="col-md-1">
                <img width="50"
                     src="{{asset("assets/dist/img/folder.png")}}"
                     alt="" class="img-responsive">
            </th>
            <th class="col-md-8">{{basename($file->url)}}</th>
            <td class="col-md-1" style="text-align: center">
                <label class="toggle">
                    <input type="checkbox" class="isActive"
                           data-url="{{route('ajax.is-active-setter-files-file',$file->id)}}"
                           name="isActive" {{ $file->isActive ? 'checked' : '' }}/>

                    <span class="slider"></span>
                </label>
            </td>
            <td class="col-md-1" style="text-align: center">
                <button type="submit" id="delete-button"
                        data-url="{{route('files.destroy',$file->id)}}"
                        class="btn btn-outline-danger btn-md remove-btn">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach

    </tbody>


</table>

