@extends('layouts.master', ['title' => 'Profile'])

@section('content')
<div class="row">
    <div class="col-sm-7 col-6">
        <h4 class="page-title">My Profile</h4>
    </div>

    <div class="col-sm-5 col-6 text-right m-b-30">
        <a href="{{ route('edit.profile') }}" class="btn btn-primary btn-rounded"><i class="fa fa-edit"></i> Edit
            Profile</a>
    </div>
</div>
<div class="card-box profile-header">
    <div class="row">
        <div class="col-md-12">
            <div class="profile-view">
                <!--<div class="profile-img-wrap">-->
                <!--    <div class="profile-img">-->
                <!--        <div class="col-sm-6 col-sg-4 m-b-4">-->
                <!--            <div class="dashboard-logo">-->
                <!--                <img src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="profile-basic">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="profile-info-left">
                                <h3 class="user-name m-t-0 mb-0">{{ $profile->name }}</h3>
                                <small class="text-muted">
                                    @foreach($profile->roles as $role)
                                    {{ $role->key }}
                                    @endforeach</small>
                                <div class="staff-id">Employee ID : {{ $profile->nik }}</div>
                                <!--<div class="staff-msg"><a href="#" class="btn btn-primary">Send Message</a></div>-->
                            </div>
                        </div>
                        <div class="col-md-7">
                            <ul class="personal-info">
                                <li>
                                    <span class="title">Phone:</span>
                                    <span class="text"><a>{{ $profile->phone_number }}</a></span>
                                </li>
                                <li>
                                    <span class="title">Email:</span>
                                    <span class="text"><a>{{ $profile->email }}</a></span>
                                </li>
                                <!-- <li>
                                    <span class="title">Birthday:</span>
                                    <span class="text">3rd March</span>
                                </li> -->
                                <li>
                                    <span class="title">Address:</span>
                                    <span class="text">{{ $profile->address }}</span>
                                </li>
                                <!-- <li>
                                    <span class="title">Gender:</span>
                                    <span class="text">Female</span>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop