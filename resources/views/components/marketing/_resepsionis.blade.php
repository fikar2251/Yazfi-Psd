<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $pasien }}</h3>
                <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $appointments }}</h3>
                <span class="widget-title3">Appointment<i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h4 class="p-1">{{ $tindakan }} </h4>
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
                        @foreach($jadwal as $jdw)
                        <tr>
                            <td style="min-width: 100px;">
                                <a class="avatar" href=""><img src="{{ asset('storage/' . $jdw->pasien->pict) }}" alt=""></a>
                                @php
                                $age = explode(",", $jdw->pasien->ttl)
                                @endphp
                                <h2><a href="">{{ $jdw->pasien->nama }}<span>{{ $jdw->pasien->jk }}, {{ \Carbon\Carbon::parse($age[1])->diff(\Carbon\Carbon::now())->format('%y') }}</span></a></h2>
                            </td>
                            <td>
                                <h5 class="time-title p-0">{{ $jdw->dokter->name }}</h5>
                                <p>{{ \Carbon\Carbon::parse($jdw->jam_status)->format('H.i') }} - {{ \Carbon\Carbon::parse($jdw->jam_selesai)->format('H.i') }}</p>
                            </td>
                            <td>
                                <form action="{{ route('resepsionis.appointments.status') }}" method="post" class="d-inline stts">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $jdw->id }}">
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Datang</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
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
                    @foreach($datang as $dtng)
                    <li class="d-flex">
                        <div class="contact-cont mr-auto">
                            <div class="float-left user-img m-r-10">
                                <a href="profile.html" title="John Doe"><img src="{{asset('/')}}img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                            </div>
                            <div class="contact-info">
                                <span class="contact-name text-ellipsis">{{ $dtng->pasien->nama }}</span>
                                <span class="contact-date">MBBS, MD</span>
                            </div>
                        </div>
                        <div class="form">
                            <form action="{{ route('resepsionis.appointments.status') }}" method="post" class="d-inline stts">
                                @csrf
                                <input type="hidden" name="id" value="{{ $dtng->id }}">
                                <input type="hidden" name="status" value="3">
                                <button type="submit" class="btn btn-sm btn-outline-success">Periksa</button>
                            </form>
                        </div>
                    </li>
                    @endforeach
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
                    @foreach($periksa as $prk)
                    <li class="d-flex">
                        <div class="contact-cont mr-auto">
                            <div class="float-left user-img m-r-10">
                                <a href="profile.html" title="John Doe"><img src="{{asset('/')}}img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                            </div>
                            <div class="contact-info">
                                <span class="contact-name text-ellipsis">{{ $prk->pasien->nama }}</span>
                                <span class="contact-date">MBBS, MD</span>
                            </div>
                        </div>
                        <div class="form">
                            <form action="{{ route('resepsionis.appointments.status') }}" method="post" class="d-inline stts">
                                @csrf
                                <input type="hidden" name="id" value="{{ $prk->id }}">
                                <input type="hidden" name="status" value="4">
                                <button type="submit" class="btn btn-sm btn-outline-warning">Selesai</button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer text-center bg-white">
                <a href="doctors.html" class="text-muted">View all Doctors</a>
            </div>
        </div>
    </div>
</div>