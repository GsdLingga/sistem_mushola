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
            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    {{-- <div class="float-right">
                        <select class="custom-select custom-select-sm">
                            <option selected>Apr</option>
                            <option value="1">Mar</option>
                            <option value="2">Feb</option>
                            <option value="3">Jan</option>
                        </select>
                    </div> --}}
                    <h4 class="card-title mb-4">Siswa</h4>

                    <div id="donut-chart" class="apex-charts"></div>

                    <div class="row">
                        <div class="col-4">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-primary font-size-10 mr-1"></i> Product A</p>
                                <h5>42 %</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-success font-size-10 mr-1"></i> Product B</p>
                                <h5>16 %</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-warning font-size-10 mr-1"></i> Product C</p>
                                <h5>42 %</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-dark font-size-10 mr-1"></i> Product D</p>
                                <h5>10 %</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->  
@endsection
