<section class="exclusive-deal-area" id="visiMisi">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 no-padding exclusive-left" style="background: url('{{ url('storage/'.$info['visi-misi']['visi'][0]['data']) }}') center no-repeat">
                <div class="row clock_sec clockdiv" id="clockdiv">
                    <div class="col-lg-12">
                        <h1>Visi Kami</h1>
                        <p>{{ $info['visi-misi']['visi'][1]['data'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 no-padding exclusive-right">
                <div class="row clock_sec clockdiv" id="clockdiv">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <h1>Misi Kami</h1>
                        <ul class="text-left">
                            @foreach($info['visi-misi']['misi'] as $i)
                                <li class="mt-3">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>
                                                <i class="fas fa-circle"></i>
                                            </td>
                                            <td>
                                                {{ $i['data'] }}
                                            </td>
                                        </tr>
                                    </table>
{{--                                    <div class="row">--}}
{{--                                        <div class="col">--}}
{{--                                            <i class="fas fa-circle"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-11">--}}
{{--                                            {{ $i['data'] }}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
