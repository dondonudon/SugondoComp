<section class="ftco-section ftco-agent ftco-no-pt">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">TEAMS</span>
                <h2 class="mb-4">Our Teams</h2>
            </div>
        </div>
        <div class="row justify-content-md-center">
            @foreach($ourteam as $t)
                <div class="col-md-3 ftco-animate">
                    <div class="agent">
                        <div class="img">
                            <img src="{{ url('storage/'.$t->foto) }}" class="img-fluid" alt="{{ $t->fullname }}" style="width: auto; height: 250px;">
                        </div>
                        <div class="desc">
                            <h3>{{ $t->fullname }}</h3>
                            <p class="h-info"><span class="location">{{ $t->jabatan }}</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>