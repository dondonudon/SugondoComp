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
                                <div class="col-lg-10">
                                    <dl class="row">
                                        <dt class="col-sm-2">Info Perusahaan</dt>
                                        <dd class="col-sm-9" id="dInfoPerusahaan"></dd>

                                        <dt class="col-sm-2">Alamat</dt>
                                        <dd class="col-sm-9" id="dAlamat"></dd>

                                        <dt class="col-sm-2">No. Telp</dt>
                                        <dd class="col-sm-9" id="dNoTelp"></dd>

                                        <dt class="col-sm-2">e-Mail</dt>
                                        <dd class="col-sm-9" id="dEmail"></dd>
                                    </dl>
                                </div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-warning btn-sm" id="btnEdit">
                                        <i class="fas fa-pen"></i> Edit
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="cardEditor" class="card card-success card-outline d-none">
                        <div class="card-header">
                            <h3 class="card-title">Edit data</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-light" id="btnClose">
                                    <i class="fas fa-times" style="color: red;"></i>
                                </button>
                            </div>
                        </div>

                        <form id="formData">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="iInfoPerusahaan">Info Perusahaan</label>
                                            <input type="text" class="form-control" id="iInfoPerusahaan" name="info_perusahaan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="iAlamat">Alamat</label>
                                            <input type="text" class="form-control" id="iAlamat" name="alamat" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="iNoTelp">No. Telp</label>
                                            <input type="text" class="form-control" id="iNoTelp" name="no_telp" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="iEmail">e-Mail</label>
                                            <input type="text" class="form-control" id="iEmail" name="email" required>
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

@section('script')
    <script>
        const headers = {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        };
        const dInfoPerusahaan = document.getElementById('dInfoPerusahaan');
        const dAlamat = document.getElementById('dAlamat');
        const dNoTelp = document.getElementById('dNoTelp');
        const dEmail = document.getElementById('dEmail');

        const iInfoPerusahaan = document.getElementById('iInfoPerusahaan');
        const iAlamat = document.getElementById('iAlamat');
        const iNoTelp = document.getElementById('iNoTelp');
        const iEmail = document.getElementById('iEmail');

        const btnEdit = document.getElementById('btnEdit');
        const btnClose = document.getElementById('btnClose');

        const cardEditor = document.getElementById('cardEditor');
        const formData = document.getElementById('formData');

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
            dInfoPerusahaan.innerHTML = data['info_perusahaan'];
            dAlamat.innerHTML = data['alamat'];
            dNoTelp.innerHTML = data['no_telp'];
            dEmail.innerHTML = data['email'];
        }

        function setEditData(response) {
            // console.log(response);
            let data = JSON.parse(response);
            iInfoPerusahaan.value = data['info_perusahaan'];
            iAlamat.value = data['alamat'];
            iNoTelp.value = data['no_telp'];
            iEmail.value = data['email'];
        }

        function getData(functionTarget) {
            kvAjax('{{ url('admin/web-component/contact-us/list') }}','',functionTarget);
        }

        function cSubmit(response) {
            // console.log(response);
            if (response === 'success') {
                getData(setDisplayData);
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
            getData(setDisplayData);

            btnEdit.addEventListener('click', function (e) {
                getData(setEditData);

                e.preventDefault();
                cardEditor.classList.remove('d-none');
                cardEditor.scrollIntoView();
            });

            btnClose.addEventListener('click', function (e) {
                e.preventDefault();
                window.scrollTo(0,0);
                cardEditor.classList.add('d-none');
            });

            formData.addEventListener('submit', function (e) {
                e.preventDefault();
                let data = 'info_perusahaan=' + iInfoPerusahaan.value + '&alamat=' + iAlamat.value + '&no_telp=' + iNoTelp.value + '&email=' + iEmail.value;

                kvAjax(
                    '{{ url('admin/web-component/contact-us/submit') }}',
                    encodeURI(data),
                    cSubmit
                );
                // console.log(encodeURI(data));
            })
        })
    </script>
@endsection
