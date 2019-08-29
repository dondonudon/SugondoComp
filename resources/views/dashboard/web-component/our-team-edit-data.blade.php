@extends('dashboard.layout')

@section('page title','WEB Component Our Team - Edit Data')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">

                    <div class="card card-primary card-outline">
                        <form id="formData">
                            <div class="card-body">
                                <input type="hidden" id="iID" value="{{ $data->id }}">
                                <div class="form-group">
                                    <label for="iFullname">Nama</label>
                                    <input type="text" class="form-control" id="iFullname" name="fullname" value="{{ $data->fullname }}">
                                </div>
                                <div class="form-group">
                                    <label for="iJabatan">Jabatan</label>
                                    <input type="text" class="form-control" id="iJabatan" name="jabatan" value="{{ $data->jabatan }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-2">
                                        <a href="{{ url('admin/web-component/our-team') }}" class="btn btn-outline-danger btn-block">Cancel</a>
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

        const iID = document.getElementById('iID');
        const iFullname = document.getElementById('iFullname');
        const iJabatan = document.getElementById('iJabatan');

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

        function cSubmit(response) {
            // console.log(response);
            if (response === 'success') {
                Swal.fire({
                    type: 'success',
                    title: 'Tersimpan',
                    onClose: function () {
                        window.location.href = '{{ url('admin/web-component/our-team') }}';
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
                let data = 'id=' + iID.value + '&fullname=' + iFullname.value + '&jabatan=' + iJabatan.value;

                kvAjax(
                    '{{ url('admin/web-component/our-team/submit-edit-data') }}',
                    encodeURI(data),
                    cSubmit
                );
                // console.log(encodeURI(data));
            })
        })
    </script>
@endsection
