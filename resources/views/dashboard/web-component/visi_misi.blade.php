@extends('dashboard.layout')

@section('page title','WEB Component Visi & Misi')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-sm-12">
                    <div class="card card-danger card-outline">
                        <div class="card-header bg-dark">
                            <h4>Visi Kami</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <img class="img-fluid" src="{{ asset('storage/'.$info['visi']['image']) }}" alt="img">
                                </div>
                                <div class="col-lg">
                                    <p>{{ $info['visi']['text'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <div class="col-lg-2 col-sm-12 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-danger" id="btnVisiEditGambar">
                                        <i class="fas fa-image"></i> Ganti Gambar
                                    </button>
                                </div>
                                <div class="col-lg-2 col-sm-12 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-primary" id="btnVisiEditText">
                                        <i class="fas fa-image"></i> Edit Text
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-sm-12">
                    <div class="card card-danger card-outline">
                        <div class="card-header bg-dark">
                            <h4>Misi Kami</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg">
                                    <ul class="list-group">
                                        @foreach($info['misi'] as $i)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-1">
                                                        <button class="btn btn-sm btn-danger btn-block" onclick="deleteMisi('{{ $i['id'] }}')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg text-bold">
                                                        {{ $i['data'] }}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <div class="col-lg-4 col-sm-12 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-primary" id="btnMisiAdd">
                                        <i class="fas fa-image"></i> Misi Baru
                                    </button>
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const btnVisiEditText = document.getElementById('btnVisiEditText');
        const btnVisiEditGambar = document.getElementById('btnVisiEditGambar');
        const btnMisiAdd = document.getElementById('btnMisiAdd');

        function deleteMisi(id) {
            Swal.fire({
                title: "Yakin akan menghapus misi?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{{ url('admin/web-component/visi-misi/misi/text/delete') }}',
                        method: 'post',
                        data: {id: id},
                        success: function (response) {
                            if (response === 'success') {
                                Swal.fire({
                                    title: 'Terhapus',
                                    type: 'success',
                                    onClose: function () {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                console.log(response);
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Silahkan coba lagi',
                                    type: 'error',
                                });
                            }
                        }
                    });
                }
            });
        }

        $(document).ready(function () {
            /*
            Button Action
             */
            btnVisiEditGambar.addEventListener('click',function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/visi-misi/visi/image') }}';
            });
            btnVisiEditText.addEventListener('click',function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/visi-misi/visi/text') }}';
            });
            btnMisiAdd.addEventListener('click',function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/visi-misi/misi/tambah-baru') }}';
            });
        });
    </script>
@endsection
