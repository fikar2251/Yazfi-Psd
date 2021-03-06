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

    <li class="submenu">
        <a href="#"><i class="fa-solid fa-book"></i><span>Accounting</span><span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li class="{{ request()->is('finance/chart') ? 'active' : '' }}">
                <a href="{{ route('finance.chart') }}"><span>Chart of account</span></a>
            </li>
            <li class="{{ request()->is('finance/transactions') ? 'active' : '' }}">
                <a href="{{ route('finance.transactions') }}"><span>Transactions</span></a>
            </li>
            <li class="{{ request()->is('finance/reinburst') ? 'active' : '' }}">
                <a href="{{ route('finance.reinburst.index') }}"><span>Reinburst</span></a>
            </li>
            <li class="{{ request()->is('finance/jurnal') ? 'active' : '' }}">
                <a href="{{ route('finance.jurnal.index') }}"><span>Jurnal Voucher</span></a>
            </li>
        </ul>
    </li>

</ul>