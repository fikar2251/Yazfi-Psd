@extends('layouts.master', ['title' => 'Doctor'])

@section('content')
<div class="row">
    <div class="col-sm-7 col-6">
        <h4 class="page-title">Doctor Profile</h4>
    </div>

    <div class="col-sm-5 col-6 text-right m-b-30">
        <a href="edit-profile.html" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a>
    </div>
</div>
<div class="card-box profile-header">
    <div class="row">
        <div class="col-md-12">
            <div class="profile-view">
                <div class="profile-img-wrap">
                    <div class="profile-img">
                        <a href="#"><img class="avatar" src="{{ asset('/storage/'.$doctor->image) }}" alt=""></a>
                    </div>
                </div>
                <div class="profile-basic">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="profile-info-left">
                                <h3 class="user-name m-t-0 mb-0">{{ $doctor->name }}</h3>
                                <small class="text-muted">{{ $doctor->cabang->nama }}</small>
                                <div class="staff-id">Employee ID : DR-0001</div>
                                <div class="staff-msg"><a href="chat.html" class="btn btn-primary">Send Message</a></div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <ul class="personal-info">
                                <li>
                                    <span class="title">Phone:</span>
                                    <span class="text"><a href="">{{ $doctor->phone_number }}</a></span>
                                </li>
                                <li>
                                    <span class="title">Email:</span>
                                    <span class="text"><a href="">{{ $doctor->email }}</a></span>
                                </li>
                                <li>
                                    <span class="title">Address:</span>
                                    <span class="text">{{ $doctor->address }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="profile-tabs">
    <ul class="nav nav-tabs nav-tabs-bottom">
        <li class="nav-item"><a class="nav-link active" href="#appointment" data-toggle="tab">Appointment</a></li>
        <li class="nav-item"><a class="nav-link" href="#attendance" data-toggle="tab">Attendance</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane show active" id="appointment">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="card-title">Appointment List</h3>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No Booking</th>
                                            <th>Nama Pasien</th>
                                            <th>Umur</th>
                                            <th>Nama Dokter</th>
                                            <th>Cabang</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($booking as $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td><span class="badge badge-success">{{ $data->no_booking }}</span></td>
                                            <td>{{ $data->pasien->nama }}</td>
                                            <td>{{ \Carbon\Carbon::now()->format('Y') - \Carbon\Carbon::parse($data->pasien->tgl_lahir)->format('Y') }} Tahun</td>
                                            <td>{{ $data->dokter->name }}</td>
                                            <td>{{ $data->cabang->nama }}</td>
                                            <td>{{ $data->tanggal_status }}</td>
                                            <td>{{ $data->jam_status }} - {{ $data->jam_selesai }}</td>
                                            <td>
                                                <span class="custom-badge status-{{ $data->kedatangan->warna }}">
                                                    {{ $data->kedatangan->status }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane show" id="attendance">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="card-title">Attendance List</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-success">
                                        <tr>
                                            <th class="text-light">Tanggal</th>
                                            <th class="text-light">Hari</th>
                                            <th class="text-light">Shift</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attendance->unique('tanggal') as $data)
                                        @if($data->tanggal == Carbon\Carbon::now()->startOfMonth()->addDays($loop->iteration - 1)->format('Y-m-d'))
                                        <tr>
                                            <td>
                                                {{ $data->tanggal }}
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($data->tanggal)->format('l') }}
                                            </td>
                                            <td>
                                                <ul class="list-unstyled">
                                                    @foreach($data->shift->whereHas('jadwal', function($qr) use($data){ return $qr->where('tanggal', $data->tanggal); })->get() as $row)
                                                    <li>
                                                        @if($row->kode == 'SF1'|| $row->kode == 'SF2')
                                                        <i class="fa fa-check text-success">{{ $row->kode }}</i>
                                                        @else
                                                        @if($row->kode == 'L')
                                                        <i class="fa fa-close text-danger">{{ $row->kode }}</i>
                                                        @else
                                                        <i class="fa fa-info text-warning">{{ $row->kode }}</i>
                                                        @endif
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop