@extends('dashboard.layout')

@section('page title','WEB Component About Us')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">

                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="#" class="img-fluid" alt="about-us" id="image_about">
                                </div>
                                <div class="col-md-6">
                                    <div class="heading-section p-md-5" id="sectionText"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-10"></div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-warning" id="btnEdit">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="cardComponent" class="card card-success card-outline d-none">
                        <div class="card-header">
                            <h3 class="card-title">Edit data</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-light" id="btnClose">
                                    <i class="fas fa-times" style="color: red;"></i>
                                </button>
                            </div>
                        </div>
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="section" value="about-us" readonly>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="cardUpload_uploadFile">Upload new photo</label>
                                        <input id="cardUpload_uploadFile" type="file">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="input">About us text</label>
                                            <div id="inputAbout"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-10"></div>
                                    <div class="col-lg-2 mt-2 mt-sm-0">
                                        <button id="btnSimpan" type="button" class="btn btn-block btn-success">Simpan</button>
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
    <link rel="stylesheet" href="{{ asset('vendor/quill/dist/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/quill/dist/quill.bubble.css') }}">
@endsection

@section('script')
    <script src="{{ asset('vendor/filepond-master/filepond.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/dist/quill.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const imageAbout = document.getElementById('image_about');
        const uploadArea = document.getElementById('cardUpload_uploadFile');
        const editorContainer = document.getElementById('inputAbout');
        let editor = new Quill(editorContainer, {
            placeholder: 'Ketik disini ...',
            theme: 'snow',
        });

        const sectionText = $('#sectionText');

        const btnEdit = $('#btnEdit');
        const btnClose = $('#btnClose');
        const btnSimpan = $('#btnSimpan');

        const cardComponent = $('#cardComponent');

        function reloadForm() {
            $.ajax({
                url: '{{ url('admin/web-component/about-us/editor') }}',
                method: 'post',
                success: function (response) {
                    // console.log(response);
                    editor.root.innerHTML = response;
                }
            })
        }

        function reloadData() {
            let result = '<h2 class="mb-4">About us</h2>';
            $.ajax({
                url: '{{ url('admin/web-component/about-us/list') }}',
                method: 'post',
                success: function (response) {
                    // console.log(response);
                    let data = JSON.parse(response);
                    sectionText.html(result+data.text);
                    imageAbout.src = data.image;
                }
            })
        }

        $(document).ready(function () {
            reloadData();

            FilePond.create( uploadArea );
            FilePond.setOptions({
                allowImageTransform: true,
                allowImageResize: true,
                imageResizeMode: 'cover',
                imageResizeTargetHeight: 700,
                imageResizeTargetWidth: 1200,
                imageTransformOutputMimeType: 'image/jpeg',
                allowMultiple: false,
                allowDrop: true,
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort) => {
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name);

                        const request = new XMLHttpRequest();
                        request.open('POST','{{ url('admin/web-component/about-us/upload') }}');
                        request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

                        request.upload.onprogress = (e) => {
                            progress(e.lengthComputable, e.loaded, e.total);
                        };

                        request.onload = function () {
                            if (request.status >= 200 && request.status < 300) {
                                load(request.responseText);
                                console.log(request.responseText);
                            } else {
                                error('gagal');
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

            btnEdit.click(function (e) {
                e.preventDefault();
                reloadForm();
                cardComponent.removeClass('d-none');
                $('html, body').animate({
                    scrollTop: cardComponent.offset().top
                }, 500);
            });
            btnClose.click(function (e) {
                e.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, 500, function () {
                    reloadData();
                    cardComponent.addClass('d-none');
                });
            });
            btnSimpan.click(function (e) {
                e.preventDefault();
                let data = editor.root.innerHTML;
                // console.log(data);
                $.ajax({
                    url: '{{ url('admin/web-component/about-us/save') }}',
                    method: 'post',
                    data: {editor: data},
                    success: function (response) {
                        // console.log(response);

                        if (response === 'success') {
                            reloadData();
                            Swal.fire({
                                title: 'Tersimpan',
                                type: 'success',
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Silahkan coba lagi',
                                type: 'error',
                            });
                        }
                    }
                })
            })


        });
    </script>
@endsection
