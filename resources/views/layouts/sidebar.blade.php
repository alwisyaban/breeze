<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">QA</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseGowning"
                    aria-expanded="false" aria-controls="collapseGowning">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-columns"></i>
                    </div>
                    Data Gowning
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>
                <div class="collapse" id="collapseGowning" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('karyawan.index') }}"><i class="fa-solid fa-users"> </i>&nbsp
                            List
                            Karyawan</a>
                        <a class="nav-link" href="{{ route('kualifikasiTerori.index') }}"> <i
                                class="fa-regular fa-clipboard"></i>&nbsp HCO</a>
                        <a class="nav-link" href="{{ route('kualifikasiGowning.index') }}"><i
                                class="fa-brands fa-galactic-republic"></i>&nbsp QC</a>
                        <a class="nav-link" href="{{ route('laporan-gowning.index') }}"><i
                                class="fa-solid fa-file"></i>&nbsp Laporan Gowning</a>
                    </nav>
                </div>
                {{-- new --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseInspeksi" aria-expanded="false" aria-controls="collapseInspeksi">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-columns"></i>
                    </div>
                    Data Kerjernihan
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>
                <div class="collapse" id="collapseInspeksi" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('inspeksi.index') }}"> <i
                                class="fa-regular fa-clipboard"></i>&nbsp List Karyawan</a>
                        <a class="nav-link" href="#"><i class="fa-solid fa-file"></i>&nbsp Laporan Gowning</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseConfig"
                    aria-expanded="false" aria-controls="collapseConfig">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                    Config
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>
                @if (Auth::user()->name == 'admin')
                    <div class="collapse" id="collapseConfig" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('departemen.index') }}"><i
                                    class="fa-regular fa-building"></i>&nbsp List Departemen</a>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>
