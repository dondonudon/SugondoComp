@extends('dashboard.layout')

@section('page title','WEB Component Image Slider')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg text-right">
                    <button class="btn btn-success" id="btnUpload">Upload Gambar</button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg">

                    <div class="row" id="contentArea">
                        @foreach($info as $i)
                            <div class="col-lg-4">
                                <div class="card">
                                    <img src="{{ url('storage/'.$i->data) }}" class="card-img-top" alt="header" style="width: auto; height: 250px;">
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-block btn-outline-danger" onclick="deleteImage('{{ $i->id }}')">Delete</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/filepond-master/filepond.css') }}">
@endsection

@section('script')
    <script src="{{ asset('vendor/filepond-master/filepond.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const btnUpload = $('#btnUpload');

        function deleteImage(id) {
            // console.log(id);
            Swal.fire({
                title: "Yakin akan menghapus gambar tersebut?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{{ url('admin/web-component/image-slider/delete') }}',
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
            btnUpload.click(function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/image-slider/upload') }}';
            });
        });
    </script>
@endsection
