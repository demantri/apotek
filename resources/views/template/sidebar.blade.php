<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav menu">
            <li class="sidebar-item">
                <a class="sidebar-link" href="/dashboard">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Masterdata
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('masterdata/obat') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Obat</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('masterdata/member') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Member</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('masterdata/supplier') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Supplier</span>
                </a>
            </li>

            {{-- laporan --}}
            <li class="sidebar-header">
                Manajemen Stok
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/pasien/checkup">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Stok Opname</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/pendaftaran/pasien">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Obat Kadaluarsa</span>
                </a>
            </li>


            {{-- laporan --}}
            <li class="sidebar-header">
                Transaksi
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('transaksi/penjualan-obat') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Penjualan Obat</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('transaksi/pembelian-obat') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Pembelian Obat</span>
                </a>
            </li>

            <li class="sidebar-header">
                Report
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('report/laporan-penjualan') }}">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Laporan Penjualan</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('report/laporan-pembelian') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Laporan Pembelian</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('report/jurnal-umum') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Jurnal Umum</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('report/buku-besar') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Buku Besar</span>
                </a>
            </li>

            {{-- setting --}}
            <li class="sidebar-header">
                Setting
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/setting/role">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Role</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/setting/users">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Users</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
