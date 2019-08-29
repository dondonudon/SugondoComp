@extends('dashboard.layout')

@section('page title','WEB Component Aktivitas Kami - Edit Data')

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
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-2">
                                        <a href="{{ url('admin/web-component/aktivitas-kita') }}" class="btn btn-outline-danger btn-block">Cancel</a>
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

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/quill/dist/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/quill/dist/quill.bubble.css') }}">
@endsection

@section('script')
    <script src="{{ asset('vendor/quill/dist/quill.min.js') }}"></script>

    <script>
        const headers = {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        };

        const iID = document.getElementById('iID');
        const iJudul = document.getElementById('iJudul');
        const iShortDesc = document.getElementById('iShortDesc');
        const iKonten = document.getElementById('iKonten');
        let editor = new Quill(iKonten, {
            placeholder: 'Ketik disini ...',
            theme: 'snow',
        });

        iID.value = '{{ $data->id }}';
        iJudul.value = '{{ $data->judul }}';
        iShortDesc.value = '{{ $data->short_desc }}';
        editor.root.innerHTML = '<?php echo $data->content ?>';

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
                        window.location.href = '{{ url('admin/web-component/aktivitas-kita') }}';
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

        document.addEventListener('DOMContentLoaded', function (event) {
            formData.addEventListener('submit', function (e) {
                e.preventDefault();
                let data = 'id=' + iID.value + '&judul=' + iJudul.value + '&short_desc=' + iShortDesc.value + '&konten=' + editor.root.innerHTML;

                kvAjax(
                    '{{ url('admin/web-component/aktivitas-kita/submit-edit-data') }}',
                    encodeURI(data),
                    cSubmit
                );
                // console.log(encodeURI(data));
            })
        })
    </script>
@endsection
