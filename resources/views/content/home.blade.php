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
                                    <h4 class="mb-0">{{$chart_total_anggota_kelas}}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="ri-user-fill font-size-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif (auth()->user()->role == 'Guru')
                @foreach ($total_kelas as $total_kls)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Total Siswa Kelas {{ Str::ucfirst($total_kls->nama_kelas) }}</p>
                                    <h4 class="mb-0">{{$total_kls->total}}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="ri-user-fill font-size-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- end row -->
                @else
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Total Siswa</p>
                                    <h4 class="mb-0">{{$chart_total_anggota_kelas}}</h4>
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
                        @foreach ($chart_get_total_kelas as $get_kelas)
                        <div class="col-3">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-primary font-size-10 mr-1"></i> Kelas {{Str::ucfirst($get_kelas->nama_kelas)}}</p>
                                <h5>{{$get_kelas->total}} siswa</h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Siswa</h4>
                    <div id="pie-chart" class="apex-charts"></div>
                    <div class="row">
                        @foreach ($chart_get_total_kelas as $get_kelas)
                        <div class="col-3">
                            <div class="text-center mt-3">
                                <p class="mb-2 text-truncate"> Kelas {{Str::ucfirst($get_kelas->nama_kelas)}}</p>
                                <h5>{{$get_kelas->total}} siswa</h5>
                            </div>
                        </div>
                        @endforeach
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
        let kelas = {!! json_encode($chart_get_total_kelas) !!}

        const arr_kelas = []
        const arr_nilai = []
        kelas.forEach(element => {
            arr_kelas.push(element.nama_kelas.toUpperCase())
            arr_nilai.push(element.total)
        });

        var options = {
            series: arr_nilai,
            chart: {
            width: 380,
            type: 'pie',
            },
            labels: arr_kelas,
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
