<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>

    <li class="{{ request()->is('purchasing/listpruchase*') ? 'active' : '' }}">
        <a href="{{ route('purchasing.listpurchase.index') }}"><i class="fa-solid fa-list-check"></i><span>List Purchase</span></a>
    </li>

    <li class="{{ request()->is('purchasing/inputtukarfaktur*') ? 'active' : '' }}">
        <a href="{{ route('purchasing.tukarfaktur.index') }}"><i class="fa-solid fa-list-check"></i> <span>List Faktur</span></a>
    </li>
    <li class="{{ request()->is('purchasing/penerimaanbarang*') ? 'active' : '' }}">
        <a href="{{ route('purchasing.penerimaan-barang.index') }}"><i class="fa fa-cart-plus"></i> <span>Penerimaan Barang</span></a>
    </li>
    <li class="{{ request()->is('purchasing/reinburst*') ? 'active' : '' }}">
        <a href="{{ route('purchasing.reinburst.index') }}"><i class="fa-solid fa-hand-holding-dollar"></i> <span>Reinburst</span></a>
    </li>

</ul>