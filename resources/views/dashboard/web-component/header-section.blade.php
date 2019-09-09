@extends('dashboard.layout')

@section('page title','WEB Component Header Background')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">

                    <div class="card card-primary card-outline">

                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <img src="{{ url('storage/'.$info['image']) }}" class="img-fluid img-thumbnail" alt="header background">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-outline-danger" id="btnEditGambar">
                                        <i class="fas fa-image"></i> Ganti Gambar
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
                window.location.href = '{{ url('admin/web-component/header-background/edit-gambar') }}';
            });
        });
    </script>
@endsection
