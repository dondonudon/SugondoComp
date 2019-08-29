@extends('dashboard.layout')

@section('page title','WEB Component Rumah Dijual - Edit Data')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">

                    <div class="card card-primary card-outline">
                        <form id="formData">
                            <input type="hidden" name="id" id="iID">
                            <div class="card-body">
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
                                    <textarea class="form-control" id="iDetail" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="iHarga">Harga</label>
                                    <input class="form-control" id="iHarga">
                                </div>

                                <div class="form-group">
                                    <label for="iLuasTanah">Luas Tanah</label>
                                    <input class="form-control" id="iLuasTanah">
                                </div>

                                <div class="form-group">
                                    <label for="iLuasBangunan">Luas Bangunan</label>
                                    <input class="form-control" id="iLuasBangunan">
                                </div>

                                <div class="form-group">
                                    <label for="iLantai">Lantai</label>
                                    <input class="form-control" id="iLantai">
                                </div>

                                <div class="form-group">
                                    <label for="iKamarTidur">Kamar Tidur</label>
                                    <input class="form-control" id="iKamarTidur">
                                </div>

                                <div class="form-group">
                                    <label for="iKamarMandi">Kamar Mandi</label>
                                    <input class="form-control" id="iKamarMandi">
                                </div>

                                <div class="form-group">
                                    <label for="iDapurBersih">Dapur Bersih</label>
                                    <input class="form-control" id="iDapurBersih">
                                </div>

                                <div class="form-group">
                                    <label for="iDapurKotor">Dapur Kotor</label>
                                    <input class="form-control" id="iDapurKotor">
                                </div>

                                <div class="form-group">
                                    <label for="iTaman">Taman</label>
                                    <input class="form-control" id="iTaman">
                                </div>

                                <div class="form-group">
                                    <label for="iArahRumah">Arah Rumah</label>
                                    <input class="form-control" id="iArahRumah">
                                </div>

                                <div class="form-group">
                                    <label for="iListrik">Listrik</label>
                                    <input class="form-control" id="iListrik">
                                </div>

                                <div class="form-group">
                                    <label for="iFurniture">Furniture</label>
                                    <input class="form-control" id="iFurniture">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-2">
                                        <a href="{{ url('admin/web-component/input-rumah-dijual') }}" class="btn btn-outline-danger btn-block">Cancel</a>
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
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

@section('script')
    <script>
        const headers = {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        };

        const sLister = new SlimSelect({
            select: '#iLister',
        });

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

        const formData = document.getElementById('formData');

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

        function cSubmit(response) {
            // console.log(response);
            if (response === 'success') {
                Swal.fire({
                    type: 'success',
                    title: 'Tersimpan',
                    onClose: function () {
                        window.location.href = '{{ url('admin/web-component/input-rumah-dijual') }}';
                    }
                });
            } else {
                console.log(response);
                Swal.fire({
                    type: 'error',
                    title: 'Silahkan coba kembali',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }

        function setSelectLister(response) {
            // console.log(response);
            let data = JSON.parse(response);
            sLister.setData(data);
            iLister.value = '{{ $data->id_lister }}';
        }

        document.addEventListener('DOMContentLoaded', function (event) {
            kvAjax('{{ url('admin/web-component/input-rumah-dijual/lister') }}','',setSelectLister);

            formData.addEventListener('submit', function (e) {
                e.preventDefault();
                let data = 'id=' + iID.value;
                data += '&id_lister=' + iLister.value;
                data += '&nama_rumah=' + iNamaRumah.value;
                data += '&lokasi=' + iLokasi.value;
                data += '&detail=' + iDetail.value;
                data += '&harga=' + iHarga.value;
                data += '&luas_tanah=' + iLuasTanah.value;
                data += '&luas_bangunan=' + iLuasBangunan.value;
                data += '&lantai=' + iLantai.value;
                data += '&kamar_tidur=' + iKamarTidur.value;
                data += '&kamar_mandi=' + iKamarMandi.value;
                data += '&dapur_bersih=' + iDapurBersih.value;
                data += '&dapur_kotor=' + iDapurKotor.value;
                data += '&taman=' + iTaman.value;
                data += '&arah_rumah=' + iArahRumah.value;
                data += '&listrik=' + iListrik.value;
                data += '&furniture=' + iFurniture.value;

                kvAjax(
                    '{{ url('admin/web-component/input-rumah-dijual/submit-edit-data') }}',
                    encodeURI(data),
                    cSubmit
                );
                // console.log(encodeURI(data));
            })
        })
    </script>
@endsection
