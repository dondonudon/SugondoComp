@extends('dashboard.layout')

@section('page title','WEB Component Our Team - Edit Data')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">

                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <input type="hidden" name="id" id="iID">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="uploadGambar"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="iJudul">Judul</label>
                                        <input class="form-control" id="iJudul" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iShortDesc">Ringkasan Singkat</label>
                                        <textarea class="form-control" id="iShortDesc" rows="3" maxlength="150" readonly></textarea>
                                        <small>Ringkasan aktivitas yang akan ditampilkan pada halaman depan (maksimal 150 karakter)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-2">
                                    <a href="{{ url('admin/web-component/aktivitas-kita') }}" class="btn btn-outline-danger btn-block">Cancel</a>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-success btn-block" id="btnUpload">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/filepond-master/filepond.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/filepond-master/filepond-plugin-image-preview.css') }}">
@endsection

@section('script')
    <script src="{{ asset('vendor/filepond-master/filepond-plugin-image-preview.js') }}"></script>
    <script src="{{ asset('vendor/filepond-master/filepond-plugin-image-crop.js') }}"></script>
    <script src="{{ asset('vendor/filepond-master/filepond-plugin-image-resize.js') }}"></script>
    <script src="{{ asset('vendor/filepond-master/filepond-plugin-image-transform.js') }}"></script>
    <script src="{{ asset('vendor/filepond-master/filepond.min.js') }}"></script>

    <script>
        const headers = {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        };

        const iID = document.getElementById('iID');
        const iJudul = document.getElementById('iJudul');
        const iShortDesc = document.getElementById('iShortDesc');

        iID.value = '{{ $data->id }}';
        iJudul.value = '{{ $data->judul }}';
        iShortDesc.value = '{{ $data->short_desc }}';

        const btnUpload = document.getElementById('btnUpload');

        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginImageCrop,
            FilePondPluginImageTransform,
        );
        FilePond.setOptions({
            allowImageTransform: true,
            allowImageResize: true,
            imageResizeMode: 'cover',
            imageResizeTargetHeight: 700,
            imageResizeTargetWidth: 1200,
            imageTransformOutputMimeType: 'image/jpeg',
            allowImagePreview: true,
            imagePreviewMinHeight: 190,
            imagePreviewMaxHeight: 200,
            allowMultiple: false,
            allowDrop: true,
            instantUpload: false,
            iconProcess: '<svg></svg>',
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort) => {
                    const formData = new FormData();
                    formData.append(fieldName, file, file.name);
                    formData.append('id',iID.value);

                    const request = new XMLHttpRequest();
                    request.open('POST','{{ url('admin/web-component/aktivitas-kita/submit-edit-gambar') }}');
                    request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };

                    request.onload = function () {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                            console.log(request.responseText);
                            if (request.responseText === 'success') {60785
                                Swal.fire({
                                    type: 'success',
                                    title: 'Tersimpan',
                                    onClose: function () {
                                        window.location.href = '{{ url('admin/web-component/aktivitas-kita') }}';
                                    }
                                });
                            }
                        } else {
                            error('gagal');
                            console.log(request.responseText);

                        }
                    };

                    request.send(formData);

                    return {
                        abort: () => {
                            request.abort();

                            abort();
                        }
                    }
                }
            }
        });
        const DOMuploadGambar = document.getElementById('uploadGambar');
        const uploadGambar = FilePond.create( DOMuploadGambar );

        document.addEventListener('DOMContentLoaded', function (event) {
            btnUpload.addEventListener('click',function (e) {
                e.preventDefault();
                uploadGambar.processFile();
            })
        })
    </script>
@endsection
