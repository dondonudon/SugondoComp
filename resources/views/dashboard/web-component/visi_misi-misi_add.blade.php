@extends('dashboard.layout')

@section('page title','WEB Component Visi & Misi - Edit Visi Text')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">

                    <div class="card card-primary card-outline">

                        <form id="formData">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="visiKami">Misi Kami</label>
                                            <textarea class="form-control" id="visiKami" name="misi" rows="3" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-2 mt-2 mt-sm-0">
                                        <button type="button" class="btn btn-block btn-outline-danger" id="btnCancel">Cancel</button>
                                    </div>
                                    <div class="col-lg-2 mt-2 mt-sm-0">
                                        <button type="submit" class="btn btn-block btn-success" id="btnEditData">Tambah</button>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const btnSimpan = document.getElementById('btnEditData');
        const btnCancel = document.getElementById('btnCancel');

        const formData = document.getElementById('formData');

        $(document).ready(function () {
            /*
            Button Action
             */
            btnCancel.addEventListener('click',function (e) {
                e.preventDefault();
                window.location.href = '{{ url('admin/web-component/visi-misi') }}';
            });
            formData.addEventListener('submit',function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url('admin/web-component/visi-misi/misi/text/submit') }}',
                    method: 'post',
                    data: $(this).serialize(),
                    success: function (response) {
                        console.log(response);
                        if (response === 'success') {
                            Swal.fire({
                                title: 'Data Tersimpan',
                                type: 'success',
                                onClose: function () {
                                    window.location.href = '{{ url('admin/web-component/visi-misi') }}';
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal Tersimpan',
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
