@error('images')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <b>Error, </b> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@enderror

<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa-solid fa-money-bill-wave"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $bayar }}</h3>

                <span class="widget-title2"> <a style="color: white" href="{{ url('finance/daftar') }}"> Pembayaran pending <i
                            class="fa fa-check" aria-hidden="true"></i>
                    </a></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa-solid fa-receipt"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $refund }}</h3>
                <span class="widget-title3"> <a style="color: white" href="{{url('finance/refund/daftar')}}"> Refund pending<i class="fa fa-check" aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa-solid fa-money-check-dollar"></i></span>
            <div class="dash-widget-info text-right">
                <h3 class="p-1">{{ $komisi }} </h3>
                <span class="widget-title4"> <a style="color: white" href="{{url('finance/komisi/daftar')}}"> Komisi pending<i class="fa fa-check" aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg1"><i class="fa-solid fa-money-bill-transfer"></i></span>
            <div class="dash-widget-info text-right">
                <h3 class="p-1">{{$tukar}} </h3>
                <span class="widget-title1"> <a style="color: white" href="{{url('finance/tukar')}}">Tukar Faktur <i class="fa fa-check" aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg1" style="background: blueviolet"><i class="fa-solid fa-money-bill-wheat"></i></span>
            <div class="dash-widget-info text-right">
                <h3 class="p-1">{{$pengajuans}} </h3>
                <span class="widget-title1" style="background: blueviolet"> <a style="color: white" href="{{url('finance/pengajuan')}}">Pengajuan Dana <i class="fa fa-check" aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>
     <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg1" style="background: chocolate"><i class="fa-solid fa-coins"></i></span>
            <div class="dash-widget-info text-right">
                <h3 class="p-1">{{$reinbursts}} </h3>
                <span class="widget-title1" style="background: chocolate"> <a style="color: white" href="{{url('finance/reinburst')}}"> Reinburst <i class="fa fa-check" aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg1" style="background: chartreuse"><i
                    class="fa-solid fa-money-check-dollar"></i></span>
            <div class="dash-widget-info text-right">
                <h3 class="p-1">{{ $penggajians }} </h3>
                <span class="widget-title1" style="background: chartreuse"> <a style="color: white"
                        href="{{ url('finance/gaji') }}"> Gaji <i class="fa fa-check"
                            aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>

