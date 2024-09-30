<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <span class="d-none d-md-inline-block ">Selamat Datang,
                @if (Auth::user()->roleId == 1)
                    {{ Auth::user()->role->name }}
                @else
                    @if (Auth::user()->roleId == 2)
                        {{ Auth::user()->guru->name }}
                    @else
                        @if (Auth::user()->roleId == 3)
                            {{ Auth::user()->pengurus->name }}
                        @else
                            {{ Auth::user()->wali->name }}
                        @endif
                    @endif
                @endif
            </span>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Style Switcher -->
            <li class="nav-item me-2 me-xl-0">
                <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class="ti ti-md"></i>
                </a>
            </li>
            <!--/ Style Switcher -->


            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ Auth::user()->image ? url('storage/profile/' . Auth::user()->image) : '../../assets/img/avatars/1.png' }}"
                            alt class="h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="pages-account-settings-account.html">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ Auth::user()->image ? url('storage/profile/' . Auth::user()->image) : '../../assets/img/avatars/1.png' }}"
                                            alt class="h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">
                                        @if (Auth::user()->roleId == 1)
                                            {{ Auth::user()->role->name }}
                                        @else
                                            @if (Auth::user()->roleId == 2)
                                                {{ Auth::user()->guru->name }}
                                            @else
                                                @if (Auth::user()->roleId == 3)
                                                    {{ Auth::user()->pengurus->name }}
                                                @else
                                                    {{ Auth::user()->wali->name }}
                                                @endif
                                            @endif
                                        @endif
                                    </span>
                                    <small class="text-muted">
                                        {{ Auth::user()->role->name }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/profile">
                            <i class="ti ti-user-check me-2 ti-sm"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button role="button" type="submit" class="dropdown-item">
                                <i class="ti ti-logout me-2 ti-sm"></i>
                                <span class="align-middle">Log Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search..." />
        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
    </div>
</nav>
