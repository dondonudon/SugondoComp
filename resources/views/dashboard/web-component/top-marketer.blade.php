@extends('dashboard.layout')

@section('page title','WEB Component Top Marketer')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">

                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <table class="table table-sm table-bordered display nowrap" id="tableIndex" width="100%">
                                <thead>
                                <tr>
                                    <th>Nama Marketer</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-danger btn-sm" id="btnDelete" disabled>
                                        <i class="fas fa-times"></i> Delete
                                    </button>
                                </div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-success btn-sm" id="btnAdd">
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
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="iMarketer">Alamat</label>
                                            <select id="iMarketer"></select>
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
        const sMarketer = new SlimSelect({
            select: '#iMarketer',
        });

        const iMarketer = document.getElementById('iMarketer');

        let vID;

        const btnTambah = document.getElementById('btnAdd');
        const btnDelete = document.getElementById('btnDelete');
        const btnClose = document.getElementById('btnClose');

        const cardEditor = document.getElementById('cardEditor');
        const formData = document.getElementById('formData');

        const tableIndex = $('#tableIndex').DataTable({
            scrollX: true,
            "columns": [
                { "data": "fullname" },
            ],
        });
        $('#tableIndex tbody').on( 'click', 'tr', function () {
            let data = tableIndex.row( this ).data();
            // console.log(data);
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                btnDelete.setAttribute('disabled', true);
            } else {
                tableIndex.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                btnDelete.removeAttribute('disabled');

                vID = data.id_marketer;
            }
        });

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

        function setSelectMarketer(response) {
            console.log(response);
            let data = JSON.parse(response);
            sMarketer.setData(data);
        }

        function fetchData(functionTarget) {
            kvAjax('{{ url('admin/web-component/top-marketer/list') }}','',functionTarget);
        }

        function deleteData(response) {
            if (response === 'success') {
                fetchData(setDisplayData);
                kvAjax('{{ url('admin/web-component/top-marketer/list-marketer') }}','',setSelectMarketer);

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
                kvAjax('{{ url('admin/web-component/top-marketer/list-marketer') }}','',setSelectMarketer);
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
            kvAjax('{{ url('admin/web-component/top-marketer/list-marketer') }}','',setSelectMarketer);

            btnTambah.addEventListener('click', function (e) {
                e.preventDefault();
                cardEditor.classList.remove('d-none');
                cardEditor.scrollIntoView();
            });

            btnDelete.addEventListener('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Yakin akan menghapus gambar tersebut?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus Data'
                }).then((result) => {
                    if (result.value) {
                        kvAjax('{{ url('admin/web-component/top-marketer/delete') }}','id='+vID,deleteData);
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
                let data = 'id=' + iMarketer.value;

                kvAjax(
                    '{{ url('admin/web-component/top-marketer/add') }}',
                    encodeURI(data),
                    cSubmit
                );
                // console.log(encodeURI(data));
            })
        })
    </script>
@endsection
