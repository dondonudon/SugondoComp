@extends('dashboard.layout')

@section('page title','WEB Component Product')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-lg">
                    <div class="row justify-content-end">
                        <div class="col-lg-2 mt-2 mt-sm-0">
                            <button class="btn btn-success btn-block" id="btnAdd"><i class="fas fa-plus"></i> Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($info as $i)
                    <div class="col-lg-3">
                        <img src="{{ url('storage/'.$i->gambar) }}" class="card-img-top" alt="...">
                        <div class="card">
                            <div class="card-body bg-gray-light">
                                <div class="row">
                                    <div class="col text-truncate">
                                        <small class="text-muted">JUDUL</small> {{ $i->judul }}
                                    </div>
                                </div>
                            </div>
{{--                            <div class="card-body">COBA</div>--}}
                            <div class="card-footer">
                                <div class="btn-group btn-block" role="group" aria-label="Basic example">
{{--                                    <button type="button" class="btn btn-outline-primary" onclick="editContent('{{ $i->id }}')">Edit</button>--}}
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Edit
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <button class="dropdown-item" onclick="editContent('{{ $i->id }}')">Edit Konten</button>
                                            <button class="dropdown-item" onclick="gantiGambar('{{ $i->id }}')">Ganti Gambar Header</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="viewContent('{{ $i->url }}')">View</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
    <script src="{{ asset('vendor/CKEditor/build/ckeditor.js') }}"></script>
    <script>
        function viewContent(url) {
            window.open('{{ url('produk') }}/'+url,'_blank');
        }

        function editContent(id) {
            window.location.href = '{{ url('admin/web-component/product/edit-content') }}/'+id;
        }

        function gantiGambar(id) {
            window.location.href = '{{ url('admin/web-component/product/ganti-gambar') }}/'+id;
        }

        const btnAdd = document.getElementById('btnAdd');

        document.addEventListener('DOMContentLoaded', function (event) {
            btnAdd.addEventListener('click',function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/product/add') }}';
            })
        })
    </script>
@endsection
