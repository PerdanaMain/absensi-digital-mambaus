<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ url('assets/img/logo-pondok.png') }}" alt="Logo Pondok" style="max-height: 25px; ;">
            </span>
            <span class="app-brand-text demo menu-text fw-bold" style="font-size: 15px; ">Pondok Pesantren
                <br>Al Baiad</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Page -->
        <li class="menu-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-layout-2"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li
            class="menu-item {{ Route::currentRouteName() == 'sekolah.index' || Route::currentRouteName() == 'madin.index' || Route::currentRouteName() == 'mandiri.index' ? 'open' : '' }}">
            @if (in_array(Auth::user()->roleId, [1, 2, 3]))
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-transfer-in"></i>
                    <div>Presensi</div>
                </a>
            @endif
            <ul class="menu-sub">
                @if (in_array(Auth::user()->roleId, [1, 2]))
                    <li class="menu-item {{ Route::currentRouteName() == 'sekolah.index' ? 'active' : '' }}">
                        <a href="{{ route('sekolah.index') }}" class="menu-link">
                            <div>Sekolah</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::currentRouteName() == 'madin.index' ? 'active' : '' }}">
                        <a href="{{ route('madin.index') }}" class="menu-link">
                            <div>Madin</div>
                        </a>
                    </li>
                @endif
                @if (in_array(Auth::user()->roleId, [1, 3]))
                    <li class="menu-item {{ Route::currentRouteName() == 'mandiri.index' ? 'active' : '' }}">
                        <a href="{{ route('mandiri.index') }}" class="menu-link">
                            <div>Mandiri</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        @if (in_array(Auth::user()->roleId, [1, 3]))
            <li class="menu-item {{ Route::currentRouteName() == 'perizinan.index' ? 'active' : '' }}">
                <a href="{{ route('perizinan.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-mail-opened"></i>
                    <div>Perizinan</div>
                </a>
            </li>
        @endif

        <li
            class="menu-item {{ Route::currentRouteName() == 'rekapAbsensi.index' || Route::currentRouteName() == 'rekapMandiri.index' || Route::currentRouteName() == 'rekapPerizinan.index' ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-report"></i>
                <div>Laporan</div>
            </a>
            <ul class="menu-sub">
                @if (in_array(Auth::user()->roleId, [1, 2, 4]))
                    <li class="menu-item {{ Route::currentRouteName() == 'rekapAbsensi.index' ? 'active' : '' }}">
                        <a href="{{ route('rekapAbsensi.index') }}" class="menu-link">
                            <div>Laporan Absensi Sekolah / Madin</div>
                        </a>
                    </li>
                @endif
                @if (in_array(Auth::user()->roleId, [1, 3, 4]))
                    <li class="menu-item {{ Route::currentRouteName() == 'rekapMandiri.index' ? 'active' : '' }}">
                        <a href="{{ route('rekapMandiri.index') }}" class="menu-link">
                            <div>Laporan Absensi Kegiatan Mandiri</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::currentRouteName() == 'rekapPerizinan.index' ? 'active' : '' }}">
                        <a href="{{ route('rekapPerizinan.index') }}" class="menu-link">
                            <div>Laporan Perizinan</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        @if (Auth::user()->roleId == 1)
            <li
                class="menu-item {{ Route::currentRouteName() == 'guru.index' || Route::currentRouteName() == 'pengurus.index' || Route::currentRouteName() == 'santri.index' || Route::currentRouteName() == 'inputMatpelSantri.index' ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle ">
                    <i class="menu-icon tf-icons ti ti-devices-pc"></i>
                    <div>Sistem</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item  {{ Route::currentRouteName() == 'guru.index' ? 'active' : '' }}">
                        <a href="{{ route('guru.index') }}" class="menu-link">
                            <div>Guru</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::currentRouteName() == 'pengurus.index' ? 'active' : '' }}">
                        <a href="{{ route('pengurus.index') }}" class="menu-link">
                            <div>Pengurus</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::currentRouteName() == 'santri.index' ? 'active' : '' }}">
                        <a href="{{ route('santri.index') }}" class="menu-link">
                            <div>Santri</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::currentRouteName() == 'matpel.index' ? 'active' : '' }}">
                        <a href="{{ route('matpel.index') }}" class="menu-link">
                            <div>Mata Pelajaran</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::currentRouteName() == 'inputMatpelSantri.index' ? 'active' : '' }}">
                        <a href="{{ route('inputMatpelSantri.index') }}" class="menu-link">
                            <div>Matpel Santri</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::currentRouteName() == 'kelas.index' ? 'active' : '' }}">
                        <a href="{{ route('kelas.index') }}" class="menu-link">
                            <div>Kelas</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::currentRouteName() == 'reset.index' ? 'active' : '' }}">
                        <a href="{{ route('reset.index') }}" class="menu-link">
                            <div>Reset Password</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        <li class="menu-item {{ Route::currentRouteName() == 'profile.index' ? 'active' : '' }}">
            <a href="{{ route('profile.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div>Profile</div>
            </a>
        </li>
    </ul>
</aside>
