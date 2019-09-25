@extends('dashboard.layout')

@section('page title','Overview')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <img src="{{ asset('img/logo.png') }}" class="img-fluid" alt="logo" style="opacity: 0.8">
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
        const loading = '<i class="fas fa-spinner fa-pulse"></i>';

        let iStartDate = moment().subtract(7,'days').format('YYYY-MM-DD');
        let iEndDate = moment().add(7,'days').format('YYYY-MM-DD');
        const iRange = $('#dateRange');
        iRange.daterangepicker({
            startDate: moment().subtract(7,'days').format('DD-MM-YYYY'),
            endDate: moment().add(7,'days').format('DD-MM-YYYY'),
            locale: {
                format: 'DD-MM-YYYY'
            }
        });
        iRange.on('apply.daterangepicker', function(ev, picker) {
            iStartDate = picker.startDate.format('YYYY-MM-DD');
            iEndDate = picker.endDate.format('YYYY-MM-DD');
            reloadChart(iStartDate, iEndDate);
        });

        function reloadChart(startDate,endDate) {
            $.ajax({
                url: '{{ url('overview/list') }}',
                method: 'post',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function (response) {
                    // console.log(response);
                    let data = JSON.parse(response);
                    spChart.updateSeries([{
                        data: data.sales_prospect
                    }]);

                    grChart.updateSeries([{
                        data: data.booking_gr
                    }]);

                    bpChart.updateSeries([{
                        data: data.bp_estimation
                    }]);
                }
            })
        }

        $(document).ready(function () {
            // reloadChart(iStartDate, iEndDate);
        })
    </script>
@endsection
