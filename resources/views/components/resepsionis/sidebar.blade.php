<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
  

    <li class="{{ request()->is('finance/payment') ? 'active' : '' }}">
        <a href="{{ route('finance.payment') }}"><i class="fa-solid fa-money-bill-wave"></i> <span>Payment</span></a>
    </li>

      <li class="submenu">
        <a href="#"><i class="fa fa-money" aria-hidden="true"></i> <span>Refund</span><span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li class="{{ request()->is('finance/refund') ? 'active' : '' }}">
                <a href="{{ route('finance.refund') }}"><span>Input Refund</span></a>
            </li>
            <li class="{{ request()->is('finance/refund/list') ? 'active' : '' }}">
                <a href="{{ route('finance.refund.list') }}"><span>List Refund</span></a>
            </li>
        </ul>
    </li>
    

    <li class="{{ request()->is('finance/komisi') ? 'active' : '' }}">
        <a href="{{ route('finance.komisi') }}"><i class="fa fa-files-o"></i> <span>Komisi</span></a>
    </li>
</ul>