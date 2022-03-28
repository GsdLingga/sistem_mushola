<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                @if (auth()->user()->role == 'Admin')
                    <li>
                        <a href="{{route('admin.dashboard')}}" class="waves-effect">
                            <i class="ri-dashboard-line"></i>
                            {{-- <span class="badge badge-pill badge-success float-right">3</span> --}}
                            <span>Dashboard</span>
                        </a>
                    </li>
                
                    <li>
                        <a href="{{route('user.index')}}" class=" waves-effect">
                            <i class="ri-user-line"></i>
                            <span>User</span>
                        </a>
                    </li>

                    {{-- <li>
                        <a href="javascript: void(0);" class=" waves-effect">
                            <i class="ri-folder-3-line"></i>
                            <span>Laporan</span>
                        </a>
                    </li> --}}
                @elseif (auth()->user()->role == 'Pengurus')
                    <li>
                        <a href="{{route('pengurus.dashboard')}}" class="waves-effect">
                            <i class="ri-dashboard-line"></i>
                            {{-- <span class="badge badge-pill badge-success float-right">3</span> --}}
                            <span>Dashboard</span>
                        </a>
                    </li>
                @elseif (auth()->user()->role == 'Guru')
                    <li>
                        <a href="{{route('guru.dashboard')}}" class="waves-effect">
                            <i class="ri-dashboard-line"></i>
                            {{-- <span class="badge badge-pill badge-success float-right">3</span> --}}
                            <span>Dashboard</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Guru')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-user-line"></i>
                            <span>Siswa</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('siswa.index')}}">Daftar Siswa</a></li>
                            {{-- <li><a href="javascript: void(0);">Nilai</a></li> --}}
                            <li><a href="{{route('raport.index')}}">Raport</a></li>
                            <li><a href="{{route('absensi.index')}}">Absen</a></li>
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="calendar.html" class=" waves-effect">
                            <i class="ri-file-list-2-line"></i>
                            <span>Nilai</span>
                        </a>
                    </li>

                    <li>
                        <a href="calendar.html" class=" waves-effect">
                            <i class="ri-book-line"></i>
                            <span>Rapot</span>
                        </a>
                    </li>

                    <li>
                        <a href="calendar.html" class=" waves-effect">
                            <i class="ri-file-paper-2-line"></i>
                            <span>Absen</span>
                        </a>
                    </li>     --}}
                @endif 
                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Pengurus')
                    <li>
                        <a href="{{route('zakat.index')}}" class=" waves-effect">
                            <i class="ri-coin-line"></i>
                            <span>Zakat</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('spp.index')}}" class=" waves-effect">
                            <i class="ri-red-packet-line"></i>
                            <span>SPP</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('jadwal-pengajian.index')}}" class=" waves-effect">
                            <i class="ri-calendar-2-line"></i>
                            <span>Jadwal Pengajian</span>
                        </a>
                    </li> 
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->