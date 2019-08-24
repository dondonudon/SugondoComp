@extends('dashboard.layout')

@section('page title','WEB Component Rumah Dijual')

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
                                    <th>Lister</th>
                                    <th>Nama Rumah</th>
                                    <th>Lokasi</th>
                                    <th>Detail</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-success btn-sm" id="btnTerjual" disabled>
                                        <i class="fas fa-check"></i> Terjual
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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div id="iGambar"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="iLister">Lister</label>
                                            <select id="iLister"></select>
                                        </div>

                                        <div class="form-group">
                                            <label for="iNamaRumah">Nama Rumah</label>
                                            <input class="form-control" id="iNamaRumah">
                                        </div>

                                        <div class="form-group">
                                            <label for="iLokasi">Lokasi</label>
                                            <input class="form-control" id="iLokasi">
                                        </div>

                                        <div class="form-group">
                                            <label for="iDetail">Detail</label>
                                            <textarea class="form-control" id="iDetail" rows="5"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="iHarga">Harga</label>
                                            <input class="form-control" id="iHarga">
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
        const iLister = document.getElementById('iLister');
        const iNamaRumah = document.getElementById('iNamaRumah');
        const iLokasi = document.getElementById('iLokasi');
        const iDetail = document.getElementById('iDetail');
        const iHarga = document.getElementById('iHarga');

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
                    formData.append('id_lister', iLister.value);
                    formData.append('nama_rumah', iNamaRumah.value);
                    formData.append('lokasi', iLokasi.value);
                    formData.append('detail', iDetail.value);
                    formData.append('harga', iHarga.value);

                    const request = new XMLHttpRequest();
                    request.open('POST','{{ url('admin/web-component/input-rumah-dijual/add') }}');
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

        const sLister = new SlimSelect({
            select: '#iLister',
        });

        let vID;

        const btnTambah = document.getElementById('btnAdd');
        const btnTerjual = document.getElementById('btnTerjual');
        const btnClose = document.getElementById('btnClose');

        const cardEditor = document.getElementById('cardEditor');
        const formData = document.getElementById('formData');

        const tableIndex = $('#tableIndex').DataTable({
            scrollX: true,
            "columns": [
                { "data": "lister" },
                { "data": "nama_rumah" },
                { "data": "lokasi" },
                { "data": "detail" },
                { "data": "harga" },
                { "data": "gambar" },
            ],
        });
        $('#tableIndex tbody').on( 'click', 'tr', function () {
            let data = tableIndex.row( this ).data();
            // console.log(data);
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                btnTerjual.setAttribute('disabled', true);
            } else {
                tableIndex.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                btnTerjual.removeAttribute('disabled');

                vID = data.id;
            }
        });

        function resetForm() {
            pond.removeFiles();
            iNamaRumah.value = '';
            iLokasi.value = '';
            iDetail.value = '';
            iHarga.value = '';
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
            sLister.setData(data);
        }

        function fetchData(functionTarget) {
            kvAjax('{{ url('admin/web-component/input-rumah-dijual/list') }}','',functionTarget);
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
                kvAjax('{{ url('admin/web-component/favorite-marketer/list-marketer') }}','',setSelectLister);
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
            kvAjax('{{ url('admin/web-component/input-rumah-dijual/lister') }}','',setSelectLister);

            btnTambah.addEventListener('click', function (e) {
                e.preventDefault();
                cardEditor.classList.remove('d-none');
                cardEditor.scrollIntoView();
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

                // let data = 'id_lister=' + iLister.value + '&nama_rumah=';

                {{--kvAjax(--}}
                {{--    '{{ url('admin/web-component/input-rumah-dijual/add') }}',--}}
                {{--    encodeURI(data),--}}
                {{--    cSubmit--}}
                {{--);--}}
                // console.log(encodeURI(data));
            })
        })
    </script>
@endsection
