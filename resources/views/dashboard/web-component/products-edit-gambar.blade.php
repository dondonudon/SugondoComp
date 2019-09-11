@extends('dashboard.layout')

@section('page title','WEB Component Product')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-lg">
                    <div class="row justify-content-between">
                        <div class="col-lg-2 mt-2 mt-sm-0">
                            <button type="button" class="btn btn-block btn-primary" id="btnBack">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <small class="text-muted">JUDUL</small> <h4>{{ $info->judul }}</h4>
                            <img class="img-fluid" src="{{ url('storage/'.$info->gambar) }}" alt="{{ $info->url }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg">
                                    <label for="uploadGambar">Ganti Gambar</label>
                                    <div id="uploadGambar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-success" id="btnSimpan">Simpan</button>
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
        const formID = '{{ $info->id }}';

        const btnBack = document.getElementById('btnBack');
        const btnSimpan = document.getElementById('btnSimpan');

        const urlMaster = '{{ url('admin/web-component/product') }}';
        const urlSubmit = '{{ url('admin/web-component/product/ganti-gambar/submit') }}';

        document.addEventListener('DOMContentLoaded', function (event) {
            btnBack.addEventListener('click',function (e) {
                e.preventDefault();
                window.location.href = urlMaster;
            });

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
                imageResizeTargetHeight: 900,
                imageResizeTargetWidth: 1920,
                imageTransformOutputMimeType: 'image/jpeg',
                allowImagePreview: true,
                imagePreviewMinHeight: 300,
                imagePreviewMaxHeight: 350,
                allowMultiple: false,
                allowDrop: true,
                instantUpload: false,
                iconProcess: '<svg></svg>',
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort) => {
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name);
                        formData.append('id',formID);

                        const request = new XMLHttpRequest();
                        request.open('POST',urlSubmit);
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
                                            window.location.href = urlMaster;
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
            btnSimpan.addEventListener('click',function (e) {
                e.preventDefault();
                uploadGambar.processFile()
            });
        })
    </script>
@endsection
