<div class="row">
    <div class="col-md-12">
        <h1 class="page-title">Dashboard</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{$total_pasien}}</h3>
                <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $appointment_count }}</h3>
                <span class="widget-title3">Appointment <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{$appointment_pending}}</h3>
                <span class="widget-title4">Tindakan Pending <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Appointment Complete Today</h3>
                    <a href="{{ route('dokter.appointments.index') }}" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped custom-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Pasien</th>
                                <th>Timing</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($finish as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <th>
                                    <div class="d-flex justify-content-start">
                                        <h5>
                                            <a href="{{ asset('') }}" class="avatar"></a>
                                            {{ $data->customer->nama }} - {{ (int)Carbon\Carbon::now()->format('Y') - (int)Carbon\Carbon::parse(substr($data->customer->ttl, -10))->format('Y') }} Tahun
                                            <h5>
                                    </div>
                                </th>
                                <th>{{ $data->jam_status }} - {{ $data->jam_selesai }}</th>
                                <th>
                                    <a href="{{route('dokter.appointments.show', $data->id)}}" class="btn btn-outline-primary btn-sm">Appointment Detail</a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title">Patient in</h3>
            </div>
            <div class="card-body">
                <ul class="contact-list">
                    @foreach($pending as $data)
                    <li>
                        <div class="contact-cont">
                            <div class="float-left user-img m-r-10">
                                <a href="profile.html" title="John Doe"><img class="avatar w-40 rounded-circle"><span class="status online"></span></a>
                            </div>
                            <div class="contact-info">
                                <a href="{{route('dokter.appointments.show', $data->id)}}"><span class="contact-name text-ellipsis">{{ $data->customer->nama }}</span></a>
                                <span class="contact-date">{{ $data->customer->alamat }}</span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>