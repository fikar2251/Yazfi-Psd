<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
            <div class="dash-widget-info text-right">
                {{-- <h3>{{ $pasien }}</h3> --}}
                <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                {{-- <h3>{{ $appointments }}</h3> --}}
                <span class="widget-title3">Appointment<i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                {{-- <h4 class="p-1">{{ $tindakan }} </h4> --}}
                <span class="widget-title4">Tindakan<i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Jadwal Hari Ini</h4> <a href="{{ route('resepsionis.appointments.index') }}" class="btn btn-primary float-right">View all</a>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
        <div class="card member-panel">
            <div class="card-header bg-white">
                <h4 class="card-title mb-0">Pasien Datang</h4>
            </div>
            <div class="card-body">
                <ul class="contact-list">
                </ul>
            </div>
            <div class="card-footer text-center bg-white">
                <a href="doctors.html" class="text-muted">View all Doctors</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
        <div class="card member-panel">
            <div class="card-header bg-white">
                <h4 class="card-title mb-0">Pasien Diperiksa</h4>
            </div>
            <div class="card-body">
                <ul class="contact-list">
                </ul>
            </div>
            <div class="card-footer text-center bg-white">
                <a href="doctors.html" class="text-muted">View all Doctors</a>
            </div>
        </div>
    </div>
</div>