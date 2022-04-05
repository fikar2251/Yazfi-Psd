<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    <li class="{{ (request()->is('dokter/dokter/show*')) ? 'active' : '' }}">
        <a href="{{ route('dokter.show', auth()->user()->id) }}"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
    </li>
    <li class="{{ (request()->is('dokter/pasien*')) ? 'active' : '' }}">
        <a href="{{ route('dokter.pasien') }}"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
    </li>
    <li class="{{ (request()->is('dokter/appointments*')) ? 'active' : '' }}">
        <a href="{{route('dokter.appointments.index')}}"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
    </li>
</ul>