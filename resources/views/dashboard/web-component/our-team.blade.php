@extends('dashboard.layout')

@section('page title','WEB Component Our Team')

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
                                    <th width="20%">Image</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-block btn-outline-danger" id="btnHapus" disabled>Hapus</button>
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-dark" id="btnEditGambar" disabled>
                                        <i class="fas fa-image"></i> Edit Gambar
                                    </button>
                                </div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-dark" id="btnEditData" disabled>
                                        <i class="fas fa-pen"></i> Edit Data
                                    </button>
                                </div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-primary" id="btnBaru">Baru</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="cardComponent" class="card card-success card-outline d-none">
                        <div class="card-header">
                            <h3 class="card-title">Tambah data baru</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-light" id="btnClose">
                                    <i class="fas fa-times" style="color: red;"></i>
                                </button>
                            </div>
                        </div>
                        <form id="dataForm">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input id="cardUpload_uploadFile" type="file">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="fullname">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <input type="text" class="form-control" id="jabatan" name="jabatan" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-10"></div>
                                    <div class="col-lg-2 mt-2 mt-sm-0">
                                        <button type="button" class="btn btn-block btn-success" id="btnSimpan">Simpan</button>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
                    formData.append('fullname', $('#fullname').val());
                    formData.append('jabatan', $('#jabatan').val());

                    const request = new XMLHttpRequest();
                    request.open('POST','{{ url('admin/web-component/our-team/submit') }}');
                    request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };

                    request.onload = function () {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                            console.log(request.responseText);
                            tableIndex.ajax.reload();
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
        const uploadArea = document.getElementById('cardUpload_uploadFile');
        const pond = FilePond.create( uploadArea );

        const btnHapus = $('#btnHapus');
        const btnEditData = $('#btnEditData');
        const btnEditGambar = $('#btnEditGambar');
        const btnBaru = $('#btnBaru');
        const btnClose = $('#btnClose');
        const btnSimpan = $('#btnSimpan');

        const cardComponent = $('#cardComponent');

        const iNamaLengkap = document.getElementById('fullname');
        const iJabatan = document.getElementById('jabatan');
        const iID = document.getElementById('idForm');

        let vID, vNamaLengkap, vJabatan;

        function resetForm() {
            pond.removeFiles();
            iNamaLengkap.value = '';
            iJabatan.value = '';
        }

        function setValue(id,fullname,jabatan) {
            editID.value = id;
            editFullname.value = fullname;
            editJabatan.value = jabatan;
        }

        const tableIndex = $('#tableIndex').DataTable({
            "ajax": {
                "method": "POST",
                "url": "{{ url('admin/web-component/our-team/list') }}",
                "header": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
                "complete": function (xhr,responseText) {
                    if (responseText == 'error') {
                        console.log(xhr);
                        console.log(responseText);
                    }
                }
            },
            "columns": [
                {
                    "data": "foto",
                    "render": function(data, type, row) {
                        return '<img src="{{ url('storage') }}/'+data+'" class="img-fluid" alt="image-team">';
                    }
                },
                { "data": "fullname" },
                { "data": "jabatan" },
            ],
        });
        $('#tableIndex tbody').on( 'click', 'tr', function () {
            let data = tableIndex.row( this ).data();
            // console.log(data);
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                btnEditData.attr('disabled','true');
                btnHapus.attr('disabled','true');
                btnEditGambar.attr('disabled','true');
            } else {
                tableIndex.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                btnEditData.removeAttr('disabled');
                btnHapus.removeAttr('disabled');
                btnEditGambar.removeAttr('disabled');

                vID = data.id;
                vNamaLengkap = data.fullname;
                vJabatan = data.jabatan;
            }
        });

        $(document).ready(function () {
            /*
            Button Action
             */
            btnBaru.click(function (e) {
                e.preventDefault();
                // inputType.val('new');
                resetForm();
                cardComponent.removeClass('d-none');
                $('html, body').animate({
                    scrollTop: cardComponent.offset().top
                }, 500);
            });
            btnEditGambar.click(function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/our-team/edit-gambar') }}/'+vID;
            });
            btnEditData.click(function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/our-team/edit') }}/'+vID;
            });
            btnHapus.click(function (e) {
                e.preventDefault();
                Swal.fire({
                    title: vNamaLengkap.value+" akan dihapus",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus Data'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '{{ url('admin/web-component/our-team/delete') }}',
                            method: 'post',
                            data: {id: vID},
                            success: function (response) {
                                console.log(response);
                                if (response === 'success') {
                                    Swal.fire({
                                        title: 'Data terhapus!',
                                        type: 'success',
                                        onClose: function () {
                                            tableIndex.ajax.reload();
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Silahkan coba lagi',
                                        type: 'error',
                                    })
                                }
                            }
                        });
                    }
                });
            });
            btnClose.click(function (e) {
                e.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, 500, function () {
                    resetForm();
                    cardComponent.addClass('d-none');
                    tableIndex.ajax.reload();
                    btnEditData.attr('disabled','true');
                    btnHapus.attr('disabled','true');
                });
            });
            btnSimpan.click(function (e) {
                e.preventDefault();
                pond.processFile().then(file => {
                    console.log('file processed');
                    resetForm();
                });
            });
        });
    </script>
@endsection
