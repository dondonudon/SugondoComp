@extends('dashboard.layout')

@section('page title','WEB Component Aktivitas Kami')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">

                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <table class="table table-sm table-bordered display nowrap" id="tableIndex" width="100%">
                                <thead class="bg-dark">
                                <tr>
                                    <th>Judul</th>
                                    <th>Image</th>
                                    <th>Content</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-block btn-outline-danger btn-sm" id="btnTerjual" disabled>
                                        <i class="fas fa-times"></i> Hide
                                    </button>
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-dark btn-sm" id="btnEditGambar" disabled>
                                        <i class="fas fa-image"></i> Edit Gambar
                                    </button>
                                </div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-dark btn-sm" id="btnEditData" disabled>
                                        <i class="fas fa-pen"></i> Edit Data
                                    </button>
                                </div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd">
                                        <i class="fas fa-plus"></i> Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="cardEditor" class="card card-success card-outline d-none">

                        <div class="card-header">
                            <h3 class="card-title">Tambah Data</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-light" id="btnClose">
                                    <i class="fas fa-times" style="color: red;"></i>
                                </button>
                            </div>
                        </div>

                        <form id="formData">
                            <input type="hidden" id="iType" value="new">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div id="iGambar"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="iJudul">Judul</label>
                                            <input class="form-control" id="iJudul">
                                        </div>

                                        <div class="form-group">
                                            <label for="iShortDesc">Ringkasan Singkat</label>
                                            <input class="form-control" id="iShortDesc" maxlength="150">
                                            <small>Ringkasan aktivitas yang akan ditampilkan pada halaman depan (maksimal 150 karakter)</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="iKonten">Konten</label>
                                            <div id="iKonten"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-10"></div>
                                    <div class="col-lg-2 mt-2 mt-sm-0">
                                        <button type="submit" class="btn btn-block btn-success">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/quill/dist/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/quill/dist/quill.bubble.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/filepond-master/filepond.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/filepond-master/filepond-plugin-image-preview.css') }}">
@endsection

@section('script')
    <script src="{{ asset('vendor/quill/dist/quill.min.js') }}"></script>

    <script src="{{ asset('vendor/filepond-master/filepond-plugin-image-preview.js') }}"></script>
    <script src="{{ asset('vendor/filepond-master/filepond-plugin-image-crop.js') }}"></script>
    <script src="{{ asset('vendor/filepond-master/filepond-plugin-image-resize.js') }}"></script>
    <script src="{{ asset('vendor/filepond-master/filepond-plugin-image-transform.js') }}"></script>
    <script src="{{ asset('vendor/filepond-master/filepond.min.js') }}"></script>

    <script>
        const iType = document.getElementById('iType');
        const iJudul = document.getElementById('iJudul');
        const iShortDesc = document.getElementById('iShortDesc');
        const iKonten = document.getElementById('iKonten');
        let editor = new Quill(iKonten, {
            placeholder: 'Ketik disini ...',
            theme: 'snow',
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
                    formData.append('judul', iJudul.value);
                    formData.append('short_desc', iShortDesc.value);
                    formData.append('konten', editor.root.innerHTML);

                    const request = new XMLHttpRequest();
                    request.open('POST','{{ url('admin/web-component/aktivitas-kita/add') }}');
                    request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };

                    request.onload = function () {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                            console.log(request.responseText);
                            fetchData(setDisplayData);
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
        const uploadArea = document.getElementById('iGambar');
        const pond = FilePond.create( uploadArea );

        let vID;

        const btnTambah = document.getElementById('btnAdd');
        const btnTerjual = document.getElementById('btnTerjual');
        const btnClose = document.getElementById('btnClose');
        const btnEditData = document.getElementById('btnEditData');
        const btnEditGambar = document.getElementById('btnEditGambar');

        const cardEditor = document.getElementById('cardEditor');
        const formData = document.getElementById('formData');

        const tableIndex = $('#tableIndex').DataTable({
            scrollX: true,
            "columns": [
                { "data": "judul" },
                { "data": "image" },
                { "data": "content" },
                { "data": "username" },
                { "data": "status" },
            ],
        });
        $('#tableIndex tbody').on( 'click', 'tr', function () {
            let data = tableIndex.row( this ).data();
            // console.log(data);
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                btnTerjual.setAttribute('disabled', true);
                btnEditGambar.setAttribute('disabled', true);
                btnEditData.setAttribute('disabled', true);
            } else {
                tableIndex.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                btnTerjual.removeAttribute('disabled');
                btnEditGambar.removeAttribute('disabled');
                btnEditData.removeAttribute('disabled');

                vID = data.id;
            }
        });

        function resetForm() {
            pond.removeFiles();
            iType.value = 'new';
            iJudul.value = '';
            iShortDesc.value = '';
            editor.setText('');
        }

        function serialize(data) {
            let result = '';
            for (let index in data) {
                result += index + '=' + data[index] + '&';
            }
            return result;
        }

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

        function setDisplayData(response) {
            // console.log(response);
            let data = JSON.parse(response);
            tableIndex.clear().draw();
            tableIndex.rows.add(data).draw();
        }

        function setSelectLister(response) {
            // console.log(response);
            let data = JSON.parse(response);
            // sLister.setData(data);
        }

        function fetchData(functionTarget) {
            kvAjax('{{ url('admin/web-component/aktivitas-kita/list') }}','',functionTarget);
        }

        function rumahTerjual(response) {
            if (response === 'success') {
                fetchData(setDisplayData);

                Swal.fire({
                    type: 'success',
                    title: 'Tersimpan',
                    showConfirmButton: false,
                    timer: 2000
                })
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Silahkan coba kembali',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }

        function cSubmit(response) {
            // console.log(response);
            if (response === 'success') {
                fetchData(setDisplayData);
                Swal.fire({
                    type: 'success',
                    title: 'Tersimpan',
                    showConfirmButton: false,
                    timer: 2000
                })
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Silahkan coba kembali',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }

        document.addEventListener('DOMContentLoaded', function (event) {
            fetchData(setDisplayData);

            btnTambah.addEventListener('click', function (e) {
                e.preventDefault();
                cardEditor.classList.remove('d-none');
                cardEditor.scrollIntoView();
            });

            btnEditData.addEventListener('click',function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/aktivitas-kita/edit-data') }}/'+vID;
            });

            btnEditGambar.addEventListener('click',function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/aktivitas-kita/edit-gambar') }}/'+vID;
            });

            btnTerjual.addEventListener('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Rumah ini telah terjual?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Rumah Terjual'
                }).then((result) => {
                    if (result.value) {
                        kvAjax('{{ url('admin/web-component/input-rumah-dijual/terjual') }}','id='+vID,rumahTerjual);
                    }
                });
            });

            btnClose.addEventListener('click', function (e) {
                e.preventDefault();
                window.scrollTo(0,0);
                cardEditor.classList.add('d-none');
            });

            formData.addEventListener('submit', function (e) {
                e.preventDefault();

                pond.processFile().then(file => {
                    console.log('file processed');
                    resetForm();
                });
            })
        })
    </script>
@endsection
