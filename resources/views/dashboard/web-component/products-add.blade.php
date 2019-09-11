@extends('dashboard.layout')

@section('page title','WEB Component Product')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg">
                                    <label for="uploadGambar">Gambar Highlight</label>
                                    <div id="uploadGambar"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="judul">Judul Product</label>
                                    <textarea class="form-control" id="judul" rows="3" maxlength="50"></textarea>
                                </div>
                                <div class="col-lg-9">
                                    <label for="editor">Content</label>
                                    <div id="editor"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-between">
                                <div class="col-lg">
                                    <h5>
                                        <small class="text-muted">URL Product:</small> {{ url('/') }}/product/<span class="text-lowercase" id="contentUrl"></span>
                                    </h5>
                                </div>
                                <div class="col-lg-2">
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
    <script src="{{ asset('vendor/CKEditor/build/ckeditor.js') }}"></script>
    <script>
        const judul = document.getElementById('judul');
        let editor;
        const contentUrl = document.getElementById('contentUrl');

        const btnSimpan = document.getElementById('btnSimpan');
        const btnAdd = document.getElementById('btnAdd');

        const urlSubmit = '{{ url('admin/web-component/product/add/submit') }}';

        function kvAjax(url,data,functionTarget) {
            let xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    functionTarget(this.responseText);
                }
            };
            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(data);
        }

        function serverResponse(response) {
            if (response === 'success') {
                Swal.fire({
                    type: 'success',
                    title: 'Tersimpan',
                    onClose: function () {
                        window.location.href = '{{ url('admin/web-component/product') }}';
                    }
                });
            } else {
                console.error(response);
                Swal.fire({
                    type: 'error',
                    title: 'Gagal Tersimpan',
                    text: 'silahkan coba lagi'
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function (event) {
            judul.addEventListener('keyup',function () {
                contentUrl.innerHTML = this.value.replace(' ','-').toLowerCase();
            });
            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(newEditor => {
                    // console.log(newEditor);
                    editor = newEditor;
                })
                .catch( error => {
                    console.error( error );
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
                        formData.append('judul',judul.value);
                        formData.append('url',contentUrl.innerHTML);
                        formData.append('productContent',editor.getData());

                        const request = new XMLHttpRequest();
                        request.open('POST','{{ url('admin/web-component/product/add/submit') }}');
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
                                            window.location.href = '{{ url('admin/web-component/product') }}';
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
                console.log(judul.value);
                uploadGambar.processFile()
            });
        })
    </script>
@endsection
