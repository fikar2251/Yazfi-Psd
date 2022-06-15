    <ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('/dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="{{ (request()->is('marketing/spr')) ? 'active' : '' }}">
        <a href="{{ route('marketing.spr.index') }}"> <i class="fa-solid fa-list"></i> <span>Daftar SPR</span></a>
    </li>
    <li class="{{ (request()->is('marketing/unit*')) ? 'active' : '' }}">
        <a href="{{ route('marketing.unit.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
            </svg><span>Unit Rumah</span></a>
    </li>
    <li class="{{ (request()->is('marketing/reinburst')) ? 'active' : '' }}">
        <a href="{{ route('marketing.reinburst.index') }}"> <i class="fa-solid fa-hand-holding-dollar"></i> <span>Reinburst</span></a>
    </li>
    {{-- <!-- <li class="{{ (request()->is('marketing/patient*')) ? 'active' : '' }}">
        <a href="{{ route('marketing.patient.index') }}"><i class="fa fa-wheelchair"></i> <span>Reinburst</span></a>
    </li> -->
    <!-- <li class="{{ (request()->is('marketing/appointments*')) ? 'active' : '' }}">
        <a href="{{ route('marketing.appointments.index') }}"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
    </li> --> --}}
</ul>
