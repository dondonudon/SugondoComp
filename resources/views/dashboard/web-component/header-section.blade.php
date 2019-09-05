@extends('dashboard.layout')

@section('page title','WEB Component Header Section')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">

                    <div class="card card-primary card-outline">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="{{ url('storage/'.$info['image']) }}" class="img-fluid">
                                </div>
                                <div class="col-lg">
                                    <dl class="row">
                                        <dt class="col-sm-3">Tagline</dt>
                                        <dd class="col-sm-9">{{ $info['tagline'] }}</dd>

                                        <dt class="col-sm-3">Deskripsi Singkat</dt>
                                        <dd class="col-sm-9">{{ $info['deskripsi-singkat'] }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-dark" id="btnEditGambar">
                                        <i class="fas fa-image"></i> Edit Gambar
                                    </button>
                                </div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-dark" id="btnEditData">
                                        <i class="fas fa-pen"></i> Edit Data
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

        const btnEditData = $('#btnEditData');
        const btnEditGambar = $('#btnEditGambar');

        $(document).ready(function () {
            /*
            Button Action
             */
            btnEditGambar.click(function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/header-image/edit-gambar') }}';
            });
            btnEditData.click(function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/header-image/edit-data') }}';
            });
        });
    </script>
@endsection
