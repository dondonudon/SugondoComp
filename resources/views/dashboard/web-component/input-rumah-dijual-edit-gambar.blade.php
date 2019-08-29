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
                                        <label for="iLister">Lister</label>
                                        <input class="form-control" id="iLister" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iNamaRumah">Nama Rumah</label>
                                        <input class="form-control" id="iNamaRumah" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iLokasi">Lokasi</label>
                                        <input class="form-control" id="iLokasi" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iDetail">Detail</label>
                                        <textarea class="form-control" id="iDetail" rows="3" readonly></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="iHarga">Harga</label>
                                        <input class="form-control" id="iHarga" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iLuasTanah">Luas Tanah</label>
                                        <input class="form-control" id="iLuasTanah" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iLuasBangunan">Luas Bangunan</label>
                                        <input class="form-control" id="iLuasBangunan" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iLantai">Lantai</label>
                                        <input class="form-control" id="iLantai" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iKamarTidur">Kamar Tidur</label>
                                        <input class="form-control" id="iKamarTidur" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iKamarMandi">Kamar Mandi</label>
                                        <input class="form-control" id="iKamarMandi" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iDapurBersih">Dapur Bersih</label>
                                        <input class="form-control" id="iDapurBersih" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iDapurKotor">Dapur Kotor</label>
                                        <input class="form-control" id="iDapurKotor" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iTaman">Taman</label>
                                        <input class="form-control" id="iTaman" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iArahRumah">Arah Rumah</label>
                                        <input class="form-control" id="iArahRumah" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iListrik">Listrik</label>
                                        <input class="form-control" id="iListrik" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="iFurniture">Furniture</label>
                                        <input class="form-control" id="iFurniture" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-2">
                                    <a href="{{ url('admin/web-component/input-rumah-dijual') }}" class="btn btn-outline-danger btn-block">Cancel</a>
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
        const iLister = document.getElementById('iLister');
        const iNamaRumah = document.getElementById('iNamaRumah');
        const iLokasi = document.getElementById('iLokasi');
        const iDetail = document.getElementById('iDetail');
        const iHarga = document.getElementById('iHarga');
        const iLuasTanah = document.getElementById('iLuasTanah');
        const iLuasBangunan = document.getElementById('iLuasBangunan');
        const iLantai = document.getElementById('iLantai');
        const iKamarTidur = document.getElementById('iKamarTidur');
        const iKamarMandi = document.getElementById('iKamarMandi');
        const iDapurBersih = document.getElementById('iDapurBersih');
        const iDapurKotor = document.getElementById('iDapurKotor');
        const iTaman = document.getElementById('iTaman');
        const iArahRumah = document.getElementById('iArahRumah');
        const iListrik = document.getElementById('iListrik');
        const iFurniture = document.getElementById('iFurniture');

        iID.value = '{{ $data->id }}';
        iLister.value = '{{ $data->lister }}';
        iNamaRumah.value = '{{ $data->nama_rumah }}';
        iLokasi.value = '{{ $data->lokasi }}';
        iDetail.value = '{{ $data->detail }}';
        iHarga.value = '{{ $data->harga }}';
        iLuasTanah.value = '{{ $data->luas_tanah }}';
        iLuasBangunan.value = '{{ $data->luas_bangunan }}';
        iLantai.value = '{{ $data->lantai }}';
        iKamarTidur.value = '{{ $data->kamar_tidur }}';
        iKamarMandi.value = '{{ $data->kamar_mandi }}';
        iDapurBersih.value = '{{ $data->dapur_bersih }}';
        iDapurKotor.value = '{{ $data->dapur_kotor }}';
        iTaman.value = '{{ $data->taman }}';
        iArahRumah.value = '{{ $data->arah_rumah }}';
        iListrik.value = '{{ $data->listrik }}';
        iFurniture.value = '{{ $data->furniture }}';

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
                    request.open('POST','{{ url('admin/web-component/input-rumah-dijual/submit-edit-gambar') }}');
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
                                        window.location.href = '{{ url('admin/web-component/input-rumah-dijual') }}';
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
