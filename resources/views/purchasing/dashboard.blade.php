<div class="row">
    {{-- <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{$warehouse}}</h3>
                <span class="widget-title1">Purchase<i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div> --}}
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg1"><i class="fa-solid fa-list-check"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{$tukar_faktur_count}}</h3>
                <span class="widget-title1">Tukar Faktur</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa fa-cart-plus" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{$received_pending}}</h3>
                <span class="widget-title2">Received</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa-solid fa-hand-holding-dollar"></i></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{$reinburst_pending}}</h3>
                <span class="widget-title3">Reinburst</span>
            </div>
        </div>
    </div>

</div>