@extends('dashboard.layout')

@section('page title','WEB Component Product - Edit')

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
                        <div class="col-lg-2 mt-2 mt-sm-0">
                            <button type="button" class="btn btn-block btn-outline-danger" id="btnDelete">
                                <i class="fas fa-times"></i> Delete Product
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="judul">Judul Product</label>
                                    <textarea class="form-control" id="judul" rows="3" maxlength="50">{{ $info->judul }}</textarea>
                                </div>
                                <div class="col-lg-9">
                                    <label for="editor">Content</label>
                                    <div id="editor"><?php echo $info->content ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-between">
                                <div class="col-lg">
                                    <h5>
                                        <small class="text-muted">URL Product:</small> {{ url('/') }}/product/<span class="text-lowercase" id="contentUrl">{{ $info->url }}</span>
                                    </h5>
                                </div>
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

@section('script')
    <script src="{{ asset('vendor/CKEditor/build/ckeditor.js') }}"></script>
    <script>
        const formID = '{{ $info->id }}';
        const judul = document.getElementById('judul');
        let editor;
        const contentUrl = document.getElementById('contentUrl');

        const btnBack = document.getElementById('btnBack');
        const btnSimpan = document.getElementById('btnSimpan');
        const btnDelete = document.getElementById('btnDelete');
        const btnAdd = document.getElementById('btnAdd');

        const urlMaster = '{{ url('admin/web-component/product') }}';
        const urlSubmit = '{{ url('admin/web-component/product/edit/submit') }}';
        const urlDelete = '{{ url('admin/web-component/product/delete') }}';

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
                        window.location.href = urlMaster;
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

            btnBack.addEventListener('click',function (e) {
                e.preventDefault();
                window.location.href = urlMaster;
            });
            btnSimpan.addEventListener('click',function (e) {
                e.preventDefault();
                console.log(judul.value);
                let data = 'id='+formID
                    +'&judul='+judul.value
                    +'&productContent='+editor.getData()
                    +'&url='+contentUrl.innerHTML;
                kvAjax(urlSubmit,data,serverResponse);
            });

            btnDelete.addEventListener('click',function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Yakin akan menghapus Produk ini?",
                    text: 'Produk akan dihapus dan anda tidak dapat mengembalikan data ini',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus Produk'
                }).then((result) => {
                    if (result.value) {
                        kvAjax(urlDelete,'id='+formID,serverResponse);
                    }
                });
            })
        })
    </script>
@endsection
