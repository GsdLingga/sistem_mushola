@extends('layouts.app2')

@section('title', 'Home')

@push('css')

@endpush

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Nazox</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                @if (auth()->user()->role == 'Admin')
                @isset($total_user)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Total User</p>
                                    <h4 class="mb-0">{{$total_user}}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="ri-user-fill font-size-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endisset
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Total Siswa</p>
                                    <h4 class="mb-0">{{$siswa}}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="ri-user-fill font-size-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif (auth()->user()->role == 'Guru')
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Total Siswa Kelas {{ Str::ucfirst($kelas->nama_kelas) }}</p>
                                    <h4 class="mb-0">{{$siswa}}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="ri-user-fill font-size-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                @else
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Total Siswa</p>
                                    <h4 class="mb-0">{{$siswa}}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="ri-user-fill font-size-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                @endif
            </div>
            @if (auth()->user()->role == 'Admin')
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">User</h4>
                    <div id="user-chart" class="apex-charts"></div>
                    <div class="row">
                        <div class="col-4">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-primary font-size-10 mr-1"></i>Admin</p>
                                <h5>{{$admin}} orang</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-success font-size-10 mr-1"></i>Pengurus</p>
                                <h5>{{$pengurus}} orang</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-warning font-size-10 mr-1"></i>Guru</p>
                                <h5>{{$guru}} orang</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Siswa</h4>
                    <div id="pie-chart" class="apex-charts"></div>
                    <div class="row">
                        <div class="col-3">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-primary font-size-10 mr-1"></i> Kelas A</p>
                                <h5>{{$kelasA}} siswa</h5>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-success font-size-10 mr-1"></i> Kelas B</p>
                                <h5>{{$kelasB}} siswa</h5>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-warning font-size-10 mr-1"></i> Kelas C</p>
                                <h5>{{$kelasC}} siswa</h5>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-danger font-size-10 mr-1"></i> Kelas D</p>
                                <h5>{{$kelasD}} siswa</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Siswa</h4>
                    <div id="pie-chart" class="apex-charts"></div>
                    <div class="row">
                        <div class="col-3">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-primary font-size-10 mr-1"></i> Kelas A</p>
                                <h5>{{$kelasA}} siswa</h5>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-success font-size-10 mr-1"></i> Kelas B</p>
                                <h5>{{$kelasB}} siswa</h5>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-warning font-size-10 mr-1"></i> Kelas C</p>
                                <h5>{{$kelasC}} siswa</h5>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-danger font-size-10 mr-1"></i> Kelas D</p>
                                <h5>{{$kelasD}} siswa</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        const Auth = "{{$role}}"
        if (Auth === "Admin") {
            let admin = {!! json_encode($admin) !!}
            let pengurus = {!! json_encode($pengurus) !!}
            let guru = {!! json_encode($guru) !!}

            var options = {
                series: [admin, pengurus, guru],
                chart: {
                width: 380,
                type: 'pie',
                },
                labels: ['Admin', 'Pengurus', 'Guru'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                        width: 200
                        },
                        legend: {
                        position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#user-chart"), options);
            chart.render();
        }
        let kelasA = {!! json_encode($kelasA) !!}
        let kelasB = {!! json_encode($kelasB) !!}
        let kelasC = {!! json_encode($kelasC) !!}
        let kelasD = {!! json_encode($kelasD) !!}

        var options = {
            series: [kelasA, kelasB, kelasC, kelasD],
            chart: {
            width: 380,
            type: 'pie',
            },
            labels: ['Kelas A', 'Kelas B', 'Kelas C', 'Kelas D'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                    width: 200
                    },
                    legend: {
                    position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#pie-chart"), options);
        chart.render();
    </script>
@endpush
