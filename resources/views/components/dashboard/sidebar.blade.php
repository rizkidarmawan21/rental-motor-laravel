<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> --}}
        <div class="sidebar-brand-text mx-3">Rental Motor</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <!-- collapsed -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Menejemen Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner roun ded">
                <h6 class="collapse-header">Menejemen Data</h6>
                <a class="collapse-item {{ set_active(['penyewa.index','penyewa.edit']) }}"
                    href="{{ route('penyewa.index') }}">Data Penyewa</a>
                <a class="collapse-item {{ set_active(['motor.index','motor.edit','motor.show']) }}"
                    href="{{ route('motor.index') }}">Data
                    Motor</a>
                <a class="collapse-item {{ set_active(['user.index','user.edit']) }}"
                    href="{{ route('user.index') }}">Data Akun User</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Charts -->
    <li class="nav-item {{ set_active(['penyewaan.index','penyewaan.edit','penyewaan.show']) }}">
        <a class="nav-link" href="{{ route('penyewaan.index') }}">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>Penyewaan</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ set_active(['pengembalian.index','pengembalian.edit','pengembalian.show']) }}">
        <a class="nav-link" href="{{ route('pengembalian.index') }}">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>Pengembalian</span></a>
    </li>
    <li class="nav-item {{ set_active(['pembayaran.index']) }}">
        <a class="nav-link" href="{{ route('pembayaran.index') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Pembayaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->