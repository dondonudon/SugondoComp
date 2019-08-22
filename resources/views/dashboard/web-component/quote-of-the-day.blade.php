@extends('dashboard.layout')

@section('page title','WEB Component About Us')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-10"></div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-block btn-warning" id="btnEdit">Edit</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <span class="subheading">Quote of The Day</span>
                            <h2 class="mb-2" id="displayText"></h2>
                        </div>
                    </div>

                    <div id="cardComponent" class="card card-success card-outline d-none">
                        <div class="card-header">
                            <h3 class="card-title">Edit data</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-light" id="btnClose">
                                    <i class="fas fa-times" style="color: red;"></i>
                                </button>
                            </div>
                        </div>
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="section" value="about-us" readonly>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="input">Quote of The Day text</label>
                                        <div id="inputText"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-10"></div>
                                <div class="col-lg-2 mt-2 mt-sm-0">
                                    <button id="btnSimpan" type="button" class="btn btn-block btn-success">Simpan</button>
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

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/filepond-master/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/quill/dist/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/quill/dist/quill.bubble.css') }}">
@endsection

@section('script')
    <script src="{{ asset('vendor/filepond-master/filepond.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/dist/quill.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const editorContainer = document.getElementById('inputText');
        let editor = new Quill(editorContainer, {
            placeholder: 'Ketik disini ...',
            theme: 'snow',
        });

        const displayText = $('#displayText');

        const btnEdit = $('#btnEdit');
        const btnClose = $('#btnClose');
        const btnSimpan = $('#btnSimpan');

        const cardComponent = $('#cardComponent');

        function reloadForm() {
            $.ajax({
                url: '{{ url('admin/web-component/quote-of-the-day/list') }}',
                method: 'post',
                success: function (response) {
                    // console.log(response);
                    editor.root.innerHTML = response;
                }
            })
        }

        function reloadData() {
            $.ajax({
                url: '{{ url('admin/web-component/quote-of-the-day/list') }}',
                method: 'post',
                success: function (response) {
                    // console.log(response);
                    displayText.html(response);
                }
            })
        }

        $(document).ready(function () {
            reloadData();
            btnEdit.click(function (e) {
                e.preventDefault();
                reloadForm();
                cardComponent.removeClass('d-none');
                $('html, body').animate({
                    scrollTop: cardComponent.offset().top
                }, 500);
            });
            btnClose.click(function (e) {
                e.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, 500, function () {
                    reloadData();
                    cardComponent.addClass('d-none');
                });
            });
            btnSimpan.click(function (e) {
                e.preventDefault();
                let data = editor.root.innerHTML;
                // console.log(data);
                $.ajax({
                    url: '{{ url('admin/web-component/quote-of-the-day/save') }}',
                    method: 'post',
                    data: {editor: data},
                    success: function (response) {
                        // console.log(response);

                        if (response === 'success') {
                            reloadData();
                            Swal.fire({
                                title: 'Tersimpan',
                                type: 'success',
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Silahkan coba lagi',
                                type: 'error',
                            });
                        }
                    }
                })
            })


        });
    </script>
@endsection
